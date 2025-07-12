<?php
/**
* @author  Wanjala Innocent Khaemba
*Model - (sales order payments)
*/
namespace App;
use Illuminate\Database\Eloquent\Model;
class SalesOrderPayments extends Model
{
	public function salesordermodel(){
		return $this->belongsTo(SalesOrders::class, 'sales_order');
	}
	public function paymentmodemodel(){
		return $this->belongsTo(PaymentModes::class, 'payment_mode');
	}
}