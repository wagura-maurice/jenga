@extends('admin.home')
@section('main_content')
		<div id="content" class="content">
    <ol class="breadcrumb pull-right">
        <li><a href="#">Home</a></li>
        <li><a href="#">public</a></li>
        <li><a href="#">Processing Fee Approvals</a></li>
        <li class="active">form</li>
    </ol>
    <h1 class="page-header">Processing Fee Approvals Form <small>processing fee approvals details goes here...</small></h1>
    <div class="row">
        <div class="col-md-12">
            <a href="{!! route('processingfeeapprovals.index') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-arrow-left"></i></button></a>
        </div>
    </div>
            <div class="profile-container">
                <div class="profile-section">
                        <div class="profile-info">
                            <div class="table-responsive">
                                <table class="table table-profile">
                                    <thead>
                                    	<tr class="highlight">
                                    		<td>Processing Fee Approvals</td>
                                    		<td>Profile Data</td>
                                    	</tr>
                                        <tr class="divider">
                                            <td colspan="2"></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="field">Transaction Reference</td>
                                            <td>				                                @foreach ($processingfeeapprovalsdata['processingfeepayments'] as $processingfeepayments)
				                                @if( $processingfeepayments->id  ==  $processingfeeapprovalsdata['data']->transaction_reference  )
				                                {!! $processingfeepayments->transaction_reference!!}
				                                @endif
				                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Approval Level</td>
                                            <td>				                                @foreach ($processingfeeapprovalsdata['approvallevels'] as $approvallevels)
				                                @if( $approvallevels->id  ==  $processingfeeapprovalsdata['data']->approval_level  )
				                                {!! $approvallevels->name!!}
				                                @endif
				                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Approved By</td>
                                            <td>				                                @foreach ($processingfeeapprovalsdata['users'] as $users)
				                                @if( $users->id  ==  $processingfeeapprovalsdata['data']->approved_by  )
				                                {!! $users->name!!}
				                                @endif
				                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Approval Status</td>
                                            <td>				                                @foreach ($processingfeeapprovalsdata['transactionstatuses'] as $transactionstatuses)
				                                @if( $transactionstatuses->id  ==  $processingfeeapprovalsdata['data']->approval_status  )
				                                {!! $transactionstatuses->name!!}
				                                @endif
				                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Date</td>
                                            <td>
                                            {!! $processingfeeapprovalsdata['data']->date !!}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                </div>
            </div>
		</div>