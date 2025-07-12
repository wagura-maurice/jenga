<?php
/**
* @author  Wanjala Innocent Khaemba
*Model - (Purchase Order Approvals)
*/
namespace App;
use Illuminate\Database\Eloquent\Model;
class PurchaseOrderApprovals extends Model
{
	public function purchaseordermodel(){
		return $this->belongsTo(PurchaseOrders::class, 'purchase_order');
	}
	public function approvalstatusmodel(){
		return $this->belongsTo(ApprovalStatuses::class, 'approval_status');
	}

	public function approvallevelmodel(){
		return $this->belongsTo(ApprovalLevels::class, 'approval_level');
	}	

	public function usermodel(){
		return $this->belongsTo(Users::class, 'user');
	}		
}