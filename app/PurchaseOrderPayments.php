<?php
/**
* @author  Wanjala Innocent Khaemba
*Model - (purchase order payments)
*/
namespace App;
use Illuminate\Database\Eloquent\Model;
class PurchaseOrderPayments extends Model
{
	public function purchaseordermodel(){
		return $this->belongsTo(PurchaseOrders::class, 'purchase_order');
	}
	public function paymentmodemodel(){
		return $this->belongsTo(PaymentModes::class, 'payment_mode');
	}
}