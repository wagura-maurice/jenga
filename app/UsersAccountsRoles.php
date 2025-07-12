<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class UsersAccountsRoles extends Model
{
	public function useraccountmodel(){
		return $this->belongsTo(UsersAccounts::class, 'user_account');
	}
	public function modulemodel(){
		return $this->belongsTo(modules::class, 'module');
	}
}