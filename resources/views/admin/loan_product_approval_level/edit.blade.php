@extends("admin.home")
@section("main_content")
<div id="content" class="content">
    <ol class="breadcrumb pull-right">
        <li><a href="#">Home</a></li>
        <li><a href="#">public</a></li>
        <li><a href="#">Loan Product Approval Level</a></li>
        <li class="active">form</li>
    </ol>
    <h1 class="page-header">Loan Product Approval Level Update Form <small>loan product approval level details goes here...</small></h1>
    <div class="row">
        <div class="col-md-12">
            <a href="{!! route('loanproductapprovallevel.index') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-arrow-left"></i></button></a>
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
                    <form action="{!! route('loanproductapprovallevel.update',$loanproductapprovalleveldata['data']->id) !!}" method="POST" class="form-horizontal">
<input type="hidden" name="_method" value="put" />
                        {!! csrf_field() !!}
                                <div class="form-group">
                                    <label for="Loan Product" class="col-sm-3 control-label">Loan Product</label>
                                    <div class="col-sm-6">
									    <select class="form-control" name="loan_product" id="loan_product">
                                            <option value="" >Select Loan Product</option>				                                @foreach ($loanproductapprovalleveldata['loanproducts'] as $loanproducts)
				                                @if( $loanproducts->id  ==  $loanproductapprovalleveldata['data']->loan_product  ){
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
                                    <label for="Approval Level" class="col-sm-3 control-label">Approval Level</label>
                                    <div class="col-sm-6">
									    <select class="form-control" name="approval_level" id="approval_level">
                                            <option value="" >Select Approval Level</option>				                                @foreach ($loanproductapprovalleveldata['approvallevels'] as $approvallevels)
				                                @if( $approvallevels->id  ==  $loanproductapprovalleveldata['data']->approval_level  ){
				                                <option selected value="{!! $approvallevels->id !!}" >
								
				                                {!! $approvallevels->name!!}
				                                </option>@else
				                                <option value="{!! $approvallevels->id !!}" >
								
				                                {!! $approvallevels->name!!}
				                                </option>@endif
				                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Employee Category" class="col-sm-3 control-label">Employee Category</label>
                                    <div class="col-sm-6">
									    <select class="form-control" name="employee_category" id="employee_category">
                                            <option value="" >Select Employee Category</option>				                                @foreach ($loanproductapprovalleveldata['employeecategories'] as $employeecategories)
				                                @if( $employeecategories->id  ==  $loanproductapprovalleveldata['data']->employee_category  ){
				                                <option selected value="{!! $employeecategories->id !!}" >
								
				                                {!! $employeecategories->name!!}
				                                </option>@else
				                                <option value="{!! $employeecategories->id !!}" >
								
				                                {!! $employeecategories->name!!}
				                                </option>@endif
				                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-3 col-sm-6">
                                    <div class="col-sm-offset-3 col-sm-6">
                                        <button type="submit" class="btn btn-sm btn-primary">
                                            <i class="fa fa-btn fa-plus"></i> Edit Loan Product Approval Level
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
@endsection