<?php
/**
* @author  Wanjala Innocent Khaemba
*Model - (inventory transfer approvals)
*/
namespace App;
use Illuminate\Database\Eloquent\Model;
class InventoryTransferApprovals extends Model
{
	public function inventorytransfermodel(){
		return $this->belongsTo(LgfToInventoryTransfers::class, 'inventory_transfer');
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