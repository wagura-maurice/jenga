@extends('admin.home')
@section('main_content')
		<div id="content" class="content">
    <ol class="breadcrumb pull-right">
        <li><a href="#">Home</a></li>
        <li><a href="#">public</a></li>
        <li><a href="#">Lgf To Mobile Money Approval Levels</a></li>
        <li class="active">form</li>
    </ol>
    <h1 class="page-header">Lgf To Mobile Money Approval Levels Form <small>lgf to mobile money approval levels details goes here...</small></h1>
    <div class="row">
        <div class="col-md-12">
            <a href="{!! route('lgftomobilemoneyapprovallevels.index') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-arrow-left"></i></button></a>
        </div>
    </div>
            <div class="profile-container">
                <div class="profile-section">
                        <div class="profile-info">
                            <div class="table-responsive">
                                <table class="table table-profile">
                                    <thead>
                                    	<tr class="highlight">
                                    		<td>Lgf To Mobile Money Approval Levels</td>
                                    		<td>Profile Data</td>
                                    	</tr>
                                        <tr class="divider">
                                            <td colspan="2"></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="field">Client Type</td>
                                            <td>				                                @foreach ($lgftomobilemoneyapprovallevelsdata['clienttypes'] as $clienttypes)
				                                @if( $clienttypes->id  ==  $lgftomobilemoneyapprovallevelsdata['data']->client_type  )
				                                {!! $clienttypes->name!!}
				                                @endif
				                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Approval Level</td>
                                            <td>				                                @foreach ($lgftomobilemoneyapprovallevelsdata['approvallevels'] as $approvallevels)
				                                @if( $approvallevels->id  ==  $lgftomobilemoneyapprovallevelsdata['data']->approval_level  )
				                                {!! $approvallevels->name!!}
				                                @endif
				                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">User Account</td>
                                            <td>				                                @foreach ($lgftomobilemoneyapprovallevelsdata['usersaccounts'] as $usersaccounts)
				                                @if( $usersaccounts->id  ==  $lgftomobilemoneyapprovallevelsdata['data']->user_account  )
				                                {!! $usersaccounts->name!!}
				                                @endif
				                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Approved By</td>
                                            <td>				                                @foreach ($lgftomobilemoneyapprovallevelsdata['users'] as $users)
				                                @if( $users->id  ==  $lgftomobilemoneyapprovallevelsdata['data']->approved_by  )
				                                {!! $users->name!!}
				                                @endif
				                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Approval Status</td>
                                            <td>				                                @foreach ($lgftomobilemoneyapprovallevelsdata['approvalstatuses'] as $approvalstatuses)
				                                @if( $approvalstatuses->id  ==  $lgftomobilemoneyapprovallevelsdata['data']->approval_status  )
				                                {!! $approvalstatuses->name!!}
				                                @endif
				                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Remarks</td>
                                            <td>
                                            {!! $lgftomobilemoneyapprovallevelsdata['data']->remarks !!}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                </div>
            </div>
		</div>