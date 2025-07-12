@extends("admin.home")
@section("main_content")
<div id="content" class="content">
    <ol class="breadcrumb pull-right">
        <li><a href="#">Home</a></li>
        <li><a href="#">public</a></li>
        <li><a href="#">Loan Product Assets</a></li>
        <li class="active">form</li>
    </ol>
    <h1 class="page-header">Loan Product Assets Update Form <small>loan product assets details goes here...</small></h1>
    <div class="row">
        <div class="col-md-12">
            <a href="{!! route('loanproductassets.index') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-arrow-left"></i></button></a>
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
                    <form action="{!! route('loanproductassets.update',$loanproductassetsdata['data']->id) !!}" method="POST" class="form-horizontal">
<input type="hidden" name="_method" value="put" />
                        {!! csrf_field() !!}
                                <div class="form-group">
                                    <label for="Loan Product" class="col-sm-3 control-label">Loan Product</label>
                                    <div class="col-sm-6">
									    <select class="form-control selectpicker" data-size="100000" data-live-search="true" data-style="btn-white" name="loan_product" id="loan_product">
                                            <option value="" >Select Loan Product</option>				                                @foreach ($loanproductassetsdata['loanproducts'] as $loanproducts)
				                                @if( $loanproducts->id  ==  $loanproductassetsdata['data']->loan_product  ){
				                                <option selected value="{!! $loanproducts->id !!}" >
								
				                                {!! $loanproducts->name!!}
				                                </option>@else
				                                <option value="{!! $loanproducts->id !!}" >
								
				                                {!! $loanproducts->name!!}
				                                </option>@endif
				                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Asset" class="col-sm-3 control-label">Asset</label>
                                    <div class="col-sm-6">
									    <select class="form-control selectpicker" data-size="100000" data-live-search="true" data-style="btn-white" name="asset" id="asset">
                                            <option value="" >Select Asset</option>				                                @foreach ($loanproductassetsdata['products'] as $products)
				                                @if( $products->id  ==  $loanproductassetsdata['data']->asset  ){
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
                                    <label for="Quantity" class="col-sm-3 control-label">Quantity</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="quantity" id="quantity" class="form-control" placeholder="Quantity" value="{!! $loanproductassetsdata['data']->quantity !!}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-3 col-sm-6">
                                    <div class="col-sm-offset-3 col-sm-6">
                                        <button type="submit" class="btn btn-sm btn-primary">
                                            <i class="fa fa-btn fa-plus"></i> Edit Loan Product Assets
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