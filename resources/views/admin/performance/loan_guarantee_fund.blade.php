@extends('admin.home')
@section('main_content')
    <div id="content" class="content">
        <ol class="breadcrumb pull-right">
            <li><a href="#">Home</a></li>
            <li><a href="#">Public</a></li>
            <li><a href="#">Performance</a></li>
            <li class="active">Loan Guarantee Funds</li>
        </ol>
        <h1 class="page-header">Loan Guarantee Funds Performance - DATA <small>report listings data goes here...</small></h1>
        <div class="row">
            <div class="col-md-12">
                <a href="#modal-dialog" data-toggle="modal"><button type="button"
                        class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-filter"></i></button></a>
                <!-- Display the Excel download icon with a click event -->
                <a href="#" onclick="event.preventDefault(); document.getElementById('downloadForm').submit();"
                    data-toggle="modal">
                    <button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10">
                        <i class="fa fa-cloud-download"></i>
                    </button>
                </a>

                <form action="{{ route('performance.loan.guarantee.fund.download') }}" method="POST" id="downloadForm"
                    style="display: inline;">
                    {!! csrf_field() !!}
                    <!-- Hidden fields to send the required data -->
                    <input type="hidden" name="branch" value="{{ request('branch') }}">
                    <input type="hidden" name="officer" value="{{ request('officer') }}">
                    <input type="hidden" name="startDate" value="{{ request('startDate') }}">
                    <input type="hidden" name="endDate" value="{{ request('endDate') }}">
                </form>
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
                        <h4 class="panel-title">Members</h4>
                    </div>
                    <div class="panel-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th># </th>
                                    <th>CLIENT NAME</th>
                                    <th>AMOUNT</th>
                                    <th>CODE</th>
                                    <th>MODE</th>
                                    <th>DATE</th>
                                    <th>STATUS</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data['list'] as $fund)
                                    <tr>
                                        <td class='table-text'>
                                            <div class="label label-info">
                                                # {!! $fund->id !!}
                                            </div>
                                        </td>
                                        <td class='table-text'>
                                            <div>
                                                {!! ucwords(
                                                    $fund->clientmodel->first_name . ' ' . $fund->clientmodel->middle_name . ' ' . $fund->clientmodel->last_name,
                                                ) !!}
                                            </div>
                                        </td>
                                        <td class='table-text'>
                                            <div>
                                                {!! $fund->amount !!}
                                            </div>
                                        </td>
                                        <td class='table-text'>
                                            <div>
                                                {!! $fund->transaction_number !!}
                                            </div>
                                        </td>
                                        <td class='table-text'>
                                            <div>
                                                {!! ucwords($fund->paymentmodemodel->code . ' ' . $fund->paymentmodemodel->name) !!}
                                            </div>
                                        </td>
                                        <td class='table-text'>
                                            <div>
                                                {!! $fund->date !!}
                                            </div>
                                        </td>
                                        <td class='table-text'>
                                            <div>
                                                {!! $fund->transaction_status == 1
                                                    ? 'Pending'
                                                    : ($fund->transaction_status == 2
                                                        ? 'Disbursed'
                                                        : ($fund->transaction_status == 3
                                                            ? 'Rejected'
                                                            : '')) !!}
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {!! $data['list']->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade modal-message" id="modal-dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">close</button>
                    <h4 class="modal-title">report - Filter Dialog</h4>
                </div>
                <div class="modal-body">
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
                                        <a href="#" class="btn btn-xs btn-icon btn-circle btn-danger"
                                            data-click="panel-remove"><i class="fa fa-times"></i></a>
                                    </div>
                                    <h4 class="panel-title">DataForm - Autofill</h4>
                                </div>
                                <div class="panel-body">
                                    <form id="form" class="form-horizontal" action="{!! route('performance.loan.guarantee.fund') !!}"
                                        method="GET">
                                        <!-- Branch dropdown -->
                                        <div class="form-group">
                                            <label for="Branch" class="col-sm-3 control-label">Branch</label>
                                            <div class="col-sm-6">
                                                <select class="form-control selectpicker" data-size="100000"
                                                    data-live-search="true" data-style="btn-white" name="branch"
                                                    id="branch">
                                                    <option value="">Select Branch</option>
                                                    @foreach ($data['branches'] as $branch)
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
                                                <select class="form-control selectpicker" data-size="100000"
                                                    data-live-search="true" data-style="btn-white" name="officer"
                                                    id="officer">
                                                    <option value="">Select Officer</option>
                                                    <!-- Employee options will be appended here using jQuery -->
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <!-- Start Date -->
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="client number" class="col-sm-6 control-label">Start
                                                        Date</label>
                                                    <div class="col-sm-6">
                                                        <input type="date" class="form-control" name="startDate"
                                                            id="startDate"
                                                            value="{{ \Carbon\Carbon::parse($data['startDate'])->format('Y-m-d') }}" />
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- End Date -->
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="Phone Number" class="col-sm-6 control-label">End
                                                        Date</label>
                                                    <div class="col-sm-6">
                                                        <input type="date" class="form-control" name="endDate"
                                                            id="endDate"
                                                            value="{{ \Carbon\Carbon::parse($data['endDate'])->format('Y-m-d') }}" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-offset-3 col-sm-6">
                                                <div class="col-sm-offset-3 col-sm-6">
                                                    <button type="submit" class="btn btn-sm btn-inverse">
                                                        <i class="fa fa-btn fa-search"></i> Search
                                                    </button>
                                                </div>
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
