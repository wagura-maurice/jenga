<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class LoanProductApprovalLevel extends Model
{
	public function loanproductmodel(){
		return $this->belongsTo(LoanProducts::class, 'loan_product');
	}
	public function approvallevelmodel(){
		return $this->belongsTo(ApprovalLevels::class, 'approval_level');
	}
	public function employeecategorymodel(){
		return $this->belongsTo(EmployeeCategories::class, 'employee_category');
	}
}