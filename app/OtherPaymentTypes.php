<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class OtherPaymentTypes extends Model
{
	protected $fillable = [
		'code',
		'name',
		'description',
		'model_name',
		'config_model'
	];

	public static function getModel($id)
	{
		$Model = '\\App\\'.OtherPaymentTypes::find($id)->model_name;
		return $Model;
	}

	public static function getConfig($id)
	{
		$Config = '\\App\\'.OtherPaymentTypes::find($id)->config_model;
		return $Config;
	}
}