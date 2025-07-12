@extends('admin.home')
@section('main_content')
		<div id="content" class="content">
    <ol class="breadcrumb pull-right">
        <li><a href="#">Home</a></li>
        <li><a href="#">public</a></li>
        <li><a href="#">Lgf Contribution Configurations</a></li>
        <li class="active">form</li>
    </ol>
    <h1 class="page-header">Lgf Contribution Configurations Form <small>lgf contribution configurations details goes here...</small></h1>
    <div class="row">
        <div class="col-md-12">
            <a href="{!! route('lgfcontributionconfigurations.index') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-arrow-left"></i></button></a>
        </div>
    </div>
            <div class="profile-container">
                <div class="profile-section">
                        <div class="profile-info">
                            <div class="table-responsive">
                                <table class="table table-profile">
                                    <thead>
                                    	<tr class="highlight">
                                    		<td>Lgf Contribution Configurations</td>
                                    		<td>Profile Data</td>
                                    	</tr>
                                        <tr class="divider">
                                            <td colspan="2"></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="field">Client Type</td>
                                            <td>				                                @foreach ($lgfcontributionconfigurationsdata['clienttypes'] as $clienttypes)
				                                @if( $clienttypes->id  ==  $lgfcontributionconfigurationsdata['data']->client_type  )
				                                {!! $clienttypes->name!!}
				                                </option>@endif
				                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Payment Mode</td>
                                            <td>				                                @foreach ($lgfcontributionconfigurationsdata['paymentmodes'] as $paymentmodes)
				                                @if( $paymentmodes->id  ==  $lgfcontributionconfigurationsdata['data']->payment_mode  )
				                                {!! $paymentmodes->name!!}
				                                </option>@endif
				                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Debit Account</td>
                                            <td>				                                @foreach ($lgfcontributionconfigurationsdata['accounts'] as $accounts)
				                                @if( $accounts->id  ==  $lgfcontributionconfigurationsdata['data']->debit_account  )
				                                {!! $accounts->code!!}
				                                {!! $accounts->name!!}
				                                </option>@endif
				                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Credit Account</td>
                                            <td>				                                @foreach ($lgfcontributionconfigurationsdata['accounts'] as $accounts)
				                                @if( $accounts->id  ==  $lgfcontributionconfigurationsdata['data']->credit_account  )
				                                {!! $accounts->code!!}
				                                {!! $accounts->name!!}
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