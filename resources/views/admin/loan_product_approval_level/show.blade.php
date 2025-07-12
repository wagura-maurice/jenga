@extends('admin.home')
@section('main_content')
		<div id="content" class="content">
    <ol class="breadcrumb pull-right">
        <li><a href="#">Home</a></li>
        <li><a href="#">public</a></li>
        <li><a href="#">Loan Product Approval Level</a></li>
        <li class="active">form</li>
    </ol>
    <h1 class="page-header">Loan Product Approval Level Form <small>loan product approval level details goes here...</small></h1>
    <div class="row">
        <div class="col-md-12">
            <a href="{!! route('loanproductapprovallevel.index') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-arrow-left"></i></button></a>
        </div>
    </div>
            <div class="profile-container">
                <div class="profile-section">
                        <div class="profile-info">
                            <div class="table-responsive">
                                <table class="table table-profile">
                                    <thead>
                                    	<tr class="highlight">
                                    		<td>Loan Product Approval Level</td>
                                    		<td>Profile Data</td>
                                    	</tr>
                                        <tr class="divider">
                                            <td colspan="2"></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="field">Loan Product</td>
                                            <td>				                                @foreach ($loanproductapprovalleveldata['loanproducts'] as $loanproducts)
				                                @if( $loanproducts->id  ==  $loanproductapprovalleveldata['data']->loan_product  )
				                                {!! $loanproducts->name!!}
				                                </option>@endif
				                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Approval Level</td>
                                            <td>				                                @foreach ($loanproductapprovalleveldata['approvallevels'] as $approvallevels)
				                                @if( $approvallevels->id  ==  $loanproductapprovalleveldata['data']->approval_level  )
				                                {!! $approvallevels->name!!}
				                                </option>@endif
				                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Employee Category</td>
                                            <td>				                                @foreach ($loanproductapprovalleveldata['employeecategories'] as $employeecategories)
				                                @if( $employeecategories->id  ==  $loanproductapprovalleveldata['data']->employee_category  )
				                                {!! $employeecategories->name!!}
				                                </option>@endif
				                                @endforeach
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                </div>
            </div>
		</div>