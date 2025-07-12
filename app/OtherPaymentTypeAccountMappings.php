<?php
/**
* @author  Wanjala Innocent Khaemba
*Model - (other payment type account mappings)
*/
namespace App;
use Illuminate\Database\Eloquent\Model;
class OtherPaymentTypeAccountMappings extends Model
{
	public function otherpaymenttypemodel(){
		return $this->belongsTo(OtherPaymentTypes::class, 'other_payment_type');
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