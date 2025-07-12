<?php
/**
* @author  Wanjala Innocent Khaemba
*Model - (manages processing fee approvals data)
*/
namespace App;
use Illuminate\Database\Eloquent\Model;
class ProcessingFeeApprovals extends Model
{
	public function transactionreferencemodel(){
		return $this->belongsTo(ProcessingFeePayments::class, 'transaction_reference');
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