<?php
/**
* @author  Wanjala Innocent Khaemba
*Model - (mobile money charge configurations)
*/
namespace App;
use Illuminate\Database\Eloquent\Model;
class MobileMoneyChargeConfigurations extends Model
{
	public function clienttypemodel(){
		return $this->belongsTo(ClientTypes::class, 'client_type');
	}
	public function mobilemoneymodesmodel(){
		return $this->belongsTo(MobileMoneyModes::class, 'mobile_money_modes');
	}
	public function chargetypemodel(){
		return $this->belongsTo(FeeTypes::class, 'charge_type');
	}
}