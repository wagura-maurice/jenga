<?php
/**
* @author  Wanjala Innocent Khaemba
*Model - (lgf to mobile money transfers)
*/
namespace App;
use Illuminate\Database\Eloquent\Model;
class LgfToMobileMoneyTransfers extends Model
{
	public function clientmodel(){
		return $this->belongsTo(Clients::class, 'client');
	}
	public function initiatedbymodel(){
		return $this->belongsTo(Users::class, 'initiated_by');
	}
	public function approvalstatusmodel(){
		return $this->belongsTo(ApprovalStatuses::class, 'approval_status');
	}
}