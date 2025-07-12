@extends('admin.home')
@section('main_content')
    <style type="text/css">
        select[disabled],
        input[disabled] {
            color: #000000;
            font-weight: bold;
        }
    </style>
    <div id="content" class="content">
        <ol class="breadcrumb pull-right">
            <li><a href="#">Home</a></li>
            <li><a href="#">public</a></li>
            <li><a href="#">Loans</a></li>
            <li class="active">form</li>
        </ol>
        <h1 class="page-header">Loans Form <small>loans details goes here...</small></h1>
        <div class="row">
            <div class="col-md-12">
                <a href="{!! url(
                    '/admin/loanapplicationclients/' . $loansdata['loanproduct']->id . '/' . $loansdata['client']->client_type,
                ) !!}"><button type="button"
                        class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-arrow-left"></i></button></a>
            </div>
        </div>
        <form id="form" enctype="multipart/form-data">
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
                            <h4 class="panel-title">Loan Details</h4>
                        </div>

                        <div class="panel-body">
                            {!! csrf_field() !!}
                            <input type="hidden" name="rescheduled_loan_number"
                                value="{{ isset($loansdata['rescheduled_loan_number']) && $loansdata['rescheduled_loan_number'] ? $loansdata['rescheduled_loan_number'] : null }}">
                            <div class="form-group">
                                <label for="Loan Product" class="col-md-3 m-t-10 control-label text-right">Loan
                                    Product</label>
                                <div class="col-md-3 m-t-10">
                                    <p class="form-control-static text-inverse">
                                        <strong>{{ $loansdata['loanproduct']->name }}</strong>
                                    </p>
                                    <input type="hidden" id="loan_product" name="loan_product"
                                        value="{{ $loansdata['loanproduct']->id }}">

                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Client" class="col-md-3 m-t-10 control-label text-right">Client</label>
                                <div class="col-md-3 m-t-10">
                                    <p class="form-control-static text-inverse">
                                        <strong>{{ $loansdata['client']->client_number }}
                                            {{ $loansdata['client']->first_name }} {{ $loansdata['client']->middle_name }}
                                            {{ $loansdata['client']->last_name }}</strong>
                                    </p>

                                    <input type="hidden" class="form-control" id="client" name="client"
                                        value="{{ $loansdata['client']->id }}" />

                                </div>
                                <label for="Date" class="col-md-3 m-t-10 control-label text-right">Date</label>
                                <div class="col-md-3 m-t-10">
                                    <input type="text" name="date" id="date" class="form-control"
                                        placeholder="Date" value="">
                                </div>
                            </div>

                            @if ($loansdata['loanproduct']->is_asset == '1')
                                <div class="form-group">
                                    <label for="Asset" class="col-md-3 m-t-10 control-label text-right">Store</label>
                                    <div class="col-md-3 m-t-10">
                                        <select class="form-control selectpicker" data-size="100000" data-live-search="true"
                                            data-style="btn-white" name="store" id="store">
                                            <option value="">Select Store</option>
                                            @foreach ($loansdata['stores'] as $store)
                                                <option value="{!! $store->id !!}">
                                                    {!! strtoupper($store->name) !!}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            @endif

                            <div class="form-group">
                                <label for="Amount" class="col-md-3 m-t-10 control-label text-right">Amount</label>
                                <div class="col-md-3 m-t-10">
                                    @if (isset($loansdata['rescheduled_loan_number']))
                                        <input type="text" name="amount" id="amount" class="form-control"
                                            placeholder="Amount" value="{{ $loansdata['rescheduled_loan_balance'] }}"
                                            onchange="getInterestCharged()">
                                    @else
                                        @if ($loansdata['loanproduct']->is_asset == '1')
                                            <input type="hidden" name="amount" id="amount" class="form-control"
                                                placeholder="Amount"
                                                value="{{ $loansdata['loanproduct']->maximum_loan_amount }}"
                                                onchange="getInterestCharged()">
                                            <input type="text" disabled="disabled" name="_amount" id="_amount"
                                                class="form-control" placeholder="Amount"
                                                value="{{ $loansdata['loanproduct']->maximum_loan_amount }}">
                                        @else
                                            <input type="text" name="amount" id="amount" class="form-control"
                                                placeholder="Amount"
                                                value="{{ $loansdata['loanproduct']->maximum_loan_amount }}"
                                                onchange="getInterestCharged()">
                                        @endif
                                    @endif
                                    <input type="hidden" name="minimum_loan_amount" id="minimum_loan_amount"
                                        value="{{ $loansdata['loanproduct']->minimum_loan_amount }}" />
                                    <input type=hidden name="maximum_loan_amount" id="maximum_loan_amount"
                                        value="{{ $loansdata['loanproduct']->maximum_loan_amount }}" />
                                    <input type="hidden" name="number_of_guarantors" id="number_of_guarantors"
                                        value="{{ $loansdata['loanproduct']->number_of_guarantors }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Interest Rate Type" class="col-md-3 m-t-10 control-label text-right">Interest
                                    Rate Type</label>
                                <div class="col-md-3 m-t-10">
                                    <p class="form-control-static text-inverse">
                                        {{ $loansdata['loanproduct']->interestratetypemodel->name }}</p>
                                    <input type="hidden" class="form-control" id="interest_rate_type"
                                        name="interest_rate_type"
                                        value="{{ $loansdata['loanproduct']->interest_rate_type }}" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Interest Rate Period"
                                    class="col-md-3 m-t-10 control-label text-right">Interest Rate Period</label>
                                <div class="col-md-3 m-t-10">
                                    <p class="form-control-static text-inverse">
                                        {{ $loansdata['loanproduct']->interestrateperiodmodel->name }}</p>
                                    <input type="hidden" class="form-control" id="interest_rate_period"
                                        name="interest_rate_period"
                                        value="{{ $loansdata['loanproduct']->interest_rate_period }}" />
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="Interest Rate" class="col-md-3 m-t-10 control-label text-right">Interest
                                    Rate(r/100)</label>
                                <div class="col-md-3 m-t-10">
                                    <p class="form-control-static text-inverse">
                                        {{ $loansdata['loanproduct']->interest_rate }}</p>
                                    <input type="hidden" name="interest_rate" id="interest_rate" class="form-control"
                                        placeholder="Interest Rate"
                                        value="{{ $loansdata['loanproduct']->interest_rate }}"
                                        onchange="getInterestCharged()">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Interest Payment Method"
                                    class="col-md-3 m-t-10 control-label text-right">Interest Payment Method</label>
                                <div class="col-md-3 m-t-10">
                                    <p class="form-control-static text-inverse">
                                        {{ $loansdata['loanproduct']->interestpaymentmethodmodel->name }}</p>
                                    <input type="hidden" class="form-control" id="interest_payment_method"
                                        name="interest_payment_method"
                                        value="{{ $loansdata['loanproduct']->interest_payment_method }}" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Loan Payment Duration" class="col-md-3 m-t-10 control-label text-right">Loan
                                    Payment Duration</label>
                                <div class="col-md-3 m-t-10">
                                    <p class="form-control-static text-inverse">
                                        {{ $loansdata['loanproduct']->loanpaymentdurationmodel->name }}</p>
                                    <input type="hidden" class="form-control" id="loan_payment_duration"
                                        name="loan_payment_duration"
                                        value="{{ $loansdata['loanproduct']->loan_payment_duration }}" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Loan Payment Frequency" class="col-md-3 m-t-10 control-label text-right">Loan
                                    Payment Frequency</label>
                                <div class="col-md-3 m-t-10">
                                    <p class="form-control-static text-inverse">
                                        {{ $loansdata['loanproduct']->loanpaymentfrequencymodel->name }}</p>
                                    <input type="hidden" class="form-control" id="loan_payment_frequency"
                                        name="loan_payment_frequency"
                                        value="{{ $loansdata['loanproduct']->loan_payment_frequency }}" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Grace Period Type" class="col-md-3 m-t-10 control-label text-right">Grace
                                    Period Type</label>
                                <div class="col-md-3 m-t-10">
                                    <p class="form-control-static text-inverse">
                                        @if ($loansdata['loanproduct']->grace_period_type != null)
                                            {{ $loansdata['loanproduct']->graceperiodtypemodel->name }}
                                        @endif
                                    </p>
                                    <input type="hidden" class="form-control" id="grace_period_type"
                                        name="grace_period_type"
                                        value="{{ $loansdata['loanproduct']->grace_period_type }}" />
                                    <input type="hidden" class="form-control" id="grace_period_type_code"
                                        name="grace_period_type_code"
                                        value="{{ $loansdata['loanproduct']->graceperiodtypemodel->code }}" />
                                </div>
                            </div>
                            @if (
                                $loansdata['loanproduct']->grace_period_type != null &&
                                    $loansdata['loanproduct']->graceperiodtypemodel->code == '001')
                                <div class="form-group" id="grace_period_container">
                                    <label for="Grace Period" class="col-md-3 m-t-10 control-label text-right">Grace
                                        Period</label>
                                    <div class="col-md-3 m-t-10">
                                        <p class="form-control-static text-inverse">
                                            {{ $loansdata['loanproduct']->graceperiodmodel->name }}</p>
                                        <input type="hidden" class="form-control" id="grace_period" name="grace_period"
                                            value="{{ $loansdata['loanproduct']->grace_period }}" />
                                    </div>
                                </div>
                            @else
                                @if ($loansdata['loanproduct']->grace_period_type != null)
                                    <div class="form-group" id="min_grace_period_container">
                                        <label for="Min Grace Period" class="col-md-3 m-t-10 control-label text-right">Min
                                            Grace Period</label>
                                        <div class="col-md-3 m-t-10">
                                            <p class="form-control-static text-inverse">
                                                {{ $loansdata['loanproduct']->mingraceperiodmodel->name }}</p>
                                            <input type="hidden" class="form-control" id="min_grace_period"
                                                name="min_grace_period"
                                                value="{{ $loansdata['loanproduct']->min_grace_period }}" />
                                        </div>

                                    </div>
                                    <div class="form-group" id="max_grace_period_container">
                                        <label for="Max Grace Period" class="col-md-3 m-t-10 control-label text-right">Max
                                            Grace Period</label>
                                        <div class="col-md-3 m-t-10">
                                            <p class="form-control-static text-inverse">
                                                {{ $loansdata['loanproduct']->maxgraceperiodmodel->name }}</p>
                                            <input type="hidden" class="form-control" id="max_grace_period"
                                                name="max_grace_period"
                                                value="{{ $loansdata['loanproduct']->max_grace_period }}" />
                                        </div>
                                    </div>
                                @endif
                            @endif

                            <div class="form-group">
                                <label for="Interest Charged" class="col-md-3 m-t-10 control-label text-right">Interest
                                    Charged</label>
                                <div class="col-md-3 m-t-10">
                                    <input type="text" name="_interest_charged" id="_interest_charged"
                                        class="form-control bg-white" placeholder="Interest Charged"
                                        value="{{ $loansdata['interestcharged'] }}" disabled="">
                                    <input type="hidden" name="interest_charged" id="interest_charged"
                                        class="form-control" placeholder="Interest Charged"
                                        value="{{ $loansdata['interestcharged'] }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Total Loan Amount" class="col-md-3 m-t-10 control-label text-right">Total Loan
                                    Amount</label>
                                <div class="col-md-3 m-t-10">
                                    <input type="text" name="_total_loan_amount" id="_total_loan_amount"
                                        class="form-control bg-white" placeholder="Total Loan Amount"
                                        value="{{ $loansdata['totalloanamount'] }}" disabled="">
                                    <input type="hidden" name="total_loan_amount" id="total_loan_amount"
                                        class="form-control" placeholder="Total Loan Amount"
                                        value="{{ $loansdata['totalloanamount'] }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Amount To Be Disbursed"
                                    class="col-md-3 m-t-10 control-label text-right">Amount To Be Disbursed</label>
                                <div class="col-md-3 m-t-10">
                                    <input type="text" name="_amount_to_be_disbursed" id="_amount_to_be_disbursed"
                                        class="form-control bg-white" placeholder="Amount To Be Disbursed"
                                        value="{{ $loansdata['amounttobedisbursed'] }}" disabled="">
                                    <input type="hidden" name="amount_to_be_disbursed" id="amount_to_be_disbursed"
                                        class="form-control" placeholder="{{ $loansdata['amounttobedisbursed'] }}"
                                        value="">
                                </div>
                            </div>
                            @if (isset($loansdata['rescheduled_loan_number']))
                            <div class="form-group">
                                <label for="Mode Of Disbursement" class="col-md-3 m-t-10 control-label text-right">Mode Of
                                    Disbursement</label>
                                <div class="col-md-3 m-t-10">
                                    <select class="form-control selectpicker" data-size="100000" data-live-search="true"
                                        data-style="btn-white" name="disbursement_mode" id="disbursement_mode" disabled>
                                        <option value="">Select Mode Of Disbursement</option>
                                        @foreach ($loansdata['disbursementmodes'] as $disbursementmodes)
                                            <option value="{!! $disbursementmodes->disbursement_mode !!}">
                                                {!! strtoupper($disbursementmodes->disbursementmodemodel->name) !!}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            @else
                            <div class="form-group">
                                <label for="Mode Of Disbursement" class="col-md-3 m-t-10 control-label text-right">Mode Of
                                    Disbursement</label>
                                <div class="col-md-3 m-t-10">
                                    <select class="form-control selectpicker" data-size="100000" data-live-search="true"
                                        data-style="btn-white" name="disbursement_mode" id="disbursement_mode">
                                        <option value="">Select Mode Of Disbursement</option>
                                        @foreach ($loansdata['disbursementmodes'] as $disbursementmodes)
                                            <option value="{!! $disbursementmodes->disbursement_mode !!}">
                                                {!! strtoupper($disbursementmodes->disbursementmodemodel->name) !!}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            @endif
                            <div class="form-group">
                                <label for="Fine Type" class="col-md-3 m-t-10 control-label text-right">Fine Type</label>
                                <div class="col-md-3 m-t-10">
                                    <p class="form-control-static text-inverse">
                                        {{ $loansdata['loanproduct']->finetypemodel->name }}</p>
                                    <input type="hidden" name="fine_type" id="fine_type" class="form-control"
                                        placeholder="Fine Type" value="{{ $loansdata['loanproduct']->fine_type }}">

                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Fine Charge" class="col-md-3 m-t-10 control-label text-right">Fine
                                    Charge</label>
                                <div class="col-md-3 m-t-10">
                                    <p class="form-control-static text-inverse">
                                        {{ $loansdata['loanproduct']->fine_charge }}</p>
                                    <input type="hidden" name="fine_charge" id="fine_charge" class="form-control"
                                        placeholder="Fine Charge" value="{{ $loansdata['loanproduct']->fine_charge }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Fine Charge Frequency" class="col-md-3 m-t-10 control-label text-right">Fine
                                    Charge Frequency</label>
                                <div class="col-md-3 m-t-10">
                                    <p class="form-control-static text-inverse">
                                        {{ $loansdata['loanproduct']->finechargefrequencymodel->name }}</p>
                                    <input type="hidden" name="fine_charge_frequency" id="fine_charge_frequency"
                                        class="form-control" placeholder="Fine Charge Frequency"
                                        value="{{ $loansdata['loanproduct']->fine_charge_frequency }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Fine Charge Period" class="col-md-3 m-t-10 control-label text-right">Fine
                                    Charge Period</label>
                                <div class="col-md-3 m-t-10">
                                    <p class="form-control-static text-inverse">
                                        {{ $loansdata['loanproduct']->finechargeperiodmodel->name }}</p>
                                    <input type="hidden" name="fine_charge_period" id="fine_charge_period"
                                        class="form-control" placeholder="Fine Charge Period"
                                        value="{{ $loansdata['loanproduct']->fine_charge_period }}">
                                </div>
                            </div>
                            @if (isset($loansdata['loanproduct']->depends_on_lgf))
                                <div class="form-group">
                                    <label for="Depends On LGF" class="col-md-3 m-t-10 control-label text-right">Depends
                                        On LGF</label>
                                    <div class="col-md-3 m-t-10">
                                        <p class="form-control-static text-inverse">
                                            @if ($loansdata['loanproduct']->depends_on_lgf == 1)
                                                YES
                                            @elseif($loansdata['loanproduct']->depends_on_lgf == 0)
                                                NO
                                            @endif
                                        </p>
                                        <input type="hidden" name="depends_on_lgf" id="depends_on_lgf"
                                            class="form-control" placeholder="Depends On LGF"
                                            value="{{ $loansdata['loanproduct']->depends_on_lgf }}">
                                    </div>
                                </div>
                            @endif
                            @if (isset($loansdata['loanproduct']->lgf_type))
                                <div class="form-group">
                                    <label for="LGF Type" class="col-md-3 m-t-10 control-label text-right">LGF
                                        Type</label>
                                    <div class="col-md-3 m-t-10">
                                        <p class="form-control-static text-inverse">
                                            {{ $loansdata['loanproduct']->lgftypemodel->name }}</p>
                                        <input type="hidden" name="lgf_type" id="lgf_type" class="form-control"
                                            placeholder="LGF Type" value="{{ $loansdata['loanproduct']->lgf_type }}">
                                    </div>
                                </div>
                            @endif
                            @if (isset($loansdata['minimumlgf']))
                                <div class="form-group">
                                    <label for="Minimum" class="col-md-3 m-t-10 control-label text-right">Minimum
                                        LGF</label>
                                    <div class="col-md-3 m-t-10">
                                        <p class="form-control-static text-inverse">{{ $loansdata['minimumlgf'] }}</p>
                                        <input type="hidden" name="lgf" id="lgf" class="form-control"
                                            placeholder="LGF" value="{{ $loansdata['loanproduct']->lgf }}">
                                    </div>
                                </div>
                            @endif

                            <!--                                     <div class="form-group">
                                                        <label for="Initial Deposit" class="col-md-3 m-t-10 control-label text-right">Depends On LGF</label>
                                                        <div class="col-md-3 m-t-10">
                                                            <input type="checkbox" name="depends_on_lgf"  id="depends_on_lgf" value="1" onclick="dependsOnLGF()" />

                                                        </div>
                                                    </div> -->
                            <!--
                                                    <div class="form-group" id="lgf_percentage_container" style="display: none;">
                                                        <label for="LGF Percentage" class="col-md-3 m-t-10 control-label text-right">Percentage</label>
                                                        <div class="col-md-3 m-t-10">
                                                            <input type="text" name="lgf_percentage"  id="lgf_percentage" value="1" placeholder="Percentage" class="form-control" />
                                                        </div>
                                                    </div> -->
                            <!--                                     <div class="form-group" id="lgf_amount_container" style="display: none;">
                                                        <label for="LGF Amount" class="col-md-3 m-t-10 control-label text-right">Percentage</label>
                                                        <div class="col-md-3 m-t-10">
                                                            <input type="text" name="lgf_amount"  id="lgf_amount" value="1" placeholder="LGF Amount" class="form-control" />
                                                        </div>
                                                    </div>
                 -->
                            <!--                                     <div class="form-group" style="display: none;" id="initial_deposit_container">
                                                        <label for="Initial Deposit" class="col-md-3 m-t-10 control-label text-right">Initial Deposit</label>
                                                        <div class="col-md-3 m-t-10">
                                                            <input type="text" name="initial_deposit"  id="initial_deposit" class="form-control" placeholder="Initial Deposit" value="">
                                                        </div>
                                                    </div>
                 -->


                            @foreach ($loansdata['loanstatuses'] as $loanstatuses)
                                @if ($loanstatuses->code == '001')
                                    <input type="hidden" name="status" value="{{ $loanstatuses->id }}" />
                                @endif
                            @endforeach

                            <!--                                 <div class="form-group">
                                                        <div class="col-sm-offset-3 col-md-3 m-t-10">
                                                            <button type="button" onclick="save()" class="btn btn-sm btn-primary">
                                                                <i class="fa fa-btn fa-plus"></i> Add Loans
                                                            </button>
                                                        </div>
                                                    </div> -->

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
                            <table id="loan-product-assets-table" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Asset</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Total Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($loansdata['productassets'] as $productassets)
                                        <tr>
                                            <td><input type="hidden" name="loan_asset[]"
                                                    value="{!! $productassets->asset !!}" />{!! $productassets->assetmodel->name !!}</td>
                                            <td><input type="hidden" value="{!! $productassets->assetmodel->selling_price !!}"
                                                    class="price" />{!! $productassets->assetmodel->selling_price !!}</td>
                                            <td><input type="text"
                                                    name="loan_asset_quantity[]"value="{!! $productassets->quantity !!}"
                                                    class="form-control quantity" onchange="updateLoanAmount(this)"></td>
                                            <td class="total">{!! $productassets->assetmodel->selling_price * $productassets->quantity !!}</td>
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
                                        name="clearing_fee_type"
                                        value="{{ $loansdata['loanproduct']->clearing_fee_type }}" />
                                    <input type="hidden" class="form-control" id="clearing_fee_code"
                                        name="clearing_fee_code"
                                        value="{{ $loansdata['loanproduct']->clearingfeetypemodel->code }}" />
                                </div>
                                <label for="Fee Payment Type" class="col-md-3 m-t-10 control-label text-right">Clearing
                                    Fee Payment Type</label>
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
                            @if ($loansdata['loanproduct']->clearingfeepaymenttypemodel->code == '001')
                                <div class="form-group ">
                                    <label for="Processing Fee"
                                        class="col-md-3 m-t-10 control-label text-right">Transaction Reference</label>
                                    <div class="col-md-3 m-t-10">
                                        <input type="text" name="clearing_fee_transaction_reference"
                                            class="form-control" value="" />
                                    </div>
                                    <!--                            <div class="col-md-3 m-t-10">
                                                @if ($loansdata['loanproduct']->insurancedeductionfeepaymenttypemodel->code == '001')
    <a href="#insurance-deduction-fee-modal-dialog" class="btn btn-danger" data-toggle="modal">Pay Now</a>
    @endif
                                            </div> -->
                                </div>
                            @endif
                            <div id="clearing-fee-payment" class="hidden">
                                <div class="form-group">
                                    <label for="Payment Mode" class="col-md-3 m-t-10 control-label">Payment Mode</label>
                                    <div class="col-sm-6">
                                        <select class="form-control selectpicker" data-size="100000"
                                            data-live-search="true" data-style="btn-white"
                                            name="_payment_mode_clearing_fee" id="_payment_mode_clearing_fee">
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
                                        <p class="form-control-static text-inverse">
                                            {{ $loansdata['clearingfee'] }}
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
                                <label for="Fee Payment Type" class="col-md-3 m-t-10 control-label text-right">Processing
                                    Fee Payment Type</label>
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
                            @if ($loansdata['loanproduct']->processingfeepaymenttypemodel->code == '001')
                                <div class="form-group ">
                                    <label for="Processing Fee"
                                        class="col-md-3 m-t-10 control-label text-right">Transaction Reference</label>
                                    <div class="col-md-3 m-t-10">
                                        <input type="text" name="processing_fee_transaction_reference"
                                            class="form-control" value="" />
                                    </div>
                                    <!--                            <div class="col-md-3 m-t-10">
                                                @if ($loansdata['loanproduct']->insurancedeductionfeepaymenttypemodel->code == '001')
    <a href="#insurance-deduction-fee-modal-dialog" class="btn btn-danger" data-toggle="modal">Pay Now</a>
    @endif
                                            </div> -->
                                </div>
                            @endif
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


                            @if ($loansdata['loanproduct']->insurancedeductionfeepaymenttypemodel->code == '001')
                                <div class="form-group ">
                                    <label for="Processing Fee"
                                        class="col-md-3 m-t-10 control-label text-right">Transaction Reference</label>
                                    <div class="col-md-3 m-t-10">
                                        <input type="text" name="insurance_deduction_transaction_reference"
                                            class="form-control" value="" />
                                    </div>
                                    <!--                            <div class="col-md-3 m-t-10">
                                                @if ($loansdata['loanproduct']->insurancedeductionfeepaymenttypemodel->code == '001')
    <a href="#insurance-deduction-fee-modal-dialog" class="btn btn-danger" data-toggle="modal">Pay Now</a>
    @endif
                                            </div> -->
                                </div>
                            @endif
                            <div class="form-group">
                                <label for="Fee Type" class="col-md-3 m-t-10 control-label text-right">Insurance Deduction
                                    Type</label>
                                <div class="col-md-3 m-t-10">
                                    <p class="form-control-static text-inverse">
                                        @if ($loansdata['loanproduct']->insurance_deduction_fee_type != null)
                                            {{ $loansdata['loanproduct']->insurancedeductionfeetypemodel->name }}
                                            @if ($loansdata['loanproduct']->insurancedeductionfeetypemodel->code == '001')
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
                                    <input type="hidden" class="form-control"
                                        id="insurance_deduction_fee_payment_type_code"
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
                            <h4 class="panel-title" id="guarantors-title">Guarantors</h4>
                        </div>
                        <div class="panel-body">
                            <div class="form-group">
                                <label for="Id Number" class="col-md-3 m-t-10 control-label text-right">Id Number</label>
                                <div class="col-md-3 m-t-10">
                                    <input type="text" name="id_number" id="id_number" class="form-control"
                                        placeholder="Id Number" value="" onkeyup="getGuarantorByIDNO()">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="First Name" class="col-md-3 m-t-10 control-label text-right">First
                                    Name</label>
                                <div class="col-md-3 m-t-10">
                                    <input type="text" name="first_name" id="first_name" class="form-control"
                                        placeholder="First Name" value="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Middle Name" class="col-md-3 m-t-10 control-label text-right">Middle
                                    Name</label>
                                <div class="col-md-3 m-t-10">
                                    <input type="text" name="middle_name" id="middle_name" class="form-control"
                                        placeholder="Middle Name" value="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Last Name" class="col-md-3 m-t-10 control-label text-right">Last Name</label>
                                <div class="col-md-3 m-t-10">
                                    <input type="text" name="last_name" id="last_name" class="form-control"
                                        placeholder="Last Name" value="">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="County" class="col-md-3 m-t-10 control-label text-right">County</label>
                                <div class="col-md-3 m-t-10">
                                    <select class="form-control name="county" id="county" onchange="subCounties()">
                                        <option value="">Select County</option>
                                        @foreach ($loansdata['counties'] as $counties)
                                            <option value="{!! $counties->id !!}">

                                                {!! $counties->name !!}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Sub County" class="col-md-3 m-t-10 control-label text-right">Sub
                                    County</label>
                                <div class="col-md-3 m-t-10">
                                    <select class="form-control" name="sub_county" id="sub_county">
                                        <option value="">Select Sub County</option>
                                        @foreach ($loansdata['subcounties'] as $subcounties)
                                            <option value="{!! $subcounties->id !!}">

                                                {!! $subcounties->name !!}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Guarantor Relationship"
                                    class="col-md-3 m-t-10 control-label text-right">Guarantor Relationship</label>
                                <div class="col-md-3 m-t-10">
                                    <select class="form-control" name="guarantor_relationship"
                                        id="guarantor_relationship">
                                        <option value="">Select Guarantor Relationship</option>
                                        @foreach ($loansdata['guarantorrelationships'] as $guarantorrelationship)
                                            <option value="{!! $guarantorrelationship->id !!}">

                                                {!! $guarantorrelationship->name !!}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Primary Phone Number" class="col-md-3 m-t-10 control-label text-right">Primary
                                    Phone Number</label>
                                <div class="col-md-3 m-t-10">
                                    <input type="text" name="primary_phone_number" id="primary_phone_number"
                                        placeholder="(999) 999-9999" class="form-control" value="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Secondary Phone Number"
                                    class="col-md-3 m-t-10 control-label text-right">Secondary Phone Number</label>
                                <div class="col-md-3 m-t-10">
                                    <input type="text" name="secondary_phone_number" id="secondary_phone_number"
                                        placeholder="(999) 999-9999" class="form-control" value="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Secondary Phone Number"
                                    class="col-sm-3 m-t-10 control-label">Occupation</label>
                                <div class="col-sm-3 m-t-10">
                                    <input type="text" name="occupation" id="occupation" class="form-control"
                                        placeholder="Occupation" value="">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-md-3 m-t-10">
                                    <button type="button" onclick="addGuarantor(this)" class="btn btn-sm btn-primary">
                                        <i class="fa fa-btn fa-plus"></i> Add Guarantor
                                    </button>
                                </div>
                            </div>

                        </div>
                        <div class="panel-body">
                            <table id="gourantors-table" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>First Name</th>
                                        <th>Middle Name</th>
                                        <th>Last Name</th>
                                        <th>Id Number</th>
                                        <th>County</th>
                                        <th>Sub County</th>
                                        <th>Guarantor Relationship</th>
                                        <th>Primary Phone Number</th>
                                        <th>Secondary Phone Number</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
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
                            <h4 class="panel-title">Loan Documents</h4>
                        </div>
                        <div class="panel-body">

                            <table class="table table-striped table-bordered">
                                <thead>
                                    <th>
                                        Documents
                                    </th>
                                    <th>Action</th>
                                </thead>
                                <tbody id="loan-documents">
                                    <tr>
                                        <td>
                                            <input type="file" name="loan_document[]" id="loan_document"
                                                class="form-control" placeholder="Document" value=""
                                                onchange="addDocument()" />
                                        </td>
                                        <td><button type='button' class='btn btn-sm btn-circle btn-danger hidden'
                                                onclick='removeGuarantor(this)'><i
                                                    class='fa fa-btn fa-trash'></i></button></td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>
                        <!--                     <div class="panel-body">
                                        <table id="documents-table" class="table table-striped table-bordered">
                                            <thead>
                                                        <tr>
                                                            <th>Document</th>
                                                            <th>Action</th>                                    </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                 -->
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

                            <div class="form-group">
                                <label for="Collateral Category"
                                    class="col-md-3 m-t-10 control-label text-right">Collateral Category</label>
                                <div class="col-md-3 m-t-10">
                                    <select class="form-control" name="_collateral_category" id="_collateral_category">
                                        <option value="">Select Collateral Category</option>
                                        @foreach ($loansdata['collateralcategories'] as $collateralcategories)
                                            <option value="{!! $collateralcategories->id !!}">

                                                {!! $collateralcategories->name !!}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Model" class="col-md-3 m-t-10 control-label text-right">Model</label>
                                <div class="col-md-3 m-t-10">
                                    <input type="text" name="_model" id="_model" class="form-control"
                                        placeholder="Model" value="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Color" class="col-md-3 m-t-10 control-label text-right">Color</label>
                                <div class="col-md-3 m-t-10">
                                    <input type="text" name="_color" id="_color" class="form-control"
                                        placeholder="Color" value="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Size" class="col-md-3 m-t-10 control-label text-right">Size</label>
                                <div class="col-md-3 m-t-10">
                                    <input type="number" min="0" name="_size" id="_size"
                                        class="form-control" placeholder="Size" value="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Year Bought" class="col-md-3 m-t-10 control-label text-right">Year
                                    Bought</label>
                                <div class="col-md-3 m-t-10">
                                    <input type="text" name="_year_bought" id="_year_bought" class="form-control"
                                        placeholder="Year Bought" value="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Buying Price" class="col-md-3 m-t-10 control-label text-right">Buying
                                    Price</label>
                                <div class="col-md-3 m-t-10">
                                    <input type="number" min="0" name="_buying_price" id="_buying_price"
                                        class="form-control" placeholder="Buying Price" value="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Current Selling Price"
                                    class="col-md-3 m-t-10 control-label text-right">Current Selling Price</label>
                                <div class="col-md-3 m-t-10">
                                    <input type="number" min="0" name="_current_selling_price"
                                        id="_current_selling_price" class="form-control"
                                        placeholder="Current Selling Price" value="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Serial Number" class="col-md-3 m-t-10 control-label text-right">Serial
                                    Number</label>
                                <div class="col-md-3 m-t-10">
                                    <input type="text" name="_serial_number" id="_serial_number"
                                        class="form-control" placeholder="Serial Number" value="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Serial Number" class="col-md-3 m-t-10 control-label text-right">Min
                                    Collateral Value</label>
                                <div class="col-md-3 m-t-10">
                                    <input type="number" name="_collateral_value" min="0"
                                        id="_collateral_value" class="form-control" placeholder="Min Collateral Value"
                                        value="" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Serial Number"
                                    class="col-md-3 m-t-10 control-label text-right">Picture</label>
                                <div class="col-md-3 m-t-10" id="picture-container">
                                    <input type="file" name="picture[]" id="picture" class="form-control"
                                        placeholder="Picture" value="" />
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="col-sm-offset-3 col-md-3 m-t-10">
                                    <button type="button" onclick="addCollateral()" class="btn btn-sm btn-primary">
                                        <i class="fa fa-btn fa-plus"></i> Add Loan Collateral
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="panel-body">
                            <table id="collaterals-table" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Collateral Category</th>
                                        <th>Model</th>
                                        <th>Color</th>
                                        <th>Size</th>
                                        <th>Year Bought</th>
                                        <th>Buying Price</th>
                                        <th>Current Selling Price</th>
                                        <th>Serial Number</th>
                                        <th>Minimum Collateral Value</th>
                                        <!-- <th>Picture</th> -->
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
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
                            <h4 class="panel-title">Loan Schedule</h4>
                        </div>
                        <div class="panel-body">

                            <table id="collaterals-table" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Payment Date</th>
                                        <th>Amount</th>
                                        <th>Total Expected Payment</th>
                                        <th>Payment</th>
                                        <th>Exptected Balance</th>

                                    </tr>
                                </thead>
                                <tbody id="loan-schedule-data">
                                    @foreach ($loansdata['loanschedule'] as $loanschedule)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ $loanschedule['date'] }}</td>
                                            <td>{{ $loanschedule['amount'] }}</td>
                                            <td>{{ $loanschedule['expectedpayment'] }}</td>
                                            <td>{{ $loanschedule['payment'] }}</td>
                                            <td>{{ $loanschedule['expectedbalance'] }}</td>


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
                            <h4 class="panel-title">Finish</h4>
                        </div>
                        <div class="panel-body">
                            <div class="alert alert-info m-b-0 text-center">
                                <h4 class="block">Final Section</h4>
                                <p>
                                    Please reveiew your data then proceed to submit. Thank you.
                                </p>
                            </div>

                        </div>
                        <div class="panel-body">
                            <div class="col-md-5 col-sm-5 col-lg-5">
                            </div>

                            <div class="col-md-2 col-sm-2 col-lg-2">
                                <button type="button" class="btn btn-primary btn-lg align-center" onclick="save()"
                                    id="btn-save"><i class="fa fa-save"></i>
                                    @if (isset($loansdata['rescheduled_loan_number']))
                                        Reschedule
                                    @else
                                        Submit
                                    @endif
                                </button>
                            </div>
                            <div class="col-md-5 col-sm-5 col-lg-5">
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="modal fade" id="clearing-fee-modal-dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Clearing Fee Payment</h4>
                </div>
                <div class="modal-body">
                    <form id="clearing_fee_form" class="form-horizontal" enctype="multipart/form-data">
                        {!! csrf_field() !!}

                        <div class="form-group">
                            <label for="Payment Mode" class="col-sm-3 control-label">Payment Mode</label>
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
                            <label for="Transaction Number" class="col-sm-3 control-label">Transaction Number</label>
                            <div class="col-sm-6">
                                <input type="text" name="_transaction_number_clearing_fee"
                                    id="_transaction_number_clearing_fee" class="form-control"
                                    placeholder="Transaction Number" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="Amount" class="col-sm-3 control-label">Amount</label>
                            <div class="col-sm-6">
                                <p class="form-control-static text-inverse">{{ $loansdata['clearingfee'] }}


                                </p>
                                <input type="hidden" name="_amount_clearing_fee" id="_amount_clearing_fee"
                                    class="form-control" placeholder="Clearing Fee"
                                    value="{{ $loansdata['clearingfee'] }}" />
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <a href="javascript:;" class="btn btn-sm btn-white" data-dismiss="modal">Close</a>
                    <a href="javascript:;" class="btn btn-sm btn-success">Done</a>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="insurance-deduction-fee-modal-dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Insurance Deduction Fee Payment</h4>
                </div>
                <div class="modal-body">
                    <form id="form" class="form-horizontal" enctype="multipart/form-data">
                        {!! csrf_field() !!}

                        <div class="form-group">
                            <label for="Payment Mode" class="col-sm-3 control-label">Payment Mode</label>
                            <div class="col-sm-6">
                                <select class="form-control selectpicker" data-size="100000" data-live-search="true"
                                    data-style="btn-white" name="payment_mode" id="payment_mode">
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
                            <label for="Transaction Number" class="col-sm-3 control-label">Transaction Number</label>
                            <div class="col-sm-6">
                                <input type="text" name="transaction_number" id="transaction_number"
                                    class="form-control" placeholder="Transaction Number" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="Amount" class="col-sm-3 control-label">Amount</label>
                            <div class="col-sm-6">
                                <p class="form-control-static text-inverse">


                                </p>
                                <input type="hidden" name="_clearing_fee" id="_clearing_fee" class="form-control"
                                    placeholder="Clearing Fee" value="{{ $loansdata['clearingfee'] }}" />
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <a href="javascript:;" class="btn btn-sm btn-white" data-dismiss="modal">Close</a>
                    <a href="javascript:;" class="btn btn-sm btn-success">Done</a>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script language="javascript" type="text/javascript">
        function amount() {
            var amount = Number($("#amount").val());
            var minAmount = Number($("#minimum_loan_amount").val());
            var maxAmount = Number($("#maximum_loan_amount").val());
            if (amount < minAmount || amount > maxAmount) {
                alert("Loan amount must be greater than " + minAmount + " and  less than " + maxAmount);
                $("#amount").val(maxAmount);
                return;
            }

        }

        function applicationDate() {
            if ($("#loan_product").val() == "") {
                alert("You must select a loan product!");
                return;
            }
            if ($("#date").val() == "") {
                alert("Date cannot be empty!");
                return;
            }
            //disabled future applications
            var date = new Date($("#date").val());
            date.setHours(0, 0, 0, 0);
            var now = new Date();
            now.setHours(0, 0, 0, 0);
            if (date > now) {
                alert("Future applications are not allowed!");
                return;
            }
        }

        function save() {
            $("btn-save").attr("disabled", true);
            applicationDate();
            //check loan amount
            amount();
            maxNumberOfGuarantors = Number($("#number_of_guarantors").val());
            if (maxNumberOfGuarantors > Number(guarantorsCount)) {
                alert("You must provide atleast " + maxNumberOfGuarantors + " Guarantors!");
                return;
            }

            var formData = new FormData($('#form')[0]);
            $.ajax({
                type: 'POST',
                url: "{!! route('loans.store') !!}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function(data) {
                    $("btn-save").attr("disabled", false);

                    var obj = jQuery.parseJSON(data);
                    if (obj.status == '1') {

                        $.gritter.add({
                            title: 'Success',
                            text: obj.message,
                            sticky: false,
                            time: '1000',
                        });
                        $("#form")[0].reset();
                        location.reload();
                    } else {
                        $.gritter.add({
                            title: 'Fail',
                            text: obj.message,
                            sticky: false,
                            time: '5000',
                        });
                    }
                },
                error: function(data) {
                    $.gritter.add({
                        title: 'Error',
                        text: 'An Error occured. Please review your data then submit again!!',
                        sticky: false,
                        time: '5000',
                    });
                }
            });
            return false;
        }
        var minAmount = 0;
        var maxAmount = 0;

        function getDisbursementModes() {
            var productId = $("#loan_product").val();
            $.ajax({
                type: 'GET',
                url: "{!! url('/admin/getproductdisbursementmode/') !!}/" + productId,
                data: JSON.stringify({
                    '_token': "{{ csrf_token() }}"
                }),
                contentType: 'application/json',
                processData: false,
                success: function(data) {
                    var disbursementModes = data;
                    $("#disbursement_mode").val(disbursementModes[0].disbursement_mode);

                }
            });
        }

        // function getAndUpdateDisbursementModes(){
        //     var productId=$("#loan_product").val();
        //     $.ajax({
        //         type:'GET',
        //         url: "{!! url('/admin/getproductdisbursementmode/') !!}/"+productId,
        //         data:JSON.stringify({'_token':"{{ csrf_token() }}"}),
        //         contentType: 'application/json',
        //         processData: false,
        //         success:function(data){
        //             console.log(data);  

        //             var disbursementModes=data;
        //             console.log(disbursementModes);
        //             $("#disbursement_mode option").attr("disabled",true);
        //             $("#disbursement_mode option").each(function(){
        //                 var optionVal=$(this).val();
        //                 var option=$(this);
        //                 for(var r=0;r<disbursementModes.length;r++){
        //                     console.log("disbursement_mode : "+disbursementModes[r].disbursement_mode);
        //                     console.log("option value : "+optionVal);
        //                     if(Number(disbursementModes[r].disbursement_mode)==Number(optionVal)){
        //                         console.log("disbursement_mode : "+disbursementModes[r].disbursement_mode+" enabled");
        //                         option.attr("disabled",false);
        //                     }
        //                 }
        //             });


        //         }
        //     });      
        // }

        var guarantorsCount = 0;

        function addGuarantor() {
            var firstName = $("#first_name").val();
            var lastName = $("#last_name").val();
            var middleName = $("#middle_name").val();
            var idNumber = $("#id_number").val();
            var county = $("#county").val();
            var countyName = $("#county option:selected").text();
            var subCounty = $("#sub_county").val();

            var guarantorRelationship = $("#guarantor_relationship").val();
            var guarantorRelationshipName = $("#guarantor_relationship option:selected").text();
            var subCountyName = $("#sub_county option:selected").text();
            var primaryPhoneNumber = $("#primary_phone_number").val();
            var secondaryPhoneNumber = $("#secondary_phone_number").val();
            if (firstName != "" && lastName != "" && idNumber != "" && county != "" && subCounty != "" &&

                primaryPhoneNumber != "" && secondaryPhoneNumber != "") {
                var row = "<tr><td><input type='hidden' value='" + firstName + "' name='guarantor_first_name_arr[]'/>" +
                    firstName + "</td><td><input type='hidden' value='" + middleName +
                    "' name='guarantor_middle_name_arr[]'/>" + middleName + "</td><td><input type='hidden' value='" +
                    lastName + "' name='guarantor_last_name_arr[]'/>" + lastName + "</td><td><input type='hidden' value='" +
                    idNumber + "' name='guarantor_id_number_arr[]'/>" + idNumber + "</td><td><input type='hidden' value='" +
                    county + "' name='guarantor_county_arr[]'/>" + countyName + "</td><td><input type='hidden' value='" +
                    subCounty + "' name='guarantor_sub_county_arr[]'/>" + subCountyName +
                    "</td><td><input type='hidden' name='guarantor_relationship_arr[]' value='" + guarantorRelationship +
                    "'>" + guarantorRelationshipName + "</td><td><input type='hidden' value='" + primaryPhoneNumber +
                    "' name='guarantor_primary_phone_number_arr[]'/>" + primaryPhoneNumber +
                    "</td><td><input type='hidden' value='" + secondaryPhoneNumber +
                    "' name='guarantor_secondary_phone_number_arr[]'/>" + secondaryPhoneNumber +
                    "</td><td><button type='button' class='btn btn-sm btn-circle btn-danger' onclick='removeGuarantor(this)'><i class='fa fa-btn fa-trash'></i></button></td></tr>";
                $("#gourantors-table tbody").append(row);
                $("#first_name").val("");
                $("#last_name").val("");
                $("#middle_name").val("");
                $("#id_number").val("");
                $("#county").val("");
                $("#sub_county").val("");
                $("#guarantor_relationship").val("");
                $("#primary_phone_number").val("");
                $("#secondary_phone_number").val("");
                guarantorsCount++;
            } else {
                alert("Some or all the Field are missing. Please fill all fields!");
            }
        }
        var maxNumberOfGuarantors = 0;

        function removeGuarantor(e) {
            $(e).closest("tr").remove();
            guarantorsCount--;
        }

        function addDocument() {
            var loanDocument = $("#loan_document").val();
            var allowedFileTypes = [".doc", ".docx", ".pdf", ".jpg", ".jpeg", ".png", ".JPG", ".JPEG", ".PNG"];
            var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(" + allowedFileTypes.join('|') + ")$");
            if (regex.test(loanDocument.toLowerCase())) {
                $("button.hidden").removeClass("hidden");
                $("#loan-documents").prepend(
                    "<tr><td><input type='file'  name='loan_document[]' id='loan_document' class='form-control' placeholder='Document' value='' onchange='addDocument()'></td><td><button type='button' class='btn btn-sm btn-circle btn-danger hidden' onclick='removeDocument(this)'><i class='fa fa-btn fa-trash'></i></button></td></tr>"
                );


            } else {
                alert("no document found or document name has braces!");
            }
        }

        function editDocument() {
            var loanDocument = $("#loan_document").val();
            var allowedFileTypes = [".doc", ".docx", ".pdf", ".jpg", ".jpeg", ".png", ".JPG", ".JPEG", ".PNG"];
            var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(" + allowedFileTypes.join('|') + ")$");
            if (!regex.test(loanDocument.toLowerCase())) {
                alert("no document found or document name has braces!");
            }
        }

        function removeDocument(e) {
            $(e).closest("tr").remove();
        }

        function addCollateral() {
            var collateralCategory = $("#_collateral_category").val();
            var collateralCategoryName = $("#_collateral_category option:selected").text();
            var model = $("#_model").val();
            var color = $("#_color").val();
            var size = $("#_size").val();
            var yearBought = $("#_year_bought").val();
            var buyingPrice = $("#_buying_price").val();
            var currentSellingPrice = $("#_current_selling_price").val();
            var serialNumber = $("#_serial_number").val();
            var minCollateralValue = $("#_collateral_value").val();
            // var picture=$("#picture").clone();

            var row = $("<tr><td><input type='hidden' name='collateral_category[]' value='" + collateralCategory + "'/>" +
                collateralCategoryName + "</td><td><input type='hidden' name='model[]' value='" + model + "'>" + model +
                "</td><td><input type='hidden' name='color[]' value='" + color + "'>" + color +
                "</td><td><input type='hidden' name='size[]' value='" + size + "'>" + size +
                "</td><td><input type='hidden' name='year_bought[]' value='" + yearBought + "'>" + yearBought +
                "</td><td><input type='hidden' name='buying_price' value='" + buyingPrice + "'>" + buyingPrice +
                "</td><td><input type='hidden' name='current_selling_price[]' value='" + currentSellingPrice + "'>" +
                currentSellingPrice + "</td><td><input type='hidden' name='serial_number[]' value='" + serialNumber +
                "'>" + serialNumber + "</td><td><input type='hidden' name='collateral_value[]' value='" +
                minCollateralValue + "'>" + minCollateralValue +
                "</td><td><button type='button' class='btn btn-sm btn-circle btn-danger' onclick='removeCollateral(this)'><i class='fa fa-btn fa-trash'></i></button></td></tr>"
            );

            $("#collaterals-table").append(row);
            $("#picture-container #picuter").appendTo(row.find("td[name=index]:not(:empty):last"));
            var picture = $(
                "<input type=\"file\" name=\"picture\"  id=\"picture\" class=\"form-control\" placeholder=\"Picture\" value=\"\"/>"
            );
            $("#picture-container").append(picture);
        }

        function removeCollateral(e) {
            $(e).closest('tr').remove();
        }

        function getInterestCharged() {
            applicationDate();
            amount();
            checkIfDependsOnLGF();
            getClearingFee();
            getInsuranceDeductionFee();
            checkIfDependsOnLGF();
            getProcessingFee();
            var loanAmount = $("#amount").val();
            var interestRate = $("#interest_rate").val();
            var interestRateType = $("#interest_rate_type").val();
            var interestRatePeriod = $("#interest_rate_period").val();
            var laonPaymentDuration = $("#loan_payment_duration").val();
            var token = "{{ csrf_token() }}";

            // console.log(data);
            $.ajax({
                type: 'POST',
                url: "{!! url('/admin/getinterestcharged/') !!}",
                data: JSON.stringify({
                    '_token': token,
                    'loan_amount': loanAmount,
                    "interest_rate": interestRate,
                    "interest_rate_type": interestRateType,
                    "interest_rate_period": interestRatePeriod,
                    "loan_payment_duration": laonPaymentDuration
                }),
                contentType: "application/json",
                processData: false,
                success: function(data) {
                    $("#interest_charged").val(data);
                    $("#_interest_charged").val(data);
                    getTotalLoanAmount();
                    getAmountToBeDisbursed();
                }
            });
        }

        function getloanschedule() {

            var applicationDate = $("#date").val();
            var gracePeriod = $("#grace_period_type_code").val() == "001" ? $("#grace_period").val() : $(
                "#max_grace_period").val();
            var paymentFrequency = $("#loan_payment_frequency").val();
            var paymentDuration = $("#loan_payment_duration").val();
            var totalLoanAmount = $("#total_loan_amount").val();
            $.ajax({
                type: 'POST',
                url: "{!! url('/admin/getloanschedule/') !!}",
                data: JSON.stringify({
                    '_token': "{{ csrf_token() }}",
                    'applicationDate': applicationDate,
                    'gracePeriod': gracePeriod,
                    'paymentFrequency': paymentFrequency,
                    'paymentDuration': paymentDuration,
                    'totalLoanAmount': totalLoanAmount
                }),
                contentType: "application/json",
                processData: false,
                success: function(data) {
                    $("#loan-schedule-data tr").remove();
                    for (var r = 0; r < data.length; r++) {
                        var row = $("<tr><td>" + (r + 1) + "</td><td>" + data[r].date + "</td><td>" + data[r]
                            .amount + "</td><td>" + data[r].expectedpayment + "</td><td>" + data[r]
                            .payment + "</td><td>" + data[r].expectedbalance + "</td></tr>");
                        $("#loan-schedule-data").append(row);
                    }
                }
            });
        }

        function gracePeriodType() {
            var gracePeriodType = $("#grace_period_type").val();
            $.ajax({
                type: 'get',
                url: "{!! url('/admin/getgraceperiodtype/') !!}/" + gracePeriodType,
                data: JSON.stringify({
                    '_token': "{{ csrf_token() }}"
                }),
                contentType: 'application/json',
                processData: false,
                success: function(response) {
                    $("#min_grace_period_container").css("display", "none");
                    $("#max_grace_period_container").css("display", "none");
                    $("#grace_period_container").css("display", "none");

                    var data = jQuery.parseJSON(response);
                    if (data.code == "001") {
                        $("#min_grace_period_container").css("display", "none");
                        $("#max_grace_period_container").css("display", "none");
                        $("#grace_period_container").css("display", "block");
                    } else if (data.code = "002") {
                        $("#min_grace_period_container").css("display", "block");
                        $("#max_grace_period_container").css("display", "block");
                        $("#grace_period_container").css("display", "none");
                    } else {
                        $("#min_grace_period_container").css("display", "none");
                        $("#max_grace_period_container").css("display", "none");
                        $("#grace_period_container").css("display", "none");

                    }
                }
            });
        }



        function getGuarantorByIDNO() {
            var idNumber = $("#id_number").val();
            var client = $("#client").val();
            $.ajax({
                type: 'GET',
                url: "{{ url('/admin/getguarantorbyidno/') }}/" + idNumber + "/" + client,
                data: JSON.stringify({
                    '_token': "{{ csrf_token() }}"
                }),
                contentType: "application/json",
                processData: false,
                success: function(data) {
                    console.log(data);
                    $("#first_name").val(data[0].first_name);
                    $("#middle_name").val(data[0].middle_name);
                    $("#last_name").val(data[0].last_name);
                    $("#id_number").val(data[0].id_number);
                    $("#county").val(data[0].county);
                    $("#sub_county").val(data[0].sub_county);
                    $("#guarantor_relationship").val(data[0].relationship);
                    $("#primary_phone_number").val(data[0].primary_phone_number);
                    $("#secondary_phone_number").val(data[0].secondary_phone_number);
                    $("#occupation").val(data[0].occupation);
                }

            });
        }

        function getTotalLoanAmount() {
            var loanAmount = $("#amount").val();
            var interestCharged = $("#interest_charged").val();
            var interestPaymentMethod = $("#interest_payment_method").val();
            $.ajax({
                type: 'POST',
                url: "{!! url('/admin/gettotalloanamount/') !!}",
                data: JSON.stringify({
                    '_token': "{{ csrf_token() }}",
                    'loan_amount': loanAmount,
                    "interest_charged": interestCharged,
                    "interest_payment_method": interestPaymentMethod
                }),
                contentType: 'application/json',
                processData: false,
                success: function(data) {
                    $("#total_loan_amount").val(data);
                    $("#_total_loan_amount").val(data);
                    getloanschedule();

                }
            });
        }

        function dependsOnLGF() {

            // if($("#depends_on_lgf").is("checked")){
            //     $("#depends_on_lgf").prop("checked",true);
            //     $("#depends_on_lgf").val("1");

            // }else{
            //     $("#depends_on_lgf").prop("checked",false);
            //     $("#depends_on_lgf").val("0");
            // }

            if ($("#depends_on_lgf").is("checked") == true) {
                $("#lgf_percentage").css("display", "block");
                $("#lgf_amount").css("display", "block");
            } else {
                $("#lgf_percentage").css("display", "none");
                $("#lgf_amount").css("display", "none");

            }
        }

        function getClearingFee() {
            var loanAmount = $("#amount").val();
            var clearingFeeCode = $("#clearing_fee_code").val();

            var clearingFee = $("#clearing_fee_value").val();
            $.ajax({
                type: 'POST',
                url: "{!! url('/admin/getclearingfee/') !!}",
                data: JSON.stringify({
                    '_token': "{{ csrf_token() }}",
                    'loan_amount': loanAmount,
                    "clearing_fee_code": clearingFeeCode,
                    "clearing_fee_value": clearingFee
                }),
                contentType: 'application/json',
                processData: false,
                success: function(data) {
                    $("#clearing_fee_amount_label").html(data);
                    $("#clearing_fee").val(data);
                    // $("#amount_to_be_disbursed").val(data); 
                    // $("#_amount_to_be_disbursed").val(data);          

                }
            });

        }

        function getInsuranceDeductionFee() {
            var loanAmount = $("#amount").val();
            var insuranceDeductionFeeTypeCode = $("#insurance_deduction_fee_type_code").val();

            var insuranceDeductionFeeValue = $("#insurance_deduction_fee_value").val();
            $.ajax({
                type: 'POST',
                url: "{!! url('/admin/getinsurancedeductionfee/') !!}",
                data: JSON.stringify({
                    '_token': "{{ csrf_token() }}",
                    'loan_amount': loanAmount,
                    "insurance_deduction_fee_type_code": insuranceDeductionFeeTypeCode,
                    "insurance_deduction_fee_value": insuranceDeductionFeeValue
                }),
                contentType: 'application/json',
                processData: false,
                success: function(data) {
                    $("#insurance_deduction_fee_amount_label").html(data);
                    $("#insurance_deduction_fee").val(data);
                    // $("#amount_to_be_disbursed").val(data); 
                    // $("#_amount_to_be_disbursed").val(data);          

                }
            });
        }

        function getProcessingFee() {
            var loanAmount = $("#amount").val();
            var processingFeeTypeCode = $("#processing_fee_type_code").val();

            var processingFeeValue = $("#processing_fee_value").val();
            $.ajax({
                type: 'POST',
                url: "{!! url('/admin/getprocessingfee/') !!}",
                data: JSON.stringify({
                    '_token': "{{ csrf_token() }}",
                    'loan_amount': loanAmount,
                    "processing_fee_type_code": processingFeeTypeCode,
                    "processing_fee_value": processingFeeValue
                }),
                contentType: 'application/json',
                processData: false,
                success: function(data) {
                    $("#processing_fee_amount_label").html(data);
                    $("#processing_fee").val(data);
                    // $("#amount_to_be_disbursed").val(data); 
                    // $("#_amount_to_be_disbursed").val(data);          

                }
            });
        }

        function getAmountToBeDisbursed() {
            var loanAmount = $("#amount").val();
            var interestCharged = $("#interest_charged").val();
            var interestPaymentMethod = $("#interest_payment_method").val();
            var clearingFee = $("#clearing_fee").val();
            var insuranceDeductionFee = $("#insurance_deduction_fee").val();
            var clearingFeePaymentTypeCode = $("#clearing_fee_payment_type_code").val();
            var insuranceDeductionFeePaymentTypeCode = $("#insurance_deduction_fee_payment_type_code").val();
            var loanProductId = $("#loan_product").val();
            $.ajax({
                type: 'POST',
                url: "{!! url('/admin/getamounttobedisbursed/') !!}",
                data: JSON.stringify({
                    '_token': "{{ csrf_token() }}",
                    'loanProductId': loanProductId,
                    'loan_amount': loanAmount,
                    "interest_charged": interestCharged,
                    "interest_payment_method": interestPaymentMethod,
                    "clearing_fee": clearingFee,
                    "insurance_deduction_fee": insuranceDeductionFee,
                    "clearing_fee_payment_type_code": clearingFeePaymentTypeCode,
                    "insurance_deduction_fee_payment_type_code": insuranceDeductionFeePaymentTypeCode
                }),
                contentType: 'application/json',
                processData: false,
                success: function(data) {
                    $("#amount_to_be_disbursed").val(data);
                    $("#_amount_to_be_disbursed").val(data);

                }
            });
        }


        function getUnitPrice() {

            var productId = $("#asset").val();

            var quantity = Number($("#asset_quantity").val());

            var storeId = $("#store").val();

            if (!storeId) {
                alert("Please select store first!");
                $("#asset_quantity").val("1");
                return false;
            }

            $.get("{!! url('/admin/getproductbyid') !!}/" + productId, function(data) {

                var sellingPrice = data.selling_price;

                $.get("{!! url('/admin/getstockbyproductidandstoreid') !!}/" + productId + "/" + storeId, function(data) {

                    if (data.size < quantity) {

                        alert("Available stock is less than given quantity. Please enter quantity equal to or below : " +
                            data.size);

                        quantity = Number(data.size);

                        $("#asset_quantity").val(data.size);

                    }

                    $("#amount").val(Number(sellingPrice) * quantity);

                    getInterestCharged();


                });

            });
        }

        function loanProduct() {
            var id = $("#loan_product").val();
            $.ajax({
                type: 'POST',
                url: "{!! url('/admin/getloanproduct/') !!}",
                data: JSON.stringify({
                    '_token': "{{ csrf_token() }}",
                    'id': id
                }),
                contentType: 'application/json',
                processData: false,
                success: function(data) {
                    $("#amount").val(data.maximum_loan_amount);
                    $("#interest_rate_type").val(data.interest_rate_type);
                    $("#_interest_rate_type").val(data.interest_rate_type);
                    $("#interest_rate").val(data.interest_rate);
                    $("#_interest_rate").val(data.interest_rate);
                    $("#interest_payment_method").val(data.interest_payment_method);
                    $("#_interest_payment_method").val(data.interest_payment_method);
                    $("#loan_payment_duration").val(data.loan_payment_duration);
                    $("#_loan_payment_duration").val(data.loan_payment_duration);
                    $("#loan_payment_frequency").val(data.loan_payment_frequency);
                    $("#_loan_payment_frequency").val(data.loan_payment_frequency);
                    $("#grace_period_type").val(data.grace_period_type);
                    $("#_grace_period_type").val(data.grace_period_type);
                    gracePeriodType()
                    $("#grace_period").val(data.grace_period);
                    $("#_grace_period").val(data.grace_period);
                    $("#min_grace_period").val(data.min_grace_period);
                    $("#_min_grace_period").val(data.min_grace_period);
                    $("#max_grace_period").val(data.max_grace_period);
                    $("#_max_grace_period").val(data.max_grace_period);
                    // getAndUpdateDisbursementModes();
                    // if(data.can_change_disbursement_mode==1){
                    //     $("#disbursement_mode").attr("disabled",false);


                    // }else{
                    //     $("#disbursement_mode").attr("disabled",true);
                    //     getDisbursementModes();
                    // }
                    // $("#disbursement_mode").val(data.disbursement_mode);
                    $("#clearing_fee").val(data.clearing_fee);
                    $("#_clearing_fee").val(data.clearing_fee);
                    $("#clearing_fee_type").val(data.clearing_fee_type);
                    $("#_clearing_fee_type").val(data.clearing_fee_type);
                    $("#clearing_fee_payment_type").val(data.clearing_fee_payment_type);
                    $("#_clearing_fee_payment_type").val(data.clearing_fee_payment_type);
                    $("#insurance_deduction_fee").val(data.insurance_deduction_fee);
                    $("#_insurance_deduction_fee").val(data.insurance_deduction_fee);
                    $("#insurance_deduction_fee_type").val(data.insurance_deduction_fee_type);
                    $("#_insurance_deduction_fee_type").val(data.insurance_deduction_fee_fee_type);
                    $("#insurance_deduction_fee_payment_type").val(data.insurance_deduction_fee_payment_type);
                    $("#_insurance_deduction_fee_payment_type").val(data.insurance_deduction_fee_payment_type);
                    $("#fine_type").val(data.fine_type);
                    $("#_fine_type").val(data.fine_type);
                    $("#fine_charge").val(data.fine_charge);
                    $("#_fine_charge").val(data.fine_charge);
                    $("#fine_charge_period").val(data.fine_charge_period);
                    $("#_fine_charge_period").val(data.fine_charge_period);
                    $("#fine_charge_frequency").val(data.fine_charge_frequency);
                    $("#_fine_charge_frequency").val(data.fine_charge_frequency);
                    $("#initial_deposit").val(data.initial_deposit);
                    $("#guarantors-title").html("Guarantor(s) - (atleast " + data.number_of_guarantors + ")");
                    maxNumberOfGuarantors = Number(data.number_of_guarantors);
                    minAmount = Number(data.minimum_loan_amount);
                    maxAmount = Number(data.maximum_loan_amount);

                    getInterestCharged();


                }
            });
        }

        $(document).ready(function() {
            // loanProduct();    
            $("#date").datepicker({
                todayHighlight: !0,
                autoclose: !0
            });
            $("#date").datepicker('setDate', 'today');

            function loansCount() {


                $.ajax({
                    type: 'POST',
                    url: "{!! url('/admin/loanscount/') !!}",
                    data: JSON.stringify({
                        '_token': "{{ csrf_token() }}"
                    }),
                    contentType: 'application/json',
                    processData: false,
                    success: function(data) {
                        var obj = jQuery.parseJSON(data);
                        if (obj < 10) {
                            $("#loan_number").val("JKL0000" + (obj + 1));
                        } else if (obj < 100) {
                            $("#loan_number").val("JKL000" + (obj + 1));
                        } else if (obj < 1000) {
                            $("#loan_number").val("JKL00" + (obj + 1));
                        } else if (obj < 10000) {
                            $("#loan_number").val("JKL0" + (obj + 1));
                        } else {
                            $("#loan_number").val("JKL" + (obj + 1));
                        }

                        // console.log(obj);
                    }
                });

            }
            loansCount();

        });

        function subCounties() {
            var county = $("#county").val();
            // var token=$("input[name=_token]").val();
            $.ajax({
                type: 'POST',
                url: "{!! url('/admin/getsubcounties/') !!}",
                data: JSON.stringify({
                    'county': county,
                    '_token': "{{ csrf_token() }}"
                }),
                contentType: 'application/json',
                processData: false,
                success: function(data) {
                    var obj = jQuery.parseJSON(data);
                    // console.log(obj);
                    $("#sub_county option").remove();

                    var option = "<option value=''>Select Sub County</option>";
                    $("#sub_county").append(option);


                    for (var r = 0; r < obj.length; r++) {

                        var option = "<option value='" + obj[r].id + "'>" + obj[r].code + " " + obj[r].name +
                            "</option>";
                        $("#sub_county").append(option);

                    }
                }
            });

        }

        function updateLoanAmount(e) {

            var tbody = $(e).closest("tbody");

            var totalLoanAmount = 0;

            tbody.find("tr").each(function() {

                var price = $(this).find(".price").val();

                var quantity = $(this).find(".quantity").val();

                var total = (price * quantity);

                console.log(total);

                totalLoanAmount += total;

                $(this).find(".total").html(total);

            });

            $("#amount").val(totalLoanAmount);
            $("#_amount").val(totalLoanAmount);

            getInterestCharged();

        }

        function checkIfDependsOnLGF() {

            var loanProduct = $("#loan_product").val();
            var client = $("#client").val();
            var loanamount = $("#amount").val();

            $.get("{!! url('/admin/checkifloanproductdependsonlgf') !!}/" + loanProduct + "/" + client + "/" + loanamount, function(data) {

                if (data == 3) {

                    alert("This loan product depends on lgf balance! Client has no lgf balance!");

                    $("#btn-save").attr("disabled", true);

                } else if (data == 2) {

                    alert(
                        "This loan product depends on lgf balance! Please check clients lgf balance meets the loan product requirements!"
                    );

                    $("#btn-save").attr("disabled", true);

                } else {

                    $("#btn-save").attr("disabled", false);

                }

            });

        }

        checkIfDependsOnLGF();

        $("#primary_phone_number").mask("(999) 999-9999");
        $("#secondary_phone_number").mask("(999) 999-9999");
    </script>
@endsection
