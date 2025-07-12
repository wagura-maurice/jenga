<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Branches extends Model
{
    public function employees(){
		return $this->hasMany(Employees::class, 'branch', 'id');
	}
}