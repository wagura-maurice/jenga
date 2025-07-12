<?php
/**
* @author  Wanjala Innocent Khaemba
*Controller - ()
*/
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\ClearingFeeConfigurations;
use App\Companies;
use App\Modules;
use App\LoanPayments;
use App\Users;
use App\LoanPaymentFrequencies;
use App\LoanPaymentDurations;
use App\GracePeriods;
use App\LoanProducts;
use App\DisbursementStatuses;
use App\LoanDisbursements;
use App\Clients;
use App\Accounts;
use Carbon\Carbon;
use App\GeneralLedgers;
use App\ProductDisbursementConfigurations;
use App\Loans;
use App\EntryTypes;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Exception;
use App\UsersAccountsRoles;
class LoanStatementController extends Controller
{
	public function __construct(){
		$this->middleware('auth');

	}

	public function index(){
		$loansdata['list']=Loans::orderBy('client','desc')->take(100)->skip(0)->get();

		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Loans']])->get();
		$loansdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();

		if($loansdata['usersaccountsroles'][0]['_add']==0&&$loansdata['usersaccountsroles'][0]['_list']==0&&$loansdata['usersaccountsroles'][0]['_edit']==0&&$loansdata['usersaccountsroles'][0]['_edit']==0&&$loansdata['usersaccountsroles'][0]['_show']==0&&$loansdata['usersaccountsroles'][0]['_delete']==0&&$loansdata['usersaccountsroles'][0]['_report']==0) {
	        	 return View('admin.error.denied', compact('loansdata'));
	        
		} else {
	        	 return View('admin.loan_statement.index', compact('loansdata'));
		}
		
	}	

	public function show($id){
		$loanstatement['company']=Companies::all();
		$loan=Loans::find($id);
		$loanstatement["loan"]=$loan;
		$loanstatement["date"]=Carbon::now()->toDateTimeString();
		$loanProduct=LoanProducts::find($loan->loan_product);
		$productdisbursementconfigurations=ProductDisbursementConfigurations::where([['loan_product','=',$loan->loan_product],['disbursement_mode','=',$loan->disbursement_mode]])->get()->first();
		$loanstatement["data"]=LoanPayments::where([["loan","=",$loan->id]])->get();
		$totalloanamount=$loan->total_loan_amount;

		$loanpaymentfrequency=LoanPaymentFrequencies::find($loan->loan_payment_frequency);

		$disbursementstatus=DisbursementStatuses::where([['code','=','002']])->get()->first();
		$loandisbursement=LoanDisbursements::where([['disbursement_status','=',$disbursementstatus->id],['loan','=',$loan->id]])->get()->first();

		if(!isset($loandisbursement))
			throw new Exception("Loan Not Disbursed", 1);
			
		$loanstatement['disbursement_date']=Carbon::parse($loandisbursement->created_at)->format('d-M-Y');

		$loanpaymentduration=LoanPaymentDurations::find($loan->loan_payment_duration);
		$graceperiod=GracePeriods::find($loan->grace_period);

		$noofinstallment=($loanpaymentduration->number_of_days-$graceperiod->number_of_days)/$loanpaymentfrequency->number_of_days;

		$loanDate=Carbon::parse($loan->date);

		$aftergraceperiod=$loanDate->addDays($graceperiod->number_of_days);	

		$installment=$loan->total_loan_amount/$noofinstallment;

		$loanstatement['installment']=$installment;

		for($r=0;$r<count($loanstatement["data"]); $r++){

				$createdAt=Carbon::parse($loanstatement['data'][$r]->created_at);

				$loanstatement['data'][$r]->date=$createdAt->format('d-M-Y');

				$totalloanamount=$totalloanamount-$loanstatement['data'][$r]->amount;

				$loanstatement['data'][$r]->balance=$totalloanamount;

				if($totalloanamount>$installment){

					$loanstatement['data'][$r]->installment=$installment;

				}else{

					$loanstatement['data'][$r]->installment=$totalloanamount;

				}


				if(isset($loanstatement['data'][$r-1])){
					$loanstatement['data'][$r]->cummulative_payment=$loanstatement['data'][$r]->amount+$loanstatement['data'][$r-1]->cummulative_payment;
					$loanstatement['data'][$r]->cummulative_installment=$loanstatement['data'][$r]->installment+$loanstatement['data'][$r-1]->cummulative_installment;

				}else{
					$loanstatement['data'][$r]->cummulative_payment=$loanstatement['data'][$r]->amount+0;
					$loanstatement['data'][$r]->cummulative_installment=$loanstatement['data'][$r]->installment+0;
				}

				$currentduration=$aftergraceperiod->diffInDays($createdAt);

				$currentinstallments=$currentduration/$loanpaymentfrequency->number_of_days;

				$currrentexpectedamount=$currentinstallments*$installment;

				$loanstatement['data'][$r]->expected=$currrentexpectedamount;

				$loanstatement['data'][$r]->arrears=$loanstatement['data'][$r]->cummulative_payment-$currrentexpectedamount;
		}	

		$loanstatement['balance']=$totalloanamount;

		return view('admin.loan_statement.show',compact('loanstatement'));

	}
}