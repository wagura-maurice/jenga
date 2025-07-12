@extends('admin.home')
@section('main_content')
		<div id="content" class="content">
    <ol class="breadcrumb pull-right">
        <li><a href="#">Home</a></li>
        <li><a href="#">public</a></li>
        <li><a href="#">Clearing Fee Approvals</a></li>
        <li class="active">form</li>
    </ol>
    <h1 class="page-header">Clearing Fee Approvals Form <small>clearing fee approvals details goes here...</small></h1>
    <div class="row">
        <div class="col-md-12">
            <a href="{!! route('clearingfeeapprovals.index') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-arrow-left"></i></button></a>
        </div>
    </div>
            <div class="profile-container">
                <div class="profile-section">
                        <div class="profile-info">
                            <div class="table-responsive">
                                <table class="table table-profile">
                                    <thead>
                                    	<tr class="highlight">
                                    		<td>Clearing Fee Approvals</td>
                                    		<td>Profile Data</td>
                                    	</tr>
                                        <tr class="divider">
                                            <td colspan="2"></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="field">Transaction Reference</td>
                                            <td>				                                @foreach ($clearingfeeapprovalsdata['clearingfeepayments'] as $clearingfeepayments)
				                                @if( $clearingfeepayments->id  ==  $clearingfeeapprovalsdata['data']->transaction_reference  )
				                                {!! $clearingfeepayments->transaction_reference!!}
				                                @endif
				                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Approval Level</td>
                                            <td>				                                @foreach ($clearingfeeapprovalsdata['approvallevels'] as $approvallevels)
				                                @if( $approvallevels->id  ==  $clearingfeeapprovalsdata['data']->approval_level  )
				                                {!! $approvallevels->name!!}
				                                @endif
				                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Approved By</td>
                                            <td>				                                @foreach ($clearingfeeapprovalsdata['users'] as $users)
				                                @if( $users->id  ==  $clearingfeeapprovalsdata['data']->approved_by  )
				                                {!! $users->name!!}
				                                @endif
				                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Approval Status</td>
                                            <td>				                                @foreach ($clearingfeeapprovalsdata['transactionstatuses'] as $transactionstatuses)
				                                @if( $transactionstatuses->id  ==  $clearingfeeapprovalsdata['data']->approval_status  )
				                                {!! $transactionstatuses->name!!}
				                                @endif
				                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Date</td>
                                            <td>
                                            {!! $clearingfeeapprovalsdata['data']->date !!}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                </div>
            </div>
		</div>