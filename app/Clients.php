<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Clients extends Model
{
	use SoftDeletes;
	
	public function gendermodel(){
		return $this->belongsTo(Genders::class, 'gender');
	}
	public function maritalstatusmodel(){
		return $this->belongsTo(MaritalStatuses::class, 'marital_status');
	}
	public function clienttypemodel(){
		return $this->belongsTo(ClientTypes::class, 'client_type');
	}
	public function clientcategorymodel(){
		return $this->belongsTo(ClientCategories::class, 'client_category');
	}
	public function countymodel(){
		return $this->belongsTo(Counties::class, 'county');
	}
	public function subcountymodel(){
		return $this->belongsTo(SubCounties::class, 'sub_county');
	}
	public function relationshipwithnextofkinmodel(){
		return $this->belongsTo(NextOfKinRelationships::class, 'relationship_with_next_of_kin');
	}
	public function nextofkincountymodel(){
		return $this->belongsTo(Counties::class, 'next_of_kin_county');
	}
	public function nextofkinsubcountymodel(){
		return $this->belongsTo(SubCounties::class, 'next_of_kin_sub_county');
	}
	public function maileconomicactivitymodel(){
		return $this->belongsTo(MainEconomicActivities::class, 'main_economic_activity');
	}
	public function secondaryeconomicactivitymodel(){
		return $this->belongsTo(SecondaryEconomicActivities::class, 'secondary_economic_activity');
	}

	public function name(){
		return $this->first_name.' '.$this->middle_name;
	}

	/*public function group()
    {
        return $this->belongsTo('App\Groups', 'client_group', 'id');
    }*/

	public function group(){
		return $this->belongsTo(GroupClients::class, 'id', 'client');
	}

	public function branchmodel(){
		return $this->belongsTo(Branches::class, 'branch_id', 'id');
	}

	public function officermodel(){
		return $this->belongsTo(Employees::class, 'officer_id', 'id');
	}

	public function lgf_balance(){
		return $this->belongsTo(ClientLgfBalances::class, 'id', 'client');
	}

	public function lgf_contributions(){
		return $this->hasMany(ClientLgfContributions::class, 'client', 'id');
	}

	public function loans(){
		return $this->hasMany(Loans::class, 'client', 'id');
	}
}