<?php
/**
* @author  Wanjala Innocent Khaemba
*Controller - (account transfer approval levels)
*/
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\AccountTransferApprovalLevels;
use App\Companies;
use App\Modules;
use App\Users;
use App\ApprovalLevels;
use App\UsersAccounts;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;
class AccountTransferApprovalLevelsController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$accounttransferapprovallevelsdata['approvallevels']=ApprovalLevels::all();
		$accounttransferapprovallevelsdata['usersaccounts']=UsersAccounts::all();
		$accounttransferapprovallevelsdata['list']=AccountTransferApprovalLevels::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','AccountTransferApprovalLevels']])->get();
		$accounttransferapprovallevelsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($accounttransferapprovallevelsdata['usersaccountsroles'][0]) && $accounttransferapprovallevelsdata['usersaccountsroles'][0]['_add']==0&&$accounttransferapprovallevelsdata['usersaccountsroles'][0]['_list']==0&&$accounttransferapprovallevelsdata['usersaccountsroles'][0]['_edit']==0&&$accounttransferapprovallevelsdata['usersaccountsroles'][0]['_edit']==0&&$accounttransferapprovallevelsdata['usersaccountsroles'][0]['_show']==0&&$accounttransferapprovallevelsdata['usersaccountsroles'][0]['_delete']==0&&$accounttransferapprovallevelsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('accounttransferapprovallevelsdata'));
		}else{
			return view('admin.account_transfer_approval_levels.index',compact('accounttransferapprovallevelsdata'));
		}
	}

	public function create(){
		$accounttransferapprovallevelsdata;
		$accounttransferapprovallevelsdata['approvallevels']=ApprovalLevels::all();
		$accounttransferapprovallevelsdata['usersaccounts']=UsersAccounts::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','AccountTransferApprovalLevels']])->get();
		$accounttransferapprovallevelsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($accounttransferapprovallevelsdata['usersaccountsroles'][0]) && $accounttransferapprovallevelsdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('accounttransferapprovallevelsdata'));
		}else{
			return view('admin.account_transfer_approval_levels.create',compact('accounttransferapprovallevelsdata'));
		}
	}

	public function filter(Request $request){
		$accounttransferapprovallevelsdata['approvallevels']=ApprovalLevels::all();
		$accounttransferapprovallevelsdata['usersaccounts']=UsersAccounts::all();
		$accounttransferapprovallevelsdata['list']=AccountTransferApprovalLevels::where([['approval_level','LIKE','%'.$request->get('approval_level').'%'],['user_account','LIKE','%'.$request->get('user_account').'%'],])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','AccountTransferApprovalLevels']])->get();
		$accounttransferapprovallevelsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($accounttransferapprovallevelsdata['usersaccountsroles'][0]) && $accounttransferapprovallevelsdata['usersaccountsroles'][0]['_add']==0&&$accounttransferapprovallevelsdata['usersaccountsroles'][0]['_list']==0&&$accounttransferapprovallevelsdata['usersaccountsroles'][0]['_edit']==0&&$accounttransferapprovallevelsdata['usersaccountsroles'][0]['_edit']==0&&$accounttransferapprovallevelsdata['usersaccountsroles'][0]['_show']==0&&$accounttransferapprovallevelsdata['usersaccountsroles'][0]['_delete']==0&&$accounttransferapprovallevelsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('accounttransferapprovallevelsdata'));
		}else{
			return view('admin.account_transfer_approval_levels.index',compact('accounttransferapprovallevelsdata'));
		}
	}

	public function report(){
		$accounttransferapprovallevelsdata['company']=Companies::all();
		$accounttransferapprovallevelsdata['list']=AccountTransferApprovalLevels::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','AccountTransferApprovalLevels']])->get();
		$accounttransferapprovallevelsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($accounttransferapprovallevelsdata['usersaccountsroles'][0]) && $accounttransferapprovallevelsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('accounttransferapprovallevelsdata'));
		}else{
			return view('admin.account_transfer_approval_levels.report',compact('accounttransferapprovallevelsdata'));
		}
	}

	public function chart(){
		return view('admin.account_transfer_approval_levels.chart');
	}

	public function store(Request $request){
		$accounttransferapprovallevels=new AccountTransferApprovalLevels();
		$accounttransferapprovallevels->approval_level=$request->get('approval_level');
		$accounttransferapprovallevels->user_account=$request->get('user_account');
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','AccountTransferApprovalLevels']])->get();
		$accounttransferapprovallevelsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($accounttransferapprovallevelsdata['usersaccountsroles'][0]) && $accounttransferapprovallevelsdata['usersaccountsroles'][0]['_show']==1){
			try{
				if($accounttransferapprovallevels->save()){
					$response['status']='1';
					$response['message']='account transfer approval levels Added successfully';
					return json_encode($response);
			}else{
					$response['status']='0';
					$response['message']='Failed to add account transfer approval levels. Please try again';
					return json_encode($response);
				}
			}
			catch(Exception $e){
					$response['status']='0';
					$response['message']='An Error occured while attempting to add account transfer approval levels. Please try again';
					return json_encode($response);
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$accounttransferapprovallevelsdata['approvallevels']=ApprovalLevels::all();
		$accounttransferapprovallevelsdata['usersaccounts']=UsersAccounts::all();
		$accounttransferapprovallevelsdata['data']=AccountTransferApprovalLevels::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','AccountTransferApprovalLevels']])->get();
		$accounttransferapprovallevelsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($accounttransferapprovallevelsdata['usersaccountsroles'][0]) && $accounttransferapprovallevelsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('accounttransferapprovallevelsdata'));
		}else{
		return view('admin.account_transfer_approval_levels.edit',compact('accounttransferapprovallevelsdata','id'));
		}
	}

	public function show($id){
		$accounttransferapprovallevelsdata['approvallevels']=ApprovalLevels::all();
		$accounttransferapprovallevelsdata['usersaccounts']=UsersAccounts::all();
		$accounttransferapprovallevelsdata['data']=AccountTransferApprovalLevels::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','AccountTransferApprovalLevels']])->get();
		$accounttransferapprovallevelsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($accounttransferapprovallevelsdata['usersaccountsroles'][0]) && $accounttransferapprovallevelsdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('accounttransferapprovallevelsdata'));
		}else{
		return view('admin.account_transfer_approval_levels.show',compact('accounttransferapprovallevelsdata','id'));
		}
	}

	public function update(Request $request,$id){
		$accounttransferapprovallevels=AccountTransferApprovalLevels::find($id);
		$accounttransferapprovallevelsdata['approvallevels']=ApprovalLevels::all();
		$accounttransferapprovallevelsdata['usersaccounts']=UsersAccounts::all();
		$accounttransferapprovallevels->approval_level=$request->get('approval_level');
		$accounttransferapprovallevels->user_account=$request->get('user_account');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','AccountTransferApprovalLevels']])->get();
		$accounttransferapprovallevelsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($accounttransferapprovallevelsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('accounttransferapprovallevelsdata'));
		}else{
		$accounttransferapprovallevels->save();
		$accounttransferapprovallevelsdata['data']=AccountTransferApprovalLevels::find($id);
		return view('admin.account_transfer_approval_levels.edit',compact('accounttransferapprovallevelsdata','id'));
		}
	}

	public function destroy($id){
		$accounttransferapprovallevels=AccountTransferApprovalLevels::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','AccountTransferApprovalLevels']])->get();
		$accounttransferapprovallevelsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($accounttransferapprovallevelsdata['usersaccountsroles'][0]) && $accounttransferapprovallevelsdata['usersaccountsroles'][0]['_delete']==1){
			$accounttransferapprovallevels->delete();
		}return redirect('admin/accounttransferapprovallevels')->with('success','account transfer approval levels has been deleted!');
	}
}