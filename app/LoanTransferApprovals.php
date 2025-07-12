<?php
/**
* @author  Wanjala Innocent Khaemba
*Model - (loan transfer approvals)
*/
namespace App;
use Illuminate\Database\Eloquent\Model;
class LoanTransferApprovals extends Model
{
	public function loantransfermodel(){
		return $this->belongsTo(LgfToLoanTransfers::class, 'loan_transfer');
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
		return $this->belongsTo(UsersAccounts::class, 'users_accounts');
	}
}