<?php
/**
* @author  Wanjala Innocent Khaemba
*Model - ()
*/
namespace App;
use Illuminate\Database\Eloquent\Model;
class SalesOrderMarginAccountMappings extends Model
{
	public function productmodel(){
		return $this->belongsTo(Products::class, 'product');
	}
	public function paymentmodemodel(){
		return $this->belongsTo(PaymentModes::class, 'payment_mode');
	}
	public function debitaccountmodel(){
		return $this->belongsTo(Accounts::class, 'debit_account');
	}
	public function creditaccountmodel(){
		return $this->belongsTo(Accounts::class, 'credit_account');
	}
}