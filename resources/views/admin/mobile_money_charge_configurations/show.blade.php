@extends('admin.home')
@section('main_content')
		<div id="content" class="content">
    <ol class="breadcrumb pull-right">
        <li><a href="#">Home</a></li>
        <li><a href="#">public</a></li>
        <li><a href="#">Mobile Money Charge Configurations</a></li>
        <li class="active">form</li>
    </ol>
    <h1 class="page-header">Mobile Money Charge Configurations Form <small>mobile money charge configurations details goes here...</small></h1>
    <div class="row">
        <div class="col-md-12">
            <a href="{!! route('mobilemoneychargeconfigurations.index') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-arrow-left"></i></button></a>
        </div>
    </div>
            <div class="profile-container">
                <div class="profile-section">
                        <div class="profile-info">
                            <div class="table-responsive">
                                <table class="table table-profile">
                                    <thead>
                                    	<tr class="highlight">
                                    		<td>Mobile Money Charge Configurations</td>
                                    		<td>Profile Data</td>
                                    	</tr>
                                        <tr class="divider">
                                            <td colspan="2"></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="field">Client Type</td>
                                            <td>				                                @foreach ($mobilemoneychargeconfigurationsdata['clienttypes'] as $clienttypes)
				                                @if( $clienttypes->id  ==  $mobilemoneychargeconfigurationsdata['data']->client_type  )
				                                {!! $clienttypes->name!!}
				                                @endif
				                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Mobile Money Modes</td>
                                            <td>				                                @foreach ($mobilemoneychargeconfigurationsdata['mobilemoneymodes'] as $mobilemoneymodes)
				                                @if( $mobilemoneymodes->id  ==  $mobilemoneychargeconfigurationsdata['data']->mobile_money_modes  )
				                                {!! $mobilemoneymodes->name!!}
				                                @endif
				                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Charge Type</td>
                                            <td>				                                @foreach ($mobilemoneychargeconfigurationsdata['feetypes'] as $feetypes)
				                                @if( $feetypes->id  ==  $mobilemoneychargeconfigurationsdata['data']->charge_type  )
				                                {!! $feetypes->name!!}
				                                @endif
				                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Value</td>
                                            <td>
                                            {!! $mobilemoneychargeconfigurationsdata['data']->value !!}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                </div>
            </div>
		</div>