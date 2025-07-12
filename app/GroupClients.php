<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class GroupClients extends Model
{
	public function client_groupmodel(){
		return $this->belongsTo(Groups::class, 'client_group');
	}
	public function clientmodel(){
		return $this->belongsTo(Clients::class, 'client');
	}
	public function leadership(){
		return $this->belongsTo(GroupLeadership::class, 'client', 'client_id');
	}
}