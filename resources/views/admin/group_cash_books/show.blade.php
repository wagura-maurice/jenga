@extends('admin.home')
@section('main_content')
		<div id="content" class="content">
    <ol class="breadcrumb pull-right">
        <li><a href="#">Home</a></li>
        <li><a href="#">public</a></li>
        <li><a href="#">Group Cash Books</a></li>
        <li class="active">form</li>
    </ol>
    <h1 class="page-header">Group Cash Books Form <small>group cash books details goes here...</small></h1>
    <div class="row">
        <div class="col-md-12">
            <a href="{!! route('groupcashbooks.index') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-arrow-left"></i></button></a>
        </div>
    </div>
            <div class="profile-container">
                <div class="profile-section">
                        <div class="profile-info">
                            <div class="table-responsive">
                                <table class="table table-profile">
                                    <thead>
                                    	<tr class="highlight">
                                    		<td>Group Cash Books</td>
                                    		<td>Profile Data</td>
                                    	</tr>
                                        <tr class="divider">
                                            <td colspan="2"></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="field">Transaction Id</td>
                                            <td>
                                            {!! $groupcashbooksdata['data']->transaction_id !!}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Group</td>
                                            <td>				                                @foreach ($groupcashbooksdata['groups'] as $groups)
				                                @if( $groups->id  ==  $groupcashbooksdata['data']->group  )
				                                {!! $groups->group_code!!}
				                                {!! $groups->group_name!!}
				                                @endif
				                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Transaction Date</td>
                                            <td>
                                            {!! $groupcashbooksdata['data']->transaction_date !!}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Transaction Reference</td>
                                            <td>
                                            {!! $groupcashbooksdata['data']->transaction_reference !!}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Transaction Type</td>
                                            <td>
                                            {!! $groupcashbooksdata['data']->transaction_type !!}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Amount</td>
                                            <td>
                                            {!! $groupcashbooksdata['data']->amount !!}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Payment Mode</td>
                                            <td>				                                @foreach ($groupcashbooksdata['paymentmodes'] as $paymentmodes)
				                                @if( $paymentmodes->id  ==  $groupcashbooksdata['data']->payment_mode  )
				                                {!! $paymentmodes->code!!}
				                                {!! $paymentmodes->name!!}
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