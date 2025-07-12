<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class LgfToLgfTransferes extends Model
{
	public function clientfrommodel(){
		return $this->belongsTo(Clients::class, 'client_from');
	}
	public function clienttomodel(){
		return $this->belongsTo(Clients::class, 'client_to');
	}
}