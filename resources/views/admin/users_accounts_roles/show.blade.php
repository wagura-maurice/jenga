@extends('admin.home')
@section('main_content')
		<div id="content" class="content">
    <ol class="breadcrumb pull-right">
        <li><a href="#">Home</a></li>
        <li><a href="#">public</a></li>
        <li><a href="#">Users Accounts Roles</a></li>
        <li class="active">form</li>
    </ol>
    <h1 class="page-header">Users Accounts Roles Form <small>users accounts roles details goes here...</small></h1>
    <div class="row">
        <div class="col-md-12">
            <a href="{!! route('usersaccountsroles.index') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-arrow-left"></i></button></a>
        </div>
    </div>
            <div class="profile-container">
                <div class="profile-section">
                        <div class="profile-info">
                            <div class="table-responsive">
                                <table class="table table-profile">
                                    <thead>
                                    	<tr class="highlight">
                                    		<td>Users Accounts Roles</td>
                                    		<td>Profile Data</td>
                                    	</tr>
                                        <tr class="divider">
                                            <td colspan="2"></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="field">User Account</td>
                                            <td>				                                @foreach ($usersaccountsrolesdata['usersaccounts'] as $usersaccounts)
				                                @if( $usersaccounts->id  ==  $usersaccountsrolesdata['data']->user_account  ){
				                                {!! $usersaccounts->name!!}
				                                </option>@endif
				                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Module</td>
                                            <td>				                                @foreach ($usersaccountsrolesdata['modules'] as $modules)
				                                @if( $modules->id  ==  $usersaccountsrolesdata['data']->module  ){
				                                {!! $modules->name!!}
				                                </option>@endif
				                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">_add</td>
                                            <td>
                                            {!! $usersaccountsrolesdata['data']->_add !!}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">_list</td>
                                            <td>
                                            {!! $usersaccountsrolesdata['data']->_list !!}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">_edit</td>
                                            <td>
                                            {!! $usersaccountsrolesdata['data']->_edit !!}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">_delete</td>
                                            <td>
                                            {!! $usersaccountsrolesdata['data']->_delete !!}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">_show</td>
                                            <td>
                                            {!! $usersaccountsrolesdata['data']->_show !!}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">_report</td>
                                            <td>
                                            {!! $usersaccountsrolesdata['data']->_report !!}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                </div>
            </div>
		</div>