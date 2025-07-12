<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Loans extends Model
{
	use SoftDeletes;
	
	protected $guarded = array();
	
	public function loanproductmodel(){
		return $this->belongsTo(LoanProducts::class, 'loan_product');
	}
	public function clientmodel(){
		return $this->belongsTo(Clients::class, 'client');
	}
	
	public function interestratetypemodel(){
		return $this->belongsTo(InterestRateTypes::class, 'interest_rate_type');
	}
	public function interestrateperiodmodel(){
		return $this->belongsTo(InterestRatePeriods::class, 'interest_rate_period');
	}

	public function interestpaymentmethodmodel(){
		return $this->belongsTo(InterestPaymentMethods::class, 'interest_payment_method');
	}
	
	public function loanpaymentdurationmodel(){
		return $this->belongsTo(LoanPaymentDurations::class, 'loan_payment_duration');
	}
	public function loanpaymentfrequencymodel(){
		return $this->belongsTo(LoanPaymentFrequencies::class, 'loan_payment_frequency');
	}
	public function graceperiodmodel(){
		return $this->belongsTo(GracePeriods::class, 'grace_period');
	}
	public function modeofdisbursementmodel(){
		return $this->belongsTo(DisbursementModes::class, 'disbursement_mode');
	}
	public function finetypemodel(){
		return $this->belongsTo(FineTypes::class, 'fine_type');
	}
	public function finechargefrequencymodel(){
		return $this->belongsTo(FineChargeFrequencies::class, 'fine_charge_frequency');
	}
	public function finechargeperiodmodel(){
		return $this->belongsTo(FineChargePeriods::class, 'fine_charge_period');
	}
	public function loanstatusmodel(){
		return $this->belongsTo(LoanStatuses::class, 'status');
	}

	public function storemodel(){
		return $this->belongsTo(Stores::class, 'store');
	}	
	public function loan_payments(){
		return $this->hasMany('App\LoanPayments', 'loan')->orderBy('id', 'desc');
	}
	public function getClearingFee($clearingFeeTypeCode,$clearingFee,$loanAmount){

		if($clearingFeeTypeCode=="001"){
			return round(($loanAmount*$clearingFee/100),2);
		}else{
			return $clearingFee;
		}
	}

	public function getInsuranceDeductionFee($insuranceDeductionFeeTypeCode,$insuranceDeductionFeeValue,$loanAmount){
		if($insuranceDeductionFeeTypeCode=="001"){
			return round(($loanAmount*$insuranceDeductionFeeValue/100),2);
		}else{
			return $insuranceDeductionFeeValue;
		}
	}

	public function getProcessingFee($processingFeeTypeCode,$processingFeeValue,$loanAmount){

		if($processingFeeTypeCode=="001"){
			return round(($loanAmount*$processingFeeValue/100),2);
		}else{
			return $processingFeeValue;
		}
	}

	public function getInterestCharged($loanAmount,$interestRate,$interestRateTypeCode,$interestRatePeriodDays,$loanPaymmentDurationDays){
		if($interestRateTypeCode=='001'){
			$interestCharged=($loanAmount*$interestRate/100)*($loanPaymmentDurationDays/$interestRatePeriodDays);
			
			return round($interestCharged, 2);
		}else if($interestRateTypeCode=='002'){
			return 0;
		}
	}
	public function getTotalLoanAmount($loanAmount,$interestCharged,$interestPaymentMethodCode){

		if($interestPaymentMethodCode=='001'){
			return $loanAmount;
		}else {
			return ($loanAmount+$interestCharged);
		}
	}
	public function getAmountToBeDisbursed($loanAmount,$interestCharged,$interestPaymentMethodCode,$clearingFee,$insuranceDeductionFee,$processingFee){
		
		if($interestPaymentMethodCode=='001'){
			return ($loanAmount-$interestCharged-$clearingFee-$insuranceDeductionFee-$processingFee);
		}else{
			return ($loanAmount-$clearingFee-$insuranceDeductionFee-$processingFee);
		}

	}

}