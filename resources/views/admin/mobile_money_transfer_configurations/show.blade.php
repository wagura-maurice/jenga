@extends('admin.home')
@section('main_content')
		<div id="content" class="content">
    <ol class="breadcrumb pull-right">
        <li><a href="#">Home</a></li>
        <li><a href="#">public</a></li>
        <li><a href="#">Mobile Money Transfer Configurations</a></li>
        <li class="active">form</li>
    </ol>
    <h1 class="page-header">Mobile Money Transfer Configurations Form <small>mobile money transfer configurations details goes here...</small></h1>
    <div class="row">
        <div class="col-md-12">
            <a href="{!! route('mobilemoneytransferconfigurations.index') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-arrow-left"></i></button></a>
        </div>
    </div>
            <div class="profile-container">
                <div class="profile-section">
                        <div class="profile-info">
                            <div class="table-responsive">
                                <table class="table table-profile">
                                    <thead>
                                    	<tr class="highlight">
                                    		<td>Mobile Money Transfer Configurations</td>
                                    		<td>Profile Data</td>
                                    	</tr>
                                        <tr class="divider">
                                            <td colspan="2"></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="field">Client Type</td>
                                            <td>				                                @foreach ($mobilemoneytransferconfigurationsdata['clienttypes'] as $clienttypes)
				                                @if( $clienttypes->id  ==  $mobilemoneytransferconfigurationsdata['data']->client_type  )
				                                {!! $clienttypes->name!!}
				                                @endif
				                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Mobile Money Mode</td>
                                            <td>				                                @foreach ($mobilemoneytransferconfigurationsdata['mobilemoneymodes'] as $mobilemoneymodes)
				                                @if( $mobilemoneymodes->id  ==  $mobilemoneytransferconfigurationsdata['data']->mobile_money_mode  )
				                                {!! $mobilemoneymodes->name!!}
				                                @endif
				                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Debit Account</td>
                                            <td>				                                @foreach ($mobilemoneytransferconfigurationsdata['accounts'] as $accounts)
				                                @if( $accounts->id  ==  $mobilemoneytransferconfigurationsdata['data']->debit_account  )
				                                {!! $accounts->name!!}
				                                @endif
				                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Credit Account</td>
                                            <td>				                                @foreach ($mobilemoneytransferconfigurationsdata['accounts'] as $accounts)
				                                @if( $accounts->id  ==  $mobilemoneytransferconfigurationsdata['data']->credit_account  )
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