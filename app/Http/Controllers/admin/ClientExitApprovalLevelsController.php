<?php
/**
* @author  Wanjala Innocent Khaemba
*Controller - (client exit approval levels)
*/
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\ClientExitApprovalLevels;
use App\Companies;
use App\Modules;
use App\Users;
use App\ClientTypes;
use App\UsersAccounts;
use App\ApprovalLevels;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;
class ClientExitApprovalLevelsController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$clientexitapprovallevelsdata['clienttypes']=ClientTypes::all();
		$clientexitapprovallevelsdata['usersaccounts']=UsersAccounts::all();
		$clientexitapprovallevelsdata['approvallevels']=ApprovalLevels::all();
		$clientexitapprovallevelsdata['list']=ClientExitApprovalLevels::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ClientExitApprovalLevels']])->get();
		$clientexitapprovallevelsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($clientexitapprovallevelsdata['usersaccountsroles'][0]) && $clientexitapprovallevelsdata['usersaccountsroles'][0]['_add']==0&&$clientexitapprovallevelsdata['usersaccountsroles'][0]['_list']==0&&$clientexitapprovallevelsdata['usersaccountsroles'][0]['_edit']==0&&$clientexitapprovallevelsdata['usersaccountsroles'][0]['_edit']==0&&$clientexitapprovallevelsdata['usersaccountsroles'][0]['_show']==0&&$clientexitapprovallevelsdata['usersaccountsroles'][0]['_delete']==0&&$clientexitapprovallevelsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('clientexitapprovallevelsdata'));
		}else{
			return view('admin.client_exit_approval_levels.index',compact('clientexitapprovallevelsdata'));
		}
	}

	public function create(){
		$clientexitapprovallevelsdata;
		$clientexitapprovallevelsdata['clienttypes']=ClientTypes::all();
		$clientexitapprovallevelsdata['usersaccounts']=UsersAccounts::all();
		$clientexitapprovallevelsdata['approvallevels']=ApprovalLevels::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ClientExitApprovalLevels']])->get();
		$clientexitapprovallevelsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($clientexitapprovallevelsdata['usersaccountsroles'][0]) && $clientexitapprovallevelsdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('clientexitapprovallevelsdata'));
		}else{
			return view('admin.client_exit_approval_levels.create',compact('clientexitapprovallevelsdata'));
		}
	}

	public function filter(Request $request){
		$clientexitapprovallevelsdata['clienttypes']=ClientTypes::all();
		$clientexitapprovallevelsdata['usersaccounts']=UsersAccounts::all();
		$clientexitapprovallevelsdata['approvallevels']=ApprovalLevels::all();
		$clientexitapprovallevelsdata['list']=ClientExitApprovalLevels::where([['client_type','LIKE','%'.$request->get('client_type').'%'],['user_account','LIKE','%'.$request->get('user_account').'%'],['approval_level','LIKE','%'.$request->get('approval_level').'%'],])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ClientExitApprovalLevels']])->get();
		$clientexitapprovallevelsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($clientexitapprovallevelsdata['usersaccountsroles'][0]) && $clientexitapprovallevelsdata['usersaccountsroles'][0]['_add']==0&&$clientexitapprovallevelsdata['usersaccountsroles'][0]['_list']==0&&$clientexitapprovallevelsdata['usersaccountsroles'][0]['_edit']==0&&$clientexitapprovallevelsdata['usersaccountsroles'][0]['_edit']==0&&$clientexitapprovallevelsdata['usersaccountsroles'][0]['_show']==0&&$clientexitapprovallevelsdata['usersaccountsroles'][0]['_delete']==0&&$clientexitapprovallevelsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('clientexitapprovallevelsdata'));
		}else{
			return view('admin.client_exit_approval_levels.index',compact('clientexitapprovallevelsdata'));
		}
	}

	public function report(){
		$clientexitapprovallevelsdata['company']=Companies::all();
		$clientexitapprovallevelsdata['list']=ClientExitApprovalLevels::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ClientExitApprovalLevels']])->get();
		$clientexitapprovallevelsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($clientexitapprovallevelsdata['usersaccountsroles'][0]) && $clientexitapprovallevelsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('clientexitapprovallevelsdata'));
		}else{
			return view('admin.client_exit_approval_levels.report',compact('clientexitapprovallevelsdata'));
		}
	}

	public function chart(){
		return view('admin.client_exit_approval_levels.chart');
	}

	public function store(Request $request){
		$clientexitapprovallevels=new ClientExitApprovalLevels();
		$clientexitapprovallevels->client_type=$request->get('client_type');
		$clientexitapprovallevels->user_account=$request->get('user_account');
		$clientexitapprovallevels->approval_level=$request->get('approval_level');
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ClientExitApprovalLevels']])->get();
		$clientexitapprovallevelsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($clientexitapprovallevelsdata['usersaccountsroles'][0]) && $clientexitapprovallevelsdata['usersaccountsroles'][0]['_show']==1){
			try{
				if($clientexitapprovallevels->save()){
					$response['status']='1';
					$response['message']='client exit approval levels Added successfully';
					return json_encode($response);
			}else{
					$response['status']='0';
					$response['message']='Failed to add client exit approval levels. Please try again';
					return json_encode($response);
				}
			}
			catch(Exception $e){
					$response['status']='0';
					$response['message']='An Error occured while attempting to add client exit approval levels. Please try again';
					return json_encode($response);
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$clientexitapprovallevelsdata['clienttypes']=ClientTypes::all();
		$clientexitapprovallevelsdata['usersaccounts']=UsersAccounts::all();
		$clientexitapprovallevelsdata['approvallevels']=ApprovalLevels::all();
		$clientexitapprovallevelsdata['data']=ClientExitApprovalLevels::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ClientExitApprovalLevels']])->get();
		$clientexitapprovallevelsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($clientexitapprovallevelsdata['usersaccountsroles'][0]) && $clientexitapprovallevelsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('clientexitapprovallevelsdata'));
		}else{
		return view('admin.client_exit_approval_levels.edit',compact('clientexitapprovallevelsdata','id'));
		}
	}

	public function show($id){
		$clientexitapprovallevelsdata['clienttypes']=ClientTypes::all();
		$clientexitapprovallevelsdata['usersaccounts']=UsersAccounts::all();
		$clientexitapprovallevelsdata['approvallevels']=ApprovalLevels::all();
		$clientexitapprovallevelsdata['data']=ClientExitApprovalLevels::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ClientExitApprovalLevels']])->get();
		$clientexitapprovallevelsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($clientexitapprovallevelsdata['usersaccountsroles'][0]) && $clientexitapprovallevelsdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('clientexitapprovallevelsdata'));
		}else{
		return view('admin.client_exit_approval_levels.show',compact('clientexitapprovallevelsdata','id'));
		}
	}

	public function update(Request $request,$id){
		$clientexitapprovallevels=ClientExitApprovalLevels::find($id);
		$clientexitapprovallevelsdata['clienttypes']=ClientTypes::all();
		$clientexitapprovallevelsdata['usersaccounts']=UsersAccounts::all();
		$clientexitapprovallevelsdata['approvallevels']=ApprovalLevels::all();
		$clientexitapprovallevels->client_type=$request->get('client_type');
		$clientexitapprovallevels->user_account=$request->get('user_account');
		$clientexitapprovallevels->approval_level=$request->get('approval_level');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ClientExitApprovalLevels']])->get();
		$clientexitapprovallevelsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($clientexitapprovallevelsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('clientexitapprovallevelsdata'));
		}else{
		$clientexitapprovallevels->save();
		$clientexitapprovallevelsdata['data']=ClientExitApprovalLevels::find($id);
		return view('admin.client_exit_approval_levels.edit',compact('clientexitapprovallevelsdata','id'));
		}
	}

	public function destroy($id){
		$clientexitapprovallevels=ClientExitApprovalLevels::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ClientExitApprovalLevels']])->get();
		$clientexitapprovallevelsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($clientexitapprovallevelsdata['usersaccountsroles'][0]) && $clientexitapprovallevelsdata['usersaccountsroles'][0]['_delete']==1){
			$clientexitapprovallevels->delete();
		}return redirect('admin/clientexitapprovallevels')->with('success','client exit approval levels has been deleted!');
	}
}