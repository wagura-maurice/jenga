@extends('admin.home')
@section('main_content')
    <style type="text/css">
        #report-header {
            width: 100%;
            height: 162px;
            font-weight: bold;
            color: #000;
        }

        #report-header table {
            width: 100%;
        }

        #report-header table tbody tr td {
            width: 33%;
        }
    </style>
    <div id='content' class='content'>
        <ol class="breadcrumb hidden-print pull-right">
            <li><a href="javascript:;">Home</a></li>
            <li class="active">Loan Statement</li>
        </ol>
        <h1 class="page-header hidden-print">Loan Statement <small>Loan Statement report goes here...</small></h1>
        <div class="row no-print">
            <div class="col-md-12 hidden-print">
                <a href="{!! route('salesorders.index') !!}"><button type="button"
                        class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-arrow-left"></i></button></a>
            </div>
        </div>
        <div class="invoice">
            <div class="invoice-company">
                <span class="pull-right hidden-print">
                    <a href="javascript:;" onclick="window.print()" class="btn btn-sm btn-success m-b-10"><i
                            class="fa fa-print m-r-5"></i> Print</a>
                </span>
            </div>
            <div class="text-center" id="report-header">
                <table>
                    <tbody>
                        <tr>
                            <td></td>
                            <td><img src="{!! asset('uploads/images/' . $loanstatement['company'][0]->logo) !!}" style="max-height: 70px;" /></td>
                            <td></td>
                        </tr>
                        <div class="invoice-date">
                            <tr>
                                <td></td>
                                <td class="text-center" style="color:#000; font-weight: bold; font-family: segoi-ui;">
                                    {!! $loanstatement['company'][0]->street !!} {!! $loanstatement['company'][0]->address !!}</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td class="text-center" style="color:#000; font-weight: bold; font-family: segoi-ui;">
                                    {!! $loanstatement['company'][0]->city !!}, {!! $loanstatement['company'][0]->zip_code !!}</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td class="text-center" style="color:#000; font-weight: bold; font-family: segoi-ui;">
                                    {!! $loanstatement['company'][0]->phone_number !!}</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td class="text-center" style="color:#000; font-weight: bold; font-family: segoi-ui;">LOAN
                                    STATEMENT {!! $loanstatement['date'] !!}</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td class="text-center" style="color:#000; font-weight: bold; font-family: segoi-ui;">
                                    {!! $loanstatement['loan']->loan_number !!} - {!! $loanstatement['loan']->clientmodel->first_name !!} {!! $loanstatement['loan']->clientmodel->middle_name !!}
                                    {!! $loanstatement['loan']->clientmodel->last_name !!}</td>
                                <td></td>
                            </tr>

                            <tr>
                                <td></td>
                                <td class="text-center" style="color:#000; font-weight: bold; font-family: segoi-ui;">
                                    Disbursed On : {!! $loanstatement['disbursement_date'] !!}, Amount : {!! number_format($loanstatement['loan']->total_loan_amount, 2, '.', ',') !!} </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td class="text-center" style="color:#000; font-weight: bold; font-family: segoi-ui;">
                                    Payment Frequency : {!! $loanstatement['loan']->loanpaymentfrequencymodel->name !!}, Installment : {!! number_format($loanstatement['installment'], 2, '.', ',') !!},
                                    Balance :{!! number_format($loanstatement['balance'], 2, '.', ',') !!} </td>
                                <td></td>
                            </tr>
                    </tbody>
                </table>
            </div>
            <div class="invoice-content">
                <div class="table-responsive">
                    <table class="table table-invoice">
                        <thead>
                            <tr>
                                <th>DATE</th>
                                <th class="text-right">Amount Paid</th>
                                <th class="text-right">Balance/Status</th>
                                <th colspan="4" class="text-center">Cummulative Expected</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($loanstatement['data'] as $statement)
                                <tr>
                                    <td>{!! $statement->date !!}</td>
                                    <td class="text-right">{!! number_format($statement->amount, 2, '.', ',') !!}</td>
                                    @if ($statement->arrears < 0)
                                        <td class="text-right"><span
                                                class="label label-warning">{!! number_format($statement->balance, 2, '.', ',') !!}</span></td>
                                    @else
                                        <td class="text-right">{!! number_format($statement->balance, 2, '.', ',') !!}</td>
                                    @endif
                                    <td class="text-right">{!! number_format($statement->cummulative_payment, 2, '.', ',') !!}</td>
                                    <td class="text-right">{!! number_format($statement->installment, 2, '.', ',') !!}</td>
                                    <td class="text-right">{!! number_format($statement->cummulative_installment, 2, '.', ',') !!}</td>
                                    <td class="text-right">{!! number_format($statement->arrears, 2, '.', ',') !!}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="invoice-footer text-muted">
                <p class="text-center m-b-5">
                </p>
                <p class="text-center">
                    <span class="m-r-10"><i class="fa fa-globe"></i> {!! $loanstatement['company'][0]->website !!}</span>
                    <span class="m-r-10"><i class="fa fa-phone"></i> T:{!! $loanstatement['company'][0]->phone_number !!}</span>
                    <span class="m-r-10"><i class="fa fa-envelope"></i> {!! $loanstatement['company'][0]->email_address !!}</span>
                    <span class="m-r-10"><i class="fa fa-calendar"></i> {!! $loanstatement['date'] !!}</span>
                </p>
            </div>
        </div>
    </div>
@endsection
