<?php
/**
* @author  Wanjala Innocent Khaemba
*/
namespace App;
use Illuminate\Database\Eloquent\Model;
class ChangeGroupRequests extends Model
{
	public function clientmodel(){
		return $this->belongsTo(Clients::class, 'client');
	}
	public function currentgroupmodel(){
		return $this->belongsTo(Groups::class, 'current_group');
	}
	public function newgroupmodel(){
		return $this->belongsTo(Groups::class, 'new_group');
	}
	public function statusmodel(){
		return $this->belongsTo(ChangeGroupRequestStatuses::class, 'status');
	}
}