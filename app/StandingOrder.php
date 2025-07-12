<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StandingOrder extends Model
{
    use SoftDeletes;
	
	public function category() {
		return $this->belongsTo(StandingOrderCategory::class, 'category_id');
	}

    public function client() {
		return $this->belongsTo(Clients::class, 'client_id');
	}

	public function by() {
		return $this->belongsTo(Users::class, 'escalated_by');
	}

	public function source() {
		return $this->belongsTo(ClientLgfBalances::class, 'source_account');
	}

	public function destination() {
		return $this->belongsTo(Loans::class, 'destination_account');
	}
}
