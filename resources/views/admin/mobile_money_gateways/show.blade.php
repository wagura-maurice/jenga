@extends('admin.home')
@section('main_content')
		<div id="content" class="content">
    <ol class="breadcrumb pull-right">
        <li><a href="#">Home</a></li>
        <li><a href="#">public</a></li>
        <li><a href="#">Mobile Money Gateways</a></li>
        <li class="active">form</li>
    </ol>
    <h1 class="page-header">Mobile Money Gateways Form <small>mobile money gateways details goes here...</small></h1>
    <div class="row">
        <div class="col-md-12">
            <a href="{!! route('mobilemoneygateways.index') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-arrow-left"></i></button></a>
        </div>
    </div>
            <div class="profile-container">
                <div class="profile-section">
                        <div class="profile-info">
                            <div class="table-responsive">
                                <table class="table table-profile">
                                    <thead>
                                    	<tr class="highlight">
                                    		<td>Mobile Money Gateways</td>
                                    		<td>Profile Data</td>
                                    	</tr>
                                        <tr class="divider">
                                            <td colspan="2"></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="field">Name</td>
                                            <td>
                                            {!! $mobilemoneygatewaysdata['data']->name !!}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Short Code</td>
                                            <td>
                                            {!! $mobilemoneygatewaysdata['data']->short_code !!}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Settlement Account</td>
                                            <td>				                                @foreach ($mobilemoneygatewaysdata['accounts'] as $accounts)
				                                @if( $accounts->id  ==  $mobilemoneygatewaysdata['data']->settlement_account  )
				                                {!! $accounts->name!!}
				                                @endif
				                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Queue Time Out Url</td>
                                            <td>
                                            {!! $mobilemoneygatewaysdata['data']->queue_time_out_url !!}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Result Url</td>
                                            <td>
                                            {!! $mobilemoneygatewaysdata['data']->result_url !!}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Call Back Url</td>
                                            <td>
                                            {!! $mobilemoneygatewaysdata['data']->call_back_url !!}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Pass Key</td>
                                            <td>
                                            {!! $mobilemoneygatewaysdata['data']->pass_key !!}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                </div>
            </div>
		</div>