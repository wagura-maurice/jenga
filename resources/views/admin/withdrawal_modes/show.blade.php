@extends('admin.home')
@section('main_content')
		<div id="content" class="content">
    <ol class="breadcrumb pull-right">
        <li><a href="#">Home</a></li>
        <li><a href="#">public</a></li>
        <li><a href="#">Withdrawal Modes</a></li>
        <li class="active">form</li>
    </ol>
    <h1 class="page-header">Withdrawal Modes Form <small>withdrawal modes details goes here...</small></h1>
    <div class="row">
        <div class="col-md-12">
            <a href="{!! route('withdrawalmodes.index') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-arrow-left"></i></button></a>
        </div>
    </div>
            <div class="profile-container">
                <div class="profile-section">
                        <div class="profile-info">
                            <div class="table-responsive">
                                <table class="table table-profile">
                                    <thead>
                                    	<tr class="highlight">
                                    		<td>Withdrawal Modes</td>
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
                                            {!! $withdrawalmodesdata['data']->code !!}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Name</td>
                                            <td>
                                            {!! $withdrawalmodesdata['data']->name !!}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Transaction Gateway</td>
                                            <td>				                                @foreach ($withdrawalmodesdata['transactiongateways'] as $transactiongateways)
				                                @if( $transactiongateways->id  ==  $withdrawalmodesdata['data']->transaction_gateway  )
				                                {!! $transactiongateways->short_code!!}
				                                {!! $transactiongateways->name!!}
				                                @endif
				                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Settlement Account</td>
                                            <td>				                                @foreach ($withdrawalmodesdata['accounts'] as $accounts)
				                                @if( $accounts->id  ==  $withdrawalmodesdata['data']->settlement_account  )
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