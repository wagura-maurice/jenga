@extends('admin.home')
@section('main_content')
		<div id="content" class="content">
    <ol class="breadcrumb pull-right">
        <li><a href="#">Home</a></li>
        <li><a href="#">public</a></li>
        <li><a href="#">Mobile Money Charge Scales</a></li>
        <li class="active">form</li>
    </ol>
    <h1 class="page-header">Mobile Money Charge Scales Form <small>mobile money charge scales details goes here...</small></h1>
    <div class="row">
        <div class="col-md-12">
            <a href="{!! route('mobilemoneychargescales.index') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-arrow-left"></i></button></a>
        </div>
    </div>
            <div class="profile-container">
                <div class="profile-section">
                        <div class="profile-info">
                            <div class="table-responsive">
                                <table class="table table-profile">
                                    <thead>
                                    	<tr class="highlight">
                                    		<td>Mobile Money Charge Scales</td>
                                    		<td>Profile Data</td>
                                    	</tr>
                                        <tr class="divider">
                                            <td colspan="2"></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="field">Mobile Money Charge</td>
                                            <td>				                                @foreach ($mobilemoneychargescalesdata['mobilemoneychargeconfigurations'] as $mobilemoneychargeconfigurations)
				                                @if( $mobilemoneychargeconfigurations->id  ==  $mobilemoneychargescalesdata['data']->mobile_money_charge  )
				                                {!! $mobilemoneychargeconfigurations->name!!}
				                                @endif
				                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Minimum Amount</td>
                                            <td>
                                            {!! $mobilemoneychargescalesdata['data']->minimum_amount !!}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Maximum Amount</td>
                                            <td>
                                            {!! $mobilemoneychargescalesdata['data']->maximum_amount !!}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Charge Type</td>
                                            <td>				                                @foreach ($mobilemoneychargescalesdata['feetypes'] as $feetypes)
				                                @if( $feetypes->id  ==  $mobilemoneychargescalesdata['data']->charge_type  )
				                                {!! $feetypes->name!!}
				                                @endif
				                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Charge</td>
                                            <td>
                                            {!! $mobilemoneychargescalesdata['data']->charge !!}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                </div>
            </div>
		</div>