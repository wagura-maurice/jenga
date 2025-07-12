@extends('admin.home')
@section('main_content')
    <div id="content" class="content">
        <ol class="breadcrumb pull-right">
            <li><a href="#">Home</a></li>
            <li><a href="#">public</a></li>
            <li><a href="#">Groups</a></li>
            <li class="active">form</li>
        </ol>
        <h1 class="page-header">Groups Form <small>groups details goes here...</small></h1>
        <div class="row">
            <div class="col-md-12">
                <a href="{!! route('groups.index') !!}"><button type="button"
                        class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-arrow-left"></i></button></a>
            </div>
        </div>
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
                        <h4 class="panel-title">DataForm - Autofill</h4>
                    </div>
                    <div class="panel-body">
                        <form id="form" class="form-horizontal" enctype="multipart/form-data">
                            {!! csrf_field() !!}

                            <div class="form-group">
                                <label for="Group Name" class="col-sm-3 control-label">Group Name</label>
                                <div class="col-sm-6">
                                    <input type="text" name="group_name" id="group_name" class="form-control"
                                        placeholder="Group Name" value="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Meeting Frequency" class="col-sm-3 control-label">Meeting Frequency</label>
                                <div class="col-sm-6">
                                    <select class="form-control selectpicker" data-size="100000" data-live-search="true"
                                        data-style="btn-white" name="meeting_frequency" id="meeting_frequency">
                                        <option value="">Select Meeting Frequency</option>
                                        @foreach ($groupsdata['meetingfrequencies'] as $meetingfrequencies)
                                            <option value="{!! $meetingfrequencies->id !!}">

                                                {!! $meetingfrequencies->name !!}
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
                                            <option value="{!! $days->id !!}">

                                                {!! $days->name !!}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Meeting Time" class="col-sm-3 control-label">Meeting Time</label>
                                <div class="col-sm-6">
                                    <div class="input-group date" id="meeting_time">
                                        <input type="text" class="form-control" name="meeting_time" />
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
                                            <option value="{!! $bankingmodes->id !!}">

                                                {!! $bankingmodes->name !!}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Registration Date" class="col-sm-3 control-label">Registration Date</label>
                                <div class="col-sm-6">
                                    <input type="text" name="registration_date" id="registration_date"
                                        class="form-control" placeholder="Registration Date" value="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Group Formation Date" class="col-sm-3 control-label">Group Formation
                                    Date</label>
                                <div class="col-sm-6">
                                    <input type="text" name="group_formation_date" id="group_formation_date"
                                        class="form-control" placeholder="Group Formation Date" value="">
                                </div>
                            </div>
                            <!-- Branch dropdown -->
                            <div class="form-group">
                                <label for="Branch" class="col-sm-3 control-label">Branch</label>
                                <div class="col-sm-6">
                                    <select class="form-control selectpicker" data-size="100000" data-live-search="true"
                                        data-style="btn-white" name="branch" id="branch" required>
                                        <option value="">Select Branch</option>
                                        @foreach ($groupsdata['branches'] as $branch)
                                            <option value="{!! $branch->id !!}">
                                                {!! $branch->code !!} - {!! $branch->name !!}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <!-- Officer dropdown -->
                            <div class="form-group">
                                <label for="Officer" class="col-sm-3 control-label">Officer</label>
                                <div class="col-sm-6">
                                    <select class="form-control selectpicker" data-size="100000" data-live-search="true"
                                        data-style="btn-white" name="officer" id="officer" required>
                                        <option value="">Select Officer</option>
                                        <!-- Employee options will be appended here using jQuery -->
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
                                            <option value="{!! $status->id !!}">

                                                {!! $status->name !!}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-6">
                                    <button type="button" onclick="save()" class="btn btn-sm btn-primary">
                                        <i class="fa fa-btn fa-plus"></i> Add Groups
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script language="javascript" type="text/javascript">
        function save() {
            var formData = new FormData($('#form')[0]);
            $.ajax({
                type: 'POST',
                url: "{!! route('groups.store') !!}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function(data) {
                    var obj = jQuery.parseJSON(data);
                    if (obj.status == '1') {
                        $.gritter.add({
                            title: 'Success',
                            text: obj.message,
                            sticky: false,
                            time: '1000',
                        });
                        $("#form")[0].reset();
                    } else {
                        $.gritter.add({
                            title: 'Fail',
                            text: obj.message,
                            sticky: false,
                            time: '5000',
                        });
                    }
                },
                error: function(data) {
                    console.log(data)
                    $.gritter.add({
                        title: 'Error',
                        text: 'An Error occured. Please review your data then submit again!!',
                        sticky: false,
                        time: '5000',
                    });
                }
            });
            return false;
        }

        function dateOfFormation() {

        }
    </script>
@endsection
@section('script')
    <script language="javascript" type="text/javascript">
        $("#meeting_time").datetimepicker({
            format: "LT"
        });
    </script>
    <script language="javascript" type="text/javascript">
        $("#registration_date").datepicker({
            todayHighlight: !0,
            autoclose: !0
        });
    </script>
    <script language="javascript" type="text/javascript">
        $("#group_formation_date").datepicker({
            todayHighlight: !0,
            autoclose: !0
        });
        $(document).ready(function() {
            function groupsCount() {
                $.ajax({
                    type: 'POST',
                    url: "{!! url('/admin/groupscount/') !!}",
                    data: JSON.stringify({
                        '_token': "{{ csrf_token() }}"
                    }),
                    contentType: 'application/json',
                    processData: false,
                    success: function(data) {
                        var obj = jQuery.parseJSON(data);
                        if (obj < 10) {
                            $("#group_number").val("G0000" + (obj + 1));
                        } else if (obj < 100) {
                            $("#group_number").val("G000" + (obj + 1));
                        } else if (obj < 1000) {
                            $("#group_number").val("G00" + (obj + 1));
                        } else if (obj < 10000) {
                            $("#group_number").val("G0" + (obj + 1));
                        } else {
                            $("#group_number").val("G" + (obj + 1));
                        }

                        // console.log(obj);
                    }
                });

            }
            groupsCount();

        });
    </script>
    <script>
        $(document).ready(function() {
            // When the branch dropdown value changes
            $("#branch").on('change', function() {
                var selectedBranch = $(this).val();
                fetchEmployees(selectedBranch);
            });
        });

        function fetchEmployees(branchId) {
            if (branchId) {
                $.ajax({
                    url: `/api/employees?branch=${branchId}`,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        // Clear previous options
                        $("#officer").empty().append('<option value="">Select Officer</option>');

                        // Populate the officer dropdown with the fetched data
                        $.each(data, function(key, employee) {
                            $("#officer").append(
                                `<option value="${employee.id}">${employee.employee_number} ${employee.first_name} ${employee.middle_name} ${employee.last_name}</option>`
                            );
                        });

                        // If you're using a plugin like Bootstrap-Select, refresh the dropdown
                        $('#officer').selectpicker('refresh');
                    },
                    error: function(error) {
                        console.log("Error fetching employees:", error);
                    }
                });
            } else {
                $("#officer").empty().append('<option value="">Select Officer</option>');
                $('#officer').selectpicker('refresh');
            }
        }
    </script>
@endsection
