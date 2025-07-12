<?php
/**
* @author  Wanjala Innocent Khaemba
*Model - (purchase order approval mappings)
*/
namespace App;
use Illuminate\Database\Eloquent\Model;
class PurchaseOrderApprovalMappings extends Model
{
	public function storemodel(){
		return $this->belongsTo(Stores::class, 'store');
	}
	public function approvallevelmodel(){
		return $this->belongsTo(ApprovalLevels::class, 'approval_level');
	}
	public function useraccountmodel(){
		return $this->belongsTo(UsersAccounts::class, 'user_account');
	}
}