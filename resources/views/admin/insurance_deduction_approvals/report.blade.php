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
            <li class="active">Insurance Deduction Approvals</li>
        </ol>
        <h1 class="page-header hidden-print">Insurance Deduction Approvals <small>insurance deduction approvals report goes
                here...</small></h1>
        <div class="row no-print">
            <div class="col-md-12 hidden-print">
                <a href="{!! route('insurancedeductionapprovals.index') !!}"><button type="button"
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
                            <td><img src="{!! asset('uploads/images/' . $insurancedeductionapprovalsdata['company'][0]->logo) !!}" height='70px' /></td>
                            <td></td>
                        </tr>
                        <div class="invoice-date">
                            <tr>
                                <td></td>
                                <td class="text-center" style="font-size:18px; font-weight:bold; color:#000;">
                                    {!! $insurancedeductionapprovalsdata['company'][0]->name !!}</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td class="text-center" style="color:#000; font-weight: bold; font-family: segoi-ui;">
                                    {!! $insurancedeductionapprovalsdata['company'][0]->street !!} {!! $insurancedeductionapprovalsdata['company'][0]->address !!}</td>
                                <td></td>

                            </tr>
                            <tr>
                                <td></td>
                                <td class="text-center" style="color:#000; font-weight: bold; font-family: segoi-ui;">
                                    {!! $insurancedeductionapprovalsdata['company'][0]->city !!}, {!! $insurancedeductionapprovalsdata['company'][0]->zip_code !!}</td>
                                <td></td>

                            </tr>
                            <tr>
                                <td></td>
                                <td class="text-center" style="color:#000; font-weight: bold; font-family: segoi-ui;">Phone:
                                    {!! $insurancedeductionapprovalsdata['company'][0]->phone_number !!}</td>
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
                                <th>Transaction Reference</th>
                                <th>Approval Level</th>
                                <th>Approved By</th>
                                <th>Approval Status</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($insurancedeductionapprovalsdata['list'] as $insurancedeductionapprovals)
                                <tr>
                                    <td class='table-text'>
                                        <div>
                                            {!! $insurancedeductionapprovals->transactionreferencemodel->transaction_reference !!}
                                        </div>
                                    </td>
                                    <td class='table-text'>
                                        <div>
                                            {!! $insurancedeductionapprovals->approvallevelmodel->name !!}
                                        </div>
                                    </td>
                                    <td class='table-text'>
                                        <div>
                                            {!! $insurancedeductionapprovals->approvedbymodel->name !!}
                                        </div>
                                    </td>
                                    <td class='table-text'>
                                        <div>
                                            {!! $insurancedeductionapprovals->approvalstatusmodel->name !!}
                                        </div>
                                    </td>
                                    <td class='table-text'>
                                        <div>
                                            {!! $insurancedeductionapprovals->date !!}
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
                        <small>TOTAL COUNT</small> {!! count($insurancedeductionapprovalsdata['list']) !!}
                    </div>
                </div>
            </div>
            <div class="invoice-footer text-muted">
                <p class="text-center m-b-5">
                </p>
                <p class="text-center">
                    <span class="m-r-10"><i class="fa fa-globe"></i> {!! $insurancedeductionapprovalsdata['company'][0]->website !!}</span>
                    <span class="m-r-10"><i class="fa fa-phone"></i> T:{!! $insurancedeductionapprovalsdata['company'][0]->phone_number !!}</span>
                    <span class="m-r-10"><i class="fa fa-envelope"></i> {!! $insurancedeductionapprovalsdata['company'][0]->email_address !!}</span>
                </p>
            </div>
        </div>
    </div>
@endsection
