<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class SubCounties extends Model
{
	public function countymodel(){
		return $this->belongsTo(Counties::class, 'county');
	}
}