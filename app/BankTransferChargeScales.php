<?php
/**
* @author  Wanjala Innocent Khaemba
*Model - (bank transfer charge scales)
*/
namespace App;
use Illuminate\Database\Eloquent\Model;
class BankTransferChargeScales extends Model
{
	public function banktransferchargemodel(){
		return $this->belongsTo(BankTransferCharges::class, 'bank_transfer_charge');
	}
	public function chargetypemodel(){
		return $this->belongsTo(FeeTypes::class, 'charge_type');
	}
}