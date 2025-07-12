<?php
/**
* @author  Wanjala Innocent Khaemba
*Model - (client exit approval levels)
*/
namespace App;
use Illuminate\Database\Eloquent\Model;
class ClientExitApprovalLevels extends Model
{
	public function clienttypemodel(){
		return $this->belongsTo(ClientTypes::class, 'client_type');
	}
	public function useraccountmodel(){
		return $this->belongsTo(UsersAccounts::class, 'user_account');
	}
	public function approvallevelmodel(){
		return $this->belongsTo(ApprovalLevels::class, 'approval_level');
	}
}