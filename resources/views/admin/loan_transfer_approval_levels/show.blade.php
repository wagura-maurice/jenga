@extends('admin.home')
@section('main_content')
		<div id="content" class="content">
    <ol class="breadcrumb pull-right">
        <li><a href="#">Home</a></li>
        <li><a href="#">public</a></li>
        <li><a href="#">Loan Transfer Approval Levels</a></li>
        <li class="active">form</li>
    </ol>
    <h1 class="page-header">Loan Transfer Approval Levels Form <small>loan transfer approval levels details goes here...</small></h1>
    <div class="row">
        <div class="col-md-12">
            <a href="{!! route('loantransferapprovallevels.index') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-arrow-left"></i></button></a>
        </div>
    </div>
            <div class="profile-container">
                <div class="profile-section">
                        <div class="profile-info">
                            <div class="table-responsive">
                                <table class="table table-profile">
                                    <thead>
                                    	<tr class="highlight">
                                    		<td>Loan Transfer Approval Levels</td>
                                    		<td>Profile Data</td>
                                    	</tr>
                                        <tr class="divider">
                                            <td colspan="2"></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="field">Approval Level</td>
                                            <td>				                                @foreach ($loantransferapprovallevelsdata['approvallevels'] as $approvallevels)
				                                @if( $approvallevels->id  ==  $loantransferapprovallevelsdata['data']->approval_level  )
				                                {!! $approvallevels->name!!}
				                                @endif
				                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">User Account</td>
                                            <td>				                                @foreach ($loantransferapprovallevelsdata['usersaccounts'] as $usersaccounts)
				                                @if( $usersaccounts->id  ==  $loantransferapprovallevelsdata['data']->user_account  )
				                                {!! $usersaccounts->name!!}
				                                @endif
				                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Client Type</td>
                                            <td>				                                @foreach ($loantransferapprovallevelsdata['clienttypes'] as $clienttypes)
				                                @if( $clienttypes->id  ==  $loantransferapprovallevelsdata['data']->client_type  )
				                                {!! $clienttypes->name!!}
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