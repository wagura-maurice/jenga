@extends('admin.home')
@section('main_content')
		<div id="content" class="content">
    <ol class="breadcrumb pull-right">
        <li><a href="#">Home</a></li>
        <li><a href="#">public</a></li>
        <li><a href="#">Client Lgf Contributions</a></li>
        <li class="active">form</li>
    </ol>
    <h1 class="page-header">Client Lgf Contributions Form <small>client lgf contributions details goes here...</small></h1>
    <div class="row">
        <div class="col-md-12">
            <a href="{!! route('clientlgfcontributions.index') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-arrow-left"></i></button></a>
        </div>
    </div>
            <div class="profile-container">
                <div class="profile-section">
                        <div class="profile-info">
                            <div class="table-responsive">
                                <table class="table table-profile">
                                    <thead>
                                    	<tr class="highlight">
                                    		<td>Client Lgf Contributions</td>
                                    		<td>Profile Data</td>
                                    	</tr>
                                        <tr class="divider">
                                            <td colspan="2"></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="field">Client</td>
                                            <td>				                                @foreach ($clientlgfcontributionsdata['clients'] as $clients)
				                                @if( $clients->id  ==  $clientlgfcontributionsdata['data']->client  )
				                                {!! $clients->client_number!!}
				                                {!! $clients->first_name!!}
				                                {!! $clients->middle_name!!}
				                                {!! $clients->last_name!!}
				                                </option>@endif
				                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Payment Mode</td>
                                            <td>				                                @foreach ($clientlgfcontributionsdata['paymentmodes'] as $paymentmodes)
				                                @if( $paymentmodes->id  ==  $clientlgfcontributionsdata['data']->payment_mode  )
				                                {!! $paymentmodes->name!!}
				                                </option>@endif
				                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Transaction Number</td>
                                            <td>
                                            {!! $clientlgfcontributionsdata['data']->transaction_number !!}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Date</td>
                                            <td>
                                            {!! $clientlgfcontributionsdata['data']->date !!}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Amount</td>
                                            <td>
                                            {!! $clientlgfcontributionsdata['data']->amount !!}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Transaction Status</td>
                                            <td>				                                @foreach ($clientlgfcontributionsdata['transactionstatuses'] as $transactionstatuses)
				                                @if( $transactionstatuses->id  ==  $clientlgfcontributionsdata['data']->transaction_status  )
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