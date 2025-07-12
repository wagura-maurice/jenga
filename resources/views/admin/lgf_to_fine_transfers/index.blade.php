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
        <li><a href="#">Lgf To Fine Transfers</a></li>
        <li class="active">Table</li>
    </ol>
    <h1 class="page-header">Lgf To Fine Transfers - DATA <small>lgf to fine transfers data goes here...</small></h1>
    <div class="row">
        <div class="col-md-12">
            @if($lgftofinetransfersdata['usersaccountsroles'][0]->_add==1)
            <a href="{!! route('lgftofinetransfers.create') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-plus"></i></button></a>
            @endif
            @if($lgftofinetransfersdata['usersaccountsroles'][0]->_report==1)
            <a href="{!! url('admin/lgftofinetransfersreport') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-file-text-o"></i></button></a>
            @endif
            @if($lgftofinetransfersdata['usersaccountsroles'][0]->_report==1 || $lgftofinetransfersdata['usersaccountsroles'][0]->_list==1)
            <a href="#modal-dialog"  data-toggle="modal"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-filter"></i></button></a>
            @endif
        </div>
    </div>
    @if($lgftofinetransfersdata['usersaccountsroles'][0]->_list==1)
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
                        @foreach ($lgftofinetransfersdata['list'] as $lgftofinetransfers)
                            <tr>
                                <td class='table-text'><div>
                                    {!! $lgftofinetransfers->transaction_number !!}
                                </div></td>                                
                                <td class='table-text'><div>
                                	{!! $lgftofinetransfers->clientmodel->client_number !!}
                                	{!! $lgftofinetransfers->clientmodel->first_name !!}
                                	{!! $lgftofinetransfers->clientmodel->middle_name !!}
                                	{!! $lgftofinetransfers->clientmodel->last_name !!}
                                </div></td>
                                <td class='table-text'><div>
                                	{!! $lgftofinetransfers->loanmodel->loan_number !!}
                                </div></td>
                                <td class='table-text'><div>
                                	{!! $lgftofinetransfers->amount !!}
                                </div></td>
                                <td class='table-text'><div>
                                	{!! $lgftofinetransfers->initiatedbymodel->name !!}
                                </div></td>
                                <td class='table-text'><div>
                                	{!! $lgftofinetransfers->transaction_date !!}
                                </div></td>
                                <td class='table-text'><div>
                                	{!! $lgftofinetransfers->approvalstatusmodel->name !!}
                                </div></td>
                                <td>
                <form action="{!! route('lgftofinetransfers.destroy',$lgftofinetransfers->id) !!}" method="POST">
                                        @if($lgftofinetransfersdata['usersaccountsroles'][0]->_show==1)
                                        <a href="{!! route('lgftofinetransfers.show',$lgftofinetransfers->id) !!}" id='show-lgftofinetransfers-{!! $lgftofinetransfers->id !!}' class='btn btn-sm btn-circle btn-icon btn-inverse'>
                                            <i class='fa fa-btn fa-eye'></i>
                                        </a>
                                        @endif

                                        @if($lgftofinetransfersdata['usersaccountsroles'][0]->_delete==1)
                                        <input type="hidden" name="_method" value="delete" />
                                        {!! csrf_field() !!}
                                        {!! method_field('DELETE') !!}
                                        <button type='submit' id='delete-lgftofinetransfers-{!! $lgftofinetransfers->id !!}' class='btn btn-icon btn-sm btn-circle btn-danger'>
                                            <i class='fa fa-btn fa-trash'></i>
                                        </button>
                                        @endif
                                        @if($lgftofinetransfersdata['usersaccountsroles'][0]->_edit==1)
                                        <a href="{!! route('lgftofinetransfers.edit',$lgftofinetransfers->id) !!}" id='edit-lgftofinetransfers-{!! $lgftofinetransfers->id !!}' class='btn btn-icon btn-sm btn-circle btn-warning'>
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
                <h4 class="modal-title">Lgf To Fine Transfers - Filter Dialog</h4>
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
                    <form id="form"  class="form-horizontal" action="{!! url('admin/lgftofinetransfersfilter') !!}" method="POST">
                        {!! csrf_field() !!}
                                <div class="form-group">
                                    <label for="Client" class="col-sm-3 control-label">Client</label>
                                    <div class="col-sm-6">
									    <select class="form-control selectpicker" data-size="100000" data-live-search="true" data-style="btn-white" name="client"  id="client">
                                            <option value="" >Select Client</option>				                                @foreach ($lgftofinetransfersdata['clients'] as $clients)
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
                                            <option value="" >Select Loan</option>				                                @foreach ($lgftofinetransfersdata['loans'] as $loans)
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
                                            <option value="" >Select Initiated By</option>				                                @foreach ($lgftofinetransfersdata['users'] as $users)
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
                                            <option value="" >Select Approval Status</option>				                                @foreach ($lgftofinetransfersdata['approvalstatuses'] as $approvalstatuses)
				                                <option value="{!! $approvalstatuses->id !!}">
					
				                                {!! $approvalstatuses->name!!}
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
                                    <div class="col-sm-offset-3 col-sm-6">
                                    <div class="col-sm-offset-3 col-sm-6">
                                        <button type="submit" class="btn btn-sm btn-inverse">
                                            <i class="fa fa-btn fa-search"></i> Search Lgf To Fine Transfers
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