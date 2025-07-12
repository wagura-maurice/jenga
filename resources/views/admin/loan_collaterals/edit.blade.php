@extends("admin.home")
@section("main_content")
<div id="content" class="content">
    <ol class="breadcrumb pull-right">
        <li><a href="#">Home</a></li>
        <li><a href="#">public</a></li>
        <li><a href="#">Loan Collaterals</a></li>
        <li class="active">form</li>
    </ol>
    <h1 class="page-header">Loan Collaterals Update Form <small>loan collaterals details goes here...</small></h1>
    <div class="row">
        <div class="col-md-12">
            <a href="{!! route('loancollaterals.index') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-arrow-left"></i></button></a>
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
                    <form action="{!! route('loancollaterals.update',$loancollateralsdata['data']->id) !!}" method="POST" class="form-horizontal">
<input type="hidden" name="_method" value="put" />
                        {!! csrf_field() !!}
                                <div class="form-group">
                                    <label for="Loan" class="col-sm-3 control-label">Loan</label>
                                    <div class="col-sm-6">
									    <select class="form-control" name="loan" id="loan">
                                            <option value="" >Select Loan</option>				                                @foreach ($loancollateralsdata['loans'] as $loans)
				                                @if( $loans->id  ==  $loancollateralsdata['data']->loan  ){
				                                <option selected value="{!! $loans->id !!}" >
								
				                                {!! $loans->loan_number!!}
				                                </option>@else
				                                <option value="{!! $loans->id !!}" >
								
				                                {!! $loans->loan_number!!}
				                                </option>@endif
				                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Collateral Category" class="col-sm-3 control-label">Collateral Category</label>
                                    <div class="col-sm-6">
									    <select class="form-control" name="collateral_category" id="collateral_category">
                                            <option value="" >Select Collateral Category</option>				                                @foreach ($loancollateralsdata['collateralcategories'] as $collateralcategories)
				                                @if( $collateralcategories->id  ==  $loancollateralsdata['data']->collateral_category  ){
				                                <option selected value="{!! $collateralcategories->id !!}" >
								
				                                {!! $collateralcategories->name!!}
				                                </option>@else
				                                <option value="{!! $collateralcategories->id !!}" >
								
				                                {!! $collateralcategories->name!!}
				                                </option>@endif
				                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Model" class="col-sm-3 control-label">Model</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="model" id="model" class="form-control" placeholder="Model" value="{!! $loancollateralsdata['data']->model !!}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Color" class="col-sm-3 control-label">Color</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="color" id="color" class="form-control" placeholder="Color" value="{!! $loancollateralsdata['data']->color !!}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Size" class="col-sm-3 control-label">Size</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="size" id="size" class="form-control" placeholder="Size" value="{!! $loancollateralsdata['data']->size !!}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Year Bought" class="col-sm-3 control-label">Year Bought</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="year_bought" id="year_bought" class="form-control" placeholder="Year Bought" value="{!! $loancollateralsdata['data']->year_bought !!}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Buying Price" class="col-sm-3 control-label">Buying Price</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="buying_price" id="buying_price" class="form-control" placeholder="Buying Price" value="{!! $loancollateralsdata['data']->buying_price !!}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Current Selling Price" class="col-sm-3 control-label">Current Selling Price</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="current_selling_price" id="current_selling_price" class="form-control" placeholder="Current Selling Price" value="{!! $loancollateralsdata['data']->current_selling_price !!}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Serial Number" class="col-sm-3 control-label">Serial Number</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="serial_number" id="serial_number" class="form-control" placeholder="Serial Number" value="{!! $loancollateralsdata['data']->serial_number !!}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-3 col-sm-6">
                                    <div class="col-sm-offset-3 col-sm-6">
                                        <button type="submit" class="btn btn-sm btn-primary">
                                            <i class="fa fa-btn fa-plus"></i> Edit Loan Collaterals
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