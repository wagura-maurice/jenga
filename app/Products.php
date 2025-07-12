<?php
/**
* @author  Wanjala Innocent Khaemba
*Model - (products)
*/
namespace App;
use Illuminate\Database\Eloquent\Model;
class Products extends Model
{
	public function categorymodel(){
		return $this->belongsTo(ProductCategories::class, 'category');
	}
	public function brandmodel(){
		return $this->belongsTo(ProductBrands::class, 'brand');
	}
}