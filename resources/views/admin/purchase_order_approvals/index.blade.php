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
        <li><a href="#">Purchase Order Approvals</a></li>
        <li class="active">Table</li>
    </ol>
    <h1 class="page-header">Purchase Order Approvals - DATA <small>purchase order approvals data goes here...</small></h1>
    @if($purchaseorderapprovalsdata['usersaccountsroles'][0]->_list==1)
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
                                        <th>Purchase Order</th>
                                        <th>Approval Level</th>
                                        <th>User</th>
                                        <th>Approval Status</th>
                                        <th>Action</th>                                    </tr>
                        </thead>
                        <tbody>
                        @foreach ($purchaseorderapprovalsdata['list'] as $purchaseorderapprovals)
                            <tr>
                                <td class='table-text'><div>
                                	{!! $purchaseorderapprovals->purchaseordermodel->order_number !!}
                                </div></td>
                                <td class='table-text'><div>
                                	{!! $purchaseorderapprovals->approval_level !!}
                                </div></td>
                                <td class='table-text'><div>
                                	{!! $purchaseorderapprovals->user !!}
                                </div></td>
                                <td class='table-text'><div>
                                	{!! $purchaseorderapprovals->approvalstatusmodel->name !!}
                                </div></td>
                                <td>
                <form action="{!! route('purchaseorderapprovals.destroy',$purchaseorderapprovals->id) !!}" method="POST">
                                        @if($purchaseorderapprovalsdata['usersaccountsroles'][0]->_show==1)
                                        <a href="{!! route('purchaseorderapprovals.show',$purchaseorderapprovals->id) !!}" id='show-purchaseorderapprovals-{!! $purchaseorderapprovals->id !!}' class='btn btn-sm btn-circle btn-inverse'>
                                            <i class='fa fa-btn fa-eye'></i>
                                        </a>
                                        @endif
                                        @if($purchaseorderapprovalsdata['usersaccountsroles'][0]->_edit==1)
                                        <a href="{!! route('purchaseorderapprovals.edit',$purchaseorderapprovals->id) !!}" id='edit-purchaseorderapprovals-{!! $purchaseorderapprovals->id !!}' class='btn btn-sm btn-circle btn-warning'>
                                            <i class='fa fa-btn fa-edit'></i>
                                        </a>
                                        @endif
                                        @if($purchaseorderapprovalsdata['usersaccountsroles'][0]->_delete==1)
                                        <input type="hidden" name="_method" value="delete" />
                                        {!! csrf_field() !!}
                                        {!! method_field('DELETE') !!}
                                        <button type='submit' id='delete-purchaseorderapprovals-{!! $purchaseorderapprovals->id !!}' class='btn btn-sm btn-circle btn-danger'>
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
                <h4 class="modal-title">Purchase Order Approvals - Filter Dialog</h4>
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
                    <form id="form"  class="form-horizontal" action="{!! url('admin/purchaseorderapprovalsfilter') !!}" method="POST">
                        {!! csrf_field() !!}
                                <div class="form-group">
                                    <label for="Purchase Order" class="col-sm-3 control-label">Purchase Order</label>
                                    <div class="col-sm-6">
									    <select class="form-control selectpicker" data-size="100000" data-live-search="true" data-style="btn-white" name="purchase_order"  id="purchase_order">
                                            <option value="" >Select Purchase Order</option>				                                @foreach ($purchaseorderapprovalsdata['purchaseorders'] as $purchaseorders)
				                                <option value="{!! $purchaseorders->id !!}">
					
				                                {!! $purchaseorders->order_number!!}
				                                </option>
				                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Approval Level" class="col-sm-3 control-label">Approval Level</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="approval_level"  id="approval_level" class="form-control" placeholder="Approval Level" value="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="User" class="col-sm-3 control-label">User</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="user"  id="user" class="form-control" placeholder="User" value="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Approval Status" class="col-sm-3 control-label">Approval Status</label>
                                    <div class="col-sm-6">
									    <select class="form-control selectpicker" data-size="100000" data-live-search="true" data-style="btn-white" name="approval_status"  id="approval_status">
                                            <option value="" >Select Approval Status</option>				                                @foreach ($purchaseorderapprovalsdata['approvalstatuses'] as $approvalstatuses)
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
                                            <i class="fa fa-btn fa-search"></i> Search Purchase Order Approvals
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