@extends('admin.home')
@section('main_content')
		<div id="content" class="content">
    <ol class="breadcrumb pull-right">
        <li><a href="#">Home</a></li>
        <li><a href="#">public</a></li>
        <li><a href="#">Product Interest Configurations</a></li>
        <li class="active">form</li>
    </ol>
    <h1 class="page-header">Product Interest Configurations Form <small>product interest configurations details goes here...</small></h1>
    <div class="row">
        <div class="col-md-12">
            <a href="{!! route('productinterestconfigurations.index') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-arrow-left"></i></button></a>
        </div>
    </div>
            <div class="profile-container">
                <div class="profile-section">
                        <div class="profile-info">
                            <div class="table-responsive">
                                <table class="table table-profile">
                                    <thead>
                                    	<tr class="highlight">
                                    		<td>Product Interest Configurations</td>
                                    		<td>Profile Data</td>
                                    	</tr>
                                        <tr class="divider">
                                            <td colspan="2"></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="field">Loan Product</td>
                                            <td>				                                @foreach ($productinterestconfigurationsdata['loanproducts'] as $loanproducts)
				                                @if( $loanproducts->id  ==  $productinterestconfigurationsdata['data']->loan_product  )
				                                {!! $loanproducts->name!!}
				                                </option>@endif
				                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Interest Payment Method</td>
                                            <td>				                                @foreach ($productinterestconfigurationsdata['interestpaymentmethods'] as $interestpaymentmethods)
				                                @if( $interestpaymentmethods->id  ==  $productinterestconfigurationsdata['data']->interest_payment_method  )
				                                {!! $interestpaymentmethods->name!!}
				                                </option>@endif
				                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Payment Mode</td>
                                            <td>				                                @foreach ($productinterestconfigurationsdata['paymentmodes'] as $paymentmodes)
				                                @if( $paymentmodes->id  ==  $productinterestconfigurationsdata['data']->payment_mode  )
				                                {!! $paymentmodes->name!!}
				                                </option>@endif
				                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Debit Account</td>
                                            <td>				                                @foreach ($productinterestconfigurationsdata['accounts'] as $accounts)
				                                @if( $accounts->id  ==  $productinterestconfigurationsdata['data']->debit_account  )
				                                {!! $accounts->name!!}
				                                </option>@endif
				                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Credit Account</td>
                                            <td>				                                @foreach ($productinterestconfigurationsdata['accounts'] as $accounts)
				                                @if( $accounts->id  ==  $productinterestconfigurationsdata['data']->credit_account  )
				                                {!! $accounts->name!!}
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