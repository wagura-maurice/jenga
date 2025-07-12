<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Groups extends Model
{
	use SoftDeletes;

	protected $guarded = [];
	
	public function meetingdaymodel(){
		return $this->belongsTo(Days::class, 'meeting_day');
	}
	
	public function meetingfrequencymodel(){
		return $this->belongsTo(MeetingFrequencies::class, 'meeting_frequency');
	}

	public function preferredmodeofbankingmodel(){
		return $this->belongsTo(BankingModes::class, 'preferred_mode_of_banking');
	}

	public function officermodel(){
		return $this->belongsTo(Employees::class, 'officer');
	}

	public function branchmodel(){
		return $this->belongsTo(Branches::class, 'branch_id');
	}

	public function clients()
    {
        return $this->hasMany('App\GroupClients', 'client_group', 'id');
    }
}