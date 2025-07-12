<?php
/**
* @author  Wanjala Innocent Khaemba
*Model - (account transfer approval levels)
*/
namespace App;
use Illuminate\Database\Eloquent\Model;
class AccountTransferApprovalLevels extends Model
{
	public function approvallevelmodel(){
		return $this->belongsTo(ApprovalLevels::class, 'approval_level');
	}
	public function useraccountmodel(){
		return $this->belongsTo(UsersAccounts::class, 'user_account');
	}
}