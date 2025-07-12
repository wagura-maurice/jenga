@extends('admin.home')
@section('main_content')
		<div id="content" class="content">
    <ol class="breadcrumb pull-right">
        <li><a href="#">Home</a></li>
        <li><a href="#">public</a></li>
        <li><a href="#">Client Exits</a></li>
        <li class="active">form</li>
    </ol>
    <h1 class="page-header">Client Exits Form <small>client exits details goes here...</small></h1>
    <div class="row">
        <div class="col-md-12">
            <a href="{!! route('clientexits.index') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-arrow-left"></i></button></a>
        </div>
    </div>
            <div class="profile-container">
                <div class="profile-section">
                        <div class="profile-info">
                            <div class="table-responsive">
                                <table class="table table-profile">
                                    <thead>
                                    	<tr class="highlight">
                                    		<td>Client Exits</td>
                                    		<td>Profile Data</td>
                                    	</tr>
                                        <tr class="divider">
                                            <td colspan="2"></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="field">Client</td>
                                            <td>				                                @foreach ($clientexitsdata['clients'] as $clients)
				                                @if( $clients->id  ==  $clientexitsdata['data']->client  )
				                                {!! $clients->client_number!!}
				                                {!! $clients->first_name!!}
				                                {!! $clients->middle_name!!}
				                                {!! $clients->last_name!!}
				                                @endif
				                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Request Date</td>
                                            <td>
                                            {!! $clientexitsdata['data']->request_date !!}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Approved Date</td>
                                            <td>
                                            {!! $clientexitsdata['data']->approved_date !!}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Initiated By</td>
                                            <td>				                                @foreach ($clientexitsdata['users'] as $users)
				                                @if( $users->id  ==  $clientexitsdata['data']->initiated_by  )
				                                {!! $users->name!!}
				                                @endif
				                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Reason</td>
                                            <td>
                                            {!! $clientexitsdata['data']->reason !!}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Remarks</td>
                                            <td>
                                            {!! $clientexitsdata['data']->remarks !!}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                </div>
            </div>
		</div>