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
            <li class="active">LGF Statement</li>
        </ol>
        <h1 class="page-header hidden-print">LGF Statement <small>LGF Statement report goes here...</small></h1>
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
                            <td><img src="{!! secure_asset('uploads/images/' . $clientstatement['company'][0]->logo) !!}" style="max-height: 70px;" /></td>
                            <td></td>
                        </tr>
                        <div class="invoice-date">
                            <tr>
                                <td></td>
                                <td class="text-center" style="color:#000; font-weight: bold; font-family: segoi-ui;">
                                    {!! $clientstatement['company'][0]->street !!} {!! $clientstatement['company'][0]->address !!}</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td class="text-center" style="color:#000; font-weight: bold; font-family: segoi-ui;">
                                    {!! $clientstatement['company'][0]->city !!}, {!! $clientstatement['company'][0]->zip_code !!}</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td class="text-center" style="color:#000; font-weight: bold; font-family: segoi-ui;">
                                    {!! $clientstatement['company'][0]->phone_number !!}</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td class="text-center" style="color:#000; font-weight: bold; font-family: segoi-ui;">LGF
                                    Statement {!! $clientstatement['date'] !!}</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td class="text-center" style="color:#000; font-weight: bold; font-family: segoi-ui;">
                                    {!! $clientstatement['client']->client_number !!} - {!! $clientstatement['client']->first_name !!} {!! $clientstatement['client']->middle_name !!}
                                    {!! $clientstatement['client']->last_name !!}</td>
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
                                <th>Transaction Number</th>
                                <th>Transaction Date</th>
                                <th>Details</th>
                                <th>Amount</th>
                                <th>Running Balance</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($clientstatement['data'] as $statement)
                                <tr>
                                    <td>{!! $statement->transaction_number !!}</td>
                                    <td>{!! $statement->created_at !!}</td>
                                    <td>{!! $statement->secondary_description !!}</td>
                                    <td>{!! $statement->amount !!}</td>
                                    <td>{!! $statement->balance !!}</td>
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
                    <span class="m-r-10"><i class="fa fa-globe"></i> {!! $clientstatement['company'][0]->website !!}</span>
                    <span class="m-r-10"><i class="fa fa-phone"></i> T:{!! $clientstatement['company'][0]->phone_number !!}</span>
                    <span class="m-r-10"><i class="fa fa-envelope"></i> {!! $clientstatement['company'][0]->email_address !!}</span>
                    <span class="m-r-10"><i class="fa fa-calendar"></i> {!! $clientstatement['date'] !!}</span>
                </p>
            </div>
        </div>
    </div>
@endsection
