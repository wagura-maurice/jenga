@extends('admin.home')
@section('main_content')
<div id='content' class='content'>
            <ol class="breadcrumb hidden-print pull-right">
                <li><a href="javascript:;">Home</a></li>
                <li class="active">Change Group Requests</li>
            </ol>
            <h1 class="page-header hidden-print">Change Group Requests <small>change group requests report goes here...</small></h1>
            <div class="row no-print">
                <div class="col-md-12 hidden-print">
                    <a href="{!! route('changegrouprequests.index') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-arrow-left"></i></button></a>
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
                            <strong>{!! $changegrouprequestsdata['company'][0]->name!!}</strong><br/>
                            {!! $changegrouprequestsdata['company'][0]->street!!} {!! $changegrouprequestsdata['company'][0]->address!!}<br />
                            {!! $changegrouprequestsdata['company'][0]->city!!}, {!! $changegrouprequestsdata['company'][0]->zip_code!!}<br />
                            Phone: {!! $changegrouprequestsdata['company'][0]->phone_number!!}<br />
                        </address>
                    </div>
                    <div class="invoice-date">
                        <img src="{!!asset('uploads/images/'.$changegrouprequestsdata['company'][0]->logo)!!}" width='100' height='100'/>
                    </div>
                </div>
                <div class="invoice-content">
                    <div class="table-responsive">
                        <table class="table table-invoice">
                        <thead>
                                    <tr>
                                        <th>Client</th>
                                        <th>Current Group</th>
                                        <th>New Group</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                        <th>Comments</th>                                    </tr>
                        </thead>
                        <tbody>
                        @foreach ($changegrouprequestsdata['list'] as $changegrouprequests)
                            <tr>
                                <td class='table-text'><div>
                                    {!! $changegrouprequests->clientmodel->client_number !!}
                                    {!! $changegrouprequests->clientmodel->first_name !!}
                                    {!! $changegrouprequests->clientmodel->middle_name !!}
                                    {!! $changegrouprequests->clientmodel->last_name !!}
                                </div></td>
                                <td class='table-text'><div>
                                    {!! $changegrouprequests->currentgroupmodel->group_number !!}
                                    {!! $changegrouprequests->currentgroupmodel->group_name !!}
                                </div></td>
                                <td class='table-text'><div>
                                    {!! $changegrouprequests->newgroupmodel->group_number !!}
                                    {!! $changegrouprequests->newgroupmodel->group_name !!}
                                </div></td>
                                <td class='table-text'><div>
                                    {!! $changegrouprequests->date !!}
                                </div></td>
                                <td class='table-text'><div>
                                    {!! $changegrouprequests->statusmodel->name !!}
                                </div></td>
                                <td class='table-text'><div>
                                    {!! $changegrouprequests->comments !!}
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
                            <small>TOTAL COUNT</small> {!!count($changegrouprequestsdata['list'])!!}
                        </div>
                    </div>
                </div>
                <div class="invoice-footer text-muted">
                    <p class="text-center m-b-5">
                    </p>
                    <p class="text-center">
                        <span class="m-r-10"><i class="fa fa-globe"></i> {!! $changegrouprequestsdata['company'][0]->website!!}</span>
                        <span class="m-r-10"><i class="fa fa-phone"></i> T:{!! $changegrouprequestsdata['company'][0]->phone_number!!}</span>
                        <span class="m-r-10"><i class="fa fa-envelope"></i> {!! $changegrouprequestsdata['company'][0]->email_address!!}</span>
                    </p>
                </div>
            </div>
</div>
@endsection