@extends('admin.home')
@section('main_content')
		<div id="content" class="content">
    <ol class="breadcrumb pull-right">
        <li><a href="#">Home</a></li>
        <li><a href="#">public</a></li>
        <li><a href="#">Sub Accounts</a></li>
        <li class="active">form</li>
    </ol>
    <h1 class="page-header">Sub Accounts Form <small>sub accounts details goes here...</small></h1>
    <div class="row">
        <div class="col-md-12">
            <a href="{!! route('subaccounts.index') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-arrow-left"></i></button></a>
        </div>
    </div>
            <div class="profile-container">
                <div class="profile-section">
                        <div class="profile-info">
                            <div class="table-responsive">
                                <table class="table table-profile">
                                    <thead>
                                    	<tr class="highlight">
                                    		<td>Sub Accounts</td>
                                    		<td>Profile Data</td>
                                    	</tr>
                                        <tr class="divider">
                                            <td colspan="2"></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="field">Account</td>
                                            <td>				                                @foreach ($subaccountsdata['accounts'] as $accounts)
				                                @if( $accounts->id  ==  $subaccountsdata['data']->account  )
				                                {!! $accounts->code!!}
				                                {!! $accounts->name!!}
				                                </option>@endif
				                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Sub Account</td>
                                            <td>				                                @foreach ($subaccountsdata['accounts'] as $accounts)
				                                @if( $accounts->id  ==  $subaccountsdata['data']->sub_account  )
				                                {!! $accounts->code!!}
				                                {!! $accounts->name!!}
				                                </option>@endif
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