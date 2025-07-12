<?php
/**
* @author  Wanjala Innocent Khaemba
*Model - ()
*/
namespace App;
use Illuminate\Database\Eloquent\Model;
class GroupCashBooks extends Model
{
	protected $guarded = [];
	
	public function groupmodel(){
		return $this->belongsTo(Groups::class, 'transacting_group');
	}

	public function paymentmodemodel(){
		return $this->belongsTo(PaymentModes::class, 'payment_mode');
	}

	public function disbursementmodemodel(){
		return $this->belongsTo(DisbursementModes::class, 'disbursement_mode');
	}

	public function accountmodemodel(){
		return $this->belongsTo(Accounts::class, 'account');
	}
	
	public function officermodel(){
		return $this->belongsTo(Employees::class, 'officer_id');
	}

	public function branchmodel(){
		return $this->belongsTo(Branches::class, 'branch_id');
	}
}
