<?php
/**
* @author  Wanjala Innocent Khaemba
*Model - (manages insurance deduction fee approvals data)
*/
namespace App;
use Illuminate\Database\Eloquent\Model;
class InsuranceDeductionApprovalLevels extends Model
{
	public function approvallevelmodel(){
		return $this->belongsTo(ApprovalLevels::class, 'approval_level');
	}
	public function useraccountmodel(){
		return $this->belongsTo(UsersAccounts::class, 'user_account');
	}
}