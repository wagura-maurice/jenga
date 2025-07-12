@extends("admin.home")
@section("main_content")
<div id="content" class="content">
    <ol class="breadcrumb pull-right">
        <li><a href="#">Home</a></li>
        <li><a href="#">public</a></li>
        <li><a href="#">Products</a></li>
        <li class="active">form</li>
    </ol>
    <h1 class="page-header">Products Update Form <small>products details goes here...</small></h1>
    <div class="row">
        <div class="col-md-12">
            <a href="{!! route('products.index') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-arrow-left"></i></button></a>
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
                    <form action="{!! route('products.update',$productsdata['data']->id) !!}" method="POST" class="form-horizontal">
<input type="hidden" name="_method" value="put" />
                        {!! csrf_field() !!}
                                <div class="form-group">
                                    <label for="Product Number" class="col-sm-3 control-label">Product Number</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="product_number" id="product_number" class="form-control" placeholder="Product Number" value="{!! $productsdata['data']->product_number !!}">
                                    </div>
                                </div>                        
                                <div class="form-group">
                                    <label for="Name" class="col-sm-3 control-label">Name</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="name" id="name" class="form-control" placeholder="Name" value="{!! $productsdata['data']->name !!}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Category" class="col-sm-3 control-label">Category</label>
                                    <div class="col-sm-6">
									    <select class="form-control selectpicker" data-size="100000" data-live-search="true" data-style="btn-white" name="category" id="category">
                                            <option value="" >Select Category</option>				                                @foreach ($productsdata['productcategories'] as $productcategories)
				                                @if( $productcategories->id  ==  $productsdata['data']->category  ){
				                                <option selected value="{!! $productcategories->id !!}" >
								
				                                {!! $productcategories->name!!}
				                                </option>@else
				                                <option value="{!! $productcategories->id !!}" >
								
				                                {!! $productcategories->name!!}
				                                </option>@endif
				                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Brand" class="col-sm-3 control-label">Brand</label>
                                    <div class="col-sm-6">
									    <select class="form-control selectpicker" data-size="100000" data-live-search="true" data-style="btn-white" name="brand" id="brand">
                                            <option value="" >Select Brand</option>				                                @foreach ($productsdata['productbrands'] as $productbrands)
				                                @if( $productbrands->id  ==  $productsdata['data']->brand  ){
				                                <option selected value="{!! $productbrands->id !!}" >
								
				                                {!! $productbrands->name!!}
				                                </option>@else
				                                <option value="{!! $productbrands->id !!}" >
								
				                                {!! $productbrands->name!!}
				                                </option>@endif
				                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Description" class="col-sm-3 control-label">Description</label>
                                    <div class="col-sm-6">
                                        <Textarea name="description" id="description" class="form-control" row="20" placeholder="Description" value="{!! $productsdata['data']->description !!}">{!! $productsdata['data']->description !!}</textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Buying Price" class="col-sm-3 control-label">Buying Price</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="buying_price"  id="buying_price" class="form-control" placeholder="Buying Price" value="{!! $productsdata['data']->buying_price !!}">
                                    </div>
                                </div>    
                                <div class="form-group">
                                    <label for="Selling Price" class="col-sm-3 control-label">Selling Price</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="selling_price"  id="selling_price" class="form-control" placeholder="Price" value="{!! $productsdata['data']->selling_price !!}">
                                    </div>
                                </div>  
                                <div class="form-group">
                                    <label for="Margin" class="col-sm-3 control-label">Margin</label>
                                    <div class="col-sm-6">
                                        <input type="text"  readonly id="_margin" class="form-control" placeholder="margin" value="{!! $productsdata['data']->margin !!}">
                                        <input type="hidden" name="margin" required  id="margin" class="form-control" placeholder="margin" value="{!! $productsdata['data']->margin !!}">
                                    </div>
                                </div>                                                            
                                <div class="form-group">
                                    <label for="Reorder Level" class="col-sm-3 control-label">Reorder Level</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="reorder_level" id="reorder_level" class="form-control" placeholder="Reorder Level" value="{!! $productsdata['data']->reorder_level !!}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Reorder Quantity" class="col-sm-3 control-label">Reorder Quantity</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="reorder_quantity" id="reorder_quantity" class="form-control" placeholder="Reorder Quantity" value="{!! $productsdata['data']->reorder_quantity !!}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Other Details" class="col-sm-3 control-label">Other Details</label>
                                    <div class="col-sm-6">
                                        <Textarea name="other_details" id="other_details" class="form-control" row="20" placeholder="Other Details" value="{!! $productsdata['data']->other_details !!}">{!! $productsdata['data']->other_details !!}</textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-3 col-sm-6">
                                    <div class="col-sm-offset-3 col-sm-6">
                                        <button type="submit" class="btn btn-sm btn-primary">
                                            <i class="fa fa-btn fa-plus"></i> Edit Products
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