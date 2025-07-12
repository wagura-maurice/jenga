<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class LoanProductApprovalLevels extends Model
{
	public function loanproductmodel(){
		return $this->belongsTo(LoanProducts::class, 'loan_product');
	}
	public function levelmodel(){
		return $this->belongsTo(ApprovalLevels::class, 'level');
	}
	public function useraccountmodel(){
		return $this->belongsTo(UsersAccounts::class, 'user_account');
	}
}