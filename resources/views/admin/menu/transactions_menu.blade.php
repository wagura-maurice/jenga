    @extends('admin.home')
    @section('main_content')
        <div id="content" class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-lg-4">
                            <a class="link-unstyled text-white" href="{!! route('groupcontributions.index') !!}">
                                <div class="panel b bg-green-lighter">
                                    <div class="panel-body text-center">

                                        <em class="fa fa-4x fa-suitcase m-b-5"></em>
                                        <br />
                                        <span class="h4">Group Contributions</span>
                                        <br />
                                        <small class="text-white">View all &rarr;</small>

                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-4">

                            <a class="link-unstyled text-white" href="#" data-toggle="modal"
                                data-target="#IndividualContributionsModal">
                                <div class="panel b bg-green-lighter">
                                    <div class="panel-body text-center">

                                        <em class="fa fa-4x fa-suitcase m-b-5"></em>
                                        <br />
                                        <span class="h4">Individual Contributions</span>
                                        <br />
                                        <!-- <small class="text-white">View all &rarr;</small> -->

                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-4">
                            <a class="link-unstyled text-white" href="{!! route('membershipfees.create') !!}">
                                <div class="panel b  bg-green-lighter">

                                    <div class="panel-body text-center">

                                        <em class="fa fa-4x fa-users m-b-5"></em>
                                        <br />
                                        <span class="h4">Membership Fees</span>
                                        <br />
                                        <small class="text-white">View all &rarr;</small>

                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-4">
                            <a class="link-unstyled text-white" href="{!! route('insurancedeductionpayments.index') !!}">
                                <div class="panel b  bg-green-lighter">

                                    <div class="panel-body text-center">

                                        <em class="fa fa-4x fa-arrow-down m-b-5"></em>
                                        <br />
                                        <span class="h4">Insurance Deduction Payments</span>
                                        <br />
                                        <small class="text-white">View all &rarr;</small>

                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-4">
                            <a class="link-unstyled text-white" href="{!! route('processingfeepayments.index') !!}">
                                <div class="panel b  bg-green-lighter">

                                    <div class="panel-body text-center">

                                        <em class="fa fa-4x fa-arrow-down m-b-5"></em>
                                        <br />
                                        <span class="h4">Processing Fee Payment</span>
                                        <br />
                                        <small class="text-white">View all &rarr;</small>

                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-4">
                            <a class="link-unstyled text-white" href="{!! route('clearingfeepayments.index') !!}">
                                <div class="panel b  bg-green-lighter">

                                    <div class="panel-body text-center">

                                        <em class="fa fa-4x fa-arrow-down m-b-5"></em>
                                        <br />
                                        <span class="h4">Clearing Fee Payment</span>
                                        <br />
                                        <small class="text-white">View all &rarr;</small>

                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-4">
                            <a class="link-unstyled text-white" href="{!! route('loandisbursements.index') !!}">
                                <div class="panel b bg-green-lighter">
                                    <div class="panel-body text-center">

                                        <em class="fa fa-4x fa-arrow-up m-b-5"></em>
                                        <br />
                                        <span class="h4">Loan Disbursements</span>
                                        <br />
                                        <small class="text-white">View all &rarr;</small>

                                    </div>
                                </div>
                            </a>
                        </div>
                        <!--                     <div class="col-lg-4">
                                <a class="link-unstyled text-white" href="{!! route('loans.index') !!}">
                                    <div class="panel b bg-green-lighter">
                                        <div class="panel-body text-center">
                                            
                                            <em class="fa fa-4x fa-language m-b-5"></em>
                                            <br/>
                                            <span class="h4">Other Payments</span>
                                            <br/>
                                            <small class="text-white">View all &rarr;</small>
                                            
                                        </div>
                                    </div>
                                </a>
                            </div> -->
                        <div class="col-lg-4">
                            <a class="link-unstyled text-white" href="{!! route('finepayments.index') !!}">
                                <div class="panel b bg-green-lighter">
                                    <div class="panel-body text-center">

                                        <em class="fa fa-4x fa-unlock m-b-5"></em>
                                        <br />
                                        <span class="h4">Fine Payments</span>
                                        <br />
                                        <small class="text-white">View all &rarr;</small>

                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-4">
                            <a class="link-unstyled text-white" href="{!! route('expense.index') !!}">
                                <div class="panel b bg-green-lighter">
                                    <div class="panel-body text-center">

                                        <em class="fa fa-4x fa-rebel m-b-5"></em>
                                        <br />
                                        <span class="h4">Expenses</span>
                                        <br />
                                        <small class="text-white">View all &rarr;</small>

                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-4">
                            <a class="link-unstyled text-white" href="{!! url('admin/transfersmenu') !!}">
                                <div class="panel b bg-green-lighter">
                                    <div class="panel-body text-center">

                                        <em class="fa fa-4x fa-language m-b-5"></em>
                                        <br />
                                        <span class="h4">Transfers</span>
                                        <br />
                                        <small class="text-white">View all &rarr;</small>

                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="col-lg-4">
                            <a class="link-unstyled text-white" href="{!! url('admin/withdrawalsmenu') !!}">
                                <div class="panel b bg-green-lighter">
                                    <div class="panel-body text-center">

                                        <em class="fa fa-4x fa-sign-out m-b-5"></em>
                                        <br />
                                        <span class="h4">Withdrawals</span>
                                        <br />
                                        <small class="text-white">View all &rarr;</small>

                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="col-lg-4">
                            <a class="link-unstyled text-white" href="{!! route('salesorders.index') !!}">
                                <div class="panel b bg-green-lighter">
                                    <div class="panel-body text-center">

                                        <em class="fa fa-4x fa-cart-arrow-down m-b-5"></em>
                                        <br />
                                        <span class="h4">Sales Payments</span>
                                        <br />
                                        <small class="text-white">View all &rarr;</small>

                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="col-lg-4">
                            <a class="link-unstyled text-white" href="{!! route('purchaseorders.index') !!}">
                                <div class="panel b bg-green-lighter">
                                    <div class="panel-body text-center">

                                        <em class="fa fa-4x fa-balance-scale m-b-5"></em>
                                        <br />
                                        <span class="h4">Purchase Payments</span>
                                        <br />
                                        <small class="text-white">View all &rarr;</small>

                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-4">
                            <a class="link-unstyled text-white" href="{!! route('standing.order.index') !!}">
                                <div class="panel b bg-green-lighter">
                                    <div class="panel-body text-center">

                                        <em class="fa fa-4x fa-list-ol m-b-5"></em>
                                        <br />
                                        <span class="h4">Standing Orders</span>
                                        <br />
                                        <small class="text-white">View all &rarr;</small>

                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="IndividualContributionsModal" role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <!-- <div class="modal-header"> -->
                        <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
                        <!-- <h4 class="modal-title">Query Client</h4> -->
                        <!-- </div> -->
                        <div class="modal-body">
                            <div class="form-group">
                                <!-- <label for="clientNumber">Client Number:</label> -->
                                <input type="text" class="form-control" name="clientNumber" id="clientNumber"
                                    placeholder="ENTER CLIENT NUMBER">
                            </div>
                            <form id="IndividualContributions">
                                <div id="client_information"></div>
                                <div class="row">
                                    <div class="col-md-12 form-group">
                                        <span class="col-md-6 control-label"><strong>C. Name:</strong></span>
                                        <span class="col-md-6 control-label text-left" id="client_name"></span>
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <span class="col-md-6 control-label"><strong>LGF. Balance:</strong></span>
                                        <span class="col-md-6 control-label text-left" id="lgf_balance"></span>
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <span class="col-md-6 control-label"><strong>Transaction Date:</strong></span>
                                        <input type="text" name="transaction_date" id="transaction_date"
                                            class="form-control" placeholder="Transaction Date" value=""
                                            required="required" data-date-format="dd-mm-yyyy"
                                            data-date-end-date="Date.default">
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <span class="col-md-6 control-label"><strong>Transaction Number:</strong></span>
                                        <input type="text" class="form-control" name="transaction_number"
                                            id="transaction_number" placeholder="ENTER TRANSACTION NUMBER">
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <span class="col-md-6 control-label"><strong>Payment Mode:</strong></span>
                                        <select id="payment_mode" name="payment_mode" class="form-control">
                                            @foreach (\App\PaymentModes::all() as $paymentMode)
                                                <option value="{{ $paymentMode->id }}">
                                                    {{ ucwords($paymentMode->code . ' - ' . $paymentMode->name) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <span class="col-md-6 control-label"><strong>LGF.Contribution:</strong></span>
                                        <input type="text" class="form-control" name="lgf_contribution"
                                            id="lgf_contribution" placeholder="ENTER LGF CONTRIBUTION">
                                    </div>
                                    <div id="loan_payments"></div>
                                    <!-- <div class="col-md-12 form-group">
                                        <div class="col-6">
                                            <span class="col-md-6 control-label"><strong>L. Number:</strong></span>
                                            <span class="col-md-6 control-label text-left" id="loan_number"></span>
                                        </div>
                                        <div class="col-6">
                                            <span class="col-md-6 control-label"><strong>L. Balance:</strong></span>
                                            <span class="col-md-6 control-label text-left" id="loan_balance"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <span class="col-md-6 control-label"><strong>L. Payment:</strong></span>
                                        <input type="text" class="form-control" name="loan_payment" id="loan_payment" placeholder="ENTER LOAN PAYMENT">
                                    </div> -->
                                    <div class="col-md-12 form-group">
                                        @foreach (\App\OtherPaymentTypes::all() as $otherpaymenttypes)
                                            <span class="col-md-6 control-label">
                                                <strong>{{ ucwords($otherpaymenttypes->code . ' - ' . $otherpaymenttypes->name) }}:</strong>
                                            </span>
                                            <input type="text" class="form-control" name="other_payments[{{ $otherpaymenttypes->id }}]" id="{{ $otherpaymenttypes->code }}" placeholder="ENTER {{ strtoupper($otherpaymenttypes->name) }}">
                                        @endforeach
                                    </div>
                                    <div class="col-lg-3 m-t-10 m-b-10">
                                        <button type="submit" id="submit-button"
                                            class="btn btn-sm btn-primary" disabled>Submit</button>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endsection
        @section('script')
            <script>
                $("#transaction_date").datepicker({
                    todayHighlight: !0,
                    autoclose: !0
                });

                // setup before functions
                var typingTimer; // timer identifier
                var doneTypingInterval = 5000; // time in ms, 5 second for example
                var $input = $('#clientNumber');

                // on keyup, start the countdown
                $input.on('keyup', function() {
                    clearTimeout(typingTimer);
                    typingTimer = setTimeout(doneTyping, doneTypingInterval);
                    // reset
                    $('#client_name').empty();
                    $('#lgf_balance').empty();
                    $('form :input').val('');
                });

                // on keydown, clear the countdown 
                $input.on('keydown', function() {
                    clearTimeout(typingTimer);
                });

                // user is "finished typing," do something
                function doneTyping() {
                    // do something
                    var formData = {
                        clientNumber: $("#clientNumber").val()
                    };

                    $.ajax({
                        type: "POST",
                        url: "{!! route('client.query2') !!}",
                        data: formData,
                        dataType: "json",
                        encode: true,
                    }).done(function(data) {
                        // console.log(data);
                        if (data && data.name) {
                            $('#client_name').prepend(data.name);
                            $('#lgf_balance').prepend('KSH ' + data.lgf_balance);
                            $('#client_information').prepend(
                                '<input type="hidden" name="client_number" id="client_number" value="' + data.number + '">');
                            $.each(data.loans, function(index, loan) {
                                //now you can access properties using dot notation
                                if (loan.total_loan_balance) {
                                    $("#loan_payments").prepend(
                                        '<div class="col-md-12 form-group"><div class="col-6"><span class="col-md-6 control-label"><strong>L. Number:</strong></span><span class="col-md-6 control-label text-left" id="loan_number_' +
                                        loan.loan_number + '">' + loan.loan_number +
                                        '</span></div><div class="col-6"><span class="col-md-6 control-label"><strong>L. Balance:</strong></span><span class="col-md-6 control-label text-left" id="loan_balance_' +
                                        loan.loan_number + '">' + loan.total_loan_balance +
                                        '</span></div></div><div class="col-md-12 form-group"><span class="col-md-6 control-label"><strong>L. Payment:</strong></span><input type="text" class="form-control" name="loan_payment[' +
                                        loan.id + ']" id="' + loan.id + '" placeholder="ENTER LOAN ' + loan
                                        .loan_number + ' PAYMENT AMOUNT"></div>');
                                }
                            });
                            $('#submit-button').prop('disabled', false);
                        } else {
                            $('#submit-button').prop('disabled', true);
                        }
                    });

                    // event.preventDefault();
                }

                $(document).ready(function() {
                    $("#IndividualContributions").submit(function(event) {
                        var formData = $('form').serialize();

                        console.log(formData);

                        $.ajax({
                            type: "POST",
                            url: "{!! route('client.contribute') !!}",
                            data: formData,
                            dataType: "json",
                            encode: true,
                        }).done(function(data) {
                            // console.log(data);
                            $.gritter.add({
                                title: data.status,
                                text: data.message,
                                sticky: false,
                                time: '3000',
                            });

                            // $('form :input').val('');

                            $('#IndividualContributionsModal').modal('toggle');
                        });

                        event.preventDefault();
                    });
                });
            </script>
        @endsection
