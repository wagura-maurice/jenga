@extends('admin.home')
@section('main_content')
		<div id="content" class="content">
    <ol class="breadcrumb pull-right">
        <li><a href="#">Home</a></li>
        <li><a href="#">public</a></li>
        <li><a href="#">Loan Product Assets</a></li>
        <li class="active">form</li>
    </ol>
    <h1 class="page-header">Loan Product Assets Form <small>loan product assets details goes here...</small></h1>
    <div class="row">
        <div class="col-md-12">
            <a href="{!! route('loanproductassets.index') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-arrow-left"></i></button></a>
        </div>
    </div>
            <div class="profile-container">
                <div class="profile-section">
                        <div class="profile-info">
                            <div class="table-responsive">
                                <table class="table table-profile">
                                    <thead>
                                    	<tr class="highlight">
                                    		<td>Loan Product Assets</td>
                                    		<td>Profile Data</td>
                                    	</tr>
                                        <tr class="divider">
                                            <td colspan="2"></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="field">Loan Product</td>
                                            <td>				                                @foreach ($loanproductassetsdata['loanproducts'] as $loanproducts)
				                                @if( $loanproducts->id  ==  $loanproductassetsdata['data']->loan_product  )
				                                {!! $loanproducts->name!!}
				                                @endif
				                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Asset</td>
                                            <td>				                                @foreach ($loanproductassetsdata['products'] as $products)
				                                @if( $products->id  ==  $loanproductassetsdata['data']->asset  )
				                                {!! $products->product_number!!}
				                                {!! $products->name!!}
				                                @endif
				                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Quantity</td>
                                            <td>
                                            {!! $loanproductassetsdata['data']->quantity !!}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                </div>
            </div>
		</div>