<?php
/**
* @author  Wanjala Innocent Khaemba
*Model - ()
*/
namespace App;
use Illuminate\Database\Eloquent\Model;
class LoanProductAssets extends Model
{
	public function loanproductmodel(){
		return $this->belongsTo(LoanProducts::class, 'loan_product');
	}
	public function assetmodel(){
		return $this->belongsTo(Products::class, 'asset');
	}
}