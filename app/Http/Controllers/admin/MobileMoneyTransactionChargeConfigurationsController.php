<?php
/**
* @author  Wanjala Innocent Khaemba
*Controller - (mobile money transaction charge configurations)
*/
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\MobileMoneyTransactionChargeConfigurations;
use App\Companies;
use App\Modules;
use App\Users;
use App\ClientTypes;
use App\MobileMoneyModes;
use App\Accounts;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;
class MobileMoneyTransactionChargeConfigurationsController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$mobilemoneytransactionchargeconfigurationsdata['clienttypes']=ClientTypes::all();
		$mobilemoneytransactionchargeconfigurationsdata['mobilemoneymodes']=MobileMoneyModes::all();
		$mobilemoneytransactionchargeconfigurationsdata['accounts']=Accounts::all();
		$mobilemoneytransactionchargeconfigurationsdata['accounts']=Accounts::all();
		$mobilemoneytransactionchargeconfigurationsdata['list']=MobileMoneyTransactionChargeConfigurations::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','MobileMoneyTransactionChargeConfigurations']])->get();
		$mobilemoneytransactionchargeconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($mobilemoneytransactionchargeconfigurationsdata['usersaccountsroles'][0]) && $mobilemoneytransactionchargeconfigurationsdata['usersaccountsroles'][0]['_add']==0&&$mobilemoneytransactionchargeconfigurationsdata['usersaccountsroles'][0]['_list']==0&&$mobilemoneytransactionchargeconfigurationsdata['usersaccountsroles'][0]['_edit']==0&&$mobilemoneytransactionchargeconfigurationsdata['usersaccountsroles'][0]['_edit']==0&&$mobilemoneytransactionchargeconfigurationsdata['usersaccountsroles'][0]['_show']==0&&$mobilemoneytransactionchargeconfigurationsdata['usersaccountsroles'][0]['_delete']==0&&$mobilemoneytransactionchargeconfigurationsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('mobilemoneytransactionchargeconfigurationsdata'));
		}else{
			return view('admin.mobile_money_transaction_charge_configurations.index',compact('mobilemoneytransactionchargeconfigurationsdata'));
		}
	}

	public function create(){
		$mobilemoneytransactionchargeconfigurationsdata;
		$mobilemoneytransactionchargeconfigurationsdata['clienttypes']=ClientTypes::all();
		$mobilemoneytransactionchargeconfigurationsdata['mobilemoneymodes']=MobileMoneyModes::all();
		$mobilemoneytransactionchargeconfigurationsdata['accounts']=Accounts::all();
		$mobilemoneytransactionchargeconfigurationsdata['accounts']=Accounts::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','MobileMoneyTransactionChargeConfigurations']])->get();
		$mobilemoneytransactionchargeconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($mobilemoneytransactionchargeconfigurationsdata['usersaccountsroles'][0]) && $mobilemoneytransactionchargeconfigurationsdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('mobilemoneytransactionchargeconfigurationsdata'));
		}else{
			return view('admin.mobile_money_transaction_charge_configurations.create',compact('mobilemoneytransactionchargeconfigurationsdata'));
		}
	}

	public function filter(Request $request){
		$mobilemoneytransactionchargeconfigurationsdata['clienttypes']=ClientTypes::all();
		$mobilemoneytransactionchargeconfigurationsdata['mobilemoneymodes']=MobileMoneyModes::all();
		$mobilemoneytransactionchargeconfigurationsdata['accounts']=Accounts::all();
		$mobilemoneytransactionchargeconfigurationsdata['accounts']=Accounts::all();
		$mobilemoneytransactionchargeconfigurationsdata['list']=MobileMoneyTransactionChargeConfigurations::where([['client_type','LIKE','%'.$request->get('client_type').'%'],['mobile_money_mode','LIKE','%'.$request->get('mobile_money_mode').'%'],['debit_account','LIKE','%'.$request->get('debit_account').'%'],['credit_account','LIKE','%'.$request->get('credit_account').'%'],])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','MobileMoneyTransactionChargeConfigurations']])->get();
		$mobilemoneytransactionchargeconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($mobilemoneytransactionchargeconfigurationsdata['usersaccountsroles'][0]) && $mobilemoneytransactionchargeconfigurationsdata['usersaccountsroles'][0]['_add']==0&&$mobilemoneytransactionchargeconfigurationsdata['usersaccountsroles'][0]['_list']==0&&$mobilemoneytransactionchargeconfigurationsdata['usersaccountsroles'][0]['_edit']==0&&$mobilemoneytransactionchargeconfigurationsdata['usersaccountsroles'][0]['_edit']==0&&$mobilemoneytransactionchargeconfigurationsdata['usersaccountsroles'][0]['_show']==0&&$mobilemoneytransactionchargeconfigurationsdata['usersaccountsroles'][0]['_delete']==0&&$mobilemoneytransactionchargeconfigurationsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('mobilemoneytransactionchargeconfigurationsdata'));
		}else{
			return view('admin.mobile_money_transaction_charge_configurations.index',compact('mobilemoneytransactionchargeconfigurationsdata'));
		}
	}

	public function report(){
		$mobilemoneytransactionchargeconfigurationsdata['company']=Companies::all();
		$mobilemoneytransactionchargeconfigurationsdata['list']=MobileMoneyTransactionChargeConfigurations::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','MobileMoneyTransactionChargeConfigurations']])->get();
		$mobilemoneytransactionchargeconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($mobilemoneytransactionchargeconfigurationsdata['usersaccountsroles'][0]) && $mobilemoneytransactionchargeconfigurationsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('mobilemoneytransactionchargeconfigurationsdata'));
		}else{
			return view('admin.mobile_money_transaction_charge_configurations.report',compact('mobilemoneytransactionchargeconfigurationsdata'));
		}
	}

	public function chart(){
		return view('admin.mobile_money_transaction_charge_configurations.chart');
	}

	public function store(Request $request){
		$mobilemoneytransactionchargeconfigurations=new MobileMoneyTransactionChargeConfigurations();
		$mobilemoneytransactionchargeconfigurations->client_type=$request->get('client_type');
		$mobilemoneytransactionchargeconfigurations->mobile_money_mode=$request->get('mobile_money_mode');
		$mobilemoneytransactionchargeconfigurations->debit_account=$request->get('debit_account');
		$mobilemoneytransactionchargeconfigurations->credit_account=$request->get('credit_account');
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','MobileMoneyTransactionChargeConfigurations']])->get();
		$mobilemoneytransactionchargeconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($mobilemoneytransactionchargeconfigurationsdata['usersaccountsroles'][0]) && $mobilemoneytransactionchargeconfigurationsdata['usersaccountsroles'][0]['_show']==1){
			try{
				if($mobilemoneytransactionchargeconfigurations->save()){
					$response['status']='1';
					$response['message']='mobile money transaction charge configurations Added successfully';
					return json_encode($response);
			}else{
					$response['status']='0';
					$response['message']='Failed to add mobile money transaction charge configurations. Please try again';
					return json_encode($response);
				}
			}
			catch(Exception $e){
					$response['status']='0';
					$response['message']='An Error occured while attempting to add mobile money transaction charge configurations. Please try again';
					return json_encode($response);
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$mobilemoneytransactionchargeconfigurationsdata['clienttypes']=ClientTypes::all();
		$mobilemoneytransactionchargeconfigurationsdata['mobilemoneymodes']=MobileMoneyModes::all();
		$mobilemoneytransactionchargeconfigurationsdata['accounts']=Accounts::all();
		$mobilemoneytransactionchargeconfigurationsdata['accounts']=Accounts::all();
		$mobilemoneytransactionchargeconfigurationsdata['data']=MobileMoneyTransactionChargeConfigurations::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','MobileMoneyTransactionChargeConfigurations']])->get();
		$mobilemoneytransactionchargeconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($mobilemoneytransactionchargeconfigurationsdata['usersaccountsroles'][0]) && $mobilemoneytransactionchargeconfigurationsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('mobilemoneytransactionchargeconfigurationsdata'));
		}else{
		return view('admin.mobile_money_transaction_charge_configurations.edit',compact('mobilemoneytransactionchargeconfigurationsdata','id'));
		}
	}

	public function show($id){
		$mobilemoneytransactionchargeconfigurationsdata['clienttypes']=ClientTypes::all();
		$mobilemoneytransactionchargeconfigurationsdata['mobilemoneymodes']=MobileMoneyModes::all();
		$mobilemoneytransactionchargeconfigurationsdata['accounts']=Accounts::all();
		$mobilemoneytransactionchargeconfigurationsdata['accounts']=Accounts::all();
		$mobilemoneytransactionchargeconfigurationsdata['data']=MobileMoneyTransactionChargeConfigurations::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','MobileMoneyTransactionChargeConfigurations']])->get();
		$mobilemoneytransactionchargeconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($mobilemoneytransactionchargeconfigurationsdata['usersaccountsroles'][0]) && $mobilemoneytransactionchargeconfigurationsdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('mobilemoneytransactionchargeconfigurationsdata'));
		}else{
		return view('admin.mobile_money_transaction_charge_configurations.show',compact('mobilemoneytransactionchargeconfigurationsdata','id'));
		}
	}

	public function update(Request $request,$id){
		$mobilemoneytransactionchargeconfigurations=MobileMoneyTransactionChargeConfigurations::find($id);
		$mobilemoneytransactionchargeconfigurationsdata['clienttypes']=ClientTypes::all();
		$mobilemoneytransactionchargeconfigurationsdata['mobilemoneymodes']=MobileMoneyModes::all();
		$mobilemoneytransactionchargeconfigurationsdata['accounts']=Accounts::all();
		$mobilemoneytransactionchargeconfigurationsdata['accounts']=Accounts::all();
		$mobilemoneytransactionchargeconfigurations->client_type=$request->get('client_type');
		$mobilemoneytransactionchargeconfigurations->mobile_money_mode=$request->get('mobile_money_mode');
		$mobilemoneytransactionchargeconfigurations->debit_account=$request->get('debit_account');
		$mobilemoneytransactionchargeconfigurations->credit_account=$request->get('credit_account');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','MobileMoneyTransactionChargeConfigurations']])->get();
		$mobilemoneytransactionchargeconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($mobilemoneytransactionchargeconfigurationsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('mobilemoneytransactionchargeconfigurationsdata'));
		}else{
		$mobilemoneytransactionchargeconfigurations->save();
		$mobilemoneytransactionchargeconfigurationsdata['data']=MobileMoneyTransactionChargeConfigurations::find($id);
		return view('admin.mobile_money_transaction_charge_configurations.edit',compact('mobilemoneytransactionchargeconfigurationsdata','id'));
		}
	}

	public function destroy($id){
		$mobilemoneytransactionchargeconfigurations=MobileMoneyTransactionChargeConfigurations::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','MobileMoneyTransactionChargeConfigurations']])->get();
		$mobilemoneytransactionchargeconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($mobilemoneytransactionchargeconfigurationsdata['usersaccountsroles'][0]) && $mobilemoneytransactionchargeconfigurationsdata['usersaccountsroles'][0]['_delete']==1){
			$mobilemoneytransactionchargeconfigurations->delete();
		}return redirect('admin/mobilemoneytransactionchargeconfigurations')->with('success','mobile money transaction charge configurations has been deleted!');
	}
}