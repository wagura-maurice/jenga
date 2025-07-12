@extends("admin.home")
@section("main_content")
<div id="content" class="content">
    <ol class="breadcrumb pull-right">
        <li><a href="#">Home</a></li>
        <li><a href="#">public</a></li>
        <li><a href="#">Sales Orders</a></li>
        <li class="active">form</li>
    </ol>
    <h1 class="page-header">Sales Orders Update Form <small>sales orders details goes here...</small></h1>
    <div class="row">
        <div class="col-md-12">
            <a href="{!! route('salesorders.index') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-arrow-left"></i></button></a>
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
                    <h4 class="panel-title">DataForm - Autofill</h4>
                </div>
                <div class="panel-body">
                    <form action="{!! route('salesorders.update',$salesordersdata['data']->id) !!}" method="POST" class="form-horizontal">
<input type="hidden" name="_method" value="put" />
                        {!! csrf_field() !!}
                                <div class="form-group">
                                    <label for="Order Date" class="col-sm-3 control-label">Order Date</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="order_date" id="order_date" class="form-control" placeholder="Order Date" value="{!! $salesordersdata['data']->order_date !!}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Order Status" class="col-sm-3 control-label">Order Status</label>
                                    <div class="col-sm-6">
									    <select class="form-control selectpicker" data-size="100000" data-live-search="true" data-style="btn-white" name="order_status" id="order_status">
                                            <option value="" >Select Order Status</option>				                                @foreach ($salesordersdata['orderstatuses'] as $orderstatuses)
				                                @if( $orderstatuses->id  ==  $salesordersdata['data']->order_status  ){
				                                <option selected value="{!! $orderstatuses->id !!}" >
								
				                                {!! $orderstatuses->name!!}
				                                </option>@else
				                                <option value="{!! $orderstatuses->id !!}" >
								
				                                {!! $orderstatuses->name!!}
				                                </option>@endif
				                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Customer Name" class="col-sm-3 control-label">Customer Name</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="customer_name" id="customer_name" class="form-control" placeholder="Customer Name" value="{!! $salesordersdata['data']->customer_name !!}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Customer Phone Number" class="col-sm-3 control-label">Customer Phone Number</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="customer_phone_number" id="customer_phone_number" class="form-control" placeholder="Customer Phone Number" value="{!! $salesordersdata['data']->customer_phone_number !!}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Customer Email Address" class="col-sm-3 control-label">Customer Email Address</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="customer_email_address" id="customer_email_address" class="form-control" placeholder="Customer Email Address" value="{!! $salesordersdata['data']->customer_email_address !!}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Order Number" class="col-sm-3 control-label">Order Number</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="order_number" id="order_number" class="form-control" placeholder="Order Number" value="{!! $salesordersdata['data']->order_number !!}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Due Date" class="col-sm-3 control-label">Due Date</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="due_date" id="due_date" class="form-control" placeholder="Due Date" value="{!! $salesordersdata['data']->due_date !!}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Notes" class="col-sm-3 control-label">Notes</label>
                                    <div class="col-sm-6">
                                        <Textarea name="notes" id="notes" class="form-control" row="20" placeholder="Notes" value="{!! $salesordersdata['data']->notes !!}">{!! $salesordersdata['data']->notes !!}</textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-3 col-sm-6">
                                    <div class="col-sm-offset-3 col-sm-6">
                                        <button type="submit" class="btn btn-sm btn-primary">
                                            <i class="fa fa-btn fa-plus"></i> Edit Sales Orders
                                        </button>
                                    </div>
                                </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script language="javascript" type="text/javascript">
$("#order_date").datepicker({todayHighlight:!0,autoclose:!0});
$("#due_date").datepicker({todayHighlight:!0,autoclose:!0});
</script>
@endsection