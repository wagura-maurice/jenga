<?php
/**
* @author  Wanjala Innocent Khaemba
*Model - ()
*/
namespace App;
use Illuminate\Database\Eloquent\Model;
class ProductDisbursementConfigurations extends Model
{
	public function loanproductmodel(){
		return $this->belongsTo(LoanProducts::class, 'loan_product');
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