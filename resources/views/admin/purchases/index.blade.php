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
        <li><a href="#">Purchases</a></li>
        <li class="active">Table</li>
    </ol>
    <h1 class="page-header">Purchases - DATA <small>purchases data goes here...</small></h1>
    <div class="row">
        <div class="col-md-12">
            @if($purchasesdata['usersaccountsroles'][0]->_add==1)
            <a href="{!! route('purchases.create') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-plus"></i></button></a>
            @endif
            @if($purchasesdata['usersaccountsroles'][0]->_report==1)
            <a href="{!! url('admin/purchasesreport') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-file-text-o"></i></button></a>
            @endif
            @if($purchasesdata['usersaccountsroles'][0]->_report==1 || $purchasesdata['usersaccountsroles'][0]->_list==1)
            <a href="#modal-dialog"  data-toggle="modal"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-filter"></i></button></a>
            @endif
        </div>
    </div>
    @if($purchasesdata['usersaccountsroles'][0]->_list==1)
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
                                        <th>Supplier</th>
                                        <th>Product</th>
                                        <th>Quantity</th>
                                        <th>Purchase Date</th>
                                        <th>Action</th>                                    </tr>
                        </thead>
                        <tbody>
                        @foreach ($purchasesdata['list'] as $purchases)
                            <tr>
                                <td class='table-text'><div>
                                	{!! $purchases->suppliermodel->name !!}
                                </div></td>
                                <td class='table-text'><div>
                                	{!! $purchases->productmodel->name !!}
                                </div></td>
                                <td class='table-text'><div>
                                	{!! $purchases->quantity !!}
                                </div></td>
                                <td class='table-text'><div>
                                	{!! $purchases->purchase_date !!}
                                </div></td>
                                <td>
                <form action="{!! route('purchases.destroy',$purchases->id) !!}" method="POST">
                                        @if($purchasesdata['usersaccountsroles'][0]->_show==1)
                                        <a href="{!! route('purchases.show',$purchases->id) !!}" id='show-purchases-{!! $purchases->id !!}' class='btn btn-sm btn-circle btn-inverse'>
                                            <i class='fa fa-btn fa-eye'></i>
                                        </a>
                                        @endif
                                        @if($purchasesdata['usersaccountsroles'][0]->_edit==1)
                                        <a href="{!! route('purchases.edit',$purchases->id) !!}" id='edit-purchases-{!! $purchases->id !!}' class='btn btn-sm btn-circle btn-warning'>
                                            <i class='fa fa-btn fa-edit'></i>
                                        </a>
                                        @endif
                                        @if($purchasesdata['usersaccountsroles'][0]->_delete==1)
                                        <input type="hidden" name="_method" value="delete" />
                                        {!! csrf_field() !!}
                                        {!! method_field('DELETE') !!}
                                        <button type='submit' id='delete-purchases-{!! $purchases->id !!}' class='btn btn-sm btn-circle btn-danger'>
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
                <h4 class="modal-title">Purchases - Filter Dialog</h4>
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
                    <form id="form"  class="form-horizontal" action="{!! url('admin/purchasesfilter') !!}" method="POST">
                        {!! csrf_field() !!}
                                <div class="form-group">
                                    <label for="Supplier" class="col-sm-3 control-label">Supplier</label>
                                    <div class="col-sm-6">
									    <select class="form-control selectpicker" data-size="100000" data-live-search="true" data-style="btn-white" name="supplier"  id="supplier">
                                            <option value="" >Select Supplier</option>				                                @foreach ($purchasesdata['suppliers'] as $suppliers)
				                                <option value="{!! $suppliers->id !!}">
					
				                                {!! $suppliers->name!!}
				                                </option>
				                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Product" class="col-sm-3 control-label">Product</label>
                                    <div class="col-sm-6">
									    <select class="form-control selectpicker" data-size="100000" data-live-search="true" data-style="btn-white" name="product"  id="product">
                                            <option value="" >Select Product</option>				                                @foreach ($purchasesdata['products'] as $products)
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
                                    <label for="Purchase Date" class="col-sm-3 control-label">Purchase Date</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="purchase_datefrom" id="purchase_datefrom" class="form-control m-b-5" placeholder="Purchase Date From" value="">
                                        <input type="text" name="purchase_dateto" id="purchase_dateto" class="form-control" placeholder="Purchase Date To" value="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-3 col-sm-6">
                                    <div class="col-sm-offset-3 col-sm-6">
                                        <button type="submit" class="btn btn-sm btn-inverse">
                                            <i class="fa fa-btn fa-search"></i> Search Purchases
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
$("#purchase_datefrom").datepicker({todayHighlight:!0,autoclose:!0});
$("#purchase_dateto").datepicker({todayHighlight:!0,autoclose:!0});
</script>
@endsection