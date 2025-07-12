@extends('admin.home')
@section('main_content')
		<div id="content" class="content">
    <ol class="breadcrumb pull-right">
        <li><a href="#">Home</a></li>
        <li><a href="#">public</a></li>
        <li><a href="#">Insurance Deduction Approvals</a></li>
        <li class="active">form</li>
    </ol>
    <h1 class="page-header">Insurance Deduction Approvals Form <small>insurance deduction approvals details goes here...</small></h1>
    <div class="row">
        <div class="col-md-12">
            <a href="{!! route('insurancedeductionapprovals.index') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-arrow-left"></i></button></a>
        </div>
    </div>
            <div class="profile-container">
                <div class="profile-section">
                        <div class="profile-info">
                            <div class="table-responsive">
                                <table class="table table-profile">
                                    <thead>
                                    	<tr class="highlight">
                                    		<td>Insurance Deduction Approvals</td>
                                    		<td>Profile Data</td>
                                    	</tr>
                                        <tr class="divider">
                                            <td colspan="2"></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="field">Transaction Reference</td>
                                            <td>				                                @foreach ($insurancedeductionapprovalsdata['insurancedeductionpayments'] as $insurancedeductionpayments)
				                                @if( $insurancedeductionpayments->id  ==  $insurancedeductionapprovalsdata['data']->transaction_reference  )
				                                {!! $insurancedeductionpayments->transaction_reference!!}
				                                @endif
				                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Approval Level</td>
                                            <td>				                                @foreach ($insurancedeductionapprovalsdata['approvallevels'] as $approvallevels)
				                                @if( $approvallevels->id  ==  $insurancedeductionapprovalsdata['data']->approval_level  )
				                                {!! $approvallevels->name!!}
				                                @endif
				                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Approved By</td>
                                            <td>				                                @foreach ($insurancedeductionapprovalsdata['users'] as $users)
				                                @if( $users->id  ==  $insurancedeductionapprovalsdata['data']->approved_by  )
				                                {!! $users->name!!}
				                                @endif
				                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Approval Status</td>
                                            <td>				                                @foreach ($insurancedeductionapprovalsdata['transactionstatuses'] as $transactionstatuses)
				                                @if( $transactionstatuses->id  ==  $insurancedeductionapprovalsdata['data']->approval_status  )
				                                {!! $transactionstatuses->name!!}
				                                @endif
				                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Date</td>
                                            <td>
                                            {!! $insurancedeductionapprovalsdata['data']->date !!}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                </div>
            </div>
		</div>