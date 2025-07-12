<?php
/**
* @author  Wanjala Innocent Khaemba
*Model - (Product Purchases)
*/
namespace App;
use Illuminate\Database\Eloquent\Model;
class Purchases extends Model
{
	public function suppliermodel(){
		return $this->belongsTo(Suppliers::class, 'supplier');
	}
	public function productmodel(){
		return $this->belongsTo(Products::class, 'product');
	}
}