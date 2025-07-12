<?php
/**
* @author  Wanjala Innocent Khaemba
*Model - (bank transfer configurations)
*/
namespace App;
use Illuminate\Database\Eloquent\Model;
class BankTransferConfigurations extends Model
{
	public function clienttypemodel(){
		return $this->belongsTo(ClientTypes::class, 'client_type');
	}
	public function debitaccountmodel(){
		return $this->belongsTo(Accounts::class, 'debit_account');
	}
	public function creditaccountmodel(){
		return $this->belongsTo(Accounts::class, 'credit_account');
	}
}