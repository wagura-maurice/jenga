@extends('admin.home')
@section('main_content')
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
                <a href="{!! Route('loans.index') !!}"><button type="button"
                        class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-arrow-left"></i></button></a>
            </div>
        </div>

        @if ($loansdata['usersaccountsroles'][0]->_list == 1)
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-inverse">
                        <div class="panel-heading">
                            <div class="panel-heading-btn">
                                <a href="#" class="btn btn-xs btn-icon btn-circle btn-default"
                                    data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                <a href="#" class="btn btn-xs btn-icon btn-circle btn-success"
                                    data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                                <a href="#" class="btn btn-xs btn-icon btn-circle btn-warning"
                                    data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                                <a href="#" class="btn btn-xs btn-icon btn-circle btn-danger"
                                    data-click="panel-remove"><i class="fa fa-times"></i></a>
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
                                        <th>Minimum Loan Amount</th>
                                        <th>Maximum Loan Amount</th>
                                        <th>Fine Type</th>
                                        <th>Fine Charge</th>
                                        <th>Fine Charge Frequency</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($loansdata['list'] as $loanproducts)
                                        <tr>
                                            <td class='table-text'>
                                                <div>
                                                    {!! $loanproducts->code !!}
                                                </div>
                                            </td>
                                            <td class='table-text'>
                                                <div>
                                                    {!! $loanproducts->name !!}
                                                </div>
                                            </td>
                                            <td class='table-text'>
                                                <div>
                                                    {!! $loanproducts->description !!}
                                                </div>
                                            </td>
                                            <td class='table-text'>
                                                <div>
                                                    {!! number_format($loanproducts->minimum_loan_amount, 2) !!}
                                                </div>
                                            </td>
                                            <td class='table-text'>
                                                <div>
                                                    {!! number_format($loanproducts->maximum_loan_amount, 2) !!}
                                                </div>
                                            </td>
                                            <td class='table-text'>
                                                <div>
                                                    {!! $loanproducts->finetypemodel->name !!}
                                                </div>
                                            </td>
                                            <td class='table-text'>
                                                <div>
                                                    {!! $loanproducts->fine_charge !!}
                                                </div>
                                            </td>
                                            <td class='table-text'>
                                                <div>
                                                    {!! $loanproducts->finechargefrequencymodel->name !!}
                                                </div>
                                            </td>
                                            <td>
                                                @if ($loansdata['usersaccountsroles'][0]->_edit == 1)
                                                    @if (isset($loansdata['rescheduled_loan_number']) && !empty($loansdata['rescheduled_loan_number']))
                                                        <a href="{!! url('/admin/loans/reschedual/' . $loansdata['rescheduled_loan_number'] . '/' . $loanproducts->id) !!}"
                                                            id='edit-loanproducts-{!! $loanproducts->id !!}'
                                                            class="btn btn-primary btn-circle">
                                                            <i class="fa fa-arrow-right"></i>
                                                        </a>
                                                    @else
                                                        <a href="{!! url('/admin/loanapplicationclienttypes/' . $loanproducts->id) !!}"
                                                            id='edit-loanproducts-{!! $loanproducts->id !!}'
                                                            class="btn btn-primary btn-circle">
                                                            <i class="fa fa-arrow-right"></i>
                                                        </a>
                                                    @endif
                                                @endif
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
                                        <a href="#" class="btn btn-xs btn-icon btn-circle btn-default"
                                            data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                        <a href="#" class="btn btn-xs btn-icon btn-circle btn-success"
                                            data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                                        <a href="#" class="btn btn-xs btn-icon btn-circle btn-warning"
                                            data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                                        <a href="#" class="btn btn-xs btn-icon btn-circle btn-danger"
                                            data-click="panel-remove"><i class="fa fa-times"></i></a>
                                    </div>
                                    <h4 class="panel-title">DataForm - Autofill</h4>
                                </div>
                                <div class="panel-body">
                                    <form id="form" class="form-horizontal" action="{!! url('admin/loanproductsfilter') !!}"
                                        method="POST">
                                        {!! csrf_field() !!}
                                        <div class="form-group">
                                            <label for="Code" class="col-sm-3 control-label">Code</label>
                                            <div class="col-sm-6">
                                                <input type="text" name="code" id="code" class="form-control"
                                                    placeholder="Code" value="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="Name" class="col-sm-3 control-label">Name</label>
                                            <div class="col-sm-6">
                                                <input type="text" name="name" id="name" class="form-control"
                                                    placeholder="Name" value="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="Description" class="col-sm-3 control-label">Description</label>
                                            <div class="col-sm-6">
                                                <input type="text" name="description" id="description"
                                                    class="form-control" placeholder="Description" value="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="Grace Period" class="col-sm-3 control-label">Grace Period</label>
                                            <div class="col-sm-6">
                                                <select class="form-control" name="grace_period" id="grace_period">
                                                    <option value="">Select Grace Period</option>
                                                    @foreach ($loansdata['graceperiods'] as $graceperiods)
                                                        <option value="{!! $graceperiods->id !!}">

                                                            {!! $graceperiods->name !!}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="Mode Of Disbursement" class="col-sm-3 control-label">Mode Of
                                                Disbursement</label>
                                            <div class="col-sm-6">
                                                <select class="form-control" name="mode_of_disbursement"
                                                    id="mode_of_disbursement">
                                                    <option value="">Select Mode Of Disbursement</option>
                                                    @foreach ($loansdata['disbursementmodes'] as $disbursementmodes)
                                                        <option value="{!! $disbursementmodes->id !!}">

                                                            {!! $disbursementmodes->name !!}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="Fine Type" class="col-sm-3 control-label">Fine Type</label>
                                            <div class="col-sm-6">
                                                <select class="form-control" name="fine_type" id="fine_type">
                                                    <option value="">Select Fine Type</option>
                                                    @foreach ($loansdata['finetypes'] as $finetypes)
                                                        <option value="{!! $finetypes->id !!}">

                                                            {!! $finetypes->name !!}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="Fine Charge" class="col-sm-3 control-label">Fine Charge</label>
                                            <div class="col-sm-6">
                                                <input type="text" name="fine_charge" id="fine_charge"
                                                    class="form-control" placeholder="Fine Charge" value="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="Fine Charge Frequency" class="col-sm-3 control-label">Fine Charge
                                                Frequency</label>
                                            <div class="col-sm-6">
                                                <select class="form-control" name="fine_charge_frequency"
                                                    id="fine_charge_frequency">
                                                    <option value="">Select Fine Charge Frequency</option>
                                                    @foreach ($loansdata['finechargefrequencies'] as $finechargefrequencies)
                                                        <option value="{!! $finechargefrequencies->id !!}">

                                                            {!! $finechargefrequencies->name !!}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="Fine Charge Period" class="col-sm-3 control-label">Fine Charge
                                                Period</label>
                                            <div class="col-sm-6">
                                                <select class="form-control" name="fine_charge_period"
                                                    id="fine_charge_period">
                                                    <option value="">Select Fine Charge Period</option>
                                                    @foreach ($loansdata['finechargeperiods'] as $finechargeperiods)
                                                        <option value="{!! $finechargeperiods->id !!}">

                                                            {!! $finechargeperiods->name !!}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="Interest Rate Type" class="col-sm-3 control-label">Interest Rate
                                                Type</label>
                                            <div class="col-sm-6">
                                                <select class="form-control" name="interest_rate_type"
                                                    id="interest_rate_type">
                                                    <option value="">Select Interest Rate Type</option>
                                                    @foreach ($loansdata['interestratetypes'] as $interestratetypes)
                                                        <option value="{!! $interestratetypes->id !!}">

                                                            {!! $interestratetypes->name !!}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="Compounds Per Year" class="col-sm-3 control-label">Compounds Per
                                                Year</label>
                                            <div class="col-sm-6">
                                                <input type="text" name="compounds_per_year" id="compounds_per_year"
                                                    class="form-control" placeholder="Compounds Per Year" value="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="Interest Rate" class="col-sm-3 control-label">Interest
                                                Rate</label>
                                            <div class="col-sm-6">
                                                <input type="text" name="interest_rate" id="interest_rate"
                                                    class="form-control" placeholder="Interest Rate" value="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="Interest Payment Method" class="col-sm-3 control-label">Interest
                                                Payment Method</label>
                                            <div class="col-sm-6">
                                                <select class="form-control" name="interest_payment_method"
                                                    id="interest_payment_method">
                                                    <option value="">Select Interest Payment Method</option>
                                                    @foreach ($loansdata['interestpaymentmethods'] as $interestpaymentmethods)
                                                        <option value="{!! $interestpaymentmethods->id !!}">

                                                            {!! $interestpaymentmethods->name !!}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="Initial Deposit" class="col-sm-3 control-label">Initial
                                                Deposit</label>
                                            <div class="col-sm-6">
                                                <input type="text" name="initial_deposit" id="initial_deposit"
                                                    class="form-control" placeholder="Initial Deposit" value="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="Loan Payment Duration" class="col-sm-3 control-label">Loan Payment
                                                Duration</label>
                                            <div class="col-sm-6">
                                                <select class="form-control" name="loan_payment_duration"
                                                    id="loan_payment_duration">
                                                    <option value="">Select Loan Payment Duration</option>
                                                    @foreach ($loansdata['loanpaymentdurations'] as $loanpaymentdurations)
                                                        <option value="{!! $loanpaymentdurations->id !!}">

                                                            {!! $loanpaymentdurations->name !!}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="Minimum Loan Amount" class="col-sm-3 control-label">Minimum Loan
                                                Amount</label>
                                            <div class="col-sm-6">
                                                <input type="text" name="minimum_loan_amount" id="minimum_loan_amount"
                                                    class="form-control" placeholder="Minimum Loan Amount"
                                                    value="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="Maximum Loan Amount" class="col-sm-3 control-label">Maximum Loan
                                                Amount</label>
                                            <div class="col-sm-6">
                                                <input type="text" name="maximum_loan_amount" id="maximum_loan_amount"
                                                    class="form-control" placeholder="Maximum Loan Amount"
                                                    value="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="Can Change Disbursement Mode" class="col-sm-3 control-label">Can
                                                Change Disbursement Mode</label>
                                            <div class="col-sm-6">
                                                <input type="checkbox" name="can_change_disbursement_mode"
                                                    id="can_change_disbursement_mode" class="form-control"
                                                    placeholder="Can Change Disbursement Mode" value="1">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="Can Access Another Loan" class="col-sm-3 control-label">Can Access
                                                Another Loan</label>
                                            <div class="col-sm-6">
                                                <input type="checkbox" name="can_access_another_loan"
                                                    id="can_access_another_loan" class="form-control"
                                                    placeholder="Can Access Another Loan" value="1">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="Clearing Fee" class="col-sm-3 control-label">Clearing Fee</label>
                                            <div class="col-sm-6">
                                                <input type="text" name="clearing_fee" id="clearing_fee"
                                                    class="form-control" placeholder="Clearing Fee" value="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="Number Of Guarantors" class="col-sm-3 control-label">Number Of
                                                Guarantors</label>
                                            <div class="col-sm-6">
                                                <input type="text" name="number_of_guarantors"
                                                    id="number_of_guarantors" class="form-control"
                                                    placeholder="Number Of Guarantors" value="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="Minimum Membership Period" class="col-sm-3 control-label">Minimum
                                                Membership Period</label>
                                            <div class="col-sm-6">
                                                <select class="form-control" name="minimum_membership_period"
                                                    id="minimum_membership_period">
                                                    <option value="">Select Minimum Membership Period</option>
                                                    @foreach ($loansdata['minimummembershipperiods'] as $minimummembershipperiods)
                                                        <option value="{!! $minimummembershipperiods->id !!}">

                                                            {!! $minimummembershipperiods->name !!}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="Insurance Deduction Fee" class="col-sm-3 control-label">Insurance
                                                Deduction Fee</label>
                                            <div class="col-sm-6">
                                                <input type="text" name="insurance_deduction_fee"
                                                    id="insurance_deduction_fee" class="form-control"
                                                    placeholder="Insurance Deduction Fee" value="">
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
