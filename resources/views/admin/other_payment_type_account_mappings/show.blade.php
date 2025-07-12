@extends('admin.home')
@section('main_content')
		<div id="content" class="content">
    <ol class="breadcrumb pull-right">
        <li><a href="#">Home</a></li>
        <li><a href="#">public</a></li>
        <li><a href="#">Other Payment Type Account Mappings</a></li>
        <li class="active">form</li>
    </ol>
    <h1 class="page-header">Other Payment Type Account Mappings Form <small>other payment type account mappings details goes here...</small></h1>
    <div class="row">
        <div class="col-md-12">
            <a href="{!! route('otherpaymenttypeaccountmappings.index') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-arrow-left"></i></button></a>
        </div>
    </div>
            <div class="profile-container">
                <div class="profile-section">
                        <div class="profile-info">
                            <div class="table-responsive">
                                <table class="table table-profile">
                                    <thead>
                                    	<tr class="highlight">
                                    		<td>Other Payment Type Account Mappings</td>
                                    		<td>Profile Data</td>
                                    	</tr>
                                        <tr class="divider">
                                            <td colspan="2"></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="field">Other Payment Type</td>
                                            <td>				                                @foreach ($otherpaymenttypeaccountmappingsdata['otherpaymenttypes'] as $otherpaymenttypes)
				                                @if( $otherpaymenttypes->id  ==  $otherpaymenttypeaccountmappingsdata['data']->other_payment_type  )
				                                {!! $otherpaymenttypes->name!!}
				                                @endif
				                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Payment Mode</td>
                                            <td>				                                @foreach ($otherpaymenttypeaccountmappingsdata['paymentmodes'] as $paymentmodes)
				                                @if( $paymentmodes->id  ==  $otherpaymenttypeaccountmappingsdata['data']->payment_mode  )
				                                {!! $paymentmodes->name!!}
				                                @endif
				                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Debit Account</td>
                                            <td>				                                @foreach ($otherpaymenttypeaccountmappingsdata['accounts'] as $accounts)
				                                @if( $accounts->id  ==  $otherpaymenttypeaccountmappingsdata['data']->debit_account  )
				                                {!! $accounts->name!!}
				                                @endif
				                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Credit Account</td>
                                            <td>				                                @foreach ($otherpaymenttypeaccountmappingsdata['accounts'] as $accounts)
				                                @if( $accounts->id  ==  $otherpaymenttypeaccountmappingsdata['data']->credit_account  )
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