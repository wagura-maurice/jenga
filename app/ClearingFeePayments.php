<?php
/**
* @author  Wanjala Innocent Khaemba
*Model - (manages clearing fee payments data)
*/
namespace App;
use Illuminate\Database\Eloquent\Model;
class ClearingFeePayments extends Model
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

	public static function getPaymentsSum($id) {
		$payments = Self::where(['loan_number' => $id])->get();
		$sum = 0;
		foreach ($payments as $payment) {
			$sum += $payment->amount;
		}

		return $sum;
	}
}