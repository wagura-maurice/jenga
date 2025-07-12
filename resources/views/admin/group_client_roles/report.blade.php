@extends('admin.home')
@section('main_content')
    <div id='content' class='content'>
        <ol class="breadcrumb hidden-print pull-right">
            <li><a href="javascript:;">Home</a></li>
            <li class="active">Group Client Roles</li>
        </ol>
        <h1 class="page-header hidden-print">Group Client Roles <small>group client roles report goes here...</small></h1>
        <div class="row no-print">
            <div class="col-md-12 hidden-print">
                <a href="{!! route('groupclientroles.index') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i
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
                        <strong>{!! $groupclientrolesdata['company'][0]->name !!}</strong><br />
                        {!! $groupclientrolesdata['company'][0]->street !!} {!! $groupclientrolesdata['company'][0]->address !!}<br />
                        {!! $groupclientrolesdata['company'][0]->city !!}, {!! $groupclientrolesdata['company'][0]->zip_code !!}<br />
                        Phone: {!! $groupclientrolesdata['company'][0]->phone_number !!}<br />
                    </address>
                </div>
                <div class="invoice-date">
                    <img src="{!! asset('uploads/images/' . $groupclientrolesdata['company'][0]->logo) !!}" width='100' height='100' />
                </div>
            </div>
            <div class="invoice-content">
                <div class="table-responsive">
                    <table class="table table-invoice">
                        <thead>
                            <tr>
                                <th>Client_group</th>
                                <th>Group_role</th>
                                <th>Client</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($groupclientrolesdata['list'] as $groupclientroles)
                                <tr>
                                    <td class='table-text'>
                                        <div>
                                            {!! $groupclientroles->client_groupmodel->group_number !!}
                                            {!! $groupclientroles->client_groupmodel->group_name !!}
                                        </div>
                                    </td>
                                    <td class='table-text'>
                                        <div>
                                            {!! $groupclientroles->group_rolemodel->name !!}
                                        </div>
                                    </td>
                                    <td class='table-text'>
                                        <div>
                                            {!! $groupclientroles->clientmodel->client_number !!}
                                            {!! $groupclientroles->clientmodel->first_name !!}
                                            {!! $groupclientroles->clientmodel->middle_name !!}
                                            {!! $groupclientroles->clientmodel->last_name !!}
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
                        <small>TOTAL COUNT</small> {!! count($groupclientrolesdata['list']) !!}
                    </div>
                </div>
            </div>
            <div class="invoice-footer text-muted">
                <p class="text-center m-b-5">
                </p>
                <p class="text-center">
                    <span class="m-r-10"><i class="fa fa-globe"></i> {!! $groupclientrolesdata['company'][0]->website !!}</span>
                    <span class="m-r-10"><i class="fa fa-phone"></i> T:{!! $groupclientrolesdata['company'][0]->phone_number !!}</span>
                    <span class="m-r-10"><i class="fa fa-envelope"></i> {!! $groupclientrolesdata['company'][0]->email_address !!}</span>
                </p>
            </div>
        </div>
    </div>
@endsection
