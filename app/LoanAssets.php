<?php
/**
* @author  Wanjala Innocent Khaemba
*Model - ()
*/
namespace App;
use Illuminate\Database\Eloquent\Model;
class LoanAssets extends Model
{
	public function loanmodel(){
		return $this->belongsTo(Loans::class, 'loan');
	}
	public function assetmodel(){
		return $this->belongsTo(Products::class, 'asset');
	}
}