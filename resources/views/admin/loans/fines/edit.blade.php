@extends('admin.home')
@section('main_content')
    <div id="content" class="content">
        <ol class="breadcrumb pull-right">
            <li><a href="#">Home</a></li>
            <li><a href="#">public</a></li>
            <li><a href="#">Fine Payment</a></li>
            <li class="active">form</li>
        </ol>
        <h1 class="page-header">Fine Payment Form <small>fine payments details goes here...</small></h1>
        <div class="row">
            <div class="col-md-12">
                <a href="{!! route('loanfine.index') !!}"><button type="button"
                        class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-arrow-left"></i></button></a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-inverse">
                    <div class="panel-heading">
                        <div class="panel-heading-btn">
                            <a href="#" class="btn btn-xs btn-icon btn-circle btn-default"
                                data-click="panel-expand"><i class="fa fa-expand"></i></a>
                            <a href="#" class="btn btn-xs btn-icon btn-circle btn-success"
                                data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                            <a href="#" class="btn btn-xs btn-icon btn-circle btn-warning"
                                data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                            <a href="#" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i
                                    class="fa fa-times"></i></a>
                        </div>
                        <h4 class="panel-title">DataForm - Autofill</h4>
                    </div>
                    <div class="panel-body">
                        <form id="form" class="form-horizontal">
                            {!! csrf_field() !!}
                            <input type="hidden" name="loanfine" id="loanfine" value="{{ $data['fine']->id }}" required>
                            <div class="form-group">
                                <label for="Loan" class="col-sm-3 control-label">Loan</label>
                                <div class="col-sm-6">
                                    <select class="form-control" name="loan" id="loan" required>
                                        <option value="">Select Loan</option>
                                        @foreach ($data['loans'] as $loans)
                                            <option value="{!! $loans->id !!}"
                                                @if ($loans->id == $data['fine']->loan->id) selected @endif>
                                                {!! $loans->loan_number !!}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Payment Mode" class="col-sm-3 control-label">Payment Mode</label>
                                <div class="col-sm-6">
                                    <select class="form-control" name="payment_mode" id="payment_mode" required>
                                        <option value="">Select Payment Mode</option>
                                        @foreach ($data['paymentmodes'] as $paymentmode)
                                            <option value="{!! $paymentmode->id !!}"
                                                @if ($paymentmode->id == $data['fine']->loan->id) selected @endif>
                                                {!! $paymentmode->name !!}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Transaction Code" class="col-sm-3 control-label">Transaction Code</label>
                                <div class="col-sm-6">
                                    <input type="text" name="transaction_code" id="transaction_code" class="form-control"
                                        placeholder="Transaction Code" value="" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Amount" class="col-sm-3 control-label">Amount</label>
                                <div class="col-sm-6">
                                    <input type="text" name="amount" id="amount" class="form-control"
                                        placeholder="Amount" value="{{ $data['fine']->amount ?? null }}" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Date" class="col-sm-3 control-label">Date</label>
                                <div class="col-sm-6">
                                    <input type="text" name="date" id="date" class="form-control"
                                        placeholder="Date" value="" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-6">
                                    <button type="button" onclick="save()" class="btn btn-sm btn-primary">
                                        <i class="fa fa-btn fa-plus"></i> Add Fine Payments
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script language="javascript" type="text/javascript">
        function save() {
            var formData = new FormData($('#form')[0]);
            $.ajax({
                type: 'POST',
                url: "{!! route('finepayments.store') !!}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function(data) {
                    var obj = jQuery.parseJSON(data);
                    if (obj.status == '1') {
                        $.gritter.add({
                            title: 'Success',
                            text: obj.message,
                            sticky: false,
                            time: '1000',
                        });
                        $("#form")[0].reset();

                        setTimeout(function() {
                            window.location.replace("{!! route('loanfine.index') !!}");
                        }, 2000);
                    } else {
                        $.gritter.add({
                            title: 'Fail',
                            text: obj.message,
                            sticky: false,
                            time: '5000',
                        });
                    }
                },
                error: function(data) {
                    console.log(data)
                    $.gritter.add({
                        title: 'Error',
                        text: 'An Error occurred. Please review your data then submit again!!',
                        sticky: false,
                        time: '5000',
                    });
                }
            });
            return false;
        }

        $("#date").datepicker({
            todayHighlight: !0,
            autoclose: !0
        });
    </script>
@endsection
