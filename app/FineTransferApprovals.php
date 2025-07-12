<?php
/**
* @author  Wanjala Innocent Khaemba
*Model - (fine transfer approvals)
*/
namespace App;
use Illuminate\Database\Eloquent\Model;
class FineTransferApprovals extends Model
{
	public function finetransfermodel(){
		return $this->belongsTo(LgfToFineTransfers::class, 'fine_transfer');
	}
	public function approvallevelmodel(){
		return $this->belongsTo(ApprovalLevels::class, 'approval_level');
	}
	public function approvalstatusmodel(){
		return $this->belongsTo(ApprovalStatuses::class, 'approval_status');
	}
	public function approvedbymodel(){
		return $this->belongsTo(Users::class, 'approved_by');
	}
	public function usersaccountsmodel(){
		return $this->belongsTo(UsersAccounts::class, 'users_accounts');
	}
}