<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class BankBranches extends Model
{
	public function bankmodel(){
		return $this->belongsTo(Banks::class, 'bank');
	}
}