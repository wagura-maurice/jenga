@extends('admin.home')
@section('main_content')
    <div id="content" class="content">
        <ol class="breadcrumb pull-right">
            <li><a href="#">Home</a></li>
            <li><a href="#">Public</a></li>
            <li><a href="#">Fine Payments</a></li>
            <li class="active">Table</li>
        </ol>
        <h1 class="page-header">Fine Payments - DATA <small>fine payments data goes here...</small></h1>
        <div class="row">
            <div class="col-md-12">
                @if ($finepaymentsdata['usersaccountsroles'][0]->_add == 1)
                    <a href="{!! route('finepayments.create') !!}"><button type="button"
                            class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-plus"></i></button></a>
                @endif
                @if ($finepaymentsdata['usersaccountsroles'][0]->_report == 1)
                    <a href="{!! url('admin/finepaymentsreport') !!}"><button type="button"
                            class="btn btn-inverse btn-icon btn-circle m-b-10"><i
                                class="fa fa-file-text-o"></i></button></a>
                @endif
                @if ($finepaymentsdata['usersaccountsroles'][0]->_report == 1 || $finepaymentsdata['usersaccountsroles'][0]->_list == 1)
                    <a href="#modal-dialog" data-toggle="modal"><button type="button"
                            class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-filter"></i></button></a>
                @endif
                @if ($finepaymentsdata['usersaccountsroles'][0]->_list == 1)
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
                        <h4 class="panel-title">DataTable - Autofill</h4>
                    </div>
                    <div class="panel-body">
                        <table id="data-table" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Loan</th>
                                    <th>Payment Mode</th>
                                    <th>Amount</th>
                                    <th>Transaction Code</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($finepaymentsdata['list'] as $finepayments)
                                    <tr>
                                        <td class='table-text'>
                                            <div>
                                                {!! $finepayments->loanmodel->loan_number !!}
                                            </div>
                                        </td>
                                        <td class='table-text'>
                                            <div>
                                                {!! $finepayments->paymentmodemodel->name !!}
                                            </div>
                                        </td>
                                        <td class='table-text'>
                                            <div>
                                                {!! $finepayments->amount !!}
                                            </div>
                                        </td>
                                        <td class='table-text'>
                                            <div>
                                                {!! $finepayments->transaction_code !!}
                                            </div>
                                        </td>
                                        <td class='table-text'>
                                            <div>
                                                {!! $finepayments->date !!}
                                            </div>
                                        </td>
                                        <td>
                                            <form action="{!! route('finepayments.destroy', $finepayments->id) !!}" method="POST">
                                                @if ($finepaymentsdata['usersaccountsroles'][0]->_show == 1)
                                                    <a href="{!! route('finepayments.show', $finepayments->id) !!}"
                                                        id='show-finepayments-{!! $finepayments->id !!}'
                                                        class='btn btn-sm btn-circle btn-inverse'>
                                                        <i class='fa fa-btn fa-eye'></i>
                                                    </a>
                                                @endif
                                                @if ($finepaymentsdata['usersaccountsroles'][0]->_edit == 1)
                                                    <a href="{!! route('finepayments.edit', $finepayments->id) !!}"
                                                        id='edit-finepayments-{!! $finepayments->id !!}'
                                                        class='btn btn-sm btn-circle btn-warning'>
                                                        <i class='fa fa-btn fa-edit'></i>
                                                    </a>
                                                @endif
                                                @if ($finepaymentsdata['usersaccountsroles'][0]->_delete == 1)
                                                    <input type="hidden" name="_method" value="delete" />
                                                    {!! csrf_field() !!}
                                                    {!! method_field('DELETE') !!}
                                                    <button type='submit' id='delete-finepayments-{!! $finepayments->id !!}'
                                                        class='btn btn-sm btn-circle btn-danger'>
                                                        <i class='fa fa-btn fa-trash'></i>
                                                    </button>
                                                @endif
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    <div class="modal fade modal-message" id="modal-dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">close</button>
                    <h4 class="modal-title">Fine Payments - Filter Dialog</h4>
                </div>
                <div class="modal-body">
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
                                        <a href="#" class="btn btn-xs btn-icon btn-circle btn-danger"
                                            data-click="panel-remove"><i class="fa fa-times"></i></a>
                                    </div>
                                    <h4 class="panel-title">DataForm - Autofill</h4>
                                </div>
                                <div class="panel-body">
                                    <form id="form" class="form-horizontal" action="{!! url('admin/finepaymentsfilter') !!}"
                                        method="POST">
                                        {!! csrf_field() !!}
                                        <div class="form-group">
                                            <label for="Loan" class="col-sm-3 control-label">Loan</label>
                                            <div class="col-sm-6">
                                                <select class="form-control" name="loan" id="loan">
                                                    <option value="">Select Loan</option>
                                                    @foreach ($finepaymentsdata['loans'] as $loans)
                                                        <option value="{!! $loans->id !!}">

                                                            {!! $loans->loan_number !!}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="Payment Mode" class="col-sm-3 control-label">Payment Mode</label>
                                            <div class="col-sm-6">
                                                <select class="form-control" name="payment_mode" id="payment_mode">
                                                    <option value="">Select Payment Mode</option>
                                                    @foreach ($finepaymentsdata['paymentmodes'] as $paymentmodes)
                                                        <option value="{!! $paymentmodes->id !!}">

                                                            {!! $paymentmodes->name !!}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="Amount" class="col-sm-3 control-label">Amount</label>
                                            <div class="col-sm-6">
                                                <input type="text" name="amount" id="amount" class="form-control"
                                                    placeholder="Amount" value="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="Date" class="col-sm-3 control-label">Date</label>
                                            <div class="col-sm-6">
                                                <input type="text" name="datefrom" id="datefrom"
                                                    class="form-control m-b-5" placeholder="Date From" value="">
                                                <input type="text" name="dateto" id="dateto" class="form-control"
                                                    placeholder="Date To" value="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-offset-3 col-sm-6">
                                                <div class="col-sm-offset-3 col-sm-6">
                                                    <button type="submit" class="btn btn-sm btn-inverse">
                                                        <i class="fa fa-btn fa-search"></i> Search Fine Payments
                                                    </button>
                                                </div>
                                            </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="javascript:;" class="btn btn-sm btn-white" data-dismiss="modal">Close</a>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script language="javascript" type="text/javascript">
        $("#datefrom").datepicker({
            todayHighlight: !0,
            autoclose: !0
        });
        $("#dateto").datepicker({
            todayHighlight: !0,
            autoclose: !0
        });
    </script>
@endsection
