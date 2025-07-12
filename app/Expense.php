<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Expense extends Model
{
    use SoftDeletes;

	protected $guarded = [];

    public function usermodel(){
		return $this->belongsTo(User::class, 'user_id');
	}

    public function expensetypemodel(){
		return $this->belongsTo(Accounts::class, 'expense_type');
	}

	public function paymentmodemodel(){
		return $this->belongsTo(PaymentModes::class, 'payment_mode');
	}

	public function transactionstatusmodel(){
		return $this->belongsTo(TransactionStatuses::class, '_status');
	}
}
