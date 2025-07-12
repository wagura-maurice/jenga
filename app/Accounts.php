<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Accounts extends Model
{
	public function financialcategorymodel(){
		return $this->belongsTo(FinancialCategories::class, 'financial_category');
	}
	public function levelmodel(){
		return $this->belongsTo(AccountLevels::class, 'level');
	}
}