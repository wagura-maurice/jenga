<?php
namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;

use App\Loans;
use App\InsuranceDeductionPayments;
use App\ClearingFeePayments;
use App\ProcessingFeePayments;
use Illuminate\Http\Request;

class JengaController extends Controller
{
	public function __construct(){
		$this->middleware('auth');
	}

	public function tables() {
		return \JENGA::get_tables_list();
	}

	public function loaninsuarancedeductionfee(Request $request) {
		$loan = Loans::find($request->loan_number);
		return ($loan->insurance_deduction_fee - InsuranceDeductionPayments::getPaymentsSum($request->loan_number));
	}

	public function loanclearingfee(Request $request) {
		$loan = Loans::find($request->loan_number);
		return ($loan->clearing_fee - ClearingFeePayments::getPaymentsSum($request->loan_number));
	}

	public function loanprocessingfee(Request $request) {
		$loan = Loans::find($request->loan_number);
		return ($loan->processing_fee - ProcessingFeePayments::getPaymentsSum($request->loan_number));
	}
}