@extends('admin.home')
@section('main_content')
		<div id="content" class="content">
    <ol class="breadcrumb pull-right">
        <li><a href="#">Home</a></li>
        <li><a href="#">public</a></li>
        <li><a href="#">Client Officers</a></li>
        <li class="active">form</li>
    </ol>
    <h1 class="page-header">Client Officers Form <small>client officers details goes here...</small></h1>
    <div class="row">
        <div class="col-md-12">
            <a href="{!! route('clientofficers.index') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-arrow-left"></i></button></a>
        </div>
    </div>
            <div class="profile-container">
                <div class="profile-section">
                        <div class="profile-info">
                            <div class="table-responsive">
                                <table class="table table-profile">
                                    <thead>
                                    	<tr class="highlight">
                                    		<td>Client Officers</td>
                                    		<td>Profile Data</td>
                                    	</tr>
                                        <tr class="divider">
                                            <td colspan="2"></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="field">Client</td>
                                            <td>				                                @foreach ($clientofficersdata['clients'] as $clients)
				                                @if( $clients->id  ==  $clientofficersdata['data']->client  )
				                                {!! $clients->client_number!!}
				                                {!! $clients->first_name!!}
				                                {!! $clients->middle_name!!}
				                                {!! $clients->last_name!!}
				                                </option>@endif
				                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Officer</td>
                                            <td>				                                @foreach ($clientofficersdata['employees'] as $employees)
				                                @if( $employees->id  ==  $clientofficersdata['data']->officer  )
				                                {!! $employees->employee_number!!}
				                                {!! $employees->first_name!!}
				                                {!! $employees->middle_name!!}
				                                {!! $employees->last_name!!}
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