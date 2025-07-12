<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Users extends Model
{
	public function useraccountmodel(){
		return $this->belongsTo(UsersAccounts::class, 'user_account');
	}
}