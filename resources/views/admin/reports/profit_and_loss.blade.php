@extends('admin.home')
@section('main_content')
<div id='content' class='content'>
    <div class="row">
        <div class="col-lg-12">
            <ol class="breadcrumb hidden-print pull-right">
                <li><a href="javascript:;">Home</a></li>
                <li class="active">Profit And Loss</li>
            </ol>
            <h1 class="page-header hidden-print">Profit And Loss <small>Profit And Loss report goes here...</small></h1>
        </div>                
    </div>
    <div class="row">
        <form>
            <div class="form-group col-lg-3">
                <div class="col-lg-4">
                    <label class="form-label text-right">Date From</label>    
                </div>
                <div class="col-lg-8">
                    <input type="text" name="date_from"  class="form-control" />
                </div>
            </div>
            <div class="form-group col-lg-3">
                <div class="col-lg-4">
                    <label class="form-label text-right">Date To</label>    
                </div>
                <div class="col-lg-8">
                    <input type="text" name="date_to" class="form-control" />
                </div>
            </div>
            <div class="form-group col-lg-3">
                <div class="col-lg-2">
                    <input type="checkbox" name="show_zeros"/>   
                </div>
                <div class="col-lg-8">
                    <label class="form-label text-left">Show Zeros?</label>    
                </div>
            </div>
            <div class="form-group col-lg-3">
                <div class="col-lg-8">
                    <button class="form-control btn-primary" type="submit">Run Report</button>
                </div>
            </div>
        </form>
    </div>
    <div class="row no-print">
        <div class="col-md-12 hidden-print">
            <a href="{!! route('generalledgers.index') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-arrow-left"></i></button></a>
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
                    <strong>{!! $profitandlossdata['company'][0]->name!!}</strong><br/>
                    {!! $profitandlossdata['company'][0]->street!!} {!! $profitandlossdata['company'][0]->address!!}<br />
                    {!! $profitandlossdata['company'][0]->city!!}, {!! $profitandlossdata['company'][0]->zip_code!!}<br />
                    Phone: {!! $profitandlossdata['company'][0]->phone_number!!}<br />
                </address>
            </div>
            <div class="invoice-date">
                <img src="{!!asset('uploads/images/'.$profitandlossdata['company'][0]->logo)!!}" width='100' height='100'/>
            </div>
        </div>
        <div class="invoice-content">
            <div class="table-responsive">
                <table class="table table-invoice">
                    <thead>
                        <tr>
                            <th>Account</th>
                            <th>Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr style="font-weight: bold;">
                            <td class='table-text'><div>
                                Income
                            </div></td>
                            <td class='table-text'><div>
                            </div></td>
                        </tr>
                        @foreach ($profitandlossdata['income'] as $income)
                        <tr>
                            <td class='table-text'><div>
                                {!! $income['account'] !!}
                            </div></td>
                            <td class='table-text'><div>
                                {!! $income['amount'] !!}
                            </div></td>
                        </tr>
                        @endforeach
                        <tr style="font-weight: bold;">
                            <td class='table-text'><div>
                                Gross Profit
                            </div></td>
                            <td class='table-text'><div>
                                {{$profitandlossdata['grossprofit']}}
                            </div></td>
                        </tr>
                        <tr style="font-weight: bold;">
                            <td class='table-text'><div>
                                Expenses
                            </div></td>
                            <td class='table-text'><div>
                            </div></td>
                        </tr>
                        @foreach ($profitandlossdata['expense'] as $expense)
                        <tr>
                            <td class='table-text'><div>
                                {!! $expense['account'] !!}
                            </div></td>
                            <td class='table-text'><div>
                                {!! $expense['amount'] !!}
                            </div></td>
                        </tr>
                        @endforeach
                        <tr style="font-weight: bold;">
                            <td class='table-text'><div>
                                Total Expenses
                            </div></td>
                            <td class='table-text'><div>
                                {{$profitandlossdata['totalexpense']}}
                            </div></td>
                        </tr>
                        <tr style="font-weight: bold;">
                            <td class='table-text'><div>
                                Net Profit
                            </div></td>
                            <td class='table-text'><div>
                                {{$profitandlossdata['netprofit']}}
                            </div></td>
                        </tr>
                        <tr style="font-weight: bold;">
                            <td class='table-text'>
                                <div></div>
                            </td>
                            <input type="hidden" name="pageIndex" value="{{$profitandlossdata['pageIndex']}}"/>
                            <input type="hidden" name="pageSize" value="{{$profitandlossdata['pageSize']}}"/>
                            <td class='table-text'>
                                <div><button type="button" onclick="paginate()" class="btn btn-inverse">Previous</button></div>
                            </td>
                            <td class='table-text'>
                                <div><button type="button" onclick="paginate()" class="btn btn-inverse">Next</button></div>
                            </td>
                        </tr>                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="invoice-footer text-muted">
    <p class="text-center m-b-5">
    </p>
    <p class="text-center">
        <span class="m-r-10"><i class="fa fa-globe"></i> {!! $profitandlossdata['company'][0]->website!!}</span>
        <span class="m-r-10"><i class="fa fa-phone"></i> T:{!! $profitandlossdata['company'][0]->phone_number!!}</span>
        <span class="m-r-10"><i class="fa fa-envelope"></i> {!! $profitandlossdata['company'][0]->email_address!!}</span>
    </p>
</div>
<script>

function paginate(){

    var pageSize=Number($("input[name='pageSize']").val());
    
    var pageIndex=Number($("input[name='pageIndex']").val())+pageSize;

    window.location.href="{{url('/admin/profitandloss/')}}/"+pageIndex+"/"+pageSize;

}

</script>
@endsection