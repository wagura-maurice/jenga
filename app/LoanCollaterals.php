<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class LoanCollaterals extends Model
{
	public function loanmodel(){
		return $this->belongsTo(Loans::class, 'loan');
	}
	public function collateralcategorymodel(){
		return $this->belongsTo(CollateralCategories::class, 'collateral_category');
	}
}