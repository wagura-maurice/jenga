<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LoanInterest extends Model
{
    public function paymentMode()
    {
		return $this->belongsTo(PaymentModes::class, 'mode');
	}
}
