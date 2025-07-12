<?php
/**
* @author  Wanjala Innocent Khaemba
*Model - (bank transfer charges)
*/
namespace App;
use Illuminate\Database\Eloquent\Model;
class BankTransferCharges extends Model
{
	public function clienttypemodel(){
		return $this->belongsTo(ClientTypes::class, 'client_type');
	}
}