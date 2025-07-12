<?php
/**
* @author  Wanjala Innocent Khaemba
*/
namespace App;
use Illuminate\Database\Eloquent\Model;
class ProductApprovalLevels extends Model
{
	public function loanproductmodel(){
		return $this->belongsTo(LoanProducts::class, 'loan_product');
	}
	public function approvallevelmodel(){
		return $this->belongsTo(ApprovalLevels::class, 'approval_level');
	}
	public function useraccountmodel(){
		return $this->belongsTo(UsersAccounts::class, 'user_account');
	}
}