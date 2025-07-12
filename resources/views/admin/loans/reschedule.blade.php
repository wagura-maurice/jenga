@extends('admin.home')
@section('main_content')
    <div id="content" class="content">
        <ol class="breadcrumb pull-right">
            <li><a href="#">Home</a></li>
            <li><a href="#">public</a></li>
            <li><a href="#">Loans</a></li>
            <li class="active">form</li>
        </ol>
        <h1 class="page-header">Loans Reschedule Form <small>loans details goes here...</small></h1>
        <div class="row">
            <div class="col-md-12">
                <a href="{!! route('loans.index') !!}"><button type="button"
                        class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-arrow-left"></i></button></a>
            </div>
        </div>
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
                            <a href="#" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i
                                    class="fa fa-times"></i></a>
                        </div>
                        <h4 class="panel-title">DataForm - Autofill</h4>
                    </div>
                    <div class="panel-body">
                        <form action="{!! route('loans.reschedule.store', $loansdata['data']->id) !!}" method="POST">
                            {!! csrf_field() !!}
                            <div class="form-group">
                                <label for="Loan Number" class="col-md-3 m-t-10 control-label">Loan Number</label>
                                <div class="col-md-3 m-t-10">
                                    <input type="text" name="loan_number" id="loan_number" class="form-control"
                                        placeholder="Loan Number" value="{!! $loansdata['data']->loan_number !!}" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Loan Product" class="col-md-3 m-t-10 control-label">Loan Product</label>
                                <div class="col-md-3 m-t-10">
                                    <select class="form-control" name="loan_product" id="loan_product" readonly>
                                        <option value="" disabled>Select Loan Product</option>
                                        @foreach ($loansdata['loanproducts'] as $loanproducts)
                                            @if ($loanproducts->id == $loansdata['data']->loan_product)
                                                <option selected value="{!! $loanproducts->id !!}">
                                                    {!! $loanproducts->name !!}
                                                </option>
                                            @else
                                                <option disabled value="{!! $loanproducts->id !!}">
                                                    {!! $loanproducts->name !!}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Client" class="col-md-3 m-t-10 control-label">Client</label>
                                <div class="col-md-3 m-t-10">
                                    <select class="form-control" name="client" id="client" readonly>
                                        <option value="" disabled>Select Client</option>
                                        @foreach ($loansdata['clients'] as $clients)
                                            @if ($clients->id == $loansdata['data']->client)
                                                <option selected value="{!! $clients->id !!}">
                                                    {!! $clients->client_number !!}
                                                    {!! $clients->first_name !!}
                                                    {!! $clients->middle_name !!}
                                                    {!! $clients->last_name !!}
                                                </option>
                                            @else
                                                <option disabled value="{!! $clients->id !!}">
                                                    {!! $clients->client_number !!}
                                                    {!! $clients->first_name !!}
                                                    {!! $clients->middle_name !!}
                                                    {!! $clients->last_name !!}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Date" class="col-md-3 m-t-10 control-label">Date</label>
                                <div class="col-md-3 m-t-10">
                                    <input type="text" name="date" id="date" class="form-control"
                                        placeholder="Date" value="{!! \Carbon\Carbon::now()->toDateString() !!}" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Amount" class="col-md-3 m-t-10 control-label">Amount</label>
                                <div class="col-md-3 m-t-10">
                                    <input type="text" name="amount" id="amount" class="form-control"
                                        placeholder="Amount" value="{!! $loansdata['data']['loan_amount'] !!}" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Interest Rate Type" class="col-md-3 m-t-10 control-label">Interest Rate
                                    Type</label>
                                <div class="col-md-3 m-t-10">
                                    <select class="form-control" name="interest_rate_type" id="interest_rate_type" readonly>
                                        <option disabled value="">Select Interest Rate Type</option>
                                        @foreach ($loansdata['interestratetypes'] as $interestratetypes)
                                            @if ($interestratetypes->id == $loansdata['data']->interest_rate_type)
                                                <option selected value="{!! $interestratetypes->id !!}">
                                                    {!! $interestratetypes->name !!}
                                                </option>
                                            @else
                                                <option disabled value="{!! $interestratetypes->id !!}">
                                                    {!! $interestratetypes->name !!}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Interest Rate" class="col-md-3 m-t-10 control-label">Interest Rate</label>
                                <div class="col-md-3 m-t-10">
                                    <input type="text" name="interest_rate" id="interest_rate" class="form-control"
                                        placeholder="Interest Rate" value="{!! $loansdata['data']->interest_rate !!}" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Interest Payment Method" class="col-md-3 m-t-10 control-label">Interest
                                    Payment Method</label>
                                <div class="col-md-3 m-t-10">
                                    <select class="form-control" name="interest_payment_method"
                                        id="interest_payment_method" readonly>
                                        <option disabled value="">Select Interest Payment Method</option>
                                        @foreach ($loansdata['interestpaymentmethods'] as $interestpaymentmethods)
                                            @if ($interestpaymentmethods->id == $loansdata['data']->interest_payment_method)
                                                <option selected value="{!! $interestpaymentmethods->id !!}">
                                                    {!! $interestpaymentmethods->name !!}
                                                </option>
                                            @else
                                                <option disabled value="{!! $interestpaymentmethods->id !!}">
                                                    {!! $interestpaymentmethods->name !!}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Loan Payment Duration" class="col-md-3 m-t-10 control-label">Loan Payment
                                    Duration</label>
                                <div class="col-md-3 m-t-10">
                                    <select class="form-control" name="loan_payment_duration" id="loan_payment_duration" readonly>
                                        <option disabled value="">Select Loan Payment Duration</option>
                                        @foreach ($loansdata['loanpaymentdurations'] as $loanpaymentdurations)
                                            @if ($loanpaymentdurations->id == $loansdata['data']->loan_payment_duration)
                                                <option disabled selected value="{!! $loanpaymentdurations->id !!}">
                                                    {!! $loanpaymentdurations->name !!}
                                                </option>
                                            @else
                                                <option disabled value="{!! $loanpaymentdurations->id !!}">
                                                    {!! $loanpaymentdurations->name !!}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Loan Payment Frequency" class="col-md-3 m-t-10 control-label">Loan Payment
                                    Frequency</label>
                                <div class="col-md-3 m-t-10">
                                    <select class="form-control" name="loan_payment_frequency"
                                        id="loan_payment_frequency" readonly>
                                        <option disabled value="">Select Loan Payment Frequency</option>
                                        @foreach ($loansdata['loanpaymentfrequencies'] as $loanpaymentfrequencies)
                                            @if ($loanpaymentfrequencies->id == $loansdata['data']->loan_payment_frequency)
                                                <option selected value="{!! $loanpaymentfrequencies->id !!}">
                                                    {!! $loanpaymentfrequencies->name !!}
                                                </option>
                                            @else
                                                <option disabled value="{!! $loanpaymentfrequencies->id !!}">
                                                    {!! $loanpaymentfrequencies->name !!}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Grace Period" class="col-md-3 m-t-10 control-label">Grace Period</label>
                                <div class="col-md-3 m-t-10">
                                    <select class="form-control" name="grace_period" id="grace_period" readonly>
                                        <option disabled value="">Select Grace Period</option>
                                        @foreach ($loansdata['graceperiods'] as $graceperiods)
                                            @if ($graceperiods->id == $loansdata['data']->grace_period)
                                                <option selected value="{!! $graceperiods->id !!}">
                                                    {!! $graceperiods->name !!}
                                                </option>
                                            @else
                                                <option disabled value="{!! $graceperiods->id !!}">
                                                    {!! $graceperiods->name !!}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Interest Charged" class="col-md-3 m-t-10 control-label">Interest
                                    Charged</label>
                                <div class="col-md-3 m-t-10">
                                    <input type="text" name="interest_charged" id="interest_charged"
                                        class="form-control" placeholder="Interest Charged"
                                        value="{!! $loansdata['data']->interest_charged !!}" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Total Loan Amount" class="col-md-3 m-t-10 control-label">Total Loan
                                    Amount</label>
                                <div class="col-md-3 m-t-10">
                                    <input type="text" name="total_loan_amount" id="total_loan_amount"
                                        class="form-control" placeholder="Total Loan Amount"
                                        value="{!! $loansdata['data']->total_loan_amount !!}" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Amount To Be Disbursed" class="col-md-3 m-t-10 control-label">Amount To Be
                                    Disbursed</label>
                                <div class="col-md-3 m-t-10">
                                    <input type="text" name="amount_to_be_disbursed" id="amount_to_be_disbursed"
                                        class="form-control" placeholder="Amount To Be Disbursed"
                                        value="" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Mode Of Disbursement" class="col-md-3 m-t-10 control-label">Mode Of
                                    Disbursement</label>
                                <div class="col-md-3 m-t-10">
                                    <select class="form-control" name="mode_of_disbursement" id="mode_of_disbursement" readonly>
                                        <option disabled value="">Select Mode Of Disbursement</option>
                                        @foreach ($loansdata['disbursementmodes'] as $disbursementmodes)
                                            @if ($disbursementmodes->id == $loansdata['data']->mode_of_disbursement)
                                                <option selected value="{!! $disbursementmodes->id !!}">
                                                    {!! $disbursementmodes->name !!}
                                                </option>
                                            @else
                                                <option value="{!! $disbursementmodes->id !!}">
                                                    {!! $disbursementmodes->name !!}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Processing Fee" class="col-md-3 m-t-10 control-label">Processing Fee</label>
                                <div class="col-md-3 m-t-10">
                                    <input type="text" name="processing_fee" id="processing_fee" class="form-control"
                                        placeholder="Processing Fee" value="{!! $loansdata['data']->processing_fee !!}" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Clearing Fee" class="col-md-3 m-t-10 control-label">Clearing Fee</label>
                                <div class="col-md-3 m-t-10">
                                    <input type="text" name="clearing_fee" id="clearing_fee" class="form-control"
                                        placeholder="Clearing Fee" value="{!! $loansdata['data']->clearing_fee !!}" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Insurance Deduction Fee" class="col-md-3 m-t-10 control-label">Insurance
                                    Deduction Fee</label>
                                <div class="col-md-3 m-t-10">
                                    <input type="text" name="insurance_deduction_fee" id="insurance_deduction_fee"
                                        class="form-control" placeholder="Insurance Deduction Fee"
                                        value="{!! $loansdata['data']->insurance_deduction_fee !!}" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Fine Type" class="col-md-3 m-t-10 control-label">Fine Type</label>
                                <div class="col-md-3 m-t-10">
                                    <select class="form-control" name="fine_type" id="fine_type" readonly>
                                        <option disabled value="">Select Fine Type</option>
                                        @foreach ($loansdata['finetypes'] as $finetypes)
                                            @if ($finetypes->id == $loansdata['data']->fine_type)
                                                <option selected value="{!! $finetypes->id !!}">
                                                    {!! $finetypes->name !!}
                                                </option>
                                            @else
                                                <option disabled value="{!! $finetypes->id !!}">
                                                    {!! $finetypes->name !!}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Fine Charge" class="col-md-3 m-t-10 control-label">Fine Charge</label>
                                <div class="col-md-3 m-t-10">
                                    <input type="text" name="fine_charge" id="fine_charge" class="form-control"
                                        placeholder="Fine Charge" value="{!! $loansdata['data']->fine_charge !!}" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Fine Charge Frequency" class="col-md-3 m-t-10 control-label">Fine Charge
                                    Frequency</label>
                                <div class="col-md-3 m-t-10">
                                    <select class="form-control" name="fine_charge_frequency" id="fine_charge_frequency" readonly>
                                        <option disabled value="">Select Fine Charge Frequency</option>
                                        @foreach ($loansdata['finechargefrequencies'] as $finechargefrequencies)
                                            @if ($finechargefrequencies->id == $loansdata['data']->fine_charge_frequency)
                                                <option selected value="{!! $finechargefrequencies->id !!}">
                                                    {!! $finechargefrequencies->name !!}
                                                </option>
                                            @else
                                                <option disabled value="{!! $finechargefrequencies->id !!}">
                                                    {!! $finechargefrequencies->name !!}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Fine Charge Period" class="col-md-3 m-t-10 control-label">Fine Charge
                                    Period</label>
                                <div class="col-md-3 m-t-10">
                                    <select class="form-control" name="fine_charge_period" id="fine_charge_period" readonly>
                                        <option disabled value="">Select Fine Charge Period</option>
                                        @foreach ($loansdata['finechargeperiods'] as $finechargeperiods)
                                            @if ($finechargeperiods->id == $loansdata['data']->fine_charge_period)
                                                <option selected value="{!! $finechargeperiods->id !!}">
                                                    {!! $finechargeperiods->name !!}
                                                </option>
                                            @else
                                                <option disabled value="{!! $finechargeperiods->id !!}">
                                                    {!! $finechargeperiods->name !!}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Initial Deposit" class="col-md-3 m-t-10 control-label">Initial Deposit</label>
                                <div class="col-md-3 m-t-10">
                                    <input type="text" name="initial_deposit" id="initial_deposit"
                                        class="form-control" placeholder="Initial Deposit"
                                        value="{!! $loansdata['data']->initial_deposit !!}" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Fine Charge Period" class="col-md-3 m-t-10 control-label">Loan Status</label>
                                <div class="col-md-3 m-t-10">
                                    <select class="form-control" name="status" id="status" readonly>
                                        <option disabled value="">Select Loan Status</option>
                                        @foreach ($loansdata['loanstatuses'] as $status)
                                            <option value="{!! $status->id !!}" @if ($status->id == $loansdata['data']->status) selected @else disabled @endif>
                                                {!! ucwords($status->name) !!}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-md-3 m-t-10">
                                    <div class="col-sm-offset-3 col-md-3 m-t-10">
                                        <button type="submit" class="btn btn-sm btn-primary">
                                            <i class="fa fa-btn fa-plus"></i> Reschedule Loan
                                        </button>
                                    </div>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script language="javascript" type="text/javascript">
        $("#date").datepicker({
            todayHighlight: !0,
            autoclose: !0
        });
    </script>
@endsection
