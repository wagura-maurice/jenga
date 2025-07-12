@extends("admin.home")
@section("main_content")
<div id="content" class="content">
    <ol class="breadcrumb pull-right">
        <li><a href="#">Home</a></li>
        <li><a href="#">public</a></li>
        <li><a href="#">Purchase Orders</a></li>
        <li class="active">form</li>
    </ol>
    <h1 class="page-header">Purchase Orders Update Form <small>purchase orders details goes here...</small></h1>
    <div class="row">
        <div class="col-md-12">
            <a href="{!! route('purchaseorders.index') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-arrow-left"></i></button></a>
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
                    <form action="{!! route('purchaseorders.update',$purchaseordersdata['data']->id) !!}" method="POST" class="form-horizontal">
<input type="hidden" name="_method" value="put" />
                        {!! csrf_field() !!}
                                <div class="form-group">
                                    <label for="Order Number" class="col-sm-3 control-label">Order Number</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="order_number" id="order_number" class="form-control" placeholder="Order Number" value="{!! $purchaseordersdata['data']->order_number !!}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Supplier" class="col-sm-3 control-label">Supplier</label>
                                    <div class="col-sm-6">
									    <select class="form-control selectpicker" data-size="100000" data-live-search="true" data-style="btn-white" name="supplier" id="supplier">
                                            <option value="" >Select Supplier</option>				                                @foreach ($purchaseordersdata['suppliers'] as $suppliers)
				                                @if( $suppliers->id  ==  $purchaseordersdata['data']->supplier  ){
				                                <option selected value="{!! $suppliers->id !!}" >
								
				                                {!! $suppliers->name!!}
				                                </option>@else
				                                <option value="{!! $suppliers->id !!}" >
								
				                                {!! $suppliers->name!!}
				                                </option>@endif
				                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Order Date" class="col-sm-3 control-label">Order Date</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="order_date" id="order_date" class="form-control" placeholder="Order Date" value="{!! $purchaseordersdata['data']->order_date !!}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Due Date" class="col-sm-3 control-label">Due Date</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="due_date" id="due_date" class="form-control" placeholder="Due Date" value="{!! $purchaseordersdata['data']->due_date !!}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Notes" class="col-sm-3 control-label">Notes</label>
                                    <div class="col-sm-6">
                                        <Textarea name="notes" id="notes" class="form-control" row="20" placeholder="Notes" value="{!! $purchaseordersdata['data']->notes !!}">{!! $purchaseordersdata['data']->notes !!}</textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-3 col-sm-6">
                                    <div class="col-sm-offset-3 col-sm-6">
                                        <button type="submit" class="btn btn-sm btn-primary">
                                            <i class="fa fa-btn fa-plus"></i> Edit Purchase Orders
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