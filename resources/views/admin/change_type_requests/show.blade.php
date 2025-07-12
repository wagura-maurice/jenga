@extends('admin.home')
@section('main_content')
		<div id="content" class="content">
    <ol class="breadcrumb pull-right">
        <li><a href="#">Home</a></li>
        <li><a href="#">public</a></li>
        <li><a href="#">Change Type Requests</a></li>
        <li class="active">form</li>
    </ol>
    <h1 class="page-header">Change Type Requests Form <small>change type requests details goes here...</small></h1>
    <div class="row">
        <div class="col-md-12">
            <a href="{!! route('changetyperequests.index') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-arrow-left"></i></button></a>
        </div>
    </div>
            <div class="profile-container">
                <div class="profile-section">
                        <div class="profile-info">
                            <div class="table-responsive">
                                <table class="table table-profile">
                                    <thead>
                                    	<tr class="highlight">
                                    		<td>Change Type Requests</td>
                                    		<td>Profile Data</td>
                                    	</tr>
                                        <tr class="divider">
                                            <td colspan="2"></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="field">Client</td>
                                            <td>				                                @foreach ($changetyperequestsdata['clients'] as $clients)
				                                @if( $clients->id  ==  $changetyperequestsdata['data']->client  )
				                                {!! $clients->client_number!!}
				                                {!! $clients->first_name!!}
				                                {!! $clients->middle_name!!}
				                                {!! $clients->last_name!!}
				                                </option>@endif
				                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Current Type</td>
                                            <td>				                                @foreach ($changetyperequestsdata['clienttypes'] as $clienttypes)
				                                @if( $clienttypes->id  ==  $changetyperequestsdata['data']->current_type  )
				                                {!! $clienttypes->name!!}
				                                </option>@endif
				                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">New Type</td>
                                            <td>				                                @foreach ($changetyperequestsdata['clienttypes'] as $clienttypes)
				                                @if( $clienttypes->id  ==  $changetyperequestsdata['data']->new_type  )
				                                {!! $clienttypes->name!!}
				                                </option>@endif
				                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Date</td>
                                            <td>
                                            {!! $changetyperequestsdata['data']->date !!}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Comments</td>
                                            <td>
                                            {!! $changetyperequestsdata['data']->comments !!}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Status</td>
                                            <td>				                                @foreach ($changetyperequestsdata['changetyperequeststatuses'] as $changetyperequeststatuses)
				                                @if( $changetyperequeststatuses->id  ==  $changetyperequestsdata['data']->status  )
				                                {!! $changetyperequeststatuses->name!!}
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