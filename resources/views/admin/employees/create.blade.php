@extends('admin.home')
@section('main_content')
    <div id="content" class="content">
        <ol class="breadcrumb pull-right">
            <li><a href="#">Home</a></li>
            <li><a href="#">public</a></li>
            <li><a href="#">Employees</a></li>
            <li class="active">form</li>
        </ol>
        <h1 class="page-header">Employees Form <small>employees details goes here...</small></h1>
        <div class="row">
            <div class="col-md-12">
                <a href="{!! route('employees.index') !!}"><button type="button"
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
                            <div id="wizard">
                                <ol>
                                    <li>
                                        basic
                                        <small>basic details</small>
                                    </li>
                                    <li>
                                        contact
                                        <small>contact details</small>
                                    </li>
                                    <li>
                                        statutory
                                        <small>statutory details</small>
                                    </li>
                                    <li>
                                        financial
                                        <small>financial details</small>
                                    </li>
                                    <li>
                                        other
                                        <small>other details</small>
                                    </li>
                                    <li>
                                        Completed
                                        <small>Final Section</small>
                                    </li>
                                </ol>
                                <div>
                                    <fieldset>
                                        <legend class="pull-left width-full">basic</legend>
                                        <div class="row">
                                            <div class="form-group">
                                                <label for="First Name" class="col-sm-3 control-label">First Name</label>
                                                <div class="col-sm-6">
                                                    <input type="text" name="first_name" id="first_name"
                                                        class="form-control" placeholder="First Name" value="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="Middle Name" class="col-sm-3 control-label">Middle Name</label>
                                                <div class="col-sm-6">
                                                    <input type="text" name="middle_name" id="middle_name"
                                                        class="form-control" placeholder="Middle Name" value="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="Last Name" class="col-sm-3 control-label">Last Name</label>
                                                <div class="col-sm-6">
                                                    <input type="text" name="last_name" id="last_name"
                                                        class="form-control" placeholder="Last Name" value="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="Employee Number" class="col-sm-3 control-label">Employee
                                                    Number</label>
                                                <div class="col-sm-6">
                                                    <input type="text" name="employee_number" id="employee_number"
                                                        class="form-control" placeholder="Employee Number" value="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="Id Number" class="col-sm-3 control-label">Id Number</label>
                                                <div class="col-sm-6">
                                                    <input type="text" name="id_number" id="id_number"
                                                        class="form-control" placeholder="Id Number" value="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="Passport Number" class="col-sm-3 control-label">Passport
                                                    Number</label>
                                                <div class="col-sm-6">
                                                    <input type="text" name="passport_number" id="passport_number"
                                                        class="form-control" placeholder="Passport Number"
                                                        value="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="Country Of Issue" class="col-sm-3 control-label">Country Of
                                                    Issue</label>
                                                <div class="col-sm-6">
                                                    <input type="text" name="country_of_issue" id="country_of_issue"
                                                        class="form-control" placeholder="Country Of Issue"
                                                        value="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="Expiry Date" class="col-sm-3 control-label">Expiry
                                                    Date</label>
                                                <div class="col-sm-6">
                                                    <input type="text" name="expiry_date" id="expiry_date"
                                                        class="form-control" placeholder="Expiry Date" value="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="Gender" class="col-sm-3 control-label">Gender</label>
                                                <div class="col-sm-6">
                                                    <select class="form-control" name="gender" id="gender">
                                                        <option value="">Select Gender</option>
                                                        @foreach ($employeesdata['genders'] as $genders)
                                                            <option value="{!! $genders->id !!}">

                                                                {!! $genders->name !!}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="Date Of Birth" class="col-sm-3 control-label">Date Of
                                                    Birth</label>
                                                <div class="col-sm-6">
                                                    <input type="text" name="date_of_birth" id="date_of_birth"
                                                        class="form-control" placeholder="Date Of Birth" value="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="Marital Status" class="col-sm-3 control-label">Marital
                                                    Status</label>
                                                <div class="col-sm-6">
                                                    <select class="form-control" name="marital_status"
                                                        id="marital_status">
                                                        <option value="">Select Marital Status</option>
                                                        @foreach ($employeesdata['maritalstatuses'] as $maritalstatuses)
                                                            <option value="{!! $maritalstatuses->id !!}">

                                                                {!! $maritalstatuses->name !!}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="Dependencies"
                                                    class="col-sm-3 control-label">Dependencies</label>
                                                <div class="col-sm-6">
                                                    <input type="number" name="dependencies" id="dependencies"
                                                        class="form-control" placeholder="Dependencies" value="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="Next Of Kin Name" class="col-sm-3 control-label">Next Of Kin
                                                    Name</label>
                                                <div class="col-sm-6">
                                                    <input type="text" name="next_of_kin_name" id="next_of_kin_name"
                                                        class="form-control" placeholder="Next Of Kin Name"
                                                        value="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="Relationship With Next Of Kin"
                                                    class="col-sm-3 control-label">Relationship With Next Of Kin</label>
                                                <div class="col-sm-6">
                                                    <select class="form-control" name="relationship_with_next_of_kin"
                                                        id="relationship_with_next_of_kin">
                                                        <option value="">Select Relationship With Next Of Kin
                                                        </option>
                                                        @foreach ($employeesdata['nextofkinrelationships'] as $nextofkinrelationships)
                                                            <option value="{!! $nextofkinrelationships->id !!}">

                                                                {!! $nextofkinrelationships->name !!}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="Next Of Kin Phone Number" class="col-sm-3 control-label">Next
                                                    Of Kin Phone Number</label>
                                                <div class="col-sm-6">
                                                    <input type="text" name="next_of_kin_phone_number"
                                                        placeholder="(999) 999-9999" id="next_of_kin_phone_number"
                                                        class="form-control" value="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="Is Disabled" class="col-sm-3 control-label">Is
                                                    Disabled</label>
                                                <div class="col-sm-6">
                                                    <input type="checkbox" name="is_disabled" id="is_disabled"
                                                        placeholder="Is Disabled" value="1">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="Nature Of Disability" class="col-sm-3 control-label">Nature Of
                                                    Disability</label>
                                                <div class="col-sm-6">
                                                    <Textarea name="nature_of_disability" id="nature_of_disability" class="form-control" row="20"
                                                        placeholder="Nature Of Disability" value=""></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                </div>
                                <div>
                                    <fieldset>
                                        <legend class="pull-left width-full">contact</legend>
                                        <div class="row">
                                            <div class="form-group">
                                                <label for="Phone Number" class="col-sm-3 control-label">Phone
                                                    Number</label>
                                                <div class="col-sm-6">
                                                    <input type="text" name="phone_number"
                                                        placeholder="(999) 999-9999" id="phone_number"
                                                        class="form-control" value="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="Email Address" class="col-sm-3 control-label">Email
                                                    Address</label>
                                                <div class="col-sm-6">
                                                    <input type="email" name="email_address" class="form-control"
                                                        placeholder="Email Address" value="" />
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="Physical Address" class="col-sm-3 control-label">Physical
                                                    Address</label>
                                                <div class="col-sm-6">
                                                    <input type="text" name="physical_address" id="physical_address"
                                                        class="form-control" placeholder="Physical Address"
                                                        value="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="Postal Address" class="col-sm-3 control-label">Postal
                                                    Address</label>
                                                <div class="col-sm-6">
                                                    <input type="text" name="postal_address" id="postal_address"
                                                        class="form-control" placeholder="Postal Address" value="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="Postal Code" class="col-sm-3 control-label">Postal
                                                    Code</label>
                                                <div class="col-sm-6">
                                                    <input type="text" name="postal_code" id="postal_code"
                                                        class="form-control" placeholder="Postal Code" value="">
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                </div>
                                <div>
                                    <fieldset>
                                        <legend class="pull-left width-full">statutory</legend>
                                        <div class="row">
                                            <div class="form-group">
                                                <label for="Pin Number" class="col-sm-3 control-label">Pin Number</label>
                                                <div class="col-sm-6">
                                                    <input type="text" name="pin_number" id="pin_number"
                                                        class="form-control" placeholder="Pin Number" value="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="Nhif Number" class="col-sm-3 control-label">Nhif
                                                    Number</label>
                                                <div class="col-sm-6">
                                                    <input type="text" name="nhif_number" id="nhif_number"
                                                        class="form-control" placeholder="Nhif Number" value="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="Nssf Number" class="col-sm-3 control-label">Nssf
                                                    Number</label>
                                                <div class="col-sm-6">
                                                    <input type="text" name="nssf_number" id="nssf_number"
                                                        class="form-control" placeholder="Nssf Number" value="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="Helb Number" class="col-sm-3 control-label">Helb
                                                    Number</label>
                                                <div class="col-sm-6">
                                                    <input type="text" name="helb_number" id="helb_number"
                                                        class="form-control" placeholder="Helb Number" value="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="University Registration Number"
                                                    class="col-sm-3 control-label">University Registration Number</label>
                                                <div class="col-sm-6">
                                                    <input type="text" name="university_registration_number"
                                                        id="university_registration_number" class="form-control"
                                                        placeholder="University Registration Number" value="">
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                </div>
                                <div>
                                    <fieldset>
                                        <legend class="pull-left width-full">financial</legend>
                                        <div class="row">
                                            <div class="form-group">
                                                <label for="Employment Date" class="col-sm-3 control-label">Employment
                                                    Date</label>
                                                <div class="col-sm-6">
                                                    <input type="text" name="employment_date" id="employment_date"
                                                        class="form-control" placeholder="Employment Date"
                                                        value="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="Is Terminated" class="col-sm-3 control-label">Is
                                                    Terminated</label>
                                                <div class="col-sm-6">
                                                    <input type="checkbox" name="is_terminated" id="is_terminated"
                                                        placeholder="Is Terminated" value="1">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="Termination Date" class="col-sm-3 control-label">Termination
                                                    Date</label>
                                                <div class="col-sm-6">
                                                    <input type="text" name="termination_date" id="termination_date"
                                                        class="form-control" placeholder="Termination Date"
                                                        value="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="Previous Employer Name"
                                                    class="col-sm-3 control-label">Previous Employer Name</label>
                                                <div class="col-sm-6">
                                                    <input type="text" name="previous_employer_name"
                                                        id="previous_employer_name" class="form-control"
                                                        placeholder="Previous Employer Name" value="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="Pay Point" class="col-sm-3 control-label">Pay Point</label>
                                                <div class="col-sm-6">
                                                    <select class="form-control" name="pay_point" id="pay_point">
                                                        <option value="">Select Pay Point</option>
                                                        @foreach ($employeesdata['paypoints'] as $paypoints)
                                                            <option value="{!! $paypoints->id !!}">

                                                                {!! $paypoints->name !!}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="Pay Mode" class="col-sm-3 control-label">Pay Mode</label>
                                                <div class="col-sm-6">
                                                    <select class="form-control" name="pay_mode" id="pay_mode">
                                                        <option value="">Select Pay Mode</option>
                                                        @foreach ($employeesdata['paymodes'] as $paymodes)
                                                            <option value="{!! $paymodes->id !!}">

                                                                {!! $paymodes->name !!}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="Bank" class="col-sm-3 control-label">Bank</label>
                                                <div class="col-sm-6">
                                                    <select class="form-control" name="bank" id="bank">
                                                        <option value="">Select Bank</option>
                                                        @foreach ($employeesdata['banks'] as $banks)
                                                            <option value="{!! $banks->id !!}">

                                                                {!! $banks->name !!}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="Bank Branch" class="col-sm-3 control-label">Bank
                                                    Branch</label>
                                                <div class="col-sm-6">
                                                    <select class="form-control" name="bank_branch" id="bank_branch">
                                                        <option value="">Select Bank Branch</option>
                                                        @foreach ($employeesdata['bankbranches'] as $bankbranches)
                                                            <option value="{!! $bankbranches->id !!}">

                                                                {!! $bankbranches->name !!}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="Bank Account Number" class="col-sm-3 control-label">Bank
                                                    Account Number</label>
                                                <div class="col-sm-6">
                                                    <input type="text" name="bank_account_number"
                                                        id="bank_account_number" class="form-control"
                                                        placeholder="Bank Account Number" value="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="Bank Account Name" class="col-sm-3 control-label">Bank Account
                                                    Name</label>
                                                <div class="col-sm-6">
                                                    <input type="text" name="bank_account_name" id="bank_account_name"
                                                        class="form-control" placeholder="Bank Account Name"
                                                        value="">
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                </div>
                                <div>
                                    <fieldset>
                                        <legend class="pull-left width-full">other</legend>
                                        <div class="row">
                                            <div class="form-group">
                                                <label for="Department" class="col-sm-3 control-label">Department</label>
                                                <div class="col-sm-6">
                                                    <select class="form-control" name="department" id="department">
                                                        <option value="">Select Department</option>
                                                        @foreach ($employeesdata['departments'] as $departments)
                                                            <option value="{!! $departments->id !!}">

                                                                {!! $departments->name !!}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="Employee Category" class="col-sm-3 control-label">Employee
                                                    Category</label>
                                                <div class="col-sm-6">
                                                    <select class="form-control" name="employee_category"
                                                        id="employee_category">
                                                        <option value="">Select Employee Category</option>
                                                        @foreach ($employeesdata['employeecategories'] as $employeecategories)
                                                            <option value="{!! $employeecategories->id !!}">

                                                                {!! $employeecategories->name !!}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="Employee Group" class="col-sm-3 control-label">Employee
                                                    Group</label>
                                                <div class="col-sm-6">
                                                    <select class="form-control" name="employee_group"
                                                        id="employee_group">
                                                        <option value="">Select Employee Group</option>
                                                        @foreach ($employeesdata['employeegroups'] as $employeegroups)
                                                            <option value="{!! $employeegroups->id !!}">

                                                                {!! $employeegroups->name !!}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="Position" class="col-sm-3 control-label">Position</label>
                                                <div class="col-sm-6">
                                                    <select class="form-control" name="position" id="position">
                                                        <option value="">Select Position</option>
                                                        @foreach ($employeesdata['positions'] as $positions)
                                                            <option value="{!! $positions->id !!}">

                                                                {!! $positions->name !!}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="Branch" class="col-sm-3 control-label">Branch</label>
                                                <div class="col-sm-6">
                                                    <select class="form-control" name="branch" id="branch">
                                                        <option value="">Select Branch</option>
                                                        @foreach ($employeesdata['branches'] as $branches)
                                                            <option value="{!! $branches->id !!}">

                                                                {!! $branches->name !!}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="User Account" class="col-sm-3 control-label">User
                                                    Account</label>
                                                <div class="col-sm-6">
                                                    <select class="form-control selectpicker" data-size="100000"
                                                        data-live-search="true" data-style="btn-white"
                                                        name="user_account" id="user_account">
                                                        <option value="">Select User Account</option>
                                                        @foreach ($employeesdata['usersaccounts'] as $usersaccounts)
                                                            <option value="{!! $usersaccounts->id !!}">

                                                                {!! $usersaccounts->name !!}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="User Name" class="col-sm-3 control-label">User Name</label>
                                                <div class="col-sm-6">
                                                    <input type="text" name="user_name" id="user_name"
                                                        class="form-control" placeholder="User Name" value="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="Password" class="col-sm-3 control-label">Password</label>
                                                <div class="col-sm-6">
                                                    <input type="text" name="password" id="password"
                                                        class="form-control" placeholder="Password" value="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="Image" class="col-sm-3 control-label">Image</label>
                                                <div class="col-sm-6">
                                                    <input type="file" name="image" id="image"
                                                        class="form-control" placeholder="Image" value="">
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                </div>
                                <div>
                                    <div class="jumbotron m-b-0 text-center">
                                        <p>Final section. Review the data then click submit to complete registration wizard
                                        </p>
                                        <button class="btn-success btn-lg btn" type='button'
                                            onclick='save()'>Finish</button>
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
                url: "{!! route('employees.store') !!}",
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
    </script>
