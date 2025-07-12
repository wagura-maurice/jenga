<?php
/**
* @author  Wanjala Innocent Khaemba
*/
namespace App;
use Illuminate\Database\Eloquent\Model;
class ChangeTypeRequests extends Model
{
	public function clientmodel(){
		return $this->belongsTo(Clients::class, 'client');
	}
	public function currenttypemodel(){
		return $this->belongsTo(ClientTypes::class, 'current_type');
	}
	public function newtypemodel(){
		return $this->belongsTo(ClientTypes::class, 'new_type');
	}
	public function statusmodel(){
		return $this->belongsTo(ChangeTypeRequestStatuses::class, 'status');
	}
}