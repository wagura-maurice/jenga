@extends('admin.home')
@section('main_content')
<div id='content' class='content'>
            <ol class="breadcrumb hidden-print pull-right">
                <li><a href="javascript:;">Home</a></li>
                <li class="active">General Ledgers</li>
            </ol>
            <h1 class="page-header hidden-print">General Ledgers <small>general ledgers report goes here...</small></h1>
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
                            <strong>{!! $trialbalancedata['company'][0]->name!!}</strong><br/>
                            {!! $trialbalancedata['company'][0]->street!!} {!! $trialbalancedata['company'][0]->address!!}<br />
                            {!! $trialbalancedata['company'][0]->city!!}, {!! $trialbalancedata['company'][0]->zip_code!!}<br />
                            Phone: {!! $trialbalancedata['company'][0]->phone_number!!}<br />
                        </address>
                    </div>
                    <div class="invoice-date">
                        <img src="{!!asset('uploads/images/'.$trialbalancedata['company'][0]->logo)!!}" width='100' height='100'/>
                    </div>
                </div>
                <div class="invoice-content">
                    <div class="table-responsive">
                        <table class="table table-invoice">
                        <thead>
                                    <tr>
                                        <th>Account</th>
                                        <th>Debit</th>
                                        <th>Credit</th>
                                                                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($trialbalancedata['ledger'] as $ledger)
                            <tr>
                                <td class='table-text'><div>
                                    {!! $ledger['account'] !!}
                                    
                                </div></td>
                                <td class='table-text'><div>
                                    {!! $ledger['debit'] !!}
                                </div></td>
                                <td class='table-text'><div>
                                    {!! $ledger['credit'] !!}
                                    
                                </div></td>
                                
                            </tr>
                        @endforeach
                            <tr style="font-weight: bold;">
                                <td class='table-text'><div>
                                    Totals
                                    
                                </div></td>
                                <td class='table-text'><div>
                                    {!! $trialbalancedata['totaldebit'] !!}
                                </div></td>
                                <td class='table-text'><div>
                                    {!! $trialbalancedata['totalcredit'] !!}
                                    
                                </div></td>
                                
                            </tr>
                        <tr style="font-weight: bold;">
                            <td class='table-text'>
                                <div></div>
                            </td>
                            <input type="hidden" name="pageIndex" value="{{$trialbalancedata['pageIndex']}}"/>
                            <input type="hidden" name="pageSize" value="{{$trialbalancedata['pageSize']}}"/>
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
                    </div> -->
                </div>
                <div class="invoice-footer text-muted">
                    <p class="text-center m-b-5">
                    </p>
                    <p class="text-center">
                        <span class="m-r-10"><i class="fa fa-globe"></i> {!! $trialbalancedata['company'][0]->website!!}</span>
                        <span class="m-r-10"><i class="fa fa-phone"></i> T:{!! $trialbalancedata['company'][0]->phone_number!!}</span>
                        <span class="m-r-10"><i class="fa fa-envelope"></i> {!! $trialbalancedata['company'][0]->email_address!!}</span>
                    </p>
                </div>
            </div>
</div>
<script>

function paginate(){

    var pageSize=Number($("input[name='pageSize']").val());
    
    var pageIndex=Number($("input[name='pageIndex']").val())+pageSize;

    window.location.href="{{url('/admin/balancesheet/')}}/"+pageIndex+"/"+pageSize;

}

</script>
@endsection