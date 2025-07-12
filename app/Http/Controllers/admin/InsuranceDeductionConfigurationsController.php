<?php
/**
* @author  Wanjala Innocent Khaemba
*Controller - ()
*/
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\InsuranceDeductionConfigurations;
use App\Companies;
use App\Modules;
use App\Users;
use App\LoanProducts;
use App\FeeTypes;
use App\FeePaymentTypes;
use App\PaymentModes;
use App\DisbursementModes;
use App\Accounts;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;
class InsuranceDeductionConfigurationsController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$insurancedeductionconfigurationsdata['loanproducts']=LoanProducts::all();
		$insurancedeductionconfigurationsdata['feetypes']=FeeTypes::all();
		$insurancedeductionconfigurationsdata['feepaymenttypes']=FeePaymentTypes::all();
		$insurancedeductionconfigurationsdata['paymentmodes']=PaymentModes::all();
		$insurancedeductionconfigurationsdata['disbursementmodes']=DisbursementModes::all();
		$insurancedeductionconfigurationsdata['accounts']=Accounts::all();
		$insurancedeductionconfigurationsdata['accounts']=Accounts::all();
		$insurancedeductionconfigurationsdata['list']=InsuranceDeductionConfigurations::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','InsuranceDeductionConfigurations']])->get();
		$insurancedeductionconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($insurancedeductionconfigurationsdata['usersaccountsroles'][0]['_add']==0&&$insurancedeductionconfigurationsdata['usersaccountsroles'][0]['_list']==0&&$insurancedeductionconfigurationsdata['usersaccountsroles'][0]['_edit']==0&&$insurancedeductionconfigurationsdata['usersaccountsroles'][0]['_edit']==0&&$insurancedeductionconfigurationsdata['usersaccountsroles'][0]['_show']==0&&$insurancedeductionconfigurationsdata['usersaccountsroles'][0]['_delete']==0&&$insurancedeductionconfigurationsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('insurancedeductionconfigurationsdata'));
		}else{
			return view('admin.insurance_deduction_configurations.index',compact('insurancedeductionconfigurationsdata'));
		}
	}

	public function create(){
		$insurancedeductionconfigurationsdata;
		$insurancedeductionconfigurationsdata['loanproducts']=LoanProducts::all();
		$insurancedeductionconfigurationsdata['feetypes']=FeeTypes::all();
		$insurancedeductionconfigurationsdata['feepaymenttypes']=FeePaymentTypes::all();
		$insurancedeductionconfigurationsdata['paymentmodes']=PaymentModes::all();
		$insurancedeductionconfigurationsdata['disbursementmodes']=DisbursementModes::all();
		$insurancedeductionconfigurationsdata['accounts']=Accounts::all();
		$insurancedeductionconfigurationsdata['accounts']=Accounts::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','InsuranceDeductionConfigurations']])->get();
		$insurancedeductionconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($insurancedeductionconfigurationsdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('insurancedeductionconfigurationsdata'));
		}else{
			return view('admin.insurance_deduction_configurations.create',compact('insurancedeductionconfigurationsdata'));
		}
	}

	public function filter(Request $request){
		$insurancedeductionconfigurationsdata['loanproducts']=LoanProducts::all();
		$insurancedeductionconfigurationsdata['feetypes']=FeeTypes::all();
		$insurancedeductionconfigurationsdata['feepaymenttypes']=FeePaymentTypes::all();
		$insurancedeductionconfigurationsdata['paymentmodes']=PaymentModes::all();
		$insurancedeductionconfigurationsdata['disbursementmodes']=DisbursementModes::all();
		$insurancedeductionconfigurationsdata['accounts']=Accounts::all();
		$insurancedeductionconfigurationsdata['accounts']=Accounts::all();
		$insurancedeductionconfigurationsdata['list']=InsuranceDeductionConfigurations::where([['loan_product','LIKE','%'.$request->get('loan_product').'%'],['fee_type','LIKE','%'.$request->get('fee_type').'%'],['fee_payment_type','LIKE','%'.$request->get('fee_payment_type').'%'],['payment_mode','LIKE','%'.$request->get('payment_mode').'%'],['disbursement_mode','LIKE','%'.$request->get('disbursement_mode').'%'],['debit_account','LIKE','%'.$request->get('debit_account').'%'],['credit_account','LIKE','%'.$request->get('credit_account').'%'],])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','InsuranceDeductionConfigurations']])->get();
		$insurancedeductionconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($insurancedeductionconfigurationsdata['usersaccountsroles'][0]['_add']==0&&$insurancedeductionconfigurationsdata['usersaccountsroles'][0]['_list']==0&&$insurancedeductionconfigurationsdata['usersaccountsroles'][0]['_edit']==0&&$insurancedeductionconfigurationsdata['usersaccountsroles'][0]['_edit']==0&&$insurancedeductionconfigurationsdata['usersaccountsroles'][0]['_show']==0&&$insurancedeductionconfigurationsdata['usersaccountsroles'][0]['_delete']==0&&$insurancedeductionconfigurationsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('insurancedeductionconfigurationsdata'));
		}else{
			return view('admin.insurance_deduction_configurations.index',compact('insurancedeductionconfigurationsdata'));
		}
	}

	public function report(){
		$insurancedeductionconfigurationsdata['company']=Companies::all();
		$insurancedeductionconfigurationsdata['list']=InsuranceDeductionConfigurations::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','InsuranceDeductionConfigurations']])->get();
		$insurancedeductionconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($insurancedeductionconfigurationsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('insurancedeductionconfigurationsdata'));
		}else{
			return view('admin.insurance_deduction_configurations.report',compact('insurancedeductionconfigurationsdata'));
		}
	}

	public function chart(){
		return view('admin.insurance_deduction_configurations.chart');
	}

	public function store(Request $request){
		$insurancedeductionconfigurations=new InsuranceDeductionConfigurations();
		$insurancedeductionconfigurations->loan_product=$request->get('loan_product');
		$insurancedeductionconfigurations->fee_type=$request->get('fee_type');
		$insurancedeductionconfigurations->fee_payment_type=$request->get('fee_payment_type');
		$insurancedeductionconfigurations->payment_mode=$request->get('payment_mode');
		$insurancedeductionconfigurations->disbursement_mode=$request->get('disbursement_mode');
		$insurancedeductionconfigurations->debit_account=$request->get('debit_account');
		$insurancedeductionconfigurations->credit_account=$request->get('credit_account');
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','InsuranceDeductionConfigurations']])->get();
		$insurancedeductionconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($insurancedeductionconfigurationsdata['usersaccountsroles'][0]['_show']==1){
			try{
				if($insurancedeductionconfigurations->save()){
					$response['status']='1';
					$response['message']='insurance deduction configurations Added successfully';
					return json_encode($response);
			}else{
					$response['status']='0';
					$response['message']='Failed to add insurance deduction configurations. Please try again';
					return json_encode($response);
				}
			}
			catch(Exception $e){
					$response['status']='0';
					$response['message']='An Error occured while attempting to add insurance deduction configurations. Please try again';
					return json_encode($response);
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$insurancedeductionconfigurationsdata['loanproducts']=LoanProducts::all();
		$insurancedeductionconfigurationsdata['feetypes']=FeeTypes::all();
		$insurancedeductionconfigurationsdata['feepaymenttypes']=FeePaymentTypes::all();
		$insurancedeductionconfigurationsdata['paymentmodes']=PaymentModes::all();
		$insurancedeductionconfigurationsdata['disbursementmodes']=DisbursementModes::all();
		$insurancedeductionconfigurationsdata['accounts']=Accounts::all();
		$insurancedeductionconfigurationsdata['accounts']=Accounts::all();
		$insurancedeductionconfigurationsdata['data']=InsuranceDeductionConfigurations::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','InsuranceDeductionConfigurations']])->get();
		$insurancedeductionconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($insurancedeductionconfigurationsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('insurancedeductionconfigurationsdata'));
		}else{
		return view('admin.insurance_deduction_configurations.edit',compact('insurancedeductionconfigurationsdata','id'));
		}
	}

	public function show($id){
		$insurancedeductionconfigurationsdata['loanproducts']=LoanProducts::all();
		$insurancedeductionconfigurationsdata['feetypes']=FeeTypes::all();
		$insurancedeductionconfigurationsdata['feepaymenttypes']=FeePaymentTypes::all();
		$insurancedeductionconfigurationsdata['paymentmodes']=PaymentModes::all();
		$insurancedeductionconfigurationsdata['disbursementmodes']=DisbursementModes::all();
		$insurancedeductionconfigurationsdata['accounts']=Accounts::all();
		$insurancedeductionconfigurationsdata['accounts']=Accounts::all();
		$insurancedeductionconfigurationsdata['data']=InsuranceDeductionConfigurations::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','InsuranceDeductionConfigurations']])->get();
		$insurancedeductionconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($insurancedeductionconfigurationsdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('insurancedeductionconfigurationsdata'));
		}else{
		return view('admin.insurance_deduction_configurations.show',compact('insurancedeductionconfigurationsdata','id'));
		}
	}

	public function check(Request $request){
		$insurancedeductionconfigurationsdata=InsuranceDeductionConfigurations::where([['loan_product','=',$request->get("loan_product")],['payment_mode','=',$request->get("payment_mode")]])->get();
		return isset($insurancedeductionconfigurationsdata[0])?"1":"0";

	}

	public function update(Request $request,$id){
		$insurancedeductionconfigurations=InsuranceDeductionConfigurations::find($id);
		$insurancedeductionconfigurationsdata['loanproducts']=LoanProducts::all();
		$insurancedeductionconfigurationsdata['feetypes']=FeeTypes::all();
		$insurancedeductionconfigurationsdata['feepaymenttypes']=FeePaymentTypes::all();
		$insurancedeductionconfigurationsdata['paymentmodes']=PaymentModes::all();
		$insurancedeductionconfigurationsdata['disbursementmodes']=DisbursementModes::all();
		$insurancedeductionconfigurationsdata['accounts']=Accounts::all();
		$insurancedeductionconfigurationsdata['accounts']=Accounts::all();
		$insurancedeductionconfigurations->loan_product=$request->get('loan_product');
		$insurancedeductionconfigurations->fee_type=$request->get('fee_type');
		$insurancedeductionconfigurations->fee_payment_type=$request->get('fee_payment_type');
		$insurancedeductionconfigurations->payment_mode=$request->get('payment_mode');
		$insurancedeductionconfigurations->disbursement_mode=$request->get('disbursement_mode');
		$insurancedeductionconfigurations->debit_account=$request->get('debit_account');
		$insurancedeductionconfigurations->credit_account=$request->get('credit_account');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','InsuranceDeductionConfigurations']])->get();
		$insurancedeductionconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($insurancedeductionconfigurationsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('insurancedeductionconfigurationsdata'));
		}else{
		$insurancedeductionconfigurations->save();
		$insurancedeductionconfigurationsdata['data']=InsuranceDeductionConfigurations::find($id);
		return view('admin.insurance_deduction_configurations.edit',compact('insurancedeductionconfigurationsdata','id'));
		}
	}

	public function destroy($id){
		$insurancedeductionconfigurations=InsuranceDeductionConfigurations::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','InsuranceDeductionConfigurations']])->get();
		$insurancedeductionconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($insurancedeductionconfigurationsdata['usersaccountsroles'][0]['_delete']==1){
			$insurancedeductionconfigurations->delete();
		}return redirect('admin/insurancedeductionconfigurations')->with('success','insurance deduction configurations has been deleted!');
	}
}