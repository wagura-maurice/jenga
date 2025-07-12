@extends('admin.home')
@section('main_content')
		<div id="content" class="content">
    <ol class="breadcrumb pull-right">
        <li><a href="#">Home</a></li>
        <li><a href="#">public</a></li>
        <li><a href="#">Insurance Deductions Configurations</a></li>
        <li class="active">form</li>
    </ol>
    <h1 class="page-header">Insurance Deductions Configurations Form <small>insurance deductions configurations details goes here...</small></h1>
    <div class="row">
        <div class="col-md-12">
            <a href="{!! route('insurancedeductionsconfigurations.index') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-arrow-left"></i></button></a>
        </div>
    </div>
            <div class="profile-container">
                <div class="profile-section">
                        <div class="profile-info">
                            <div class="table-responsive">
                                <table class="table table-profile">
                                    <thead>
                                    	<tr class="highlight">
                                    		<td>Insurance Deductions Configurations</td>
                                    		<td>Profile Data</td>
                                    	</tr>
                                        <tr class="divider">
                                            <td colspan="2"></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="field">Loan Product</td>
                                            <td>				                                @foreach ($insurancedeductionsconfigurationsdata['loanproducts'] as $loanproducts)
				                                @if( $loanproducts->id  ==  $insurancedeductionsconfigurationsdata['data']->loan_product  )
				                                {!! $loanproducts->name!!}
				                                @endif
				                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Fee Type</td>
                                            <td>				                                @foreach ($insurancedeductionsconfigurationsdata['feetypes'] as $feetypes)
				                                @if( $feetypes->id  ==  $insurancedeductionsconfigurationsdata['data']->fee_type  )
				                                {!! $feetypes->name!!}
				                                @endif
				                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Fee Payment Type</td>
                                            <td>				                                @foreach ($insurancedeductionsconfigurationsdata['feepaymenttypes'] as $feepaymenttypes)
				                                @if( $feepaymenttypes->id  ==  $insurancedeductionsconfigurationsdata['data']->fee_payment_type  )
				                                {!! $feepaymenttypes->name!!}
				                                @endif
				                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Debit Account</td>
                                            <td>				                                @foreach ($insurancedeductionsconfigurationsdata['accounts'] as $accounts)
				                                @if( $accounts->id  ==  $insurancedeductionsconfigurationsdata['data']->debit_account  )
				                                {!! $accounts->name!!}
				                                @endif
				                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Credit Account</td>
                                            <td>				                                @foreach ($insurancedeductionsconfigurationsdata['accounts'] as $accounts)
				                                @if( $accounts->id  ==  $insurancedeductionsconfigurationsdata['data']->credit_account  )
				                                {!! $accounts->name!!}
				                                @endif
				                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Payment Mode</td>
                                            <td>				                                @foreach ($insurancedeductionsconfigurationsdata['paymentmodes'] as $paymentmodes)
				                                @if( $paymentmodes->id  ==  $insurancedeductionsconfigurationsdata['data']->payment_mode  )
				                                {!! $paymentmodes->name!!}
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