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
        <li><a href="#">Purchase Order Lines</a></li>
        <li class="active">Table</li>
    </ol>
    <h1 class="page-header">Purchase Order Lines - DATA <small>purchase order lines data goes here...</small></h1>
    @if($purchaseorderlinesdata['usersaccountsroles'][0]->_list==1)
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
                                        <th>Product</th>
                                        <th>Quantity</th>
                                        <th>Unit Price</th>
                                        <th>Discount</th>
                                        <th>Total Price</th>
                                        <th>Action</th>                                    </tr>
                        </thead>
                        <tbody>
                        @foreach ($purchaseorderlinesdata['list'] as $purchaseorderlines)
                            <tr>
                                <td class='table-text'><div>
                                	{!! $purchaseorderlines->purchaseordermodel->order_number !!}
                                </div></td>
                                <td class='table-text'><div>
                                	{!! $purchaseorderlines->productmodel->name !!}
                                </div></td>
                                <td class='table-text'><div>
                                	{!! $purchaseorderlines->quantity !!}
                                </div></td>
                                <td class='table-text'><div>
                                	{!! $purchaseorderlines->unit_price !!}
                                </div></td>
                                <td class='table-text'><div>
                                	{!! $purchaseorderlines->discount !!}
                                </div></td>
                                <td class='table-text'><div>
                                	{!! $purchaseorderlines->total_price !!}
                                </div></td>
                                <td>
                <form action="{!! route('purchaseorderlines.destroy',$purchaseorderlines->id) !!}" method="POST">
                                        @if($purchaseorderlinesdata['usersaccountsroles'][0]->_show==1)
                                        <a href="{!! route('purchaseorderlines.show',$purchaseorderlines->id) !!}" id='show-purchaseorderlines-{!! $purchaseorderlines->id !!}' class='btn btn-sm btn-circle btn-inverse'>
                                            <i class='fa fa-btn fa-eye'></i>
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
                <h4 class="modal-title">Purchase Order Lines - Filter Dialog</h4>
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
                    <form id="form"  class="form-horizontal" action="{!! url('admin/purchaseorderlinesfilter') !!}" method="POST">
                        {!! csrf_field() !!}
                                <div class="form-group">
                                    <label for="Purchase Order" class="col-sm-3 control-label">Purchase Order</label>
                                    <div class="col-sm-6">
									    <select class="form-control selectpicker" data-size="100000" data-live-search="true" data-style="btn-white" name="purchase_order"  id="purchase_order">
                                            <option value="" >Select Purchase Order</option>				                                @foreach ($purchaseorderlinesdata['purchaseorders'] as $purchaseorders)
				                                <option value="{!! $purchaseorders->id !!}">
					
				                                {!! $purchaseorders->order_number!!}
				                                </option>
				                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Product" class="col-sm-3 control-label">Product</label>
                                    <div class="col-sm-6">
									    <select class="form-control selectpicker" data-size="100000" data-live-search="true" data-style="btn-white" name="product"  id="product">
                                            <option value="" >Select Product</option>				                                @foreach ($purchaseorderlinesdata['products'] as $products)
				                                <option value="{!! $products->id !!}">
					
				                                {!! $products->name!!}
				                                </option>
				                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Quantity" class="col-sm-3 control-label">Quantity</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="quantity"  id="quantity" class="form-control" placeholder="Quantity" value="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Unit Price" class="col-sm-3 control-label">Unit Price</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="unit_price"  id="unit_price" class="form-control" placeholder="Unit Price" value="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Discount" class="col-sm-3 control-label">Discount</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="discount"  id="discount" class="form-control" placeholder="Discount" value="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Total Price" class="col-sm-3 control-label">Total Price</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="total_price"  id="total_price" class="form-control" placeholder="Total Price" value="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-3 col-sm-6">
                                    <div class="col-sm-offset-3 col-sm-6">
                                        <button type="submit" class="btn btn-sm btn-inverse">
                                            <i class="fa fa-btn fa-search"></i> Search Purchase Order Lines
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