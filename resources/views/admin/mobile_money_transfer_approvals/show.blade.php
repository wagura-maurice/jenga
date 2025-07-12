@extends('admin.home')
@section('main_content')
		<div id="content" class="content">
    <ol class="breadcrumb pull-right">
        <li><a href="#">Home</a></li>
        <li><a href="#">public</a></li>
        <li><a href="#">Mobile Money Transfer Approvals</a></li>
        <li class="active">form</li>
    </ol>
    <h1 class="page-header">Mobile Money Transfer Approvals Form <small>mobile money transfer approvals details goes here...</small></h1>
    <div class="row">
        <div class="col-md-12">
            <a href="{!! route('mobilemoneytransferapprovals.index') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-arrow-left"></i></button></a>
        </div>
    </div>
            <div class="profile-container">
                <div class="profile-section">
                        <div class="profile-info">
                            <div class="table-responsive">
                                <table class="table table-profile">
                                    <thead>
                                    	<tr class="highlight">
                                    		<td>Mobile Money Transfer Approvals</td>
                                    		<td>Profile Data</td>
                                    	</tr>
                                        <tr class="divider">
                                            <td colspan="2"></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="field">Mobile Money Transfer</td>
                                            <td>				                                @foreach ($mobilemoneytransferapprovalsdata['lgftomobilemoneytransfers'] as $lgftomobilemoneytransfers)
				                                @if( $lgftomobilemoneytransfers->id  ==  $mobilemoneytransferapprovalsdata['data']->mobile_money_transfer  )
				                                {!! $lgftomobilemoneytransfers->transaction_number!!}
				                                @endif
				                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Approval Level</td>
                                            <td>				                                @foreach ($mobilemoneytransferapprovalsdata['approvallevels'] as $approvallevels)
				                                @if( $approvallevels->id  ==  $mobilemoneytransferapprovalsdata['data']->approval_level  )
				                                {!! $approvallevels->name!!}
				                                @endif
				                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Approval Status</td>
                                            <td>				                                @foreach ($mobilemoneytransferapprovalsdata['approvalstatuses'] as $approvalstatuses)
				                                @if( $approvalstatuses->id  ==  $mobilemoneytransferapprovalsdata['data']->approval_status  )
				                                {!! $approvalstatuses->name!!}
				                                @endif
				                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Approved By</td>
                                            <td>				                                @foreach ($mobilemoneytransferapprovalsdata['users'] as $users)
				                                @if( $users->id  ==  $mobilemoneytransferapprovalsdata['data']->approved_by  )
				                                {!! $users->name!!}
				                                @endif
				                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">User Account</td>
                                            <td>				                                @foreach ($mobilemoneytransferapprovalsdata['usersaccounts'] as $usersaccounts)
				                                @if( $usersaccounts->id  ==  $mobilemoneytransferapprovalsdata['data']->user_account  )
				                                {!! $usersaccounts->name!!}
				                                @endif
				                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Remarks</td>
                                            <td>
                                            {!! $mobilemoneytransferapprovalsdata['data']->remarks !!}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                </div>
            </div>
		</div>