@extends('admin.home')
@section('main_content')
		<div id="content" class="content">
    <ol class="breadcrumb pull-right">
        <li><a href="#">Home</a></li>
        <li><a href="#">public</a></li>
        <li><a href="#">Disbursement Charges Configurations </a></li>
        <li class="active">form</li>
    </ol>
    <h1 class="page-header">Disbursement Charges Configurations  Form <small>disbursement charges configurations  details goes here...</small></h1>
    <div class="row">
        <div class="col-md-12">
            <a href="{!! route('disbursementchargesconfigurations.index') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-arrow-left"></i></button></a>
        </div>
    </div>
            <div class="profile-container">
                <div class="profile-section">
                        <div class="profile-info">
                            <div class="table-responsive">
                                <table class="table table-profile">
                                    <thead>
                                    	<tr class="highlight">
                                    		<td>Disbursement Charges Configurations </td>
                                    		<td>Profile Data</td>
                                    	</tr>
                                        <tr class="divider">
                                            <td colspan="2"></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="field">Loan Product</td>
                                            <td>				                                @foreach ($disbursementchargesconfigurationsdata['loanproducts'] as $loanproducts)
				                                @if( $loanproducts->id  ==  $disbursementchargesconfigurationsdata['data']->loan_product  )
				                                {!! $loanproducts->name!!}
				                                @endif
				                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Disbursement Charge</td>
                                            <td>				                                @foreach ($disbursementchargesconfigurationsdata['disbursementcharges'] as $disbursementcharges)
				                                @if( $disbursementcharges->id  ==  $disbursementchargesconfigurationsdata['data']->disbursement_charge  )
				                                {!! $disbursementcharges->name!!}
				                                @endif
				                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Disbursement Mode</td>
                                            <td>				                                @foreach ($disbursementchargesconfigurationsdata['disbursementmodes'] as $disbursementmodes)
				                                @if( $disbursementmodes->id  ==  $disbursementchargesconfigurationsdata['data']->disbursement_mode  )
				                                {!! $disbursementmodes->name!!}
				                                @endif
				                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Debit Account</td>
                                            <td>				                                @foreach ($disbursementchargesconfigurationsdata['accounts'] as $accounts)
				                                @if( $accounts->id  ==  $disbursementchargesconfigurationsdata['data']->debit_account  )
				                                {!! $accounts->name!!}
				                                @endif
				                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Credit Account</td>
                                            <td>				                                @foreach ($disbursementchargesconfigurationsdata['accounts'] as $accounts)
				                                @if( $accounts->id  ==  $disbursementchargesconfigurationsdata['data']->credit_account  )
				                                {!! $accounts->name!!}
				                                @endif
				                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Amount</td>
                                            <td>
                                            {!! $disbursementchargesconfigurationsdata['data']->amount !!}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                </div>
            </div>
		</div>