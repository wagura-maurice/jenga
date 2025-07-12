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
        <li><a href="#">Purchase Orders</a></li>
        <li class="active">Table</li>
    </ol>
    <h1 class="page-header">Purchase Orders - DATA <small>purchase orders data goes here...</small></h1>
    <div class="row">
        <div class="col-md-12">
            @if($purchaseordersdata['usersaccountsroles'][0]->_add==1)
            <a href="{!! route('purchaseorders.create') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-plus"></i></button></a>
            @endif
            @if($purchaseordersdata['usersaccountsroles'][0]->_report==1)
            <a href="{!! url('admin/purchaseordersreport') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-file-text-o"></i></button></a>
            @endif
            @if($purchaseordersdata['usersaccountsroles'][0]->_report==1 || $purchaseordersdata['usersaccountsroles'][0]->_list==1)
            <a href="#modal-dialog"  data-toggle="modal"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-filter"></i></button></a>
            @endif
        </div>
    </div>
    @if($purchaseordersdata['usersaccountsroles'][0]->_list==1)
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
                                        <th>Order Number</th>
                                        <th>Supplier</th>
                                        <th>Store</th>
                                        <th>Order Date</th>
                                        <th>Due Date</th>
                                        <th>Notes</th>
                                        <th>Order Status</th>
                                        <th>Approval Status</th>
                                        <th>Action</th>
                                    </tr>
                        </thead>
                        <tbody>
                        @foreach ($purchaseordersdata['list'] as $purchaseorders)
                            <tr>
                                <td class='table-text'><div>
                                	{!! $purchaseorders->order_number !!}
                                </div></td>
                                <td class='table-text'><div>
                                	{!! $purchaseorders->suppliermodel->name !!}
                                </div></td>
                                <td class='table-text'><div>
                                    {!! $purchaseorders->storemodel->number !!} - {!! $purchaseorders->storemodel->name !!}
                                </div></td>                                
                                <td class='table-text'><div>
                                	{!! $purchaseorders->order_date !!}
                                </div></td>
                                <td class='table-text'><div>
                                	{!! $purchaseorders->due_date !!}
                                </div></td>
                                <td class='table-text'><div>
                                	{!! $purchaseorders->notes !!}
                                </div></td>
                                <td class='table-text'><div>
                                    {!! $purchaseorders->orderstatusmodel->name !!}
                                </div></td>  
                                <td class='table-text'><div>
                                    {!! $purchaseorders->approvalstatusmodel->name !!}
                                </div></td>                                                                
                                <td>
                                    @if($purchaseordersdata['usersaccountsroles'][0]->_show==1)
                                    <a href="{!! route('purchaseorders.show',$purchaseorders->id) !!}" id='preview-purchaseorders-{!! $purchaseorders->id !!}' class='btn btn-xs btn-primary m-b-2 m-l-2'>
                                        Preview
                                    </a>                                    
                                    @endif
                                    @if($purchaseordersdata['usersaccountsroles'][0]->_show==1)
                                    <a href="{!! url('/admin/getpurchaseorderlines') !!}/{!!$purchaseorders->id!!}" target="_blank" id='orderlines-purchaseorders-{!! $purchaseorders->id !!}' class='btn btn-xs btn-primary m-b-2 m-l-2'>
                                        Order lines
                                    </a>
                                    @endif                    
                                    @if($purchaseordersdata['usersaccountsroles'][0]->_show==1 && $purchaseorders->approvalstatusmodel->code=="001")
                                    <a href="{!! url('/admin/getpurchaseorderpayments') !!}/{!! $purchaseorders->id!!}" target="_blank" id='payments-purchaseorders-{!! $purchaseorders->id !!}' class='btn btn-xs btn-primary m-b-2 m-l-2'>
                                        Payments
                                    </a>
                                    @else
                                    <a href="#" id='payments-purchaseorders-{!! $purchaseorders->id !!}' class='btn btn-xs btn-default m-b-2 m-l-2'>
                                        Payments
                                    </a>                                    
                                    @endif
                                    @if($purchaseordersdata['usersaccountsroles'][0]->_edit==1 &&  $purchaseorders->approvalstatusmodel->code=="003")
                                    <a href="{!! url('/admin/approvepurchaseorder') !!}/{!! $purchaseorders->id!!}" target="_blank" id='approve-purchaseorders-{!! $purchaseorders->id !!}' class='btn btn-xs btn-primary m-b-2 m-l-2'>
                                        Approve
                                    </a>
                                    @else
                                    <a href="#" id='approve-purchaseorders-{!! $purchaseorders->id !!}' class='btn btn-xs btn-default m-b-2 m-l-2'>
                                        Approve
                                    </a>                                    
                                    @endif                                    

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
                <h4 class="modal-title">Purchase Orders - Filter Dialog</h4>
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
                    <form id="form"  class="form-horizontal" action="{!! url('admin/purchaseordersfilter') !!}" method="POST">
                        {!! csrf_field() !!}
                                <div class="form-group">
                                    <label for="Order Number" class="col-sm-3 control-label">Order Number</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="order_number"  id="order_number" class="form-control" placeholder="Order Number" value="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Supplier" class="col-sm-3 control-label">Supplier</label>
                                    <div class="col-sm-6">
									    <select class="form-control selectpicker" data-size="100000" data-live-search="true" data-style="btn-white" name="supplier"  id="supplier">
                                            <option value="" >Select Supplier</option>				                                @foreach ($purchaseordersdata['suppliers'] as $suppliers)
				                                <option value="{!! $suppliers->id !!}">
					
				                                {!! $suppliers->name!!}
				                                </option>
				                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Order Date" class="col-sm-3 control-label">Order Date</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="order_datefrom" id="order_datefrom" class="form-control m-b-5" placeholder="Order Date From" value="">
                                        <input type="text" name="order_dateto" id="order_dateto" class="form-control" placeholder="Order Date To" value="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Due Date" class="col-sm-3 control-label">Due Date</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="due_datefrom" id="due_datefrom" class="form-control m-b-5" placeholder="Due Date From" value="">
                                        <input type="text" name="due_dateto" id="due_dateto" class="form-control" placeholder="Due Date To" value="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Notes" class="col-sm-3 control-label">Notes</label>
                                    <div class="col-sm-6">
                                        <Textarea name="notes" id="notes"  class="form-control" row="5" placeholder="Notes" value=""></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-3 col-sm-6">
                                    <div class="col-sm-offset-3 col-sm-6">
                                        <button type="submit" class="btn btn-sm btn-inverse">
                                            <i class="fa fa-btn fa-search"></i> Search Purchase Orders
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
$("#order_datefrom").datepicker({todayHighlight:!0,autoclose:!0});
$("#order_dateto").datepicker({todayHighlight:!0,autoclose:!0});
</script>
<script language="javascript" type="text/javascript">
$("#due_datefrom").datepicker({todayHighlight:!0,autoclose:!0});
$("#due_dateto").datepicker({todayHighlight:!0,autoclose:!0});
</script>
@endsection