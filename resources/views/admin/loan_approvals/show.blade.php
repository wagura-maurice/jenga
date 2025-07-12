@extends('admin.home')
@section('main_content')
		<div id="content" class="content">
    <ol class="breadcrumb pull-right">
        <li><a href="#">Home</a></li>
        <li><a href="#">public</a></li>
        <li><a href="#">Loan Approvals</a></li>
        <li class="active">form</li>
    </ol>
    <h1 class="page-header">Loan Approvals Form <small>loan approvals details goes here...</small></h1>
    <div class="row">
        <div class="col-md-12">
            <a href="{!! route('loanapprovals.index') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-arrow-left"></i></button></a>
        </div>
    </div>
            <div class="profile-container">
                <div class="profile-section">
                        <div class="profile-info">
                            <div class="table-responsive">
                                <table class="table table-profile">
                                    <thead>
                                    	<tr class="highlight">
                                    		<td>Loan Approvals</td>
                                    		<td>Profile Data</td>
                                    	</tr>
                                        <tr class="divider">
                                            <td colspan="2"></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="field">Loan</td>
                                            <td>				                                @foreach ($loanapprovalsdata['loans'] as $loans)
				                                @if( $loans->id  ==  $loanapprovalsdata['data']->loan  )
				                                {!! $loans->loan_number!!}
				                                </option>@endif
				                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Level</td>
                                            <td>				                                @foreach ($loanapprovalsdata['approvallevels'] as $approvallevels)
				                                @if( $approvallevels->id  ==  $loanapprovalsdata['data']->level  )
				                                {!! $approvallevels->name!!}
				                                </option>@endif
				                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">User Account</td>
                                            <td>				                                @foreach ($loanapprovalsdata['usersaccounts'] as $usersaccounts)
				                                @if( $usersaccounts->id  ==  $loanapprovalsdata['data']->user_account  )
				                                {!! $usersaccounts->name!!}
				                                </option>@endif
				                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">User</td>
                                            <td>				                                @foreach ($loanapprovalsdata['users'] as $users)
				                                @if( $users->id  ==  $loanapprovalsdata['data']->user  )
				                                {!! $users->name!!}
				                                </option>@endif
				                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Date</td>
                                            <td>
                                            {!! $loanapprovalsdata['data']->date !!}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Status</td>
                                            <td>				                                @foreach ($loanapprovalsdata['approvalstatuses'] as $approvalstatuses)
				                                @if( $approvalstatuses->id  ==  $loanapprovalsdata['data']->status  )
				                                {!! $approvalstatuses->name!!}
				                                </option>@endif
				                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Comment</td>
                                            <td>
                                            {!! $loanapprovalsdata['data']->comment !!}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                </div>
            </div>
		</div>