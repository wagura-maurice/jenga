<?php
/**
* @author  Wanjala Innocent Khaemba
*Model - (lgf to bank transfers)
*/
namespace App;
use Illuminate\Database\Eloquent\Model;
class LgfToBankTransfers extends Model
{
	public function clientmodel(){
		return $this->belongsTo(Clients::class, 'client');
	}
	public function bankmodel(){
		return $this->belongsTo(Banks::class, 'bank');
	}
	public function bankbranchmodel(){
		return $this->belongsTo(BankBranches::class, 'bank_branch');
	}
	public function initiatedbymodel(){
		return $this->belongsTo(Users::class, 'initiated_by');
	}
	public function approvalstatusmodel(){
		return $this->belongsTo(ApprovalStatuses::class, 'approval_status');
	}
}