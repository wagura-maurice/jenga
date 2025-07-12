<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class LoanPayments extends Model
{
	public function loanmodel(){
		return $this->belongsTo(Loans::class, 'loan');
	}
	public function modeofpaymentmodel(){
		return $this->belongsTo(PaymentModes::class, 'mode_of_payment');
	}
	public function transactionstatusmodel(){
		return $this->belongsTo(TransactionStatuses::class, 'transaction_status');
	}
}