<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class GeneralLedgers extends Model
{
	protected $guarded = [];
	
	public function accountmodel(){
		return $this->belongsTo(Accounts::class, 'account');
	}
	public function entrytypemodel(){
		return $this->belongsTo(EntryTypes::class, 'entry_type');
	}
	public function clientmodel(){
		return $this->belongsTo(Clients::class, 'client');
	}
}