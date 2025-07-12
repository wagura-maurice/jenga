@extends("admin.home")
@section("main_content")
<div id="content" class="content">
    <ol class="breadcrumb pull-right">
        <li><a href="#">Home</a></li>
        <li><a href="#">public</a></li>
        <li><a href="#">Account To Account Transfers</a></li>
        <li class="active">form</li>
    </ol>
    <h1 class="page-header">Account To Account Transfers Form <small>account to account transfers details goes here...</small></h1>
    <div class="row">
        <div class="col-md-12">
            <a href="{!! route('accounttoaccounttransfers.index') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-arrow-left"></i></button></a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <div class="panel-heading-btn">
                        <a href="#" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                        <a href="#" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                        <a href="#" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                        <a href="#" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                    </div>
                    <h4 class="panel-title">DataForm - Autofill</h4>
                </div>
                <div class="panel-body">
                    <form id="form" class="form-horizontal" enctype="multipart/form-data">
                        {!! csrf_field() !!}
                        <div class="form-group">
                            <label for="Transaction Number" class="col-sm-3 control-label">Transaction Number</label>
                            <div class="col-sm-6">
                                <input type="text" name="transaction_number" required="required" id="transaction_number" class="form-control" placeholder="Transaction Number" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="Account From" class="col-sm-3 control-label">Account From</label>
                            <div class="col-sm-6">
                                <select class="form-control selectpicker" required="required" data-size="100000" data-live-search="true" data-style="btn-white" name="account_from" id="account_from">
                                    <option value="">Select Account From</option> @foreach ($accounttoaccounttransfersdata['accounts'] as $accounts)
                                    <option value="{!! $accounts->id !!}">

                                        {!! $accounts->name!!}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="Account To" class="col-sm-3 control-label">Account To</label>
                            <div class="col-sm-6">
                                <select class="form-control selectpicker" required="required" data-size="100000" data-live-search="true" data-style="btn-white" name="account_to" id="account_to">
                                    <option value="">Select Account To</option> @foreach ($accounttoaccounttransfersdata['accounts'] as $accounts)
                                    <option value="{!! $accounts->id !!}">

                                        {!! $accounts->name!!}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="Amount" class="col-sm-3 control-label">Amount</label>
                            <div class="col-sm-6">
                                <input type="text" name="amount" required="required" id="amount" class="form-control" placeholder="Amount" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="Initiated By" class="col-sm-3 control-label">Initiated By</label>
                            <div class="col-sm-6">
                                <input type="text" readonly="" class="form-control" value="{{ strtoupper(Auth::user()->name) }}" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="Transaction Date" class="col-sm-3 control-label">Transaction Date</label>
                            <div class="col-sm-6">
                                <input type="text" required="required" name="transaction_date" id="transaction_date" class="form-control" placeholder="Transaction Date" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-6">
                                <button type="button" onclick="save()" class="btn btn-sm btn-primary" id="btn-save">
                                    <i class="fa fa-btn fa-plus"></i> Add Account To Account Transfers
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script language="javascript" type="text/javascript">
    function save() {

        if (!$("select[name='account_from']").val()) {

            $.gritter.add({
                title: 'Error',
                text: 'Must select account from!!',
                sticky: false,
                time: '5000',
            });

            return;
        }


        if (!$("select[name='account_to']").val()) {

            $.gritter.add({
                title: 'Error',
                text: 'Must select account to!!',
                sticky: false,
                time: '5000',
            });

            return;
        }

        if (!$("input[name='amount']").val()) {

            $.gritter.add({
                title: 'Error',
                text: 'Must provide amount!!',
                sticky: false,
                time: '5000',
            });

            return;
        }

        if (!$("input[name='transaction_number']").val()) {

            $.gritter.add({
                title: 'Error',
                text: 'Must provide transaction number!!',
                sticky: false,
                time: '5000',
            });

            return;
        }


        if (!$("input[name='transaction_date']").val()) {

            $.gritter.add({
                title: 'Error',
                text: 'Must provide transaction date!!',
                sticky: false,
                time: '5000',
            });

            return;
        }

        $("#btn-save").attr("disable", true);

        var formData = new FormData($('#form')[0]);
        $.ajax({
            type: 'POST',
            url: "{!! route('accounttoaccounttransfers.store')!!}",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function(data) {
                $("#btn-save").attr("disable", false);
                var obj = jQuery.parseJSON(data);
                if (obj.status == '1') {
                    $.gritter.add({
                        title: 'Success',
                        text: obj.message,
                        sticky: false,
                        time: '1000',
                    });
                    $("#form")[0].reset();
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
                    text: 'An Error occured. Please review your data then submit again!!',
                    sticky: false,
                    time: '5000',
                });
            }
        });
        return false;
    }
</script>
@endsection
@section('script')
<script language="javascript" type="text/javascript">
    $("#transaction_date").datepicker({
        todayHighlight: !0,
        autoclose: !0
    }).datepicker({
        dateFormat: "yy-mm-dd"
    }).datepicker("setDate", new Date());
    $(document).ready(function() {

        function gettransactionnumber() {

            $.get("{!!url('/admin/getacttoacttransactionnumber')!!}", function(data) {
                $("#transaction_number").val(data);
            });

        }

        gettransactionnumber();
    });
</script>
@endsection