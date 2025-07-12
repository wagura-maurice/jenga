<?php
/**
* @author  Wanjala Innocent Khaemba
*Model - (manages insurance deduction approvals data)
*/
namespace App;
use Illuminate\Database\Eloquent\Model;
class InsuranceDeductionApprovals extends Model
{
	public function transactionreferencemodel(){
		return $this->belongsTo(InsuranceDeductionPayments::class, 'transaction_reference');
	}
	public function approvallevelmodel(){
		return $this->belongsTo(ApprovalLevels::class, 'approval_level');
	}
	public function approvedbymodel(){
		return $this->belongsTo(Users::class, 'approved_by');
	}
	public function approvalstatusmodel(){
		return $this->belongsTo(TransactionStatuses::class, 'approval_status');
	}
}