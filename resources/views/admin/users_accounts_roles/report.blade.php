@extends('admin.home')
@section('main_content')
    <div id='content' class='content'>
        <ol class="breadcrumb hidden-print pull-right">
            <li><a href="javascript:;">Home</a></li>
            <li class="active">Users Accounts Roles</li>
        </ol>
        <h1 class="page-header hidden-print">Users Accounts Roles <small>users accounts roles report goes here...</small>
        </h1>
        <div class="row no-print">
            <div class="col-md-12 hidden-print">
                <a href="{!! route('usersaccountsroles.index') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i
                            class="fa fa-arrow-left"></i></button></a>
            </div>
        </div>
        <div class="invoice">
            <div class="invoice-company">
                <span class="pull-right hidden-print">
                    <a href="javascript:;" class="btn btn-sm btn-success m-b-10"><i class="fa fa-download m-r-5"></i> Export
                        as PDF</a>
                    <a href="javascript:;" onclick="window.print()" class="btn btn-sm btn-success m-b-10"><i
                            class="fa fa-print m-r-5"></i> Print</a>
                </span>
            </div>
            <div class="invoice-header">
                <div class="invoice-from">
                    <address class="m-t-5 m-b-5">
                        <strong>{!! $usersaccountsrolesdata['company'][0]->name !!}</strong><br />
                        {!! $usersaccountsrolesdata['company'][0]->street !!} {!! $usersaccountsrolesdata['company'][0]->address !!}<br />
                        {!! $usersaccountsrolesdata['company'][0]->city !!}, {!! $usersaccountsrolesdata['company'][0]->zip_code !!}<br />
                        Phone: {!! $usersaccountsrolesdata['company'][0]->phone_number !!}<br />
                    </address>
                </div>
                <div class="invoice-date">
                    <img src="{!! asset('uploads/images/' . $usersaccountsrolesdata['company'][0]->logo) !!}" width='100' height='100' />
                </div>
            </div>
            <div class="invoice-content">
                <div class="table-responsive">
                    <table class="table table-invoice">
                        <thead>
                            <tr>
                                <th>User Account</th>
                                <th>Module</th>
                                <th>_add</th>
                                <th>_list</th>
                                <th>_edit</th>
                                <th>_delete</th>
                                <th>_show</th>
                                <th>_report</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($usersaccountsrolesdata['list'] as $usersaccountsroles)
                                <tr>
                                    <td class='table-text'>
                                        <div>
                                            {!! $usersaccountsroles->useraccountmodel->name !!}
                                        </div>
                                    </td>
                                    <td class='table-text'>
                                        <div>
                                            {!! $usersaccountsroles->modulemodel->name !!}
                                        </div>
                                    </td>
                                    <td class='table-text'>
                                        <div>
                                            {!! $usersaccountsroles->_add !!}
                                        </div>
                                    </td>
                                    <td class='table-text'>
                                        <div>
                                            {!! $usersaccountsroles->_list !!}
                                        </div>
                                    </td>
                                    <td class='table-text'>
                                        <div>
                                            {!! $usersaccountsroles->_edit !!}
                                        </div>
                                    </td>
                                    <td class='table-text'>
                                        <div>
                                            {!! $usersaccountsroles->_delete !!}
                                        </div>
                                    </td>
                                    <td class='table-text'>
                                        <div>
                                            {!! $usersaccountsroles->_show !!}
                                        </div>
                                    </td>
                                    <td class='table-text'>
                                        <div>
                                            {!! $usersaccountsroles->_report !!}
                                        </div>
                                    </td>
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
                        <small>TOTAL COUNT</small> {!! count($usersaccountsrolesdata['list']) !!}
                    </div>
                </div>
            </div>
            <div class="invoice-footer text-muted">
                <p class="text-center m-b-5">
                </p>
                <p class="text-center">
                    <span class="m-r-10"><i class="fa fa-globe"></i> {!! $usersaccountsrolesdata['company'][0]->website !!}</span>
                    <span class="m-r-10"><i class="fa fa-phone"></i> T:{!! $usersaccountsrolesdata['company'][0]->phone_number !!}</span>
                    <span class="m-r-10"><i class="fa fa-envelope"></i> {!! $usersaccountsrolesdata['company'][0]->email_address !!}</span>
                </p>
            </div>
        </div>
    </div>
@endsection
