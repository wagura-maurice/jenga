<?php
/**
* @author  Wanjala Innocent Khaemba
*Model - ()
*/
namespace App;
use Illuminate\Database\Eloquent\Model;
class WithdrawalChargeConfigurations extends Model
{
	public function clienttypemodel(){
		return $this->belongsTo(ClientTypes::class, 'client_type');
	}
	public function withdrawalmodemodel(){
		return $this->belongsTo(WithdrawalModes::class, 'withdrawal_mode');
	}
	public function chargetypemodel(){
		return $this->belongsTo(FeeTypes::class, 'charge_type');
	}
}