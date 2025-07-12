<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class LoanDisbursements extends Model
{
	public function loanmodel(){
		return $this->belongsTo(Loans::class, 'loan');
	}
	public function disbursementstatusmodel(){
		return $this->belongsTo(DisbursementStatuses::class, 'disbursement_status');
	}
}