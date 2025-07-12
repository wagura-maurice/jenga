<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class MembershipFees extends Model
{
	public function clientmodel(){
		return $this->belongsTo(Clients::class, 'client');
	}
	public function paymentmodemodel(){
		return $this->belongsTo(PaymentModes::class, 'payment_mode');
	}
	public function transactionstatusmodel(){
		return $this->belongsTo(TransactionStatuses::class, 'transaction_status');
	}
}