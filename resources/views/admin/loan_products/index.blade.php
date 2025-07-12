@extends("admin.home")
@section("main_content")
<div id="content" class="content">
    <ol class="breadcrumb pull-right">
        <li><a href="#">Home</a></li>
        <li><a href="#">Public</a></li>
        <li><a href="#">Loan Products</a></li>
        <li class="active">Table</li>
    </ol>
    <h1 class="page-header">Loan Products - DATA <small>loan products data goes here...</small></h1>
    <div class="row">
        <div class="col-md-12">
            @if($loanproductsdata['usersaccountsroles'][0]->_add==1)
            <a href="{!! route('loanproducts.create') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-plus"></i></button></a>
            @endif
            @if($loanproductsdata['usersaccountsroles'][0]->_report==1)
            <a href="{!! url('admin/loanproductsreport') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-file-text-o"></i></button></a>
            @endif
            @if($loanproductsdata['usersaccountsroles'][0]->_report==1 || $loanproductsdata['usersaccountsroles'][0]->_list==1)
            <a href="#modal-dialog"  data-toggle="modal"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-filter"></i></button></a>
            @endif
    @if($loanproductsdata['usersaccountsroles'][0]->_list==1)
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
                                        <th>Code</th>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Fine Type</th>
                                        <th>Fine Charge</th>
                                        <th>Fine Charge Frequency</th>
                                        <th>Action</th>                                    </tr>
                        </thead>
                        <tbody>
                        @foreach ($loanproductsdata['list'] as $loanproducts)
                            <tr>
                                <td class='table-text'><div>
                                	{!! $loanproducts->code !!}
                                </div></td>
                                <td class='table-text'><div>
                                	{!! $loanproducts->name !!}
                                </div></td>
                                <td class='table-text'><div>
                                	{!! $loanproducts->description !!}
                                </div></td>

                                <td class='table-text'><div>
                                	{!! $loanproducts->finetypemodel->name !!}
                                </div></td>
                                <td class='table-text'><div>
                                	{!! $loanproducts->fine_charge !!}
                                </div></td>
                                <td class='table-text'><div>
                                	{!! $loanproducts->finechargefrequencymodel->name !!}
                                </div></td>
                                <td>
                <form action="{!! route('loanproducts.destroy',$loanproducts->id) !!}" method="POST">
                                        @if($loanproductsdata['usersaccountsroles'][0]->_show==1)
                                        <a href="{!! route('loanproducts.show',$loanproducts->id) !!}" id='show-loanproducts-{!! $loanproducts->id !!}' class='btn btn-sm btn-circle btn-inverse'>
                                            <i class='fa fa-btn fa-eye'></i>
                                        </a>
                                        @endif
                                        @if($loanproductsdata['usersaccountsroles'][0]->_edit==1)
                                        <a href="{!! route('loanproducts.edit',$loanproducts->id) !!}" id='edit-loanproducts-{!! $loanproducts->id !!}' class='btn btn-sm btn-circle btn-warning'>
                                            <i class='fa fa-btn fa-edit'></i>
                                        </a>
                                        @endif
                                        @if($loanproductsdata['usersaccountsroles'][0]->_delete==1)
                                        <input type="hidden" name="_method" value="delete" />
                                        {!! csrf_field() !!}
                                        {!! method_field('DELETE') !!}
                                        <button type='submit' id='delete-loanproducts-{!! $loanproducts->id !!}' class='btn btn-sm btn-circle btn-danger'>
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
                <h4 class="modal-title">Loan Products - Filter Dialog</h4>
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
                    <form id="form"  class="form-horizontal" action="{!! url('admin/loanproductsfilter') !!}" method="POST">
                        {!! csrf_field() !!}
                                <div class="form-group">
                                    <label for="Code" class="col-sm-3 control-label">Code</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="code"  id="code" class="form-control" placeholder="Code" value="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Name" class="col-sm-3 control-label">Name</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="name"  id="name" class="form-control" placeholder="Name" value="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Description" class="col-sm-3 control-label">Description</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="description"  id="description" class="form-control" placeholder="Description" value="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Grace Period" class="col-sm-3 control-label">Grace Period</label>
                                    <div class="col-sm-6">
									    <select class="form-control" name="grace_period"  id="grace_period">
                                            <option value="" >Select Grace Period</option>				                                @foreach ($loanproductsdata['graceperiods'] as $graceperiods)
				                                <option value="{!! $graceperiods->id !!}">
					
				                                {!! $graceperiods->name!!}
				                                </option>
				                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Mode Of Disbursement" class="col-sm-3 control-label">Mode Of Disbursement</label>
                                    <div class="col-sm-6">
									    <select class="form-control" name="mode_of_disbursement"  id="mode_of_disbursement">
                                            <option value="" >Select Mode Of Disbursement</option>				                                @foreach ($loanproductsdata['disbursementmodes'] as $disbursementmodes)
				                                <option value="{!! $disbursementmodes->id !!}">
					
				                                {!! $disbursementmodes->name!!}
				                                </option>
				                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Fine Type" class="col-sm-3 control-label">Fine Type</label>
                                    <div class="col-sm-6">
									    <select class="form-control" name="fine_type"  id="fine_type">
                                            <option value="" >Select Fine Type</option>				                                @foreach ($loanproductsdata['finetypes'] as $finetypes)
				                                <option value="{!! $finetypes->id !!}">
					
				                                {!! $finetypes->name!!}
				                                </option>
				                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Fine Charge" class="col-sm-3 control-label">Fine Charge</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="fine_charge"  id="fine_charge" class="form-control" placeholder="Fine Charge" value="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Fine Charge Frequency" class="col-sm-3 control-label">Fine Charge Frequency</label>
                                    <div class="col-sm-6">
									    <select class="form-control" name="fine_charge_frequency"  id="fine_charge_frequency">
                                            <option value="" >Select Fine Charge Frequency</option>				                                @foreach ($loanproductsdata['finechargefrequencies'] as $finechargefrequencies)
				                                <option value="{!! $finechargefrequencies->id !!}">
					
				                                {!! $finechargefrequencies->name!!}
				                                </option>
				                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Fine Charge Period" class="col-sm-3 control-label">Fine Charge Period</label>
                                    <div class="col-sm-6">
									    <select class="form-control" name="fine_charge_period"  id="fine_charge_period">
                                            <option value="" >Select Fine Charge Period</option>				                                @foreach ($loanproductsdata['finechargeperiods'] as $finechargeperiods)
				                                <option value="{!! $finechargeperiods->id !!}">
					
				                                {!! $finechargeperiods->name!!}
				                                </option>
				                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Interest Rate Type" class="col-sm-3 control-label">Interest Rate Type</label>
                                    <div class="col-sm-6">
									    <select class="form-control" name="interest_rate_type"  id="interest_rate_type">
                                            <option value="" >Select Interest Rate Type</option>				                                @foreach ($loanproductsdata['interestratetypes'] as $interestratetypes)
				                                <option value="{!! $interestratetypes->id !!}">
					
				                                {!! $interestratetypes->name!!}
				                                </option>
				                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Compounds Per Year" class="col-sm-3 control-label">Compounds Per Year</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="compounds_per_year"  id="compounds_per_year" class="form-control" placeholder="Compounds Per Year" value="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Interest Rate" class="col-sm-3 control-label">Interest Rate</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="interest_rate"  id="interest_rate" class="form-control" placeholder="Interest Rate" value="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Interest Payment Method" class="col-sm-3 control-label">Interest Payment Method</label>
                                    <div class="col-sm-6">
									    <select class="form-control" name="interest_payment_method"  id="interest_payment_method">
                                            <option value="" >Select Interest Payment Method</option>				                                @foreach ($loanproductsdata['interestpaymentmethods'] as $interestpaymentmethods)
				                                <option value="{!! $interestpaymentmethods->id !!}">
					
				                                {!! $interestpaymentmethods->name!!}
				                                </option>
				                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Initial Deposit" class="col-sm-3 control-label">Initial Deposit</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="initial_deposit"  id="initial_deposit" class="form-control" placeholder="Initial Deposit" value="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Loan Payment Duration" class="col-sm-3 control-label">Loan Payment Duration</label>
                                    <div class="col-sm-6">
									    <select class="form-control" name="loan_payment_duration"  id="loan_payment_duration">
                                            <option value="" >Select Loan Payment Duration</option>				                                @foreach ($loanproductsdata['loanpaymentdurations'] as $loanpaymentdurations)
				                                <option value="{!! $loanpaymentdurations->id !!}">
					
				                                {!! $loanpaymentdurations->name!!}
				                                </option>
				                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Minimum Loan Amount" class="col-sm-3 control-label">Minimum Loan Amount</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="minimum_loan_amount"  id="minimum_loan_amount" class="form-control" placeholder="Minimum Loan Amount" value="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Maximum Loan Amount" class="col-sm-3 control-label">Maximum Loan Amount</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="maximum_loan_amount"  id="maximum_loan_amount" class="form-control" placeholder="Maximum Loan Amount" value="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Can Change Disbursement Mode" class="col-sm-3 control-label">Can Change Disbursement Mode</label>
                                    <div class="col-sm-6">
                                        <input type="checkbox" name="can_change_disbursement_mode"  id="can_change_disbursement_mode" class="form-control" placeholder="Can Change Disbursement Mode" value="1">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Can Access Another Loan" class="col-sm-3 control-label">Can Access Another Loan</label>
                                    <div class="col-sm-6">
                                        <input type="checkbox" name="can_access_another_loan"  id="can_access_another_loan" class="form-control" placeholder="Can Access Another Loan" value="1">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Clearing Fee" class="col-sm-3 control-label">Clearing Fee</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="clearing_fee"  id="clearing_fee" class="form-control" placeholder="Clearing Fee" value="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Number Of Guarantors" class="col-sm-3 control-label">Number Of Guarantors</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="number_of_guarantors"  id="number_of_guarantors" class="form-control" placeholder="Number Of Guarantors" value="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Minimum Membership Period" class="col-sm-3 control-label">Minimum Membership Period</label>
                                    <div class="col-sm-6">
									    <select class="form-control" name="minimum_membership_period"  id="minimum_membership_period">
                                            <option value="" >Select Minimum Membership Period</option>				                                @foreach ($loanproductsdata['minimummembershipperiods'] as $minimummembershipperiods)
				                                <option value="{!! $minimummembershipperiods->id !!}">
					
				                                {!! $minimummembershipperiods->name!!}
				                                </option>
				                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Insurance Deduction Fee" class="col-sm-3 control-label">Insurance Deduction Fee</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="insurance_deduction_fee"  id="insurance_deduction_fee" class="form-control" placeholder="Insurance Deduction Fee" value="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-3 col-sm-6">
                                    <div class="col-sm-offset-3 col-sm-6">
                                        <button type="submit" class="btn btn-sm btn-inverse">
                                            <i class="fa fa-btn fa-search"></i> Search Loan Products
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