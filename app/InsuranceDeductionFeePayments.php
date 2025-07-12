<?php
/**
* @author  Wanjala Innocent Khaemba
*Model - (manages insurance deduction fee payments)
*/
namespace App;
use Illuminate\Database\Eloquent\Model;
class InsuranceDeductionFeePayments extends Model
{
	public function loannumbermodel(){
		return $this->belongsTo(Loans::class, 'loan__number');
	}
	public function paymentmodemodel(){
		return $this->belongsTo(PaymentModes::class, 'payment_mode');
	}
	public function statusmodel(){
		return $this->belongsTo(TransactionStatuses::class, 'status');
	}
}