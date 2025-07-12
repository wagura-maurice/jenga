@extends("admin.home")
@section("main_content")
<div id="content" class="content">
    <ol class="breadcrumb pull-right">
        <li><a href="#">Home</a></li>
        <li><a href="#">public</a></li>
        <li><a href="#">Purchase Order Lines</a></li>
        <li class="active">form</li>
    </ol>
    <h1 class="page-header">Purchase Order Lines Update Form <small>purchase order lines details goes here...</small></h1>
    <div class="row">
        <div class="col-md-12">
            <a href="{!! route('purchaseorderlines.index') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-arrow-left"></i></button></a>
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
                    <form action="{!! route('purchaseorderlines.update',$purchaseorderlinesdata['data']->id) !!}" method="POST" class="form-horizontal">
<input type="hidden" name="_method" value="put" />
                        {!! csrf_field() !!}
                                <div class="form-group">
                                    <label for="Purchase Order" class="col-sm-3 control-label">Purchase Order</label>
                                    <div class="col-sm-6">
									    <select class="form-control selectpicker" data-size="100000" data-live-search="true" data-style="btn-white" name="purchase_order" id="purchase_order">
                                            <option value="" >Select Purchase Order</option>				                                @foreach ($purchaseorderlinesdata['purchaseorders'] as $purchaseorders)
				                                @if( $purchaseorders->id  ==  $purchaseorderlinesdata['data']->purchase_order  ){
				                                <option selected value="{!! $purchaseorders->id !!}" >
								
				                                {!! $purchaseorders->order_number!!}
				                                </option>@else
				                                <option value="{!! $purchaseorders->id !!}" >
								
				                                {!! $purchaseorders->order_number!!}
				                                </option>@endif
				                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Product" class="col-sm-3 control-label">Product</label>
                                    <div class="col-sm-6">
									    <select class="form-control selectpicker" data-size="100000" data-live-search="true" data-style="btn-white" name="product" id="product">
                                            <option value="" >Select Product</option>				                                @foreach ($purchaseorderlinesdata['products'] as $products)
				                                @if( $products->id  ==  $purchaseorderlinesdata['data']->product  ){
				                                <option selected value="{!! $products->id !!}" >
								
				                                {!! $products->name!!}
				                                </option>@else
				                                <option value="{!! $products->id !!}" >
								
				                                {!! $products->name!!}
				                                </option>@endif
				                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Quantity" class="col-sm-3 control-label">Quantity</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="quantity" id="quantity" class="form-control" placeholder="Quantity" value="{!! $purchaseorderlinesdata['data']->quantity !!}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Unit Price" class="col-sm-3 control-label">Unit Price</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="unit_price" id="unit_price" class="form-control" placeholder="Unit Price" value="{!! $purchaseorderlinesdata['data']->unit_price !!}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Discount" class="col-sm-3 control-label">Discount</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="discount" id="discount" class="form-control" placeholder="Discount" value="{!! $purchaseorderlinesdata['data']->discount !!}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Total Price" class="col-sm-3 control-label">Total Price</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="total_price" id="total_price" class="form-control" placeholder="Total Price" value="{!! $purchaseorderlinesdata['data']->total_price !!}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-3 col-sm-6">
                                    <div class="col-sm-offset-3 col-sm-6">
                                        <button type="submit" class="btn btn-sm btn-primary">
                                            <i class="fa fa-btn fa-plus"></i> Edit Purchase Order Lines
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
</script>
@endsection