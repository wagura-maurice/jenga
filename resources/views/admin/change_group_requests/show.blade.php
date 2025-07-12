@extends('admin.home')
@section('main_content')
		<div id="content" class="content">
    <ol class="breadcrumb pull-right">
        <li><a href="#">Home</a></li>
        <li><a href="#">public</a></li>
        <li><a href="#">Change Group Requests</a></li>
        <li class="active">form</li>
    </ol>
    <h1 class="page-header">Change Group Requests Form <small>change group requests details goes here...</small></h1>
    <div class="row">
        <div class="col-md-12">
            <a href="{!! route('changegrouprequests.index') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-arrow-left"></i></button></a>
        </div>
    </div>
            <div class="profile-container">
                <div class="profile-section">
                        <div class="profile-info">
                            <div class="table-responsive">
                                <table class="table table-profile">
                                    <thead>
                                    	<tr class="highlight">
                                    		<td>Change Group Requests</td>
                                    		<td>Profile Data</td>
                                    	</tr>
                                        <tr class="divider">
                                            <td colspan="2"></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="field">Client</td>
                                            <td>				                                @foreach ($changegrouprequestsdata['clients'] as $clients)
				                                @if( $clients->id  ==  $changegrouprequestsdata['data']->client  )
				                                {!! $clients->client_number!!}
				                                {!! $clients->first_name!!}
				                                {!! $clients->middle_name!!}
				                                {!! $clients->last_name!!}
				                                </option>@endif
				                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Current Group</td>
                                            <td>				                                @foreach ($changegrouprequestsdata['groups'] as $groups)
				                                @if( $groups->id  ==  $changegrouprequestsdata['data']->current_group  )
				                                {!! $groups->group_number!!}
				                                {!! $groups->group_name!!}
				                                </option>@endif
				                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">New Group</td>
                                            <td>				                                @foreach ($changegrouprequestsdata['groups'] as $groups)
				                                @if( $groups->id  ==  $changegrouprequestsdata['data']->new_group  )
				                                {!! $groups->group_number!!}
				                                {!! $groups->group_name!!}
				                                </option>@endif
				                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Date</td>
                                            <td>
                                            {!! $changegrouprequestsdata['data']->date !!}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Status</td>
                                            <td>				                                @foreach ($changegrouprequestsdata['changegrouprequeststatuses'] as $changegrouprequeststatuses)
				                                @if( $changegrouprequeststatuses->id  ==  $changegrouprequestsdata['data']->status  )
				                                {!! $changegrouprequeststatuses->name!!}
				                                </option>@endif
				                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Comments</td>
                                            <td>
                                            {!! $changegrouprequestsdata['data']->comments !!}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                </div>
            </div>
		</div>