<?php
/**
* @author  Wanjala Innocent Khaemba
*Model - (processing fee payments)
*/
namespace App;
use Illuminate\Database\Eloquent\Model;
class ProcessingFeePayments extends Model
{
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