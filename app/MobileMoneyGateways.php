<?php
/**
* @author  Wanjala Innocent Khaemba
*Model - (mobile money gateways)
*/
namespace App;
use Illuminate\Database\Eloquent\Model;
class MobileMoneyGateways extends Model
{
	public function settlementaccountmodel(){
		return $this->belongsTo(Accounts::class, 'settlement_account');
	}
}