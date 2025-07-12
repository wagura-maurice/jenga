<?php
/**
* @author  Wanjala Innocent Khaemba
*Controller - (mobile money transfer configurations)
*/
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\MobileMoneyTransferConfigurations;
use App\Companies;
use App\Modules;
use App\Users;
use App\ClientTypes;
use App\MobileMoneyModes;
use App\Accounts;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;
class MobileMoneyTransferConfigurationsController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$mobilemoneytransferconfigurationsdata['clienttypes']=ClientTypes::all();
		$mobilemoneytransferconfigurationsdata['mobilemoneymodes']=MobileMoneyModes::all();
		$mobilemoneytransferconfigurationsdata['accounts']=Accounts::all();
		$mobilemoneytransferconfigurationsdata['accounts']=Accounts::all();
		$mobilemoneytransferconfigurationsdata['list']=MobileMoneyTransferConfigurations::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','MobileMoneyTransferConfigurations']])->get();
		$mobilemoneytransferconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($mobilemoneytransferconfigurationsdata['usersaccountsroles'][0]) && $mobilemoneytransferconfigurationsdata['usersaccountsroles'][0]['_add']==0&&$mobilemoneytransferconfigurationsdata['usersaccountsroles'][0]['_list']==0&&$mobilemoneytransferconfigurationsdata['usersaccountsroles'][0]['_edit']==0&&$mobilemoneytransferconfigurationsdata['usersaccountsroles'][0]['_edit']==0&&$mobilemoneytransferconfigurationsdata['usersaccountsroles'][0]['_show']==0&&$mobilemoneytransferconfigurationsdata['usersaccountsroles'][0]['_delete']==0&&$mobilemoneytransferconfigurationsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('mobilemoneytransferconfigurationsdata'));
		}else{
			return view('admin.mobile_money_transfer_configurations.index',compact('mobilemoneytransferconfigurationsdata'));
		}
	}

	public function create(){
		$mobilemoneytransferconfigurationsdata;
		$mobilemoneytransferconfigurationsdata['clienttypes']=ClientTypes::all();
		$mobilemoneytransferconfigurationsdata['mobilemoneymodes']=MobileMoneyModes::all();
		$mobilemoneytransferconfigurationsdata['accounts']=Accounts::all();
		$mobilemoneytransferconfigurationsdata['accounts']=Accounts::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','MobileMoneyTransferConfigurations']])->get();
		$mobilemoneytransferconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($mobilemoneytransferconfigurationsdata['usersaccountsroles'][0]) && $mobilemoneytransferconfigurationsdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('mobilemoneytransferconfigurationsdata'));
		}else{
			return view('admin.mobile_money_transfer_configurations.create',compact('mobilemoneytransferconfigurationsdata'));
		}
	}

	public function filter(Request $request){
		$mobilemoneytransferconfigurationsdata['clienttypes']=ClientTypes::all();
		$mobilemoneytransferconfigurationsdata['mobilemoneymodes']=MobileMoneyModes::all();
		$mobilemoneytransferconfigurationsdata['accounts']=Accounts::all();
		$mobilemoneytransferconfigurationsdata['accounts']=Accounts::all();
		$mobilemoneytransferconfigurationsdata['list']=MobileMoneyTransferConfigurations::where([['client_type','LIKE','%'.$request->get('client_type').'%'],['mobile_money_mode','LIKE','%'.$request->get('mobile_money_mode').'%'],['debit_account','LIKE','%'.$request->get('debit_account').'%'],['credit_account','LIKE','%'.$request->get('credit_account').'%'],])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','MobileMoneyTransferConfigurations']])->get();
		$mobilemoneytransferconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($mobilemoneytransferconfigurationsdata['usersaccountsroles'][0]) && $mobilemoneytransferconfigurationsdata['usersaccountsroles'][0]['_add']==0&&$mobilemoneytransferconfigurationsdata['usersaccountsroles'][0]['_list']==0&&$mobilemoneytransferconfigurationsdata['usersaccountsroles'][0]['_edit']==0&&$mobilemoneytransferconfigurationsdata['usersaccountsroles'][0]['_edit']==0&&$mobilemoneytransferconfigurationsdata['usersaccountsroles'][0]['_show']==0&&$mobilemoneytransferconfigurationsdata['usersaccountsroles'][0]['_delete']==0&&$mobilemoneytransferconfigurationsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('mobilemoneytransferconfigurationsdata'));
		}else{
			return view('admin.mobile_money_transfer_configurations.index',compact('mobilemoneytransferconfigurationsdata'));
		}
	}

	public function report(){
		$mobilemoneytransferconfigurationsdata['company']=Companies::all();
		$mobilemoneytransferconfigurationsdata['list']=MobileMoneyTransferConfigurations::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','MobileMoneyTransferConfigurations']])->get();
		$mobilemoneytransferconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($mobilemoneytransferconfigurationsdata['usersaccountsroles'][0]) && $mobilemoneytransferconfigurationsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('mobilemoneytransferconfigurationsdata'));
		}else{
			return view('admin.mobile_money_transfer_configurations.report',compact('mobilemoneytransferconfigurationsdata'));
		}
	}

	public function chart(){
		return view('admin.mobile_money_transfer_configurations.chart');
	}

	public function store(Request $request){
		$mobilemoneytransferconfigurations=new MobileMoneyTransferConfigurations();
		$mobilemoneytransferconfigurations->client_type=$request->get('client_type');
		$mobilemoneytransferconfigurations->mobile_money_mode=$request->get('mobile_money_mode');
		$mobilemoneytransferconfigurations->debit_account=$request->get('debit_account');
		$mobilemoneytransferconfigurations->credit_account=$request->get('credit_account');
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','MobileMoneyTransferConfigurations']])->get();
		$mobilemoneytransferconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($mobilemoneytransferconfigurationsdata['usersaccountsroles'][0]) && $mobilemoneytransferconfigurationsdata['usersaccountsroles'][0]['_show']==1){
			try{
				if($mobilemoneytransferconfigurations->save()){
					$response['status']='1';
					$response['message']='mobile money transfer configurations Added successfully';
					return json_encode($response);
			}else{
					$response['status']='0';
					$response['message']='Failed to add mobile money transfer configurations. Please try again';
					return json_encode($response);
				}
			}
			catch(Exception $e){
					$response['status']='0';
					$response['message']='An Error occured while attempting to add mobile money transfer configurations. Please try again';
					return json_encode($response);
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$mobilemoneytransferconfigurationsdata['clienttypes']=ClientTypes::all();
		$mobilemoneytransferconfigurationsdata['mobilemoneymodes']=MobileMoneyModes::all();
		$mobilemoneytransferconfigurationsdata['accounts']=Accounts::all();
		$mobilemoneytransferconfigurationsdata['accounts']=Accounts::all();
		$mobilemoneytransferconfigurationsdata['data']=MobileMoneyTransferConfigurations::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','MobileMoneyTransferConfigurations']])->get();
		$mobilemoneytransferconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($mobilemoneytransferconfigurationsdata['usersaccountsroles'][0]) && $mobilemoneytransferconfigurationsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('mobilemoneytransferconfigurationsdata'));
		}else{
		return view('admin.mobile_money_transfer_configurations.edit',compact('mobilemoneytransferconfigurationsdata','id'));
		}
	}

	public function show($id){
		$mobilemoneytransferconfigurationsdata['clienttypes']=ClientTypes::all();
		$mobilemoneytransferconfigurationsdata['mobilemoneymodes']=MobileMoneyModes::all();
		$mobilemoneytransferconfigurationsdata['accounts']=Accounts::all();
		$mobilemoneytransferconfigurationsdata['accounts']=Accounts::all();
		$mobilemoneytransferconfigurationsdata['data']=MobileMoneyTransferConfigurations::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','MobileMoneyTransferConfigurations']])->get();
		$mobilemoneytransferconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($mobilemoneytransferconfigurationsdata['usersaccountsroles'][0]) && $mobilemoneytransferconfigurationsdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('mobilemoneytransferconfigurationsdata'));
		}else{
		return view('admin.mobile_money_transfer_configurations.show',compact('mobilemoneytransferconfigurationsdata','id'));
		}
	}

	public function update(Request $request,$id){
		$mobilemoneytransferconfigurations=MobileMoneyTransferConfigurations::find($id);
		$mobilemoneytransferconfigurationsdata['clienttypes']=ClientTypes::all();
		$mobilemoneytransferconfigurationsdata['mobilemoneymodes']=MobileMoneyModes::all();
		$mobilemoneytransferconfigurationsdata['accounts']=Accounts::all();
		$mobilemoneytransferconfigurationsdata['accounts']=Accounts::all();
		$mobilemoneytransferconfigurations->client_type=$request->get('client_type');
		$mobilemoneytransferconfigurations->mobile_money_mode=$request->get('mobile_money_mode');
		$mobilemoneytransferconfigurations->debit_account=$request->get('debit_account');
		$mobilemoneytransferconfigurations->credit_account=$request->get('credit_account');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','MobileMoneyTransferConfigurations']])->get();
		$mobilemoneytransferconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($mobilemoneytransferconfigurationsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('mobilemoneytransferconfigurationsdata'));
		}else{
		$mobilemoneytransferconfigurations->save();
		$mobilemoneytransferconfigurationsdata['data']=MobileMoneyTransferConfigurations::find($id);
		return view('admin.mobile_money_transfer_configurations.edit',compact('mobilemoneytransferconfigurationsdata','id'));
		}
	}

	public function destroy($id){
		$mobilemoneytransferconfigurations=MobileMoneyTransferConfigurations::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','MobileMoneyTransferConfigurations']])->get();
		$mobilemoneytransferconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($mobilemoneytransferconfigurationsdata['usersaccountsroles'][0]) && $mobilemoneytransferconfigurationsdata['usersaccountsroles'][0]['_delete']==1){
			$mobilemoneytransferconfigurations->delete();
		}return redirect('admin/mobilemoneytransferconfigurations')->with('success','mobile money transfer configurations has been deleted!');
	}
}