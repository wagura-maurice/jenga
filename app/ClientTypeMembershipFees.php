<?php
/**
* @author  Wanjala Innocent Khaemba
*/
namespace App;
use Illuminate\Database\Eloquent\Model;
class ClientTypeMembershipFees extends Model
{
	public function clienttypemodel(){
		return $this->belongsTo(ClientTypes::class, 'client_type');
	}
}