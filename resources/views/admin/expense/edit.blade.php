@extends('admin.home')
@section('main_content')
    <div id="content" class="content">
        <ol class="breadcrumb pull-right">
            <li><a href="#">Home</a></li>
            <li><a href="#">public</a></li>
            <li><a href="#">Expense</a></li>
            <li class="active">form</li>
        </ol>
        <h1 class="page-header">Expense Update Form <small>expense fee details goes
                here...</small></h1>
        <div class="row">
            <div class="col-md-12">
                <a href="{!! route('expense.index') !!}"><button type="button"
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
                        <form id="form" class="form-horizontal" action="{!! route('expense.update', $data['expense']->id) !!}" method="POST">
                            {!! csrf_field() !!}
                            <div class="form-group">
                                <label for="Expense Type" class="col-sm-3 control-label">Expense Type</label>
                                <div class="col-sm-6">
                                    <select class="form-control selectpicker" data-size="100000" data-live-search="true"
                                        data-style="btn-white" name="expense_type" id="expense_type">
                                        <option value="">Select Expense Type</option>
                                        @foreach ($data['types'] as $type)
                                            <option value="{!! $type->id !!}" {{ $type->id == $data['expense']->expensetypemodel->id ? 'selected' : NULL }}>
                                                {!! $type->name !!}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Payment Mode" class="col-sm-3 control-label">Payment Mode</label>
                                <div class="col-sm-6">
                                    <select class="form-control selectpicker" data-size="100000" data-live-search="true"
                                        data-style="btn-white" name="payment_mode" id="payment_mode" required>
                                        <option value="">Select Payment Mode</option>
                                        @foreach ($data['paymentmodes'] as $paymentmodes)
                                            <option value="{!! $paymentmodes->id !!}" {{ $paymentmodes->id == $data['expense']->paymentmodemodel->id ? 'selected' : NULL }}>
                                                {!! $paymentmodes->name !!}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Transaction Code" class="col-sm-3 control-label">Transaction Code</label>
                                <div class="col-sm-6">
                                    <input type="text" name="transaction_code" id="transaction_code" class="form-control"
                                        placeholder="Transaction Code" value="{{ $data['expense']->transaction_code }}" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Amount" class="col-sm-3 control-label">Amount</label>
                                <div class="col-sm-6">
                                    <input type="number" name="amount" id="amount" class="form-control"
                                        placeholder="Amount" value="{{ $data['expense']->amount }}" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Date" class="col-sm-3 control-label">Date</label>
                                <div class="col-sm-6">
                                    <input type="text" name="date" id="date" class="form-control"
                                        placeholder="Date" value="{{ \Carbon\Carbon::parse($data['expense']->date)->format('m/d/Y') }}" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Transaction Status" class="col-sm-3 control-label">Transaction Status</label>
                                <div class="col-sm-6">
                                    <select class="form-control selectpicker" data-size="100000" data-live-search="true"
                                        data-style="btn-white" name="_status" id="_status" required>
                                        <option value="">Select Transaction Status</option>
                                        @foreach ($data['transactionstatuses'] as $transactionstatuses)
                                            <option value="{!! $transactionstatuses->id !!}" {{ $transactionstatuses->id == $data['expense']->transactionstatusmodel->id ? 'selected' : NULL }}>
                                                {!! $transactionstatuses->name !!}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-6">
                                    <button type="submit" class="btn btn-sm btn-primary">
                                        <i class="fa fa-btn fa-plus"></i> Add Expense
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
        $("#date").datepicker({
            todayHighlight: !0,
            autoclose: !0
        });
    </script>
@endsection
