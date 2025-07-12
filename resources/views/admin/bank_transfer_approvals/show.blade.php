@extends('admin.home')
@section('main_content')
		<div id="content" class="content">
    <ol class="breadcrumb pull-right">
        <li><a href="#">Home</a></li>
        <li><a href="#">public</a></li>
        <li><a href="#">Bank Transfer Approvals</a></li>
        <li class="active">form</li>
    </ol>
    <h1 class="page-header">Bank Transfer Approvals Form <small>bank transfer approvals details goes here...</small></h1>
    <div class="row">
        <div class="col-md-12">
            <a href="{!! route('banktransferapprovals.index') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-arrow-left"></i></button></a>
        </div>
    </div>
            <div class="profile-container">
                <div class="profile-section">
                        <div class="profile-info">
                            <div class="table-responsive">
                                <table class="table table-profile">
                                    <thead>
                                    	<tr class="highlight">
                                    		<td>Bank Transfer Approvals</td>
                                    		<td>Profile Data</td>
                                    	</tr>
                                        <tr class="divider">
                                            <td colspan="2"></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="field">Bank Transfer</td>
                                            <td>				                                @foreach ($banktransferapprovalsdata['lgftobanktransfers'] as $lgftobanktransfers)
				                                @if( $lgftobanktransfers->id  ==  $banktransferapprovalsdata['data']->bank_transfer  )
				                                {!! $lgftobanktransfers->transaction_number!!}
				                                @endif
				                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Approval Level</td>
                                            <td>				                                @foreach ($banktransferapprovalsdata['approvallevels'] as $approvallevels)
				                                @if( $approvallevels->id  ==  $banktransferapprovalsdata['data']->approval_level  )
				                                {!! $approvallevels->name!!}
				                                @endif
				                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Approval Status</td>
                                            <td>				                                @foreach ($banktransferapprovalsdata['approvalstatuses'] as $approvalstatuses)
				                                @if( $approvalstatuses->id  ==  $banktransferapprovalsdata['data']->approval_status  )
				                                {!! $approvalstatuses->name!!}
				                                @endif
				                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Approved By</td>
                                            <td>				                                @foreach ($banktransferapprovalsdata['users'] as $users)
				                                @if( $users->id  ==  $banktransferapprovalsdata['data']->approved_by  )
				                                {!! $users->name!!}
				                                @endif
				                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">User Account</td>
                                            <td>				                                @foreach ($banktransferapprovalsdata['usersaccounts'] as $usersaccounts)
				                                @if( $usersaccounts->id  ==  $banktransferapprovalsdata['data']->user_account  )
				                                {!! $usersaccounts->name!!}
				                                @endif
				                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Remarks</td>
                                            <td>
                                            {!! $banktransferapprovalsdata['data']->remarks !!}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                </div>
            </div>
		</div>