@extends('admin.home')
@section('main_content')
    <div id='content' class='content'>
        <ol class="breadcrumb hidden-print pull-right">
            <li><a href="javascript:;">Home</a></li>
            <li class="active">Client Lgf Contributions</li>
        </ol>
        <h1 class="page-header hidden-print">Client Lgf Contributions <small>client lgf contributions report goes
                here...</small></h1>
        <div class="row no-print">
            <div class="col-md-12 hidden-print">
                <a href="{!! route('clientlgfcontributions.index') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i
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
                        <strong>{!! $clientlgfcontributionsdata['company'][0]->name !!}</strong><br />
                        {!! $clientlgfcontributionsdata['company'][0]->street !!} {!! $clientlgfcontributionsdata['company'][0]->address !!}<br />
                        {!! $clientlgfcontributionsdata['company'][0]->city !!}, {!! $clientlgfcontributionsdata['company'][0]->zip_code !!}<br />
                        Phone: {!! $clientlgfcontributionsdata['company'][0]->phone_number !!}<br />
                    </address>
                </div>
                <div class="invoice-date">
                    <img src="{!! secure_asset('uploads/images/' . $clientlgfcontributionsdata['company'][0]->logo) !!}" width='100' height='100' />
                </div>
            </div>
            <div class="invoice-content">
                <div class="table-responsive">
                    <table class="table table-invoice">
                        <thead>
                            <tr>
                                <th>Client</th>
                                <th>Payment Mode</th>
                                <th>Transaction Number</th>
                                <th>Date</th>
                                <th>Amount</th>
                                <th>Transaction Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($clientlgfcontributionsdata['list'] as $clientlgfcontributions)
                                <tr>
                                    <td class='table-text'>
                                        <div>
                                            {!! $clientlgfcontributions->clientmodel->client_number !!}
                                            {!! $clientlgfcontributions->clientmodel->first_name !!}
                                            {!! $clientlgfcontributions->clientmodel->middle_name !!}
                                            {!! $clientlgfcontributions->clientmodel->last_name !!}
                                        </div>
                                    </td>
                                    <td class='table-text'>
                                        <div>
                                            {!! $clientlgfcontributions->paymentmodemodel->name !!}
                                        </div>
                                    </td>
                                    <td class='table-text'>
                                        <div>
                                            {!! $clientlgfcontributions->transaction_number !!}
                                        </div>
                                    </td>
                                    <td class='table-text'>
                                        <div>
                                            {!! $clientlgfcontributions->date !!}
                                        </div>
                                    </td>
                                    <td class='table-text'>
                                        <div>
                                            {!! $clientlgfcontributions->amount !!}
                                        </div>
                                    </td>
                                    <td class='table-text'>
                                        <div>
                                            {!! $clientlgfcontributions->transactionstatusmodel->name !!}
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
                        <small>TOTAL COUNT</small> {!! count($clientlgfcontributionsdata['list']) !!}
                    </div>
                </div>
            </div>
            <div class="invoice-footer text-muted">
                <p class="text-center m-b-5">
                </p>
                <p class="text-center">
                    <span class="m-r-10"><i class="fa fa-globe"></i> {!! $clientlgfcontributionsdata['company'][0]->website !!}</span>
                    <span class="m-r-10"><i class="fa fa-phone"></i> T:{!! $clientlgfcontributionsdata['company'][0]->phone_number !!}</span>
                    <span class="m-r-10"><i class="fa fa-envelope"></i> {!! $clientlgfcontributionsdata['company'][0]->email_address !!}</span>
                </p>
            </div>
        </div>
    </div>
@endsection
