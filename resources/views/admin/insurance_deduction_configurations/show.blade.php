@extends('admin.home')
@section('main_content')
		<div id="content" class="content">
    <ol class="breadcrumb pull-right">
        <li><a href="#">Home</a></li>
        <li><a href="#">public</a></li>
        <li><a href="#">Insurance Deduction Configurations</a></li>
        <li class="active">form</li>
    </ol>
    <h1 class="page-header">Insurance Deduction Configurations Form <small>insurance deduction configurations details goes here...</small></h1>
    <div class="row">
        <div class="col-md-12">
            <a href="{!! route('insurancedeductionconfigurations.index') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-arrow-left"></i></button></a>
        </div>
    </div>
            <div class="profile-container">
                <div class="profile-section">
                        <div class="profile-info">
                            <div class="table-responsive">
                                <table class="table table-profile">
                                    <thead>
                                    	<tr class="highlight">
                                    		<td>Insurance Deduction Configurations</td>
                                    		<td>Profile Data</td>
                                    	</tr>
                                        <tr class="divider">
                                            <td colspan="2"></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="field">Loan Product</td>
                                            <td>				                                @foreach ($insurancedeductionconfigurationsdata['loanproducts'] as $loanproducts)
				                                @if( $loanproducts->id  ==  $insurancedeductionconfigurationsdata['data']->loan_product  )
				                                {!! $loanproducts->name!!}
				                                @endif
				                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Fee Type</td>
                                            <td>				                                @foreach ($insurancedeductionconfigurationsdata['feetypes'] as $feetypes)
				                                @if( $feetypes->id  ==  $insurancedeductionconfigurationsdata['data']->fee_type  )
				                                {!! $feetypes->name!!}
				                                @endif
				                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Fee Payment Type</td>
                                            <td>				                                @foreach ($insurancedeductionconfigurationsdata['feepaymenttypes'] as $feepaymenttypes)
				                                @if( $feepaymenttypes->id  ==  $insurancedeductionconfigurationsdata['data']->fee_payment_type  )
				                                {!! $feepaymenttypes->name!!}
				                                @endif
				                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Payment Mode</td>
                                            <td>				                                @foreach ($insurancedeductionconfigurationsdata['paymentmodes'] as $paymentmodes)
				                                @if( $paymentmodes->id  ==  $insurancedeductionconfigurationsdata['data']->payment_mode  )
				                                {!! $paymentmodes->name!!}
				                                @endif
				                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Disbursement Mode</td>
                                            <td>				                                @foreach ($insurancedeductionconfigurationsdata['disbursementmodes'] as $disbursementmodes)
				                                @if( $disbursementmodes->id  ==  $insurancedeductionconfigurationsdata['data']->disbursement_mode  )
				                                {!! $disbursementmodes->name!!}
				                                @endif
				                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Debit Account</td>
                                            <td>				                                @foreach ($insurancedeductionconfigurationsdata['accounts'] as $accounts)
				                                @if( $accounts->id  ==  $insurancedeductionconfigurationsdata['data']->debit_account  )
				                                {!! $accounts->name!!}
				                                @endif
				                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Credit Account</td>
                                            <td>				                                @foreach ($insurancedeductionconfigurationsdata['accounts'] as $accounts)
				                                @if( $accounts->id  ==  $insurancedeductionconfigurationsdata['data']->credit_account  )
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