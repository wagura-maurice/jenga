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
        <li><a href="#">Purchase Order Approval Mappings</a></li>
        <li class="active">Table</li>
    </ol>
    <h1 class="page-header">Purchase Order Approval Mappings - DATA <small>purchase order approval mappings data goes here...</small></h1>
    <div class="row">
        <div class="col-md-12">
            @if($purchaseorderapprovalmappingsdata['usersaccountsroles'][0]->_add==1)
            <a href="{!! route('purchaseorderapprovalmappings.create') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-plus"></i></button></a>
            @endif
            @if($purchaseorderapprovalmappingsdata['usersaccountsroles'][0]->_report==1)
            <a href="{!! url('admin/purchaseorderapprovalmappingsreport') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-file-text-o"></i></button></a>
            @endif
            @if($purchaseorderapprovalmappingsdata['usersaccountsroles'][0]->_report==1 || $purchaseorderapprovalmappingsdata['usersaccountsroles'][0]->_list==1)
            <a href="#modal-dialog"  data-toggle="modal"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-filter"></i></button></a>
            @endif
        </div>
    </div>
    @if($purchaseorderapprovalmappingsdata['usersaccountsroles'][0]->_list==1)
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
                                        <th>Store</th>
                                        <th>Approval Level</th>
                                        <th>User Account</th>
                                        <th>Action</th>                                    </tr>
                        </thead>
                        <tbody>
                        @foreach ($purchaseorderapprovalmappingsdata['list'] as $purchaseorderapprovalmappings)
                            <tr>
                                <td class='table-text'><div>
                                	{!! $purchaseorderapprovalmappings->storemodel->number !!}
                                	{!! $purchaseorderapprovalmappings->storemodel->name !!}
                                </div></td>
                                <td class='table-text'><div>
                                	{!! $purchaseorderapprovalmappings->approvallevelmodel->name !!}
                                </div></td>
                                <td class='table-text'><div>
                                	{!! $purchaseorderapprovalmappings->useraccountmodel->name !!}
                                </div></td>
                                <td>
                <form action="{!! route('purchaseorderapprovalmappings.destroy',$purchaseorderapprovalmappings->id) !!}" method="POST">
                                        @if($purchaseorderapprovalmappingsdata['usersaccountsroles'][0]->_show==1)
                                        <a href="{!! route('purchaseorderapprovalmappings.show',$purchaseorderapprovalmappings->id) !!}" id='show-purchaseorderapprovalmappings-{!! $purchaseorderapprovalmappings->id !!}' class='btn btn-sm btn-circle btn-inverse'>
                                            <i class='fa fa-btn fa-eye'></i>
                                        </a>
                                        @endif
                                        @if($purchaseorderapprovalmappingsdata['usersaccountsroles'][0]->_edit==1)
                                        <a href="{!! route('purchaseorderapprovalmappings.edit',$purchaseorderapprovalmappings->id) !!}" id='edit-purchaseorderapprovalmappings-{!! $purchaseorderapprovalmappings->id !!}' class='btn btn-sm btn-circle btn-warning'>
                                            <i class='fa fa-btn fa-edit'></i>
                                        </a>
                                        @endif
                                        @if($purchaseorderapprovalmappingsdata['usersaccountsroles'][0]->_delete==1)
                                        <input type="hidden" name="_method" value="delete" />
                                        {!! csrf_field() !!}
                                        {!! method_field('DELETE') !!}
                                        <button type='submit' id='delete-purchaseorderapprovalmappings-{!! $purchaseorderapprovalmappings->id !!}' class='btn btn-sm btn-circle btn-danger'>
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
                <h4 class="modal-title">Purchase Order Approval Mappings - Filter Dialog</h4>
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
                    <form id="form"  class="form-horizontal" action="{!! url('admin/purchaseorderapprovalmappingsfilter') !!}" method="POST">
                        {!! csrf_field() !!}
                                <div class="form-group">
                                    <label for="Store" class="col-sm-3 control-label">Store</label>
                                    <div class="col-sm-6">
									    <select class="form-control selectpicker" data-size="100000" data-live-search="true" data-style="btn-white" name="store"  id="store">
                                            <option value="" >Select Store</option>				                                @foreach ($purchaseorderapprovalmappingsdata['stores'] as $stores)
				                                <option value="{!! $stores->id !!}">
					
				                                {!! $stores->number!!}
				                                {!! $stores->name!!}
				                                </option>
				                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Approval Level" class="col-sm-3 control-label">Approval Level</label>
                                    <div class="col-sm-6">
									    <select class="form-control selectpicker" data-size="100000" data-live-search="true" data-style="btn-white" name="approval_level"  id="approval_level">
                                            <option value="" >Select Approval Level</option>				                                @foreach ($purchaseorderapprovalmappingsdata['approvallevels'] as $approvallevels)
				                                <option value="{!! $approvallevels->id !!}">
					
				                                {!! $approvallevels->name!!}
				                                </option>
				                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="User Account" class="col-sm-3 control-label">User Account</label>
                                    <div class="col-sm-6">
									    <select class="form-control selectpicker" data-size="100000" data-live-search="true" data-style="btn-white" name="user_account"  id="user_account">
                                            <option value="" >Select User Account</option>				                                @foreach ($purchaseorderapprovalmappingsdata['usersaccounts'] as $usersaccounts)
				                                <option value="{!! $usersaccounts->id !!}">
					
				                                {!! $usersaccounts->name!!}
				                                </option>
				                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-3 col-sm-6">
                                    <div class="col-sm-offset-3 col-sm-6">
                                        <button type="submit" class="btn btn-sm btn-inverse">
                                            <i class="fa fa-btn fa-search"></i> Search Purchase Order Approval Mappings
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