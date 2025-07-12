<?php
/**
* @author  Wanjala Innocent Khaemba
*Model - (mobile money transaction charge configurations)
*/
namespace App;
use Illuminate\Database\Eloquent\Model;
class MobileMoneyTransactionChargeConfigurations extends Model
{
	public function clienttypemodel(){
		return $this->belongsTo(ClientTypes::class, 'client_type');
	}
	public function mobilemoneymodemodel(){
		return $this->belongsTo(MobileMoneyModes::class, 'mobile_money_mode');
	}
	public function debitaccountmodel(){
		return $this->belongsTo(Accounts::class, 'debit_account');
	}
	public function creditaccountmodel(){
		return $this->belongsTo(Accounts::class, 'credit_account');
	}
}