@extends("admin.home")
@section("main_content")
<div id="content" class="content">
    <ol class="breadcrumb pull-right">
        <li><a href="#">Home</a></li>
        <li><a href="#">Public</a></li>
        <li><a href="#">Client Lgf Contributions</a></li>
        <li class="active">Table</li>
    </ol>
    <h1 class="page-header">Client Lgf Contributions - DATA <small>client lgf contributions data goes here...</small></h1>
    <div class="row">
        <div class="col-md-12">
            @if($clientlgfcontributionsdata['usersaccountsroles'][0]->_add==1)
            <a href="{!! route('clientlgfcontributions.create') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-plus"></i></button></a>
            @endif
            @if($clientlgfcontributionsdata['usersaccountsroles'][0]->_report==1)
            <a href="{!! url('admin/clientlgfcontributionsreport') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-file-text-o"></i></button></a>
            @endif
            @if($clientlgfcontributionsdata['usersaccountsroles'][0]->_report==1 || $clientlgfcontributionsdata['usersaccountsroles'][0]->_list==1)
            <a href="#modal-dialog"  data-toggle="modal"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-filter"></i></button></a>
            @endif
            @if($clientlgfcontributionsdata['usersaccountsroles'][0]->_add==1)
            <a href="{!! url('/admin/clientlgfcontributiondbimport/') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-download"></i></button></a>
            @endif

    @if($clientlgfcontributionsdata['usersaccountsroles'][0]->_list==1)
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <div class="panel-heading-btn">
                        <a href="#" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                        <a href="#" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                        <a href="#" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                        <a href="#" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                    </div>
                    <h4 class="panel-title">DataTable - Autofill</h4>
                </div>
                <div class="panel-body">
                    <table id="data-table" class="table table-striped table-bordered">
                        <thead>
                                    <tr>
                                        <th>Client</th>
                                        <th>Payment Mode</th>
                                        <th>Transaction Number</th>
                                        <th>Date</th>
                                        <th>Amount</th>
                                        <th>Transaction Status</th>
                                        <th>Action</th>                                    </tr>
                        </thead>
                        <tbody>
                        @foreach ($clientlgfcontributionsdata['list'] as $clientlgfcontributions)
                            <tr>
                                <td class='table-text'><div>
                                	{!! $clientlgfcontributions->clientmodel->client_number !!}
                                	{!! $clientlgfcontributions->clientmodel->first_name !!}
                                	{!! $clientlgfcontributions->clientmodel->middle_name !!}
                                	{!! $clientlgfcontributions->clientmodel->last_name !!}
                                </div></td>
                                <td class='table-text'><div>
                                	{!! $clientlgfcontributions->paymentmodemodel->name !!}
                                </div></td>
                                <td class='table-text'><div>
                                	{!! $clientlgfcontributions->transaction_number !!}
                                </div></td>
                                <td class='table-text'><div>
                                	{!! $clientlgfcontributions->date !!}
                                </div></td>
                                <td class='table-text'><div>
                                	{!! $clientlgfcontributions->amount !!}
                                </div></td>
                                <td class='table-text'><div>
                                	{!! $clientlgfcontributions->transactionstatusmodel->name !!}
                                </div></td>
                                <td>
                <form action="{!! route('clientlgfcontributions.destroy',$clientlgfcontributions->id) !!}" method="POST">
                                        @if($clientlgfcontributionsdata['usersaccountsroles'][0]->_show==1)
                                        <a href="{!! route('clientlgfcontributions.show',$clientlgfcontributions->id) !!}" id='show-clientlgfcontributions-{!! $clientlgfcontributions->id !!}' class='btn btn-sm btn-circle btn-inverse'>
                                            <i class='fa fa-btn fa-eye'></i>
                                        </a>
                                        @endif
                                        @if($clientlgfcontributionsdata['usersaccountsroles'][0]->_delete==1)
                                        <input type="hidden" name="_method" value="delete" />
                                        {!! csrf_field() !!}
                                        {!! method_field('DELETE') !!}
                                        <button type='submit' id='delete-clientlgfcontributions-{!! $clientlgfcontributions->id !!}' class='btn btn-sm btn-circle btn-danger'>
                                            <i class='fa fa-btn fa-refresh'></i>
                                        </button>
                                        @endif
                </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
    @endif
<div class="modal fade modal-message" id="modal-dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">close</button>
                <h4 class="modal-title">Client Lgf Contributions - Filter Dialog</h4>
            </div>
            <div class="modal-body">
    			<div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-inverse">
                            <div class="panel-heading">
                                <div class="panel-heading-btn">
                                    <a href="#" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                    <a href="#" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                                    <a href="#" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                                    <a href="#" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                                </div>
                                <h4 class="panel-title">DataForm - Autofill</h4>
                            </div>
                            <div class="panel-body">
                    <form id="form"  class="form-horizontal" action="{!! url('admin/clientlgfcontributionsfilter') !!}" method="POST">
                        {!! csrf_field() !!}
                                <div class="form-group">
                                    <label for="Client" class="col-sm-3 control-label">Client</label>
                                    <div class="col-sm-6">
									    <select class="form-control" name="client"  id="client">
                                            <option value="" >Select Client</option>				                                @foreach ($clientlgfcontributionsdata['clients'] as $clients)
				                                <option value="{!! $clients->id !!}">
					
				                                {!! $clients->client_number!!}
				                                {!! $clients->first_name!!}
				                                {!! $clients->middle_name!!}
				                                {!! $clients->last_name!!}
				                                </option>
				                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Payment Mode" class="col-sm-3 control-label">Payment Mode</label>
                                    <div class="col-sm-6">
									    <select class="form-control" name="payment_mode"  id="payment_mode">
                                            <option value="" >Select Payment Mode</option>				                                @foreach ($clientlgfcontributionsdata['paymentmodes'] as $paymentmodes)
				                                <option value="{!! $paymentmodes->id !!}">
					
				                                {!! $paymentmodes->name!!}
				                                </option>
				                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Transaction Number" class="col-sm-3 control-label">Transaction Number</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="transaction_number"  id="transaction_number" class="form-control" placeholder="Transaction Number" value="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Date" class="col-sm-3 control-label">Date</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="datefrom" id="datefrom" class="form-control m-b-5" placeholder="Date From" value="">
                                        <input type="text" name="dateto" id="dateto" class="form-control" placeholder="Date To" value="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Amount" class="col-sm-3 control-label">Amount</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="amount"  id="amount" class="form-control" placeholder="Amount" value="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Transaction Status" class="col-sm-3 control-label">Transaction Status</label>
                                    <div class="col-sm-6">
									    <select class="form-control" name="transaction_status"  id="transaction_status">
                                            <option value="" >Select Transaction Status</option>				                                @foreach ($clientlgfcontributionsdata['transactionstatuses'] as $transactionstatuses)
				                                <option value="{!! $transactionstatuses->id !!}">
					
				                                {!! $transactionstatuses->name!!}
				                                </option>
				                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-3 col-sm-6">
                                    <div class="col-sm-offset-3 col-sm-6">
                                        <button type="submit" class="btn btn-sm btn-inverse">
                                            <i class="fa fa-btn fa-search"></i> Search Client Lgf Contributions
                                        </button>
                                    </div>
                                </div>
                    </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a href="javascript:;" class="btn btn-sm btn-white" data-dismiss="modal">Close</a>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script language="javascript" type="text/javascript">
$("#datefrom").datepicker({todayHighlight:!0,autoclose:!0});
$("#dateto").datepicker({todayHighlight:!0,autoclose:!0});
</script>
@endsection