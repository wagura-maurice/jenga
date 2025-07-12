<?php
/**
* @author  Wanjala Innocent Khaemba
*Controller - (manages processing fee configurations)
*/
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\ProcessingFeeConfigurations;
use App\Companies;
use App\Modules;
use App\Users;
use App\LoanProducts;
use App\FeeTypes;
use App\FeePaymentTypes;
use App\Accounts;
use App\PaymentModes;
use App\DisbursementModes;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;
class ProcessingFeeConfigurationsController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$processingfeeconfigurationsdata['loanproducts']=LoanProducts::all();
		$processingfeeconfigurationsdata['feetypes']=FeeTypes::all();
		$processingfeeconfigurationsdata['feepaymenttypes']=FeePaymentTypes::all();
		$processingfeeconfigurationsdata['accounts']=Accounts::all();
		$processingfeeconfigurationsdata['accounts']=Accounts::all();
		$processingfeeconfigurationsdata['paymentmodes']=PaymentModes::all();
		$processingfeeconfigurationsdata['disbursementmodes']=DisbursementModes::all();
		$processingfeeconfigurationsdata['list']=ProcessingFeeConfigurations::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ProcessingFeeConfigurations']])->get();
		$processingfeeconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($processingfeeconfigurationsdata['usersaccountsroles'][0]['_add']==0&&$processingfeeconfigurationsdata['usersaccountsroles'][0]['_list']==0&&$processingfeeconfigurationsdata['usersaccountsroles'][0]['_edit']==0&&$processingfeeconfigurationsdata['usersaccountsroles'][0]['_edit']==0&&$processingfeeconfigurationsdata['usersaccountsroles'][0]['_show']==0&&$processingfeeconfigurationsdata['usersaccountsroles'][0]['_delete']==0&&$processingfeeconfigurationsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('processingfeeconfigurationsdata'));
		}else{
			return view('admin.processing_fee_configurations.index',compact('processingfeeconfigurationsdata'));
		}
	}

	public function create(){
		$processingfeeconfigurationsdata;
		$processingfeeconfigurationsdata['loanproducts']=LoanProducts::all();
		$processingfeeconfigurationsdata['feetypes']=FeeTypes::all();
		$processingfeeconfigurationsdata['feepaymenttypes']=FeePaymentTypes::all();
		$processingfeeconfigurationsdata['accounts']=Accounts::all();
		$processingfeeconfigurationsdata['accounts']=Accounts::all();
		$processingfeeconfigurationsdata['paymentmodes']=PaymentModes::all();
		$processingfeeconfigurationsdata['disbursementmodes']=DisbursementModes::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ProcessingFeeConfigurations']])->get();
		$processingfeeconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($processingfeeconfigurationsdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('processingfeeconfigurationsdata'));
		}else{
			return view('admin.processing_fee_configurations.create',compact('processingfeeconfigurationsdata'));
		}
	}

	public function filter(Request $request){
		$processingfeeconfigurationsdata['loanproducts']=LoanProducts::all();
		$processingfeeconfigurationsdata['feetypes']=FeeTypes::all();
		$processingfeeconfigurationsdata['feepaymenttypes']=FeePaymentTypes::all();
		$processingfeeconfigurationsdata['accounts']=Accounts::all();
		$processingfeeconfigurationsdata['accounts']=Accounts::all();
		$processingfeeconfigurationsdata['paymentmodes']=PaymentModes::all();
		$processingfeeconfigurationsdata['disbursementmodes']=DisbursementModes::all();
		$processingfeeconfigurationsdata['list']=ProcessingFeeConfigurations::where([['loan_product','LIKE','%'.$request->get('loan_product').'%'],['fee_type','LIKE','%'.$request->get('fee_type').'%'],['fee_payment_type','LIKE','%'.$request->get('fee_payment_type').'%'],['debit_account','LIKE','%'.$request->get('debit_account').'%'],['credit_account','LIKE','%'.$request->get('credit_account').'%'],['payment_mode','LIKE','%'.$request->get('payment_mode').'%'],['disbursement_modes','LIKE','%'.$request->get('disbursement_modes').'%'],])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ProcessingFeeConfigurations']])->get();
		$processingfeeconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($processingfeeconfigurationsdata['usersaccountsroles'][0]['_add']==0&&$processingfeeconfigurationsdata['usersaccountsroles'][0]['_list']==0&&$processingfeeconfigurationsdata['usersaccountsroles'][0]['_edit']==0&&$processingfeeconfigurationsdata['usersaccountsroles'][0]['_edit']==0&&$processingfeeconfigurationsdata['usersaccountsroles'][0]['_show']==0&&$processingfeeconfigurationsdata['usersaccountsroles'][0]['_delete']==0&&$processingfeeconfigurationsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('processingfeeconfigurationsdata'));
		}else{
			return view('admin.processing_fee_configurations.index',compact('processingfeeconfigurationsdata'));
		}
	}

	public function report(){
		$processingfeeconfigurationsdata['company']=Companies::all();
		$processingfeeconfigurationsdata['list']=ProcessingFeeConfigurations::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ProcessingFeeConfigurations']])->get();
		$processingfeeconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($processingfeeconfigurationsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('processingfeeconfigurationsdata'));
		}else{
			return view('admin.processing_fee_configurations.report',compact('processingfeeconfigurationsdata'));
		}
	}

	public function chart(){
		return view('admin.processing_fee_configurations.chart');
	}

	public function store(Request $request){
		$processingfeeconfigurations=new ProcessingFeeConfigurations();
		$processingfeeconfigurations->loan_product=$request->get('loan_product');
		$processingfeeconfigurations->fee_type=$request->get('fee_type');
		$processingfeeconfigurations->fee_payment_type=$request->get('fee_payment_type');
		$processingfeeconfigurations->debit_account=$request->get('debit_account');
		$processingfeeconfigurations->credit_account=$request->get('credit_account');
		$processingfeeconfigurations->payment_mode=$request->get('payment_mode');
		$processingfeeconfigurations->disbursement_modes=$request->get('disbursement_modes');
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ProcessingFeeConfigurations']])->get();
		$processingfeeconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($processingfeeconfigurationsdata['usersaccountsroles'][0]['_show']==1){
			try{
				if($processingfeeconfigurations->save()){
					$response['status']='1';
					$response['message']='processing fee configurations Added successfully';
					return json_encode($response);
			}else{
					$response['status']='0';
					$response['message']='Failed to add processing fee configurations. Please try again';
					return json_encode($response);
				}
			}
			catch(Exception $e){
					$response['status']='0';
					$response['message']='An Error occured while attempting to add processing fee configurations. Please try again';
					return json_encode($response);
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$processingfeeconfigurationsdata['loanproducts']=LoanProducts::all();
		$processingfeeconfigurationsdata['feetypes']=FeeTypes::all();
		$processingfeeconfigurationsdata['feepaymenttypes']=FeePaymentTypes::all();
		$processingfeeconfigurationsdata['accounts']=Accounts::all();
		$processingfeeconfigurationsdata['accounts']=Accounts::all();
		$processingfeeconfigurationsdata['paymentmodes']=PaymentModes::all();
		$processingfeeconfigurationsdata['disbursementmodes']=DisbursementModes::all();
		$processingfeeconfigurationsdata['data']=ProcessingFeeConfigurations::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ProcessingFeeConfigurations']])->get();
		$processingfeeconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($processingfeeconfigurationsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('processingfeeconfigurationsdata'));
		}else{
		return view('admin.processing_fee_configurations.edit',compact('processingfeeconfigurationsdata','id'));
		}
	}

	public function show($id){
		$processingfeeconfigurationsdata['loanproducts']=LoanProducts::all();
		$processingfeeconfigurationsdata['feetypes']=FeeTypes::all();
		$processingfeeconfigurationsdata['feepaymenttypes']=FeePaymentTypes::all();
		$processingfeeconfigurationsdata['accounts']=Accounts::all();
		$processingfeeconfigurationsdata['accounts']=Accounts::all();
		$processingfeeconfigurationsdata['paymentmodes']=PaymentModes::all();
		$processingfeeconfigurationsdata['disbursementmodes']=DisbursementModes::all();
		$processingfeeconfigurationsdata['data']=ProcessingFeeConfigurations::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ProcessingFeeConfigurations']])->get();
		$processingfeeconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($processingfeeconfigurationsdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('processingfeeconfigurationsdata'));
		}else{
		return view('admin.processing_fee_configurations.show',compact('processingfeeconfigurationsdata','id'));
		}
	}

	public function update(Request $request,$id){
		$processingfeeconfigurations=ProcessingFeeConfigurations::find($id);
		$processingfeeconfigurationsdata['loanproducts']=LoanProducts::all();
		$processingfeeconfigurationsdata['feetypes']=FeeTypes::all();
		$processingfeeconfigurationsdata['feepaymenttypes']=FeePaymentTypes::all();
		$processingfeeconfigurationsdata['accounts']=Accounts::all();
		$processingfeeconfigurationsdata['accounts']=Accounts::all();
		$processingfeeconfigurationsdata['paymentmodes']=PaymentModes::all();
		$processingfeeconfigurationsdata['disbursementmodes']=DisbursementModes::all();
		$processingfeeconfigurations->loan_product=$request->get('loan_product');
		$processingfeeconfigurations->fee_type=$request->get('fee_type');
		$processingfeeconfigurations->fee_payment_type=$request->get('fee_payment_type');
		$processingfeeconfigurations->debit_account=$request->get('debit_account');
		$processingfeeconfigurations->credit_account=$request->get('credit_account');
		$processingfeeconfigurations->payment_mode=$request->get('payment_mode');
		$processingfeeconfigurations->disbursement_modes=$request->get('disbursement_modes');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ProcessingFeeConfigurations']])->get();
		$processingfeeconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($processingfeeconfigurationsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('processingfeeconfigurationsdata'));
		}else{
		$processingfeeconfigurations->save();
		$processingfeeconfigurationsdata['data']=ProcessingFeeConfigurations::find($id);
		return view('admin.processing_fee_configurations.edit',compact('processingfeeconfigurationsdata','id'));
		}
	}

	public function destroy($id){
		$processingfeeconfigurations=ProcessingFeeConfigurations::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ProcessingFeeConfigurations']])->get();
		$processingfeeconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($processingfeeconfigurationsdata['usersaccountsroles'][0]['_delete']==1){
			$processingfeeconfigurations->delete();
		}return redirect('admin/processingfeeconfigurations')->with('success','processing fee configurations has been deleted!');
	}
}