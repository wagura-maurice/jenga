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
        <li><a href="#">Inventory Transfer Approval Levels</a></li>
        <li class="active">Table</li>
    </ol>
    <h1 class="page-header">Inventory Transfer Approval Levels - DATA <small>inventory transfer approval levels data goes here...</small></h1>
    <div class="row">
        <div class="col-md-12">
            @if($inventorytransferapprovallevelsdata['usersaccountsroles'][0]->_add==1)
            <a href="{!! route('inventorytransferapprovallevels.create') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-plus"></i></button></a>
            @endif
            @if($inventorytransferapprovallevelsdata['usersaccountsroles'][0]->_report==1)
            <a href="{!! url('admin/inventorytransferapprovallevelsreport') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-file-text-o"></i></button></a>
            @endif
            @if($inventorytransferapprovallevelsdata['usersaccountsroles'][0]->_report==1 || $inventorytransferapprovallevelsdata['usersaccountsroles'][0]->_list==1)
            <a href="#modal-dialog"  data-toggle="modal"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-filter"></i></button></a>
            @endif
        </div>
    </div>
    @if($inventorytransferapprovallevelsdata['usersaccountsroles'][0]->_list==1)
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
                                        <th>Client Type</th>
                                        <th>User Account</th>
                                        <th>Approval Level</th>
                                        <th>Action</th>                                    </tr>
                        </thead>
                        <tbody>
                        @foreach ($inventorytransferapprovallevelsdata['list'] as $inventorytransferapprovallevels)
                            <tr>
                                <td class='table-text'><div>
                                	{!! $inventorytransferapprovallevels->clienttypemodel->name !!}
                                </div></td>
                                <td class='table-text'><div>
                                	{!! $inventorytransferapprovallevels->useraccountmodel->name !!}
                                </div></td>
                                <td class='table-text'><div>
                                	{!! $inventorytransferapprovallevels->approvallevelmodel->name !!}
                                </div></td>
                                <td>
                <form action="{!! route('inventorytransferapprovallevels.destroy',$inventorytransferapprovallevels->id) !!}" method="POST">
                                        @if($inventorytransferapprovallevelsdata['usersaccountsroles'][0]->_show==1)
                                        <a href="{!! route('inventorytransferapprovallevels.show',$inventorytransferapprovallevels->id) !!}" id='show-inventorytransferapprovallevels-{!! $inventorytransferapprovallevels->id !!}' class='btn btn-sm btn-circle btn-inverse'>
                                            <i class='fa fa-btn fa-eye'></i>
                                        </a>
                                        @endif
                                        @if($inventorytransferapprovallevelsdata['usersaccountsroles'][0]->_edit==1)
                                        <a href="{!! route('inventorytransferapprovallevels.edit',$inventorytransferapprovallevels->id) !!}" id='edit-inventorytransferapprovallevels-{!! $inventorytransferapprovallevels->id !!}' class='btn btn-sm btn-circle btn-warning'>
                                            <i class='fa fa-btn fa-edit'></i>
                                        </a>
                                        @endif
                                        @if($inventorytransferapprovallevelsdata['usersaccountsroles'][0]->_delete==1)
                                        <input type="hidden" name="_method" value="delete" />
                                        {!! csrf_field() !!}
                                        {!! method_field('DELETE') !!}
                                        <button type='submit' id='delete-inventorytransferapprovallevels-{!! $inventorytransferapprovallevels->id !!}' class='btn btn-sm btn-circle btn-danger'>
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
                <h4 class="modal-title">Inventory Transfer Approval Levels - Filter Dialog</h4>
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
                    <form id="form"  class="form-horizontal" action="{!! url('admin/inventorytransferapprovallevelsfilter') !!}" method="POST">
                        {!! csrf_field() !!}
                                <div class="form-group">
                                    <label for="Client Type" class="col-sm-3 control-label">Client Type</label>
                                    <div class="col-sm-6">
									    <select class="form-control selectpicker" data-size="100000" data-live-search="true" data-style="btn-white" name="client_type"  id="client_type">
                                            <option value="" >Select Client Type</option>				                                @foreach ($inventorytransferapprovallevelsdata['clienttypes'] as $clienttypes)
				                                <option value="{!! $clienttypes->id !!}">
					
				                                {!! $clienttypes->name!!}
				                                </option>
				                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="User Account" class="col-sm-3 control-label">User Account</label>
                                    <div class="col-sm-6">
									    <select class="form-control selectpicker" data-size="100000" data-live-search="true" data-style="btn-white" name="user_account"  id="user_account">
                                            <option value="" >Select User Account</option>				                                @foreach ($inventorytransferapprovallevelsdata['usersaccounts'] as $usersaccounts)
				                                <option value="{!! $usersaccounts->id !!}">
					
				                                {!! $usersaccounts->name!!}
				                                </option>
				                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Approval Level" class="col-sm-3 control-label">Approval Level</label>
                                    <div class="col-sm-6">
									    <select class="form-control selectpicker" data-size="100000" data-live-search="true" data-style="btn-white" name="approval_level"  id="approval_level">
                                            <option value="" >Select Approval Level</option>				                                @foreach ($inventorytransferapprovallevelsdata['approvallevels'] as $approvallevels)
				                                <option value="{!! $approvallevels->id !!}">
					
				                                {!! $approvallevels->name!!}
				                                </option>
				                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-3 col-sm-6">
                                    <div class="col-sm-offset-3 col-sm-6">
                                        <button type="submit" class="btn btn-sm btn-inverse">
                                            <i class="fa fa-btn fa-search"></i> Search Inventory Transfer Approval Levels
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
@endsection