@extends('admin.home')
@section('main_content')

    <div id="content" class="content">
        <ol class="breadcrumb pull-right">
            <li><a href="#">Home</a></li>
            <li><a href="#">public</a></li>
            <li><a href="#">Loan Disbursements</a></li>
            <li class="active">form</li>
        </ol>
        <h1 class="page-header">Loan Disbursements Update Form <small>loan disbursements details goes here...</small></h1>
        <div class="row">
            <div class="col-md-12">
                <a href="{!! route('loandisbursements.index') !!}"><button type="button"
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

                        <form action="{!! route('loans.update', $loandisbursementsdata['disbursementloan']->id) !!}" method="POST">
                            <input type="hidden" name="_method" value="put" />
                            {!! csrf_field() !!}
                            <div class="form-group">
                                <label for="Loan Number" class="col-md-3 m-t-10 control-label">Loan Number</label>
                                <div class="col-md-3 m-t-10">
                                    <label>{!! $loandisbursementsdata['disbursementloan']->loan_number !!}</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Loan Product" class="col-md-3 m-t-10 control-label">Loan Product</label>
                                <div class="col-md-3 m-t-10">
                                    <!-- <select class="form-control" name="loan_product" id="loan_product"> -->
                                    <label>
                                        {{ $loandisbursementsdata['disbursementloan']->loanproductmodel->name }}
                                    </label>

                                    <!-- </select> -->
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Client" class="col-md-3 m-t-10 control-label">Client</label>
                                <div class="col-md-3 m-t-10">
                                    <label>
                                        @foreach ($loandisbursementsdata['clients'] as $clients)
                                            @if ($clients->id == $loandisbursementsdata['disbursementloan']->client)
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
                                    <label>{!! $loandisbursementsdata['disbursementloan']['date'] !!}</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Amount" class="col-md-3 m-t-10 control-label">Amount</label>
                                <div class="col-md-3 m-t-10">
                                    <label>{!! $loandisbursementsdata['disbursementloan']->amount !!}</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Interest Rate Type" class="col-md-3 m-t-10 control-label">Interest Rate
                                    Type</label>
                                <div class="col-md-3 m-t-10">
                                    <label>
                                        @foreach ($loandisbursementsdata['interestratetypes'] as $interestratetypes)
                                            @if ($interestratetypes->id == $loandisbursementsdata['disbursementloan']->interest_rate_type)
                                                {!! $interestratetypes->name !!}
                                            @endif
                                        @endforeach
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Interest Rate" class="col-md-3 m-t-10 control-label">Interest Rate</label>
                                <div class="col-md-3 m-t-10">
                                    <label>{!! $loandisbursementsdata['disbursementloan']->interest_rate !!}</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Interest Payment Method" class="col-md-3 m-t-10 control-label">Interest Payment
                                    Method</label>
                                <div class="col-md-3 m-t-10">
                                    <label>
                                        @foreach ($loandisbursementsdata['interestpaymentmethods'] as $interestpaymentmethods)
                                            @if ($interestpaymentmethods->id == $loandisbursementsdata['disbursementloan']->interest_payment_method)
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
                                        @foreach ($loandisbursementsdata['loanpaymentdurations'] as $loanpaymentdurations)
                                            @if ($loanpaymentdurations->id == $loandisbursementsdata['disbursementloan']->loan_payment_duration)
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
                                        @foreach ($loandisbursementsdata['loanpaymentfrequencies'] as $loanpaymentfrequencies)
                                            @if ($loanpaymentfrequencies->id == $loandisbursementsdata['disbursementloan']->loan_payment_frequency)
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
                                        @foreach ($loandisbursementsdata['graceperiods'] as $graceperiods)
                                            @if ($graceperiods->id == $loandisbursementsdata['disbursementloan']->grace_period)
                                                {!! $graceperiods->name !!}
                                            @endif
                                        @endforeach
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Interest Charged" class="col-md-3 m-t-10 control-label">Interest Charged</label>
                                <div class="col-md-3 m-t-10">
                                    <label>{!! $loandisbursementsdata['disbursementloan']->interest_charged !!}</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Total Loan Amount" class="col-md-3 m-t-10 control-label">Total Loan
                                    Amount</label>
                                <div class="col-md-3 m-t-10">
                                    <label>{!! $loandisbursementsdata['disbursementloan']->total_loan_amount !!}</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Amount To Be Disbursed" class="col-md-3 m-t-10 control-label">Amount To Be
                                    Disbursed</label>
                                <div class="col-md-3 m-t-10">
                                    <label>{!! $loandisbursementsdata['disbursementloan']->amount_to_be_disbursed !!}</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Mode Of Disbursement" class="col-md-3 m-t-10 control-label">Mode Of
                                    Disbursement</label>
                                <div class="col-md-3 m-t-10">
                                    <label>
                                        @foreach ($loandisbursementsdata['disbursementmodes'] as $disbursementmodes)
                                            @if ($disbursementmodes->id == $loandisbursementsdata['disbursementloan']->disbursement_mode)
                                                {!! $disbursementmodes->name !!}
                                            @endif
                                        @endforeach
                                    </label>

                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Clearing Fee" class="col-md-3 m-t-10 control-label">Clearing Fee</label>
                                <div class="col-md-3 m-t-10">
                                    <label>{!! $loandisbursementsdata['disbursementloan']->clearing_fee !!}</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Clearing Fee" class="col-md-3 m-t-10 control-label">Processing Fee</label>
                                <div class="col-md-3 m-t-10">
                                    <label>{!! $loandisbursementsdata['disbursementloan']->processing_fee !!}</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Insurance Deduction Fee" class="col-md-3 m-t-10 control-label">Insurance
                                    Deduction Fee</label>
                                <div class="col-md-3 m-t-10">
                                    <label>{!! $loandisbursementsdata['disbursementloan']->insurance_deduction_fee !!}</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Fine Type" class="col-md-3 m-t-10 control-label">Fine Type</label>
                                <div class="col-md-3 m-t-10">
                                    <label>
                                        @foreach ($loandisbursementsdata['finetypes'] as $finetypes)
                                            @if ($finetypes->id == $loandisbursementsdata['disbursementloan']->fine_type)
                                                {!! $finetypes->name !!}
                                            @endif
                                        @endforeach
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Fine Charge" class="col-md-3 m-t-10 control-label">Fine Charge</label>
                                <div class="col-md-3 m-t-10">
                                    <label>{!! $loandisbursementsdata['disbursementloan']->fine_charge !!}</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Fine Charge Frequency" class="col-md-3 m-t-10 control-label">Fine Charge
                                    Frequency</label>
                                <div class="col-md-3 m-t-10">
                                    <label>
                                        @foreach ($loandisbursementsdata['finechargefrequencies'] as $finechargefrequencies)
                                            @if ($finechargefrequencies->id == $loandisbursementsdata['disbursementloan']->fine_charge_frequency)
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
                                        @foreach ($loandisbursementsdata['finechargeperiods'] as $finechargeperiods)
                                            @if ($finechargeperiods->id == $loandisbursementsdata['disbursementloan']->fine_charge_period)
                                                {!! $finechargeperiods->name !!}
                                            @endif
                                        @endforeach

                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Initial Deposit" class="col-md-3 m-t-10 control-label">Initial Deposit</label>
                                <div class="col-md-3 m-t-10">
                                    <label>{!! $loandisbursementsdata['disbursementloan']->initial_deposit !!}</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Status" class="col-md-3 m-t-10 control-label">Status</label>
                                <div class="col-md-3 m-t-10">
                                    <label>
                                        @foreach ($loandisbursementsdata['loanstatuses'] as $loanstatuses)
                                            @if ($loanstatuses->id == $loandisbursementsdata['disbursementloan']['status'])
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
                            @if (isset($loandsibrusementdata['documents']))
                                @foreach ($loandisbursementsdata['documents'] as $loandocuments)
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
                            @endif
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
                                @if (isset($loandsibursementsdata['guarantors']))
                                    @foreach ($loandisbursementsdata['guarantors'] as $guarantors)
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
                                @endif
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
                        <h4 class="panel-title">Assets</h4>
                    </div>
                    <div class="panel-body">
                        <table id="data-table" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Asset</th>
                                    <th>Store</th>
                                    <th>Quantity</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (isset($loandisbursementsdata['assets']))
                                    @foreach ($loandisbursementsdata['assets'] as $assets)
                                        <tr>
                                            <td class='table-text'>
                                                <div>
                                                    {!! isset($assets->asset) ? $assets->assetmodel->name : '' !!}
                                                </div>
                                            </td>
                                            <td class='table-text'>
                                                <div>
                                                    {!! isset($loandisbursementsdata['disbursementloan']->store)
                                                        ? $loandisbursementsdata['disbursementloan']->storemodel->name
                                                        : '' !!}
                                                </div>
                                            </td>
                                            <td class='table-text'>
                                                <div>
                                                    {!! $assets->quantity !!}
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
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
                                @if (isset($loandisbursementsdata['collaterals']))
                                    @foreach ($loandisbursementsdata['collaterals'] as $loancollaterals)
                                        <tr>
                                            <td class='table-text'>
                                                <div>
                                                    {!! $loancollaterals->loanmodel->loan_number !!}
                                                </div>
                                            </td>
                                            <td class='table-text'>
                                                <div>
                                                    {!! isset($loancollaterals->collateral_category) ? $loancollaterals->collateralcategorymodel->name : '' !!}
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
                                @endif
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
                                    <th>Payment Date</th>
                                    <th>Amount</th>
                                    <th>Expected Payment</th>
                                    <th>Exptected Balance</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (isset($loandsibursementsdata['loanschedule']))
                                    @foreach ($loandisbursementsdata['loanschedule'] as $loanschedule)
                                        <tr>
                                            <td>{{ $loanschedule['date'] }}</td>
                                            <td>{{ $loanschedule['amount'] }}</td>
                                            <td>{{ $loanschedule['expectedpayment'] }}</td>
                                            <td>{{ $loanschedule['expectedbalance'] }}</td>

                                        </tr>
                                    @endforeach
                                @endif
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
                        <h4 class="panel-title">DataForm - Autofill</h4>
                    </div>
                    <div class="panel-body">
                        <form action="{!! route('loandisbursements.update', $loandisbursementsdata['data']->id) !!}" method="POST" class="form-horizontal">
                            <input type="hidden" name="_method" value="put" />
                            {!! csrf_field() !!}
                            <div class="form-group">
                                <label for="Loan" class="col-sm-3 control-label">Loan</label>
                                <div class="col-sm-6">
                                    <select class="form-control" name="loan" id="loan">
                                        <option value="">Select Loan</option>
                                        @foreach ($loandisbursementsdata['loans'] as $loans)
                                            @if ($loans->id == $loandisbursementsdata['data']->loan)
                                                {
                                                <option selected value="{!! $loans->id !!}">

                                                    {!! $loans->loan_number !!}
                                                </option>
                                            @else
                                                <option value="{!! $loans->id !!}">

                                                    {!! $loans->loan_number !!}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Disbursement Status" class="col-sm-3 control-label">Disbursement
                                    Status</label>
                                <div class="col-sm-6">
                                    <select class="form-control" name="disbursement_status" id="disbursement_status">
                                        <option value="">Select Disbursement Status</option>
                                        @foreach ($loandisbursementsdata['disbursementstatuses'] as $disbursementstatuses)
                                            @if ($disbursementstatuses->id == $loandisbursementsdata['data']->disbursement_status)
                                                {
                                                <option selected value="{!! $disbursementstatuses->id !!}">

                                                    {!! $disbursementstatuses->name !!}
                                                </option>
                                            @else
                                                <option value="{!! $disbursementstatuses->id !!}">

                                                    {!! $disbursementstatuses->name !!}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Date" class="col-sm-3 control-label">Date</label>
                                <div class="col-sm-6">
                                    <input type="text" name="date" id="date" class="form-control"
                                        placeholder="Date" value="{!! $loandisbursementsdata['data']->date !!}" data-date-format="dd-mm-yyyy"
                                        data-date-end-date="Date.default" />
                                </div>
                            </div>

                            @if ($loandisbursementsdata['data']->disbursementstatusmodel->code == '001')
                                <div class="form-group">
                                    <div class="col-sm-offset-3 col-sm-6">
                                        <div class="col-sm-offset-3 col-sm-6">
                                            <button type="submit" class="btn btn-sm btn-primary">
                                                Submit
                                            </button>
                                        </div>
                                    </div>
                            @endif
                            @if (isset($loandisbursementsdata['response']))
                                @if ($loandisbursementsdata['response'] == '1')
                                    <div class="alert alert-success m-b-0">
                                        <h4 class="block">Success</h4>
                                        <p>
                                            This loan has been
                                            {{ $loandisbursementsdata['data']->disbursementstatusmodel->name }}
                                        </p>
                                    </div>
                                @else
                                    <div class="alert alert-danger m-b-0">
                                        <h4 class="block">Disbursement Failed.</h4>
                                        <p>
                                            An error occured while trying to disburse the funds. Please try again.
                                            {!! $loandisbursementsdata['result'] !!}
                                        </p>
                                    </div>
                                @endif
                            @endif

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
