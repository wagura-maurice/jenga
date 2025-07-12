@extends("admin.home")
@section("main_content")
<div id="content" class="content">
    <ol class="breadcrumb pull-right">
        <li><a href="#">Home</a></li>
        <li><a href="#">Public</a></li>
        <li><a href="#">Groups</a></li>
        <li class="active">Table</li>
    </ol>
    <h1 class="page-header">Groups - DATA <small>groups data goes here...</small></h1>
    <div class="row">
        <div class="col-md-12">
            @if($groupsdata['usersaccountsroles'][0]->_add==1)
            <a href="{!! route('ptrreport.index') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-plus"></i></button></a>
            @endif
            @if($groupsdata['usersaccountsroles'][0]->_report==1)
            <a href="{!! url('admin/groupsreport') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-file-text-o"></i></button></a>
            @endif
            @if($groupsdata['usersaccountsroles'][0]->_report==1 || $groupsdata['usersaccountsroles'][0]->_list==1)
            <a href="#modal-dialog" data-toggle="modal"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-filter"></i></button></a>
            @endif
            <!--             @if($groupsdata['usersaccountsroles'][0]->_add==1)
            <a href="{!! url('/admin/groupsimport') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-download"></i></button></a>
            @endif
 -->
            @if($groupsdata['usersaccountsroles'][0]->_list==1)
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <div class="panel-heading-btn">
                        <a href="#" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                        <a href="#" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                        <a href="#" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                        <a href="#" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                    </div>
                    <h4 class="panel-title">DataTable - Autofill</h4>
                </div>
                <div class="panel-body">
                    <table id="data-table" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Group Number</th>
                                <th>Group Name</th>
                                <th>Meeting Day</th>
                                <th>Meeting Time</th>
                                <th>Meeting Frequency</th>
                                <th>Preferred Mode Of Banking</th>
                                <th>Registration Date</th>
                                <th>Group Formation Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($groupsdata['list'] as $groups)
                            <tr>
                                <td class='table-text'>
                                    <div>
                                        {!! $groups->group_number !!}
                                    </div>
                                </td>
                                <td class='table-text'>
                                    <div>
                                        {!! $groups->group_name !!}
                                    </div>
                                </td>
                                <td class='table-text'>
                                    <div>
                                        {!! isset($groups->meeting_day) ? $groups->meetingdaymodel->name : '' !!}
                                    </div>
                                </td>
                                <td class='table-text'>
                                    <div>
                                        {!! $groups->meeting_time !!}
                                    </div>
                                </td>
                                <td class='table-text'>
                                    <div>
                                        {!! isset($groups->meeting_frequency) ? $groups->meetingfrequencymodel->name : '' !!}
                                    </div>
                                </td>
                                <td class='table-text'>
                                    <div>
                                        {!! isset($groups->preferred_mode_of_banking)?$groups->preferredmodeofbankingmodel->name : ''!!}
                                    </div>
                                </td>
                                <td class='table-text'>
                                    <div>
                                        {!! $groups->registration_date !!}
                                    </div>
                                </td>
                                <td class='table-text'>
                                    <div>
                                        {!! $groups->group_formation_date !!}
                                    </div>
                                </td>
                                <td>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <form action="{!! route('groups.destroy',$groups->id) !!}" method="POST">
                                                @if($groupsdata['usersaccountsroles'][0]->_edit==1)
                                                <a href="{!! route('ptrreport.edit',$groups->id) !!}" id='edit-groups-{!! $groups->id !!}' class='btn btn-sm btn-circle btn-primary'>
                                                    <i class='fa fa-btn fa-arrow-right'></i>
                                                </a>
                                                @endif
                                            </form>
                                        </div>
                                        <div class="col-sm-6">
                                            <!-- <a href="{{ route('general.report.ptr', $groups->id) }}" class='btn btn-sm btn-circle btn-info'><i class='fa fa-btn fa-cloud-download'></i></a> -->
                                        </div>
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
@endif
<div class="modal fade modal-message" id="modal-dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">close</button>
                <h4 class="modal-title">Groups - Filter Dialog</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-inverse">
                            <div class="panel-heading">
                                <div class="panel-heading-btn">
                                    <a href="#" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                    <a href="#" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                                    <a href="#" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                                    <a href="#" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                                </div>
                                <h4 class="panel-title">DataForm - Autofill</h4>
                            </div>
                            <div class="panel-body">
                                <form id="form" class="form-horizontal" action="{!! url('admin/groupsfilter') !!}" method="POST">
                                    {!! csrf_field() !!}
                                    <div class="form-group">
                                        <label for="Group Number" class="col-sm-3 control-label">Group Number</label>
                                        <div class="col-sm-6">
                                            <input type="text" name="group_number" id="group_number" class="form-control" placeholder="Group Number" value="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="Group Name" class="col-sm-3 control-label">Group Name</label>
                                        <div class="col-sm-6">
                                            <input type="text" name="group_name" id="group_name" class="form-control" placeholder="Group Name" value="">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="Meeting Day" class="col-sm-3 control-label">Meeting Day</label>
                                        <div class="col-sm-6">
                                            <select class="form-control" name="meeting_day" id="meeting_day">
                                                <option value="">Select Meeting Day</option> @foreach ($groupsdata['days'] as $days)
                                                <option value="{!! $days->id !!}">

                                                    {!! $days->name!!}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="Meeting Time" class="col-sm-3 control-label">Meeting Time</label>
                                        <div class="col-sm-6">
                                            <input type="text" name="meeting_time" id="meeting_time" class="form-control" placeholder="Meeting Time" value="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="Meeting Frequency" class="col-sm-3 control-label">Meeting Frequency</label>
                                        <div class="col-sm-6">
                                            <select class="form-control" name="meeting_frequency" id="meeting_frequency">
                                                <option value="">Select Meeting Frequency</option> @foreach ($groupsdata['meetingfrequencies'] as $meetingfrequencies)
                                                <option value="{!! $meetingfrequencies->id !!}">

                                                    {!! $meetingfrequencies->name!!}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="Preferred Mode Of Banking" class="col-sm-3 control-label">Preferred Mode Of Banking</label>
                                        <div class="col-sm-6">
                                            <select class="form-control" name="preferred_mode_of_banking" id="preferred_mode_of_banking">
                                                <option value="">Select Preferred Mode Of Banking</option> @foreach ($groupsdata['bankingmodes'] as $bankingmodes)
                                                <option value="{!! $bankingmodes->id !!}">

                                                    {!! $bankingmodes->name!!}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="Registration Date" class="col-sm-3 control-label">Registration Date</label>
                                        <div class="col-sm-6">
                                            <input type="text" name="registration_datefrom" id="registration_datefrom" class="form-control m-b-5" placeholder="Registration Date From" value="">
                                            <input type="text" name="registration_dateto" id="registration_dateto" class="form-control" placeholder="Registration Date To" value="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="Group Formation Date" class="col-sm-3 control-label">Group Formation Date</label>
                                        <div class="col-sm-6">
                                            <input type="text" name="group_formation_datefrom" id="group_formation_datefrom" class="form-control m-b-5" placeholder="Group Formation Date From" value="">
                                            <input type="text" name="group_formation_dateto" id="group_formation_dateto" class="form-control" placeholder="Group Formation Date To" value="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="Officer" class="col-sm-3 control-label">Officer</label>
                                        <div class="col-sm-6">
                                            <select class="form-control" name="officer" id="officer">
                                                <option value="">Select Officer</option> @foreach ($groupsdata['employees'] as $employees)
                                                <option value="{!! $employees->id !!}">

                                                    {!! $employees->employee_number!!}
                                                    {!! $employees->first_name!!}
                                                    {!! $employees->middle_name!!}
                                                    {!! $employees->last_name!!}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-offset-3 col-sm-6">
                                            <div class="col-sm-offset-3 col-sm-6">
                                                <button type="submit" class="btn btn-sm btn-inverse">
                                                    <i class="fa fa-btn fa-search"></i> Search Groups
                                                </button>
                                            </div>
                                        </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a href="javascript:;" class="btn btn-sm btn-white" data-dismiss="modal">Close</a>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script language="javascript" type="text/javascript">
    $("#registration_datefrom").datepicker({
        todayHighlight: !0,
        autoclose: !0
    });
    $("#registration_dateto").datepicker({
        todayHighlight: !0,
        autoclose: !0
    });
</script>
<script language="javascript" type="text/javascript">
    $("#group_formation_datefrom").datepicker({
        todayHighlight: !0,
        autoclose: !0
    });
    $("#group_formation_dateto").datepicker({
        todayHighlight: !0,
        autoclose: !0
    });
</script>
@endsection