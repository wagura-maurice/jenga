<?php
/**
* @author  Wanjala Innocent Khaemba
*Controller - (bank transfer charge configurations)
*/
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\BankTransferChargeConfigurations;
use App\Companies;
use App\Modules;
use App\Users;
use App\ClientTypes;
use App\Accounts;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;
class BankTransferChargeConfigurationsController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$banktransferchargeconfigurationsdata['clienttypes']=ClientTypes::all();
		$banktransferchargeconfigurationsdata['accounts']=Accounts::all();
		$banktransferchargeconfigurationsdata['accounts']=Accounts::all();
		$banktransferchargeconfigurationsdata['list']=BankTransferChargeConfigurations::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','BankTransferChargeConfigurations']])->get();
		$banktransferchargeconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($banktransferchargeconfigurationsdata['usersaccountsroles'][0]) && $banktransferchargeconfigurationsdata['usersaccountsroles'][0]['_add']==0&&$banktransferchargeconfigurationsdata['usersaccountsroles'][0]['_list']==0&&$banktransferchargeconfigurationsdata['usersaccountsroles'][0]['_edit']==0&&$banktransferchargeconfigurationsdata['usersaccountsroles'][0]['_edit']==0&&$banktransferchargeconfigurationsdata['usersaccountsroles'][0]['_show']==0&&$banktransferchargeconfigurationsdata['usersaccountsroles'][0]['_delete']==0&&$banktransferchargeconfigurationsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('banktransferchargeconfigurationsdata'));
		}else{
			return view('admin.bank_transfer_charge_configurations.index',compact('banktransferchargeconfigurationsdata'));
		}
	}

	public function create(){
		$banktransferchargeconfigurationsdata;
		$banktransferchargeconfigurationsdata['clienttypes']=ClientTypes::all();
		$banktransferchargeconfigurationsdata['accounts']=Accounts::all();
		$banktransferchargeconfigurationsdata['accounts']=Accounts::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','BankTransferChargeConfigurations']])->get();
		$banktransferchargeconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($banktransferchargeconfigurationsdata['usersaccountsroles'][0]) && $banktransferchargeconfigurationsdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('banktransferchargeconfigurationsdata'));
		}else{
			return view('admin.bank_transfer_charge_configurations.create',compact('banktransferchargeconfigurationsdata'));
		}
	}

	public function filter(Request $request){
		$banktransferchargeconfigurationsdata['clienttypes']=ClientTypes::all();
		$banktransferchargeconfigurationsdata['accounts']=Accounts::all();
		$banktransferchargeconfigurationsdata['accounts']=Accounts::all();
		$banktransferchargeconfigurationsdata['list']=BankTransferChargeConfigurations::where([['client_type','LIKE','%'.$request->get('client_type').'%'],['debit_account','LIKE','%'.$request->get('debit_account').'%'],['credit_account','LIKE','%'.$request->get('credit_account').'%'],])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','BankTransferChargeConfigurations']])->get();
		$banktransferchargeconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($banktransferchargeconfigurationsdata['usersaccountsroles'][0]) && $banktransferchargeconfigurationsdata['usersaccountsroles'][0]['_add']==0&&$banktransferchargeconfigurationsdata['usersaccountsroles'][0]['_list']==0&&$banktransferchargeconfigurationsdata['usersaccountsroles'][0]['_edit']==0&&$banktransferchargeconfigurationsdata['usersaccountsroles'][0]['_edit']==0&&$banktransferchargeconfigurationsdata['usersaccountsroles'][0]['_show']==0&&$banktransferchargeconfigurationsdata['usersaccountsroles'][0]['_delete']==0&&$banktransferchargeconfigurationsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('banktransferchargeconfigurationsdata'));
		}else{
			return view('admin.bank_transfer_charge_configurations.index',compact('banktransferchargeconfigurationsdata'));
		}
	}

	public function report(){
		$banktransferchargeconfigurationsdata['company']=Companies::all();
		$banktransferchargeconfigurationsdata['list']=BankTransferChargeConfigurations::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','BankTransferChargeConfigurations']])->get();
		$banktransferchargeconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($banktransferchargeconfigurationsdata['usersaccountsroles'][0]) && $banktransferchargeconfigurationsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('banktransferchargeconfigurationsdata'));
		}else{
			return view('admin.bank_transfer_charge_configurations.report',compact('banktransferchargeconfigurationsdata'));
		}
	}

	public function chart(){
		return view('admin.bank_transfer_charge_configurations.chart');
	}

	public function store(Request $request){
		$banktransferchargeconfigurations=new BankTransferChargeConfigurations();
		$banktransferchargeconfigurations->client_type=$request->get('client_type');
		$banktransferchargeconfigurations->debit_account=$request->get('debit_account');
		$banktransferchargeconfigurations->credit_account=$request->get('credit_account');
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','BankTransferChargeConfigurations']])->get();
		$banktransferchargeconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($banktransferchargeconfigurationsdata['usersaccountsroles'][0]) && $banktransferchargeconfigurationsdata['usersaccountsroles'][0]['_show']==1){
			try{
				if($banktransferchargeconfigurations->save()){
					$response['status']='1';
					$response['message']='bank transfer charge configurations Added successfully';
					return json_encode($response);
			}else{
					$response['status']='0';
					$response['message']='Failed to add bank transfer charge configurations. Please try again';
					return json_encode($response);
				}
			}
			catch(Exception $e){
					$response['status']='0';
					$response['message']='An Error occured while attempting to add bank transfer charge configurations. Please try again';
					return json_encode($response);
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$banktransferchargeconfigurationsdata['clienttypes']=ClientTypes::all();
		$banktransferchargeconfigurationsdata['accounts']=Accounts::all();
		$banktransferchargeconfigurationsdata['accounts']=Accounts::all();
		$banktransferchargeconfigurationsdata['data']=BankTransferChargeConfigurations::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','BankTransferChargeConfigurations']])->get();
		$banktransferchargeconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($banktransferchargeconfigurationsdata['usersaccountsroles'][0]) && $banktransferchargeconfigurationsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('banktransferchargeconfigurationsdata'));
		}else{
		return view('admin.bank_transfer_charge_configurations.edit',compact('banktransferchargeconfigurationsdata','id'));
		}
	}

	public function show($id){
		$banktransferchargeconfigurationsdata['clienttypes']=ClientTypes::all();
		$banktransferchargeconfigurationsdata['accounts']=Accounts::all();
		$banktransferchargeconfigurationsdata['accounts']=Accounts::all();
		$banktransferchargeconfigurationsdata['data']=BankTransferChargeConfigurations::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','BankTransferChargeConfigurations']])->get();
		$banktransferchargeconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($banktransferchargeconfigurationsdata['usersaccountsroles'][0]) && $banktransferchargeconfigurationsdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('banktransferchargeconfigurationsdata'));
		}else{
		return view('admin.bank_transfer_charge_configurations.show',compact('banktransferchargeconfigurationsdata','id'));
		}
	}

	public function update(Request $request,$id){
		$banktransferchargeconfigurations=BankTransferChargeConfigurations::find($id);
		$banktransferchargeconfigurationsdata['clienttypes']=ClientTypes::all();
		$banktransferchargeconfigurationsdata['accounts']=Accounts::all();
		$banktransferchargeconfigurationsdata['accounts']=Accounts::all();
		$banktransferchargeconfigurations->client_type=$request->get('client_type');
		$banktransferchargeconfigurations->debit_account=$request->get('debit_account');
		$banktransferchargeconfigurations->credit_account=$request->get('credit_account');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','BankTransferChargeConfigurations']])->get();
		$banktransferchargeconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($banktransferchargeconfigurationsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('banktransferchargeconfigurationsdata'));
		}else{
		$banktransferchargeconfigurations->save();
		$banktransferchargeconfigurationsdata['data']=BankTransferChargeConfigurations::find($id);
		return view('admin.bank_transfer_charge_configurations.edit',compact('banktransferchargeconfigurationsdata','id'));
		}
	}

	public function destroy($id){
		$banktransferchargeconfigurations=BankTransferChargeConfigurations::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','BankTransferChargeConfigurations']])->get();
		$banktransferchargeconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($banktransferchargeconfigurationsdata['usersaccountsroles'][0]) && $banktransferchargeconfigurationsdata['usersaccountsroles'][0]['_delete']==1){
			$banktransferchargeconfigurations->delete();
		}return redirect('admin/banktransferchargeconfigurations')->with('success','bank transfer charge configurations has been deleted!');
	}
}