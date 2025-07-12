<?php
/**
* @author  Wanjala Innocent Khaemba
*Model - (stores)
*/
namespace App;
use Illuminate\Database\Eloquent\Model;
class Stores extends Model
{
	public function staffmodel(){
		return $this->belongsTo(Users::class, 'staff');
	}
	public function branchmodel(){
		return $this->belongsTo(Branches::class, 'branch');
	}
}