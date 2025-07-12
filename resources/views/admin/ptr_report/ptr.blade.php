@extends("admin.home")
@section("main_content")
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
    <ol class="breadcrumb pull-right hidden-print">
        <li><a href="#">Home</a></li>
        <li><a href="#">public</a></li>
        <li><a href="#">Groups</a></li>
        <li class="active">form</li>
    </ol>
    <h1 class="page-header hidden-print">Periodic Transaction Report <small>groups details goes here...</small></h1>
    <div class="row hidden-print">
        <div class="col-md-12">
            <a href="{!! route('groups.index') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-arrow-left"></i></button></a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-inverse">
                <div class="panel-heading hidden-print">
                    <div class="panel-heading-btn">
                        <a href="#" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                        <a href="#" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                        <a href="#" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                        <a href="#" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                    </div>
                    <h4 class="panel-title">PTR</h4>
                </div>
                <div class="panel-body">
                    <label for="Group Number" class="col-md-3 col-sm-6 col-lg-3 control-label m-t-10  text-right">Group Number : </label>
                    <label class="col-md-3 col-sm-6 col-lg-3 control-label m-t-10">
                        {!! $groupsdata['data']->group_number !!}
                    </label>
                    <label for="Group Name" class="col-md-3 col-sm-6 col-lg-3 control-label m-t-10 text-right">Group Name : </label>
                    <label class="col-md-3 col-sm-6 col-lg-3 control-label m-t-10">
                        {!! $groupsdata['data']->group_name !!}
                    </label>
                    <label for="Meeting Time" class="col-md-3 col-sm-6 col-lg-3 control-label m-t-10 text-right">Meeting Day : </label>
                    <label class="col-md-3 col-sm-6 col-lg-3 control-label m-t-10">
                        {!! $groupsdata['data']->meeting_time !!}
                        @foreach ($groupsdata['days'] as $days)
                            @if($days->id == $groupsdata['data']->meeting_day)
                                {!! $days->name!!}
                            @endif
                        @endforeach
                        @foreach ($groupsdata['meetingfrequencies'] as $meetingfrequencies)
                            @if($meetingfrequencies->id == $groupsdata['data']->meeting_frequency)
                                {!! $meetingfrequencies->name!!}
                            @endif
                        @endforeach
                    </label>

                    <!-- <label for="Preferred Mode Of Banking" class="col-md-3 col-sm-6 col-lg-3 control-label m-t-10 text-right" >Preferred Mode Of Banking : </label>
                                    <label class="col-md-3 col-sm-6 col-lg-3 control-label m-t-10">
                                                                                     @foreach ($groupsdata['bankingmodes'] as $bankingmodes)
                                                @if( $bankingmodes->id  ==  $groupsdata['data']->preferred_mode_of_banking  )
                                                
                                
                                                {!! $bankingmodes->name!!}
                                                @endif
                                                @endforeach
                                        
                                    </label> -->



                    <!--                                 
                                    <label for="Registration Date" class="col-md-3 col-sm-6 col-lg-3 control-label m-t-10  text-right">Registration Date : </label>
                                    <label class="col-md-3 col-sm-6 col-lg-3 control-label m-t-10">
                                        {!! $groupsdata['data']->registration_date !!}
                                    </label> -->


                    <!-- <label for="Group Formation Date" class="col-md-3 col-sm-6 col-lg-3 control-label m-t-10  text-right">Group Formation Date : </label>
                                    <label class="col-md-3 col-sm-6 col-lg-3 control-label m-t-10">
                                        {!! $groupsdata['data']->group_formation_date !!}
                                    </label> -->


                    <!-- <label for="Officer" class="col-md-3 col-sm-6 col-lg-3 control-label m-t-10 text-right">Officer : </label>
                                    <label class="col-md-3 col-sm-6 col-lg-3 control-label m-t-10">
                                        
                                                                        @foreach ($groupsdata['employees'] as $employees)
                                                @if( $employees->id  ==  $groupsdata['data']->officer  )
                                        
                                
                                                {!! $employees->employee_number!!}
                                                {!! $employees->first_name!!}
                                                {!! $employees->middle_name!!}
                                                {!! $employees->last_name!!}
                                                @endif
                                                @endforeach
                                        
                                    </label> -->

                    <!-- @foreach($groupsdata['clientroles'] as $clientrole)

                        @foreach($groupsdata['grouproles'] as $role)
                        
                            @if($role->id==$clientrole->group_role)
                            <label for="Group Formation Date" class="col-md-3 col-sm-6 col-lg-3 control-label m-t-10  text-right">{!!$role->name!!} :  </label>
                            @endif
                        @endforeach
                        @foreach($groupsdata['clients'] as $client)

                            @if($client->id==$clientrole->client)
                            <label class="col-md-3 col-sm-6 col-lg-3 control-label m-t-10">
                                {!! $client->client_number !!} {!! $client->first_name !!} {!! $client->middle_name !!} {!! $client->last_name !!}
                            </label>
                            @endif
                        @endforeach
                    @endforeach                         -->
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-inverse">
                <div class="panel-heading hidden-print">
                    <div class="panel-heading-btn">
                        <a href="#" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                        <a href="#" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                        <a href="#" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                        <a href="#" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                    </div>
                    <h4 class="panel-title hidden-print">PTR</h4>
                </div>

                <form action="{{route('groupcontributions.update',$groupsdata['data']->id)}}" method="post">
                    <!-- <div class="panel-body hidden-print">
                    <input type="hidden" name="_method" value="put" />
                        {!! csrf_field() !!}
                        
                            <label for="transaction_date" class="control-label col-lg-3 m-t-10">Transaction Date</label>
                            <div class="col-lg-3 m-t-10">
                                <input type="text" name="transaction_date"  id="transaction_date" class="form-control" placeholder="Transaction Date" value="">
                            </div>
                        
                        
                            <label for="transaction_number" class="control-label col-lg-3 m-t-10">Transaction Number</label>
                            <div class="col-lg-3 m-t-10">
                                <input type="text" name="transaction_number"  id="transaction_number" class="form-control" placeholder="Transaction Number" value="">
                            </div>
                        
                            <label for="payment_mode" class="control-label col-lg-3 m-t-10 m-b-10">Payment Mode</label>
                            <div class="col-lg-3 m-t-10 m-b-10">
                                <select name="payment_mode" class="form-control">
                                    <option value="">Select Payment Mode</option>
                                    @foreach($groupsdata['paymentmodes'] as $paymentmode)
                                        <option value="{!!$paymentmode->id!!}">{!!$paymentmode->name!!}</option>
                                    @endforeach
                                </select>
                            </div>
                    </div> -->
                    <div class="panel-body">
                        <div class="invoice-company">
                            <span class="pull-right hidden-print">
                                <a href="{{ route('ptrreport.export', $groupsdata['data']->id) }}" class="btn btn-sm btn-primary m-b-10"><i class="fa fa-download m-r-5"></i> Download</a>
                                <a href="javascript:;" onclick="window.print()" class="btn btn-sm btn-info m-b-10"><i class="fa fa-print m-r-5"></i> Print</a>
                            </span>
                        </div>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>CLIENT ID</th>
                                    <th>CLIENT NAME</th>
                                    <th>LOAN NUMBER</th>
                                    <th>LOAN INCEPTION DATE</th>
                                    <th>LOAN AMOUNT</th>
                                    <th>EXPECTED PAYMENT PERIOD</th>
                                    <th>LAST PAYMENT DATE</th>
                                    <th>PAYMENT AMOUNT</th>
                                    <th>ARREARS PER PERIOD</th>
                                    <th>ARREARS AMOUNT</th>
                                    <th>NEXT PAYMENT DATE</th>
                                    <th>OLB</th>
                                    <th>LAST LGF DATE</th>
                                    <th>LGF AMOUNT</th>
                                    <th>TOTAL</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $r = 0; ?>
                                @foreach($groupsdata['clientcontributions'] as $clientcontribution)
                                    @forelse($clientcontribution['loans'] as $loan)
                                        @if($loop->first)
                                            @if(isset($clientcontribution))
                                                <tr id="<?php ++$r; echo $r; ?>">
                                                    <td>
                                                        {!! $clientcontribution['client']['client_number'] !!}
                                                    </td>
                                                    <td>
                                                        {!! $clientcontribution['client']['first_name'] !!} {!! $clientcontribution['client']['last_name'] !!}
                                                    </td>
                                                    <td>
                                                        <small>{!!$loan->loan_number!!}</small>
                                                    </td>
                                                    <td>
                                                        {!!\Carbon\Carbon::parse($loan->date)->format('d/m/Y')!!}
                                                    </td>
                                                    <td>
                                                        {!!$loan->amount ? number_format($loan->amount) : NULL!!}
                        
                                                    </td>
                                                    <td>
                                                        {!!$loan->exppay!!}
                                                    </td>
                                                    <td>
                                                        {!! $loan->lastpaydate ? \Carbon\Carbon::parse($loan->lastpaydate)->diffForHumans() : NULL !!}
                                                    </td>
                                                    <td>
                                                        {!!$loan->lastpayamount ? number_format($loan->lastpayamount) : NULL!!}
                                                    </td>
                                                @if($loan->arrears < 0)
                                                    <td>
                                                        <span class="label label-warning">
                                                            {!!$loan->arrears_period!!}
                                                        </span>
                                                    </td>
                                                @else
                                                    <td>
                                                        {!!$loan->arrears_period!!}
                                                    </td>
                                                @endif
                                                @if($loan->arrears<0)
                                                    <td>
                                                        <span class="label label-warning">
                                                            {!!$loan->arrears ? number_format($loan->arrears) : NULL!!}
                                                        </span>
                                                    </td>
                                                @else
                                                    <td>
                                                        {!!$loan->arrears ? number_format($loan->arrears) : NULL!!}
                                                    </td>
                                                @endif
                                                @if($loan->arrears < 0)
                                                    <td>
                                                        <span class="label label-warning">
                                                            {!! (new \Moment\Moment($loan->nextpay))->calendar(false) !!}
                                                        </span>
                                                    </td>
                                                @else
                                                    <td>
                                                        <?php
                                                            $loanproduct = \App\LoanProducts::find($loan->loan_product);
				
                                                            $schedules = app('App\Http\Controllers\admin\LoansController')->getloanschedule(\Carbon\Carbon::parse($loan->date), $loanproduct->graceperiodmodel->number_of_days, $loanproduct->loanpaymentfrequencymodel->number_of_days, $loanproduct->loanpaymentdurationmodel->number_of_days, $loan->total_loan_amount);

                                                            $nextpay = NULL;
                                        
                                                            foreach ($schedules as $schedule) {
                                                                $payment_date = \Carbon\Carbon::parse($schedule['date'])->toDateString();
                                                                if($payment_date >= \Carbon\Carbon::today()->toDateString()) {
                                                                    $nextpay = \Carbon\Carbon::parse($schedule['date'])->toDateString();
                                                                }
                                                            }
                                                        ?>
                                                        {{ isset($nextpay) ? \Carbon\Carbon::parse($nextpay)->diffForHumans() : \Carbon\Carbon::parse($loan->nextpay)->diffForHumans() }}
                                                    </td>
                                                @endif
                                                    <td>
                                                        {!!$loan->rembalance ? number_format($loan->rembalance) : NULL!!}
                                                    </td>
                                                    <td>
                                                        @if(isset($clientcontribution['lgf']['lastcontributiondate'])){!! \Carbon\Carbon::parse($clientcontribution['lgf']['lastcontributiondate'])->diffForHumans() !!} @endif
                                                    </td>
                                                    <td>
                                                        @if(isset($clientcontribution['lgf']['lastcontributiondate'])){!!number_format($clientcontribution['lgf']['lastcontribution'])!!} @endif
                                                    </td>
                                                    <td>
                                                        @if(isset($clientcontribution['lgf']['lastcontributiondate'])){!!number_format($clientcontribution['lgf']['totallgfcontribution'])!!} @endif
                                                    </td>
                                                </tr>
                                                @endif
                                            @else
                                                <tr id="<?php ++$r; echo $r; ?>">
                                                    <td></td>
                                                    <td></td>
                                                    <td>
                                                        {!!$loan->loan_number!!}
                                                    </td>
                                                    <td>
                                                        {!!\Carbon\Carbon::parse($loan->date)->format('jS F Y')!!}
                                                    </td>
                                                    <td>
                                                        {!!$loan->amount ? number_format($loan->amount) : NULL!!}
                        
                                                    </td>
                                                    <td>
                                                        {!!$loan->exppay!!}
                                                    </td>
                                                    <td>
                                                        {!! $loan->lastpaydate ? \Carbon\Carbon::parse($loan->lastpaydate)->diffForHumans() : NULL !!}
                                                    </td>
                                                    <td>
                                                        {!!$loan->lastpayamount ? number_format($loan->lastpayamount) : NULL!!}
                                                    </td>
                                                @if($loan->arrears < 0)
                                                    <td>
                                                        <span class="label label-warning">
                                                            {!!$loan->arrears_period!!}
                                                        </span>
                                                    </td>
                                                @else
                                                    <td>
                                                        {!!$loan->arrears_period!!}
                                                    </td>
                                                @endif
                                                @if($loan->arrears<0)
                                                    <td>
                                                        <span class="label label-warning">
                                                            {!!$loan->arrears ? number_format($loan->arrears) : NULL!!}
                                                        </span>
                                                    </td>
                                                @else
                                                    <td>
                                                        {!!$loan->arrears ? number_format($loan->arrears) : NULL!!}
                                                    </td>
                                                @endif
                                                @if($loan->arrears < 0)
                                                    <td>
                                                        <span class="label label-warning">
                                                            {!! (new \Moment\Moment($loan->nextpay))->calendar(false) !!}
                                                        </span>
                                                    </td>
                                                @else
                                                <td>
                                                    <?php
                                                        $loanproduct = \App\LoanProducts::find($loan->loan_product);
            
                                                        $schedules = app('App\Http\Controllers\admin\LoansController')->getloanschedule(\Carbon\Carbon::parse($loan->date), $loanproduct->graceperiodmodel->number_of_days, $loanproduct->loanpaymentfrequencymodel->number_of_days, $loanproduct->loanpaymentdurationmodel->number_of_days, $loan->total_loan_amount);

                                                        $nextpay = NULL;
                                    
                                                        foreach ($schedules as $schedule) {
                                                            $payment_date = \Carbon\Carbon::parse($schedule['date'])->toDateString();
                                                            if($payment_date >= \Carbon\Carbon::today()->toDateString()) {
                                                                $nextpay = \Carbon\Carbon::parse($schedule['date'])->toDateString();
                                                            }
                                                        }
                                                    ?>
                                                    {{ isset($nextpay) ? \Carbon\Carbon::parse($nextpay)->diffForHumans() : \Carbon\Carbon::parse($loan->nextpay)->diffForHumans() }}
                                                </td>
                                                @endif
                                                    <td>
                                                        {!!$loan->rembalance ? number_format($loan->rembalance) : NULL!!}
                                                    </td>
                                                    <td>
                                                        @if(isset($clientcontribution['lgf']['lastcontributiondate'])){!! \Carbon\Carbon::parse($clientcontribution['lgf']['lastcontributiondate'])->diffForHumans() !!} @endif
                                                    </td>
                                                    <td>
                                                        @if(isset($clientcontribution['lgf']['lastcontributiondate'])){!!number_format($clientcontribution['lgf']['lastcontribution'])!!} @endif
                                                    </td>
                                                    <td>
                                                        @if(isset($clientcontribution['lgf']['lastcontributiondate'])){!!number_format($clientcontribution['lgf']['totallgfcontribution'])!!} @endif
                                                    </td>
                                                </tr>
                                            @endif
                                        @empty
                                        @if(isset($clientcontribution))
                                            <tr id="<?php ++$r; echo $r; ?>">
                                                <td>
                                                    {!! $clientcontribution['client']['client_number'] !!}
                                                </td>
                                                <td>
                                                    {!! $clientcontribution['client']['first_name'] !!} {!! $clientcontribution['client']['last_name'] !!}
                                                </td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td>
                                                    @if(isset($clientcontribution['lgf']['lastcontributiondate'])){!! \Carbon\Carbon::parse($clientcontribution['lgf']['lastcontributiondate'])->diffForHumans() !!} @endif
                                                </td>
                                                <td>
                                                    @if(isset($clientcontribution['lgf']['lastcontributiondate'])){!!number_format($clientcontribution['lgf']['lastcontribution'])!!} @endif
                                                </td>
                                                <td>
                                                    @if(isset($clientcontribution['lgf']['lastcontributiondate'])){!!number_format($clientcontribution['lgf']['totallgfcontribution'])!!} @endif
                                                </td>
                                            </tr>
                                        @endif
                                    @endforelse
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </form>
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
    $("#registration_date").datepicker({
        todayHighlight: !0,
        autoclose: !0
    });
    $("#transaction_date").datepicker({
        todayHighlight: !0,
        autoclose: !0
    });

    function totalContribution() {
        var contribution = 0;
        $("#contribution-tbl tr").each(function(i, row) {
            var contributionValue = $(this).find("td .client_lgf_contribution").val();
            if (contributionValue != null && contributionValue != "") {
                contribution = contribution + Number($(this).find("td .client_lgf_contribution").val());
            }
            console.log(contribution);

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
            // console.log(otherPayment);
        });

        $("#total-other-payment").html(otherPayment);
    }

    function totalLoanPayment() {
        var loanPayment = 0;

        $("#contribution-tbl tr").each(function(i, row) {
            var loanPaymentValue = $(this).find("td .loan_payment").val();

            if (loanPaymentValue != null && loanPaymentValue != "") {
                loanPayment = loanPayment + Number($(this).find("td .loan_payment").val());
            }
            // console.log(loanPayment);
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

        var row = $("<tr id='" + lastAddedRow + "'><td><input type=\"hidden\" name=\"client[]\" value=\"" + client + "\"/><input type=\"hidden\" name=\"loan_payment[]\"><input type=\"hidden\" name=\"loan[]\" value=\"\"/></td><td> </td><td></td><td></td><td></td><td><input type=\"hidden\" name=\"client_lgf_contribution[]\" class=\"client_lgf_contribution\" onchange=\"totalContribution()\"></td><td></td><td><select name=\"other_payment_type[]\"><option>Select Type</option>@foreach($groupsdata['otherpaymenttypes'] as $otherpaymenttypes)<option value=\"{{$otherpaymenttypes->id}}\">{{$otherpaymenttypes->name}}</option>@endforeach</select></td><td><input type=\"text\" name=\"other_payment[]\"  class=\"other_payment\" onchange=\"totalOtherPayment()\"></td><td><button type=\"button\" name=\"add-other-payment\" class=\"remove-other-payment btn-danger  m-b-2 m-r-2 \"  onclick=\"removeOtherPayment('" + lastAddedRow + "','" + client + "')\"><i class=\"fa fa-minus\"></i></button><button type=\"button\" name=\"add-other-payment\" class=\"add-other-payment btn-primary\"  onclick=\"addOtherPayment('" + lastAddedRow + "','" + client + "')\"><i class=\"fa fa-plus\"></i></button></td></tr> ");

        row.insertAfter($("tr#" + currentRow));
    }

    function removeOtherPayment(currentRow, client) {
        $("tr#" + currentRow).remove();
    }
</script>
@endsection