@extends("admin.home")
@section("main_content")
<div id="content" class="content">
    <ol class="breadcrumb pull-right">
        <li><a href="#">Home</a></li>
        <li><a href="#">Public</a></li>
        <li><a href="#">Loan Payments</a></li>
        <li class="active">Table</li>
    </ol>
    <h1 class="page-header">Loan Payments - DATA <small>loan payments data goes here...</small></h1>
    <div class="row">
        <div class="col-md-12">
            @if($loanpaymentsdata['usersaccountsroles'][0]->_add==1)
            <a href="{!! route('loanpayments.create') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-plus"></i></button></a>
            @endif
            @if($loanpaymentsdata['usersaccountsroles'][0]->_report==1)
            <a href="{!! url('admin/loanpaymentsreport') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-file-text-o"></i></button></a>
            @endif
            @if($loanpaymentsdata['usersaccountsroles'][0]->_report==1 || $loanpaymentsdata['usersaccountsroles'][0]->_list==1)
            <a href="#modal-dialog"  data-toggle="modal"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-filter"></i></button></a>
            @endif
    @if($loanpaymentsdata['usersaccountsroles'][0]->_list==1)
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
                    <h4 class="panel-title">DataTable - Autofill</h4>
                </div>
                <div class="panel-body">
                    <table id="data-table" class="table table-striped table-bordered">
                        <thead>
                                    <tr>
                                        <th>Loan</th>
                                        <th>Mode Of Payment</th>
                                        <th>Transaction Number</th>
                                        <th>Amount</th>
                                        <th>Date</th>
                                        <th>Transaction Status</th>
                                        <th>Action</th>                                    </tr>
                        </thead>
                        <tbody>
                        @foreach ($loanpaymentsdata['list'] as $loanpayments)
                            <tr>
                                <td class='table-text'><div>
                                	{!! $loanpayments->loanmodel->loan_number !!}
                                </div></td>
                                <td class='table-text'><div>
                                	{!! $loanpayments->modeofpaymentmodel->name !!}
                                </div></td>
                                <td class='table-text'><div>
                                	{!! $loanpayments->transaction_number !!}
                                </div></td>
                                <td class='table-text'><div>
                                	{!! $loanpayments->amount !!}
                                </div></td>
                                <td class='table-text'><div>
                                	{!! $loanpayments->date !!}
                                </div></td>
                                <td class='table-text'><div>
                                	{!! $loanpayments->transactionstatusmodel->name !!}
                                </div></td>
                                <td>
                                <form action="{!! route('loanpayments.destroy',$loanpayments->id) !!}" method="POST">
                                                        @if($loanpaymentsdata['usersaccountsroles'][0]->_show==1)
                                                        <a href="{!! route('loanpayments.show',$loanpayments->id) !!}" id='show-loanpayments-{!! $loanpayments->id !!}' class='btn btn-sm btn-circle btn-inverse'>
                                                            <i class='fa fa-btn fa-eye'></i>
                                                        </a>
                                                        @endif
                                                        @if($loanpaymentsdata['usersaccountsroles'][0]->_delete==1)
                                                        <input type="hidden" name="_method" value="delete" />
                                                        {!! csrf_field() !!}
                                                        {!! method_field('DELETE') !!}
                                                        <button type='submit' id='delete-loanpayments-{!! $loanpayments->id !!}' class='btn btn-sm btn-circle btn-danger'>
                                                            <i class='fa fa-btn fa-refresh'></i>
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
                <h4 class="modal-title">Loan Payments - Filter Dialog</h4>
            </div>
            <div class="modal-body">
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
                    <form id="form"  class="form-horizontal" action="{!! url('admin/loanpaymentsfilter') !!}" method="POST">
                        {!! csrf_field() !!}
                                <div class="form-group">
                                    <label for="Loan" class="col-sm-3 control-label">Loan</label>
                                    <div class="col-sm-6">
									    <select class="form-control" name="loan"  id="loan">
                                            <option value="" >Select Loan</option>				                                @foreach ($loanpaymentsdata['loans'] as $loans)
				                                <option value="{!! $loans->id !!}">
					
				                                {!! $loans->loan_number!!}
				                                </option>
				                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Mode Of Payment" class="col-sm-3 control-label">Mode Of Payment</label>
                                    <div class="col-sm-6">
									    <select class="form-control" name="mode_of_payment"  id="mode_of_payment">
                                            <option value="" >Select Mode Of Payment</option>				                                @foreach ($loanpaymentsdata['paymentmodes'] as $paymentmodes)
				                                <option value="{!! $paymentmodes->id !!}">
					
				                                {!! $paymentmodes->name!!}
				                                </option>
				                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Transaction Number" class="col-sm-3 control-label">Transaction Number</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="transaction_number"  id="transaction_number" class="form-control" placeholder="Transaction Number" value="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Amount" class="col-sm-3 control-label">Amount</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="amount"  id="amount" class="form-control" placeholder="Amount" value="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Date" class="col-sm-3 control-label">Date</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="datefrom" id="datefrom" class="form-control m-b-5" placeholder="Date From" value="">
                                        <input type="text" name="dateto" id="dateto" class="form-control" placeholder="Date To" value="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Transaction Status" class="col-sm-3 control-label">Transaction Status</label>
                                    <div class="col-sm-6">
									    <select class="form-control" name="transaction_status"  id="transaction_status">
                                            <option value="" >Select Transaction Status</option>				                                @foreach ($loanpaymentsdata['transactionstatuses'] as $transactionstatuses)
				                                <option value="{!! $transactionstatuses->id !!}">
					
				                                {!! $transactionstatuses->name!!}
				                                </option>
				                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-3 col-sm-6">
                                    <div class="col-sm-offset-3 col-sm-6">
                                        <button type="submit" class="btn btn-sm btn-inverse">
                                            <i class="fa fa-btn fa-search"></i> Search Loan Payments
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
$("#datefrom").datepicker({todayHighlight:!0,autoclose:!0});
$("#dateto").datepicker({todayHighlight:!0,autoclose:!0});
</script>
@endsection