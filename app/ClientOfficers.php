<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class ClientOfficers extends Model
{
	public function clientmodel(){
		return $this->belongsTo(Clients::class, 'client');
	}
	
	public function officermodel(){
		return $this->belongsTo(Employees::class, 'officer');
	}
}