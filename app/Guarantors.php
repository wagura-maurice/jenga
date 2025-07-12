<?php

/**
 * @author  Wanjala Innocent Khaemba
 *Model - ()
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

class Guarantors extends Model
{
	public function countymodel()
	{
		return $this->belongsTo(Counties::class, 'county');
	}
	public function subcountymodel()
	{
		return $this->belongsTo(SubCounties::class, 'sub_county');
	}
	public function clientmodel()
	{
		return $this->belongsTo(Clients::class, 'client');
	}

	public function relationshipmodel(){
		return $this->belongsTo(GuarantorRelationships::class,"relationship");
	}
}
