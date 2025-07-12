@extends('admin.home')
@section('main_content')
<div id='content' class='content'>
            <ol class="breadcrumb hidden-print pull-right">
                <li><a href="javascript:;">Home</a></li>
                <li class="active">Loans</li>
            </ol>
            <h1 class="page-header hidden-print">Loans <small>loans report goes here...</small></h1>
            <div class="row no-print">
                <div class="col-md-12 hidden-print">
                    <a href="{!! route('loans.index') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-arrow-left"></i></button></a>
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
                            <strong>{!! $loansdata['company'][0]->name!!}</strong><br/>
                            {!! $loansdata['company'][0]->street!!} {!! $loansdata['company'][0]->address!!}<br />
                            {!! $loansdata['company'][0]->city!!}, {!! $loansdata['company'][0]->zip_code!!}<br />
                            Phone: {!! $loansdata['company'][0]->phone_number!!}<br />
                        </address>
                    </div>
                    <div class="invoice-date">
                        <img src="{!!asset('uploads/images/'.$loansdata['company'][0]->logo)!!}" width='100' height='100'/>
                    </div>
                </div>
                <div class="invoice-content">
                    <div class="table-responsive">
                        <table class="table table-invoice">
                        <thead>
                                    <tr>
                                        <th>Loan Number</th>
                                        <th>Loan Product</th>
                                        <th>Client</th>
                                        <th>Date</th>
                                        <th>Amount</th>
                                        <th>Interest Rate Type</th>
                                        <th>Interest Rate</th>
                                        <th>Interest Payment Method</th>                                    </tr>
                        </thead>
                        <tbody>
                        @foreach ($loansdata['list'] as $loans)
                            <tr>
                                <td class='table-text'><div>
                                    {!! $loans->loan_number !!}
                                </div></td>
                                <td class='table-text'><div>
                                    {!! $loans->loanproductmodel->name !!}
                                </div></td>
                                <td class='table-text'><div>
                                    {!! $loans->clientmodel->client_number !!}
                                    {!! $loans->clientmodel->first_name !!}
                                    {!! $loans->clientmodel->middle_name !!}
                                    {!! $loans->clientmodel->last_name !!}
                                </div></td>
                                <td class='table-text'><div>
                                    {!! $loans->date !!}
                                </div></td>
                                <td class='table-text'><div>
                                    {!! $loans->amount !!}
                                </div></td>
                                <td class='table-text'><div>
                                    {!! $loans->interestratetypemodel->name !!}
                                </div></td>
                                <td class='table-text'><div>
                                    {!! $loans->interest_rate !!}
                                </div></td>
                                <td class='table-text'><div>
                                    {!! $loans->interestpaymentmethodmodel->name !!}
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
                            <small>TOTAL COUNT</small> {!!count($loansdata['list'])!!}
                        </div>
                    </div>
                </div>
                <div class="invoice-footer text-muted">
                    <p class="text-center m-b-5">
                    </p>
                    <p class="text-center">
                        <span class="m-r-10"><i class="fa fa-globe"></i> {!! $loansdata['company'][0]->website!!}</span>
                        <span class="m-r-10"><i class="fa fa-phone"></i> T:{!! $loansdata['company'][0]->phone_number!!}</span>
                        <span class="m-r-10"><i class="fa fa-envelope"></i> {!! $loansdata['company'][0]->email_address!!}</span>
                    </p>
                </div>
            </div>
</div>
@endsection