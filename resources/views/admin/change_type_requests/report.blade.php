@extends('admin.home')
@section('main_content')
<div id='content' class='content'>
            <ol class="breadcrumb hidden-print pull-right">
                <li><a href="javascript:;">Home</a></li>
                <li class="active">Change Type Requests</li>
            </ol>
            <h1 class="page-header hidden-print">Change Type Requests <small>change type requests report goes here...</small></h1>
            <div class="row no-print">
                <div class="col-md-12 hidden-print">
                    <a href="{!! route('changetyperequests.index') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-arrow-left"></i></button></a>
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
                            <strong>{!! $changetyperequestsdata['company'][0]->name!!}</strong><br/>
                            {!! $changetyperequestsdata['company'][0]->street!!} {!! $changetyperequestsdata['company'][0]->address!!}<br />
                            {!! $changetyperequestsdata['company'][0]->city!!}, {!! $changetyperequestsdata['company'][0]->zip_code!!}<br />
                            Phone: {!! $changetyperequestsdata['company'][0]->phone_number!!}<br />
                        </address>
                    </div>
                    <div class="invoice-date">
                        <img src="{!!asset('uploads/images/'.$changetyperequestsdata['company'][0]->logo)!!}" width='100' height='100'/>
                    </div>
                </div>
                <div class="invoice-content">
                    <div class="table-responsive">
                        <table class="table table-invoice">
                        <thead>
                                    <tr>
                                        <th>Client</th>
                                        <th>Current Type</th>
                                        <th>New Type</th>
                                        <th>Date</th>
                                        <th>Comments</th>
                                        <th>Status</th>                                    </tr>
                        </thead>
                        <tbody>
                        @foreach ($changetyperequestsdata['list'] as $changetyperequests)
                            <tr>
                                <td class='table-text'><div>
                                    {!! $changetyperequests->clientmodel->client_number !!}
                                    {!! $changetyperequests->clientmodel->first_name !!}
                                    {!! $changetyperequests->clientmodel->middle_name !!}
                                    {!! $changetyperequests->clientmodel->last_name !!}
                                </div></td>
                                <td class='table-text'><div>
                                    {!! $changetyperequests->currenttypemodel->name !!}
                                </div></td>
                                <td class='table-text'><div>
                                    {!! $changetyperequests->newtypemodel->name !!}
                                </div></td>
                                <td class='table-text'><div>
                                    {!! $changetyperequests->date !!}
                                </div></td>
                                <td class='table-text'><div>
                                    {!! $changetyperequests->comments !!}
                                </div></td>
                                <td class='table-text'><div>
                                    {!! $changetyperequests->statusmodel->name !!}
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
                            <small>TOTAL COUNT</small> {!!count($changetyperequestsdata['list'])!!}
                        </div>
                    </div>
                </div>
                <div class="invoice-footer text-muted">
                    <p class="text-center m-b-5">
                    </p>
                    <p class="text-center">
                        <span class="m-r-10"><i class="fa fa-globe"></i> {!! $changetyperequestsdata['company'][0]->website!!}</span>
                        <span class="m-r-10"><i class="fa fa-phone"></i> T:{!! $changetyperequestsdata['company'][0]->phone_number!!}</span>
                        <span class="m-r-10"><i class="fa fa-envelope"></i> {!! $changetyperequestsdata['company'][0]->email_address!!}</span>
                    </p>
                </div>
            </div>
</div>
@endsection