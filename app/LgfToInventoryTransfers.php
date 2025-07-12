<?php
/**
* @author  Wanjala Innocent Khaemba
*Model - (lgf to inventory transfers)
*/
namespace App;
use Illuminate\Database\Eloquent\Model;
class LgfToInventoryTransfers extends Model
{
	public function clientmodel(){
		return $this->belongsTo(Clients::class, 'client');
	}
	public function purchaseordermodel(){
		return $this->belongsTo(PurchaseOrders::class, 'purchase_order');
	}
	public function initiatedbymodel(){
		return $this->belongsTo(Users::class, 'initiated_by');
	}
	public function approvalstatusmodel(){
		return $this->belongsTo(ApprovalStatuses::class, 'approval_status');
	}
}