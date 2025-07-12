<?php
/**
* @author  Wanjala Innocent Khaemba
*Controller - (manages insurance deduction fee payments)
*/
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\InsuranceDeductionFeePayments;
use App\Companies;
use App\Modules;
use App\LoanProducts;
use App\Users;
use App\Loans;
use App\PaymentModes;
use App\LoanStatuses;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;
class PendingInsuranceDeductionFeeController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$insurancedeductionfeepaymentsdata['loans']=Loans::all();
		$insurancedeductionfeepaymentsdata['paymentmodes']=PaymentModes::all();
		
		$loanstatuses=LoanStatuses::where([['code','=','001']])->get();
		$insurancedeductionfeepaymentsdata['pendingloans']=Loans::where([['status','=',$loanstatuses[0]->id]])->get();
		$insurancedeductionfeepaymentsdata['data']=array();
		
		foreach($insurancedeductionfeepaymentsdata['pendingloans'] as $pendingloan){
			$payment=InsuranceDeductionFeePayments::where([['loan','=',$pendingloan->id]])->get();
			if(isset($payment[0])){
				$insurancedeductionfeepaymentsdata['list'][]=$pendingloan;	
			}
			
		}

		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','InsuranceDeductionFeePayments']])->get();
		$insurancedeductionfeepaymentsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($insurancedeductionfeepaymentsdata['usersaccountsroles'][0]['_add']==0&&$insurancedeductionfeepaymentsdata['usersaccountsroles'][0]['_list']==0&&$insurancedeductionfeepaymentsdata['usersaccountsroles'][0]['_edit']==0&&$insurancedeductionfeepaymentsdata['usersaccountsroles'][0]['_edit']==0&&$insurancedeductionfeepaymentsdata['usersaccountsroles'][0]['_show']==0&&$insurancedeductionfeepaymentsdata['usersaccountsroles'][0]['_delete']==0&&$insurancedeductionfeepaymentsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('insurancedeductionfeepaymentsdata'));
		}else{
			return view('admin.pending_insurance_deduction_fee.index',compact('insurancedeductionfeepaymentsdata'));
		}
	}

	public function payment($id){
		$insurancedeductionfeepaymentsdata;
		$insurancedeductionfeepaymentsdata['loan']=Loans::find($id);
		$loanProduct=LoanProducts::find($insurancedeductionfeepaymentsdata['loan']->loan_product);
		$insurancedeductionfeepaymentsdata['loanproduct']=$loanProduct;
		$loans=new Loans();
		$insuranceDeductionFeeTypeCode=$loanProduct->insurancedeductionfeetypemodel->code;
		$insuranceDeductionFeeValue=$loanProduct->insurance_deduction_fee;
		$loanAmount=$insurancedeductionfeepaymentsdata['loan']->amount;
		$insurancedeductionfeepaymentsdata['amount']=$loans->getInsuranceDeductionFee($insuranceDeductionFeeTypeCode,$insuranceDeductionFeeValue,$loanAmount);
		$insurancedeductionfeepaymentsdata['paymentmodes']=PaymentModes::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','InsuranceDeductionFeePayments']])->get();
		$insurancedeductionfeepaymentsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($insurancedeductionfeepaymentsdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('insurancedeductionfeepaymentsdata'));
		}else{
			return view('admin.pending_insurance_deduction_fee.payment',compact('insurancedeductionfeepaymentsdata'));
		}
	}

	public function create(){
		$insurancedeductionfeepaymentsdata;
		$insurancedeductionfeepaymentsdata['loans']=Loans::all();
		$insurancedeductionfeepaymentsdata['paymentmodes']=PaymentModes::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','InsuranceDeductionFeePayments']])->get();
		$insurancedeductionfeepaymentsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($insurancedeductionfeepaymentsdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('insurancedeductionfeepaymentsdata'));
		}else{
			return view('admin.pending_insurance_deduction_fee.create',compact('insurancedeductionfeepaymentsdata'));
		}
	}

	public function filter(Request $request){
		$insurancedeductionfeepaymentsdata['loans']=Loans::all();
		$insurancedeductionfeepaymentsdata['paymentmodes']=PaymentModes::all();
		$insurancedeductionfeepaymentsdata['list']=InsuranceDeductionFeePayments::where([['loan','LIKE','%'.$request->get('loan').'%'],['payment_mode','LIKE','%'.$request->get('payment_mode').'%'],['transaction_number','LIKE','%'.$request->get('transaction_number').'%'],['amount','LIKE','%'.$request->get('amount').'%'],])->orWhereBetween('date',[$request->get('datefrom'),$request->get('dateto')])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','InsuranceDeductionFeePayments']])->get();
		$insurancedeductionfeepaymentsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($insurancedeductionfeepaymentsdata['usersaccountsroles'][0]['_add']==0&&$insurancedeductionfeepaymentsdata['usersaccountsroles'][0]['_list']==0&&$insurancedeductionfeepaymentsdata['usersaccountsroles'][0]['_edit']==0&&$insurancedeductionfeepaymentsdata['usersaccountsroles'][0]['_edit']==0&&$insurancedeductionfeepaymentsdata['usersaccountsroles'][0]['_show']==0&&$insurancedeductionfeepaymentsdata['usersaccountsroles'][0]['_delete']==0&&$insurancedeductionfeepaymentsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('insurancedeductionfeepaymentsdata'));
		}else{
			return view('admin.pending_insurance_deduction_fee.index',compact('insurancedeductionfeepaymentsdata'));
		}
	}

	public function report(){
		$insurancedeductionfeepaymentsdata['company']=Companies::all();
		$insurancedeductionfeepaymentsdata['list']=InsuranceDeductionFeePayments::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','InsuranceDeductionFeePayments']])->get();
		$insurancedeductionfeepaymentsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($insurancedeductionfeepaymentsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('insurancedeductionfeepaymentsdata'));
		}else{
			return view('admin.pending_insurance_deduction_fee.report',compact('insurancedeductionfeepaymentsdata'));
		}
	}

	public function chart(){
		return view('admin.pending_insurance_deduction_fee.chart');
	}

	public function store(Request $request){
		$insurancedeductionfeepayments=new InsuranceDeductionFeePayments();
		$insurancedeductionfeepayments->loan=$request->get('loan');
		$insurancedeductionfeepayments->payment_mode=$request->get('payment_mode');
		$insurancedeductionfeepayments->transaction_number=$request->get('transaction_number');
		$insurancedeductionfeepayments->date=$request->get('date');
		$insurancedeductionfeepayments->amount=$request->get('amount');
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','InsuranceDeductionFeePayments']])->get();
		$insurancedeductionfeepaymentsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($insurancedeductionfeepaymentsdata['usersaccountsroles'][0]['_show']==1){
			try{
				if($insurancedeductionfeepayments->save()){
					$response['status']='1';
					$response['message']='insurance deduction fee payments Added successfully';
					return json_encode($response);
			}else{
					$response['status']='0';
					$response['message']='Failed to add insurance deduction fee payments. Please try again';
					return json_encode($response);
				}
			}
			catch(Exception $e){
					$response['status']='0';
					$response['message']='An Error occured while attempting to add insurance deduction fee payments. Please try again';
					return json_encode($response);
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$insurancedeductionfeepaymentsdata['loans']=Loans::all();
		$insurancedeductionfeepaymentsdata['paymentmodes']=PaymentModes::all();
		$insurancedeductionfeepaymentsdata['data']=InsuranceDeductionFeePayments::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','InsuranceDeductionFeePayments']])->get();
		$insurancedeductionfeepaymentsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($insurancedeductionfeepaymentsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('insurancedeductionfeepaymentsdata'));
		}else{
		return view('admin.pending_insurance_deduction_fee.edit',compact('insurancedeductionfeepaymentsdata','id'));
		}
	}


	public function update(Request $request,$id){
		$insurancedeductionfeepayments=InsuranceDeductionFeePayments::find($id);
		$insurancedeductionfeepaymentsdata['loans']=Loans::all();
		$insurancedeductionfeepaymentsdata['paymentmodes']=PaymentModes::all();
		$insurancedeductionfeepayments->loan=$request->get('loan');
		$insurancedeductionfeepayments->payment_mode=$request->get('payment_mode');
		$insurancedeductionfeepayments->transaction_number=$request->get('transaction_number');
		$insurancedeductionfeepayments->date=$request->get('date');
		$insurancedeductionfeepayments->amount=$request->get('amount');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','InsuranceDeductionFeePayments']])->get();
		$insurancedeductionfeepaymentsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($insurancedeductionfeepaymentsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('insurancedeductionfeepaymentsdata'));
		}else{
		$insurancedeductionfeepayments->save();
		$insurancedeductionfeepaymentsdata['data']=InsuranceDeductionFeePayments::find($id);
		return view('admin.pending_insurance_deduction_fee.edit',compact('insurancedeductionfeepaymentsdata','id'));
		}
	}

	public function destroy($id){
		$insurancedeductionfeepayments=InsuranceDeductionFeePayments::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','InsuranceDeductionFeePayments']])->get();
		$insurancedeductionfeepaymentsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($insurancedeductionfeepaymentsdata['usersaccountsroles'][0]['_delete']==1){
			$insurancedeductionfeepayments->delete();
		}return redirect('admin/insurancedeductionfeepayments')->with('success','insurance deduction fee payments has been deleted!');
	}
}