<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class OtherPayments extends Model
{
	protected $fillable = ['other_payment_type','transaction_number','payment_mode','date','amount'];

	public function otherpaymenttypemodel(){
		return $this->belongsTo(OtherPaymentTypes::class, 'other_payment_type');
	}
	public function paymentmodemodel(){
		return $this->belongsTo(PaymentModes::class, 'payment_mode');
	}

	public static function _cleared($loan_id, $other_payment_type_id) {

		// return $loan_id . " - " . $other_payment_type_id;
		
		$loan = \App\Loans::find($loan_id);
		$other_payment_type = OtherPaymentTypes::find($other_payment_type_id);

		if ($other_payment_type->code == "003") {
			$payment_type = "processing_fee";
		} elseif ($other_payment_type->code == "004") {
			$payment_type = "clearing_fee";
		} elseif ($other_payment_type->code == "005") {
			$payment_type = "insurance_deduction_fee";
		} else {
			$payment_type = NULL;
		}

		if ($payment_type) {
			$Model = '\\App\\'.$other_payment_type->model_name;
			$sum=0;
			// $sum = $loan->$payment_type - $Model::getPaymentsSum($loan->id);

			return $sum ? false : true; 
		} else {
			return false;
		}
	}
}