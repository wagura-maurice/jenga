<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FinePaymentFees extends Model
{
	protected $fillable = [
		'loan_number',
		'payment_mode',
		'transaction_reference',
		'amount',
		'date',
		'transaction_status'
	];

    public function loannumbermodel(){
		return $this->belongsTo(Loans::class, 'loan_number');
	}
	public function paymentmodemodel(){
		return $this->belongsTo(PaymentModes::class, 'payment_mode');
	}
	public function transactionstatusmodel(){
		return $this->belongsTo(TransactionStatuses::class, 'transaction_status');
	}
}
