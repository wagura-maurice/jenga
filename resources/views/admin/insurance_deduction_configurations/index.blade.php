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
        <li><a href="#">Insurance Deduction Configurations</a></li>
        <li class="active">Table</li>
    </ol>
    <h1 class="page-header">Insurance Deduction Configurations - DATA <small>insurance deduction configurations data goes here...</small></h1>
    <div class="row">
        <div class="col-md-12">
            @if($insurancedeductionconfigurationsdata['usersaccountsroles'][0]->_add==1)
            <a href="{!! route('insurancedeductionconfigurations.create') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-plus"></i></button></a>
            @endif
            @if($insurancedeductionconfigurationsdata['usersaccountsroles'][0]->_report==1)
            <a href="{!! url('admin/insurancedeductionconfigurationsreport') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-file-text-o"></i></button></a>
            @endif
            @if($insurancedeductionconfigurationsdata['usersaccountsroles'][0]->_report==1 || $insurancedeductionconfigurationsdata['usersaccountsroles'][0]->_list==1)
            <a href="#modal-dialog"  data-toggle="modal"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-filter"></i></button></a>
            @endif
    @if($insurancedeductionconfigurationsdata['usersaccountsroles'][0]->_list==1)
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
                                        <th>Loan Product</th>
                                        <th>Fee Type</th>
                                        <th>Fee Payment Type</th>
                                        <th>Payment Mode</th>
                                        <th>Disbursement Mode</th>
                                        <th>Debit Account</th>
                                        <th>Credit Account</th>
                                        <th>Action</th>                                    </tr>
                        </thead>
                        <tbody>
                        @foreach ($insurancedeductionconfigurationsdata['list'] as $insurancedeductionconfigurations)
                            <tr>
                                <td class='table-text'><div>
                                	{!! $insurancedeductionconfigurations->loanproductmodel->name !!}
                                </div></td>
                                <td class='table-text'><div>
                                	{!! $insurancedeductionconfigurations->feetypemodel->name !!}
                                </div></td>
                                <td class='table-text'><div>
                                	{!! $insurancedeductionconfigurations->feepaymenttypemodel->name !!}
                                </div></td>
                                <td class='table-text'><div>
                                	{!! $insurancedeductionconfigurations->paymentmodemodel->name !!}
                                </div></td>
                                <td class='table-text'><div>
                                	{!! $insurancedeductionconfigurations->disbursementmodemodel->name !!}
                                </div></td>
                                <td class='table-text'><div>
                                	{!! $insurancedeductionconfigurations->debitaccountmodel->name !!}
                                </div></td>
                                <td class='table-text'><div>
                                	{!! $insurancedeductionconfigurations->creditaccountmodel->name !!}
                                </div></td>
                                <td>
                <form action="{!! route('insurancedeductionconfigurations.destroy',$insurancedeductionconfigurations->id) !!}" method="POST">
                                        @if($insurancedeductionconfigurationsdata['usersaccountsroles'][0]->_show==1)
                                        <a href="{!! route('insurancedeductionconfigurations.show',$insurancedeductionconfigurations->id) !!}" id='show-insurancedeductionconfigurations-{!! $insurancedeductionconfigurations->id !!}' class='btn btn-sm btn-circle btn-inverse'>
                                            <i class='fa fa-btn fa-eye'></i>
                                        </a>
                                        @endif
                                        @if($insurancedeductionconfigurationsdata['usersaccountsroles'][0]->_edit==1)
                                        <a href="{!! route('insurancedeductionconfigurations.edit',$insurancedeductionconfigurations->id) !!}" id='edit-insurancedeductionconfigurations-{!! $insurancedeductionconfigurations->id !!}' class='btn btn-sm btn-circle btn-warning'>
                                            <i class='fa fa-btn fa-edit'></i>
                                        </a>
                                        @endif
                                        @if($insurancedeductionconfigurationsdata['usersaccountsroles'][0]->_delete==1)
                                        <input type="hidden" name="_method" value="delete" />
                                        {!! csrf_field() !!}
                                        {!! method_field('DELETE') !!}
                                        <button type='submit' id='delete-insurancedeductionconfigurations-{!! $insurancedeductionconfigurations->id !!}' class='btn btn-sm btn-circle btn-danger'>
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
                <h4 class="modal-title">Insurance Deduction Configurations - Filter Dialog</h4>
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
                    <form id="form"  class="form-horizontal" action="{!! url('admin/insurancedeductionconfigurationsfilter') !!}" method="POST">
                        {!! csrf_field() !!}
                                <div class="form-group">
                                    <label for="Loan Product" class="col-sm-3 control-label">Loan Product</label>
                                    <div class="col-sm-6">
									    <select class="form-control selectpicker" data-size="100000" data-live-search="true" data-style="btn-white" name="loan_product"  id="loan_product">
                                            <option value="" >Select Loan Product</option>				                                @foreach ($insurancedeductionconfigurationsdata['loanproducts'] as $loanproducts)
				                                <option value="{!! $loanproducts->id !!}">
					
				                                {!! $loanproducts->name!!}
				                                </option>
				                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Fee Type" class="col-sm-3 control-label">Fee Type</label>
                                    <div class="col-sm-6">
									    <select class="form-control selectpicker" data-size="100000" data-live-search="true" data-style="btn-white" name="fee_type"  id="fee_type">
                                            <option value="" >Select Fee Type</option>				                                @foreach ($insurancedeductionconfigurationsdata['feetypes'] as $feetypes)
				                                <option value="{!! $feetypes->id !!}">
					
				                                {!! $feetypes->name!!}
				                                </option>
				                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Fee Payment Type" class="col-sm-3 control-label">Fee Payment Type</label>
                                    <div class="col-sm-6">
									    <select class="form-control selectpicker" data-size="100000" data-live-search="true" data-style="btn-white" name="fee_payment_type"  id="fee_payment_type">
                                            <option value="" >Select Fee Payment Type</option>				                                @foreach ($insurancedeductionconfigurationsdata['feepaymenttypes'] as $feepaymenttypes)
				                                <option value="{!! $feepaymenttypes->id !!}">
					
				                                {!! $feepaymenttypes->name!!}
				                                </option>
				                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Payment Mode" class="col-sm-3 control-label">Payment Mode</label>
                                    <div class="col-sm-6">
									    <select class="form-control selectpicker" data-size="100000" data-live-search="true" data-style="btn-white" name="payment_mode"  id="payment_mode">
                                            <option value="" >Select Payment Mode</option>				                                @foreach ($insurancedeductionconfigurationsdata['paymentmodes'] as $paymentmodes)
				                                <option value="{!! $paymentmodes->id !!}">
					
				                                {!! $paymentmodes->name!!}
				                                </option>
				                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Disbursement Mode" class="col-sm-3 control-label">Disbursement Mode</label>
                                    <div class="col-sm-6">
									    <select class="form-control selectpicker" data-size="100000" data-live-search="true" data-style="btn-white" name="disbursement_mode"  id="disbursement_mode">
                                            <option value="" >Select Disbursement Mode</option>				                                @foreach ($insurancedeductionconfigurationsdata['disbursementmodes'] as $disbursementmodes)
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
                                            <option value="" >Select Debit Account</option>				                                @foreach ($insurancedeductionconfigurationsdata['accounts'] as $accounts)
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
                                            <option value="" >Select Credit Account</option>				                                @foreach ($insurancedeductionconfigurationsdata['accounts'] as $accounts)
				                                <option value="{!! $accounts->id !!}">
					
				                                {!! $accounts->name!!}
				                                </option>
				                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-3 col-sm-6">
                                    <div class="col-sm-offset-3 col-sm-6">
                                        <button type="submit" class="btn btn-sm btn-inverse">
                                            <i class="fa fa-btn fa-search"></i> Search Insurance Deduction Configurations
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