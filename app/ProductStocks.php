<?php
/**
* @author  Wanjala Innocent Khaemba
*Model - (product stocks)
*/
namespace App;
use Illuminate\Database\Eloquent\Model;
class ProductStocks extends Model
{
	public function productmodel(){
		return $this->belongsTo(Products::class, 'product');
	}
	public function storemodel(){
		return $this->belongsTo(Stores::class, 'store');
	}
}