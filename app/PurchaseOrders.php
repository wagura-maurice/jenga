<?php
/**
* @author  Wanjala Innocent Khaemba
*Model - (Purchases)
*/
namespace App;
use Illuminate\Database\Eloquent\Model;
class PurchaseOrders extends Model
{
	public function suppliermodel(){
		return $this->belongsTo(Suppliers::class, 'supplier');
	}

	public function orderstatusmodel(){
		return $this->belongsTo(OrderStatuses::class, 'order_status');
	}	

	public function storemodel(){
		return $this->belongsTo(Stores::class, 'store');
	}	

	public function approvalstatusmodel(){
		return $this->belongsTo(ApprovalStatuses::class, 'approval_status');
	}			
}