<?php
/**
* @author  Wanjala Innocent Khaemba
*Model - (manages product disbursement modes)
*/
namespace App;
use Illuminate\Database\Eloquent\Model;
class ProductDisbursementModes extends Model
{
	public function loanproductmodel(){
		return $this->belongsTo(LoanProducts::class, 'loan_product');
	}
	public function disbursementmodemodel(){
		return $this->belongsTo(DisbursementModes::class, 'disbursement_mode');
	}
}