@extends('admin.home')
@section('main_content')
		<div id="content" class="content">
    <ol class="breadcrumb pull-right">
        <li><a href="#">Home</a></li>
        <li><a href="#">public</a></li>
        <li><a href="#">General Ledgers</a></li>
        <li class="active">form</li>
    </ol>
    <h1 class="page-header">General Ledgers Form <small>general ledgers details goes here...</small></h1>
    <div class="row">
        <div class="col-md-12">
            <a href="{!! route('generalledgers.index') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-arrow-left"></i></button></a>
        </div>
    </div>
            <div class="profile-container">
                <div class="profile-section">
                        <div class="profile-info">
                            <div class="table-responsive">
                                <table class="table table-profile">
                                    <thead>
                                    	<tr class="highlight">
                                    		<td>General Ledgers</td>
                                    		<td>Profile Data</td>
                                    	</tr>
                                        <tr class="divider">
                                            <td colspan="2"></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="field">Account</td>
                                            <td>				                                @foreach ($generalledgersdata['accounts'] as $accounts)
				                                @if( $accounts->id  ==  $generalledgersdata['data']->account  )
				                                {!! $accounts->code!!}
				                                {!! $accounts->name!!}
				                                </option>@endif
				                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Entry Type</td>
                                            <td>				                                @foreach ($generalledgersdata['entrytypes'] as $entrytypes)
				                                @if( $entrytypes->id  ==  $generalledgersdata['data']->entry_type  )
				                                {!! $entrytypes->name!!}
				                                </option>@endif
				                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Transaction Number</td>
                                            <td>
                                            {!! $generalledgersdata['data']->transaction_number !!}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Amount</td>
                                            <td>
                                            {!! $generalledgersdata['data']->amount !!}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Date</td>
                                            <td>
                                            {!! $generalledgersdata['data']->date !!}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                </div>
            </div>
		</div>