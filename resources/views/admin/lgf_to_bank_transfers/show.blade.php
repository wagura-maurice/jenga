@extends('admin.home')
@section('main_content')
		<div id="content" class="content">
    <ol class="breadcrumb pull-right">
        <li><a href="#">Home</a></li>
        <li><a href="#">public</a></li>
        <li><a href="#">Lgf To Bank Transfers</a></li>
        <li class="active">form</li>
    </ol>
    <h1 class="page-header">Lgf To Bank Transfers Form <small>lgf to bank transfers details goes here...</small></h1>
    <div class="row">
        <div class="col-md-12">
            <a href="{!! route('lgftobanktransfers.index') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-arrow-left"></i></button></a>
        </div>
    </div>
            <div class="profile-container">
                <div class="profile-section">
                        <div class="profile-info">
                            <div class="table-responsive">
                                <table class="table table-profile">
                                    <thead>
                                    	<tr class="highlight">
                                    		<td>Lgf To Bank Transfers</td>
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
                                            {!! $lgftobanktransfersdata['data']->transaction_number !!}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Client</td>
                                            <td>				                                @foreach ($lgftobanktransfersdata['clients'] as $clients)
				                                @if( $clients->id  ==  $lgftobanktransfersdata['data']->client  )
				                                {!! $clients->client_number!!}
				                                {!! $clients->first_name!!}
				                                {!! $clients->middle_name!!}
				                                {!! $clients->last_name!!}
				                                @endif
				                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Bank</td>
                                            <td>				                                @foreach ($lgftobanktransfersdata['banks'] as $banks)
				                                @if( $banks->id  ==  $lgftobanktransfersdata['data']->bank  )
				                                {!! $banks->code!!}
				                                {!! $banks->name!!}
				                                @endif
				                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Bank Branch</td>
                                            <td>				                                @foreach ($lgftobanktransfersdata['bankbranches'] as $bankbranches)
				                                @if( $bankbranches->id  ==  $lgftobanktransfersdata['data']->bank_branch  )
				                                {!! $bankbranches->code!!}
				                                {!! $bankbranches->name!!}
				                                @endif
				                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Bank Account Number</td>
                                            <td>
                                            {!! $lgftobanktransfersdata['data']->bank_account_number !!}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Amount</td>
                                            <td>
                                            {!! $lgftobanktransfersdata['data']->amount !!}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Transaction Charge</td>
                                            <td>
                                            {!! $lgftobanktransfersdata['data']->transaction_charge !!}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Initiated By</td>
                                            <td>				                                @foreach ($lgftobanktransfersdata['users'] as $users)
				                                @if( $users->id  ==  $lgftobanktransfersdata['data']->initiated_by  )
				                                {!! $users->name!!}
				                                @endif
				                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Approval Status</td>
                                            <td>				                                @foreach ($lgftobanktransfersdata['approvalstatuses'] as $approvalstatuses)
				                                @if( $approvalstatuses->id  ==  $lgftobanktransfersdata['data']->approval_status  )
				                                {!! $approvalstatuses->name!!}
				                                @endif
				                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Transaction Date</td>
                                            <td>
                                            {!! $lgftobanktransfersdata['data']->transaction_date !!}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                </div>
            </div>
		</div>