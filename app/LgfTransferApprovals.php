<?php
/**
* @author  Wanjala Innocent Khaemba
*Model - (lgf transfer approvals)
*/
namespace App;
use Illuminate\Database\Eloquent\Model;
class LgfTransferApprovals extends Model
{
	public function lgftransfermodel(){
		return $this->belongsTo(LgfToLgfTransfers::class, 'lgf_transfer');
	}
	public function approvallevelmodel(){
		return $this->belongsTo(ApprovalLevels::class, 'approval_level');
	}
	public function approvalstatusmodel(){
		return $this->belongsTo(ApprovalStatuses::class, 'approval_status');
	}
	public function useraccountmodel(){
		return $this->belongsTo(UsersAccounts::class, 'user_account');
	}
	public function approvedbymodel(){
		return $this->belongsTo(Users::class, 'approved_by');
	}
}