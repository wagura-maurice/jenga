<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class LoanDocuments extends Model
{
	public function loanmodel(){
		return $this->belongsTo(Loans::class, 'loan');
	}
}