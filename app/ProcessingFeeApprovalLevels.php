<?php
/**
* @author  Wanjala Innocent Khaemba
*Model - (manages processing fee approval levels)
*/
namespace App;
use Illuminate\Database\Eloquent\Model;
class ProcessingFeeApprovalLevels extends Model
{
	public function approvallevelmodel(){
		return $this->belongsTo(ApprovalLevels::class, 'approval_level');
	}
	public function useraccountmodel(){
		return $this->belongsTo(UsersAccounts::class, 'user_account');
	}
}