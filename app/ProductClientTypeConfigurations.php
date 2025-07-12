<?php
/**
* @author  Wanjala Innocent Khaemba
*Model - (manages product client types data)
*/
namespace App;
use Illuminate\Database\Eloquent\Model;
class ProductClientTypeConfigurations extends Model
{
	public function loanproductmodel(){
		return $this->belongsTo(LoanProducts::class, 'loan_product');
	}
	public function clienttypemodel(){
		return $this->belongsTo(ClientTypes::class, 'client_type');
	}
}