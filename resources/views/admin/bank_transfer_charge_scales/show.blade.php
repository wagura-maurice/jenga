@extends('admin.home')
@section('main_content')
		<div id="content" class="content">
    <ol class="breadcrumb pull-right">
        <li><a href="#">Home</a></li>
        <li><a href="#">public</a></li>
        <li><a href="#">Bank Transfer Charge Scales</a></li>
        <li class="active">form</li>
    </ol>
    <h1 class="page-header">Bank Transfer Charge Scales Form <small>bank transfer charge scales details goes here...</small></h1>
    <div class="row">
        <div class="col-md-12">
            <a href="{!! route('banktransferchargescales.index') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-arrow-left"></i></button></a>
        </div>
    </div>
            <div class="profile-container">
                <div class="profile-section">
                        <div class="profile-info">
                            <div class="table-responsive">
                                <table class="table table-profile">
                                    <thead>
                                    	<tr class="highlight">
                                    		<td>Bank Transfer Charge Scales</td>
                                    		<td>Profile Data</td>
                                    	</tr>
                                        <tr class="divider">
                                            <td colspan="2"></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="field">Bank Transfer Charge</td>
                                            <td>				                                @foreach ($banktransferchargescalesdata['banktransfercharges'] as $banktransfercharges)
				                                @if( $banktransfercharges->id  ==  $banktransferchargescalesdata['data']->bank_transfer_charge  )
				                                {!! $banktransfercharges->name!!}
				                                @endif
				                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Minimum Amount</td>
                                            <td>
                                            {!! $banktransferchargescalesdata['data']->minimum_amount !!}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Maximum Amount</td>
                                            <td>
                                            {!! $banktransferchargescalesdata['data']->maximum_amount !!}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Charge Type</td>
                                            <td>				                                @foreach ($banktransferchargescalesdata['feetypes'] as $feetypes)
				                                @if( $feetypes->id  ==  $banktransferchargescalesdata['data']->charge_type  )
				                                {!! $feetypes->name!!}
				                                @endif
				                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Charge</td>
                                            <td>
                                            {!! $banktransferchargescalesdata['data']->charge !!}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                </div>
            </div>
		</div>