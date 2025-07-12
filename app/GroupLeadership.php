<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpKernel\Client;

class GroupLeadership extends Model
{
    public function category(){
		return $this->belongsTo(GroupLeadershipCategory::class, 'category_id');
	}

	public function client(){
		return $this->belongsTo(Clients::class, 'client_id');
	}
}
