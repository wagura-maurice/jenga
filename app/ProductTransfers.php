<?php
/**
* @author  Wanjala Innocent Khaemba
*Model - (Product Transfers)
*/
namespace App;
use Illuminate\Database\Eloquent\Model;
class ProductTransfers extends Model
{
	public function productmodel(){
		return $this->belongsTo(Products::class, 'product');
	}
	public function storefrommodel(){
		return $this->belongsTo(Stores::class, 'store_from');
	}
	public function storetomodel(){
		return $this->belongsTo(Stores::class, 'store_to');
	}
	public function producttransferstatusmodel(){
		return $this->belongsTo(ProductTransferStatuses::class, 'product_transfer_status');
	}	
}