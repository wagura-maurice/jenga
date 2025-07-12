<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class LoanApprovals extends Model
{
	public function loanmodel(){
		return $this->belongsTo(Loans::class, 'loan');
	}
	public function levelmodel(){
		return $this->belongsTo(ApprovalLevels::class, 'level');
	}
	public function useraccountmodel(){
		return $this->belongsTo(UsersAccounts::class, 'user_account');
	}
	public function usermodel(){
		return $this->belongsTo(Users::class, 'user');
	}
	public function statusmodel(){
		return $this->belongsTo(ApprovalStatuses::class, 'status');
	}
}