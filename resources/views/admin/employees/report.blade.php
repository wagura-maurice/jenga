@extends('admin.home')
@section('main_content')
<div id='content' class='content'>
            <ol class="breadcrumb hidden-print pull-right">
                <li><a href="javascript:;">Home</a></li>
                <li class="active">Employees</li>
            </ol>
            <h1 class="page-header hidden-print">Employees <small>employees report goes here...</small></h1>
            <div class="row no-print">
                <div class="col-md-12 hidden-print">
                    <a href="{!! route('employees.index') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-arrow-left"></i></button></a>
                </div>
            </div>
            <div class="invoice">
                <div class="invoice-company">
                    <span class="pull-right hidden-print">
                    <a href="javascript:;" class="btn btn-sm btn-success m-b-10"><i class="fa fa-download m-r-5"></i> Export as PDF</a>
                    <a href="javascript:;" onclick="window.print()" class="btn btn-sm btn-success m-b-10"><i class="fa fa-print m-r-5"></i> Print</a>
                    </span>
                </div>
                <div class="invoice-header">
                    <div class="invoice-from">
                        <address class="m-t-5 m-b-5">
                            <strong>{!! $employeesdata['company'][0]->name!!}</strong><br/>
                            {!! $employeesdata['company'][0]->street!!} {!! $employeesdata['company'][0]->address!!}<br />
                            {!! $employeesdata['company'][0]->city!!}, {!! $employeesdata['company'][0]->zip_code!!}<br />
                            Phone: {!! $employeesdata['company'][0]->phone_number!!}<br />
                        </address>
                    </div>
                    <div class="invoice-date">
                        <img src="{!!asset('uploads/images/'.$employeesdata['company'][0]->logo)!!}" width='100' height='100'/>
                    </div>
                </div>
                <div class="invoice-content">
                    <div class="table-responsive">
                        <table class="table table-invoice">
                        <thead>
                                    <tr>
                                        <th>First Name</th>
                                        <th>Middle Name</th>
                                        <th>Last Name</th>
                                        <th>Employee Number</th>
                                        <th>Id Number</th>
                                        <th>Passport Number</th>
                                        <th>Country Of Issue</th>
                                        <th>Expiry Date</th>                                    </tr>
                        </thead>
                        <tbody>
                        @foreach ($employeesdata['list'] as $employees)
                            <tr>
                                <td class='table-text'><div>
                                    {!! $employees->first_name !!}
                                </div></td>
                                <td class='table-text'><div>
                                    {!! $employees->middle_name !!}
                                </div></td>
                                <td class='table-text'><div>
                                    {!! $employees->last_name !!}
                                </div></td>
                                <td class='table-text'><div>
                                    {!! $employees->employee_number !!}
                                </div></td>
                                <td class='table-text'><div>
                                    {!! $employees->id_number !!}
                                </div></td>
                                <td class='table-text'><div>
                                    {!! $employees->passport_number !!}
                                </div></td>
                                <td class='table-text'><div>
                                    {!! $employees->country_of_issue !!}
                                </div></td>
                                <td class='table-text'><div>
                                    {!! $employees->expiry_date !!}
                                </div></td>
                            </tr>
                        @endforeach
                        </tbody>
                        </table>
                    </div>
                    <div class="invoice-price">
                        <div class="invoice-price-left">
                            <div class="invoice-price-row">
                            </div>
                        </div>
                        <div class="invoice-price-right">
                            <small>TOTAL COUNT</small> {!!count($employeesdata['list'])!!}
                        </div>
                    </div>
                </div>
                <div class="invoice-footer text-muted">
                    <p class="text-center m-b-5">
                    </p>
                    <p class="text-center">
                        <span class="m-r-10"><i class="fa fa-globe"></i> {!! $employeesdata['company'][0]->website!!}</span>
                        <span class="m-r-10"><i class="fa fa-phone"></i> T:{!! $employeesdata['company'][0]->phone_number!!}</span>
                        <span class="m-r-10"><i class="fa fa-envelope"></i> {!! $employeesdata['company'][0]->email_address!!}</span>
                    </p>
                </div>
            </div>
</div>
@endsection