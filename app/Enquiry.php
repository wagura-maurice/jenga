<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Enquiry extends Model
{
    use SoftDeletes;
	
	public function category() {
		return $this->belongsTo(EnquiryCategory::class, 'category_id');
	}

    public function client() {
		return $this->belongsTo(Clients::class, 'client_id');
	}

	public function by() {
		return $this->belongsTo(Users::class, 'escalated_by');
	}

	public function to() {
		return $this->belongsTo(Users::class, 'escalated_to');
	}

	public function location() {
		return $this->belongsTo(Branches::class, 'branch');
	}
}
