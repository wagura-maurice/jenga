<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Employees extends Model
{
	public function gendermodel(){
		return $this->belongsTo(Genders::class, 'gender');
	}
	public function maritalstatusmodel(){
		return $this->belongsTo(MaritalStatuses::class, 'marital_status');
	}
	public function relationshipwithnextofkinmodel(){
		return $this->belongsTo(NextOfKinRelationships::class, 'relationship_with_next_of_kin');
	}
	public function paypointmodel(){
		return $this->belongsTo(PayPoints::class, 'pay_point');
	}
	public function paymodemodel(){
		return $this->belongsTo(PayModes::class, 'pay_mode');
	}
	public function bankmodel(){
		return $this->belongsTo(Banks::class, 'bank');
	}
	public function bankbranchmodel(){
		return $this->belongsTo(BankBranches::class, 'bank_branch');
	}
	public function departmentmodel(){
		return $this->belongsTo(Departments::class, 'department');
	}
	public function employeecategorymodel(){
		return $this->belongsTo(EmployeeCategories::class, 'employee_category');
	}
	public function employeegroupmodel(){
		return $this->belongsTo(EmployeeGroups::class, 'employee_group');
	}
	public function positionmodel(){
		return $this->belongsTo(Positions::class, 'position');
	}
	public function branchmodel(){
		return $this->belongsTo(Branches::class, 'branch');
	}
}