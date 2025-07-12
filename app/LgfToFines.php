<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class LgfToFines extends Model
{
	public function clientmodel(){
		return $this->belongsTo(Clients::class, 'client');
	}
	public function loanmodel(){
		return $this->belongsTo(Loans::class, 'loan');
	}
}