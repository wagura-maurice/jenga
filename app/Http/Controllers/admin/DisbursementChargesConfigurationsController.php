<?php
/**
* @author  Wanjala Innocent Khaemba
*Controller - (manages disbursement charges configurations data)
*/
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\DisbursementChargesConfigurations;
use App\Companies;
use App\Modules;
use App\Users;
use App\LoanProducts;
use App\DisbursementCharges;
use App\DisbursementModes;
use App\Accounts;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;
class DisbursementChargesConfigurationsController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$disbursementchargesconfigurationsdata['loanproducts']=LoanProducts::all();
		$disbursementchargesconfigurationsdata['disbursementcharges']=DisbursementCharges::all();
		$disbursementchargesconfigurationsdata['disbursementmodes']=DisbursementModes::all();
		$disbursementchargesconfigurationsdata['accounts']=Accounts::all();
		$disbursementchargesconfigurationsdata['accounts']=Accounts::all();
		$disbursementchargesconfigurationsdata['list']=DisbursementChargesConfigurations::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','DisbursementChargesConfigurations']])->get();
		$disbursementchargesconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($disbursementchargesconfigurationsdata['usersaccountsroles'][0]['_add']==0&&$disbursementchargesconfigurationsdata['usersaccountsroles'][0]['_list']==0&&$disbursementchargesconfigurationsdata['usersaccountsroles'][0]['_edit']==0&&$disbursementchargesconfigurationsdata['usersaccountsroles'][0]['_edit']==0&&$disbursementchargesconfigurationsdata['usersaccountsroles'][0]['_show']==0&&$disbursementchargesconfigurationsdata['usersaccountsroles'][0]['_delete']==0&&$disbursementchargesconfigurationsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('disbursementchargesconfigurationsdata'));
		}else{
			return view('admin.disbursement_charges_configurations.index',compact('disbursementchargesconfigurationsdata'));
		}
	}

	public function create(){
		$disbursementchargesconfigurationsdata;
		$disbursementchargesconfigurationsdata['loanproducts']=LoanProducts::all();
		$disbursementchargesconfigurationsdata['disbursementcharges']=DisbursementCharges::all();
		$disbursementchargesconfigurationsdata['disbursementmodes']=DisbursementModes::all();
		$disbursementchargesconfigurationsdata['accounts']=Accounts::all();
		$disbursementchargesconfigurationsdata['accounts']=Accounts::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','DisbursementChargesConfigurations']])->get();
		$disbursementchargesconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($disbursementchargesconfigurationsdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('disbursementchargesconfigurationsdata'));
		}else{
			return view('admin.disbursement_charges_configurations.create',compact('disbursementchargesconfigurationsdata'));
		}
	}

	public function filter(Request $request){
		$disbursementchargesconfigurationsdata['loanproducts']=LoanProducts::all();
		$disbursementchargesconfigurationsdata['disbursementcharges']=DisbursementCharges::all();
		$disbursementchargesconfigurationsdata['disbursementmodes']=DisbursementModes::all();
		$disbursementchargesconfigurationsdata['accounts']=Accounts::all();
		$disbursementchargesconfigurationsdata['accounts']=Accounts::all();
		$disbursementchargesconfigurationsdata['list']=DisbursementChargesConfigurations::where([['loan_product','LIKE','%'.$request->get('loan_product').'%'],['disbursement_charge','LIKE','%'.$request->get('disbursement_charge').'%'],['disbursement_mode','LIKE','%'.$request->get('disbursement_mode').'%'],['debit_account','LIKE','%'.$request->get('debit_account').'%'],['credit_account','LIKE','%'.$request->get('credit_account').'%'],['amount','LIKE','%'.$request->get('amount').'%'],])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','DisbursementChargesConfigurations']])->get();
		$disbursementchargesconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($disbursementchargesconfigurationsdata['usersaccountsroles'][0]['_add']==0&&$disbursementchargesconfigurationsdata['usersaccountsroles'][0]['_list']==0&&$disbursementchargesconfigurationsdata['usersaccountsroles'][0]['_edit']==0&&$disbursementchargesconfigurationsdata['usersaccountsroles'][0]['_edit']==0&&$disbursementchargesconfigurationsdata['usersaccountsroles'][0]['_show']==0&&$disbursementchargesconfigurationsdata['usersaccountsroles'][0]['_delete']==0&&$disbursementchargesconfigurationsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('disbursementchargesconfigurationsdata'));
		}else{
			return view('admin.disbursement_charges_configurations.index',compact('disbursementchargesconfigurationsdata'));
		}
	}

	public function report(){
		$disbursementchargesconfigurationsdata['company']=Companies::all();
		$disbursementchargesconfigurationsdata['list']=DisbursementChargesConfigurations::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','DisbursementChargesConfigurations']])->get();
		$disbursementchargesconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($disbursementchargesconfigurationsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('disbursementchargesconfigurationsdata'));
		}else{
			return view('admin.disbursement_charges_configurations.report',compact('disbursementchargesconfigurationsdata'));
		}
	}

	public function chart(){
		return view('admin.disbursement_charges_configurations.chart');
	}

	public function store(Request $request){
		$disbursementchargesconfigurations=new DisbursementChargesConfigurations();
		$disbursementchargesconfigurations->loan_product=$request->get('loan_product');
		$disbursementchargesconfigurations->disbursement_charge=$request->get('disbursement_charge');
		$disbursementchargesconfigurations->disbursement_mode=$request->get('disbursement_mode');
		$disbursementchargesconfigurations->debit_account=$request->get('debit_account');
		$disbursementchargesconfigurations->credit_account=$request->get('credit_account');
		$disbursementchargesconfigurations->amount=$request->get('amount');
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','DisbursementChargesConfigurations']])->get();
		$disbursementchargesconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($disbursementchargesconfigurationsdata['usersaccountsroles'][0]['_show']==1){
			try{
				if($disbursementchargesconfigurations->save()){
					$response['status']='1';
					$response['message']='disbursement charges configurations  Added successfully';
					return json_encode($response);
			}else{
					$response['status']='0';
					$response['message']='Failed to add disbursement charges configurations . Please try again';
					return json_encode($response);
				}
			}
			catch(Exception $e){
					$response['status']='0';
					$response['message']='An Error occured while attempting to add disbursement charges configurations . Please try again';
					return json_encode($response);
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$disbursementchargesconfigurationsdata['loanproducts']=LoanProducts::all();
		$disbursementchargesconfigurationsdata['disbursementcharges']=DisbursementCharges::all();
		$disbursementchargesconfigurationsdata['disbursementmodes']=DisbursementModes::all();
		$disbursementchargesconfigurationsdata['accounts']=Accounts::all();
		$disbursementchargesconfigurationsdata['accounts']=Accounts::all();
		$disbursementchargesconfigurationsdata['data']=DisbursementChargesConfigurations::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','DisbursementChargesConfigurations']])->get();
		$disbursementchargesconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($disbursementchargesconfigurationsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('disbursementchargesconfigurationsdata'));
		}else{
		return view('admin.disbursement_charges_configurations.edit',compact('disbursementchargesconfigurationsdata','id'));
		}
	}

	public function show($id){
		$disbursementchargesconfigurationsdata['loanproducts']=LoanProducts::all();
		$disbursementchargesconfigurationsdata['disbursementcharges']=DisbursementCharges::all();
		$disbursementchargesconfigurationsdata['disbursementmodes']=DisbursementModes::all();
		$disbursementchargesconfigurationsdata['accounts']=Accounts::all();
		$disbursementchargesconfigurationsdata['accounts']=Accounts::all();
		$disbursementchargesconfigurationsdata['data']=DisbursementChargesConfigurations::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','DisbursementChargesConfigurations']])->get();
		$disbursementchargesconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($disbursementchargesconfigurationsdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('disbursementchargesconfigurationsdata'));
		}else{
		return view('admin.disbursement_charges_configurations.show',compact('disbursementchargesconfigurationsdata','id'));
		}
	}

	public function update(Request $request,$id){
		$disbursementchargesconfigurations=DisbursementChargesConfigurations::find($id);
		$disbursementchargesconfigurationsdata['loanproducts']=LoanProducts::all();
		$disbursementchargesconfigurationsdata['disbursementcharges']=DisbursementCharges::all();
		$disbursementchargesconfigurationsdata['disbursementmodes']=DisbursementModes::all();
		$disbursementchargesconfigurationsdata['accounts']=Accounts::all();
		$disbursementchargesconfigurationsdata['accounts']=Accounts::all();
		$disbursementchargesconfigurations->loan_product=$request->get('loan_product');
		$disbursementchargesconfigurations->disbursement_charge=$request->get('disbursement_charge');
		$disbursementchargesconfigurations->disbursement_mode=$request->get('disbursement_mode');
		$disbursementchargesconfigurations->debit_account=$request->get('debit_account');
		$disbursementchargesconfigurations->credit_account=$request->get('credit_account');
		$disbursementchargesconfigurations->amount=$request->get('amount');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','DisbursementChargesConfigurations']])->get();
		$disbursementchargesconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($disbursementchargesconfigurationsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('disbursementchargesconfigurationsdata'));
		}else{
		$disbursementchargesconfigurations->save();
		$disbursementchargesconfigurationsdata['data']=DisbursementChargesConfigurations::find($id);
		return view('admin.disbursement_charges_configurations.edit',compact('disbursementchargesconfigurationsdata','id'));
		}
	}

	public function destroy($id){
		$disbursementchargesconfigurations=DisbursementChargesConfigurations::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','DisbursementChargesConfigurations']])->get();
		$disbursementchargesconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($disbursementchargesconfigurationsdata['usersaccountsroles'][0]['_delete']==1){
			$disbursementchargesconfigurations->delete();
		}return redirect('admin/disbursementchargesconfigurations')->with('success','disbursement charges configurations  has been deleted!');
	}
}