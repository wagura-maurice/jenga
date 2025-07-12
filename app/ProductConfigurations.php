<?php
/**
* @author  Wanjala Innocent Khaemba
*Model - (manages product configurations data)
*/
namespace App;
use Illuminate\Database\Eloquent\Model;
class ProductConfigurations extends Model
{
	public function loanproductmodel(){
		return $this->belongsTo(LoanProducts::class, 'loan_product');
	}
	public function debitaccountmodel(){
		return $this->belongsTo(Accounts::class, 'debit_account');
	}
	public function creditaccountmodel(){
		return $this->belongsTo(Accounts::class, 'credit_account');
	}
}