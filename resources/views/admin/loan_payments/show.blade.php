@extends('admin.home')
@section('main_content')
		<div id="content" class="content">
    <ol class="breadcrumb pull-right">
        <li><a href="#">Home</a></li>
        <li><a href="#">public</a></li>
        <li><a href="#">Loan Payments</a></li>
        <li class="active">form</li>
    </ol>
    <h1 class="page-header">Loan Payments Form <small>loan payments details goes here...</small></h1>
    <div class="row">
        <div class="col-md-12">
            <a href="{!! route('loanpayments.index') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-arrow-left"></i></button></a>
        </div>
    </div>
            <div class="profile-container">
                <div class="profile-section">
                        <div class="profile-info">
                            <div class="table-responsive">
                                <table class="table table-profile">
                                    <thead>
                                    	<tr class="highlight">
                                    		<td>Loan Payments</td>
                                    		<td>Profile Data</td>
                                    	</tr>
                                        <tr class="divider">
                                            <td colspan="2"></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="field">Loan</td>
                                            <td>				                                @foreach ($loanpaymentsdata['loans'] as $loans)
				                                @if( $loans->id  ==  $loanpaymentsdata['data']->loan  )
				                                {!! $loans->loan_number!!}
				                                </option>@endif
				                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Mode Of Payment</td>
                                            <td>				                                @foreach ($loanpaymentsdata['paymentmodes'] as $paymentmodes)
				                                @if( $paymentmodes->id  ==  $loanpaymentsdata['data']->mode_of_payment  )
				                                {!! $paymentmodes->name!!}
				                                </option>@endif
				                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Transaction Number</td>
                                            <td>
                                            {!! $loanpaymentsdata['data']->transaction_number !!}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Amount</td>
                                            <td>
                                            {!! $loanpaymentsdata['data']->amount !!}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Date</td>
                                            <td>
                                            {!! $loanpaymentsdata['data']->date !!}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Transaction Status</td>
                                            <td>				                                @foreach ($loanpaymentsdata['transactionstatuses'] as $transactionstatuses)
				                                @if( $transactionstatuses->id  ==  $loanpaymentsdata['data']->transaction_status  )
				                                {!! $transactionstatuses->name!!}
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