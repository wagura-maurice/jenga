@extends('admin.home')
@section('main_content')
    <style type="text/css">
        img {
            max-width: 100%;
            max-height: 100%;
        }
    </style>
    <div id="content" class="content">
        <ol class="breadcrumb pull-right">
            <li><a href="#">Home</a></li>
            <li><a href="#">public</a></li>
            <li><a href="#">Loans</a></li>
            <li class="active">form</li>
        </ol>
        <h1 class="page-header">Loans Approval Form <small>loans details goes here...</small></h1>
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
                        <form action="{!! route('loans.update', $loansdata['data']->id) !!}" method="POST">
                            <input type="hidden" name="_method" value="put" />
                            {!! csrf_field() !!}
                            <div class="form-group">
                                <label for="Loan Number" class="col-md-3 m-t-10 control-label">Loan Number</label>
                                <div class="col-md-3 m-t-10">
                                    <label>{!! $loansdata['data']->loan_number !!}</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Loan Product" class="col-md-3 m-t-10 control-label">Loan Product</label>
                                <div class="col-md-3 m-t-10">
                                    <!-- <select class="form-control" name="loan_product" id="loan_product"> -->
                                    <label>
                                        {{ $loansdata['loanproduct']->name }}
                                    </label>

                                    <!-- </select> -->
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Client" class="col-md-3 m-t-10 control-label">Client</label>
                                <div class="col-md-3 m-t-10">
                                    <label>
                                        @foreach ($loansdata['clients'] as $clients)
                                            @if ($clients->id == $loansdata['data']->client)
                                                {!! $clients->client_number !!}
                                                {!! $clients->first_name !!}
                                                {!! $clients->middle_name !!}
                                                {!! $clients->last_name !!}
                                            @endif
                                        @endforeach
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Date" class="col-md-3 m-t-10 control-label">Date</label>
                                <div class="col-md-3 m-t-10">
                                    <label>{!! $loansdata['data']['date'] !!}</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Amount" class="col-md-3 m-t-10 control-label">Amount</label>
                                <div class="col-md-3 m-t-10">
                                    <label>{!! $loansdata['data']->amount !!}</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Interest Rate Type" class="col-md-3 m-t-10 control-label">Interest Rate
                                    Type</label>
                                <div class="col-md-3 m-t-10">
                                    <label>
                                        @foreach ($loansdata['interestratetypes'] as $interestratetypes)
                                            @if ($interestratetypes->id == $loansdata['data']->interest_rate_type)
                                                {!! $interestratetypes->name !!}
                                            @endif
                                        @endforeach
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Interest Rate" class="col-md-3 m-t-10 control-label">Interest Rate</label>
                                <div class="col-md-3 m-t-10">
                                    <label>{!! $loansdata['data']->interest_rate !!}</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Interest Payment Method" class="col-md-3 m-t-10 control-label">Interest Payment
                                    Method</label>
                                <div class="col-md-3 m-t-10">
                                    <label>
                                        @foreach ($loansdata['interestpaymentmethods'] as $interestpaymentmethods)
                                            @if ($interestpaymentmethods->id == $loansdata['data']->interest_payment_method)
                                                {!! $interestpaymentmethods->name !!}
                                            @endif
                                        @endforeach

                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Loan Payment Duration" class="col-md-3 m-t-10 control-label">Loan Payment
                                    Duration</label>
                                <div class="col-md-3 m-t-10">
                                    <label>
                                        @foreach ($loansdata['loanpaymentdurations'] as $loanpaymentdurations)
                                            @if ($loanpaymentdurations->id == $loansdata['data']->loan_payment_duration)
                                                {!! $loanpaymentdurations->name !!}
                                            @endif
                                        @endforeach

                                    </label>

                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Loan Payment Frequency" class="col-md-3 m-t-10 control-label">Loan Payment
                                    Frequency</label>
                                <div class="col-md-3 m-t-10">
                                    <label>
                                        @foreach ($loansdata['loanpaymentfrequencies'] as $loanpaymentfrequencies)
                                            @if ($loanpaymentfrequencies->id == $loansdata['data']->loan_payment_frequency)
                                                {!! $loanpaymentfrequencies->name !!}
                                            @endif
                                        @endforeach

                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Grace Period" class="col-md-3 m-t-10 control-label">Grace Period</label>
                                <div class="col-md-3 m-t-10">
                                    <label>
                                        @foreach ($loansdata['graceperiods'] as $graceperiods)
                                            @if ($graceperiods->id == $loansdata['data']->grace_period)
                                                {!! $graceperiods->name !!}
                                            @endif
                                        @endforeach
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Interest Charged" class="col-md-3 m-t-10 control-label">Interest Charged</label>
                                <div class="col-md-3 m-t-10">
                                    <label>{!! $loansdata['data']->interest_charged !!}</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Total Loan Amount" class="col-md-3 m-t-10 control-label">Total Loan
                                    Amount</label>
                                <div class="col-md-3 m-t-10">
                                    <label>{!! $loansdata['data']->total_loan_amount !!}</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Amount To Be Disbursed" class="col-md-3 m-t-10 control-label">Amount To Be
                                    Disbursed</label>
                                <div class="col-md-3 m-t-10">
                                    <label>{!! $loansdata['data']->amount_to_be_disbursed !!}</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Mode Of Disbursement" class="col-md-3 m-t-10 control-label">Mode Of
                                    Disbursement</label>
                                <div class="col-md-3 m-t-10">
                                    <label>
                                        @foreach ($loansdata['disbursementmodes'] as $disbursementmodes)
                                            @if ($disbursementmodes->id == $loansdata['data']->disbursement_mode)
                                                {!! $disbursementmodes->name !!}
                                            @endif
                                        @endforeach
                                    </label>

                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Clearing Fee" class="col-md-3 m-t-10 control-label">Clearing Fee</label>
                                <div class="col-md-3 m-t-10">
                                    <label>{!! $loansdata['data']->clearing_fee !!}</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Clearing Fee" class="col-md-3 m-t-10 control-label">Processing Fee</label>
                                <div class="col-md-3 m-t-10">
                                    <label>{!! $loansdata['data']->processing_fee !!}</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Insurance Deduction Fee" class="col-md-3 m-t-10 control-label">Insurance
                                    Deduction Fee</label>
                                <div class="col-md-3 m-t-10">
                                    <label>{!! $loansdata['data']->insurance_deduction_fee !!}</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Fine Type" class="col-md-3 m-t-10 control-label">Fine Type</label>
                                <div class="col-md-3 m-t-10">
                                    <label>
                                        @foreach ($loansdata['finetypes'] as $finetypes)
                                            @if ($finetypes->id == $loansdata['data']->fine_type)
                                                {!! $finetypes->name !!}
                                            @endif
                                        @endforeach
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Fine Charge" class="col-md-3 m-t-10 control-label">Fine Charge</label>
                                <div class="col-md-3 m-t-10">
                                    <label>{!! $loansdata['data']->fine_charge !!}</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Fine Charge Frequency" class="col-md-3 m-t-10 control-label">Fine Charge
                                    Frequency</label>
                                <div class="col-md-3 m-t-10">
                                    <label>
                                        @foreach ($loansdata['finechargefrequencies'] as $finechargefrequencies)
                                            @if ($finechargefrequencies->id == $loansdata['data']->fine_charge_frequency)
                                                {!! $finechargefrequencies->name !!}
                                            @endif
                                        @endforeach
                                    </label>

                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Fine Charge Period" class="col-md-3 m-t-10 control-label">Fine Charge
                                    Period</label>
                                <div class="col-md-3 m-t-10">
                                    <label>
                                        @foreach ($loansdata['finechargeperiods'] as $finechargeperiods)
                                            @if ($finechargeperiods->id == $loansdata['data']->fine_charge_period)
                                                {!! $finechargeperiods->name !!}
                                            @endif
                                        @endforeach

                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Initial Deposit" class="col-md-3 m-t-10 control-label">Initial Deposit</label>
                                <div class="col-md-3 m-t-10">
                                    <label>{!! $loansdata['data']->initial_deposit !!}</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Status" class="col-md-3 m-t-10 control-label">Status</label>
                                <div class="col-md-3 m-t-10">
                                    <label>
                                        @foreach ($loansdata['loanstatuses'] as $loanstatuses)
                                            @if ($loanstatuses->id == $loansdata['data']['status'])
                                                {!! $loanstatuses->name !!}
                                            @endif
                                        @endforeach


                                    </label>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
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
                            <a href="#" class="btn btn-xs btn-icon btn-circle btn-danger"
                                data-click="panel-remove"><i class="fa fa-times"></i></a>
                        </div>
                        <h4 class="panel-title">Loan Documents</h4>
                    </div>
                    <div class="panel-body">
                        <div id="" class="row">

                            @foreach ($loansdata['documents'] as $loandocuments)
                                <div class="col-md-4">

                                    <div class="row">
                                        <div class="col-md-12">
                                            <img src="{!! asset('uploads/images/' . $loandocuments->document) !!}" />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <p class="form-control-static">{{ $loandocuments->document }}</p>
                                        </div>
                                    </div>

                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
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
                            <a href="#" class="btn btn-xs btn-icon btn-circle btn-danger"
                                data-click="panel-remove"><i class="fa fa-times"></i></a>
                        </div>
                        <h4 class="panel-title">Guarantors</h4>
                    </div>
                    <div class="panel-body">
                        <table id="data-table" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>First Name</th>
                                    <th>Middle Name</th>
                                    <th>Last Name</th>
                                    <th>Id Number</th>
                                    <th>County</th>
                                    <th>Sub County</th>
                                    <th>Primary Phone Number</th>
                                    <th>Secondary Phone Number</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($loansdata['guarantors'] as $guarantors)
                                    <tr>
                                        <td class='table-text'>
                                            <div>
                                                {!! $guarantors->guarantormodel->first_name !!}
                                            </div>
                                        </td>
                                        <td class='table-text'>
                                            <div>
                                                {!! $guarantors->guarantormodel->middle_name !!}
                                            </div>
                                        </td>
                                        <td class='table-text'>
                                            <div>
                                                {!! $guarantors->guarantormodel->last_name !!}
                                            </div>
                                        </td>
                                        <td class='table-text'>
                                            <div>
                                                {!! $guarantors->guarantormodel->id_number !!}
                                            </div>
                                        </td>
                                        <td class='table-text'>
                                            <div>
                                                {!! $guarantors->guarantormodel->countymodel->name !!}
                                            </div>
                                        </td>
                                        <td class='table-text'>
                                            <div>
                                                {!! $guarantors->guarantormodel->subcountymodel->name !!}
                                            </div>
                                        </td>
                                        <td class='table-text'>
                                            <div>
                                                {!! $guarantors->guarantormodel->primary_phone_number !!}
                                            </div>
                                        </td>
                                        <td class='table-text'>
                                            <div>
                                                {!! $guarantors->guarantormodel->secondary_phone_number !!}
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
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
                            <a href="#" class="btn btn-xs btn-icon btn-circle btn-danger"
                                data-click="panel-remove"><i class="fa fa-times"></i></a>
                        </div>
                        <h4 class="panel-title">Collaterals</h4>
                    </div>
                    <div class="panel-body">
                        <table id="data-table" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Loan</th>
                                    <th>Collateral Category</th>
                                    <th>Model</th>
                                    <th>Color</th>
                                    <th>Size</th>
                                    <th>Year Bought</th>
                                    <th>Buying Price</th>
                                    <th>Current Selling Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($loansdata['collaterals'] as $loancollaterals)
                                    <tr>
                                        <td class='table-text'>
                                            <div>
                                                {!! $loancollaterals->loanmodel->loan_number !!}
                                            </div>
                                        </td>
                                        <td class='table-text'>
                                            <div>
                                                {!! $loancollaterals->collateralcategorymodel->name !!}
                                            </div>
                                        </td>
                                        <td class='table-text'>
                                            <div>
                                                {!! $loancollaterals->model !!}
                                            </div>
                                        </td>
                                        <td class='table-text'>
                                            <div>
                                                {!! $loancollaterals->color !!}
                                            </div>
                                        </td>
                                        <td class='table-text'>
                                            <div>
                                                {!! $loancollaterals->size !!}
                                            </div>
                                        </td>
                                        <td class='table-text'>
                                            <div>
                                                {!! $loancollaterals->year_bought !!}
                                            </div>
                                        </td>
                                        <td class='table-text'>
                                            <div>
                                                {!! $loancollaterals->buying_price !!}
                                            </div>
                                        </td>
                                        <td class='table-text'>
                                            <div>
                                                {!! $loancollaterals->current_selling_price !!}
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
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
                            <a href="#" class="btn btn-xs btn-icon btn-circle btn-danger"
                                data-click="panel-remove"><i class="fa fa-times"></i></a>
                        </div>
                        <h4 class="panel-title" id="guarantors-title">Clearing Fee</h4>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label for="Fee Type" class="col-md-3 m-t-10 control-label text-right">Clearing Fee
                                Type</label>
                            <div class="col-md-3 m-t-10">

                                <p class="form-control-static text-inverse">
                                    {{ $loansdata['loanproduct']->clearingfeetypemodel->name }}@if ($loansdata['loanproduct']->clearingfeetypemodel->code == '001')
                                        - {{ $loansdata['loanproduct']->clearing_fee }}
                                    @endif

                                </p>
                                <input type="hidden" class="form-control" id="clearing_fee_type"
                                    name="clearing_fee_type" value="{{ $loansdata['loanproduct']->clearing_fee_type }}" />
                                <input type="hidden" class="form-control" id="clearing_fee_code"
                                    name="clearing_fee_code"
                                    value="{{ $loansdata['loanproduct']->clearingfeetypemodel->code }}" />
                            </div>
                            <label for="Fee Payment Type" class="col-md-3 m-t-10 control-label text-right">Clearing Fee
                                Payment Type</label>
                            <div class="col-md-3 m-t-10">
                                <p class="form-control-static text-inverse">
                                    {{ $loansdata['loanproduct']->clearingfeepaymenttypemodel->name }}


                                </p>
                                <input type="hidden" class="form-control" id="clearing_fee_payment_type"
                                    name="clearing_fee_payment_type"
                                    value="{{ $loansdata['loanproduct']->clearing_fee_payment_type }}" />
                                <input type="hidden" class="form-control" id="clearing_fee_payment_type_code"
                                    name="clearing_fee_payment_type_code"
                                    value="{{ $loansdata['loanproduct']->clearingfeepaymenttypemodel->code }}" />


                            </div>
                        </div>

                        <div class="form-group">
                            <label for="Clearing Fee" class="col-md-3 m-t-10 control-label text-right">Clearing
                                Fee</label>
                            <div class="col-md-3 m-t-10">
                                <p class="form-control-static text-inverse" id="clearing_fee_amount_label">
                                    {{ $loansdata['clearingfee'] }}


                                </p>
                                <input type="hidden" name="clearing_fee_value" id="clearing_fee_value"
                                    value="{{ $loansdata['loanproduct']->clearing_fee }}" />
                                <input type="hidden" name="clearing_fee" id="clearing_fee" class="form-control"
                                    placeholder="Clearing Fee" value="{{ $loansdata['clearingfee'] }}" />
                            </div>

                            <!--                             <div class="col-md-3 m-t-10">
                                        @if ($loansdata['loanproduct']->clearingfeepaymenttypemodel->code == '001')
    <a href="#clearing-fee-modal-dialog" class="btn btn-danger" data-toggle="modal">Pay Now</a>
    @endif

                                    </div> -->

                        </div>
                        <div class="form-group">
                            <label for="Clearing Fee" class="col-md-3 m-t-10 control-label text-right">Amount Paid</label>
                            <div class="col-md-3 m-t-10">
                                <p class="form-control-static text-inverse">
                                    @if (isset($loansdata['clearingfeepaid']))
                                        {{ $loansdata['clearingfeepaid'] }}
                                    @endif

                                </p>


                            </div>
                        </div>
                        <div id="clearing-fee-payment" class="hidden">
                            <div class="form-group">
                                <label for="Payment Mode" class="col-md-3 m-t-10 control-label">Payment Mode</label>
                                <div class="col-sm-6">
                                    <select class="form-control selectpicker" data-size="100000" data-live-search="true"
                                        data-style="btn-white" name="_payment_mode_clearing_fee"
                                        id="_payment_mode_clearing_fee">
                                        <option value="">Select Payment Mode</option>
                                        @foreach ($loansdata['paymentmodes'] as $paymentmodes)
                                            <option value="{!! $paymentmodes->id !!}">

                                                {!! $paymentmodes->name !!}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Transaction Number" class="col-md-3 m-t-10 control-label">Transaction
                                    Number</label>
                                <div class="col-sm-6">
                                    <input type="text" name="_transaction_number_clearing_fee"
                                        id="_transaction_number_clearing_fee" class="form-control"
                                        placeholder="Transaction Number" value="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Amount" class="col-md-3 m-t-10 control-label">Amount</label>
                                <div class="col-sm-6">
                                    <p class="form-control-static text-inverse">{{ $loansdata['clearingfee'] }}


                                    </p>
                                    <input type="hidden" name="_amount_clearing_fee" id="_amount_clearing_fee"
                                        class="form-control" placeholder="Clearing Fee"
                                        value="{{ $loansdata['clearingfee'] }}" />
                                </div>
                            </div>


                        </div>


                    </div>
                </div>
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
                            <a href="#" class="btn btn-xs btn-icon btn-circle btn-danger"
                                data-click="panel-remove"><i class="fa fa-times"></i></a>
                        </div>
                        <h4 class="panel-title" id="guarantors-title">Processing Fee</h4>
                    </div>
                    <div class="panel-body">

                        <div class="form-group">
                            <label for="Fee Type" class="col-md-3 m-t-10 control-label text-right">Processing Fee
                                Type</label>
                            <div class="col-md-3 m-t-10">
                                <p class="form-control-static text-inverse">
                                    @if ($loansdata['loanproduct']->processing_fee_type != null)
                                        {{ $loansdata['loanproduct']->processingfeetypemodel->name }} @if ($loansdata['loanproduct']->processingfeetypemodel->code == '001')
                                            - {{ $loansdata['loanproduct']->processing_fee }}
                                        @endif
                                    @endif
                                </p>
                                <input type="hidden" class="form-control" id="processing_fee_type"
                                    name="processing_fee_type"
                                    value="{{ $loansdata['loanproduct']->processing_fee_type }}" />
                                <input type="hidden" class="form-control" id="processing_fee_type_code"
                                    name="processing_fee_type_code"
                                    value="{{ $loansdata['loanproduct']->processingfeetypemodel->code }}" />
                            </div>
                            <label for="Fee Payment Type" class="col-md-3 m-t-10 control-label text-right">Processing Fee
                                Payment Type</label>
                            <div class="col-md-3 m-t-10">
                                <p class="form-control-static text-inverse">
                                    {{ $loansdata['loanproduct']->processingfeepaymenttypemodel->name }}</p>
                                <input type="hidden" class="form-control" id="processing_fee_payment_type"
                                    name="processing_fee_payment_type"
                                    value="{{ $loansdata['loanproduct']->processing_fee_payment_type }}" />
                                <input type="hidden" class="form-control" id="processing_fee_payment_type_code"
                                    name="processing_fee_payment_type_code"
                                    value="{{ $loansdata['loanproduct']->processingfeepaymenttypemodel->code }}" />
                            </div>
                        </div>
                        <div class="form-group ">
                            <label for="Processing Fee" class="col-md-3 m-t-10 control-label text-right">Processing
                                Fee</label>
                            <div class="col-md-3 m-t-10">
                                <p class="form-control-static text-inverse" id="processing_fee_amount_label">
                                    {{ $loansdata['processingfee'] }}


                                </p>
                                <input type="hidden" name="processing_fee_value" id="processing_fee_value"
                                    class="form-control" placeholder="Insurance Deduction Fee"
                                    value="{{ $loansdata['loanproduct']->processing_fee }}">
                                <input type="hidden" name="processing_fee" id="processing_fee" class="form-control"
                                    placeholder="Insurance Deduction Fee" value="{{ $loansdata['processingfee'] }}">
                            </div>

                            <!--                            <div class="col-md-3 m-t-10">
                                        @if ($loansdata['loanproduct']->insurancedeductionfeepaymenttypemodel->code == '001')
    <a href="#insurance-deduction-fee-modal-dialog" class="btn btn-danger" data-toggle="modal">Pay Now</a>
    @endif
                                    </div> -->
                        </div>
                        <div class="form-group">
                            <label for="Clearing Fee" class="col-md-3 m-t-10 control-label text-right">Amount Paid</label>
                            <div class="col-md-3 m-t-10">
                                <p class="form-control-static text-inverse">
                                    @if (isset($loansdata['processingfeepaid']))
                                        {{ $loansdata['processingfeepaid'] }}
                                    @endif

                                </p>


                            </div>
                        </div>
                    </div>
                </div>
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
                            <a href="#" class="btn btn-xs btn-icon btn-circle btn-danger"
                                data-click="panel-remove"><i class="fa fa-times"></i></a>
                        </div>
                        <h4 class="panel-title" id="guarantors-title">Insurance Deduction Fee</h4>
                    </div>
                    <div class="panel-body">

                        <div class="form-group">
                            <label for="Fee Type" class="col-md-3 m-t-10 control-label text-right">Insurance Deduction
                                Type</label>
                            <div class="col-md-3 m-t-10">
                                <p class="form-control-static text-inverse">
                                    @if ($loansdata['loanproduct']->insurance_deduction_fee_type != null)
                                        {{ $loansdata['loanproduct']->insurancedeductionfeetypemodel->name }} @if ($loansdata['loanproduct']->insurancedeductionfeetypemodel->code == '001')
                                            - {{ $loansdata['loanproduct']->insurance_deduction_fee }}
                                        @endif
                                    @endif
                                </p>
                                <input type="hidden" class="form-control" id="insurance_deduction_fee_type"
                                    name="insurance_deduction_fee_type"
                                    value="{{ $loansdata['loanproduct']->insurance_deduction_fee_type }}" />
                                <input type="hidden" class="form-control" id="insurance_deduction_fee_type_code"
                                    name="insurance_deduction_fee_type_code"
                                    value="{{ $loansdata['loanproduct']->insurancedeductionfeetypemodel->code }}" />
                            </div>
                            <label for="Fee Payment Type" class="col-md-3 m-t-10 control-label text-right">Insurance
                                Deducation Payment Type</label>
                            <div class="col-md-3 m-t-10">
                                <p class="form-control-static text-inverse">
                                    {{ $loansdata['loanproduct']->insurancedeductionfeepaymenttypemodel->name }}</p>
                                <input type="hidden" class="form-control" id="insurance_deduction_fee_payment_type"
                                    name="insurance_deduction_fee_payment_type"
                                    value="{{ $loansdata['loanproduct']->insurance_deduction_fee_payment_type }}" />
                                <input type="hidden" class="form-control" id="insurance_deduction_fee_payment_type_code"
                                    name="insurance_deduction_fee_payment_type_code"
                                    value="{{ $loansdata['loanproduct']->insurancedeductionfeepaymenttypemodel->code }}" />
                            </div>
                        </div>
                        <div class="form-group ">
                            <label for="Insurance Deduction Fee"
                                class="col-md-3 m-t-10 control-label text-right">Insurance Deduction Fee</label>
                            <div class="col-md-3 m-t-10">
                                <p class="form-control-static text-inverse" id="insurance_deduction_fee_amount_label">
                                    {{ $loansdata['insurancedeductionfee'] }}


                                </p>
                                <input type="hidden" name="insurance_deduction_fee_value"
                                    id="insurance_deduction_fee_value" class="form-control"
                                    placeholder="Insurance Deduction Fee"
                                    value="{{ $loansdata['loanproduct']->insurance_deduction_fee }}">
                                <input type="hidden" name="insurance_deduction_fee" id="insurance_deduction_fee"
                                    class="form-control" placeholder="Insurance Deduction Fee"
                                    value="{{ $loansdata['insurancedeductionfee'] }}">
                            </div>
                            <!--                            <div class="col-md-3 m-t-10">
                                        @if ($loansdata['loanproduct']->insurancedeductionfeepaymenttypemodel->code == '001')
    <a href="#insurance-deduction-fee-modal-dialog" class="btn btn-danger" data-toggle="modal">Pay Now</a>
    @endif
                                    </div> -->
                        </div>
                        <div class="form-group">
                            <label for="Clearing Fee" class="col-md-3 m-t-10 control-label text-right">Amount Paid</label>
                            <div class="col-md-3 m-t-10">
                                <p class="form-control-static text-inverse">
                                    @if (isset($loansdata['insurancedeductionfeepaid']))
                                        {{ $loansdata['insurancedeductionfeepaid'] }}
                                    @endif

                                </p>


                            </div>
                        </div>
                    </div>
                </div>
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
                            <a href="#" class="btn btn-xs btn-icon btn-circle btn-danger"
                                data-click="panel-remove"><i class="fa fa-times"></i></a>
                        </div>
                        <h4 class="panel-title">Loan Schedule</h4>
                    </div>
                    <div class="panel-body">

                        <table id="collaterals-table" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Payment Date</th>
                                    <th>Amount</th>
                                    <th>Expected Payment</th>
                                    <th>Exptected Balance</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($loansdata['loanschedule'] as $loanschedule)
                                    <tr>
                                        <td>{{ $loanschedule['date'] }}</td>
                                        <td>{{ $loanschedule['amount'] }}</td>
                                        <td>{{ $loanschedule['expectedpayment'] }}</td>
                                        <td>{{ $loanschedule['expectedbalance'] }}</td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>

        </div>

        @if (isset($loansdata['otherapprovals'][0]))
            @foreach ($loansdata['otherapprovals'] as $otherapprovall)
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
                                <h4 class="panel-title">Other Approval</h4>
                            </div>
                            <div class="panel-body">
                                <form class="form-horizontal">


                                    <div class="row">
                                        <label for="Grace Period" class="col-md-3 m-t-10 control-label">Approval
                                            Level</label>


                                        <label class="col-md-9 m-t-10 control-label text-left">
                                            @foreach ($loansdata['approvallevels'] as $approvallevel)
                                                @if ($approvallevel->id == $otherapprovall['approval_level'])
                                                    {!! $approvallevel->name !!}
                                                @endif
                                            @endforeach
                                        </label>

                                    </div>
                                    <div class="row">



                                        <label for="Grace Period" class="col-md-3 m-t-10 control-label">Approval
                                            Account</label>


                                        <label class="col-md-9 m-t-10 control-label text-left">
                                            @foreach ($loansdata['usersaccounts'] as $useraccount)
                                                @if ($useraccount->id == $otherapprovall['user_account'])
                                                    {!! $useraccount->name !!}
                                                @endif
                                            @endforeach
                                        </label>


                                    </div>
                                    <div class="row">



                                        <label for="Grace Period" class="col-md-3 m-t-10 control-label">Approved
                                            By</label>


                                        <label class="col-md-9 m-t-10 control-label text-left">
                                            @foreach ($loansdata['users'] as $user)
                                                @if (isset($otherapprovall['user']))
                                                    @if ($user->id == $otherapprovall['user'])
                                                        {!! $user->name !!}
                                                    @endif
                                                @endif
                                            @endforeach
                                        </label>


                                    </div>
                                    <div class="row">

                                        <label for="Grace Period" class="col-md-3 m-t-10 control-label">Date</label>


                                        <label class="col-md-9 m-t-10 control-label text-left">
                                            @if (isset($otherapprovall['date']))
                                                {{ $otherapprovall['date'] }}
                                            @endif
                                        </label>

                                    </div>
                                    <div class="row">


                                        <label for="Grace Period" class="col-md-3 m-t-10 control-label">Comments</label>
                                        <label class="col-md-9 m-t-10 control-label text-left">


                                            @if (isset($otherapprovall['comments']))
                                                {!! $otherapprovall['comments'] !!}
                                            @endif
                                        </label>

                                    </div>
                                    <div class="row">
                                        <label class="col-md-3 m-t-10 control-label">Status : </label>
                                        <label class="col-md-9 m-t-10 control-label text-left">
                                            @if (isset($otherapprovall['status']))
                                                @foreach ($loansdata['approvalstatuses'] as $approvalstatus)
                                                    @if ($approvalstatus->id == $otherapprovall['status'])
                                                        {!! $approvalstatus->name !!}
                                                    @endif
                                                @endforeach
                                            @endif
                                        </label>

                                    </div>


                                </form>


                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif


        @if (isset($loansdata['myapprovals'][0]))
            @foreach ($loansdata['myapprovals'] as $myapproval)
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
                                <h4 class="panel-title">My Approval</h4>
                            </div>
                            <div class="panel-body">
                                <form action="{!! url('/admin/approveloan/') !!}" method="POST" class="form-horizontal">
                                    {!! csrf_field() !!}
                                    <div class="form-group">
                                        <label for="Grace Period" class="col-md-3 m-t-10 control-label">Approval
                                            Level</label>


                                        <label class="col-md-9 m-t-10 control-label text-left">
                                            @foreach ($loansdata['approvallevels'] as $approvallevel)
                                                @if ($approvallevel->id == $myapproval['approval_level'])
                                                    {!! $approvallevel->name !!}
                                                @endif
                                            @endforeach
                                        </label>


                                    </div>
                                    <div class="form-group m-t-10">
                                        <label for="Grace Period" class="col-md-3 m-t-10 control-label">Approval
                                            Account</label>


                                        <label class="col-md-9 m-t-10 control-label text-left">
                                            @foreach ($loansdata['usersaccounts'] as $useraccount)
                                                @if ($useraccount->id == $myapproval['user_account'])
                                                    {!! $useraccount->name !!}
                                                @endif
                                            @endforeach
                                        </label>


                                    </div>
                                    <div class="form-group m-t-10">
                                        <label for="Grace Period" class="col-md-3 m-t-10 control-label">Will Be Approval
                                            By</label>


                                        <label class="col-md-9 m-t-10 control-label text-left">
                                            @foreach ($loansdata['users'] as $user)
                                                @if ($user->id == $loansdata['user'][0]->id)
                                                    {!! $user->name !!}
                                                @endif
                                            @endforeach
                                        </label>


                                    </div>

                                    <div class="form-group">
                                        <label for="Grace Period" class="col-md-3 m-t-10 control-label">Date</label>


                                        <label class="col-md-9 m-t-10 control-label text-left">
                                            @if (isset($myapproval['date']))
                                                {{ $myapproval['date'] }}
                                            @else
                                                {{ $loansdata['today'] }}
                                            @endif
                                        </label>


                                    </div>

                                    <div class="form-group">
                                        <label for="Grace Period" class="col-md-3 m-t-10 control-label">Pending
                                            Fees</label>


                                        <label
                                            class="col-md-9 m-t-10 control-label text-left @if ($loansdata['pendingfee'] > 0) text-danger @endif">
                                            {{ $loansdata['pendingfee'] }}
                                        </label>


                                    </div>

                                    <div class="form-group">
                                        <label for="Grace Period" class="col-md-3 m-t-10 control-label">Comments</label>

                                        @if ($loansdata['myturn'] == true)
                                            @if (isset($myapproval['comments']))
                                                <label class="col-md-9 m-t-10 control-label text-left">
                                                    {!! $myapproval['comments'] !!}
                                                </label>
                                            @else
                                                <div class="col-md-3 m-t-10">
                                                    <input type="hidden" name="user"
                                                        value="{{ $loansdata['user'][0]->id }}">
                                                    <input type="hidden" name="loan"
                                                        value="{{ $loansdata['data']->id }}">
                                                    <input type="hidden" name="user_account"
                                                        value="{{ $loansdata['user'][0]->user_account }}">
                                                    <input type="hidden" name='approval_level'
                                                        value="{{ $myapproval['approval_level'] }}">
                                                    <input type="hidden" name="date"
                                                        value="{{ $loansdata['today'] }}">
                                                    <textarea cols="80" rows="10" name="comment">
                                                
                                            </textarea>
                                                </div>
                                            @endif
                                        @endif

                                    </div>

                                    @if ($loansdata['myturn'] == true)
                                        @if (isset($myapproval['status']))
                                            @foreach ($loansdata['approvalstatuses'] as $approvalstatus)
                                                @if ($approvalstatus->id == $myapproval['status'])
                                                    <label class="col-md-3 m-t-10 control-label">Status</label>
                                                    <label class="col-md-9 m-t-10 control-label text-left">

                                                        {!! $approvalstatus->name !!}
                                                    </label>
                                                @endif
                                            @endforeach
                                        @else
                                            @foreach ($loansdata['approvalstatuses'] as $approvalstatus)
                                                <div class="form-group">
                                                    <label
                                                        class="col-md-3 m-t-10 control-label">{{ $approvalstatus->name }}</label>
                                                    <div class="col-md-3 m-t-10">
                                                        <input type="radio" name="status"
                                                            value="{{ $approvalstatus->id }}">
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                    @endif

                                    @if ($loansdata['myturn'] == true && $loansdata['pendingfee'] <= 0)
                                        @if (!isset($myapproval['status']))
                                            <div class="form-group">
                                                <label class="col-md-3"></label>
                                                <div class="col-md-3">
                                                    <button class="btn btn-primary" type="submit">Submit</button>

                                                </div>

                                            </div>
                                        @endif
                                    @endif
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif


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
