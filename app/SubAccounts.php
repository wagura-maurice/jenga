<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class SubAccounts extends Model
{
	public function accountmodel(){
		return $this->belongsTo(Accounts::class, 'account');
	}
	public function subaccountmodel(){
		return $this->belongsTo(Accounts::class, 'sub_account');
	}
}