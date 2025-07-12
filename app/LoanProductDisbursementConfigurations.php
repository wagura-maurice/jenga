<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class LoanProductDisbursementConfigurations extends Model
{
	public function loanproductmodel(){
		return $this->belongsTo(LoanProducts::class, 'loan_product');
	}
	public function modeofdisbursementmodel(){
		return $this->belongsTo(DisbursementModes::class, 'mode_of_disbursement');
	}
	public function debitaccountmodel(){
		return $this->belongsTo(Accounts::class, 'debit_account');
	}
	public function creditaccountmodel(){
		return $this->belongsTo(Accounts::class, 'credit_account');
	}
}