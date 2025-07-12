<?php
/**
* @author  Wanjala Innocent Khaemba
*Model - (Sales Orders)
*/
namespace App;
use Illuminate\Database\Eloquent\Model;
class SalesOrders extends Model
{
	public function orderstatusmodel(){
		return $this->belongsTo(OrderStatuses::class, 'order_status');
	}

	public function storemodel(){
		return $this->belongsTo(Stores::class, 'store');
	}	
}