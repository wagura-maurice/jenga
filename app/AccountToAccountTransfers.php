<?php
/**
* @author  Wanjala Innocent Khaemba
*Model - (account to account transfers)
*/
namespace App;
use Illuminate\Database\Eloquent\Model;
class AccountToAccountTransfers extends Model
{
	public function accountfrommodel(){
		return $this->belongsTo(Accounts::class, 'account_from');
	}
	public function accounttomodel(){
		return $this->belongsTo(Accounts::class, 'account_to');
	}
	public function initiatedbymodel(){
		return $this->belongsTo(Users::class, 'initiated_by');
	}
	public function approvalstatusmodel(){
		return $this->belongsTo(ApprovalStatuses::class, 'approval_status');
	}
}