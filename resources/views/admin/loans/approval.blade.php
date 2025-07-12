@extends("admin.home")
@section("main_content")
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
            <a href="{!! route('loans.index') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-arrow-left"></i></button></a>
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
                    <h4 class="panel-title">DataForm - Autofill</h4>
                </div>
                <div class="panel-body">
                    <form action="{!! route('loans.update',$loansdata['data']->id) !!}" method="POST" >
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
                                                @foreach ($loansdata['loanproducts'] as $loanproducts)
                                                @if( $loanproducts->id  ==  $loansdata['data']->loan_product  )
                                                <!-- <option selected value="{!! $loanproducts->id !!}" > -->
                                
                                                {!! $loanproducts->name!!}
                                                @else
                                                <!-- <option value="{!! $loanproducts->id !!}" > -->
                                
                                                {!! $loanproducts->name!!}
                                                @endif
                                                @endforeach
                                            </label>
                                                                            
                                        <!-- </select> -->
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Client" class="col-md-3 m-t-10 control-label">Client</label>
                                    <div class="col-md-3 m-t-10">
                                        <label>
                                        @foreach ($loansdata['clients'] as $clients)
                                                @if( $clients->id  ==  $loansdata['data']->client  )
                                                
                                
                                                {!! $clients->client_number!!}
                                                {!! $clients->first_name!!}
                                                {!! $clients->middle_name!!}
                                                {!! $clients->last_name!!}
                                                @endif
                                                @endforeach                                            
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Date" class="col-md-3 m-t-10 control-label">Date</label>
                                    <div class="col-md-3 m-t-10">
                                        <label>{!! $loansdata['data']->date !!}</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Amount" class="col-md-3 m-t-10 control-label">Amount</label>
                                    <div class="col-md-3 m-t-10">
                                        <label>{!! $loansdata['data']->amount !!}</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Interest Rate Type" class="col-md-3 m-t-10 control-label">Interest Rate Type</label>
                                    <div class="col-md-3 m-t-10">
                                        <label>@foreach ($loansdata['interestratetypes'] as $interestratetypes)
                                                @if( $interestratetypes->id  ==  $loansdata['data']->interest_rate_type  )
                                                
                                
                                                {!! $interestratetypes->name!!}
                                                @endif
                                                @endforeach</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Interest Rate" class="col-md-3 m-t-10 control-label">Interest Rate</label>
                                    <div class="col-md-3 m-t-10">
                                        <label>{!! $loansdata['data']->interest_rate !!}</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Interest Payment Method" class="col-md-3 m-t-10 control-label">Interest Payment Method</label>
                                    <div class="col-md-3 m-t-10">
                                        <label>
                                            @foreach ($loansdata['interestpaymentmethods'] as $interestpaymentmethods)
                                                @if( $interestpaymentmethods->id  ==  $loansdata['data']->interest_payment_method  )
                                                {!! $interestpaymentmethods->name!!}
                                                @endif
                                                @endforeach

                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Loan Payment Duration" class="col-md-3 m-t-10 control-label">Loan Payment Duration</label>
                                    <div class="col-md-3 m-t-10">
                                        <label>
                                            @foreach ($loansdata['loanpaymentdurations'] as $loanpaymentdurations)
                                                @if( $loanpaymentdurations->id  ==  $loansdata['data']->loan_payment_duration  )
                                               
                                
                                                {!! $loanpaymentdurations->name!!}
                                                @endif
                                                @endforeach

                                        </label>
			                                                                        
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Loan Payment Frequency" class="col-md-3 m-t-10 control-label">Loan Payment Frequency</label>
                                    <div class="col-md-3 m-t-10">
                                        <label>
                                            @foreach ($loansdata['loanpaymentfrequencies'] as $loanpaymentfrequencies)
                                                @if( $loanpaymentfrequencies->id  ==  $loansdata['data']->loan_payment_frequency  )
                                
                                                {!! $loanpaymentfrequencies->name!!}
                                                
                                                @endif
                                                @endforeach

                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Grace Period" class="col-md-3 m-t-10 control-label">Grace Period</label>
                                    <div class="col-md-3 m-t-10">
                                        <label>@foreach ($loansdata['graceperiods'] as $graceperiods)
                                                @if( $graceperiods->id  ==  $loansdata['data']->grace_period  )
                                                
                                
                                                {!! $graceperiods->name!!}
                                                @endif
                                                @endforeach</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Interest Charged" class="col-md-3 m-t-10 control-label">Interest Charged</label>
                                    <div class="col-md-3 m-t-10">
                                        <label>{!! $loansdata['data']->interest_charged !!}</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Total Loan Amount" class="col-md-3 m-t-10 control-label">Total Loan Amount</label>
                                    <div class="col-md-3 m-t-10">
                                        <label>{!! $loansdata['data']->total_loan_amount !!}</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Amount To Be Disbursed" class="col-md-3 m-t-10 control-label">Amount To Be Disbursed</label>
                                    <div class="col-md-3 m-t-10">
                                        <label>{!! $loansdata['data']->amount_to_be_disbursed !!}</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Mode Of Disbursement" class="col-md-3 m-t-10 control-label">Mode Of Disbursement</label>
                                    <div class="col-md-3 m-t-10">
                                        <label>
                                            @foreach ($loansdata['disbursementmodes'] as $disbursementmodes)
                                                @if( $disbursementmodes->id  ==  $loansdata['data']->mode_of_disbursement  )
                                                
                                
                                                {!! $disbursementmodes->name!!}
                                                
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
                                    <label for="Insurance Deduction Fee" class="col-md-3 m-t-10 control-label">Insurance Deduction Fee</label>
                                    <div class="col-md-3 m-t-10">
                                        <label>{!! $loansdata['data']->insurance_deduction_fee !!}</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Fine Type" class="col-md-3 m-t-10 control-label">Fine Type</label>
                                    <div class="col-md-3 m-t-10">
									    <label>@foreach ($loansdata['finetypes'] as $finetypes)
                                                @if( $finetypes->id  ==  $loansdata['data']->fine_type  )
                                                
                                
                                                {!! $finetypes->name!!}
                                                @endif
                                                @endforeach</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Fine Charge" class="col-md-3 m-t-10 control-label">Fine Charge</label>
                                    <div class="col-md-3 m-t-10">
                                        <label>{!! $loansdata['data']->fine_charge !!}</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Fine Charge Frequency" class="col-md-3 m-t-10 control-label">Fine Charge Frequency</label>
                                    <div class="col-md-3 m-t-10">
									    <label>
                                            @foreach ($loansdata['finechargefrequencies'] as $finechargefrequencies)
                                                @if( $finechargefrequencies->id  ==  $loansdata['data']->fine_charge_frequency  )
                                                
                                
                                                {!! $finechargefrequencies->name!!}
                                                @endif
                                                @endforeach                           
                                        </label>
                                        
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Fine Charge Period" class="col-md-3 m-t-10 control-label">Fine Charge Period</label>
                                    <div class="col-md-3 m-t-10">
									    <label>
                                            @foreach ($loansdata['finechargeperiods'] as $finechargeperiods)
                                                @if( $finechargeperiods->id  ==  $loansdata['data']->fine_charge_period  )
                                
                                                {!! $finechargeperiods->name!!}
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
                                                @if( $loanstatuses->id  ==  $loansdata['data']->status  )
                                
                                                {!! $loanstatuses->name!!}
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

    @if(isset($loansdata['approval'][0]))
        @foreach($loansdata['approval'] as $approval)
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
                        <form class="form-horizontal">
                        
                            <div class="form-group">
                                <label for="Grace Period" class="col-md-3 m-t-10 control-label">Approval Level</label>
                                
                                    
                                    <label class="col-md-3 m-t-10 control-label  text-left">@foreach ($loansdata['approvallevels'] as $approvallevel)
                                            @if( $approvallevel->id  ==  $approval[0]->level )
                                            
                            
                                            {!! $approvallevel->name!!}
                                            @endif
                                            @endforeach</label>
                                    
                                
                            </div>                           
                            <div class="form-group">
                                <label for="Grace Period" class="col-md-3 m-t-10 control-label">Approval Account</label>
                                
                                    
                                    <label class="col-md-3 m-t-10 control-label  text-left">@foreach ($loansdata['usersaccounts'] as $useraccount)
                                            @if( $useraccount->id  ==  $approval[0]->user_account )
                                            
                            
                                            {!! $useraccount->name!!}
                                            @endif
                                            @endforeach</label>
                                    
                                
                            </div>   

                            <div class="form-group">
                                <label for="Grace Period" class="col-md-3 m-t-10 control-label">Approved By</label>
                                
                                    
                                    <label  class="col-md-3 m-t-10 control-label  text-left">
                                    @if(isset($loansdata[0]))
                                        @foreach($loansdata['loanapprovals'] as $loanApproval)
                                            @if($approval[0]->level==$loanApproval->level)
                                                @foreach($loansdata['users'] as $user)
                                                    @if($loanApproval->user==$user->id)
                                                        {!!$user->name!!}
                                                    @endif
                                                @endforeach                                        
                                            @endif
                                        @endforeach
                                    @endif
                                </label>
                                    
                                
                            </div>   

                            <div class="form-group">
                                <label for="Grace Period" class="col-md-3 m-t-10 control-label">Comments</label>
                                <label  class="col-md-9 m-t-10 control-label text-left">
                                    @if(isset($loansdata[0]))
                                        @foreach($loansdata['loanapprovals'] as $loanApproval)
                                            @if($approval[0]->level==$loanApproval->level)
                                                {!!$loanApproval->comment!!}                                       
                                            @endif
                                        @endforeach                
                                    @endif                               
                                </label>
                                    
                                
                            </div>   
                            <div class="form-group">
                                <label for="Grace Period" class="col-md-3 m-t-10 control-label">Status</label>
                                <label  class="col-md-9 m-t-10 control-label text-left">
                                Pending                              
                                </label>
                                    
                                
                            </div>   

                          </form>
                        
                    </div>
                </div>
            </div>
        </div>            
        @endforeach
    @endif            

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
                    <form action="{!! url('/admin/approveloan/') !!}" method="POST"  class="form-horizontal">
                        {!! csrf_field() !!}
                        <div class="form-group">
                            <label for="Grace Period" class="col-md-3 m-t-10 control-label">Approval Level</label>
                            
                                
                                <label class="col-md-3 m-t-10 control-label text-left">@foreach ($loansdata['approvallevels'] as $approvallevel)
                                        @if( $approvallevel->id  ==  $loansdata['myapproval'][0][0]['level'] )
                                        
                        
                                        {!! $approvallevel->name!!}
                                        @endif
                                        @endforeach</label>
                                
                            
                        </div>                           
                        <div class="form-group m-t-10">
                            <label for="Grace Period" class="col-md-3 control-label">Approval Account</label>
                            
                                
                                <label class="col-md-3 m-t-10 control-label text-left">@foreach ($loansdata['usersaccounts'] as $useraccount)
                                        @if( $useraccount->id  ==  $loansdata['myapproval'][0][0]['user_account'] )
                                        
                        
                                        {!! $useraccount->name!!}
                                        @endif
                                        @endforeach</label>
                                
                            
                        </div>   

                        <div class="form-group">
                            <label for="Grace Period" class="col-md-3 m-t-10 control-label">Approved By</label>
                            
                                
                                <label class="col-md-3 m-t-10 control-label  text-left">
                                @if(isset($loansdata[0]))
                                    @foreach($loansdata['loanapprovals'] as $loanApproval)
                                        @if($loansdata['myapproval'][0][0]['level']==$loanApproval->level)
                                            @foreach($loansdata['users'] as $user)
                                                @if($loanApproval->user==$user->id)
                                                    {!!$user->name!!}
                                                @endif
                                            @endforeach                                        
                                        @endif
                                    @endforeach
                                @endif
                            </label>
                                
                            
                        </div>   

                        <div class="form-group">
                            <label for="Grace Period" class="col-md-3 m-t-10 control-label">Comments</label>
                            <div class="col-md-3 m-t-10">
                                @if(isset($loansdata[0]))
                                    @foreach($loansdata['loanapprovals'] as $loanApproval)
                                        @if($loansdata['myapproval'][0][0]['level']==$loanApproval->level)
                                            {!!$loanApproval->comment!!}                                       
                                        @endif
                                    @endforeach
                                @else
                                    @if($loansdata['user'][0]->user_account==$loansdata['myapproval'][0][0]['user_account'])
                                        <input type="hidden" name="user" value="{{$loansdata['user'][0]->id}}">
                                        <input type="hidden" name="loan" value="{{$loansdata['data']->id}}">
                                        <input type="hidden" name="user_account" value="{{$loansdata['user'][0]->user_account}}">
                                        <input type="hidden" name="level" value="{{$loansdata['myapproval'][0][0]['level']}}">
                                        <input type="hidden" name="user" value="{{$loansdata['user'][0]->id}}">
                                        <input type="hidden" name="date" value="">
                                        <textarea cols="80" rows="10" name="comment">
                                            
                                        </textarea>                                    
                                    @endif                 
                                @endif                               
                                
                            </div>
                        </div>   
                        <div class="form-group">
                            <label class="col-md-3 m-t-10 control-label">Status</label>
                            <div class="col-md-3">
                                @foreach($loansdata['approvalstatuses'] as $approvalStatus)
                                {{$approvalStatus->name}}
                                <input type="radio" name="status" value="{{$approvalStatus->id}}">
                                @endforeach
                            </div>

                        </div>                         

                        <div class="form-group">
                            <label class="col-md-3"></label>
                            <div class="col-md-3">
                                <button class="btn btn-primary" type="submit" >Submit</button>
                                
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
$("#date").datepicker({todayHighlight:!0,autoclose:!0});
</script>
@endsection