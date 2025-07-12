<?php
/**
* @author  Wanjala Innocent Khaemba
*Model - ()
*/
namespace App;
use Illuminate\Database\Eloquent\Model;
class ClientGuarantors extends Model
{
	public function clientmodel(){
		return $this->belongsTo(Clients::class, 'client');
	}
	public function guarantormodel(){
		return $this->belongsTo(Guarantors::class, 'guarantor');
	}
}