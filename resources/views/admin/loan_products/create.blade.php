@extends("admin.home")
@section("main_content")
<div id="content" class="content">
   <ol class="breadcrumb pull-right">
      <li><a href="#">Home</a></li>
      <li><a href="#">public</a></li>
      <li><a href="#">Loan Products</a></li>
      <li class="active">form</li>
   </ol>
   <h1 class="page-header">Loan Products Form <small>loan products details goes here...</small></h1>
   <div class="row">
      <div class="col-md-12">
         <a href="{!! route('loanproducts.index') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-arrow-left"></i></button></a>
      </div>
   </div>
   <form id="form"  class="" enctype="multipart/form-data">
      {!! csrf_field() !!}    
      <div class="row">
         <div class="col-md-12">
            <div class="panel panel-inverse">
               <div class="panel-heading">
                  <div class="panel-heading-btn">
                     <a href="#" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                     <a href="#" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                     <a href="#" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                     
                  </div>
                  <h4 class="panel-title ">DataForm - Autofill</h4>
               </div>
               <div class="panel-body b-t-1" id="loan-products-form">
                  <div class="form-group">
                     <label for="Name" class="col-md-3 m-t-10 control-label text-right">Name</label>
                     <div class="col-md-3 m-t-10">
                        <input type="text" name="name"  id="name" class="form-control" placeholder="Name" value="">
                     </div>
                  </div>
                  <div class="form-group">
                     <label for="Description" class="col-md-3 m-t-10 control-label text-right">Description</label>
                     <div class="col-md-3 m-t-10">
                        <input type="text" name="description"  id="description" class="form-control" placeholder="Description" value="">
                     </div>
                  </div>
                  <div class="form-group">
                     <label for="Defaulter Meter" class="col-md-3 m-t-10 control-label text-right">Defaulter Meter</label>
                     <div class="col-md-3 m-t-10">
                        <select class="form-control" name="defaulter_meter"  id="defaulter_meter">
                           <option value=""  >Select Defaulter Meter</option>
                           @foreach ($loanproductsdata['defaultermeters'] as $defaultermeters)
                           <option value="{!! $defaultermeters->id !!}">
                              {!! $defaultermeters->name!!}
                           </option>
                           @endforeach
                        </select>
                     </div>
                  </div>
                  <div class="form-group">
                     <label for="Fine Type" class="col-md-3 m-t-10 control-label text-right">Fine Type</label>
                     <div class="col-md-3 m-t-10">
                        <select class="form-control" name="fine_type"  id="fine_type">
                           <option value=""  >Select Fine Type</option>
                           @foreach ($loanproductsdata['finetypes'] as $finetypes)
                           <option value="{!! $finetypes->id !!}">
                              {!! $finetypes->name!!}
                           </option>
                           @endforeach
                        </select>
                     </div>
                  </div>
                  <div class="form-group">
                     <label for="Fine Charge" class="col-md-3 m-t-10 control-label text-right">Fine Charge</label>
                     <div class="col-md-3 m-t-10">
                        <input type="text" name="fine_charge"  id="fine_charge" class="form-control" placeholder="Fine Charge" value="">
                     </div>
                  </div>
                  <div class="form-group">
                     <label for="Fine Charge Frequency" class="col-md-3 m-t-10 control-label text-right">Fine Charge Frequency</label>
                     <div class="col-md-3 m-t-10">
                        <select class="form-control" name="fine_charge_frequency"  id="fine_charge_frequency">
                           <option value=""  >Select Fine Charge Frequency</option>
                           @foreach ($loanproductsdata['finechargefrequencies'] as $finechargefrequencies)
                           <option value="{!! $finechargefrequencies->id !!}">
                              {!! $finechargefrequencies->name!!}
                           </option>
                           @endforeach
                        </select>
                     </div>
                  </div>
                  <div class="form-group">
                     <label for="Fine Charge Period" class="col-md-3 m-t-10 control-label text-right">Fine Charge Period</label>
                     <div class="col-md-3 m-t-10">
                        <select class="form-control" name="fine_charge_period"  id="fine_charge_period">
                           <option value=""  >Select Fine Charge Period</option>
                           @foreach ($loanproductsdata['finechargeperiods'] as $finechargeperiods)
                           <option value="{!! $finechargeperiods->id !!}">
                              {!! $finechargeperiods->name!!}
                           </option>
                           @endforeach
                        </select>
                     </div>
                  </div>
                  <div class="form-group">
                     <label for="Interest Rate Type" class="col-md-3 m-t-10 control-label text-right">Interest Rate Type</label>
                     <div class="col-md-3 m-t-10">
                        <select class="form-control" name="interest_rate_type"  id="interest_rate_type" onchange="interestRateType()">
                           <option value=""  >Select Interest Rate Type</option>
                           @foreach ($loanproductsdata['interestratetypes'] as $interestratetypes)
                           <option value="{!! $interestratetypes->id !!}">
                              {!! $interestratetypes->name!!}
                           </option>
                           @endforeach
                        </select>
                     </div>
                  </div>
                  <div class="form-group" style="display: none;">
                     <label for="Compounds Per Year" class="col-md-3 m-t-10 control-label text-right">Compounds Per Year</label>
                     <div class="col-md-3 m-t-10">
                        <input type="text" name="compounds_per_year"  id="compounds_per_year" class="form-control" placeholder="Compounds Per Year" value="">
                     </div>
                  </div>
                  <div class="form-group">
                     <label for="Interest Rate Type" class="col-md-3 m-t-10 control-label text-right">Interest Rate Period</label>
                     <div class="col-md-3 m-t-10">
                        <select class="form-control" name="interest_rate_period"  id="interest_rate_period">
                           <option value=""  >Select Interest Rate Period</option>
                           @foreach ($loanproductsdata['interestrateperiods'] as $interestrateperiods)
                           <option value="{!! $interestrateperiods->id !!}">
                              {!! $interestrateperiods->name!!}
                           </option>
                           @endforeach
                        </select>
                     </div>
                  </div>
                  <div class="form-group">
                     <label for="Interest Rate" class="col-md-3 m-t-10 control-label text-right">Interest Rate(r/100)</label>
                     <div class="col-md-3 m-t-10">
                        <input type="text" name="interest_rate"  id="interest_rate" class="form-control" placeholder="Interest Rate" value="">
                     </div>
                  </div>
                  <div class="form-group">
                     <label for="Interest Payment Method" class="col-md-3 m-t-10 control-label text-right">Interest Payment Method</label>
                     <div class="col-md-3 m-t-10">
                        <select class="form-control" name="interest_payment_method"  id="interest_payment_method">
                           <option value=""  >Select Interest Payment Method</option>
                           @foreach ($loanproductsdata['interestpaymentmethods'] as $interestpaymentmethods)
                           <option value="{!! $interestpaymentmethods->id !!}">
                              {!! $interestpaymentmethods->name!!}
                           </option>
                           @endforeach
                        </select>
                     </div>
                  </div>
                  <div class="form-group">
                     <label for="DEPENDS ON LGF" class="col-md-3 m-t-10 control-label text-right">Depends On LGF</label>
                     <div class="col-md-3 m-t-10">
                        <select class="form-control" name="depends_on_lgf"  id="depends_on_lgf" onchange="dependsOnLGF()">
                           <option value=""  >Select Option</option>
                           <option value="1">Yes</option>
                           <option value="0">No</option>
                        </select>
                     </div>
                  </div>
                  <div class="form-group">
                     <label for="lgf_type" class="col-md-3 m-t-10 control-label text-right">LGF Type</label>
                     <div class="col-md-3 m-t-10">
                        <select class="form-control" name="lgf_type"  id="lgf_type">
                           <option value=""  >Select LGF Type</option>
                           @foreach ($loanproductsdata['feetypes'] as $feetype)
                           <option value="{!! $feetype->id !!}">
                              {!! $feetype->name!!}
                           </option>
                           @endforeach
                        </select>
                     </div>
                  </div>                  
                  <div class="form-group">
                     <label for="LGF" class="col-md-3 m-t-10 control-label text-right">LGF</label>
                     <div class="col-md-3 m-t-10">
                        <input type="text" name="lgf"  id="lgf" class="form-control" placeholder="lgf" value="">
                     </div>
                  </div>
                  <div class="form-group">
                     <label for="Loan Payment Duration" class="col-md-3 m-t-10 control-label text-right">Loan Payment Duration</label>
                     <div class="col-md-3 m-t-10">
                        <select class="form-control" name="loan_payment_duration"  id="loan_payment_duration">
                           <option value=""  >Select Loan Payment Duration</option>
                           @foreach ($loanproductsdata['loanpaymentdurations'] as $loanpaymentdurations)
                           <option value="{!! $loanpaymentdurations->id !!}">
                              {!! $loanpaymentdurations->name!!}
                           </option>
                           @endforeach
                        </select>
                     </div>
                  </div>
                  <div class="form-group">
                     <label for="Loan Payment Frequency" class="col-md-3 m-t-10 control-label text-right">Loan Payment Frequency</label>
                     <div class="col-md-3 m-t-10">
                        <select class="form-control" name="loan_payment_frequency"  id="loan_payment_frequency" >
                           <option value=""  >Select Loan Payment Frequency</option>
                           @foreach ($loanproductsdata['loanpaymentfrequencies'] as $loanpaymentfrequencies)
                           <option value="{!! $loanpaymentfrequencies->id !!}">
                              {!! $loanpaymentfrequencies->name!!}
                           </option>
                           @endforeach
                        </select>
                     </div>
                  </div>
                  <div class="form-group">
                     <label for="Can Access Another Loan" class="col-md-3 m-t-10 control-label text-right">Is Asset</label>
                     <div class="col-md-3 m-t-10">
                        <select class="form-control" name="is_asset" onchange="isAsset(this)">
                           <option value=""  >Select Option</option>
                           <option value="1">Yes</option>
                           <option value="0">No</option>
                        </select>
                     </div>
                  </div>                     
                  <div class="form-group">
                     <label for="Minimum Loan Amount" class="col-md-3 m-t-10 control-label text-right">Minimum Loan Amount</label>
                     <div class="col-md-3 m-t-10">
                        <input type="text" name="minimum_loan_amount"  id="minimum_loan_amount" class="form-control" placeholder="Minimum Loan Amount" value="" onchange="minimumLoanAmount()">
                     </div>
                  </div>
                  <div class="form-group">
                     <label for="Maximum Loan Amount" class="col-md-3 m-t-10 control-label text-right">Maximum Loan Amount</label>
                     <div class="col-md-3 m-t-10">
                        <input type="text" name="maximum_loan_amount"  id="maximum_loan_amount" class="form-control" placeholder="Maximum Loan Amount" value="" onchange="maximumLoanAmount()">
                     </div>
                  </div>
                  <div class="form-group">
                     <label for="Fee Type" class="col-md-3 m-t-10 control-label text-right">Clearing Fee Type</label>
                     <div class="col-md-3 m-t-10">
                        <select class="form-control" name="clearing_fee_type"  id="clearing_fee_type">
                           <option value=""  >Select Fee Type</option>
                           @foreach ($loanproductsdata['feetypes'] as $feetypes)
                           <option value="{!! $feetypes->id !!}">
                              {!! $feetypes->name!!}
                           </option>
                           @endforeach
                        </select>
                     </div>
                  </div>
                  <div class="form-group">
                     <label for="Fee Payment Type" class="col-md-3 m-t-10 control-label text-right">Clearing Fee Payment Type</label>
                     <div class="col-md-3 m-t-10">
                        <select class="form-control" name="clearing_fee_payment_type"  id="clearing_fee_payment_type" onchange="clearingFeePaymentType()">
                           <option value=""  >Select Fee Payment Type</option>
                           @foreach ($loanproductsdata['feepaymenttypes'] as $feepaymenttypes)
                           <option value="{!! $feepaymenttypes->id !!}">
                              {!! $feepaymenttypes->name!!}
                           </option>
                           @endforeach
                        </select>
                     </div>
                  </div>
                  <div class="form-group">
                     <label for="Clearing Fee" class="col-md-3 m-t-10 control-label text-right">Clearing Fee</label>
                     <div class="col-md-3 m-t-10">
                        <input type="text" name="clearing_fee"  id="clearing_fee" class="form-control" placeholder="Clearing Fee" value="">
                     </div>
                  </div>
                  <div class="form-group">
                     <label for="Fee Type" class="col-md-3 m-t-10 control-label text-right">Processing Fee Type</label>
                     <div class="col-md-3 m-t-10">
                        <select class="form-control" name="processing_fee_type"  id="processing_fee_type">
                           <option value=""  >Select Fee Type</option>
                           @foreach ($loanproductsdata['feetypes'] as $feetypes)
                           <option value="{!! $feetypes->id !!}">
                              {!! $feetypes->name!!}
                           </option>
                           @endforeach
                        </select>
                     </div>
                  </div>
                  <div class="form-group">
                     <label for="Fee Payment Type" class="col-md-3 m-t-10 control-label text-right">Processing Fee Payment Type</label>
                     <div class="col-md-3 m-t-10">
                        <select class="form-control" name="processing_fee_payment_type"  id="processing_fee_payment_type" >
                           <option value=""  >Select Fee Payment Type</option>
                           @foreach ($loanproductsdata['feepaymenttypes'] as $feepaymenttypes)
                           <option value="{!! $feepaymenttypes->id !!}">
                              {!! $feepaymenttypes->name!!}
                           </option>
                           @endforeach
                        </select>
                     </div>
                  </div>
                  <div class="form-group">
                     <label for="Processing Fee" class="col-md-3 m-t-10 control-label text-right">Processing Fee</label>
                     <div class="col-md-3 m-t-10">
                        <input type="text" name="processing_fee"  id="processing_fee" class="form-control" placeholder="Processing Fee" value="">
                     </div>
                  </div>

                  <div class="form-group">
                     <label for="Number Of Guarantors" class="col-md-3 m-t-10 control-label text-right">Number Of Guarantors</label>
                     <div class="col-md-3 m-t-10">
                        <input type="text" name="number_of_guarantors"  id="number_of_guarantors" class="form-control" placeholder="Number Of Guarantors" value="" onchange="numberOfGuarantors()">
                     </div>
                  </div>
                  <div class="form-group">
                     <label for="Fee Type" class="col-md-3 m-t-10 control-label text-right">Insurance Deduction Type</label>
                     <div class="col-md-3 m-t-10">
                        <select class="form-control" name="insurance_deduction_fee_type"  id="insurance_deduction_fee_type">
                           <option value=""  >Select Fee Type</option>
                           @foreach ($loanproductsdata['feetypes'] as $feetypes)
                           <option value="{!! $feetypes->id !!}">
                              {!! $feetypes->name!!}
                           </option>
                           @endforeach
                        </select>
                     </div>
                  </div>
                  <div class="form-group">
                     <label for="Fee Payment Type" class="col-md-3 m-t-10 control-label text-right">Insurance Deducation Payment Type</label>
                     <div class="col-md-3 m-t-10">
                        <select class="form-control" name="insurance_deduction_fee_payment_type"  id="insurance_deduction_fee_payment_type" onchange="insuranceDeductionFeePaymentType()">
                           <option value=""  >Select Fee Payment Type</option>
                           @foreach ($loanproductsdata['feepaymenttypes'] as $feepaymenttypes)
                           <option value="{!! $feepaymenttypes->id !!}">
                              {!! $feepaymenttypes->name!!}
                           </option>
                           @endforeach
                        </select>
                     </div>
                  </div>
                  <div class="form-group">
                     <label for="Insurance Deduction Fee" class="col-md-3 m-t-10 control-label text-right">Insurance Deduction Fee</label>
                     <div class="col-md-3 m-t-10">
                        <input type="text" name="insurance_deduction_fee"  id="insurance_deduction_fee" class="form-control" placeholder="Insurance Deduction Fee" value="">
                     </div>
                  </div>
                  <div class="form-group">
                     <label for="Min Collateral Value Type" class="col-md-3 m-t-10 control-label text-right">Min Collateral Value Type</label>
                     <div class="col-md-3 m-t-10">
                        <select class="form-control" name="min_collateral_value_type"  id="min_collateral_value_type">
                           <option value=""  >Select Min Collateral Value Type</option>
                           @foreach ($loanproductsdata['collateralvaluetypes'] as $collateralvaluetypes)
                           <option value="{!! $collateralvaluetypes->id !!}">
                              {!! $collateralvaluetypes->name!!}
                           </option>
                           @endforeach
                        </select>
                     </div>
                  </div>
                  <div class="form-group">
                     <label for="Min Collateral Value" class="col-md-3 m-t-10 control-label text-right">Min Collateral Value</label>
                     <div class="col-md-3 m-t-10">
                        <input type="text" name="min_collateral_value"  id="min_collateral_value" class="form-control" placeholder="Min Collateral Value" value="">
                     </div>
                  </div>
                  <div class="form-group">
                     <label for="Minimum Membership Period" class="col-md-3 m-t-10 control-label text-right">Minimum Membership Period</label>
                     <div class="col-md-3 m-t-10">
                        <select class="form-control" name="minimum_membership_period"  id="minimum_membership_period">
                           <option value=""  >Select Minimum Membership Period</option>
                           @foreach ($loanproductsdata['minimummembershipperiods'] as $minimummembershipperiods)
                           <option value="{!! $minimummembershipperiods->id !!}">
                              {!! $minimummembershipperiods->name!!}
                           </option>
                           @endforeach
                        </select>
                     </div>
                  </div>
                  <div class="form-group">
                     <label for="Can Access Another Loan" class="col-md-3 m-t-10 control-label text-right">Can Access Another Loan</label>
                     <div class="col-md-3 m-t-10">
                        <select class="form-control" name="can_access_another_loan">
                           <option value=""  >Select Option</option>
                           <option value="1">Yes</option>
                           <option value="0">No</option>
                        </select>
                     </div>
                  </div>
                  <div class="form-group">
                     <label for="Grace Period Type" class="col-md-3 m-t-10 control-label text-right">Grace Period Type</label>
                     <div class="col-md-3 m-t-10">
                        <select class="form-control" name="grace_period_type"  id="grace_period_type" onchange="gracePeriodType()">
                           <option value=""  >Select Grace Period Type</option>
                           @foreach ($loanproductsdata['graceperiodtypes'] as $graceperiodtypes)
                           <option value="{!! $graceperiodtypes->id !!}">
                              {!! $graceperiodtypes->name!!}
                           </option>
                           @endforeach
                        </select>
                     </div>
                  </div>
                  <div class="form-group" id="grace_period_container" style="display: none;">
                     <label for="Grace Period" class="col-md-3 m-t-10 control-label text-right">Grace Period</label>
                     <div class="col-md-3 m-t-10">
                        <select class="form-control" name="grace_period"  id="grace_period">
                           <option value=""  >Select Grace Period</option>
                           @foreach ($loanproductsdata['graceperiods'] as $graceperiods)
                           <option value="{!! $graceperiods->id !!}">
                              {!! $graceperiods->name!!}
                           </option>
                           @endforeach
                        </select>
                     </div>
                  </div>
                  <div class="form-group" id="min_grace_period_container" style="display: none;">
                     <label for="Min Grace Period" class="col-md-3 m-t-10 control-label text-right">Min Grace Period</label>
                     <div class="col-md-3 m-t-10">
                        <select class="form-control" name="min_grace_period"  id="min_grace_period">
                           <option value=""  >Select Min Grace Period</option>
                           @foreach ($loanproductsdata['graceperiods'] as $graceperiods)
                           <option value="{!! $graceperiods->id !!}">
                              {!! $graceperiods->name!!}
                           </option>
                           @endforeach
                        </select>
                     </div>
                  </div>
                  <div class="form-group" id="max_grace_period_container" style="display: none;">
                     <label for="Max Grace Period" class="col-md-3 m-t-10 control-label text-right">Max Grace Period</label>
                     <div class="col-md-3 m-t-10">
                        <select class="form-control" name="max_grace_period"  id="max_grace_period">
                           <option value=""  >Select Max Grace Period</option>
                           @foreach ($loanproductsdata['graceperiods'] as $graceperiods)
                           <option value="{!! $graceperiods->id !!}">
                              {!! $graceperiods->name!!}
                           </option>
                           @endforeach
                        </select>
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
                     <a href="#" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                     <a href="#" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                     <a href="#" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                     
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
                           <td class='table-text'>
                              <div>
                                 {!! $clienttypes->code !!}
                              </div>
                           </td>
                           <td class='table-text'>
                              <div>
                                 {!! $clienttypes->name !!}
                              </div>
                           </td>
                           <td class='table-text'>
                              <div>
                                 {!! $clienttypes->description !!}
                              </div>
                           </td>
                           <td>
                              <input type="checkbox" name="client_type_config[]" value="{{$clienttypes->id}}"/>
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
                           <th>Can Initiate</th>
                        </tr>
                     </thead>
                     <tbody>
                        @foreach ($loanproductsdata['useraccounts'] as $useraccount)
                        <tr>
                           <td class='table-text'>
                              <div>
                                 {!! $useraccount->code !!}
                              </div>
                           </td>
                           <td class='table-text'>
                              <div>
                                 {!! $useraccount->name !!}
                              </div>
                           </td>
                           <td class='table-text'>
                              <div>
                                 {!! $useraccount->description !!}
                              </div>
                           </td>
                           <td>
                              <input type="checkbox" name="user_account_config[]" value="{{$useraccount->id}}" />
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
                           <th>Action</th>
                        </tr>
                     </thead>
                     <tbody>
                        @foreach ($loanproductsdata['disbursementmodes'] as $disbursementmodes)
                        <tr>
                           <td class='table-text'>
                              <div>
                                 {!! $disbursementmodes->code !!}
                              </div>
                           </td>
                           <td class='table-text'>
                              <div>
                                 {!! $disbursementmodes->name !!}
                              </div>
                           </td>
                           <td class='table-text'>
                              <div>
                                 {!! $disbursementmodes->description !!}
                              </div>
                           </td>
                           <td>
                              <input type="checkbox" name="disbursement_mode_config[]" value="{{$disbursementmodes->id}}"/>
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
                     
                  </div>
                  <h4 class="panel-title">Loan Product Assets</h4>
               </div>
               <div class="panel-body">
                  <div class="form-group">
                     <label for="Asset" class="col-md-3 m-t-10 control-label text-right">Asset</label>
                     <div class="col-md-3 m-t-10">
                        <select class="form-control" name="loan_product_asset"  id="loan_product_asset">
                           <option value=""  >Select Asset</option>
                           @foreach ($loanproductsdata['assets'] as $asset)
                           <option value="{!! $asset->id !!}">
                              {!! $asset->name!!}
                           </option>
                           @endforeach
                        </select>
                     </div>
                     <label for="Asset" class="col-md-3 m-t-10 control-label text-right">Quantity</label>
                     <div class="col-md-3 m-t-10">
                        <input type="text" name="loan_product_asset_quantity" id="loan_product_asset_quantity" class="form-control" />
                     </div>
                  </div>                     
                  <div class="form-group">
                     <div class="col-md-7 m-t-10">
                        <button type="button" onclick="addLoanProductAsset()" disabled="disabled" id="add-loan-product-asset-btn" class="btn btn-sm btn-primary pull-right">
                        <i class="fa fa-btn fa-plus"></i> Add
                        </button>
                     </div>
                  </div>
               </div>
               <div class="panel-body">
                  <table id="loan-product-assets-table" class="table table-striped table-bordered">
                     <thead>
                        <tr>
                           <th>Asset</th>
                           <th>Quantity</th>
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
                     <a href="#" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                     <a href="#" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                     <a href="#" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                     
                  </div>
                  <h4 class="panel-title">Disbursement Charges Configurations</h4>
               </div>
               <div class="panel-body">
                  <div class="form-group">
                     <label for="Disbursement Charge" class="col-md-3 control-label m-t-10 text-right">Disbursement Charge Type</label>
                     <div class="col-md-3 m-t-10">
                        <select class="form-control" name="disbursement_charge_type_disbursement_charge"  id="disbursement_charge_type_disbursement_charge">
                           <option value=""  >Select Disbursement Charge Types</option>
                           @foreach ($loanproductsdata['disbursementchargetypes'] as $disbursementchargetypes)
                           <option value="{!! $disbursementchargetypes->id !!}">
                              {!! $disbursementchargetypes->name!!}
                           </option>
                           @endforeach
                        </select>
                     </div>
                  </div>
                  <div class="form-group">
                     <label for="Disbursement Mode" class="col-md-3 control-label m-t-10 text-right">Disbursement Mode</label>
                     <div class="col-md-3 m-t-10">
                        <select class="form-control" name="disbursement_mode_disbursement_charge"  id="disbursement_mode_disbursement_charge">
                           <option value=""  >Select Disbursement Mode</option>
                           @foreach ($loanproductsdata['disbursementmodes'] as $disbursementmodes)
                           <option value="{!! $disbursementmodes->id !!}">
                              {!! $disbursementmodes->name!!}
                           </option>
                           @endforeach
                        </select>
                     </div>
                  </div>
                  <div class="form-group">
                     <label for="Debit Account" class="col-md-3 control-label m-t-10 text-right">Debit Account</label>
                     <div class="col-md-3 m-t-10">
                        <select class="form-control" name="debit_account_disbursement_charge"  id="debit_account_disbursement_charge">
                           <option value=""  >Select Debit Account</option>
                           @foreach ($loanproductsdata['accounts'] as $accounts)
                           <option value="{!! $accounts->id !!}">
                              {!! $accounts->name!!}
                           </option>
                           @endforeach
                        </select>
                     </div>
                  </div>
                  <div class="form-group">
                     <label for="Credit Account" class="col-md-3 control-label m-t-10 text-right">Credit Account</label>
                     <div class="col-md-3 m-t-10">
                        <select class="form-control" name="credit_account_disbursement_charge"  id="credit_account_disbursement_charge">
                           <option value=""  >Select Credit Account</option>
                           @foreach ($loanproductsdata['accounts'] as $accounts)
                           <option value="{!! $accounts->id !!}">
                              {!! $accounts->name!!}
                           </option>
                           @endforeach
                        </select>
                     </div>
                  </div>
                  <div class="form-group">
                     <label for="Amount" class="col-md-3 control-label m-t-10 text-right">Amount</label>
                     <div class="col-md-3 m-t-10">
                        <input type="text" name="amount_disbursement_charge"  id="amount_disbursement_charge" class="form-control" placeholder="Amount" value="" >
                     </div>
                  </div>
                  <div class="form-group">
                     <div class="col-md-3 m-t-10">
                        <button type="button" id="addDisbursementChargeConfigurationBtn" onclick="addDisbursementChargeConfiguration()" class="btn btn-sm btn-primary">
                        <i class="fa fa-btn fa-plus"></i> Add
                        </button>
                     </div>
                  </div>
               </div>
               <div class="panel-body">
                  <table id="disbursement-charge-configurations-table" class="table table-striped table-bordered">
                     <thead>
                        <tr>
                           <th>Disbursement Charge</th>
                           <th>Disbursement Mode</th>
                           <th>Debit Account</th>
                           <th>Credit Account</th>
                           <th>Amount</th>
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
                     <a href="#" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                     <a href="#" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                     <a href="#" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                     
                  </div>
                  <h4 class="panel-title">Disbursement Configuration</h4>
               </div>
               <div class="panel-body">
                  <div class="form-group">
                     <label for="Mode Of Disbursement" class="col-md-3 m-t-10 control-label text-right">Mode Of Disbursement</label>
                     <div class="col-md-3 m-t-10">
                        <select class="form-control" name="mode_of_disbursement"  id="mode_of_disbursement">
                           <option value=""  >Select Mode Of Disbursement</option>
                           @foreach ($loanproductsdata['disbursementmodes'] as $disbursementmodes)
                           <option value="{!! $disbursementmodes->id !!}">
                              {!! $disbursementmodes->name!!}
                           </option>
                           @endforeach
                        </select>
                     </div>
                     <label for="Debit Account" class="col-md-3 m-t-10 control-label text-right">Debit Account</label>
                     <div class="col-md-3 m-t-10">
                        <select class="form-control" name="disbursement_debit_account"  id="disbursement_debit_account">
                           <option value=""  >Select Debit Account</option>
                           @foreach ($loanproductsdata['accounts'] as $accounts)
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
                           <option value=""  >Select Credit Account</option>
                           @foreach ($loanproductsdata['accounts'] as $accounts)
                           <option value="{!! $accounts->id !!}">
                              {!! $accounts->name!!}
                           </option>
                           @endforeach
                        </select>
                     </div>
                  </div>
                  <div class="form-group">
                     <div class=" col-md-3 m-t-10">
                        <button type="button" id="addDisbursementConfigurationBtn" onclick="addDisbursementConfiguration()" class="btn btn-sm btn-primary">
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
                     <a href="#" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                     <a href="#" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                     <a href="#" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                     
                  </div>
                  <h4 class="panel-title">Interest Configuration</h4>
               </div>
               <div class="panel-body">
                  <div class="form-group">
                     <label for="Payment Mode" class="col-md-3 m-t-10 control-label text-right">Payment Mode</label>
                     <div class="col-md-3 m-t-10">
                        <select class="form-control" name="interest_payment_mode"  id="interest_payment_mode">
                           <option value=""  >Select Payment Mode</option>
                           @foreach ($loanproductsdata['paymentmodes'] as $paymentmodes)
                           <option value="{!! $paymentmodes->id !!}">
                              {!! $paymentmodes->name!!}
                           </option>
                           @endforeach
                        </select>
                     </div>
                     <label for="Debit Account" class="col-md-3 m-t-10 control-label text-right">Debit Account</label>
                     <div class="col-md-3 m-t-10">
                        <select class="form-control" name="interest_debit_account"  id="interest_debit_account">
                           <option value=""  >Select Debit Account</option>
                           @foreach ($loanproductsdata['accounts'] as $accounts)
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
                           <option value=""  >Select Credit Account</option>
                           @foreach ($loanproductsdata['accounts'] as $accounts)
                           <option value="{!! $accounts->id !!}">
                              {!! $accounts->name!!}
                           </option>
                           @endforeach
                        </select>
                     </div>
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
                           <th>Payment Mode</th>
                           <th>Debit Account</th>
                           <th>Credit Account</th>
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
                     <a href="#" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                     <a href="#" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                     <a href="#" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                     
                  </div>
                  <h4 class="panel-title">Principal Configuration</h4>
               </div>
               <div class="panel-body">
                  <div class="form-group">
                     <label for="Payment Mode" class="col-md-3 m-t-10 control-label text-right">Payment Mode</label>
                     <div class="col-md-3 m-t-10">
                        <select class="form-control" name="principal_payment_mode"  id="principal_payment_mode">
                           <option value=""  >Select Payment Mode</option>
                           @foreach ($loanproductsdata['paymentmodes'] as $paymentmodes)
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
                           <option value=""  >Select Debit Account</option>
                           @foreach ($loanproductsdata['accounts'] as $accounts)
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
                           <option value=""  >Select Credit Account</option>
                           @foreach ($loanproductsdata['accounts'] as $accounts)
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
                     
                  </div>
                  <h4 class="panel-title">Approval Configurations</h4>
               </div>
               <div class="panel-body">
                  <div class="form-group">
                     <label for="Approval Level" class="col-md-3 m-t-10 control-label text-right">Approval Level</label>
                     <div class="col-md-3 m-t-10">
                        <select class="form-control" name="approval_level"  id="approval_level">
                           <option value=""  >Select Approval Level</option>
                           @foreach ($loanproductsdata['approvallevels'] as $approvallevels)
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
                           <option value=""  >Select User Account</option>
                           @foreach ($loanproductsdata['usersaccounts'] as $usersaccounts)
                           <option value="{!! $usersaccounts->id !!}">
                              {!! $usersaccounts->name!!}
                           </option>
                           @endforeach
                        </select>
                     </div>
                  </div>
                  <div class="form-group">
                     <div class=" col-md-3 m-t-10">
                        <button type="button" onclick="addApprovalConfiguration()" class="btn btn-sm btn-primary" >
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
                     <a href="#" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                     <a href="#" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                     <a href="#" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                     
                  </div>
                  <h4 class="panel-title">Insurance Deduction Fees Configuration</h4>
               </div>
               <div class="panel-body" id="insurance-deduction-configurations-form">
                  <div class="form-group">
                     <label for="Debit Account" class="col-md-3 m-t-10 control-label text-right">Debit Account</label>
                     <div class="col-md-3 m-t-10">
                        <select class="form-control" name="debit_account_insurance_deduction"  id="debit_account_insurance_deduction" required="required">
                           <option value=""  >Select Debit Account</option>
                           @foreach ($loanproductsdata['accounts'] as $accounts)
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
                           <option value=""  >Select Credit Account</option>
                           @foreach ($loanproductsdata['accounts'] as $accounts)
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
                        <select class="form-control" name="payment_mode_insurance_deduction"  id="payment_mode_insurance_deduction">
                           <option value=""  >Select Payment Mode</option>
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
                        <select class="form-control" name="disbursement_mode_insurance_deduction"  id="disbursement_mode_insurance_deduction">
                           <option value=""  >Select Disbursement Mode</option>
                           @foreach ($loanproductsdata['disbursementmodes'] as $disbursementmodes)
                           <option value="{!! $disbursementmodes->id !!}">
                              {!! $disbursementmodes->name!!}
                           </option>
                           @endforeach
                        </select>
                     </div>
                  </div>
                  <div class="form-group">
                     <div class=" col-md-3 m-t-10 col-md-offset-9">
                        <button type="button" onclick="addInsuranceDeductionConfiguration()" class="btn btn-sm btn-primary">
                        <i class="fa fa-btn fa-plus"></i> Add
                        </button>
                     </div>
                  </div>
               </div>
               <div class="panel-body">
                  <table id="insurance-deduction-configurations-table" class="table table-striped table-bordered">
                     <thead>
                        <tr>
                           <th>Debit Account</th>
                           <th>Credit Account</th>
                           <th>Payment Mode</th>
                           <th>Disbursement Mode</th>
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
                     <a href="#" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                     <a href="#" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                     <a href="#" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                     
                  </div>
                  <h4 class="panel-title">Clearing Fee Configurations</h4>
               </div>
               <div class="panel-body" id="clearing-fee-configurations-form">
                  <div class="form-group">
                     <label for="Debit Account" class="col-md-3 m-t-10 control-label text-right">Debit Account</label>
                     <div class="col-md-3 m-t-10">
                        <select class="form-control" name="debit_account_clearing_fee"  id="debit_account_clearing_fee">
                           <option value=""  >Select Debit Account</option>
                           @foreach ($loanproductsdata['accounts'] as $accounts)
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
                           <option value=""  >Select Credit Account</option>
                           @foreach ($loanproductsdata['accounts'] as $accounts)
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
                           <option value=""  >Select Payment Mode</option>
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
                        <select class="form-control" name="disbursement_mode_clearing_fee"  id="disbursement_mode_clearing_fee">
                           <option value=""  >Select Disbursement Mode</option>
                           @foreach ($loanproductsdata['disbursementmodes'] as $disbursementmodes)
                           <option value="{!! $disbursementmodes->id !!}">
                              {!! $disbursementmodes->name!!}
                           </option>
                           @endforeach
                        </select>
                     </div>
                  </div>
                  <div class="form-group">
                     <div class=" col-md-3 m-t-10 col-md-offset-9">
                        <button type="button" onclick="addClearingFeeConfiguration()" class="btn btn-sm btn-primary">
                        <i class="fa fa-btn fa-plus"></i> Add
                        </button>
                     </div>
                  </div>
               </div>
               <div class="panel-body">
                  <table id="clearing-fee-configurations-table" class="table table-striped table-bordered">
                     <thead>
                        <tr>
                           <th>Debit Account</th>
                           <th>Credit Account</th>
                           <th>Payment Mode</th>
                           <th>Disbursement Mode</th>
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
                     <a href="#" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                     <a href="#" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                     <a href="#" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                     
                  </div>
                  <h4 class="panel-title">Processing Fee Configurations</h4>
               </div>
               <div class="panel-body">
                  <div class="form-group">
                     <label for="Debit Account" class="col-md-3 m-t-10 text-right control-label">Debit Account</label>
                     <div class="col-md-3 m-t-10">
                        <select class="form-control" name="debit_account_processing_fee"  id="debit_account_processing_fee">
                           <option value=""  >Select Debit Account</option>
                           @foreach ($loanproductsdata['accounts'] as $accounts)
                           <option value="{!! $accounts->id !!}">
                              {!! $accounts->name!!}
                           </option>
                           @endforeach
                        </select>
                     </div>
                  </div>
                  <div class="form-group">
                     <label for="Credit Account" class="col-md-3 m-t-10 text-right control-label">Credit Account</label>
                     <div class="col-md-3 m-t-10">
                        <select class="form-control" name="credit_account_processing_fee"  id="credit_account_processing_fee">
                           <option value=""  >Select Credit Account</option>
                           @foreach ($loanproductsdata['accounts'] as $accounts)
                           <option value="{!! $accounts->id !!}">
                              {!! $accounts->name!!}
                           </option>
                           @endforeach
                        </select>
                     </div>
                  </div>
                  <div class="form-group">
                     <label for="Payment Mode" class="col-md-3 m-t-10 text-right control-label">Payment Mode</label>
                     <div class="col-md-3 m-t-10">
                        <select class="form-control" name="payment_mode_processing_fee"  id="payment_mode_processing_fee">
                           <option value=""  >Select Payment Mode</option>
                           @foreach ($loanproductsdata['paymentmodes'] as $paymentmodes)
                           <option value="{!! $paymentmodes->id !!}">
                              {!! $paymentmodes->name!!}
                           </option>
                           @endforeach
                        </select>
                     </div>
                  </div>
                  <div class="form-group">
                     <label for="Disbursement Mode" class="col-md-3 m-t-10 text-right control-label">Disbursement Mode</label>
                     <div class="col-md-3 m-t-10">
                        <select class="form-control" name="disbursement_mode_processing_fee"  id="disbursement_mode_processing_fee">
                           <option value=""  >Select Disbursement Modes</option>
                           @foreach ($loanproductsdata['disbursementmodes'] as $disbursementmodes)
                           <option value="{!! $disbursementmodes->id !!}">
                              {!! $disbursementmodes->name!!}
                           </option>
                           @endforeach
                        </select>
                     </div>
                  </div>
                  <div class="form-group">
                     <div class="col-md-3 col-md-offset-9 m-t-10">
                        <button type="button" onclick="addProcessingFeeConfiguration()" class="btn btn-sm btn-primary">
                        <i class="fa fa-btn fa-plus"></i> Add
                        </button>
                     </div>
                  </div>
               </div>
               <div class="panel-body">
                  <table id="processing-fee-configurations-table" class="table table-striped table-bordered">
                     <thead>
                        <tr>
                           <th>Debit Account</th>
                           <th>Credit Account</th>
                           <th>Payment Mode</th>
                           <th>Disbursement Modes</th>
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
                     <a href="#" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                     <a href="#" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                     <a href="#" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                     
                  </div>
                  <h4 class="panel-title">Fine Payment Configurations</h4>
               </div>
               <div class="panel-body">
                  <div class="form-group">
                     <label for="Debit Account" class="col-md-3 m-t-10 control-label text-right">Debit Account</label>
                     <div class="col-md-3 m-t-10">
                        <select class="form-control" name="debit_account_fine_payment"  id="debit_account_fine_payment">
                           <option value=""  >Select Debit Account</option>
                           @foreach ($loanproductsdata['accounts'] as $accounts)
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
                           <option value=""  >Select Credit Account</option>
                           @foreach ($loanproductsdata['accounts'] as $accounts)
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
                           <option value=""  >Select Payment Mode</option>
                           @foreach ($loanproductsdata['paymentmodes'] as $paymentmodes)
                           <option value="{!! $paymentmodes->id !!}">
                              {!! $paymentmodes->name!!}
                           </option>
                           @endforeach
                        </select>
                     </div>
                  </div>
                  <div class="form-group">
                     <div class="col-md-3 m-t-10">
                        <button type="button" onclick="addFinePaymentConfiguration()" class="btn btn-sm btn-primary">
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
                     <a href="#" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                     <a href="#" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                     <a href="#" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                     
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
                     <button type="button" class="btn btn-primary btn-lg align-center" id="btn-save" onclick="save()"><i class="fa fa-save"></i> Submit</button>     
                  </div>
                  <div class="col-md-5 col-sm-5 col-lg-5">
                  </div>
               </div>
            </div>
         </div>
      </div>
   </form>