@endsection
@section('script')
    <script language="javascript" type="text/javascript">
        $("#expiry_date").datepicker({
            todayHighlight: !0,
            autoclose: !0
        });
        $("#date_of_birth").datepicker({
            todayHighlight: !0,
            autoclose: !0
        });
        $("#next_of_kin_phone_number").mask("(999) 999-9999");
        $("#phone_number").mask("(999) 999-9999");
        $("#employment_date").datepicker({
            todayHighlight: !0,
            autoclose: !0
        });
        $("#termination_date").datepicker({
            todayHighlight: !0,
            autoclose: !0
        });
        $(document).ready(function() {
            function employeesCount() {


                $.ajax({
                    type: 'POST',
                    url: "{!! url('/admin/employeescount/') !!}",
                    data: JSON.stringify({
                        '_token': "{{ csrf_token() }}"
                    }),
                    contentType: 'application/json',
                    processData: false,
                    success: function(data) {
                        var obj = jQuery.parseJSON(data);
                        if (obj < 10) {
                            $("#employee_number").val("P0000" + (obj + 1));
                        } else if (obj < 100) {
                            $("#employee_number").val("P000" + (obj + 1));
                        } else if (obj < 1000) {
                            $("#employee_number").val("P00" + (obj + 1));
                        } else if (obj < 10000) {
                            $("#employee_number").val("P0" + (obj + 1));
                        } else {
                            $("#employee_number").val("P" + (obj + 1));
                        }

                        // console.log(obj);
                    }
                });

            }
            employeesCount();

        });
    </script>
@endsection
