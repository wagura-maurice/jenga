<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class FinePayments extends Model
{
	protected $table = 'fine_payments';
	
	public function loanmodel(){
		return $this->belongsTo(Loans::class, 'loan');
	}
	public function paymentmodemodel(){
		return $this->belongsTo(PaymentModes::class, 'payment_mode');
	}
}