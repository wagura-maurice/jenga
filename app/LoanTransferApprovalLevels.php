<?php
/**
* @author  Wanjala Innocent Khaemba
*Model - (loan transfer approval levels)
*/
namespace App;
use Illuminate\Database\Eloquent\Model;
class LoanTransferApprovalLevels extends Model
{
	public function approvallevelmodel(){
		return $this->belongsTo(ApprovalLevels::class, 'approval_level');
	}
	public function useraccountmodel(){
		return $this->belongsTo(UsersAccounts::class, 'user_account');
	}
	public function clienttypemodel(){
		return $this->belongsTo(ClientTypes::class, 'client_type');
	}
}