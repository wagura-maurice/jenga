<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LoanFine extends Model
{
	protected $table = 'loan_fines';

	protected $fillables = [
		'loan_id',
		'product_id',
		'schedule_id',
		'client_id',
		'fine_date',
		'amount',
		'_narrative',
		'_status'
	];
	
    public function loan() {
		return $this->belongsTo(Loans::class, 'loan_id');
	}

    public function product() {
		return $this->belongsTo(LoanProducts::class, 'product_id');
	}

	public function client() {
		return $this->belongsTo(Clients::class, 'client_id');
	}
}
