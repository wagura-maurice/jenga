<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class LoanProducts extends Model
{
	public function graceperiodmodel(){
		return $this->belongsTo(GracePeriods::class, 'grace_period');
	}
	public function mingraceperiodmodel(){
		return $this->belongsTo(GracePeriods::class, 'min_grace_period');
	}
	public function maxgraceperiodmodel(){
		return $this->belongsTo(GracePeriods::class, 'max_grace_period');
	}
	public function interestrateperiodmodel(){
		return $this->belongsTo(InterestRatePeriods::class, 'interest_rate_period');
	}

	public function modeofdisbursementmodel(){
		return $this->belongsTo(DisbursementModes::class, 'mode_of_disbursement');
	}
	public function loanpaymentfrequencymodel(){
		return $this->belongsTo(LoanPaymentFrequencies::class, 'loan_payment_frequency');
	}	
	public function clearingfeepaymenttypemodel(){
		return $this->belongsTo(FeePaymentTypes::class,'clearing_fee_payment_type');
	}
	public function clearingfeetypemodel(){
		return $this->belongsTo(FeeTypes::class,'clearing_fee_type');
	}
	public function lgftypemodel(){
		return $this->belongsTo(FeeTypes::class,'lgf_type');
	}

	public function processingfeepaymenttypemodel(){
		return $this->belongsTo(FeePaymentTypes::class,'processing_fee_payment_type');
	}
	public function processingfeetypemodel(){
		return $this->belongsTo(FeeTypes::class,'processing_fee_type');
	}

	public function insurancedeductionfeepaymenttypemodel(){
		return $this->belongsTo(FeePaymentTypes::class,'insurance_deduction_fee_payment_type');
	}
	public function insurancedeductionfeetypemodel(){
		return $this->belongsTo(FeeTypes::class,'insurance_deduction_fee_type');
	}
	public function finetypemodel(){
		return $this->belongsTo(FineTypes::class, 'fine_type');
	}
	public function graceperiodtypemodel(){
		return $this->belongsTo(GracePeriodTypes::class,'grace_period_type');
	}
	public function finechargefrequencymodel(){
		return $this->belongsTo(FineChargeFrequencies::class, 'fine_charge_frequency');
	}
	public function finechargeperiodmodel(){
		return $this->belongsTo(FineChargePeriods::class, 'fine_charge_period');
	}
	public function interestratetypemodel(){
		return $this->belongsTo(InterestRateTypes::class, 'interest_rate_type');
	}
	public function interestpaymentmethodmodel(){
		return $this->belongsTo(InterestPaymentMethods::class, 'interest_payment_method');
	}
	public function loanpaymentdurationmodel(){
		return $this->belongsTo(LoanPaymentDurations::class, 'loan_payment_duration');
	}
	public function minimummembershipperiodmodel(){
		return $this->belongsTo(MinimumMembershipPeriods::class, 'minimum_membership_period');
	}
	public function assetmodel(){
		return $this->belongsTo(Products::class, 'asset');
	}	
}