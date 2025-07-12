<?php
/**
* @author  Wanjala Innocent Khaemba
*Model - (lgf to loan transfers)
*/
namespace App;
use Illuminate\Database\Eloquent\Model;
class LgfToLoanTransfers extends Model
{
	public function clientmodel(){
		return $this->belongsTo(Clients::class, 'client');
	}
	public function loanmodel(){
		return $this->belongsTo(Loans::class, 'loan');
	}
	public function initiatedbymodel(){
		return $this->belongsTo(Users::class, 'initiated_by');
	}
	public function approvalstatusmodel(){
		return $this->belongsTo(ApprovalStatuses::class, 'approval_status');
	}
}