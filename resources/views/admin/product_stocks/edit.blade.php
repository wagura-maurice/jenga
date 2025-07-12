@extends("admin.home")
@section("main_content")
<div id="content" class="content">
    <ol class="breadcrumb pull-right">
        <li><a href="#">Home</a></li>
        <li><a href="#">public</a></li>
        <li><a href="#">Product Stocks</a></li>
        <li class="active">form</li>
    </ol>
    <h1 class="page-header">Product Stocks Update Form <small>product stocks details goes here...</small></h1>
    <div class="row">
        <div class="col-md-12">
            <a href="{!! route('productstocks.index') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-arrow-left"></i></button></a>
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
                    <form action="{!! route('productstocks.update',$productstocksdata['data']->id) !!}" method="POST" class="form-horizontal">
<input type="hidden" name="_method" value="put" />
                        {!! csrf_field() !!}
                                <div class="form-group">
                                    <label for="Product" class="col-sm-3 control-label">Product</label>
                                    <div class="col-sm-6">
									    <select class="form-control selectpicker" data-size="100000" data-live-search="true" data-style="btn-white" name="product" id="product">
                                            <option value="" >Select Product</option>				                                @foreach ($productstocksdata['products'] as $products)
				                                @if( $products->id  ==  $productstocksdata['data']->product  ){
				                                <option selected value="{!! $products->id !!}" >
								
				                                {!! $products->product_number!!}
				                                {!! $products->name!!}
				                                </option>@else
				                                <option value="{!! $products->id !!}" >
								
				                                {!! $products->product_number!!}
				                                {!! $products->name!!}
				                                </option>@endif
				                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Store" class="col-sm-3 control-label">Store</label>
                                    <div class="col-sm-6">
									    <select class="form-control selectpicker" data-size="100000" data-live-search="true" data-style="btn-white" name="store" id="store">
                                            <option value="" >Select Store</option>				                                @foreach ($productstocksdata['stores'] as $stores)
				                                @if( $stores->id  ==  $productstocksdata['data']->store  ){
				                                <option selected value="{!! $stores->id !!}" >
								
				                                {!! $stores->number!!}
				                                {!! $stores->name!!}
				                                </option>@else
				                                <option value="{!! $stores->id !!}" >
								
				                                {!! $stores->number!!}
				                                {!! $stores->name!!}
				                                </option>@endif
				                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Size" class="col-sm-3 control-label">Size</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="size" id="size" class="form-control" placeholder="Size" value="{!! $productstocksdata['data']->size !!}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-3 col-sm-6">
                                    <div class="col-sm-offset-3 col-sm-6">
                                        <button type="submit" class="btn btn-sm btn-primary">
                                            <i class="fa fa-btn fa-plus"></i> Edit Product Stocks
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