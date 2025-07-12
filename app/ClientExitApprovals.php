<?php
/**
* @author  Wanjala Innocent Khaemba
*Model - (client exit approvals)
*/
namespace App;
use Illuminate\Database\Eloquent\Model;
class ClientExitApprovals extends Model
{
	public function clientexitmodel(){
		return $this->belongsTo(ClientExits::class, 'client_exit');
	}
	public function approvedbymodel(){
		return $this->belongsTo(Users::class, 'approved_by');
	}
	public function useraccountmodel(){
		return $this->belongsTo(UsersAccounts::class, 'user_account');
	}
	public function approvalstatusmodel(){
		return $this->belongsTo(ApprovalStatuses::class, 'approval_status');
	}
	public function approvallevelmodel(){
		return $this->belongsTo(ApprovalLevels::class, 'approval_level');
	}
}