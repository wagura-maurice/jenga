@extends('admin.home')
@section('main_content')
		<div id="content" class="content">
    <ol class="breadcrumb pull-right">
        <li><a href="#">Home</a></li>
        <li><a href="#">public</a></li>
        <li><a href="#">Mobile Money Transaction Charge Configurations</a></li>
        <li class="active">form</li>
    </ol>
    <h1 class="page-header">Mobile Money Transaction Charge Configurations Form <small>mobile money transaction charge configurations details goes here...</small></h1>
    <div class="row">
        <div class="col-md-12">
            <a href="{!! route('mobilemoneytransactionchargeconfigurations.index') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-arrow-left"></i></button></a>
        </div>
    </div>
            <div class="profile-container">
                <div class="profile-section">
                        <div class="profile-info">
                            <div class="table-responsive">
                                <table class="table table-profile">
                                    <thead>
                                    	<tr class="highlight">
                                    		<td>Mobile Money Transaction Charge Configurations</td>
                                    		<td>Profile Data</td>
                                    	</tr>
                                        <tr class="divider">
                                            <td colspan="2"></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="field">Client Type</td>
                                            <td>				                                @foreach ($mobilemoneytransactionchargeconfigurationsdata['clienttypes'] as $clienttypes)
				                                @if( $clienttypes->id  ==  $mobilemoneytransactionchargeconfigurationsdata['data']->client_type  )
				                                {!! $clienttypes->name!!}
				                                @endif
				                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Mobile Money Mode</td>
                                            <td>				                                @foreach ($mobilemoneytransactionchargeconfigurationsdata['mobilemoneymodes'] as $mobilemoneymodes)
				                                @if( $mobilemoneymodes->id  ==  $mobilemoneytransactionchargeconfigurationsdata['data']->mobile_money_mode  )
				                                {!! $mobilemoneymodes->name!!}
				                                @endif
				                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Debit Account</td>
                                            <td>				                                @foreach ($mobilemoneytransactionchargeconfigurationsdata['accounts'] as $accounts)
				                                @if( $accounts->id  ==  $mobilemoneytransactionchargeconfigurationsdata['data']->debit_account  )
				                                {!! $accounts->name!!}
				                                @endif
				                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Credit Account</td>
                                            <td>				                                @foreach ($mobilemoneytransactionchargeconfigurationsdata['accounts'] as $accounts)
				                                @if( $accounts->id  ==  $mobilemoneytransactionchargeconfigurationsdata['data']->credit_account  )
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