<?php
/**
* @author  Wanjala Innocent Khaemba
*Model - (account transfer approvals)
*/
namespace App;
use Illuminate\Database\Eloquent\Model;
class AccountTransferApprovals extends Model
{
	public function accounttransfermodel(){
		return $this->belongsTo(AccountToAccountTransfers::class, 'account_transfer');
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