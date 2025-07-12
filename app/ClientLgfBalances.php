<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class ClientLgfBalances extends Model
{
	public function clientmodel(){
		return $this->belongsTo(Clients::class, 'client');
	}
}