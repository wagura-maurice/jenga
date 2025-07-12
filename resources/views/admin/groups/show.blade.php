@extends('admin.home')
@section('stylesheet')
    <!-- <link rel="stylesheet" href="https://cdn.rawgit.com/openlayers/openlayers.github.io/master/en/v5.3.0/css/ol.css" type="text/css"> -->
@endsection
@section('main_content')
<div id="content" class="content">
    <h1 class="page-header">Groups Form <small>groups details goes here...</small></h1>
    <div class="row">
        <div class="col-md-12">
            <a href="{!! route('groups.index') !!}"><button type="button"
                    class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-arrow-left"></i></button></a>
        </div>
    </div>
    <!-- <div class="profile-container">
        <div class="profile-section">
            <div class="profile-info">
                <div class="table-responsive">
                    <table class="table table-profile">
                        <thead>
                            <tr class="highlight">
                                <td>Groups</td>
                                <td>Profile Data</td>
                            </tr>
                            <tr class="divider">
                                <td colspan="2"></td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="field">Group Number</td>
                                <td>
                                    {!! $groupsdata['data']->group_number !!}
                                </td>
                            </tr>
                            <tr>
                                <td class="field">Group Name</td>
                                <td>
                                    {!! $groupsdata['data']->group_name !!}
                                </td>
                            </tr>
                            <tr>
                                <td class="field">Meeting Day</td>
                                <td>
                                    @foreach ($groupsdata['days'] as $days)
                                    @if ($days->id == $groupsdata['data']->meeting_day)
                                    {!! $days->name !!}
                                    @endif
                                    @endforeach
                                </td>
                            </tr>
                            <tr>
                                <td class="field">Meeting Time</td>
                                <td>
                                    {!! $groupsdata['data']->meeting_time !!}
                                </td>
                            </tr>
                            <tr>
                                <td class="field">Meeting Frequency</td>
                                <td>
                                    @foreach ($groupsdata['meetingfrequencies'] as $meetingfrequencies)
                                    @if ($meetingfrequencies->id == $groupsdata['data']->meeting_frequency)
                                    {!! $meetingfrequencies->name !!}
                                    @endif
                                    @endforeach
                                </td>
                            </tr>
                            <tr>
                                <td class="field">Preferred Mode Of Banking</td>
                                <td>
                                    @foreach ($groupsdata['bankingmodes'] as $bankingmodes)
                                    @if ($bankingmodes->id == $groupsdata['data']->preferred_mode_of_banking)
                                    {!! $bankingmodes->name !!}
                                    @endif
                                    @endforeach
                                </td>
                            </tr>
                            <tr>
                                <td class="field">Registration Date</td>
                                <td>
                                    {!! $groupsdata['data']->registration_date !!}
                                </td>
                            </tr>
                            <tr>
                                <td class="field">Group Formation Date</td>
                                <td>
                                    {!! $groupsdata['data']->group_formation_date !!}
                                </td>
                            </tr>
                            <tr>
                                <td class="field">Officer</td>
                                <td>
                                    @foreach ($groupsdata['employees'] as $employees)
                                    @if ($employees->id == $groupsdata['data']->officer)
                                    {!! $employees->employee_number !!}
                                    {!! $employees->first_name !!}
                                    {!! $employees->middle_name !!}
                                    {!! $employees->last_name !!}
                                    @endif
                                    @endforeach
                                </td>
                            </tr>
                            <tr>
                                <td class="field">Status</td>
                                <td>
                                    @foreach ($groupsdata['groupstatuses'] as $status)
                                    @if ($status->id == $groupsdata['data']->status)
                                    {!! $status->name !!}
                                    @endif
                                    @endforeach
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div> -->
    
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <div class="panel-heading-btn">
                        <a href="#" class="btn btn-xs btn-icon btn-circle btn-default"
                            data-click="panel-expand"><i class="fa fa-expand"></i></a>
                        <a href="#" class="btn btn-xs btn-icon btn-circle btn-success"
                            data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                        <a href="#" class="btn btn-xs btn-icon btn-circle btn-warning"
                            data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                        <a href="#" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i
                                class="fa fa-times"></i></a>
                    </div>
                    <h4 class="panel-title">Group - Profile</h4>
                </div>
                <div class="panel-body">
                    <form id="form" class="form-horizontal" action="{{ route('groups.customize', $groupsdata['data']['id']) }}" method="POST">
                        {!! csrf_field() !!}
                        <div class="form-group">
                            <label for="Group Name" class="col-sm-3 control-label">Group Name</label>
                            <div class="col-sm-6">
                                <input type="text" name="group_name" id="group_name" class="form-control"
                                    placeholder="Group Name" value="{{ $groupsdata['data']['group_name'] }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="Meeting Frequency" class="col-sm-3 control-label">Meeting Frequency</label>
                            <div class="col-sm-6">
                                <select class="form-control selectpicker" data-size="100000" data-live-search="true"
                                    data-style="btn-white" name="meeting_frequency" id="meeting_frequency">
                                    <option value="">Select Meeting Frequency</option>
                                    @foreach ($groupsdata['meetingfrequencies'] as $meetingfrequencies)
                                        <option value="{!! $meetingfrequencies->id !!}" {{ isset($groupsdata['data']['meeting_frequency']) && $groupsdata['data']['meeting_frequency'] ==  $meetingfrequencies->id ? 'selected' : '' }}>{!! $meetingfrequencies->name !!}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="Meeting Day" class="col-sm-3 control-label">Meeting Day</label>
                            <div class="col-sm-6">
                                <select class="form-control selectpicker" data-size="100000" data-live-search="true"
                                    data-style="btn-white" name="meeting_day" id="meeting_day">
                                    <option value="">Select Meeting Day</option>
                                    @foreach ($groupsdata['days'] as $days)
                                        <option value="{!! $days->id !!}" {{ isset($groupsdata['data']['meeting_day']) && $groupsdata['data']['meeting_day'] ==  $days->id ? 'selected' : '' }}>{!! $days->number !!}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="Meeting Time" class="col-sm-3 control-label">Meeting Time</label>
                            <div class="col-sm-6">
                                <div class="input-group date" id="meeting_time">
                                    <input type="text" class="form-control" name="meeting_time" value="{{ $groupsdata['data']['meeting_time'] }}"/>
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-time"></span>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="Preferred Mode Of Banking" class="col-sm-3 control-label">Preferred Mode Of
                                Banking</label>
                            <div class="col-sm-6">
                                <select class="form-control selectpicker" data-size="100000" data-live-search="true"
                                    data-style="btn-white" name="preferred_mode_of_banking"
                                    id="preferred_mode_of_banking">
                                    <option value="">Select Preferred Mode Of Banking</option>
                                    @foreach ($groupsdata['bankingmodes'] as $bankingmodes)
                                        <option value="{!! $bankingmodes->id !!}" {{ isset($groupsdata['data']['preferred_mode_of_banking']) && $groupsdata['data']['preferred_mode_of_banking'] ==  $bankingmodes->id ? 'selected' : '' }}>{!! $bankingmodes->name !!}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="Registration Date" class="col-sm-3 control-label">Registration Date</label>
                            <div class="col-sm-6">
                                <input type="text" name="registration_date" id="registration_date" class="form-control" placeholder="Registration Date" value="{{ $groupsdata['data']['registration_date'] }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="Group Formation Date" class="col-sm-3 control-label">Group Formation Date</label>
                            <div class="col-sm-6">
                                <input type="text" name="group_formation_date" id="group_formation_date" class="form-control" placeholder="Group Formation Date" value="{{ $groupsdata['data']['group_formation_date'] }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="Registration Date" class="col-sm-3 control-label">GPS Latitude</label>
                            <div class="col-sm-6">
                                <input type="text" name="_gps_latitude" id="_gps_latitude" class="form-control" placeholder="gps latitude" value="{{ $groupsdata['data']['_gps_latitude'] }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="Group Formation Date" class="col-sm-3 control-label">GPS Longitude</label>
                            <div class="col-sm-6">
                                <input type="text" name="_gps_longitude" id="_gps_longitude" class="form-control" placeholder="gps longitude" value="{{ $groupsdata['data']['_gps_longitude'] }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="Officer" class="col-sm-3 control-label">Officer</label>
                            <div class="col-sm-6">
                                <select class="form-control selectpicker" data-size="100000" data-live-search="true"
                                    data-style="btn-white" name="officer" id="officer">
                                    <option value="">Select Officer</option>
                                    @foreach ($groupsdata['employees'] as $employees)
                                        <option value="{!! $employees->id !!}" {{ isset($groupsdata['data']['officer']) && $groupsdata['data']['officer'] ==  $employees->id ? 'selected' : '' }}>
                                            {!! $employees->employee_number !!}
                                            {!! $employees->first_name !!}
                                            {!! $employees->middle_name !!}
                                            {!! $employees->last_name !!}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="Officer" class="col-sm-3 control-label">Status</label>
                            <div class="col-sm-6">
                                <select class="form-control selectpicker" data-size="100000" data-live-search="true"
                                    data-style="btn-white" name="status" id="status">
                                    <option value="">Select Status</option>
                                    @foreach ($groupsdata['groupstatuses'] as $status)
                                        <option value="{!! $status->id !!}" {{ isset($groupsdata['data']['status']) && $groupsdata['data']['status'] ==  $status->id ? 'selected' : '' }}>{!! $status->name !!}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-6">
                                <button type="submit" class="btn btn-sm btn-primary">
                                    <i class="fa fa-btn fa-plus"></i> Update Group
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading panel-heading-nav">
          <ul class="nav nav-tabs">
            <li role="presentation" class="active">
                <a href="#current_leadership" aria-controls="current_leadership" role="tab" data-toggle="tab">Current Leadership</a>
              </li>
            <li role="presentation">
              <a href="#historic_leadership" aria-controls="historic_leadership" role="tab" data-toggle="tab">Historic Leadership</a>
            </li>
            <li role="presentation">
                <a href="#location_mapping" aria-controls="historic_leadership" role="tab" data-toggle="tab">Location Mapping</a>
              </li>
          </ul>
        </div>
        <div class="panel-body">
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane fade in active" id="current_leadership">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th># NUMBER</th>
                            <th>NAME</th>
                            <th>CATEGORY</th>
                            <th>ACTION</th>
                        </tr>
                        </thead>
                        <tbody>
                            @forelse ($groupsdata['operations'] as $operation)
                            <tr>
                                <th scope="row">
                                    <div class="label label-info">
                                        # {!! isset($operation['leadership']) ? $operation['leadership']->client->client_number : NULL !!}
                                    </div>
                                </th>
                                <td>{!! isset($operation['leadership']) ? $operation['leadership']->client->first_name . ' ' . (isset($operation['leadership']->client->middle_name) ? $operation['leadership']->client->middle_name : '') . $operation['leadership']->client->last_name : NULL !!}</td>
                                <td>{!! strtoupper($operation['category']->name) !!}</td>
                                <td>
                                    @if(isset($operation['leadership']))
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <button id='change-leadership-{!! $operation['category']->id !!}' data-toggle="modal"
                                                data-target="#change-leadership-modal-{!! $operation['category']->id !!}"
                                                class='btn btn-sm btn-circle btn-info' data-bs-toggle="tooltip"
                                                data-bs-placement="left" title="{!! ucwords(__('Change Leadership')) !!}">
                                                <i class='fa fa-btn fa-pencil-square-o'></i>
                                            </button>
                                            <!-- Modal -->
                                            <div class="modal fade" id="change-leadership-modal-{!! $operation['category']->id !!}" role="dialog">
                                                <div class="modal-dialog">
                                                    <!-- Modal content-->
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close"
                                                                data-dismiss="modal">&times;</button>
                                                            <h4 class="modal-title">Change Group Leadership</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form class="form-horizontal"
                                                                action="{!! route('groups.leadership.catalog.store') !!}"
                                                                method="POST">
                                                                {!! csrf_field() !!}
                                                                <input type="hidden" name="command" value="change">
                                                                <input type="hidden" name="group_id" value="{{ $groupsdata['data']->id }}">
                                                                <input type="hidden" name="category_id" value="{{ $operation['category']->id }}">
                                                                <div class="form-group">
                                                                    <label for="official" class="col-sm-3 control-label">{{ strtoupper($operation['category']->name) }} Official</label>
                                                                    <div class="col-sm-6">
                                                                        <select class="form-control selectpicker" data-size="100000" data-live-search="true" data-style="btn-white" name="client_id">
                                                                            <option value="" selected disabled>Select Member</option>
                                                                            @foreach ($groupsdata['clients'] as $clients)
                                                                            <option value="{!! $clients->id !!}">
                                                                                {!! $clients->first_name . ' ' . (isset($clients->middle_name) ? $clients->middle_name : '') . $clients->last_name !!} - {{ $clients->client_number }}
                                                                            </option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <button type="submit" class="btn btn-primary">Proceed</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <form action="{!! route('groups.leadership.catalog.store') !!}" method="POST">
                                                {!! csrf_field() !!}
                                                <input type="hidden" name="command" value="remove">
                                                <input type="hidden" name="group_id" value="{{ $groupsdata['data']->id }}">
                                                <input type="hidden" name="category_id" value="{{ $operation['category']->id }}">
                                                <button type='submit' id='remove-leadership-{!! $operation['category']->id !!}'
                                                    class='btn btn-sm btn-circle btn-warning' data-bs-toggle="tooltip"
                                                    data-bs-placement="left" title="{!! ucwords(__('Remove Leadership')) !!}">
                                                    <i class='fa fa-btn fa-minus-circle'></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                    @else
                                    <button id='add-leadership-{!! $operation['category']->id !!}' data-toggle="modal"
                                        data-target="#add-leadership-modal-{!! $operation['category']->id !!}"
                                        class='btn btn-sm btn-circle btn-success' data-bs-toggle="tooltip"
                                        data-bs-placement="left" title="{!! ucwords(__('Add Leadership')) !!}">
                                        <i class='fa fa-btn fa-plus-square'></i>
                                    </button>
                                    <!-- Modal -->
                                    <div class="modal fade" id="add-leadership-modal-{!! $operation['category']->id !!}" role="dialog">
                                        <div class="modal-dialog">
                                            <!-- Modal content-->
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close"
                                                        data-dismiss="modal">&times;</button>
                                                    <h4 class="modal-title">Add Group Leadership</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <form class="form-horizontal"
                                                        action="{!! route('groups.leadership.catalog.store') !!}"
                                                        method="POST">
                                                        {!! csrf_field() !!}
                                                        <input type="hidden" name="command" value="add">
                                                        <input type="hidden" name="group_id" value="{{ $groupsdata['data']->id }}">
                                                        <input type="hidden" name="category_id" value="{{ $operation['category']->id }}">
                                                        <div class="form-group">
                                                            <label for="official" class="col-sm-3 control-label">{{ strtoupper($operation['category']->name) }} Official</label>
                                                            <div class="col-sm-6">
                                                                <select class="form-control selectpicker" data-size="100000" data-live-search="true" data-style="btn-white" name="client_id">
                                                                    <option value="" selected disabled>Select Member</option>
                                                                    @foreach ($groupsdata['clients'] as $clients)
                                                                    <option value="{!! $clients->id !!}">
                                                                        {!! $clients->first_name . ' ' . (isset($clients->middle_name) ? $clients->middle_name : '') . $clients->last_name !!} - {{ $clients->client_number }}
                                                                    </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <button type="submit" class="btn btn-primary">Proceed</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <div class="col-md-12">
                                <div class="alert alert-light-primary">
                                    {!! __('no current leadership found...') !!}
                                </div>
                            </div>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div role="tabpanel" class="tab-pane fade in" id="historic_leadership">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th># NUMBER</th>
                                <th>NAME</th>
                                <th>CATEGORY</th>
                                <th>OCCUPIED</th>
                                <th>VACATED</th>
                                <th>DURATION</th>
                            </tr>
                        </thead>
                        <tbody>
                        @forelse (collect($groupsdata['leadership'])->where('vacated_at', '!=', NULL) as $historic)
                        <tr>
                            <th scope="row">
                                <div class="label label-info">
                                    # {!! $historic->client->client_number !!}
                                </div>
                            </th>
                            <td>{!! $historic->client->first_name . ' ' . (isset($historic->client->middle_name) ? $historic->client->middle_name : '') . $historic->last_name !!}</td>
                            <td>{!! strtoupper($historic->category->name) !!}</td>
                            <td>{!! Carbon\Carbon::parse($historic->occupied_at)->toDateString() !!}</td>
                            <td>{!! Carbon\Carbon::parse($historic->vacated_at)->toDateString() !!}</td>
                            <td>{!! Carbon\Carbon::parse($historic->occupied_at)->diffForHumans(Carbon\Carbon::parse($historic->vacated_at), ['long' => true, 'parts' => 4]) !!}</td>
                        </tr>
                        @empty
                        <div class="col-md-12">
                            <div class="alert alert-light-primary">
                                {!! __('no historic leadership found...') !!}
                            </div>
                        </div>
                        @endforelse
                        </tbody>
                    </table>
                </div>
                <div role="tabpanel" class="tab-pane fade in" id="location_mapping">
                    @if(isset($groupsdata['data']->_gps_latitude) && isset($groupsdata['data']->_gps_longitude))
                        <iframe width="100%" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://www.openstreetmap.org/export/embed.html?bbox={{ $groupsdata['data']->_gps_longitude }}%2C{{ $groupsdata['data']->_gps_latitude }}%2C{{ $groupsdata['data']->_gps_longitude }}%2C{{ $groupsdata['data']->_gps_latitude }}&amp;layer=mapnik" style="border: 1px solid black"></iframe>
                        <br/>
                        <small>
                            <a href="https://www.openstreetmap.org/#map=17/{{ $groupsdata['data']->_gps_latitude }}/{{ $groupsdata['data']->_gps_longitude }}" target="_blank">View Larger Map</a>
                        </small>

                        <!-- <div id="map" style="width: 600px; height: 400px;"></div>
                        <div id="popup" class="ol-popup">
                            <a href="#" id="popup-closer" class="ol-popup-closer"></a>
                            <div id="popup-content"></div>
                        </div> -->
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <div class="panel-heading-btn">
                        <a href="#" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i
                                class="fa fa-expand"></i></a>
                        <a href="#" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i
                                class="fa fa-repeat"></i></a>
                        <a href="#" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i
                                class="fa fa-minus"></i></a>
                        <a href="#" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i
                                class="fa fa-times"></i></a>
                    </div>
                    <h4 class="panel-title">Members</h4>
                </div>
                <div class="panel-body">
                    <table id="data-table" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th># NUMBER</th>
                                <th>FIRST NAME</th>
                                <th>MIDDLE NAME</th>
                                <th>LAST NAME</th>
                                <th>PHONE NUMBER</th>
                                <th>NATIONAL ID</th>
                                <th>GENDER</th>
                                <th>DATE OF BIRTH</th>
                                <th>CREATED</th>
                                <th>ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($groupsdata['clients'] as $client)
                            <tr>
                                <td class='table-text'>
                                    <div class="label label-info">
                                        # {!! $client->client_number !!}
                                    </div>
                                </td>
                                <td class='table-text'>
                                    <div>
                                        {!! $client->first_name !!}
                                    </div>
                                </td>
                                <td class='table-text'>
                                    <div>
                                        {!! $client->middle_name !!}
                                    </div>
                                </td>
                                <td class='table-text'>
                                    <div>
                                        {!! $client->last_name !!}
                                    </div>
                                </td>
                                <td class='table-text'>
                                    <div>
                                        <a href="tel:{!! $client->primary_phone_number !!}">{!!
                                            $client->primary_phone_number !!}</a>
                                    </div>
                                </td>
                                <td class='table-text'>
                                    <div>
                                        {!! $client->id_number !!}
                                    </div>
                                </td>
                                <td class='table-text'>
                                    <div>
                                        {!! $client->gender ? 'Male' : 'Female' !!}
                                    </div>
                                </td>
                                <td class='table-text'>
                                    <div>
                                        {!! $client->date_of_birth !!}
                                    </div>
                                </td>
                                <td class='table-text'>
                                    <div>
                                        {!! \Carbon\Carbon::parse($client->created_at)->diffForHumans() !!}
                                    </div>
                                </td>
                                <td>
                                    <a href="{!! route('client.individualize', $client->id) !!}" data-bs-toggle="tooltip" data-bs-placement="left" title="{!! ucwords(__('Remove')) !!}" onclick="if (confirm('{!! __("Are you sure? This can not be undone!!") !!}')) { event.preventDefault(); document.getElementById('individualize-client-{!! $client->id !!}').submit(); } else { return false }" class='btn btn-sm btn-circle btn-warning'><i class="fa fa-btn fa-minus-circle"></i></a>
                                    <form id="individualize-client-{!! $client->id !!}" action="{!! route('client.individualize', $client->id) !!}" method="POST" style="display: none;">
                                        {!! csrf_field() !!}
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    $("#meeting_time").datetimepicker({
        format: "LT"
    });

    $("#registration_date").datepicker({
        todayHighlight: !0,
        autoclose: !0
    });

    $("#group_formation_date").datepicker({
        todayHighlight: !0,
        autoclose: !0
    });
