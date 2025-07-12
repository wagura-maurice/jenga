<?php
/**
* @author  Wanjala Innocent Khaemba
*Model - ()
*/
namespace App;
use Illuminate\Database\Eloquent\Model;
class MpesaTransactionFeeConfigurations extends Model
{
	public function loanproductmodel(){
		return $this->belongsTo(LoanProducts::class, 'loan_product');
	}
	public function feetypemodel(){
		return $this->belongsTo(FeeTypes::class, 'fee_type');
	}
	public function feepaymenttypemodel(){
		return $this->belongsTo(FeePaymentTypes::class, 'fee_payment_type');
	}
	public function paymentmodemodel(){
		return $this->belongsTo(PaymentModes::class, 'payment_mode');
	}
	public function disbursementmodemodel(){
		return $this->belongsTo(DisbursementModes::class, 'disbursement_mode');
	}
	public function debitaccountmodel(){
		return $this->belongsTo(Accounts::class, 'debit_account');
	}
	public function creditaccountmodel(){
		return $this->belongsTo(Accounts::class, 'credit_account');
	}
}