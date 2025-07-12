<?php
/**
* @author  Wanjala Innocent Khaemba
*Model - (Sales Order Lines)
*/
namespace App;
use Illuminate\Database\Eloquent\Model;
class SalesOrderLines extends Model
{
	public function productmodel(){
		return $this->belongsTo(Products::class, 'product');
	}
	public function salesordermodel(){
		return $this->belongsTo(SalesOrders::class, 'sales_order');
	}	
}