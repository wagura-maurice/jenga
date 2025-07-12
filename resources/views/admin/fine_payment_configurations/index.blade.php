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
        <li><a href="#">Fine Payment Configurations</a></li>
        <li class="active">Table</li>
    </ol>
    <h1 class="page-header">Fine Payment Configurations - DATA <small>fine payment configurations data goes here...</small></h1>
    <div class="row">
        <div class="col-md-12">
            @if($finepaymentconfigurationsdata['usersaccountsroles'][0]->_add==1)
            <a href="{!! route('finepaymentconfigurations.create') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-plus"></i></button></a>
            @endif
            @if($finepaymentconfigurationsdata['usersaccountsroles'][0]->_report==1)
            <a href="{!! url('admin/finepaymentconfigurationsreport') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-file-text-o"></i></button></a>
            @endif
            @if($finepaymentconfigurationsdata['usersaccountsroles'][0]->_report==1 || $finepaymentconfigurationsdata['usersaccountsroles'][0]->_list==1)
            <a href="#modal-dialog"  data-toggle="modal"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-filter"></i></button></a>
            @endif
    @if($finepaymentconfigurationsdata['usersaccountsroles'][0]->_list==1)
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
                                        <th>Debit Account</th>
                                        <th>Credit Account</th>
                                        <th>Payment Mode</th>
                                        <th>Action</th>                                    </tr>
                        </thead>
                        <tbody>
                        @foreach ($finepaymentconfigurationsdata['list'] as $finepaymentconfigurations)
                            <tr>
                                <td class='table-text'><div>
                                	{!! $finepaymentconfigurations->loanproductmodel->name !!}
                                </div></td>
                                <td class='table-text'><div>
                                	{!! $finepaymentconfigurations->debitaccountmodel->name !!}
                                </div></td>
                                <td class='table-text'><div>
                                	{!! $finepaymentconfigurations->creditaccountmodel->name !!}
                                </div></td>
                                <td class='table-text'><div>
                                	{!! $finepaymentconfigurations->paymentmodemodel->name !!}
                                </div></td>
                                <td>
                <form action="{!! route('finepaymentconfigurations.destroy',$finepaymentconfigurations->id) !!}" method="POST">
                                        @if($finepaymentconfigurationsdata['usersaccountsroles'][0]->_show==1)
                                        <a href="{!! route('finepaymentconfigurations.show',$finepaymentconfigurations->id) !!}" id='show-finepaymentconfigurations-{!! $finepaymentconfigurations->id !!}' class='btn btn-sm btn-circle btn-inverse'>
                                            <i class='fa fa-btn fa-eye'></i>
                                        </a>
                                        @endif
                                        @if($finepaymentconfigurationsdata['usersaccountsroles'][0]->_edit==1)
                                        <a href="{!! route('finepaymentconfigurations.edit',$finepaymentconfigurations->id) !!}" id='edit-finepaymentconfigurations-{!! $finepaymentconfigurations->id !!}' class='btn btn-sm btn-circle btn-warning'>
                                            <i class='fa fa-btn fa-edit'></i>
                                        </a>
                                        @endif
                                        @if($finepaymentconfigurationsdata['usersaccountsroles'][0]->_delete==1)
                                        <input type="hidden" name="_method" value="delete" />
                                        {!! csrf_field() !!}
                                        {!! method_field('DELETE') !!}
                                        <button type='submit' id='delete-finepaymentconfigurations-{!! $finepaymentconfigurations->id !!}' class='btn btn-sm btn-circle btn-danger'>
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
                <h4 class="modal-title">Fine Payment Configurations - Filter Dialog</h4>
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
                    <form id="form"  class="form-horizontal" action="{!! url('admin/finepaymentconfigurationsfilter') !!}" method="POST">
                        {!! csrf_field() !!}
                                <div class="form-group">
                                    <label for="Loan Product" class="col-sm-3 control-label">Loan Product</label>
                                    <div class="col-sm-6">
									    <select class="form-control selectpicker" data-size="100000" data-live-search="true" data-style="btn-white" name="loan_product"  id="loan_product">
                                            <option value="" >Select Loan Product</option>				                                @foreach ($finepaymentconfigurationsdata['loanproducts'] as $loanproducts)
				                                <option value="{!! $loanproducts->id !!}">
					
				                                {!! $loanproducts->name!!}
				                                </option>
				                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Debit Account" class="col-sm-3 control-label">Debit Account</label>
                                    <div class="col-sm-6">
									    <select class="form-control selectpicker" data-size="100000" data-live-search="true" data-style="btn-white" name="debit_account"  id="debit_account">
                                            <option value="" >Select Debit Account</option>				                                @foreach ($finepaymentconfigurationsdata['accounts'] as $accounts)
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
                                            <option value="" >Select Credit Account</option>				                                @foreach ($finepaymentconfigurationsdata['accounts'] as $accounts)
				                                <option value="{!! $accounts->id !!}">
					
				                                {!! $accounts->name!!}
				                                </option>
				                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Payment Mode" class="col-sm-3 control-label">Payment Mode</label>
                                    <div class="col-sm-6">
									    <select class="form-control selectpicker" data-size="100000" data-live-search="true" data-style="btn-white" name="payment_mode"  id="payment_mode">
                                            <option value="" >Select Payment Mode</option>				                                @foreach ($finepaymentconfigurationsdata['paymentmodes'] as $paymentmodes)
				                                <option value="{!! $paymentmodes->id !!}">
					
				                                {!! $paymentmodes->name!!}
				                                </option>
				                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-3 col-sm-6">
                                    <div class="col-sm-offset-3 col-sm-6">
                                        <button type="submit" class="btn btn-sm btn-inverse">
                                            <i class="fa fa-btn fa-search"></i> Search Fine Payment Configurations
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