</div>
<script language="javascript" type="text/javascript">
   function dependsOnLGF(){
       if($("#depends_on_lgf").val()==1){
           $("#lgf").closest("div.form-group").css("display","block");
           $("#lgf_type").closest("div.form-group").css("display","block");
       }else{
           $("#lgf").closest("div.form-group").css("display","none");
           $("#lgf_type").closest("div.form-group").css("display","none");
       }
   }    
   function addDisbursementConfiguration(){
      if($("#mode_of_disbursement").val()=="" || $("#disbursement_debit_account").val()=="" || $("#disbursement_credit_account").val()==""){
         alert("Some fields are missing!!");
      }else{
          var row="<tr><td><input type='hidden' name='disbursement_mode_configuration[]' value='"+$("#mode_of_disbursement").val()+"'/>"+$("#mode_of_disbursement option:selected").text()+"</td><td><input type='hidden' name='debit_account_disbursement_configuration[]' value='"+$("#disbursement_debit_account").val()+"'/>"+$("#disbursement_debit_account option:selected").text()+"</td><td><input type='hidden' name='credit_account_disbursement_configuration[]' value='"+$("#disbursement_credit_account").val()+"'>"+$("#disbursement_credit_account option:selected").text()+"</td><td><button type='button' class='btn btn-sm btn-circle btn-danger' onclick='removeDisbursementConfiguration(this)'><i class='fa fa-btn fa-trash'></i></button></td></tr>";
          $("#disbursement-configurations-table").append(row);
          $("#mode_of_disbursement").val("");
          $("#disbursement_debit_account").val("");
          $("disbursement_credit_account").val("");

      }
   }
   function addDisbursementChargeConfiguration(){

       var row="<tr><td><input type='hidden' name='disbursement_charge_type_disbursement_charge_configuration[]' value='"+$('#disbursement_charge_type_disbursement_charge').val()+"'/>"+$("#disbursement_charge_type_disbursement_charge option:selected").text()+"</td><td><input type='hidden' name='disbursement_mode_disbursement_charge_configuration[]' value='"+$("#disbursement_mode_disbursement_charge").val()+"'/>"+$("#disbursement_mode_disbursement_charge option:selected").text()+"</td><td><input type='hidden' name='debit_account_disbursement_charge_configuration[]' value='"+$("#debit_account_disbursement_charge").val()+"'/>"+$("#debit_account_disbursement_charge option:selected").text()+"</td><td><input type='hidden' name='credit_account_disbursement_charge_configuration[]' value='"+$("#credit_account_disbursement_charge").val()+"'>"+$("#credit_account_disbursement_charge option:selected").text()+"</td><td><input type='hidden' name='amount_disbursement_charge_configuration[]' value='"+$("#amount_disbursement_charge").val()+"'>"+$("#amount_disbursement_charge").val()+"</td><td><button type='button' class='btn btn-sm btn-circle btn-danger' onclick='removeDisbursementChargeConfiguration(this)'><i class='fa fa-btn fa-trash'></i></button></td></tr>";
       $("#disbursement-charge-configurations-table").append(row);
       // $("#mode_of_disbursement").val("");
       // $("#disbursement_debit_account").val("");
       // $("disbursement_credit_account").val("");
   }

   function isAsset(e){

      if($(e).val()=="1"){

         $("#add-loan-product-asset-btn").attr("disabled",false);
         $("#disbursement-modes-table input").each(function(){
            $(this).attr("disabled",true);
         });

         $("#disbursement-charge-configurations-table tbody tr").remove();

         $("#addDisbursementChargeConfigurationBtn").attr("disabled",true);

         $("#disbursement-configurations-table tbody tr").remove();

         $("#addDisbursementConfigurationBtn").attr("disabled",true);


      }else{

         $("#disbursement-modes-table input").each(function(){
            $(this).attr("disabled",false);
         });


         $("#add-loan-product-asset-btn").attr("disabled",true);
         $("#loan-product-assets-table tbody tr").remove();

         $("#addDisbursementChargeConfigurationBtn").attr("disabled",false);

         $("#addDisbursementConfigurationBtn").attr("disabled",false);

      }

   }

   function addLoanProductAsset(){

       var row="<tr><td><input type='hidden' name='loan_product_assets[]' value='"+$('#loan_product_asset').val()+"'/>"+$("#loan_product_asset option:selected").text()+"</td><td><input type='hidden' name='loan_product_asset_quantities[]' value='"+$("#loan_product_asset_quantity").val()+"'/>"+$("#loan_product_asset_quantity").val()+"</td><td><button type='button' class='btn btn-sm btn-circle btn-danger' onclick='removeLoanProductAsset(this)'><i class='fa fa-btn fa-trash'></i></button></td></tr>";

       $("#loan-product-assets-table").append(row);
       // $("#mode_of_disbursement").val("");
       // $("#disbursement_debit_account").val("");
       // $("disbursement_credit_account").val("");
   }

   function removeLoanProductAsset(e){
       $(e).closest("tr").remove();
   }   

   function removeDisbursementConfiguration(e){
       $(e).closest("tr").remove();
   }
   function removeDisbursementChargeConfiguration(e){
       $(e).closest("tr").remove();
   }   
   function addInterestPaymentConfiguration(){
       var row="<tr><td><input type='hidden' name='interest_payment_method_config[]' value='"+$("#interest_payment_method").val()+"'/><input type='hidden' name='payment_mode_interest_config[]' value='"+$("#interest_payment_mode").val()+"'/>"+$("#interest_payment_mode option:selected").text()+"</td><td><input type='hidden' name='debit_account_interest_config[]' value='"+$("#interest_debit_account").val()+"'/>"+$("#interest_debit_account option:selected").text()+"</td><td><input type='hidden' name='credit_account_interest_config[]' value='"+$("#interest_credit_account").val()+"'>"+$("#interest_credit_account option:selected").text()+"</td><td><button type='button' class='btn btn-sm btn-circle btn-danger' onclick='removeInterestPaymentConfiguration(this)'><i class='fa fa-btn fa-trash'></i></button></td></tr>";
       $("#interest-configurations-table").append(row);
       $("#interest_payment_mode").val("");
       $("#interest_debit_account").val("");
       $("#interest_credit_account").val("");
   }
   function removeInterestPaymentConfiguration(e){
       $(e).closest("tr").remove();
   }
   function addPrincipalPaymentConfiguration(){
       var row="<tr><td><input type='hidden' name='principal_payment_mode_config[]' value='"+$("#principal_payment_mode").val()+"'/>"+$("#principal_payment_mode option:selected").text()+"</td><td><input type='hidden' name='debit_account_principal_config[]' value='"+$("#principal_debit_account").val()+"'/>"+$("#principal_debit_account option:selected").text()+"</td><td><input type='hidden' name='credit_account_principal_config[]' value='"+$("#principal_credit_account").val()+"'/>"+$("#principal_credit_account option:selected").text()+"</td><td><button type='button' class='btn btn-sm btn-circle btn-danger' onclick='removePrincipalPaymentConfiguration(this)'><i class='fa fa-btn fa-trash'></i></button></td></tr>";
       $("#principal-configurations-table").append(row);
   }
   function removePrincipalPaymentConfiguration(e){
       $(e).closest("tr").remove();
   }
   function addApprovalConfiguration(){
       var row="<tr><td><input type='hidden' name='approval_level_config[]' value='"+$("#approval_level").val()+"'>"+$("#approval_level option:selected").text()+"</td><td><input type='hidden' name='user_account_approval_config[]' value='"+$("#user_account").val()+"'>"+$("#user_account option:selected").text()+"</td><td><button type='button' class='btn btn-sm btn-circle btn-danger' onclick='removeApprovalConfiguration(this)'><i class='fa fa-btn fa-trash'></i></button></td></tr>";
       $("#approval-configurations-table").append(row);
       $("#approval_level").val("");
       $("#user_account").val("");
   }
   function removeApprovalConfiguration(e){
       $(e).closest("tr").remove();
   }
   function addInsuranceDeductionConfiguration(){
       if($("#insurance_deduction_fee_type").val()==""){
           $("#insurance_deduction_fee_type").closest("div.form-group").addClass("has-feedback has-error");
       }
       if($("#insurance_deduction_fee_payment_type").val()==""){
           $("#insurance_deduction_fee_payment_type").closest("div.form-group").addClass("has-feedback has-error");
       }
   
       if($("#insurance_deduction_fee_payment_type").val()=="" || $("#insurance_deduction_fee_type").val()==""){
           alert("(Fee Payment or Fee) Type is missing!");
           return;
       }
   
       $("#insurance-deduction-configurations-form select").each(function(){
           if($(this).prop("required")){
               if($(this).val()==""){
                   $(this).closest("div.form-group").addClass("has-feedback has-error");
               }else{
                   $(this).closest("div.form-group").removeClass("has-feedback has-error");
               }
           }
       });
       
       if($("#debit_account_insurance_deduction").val()=="" || $("#credit_account_insurance_deduction").val()==""){
           alert("Some required fields are missing!");
           return;
       }
   
       
   
   
   
       var row="<tr><td><input type='hidden' name='fee_type_insurance_deduction_config[]' value='"+$("#insurance_deduction_fee_type").val()+"'/><input type='hidden' name='fee_payment_type_insurance_deduction_config[]' value='"+$("#insurance_deduction_fee_payment_type").val()+"'/><input type='hidden' name='debit_account_insurance_deduction_config[]' value='"+$("#debit_account_insurance_deduction").val()+"' />"+$("#debit_account_insurance_deduction option:selected").text()+"</td><td><input type='hidden' name='credit_account_insurance_deduction_config[]' value='"+$("#credit_account_insurance_deduction").val()+"'/>"+$("#credit_account_insurance_deduction option:selected").text()+"</td><td><input type='hidden' name='payment_mode_insurance_deduction_config[]' value='"+$("#payment_mode_insurance_deduction").val()+"'/>"+$("#payment_mode_insurance_deduction option:selected").text()+"</td><td><input type='hidden' name='disbursement_mode_insurance_deduction_config[]' value='"+$("#disbursement_mode_insurance_deduction").val()+"'/>"+$("#disbursement_mode_insurance_deduction option:selected").text()+"</td><td><button type='button' class='btn btn-sm btn-circle btn-danger' onclick='removeInsuranceDeductionConfiguration(this)'><i class='fa fa-btn fa-trash'></i></button></td></tr>";
   
       $("#insurance-deduction-configurations-table").append(row);
   
       $("#debit_account_insurance_deduction").val("");
       $("#credit_account_insurance_deduction").val("");
       $("#payment_mode_insurance_deduction").val("");
       $("#disbursement_mode_insurance_deduction").val("");
   }
   function removeInsuranceDeductionConfiguration(e){
       $(e).closest("tr").remove();
   }
   function addClearingFeeConfiguration(){
       if($("#clearing_fee_type").val()==""){
           $("#clearing_fee_type").closest("div.form-group").addClass("has-feedback has-error");
       }else{
           $("#clearing_fee_type").closest("div.form-group").removeClass("has-feedback has-error");
       }
       if($("#clearing_fee_payment_type").val()==""){
           $("#clearing_fee_payment_type").closest("div.form-group").addClass("has-feedback has-error")
       }else{
           $("#clearing_fee_payment_type").closest("div.form-group").removeClass("has-feedback has-error")
       }
       if($("#clearing_fee_payment_type").val()=="" || $("#clearing_fee_payment_type").val()==""){
           alert("(Fee or Fee Payment) Type is missing for clearing fee!");
           return;
       }
       $("#clearing-fee-configurations-form select").each(function(){
           if($(this).val()=="" && $(this).prop('required')){
               $(this).closest("div.form-group").addClass("has-feedback has-error");
           }else{
               $(this).closest("div.form-group").removeClass("has-feedback has-error");
           }
       }); 
       $("#clearing-fee-configurations-form select").each(function(){
           if($(this).val()==""  && $(this).prop('required')){
               alert("Some fields are missing - clearing fee configurations");
               return false;
           }
       });
   
       if($("#debit_account_clearing_fee").val()=="" || $("#credit_account_clearing_fee").val()==""){
           return;
       }
          
       var row="<tr><td><input type='hidden' name='fee_type_clearing_fee_config[]' value='"+$("#clearing_fee_type").val()+"'><input type='hidden' name='fee_payment_type_clearing_fee_config[]' value='"+$("#clearing_fee_payment_type").val()+"'><input type='hidden' name='debit_account_clearing_fee_config[]' value='"+$("#debit_account_clearing_fee").val()+"'>"+$("#debit_account_clearing_fee option:selected").text()+"</td><td><input type='hidden' name='credit_account_clearing_fee_config[]' value='"+$("#credit_account_clearing_fee").val()+"'>"+$("#credit_account_clearing_fee option:selected").text()+"</td><td><input type='hidden' name='payment_mode_clearing_fee_config[]' value='"+$("#payment_mode_clearing_fee").val()+"'>"+$("#payment_mode_clearing_fee option:selected").text()+"</td><td><input type='hidden' name='disbursement_mode_clearing_fee_config[]' value='"+$("#disbursement_mode_clearing_fee").val()+"'>"+$("#disbursement_mode_clearing_fee option:selected").text()+"</td><td><button type='button' class='btn btn-sm btn-circle btn-danger' onclick='removeClearingFeeConfiguration(this)'><i class='fa fa-btn fa-trash'></i></button></td></tr>";
       $("#clearing-fee-configurations-table").append(row);
   
       $("#payment_mode_clearing_fee").val("");
       $("#disbursement_mode_clearing_fee").val("");
       $("#debit_account_clearing_fee").val("");
       $("#credit_account_clearing_fee").val("");
   
   }
   function removeClearingFeeConfiguration(e){
       $(e).closest("tr").remove();
   }
   function addFinePaymentConfiguration(){
       var row="<tr><td>"+$("#debit_account_fine_payment option:selected").text()+"</td><td>"+$("#credit_account_fine_payment option:selected").text()+"</td><td>"+$("#payment_mode_fine_payment option:selected").text()+"</td><td><button type='button' class='btn btn-sm btn-circle btn-danger' onclick='removeFinePaymentConfiguration(this)'><i class='fa fa-btn fa-trash'></i></button></td></tr>";
       $("#fine-payment-configurations-table").append(row);
   }
   function removeFinePaymentConfiguration(e){
       $(e).closest("tr").remove();
   }
   function addProcessingFeeConfiguration(){
       var row="<tr><td><input type='hidden' name='fee_payment_type_processing_fee_config[]' value='"+$("#processing_fee_payment_type").val()+"'><input type='hidden' name='fee_type_processing_fee_config[]' value='"+$("#processing_fee_type").val()+"'><input type='hidden' name='debit_account_processing_fee_config[]' value='"+$("#debit_account_processing_fee").val()+"'>"+$("#debit_account_processing_fee option:selected").text()+"</td><td><input type='hidden' name='credit_account_processing_fee_config[]' value='"+$("#credit_account_processing_fee").val()+"'>"+$("#credit_account_processing_fee option:selected").text()+"</td><td><input type='hidden' name='payment_mode_processing_fee_config[]' value='"+$("#payment_mode_processing_fee").val()+"'>"+$("#payment_mode_processing_fee option:selected").text()+"</td><td><input type='hidden' name='disbursement_mode_processing_fee_config[]' value='"+$("#disbursement_mode_processing_fee").val()+"'>"+$("#disbursement_mode_processing_fee option:selected").text()+"</td><td><button type='button' class='btn btn-sm btn-circle btn-danger' onclick='removeProcessingFeeConfiguration(this)'><i class='fa fa-btn fa-trash'></i></button></td></tr>";
       $("#processing-fee-configurations-table").append(row);
   }
   function removeProcessingFeeConfiguration(e){
       $(e).closest("tr").remove();
   }   
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
               // console.log(data.code);
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
   
   function save(){
       $("#loan-products-form select").each(function(){
               if($(this).val()==""){
                   $(this).closest("div.form-group").addClass("has-feedback has-error");
               }else{
                   $(this).closest("div.form-group").removeClass("has-feedback has-error");
               }
       });

       $("#loan-products-form input").each(function(){
               if($(this).val()==""){
                   $(this).closest("div.form-group").addClass("has-feedback has-error");
               }else{
                   $(this).closest("div.form-group").removeClass("has-feedback has-error");
               }
       });
       $("#btn-save").attr("disabled",true);
       
    var formData = new FormData($('#form')[0]);
    $.ajax({
        type:'POST',
        url: "{!! route('loanproducts.store')!!}",
        data:formData,
        cache:false,
        contentType: false,
        processData: false,
        success:function(data){

         var obj = jQuery.parseJSON( data );

         $("#btn-save").attr("disabled",false);

            if(obj.status=='1'){
               location.reload();
                $.gritter.add({
                    title: 'Success',
                    text: obj.message,
                    sticky: false,
                    time: '1000',
                });
                $("#form")[0].reset();
                $("table tbody tr").remove();
            }else{
                $.gritter.add({
                    title: 'Fail',
                    text: obj.message,
                    sticky: false,
                    time: '5000',
                });
            }
        },error: function(data){
   $("#btn-save").attr("disabled",false);
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
   function clearingFeePaymentType(){
       $.ajax({
           type:'GET',
           url: "{!! url('/admin/getfeepaymenttype/')!!}/"+$("#clearing_fee_payment_type").val(),
           data:JSON.stringify({'_token':"{{ csrf_token() }}"}),
           cache:false,
           contentType: false,
           processData: false,
           success:function(data){
                   $("#disbursement_mode_clearing_fee").attr("required",false);
                   $("#payment_mode_clearing_fee").attr("required",false);
   
                   $("#disbursement_mode_clearing_fee").closest("div.form-group").css("display","none");
                   $("#payment_mode_clearing_fee").closest("div.form-group").css("display","none");
   
               var obj = jQuery.parseJSON( data );
               if(obj.code=="001"){
                   $("#disbursement_mode_clearing_fee").attr("required",false);
                   $("#payment_mode_clearing_fee").attr("required",true);
                   $("#disbursement_mode_clearing_fee").closest("div.form-group").css("display","none");
                   $("#payment_mode_clearing_fee").closest("div.form-group").css("display","block");
               }else if(obj.code=="002"){
                   $("#disbursement_mode_clearing_fee").attr("required",true);
                   $("#payment_mode_clearing_fee").attr("required",false);
   
                   $("#disbursement_mode_clearing_fee").closest("div.form-group").css("display","block");
                   $("#payment_mode_clearing_fee").closest("div.form-group").css("display","none");
               }else{
                   $("#disbursement_mode_clearing_fee").attr("required",false);
                   $("#payment_mode_clearing_fee").attr("required",false);
   
                   $("#disbursement_mode_clearing_fee").closest("div.form-group").css("display","none");
                   $("#payment_mode_clearing_fee").closest("div.form-group").css("display","none");
   
               }
           }
       });
   }
   function insuranceDeductionFeePaymentType(){
       $.ajax({
           type:'GET',
           url: "{!! url('/admin/getfeepaymenttype/')!!}/"+$("#insurance_deduction_fee_payment_type").val(),
           data:JSON.stringify({'_token':"{{ csrf_token() }}"}),
           cache:false,
           contentType: false,
           processData: false,
           success:function(data){
                   $("#disbursement_mode_insurance_deduction").attr("required",false);
                   $("#payment_mode_insurance_deduction").attr("required",false);
   
                   $("#disbursement_mode_insurance_deduction").closest("div.form-group").css("display","none");
                   $("#payment_mode_insurance_deduction").closest("div.form-group").css("display","none");
   
               var obj = jQuery.parseJSON( data );
               if(obj.code=="001"){
                   $("#disbursement_mode_insurance_deduction").attr("required",false);
                   $("#payment_mode_insurance_deduction").attr("required",true);
                   $("#disbursement_mode_insurance_deduction").closest("div.form-group").css("display","none");
                   $("#payment_mode_insurance_deduction").closest("div.form-group").css("display","block");
               }else if(obj.code=="002"){
                   $("#disbursement_mode_insurance_deduction").attr("required",true);
                   $("#payment_mode_insurance_deduction").attr("required",false);
   
                   $("#disbursement_mode_insurance_deduction").closest("div.form-group").css("display","block");
                   $("#payment_mode_insurance_deduction").closest("div.form-group").css("display","none");
               }else{
                   $("#disbursement_mode_insurance_deduction").attr("required",false);
                   $("#payment_mode_insurance_deduction").attr("required",false);
   
                   $("#disbursement_mode_insurance_deduction").closest("div.form-group").css("display","none");
                   $("#payment_mode_insurance_deduction").closest("div.form-group").css("display","none");
   
               }
           }
       });
   }
   
   function interestRateType(){
       $.ajax({
           type:'GET',
           url: "{!! url('/admin/getinterestratetype/')!!}/"+$("#interest_rate_type").val(),
           data:JSON.stringify({'_token':"{{ csrf_token() }}"}),
           cache:false,
           contentType: false,
           processData: false,
           success:function(data){
               var obj = jQuery.parseJSON( data );
               if(obj.code=="002"){
                   $("#compounds_per_year").closest("div.form-group").css("display","block");
               }else{
                   $("#compounds_per_year").closest("div.form-group").css("display","none");
               }
           }
       });
   }
   function minimumLoanAmount(){
       var minimumLoanAmount=Number($("#minimum_loan_amount").val());
       var maximumLoanAmount=Number($("#maximum_loan_amount").val());
       if(minimumLoanAmount<100 || minimumLoanAmount==null){
           alert("minimum loan amount cannot be less than 100 or empty!");
           if(maximumLoanAmount>100){
               $("#minimum_loan_amount").val(maximumLoanAmount-100);
   
           }else if(minimumLoanAmount>100){
               $("#minimum_loan_amount").val(minimumLoanAmount);
               $("#maximum_loan_amount").val(mimimumLoanAmount+100)
           }else{
               $("#minimum_loan_amount").val("100");
               $("#maximum_loan_amount").val(maximumLoanAmount+100)
           }
           return;
       }
   
       if($("#maximum_loan_amount").val()!=""){
           if(maximumLoanAmount<minimumLoanAmount){
               alert("Maximum loan amount cannot be less that minimum loan amount!");
               if(maximumLoanAmount>100){
                   $("#minimum_loan_amount").val(maximumLoanAmount-100);
   
               }else if(minimumLoanAmount>100){
                   $("#minimum_loan_amount").val(minimumLoanAmount);
                   $("#maximum_loan_amount").val(mimimumLoanAmount+100)
               }else{
                   $("#minimum_loan_amount").val("100");
                   $("#maximum_loan_amount").val(maximumLoanAmount+100)
               }
               return;
           }
       }
   
   }
   
   function maximumLoanAmount(){
       var minimumLoanAmount=Number($("#minimum_loan_amount").val());
       var maximumLoanAmount=Number($("#maximum_loan_amount").val());
       if(maximumLoanAmount<100 || maximumLoanAmount==null || maximumLoanAmount<minimumLoanAmount){
           alert("maximum loan amount cannot be less than 100 or less that minimum loan amount!");
           if(maximumLoanAmount>100){
               $("#minimum_loan_amount").val(maximumLoanAmount-100);
   
           }else{
               $("#minimum_loan_amount").val("100");
               $("#maximum_loan_amount").val(maximumLoanAmount+100)
           }
           return;        
       }    
   }
   function numberOfGuarantors(){
       var numberOfGuarantors=Number($("#number_of_guarantors").val());
       if(numberOfGuarantors>5){
           alert("Guarantors cannot be more than 5!");
           $("#number_of_guarantors").val(5);
           return;
       }
   }

   function getUnitPrice(e){

       var productId=$(e).val();

       $.get("{!!url('/admin/getproductbyid')!!}/"+productId, function (data) {

           $("#minimum_loan_amount").val(data.selling_price);

           $("#maximum_loan_amount").val(data.selling_price);

       });
   }   
</script>
@endsection
@section('script')
<script type="text/javascript">
   $(document).on("input", "#fine_charge,#interest_rate,#compounds_per_year,#lgf,#minimum_loan_amount,#maximum_loan_amount,#clearing_fee,#number_of_guarantors,#insurance_deduction_fee", function (e) {
       this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');
   });
       function productNumber(){
           $.ajax({
               type:'get',
               url: "{!! url('/admin/getloanproductcode')!!}",
               data:JSON.stringify({'_token':"{{ csrf_token() }}"}),
               contentType: 'application/json',
               processData: false,
               success:function(response){
                   $("#code").val(response);
                   console.log(response);
               }
           });        
       }
       productNumber();
</script>
@endsection