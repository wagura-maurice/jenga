<?php
/**
* @author  Wanjala Innocent Khaemba
*Controller - (bank transfer configurations)
*/
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\BankTransferConfigurations;
use App\Companies;
use App\Modules;
use App\Users;
use App\ClientTypes;
use App\Accounts;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;
class BankTransferConfigurationsController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$banktransferconfigurationsdata['clienttypes']=ClientTypes::all();
		$banktransferconfigurationsdata['accounts']=Accounts::all();
		$banktransferconfigurationsdata['accounts']=Accounts::all();
		$banktransferconfigurationsdata['list']=BankTransferConfigurations::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','BankTransferConfigurations']])->get();
		$banktransferconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($banktransferconfigurationsdata['usersaccountsroles'][0]) && $banktransferconfigurationsdata['usersaccountsroles'][0]['_add']==0&&$banktransferconfigurationsdata['usersaccountsroles'][0]['_list']==0&&$banktransferconfigurationsdata['usersaccountsroles'][0]['_edit']==0&&$banktransferconfigurationsdata['usersaccountsroles'][0]['_edit']==0&&$banktransferconfigurationsdata['usersaccountsroles'][0]['_show']==0&&$banktransferconfigurationsdata['usersaccountsroles'][0]['_delete']==0&&$banktransferconfigurationsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('banktransferconfigurationsdata'));
		}else{
			return view('admin.bank_transfer_configurations.index',compact('banktransferconfigurationsdata'));
		}
	}

	public function create(){
		$banktransferconfigurationsdata;
		$banktransferconfigurationsdata['clienttypes']=ClientTypes::all();
		$banktransferconfigurationsdata['accounts']=Accounts::all();
		$banktransferconfigurationsdata['accounts']=Accounts::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','BankTransferConfigurations']])->get();
		$banktransferconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($banktransferconfigurationsdata['usersaccountsroles'][0]) && $banktransferconfigurationsdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('banktransferconfigurationsdata'));
		}else{
			return view('admin.bank_transfer_configurations.create',compact('banktransferconfigurationsdata'));
		}
	}

	public function filter(Request $request){
		$banktransferconfigurationsdata['clienttypes']=ClientTypes::all();
		$banktransferconfigurationsdata['accounts']=Accounts::all();
		$banktransferconfigurationsdata['accounts']=Accounts::all();
		$banktransferconfigurationsdata['list']=BankTransferConfigurations::where([['client_type','LIKE','%'.$request->get('client_type').'%'],['debit_account','LIKE','%'.$request->get('debit_account').'%'],['credit_account','LIKE','%'.$request->get('credit_account').'%'],])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','BankTransferConfigurations']])->get();
		$banktransferconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($banktransferconfigurationsdata['usersaccountsroles'][0]) && $banktransferconfigurationsdata['usersaccountsroles'][0]['_add']==0&&$banktransferconfigurationsdata['usersaccountsroles'][0]['_list']==0&&$banktransferconfigurationsdata['usersaccountsroles'][0]['_edit']==0&&$banktransferconfigurationsdata['usersaccountsroles'][0]['_edit']==0&&$banktransferconfigurationsdata['usersaccountsroles'][0]['_show']==0&&$banktransferconfigurationsdata['usersaccountsroles'][0]['_delete']==0&&$banktransferconfigurationsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('banktransferconfigurationsdata'));
		}else{
			return view('admin.bank_transfer_configurations.index',compact('banktransferconfigurationsdata'));
		}
	}

	public function report(){
		$banktransferconfigurationsdata['company']=Companies::all();
		$banktransferconfigurationsdata['list']=BankTransferConfigurations::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','BankTransferConfigurations']])->get();
		$banktransferconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($banktransferconfigurationsdata['usersaccountsroles'][0]) && $banktransferconfigurationsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('banktransferconfigurationsdata'));
		}else{
			return view('admin.bank_transfer_configurations.report',compact('banktransferconfigurationsdata'));
		}
	}

	public function chart(){
		return view('admin.bank_transfer_configurations.chart');
	}

	public function store(Request $request){
		$banktransferconfigurations=new BankTransferConfigurations();
		$banktransferconfigurations->client_type=$request->get('client_type');
		$banktransferconfigurations->debit_account=$request->get('debit_account');
		$banktransferconfigurations->credit_account=$request->get('credit_account');
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','BankTransferConfigurations']])->get();
		$banktransferconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($banktransferconfigurationsdata['usersaccountsroles'][0]) && $banktransferconfigurationsdata['usersaccountsroles'][0]['_show']==1){
			try{
				if($banktransferconfigurations->save()){
					$response['status']='1';
					$response['message']='bank transfer configurations Added successfully';
					return json_encode($response);
			}else{
					$response['status']='0';
					$response['message']='Failed to add bank transfer configurations. Please try again';
					return json_encode($response);
				}
			}
			catch(Exception $e){
					$response['status']='0';
					$response['message']='An Error occured while attempting to add bank transfer configurations. Please try again';
					return json_encode($response);
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$banktransferconfigurationsdata['clienttypes']=ClientTypes::all();
		$banktransferconfigurationsdata['accounts']=Accounts::all();
		$banktransferconfigurationsdata['accounts']=Accounts::all();
		$banktransferconfigurationsdata['data']=BankTransferConfigurations::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','BankTransferConfigurations']])->get();
		$banktransferconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($banktransferconfigurationsdata['usersaccountsroles'][0]) && $banktransferconfigurationsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('banktransferconfigurationsdata'));
		}else{
		return view('admin.bank_transfer_configurations.edit',compact('banktransferconfigurationsdata','id'));
		}
	}

	public function show($id){
		$banktransferconfigurationsdata['clienttypes']=ClientTypes::all();
		$banktransferconfigurationsdata['accounts']=Accounts::all();
		$banktransferconfigurationsdata['accounts']=Accounts::all();
		$banktransferconfigurationsdata['data']=BankTransferConfigurations::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','BankTransferConfigurations']])->get();
		$banktransferconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($banktransferconfigurationsdata['usersaccountsroles'][0]) && $banktransferconfigurationsdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('banktransferconfigurationsdata'));
		}else{
		return view('admin.bank_transfer_configurations.show',compact('banktransferconfigurationsdata','id'));
		}
	}

	public function update(Request $request,$id){
		$banktransferconfigurations=BankTransferConfigurations::find($id);
		$banktransferconfigurationsdata['clienttypes']=ClientTypes::all();
		$banktransferconfigurationsdata['accounts']=Accounts::all();
		$banktransferconfigurationsdata['accounts']=Accounts::all();
		$banktransferconfigurations->client_type=$request->get('client_type');
		$banktransferconfigurations->debit_account=$request->get('debit_account');
		$banktransferconfigurations->credit_account=$request->get('credit_account');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','BankTransferConfigurations']])->get();
		$banktransferconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($banktransferconfigurationsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('banktransferconfigurationsdata'));
		}else{
		$banktransferconfigurations->save();
		$banktransferconfigurationsdata['data']=BankTransferConfigurations::find($id);
		return view('admin.bank_transfer_configurations.edit',compact('banktransferconfigurationsdata','id'));
		}
	}

	public function destroy($id){
		$banktransferconfigurations=BankTransferConfigurations::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','BankTransferConfigurations']])->get();
		$banktransferconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($banktransferconfigurationsdata['usersaccountsroles'][0]) && $banktransferconfigurationsdata['usersaccountsroles'][0]['_delete']==1){
			$banktransferconfigurations->delete();
		}return redirect('admin/banktransferconfigurations')->with('success','bank transfer configurations has been deleted!');
	}
}