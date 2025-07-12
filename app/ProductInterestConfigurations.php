<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class ProductInterestConfigurations extends Model
{
	public function loanproductmodel(){
		return $this->belongsTo(LoanProducts::class, 'loan_product');
	}
	public function interestpaymentmethodmodel(){
		return $this->belongsTo(InterestPaymentMethods::class, 'interest_payment_method');
	}
	public function paymentmodemodel(){
		return $this->belongsTo(PaymentModes::class, 'payment_mode');
	}
	public function debitaccountmodel(){
		return $this->belongsTo(Accounts::class, 'debit_account');
	}
	public function creditaccountmodel(){
		return $this->belongsTo(Accounts::class, 'credit_account');
	}
	
}