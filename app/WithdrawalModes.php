<?php
/**
* @author  Wanjala Innocent Khaemba
*Model - (withdrawal modes)
*/
namespace App;
use Illuminate\Database\Eloquent\Model;
class WithdrawalModes extends Model
{
	public function transactiongatewaymodel(){
		return $this->belongsTo(TransactionGateways::class, 'transaction_gateway');
	}
	public function settlementaccountmodel(){
		return $this->belongsTo(Accounts::class, 'settlement_account');
	}
}