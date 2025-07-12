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
        <li><a href="#">Clearing Fee Approvals</a></li>
        <li class="active">Table</li>
    </ol>
    <h1 class="page-header">Clearing Fee Approvals - DATA <small>clearing fee approvals data goes here...</small></h1>
    <div class="row">
        <div class="col-md-12">
            @if($clearingfeeapprovalsdata['usersaccountsroles'][0]->_add==1)
            <a href="{!! route('clearingfeeapprovals.create') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-plus"></i></button></a>
            @endif
            @if($clearingfeeapprovalsdata['usersaccountsroles'][0]->_report==1)
            <a href="{!! url('admin/clearingfeeapprovalsreport') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-file-text-o"></i></button></a>
            @endif
            @if($clearingfeeapprovalsdata['usersaccountsroles'][0]->_report==1 || $clearingfeeapprovalsdata['usersaccountsroles'][0]->_list==1)
            <a href="#modal-dialog"  data-toggle="modal"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-filter"></i></button></a>
            @endif
        </div>
    </div>
    @if($clearingfeeapprovalsdata['usersaccountsroles'][0]->_list==1)
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
                                        <th>Transaction Reference</th>
                                        <th>Approval Level</th>
                                        <th>Approved By</th>
                                        <th>Approval Status</th>
                                        <th>Date</th>
                                        <th>Action</th>                                    </tr>
                        </thead>
                        <tbody>
                        @foreach ($clearingfeeapprovalsdata['list'] as $clearingfeeapprovals)
                            <tr>
                                <td class='table-text'><div>
                                	{!! $clearingfeeapprovals->transactionreferencemodel->transaction_reference !!}
                                </div></td>
                                <td class='table-text'><div>
                                	{!! $clearingfeeapprovals->approvallevelmodel->name !!}
                                </div></td>
                                <td class='table-text'><div>
                                	{!! $clearingfeeapprovals->approvedbymodel->name !!}
                                </div></td>
                                <td class='table-text'><div>
                                	{!! $clearingfeeapprovals->approvalstatusmodel->name !!}
                                </div></td>
                                <td class='table-text'><div>
                                	{!! $clearingfeeapprovals->date !!}
                                </div></td>
                                <td>
                <form action="{!! route('clearingfeeapprovals.destroy',$clearingfeeapprovals->id) !!}" method="POST">
                                        @if($clearingfeeapprovalsdata['usersaccountsroles'][0]->_show==1)
                                        <a href="{!! route('clearingfeeapprovals.show',$clearingfeeapprovals->id) !!}" id='show-clearingfeeapprovals-{!! $clearingfeeapprovals->id !!}' class='btn btn-sm btn-circle btn-inverse'>
                                            <i class='fa fa-btn fa-eye'></i>
                                        </a>
                                        @endif
                                        @if($clearingfeeapprovalsdata['usersaccountsroles'][0]->_edit==1)
                                        <a href="{!! route('clearingfeeapprovals.edit',$clearingfeeapprovals->id) !!}" id='edit-clearingfeeapprovals-{!! $clearingfeeapprovals->id !!}' class='btn btn-sm btn-circle btn-warning'>
                                            <i class='fa fa-btn fa-edit'></i>
                                        </a>
                                        @endif
                                        @if($clearingfeeapprovalsdata['usersaccountsroles'][0]->_delete==1)
                                        <input type="hidden" name="_method" value="delete" />
                                        {!! csrf_field() !!}
                                        {!! method_field('DELETE') !!}
                                        <button type='submit' id='delete-clearingfeeapprovals-{!! $clearingfeeapprovals->id !!}' class='btn btn-sm btn-circle btn-danger'>
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
                <h4 class="modal-title">Clearing Fee Approvals - Filter Dialog</h4>
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
                    <form id="form"  class="form-horizontal" action="{!! url('admin/clearingfeeapprovalsfilter') !!}" method="POST">
                        {!! csrf_field() !!}
                                <div class="form-group">
                                    <label for="Transaction Reference" class="col-sm-3 control-label">Transaction Reference</label>
                                    <div class="col-sm-6">
									    <select class="form-control selectpicker" data-size="100000" data-live-search="true" data-style="btn-white" name="transaction_reference"  id="transaction_reference">
                                            <option value="" >Select Transaction Reference</option>				                                @foreach ($clearingfeeapprovalsdata['clearingfeepayments'] as $clearingfeepayments)
				                                <option value="{!! $clearingfeepayments->id !!}">
					
				                                {!! $clearingfeepayments->transaction_reference!!}
				                                </option>
				                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Approval Level" class="col-sm-3 control-label">Approval Level</label>
                                    <div class="col-sm-6">
									    <select class="form-control selectpicker" data-size="100000" data-live-search="true" data-style="btn-white" name="approval_level"  id="approval_level">
                                            <option value="" >Select Approval Level</option>				                                @foreach ($clearingfeeapprovalsdata['approvallevels'] as $approvallevels)
				                                <option value="{!! $approvallevels->id !!}">
					
				                                {!! $approvallevels->name!!}
				                                </option>
				                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Approved By" class="col-sm-3 control-label">Approved By</label>
                                    <div class="col-sm-6">
									    <select class="form-control selectpicker" data-size="100000" data-live-search="true" data-style="btn-white" name="approved_by"  id="approved_by">
                                            <option value="" >Select Approved By</option>				                                @foreach ($clearingfeeapprovalsdata['users'] as $users)
				                                <option value="{!! $users->id !!}">
					
				                                {!! $users->name!!}
				                                </option>
				                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Approval Status" class="col-sm-3 control-label">Approval Status</label>
                                    <div class="col-sm-6">
									    <select class="form-control selectpicker" data-size="100000" data-live-search="true" data-style="btn-white" name="approval_status"  id="approval_status">
                                            <option value="" >Select Approval Status</option>				                                @foreach ($clearingfeeapprovalsdata['transactionstatuses'] as $transactionstatuses)
				                                <option value="{!! $transactionstatuses->id !!}">
					
				                                {!! $transactionstatuses->name!!}
				                                </option>
				                                @endforeach
                                        </select>
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
                                    <div class="col-sm-offset-3 col-sm-6">
                                    <div class="col-sm-offset-3 col-sm-6">
                                        <button type="submit" class="btn btn-sm btn-inverse">
                                            <i class="fa fa-btn fa-search"></i> Search Clearing Fee Approvals
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