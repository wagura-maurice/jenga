@extends('admin.home')
@section('main_content')
    <style type="text/css">
        #contribution-tbl th,
        td {
            color: #000;
            font-weight: bold;
            font-size: 12px;
        }

        #contribution-tbl td input {
            width: 70px;
        }


        #contribution-tbl td select {
            width: 100px;
        }
    </style>
    <div id="content" class="content">
        <ol class="breadcrumb pull-right">
            <li><a href="#">Home</a></li>
            <li><a href="#">public</a></li>
            <li><a href="#">Groups</a></li>
            <li class="active">form</li>
        </ol>
        <h1 class="page-header">Groups Contribution Form <small>groups details goes here...</small></h1>
        <div class="row">
            <div class="col-md-12">
                <a href="{!! url('admin/groupcontributions') !!}"><button type="button"
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
                        <h4 class="panel-title">Group Details</h4>
                    </div>
                    <div class="panel-body">
                        <label for="Group Number" class="col-md-3 col-sm-6 col-lg-3 control-label m-t-10  text-right">Group
                            Number : </label>
                        <label class="col-md-3 col-sm-6 col-lg-3 control-label m-t-10">
                            {!! $groupsdata['data']->group_number !!}
                        </label>
                        <label for="Group Name" class="col-md-3 col-sm-6 col-lg-3 control-label m-t-10 text-right">Group
                            Name : </label>
                        <label class="col-md-3 col-sm-6 col-lg-3 control-label m-t-10">
                            {!! $groupsdata['data']->group_name !!}
                        </label>
                        <label for="Meeting Day" class="col-md-3 col-sm-6 col-lg-3 control-label m-t-10  text-right">Meeting
                            Day : </label>
                        <label class="col-md-3 col-sm-6 col-lg-3 control-label m-t-10">
                            @foreach ($groupsdata['days'] as $days)
                                @if ($days->id == $groupsdata['data']->meeting_day)
                                    {!! $days->name !!}
                                @endif
                            @endforeach

                        </label>
                        <label for="Meeting Time" class="col-md-3 col-sm-6 col-lg-3 control-label m-t-10 text-right">Meeting
                            Time : </label>
                        <label class="col-md-3 col-sm-6 col-lg-3 control-label m-t-10">
                            {!! $groupsdata['data']->meeting_time !!}
                        </label>
                        <label for="Meeting Frequency"
                            class="col-md-3 col-sm-6 col-lg-3 control-label m-t-10  text-right">Meeting Frequency : </label>
                        <label class="col-md-3 col-sm-6 col-lg-3 control-label m-t-10">
                            @foreach ($groupsdata['meetingfrequencies'] as $meetingfrequencies)
                                @if ($meetingfrequencies->id == $groupsdata['data']->meeting_frequency)
                                    {!! $meetingfrequencies->name !!}
                                @endif
                            @endforeach
                            </select>
                        </label>


                        <label for="Preferred Mode Of Banking"
                            class="col-md-3 col-sm-6 col-lg-3 control-label m-t-10 text-right">Preferred Mode Of Banking :
                        </label>
                        <label class="col-md-3 col-sm-6 col-lg-3 control-label m-t-10">
                            @foreach ($groupsdata['bankingmodes'] as $bankingmodes)
                                @if ($bankingmodes->id == $groupsdata['data']->preferred_mode_of_banking)
                                    {!! $bankingmodes->name !!}
                                @endif
                            @endforeach
                        </label>

                        <label for="Registration Date"
                            class="col-md-3 col-sm-6 col-lg-3 control-label m-t-10  text-right">Registration Date : </label>
                        <label class="col-md-3 col-sm-6 col-lg-3 control-label m-t-10">
                            {!! $groupsdata['data']->registration_date !!}
                        </label>

                        <label for="Group Formation Date"
                            class="col-md-3 col-sm-6 col-lg-3 control-label m-t-10  text-right">Group Formation Date :
                        </label>
                        <label class="col-md-3 col-sm-6 col-lg-3 control-label m-t-10">
                            {!! $groupsdata['data']->group_formation_date !!}
                        </label>


                        <label for="Officer" class="col-md-3 col-sm-6 col-lg-3 control-label m-t-10 text-right">Officer :
                        </label>
                        <label class="col-md-3 col-sm-6 col-lg-3 control-label m-t-10">
                            @foreach ($groupsdata['employees'] as $employees)
                                @if ($employees->id == $groupsdata['data']->officer)
                                    {!! $employees->employee_number !!}
                                    {!! $employees->first_name !!}
                                    {!! $employees->middle_name !!}
                                    {!! $employees->last_name !!}
                                @endif
                            @endforeach
                        </label>
                        @foreach ($groupsdata['clientroles'] as $clientrole)
                            @foreach ($groupsdata['grouproles'] as $role)
                                @if ($role->id == $clientrole->group_role)
                                    <label for="Group Formation Date"
                                        class="col-md-3 col-sm-6 col-lg-3 control-label m-t-10  text-right">{!! $role->name !!}
                                        : </label>
                                @endif
                            @endforeach
                            @foreach ($groupsdata['clients'] as $client)
                                @if ($client->id == $clientrole->client)
                                    <label class="col-md-3 col-sm-6 col-lg-3 control-label m-t-10">
                                        {!! $client->client_number !!} {!! $client->first_name !!} {!! $client->middle_name !!}
                                        {!! $client->last_name !!}
                                    </label>
                                @endif
                            @endforeach
                        @endforeach
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
                            <a href="#" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i
                                    class="fa fa-times"></i></a>
                        </div>
                        <h4 class="panel-title">Contribution</h4>
                    </div>

                    <div class="panel-body">
                        <div class="col-lg-12">
                            @if (Session::has('success'))
                                <span class="alert alert-success">{{ Session::get('success') }} <a href="#"
                                        class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                                @elseif(Session::has('failed'))
                                    <span class="alert alert-danger">{{ Session::get('failed') }} <a href="#"
                                            class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                            @endif
                        </div>
                        <form action="{{ route('groupcontributions.update', $groupsdata['data']->id) }}" method="post">

                            <input type="hidden" name="_method" value="put" />
                            {!! csrf_field() !!}

                            <label for="transaction_date" class="control-label col-lg-3 m-t-10">Transaction Date</label>
                            <div class="col-lg-3 m-t-10">
                                <input type="text" name="transaction_date" id="transaction_date" class="form-control"
                                    placeholder="Transaction Date" value="" required="required"
                                    data-date-format="dd-mm-yyyy" data-date-end-date="Date.default">
                            </div>

                            <label for="transaction_number" class="control-label col-lg-3 m-t-10">Transaction
                                Number</label>
                            <div class="col-lg-3 m-t-10">
                                <input type="text" name="transaction_number" id="transaction_number"
                                    class="form-control" placeholder="Transaction Number" value=""
                                    required="required">
                            </div>

                            <label for="payment_mode" class="control-label col-lg-3 m-t-10 m-b-10">Payment Mode</label>
                            <div class="col-lg-3 m-t-10 m-b-10">
                                <select name="payment_mode" class="form-control" required="required">
                                    <option value="">Select Payment Mode</option>
                                    @foreach ($groupsdata['paymentmodes'] as $paymentmode)
                                        <option value="{!! $paymentmode->id !!}">{!! $paymentmode->name !!}</option>
                                    @endforeach
                                </select>
                            </div>

                            <table class="table table-bordered" id="contribution-tbl">
                                <thead>
                                    <tr>
                                        <th>C. Number</th>
                                        <th>Name</th>
                                        <th>LGF</th>
                                        <th>L. Number</th>
                                        <th>L. Balance</th>
                                        <th>Contribution</th>
                                        <th>L. Payment</th>
                                        <th>O. Type</th>
                                        <th>O. Payement</th>
                                        <th>Total</th>
                                        <th>Pending Loans</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $r = 0; ?>
                                    @foreach ($groupsdata['clientcontributions'] as $clientcontribution)
                                        @forelse($clientcontribution['loans'] as $loan)
                                            @if ($loop->first)
                                                @if (isset($clientcontribution))
                                                    <tr id="<?php ++$r;
                                                    echo $r; ?>">
                                                        <td><input type="hidden" name="client[]"
                                                                value="{{ $clientcontribution['client']['id'] }}" />{!! $clientcontribution['client']['client_number'] !!}
                                                        </td>
                                                        <td> {!! $clientcontribution['client']['first_name'] !!} {!! $clientcontribution['client']['middle_name'] !!}
                                                            {!! $clientcontribution['client']['last_name'] !!}</td>
                                                        <td>
                                                            @if (isset($clientcontribution['lgf'][0]))
                                                                {{ number_format($clientcontribution['lgf'][0]->balance, 2) }}
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if ($loan->balance > 0)
                                                                <input type="hidden" name="loan[]"
                                                                    value="{{ $loan->id }}" />
                                                                <font color="blue">{!! $loan->loan_number !!}
                                                            @endif
                                                            </font>
                                                        </td>
                                                        <td>
                                                            <font color="green">
                                                                @if ($loan->balance > 0)
                                                                    <input type="hidden" value="{{ $loan->balance }}"
                                                                        class="loan_balance" />{!! number_format($loan->balance, 2) !!}
                                                                @endif
                                                            </font>
                                                        </td>
                                                        <td><input type="text" name="client_lgf_contribution[]"
                                                                class="client_lgf_contribution"
                                                                onchange="totalContribution()"></td>
                                                        <td>
                                                            @if ($loan->status != 1 && $loan->balance > 0)
                                                                <input type="text" name="loan_payment[]"
                                                                    class="loan_payment"
                                                                    onchange="totalLoanPayment(this)">
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <select name="other_payment_type[]">
                                                                <option>Select Type</option>
                                                                @foreach ($groupsdata['otherpaymenttypes'] as $otherpaymenttypes)
                                                                    <option value="{{ $otherpaymenttypes->id }}">
                                                                        {{ $otherpaymenttypes->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                        <td><input type="hidden" name="other_payment_loan[]"
                                                                value="{!! $loan->id !!}" /><input type="text"
                                                                name="other_payment[]" class="other_payment"
                                                                onchange="totalOtherPayment()"></td>
                                                        <td><button type="button" name="add-other-payment"
                                                                class="btn btn-circle btn-primary btn-sm"
                                                                onclick="addOtherPayment('<?php echo $r; ?>','{{ $clientcontribution['client']['id'] }}')"><i
                                                                    class="fa fa-plus"></i></button></td>
                                                        <td>
                                                            <font color="red">
                                                                @if ($loan->status == 1)
                                                                    {{ $loan->loan_number }}
                                                                @endif
                                                            </font>
                                                        </td>
                                                    </tr>
                                                @endif
                                            @else
                                                @if ($loan->balance > 0)
                                                    <tr id="<?php ++$r;
                                                    echo $r; ?>">
                                                        <td><input type="hidden" name="client[]"
                                                                value="{{ $clientcontribution['client']['id'] }}" /><input
                                                                type="hidden" name="client_lgf_contribution[]"></td>
                                                        <td> </td>
                                                        <td></td>
                                                        <td>
                                                            @if ($loan->balance > 0)
                                                                <input type="hidden" name="loan[]"
                                                                    value="{{ $loan->id }}" /><input type="hidden"
                                                                    value="{{ $loan->balance }}"
                                                                    class="loan_balance" />{!! $loan->loan_number !!}
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if ($loan->balance > 0)
                                                                {!! $loan->balance !!}
                                                            @endif
                                                        </td>
                                                        <td></td>
                                                        <td><input type="text" name="loan_payment[]"
                                                                class="loan_payment" onchange="totalLoanPayment(this)">
                                                        </td>
                                                        <td><select name="other_payment_type[]">
                                                                <option>Select Type</option>
                                                                @foreach ($groupsdata['otherpaymenttypes'] as $otherpaymenttypes)
                                                                    <option value="{{ $otherpaymenttypes->id }}">
                                                                        {{ $otherpaymenttypes->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select></td>
                                                        <td><input type="hidden" name="other_payment_loan[]"
                                                                value="{!! $loan->id !!}" /><input type="text"
                                                                name="other_payment[]" class="other_payment"
                                                                onchange="totalOtherPayment()"></td>
                                                        <td><button type="button" name="add-other-payment"
                                                                class="btn btn-primary btn-circle btn-sm"
                                                                onclick="addOtherPayment('<?php echo $r; ?>','{{ $clientcontribution['client']['id'] }}')"><i
                                                                    class="fa fa-plus"></i></button></td>
                                                        <td>
                                                            <font color="red">
                                                                @if ($loan->status == 1)
                                                                    {{ $loan->loan_number }}
                                                                @endif
                                                            </font>
                                                        </td>
                                                    </tr>
                                                @endif
                                            @endif
                                        @empty
                                            @if (isset($clientcontribution))
                                                <tr id="<?php ++$r;
                                                echo $r; ?>">
                                                    <td>
                                                        <input type="hidden" name="client[]"
                                                            value="{{ $clientcontribution['client']['id'] }}" />
                                                        <input type="hidden" name="loan_payment[]"><input type="hidden"
                                                            name="loan[]" value="" />{!! $clientcontribution['client']['client_number'] !!}
                                                    </td>
                                                    <td> {!! $clientcontribution['client']['first_name'] !!} {!! $clientcontribution['client']['middle_name'] !!}
                                                        {!! $clientcontribution['client']['last_name'] !!}</td>
                                                    <td>
                                                        @if (isset($clientcontribution['lgf'][0]))
                                                            {!! number_format($clientcontribution['lgf'][0]->balance, 2) !!}
                                                        @endif
                                                    </td>
                                                    <td></td>
                                                    <td></td>
                                                    <td><input type="text" name="client_lgf_contribution[]"
                                                            class="client_lgf_contribution"
                                                            onchange="totalContribution()"></td>
                                                    <td></td>
                                                    <td>
                                                        <select name="other_payment_type[]">
                                                            <option>Select Type</option>
                                                            @foreach ($groupsdata['otherpaymenttypes'] as $otherpaymenttypes)
                                                                <option value="{{ $otherpaymenttypes->id }}">
                                                                    {{ $otherpaymenttypes->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td><input type="hidden" name="other_payment_loan[]"
                                                            value="" /><input type="text" name="other_payment[]"
                                                            class="other_payment" onchange="totalOtherPayment()"></td>
                                                    <td><button type="button" name="add-other-payment"
                                                            class="btn btn-primary btn-sm btn-circle"
                                                            onclick="addOtherPayment('<?php echo $r; ?>','{{ $clientcontribution['client']['id'] }}')"><i
                                                                class="fa fa-plus"></i></button></td>
                                                    <td>
                                                        <font color="red"></font>
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforelse
                                    @endforeach
                                    <tr>
                                        <td>Totals</td>
                                        <td></td>
                                        <td>{!! number_format($groupsdata['totallgfbalance'], 2) !!}</td>
                                        <td></td>
                                        <td>{!! number_format($groupsdata['totalloanbalance'], 2) !!}</td>
                                        <td id="total-contribution"></td>
                                        <td id="total-loan-payment"></td>
                                        <td></td>
                                        <td id="total-other-payment"></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                            <label for="transaction_number" class="control-label col-lg-9 m-t-10 m-b-10"></label>
                            <div class="col-lg-3 m-t-10 m-b-10">
                                <button type="submit" id="submit" class="btn btn-sm btn-primary">Submit</button>
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
        $("#meeting_time").datetimepicker({
            format: "LT"
        });
    </script>
    <script language="javascript" type="text/javascript">
        $("#registration_date").datepicker({
            todayHighlight: !0,
            autoclose: !0
        });
    </script>
    <script language="javascript" type="text/javascript">
        $("#transaction_date").datepicker({
            todayHighlight: !0,
            autoclose: !0
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $("form").submit(function() {
                $("#submit").hide();
            });
        });

        function totalContribution() {
            var contribution = 0;
            $("#contribution-tbl tr").each(function(i, row) {
                var contributionValue = $(this).find("td .client_lgf_contribution").val();
                if (contributionValue != null && contributionValue != "") {
                    contribution = contribution + Number($(this).find("td .client_lgf_contribution").val());
                }


            });
            $("#total-contribution").html(contribution);
        }

        function totalOtherPayment() {
            var otherPayment = 0;
            $("#contribution-tbl tr").each(function(i, row) {
                var otherPaymentValue = $(this).find("td .other_payment").val();
                if (otherPaymentValue != null && otherPaymentValue != "") {
                    otherPayment = otherPayment + Number($(this).find("td .other_payment").val());
                }


            });
            $("#total-other-payment").html(otherPayment);
        }

        function totalLoanPayment(e) {

            var rowBalance = Number($(e).closest("tr").find(".loan_balance").val());

            if (rowBalance) {

                if (Number($(e).val()) > rowBalance) {

                    $(e).val("");

                    alert("Payment amount should be less than loan balance");
                }

            }

            var loanPayment = 0;

            $("#contribution-tbl tr").each(function(i, row) {
                var loanPaymentValue = $(this).find("td .loan_payment").val();
                if (loanPaymentValue != null && loanPaymentValue != "") {
                    loanPayment = loanPayment + Number($(this).find("td .loan_payment").val());
                }


            });

            $("#total-loan-payment").html(loanPayment);
        }
        var rowChanges = 0;
        var lastAddedRow = 0;

        function addOtherPayment(currentRow, client) {
            var rowCount = $("#contribution-tbl tr").length;

            if (rowChanges == 0) {
                lastAddedRow = rowCount - 1;
            }
            ++lastAddedRow;
            var row = $("<tr id='" + lastAddedRow +
                "'><td><input type='hidden' name='other_payment_loan[]'/><input type=\"hidden\" name=\"client[]\" value=\"" +
                client +
                "\"/><input type=\"hidden\" name=\"loan_payment[]\"><input type=\"hidden\" name=\"loan[]\" value=\"\"/></td><td> </td><td></td><td></td><td></td><td><input type=\"hidden\" name=\"client_lgf_contribution[]\" class=\"client_lgf_contribution\" onchange=\"totalContribution()\"></td><td></td><td><select name=\"other_payment_type[]\"><option>Select Type</option>@foreach ($groupsdata['otherpaymenttypes'] as $otherpaymenttypes)<option value=\"{{ $otherpaymenttypes->id }}\">{{ $otherpaymenttypes->name }}</option>@endforeach</select></td><td><input type=\"text\" name=\"other_payment[]\"  class=\"other_payment\" onchange=\"totalOtherPayment()\"></td><td><button type=\"button\" name=\"add-other-payment\" class=\"btn btn-sm btn-circle btn-danger  m-b-2 m-r-2 \"  onclick=\"removeOtherPayment('" +
                lastAddedRow + "','" + client +
                "')\"><i class=\"fa fa-minus\"></i></button><button type=\"button\" name=\"add-other-payment\" class=\"btn btn-primary btn-circle btn-sm\"  onclick=\"addOtherPayment('" +
                lastAddedRow + "','" + client +
                "')\"><i class=\"fa fa-plus\"></i></button></td><td><font color=\"red\"></font></td></tr> ");

            row.insertAfter($("tr#" + currentRow));

        }

        function removeOtherPayment(currentRow, client) {
            $("tr#" + currentRow).remove();
        }
    </script>
@endsection
