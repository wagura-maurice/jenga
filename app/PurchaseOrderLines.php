<?php
/**
* @author  Wanjala Innocent Khaemba
*Model - (purchase order lines)
*/
namespace App;
use Illuminate\Database\Eloquent\Model;
class PurchaseOrderLines extends Model
{
	public function purchaseordermodel(){
		return $this->belongsTo(PurchaseOrders::class, 'purchase_order');
	}
	public function productmodel(){
		return $this->belongsTo(Products::class, 'product');
	}
}