@extends('admin.home')
@section('main_content')
		<div id="content" class="content">
    <ol class="breadcrumb pull-right">
        <li><a href="#">Home</a></li>
        <li><a href="#">public</a></li>
        <li><a href="#">Account To Account Transfers</a></li>
        <li class="active">form</li>
    </ol>
    <h1 class="page-header">Account To Account Transfers Form <small>account to account transfers details goes here...</small></h1>
    <div class="row">
        <div class="col-md-12">
            <a href="{!! route('accounttoaccounttransfers.index') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-arrow-left"></i></button></a>
        </div>
    </div>
            <div class="profile-container">
                <div class="profile-section">
                        <div class="profile-info">
                            <div class="table-responsive">
                                <table class="table table-profile">
                                    <thead>
                                    	<tr class="highlight">
                                    		<td>Account To Account Transfers</td>
                                    		<td>Profile Data</td>
                                    	</tr>
                                        <tr class="divider">
                                            <td colspan="2"></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="field">Account From</td>
                                            <td>				                                @foreach ($accounttoaccounttransfersdata['accounts'] as $accounts)
				                                @if( $accounts->id  ==  $accounttoaccounttransfersdata['data']->account_from  )
				                                {!! $accounts->name!!}
				                                @endif
				                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Account To</td>
                                            <td>				                                @foreach ($accounttoaccounttransfersdata['accounts'] as $accounts)
				                                @if( $accounts->id  ==  $accounttoaccounttransfersdata['data']->account_to  )
				                                {!! $accounts->name!!}
				                                @endif
				                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Amount</td>
                                            <td>
                                            {!! $accounttoaccounttransfersdata['data']->amount !!}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Initiated By</td>
                                            <td>				                                @foreach ($accounttoaccounttransfersdata['users'] as $users)
				                                @if( $users->id  ==  $accounttoaccounttransfersdata['data']->initiated_by  )
				                                {!! $users->name!!}
				                                @endif
				                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Approval Status</td>
                                            <td>				                                @foreach ($accounttoaccounttransfersdata['approvalstatuses'] as $approvalstatuses)
				                                @if( $approvalstatuses->id  ==  $accounttoaccounttransfersdata['data']->approval_status  )
				                                {!! $approvalstatuses->name!!}
				                                @endif
				                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Transaction Date</td>
                                            <td>
                                            {!! $accounttoaccounttransfersdata['data']->transaction_date !!}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                </div>
            </div>
		</div>