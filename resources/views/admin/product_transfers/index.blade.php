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
        <li><a href="#">Product Transfers</a></li>
        <li class="active">Table</li>
    </ol>
    <h1 class="page-header">Product Transfers - DATA <small>product transfers data goes here...</small></h1>
    <div class="row">
        <div class="col-md-12">
            @if($producttransfersdata['usersaccountsroles'][0]->_add==1)
            <a href="{!! route('producttransfers.create') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-plus"></i></button></a>
            @endif
            @if($producttransfersdata['usersaccountsroles'][0]->_report==1)
            <a href="{!! url('admin/producttransfersreport') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-file-text-o"></i></button></a>
            @endif
            @if($producttransfersdata['usersaccountsroles'][0]->_report==1 || $producttransfersdata['usersaccountsroles'][0]->_list==1)
            <a href="#modal-dialog"  data-toggle="modal"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-filter"></i></button></a>
            @endif
        </div>
    </div>
    @if($producttransfersdata['usersaccountsroles'][0]->_list==1)
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
                                        <th>Product</th>
                                        <th>Store From</th>
                                        <th>Store To</th>
                                        <th>Size</th>
                                        <th>Status</th>
                                        <th>Receiver</th>
                                        <th>Action</th>                                    </tr>
                        </thead>
                        <tbody>
                        @foreach ($producttransfersdata['list'] as $producttransfers)
                            <tr>
                                <td class='table-text'><div>
                                	{!! $producttransfers->productmodel->product_number !!}
                                	{!! $producttransfers->productmodel->name !!}
                                </div></td>
                                <td class='table-text'><div>
                                	{!! $producttransfers->storefrommodel->number !!}
                                	{!! $producttransfers->storefrommodel->name !!}
                                </div></td>
                                <td class='table-text'><div>
                                	{!! $producttransfers->storetomodel->number !!}
                                	{!! $producttransfers->storetomodel->name !!}
                                </div></td>
                                <td class='table-text'><div>
                                	{!! $producttransfers->size !!}
                                </div></td>
                                <td class='table-text'><div>
                                    @if($producttransfers->producttransferstatusmodel->code=="001")
                                    <span class="label label-warning">{!! $producttransfers->producttransferstatusmodel->name !!}</span>
                                    @elseif($producttransfers->producttransferstatusmodel->code=="002")
                                    <span class="label label-success">{!! $producttransfers->producttransferstatusmodel->name !!}</span>
                                    @else
                                    <span class="label label-danger">{!! $producttransfers->producttransferstatusmodel->name !!}</span>
                                    @endif
                                </div></td>
                                <td class='table-text'><div>
                                    {!! $producttransfers->storetomodel->staffmodel->name !!}
                                </div></td>
                                <td>

                                        @if($producttransfersdata['usersaccountsroles'][0]->_edit==1 && $producttransfers->producttransferstatusmodel->code=="001" && $producttransfers->storetomodel->staffmodel->name==Auth::user()->name)
                                        <a href="{!! route('producttransfers.edit',$producttransfers->id) !!}" id='edit-producttransfers-{!! $producttransfers->id !!}' class='btn btn-xs btn-warning'>
                                            Receive
                                        </a>
                                        @else
                                        <a href="#" id='edit-producttransfers-{!! $producttransfers->id !!}' class='btn btn-xs btn-default'>
                                            Receive
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
                <h4 class="modal-title">Product Transfers - Filter Dialog</h4>
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
                    <form id="form"  class="form-horizontal" action="{!! url('admin/producttransfersfilter') !!}" method="POST">
                        {!! csrf_field() !!}
                                <div class="form-group">
                                    <label for="Product" class="col-sm-3 control-label">Product</label>
                                    <div class="col-sm-6">
									    <select class="form-control selectpicker" data-size="100000" data-live-search="true" data-style="btn-white" name="product"  id="product">
                                            <option value="" >Select Product</option>				                                @foreach ($producttransfersdata['products'] as $products)
				                                <option value="{!! $products->id !!}">
					
				                                {!! $products->product_number!!}
				                                {!! $products->name!!}
				                                </option>
				                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Store From" class="col-sm-3 control-label">Store From</label>
                                    <div class="col-sm-6">
									    <select class="form-control selectpicker" data-size="100000" data-live-search="true" data-style="btn-white" name="store_from"  id="store_from">
                                            <option value="" >Select Store From</option>				                                @foreach ($producttransfersdata['stores'] as $stores)
				                                <option value="{!! $stores->id !!}">
					
				                                {!! $stores->number!!}
				                                {!! $stores->name!!}
				                                </option>
				                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Store To" class="col-sm-3 control-label">Store To</label>
                                    <div class="col-sm-6">
									    <select class="form-control selectpicker" data-size="100000" data-live-search="true" data-style="btn-white" name="store_to"  id="store_to">
                                            <option value="" >Select Store To</option>				                                @foreach ($producttransfersdata['stores'] as $stores)
				                                <option value="{!! $stores->id !!}">
					
				                                {!! $stores->number!!}
				                                {!! $stores->name!!}
				                                </option>
				                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Size" class="col-sm-3 control-label">Size</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="size"  id="size" class="form-control" placeholder="Size" value="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-3 col-sm-6">
                                    <div class="col-sm-offset-3 col-sm-6">
                                        <button type="submit" class="btn btn-sm btn-inverse">
                                            <i class="fa fa-btn fa-search"></i> Search Product Transfers
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