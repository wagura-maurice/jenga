<?php
/**
* @author  Wanjala Innocent Khaemba
*Model - (mobile money charge scales)
*/
namespace App;
use Illuminate\Database\Eloquent\Model;
class MobileMoneyChargeScales extends Model
{
	public function mobilemoneychargemodel(){
		return $this->belongsTo(MobileMoneyChargeConfigurations::class, 'mobile_money_charge');
	}
	public function chargetypemodel(){
		return $this->belongsTo(FeeTypes::class, 'charge_type');
	}
}