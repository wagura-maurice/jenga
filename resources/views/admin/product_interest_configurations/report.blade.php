@extends('admin.home')
@section('main_content')
    <div id='content' class='content'>
        <ol class="breadcrumb hidden-print pull-right">
            <li><a href="javascript:;">Home</a></li>
            <li class="active">Product Interest Configurations</li>
        </ol>
        <h1 class="page-header hidden-print">Product Interest Configurations <small>product interest configurations report
                goes here...</small></h1>
        <div class="row no-print">
            <div class="col-md-12 hidden-print">
                <a href="{!! route('productinterestconfigurations.index') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i
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
                        <strong>{!! $productinterestconfigurationsdata['company'][0]->name !!}</strong><br />
                        {!! $productinterestconfigurationsdata['company'][0]->street !!} {!! $productinterestconfigurationsdata['company'][0]->address !!}<br />
                        {!! $productinterestconfigurationsdata['company'][0]->city !!}, {!! $productinterestconfigurationsdata['company'][0]->zip_code !!}<br />
                        Phone: {!! $productinterestconfigurationsdata['company'][0]->phone_number !!}<br />
                    </address>
                </div>
                <div class="invoice-date">
                    <img src="{!! secure_asset('uploads/images/' . $productinterestconfigurationsdata['company'][0]->logo) !!}" width='100' height='100' />
                </div>
            </div>
            <div class="invoice-content">
                <div class="table-responsive">
                    <table class="table table-invoice">
                        <thead>
                            <tr>
                                <th>Loan Product</th>
                                <th>Interest Payment Method</th>
                                <th>Payment Mode</th>
                                <th>Debit Account</th>
                                <th>Credit Account</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($productinterestconfigurationsdata['list'] as $productinterestconfigurations)
                                <tr>
                                    <td class='table-text'>
                                        <div>
                                            {!! $productinterestconfigurations->loanproductmodel->name !!}
                                        </div>
                                    </td>
                                    <td class='table-text'>
                                        <div>
                                            {!! $productinterestconfigurations->interestpaymentmethodmodel->name !!}
                                        </div>
                                    </td>
                                    <td class='table-text'>
                                        <div>
                                            {!! $productinterestconfigurations->paymentmodemodel->name !!}
                                        </div>
                                    </td>
                                    <td class='table-text'>
                                        <div>
                                            {!! $productinterestconfigurations->debitaccountmodel->name !!}
                                        </div>
                                    </td>
                                    <td class='table-text'>
                                        <div>
                                            {!! $productinterestconfigurations->creditaccountmodel->name !!}
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
                        <small>TOTAL COUNT</small> {!! count($productinterestconfigurationsdata['list']) !!}
                    </div>
                </div>
            </div>
            <div class="invoice-footer text-muted">
                <p class="text-center m-b-5">
                </p>
                <p class="text-center">
                    <span class="m-r-10"><i class="fa fa-globe"></i> {!! $productinterestconfigurationsdata['company'][0]->website !!}</span>
                    <span class="m-r-10"><i class="fa fa-phone"></i> T:{!! $productinterestconfigurationsdata['company'][0]->phone_number !!}</span>
                    <span class="m-r-10"><i class="fa fa-envelope"></i> {!! $productinterestconfigurationsdata['company'][0]->email_address !!}</span>
                </p>
            </div>
        </div>
    </div>
@endsection
