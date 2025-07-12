<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class GroupClientRoles extends Model
{
	public function client_groupmodel(){
		return $this->belongsTo(Groups::class, 'client_group');
	}
	public function group_rolemodel(){
		return $this->belongsTo(GroupRoles::class, 'group_role');
	}
	public function clientmodel(){
		return $this->belongsTo(Clients::class, 'client');
	}
}