@extends("admin.home")
@section("main_content")
<style type="text/css">
	td div img{
		max-width: 64px;
	}
</style>
<div id="content" class="content">
    <ol class="breadcrumb pull-right">
        <li><a href="#">Home</a></li>
        <li><a href="#">Public</a></li>
        <li><a href="#">Disbursement Charges Configurations </a></li>
        <li class="active">Table</li>
    </ol>
    <h1 class="page-header">Disbursement Charges Configurations  - DATA <small>disbursement charges configurations  data goes here...</small></h1>
    <div class="row">
        <div class="col-md-12">
            @if($disbursementchargesconfigurationsdata['usersaccountsroles'][0]->_add==1)
            <a href="{!! route('disbursementchargesconfigurations.create') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-plus"></i></button></a>
            @endif
            @if($disbursementchargesconfigurationsdata['usersaccountsroles'][0]->_report==1)
            <a href="{!! url('admin/disbursementchargesconfigurationsreport') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-file-text-o"></i></button></a>
            @endif
            @if($disbursementchargesconfigurationsdata['usersaccountsroles'][0]->_report==1 || $disbursementchargesconfigurationsdata['usersaccountsroles'][0]->_list==1)
            <a href="#modal-dialog"  data-toggle="modal"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-filter"></i></button></a>
            @endif
        </div>
    </div>
    @if($disbursementchargesconfigurationsdata['usersaccountsroles'][0]->_list==1)
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
                                        <th>Loan Product</th>
                                        <th>Disbursement Charge</th>
                                        <th>Disbursement Mode</th>
                                        <th>Debit Account</th>
                                        <th>Credit Account</th>
                                        <th>Amount</th>
                                        <th>Action</th>                                    </tr>
                        </thead>
                        <tbody>
                        @foreach ($disbursementchargesconfigurationsdata['list'] as $disbursementchargesconfigurations)
                            <tr>
                                <td class='table-text'><div>
                                	{!! $disbursementchargesconfigurations->loanproductmodel->name !!}
                                </div></td>
                                <td class='table-text'><div>
                                	{!! $disbursementchargesconfigurations->disbursementchargemodel->name !!}
                                </div></td>
                                <td class='table-text'><div>
                                	{!! $disbursementchargesconfigurations->disbursementmodemodel->name !!}
                                </div></td>
                                <td class='table-text'><div>
                                	{!! $disbursementchargesconfigurations->debitaccountmodel->name !!}
                                </div></td>
                                <td class='table-text'><div>
                                	{!! $disbursementchargesconfigurations->creditaccountmodel->name !!}
                                </div></td>
                                <td class='table-text'><div>
                                	{!! $disbursementchargesconfigurations->amount !!}
                                </div></td>
                                <td>
                <form action="{!! route('disbursementchargesconfigurations.destroy',$disbursementchargesconfigurations->id) !!}" method="POST">
                                        @if($disbursementchargesconfigurationsdata['usersaccountsroles'][0]->_show==1)
                                        <a href="{!! route('disbursementchargesconfigurations.show',$disbursementchargesconfigurations->id) !!}" id='show-disbursementchargesconfigurations-{!! $disbursementchargesconfigurations->id !!}' class='btn btn-sm btn-circle btn-inverse'>
                                            <i class='fa fa-btn fa-eye'></i>
                                        </a>
                                        @endif
                                        @if($disbursementchargesconfigurationsdata['usersaccountsroles'][0]->_edit==1)
                                        <a href="{!! route('disbursementchargesconfigurations.edit',$disbursementchargesconfigurations->id) !!}" id='edit-disbursementchargesconfigurations-{!! $disbursementchargesconfigurations->id !!}' class='btn btn-sm btn-circle btn-warning'>
                                            <i class='fa fa-btn fa-edit'></i>
                                        </a>
                                        @endif
                                        @if($disbursementchargesconfigurationsdata['usersaccountsroles'][0]->_delete==1)
                                        <input type="hidden" name="_method" value="delete" />
                                        {!! csrf_field() !!}
                                        {!! method_field('DELETE') !!}
                                        <button type='submit' id='delete-disbursementchargesconfigurations-{!! $disbursementchargesconfigurations->id !!}' class='btn btn-sm btn-circle btn-danger'>
                                            <i class='fa fa-btn fa-trash'></i>
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
                <h4 class="modal-title">Disbursement Charges Configurations  - Filter Dialog</h4>
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
                    <form id="form"  class="form-horizontal" action="{!! url('admin/disbursementchargesconfigurationsfilter') !!}" method="POST">
                        {!! csrf_field() !!}
                                <div class="form-group">
                                    <label for="Loan Product" class="col-sm-3 control-label">Loan Product</label>
                                    <div class="col-sm-6">
									    <select class="form-control selectpicker" data-size="100000" data-live-search="true" data-style="btn-white" name="loan_product"  id="loan_product">
                                            <option value="" >Select Loan Product</option>				                                @foreach ($disbursementchargesconfigurationsdata['loanproducts'] as $loanproducts)
				                                <option value="{!! $loanproducts->id !!}">
					
				                                {!! $loanproducts->name!!}
				                                </option>
				                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Disbursement Charge" class="col-sm-3 control-label">Disbursement Charge</label>
                                    <div class="col-sm-6">
									    <select class="form-control selectpicker" data-size="100000" data-live-search="true" data-style="btn-white" name="disbursement_charge"  id="disbursement_charge">
                                            <option value="" >Select Disbursement Charge</option>				                                @foreach ($disbursementchargesconfigurationsdata['disbursementcharges'] as $disbursementcharges)
				                                <option value="{!! $disbursementcharges->id !!}">
					
				                                {!! $disbursementcharges->name!!}
				                                </option>
				                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Disbursement Mode" class="col-sm-3 control-label">Disbursement Mode</label>
                                    <div class="col-sm-6">
									    <select class="form-control selectpicker" data-size="100000" data-live-search="true" data-style="btn-white" name="disbursement_mode"  id="disbursement_mode">
                                            <option value="" >Select Disbursement Mode</option>				                                @foreach ($disbursementchargesconfigurationsdata['disbursementmodes'] as $disbursementmodes)
				                                <option value="{!! $disbursementmodes->id !!}">
					
				                                {!! $disbursementmodes->name!!}
				                                </option>
				                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Debit Account" class="col-sm-3 control-label">Debit Account</label>
                                    <div class="col-sm-6">
									    <select class="form-control selectpicker" data-size="100000" data-live-search="true" data-style="btn-white" name="debit_account"  id="debit_account">
                                            <option value="" >Select Debit Account</option>				                                @foreach ($disbursementchargesconfigurationsdata['accounts'] as $accounts)
				                                <option value="{!! $accounts->id !!}">
					
				                                {!! $accounts->name!!}
				                                </option>
				                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Credit Account" class="col-sm-3 control-label">Credit Account</label>
                                    <div class="col-sm-6">
									    <select class="form-control selectpicker" data-size="100000" data-live-search="true" data-style="btn-white" name="credit_account"  id="credit_account">
                                            <option value="" >Select Credit Account</option>				                                @foreach ($disbursementchargesconfigurationsdata['accounts'] as $accounts)
				                                <option value="{!! $accounts->id !!}">
					
				                                {!! $accounts->name!!}
				                                </option>
				                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Amount" class="col-sm-3 control-label">Amount</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="amount"  id="amount" class="form-control" placeholder="Amount" value="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-3 col-sm-6">
                                    <div class="col-sm-offset-3 col-sm-6">
                                        <button type="submit" class="btn btn-sm btn-inverse">
                                            <i class="fa fa-btn fa-search"></i> Search Disbursement Charges Configurations 
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
@endsection