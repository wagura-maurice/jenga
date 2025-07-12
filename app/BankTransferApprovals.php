<?php
/**
* @author  Wanjala Innocent Khaemba
*Model - (bank transfer approvals)
*/
namespace App;
use Illuminate\Database\Eloquent\Model;
class BankTransferApprovals extends Model
{
	public function banktransfermodel(){
		return $this->belongsTo(LgfToBankTransfers::class, 'bank_transfer');
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
	public function useraccountmodel(){
		return $this->belongsTo(UsersAccounts::class, 'user_account');
	}
}