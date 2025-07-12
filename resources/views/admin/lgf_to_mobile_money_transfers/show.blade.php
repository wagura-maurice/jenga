@extends('admin.home')
@section('main_content')
		<div id="content" class="content">
    <ol class="breadcrumb pull-right">
        <li><a href="#">Home</a></li>
        <li><a href="#">public</a></li>
        <li><a href="#">Lgf To Mobile Money Transfers</a></li>
        <li class="active">form</li>
    </ol>
    <h1 class="page-header">Lgf To Mobile Money Transfers Form <small>lgf to mobile money transfers details goes here...</small></h1>
    <div class="row">
        <div class="col-md-12">
            <a href="{!! route('lgftomobilemoneytransfers.index') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-arrow-left"></i></button></a>
        </div>
    </div>
            <div class="profile-container">
                <div class="profile-section">
                        <div class="profile-info">
                            <div class="table-responsive">
                                <table class="table table-profile">
                                    <thead>
                                    	<tr class="highlight">
                                    		<td>Lgf To Mobile Money Transfers</td>
                                    		<td>Profile Data</td>
                                    	</tr>
                                        <tr class="divider">
                                            <td colspan="2"></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="field">Transaction Number</td>
                                            <td>
                                            {!! $lgftomobilemoneytransfersdata['data']->transaction_number !!}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Client</td>
                                            <td>				                                @foreach ($lgftomobilemoneytransfersdata['clients'] as $clients)
				                                @if( $clients->id  ==  $lgftomobilemoneytransfersdata['data']->client  )
				                                {!! $clients->client_number!!}
				                                {!! $clients->first_name!!}
				                                {!! $clients->middle_name!!}
				                                {!! $clients->last_name!!}
				                                @endif
				                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">To Other Number</td>
                                            <td>
                                            {!! $lgftomobilemoneytransfersdata['data']->to_other_number !!}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Other Phone Number</td>
                                            <td>
                                            {!! $lgftomobilemoneytransfersdata['data']->other_phone_number !!}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Amount</td>
                                            <td>
                                            {!! $lgftomobilemoneytransfersdata['data']->amount !!}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Initiated By</td>
                                            <td>				                                @foreach ($lgftomobilemoneytransfersdata['users'] as $users)
				                                @if( $users->id  ==  $lgftomobilemoneytransfersdata['data']->initiated_by  )
				                                {!! $users->name!!}
				                                @endif
				                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Transaction Date</td>
                                            <td>
                                            {!! $lgftomobilemoneytransfersdata['data']->transaction_date !!}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Approval Status</td>
                                            <td>				                                @foreach ($lgftomobilemoneytransfersdata['approvalstatuses'] as $approvalstatuses)
				                                @if( $approvalstatuses->id  ==  $lgftomobilemoneytransfersdata['data']->approval_status  )
				                                {!! $approvalstatuses->name!!}
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