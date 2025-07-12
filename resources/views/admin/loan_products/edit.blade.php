@extends("admin.home")
@section("main_content")
<div id="content" class="content">
    <ol class="breadcrumb pull-right">
        <li><a href="#">Home</a></li>
        <li><a href="#">public</a></li>
        <li><a href="#">Loan Products</a></li>
        <li class="active">form</li>
    </ol>
    <h1 class="page-header">Loan Products Update Form <small>loan products details goes here...</small></h1>
    <div class="row">
        <div class="col-md-12">
            <a href="{!! route('loanproducts.index') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-arrow-left"></i></button></a>
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
                    <form action="{!! route('loanproducts.update',$loanproductsdata['data']->id) !!}" method="POST" class="">
<input type="hidden" name="_method" value="put" />
                        {!! csrf_field() !!}
                                <div class="form-group">
                                    <label for="Code" class="col-md-3 m-t-10 control-label">Code</label>
                                    <div class="col-md-3 m-t-10">
                                        <input type="text" name="code" id="code" class="form-control" placeholder="Code" value="{!! $loanproductsdata['data']->code !!}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Name" class="col-md-3 m-t-10 control-label">Name</label>
                                    <div class="col-md-3 m-t-10">
                                        <input type="text" name="name" id="name" class="form-control" placeholder="Name" value="{!! $loanproductsdata['data']->name !!}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Description" class="col-md-3 m-t-10 control-label">Description</label>
                                    <div class="col-md-3 m-t-10">
                                        <input type="text" name="description" id="description" class="form-control" placeholder="Description" value="{!! $loanproductsdata['data']->description !!}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="Mode Of Disbursement" class="col-md-3 m-t-10 control-label">Mode Of Disbursement</label>
                                    <div class="col-md-3 m-t-10">
									    <select class="form-control" name="mode_of_disbursement" id="mode_of_disbursement">
                                            <option value="" >Select Mode Of Disbursement</option>				                                @foreach ($loanproductsdata['disbursementmodes'] as $disbursementmodes)
				                                @if( $disbursementmodes->id  ==  $loanproductsdata['data']->mode_of_disbursement  ){
				                                <option selected value="{!! $disbursementmodes->id !!}" >
								
				                                {!! $disbursementmodes->name!!}
				                                </option>@else
				                                <option value="{!! $disbursementmodes->id !!}" >
								
				                                {!! $disbursementmodes->name!!}
				                                </option>@endif
				                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Fine Type" class="col-md-3 m-t-10 control-label">Fine Type</label>
                                    <div class="col-md-3 m-t-10">
									    <select class="form-control" name="fine_type" id="fine_type">
                                            <option value="" >Select Fine Type</option>				                                @foreach ($loanproductsdata['finetypes'] as $finetypes)
				                                @if( $finetypes->id  ==  $loanproductsdata['data']->fine_type  ){
				                                <option selected value="{!! $finetypes->id !!}" >
								
				                                {!! $finetypes->name!!}
				                                </option>@else
				                                <option value="{!! $finetypes->id !!}" >
								
				                                {!! $finetypes->name!!}
				                                </option>@endif
				                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Fine Charge" class="col-md-3 m-t-10 control-label">Fine Charge</label>
                                    <div class="col-md-3 m-t-10">
                                        <input type="text" name="fine_charge" id="fine_charge" class="form-control" placeholder="Fine Charge" value="{!! $loanproductsdata['data']->fine_charge !!}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Fine Charge Frequency" class="col-md-3 m-t-10 control-label">Fine Charge Frequency</label>
                                    <div class="col-md-3 m-t-10">
									    <select class="form-control" name="fine_charge_frequency" id="fine_charge_frequency">
                                            <option value="" >Select Fine Charge Frequency</option>				                                @foreach ($loanproductsdata['finechargefrequencies'] as $finechargefrequencies)
				                                @if( $finechargefrequencies->id  ==  $loanproductsdata['data']->fine_charge_frequency  ){
				                                <option selected value="{!! $finechargefrequencies->id !!}" >
								
				                                {!! $finechargefrequencies->name!!}
				                                </option>@else
				                                <option value="{!! $finechargefrequencies->id !!}" >
								
				                                {!! $finechargefrequencies->name!!}
				                                </option>@endif
				                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Fine Charge Period" class="col-md-3 m-t-10 control-label">Fine Charge Period</label>
                                    <div class="col-md-3 m-t-10">
									    <select class="form-control" name="fine_charge_period" id="fine_charge_period">
                                            <option value="" >Select Fine Charge Period</option>				                                @foreach ($loanproductsdata['finechargeperiods'] as $finechargeperiods)
				                                @if( $finechargeperiods->id  ==  $loanproductsdata['data']->fine_charge_period  ){
				                                <option selected value="{!! $finechargeperiods->id !!}" >
								
				                                {!! $finechargeperiods->name!!}
				                                </option>@else
				                                <option value="{!! $finechargeperiods->id !!}" >
								
				                                {!! $finechargeperiods->name!!}
				                                </option>@endif
				                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Interest Rate Type" class="col-md-3 m-t-10 control-label">Interest Rate Type</label>
                                    <div class="col-md-3 m-t-10">
									    <select class="form-control" name="interest_rate_type" id="interest_rate_type">
                                            <option value="" >Select Interest Rate Type</option>				                                @foreach ($loanproductsdata['interestratetypes'] as $interestratetypes)
				                                @if( $interestratetypes->id  ==  $loanproductsdata['data']->interest_rate_type  ){
				                                <option selected value="{!! $interestratetypes->id !!}" >
								
				                                {!! $interestratetypes->name!!}
				                                </option>@else
				                                <option value="{!! $interestratetypes->id !!}" >
								
				                                {!! $interestratetypes->name!!}
				                                </option>@endif
				                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Compounds Per Year" class="col-md-3 m-t-10 control-label">Compounds Per Year</label>
                                    <div class="col-md-3 m-t-10">
                                        <input type="text" name="compounds_per_year" id="compounds_per_year" class="form-control" placeholder="Compounds Per Year" value="{!! $loanproductsdata['data']->compounds_per_year !!}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Interest Rate" class="col-md-3 m-t-10 control-label">Interest Rate</label>
                                    <div class="col-md-3 m-t-10">
                                        <input type="text" name="interest_rate" id="interest_rate" class="form-control" placeholder="Interest Rate" value="{!! $loanproductsdata['data']->interest_rate !!}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Interest Payment Method" class="col-md-3 m-t-10 control-label">Interest Payment Method</label>
                                    <div class="col-md-3 m-t-10">
									    <select class="form-control" name="interest_payment_method" id="interest_payment_method">
                                            <option value="" >Select Interest Payment Method</option>				                                @foreach ($loanproductsdata['interestpaymentmethods'] as $interestpaymentmethods)
				                                @if( $interestpaymentmethods->id  ==  $loanproductsdata['data']->interest_payment_method  ){
				                                <option selected value="{!! $interestpaymentmethods->id !!}" >
								
				                                {!! $interestpaymentmethods->name!!}
				                                </option>@else
				                                <option value="{!! $interestpaymentmethods->id !!}" >
								
				                                {!! $interestpaymentmethods->name!!}
				                                </option>@endif
				                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Initial Deposit" class="col-md-3 m-t-10 control-label">Initial Deposit</label>
                                    <div class="col-md-3 m-t-10">
                                        <input type="text" name="initial_deposit" id="initial_deposit" class="form-control" placeholder="Initial Deposit" value="{!! $loanproductsdata['data']->initial_deposit !!}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Loan Payment Duration" class="col-md-3 m-t-10 control-label">Loan Payment Duration</label>
                                    <div class="col-md-3 m-t-10">
									    <select class="form-control" name="loan_payment_duration" id="loan_payment_duration">
                                            <option value="" >Select Loan Payment Duration</option>				                                @foreach ($loanproductsdata['loanpaymentdurations'] as $loanpaymentdurations)
				                                @if( $loanpaymentdurations->id  ==  $loanproductsdata['data']->loan_payment_duration  ){
				                                <option selected value="{!! $loanpaymentdurations->id !!}" >
								
				                                {!! $loanpaymentdurations->name!!}
				                                </option>@else
				                                <option value="{!! $loanpaymentdurations->id !!}" >
								
				                                {!! $loanpaymentdurations->name!!}
				                                </option>@endif
				                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Minimum Loan Amount" class="col-md-3 m-t-10 control-label">Minimum Loan Amount</label>
                                    <div class="col-md-3 m-t-10">
                                        <input type="text" name="minimum_loan_amount" id="minimum_loan_amount" class="form-control" placeholder="Minimum Loan Amount" value="{!! $loanproductsdata['data']->minimum_loan_amount !!}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Maximum Loan Amount" class="col-md-3 m-t-10 control-label">Maximum Loan Amount</label>
                                    <div class="col-md-3 m-t-10">
                                        <input type="text" name="maximum_loan_amount" id="maximum_loan_amount" class="form-control" placeholder="Maximum Loan Amount" value="{!! $loanproductsdata['data']->maximum_loan_amount !!}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Can Change Disbursement Mode" class="col-md-3 m-t-10 control-label">Can Change Disbursement Mode</label>
                                    <div class="col-md-3 m-t-10">
                                        @if($loanproductsdata['data']->can_change_disbursement_mode == '1')
                                        <input type="checkbox" name="can_change_disbursement_mode" id="can_change_disbursement_mode" placeholder="Can Change Disbursement Mode" checked value="{!! $loanproductsdata['data']->can_change_disbursement_mode !!}">
                                        @else
                                        <input type="checkbox" name="can_change_disbursement_mode" id="can_change_disbursement_mode"  placeholder="Can Change Disbursement Mode" value="{!! $loanproductsdata['data']->can_change_disbursement_mode !!}">
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Can Access Another Loan" class="col-md-3 m-t-10 control-label">Can Access Another Loan</label>
                                    <div class="col-md-3 m-t-10">
                                        @if($loanproductsdata['data']->can_access_another_loan == '1')
                                        <input type="checkbox" name="can_access_another_loan" id="can_access_another_loan" placeholder="Can Access Another Loan" checked value="{!! $loanproductsdata['data']->can_access_another_loan !!}">
                                        @else
                                        <input type="checkbox" name="can_access_another_loan" id="can_access_another_loan"  placeholder="Can Access Another Loan" value="{!! $loanproductsdata['data']->can_access_another_loan !!}">
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Clearing Fee" class="col-md-3 m-t-10 control-label">Clearing Fee</label>
                                    <div class="col-md-3 m-t-10">
                                        <input type="text" name="clearing_fee" id="clearing_fee" class="form-control" placeholder="Clearing Fee" value="{!! $loanproductsdata['data']->clearing_fee !!}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Number Of Guarantors" class="col-md-3 m-t-10 control-label">Number Of Guarantors</label>
                                    <div class="col-md-3 m-t-10">
                                        <input type="text" name="number_of_guarantors" id="number_of_guarantors" class="form-control" placeholder="Number Of Guarantors" value="{!! $loanproductsdata['data']->number_of_guarantors !!}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Minimum Membership Period" class="col-md-3 m-t-10 control-label">Minimum Membership Period</label>
                                    <div class="col-md-3 m-t-10">
									    <select class="form-control" name="minimum_membership_period" id="minimum_membership_period">
                                            <option value="" >Select Minimum Membership Period</option>				                                @foreach ($loanproductsdata['minimummembershipperiods'] as $minimummembershipperiods)
				                                @if( $minimummembershipperiods->id  ==  $loanproductsdata['data']->minimum_membership_period  ){
				                                <option selected value="{!! $minimummembershipperiods->id !!}" >
								
				                                {!! $minimummembershipperiods->name!!}
				                                </option>@else
				                                <option value="{!! $minimummembershipperiods->id !!}" >
								
				                                {!! $minimummembershipperiods->name!!}
				                                </option>@endif
				                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Insurance Deduction Fee" class="col-md-3 m-t-10 control-label">Insurance Deduction Fee</label>
                                    <div class="col-md-3 m-t-10">
                                        <input type="text" name="insurance_deduction_fee" id="insurance_deduction_fee" class="form-control" placeholder="Insurance Deduction Fee" value="{!! $loanproductsdata['data']->insurance_deduction_fee !!}">
                                    </div>
                                </div>

                                <div class="form-group" >
                                    <label for="Grace Period Type" class="col-md-3 m-t-10 control-label text-right">Grace Period Type</label>
                                    <div class="col-md-3 m-t-10">
                                        <select class="form-control" name="grace_period_type"  id="grace_period_type" onchange="gracePeriodType()">
                                            <option value="" >Select Grace Period Type</option>                                              @foreach ($loanproductsdata['graceperiodtypes'] as $graceperiodtypes)
                                                @if( $graceperiodtypes->id  ==  $loanproductsdata['data']->grace_period_type  ){
                                                <option selected value="{!! $graceperiodtypes->id !!}" >
                                
                                                {!! $graceperiodtypes->name!!}
                                                </option>@else
                                                <option value="{!! $graceperiodtypes->id !!}" >
                                
                                                {!! $graceperiodtypes->name!!}
                                                </option>@endif                                               @endforeach
                                        </select>
                                    </div>
                                </div>    
                                @if(isset($loanproductsdata['data']->grace_period))                                
                                <div class="form-group" id="grace_period_container">
                                    <label for="Grace Period" class="col-md-3 m-t-10 control-label text-right">Grace Period</label>
                                    <div class="col-md-3 m-t-10">
                                        <select class="form-control" name="grace_period"  id="grace_period">
                                            <option value="" >Select Grace Period</option>                                              @foreach ($loanproductsdata['graceperiods'] as $graceperiods)
                                                @if( $graceperiods->id  ==  $loanproductsdata['data']->grace_period  ){
                                                <option selected value="{!! $graceperiods->id !!}" >
                                
                                                {!! $graceperiods->name!!}
                                                </option>@else
                                                <option value="{!! $graceperiods->id !!}" >
                                
                                                {!! $graceperiods->name!!}
                                                </option>@endif                                               @endforeach
                                        </select>
                                    </div>
                                </div>
                                @endif
                                @if(isset($loanproductsdata['data']->min_grace_period))
                                <div class="form-group" id="min_grace_period_container">
                                    <label for="Min Grace Period" class="col-md-3 m-t-10 control-label text-right">Min Grace Period</label>
                                    <div class="col-md-3 m-t-10">
                                        <select class="form-control" name="min_grace_period"  id="min_grace_period">
                                            <option value="" >Select Min Grace Period</option>                                              @foreach ($loanproductsdata['graceperiods'] as $graceperiods)
                                                @if( $graceperiods->id  ==  $loanproductsdata['data']->min_grace_period  ){
                                                <option selected value="{!! $graceperiods->id !!}" >
                                
                                                {!! $graceperiods->name!!}
                                                </option>@else
                                                <option value="{!! $graceperiods->id !!}" >
                                
                                                {!! $graceperiods->name!!}
                                                </option>@endif                                                @endforeach
                                        </select>

                                    </div>
                                </div>
                                @endif
                                @if(isset($loanproductsdata['data']->max_grace_period))
                                <div class="form-group" id="max_grace_period_container">
                                    <label for="Max Grace Period" class="col-md-3 m-t-10 control-label text-right">Max Grace Period</label>
                                    <div class="col-md-3 m-t-10">
                                        <select class="form-control" name="max_grace_period"  id="max_grace_period">
                                            <option value="" >Select Max Grace Period</option>                                              @foreach ($loanproductsdata['graceperiods'] as $graceperiods)
                                                @if( $graceperiods->id  ==  $loanproductsdata['data']->max_grace_period  ){
                                                <option selected value="{!! $graceperiods->id !!}" >
                                                {!! $graceperiods->name!!}
                                                </option>@else
                                                <option value="{!! $graceperiods->id !!}" >
                                                {!! $graceperiods->name!!}
                                                </option>@endif                                                @endforeach
                                        </select>

                                    </div>
                                </div>
                                @endif
                                
                                <div class="form-group">
                                    <div class="col-sm-offset-3 col-md-3 m-t-10">
                                    <div class="col-sm-offset-3 col-md-3 m-t-10">
                                        <button type="submit" class="btn btn-sm btn-primary">
                                            <i class="fa fa-btn fa-plus"></i> Edit Loan Products
                                        </button>
                                    </div>
                                </div>
                              <div class="form-group">
                                 <label for="Can Access Another Loan" class="col-md-3 m-t-10 control-label text-right">Is Asset Product</label>
                                 <div class="col-md-3 m-t-10">
                                    <select class="form-control"name="can_access_another_loan"  id="can_access_another_loan">
                                       <option value=""  >Select Option</option>
                                       <option value="1">Yes</option>
                                       <option value="0">No</option>
                                    </select>
                                 </div>
                              </div>   
                              <div class="form-group">
                                 <label for="Asset" class="col-md-3 m-t-10 control-label text-right">Asset</label>
                                 <div class="col-md-3 m-t-10">
                                    <select class="form-control" name="asset"  id="asset">
                                       <option value=""  >Select Asset</option>
                                       @foreach ($loanproductsdata['assets'] as $asset)
                                       <option value="{!! $asset->id !!}">
                                          {!! $asset->name!!}
                                       </option>
                                       @endforeach
                                    </select>
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
                        <a href="#" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                        <a href="#" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                        <a href="#" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                        <a href="#" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                    </div>
                    <h4 class="panel-title">Client Types Configuration</h4>
                </div>
                <div class="panel-body">
                    <table id="client_types" class="table table-striped table-bordered">
                        <thead>
                                    <tr>
                                        <th>Code</th>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Can Access</th>
                                                                          </tr>
                        </thead>
                        <tbody>
                        @foreach ($loanproductsdata['clienttypes'] as $clienttypes)
                            <tr>
                                <td class='table-text'><div>
                                    {!! $clienttypes->code !!}
                                </div></td>
                                <td class='table-text'><div>
                                    {!! $clienttypes->name !!}
                                </div></td>
                                <td class='table-text'><div>
                                    {!! $clienttypes->description !!}
                                </div></td>
                                <td>
                                    
                                    @if(isset($loanproductsdata['productclienttypes'][0]))
                                        @foreach($loanproductsdata['productclienttypes'] as $productclienttype)
                                            @if($productclienttype->client_type==$clienttypes->id)
                                                <input type="checkbox" name="client_type_config[]" value="{{$productclienttype->client_type}}" checked/>
                                                @break
                                            @else
                                            
                                                @if($loop->last)
                                                    <input type="checkbox" name="client_type_config[]" value="{{$productclienttype->client_type}}"/>
                                                @endif
                                                
                                            @endif
                                        @endforeach


                                    @else
                                        <input type="checkbox" name="client_type_config[]" value="1"/>                                    
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
                    <h4 class="panel-title">User Accounts Configuration</h4>
                </div>
                <div class="panel-body">
                    <table id="user-accounts-table" class="table table-striped table-bordered">
                        <thead>
                                    <tr>
                                        <th>Code</th>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Can Initiate</th>                                    </tr>
                        </thead>
                        <tbody>
                        @foreach ($loanproductsdata['usersaccounts'] as $useraccount)
                            <tr>
                                <td class='table-text'><div>
                                    {!! $useraccount->code !!}
                                </div></td>
                                <td class='table-text'><div>
                                    {!! $useraccount->name !!}
                                </div></td>
                                <td class='table-text'><div>
                                    {!! $useraccount->description !!}
                                </div></td>
                                <td>
                                    @if(isset($loanproductsdata['productuseraccounts'][0]))
                                        @foreach($loanproductsdata['productuseraccounts'] as $productuseraccount)
                                            @if($productuseraccount->user_account==$useraccount->id)
                                                <input type="checkbox" name="user_account_config[]" value="1" checked/>
                                                @break
                                            @else
                                                @if($loop->last)
                                                    <input type="checkbox" name="user_account_config[]" value="1" />    
                                                @endif                                    
                                            
                                            @endif
                                        @endforeach

                                    @else
                                        <input type="checkbox" name="user_account_config[]" value="1" />                                        

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
                    <h4 class="panel-title">Modes Of Disbursements</h4>
                </div>
                <div class="panel-body">
                    <table id="disbursement-modes-table" class="table table-striped table-bordered">
                        <thead>
                                    <tr>
                                        <th>Code</th>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Action</th>                                    </tr>
                        </thead>
                        <tbody>
                        @foreach ($loanproductsdata['disbursementmodes'] as $disbursementmodes)
                            <tr>
                                <td class='table-text'><div>
                                    {!! $disbursementmodes->code !!}
                                </div></td>
                                <td class='table-text'><div>
                                    {!! $disbursementmodes->name !!}
                                </div></td>
                                <td class='table-text'><div>
                                    {!! $disbursementmodes->description !!}
                                </div></td>
                                <td>
                                    @if(isset($loanproductsdata["productdisbursementmodes"][0]))
                                        @foreach($loanproductsdata["productdisbursementmodes"] as $productdisbursementmode)
                                            @if($productdisbursementmode->disbursement_mode==$disbursementmodes->id)
                                                <input type="checkbox" name="disbursement_mode_config[]" value="{{$productdisbursementmode->disbursement_mode}}" checked/>
                                                @break
                                            @else
                                                @if($loop->last)
                                                    <input type="checkbox" name="disbursement_mode_config[]" value="{{$productdisbursementmode->disbursement_mode}}" />
                                                @endif
                                            @endif
                                        @endforeach
                                    @else
                                        <input type="checkbox" name="disbursement_mode_config[]" value="1"/>
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
                    <h4 class="panel-title">Disbursement Configuration</h4>
                </div>
                <div class="panel-body">
                                <div class="form-group">
                                    <label for="Mode Of Disbursement" class="col-md-3 m-t-10 control-label text-right">Mode Of Disbursement</label>
                                    <div class="col-md-3 m-t-10">
                                        <select class="form-control" name="mode_of_disbursement"  id="mode_of_disbursement">
                                            <option value="" >Select Mode Of Disbursement</option>                                              @foreach ($loanproductsdata['disbursementmodes'] as $disbursementmodes)
                                                <option value="{!! $disbursementmodes->id !!}">
                    
                                                {!! $disbursementmodes->name!!}
                                                </option>
                                                @endforeach
                                        </select>
                                    </div>
                                    <label for="Debit Account" class="col-md-3 m-t-10 control-label text-right">Debit Account</label>
                                    <div class="col-md-3 m-t-10">
                                        <select class="form-control" name="disbursement_debit_account"  id="disbursement_debit_account">
                                            <option value="" >Select Debit Account</option>                                             @foreach ($loanproductsdata['accounts'] as $accounts)
                                                <option value="{!! $accounts->id !!}">
                    
                                                {!! $accounts->name!!}
                                                </option>
                                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Credit Account" class="col-md-3 m-t-10 control-label text-right">Credit Account</label>
                                    <div class="col-md-3 m-t-10">
                                        <select class="form-control" name="disbursement_credit_account"  id="disbursement_credit_account">
                                            <option value="" >Select Credit Account</option>                                                @foreach ($loanproductsdata['accounts'] as $accounts)
                                                <option value="{!! $accounts->id !!}">
                    
                                                {!! $accounts->name!!}
                                                </option>
                                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class=" col-md-3 m-t-10">
                                        <button type="button" onclick="addDisbursementConfiguration()" class="btn btn-sm btn-primary">
                                            <i class="fa fa-btn fa-plus"></i> Add
                                        </button>
                                    </div>
                                </div>
                    
                </div>
                <div class="panel-body">
                    <table id="disbursement-configurations-table" class="table table-striped table-bordered">
                        <thead>
                                    <tr>
                                        
                                        <th>Mode Of Disbursement</th>
                                        <th>Debit Account</th>
                                        <th>Credit Account</th>
                                        <th>Action</th>                                    </tr>
                        </thead>
                        <tbody>
                        @foreach ($loanproductsdata['productdisbursementconfigurations'] as $productdisbursementconfigurations)
                            <tr>
                                <td class='table-text'><div>
                                    {!! $productdisbursementconfigurations->disbursementmodemodel->name !!}
                                </div></td>
                                <td class='table-text'><div>
                                    {!! $productdisbursementconfigurations->debitaccountmodel->name !!}
                                </div></td>
                                <td class='table-text'><div>
                                    {!! $productdisbursementconfigurations->creditaccountmodel->name !!}
                                </div></td>
                                <td>
                <form action="{!! route('productdisbursementconfigurations.destroy',$productdisbursementconfigurations->id) !!}" method="POST">

                                        @if($loanproductsdata['usersaccountsroles'][0]->_delete==1)
                                        <input type="hidden" name="_method" value="delete" />
                                        {!! csrf_field() !!}
                                        {!! method_field('DELETE') !!}
                                        <button type='submit' id='delete-productdisbursementconfigurations-{!! $productdisbursementconfigurations->id !!}' class='btn btn-sm btn-circle btn-danger'>
                                            <i class='fa fa-btn fa-trash'></i>
                                        </button>
                                        @endif
                </form>
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
                        <a href="#" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                        <a href="#" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                        <a href="#" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                        <a href="#" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                    </div>
                    <h4 class="panel-title">Interest Configuration</h4>
                </div>
                <div class="panel-body">
                                <div class="form-group">
                                    <label for="Payment Mode" class="col-md-3 m-t-10 control-label text-right">Payment Mode</label>
                                    <div class="col-md-3 m-t-10">
                                        <select class="form-control" name="interest_payment_mode"  id="interest_payment_mode">
                                            <option value="" >Select Payment Mode</option>                                              @foreach ($loanproductsdata['paymentmodes'] as $paymentmodes)
                                                <option value="{!! $paymentmodes->id !!}">
                    
                                                {!! $paymentmodes->name!!}
                                                </option>
                                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Debit Account" class="col-md-3 m-t-10 control-label text-right">Debit Account</label>
                                    <div class="col-md-3 m-t-10">
                                        <select class="form-control" name="interest_debit_account"  id="interest_debit_account">
                                            <option value="" >Select Debit Account</option>                                             @foreach ($loanproductsdata['accounts'] as $accounts)
                                                <option value="{!! $accounts->id !!}">
                    
                                                {!! $accounts->name!!}
                                                </option>
                                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Credit Account" class="col-md-3 m-t-10 control-label text-right">Credit Account</label>
                                    <div class="col-md-3 m-t-10">
                                        <select class="form-control" name="interest_credit_account"  id="interest_credit_account">
                                            <option value="" >Select Credit Account</option>                                                @foreach ($loanproductsdata['accounts'] as $accounts)
                                                <option value="{!! $accounts->id !!}">
                    
                                                {!! $accounts->name!!}
                                                </option>
                                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class=" col-md-3 m-t-10">
                                        <button type="button" onclick="addInterestPaymentConfiguration()" class="btn btn-sm btn-primary">
                                            <i class="fa fa-btn fa-plus"></i> Add
                                        </button>
                                    </div>
                                </div>
                    
                </div>
                <div class="panel-body">
                    <table id="interest-configurations-table" class="table table-striped table-bordered">
                        <thead>
                                    <tr>
                                        
                                        <th>Interest Payment Method</th>
                                        <th>Payment Mode</th>
                                        <th>Debit Account</th>
                                        <th>Credit Account</th>
                                        <th>Action</th>                                    </tr>
                        </thead>
                        <tbody>
                        @foreach ($loanproductsdata['productinterestconfigurations'] as $productinterestconfigurations)
                            <tr>
                                <td class='table-text'><div>
                                    {!! $productinterestconfigurations->interestpaymentmethodmodel->name !!}
                                </div></td>
                                <td class='table-text'><div>
                                    {!! $productinterestconfigurations->paymentmodemodel->name !!}
                                </div></td>
                                <td class='table-text'><div>
                                    {!! $productinterestconfigurations->debitaccountmodel->name !!}
                                </div></td>
                                <td class='table-text'><div>
                                    {!! $productinterestconfigurations->creditaccountmodel->name !!}
                                </div></td>
                                <td>
                <form action="{!! route('productinterestconfigurations.destroy',$productinterestconfigurations->id) !!}" method="POST">

                                        @if($loanproductsdata['usersaccountsroles'][0]->_delete==1)
                                        <input type="hidden" name="_method" value="delete" />
                                        {!! csrf_field() !!}
                                        {!! method_field('DELETE') !!}
                                        <button type='submit' id='delete-productinterestconfigurations-{!! $productinterestconfigurations->id !!}' class='btn btn-sm btn-circle btn-danger'>
                                            <i class='fa fa-btn fa-trash'></i>
                                        </button>
                                        @endif
                </form>
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
                        <a href="#" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                        <a href="#" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                        <a href="#" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                        <a href="#" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                    </div>
                    <h4 class="panel-title">Principal Configuration</h4>
                </div>
                <div class="panel-body">
                    
                                <div class="form-group">
                                    <label for="Payment Mode" class="col-md-3 m-t-10 control-label text-right">Payment Mode</label>
                                    <div class="col-md-3 m-t-10">
                                        <select class="form-control" name="principal_payment_mode"  id="principal_payment_mode">
                                            <option value="" >Select Payment Mode</option>                                              @foreach ($loanproductsdata['paymentmodes'] as $paymentmodes)
                                                <option value="{!! $paymentmodes->id !!}">
                    
                                                {!! $paymentmodes->name!!}
                                                </option>
                                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Debit Account" class="col-md-3 m-t-10 control-label text-right">Debit Account</label>
                                    <div class="col-md-3 m-t-10">
                                        <select class="form-control" name="principal_debit_account"  id="principal_debit_account">
                                            <option value="" >Select Debit Account</option>                                             @foreach ($loanproductsdata['accounts'] as $accounts)
                                                <option value="{!! $accounts->id !!}">
                    
                                                {!! $accounts->name!!}
                                                </option>
                                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Credit Account" class="col-md-3 m-t-10 control-label text-right">Credit Account</label>
                                    <div class="col-md-3 m-t-10">
                                        <select class="form-control" name="principal_credit_account"  id="principal_credit_account">
                                            <option value="" >Select Credit Account</option>                                                @foreach ($loanproductsdata['accounts'] as $accounts)
                                                <option value="{!! $accounts->id !!}">
                    
                                                {!! $accounts->name!!}
                                                </option>
                                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class=" col-md-3 m-t-10">
                                        <button type="button" onclick="addPrincipalPaymentConfiguration()" class="btn btn-sm btn-primary">
                                            <i class="fa fa-btn fa-plus"></i> Add
                                        </button>
                                    </div>
                                </div>
                    
                </div>
                <div class="panel-body">
                    <table id="principal-configurations-table" class="table table-striped table-bordered">
                        <thead>
                                    <tr>
                                        <th>Payment Mode</th>
                                        <th>Debit Account</th>
                                        <th>Credit Account</th>
                                        <th>Action</th>                      
                                    </tr>
                        </thead>
                        <tbody>
                        @foreach ($loanproductsdata['productprincipalconfigurations'] as $productprincipalconfigurations)
                            <tr>
                                <td class='table-text'><div>
                                    {!! $productprincipalconfigurations->paymentmodemodel->name !!}
                                </div></td>
                                <td class='table-text'><div>
                                    {!! $productprincipalconfigurations->debitaccountmodel->name !!}
                                </div></td>
                                <td class='table-text'><div>
                                    {!! $productprincipalconfigurations->creditaccountmodel->name !!}
                                </div></td>
                                <td>
                <form action="{!! route('productprincipalconfigurations.destroy',$productprincipalconfigurations->id) !!}" method="POST">

                                        @if($loanproductsdata['usersaccountsroles'][0]->_delete==1)
                                        <input type="hidden" name="_method" value="delete" />
                                        {!! csrf_field() !!}
                                        {!! method_field('DELETE') !!}
                                        <button type='submit' id='delete-productprincipalconfigurations-{!! $productprincipalconfigurations->id !!}' class='btn btn-sm btn-circle btn-danger'>
                                            <i class='fa fa-btn fa-trash'></i>
                                        </button>
                                        @endif
                </form>
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
                        <a href="#" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                        <a href="#" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                        <a href="#" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                        <a href="#" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                    </div>
                    <h4 class="panel-title">Approval Configurations</h4>
                </div>
                <div class="panel-body">
                                <div class="form-group">
                                    <label for="Approval Level" class="col-md-3 m-t-10 control-label text-right">Approval Level</label>
                                    <div class="col-md-3 m-t-10">
                                        <select class="form-control" name="approval_level"  id="approval_level">
                                            <option value="" >Select Approval Level</option>                                                @foreach ($loanproductsdata['approvallevels'] as $approvallevels)
                                                <option value="{!! $approvallevels->id !!}">
                    
                                                {!! $approvallevels->name!!}
                                                </option>
                                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="User Account" class="col-md-3 m-t-10 control-label text-right">User Account</label>
                                    <div class="col-md-3 m-t-10">
                                        <select class="form-control" name="user_account"  id="user_account">
                                            <option value="" >Select User Account</option>                                              @foreach ($loanproductsdata['usersaccounts'] as $usersaccounts)
                                                <option value="{!! $usersaccounts->id !!}">
                    
                                                {!! $usersaccounts->name!!}
                                                </option>
                                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class=" col-md-3 m-t-10">
                                        <button type="button" onclick="addApprovalConfiguration()()" class="btn btn-sm btn-primary" id="btn-save">
                                            <i class="fa fa-btn fa-plus"></i> Add
                                        </button>
                                    </div>
                                </div>
                    
                </div>
                <div class="panel-body">
                    <table id="approval-configurations-table" class="table table-striped table-bordered">
                        <thead>
                                    <tr>
                                        
                                        <th>Approval Level</th>
                                        <th>User Account</th>
                                        <th>Action</th>                                    </tr>
                        </thead>
                        <tbody>
                        @foreach ($loanproductsdata['productapprovalconfigurations'] as $productapprovalconfigurations)
                            <tr>
                                <td class='table-text'><div>
                                    {!! $productapprovalconfigurations->approvallevelmodel->name !!}
                                </div></td>
                                <td class='table-text'><div>
                                    {!! $productapprovalconfigurations->useraccountmodel->name !!}
                                </div></td>
                                <td>
                <form action="{!! route('productapprovalconfigurations.destroy',$productapprovalconfigurations->id) !!}" method="POST">
                                        @if($loanproductsdata['usersaccountsroles'][0]->_delete==1)
                                        <input type="hidden" name="_method" value="delete" />
                                        {!! csrf_field() !!}
                                        {!! method_field('DELETE') !!}
                                        <button type='submit' id='delete-productapprovalconfigurations-{!! $productapprovalconfigurations->id !!}' class='btn btn-sm btn-circle btn-danger'>
                                            <i class='fa fa-btn fa-trash'></i>
                                        </button>
                                        @endif
                </form>
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
                        <a href="#" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                        <a href="#" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                        <a href="#" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                        <a href="#" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                    </div>
                    <h4 class="panel-title">Insurance Deduction Fees Configuration</h4>
                </div>
                <div class="panel-body" id="insurance-deduction-configurations-form">


                                <div class="form-group">
                                    <label for="Debit Account" class="col-md-3 m-t-10 control-label text-right">Debit Account</label>
                                    <div class="col-md-3 m-t-10">
                                        <select class="form-control" name="debit_account_insurance_deduction"  id="debit_account_insurance_deduction" required="required">
                                            <option value="" >Select Debit Account</option>                                             @foreach ($loanproductsdata['accounts'] as $accounts)
                                                <option value="{!! $accounts->id !!}">
                    
                                                {!! $accounts->name!!}
                                                </option>
                                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Credit Account" class="col-md-3 m-t-10 control-label text-right">Credit Account</label>
                                    <div class="col-md-3 m-t-10">
                                        <select class="form-control" name="credit_account_insurance_deduction"  id="credit_account_insurance_deduction" required="required">
                                            <option value="" >Select Credit Account</option>                                                @foreach ($loanproductsdata['accounts'] as $accounts)
                                                <option value="{!! $accounts->id !!}">
                    
                                                {!! $accounts->name!!}
                                                </option>
                                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Payment Mode" class="col-md-3 m-t-10 control-label text-right">Payment Mode</label>
                                    <div class="col-md-3 m-t-10">
                                        <select class="form-control" name="payment_mode_insurance_deduction"  id="payment_mode_insurance_deduction" required="required">
                                            <option value="" >Select Payment Mode</option>                                              @foreach ($loanproductsdata['paymentmodes'] as $paymentmodes)
                                                <option value="{!! $paymentmodes->id !!}">
                    
                                                {!! $paymentmodes->name!!}
                                                </option>
                                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Disbursement Mode" class="col-md-3 m-t-10 control-label text-right">Disbursement Mode</label>
                                    <div class="col-md-3 m-t-10">
                                        <select class="form-control" name="disbursement_mode_insurance_deduction"  id="disbursement_mode_insurance_deduction" required>
                                            <option value="" >Select Disbursement Mode</option>                                              @foreach ($loanproductsdata['disbursementmodes'] as $disbursementmodes)
                                                <option value="{!! $disbursementmodes->id !!}">
                    
                                                {!! $disbursementmodes->name!!}
                                                </option>
                                                @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class=" col-md-3 m-t-10 col-md-offset-9">
                                        <button type="button" onclick="addInsuranceDeductionConfiguration()" class="btn btn-sm btn-primary" id="btn-save">
                                            <i class="fa fa-btn fa-plus"></i> Add
                                        </button>
                                    </div>
                                </div>

                </div>
                <div class="panel-body">
                    <table id="insurance-deduction-configurations-table" class="table table-striped table-bordered">
                        <thead>
                                    <tr>
                                        <th>Fee Type</th>
                                        <th>Fee Payment Type</th>
                                        <th>Debit Account</th>
                                        <th>Credit Account</th>
                                        <th>Payment Mode</th>
                                        <th>Disbursement Mode</th>
                                        <th>Action</th>                                    </tr>
                        </thead>
                        <tbody>
                        @foreach ($loanproductsdata['insurancedeductionconfigurations'] as $insurancedeductionsconfigurations)
                            <tr>

                                <td class='table-text'><div>
                                    {!! $insurancedeductionsconfigurations->feetypemodel->name !!}
                                </div></td>
                                <td class='table-text'><div>
                                    {!! $insurancedeductionsconfigurations->feepaymenttypemodel->name !!}
                                </div></td>
                                <td class='table-text'><div>
                                    {!! $insurancedeductionsconfigurations->debitaccountmodel->name !!}
                                </div></td>
                                <td class='table-text'><div>
                                    {!! $insurancedeductionsconfigurations->creditaccountmodel->name !!}
                                </div></td>
                                <td class='table-text'><div>
                                    {!! $insurancedeductionsconfigurations->paymentmodemodel ? $insurancedeductionsconfigurations->paymentmodemodel->name : NULL !!}
                                </div></td>
                                <td></td>
                                <td>
                <form action="{!! route('insurancedeductionsconfigurations.destroy',$insurancedeductionsconfigurations->id) !!}" method="POST">
                                        @if($loanproductsdata['usersaccountsroles'][0]->_delete==1)
                                        <input type="hidden" name="_method" value="delete" />
                                        {!! csrf_field() !!}
                                        {!! method_field('DELETE') !!}
                                        <button type='submit' id='delete-insurancedeductionsconfigurations-{!! $insurancedeductionsconfigurations->id !!}' class='btn btn-sm btn-circle btn-danger'>
                                            <i class='fa fa-btn fa-trash'></i>
                                        </button>
                                        @endif
                </form>
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
                        <a href="#" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                        <a href="#" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                        <a href="#" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                        <a href="#" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                    </div>
                    <h4 class="panel-title">Clearing Fee Configurations</h4>
                </div>
                <div class="panel-body" id="clearing-fee-configurations-form">
                                <div class="form-group">
                                    <label for="Debit Account" class="col-md-3 m-t-10 control-label text-right">Debit Account</label>
                                    <div class="col-md-3 m-t-10">
                                        <select class="form-control" name="debit_account_clearing_fee"  id="debit_account_clearing_fee">
                                            <option value="" >Select Debit Account</option>                                             @foreach ($loanproductsdata['accounts'] as $accounts)
                                                <option value="{!! $accounts->id !!}">
                    
                                                {!! $accounts->name!!}
                                                </option>
                                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Credit Account" class="col-md-3 m-t-10 control-label text-right">Credit Account</label>
                                    <div class="col-md-3 m-t-10">
                                        <select class="form-control" name="credit_account_clearing_fee"  id="credit_account_clearing_fee">
                                            <option value="" >Select Credit Account</option>                                                @foreach ($loanproductsdata['accounts'] as $accounts)
                                                <option value="{!! $accounts->id !!}">
                    
                                                {!! $accounts->name!!}
                                                </option>
                                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Payment Mode" class="col-md-3 m-t-10 control-label text-right">Payment Mode</label>
                                    <div class="col-md-3 m-t-10">
                                        <select class="form-control" name="payment_mode_clearing_fee"  id="payment_mode_clearing_fee">
                                            <option value="" >Select Payment Mode</option>
                                            @foreach ($loanproductsdata['paymentmodes'] as $paymentmodes)
                                                <option value="{!! $paymentmodes->id !!}">
                                                {!! $paymentmodes->name!!}
                                                </option>
                                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Disbursement Mode" class="col-md-3 m-t-10 control-label text-right">Disbursement Mode</label>
                                    <div class="col-md-3 m-t-10">
                                        <select class="form-control" name="disbursement_mode_clearing_fee"  id="disbursement_mode_clearing_fee" required>
                                            <option value="" >Select Disbursement Mode</option>                                              @foreach ($loanproductsdata['disbursementmodes'] as $disbursementmodes)
                                                <option value="{!! $disbursementmodes->id !!}">
                    
                                                {!! $disbursementmodes->name!!}
                                                </option>
                                                @endforeach
                                        </select>
                                    </div>
                                </div>                                
                                <div class="form-group">
                                    <div class=" col-md-3 m-t-10 col-md-offset-9">
                                        <button type="button" onclick="addClearingFeeConfiguration()" class="btn btn-sm btn-primary" id="btn-save">
                                            <i class="fa fa-btn fa-plus"></i> Add
                                        </button>
                                    </div>
                                </div>
                    
                </div>
                <div class="panel-body">
                    <table id="clearing-fee-configurations-table" class="table table-striped table-bordered">
                        <thead>
                                    <tr>
                                        
                                        <th>Fee Type</th>
                                        <th>Fee Payment Type</th>
                                        <th>Debit Account</th>
                                        <th>Credit Account</th>
                                        <th>Payment Mode</th>
                                        <th>Disbursement Mode</th>
                                        <th>Action</th>                                    </tr>
                        </thead>
                        <tbody>
                        @foreach ($loanproductsdata['clearingfeeconfigurations'] as $clearingfeeconfigurations)
                            <tr>

                                <td class='table-text'><div>
                                    {!! $clearingfeeconfigurations->feetypemodel->name !!}
                                </div></td>
                                <td class='table-text'><div>
                                    {!! $clearingfeeconfigurations->feepaymenttypemodel->name !!}
                                </div></td>
                                <td class='table-text'><div>
                                    {!! $clearingfeeconfigurations->paymentmodemodel ? $clearingfeeconfigurations->paymentmodemodel->name : NULL !!}
                                </div></td>
                                <td class='table-text'><div>
                                    {!! $clearingfeeconfigurations->disbursementmodemodel->name !!}
                                </div></td>
                                <td class='table-text'><div>
                                    {!! $clearingfeeconfigurations->debitaccountmodel->name !!}
                                </div></td>
                                <td class='table-text'><div>
                                    {!! $clearingfeeconfigurations->creditaccountmodel->name !!}
                                </div></td>
                                <td>
                <form action="{!! route('clearingfeeconfigurations.destroy',$clearingfeeconfigurations->id) !!}" method="POST">

                                        @if($loanproductsdata['usersaccountsroles'][0]->_delete==1)
                                        <input type="hidden" name="_method" value="delete" />
                                        {!! csrf_field() !!}
                                        {!! method_field('DELETE') !!}
                                        <button type='submit' id='delete-clearingfeeconfigurations-{!! $clearingfeeconfigurations->id !!}' class='btn btn-sm btn-circle btn-danger'>
                                            <i class='fa fa-btn fa-trash'></i>
                                        </button>
                                        @endif
                </form>
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
                        <a href="#" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                        <a href="#" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                        <a href="#" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                        <a href="#" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                    </div>
                    <h4 class="panel-title">Fine Payment Configurations</h4>
                </div>
                <div class="panel-body">
                                <div class="form-group">
                                    <label for="Debit Account" class="col-md-3 m-t-10 control-label text-right">Debit Account</label>
                                    <div class="col-md-3 m-t-10">
                                        <select class="form-control" name="debit_account_fine_payment"  id="debit_account_fine_payment">
                                            <option value="" >Select Debit Account</option>                                             @foreach ($loanproductsdata['accounts'] as $accounts)
                                                <option value="{!! $accounts->id !!}">
                    
                                                {!! $accounts->name!!}
                                                </option>
                                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Credit Account" class="col-md-3 m-t-10 control-label text-right">Credit Account</label>
                                    <div class="col-md-3 m-t-10">
                                        <select class="form-control" name="credit_account_fine_payment"  id="credit_account_fine_payment">
                                            <option value="" >Select Credit Account</option>                                                @foreach ($loanproductsdata['accounts'] as $accounts)
                                                <option value="{!! $accounts->id !!}">
                    
                                                {!! $accounts->name!!}
                                                </option>
                                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Payment Mode" class="col-md-3 m-t-10 control-label text-right">Payment Mode</label>
                                    <div class="col-md-3 m-t-10">
                                        <select class="form-control" name="payment_mode_fine_payment"  id="payment_mode_fine_payment">
                                            <option value="" >Select Payment Mode</option>                                              @foreach ($loanproductsdata['paymentmodes'] as $paymentmodes)
                                                <option value="{!! $paymentmodes->id !!}">
                    
                                                {!! $paymentmodes->name!!}
                                                </option>
                                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-3 m-t-10">
                                        <button type="button" onclick="addFinePaymentConfiguration()" class="btn btn-sm btn-primary" id="btn-save">
                                            <i class="fa fa-btn fa-plus"></i> Add
                                        </button>
                                    </div>
                                </div>
                    
                </div>
                <div class="panel-body">
                    <table id="fine-payment-configurations-table" class="table table-striped table-bordered">
                        <thead>
                                    <tr>
                               
                                        <th>Debit Account</th>
                                        <th>Credit Account</th>
                                        <th>Payment Mode</th>
                                        <th>Disbursement Mode</th>
                                        <th>Action</th>                                    </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

</div>
<script type="text/javascript">
function gracePeriodType(){
    var gracePeriodType=$("#grace_period_type").val();
    $.ajax({
        type:'get',
        url: "{!! url('/admin/getgraceperiodtype/')!!}/"+gracePeriodType,
        data:JSON.stringify({'_token':"{{ csrf_token() }}"}),
        contentType: 'application/json',
        processData: false,
        success:function(response){
            console.log(response);  
            var data=jQuery.parseJSON(response);
            $("#grace_period").val("");
            $("#min_grace_period").val("");
            $("#max_grace_period").val("");

            if(data.code=="001"){
                $("#min_grace_period_container").css("display","none");
                $("#max_grace_period_container").css("display","none");
                $("#grace_period_container").css("display","block");
            }else if(data.code="002"){
                $("#min_grace_period_container").css("display","block");
                $("#max_grace_period_container").css("display","block");
                $("#grace_period_container").css("display","none");
            }else{
                $("#min_grace_period_container").css("display","none");
                $("#max_grace_period_container").css("display","none");
                $("#grace_period_container").css("display","none");

            }
        }
    });      
}    
</script>
@endsection
@section('script')
@endsection