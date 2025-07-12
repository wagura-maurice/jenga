<?php
/**
* @author  Wanjala Innocent Khaemba
*Controller - ()
*/
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\WithdrawalChargeConfigurations;
use App\Companies;
use App\Modules;
use App\Users;
use App\ClientTypes;
use App\WithdrawalModes;
use App\FeeTypes;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;
class WithdrawalChargeConfigurationsController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$withdrawalchargeconfigurationsdata['clienttypes']=ClientTypes::all();
		$withdrawalchargeconfigurationsdata['withdrawalmodes']=WithdrawalModes::all();
		$withdrawalchargeconfigurationsdata['feetypes']=FeeTypes::all();
		$withdrawalchargeconfigurationsdata['list']=WithdrawalChargeConfigurations::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','WithdrawalChargeConfigurations']])->get();
		$withdrawalchargeconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($withdrawalchargeconfigurationsdata['usersaccountsroles'][0]) && $withdrawalchargeconfigurationsdata['usersaccountsroles'][0]['_add']==0&&$withdrawalchargeconfigurationsdata['usersaccountsroles'][0]['_list']==0&&$withdrawalchargeconfigurationsdata['usersaccountsroles'][0]['_edit']==0&&$withdrawalchargeconfigurationsdata['usersaccountsroles'][0]['_edit']==0&&$withdrawalchargeconfigurationsdata['usersaccountsroles'][0]['_show']==0&&$withdrawalchargeconfigurationsdata['usersaccountsroles'][0]['_delete']==0&&$withdrawalchargeconfigurationsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('withdrawalchargeconfigurationsdata'));
		}else{
			return view('admin.withdrawal_charge_configurations.index',compact('withdrawalchargeconfigurationsdata'));
		}
	}

	public function create(){
		$withdrawalchargeconfigurationsdata;
		$withdrawalchargeconfigurationsdata['clienttypes']=ClientTypes::all();
		$withdrawalchargeconfigurationsdata['withdrawalmodes']=WithdrawalModes::all();
		$withdrawalchargeconfigurationsdata['feetypes']=FeeTypes::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','WithdrawalChargeConfigurations']])->get();
		$withdrawalchargeconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($withdrawalchargeconfigurationsdata['usersaccountsroles'][0]) && $withdrawalchargeconfigurationsdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('withdrawalchargeconfigurationsdata'));
		}else{
			return view('admin.withdrawal_charge_configurations.create',compact('withdrawalchargeconfigurationsdata'));
		}
	}

	public function filter(Request $request){
		$withdrawalchargeconfigurationsdata['clienttypes']=ClientTypes::all();
		$withdrawalchargeconfigurationsdata['withdrawalmodes']=WithdrawalModes::all();
		$withdrawalchargeconfigurationsdata['feetypes']=FeeTypes::all();
		$withdrawalchargeconfigurationsdata['list']=WithdrawalChargeConfigurations::where([['client_type','LIKE','%'.$request->get('client_type').'%'],['withdrawal_mode','LIKE','%'.$request->get('withdrawal_mode').'%'],['charge_type','LIKE','%'.$request->get('charge_type').'%'],['value','LIKE','%'.$request->get('value').'%'],])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','WithdrawalChargeConfigurations']])->get();
		$withdrawalchargeconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($withdrawalchargeconfigurationsdata['usersaccountsroles'][0]) && $withdrawalchargeconfigurationsdata['usersaccountsroles'][0]['_add']==0&&$withdrawalchargeconfigurationsdata['usersaccountsroles'][0]['_list']==0&&$withdrawalchargeconfigurationsdata['usersaccountsroles'][0]['_edit']==0&&$withdrawalchargeconfigurationsdata['usersaccountsroles'][0]['_edit']==0&&$withdrawalchargeconfigurationsdata['usersaccountsroles'][0]['_show']==0&&$withdrawalchargeconfigurationsdata['usersaccountsroles'][0]['_delete']==0&&$withdrawalchargeconfigurationsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('withdrawalchargeconfigurationsdata'));
		}else{
			return view('admin.withdrawal_charge_configurations.index',compact('withdrawalchargeconfigurationsdata'));
		}
	}

	public function report(){
		$withdrawalchargeconfigurationsdata['company']=Companies::all();
		$withdrawalchargeconfigurationsdata['list']=WithdrawalChargeConfigurations::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','WithdrawalChargeConfigurations']])->get();
		$withdrawalchargeconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($withdrawalchargeconfigurationsdata['usersaccountsroles'][0]) && $withdrawalchargeconfigurationsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('withdrawalchargeconfigurationsdata'));
		}else{
			return view('admin.withdrawal_charge_configurations.report',compact('withdrawalchargeconfigurationsdata'));
		}
	}

	public function chart(){
		return view('admin.withdrawal_charge_configurations.chart');
	}

	public function store(Request $request){
		$withdrawalchargeconfigurations=new WithdrawalChargeConfigurations();
		$withdrawalchargeconfigurations->client_type=$request->get('client_type');
		$withdrawalchargeconfigurations->withdrawal_mode=$request->get('withdrawal_mode');
		$withdrawalchargeconfigurations->charge_type=$request->get('charge_type');
		$withdrawalchargeconfigurations->value=$request->get('value');
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','WithdrawalChargeConfigurations']])->get();
		$withdrawalchargeconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($withdrawalchargeconfigurationsdata['usersaccountsroles'][0]) && $withdrawalchargeconfigurationsdata['usersaccountsroles'][0]['_show']==1){
			try{
				if($withdrawalchargeconfigurations->save()){
					$response['status']='1';
					$response['message']='withdrawal charge configurations Added successfully';
					return json_encode($response);
			}else{
					$response['status']='0';
					$response['message']='Failed to add withdrawal charge configurations. Please try again';
					return json_encode($response);
				}
			}
			catch(Exception $e){
					$response['status']='0';
					$response['message']='An Error occured while attempting to add withdrawal charge configurations. Please try again';
					return json_encode($response);
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$withdrawalchargeconfigurationsdata['clienttypes']=ClientTypes::all();
		$withdrawalchargeconfigurationsdata['withdrawalmodes']=WithdrawalModes::all();
		$withdrawalchargeconfigurationsdata['feetypes']=FeeTypes::all();
		$withdrawalchargeconfigurationsdata['data']=WithdrawalChargeConfigurations::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','WithdrawalChargeConfigurations']])->get();
		$withdrawalchargeconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($withdrawalchargeconfigurationsdata['usersaccountsroles'][0]) && $withdrawalchargeconfigurationsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('withdrawalchargeconfigurationsdata'));
		}else{
		return view('admin.withdrawal_charge_configurations.edit',compact('withdrawalchargeconfigurationsdata','id'));
		}
	}

	public function show($id){
		$withdrawalchargeconfigurationsdata['clienttypes']=ClientTypes::all();
		$withdrawalchargeconfigurationsdata['withdrawalmodes']=WithdrawalModes::all();
		$withdrawalchargeconfigurationsdata['feetypes']=FeeTypes::all();
		$withdrawalchargeconfigurationsdata['data']=WithdrawalChargeConfigurations::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','WithdrawalChargeConfigurations']])->get();
		$withdrawalchargeconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($withdrawalchargeconfigurationsdata['usersaccountsroles'][0]) && $withdrawalchargeconfigurationsdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('withdrawalchargeconfigurationsdata'));
		}else{
		return view('admin.withdrawal_charge_configurations.show',compact('withdrawalchargeconfigurationsdata','id'));
		}
	}

	public function update(Request $request,$id){
		$withdrawalchargeconfigurations=WithdrawalChargeConfigurations::find($id);
		$withdrawalchargeconfigurationsdata['clienttypes']=ClientTypes::all();
		$withdrawalchargeconfigurationsdata['withdrawalmodes']=WithdrawalModes::all();
		$withdrawalchargeconfigurationsdata['feetypes']=FeeTypes::all();
		$withdrawalchargeconfigurations->client_type=$request->get('client_type');
		$withdrawalchargeconfigurations->withdrawal_mode=$request->get('withdrawal_mode');
		$withdrawalchargeconfigurations->charge_type=$request->get('charge_type');
		$withdrawalchargeconfigurations->value=$request->get('value');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','WithdrawalChargeConfigurations']])->get();
		$withdrawalchargeconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($withdrawalchargeconfigurationsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('withdrawalchargeconfigurationsdata'));
		}else{
		$withdrawalchargeconfigurations->save();
		$withdrawalchargeconfigurationsdata['data']=WithdrawalChargeConfigurations::find($id);
		return view('admin.withdrawal_charge_configurations.edit',compact('withdrawalchargeconfigurationsdata','id'));
		}
	}

	public function destroy($id){
		$withdrawalchargeconfigurations=WithdrawalChargeConfigurations::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','WithdrawalChargeConfigurations']])->get();
		$withdrawalchargeconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($withdrawalchargeconfigurationsdata['usersaccountsroles'][0]) && $withdrawalchargeconfigurationsdata['usersaccountsroles'][0]['_delete']==1){
			$withdrawalchargeconfigurations->delete();
		}return redirect('admin/withdrawalchargeconfigurations')->with('success','withdrawal charge configurations has been deleted!');
	}
}