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
        <div class="profile-container">
            <div class="profile-section">
                <div class="profile-info">
                    <div class="table-responsive">
                        <table class="table table-profile">
                            <thead>
                                <tr class="highlight">
                                    <td>Employees</td>
                                    <td>Profile Data</td>
                                </tr>
                                <tr class="divider">
                                    <td colspan="2"></td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="highlight">
                                    <td>basic</td>
                                    <td>basic details</td>
                                </tr>
                                <tr>
                                    <td class="field">First Name</td>
                                    <td>
                                        {!! $employeesdata['data']->first_name ?? null !!}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="field">Middle Name</td>
                                    <td>
                                        {!! $employeesdata['data']->middle_name ?? null !!}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="field">Last Name</td>
                                    <td>
                                        {!! $employeesdata['data']->last_name ?? null !!}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="field">Employee Number</td>
                                    <td>
                                        {!! $employeesdata['data']->employee_number ?? null !!}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="field">Id Number</td>
                                    <td>
                                        {!! $employeesdata['data']->id_number ?? null !!}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="field">Passport Number</td>
                                    <td>
                                        {!! $employeesdata['data']->passport_number ?? null !!}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="field">Country Of Issue</td>
                                    <td>
                                        {!! $employeesdata['data']->country_of_issue ?? null !!}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="field">Expiry Date</td>
                                    <td>
                                        {!! $employeesdata['data']->expiry_date ?? null !!}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="field">Gender</td>
                                    <td>
                                        @if (isset($employeesdata['data']->gender) && !empty($employeesdata['data']->gender))
                                            @foreach ($employeesdata['genders'] as $genders)
                                                @if ($genders->id == $employeesdata['data']->gender)
                                                    {!! $genders->name !!}
                                                    </option>
                                                @endif
                                            @endforeach
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td class="field">Date Of Birth</td>
                                    <td>
                                        {!! $employeesdata['data']->date_of_birth ?? null !!}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="field">Marital Status</td>
                                    <td>
                                        @if (isset($employeesdata['data']->marital_status) && !empty($employeesdata['data']->marital_status))
                                            @foreach ($employeesdata['maritalstatuses'] as $maritalstatuses)
                                                @if ($maritalstatuses->id == $employeesdata['data']->marital_status)
                                                    {!! $maritalstatuses->name !!}
                                                    </option>
                                                @endif
                                            @endforeach
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td class="field">Dependencies</td>
                                    <td>
                                        {!! $employeesdata['data']->dependencies ?? null !!}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="field">Next Of Kin Name</td>
                                    <td>
                                        {!! $employeesdata['data']->next_of_kin_name ?? null !!}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="field">Relationship With Next Of Kin</td>
                                    <td>
                                        @if (isset($employeesdata['data']->relationship_with_next_of_kin) &&
                                                !empty($employeesdata['data']->relationship_with_next_of_kin))
                                            @foreach ($employeesdata['nextofkinrelationships'] as $nextofkinrelationships)
                                                @if ($nextofkinrelationships->id == $employeesdata['data']->relationship_with_next_of_kin)
                                                    {!! $nextofkinrelationships->name !!}
                                                    </option>
                                                @endif
                                            @endforeach
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td class="field">Next Of Kin Phone Number</td>
                                    <td>
                                        {!! $employeesdata['data']->next_of_kin_phone_number ?? null !!}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="field">Is Disabled</td>
                                    <td>
                                        {!! $employeesdata['data']->is_disabled ?? null !!}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="field">Nature Of Disability</td>
                                    <td>
                                        {!! $employeesdata['data']->nature_of_disability ?? null !!}
                                    </td>
                                </tr>
                                <tr class="highlight">
                                    <td>contact</td>
                                    <td>contact details</td>
                                </tr>
                                <tr>
                                    <td class="field">Phone Number</td>
                                    <td>
                                        {!! $employeesdata['data']->phone_number ?? null !!}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="field">Email Address</td>
                                    <td>
                                        {!! $employeesdata['data']->email_address ?? null !!}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="field">Physical Address</td>
                                    <td>
                                        {!! $employeesdata['data']->physical_address ?? null !!}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="field">Postal Address</td>
                                    <td>
                                        {!! $employeesdata['data']->postal_address ?? null !!}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="field">Postal Code</td>
                                    <td>
                                        {!! $employeesdata['data']->postal_code ?? null !!}
                                    </td>
                                </tr>
                                <tr class="highlight">
                                    <td>statutory</td>
                                    <td>statutory details</td>
                                </tr>
                                <tr>
                                    <td class="field">Pin Number</td>
                                    <td>
                                        {!! $employeesdata['data']->pin_number ?? null !!}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="field">Nhif Number</td>
                                    <td>
                                        {!! $employeesdata['data']->nhif_number ?? null !!}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="field">Nssf Number</td>
                                    <td>
                                        {!! $employeesdata['data']->nssf_number ?? null !!}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="field">Helb Number</td>
                                    <td>
                                        {!! $employeesdata['data']->helb_number ?? null !!}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="field">University Registration Number</td>
                                    <td>
                                        {!! $employeesdata['data']->university_registration_number ?? null !!}
                                    </td>
                                </tr>
                                <tr class="highlight">
                                    <td>financial</td>
                                    <td>financial details</td>
                                </tr>
                                <tr>
                                    <td class="field">Employment Date</td>
                                    <td>
                                        {!! $employeesdata['data']->employment_date ?? null !!}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="field">Is Terminated</td>
                                    <td>
                                        {!! $employeesdata['data']->is_terminated ?? null !!}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="field">Termination Date</td>
                                    <td>
                                        {!! $employeesdata['data']->termination_date ?? null !!}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="field">Previous Employer Name</td>
                                    <td>
                                        {!! $employeesdata['data']->previous_employer_name ?? null !!}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="field">Pay Point</td>
                                    <td>
                                        @if (isset($employeesdata['data']->pay_point) && !empty($employeesdata['data']->pay_point))
                                            @foreach ($employeesdata['paypoints'] as $paypoints)
                                                @if ($paypoints->id == $employeesdata['data']->pay_point)
                                                    {!! $paypoints->name !!}
                                                    </option>
                                                @endif
                                            @endforeach
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td class="field">Pay Mode</td>
                                    <td>
                                        @if (isset($employeesdata['data']->pay_mode) && !empty($employeesdata['data']->pay_mode))
                                            @foreach ($employeesdata['paymodes'] as $paymodes)
                                                @if ($paymodes->id == $employeesdata['data']->pay_mode)
                                                    {!! $paymodes->name !!}
                                                    </option>
                                                @endif
                                            @endforeach
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td class="field">Bank</td>
                                    <td>
                                        @if (isset($employeesdata['data']->bank) && !empty($employeesdata['data']->bank))
                                            @foreach ($employeesdata['banks'] as $banks)
                                                @if ($banks->id == $employeesdata['data']->bank)
                                                    {!! $banks->name !!}
                                                    </option>
                                                @endif
                                            @endforeach
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td class="field">Bank Branch</td>
                                    <td>
                                        @if (isset($employeesdata['data']->bank_branch) && !empty($employeesdata['data']->bank_branch))
                                            @foreach ($employeesdata['bankbranches'] as $bankbranches)
                                                @if ($bankbranches->id == $employeesdata['data']->bank_branch)
                                                    {!! $bankbranches->name !!}
                                                    </option>
                                                @endif
                                            @endforeach
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td class="field">Bank Account Number</td>
                                    <td>
                                        {!! $employeesdata['data']->bank_account_number ?? null !!}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="field">Bank Account Name</td>
                                    <td>
                                        {!! $employeesdata['data']->bank_account_name ?? null !!}
                                    </td>
                                </tr>
                                <tr class="highlight">
                                    <td>other</td>
                                    <td>other details</td>
                                </tr>
                                <tr>
                                    <td class="field">Department</td>
                                    <td>
                                        @if (isset($employeesdata['data']->department) && !empty($employeesdata['data']->department))
                                            @foreach ($employeesdata['departments'] as $departments)
                                                @if ($departments->id == $employeesdata['data']->department)
                                                    {!! $departments->name !!}
                                                    </option>
                                                @endif
                                            @endforeach
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td class="field">Employee Category</td>
                                    <td>
                                        @if (isset($employeesdata['data']->employee_category) && !empty($employeesdata['data']->employee_category))
                                            @foreach ($employeesdata['employeecategories'] as $employeecategories)
                                                @if ($employeecategories->id == $employeesdata['data']->employee_category)
                                                    {!! $employeecategories->name !!}
                                                    </option>
                                                @endif
                                            @endforeach
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td class="field">Employee Group</td>
                                    <td>
                                        @if (isset($employeesdata['data']->employee_group) && !empty($employeesdata['data']->employee_group))
                                            @foreach ($employeesdata['employeegroups'] as $employeegroups)
                                                @if ($employeegroups->id == $employeesdata['data']->employee_group)
                                                    {!! $employeegroups->name !!}
                                                    </option>
                                                @endif
                                            @endforeach
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td class="field">Position</td>
                                    <td>
                                        @if (isset($employeesdata['data']->position) && !empty($employeesdata['data']->position))
                                            @foreach ($employeesdata['positions'] as $positions)
                                                @if ($positions->id == $employeesdata['data']->position)
                                                    {!! $positions->name !!}
                                                    </option>
                                                @endif
                                            @endforeach
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td class="field">Branch</td>
                                    <td>
                                        @if (isset($employeesdata['data']->branch) && !empty($employeesdata['data']->branch))
                                            @foreach ($employeesdata['branches'] as $branches)
                                                @if ($branches->id == $employeesdata['data']->branch)
                                                    {!! $branches->name !!}
                                                    </option>
                                                @endif
                                            @endforeach
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td class="field">User Name</td>
                                    <td>
                                        {!! $employeesdata['data']->user_name ?? null !!}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="field">Password</td>
                                    <td>
                                        {!! $employeesdata['data']->password ?? null !!}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="field">Image</td>
                                    <td><img src="{!! isset($employeesdata['data']->image) && !empty($employeesdata['data']->image)
                                        ? asset('uploads/images/' . $employeesdata['data']->image)
                                        : null !!}" width='164' height='164' />
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
