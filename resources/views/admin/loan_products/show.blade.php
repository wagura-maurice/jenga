@extends('admin.home')
@section('main_content')
		<div id="content" class="content">
    <ol class="breadcrumb pull-right">
        <li><a href="#">Home</a></li>
        <li><a href="#">public</a></li>
        <li><a href="#">Loan Products</a></li>
        <li class="active">form</li>
    </ol>
    <h1 class="page-header">Loan Products Form <small>loan products details goes here...</small></h1>
    <div class="row">
        <div class="col-md-12">
            <a href="{!! route('loanproducts.index') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-arrow-left"></i></button></a>
        </div>
    </div>
            <div class="profile-container">
                <div class="profile-section">
                        <div class="profile-info">
                            <div class="table-responsive">
                                <table class="table table-profile">
                                    <thead>
                                    	<tr class="highlight">
                                    		<td>Loan Products</td>
                                    		<td>Profile Data</td>
                                    	</tr>
                                        <tr class="divider">
                                            <td colspan="2"></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="field">Code</td>
                                            <td>
                                            {!! $loanproductsdata['data']->code !!}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Name</td>
                                            <td>
                                            {!! $loanproductsdata['data']->name !!}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Description</td>
                                            <td>
                                            {!! $loanproductsdata['data']->description !!}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Grace Period</td>
                                            <td>				                                @foreach ($loanproductsdata['graceperiods'] as $graceperiods)
				                                @if( $graceperiods->id  ==  $loanproductsdata['data']->grace_period  )
				                                {!! $graceperiods->name!!}
				                                </option>@endif
				                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Mode Of Disbursement</td>
                                            <td>				                                @foreach ($loanproductsdata['disbursementmodes'] as $disbursementmodes)
				                                @if( $disbursementmodes->id  ==  $loanproductsdata['data']->mode_of_disbursement  )
				                                {!! $disbursementmodes->name!!}
				                                </option>@endif
				                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Fine Type</td>
                                            <td>				                                @foreach ($loanproductsdata['finetypes'] as $finetypes)
				                                @if( $finetypes->id  ==  $loanproductsdata['data']->fine_type  )
				                                {!! $finetypes->name!!}
				                                </option>@endif
				                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Fine Charge</td>
                                            <td>
                                            {!! $loanproductsdata['data']->fine_charge !!}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Fine Charge Frequency</td>
                                            <td>				                                @foreach ($loanproductsdata['finechargefrequencies'] as $finechargefrequencies)
				                                @if( $finechargefrequencies->id  ==  $loanproductsdata['data']->fine_charge_frequency  )
				                                {!! $finechargefrequencies->name!!}
				                                </option>@endif
				                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Fine Charge Period</td>
                                            <td>				                                @foreach ($loanproductsdata['finechargeperiods'] as $finechargeperiods)
				                                @if( $finechargeperiods->id  ==  $loanproductsdata['data']->fine_charge_period  )
				                                {!! $finechargeperiods->name!!}
				                                </option>@endif
				                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Interest Rate Type</td>
                                            <td>				                                @foreach ($loanproductsdata['interestratetypes'] as $interestratetypes)
				                                @if( $interestratetypes->id  ==  $loanproductsdata['data']->interest_rate_type  )
				                                {!! $interestratetypes->name!!}
				                                </option>@endif
				                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Compounds Per Year</td>
                                            <td>
                                            {!! $loanproductsdata['data']->compounds_per_year !!}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Interest Rate</td>
                                            <td>
                                            {!! $loanproductsdata['data']->interest_rate !!}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Interest Payment Method</td>
                                            <td>				                                @foreach ($loanproductsdata['interestpaymentmethods'] as $interestpaymentmethods)
				                                @if( $interestpaymentmethods->id  ==  $loanproductsdata['data']->interest_payment_method  )
				                                {!! $interestpaymentmethods->name!!}
				                                </option>@endif
				                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Initial Deposit</td>
                                            <td>
                                            {!! $loanproductsdata['data']->initial_deposit !!}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Loan Payment Duration</td>
                                            <td>				                                @foreach ($loanproductsdata['loanpaymentdurations'] as $loanpaymentdurations)
				                                @if( $loanpaymentdurations->id  ==  $loanproductsdata['data']->loan_payment_duration  )
				                                {!! $loanpaymentdurations->name!!}
				                                </option>@endif
				                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Minimum Loan Amount</td>
                                            <td>
                                            {!! $loanproductsdata['data']->minimum_loan_amount !!}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Maximum Loan Amount</td>
                                            <td>
                                            {!! $loanproductsdata['data']->maximum_loan_amount !!}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Can Change Disbursement Mode</td>
                                            <td>
                                            {!! $loanproductsdata['data']->can_change_disbursement_mode !!}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Can Access Another Loan</td>
                                            <td>
                                            {!! $loanproductsdata['data']->can_access_another_loan !!}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Clearing Fee</td>
                                            <td>
                                            {!! $loanproductsdata['data']->clearing_fee !!}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Number Of Guarantors</td>
                                            <td>
                                            {!! $loanproductsdata['data']->number_of_guarantors !!}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Minimum Membership Period</td>
                                            <td>				                                @foreach ($loanproductsdata['minimummembershipperiods'] as $minimummembershipperiods)
				                                @if( $minimummembershipperiods->id  ==  $loanproductsdata['data']->minimum_membership_period  )
				                                {!! $minimummembershipperiods->name!!}
				                                </option>@endif
				                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Insurance Deduction Fee</td>
                                            <td>
                                            {!! $loanproductsdata['data']->insurance_deduction_fee !!}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                </div>
            </div>
		</div>