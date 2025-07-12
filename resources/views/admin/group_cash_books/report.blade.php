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
        <li class="active">Group Cash Books</li>
    </ol>
    <h1 class="page-header hidden-print">Group Cash Books <small>group cash books report goes here...</small></h1>
    <div class="row no-print">
        <div class="col-md-12 hidden-print">
            <a href="{!! route('groupcashbooks.index') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-arrow-left"></i></button></a>
        </div>
    </div>
    <div class="invoice">
        <div class="invoice-company">
            <span class="pull-right hidden-print">
                <a href="{!! route('groupcashbooksreport.export', [$groupcashbooksdata['id'], $groupcashbooksdata['startDate'] ?? NULL, $groupcashbooksdata['endDate'] ?? NULL]) !!}" class="btn btn-sm btn-success m-b-10"><i class="fa fa-download m-r-5"></i> Export as Excel</a>
                <a href="javascript:;" class="btn btn-sm btn-success m-b-10"><i class="fa fa-download m-r-5"></i> Export as PDF</a>
                <a href="javascript:;" onclick="window.print()" class="btn btn-sm btn-success m-b-10"><i class="fa fa-print m-r-5"></i> Print</a>
            </span>
        </div>

        <div class="text-center" id="report-header">

            <table>
                <tbody>
                    <tr>
                        <td></td>
                        <td><img src="{!!asset('uploads/images/'.$groupcashbooksdata['company'][0]->logo)!!}" height='70px' /></td>
                        <td></td>
                    </tr>
                    <div class="invoice-date">
                        <tr>
                            <td></td>
                            <td class="text-center" style="font-size:18px; font-weight:bold; color:#000;">{!! $groupcashbooksdata['company'][0]->name!!}</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td class="text-center" style="color:#000; font-weight: bold; font-family: segoi-ui;">{!! $groupcashbooksdata['company'][0]->street!!} {!! $groupcashbooksdata['company'][0]->address!!}</td>
                            <td></td>

                        </tr>
                        <tr>
                            <td></td>
                            <td class="text-center" style="color:#000; font-weight: bold; font-family: segoi-ui;">{!! $groupcashbooksdata['company'][0]->city!!}, {!! $groupcashbooksdata['company'][0]->zip_code!!}</td>
                            <td></td>

                        </tr>
                        <tr>
                            <td></td>
                            <td class="text-center" style="color:#000; font-weight: bold; font-family: segoi-ui;">Phone: {!! $groupcashbooksdata['company'][0]->phone_number!!}</td>
                            <td></td>
                        </tr>
                </tbody>
            </table>
        </div>
        <div class="invoice-content">
            <table>
                <tr>
                    <th style="padding:10px;">
                        <div class="row">
                            <div class="col-lg-12">

                                <label for="transaction_date" class="control-label col-lg-6 m-t-10">Start Date</label>
                                <div class="col-lg-6 m-t-10">
                                    <input type="text" autocomplete="off" name="start_date" id="start_date" class="form-control" placeholder="Start Date" value="{{ \Carbon\Carbon::parse($groupcashbooksdata['startDate'])->format('d-m-Y') }}" required="required" data-date-format="dd-mm-yyyy" data-date-end-date="Date.default">
                                </div>
                            </div>
                        </div>
                    </th>
                    <th style="padding:10px;">
                        <div class="row">
                            <div class="col-lg-12">
                                <label for="transaction_date" class="control-label col-lg-6 m-t-10">End Date</label>
                                <div class="col-lg-6 m-t-10">
                                    <input type="text" autocomplete="off" name="end_date" id="end_date" class="form-control" placeholder="End Date" value="{{ \Carbon\Carbon::parse($groupcashbooksdata['endDate'])->format('d-m-Y') }}" required="required" data-date-format="dd-mm-yyyy" data-date-end-date="Date.default">
                                </div>

                            </div>
                        </div>
                    </th>
                </tr>
                <tr>
                    <th style="padding:10px;">
                        <div class="row">
                            <div class="col-lg-12">
                                <label for="transaction_date" class="control-label col-lg-6 m-t-10">Opening Balance : {!! number_format($groupcashbooksdata['opening-balance'], 2) !!}</label>
                                <label for="transaction_date" class="control-label col-lg-6 m-t-10"></label>
                            </div>
                            <div class="col-lg-12">
                                <label for="transaction_date" class="control-label col-lg-6 m-t-10">Debit : {!! number_format($groupcashbooksdata['working-debit'], 2) !!}</label>
                                <label for="transaction_date" class="control-label col-lg-6 m-t-10"></label>
                            </div>
                        </div>
                    </th>
                    <th style="padding:10px;">
                        <div class="row">
                            <div class="col-lg-12">
                                <label for="transaction_date" class="control-label col-lg-6 m-t-10">Closing Balance : {!! number_format($groupcashbooksdata['closing-balance'], 2) !!}</label>
                                <label for="transaction_date" class="control-label col-lg-6 m-t-10"></label>
                            </div>
                            <div class="col-lg-12">
                                <label for="transaction_date" class="control-label col-lg-6 m-t-10">Credit : {!! number_format($groupcashbooksdata['working-credit'], 2) !!}</label>
                                <label for="transaction_date" class="control-label col-lg-6 m-t-10"></label>
                            </div>
                        </div>
                    </th>
                </tr>                
                <tr>
                    <th colspan="2">CASHBOOK FOR ALL MODES OF PAYMENT</th>
                </tr>
                <tr>
                    <td style="vertical-align: top;">

                        <table class="table table-striped table-bordered">
                            <thead>

                                <tr>
                                    <th>DEBIT SIDE</th>
                                    <th>MODE OF PAYMENT</th>
                                    <th>{!!$groupcashbooksdata["account"]->name!!}</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                                <tr>
                                    <th>Transaction Date</th>
                                    <th>Group ID</th>
                                    <td>Transaction ID</td>
                                    <th>Group Name</th>
                                    <th>Total Receipts</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($groupcashbooksdata['list-b-view'] as $groupcashbooks)
                                <tr>
                                    <td class='table-text'>
                                        <div>
                                            {!! isset($groupcashbooks->transaction_date) ? \Carbon\Carbon::parse($groupcashbooks->transaction_date)->format('d-m-Y') : NULL !!}
                                        </div>
                                    </td>
                                    <td class='table-text'>
                                        <div>
                                            {!! isset($groupcashbooks->transacting_group) ? $groupcashbooks->transacting_group->group_number : '' !!}
                                        </div>
                                    </td>
                                    <td class='table-text'>
                                        <div>
                                            {!! isset($groupcashbooks->transaction_reference) ? $groupcashbooks->transaction_reference : NULL !!}
                                        </div>
                                    </td>
                                    <td class='table-text'>
                                        <div>
                                            {!! isset($groupcashbooks->transacting_group) ? $groupcashbooks->transacting_group->group_name : '' !!}
                                        </div>
                                    </td>
                                    <td class='table-text'>
                                        <div>
                                            {!! number_format(isset($groupcashbooks->amount) ? $groupcashbooks->amount : 0, 2) !!}
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {!! $groupcashbooksdata['list-b-view']->links() !!}
                    </td>
                    <td style="vertical-align: top;">

                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>CREDIT SIDE</th>
                                    <th>MODE OF PAYMENT</th>
                                    <th>{!!$groupcashbooksdata["account"]->name!!}</th>
                                    <th></th>
                                </tr>
                                <tr>

                                    <th>Transaction Date</th>
                                    <th>Particulars</th>
                                    <th>Cheque No.</th>
                                    <th>Total Payments</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($groupcashbooksdata['list-a-view'] as $groupcashbooks)
                                <tr>
                                    <td class='table-text'>
                                        <div>
                                            {!! isset($groupcashbooks->transaction_date) ? \Carbon\Carbon::parse($groupcashbooks->transaction_date)->format('d-m-Y') : NULL !!}
                                        </div>
                                    </td>
                                    <td class='table-text'>
                                        <div>
                                            {!! isset($groupcashbooks->particulars) ? $groupcashbooks->particulars : NULL !!}
                                        </div>
                                    </td>
                                    <td class='table-text'>
                                        <div>
                                            {!! isset($groupcashbooks->transaction_reference) ? $groupcashbooks->transaction_reference : NULL !!}
                                        </div>
                                    </td>
                                    <td class='table-text'>
                                        <div>
                                            {!! number_format(isset($groupcashbooks->amount) ? $groupcashbooks->amount : 0, 2) !!}
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {!! $groupcashbooksdata['list-a-view']->links() !!}
                    </td>
                </tr>
            </table>

        </div>
        <div class="invoice-footer text-muted">
            <p class="text-center m-b-5">
            </p>
            <p class="text-center">
                <span class="m-r-10"><i class="fa fa-globe"></i> {!! $groupcashbooksdata['company'][0]->website!!}</span>
                <span class="m-r-10"><i class="fa fa-phone"></i> T:{!! $groupcashbooksdata['company'][0]->phone_number!!}</span>
                <span class="m-r-10"><i class="fa fa-envelope"></i> {!! $groupcashbooksdata['company'][0]->email_address!!}</span>
            </p>
        </div>
    </div>
</div>
@endsection
@section('script')
<script language="javascript" type="text/javascript">
    $("#start_date").datepicker({
        todayHighlight: !0,
        autoclose: !0,
    }).on("change",function(){
        if($("#end_date").val() && $("#start_date").val()){
            var id="{!!$groupcashbooksdata['account']->id!!}";
            window.location.href="{{url('/admin/groupcashbooksreport/')}}/"+id+"/"+$("#start_date").val()+"/"+$("#end_date").val()+"";
        }
    });
    $("#end_date").datepicker({
        todayHighlight: !0,
        autoclose: !0
    }).on("change",function(){
        if($("#end_date").val() && $("#start_date").val()){
            var id="{!!$groupcashbooksdata['account']->id!!}";
            window.location.href="{{url('/admin/groupcashbooksreport/')}}/"+id+"/"+$("#start_date").val()+"/"+$("#end_date").val()+"";
        }
    });
</script>
@endsection