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
        <li><a href="#">Sales Orders</a></li>
        <li class="active">Table</li>
    </ol>
    <h1 class="page-header">Sales Orders - DATA <small>sales orders data goes here...</small></h1>
    <div class="row">
        <div class="col-md-12">
            @if($salesordersdata['usersaccountsroles'][0]->_add==1)
            <a href="{!! route('salesorders.create') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-plus"></i></button></a>
            @endif
            @if($salesordersdata['usersaccountsroles'][0]->_report==1)
            <a href="{!! url('admin/salesordersreport') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-file-text-o"></i></button></a>
            @endif
            @if($salesordersdata['usersaccountsroles'][0]->_report==1 || $salesordersdata['usersaccountsroles'][0]->_list==1)
            <a href="#modal-dialog"  data-toggle="modal"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-filter"></i></button></a>
            @endif
        </div>
    </div>
    @if($salesordersdata['usersaccountsroles'][0]->_list==1)
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
                                        <th>Order Date</th>
                                        <th>Store</th>
                                        <th>Order Status</th>
                                        <th>Customer Name</th>
                                        <th>Customer Phone Number</th>
                                        <th>Customer Email Address</th>
                                        <th>Order Number</th>
                                        <th>Due Date</th>
                                        <th>Notes</th>
                                        <th>Action</th>                                    </tr>
                        </thead>
                        <tbody>
                        @foreach ($salesordersdata['list'] as $salesorders)
                            <tr>
                                <td class='table-text'><div>
                                	{!! $salesorders->order_date !!}
                                </div></td>
                                <td class='table-text'><div>
                                    {!! $salesorders->storemodel->number !!} - 
                                    {!! $salesorders->storemodel->name !!}
                                </div></td>                                
                                <td class='table-text'><div>
                                	{!! $salesorders->orderstatusmodel->name !!}
                                </div></td>
                                <td class='table-text'><div>
                                	{!! $salesorders->customer_name !!}
                                </div></td>
                                <td class='table-text'><div>
                                	{!! $salesorders->customer_phone_number !!}
                                </div></td>
                                <td class='table-text'><div>
                                	{!! $salesorders->customer_email_address !!}
                                </div></td>
                                <td class='table-text'><div>
                                	{!! $salesorders->order_number !!}
                                </div></td>
                                <td class='table-text'><div>
                                	{!! $salesorders->due_date !!}
                                </div></td>
                                <td class='table-text'><div>
                                	{!! $salesorders->notes !!}
                                </div></td>
                                <td>
                                    @if($salesordersdata['usersaccountsroles'][0]->_show==1)
                                    <a href="{!! route('salesorders.show',$salesorders->id) !!}" id='show-salesorders-{!! $salesorders->id !!}' class='btn btn-xs btn-primary m-b-2 m-l-2'>
                                        Preview
                                    </a>                                    
                                    @endif
                                    @if($salesordersdata['usersaccountsroles'][0]->_show==1)
                                    <a href="{!! url('/admin/getsalesorderlines') !!}/{!!$salesorders->id!!}" target="_blank" id='show-salesorders-{!! $salesorders->id !!}' class='btn btn-xs btn-primary m-b-2 m-l-2'>
                                        Order lines
                                    </a>
                                    @endif                    
                                    @if($salesordersdata['usersaccountsroles'][0]->_show==1)
                                    <a href="{!! url('/admin/getsalesorderpayments') !!}/{!! $salesorders->id!!}" target="_blank" id='show-salesorders-{!! $salesorders->id !!}' class='btn btn-xs btn-primary m-b-2 m-l-2'>
                                        Payments
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
                <h4 class="modal-title">Sales Orders - Filter Dialog</h4>
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
                    <form id="form"  class="form-horizontal" action="{!! url('admin/salesordersfilter') !!}" method="POST">
                        {!! csrf_field() !!}
                                <div class="form-group">
                                    <label for="Order Date" class="col-sm-3 control-label">Order Date</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="order_datefrom" id="order_datefrom" class="form-control m-b-5" placeholder="Order Date From" value="">
                                        <input type="text" name="order_dateto" id="order_dateto" class="form-control" placeholder="Order Date To" value="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Order Status" class="col-sm-3 control-label">Order Status</label>
                                    <div class="col-sm-6">
									    <select class="form-control selectpicker" data-size="100000" data-live-search="true" data-style="btn-white" name="order_status"  id="order_status">
                                            <option value="" >Select Order Status</option>				                                @foreach ($salesordersdata['orderstatuses'] as $orderstatuses)
				                                <option value="{!! $orderstatuses->id !!}">
					
				                                {!! $orderstatuses->name!!}
				                                </option>
				                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Customer Name" class="col-sm-3 control-label">Customer Name</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="customer_name"  id="customer_name" class="form-control" placeholder="Customer Name" value="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Customer Phone Number" class="col-sm-3 control-label">Customer Phone Number</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="customer_phone_number"  id="customer_phone_number" class="form-control" placeholder="Customer Phone Number" value="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Customer Email Address" class="col-sm-3 control-label">Customer Email Address</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="customer_email_address"  id="customer_email_address" class="form-control" placeholder="Customer Email Address" value="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Order Number" class="col-sm-3 control-label">Order Number</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="order_number"  id="order_number" class="form-control" placeholder="Order Number" value="">
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
                                            <i class="fa fa-btn fa-search"></i> Search Sales Orders
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