</script>
<!-- <script src="https://cdn.rawgit.com/openlayers/openlayers.github.io/master/en/v5.3.0/build/ol.js"></script>
<script>
    var attribution = new ol.control.Attribution({
        collapsible: false
    });

    var map = new ol.Map({
        controls: ol.control.defaults({ attribution: false }).extend([attribution]),
        layers: [
            new ol.layer.Tile({
                source: new ol.source.OSM({
                    url: 'https://tile.openstreetmap.be/osmbe/{z}/{x}/{y}.png',
                    attributions: [ol.source.OSM.ATTRIBUTION, 'Tiles courtesy of <a href="https://geo6.be/">GEO-6</a>'],
                    maxZoom: 18
                })
            })
        ],
        target: 'map',
        view: new ol.View({
            center: ol.proj.fromLonLat([4.35247, 50.84673]),
            maxZoom: 18,
            zoom: 12
        })
    });

    var layer = new ol.layer.Vector({
        source: new ol.source.Vector({
            features: [
                new ol.Feature({
                    geometry: new ol.geom.Point(ol.proj.fromLonLat([4.35247, 50.84673]))
                })
            ]
        })
    });
    map.addLayer(layer);

    var container = document.getElementById('popup');
    var content = document.getElementById('popup-content');
    var closer = document.getElementById('popup-closer');

    var overlay = new ol.Overlay({
        element: container,
        autoPan: true,
        autoPanAnimation: {
            duration: 250
        }
    });
    map.addOverlay(overlay);

    closer.onclick = function () {
        overlay.setPosition(undefined);
        closer.blur();
        return false;
    };

    map.on('singleclick', function (event) {
        if (map.hasFeatureAtPixel(event.pixel) === true) {
            var coordinate = event.coordinate;

            content.innerHTML = '<b>Hello world!</b><br />I am a popup.';
            overlay.setPosition(coordinate);
        } else {
            overlay.setPosition(undefined);
            closer.blur();
        }
    });

    content.innerHTML = '<b>Hello world!</b><br />I am a popup.';
    overlay.setPosition(ol.proj.fromLonLat([4.35247, 50.84673]));

</script> -->
@endsection