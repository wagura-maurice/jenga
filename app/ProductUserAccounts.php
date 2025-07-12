<?php
/**
* @author  Wanjala Innocent Khaemba
*Model - (manages loan product user accounts that can access is)
*/
namespace App;
use Illuminate\Database\Eloquent\Model;
class ProductUserAccounts extends Model
{
	public function loanproductmodel(){
		return $this->belongsTo(LoanProducts::class, 'loan_product');
	}
	public function useraccountmodel(){
		return $this->belongsTo(UsersAccounts::class, 'user_account');
	}
}