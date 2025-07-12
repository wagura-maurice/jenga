@extends('admin.home')
@section('main_content')
		<div id="content" class="content">
    <ol class="breadcrumb pull-right">
        <li><a href="#">Home</a></li>
        <li><a href="#">public</a></li>
        <li><a href="#">Group Client Roles</a></li>
        <li class="active">form</li>
    </ol>
    <h1 class="page-header">Group Client Roles Form <small>group client roles details goes here...</small></h1>
    <div class="row">
        <div class="col-md-12">
            <a href="{!! route('groupclientroles.index') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-arrow-left"></i></button></a>
        </div>
    </div>
            <div class="profile-container">
                <div class="profile-section">
                        <div class="profile-info">
                            <div class="table-responsive">
                                <table class="table table-profile">
                                    <thead>
                                    	<tr class="highlight">
                                    		<td>Group Client Roles</td>
                                    		<td>Profile Data</td>
                                    	</tr>
                                        <tr class="divider">
                                            <td colspan="2"></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="field">Client_group</td>
                                            <td>				                                @foreach ($groupclientrolesdata['groups'] as $groups)
				                                @if( $groups->id  ==  $groupclientrolesdata['data']->client_group  )
				                                {!! $groups->group_number!!}
				                                {!! $groups->group_name!!}
				                                </option>@endif
				                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Group_role</td>
                                            <td>				                                @foreach ($groupclientrolesdata['grouproles'] as $grouproles)
				                                @if( $grouproles->id  ==  $groupclientrolesdata['data']->group_role  )
				                                {!! $grouproles->name!!}
				                                </option>@endif
				                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Client</td>
                                            <td>				                                @foreach ($groupclientrolesdata['clients'] as $clients)
				                                @if( $clients->id  ==  $groupclientrolesdata['data']->client  )
				                                {!! $clients->client_number!!}
				                                {!! $clients->first_name!!}
				                                {!! $clients->middle_name!!}
				                                {!! $clients->last_name!!}
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