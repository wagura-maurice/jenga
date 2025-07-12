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
class ClearingFeeConfigurationsController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$clearingfeeconfigurationsdata['loanproducts']=LoanProducts::all();
		$clearingfeeconfigurationsdata['feetypes']=FeeTypes::all();
		$clearingfeeconfigurationsdata['feepaymenttypes']=FeePaymentTypes::all();
		$clearingfeeconfigurationsdata['paymentmodes']=PaymentModes::all();
		$clearingfeeconfigurationsdata['disbursementmodes']=DisbursementModes::all();
		$clearingfeeconfigurationsdata['accounts']=Accounts::all();

		$clearingfeeconfigurationsdata['list']=ClearingFeeConfigurations::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ClearingFeeConfigurations']])->get();
		$clearingfeeconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($clearingfeeconfigurationsdata['usersaccountsroles'][0]['_add']==0&&$clearingfeeconfigurationsdata['usersaccountsroles'][0]['_list']==0&&$clearingfeeconfigurationsdata['usersaccountsroles'][0]['_edit']==0&&$clearingfeeconfigurationsdata['usersaccountsroles'][0]['_edit']==0&&$clearingfeeconfigurationsdata['usersaccountsroles'][0]['_show']==0&&$clearingfeeconfigurationsdata['usersaccountsroles'][0]['_delete']==0&&$clearingfeeconfigurationsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('clearingfeeconfigurationsdata'));
		}else{
			return view('admin.clearing_fee_configurations.index',compact('clearingfeeconfigurationsdata'));
		}
	}

	public function create(){
		$clearingfeeconfigurationsdata;
		$clearingfeeconfigurationsdata['loanproducts']=LoanProducts::all();
		$clearingfeeconfigurationsdata['feetypes']=FeeTypes::all();
		$clearingfeeconfigurationsdata['feepaymenttypes']=FeePaymentTypes::all();
		$clearingfeeconfigurationsdata['paymentmodes']=PaymentModes::all();
		$clearingfeeconfigurationsdata['disbursementmodes']=DisbursementModes::all();
		$clearingfeeconfigurationsdata['accounts']=Accounts::all();
		$clearingfeeconfigurationsdata['accounts']=Accounts::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ClearingFeeConfigurations']])->get();
		$clearingfeeconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($clearingfeeconfigurationsdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('clearingfeeconfigurationsdata'));
		}else{
			return view('admin.clearing_fee_configurations.create',compact('clearingfeeconfigurationsdata'));
		}
	}

	public function filter(Request $request){
		$clearingfeeconfigurationsdata['loanproducts']=LoanProducts::all();
		$clearingfeeconfigurationsdata['feetypes']=FeeTypes::all();
		$clearingfeeconfigurationsdata['feepaymenttypes']=FeePaymentTypes::all();
		$clearingfeeconfigurationsdata['paymentmodes']=PaymentModes::all();
		$clearingfeeconfigurationsdata['disbursementmodes']=DisbursementModes::all();
		$clearingfeeconfigurationsdata['accounts']=Accounts::all();
		$clearingfeeconfigurationsdata['accounts']=Accounts::all();
		$clearingfeeconfigurationsdata['list']=ClearingFeeConfigurations::where([['loan_product','LIKE','%'.$request->get('loan_product').'%'],['fee_type','LIKE','%'.$request->get('fee_type').'%'],['fee_payment_type','LIKE','%'.$request->get('fee_payment_type').'%'],['payment_mode','LIKE','%'.$request->get('payment_mode').'%'],['disbursement_mode','LIKE','%'.$request->get('disbursement_mode').'%'],['debit_account','LIKE','%'.$request->get('debit_account').'%'],['credit_account','LIKE','%'.$request->get('credit_account').'%'],])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ClearingFeeConfigurations']])->get();
		$clearingfeeconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($clearingfeeconfigurationsdata['usersaccountsroles'][0]['_add']==0&&$clearingfeeconfigurationsdata['usersaccountsroles'][0]['_list']==0&&$clearingfeeconfigurationsdata['usersaccountsroles'][0]['_edit']==0&&$clearingfeeconfigurationsdata['usersaccountsroles'][0]['_edit']==0&&$clearingfeeconfigurationsdata['usersaccountsroles'][0]['_show']==0&&$clearingfeeconfigurationsdata['usersaccountsroles'][0]['_delete']==0&&$clearingfeeconfigurationsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('clearingfeeconfigurationsdata'));
		}else{
			return view('admin.clearing_fee_configurations.index',compact('clearingfeeconfigurationsdata'));
		}
	}

	public function report(){
		$clearingfeeconfigurationsdata['company']=Companies::all();
		$clearingfeeconfigurationsdata['list']=ClearingFeeConfigurations::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ClearingFeeConfigurations']])->get();
		$clearingfeeconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($clearingfeeconfigurationsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('clearingfeeconfigurationsdata'));
		}else{
			return view('admin.clearing_fee_configurations.report',compact('clearingfeeconfigurationsdata'));
		}
	}

	public function chart(){
		return view('admin.clearing_fee_configurations.chart');
	}

	public function store(Request $request){
		$clearingfeeconfigurations=new ClearingFeeConfigurations();
		$clearingfeeconfigurations->loan_product=$request->get('loan_product');
		$clearingfeeconfigurations->fee_type=$request->get('fee_type');
		$clearingfeeconfigurations->fee_payment_type=$request->get('fee_payment_type');
		$clearingfeeconfigurations->payment_mode=$request->get('payment_mode');
		$clearingfeeconfigurations->disbursement_mode=$request->get('disbursement_mode');
		$clearingfeeconfigurations->debit_account=$request->get('debit_account');
		$clearingfeeconfigurations->credit_account=$request->get('credit_account');
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ClearingFeeConfigurations']])->get();
		$clearingfeeconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($clearingfeeconfigurationsdata['usersaccountsroles'][0]['_show']==1){
			try{
				if($clearingfeeconfigurations->save()){
					$response['status']='1';
					$response['message']='clearing fee configurations Added successfully';
					return json_encode($response);
			}else{
					$response['status']='0';
					$response['message']='Failed to add clearing fee configurations. Please try again';
					return json_encode($response);
				}
			}
			catch(Exception $e){
					$response['status']='0';
					$response['message']='An Error occured while attempting to add clearing fee configurations. Please try again';
					return json_encode($response);
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$clearingfeeconfigurationsdata['loanproducts']=LoanProducts::all();
		$clearingfeeconfigurationsdata['feetypes']=FeeTypes::all();
		$clearingfeeconfigurationsdata['feepaymenttypes']=FeePaymentTypes::all();
		$clearingfeeconfigurationsdata['paymentmodes']=PaymentModes::all();
		$clearingfeeconfigurationsdata['disbursementmodes']=DisbursementModes::all();
		$clearingfeeconfigurationsdata['accounts']=Accounts::all();
		$clearingfeeconfigurationsdata['accounts']=Accounts::all();
		$clearingfeeconfigurationsdata['data']=ClearingFeeConfigurations::find($id);
		
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ClearingFeeConfigurations']])->get();
		$clearingfeeconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($clearingfeeconfigurationsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('clearingfeeconfigurationsdata'));
		}else{
		return view('admin.clearing_fee_configurations.edit',compact('clearingfeeconfigurationsdata','id'));
		}
	}

	public function show($id){
		$clearingfeeconfigurationsdata['loanproducts']=LoanProducts::all();
		$clearingfeeconfigurationsdata['feetypes']=FeeTypes::all();
		$clearingfeeconfigurationsdata['feepaymenttypes']=FeePaymentTypes::all();
		$clearingfeeconfigurationsdata['paymentmodes']=PaymentModes::all();
		$clearingfeeconfigurationsdata['disbursementmodes']=DisbursementModes::all();
		$clearingfeeconfigurationsdata['accounts']=Accounts::all();
		$clearingfeeconfigurationsdata['accounts']=Accounts::all();
		$clearingfeeconfigurationsdata['data']=ClearingFeeConfigurations::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ClearingFeeConfigurations']])->get();
		$clearingfeeconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($clearingfeeconfigurationsdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('clearingfeeconfigurationsdata'));
		}else{
		return view('admin.clearing_fee_configurations.show',compact('clearingfeeconfigurationsdata','id'));
		}
	}

	public function update(Request $request,$id){
		$clearingfeeconfigurations=ClearingFeeConfigurations::find($id);
		$clearingfeeconfigurationsdata['loanproducts']=LoanProducts::all();
		$clearingfeeconfigurationsdata['feetypes']=FeeTypes::all();
		$clearingfeeconfigurationsdata['feepaymenttypes']=FeePaymentTypes::all();
		$clearingfeeconfigurationsdata['paymentmodes']=PaymentModes::all();
		$clearingfeeconfigurationsdata['disbursementmodes']=DisbursementModes::all();
		$clearingfeeconfigurationsdata['accounts']=Accounts::all();
		$clearingfeeconfigurationsdata['accounts']=Accounts::all();
		$clearingfeeconfigurations->loan_product=$request->get('loan_product');
		$clearingfeeconfigurations->fee_type=$request->get('fee_type');
		$clearingfeeconfigurations->fee_payment_type=$request->get('fee_payment_type');
		$clearingfeeconfigurations->payment_mode=$request->get('payment_mode');
		$clearingfeeconfigurations->disbursement_mode=$request->get('disbursement_mode');
		$clearingfeeconfigurations->debit_account=$request->get('debit_account');
		$clearingfeeconfigurations->credit_account=$request->get('credit_account');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ClearingFeeConfigurations']])->get();
		$clearingfeeconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($clearingfeeconfigurationsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('clearingfeeconfigurationsdata'));
		}else{
		$clearingfeeconfigurations->save();
		$clearingfeeconfigurationsdata['data']=ClearingFeeConfigurations::find($id);
		return view('admin.clearing_fee_configurations.edit',compact('clearingfeeconfigurationsdata','id'));
		}
	}

	public function destroy($id){
		$clearingfeeconfigurations=ClearingFeeConfigurations::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ClearingFeeConfigurations']])->get();
		$clearingfeeconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($clearingfeeconfigurationsdata['usersaccountsroles'][0]['_delete']==1){
			$clearingfeeconfigurations->delete();
		}return redirect('admin/clearingfeeconfigurations')->with('success','clearing fee configurations has been deleted!');
	}
}