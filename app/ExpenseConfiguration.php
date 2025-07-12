<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExpenseConfiguration extends Model
{
    use SoftDeletes;

	protected $guarded = [];

    public function expensetypemodel(){
		return $this->belongsTo(Accounts::class, 'expense_type');
	}

	public function paymentmodemodel(){
		return $this->belongsTo(PaymentModes::class, 'payment_mode');
	}

	public function debitaccountmodel(){
		return $this->belongsTo(Accounts::class, 'debit_account');
	}
	
	public function creditaccountmodel(){
		return $this->belongsTo(Accounts::class, 'credit_account');
	}
}
