<?php
/**
* @author  Wanjala Innocent Khaemba
*Model - (lgf to lgf transfers)
*/
namespace App;
use Illuminate\Database\Eloquent\Model;
class LgfToLgfTransfers extends Model
{
	public function clientfrommodel(){
		return $this->belongsTo(Clients::class, 'client_from');
	}
	public function clienttomodel(){
		return $this->belongsTo(Clients::class, 'client_to');
	}
	public function transactedbymodel(){
		return $this->belongsTo(Users::class, 'transacted_by');
	}
	public function approvalstatusmodel(){
		return $this->belongsTo(ApprovalStatuses::class, 'approval_status');
	}
}