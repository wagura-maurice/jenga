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
            <li class="active">Cash Book</li>
        </ol>
        <h1 class="page-header hidden-print">Cash Book <small>Cash Book report goes here...</small></h1>
        <div class="row no-print">
            <div class="col-md-12 hidden-print">
                <a href="{!! route('cashbook.index') !!}"><button type="button"
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
                            <td><img src="{!! secure_asset('uploads/images/' . $cashbook['company'][0]->logo) !!}" style="max-height: 70px;" /></td>
                            <td></td>
                        </tr>
                        <div class="invoice-date">
                            <tr>
                                <td></td>
                                <td class="text-center" style="color:#000; font-weight: bold; font-family: segoi-ui;">
                                    {!! $cashbook['company'][0]->street !!} {!! $cashbook['company'][0]->address !!}</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td class="text-center" style="color:#000; font-weight: bold; font-family: segoi-ui;">
                                    {!! $cashbook['company'][0]->city !!}, {!! $cashbook['company'][0]->zip_code !!}</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td class="text-center" style="color:#000; font-weight: bold; font-family: segoi-ui;">
                                    {!! $cashbook['company'][0]->phone_number !!}</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td class="text-center" style="color:#000; font-weight: bold; font-family: segoi-ui;">CASH
                                    BOOK {!! $cashbook['date'] !!}</td>
                                <td></td>
                            </tr>


                    </tbody>
                </table>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="col-lg-6">

                        <table class="table">
                            <thead>
                                <tr>
                                    <th colspan="3">Debits</th>
                                </tr>
                                <tr>
                                    <th>Tran Date</th>
                                    <th>Group ID</th>
                                    <th>Tran ID</th>
                                    <th>Group Name</th>
                                    <th>Middle Name</th>
                                    <th class="text-right">Total Receipts</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cashbook['debits'] as $debit)
                                    <tr>
                                        <td class='table-text'>
                                            <div>
                                                {!! $debit->date !!}
                                            </div>
                                        </td>
                                        <td class='table-text'>
                                            <div>
                                                {!! $debit->groupid !!}
                                            </div>
                                        </td>
                                        <td class='table-text'>
                                            <div>
                                                {!! $debit->transaction_number !!}
                                            </div>
                                        </td>
                                        <td class='table-text'>
                                            <div>
                                                {!! $debit->groupname !!}
                                            </div>
                                        </td>
                                        <td class='table-text'>
                                            <div>
                                                @if (isset($debit->client))
                                                    {!! $debit->clientmodel->first_name !!}
                                                    {!! $debit->clientmodel->last_name !!}
                                                @endif
                                            </div>
                                        </td>
                                        <td class='table-text text-right'>
                                            <div>
                                                {!! number_format($debit->amount, 2, '.', ',') !!}
                                            </div>
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td>
                                        Total
                                    </td>
                                    <td>

                                    </td>
                                    <td>

                                    </td>
                                    <td>

                                    </td>

                                    <td class="text-right">
                                        {!! number_format($cashbook['totaldebits'], 2, '.', ',') !!}
                                    </td>

                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div class="col-lg-6">
                        <div class="table-responsive">
                            <table class="table table-invoice">
                                <thead>
                                    <tr>
                                        <th colspan="3" class="text-right">Credits</th>
                                    </tr>
                                    <tr>
                                        <th>Date</th>
                                        <th>Particulars</th>
                                        <th>Cheque No.</th>
                                        <th class="text-right">Total Payments</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cashbook['credits'] as $credit)
                                        <tr>
                                            <td class='table-text'>
                                                <div>
                                                    {!! $credit->date !!}
                                                </div>
                                            </td>
                                            <td class='table-text'>
                                                <div>
                                                    {!! $credit->secondary_description !!}
                                                </div>
                                            </td>
                                            <td class='table-text'>
                                                <div>
                                                </div>
                                            </td>
                                            <td class='table-text text-right'>
                                                <div>
                                                    {!! number_format($credit->amount, 2, '.', ',') !!}
                                                </div>
                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td>
                                            Total
                                        </td>
                                        <td>

                                        </td>
                                        <td class="text-right">
                                            {!! number_format($cashbook['totalcredits'], 2, '.', ',') !!}
                                        </td>

                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="invoice-footer text-muted">
                <p class="text-center m-b-5">
                </p>
                <p class="text-center">
                    <span class="m-r-10"><i class="fa fa-globe"></i> {!! $cashbook['company'][0]->website !!}</span>
                    <span class="m-r-10"><i class="fa fa-phone"></i> T:{!! $cashbook['company'][0]->phone_number !!}</span>
                    <span class="m-r-10"><i class="fa fa-envelope"></i> {!! $cashbook['company'][0]->email_address !!}</span>
                    <span class="m-r-10"><i class="fa fa-calendar"></i> {!! $cashbook['date'] !!}</span>
                </p>
            </div>
        </div>
    </div>
@endsection
