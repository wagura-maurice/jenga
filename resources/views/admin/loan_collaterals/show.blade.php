@extends('admin.home')
@section('main_content')
		<div id="content" class="content">
    <ol class="breadcrumb pull-right">
        <li><a href="#">Home</a></li>
        <li><a href="#">public</a></li>
        <li><a href="#">Loan Collaterals</a></li>
        <li class="active">form</li>
    </ol>
    <h1 class="page-header">Loan Collaterals Form <small>loan collaterals details goes here...</small></h1>
    <div class="row">
        <div class="col-md-12">
            <a href="{!! route('loancollaterals.index') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-arrow-left"></i></button></a>
        </div>
    </div>
            <div class="profile-container">
                <div class="profile-section">
                        <div class="profile-info">
                            <div class="table-responsive">
                                <table class="table table-profile">
                                    <thead>
                                    	<tr class="highlight">
                                    		<td>Loan Collaterals</td>
                                    		<td>Profile Data</td>
                                    	</tr>
                                        <tr class="divider">
                                            <td colspan="2"></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="field">Loan</td>
                                            <td>				                                @foreach ($loancollateralsdata['loans'] as $loans)
				                                @if( $loans->id  ==  $loancollateralsdata['data']->loan  )
				                                {!! $loans->loan_number!!}
				                                </option>@endif
				                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Collateral Category</td>
                                            <td>				                                @foreach ($loancollateralsdata['collateralcategories'] as $collateralcategories)
				                                @if( $collateralcategories->id  ==  $loancollateralsdata['data']->collateral_category  )
				                                {!! $collateralcategories->name!!}
				                                </option>@endif
				                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Model</td>
                                            <td>
                                            {!! $loancollateralsdata['data']->model !!}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Color</td>
                                            <td>
                                            {!! $loancollateralsdata['data']->color !!}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Size</td>
                                            <td>
                                            {!! $loancollateralsdata['data']->size !!}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Year Bought</td>
                                            <td>
                                            {!! $loancollateralsdata['data']->year_bought !!}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Buying Price</td>
                                            <td>
                                            {!! $loancollateralsdata['data']->buying_price !!}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Current Selling Price</td>
                                            <td>
                                            {!! $loancollateralsdata['data']->current_selling_price !!}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Serial Number</td>
                                            <td>
                                            {!! $loancollateralsdata['data']->serial_number !!}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                </div>
            </div>
		</div>