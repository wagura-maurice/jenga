<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class LoanGuarantors extends Model
{
	public function loanmodel(){
		return $this->belongsTo(Loans::class, 'loan');
	}
	public function guarantormodel(){
		return $this->belongsTo(Guarantors::class, 'guarantor');
	}
	public function relationshipwithguarantormodel(){
		return $this->belongsTo(GuarantorRelationships::class, 'relationship_with_guarantor');
	}
}