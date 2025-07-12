@extends("admin.home")
@section("main_content")
<style type="text/css">
	td div img{
		max-width: 64px;
	}
</style>
<div id="content" class="content">
    <ol class="breadcrumb pull-right">
        <li><a href="#">Home</a></li>
        <li><a href="#">Public</a></li>
        <li><a href="#">Lgf To Loan Transfers</a></li>
        <li class="active">Table</li>
    </ol>
    <h1 class="page-header">Lgf To Loan Transfers - DATA <small>lgf to loan transfers data goes here...</small></h1>
    <div class="row">
        <div class="col-md-12">
            @if($lgftoloantransfersdata['usersaccountsroles'][0]->_add==1)
            <a href="{!! route('lgftoloantransfers.create') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-plus"></i></button></a>
            @endif
            @if($lgftoloantransfersdata['usersaccountsroles'][0]->_report==1)
            <a href="{!! url('admin/lgftoloantransfersreport') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-file-text-o"></i></button></a>
            @endif
            @if($lgftoloantransfersdata['usersaccountsroles'][0]->_report==1 || $lgftoloantransfersdata['usersaccountsroles'][0]->_list==1)
            <a href="#modal-dialog"  data-toggle="modal"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-filter"></i></button></a>
            @endif
        </div>
    </div>
    @if($lgftoloantransfersdata['usersaccountsroles'][0]->_list==1)
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
                                        <th>Transaction Number</th>
                                        <th>Client</th>
                                        <th>Loan</th>
                                        <th>Amount</th>
                                        <th>Initiated By</th>
                                        <th>Transaction Date</th>
                                        <th>Approval Status</th>
                                        <th>Action</th>                                    </tr>
                        </thead>
                        <tbody>
                        @foreach ($lgftoloantransfersdata['list'] as $lgftoloantransfers)
                            <tr>
                                <td class='table-text'><div>
                                    {!! $lgftoloantransfers->transaction_number !!}
                                </div></td>                                
                                <td class='table-text'><div>
                                	{!! $lgftoloantransfers->clientmodel->client_number !!}
                                	{!! $lgftoloantransfers->clientmodel->first_name !!}
                                	{!! $lgftoloantransfers->clientmodel->middle_name !!}
                                	{!! $lgftoloantransfers->clientmodel->last_name !!}
                                </div></td>
                                <td class='table-text'><div>
                                	{!! $lgftoloantransfers->loanmodel->loan_number !!}
                                </div></td>
                                <td class='table-text'><div>
                                	{!! $lgftoloantransfers->amount !!}
                                </div></td>
                                <td class='table-text'><div>
                                	{!! $lgftoloantransfers->initiatedbymodel->name !!}
                                </div></td>
                                <td class='table-text'><div>
                                	{!! $lgftoloantransfers->transaction_date !!}
                                </div></td>
                                <td class='table-text'><div>
                                	{!! $lgftoloantransfers->approvalstatusmodel->name !!}
                                </div></td>
                                <td>
                <form action="{!! route('lgftoloantransfers.destroy',$lgftoloantransfers->id) !!}" method="POST">
                                        @if($lgftoloantransfersdata['usersaccountsroles'][0]->_show==1)
                                        <a href="{!! route('lgftoloantransfers.show',$lgftoloantransfers->id) !!}" id='show-lgftoloantransfers-{!! $lgftoloantransfers->id !!}' class='btn btn-icon btn-sm btn-circle btn-inverse'>
                                            <i class='fa fa-btn fa-eye'></i>
                                        </a>
                                        @endif
                                        @if($lgftoloantransfersdata['usersaccountsroles'][0]->_delete==1)
                                        <input type="hidden" name="_method" value="delete" />
                                        {!! csrf_field() !!}
                                        {!! method_field('DELETE') !!}
                                        <button type='submit' id='delete-lgftoloantransfers-{!! $lgftoloantransfers->id !!}' class='btn btn-icon btn-sm btn-circle btn-danger'>
                                            <i class='fa fa-btn fa-trash'></i>
                                        </button>
                                        @endif
                                        @if($lgftoloantransfersdata['usersaccountsroles'][0]->_edit==1)
                                        <a href="{!! route('lgftoloantransfers.edit',$lgftoloantransfers->id) !!}" id='edit-lgftoloantransfers-{!! $lgftoloantransfers->id !!}' class='btn btn-icon btn-sm btn-circle btn-warning'>
                                            <i class='fa fa-btn fa-check'></i>
                                        </a>
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
                <h4 class="modal-title">Lgf To Loan Transfers - Filter Dialog</h4>
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
                    <form id="form"  class="form-horizontal" action="{!! url('admin/lgftoloantransfersfilter') !!}" method="POST">
                        {!! csrf_field() !!}
                                <div class="form-group">
                                    <label for="Client" class="col-sm-3 control-label">Client</label>
                                    <div class="col-sm-6">
									    <select class="form-control selectpicker" data-size="100000" data-live-search="true" data-style="btn-white" name="client"  id="client">
                                            <option value="" >Select Client</option>				                                @foreach ($lgftoloantransfersdata['clients'] as $clients)
				                                <option value="{!! $clients->id !!}">
					
				                                {!! $clients->client_number!!}
				                                {!! $clients->first_name!!}
				                                {!! $clients->middle_name!!}
				                                {!! $clients->last_name!!}
				                                </option>
				                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Loan" class="col-sm-3 control-label">Loan</label>
                                    <div class="col-sm-6">
									    <select class="form-control selectpicker" data-size="100000" data-live-search="true" data-style="btn-white" name="loan"  id="loan">
                                            <option value="" >Select Loan</option>				                                @foreach ($lgftoloantransfersdata['loans'] as $loans)
				                                <option value="{!! $loans->id !!}">
					
				                                {!! $loans->loan_number!!}
				                                </option>
				                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Amount" class="col-sm-3 control-label">Amount</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="amount"  id="amount" class="form-control" placeholder="Amount" value="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Initiated By" class="col-sm-3 control-label">Initiated By</label>
                                    <div class="col-sm-6">
									    <select class="form-control selectpicker" data-size="100000" data-live-search="true" data-style="btn-white" name="initiated_by"  id="initiated_by">
                                            <option value="" >Select Initiated By</option>				                                @foreach ($lgftoloantransfersdata['users'] as $users)
				                                <option value="{!! $users->id !!}">
					
				                                {!! $users->name!!}
				                                </option>
				                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Transaction Date" class="col-sm-3 control-label">Transaction Date</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="transaction_datefrom" id="transaction_datefrom" class="form-control m-b-5" placeholder="Transaction Date From" value="">
                                        <input type="text" name="transaction_dateto" id="transaction_dateto" class="form-control" placeholder="Transaction Date To" value="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Approval Status" class="col-sm-3 control-label">Approval Status</label>
                                    <div class="col-sm-6">
									    <select class="form-control selectpicker" data-size="100000" data-live-search="true" data-style="btn-white" name="approval_status"  id="approval_status">
                                            <option value="" >Select Approval Status</option>				                                @foreach ($lgftoloantransfersdata['approvalstatuses'] as $approvalstatuses)
				                                <option value="{!! $approvalstatuses->id !!}">
					
				                                {!! $approvalstatuses->name!!}
				                                </option>
				                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-3 col-sm-6">
                                    <div class="col-sm-offset-3 col-sm-6">
                                        <button type="submit" class="btn btn-sm btn-inverse">
                                            <i class="fa fa-btn fa-search"></i> Search Lgf To Loan Transfers
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
$("#transaction_datefrom").datepicker({todayHighlight:!0,autoclose:!0});
$("#transaction_dateto").datepicker({todayHighlight:!0,autoclose:!0});
</script>
@endsection