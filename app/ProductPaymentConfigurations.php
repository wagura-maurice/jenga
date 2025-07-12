<?php
/**
* @author  Wanjala Innocent Khaemba
*Model - (Product Payment Configurations)
*/
namespace App;
use Illuminate\Database\Eloquent\Model;
class ProductPaymentConfigurations extends Model
{
	public function prodcuctmodel(){
		return $this->belongsTo(Products::class, 'prodcuct');
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