@extends('admin.home')
@section('main_content')
		<div id="content" class="content">
    <ol class="breadcrumb pull-right">
        <li><a href="#">Home</a></li>
        <li><a href="#">public</a></li>
        <li><a href="#">Product Principal Configurations</a></li>
        <li class="active">form</li>
    </ol>
    <h1 class="page-header">Product Principal Configurations Form <small>product principal configurations details goes here...</small></h1>
    <div class="row">
        <div class="col-md-12">
            <a href="{!! route('productprincipalconfigurations.index') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-arrow-left"></i></button></a>
        </div>
    </div>
            <div class="profile-container">
                <div class="profile-section">
                        <div class="profile-info">
                            <div class="table-responsive">
                                <table class="table table-profile">
                                    <thead>
                                    	<tr class="highlight">
                                    		<td>Product Principal Configurations</td>
                                    		<td>Profile Data</td>
                                    	</tr>
                                        <tr class="divider">
                                            <td colspan="2"></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="field">Loan Product</td>
                                            <td>				                                @foreach ($productprincipalconfigurationsdata['loanproducts'] as $loanproducts)
				                                @if( $loanproducts->id  ==  $productprincipalconfigurationsdata['data']->loan_product  )
				                                {!! $loanproducts->name!!}
				                                @endif
				                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Payment Mode</td>
                                            <td>				                                @foreach ($productprincipalconfigurationsdata['paymentmodes'] as $paymentmodes)
				                                @if( $paymentmodes->id  ==  $productprincipalconfigurationsdata['data']->payment_mode  )
				                                {!! $paymentmodes->name!!}
				                                @endif
				                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Debit Account</td>
                                            <td>				                                @foreach ($productprincipalconfigurationsdata['accounts'] as $accounts)
				                                @if( $accounts->id  ==  $productprincipalconfigurationsdata['data']->debit_account  )
				                                {!! $accounts->name!!}
				                                @endif
				                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Credit Account</td>
                                            <td>				                                @foreach ($productprincipalconfigurationsdata['accounts'] as $accounts)
				                                @if( $accounts->id  ==  $productprincipalconfigurationsdata['data']->credit_account  )
				                                {!! $accounts->name!!}
				                                @endif
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