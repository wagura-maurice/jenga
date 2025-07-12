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
        <h1 class="page-header">Loan <small>loan details goes here...</small></h1>
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
