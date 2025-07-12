<?php
/**
* @author  Wanjala Innocent Khaemba
*Controller - (lgf transfer approval levels)
*/
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\LgfTransferApprovalLevels;
use App\Companies;
use App\Modules;
use App\Users;
use App\ClientTypes;
use App\UsersAccounts;
use App\ApprovalLevels;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;
class LgfTransferApprovalLevelsController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$lgftransferapprovallevelsdata['clienttypes']=ClientTypes::all();
		$lgftransferapprovallevelsdata['usersaccounts']=UsersAccounts::all();
		$lgftransferapprovallevelsdata['approvallevels']=ApprovalLevels::all();
		$lgftransferapprovallevelsdata['list']=LgfTransferApprovalLevels::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LgfTransferApprovalLevels']])->get();
		$lgftransferapprovallevelsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($lgftransferapprovallevelsdata['usersaccountsroles'][0]) && $lgftransferapprovallevelsdata['usersaccountsroles'][0]['_add']==0&&$lgftransferapprovallevelsdata['usersaccountsroles'][0]['_list']==0&&$lgftransferapprovallevelsdata['usersaccountsroles'][0]['_edit']==0&&$lgftransferapprovallevelsdata['usersaccountsroles'][0]['_edit']==0&&$lgftransferapprovallevelsdata['usersaccountsroles'][0]['_show']==0&&$lgftransferapprovallevelsdata['usersaccountsroles'][0]['_delete']==0&&$lgftransferapprovallevelsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('lgftransferapprovallevelsdata'));
		}else{
			return view('admin.lgf_transfer_approval_levels.index',compact('lgftransferapprovallevelsdata'));
		}
	}

	public function create(){
		$lgftransferapprovallevelsdata;
		$lgftransferapprovallevelsdata['clienttypes']=ClientTypes::all();
		$lgftransferapprovallevelsdata['usersaccounts']=UsersAccounts::all();
		$lgftransferapprovallevelsdata['approvallevels']=ApprovalLevels::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LgfTransferApprovalLevels']])->get();
		$lgftransferapprovallevelsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($lgftransferapprovallevelsdata['usersaccountsroles'][0]) && $lgftransferapprovallevelsdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('lgftransferapprovallevelsdata'));
		}else{
			return view('admin.lgf_transfer_approval_levels.create',compact('lgftransferapprovallevelsdata'));
		}
	}

	public function filter(Request $request){
		$lgftransferapprovallevelsdata['clienttypes']=ClientTypes::all();
		$lgftransferapprovallevelsdata['usersaccounts']=UsersAccounts::all();
		$lgftransferapprovallevelsdata['approvallevels']=ApprovalLevels::all();
		$lgftransferapprovallevelsdata['list']=LgfTransferApprovalLevels::where([['client_type','LIKE','%'.$request->get('client_type').'%'],['user_account','LIKE','%'.$request->get('user_account').'%'],['approval_level','LIKE','%'.$request->get('approval_level').'%'],])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LgfTransferApprovalLevels']])->get();
		$lgftransferapprovallevelsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($lgftransferapprovallevelsdata['usersaccountsroles'][0]) && $lgftransferapprovallevelsdata['usersaccountsroles'][0]['_add']==0&&$lgftransferapprovallevelsdata['usersaccountsroles'][0]['_list']==0&&$lgftransferapprovallevelsdata['usersaccountsroles'][0]['_edit']==0&&$lgftransferapprovallevelsdata['usersaccountsroles'][0]['_edit']==0&&$lgftransferapprovallevelsdata['usersaccountsroles'][0]['_show']==0&&$lgftransferapprovallevelsdata['usersaccountsroles'][0]['_delete']==0&&$lgftransferapprovallevelsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('lgftransferapprovallevelsdata'));
		}else{
			return view('admin.lgf_transfer_approval_levels.index',compact('lgftransferapprovallevelsdata'));
		}
	}

	public function report(){
		$lgftransferapprovallevelsdata['company']=Companies::all();
		$lgftransferapprovallevelsdata['list']=LgfTransferApprovalLevels::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LgfTransferApprovalLevels']])->get();
		$lgftransferapprovallevelsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($lgftransferapprovallevelsdata['usersaccountsroles'][0]) && $lgftransferapprovallevelsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('lgftransferapprovallevelsdata'));
		}else{
			return view('admin.lgf_transfer_approval_levels.report',compact('lgftransferapprovallevelsdata'));
		}
	}

	public function chart(){
		return view('admin.lgf_transfer_approval_levels.chart');
	}

	public function store(Request $request){
		$lgftransferapprovallevels=new LgfTransferApprovalLevels();
		$lgftransferapprovallevels->client_type=$request->get('client_type');
		$lgftransferapprovallevels->user_account=$request->get('user_account');
		$lgftransferapprovallevels->approval_level=$request->get('approval_level');
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LgfTransferApprovalLevels']])->get();
		$lgftransferapprovallevelsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($lgftransferapprovallevelsdata['usersaccountsroles'][0]) && $lgftransferapprovallevelsdata['usersaccountsroles'][0]['_show']==1){
			try{
				if($lgftransferapprovallevels->save()){
					$response['status']='1';
					$response['message']='lgf transfer approval levels Added successfully';
					return json_encode($response);
			}else{
					$response['status']='0';
					$response['message']='Failed to add lgf transfer approval levels. Please try again';
					return json_encode($response);
				}
			}
			catch(Exception $e){
					$response['status']='0';
					$response['message']='An Error occured while attempting to add lgf transfer approval levels. Please try again';
					return json_encode($response);
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$lgftransferapprovallevelsdata['clienttypes']=ClientTypes::all();
		$lgftransferapprovallevelsdata['usersaccounts']=UsersAccounts::all();
		$lgftransferapprovallevelsdata['approvallevels']=ApprovalLevels::all();
		$lgftransferapprovallevelsdata['data']=LgfTransferApprovalLevels::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LgfTransferApprovalLevels']])->get();
		$lgftransferapprovallevelsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($lgftransferapprovallevelsdata['usersaccountsroles'][0]) && $lgftransferapprovallevelsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('lgftransferapprovallevelsdata'));
		}else{
		return view('admin.lgf_transfer_approval_levels.edit',compact('lgftransferapprovallevelsdata','id'));
		}
	}

	public function show($id){
		$lgftransferapprovallevelsdata['clienttypes']=ClientTypes::all();
		$lgftransferapprovallevelsdata['usersaccounts']=UsersAccounts::all();
		$lgftransferapprovallevelsdata['approvallevels']=ApprovalLevels::all();
		$lgftransferapprovallevelsdata['data']=LgfTransferApprovalLevels::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LgfTransferApprovalLevels']])->get();
		$lgftransferapprovallevelsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($lgftransferapprovallevelsdata['usersaccountsroles'][0]) && $lgftransferapprovallevelsdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('lgftransferapprovallevelsdata'));
		}else{
		return view('admin.lgf_transfer_approval_levels.show',compact('lgftransferapprovallevelsdata','id'));
		}
	}

	public function update(Request $request,$id){
		$lgftransferapprovallevels=LgfTransferApprovalLevels::find($id);
		$lgftransferapprovallevelsdata['clienttypes']=ClientTypes::all();
		$lgftransferapprovallevelsdata['usersaccounts']=UsersAccounts::all();
		$lgftransferapprovallevelsdata['approvallevels']=ApprovalLevels::all();
		$lgftransferapprovallevels->client_type=$request->get('client_type');
		$lgftransferapprovallevels->user_account=$request->get('user_account');
		$lgftransferapprovallevels->approval_level=$request->get('approval_level');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LgfTransferApprovalLevels']])->get();
		$lgftransferapprovallevelsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($lgftransferapprovallevelsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('lgftransferapprovallevelsdata'));
		}else{
		$lgftransferapprovallevels->save();
		$lgftransferapprovallevelsdata['data']=LgfTransferApprovalLevels::find($id);
		return view('admin.lgf_transfer_approval_levels.edit',compact('lgftransferapprovallevelsdata','id'));
		}
	}

	public function destroy($id){
		$lgftransferapprovallevels=LgfTransferApprovalLevels::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LgfTransferApprovalLevels']])->get();
		$lgftransferapprovallevelsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($lgftransferapprovallevelsdata['usersaccountsroles'][0]) && $lgftransferapprovallevelsdata['usersaccountsroles'][0]['_delete']==1){
			$lgftransferapprovallevels->delete();
		}return redirect('admin/lgftransferapprovallevels')->with('success','lgf transfer approval levels has been deleted!');
	}
}