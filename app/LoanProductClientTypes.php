<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class LoanProductClientTypes extends Model
{
	public function loanproductmodel(){
		return $this->belongsTo(LoanProducts::class, 'loan_product');
	}
	public function clienttypemodel(){
		return $this->belongsTo(ClientTypes::class, 'client_type');
	}
}