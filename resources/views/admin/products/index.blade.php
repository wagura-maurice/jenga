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
        <li><a href="#">Products</a></li>
        <li class="active">Table</li>
    </ol>
    <h1 class="page-header">Products - DATA <small>products data goes here...</small></h1>
    <div class="row">
        <div class="col-md-12">
            @if($productsdata['usersaccountsroles'][0]->_add==1)
            <a href="{!! route('products.create') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-plus"></i></button></a>
            @endif
            @if($productsdata['usersaccountsroles'][0]->_report==1)
            <a href="{!! url('admin/productsreport') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-file-text-o"></i></button></a>
            @endif
            @if($productsdata['usersaccountsroles'][0]->_report==1 || $productsdata['usersaccountsroles'][0]->_list==1)
            <a href="#modal-dialog"  data-toggle="modal"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-filter"></i></button></a>
            @endif
        </div>
    </div>
    @if($productsdata['usersaccountsroles'][0]->_list==1)
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
                                        <th>Name</th>
                                        <th>Category</th>
                                        <th>Brand</th>
                                        <th>Description</th>
                                        <th>Reorder Level</th>
                                        <th>Buying Price</th>
                                        <th>Selling Price</th>
                                        <th>Action</th>                                    </tr>
                        </thead>
                        <tbody>
                        @foreach ($productsdata['list'] as $products)
                            <tr>
                                <td class='table-text'><div>
                                	{!! $products->name !!}
                                </div></td>
                                <td class='table-text'><div>
                                	{!! $products->categorymodel->name !!}
                                </div></td>
                                <td class='table-text'><div>
                                	{!! $products->brandmodel->name !!}
                                </div></td>
                                <td class='table-text'><div>
                                	{!! $products->description !!}
                                </div></td>
                                <td class='table-text'><div>
                                	{!! $products->reorder_level !!}
                                </div></td>
                                <td class='table-text'><div>
                                	{!! $products->buying_price !!}
                                </div></td>
                                <td class='table-text'><div>
                                	{!! $products->selling_price !!}
                                </div></td>
                                <td>
                <form action="{!! route('products.destroy',$products->id) !!}" method="POST">
                                        @if($productsdata['usersaccountsroles'][0]->_show==1)
                                        <a href="{!! route('products.show',$products->id) !!}" id='show-products-{!! $products->id !!}' class='btn btn-sm btn-circle btn-inverse'>
                                            <i class='fa fa-btn fa-eye'></i>
                                        </a>
                                        @endif
                                        @if($productsdata['usersaccountsroles'][0]->_edit==1)
                                        <a href="{!! route('products.edit',$products->id) !!}" id='edit-products-{!! $products->id !!}' class='btn btn-sm btn-circle btn-warning'>
                                            <i class='fa fa-btn fa-edit'></i>
                                        </a>
                                        @endif
                                        @if($productsdata['usersaccountsroles'][0]->_delete==1)
                                        <input type="hidden" name="_method" value="delete" />
                                        {!! csrf_field() !!}
                                        {!! method_field('DELETE') !!}
                                        <button type='submit' id='delete-products-{!! $products->id !!}' class='btn btn-sm btn-circle btn-danger'>
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
                <h4 class="modal-title">Products - Filter Dialog</h4>
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
                    <form id="form"  class="form-horizontal" action="{!! url('admin/productsfilter') !!}" method="POST">
                        {!! csrf_field() !!}
                                <div class="form-group">
                                    <label for="Name" class="col-sm-3 control-label">Name</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="name"  id="name" class="form-control" placeholder="Name" value="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Category" class="col-sm-3 control-label">Category</label>
                                    <div class="col-sm-6">
									    <select class="form-control selectpicker" data-size="100000" data-live-search="true" data-style="btn-white" name="category"  id="category">
                                            <option value="" >Select Category</option>				                                @foreach ($productsdata['productcategories'] as $productcategories)
				                                <option value="{!! $productcategories->id !!}">
					
				                                {!! $productcategories->name!!}
				                                </option>
				                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Brand" class="col-sm-3 control-label">Brand</label>
                                    <div class="col-sm-6">
									    <select class="form-control selectpicker" data-size="100000" data-live-search="true" data-style="btn-white" name="brand"  id="brand">
                                            <option value="" >Select Brand</option>				                                @foreach ($productsdata['productbrands'] as $productbrands)
				                                <option value="{!! $productbrands->id !!}">
					
				                                {!! $productbrands->name!!}
				                                </option>
				                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Description" class="col-sm-3 control-label">Description</label>
                                    <div class="col-sm-6">
                                        <Textarea name="description" id="description"  class="form-control" row="5" placeholder="Description" value=""></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Reorder Level" class="col-sm-3 control-label">Reorder Level</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="reorder_level"  id="reorder_level" class="form-control" placeholder="Reorder Level" value="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Reorder Quantity" class="col-sm-3 control-label">Reorder Quantity</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="reorder_quantity"  id="reorder_quantity" class="form-control" placeholder="Reorder Quantity" value="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Other Details" class="col-sm-3 control-label">Other Details</label>
                                    <div class="col-sm-6">
                                        <Textarea name="other_details" id="other_details"  class="form-control" row="5" placeholder="Other Details" value=""></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-3 col-sm-6">
                                    <div class="col-sm-offset-3 col-sm-6">
                                        <button type="submit" class="btn btn-sm btn-inverse">
                                            <i class="fa fa-btn fa-search"></i> Search Products
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