@extends('admin.home')
@section('main_content')
		<div id="content" class="content">
    <ol class="breadcrumb pull-right">
        <li><a href="#">Home</a></li>
        <li><a href="#">public</a></li>
        <li><a href="#">Processing Fee Payments</a></li>
        <li class="active">form</li>
    </ol>
    <h1 class="page-header">Processing Fee Payments Form <small>processing fee payments details goes here...</small></h1>
    <div class="row">
        <div class="col-md-12">
            <a href="{!! route('processingfeepayments.index') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-arrow-left"></i></button></a>
        </div>
    </div>
            <div class="profile-container">
                <div class="profile-section">
                        <div class="profile-info">
                            <div class="table-responsive">
                                <table class="table table-profile">
                                    <thead>
                                    	<tr class="highlight">
                                    		<td>Processing Fee Payments</td>
                                    		<td>Profile Data</td>
                                    	</tr>
                                        <tr class="divider">
                                            <td colspan="2"></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="field">Loan Number</td>
                                            <td>				                                @foreach ($processingfeepaymentsdata['loans'] as $loans)
				                                @if( $loans->id  ==  $processingfeepaymentsdata['data']->loan_number  )
				                                {!! $loans->loan_number!!}
				                                @endif
				                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Payment Mode</td>
                                            <td>				                                @foreach ($processingfeepaymentsdata['paymentmodes'] as $paymentmodes)
				                                @if( $paymentmodes->id  ==  $processingfeepaymentsdata['data']->payment_mode  )
				                                {!! $paymentmodes->name!!}
				                                @endif
				                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Transaction Number</td>
                                            <td>
                                            {!! $processingfeepaymentsdata['data']->transaction_number !!}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Amount</td>
                                            <td>
                                            {!! $processingfeepaymentsdata['data']->amount !!}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Date</td>
                                            <td>
                                            {!! $processingfeepaymentsdata['data']->date !!}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Transaction Status</td>
                                            <td>				                                @foreach ($processingfeepaymentsdata['transactionstatuses'] as $transactionstatuses)
				                                @if( $transactionstatuses->id  ==  $processingfeepaymentsdata['data']->transaction_status  )
				                                {!! $transactionstatuses->name!!}
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