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
            <li class="active">Clearing Fee Approval Levels</li>
        </ol>
        <h1 class="page-header hidden-print">Clearing Fee Approval Levels <small>clearing fee approval levels report goes
                here...</small></h1>
        <div class="row no-print">
            <div class="col-md-12 hidden-print">
                <a href="{!! route('clearingfeeapprovallevels.index') !!}"><button type="button"
                        class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-arrow-left"></i></button></a>
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
            <div class="text-center" id="report-header">
                <table>
                    <tbody>
                        <tr>
                            <td></td>
                            <td><img src="{!! asset('uploads/images/' . $clearingfeeapprovallevelsdata['company'][0]->logo) !!}" height='70px' /></td>
                            <td></td>
                        </tr>
                        <div class="invoice-date">
                            <tr>
                                <td></td>
                                <td class="text-center" style="font-size:18px; font-weight:bold; color:#000;">
                                    {!! $clearingfeeapprovallevelsdata['company'][0]->name !!}</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td class="text-center" style="color:#000; font-weight: bold; font-family: segoi-ui;">
                                    {!! $clearingfeeapprovallevelsdata['company'][0]->street !!} {!! $clearingfeeapprovallevelsdata['company'][0]->address !!}</td>
                                <td></td>

                            </tr>
                            <tr>
                                <td></td>
                                <td class="text-center" style="color:#000; font-weight: bold; font-family: segoi-ui;">
                                    {!! $clearingfeeapprovallevelsdata['company'][0]->city !!}, {!! $clearingfeeapprovallevelsdata['company'][0]->zip_code !!}</td>
                                <td></td>

                            </tr>
                            <tr>
                                <td></td>
                                <td class="text-center" style="color:#000; font-weight: bold; font-family: segoi-ui;">Phone:
                                    {!! $clearingfeeapprovallevelsdata['company'][0]->phone_number !!}</td>
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
                                <th>Approval Level</th>
                                <th>User Account</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($clearingfeeapprovallevelsdata['list'] as $clearingfeeapprovallevels)
                                <tr>
                                    <td class='table-text'>
                                        <div>
                                            {!! $clearingfeeapprovallevels->approvallevelmodel->name !!}
                                        </div>
                                    </td>
                                    <td class='table-text'>
                                        <div>
                                            {!! $clearingfeeapprovallevels->useraccountmodel->name !!}
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
                        <small>TOTAL COUNT</small> {!! count($clearingfeeapprovallevelsdata['list']) !!}
                    </div>
                </div>
            </div>
            <div class="invoice-footer text-muted">
                <p class="text-center m-b-5">
                </p>
                <p class="text-center">
                    <span class="m-r-10"><i class="fa fa-globe"></i> {!! $clearingfeeapprovallevelsdata['company'][0]->website !!}</span>
                    <span class="m-r-10"><i class="fa fa-phone"></i> T:{!! $clearingfeeapprovallevelsdata['company'][0]->phone_number !!}</span>
                    <span class="m-r-10"><i class="fa fa-envelope"></i> {!! $clearingfeeapprovallevelsdata['company'][0]->email_address !!}</span>
                </p>
            </div>
        </div>
    </div>
@endsection
