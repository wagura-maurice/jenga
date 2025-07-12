@extends('admin.home')
@section('main_content')
		<div id="content" class="content">
    <ol class="breadcrumb pull-right">
        <li><a href="#">Home</a></li>
        <li><a href="#">public</a></li>
        <li><a href="#">Loan Transfer Approvals</a></li>
        <li class="active">form</li>
    </ol>
    <h1 class="page-header">Loan Transfer Approvals Form <small>loan transfer approvals details goes here...</small></h1>
    <div class="row">
        <div class="col-md-12">
            <a href="{!! route('loantransferapprovals.index') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-arrow-left"></i></button></a>
        </div>
    </div>
            <div class="profile-container">
                <div class="profile-section">
                        <div class="profile-info">
                            <div class="table-responsive">
                                <table class="table table-profile">
                                    <thead>
                                    	<tr class="highlight">
                                    		<td>Loan Transfer Approvals</td>
                                    		<td>Profile Data</td>
                                    	</tr>
                                        <tr class="divider">
                                            <td colspan="2"></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="field">Loan Transfer</td>
                                            <td>				                                @foreach ($loantransferapprovalsdata['lgftoloantransfers'] as $lgftoloantransfers)
				                                @if( $lgftoloantransfers->id  ==  $loantransferapprovalsdata['data']->loan_transfer  )
				                                {!! $lgftoloantransfers->transaction_number!!}
				                                @endif
				                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Approval Level</td>
                                            <td>				                                @foreach ($loantransferapprovalsdata['approvallevels'] as $approvallevels)
				                                @if( $approvallevels->id  ==  $loantransferapprovalsdata['data']->approval_level  )
				                                {!! $approvallevels->name!!}
				                                @endif
				                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Approval Status</td>
                                            <td>				                                @foreach ($loantransferapprovalsdata['approvalstatuses'] as $approvalstatuses)
				                                @if( $approvalstatuses->id  ==  $loantransferapprovalsdata['data']->approval_status  )
				                                {!! $approvalstatuses->name!!}
				                                @endif
				                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Remarks</td>
                                            <td>
                                            {!! $loantransferapprovalsdata['data']->remarks !!}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Approved By</td>
                                            <td>				                                @foreach ($loantransferapprovalsdata['users'] as $users)
				                                @if( $users->id  ==  $loantransferapprovalsdata['data']->approved_by  )
				                                {!! $users->name!!}
				                                @endif
				                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Users_accounts</td>
                                            <td>				                                @foreach ($loantransferapprovalsdata['usersaccounts'] as $usersaccounts)
				                                @if( $usersaccounts->id  ==  $loantransferapprovalsdata['data']->users_accounts  )
				                                {!! $usersaccounts->name!!}
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