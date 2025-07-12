<?php
/**
* @author  Wanjala Innocent Khaemba
*Model - (lgf to fine transfers)
*/
namespace App;
use Illuminate\Database\Eloquent\Model;
class LgfToFineTransfers extends Model
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