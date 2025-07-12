@extends("admin.home")
@section("main_content")
<div id="content" class="content">
    <ol class="breadcrumb pull-right">
        <li><a href="#">Home</a></li>
        <li><a href="#">Public</a></li>
        <li><a href="#">Loan Collaterals</a></li>
        <li class="active">Table</li>
    </ol>
    <h1 class="page-header">Loan Collaterals - DATA <small>loan collaterals data goes here...</small></h1>
    <div class="row">
        <div class="col-md-12">
            @if($loancollateralsdata['usersaccountsroles'][0]->_add==1)
            <a href="{!! route('loancollaterals.create') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-plus"></i></button></a>
            @endif
            @if($loancollateralsdata['usersaccountsroles'][0]->_report==1)
            <a href="{!! url('admin/loancollateralsreport') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-file-text-o"></i></button></a>
            @endif
            @if($loancollateralsdata['usersaccountsroles'][0]->_report==1 || $loancollateralsdata['usersaccountsroles'][0]->_list==1)
            <a href="#modal-dialog"  data-toggle="modal"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-filter"></i></button></a>
            @endif
    @if($loancollateralsdata['usersaccountsroles'][0]->_list==1)
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
                    <h4 class="panel-title">DataTable - Autofill</h4>
                </div>
                <div class="panel-body">
                    <table id="data-table" class="table table-striped table-bordered">
                        <thead>
                                    <tr>
                                        <th>Loan</th>
                                        <th>Collateral Category</th>
                                        <th>Model</th>
                                        <th>Color</th>
                                        <th>Size</th>
                                        <th>Year Bought</th>
                                        <th>Buying Price</th>
                                        <th>Current Selling Price</th>
                                        <th>Action</th>                                    </tr>
                        </thead>
                        <tbody>
                        @foreach ($loancollateralsdata['list'] as $loancollaterals)
                            <tr>
                                <td class='table-text'><div>
                                	{!! $loancollaterals->loanmodel->loan_number !!}
                                </div></td>
                                <td class='table-text'><div>
                                	{!! $loancollaterals->collateralcategorymodel->name !!}
                                </div></td>
                                <td class='table-text'><div>
                                	{!! $loancollaterals->model !!}
                                </div></td>
                                <td class='table-text'><div>
                                	{!! $loancollaterals->color !!}
                                </div></td>
                                <td class='table-text'><div>
                                	{!! $loancollaterals->size !!}
                                </div></td>
                                <td class='table-text'><div>
                                	{!! $loancollaterals->year_bought !!}
                                </div></td>
                                <td class='table-text'><div>
                                	{!! $loancollaterals->buying_price !!}
                                </div></td>
                                <td class='table-text'><div>
                                	{!! $loancollaterals->current_selling_price !!}
                                </div></td>
                                <td>
                <form action="{!! route('loancollaterals.destroy',$loancollaterals->id) !!}" method="POST">
                                        @if($loancollateralsdata['usersaccountsroles'][0]->_show==1)
                                        <a href="{!! route('loancollaterals.show',$loancollaterals->id) !!}" id='show-loancollaterals-{!! $loancollaterals->id !!}' class='btn btn-sm btn-circle btn-inverse'>
                                            <i class='fa fa-btn fa-eye'></i>
                                        </a>
                                        @endif
                                        @if($loancollateralsdata['usersaccountsroles'][0]->_edit==1)
                                        <a href="{!! route('loancollaterals.edit',$loancollaterals->id) !!}" id='edit-loancollaterals-{!! $loancollaterals->id !!}' class='btn btn-sm btn-circle btn-warning'>
                                            <i class='fa fa-btn fa-edit'></i>
                                        </a>
                                        @endif
                                        @if($loancollateralsdata['usersaccountsroles'][0]->_delete==1)
                                        <input type="hidden" name="_method" value="delete" />
                                        {!! csrf_field() !!}
                                        {!! method_field('DELETE') !!}
                                        <button type='submit' id='delete-loancollaterals-{!! $loancollaterals->id !!}' class='btn btn-sm btn-circle btn-danger'>
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
                <h4 class="modal-title">Loan Collaterals - Filter Dialog</h4>
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
                    <form id="form"  class="form-horizontal" action="{!! url('admin/loancollateralsfilter') !!}" method="POST">
                        {!! csrf_field() !!}
                                <div class="form-group">
                                    <label for="Loan" class="col-sm-3 control-label">Loan</label>
                                    <div class="col-sm-6">
									    <select class="form-control" name="loan"  id="loan">
                                            <option value="" >Select Loan</option>				                                @foreach ($loancollateralsdata['loans'] as $loans)
				                                <option value="{!! $loans->id !!}">
					
				                                {!! $loans->loan_number!!}
				                                </option>
				                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Collateral Category" class="col-sm-3 control-label">Collateral Category</label>
                                    <div class="col-sm-6">
									    <select class="form-control" name="collateral_category"  id="collateral_category">
                                            <option value="" >Select Collateral Category</option>				                                @foreach ($loancollateralsdata['collateralcategories'] as $collateralcategories)
				                                <option value="{!! $collateralcategories->id !!}">
					
				                                {!! $collateralcategories->name!!}
				                                </option>
				                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Model" class="col-sm-3 control-label">Model</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="model"  id="model" class="form-control" placeholder="Model" value="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Color" class="col-sm-3 control-label">Color</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="color"  id="color" class="form-control" placeholder="Color" value="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Size" class="col-sm-3 control-label">Size</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="size"  id="size" class="form-control" placeholder="Size" value="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Year Bought" class="col-sm-3 control-label">Year Bought</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="year_bought"  id="year_bought" class="form-control" placeholder="Year Bought" value="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Buying Price" class="col-sm-3 control-label">Buying Price</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="buying_price"  id="buying_price" class="form-control" placeholder="Buying Price" value="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Current Selling Price" class="col-sm-3 control-label">Current Selling Price</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="current_selling_price"  id="current_selling_price" class="form-control" placeholder="Current Selling Price" value="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Serial Number" class="col-sm-3 control-label">Serial Number</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="serial_number"  id="serial_number" class="form-control" placeholder="Serial Number" value="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-3 col-sm-6">
                                    <div class="col-sm-offset-3 col-sm-6">
                                        <button type="submit" class="btn btn-sm btn-inverse">
                                            <i class="fa fa-btn fa-search"></i> Search Loan Collaterals
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