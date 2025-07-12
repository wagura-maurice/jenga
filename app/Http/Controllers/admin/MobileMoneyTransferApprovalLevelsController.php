<?php
/**
* @author  Wanjala Innocent Khaemba
*Controller - (mobile money transfer approval levels)
*/
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\MobileMoneyTransferApprovalLevels;
use App\Companies;
use App\Modules;
use App\Users;
use App\ClientTypes;
use App\UsersAccounts;
use App\ApprovalLevels;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;
class MobileMoneyTransferApprovalLevelsController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$mobilemoneytransferapprovallevelsdata['clienttypes']=ClientTypes::all();
		$mobilemoneytransferapprovallevelsdata['usersaccounts']=UsersAccounts::all();
		$mobilemoneytransferapprovallevelsdata['approvallevels']=ApprovalLevels::all();
		$mobilemoneytransferapprovallevelsdata['list']=MobileMoneyTransferApprovalLevels::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','MobileMoneyTransferApprovalLevels']])->get();
		$mobilemoneytransferapprovallevelsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($mobilemoneytransferapprovallevelsdata['usersaccountsroles'][0]) && $mobilemoneytransferapprovallevelsdata['usersaccountsroles'][0]['_add']==0&&$mobilemoneytransferapprovallevelsdata['usersaccountsroles'][0]['_list']==0&&$mobilemoneytransferapprovallevelsdata['usersaccountsroles'][0]['_edit']==0&&$mobilemoneytransferapprovallevelsdata['usersaccountsroles'][0]['_edit']==0&&$mobilemoneytransferapprovallevelsdata['usersaccountsroles'][0]['_show']==0&&$mobilemoneytransferapprovallevelsdata['usersaccountsroles'][0]['_delete']==0&&$mobilemoneytransferapprovallevelsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('mobilemoneytransferapprovallevelsdata'));
		}else{
			return view('admin.mobile_money_transfer_approval_levels.index',compact('mobilemoneytransferapprovallevelsdata'));
		}
	}

	public function create(){
		$mobilemoneytransferapprovallevelsdata;
		$mobilemoneytransferapprovallevelsdata['clienttypes']=ClientTypes::all();
		$mobilemoneytransferapprovallevelsdata['usersaccounts']=UsersAccounts::all();
		$mobilemoneytransferapprovallevelsdata['approvallevels']=ApprovalLevels::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','MobileMoneyTransferApprovalLevels']])->get();
		$mobilemoneytransferapprovallevelsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($mobilemoneytransferapprovallevelsdata['usersaccountsroles'][0]) && $mobilemoneytransferapprovallevelsdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('mobilemoneytransferapprovallevelsdata'));
		}else{
			return view('admin.mobile_money_transfer_approval_levels.create',compact('mobilemoneytransferapprovallevelsdata'));
		}
	}

	public function filter(Request $request){
		$mobilemoneytransferapprovallevelsdata['clienttypes']=ClientTypes::all();
		$mobilemoneytransferapprovallevelsdata['usersaccounts']=UsersAccounts::all();
		$mobilemoneytransferapprovallevelsdata['approvallevels']=ApprovalLevels::all();
		$mobilemoneytransferapprovallevelsdata['list']=MobileMoneyTransferApprovalLevels::where([['client_type','LIKE','%'.$request->get('client_type').'%'],['user_account','LIKE','%'.$request->get('user_account').'%'],['approval_level','LIKE','%'.$request->get('approval_level').'%'],])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','MobileMoneyTransferApprovalLevels']])->get();
		$mobilemoneytransferapprovallevelsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($mobilemoneytransferapprovallevelsdata['usersaccountsroles'][0]) && $mobilemoneytransferapprovallevelsdata['usersaccountsroles'][0]['_add']==0&&$mobilemoneytransferapprovallevelsdata['usersaccountsroles'][0]['_list']==0&&$mobilemoneytransferapprovallevelsdata['usersaccountsroles'][0]['_edit']==0&&$mobilemoneytransferapprovallevelsdata['usersaccountsroles'][0]['_edit']==0&&$mobilemoneytransferapprovallevelsdata['usersaccountsroles'][0]['_show']==0&&$mobilemoneytransferapprovallevelsdata['usersaccountsroles'][0]['_delete']==0&&$mobilemoneytransferapprovallevelsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('mobilemoneytransferapprovallevelsdata'));
		}else{
			return view('admin.mobile_money_transfer_approval_levels.index',compact('mobilemoneytransferapprovallevelsdata'));
		}
	}

	public function report(){
		$mobilemoneytransferapprovallevelsdata['company']=Companies::all();
		$mobilemoneytransferapprovallevelsdata['list']=MobileMoneyTransferApprovalLevels::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','MobileMoneyTransferApprovalLevels']])->get();
		$mobilemoneytransferapprovallevelsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($mobilemoneytransferapprovallevelsdata['usersaccountsroles'][0]) && $mobilemoneytransferapprovallevelsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('mobilemoneytransferapprovallevelsdata'));
		}else{
			return view('admin.mobile_money_transfer_approval_levels.report',compact('mobilemoneytransferapprovallevelsdata'));
		}
	}

	public function chart(){
		return view('admin.mobile_money_transfer_approval_levels.chart');
	}

	public function store(Request $request){
		$mobilemoneytransferapprovallevels=new MobileMoneyTransferApprovalLevels();
		$mobilemoneytransferapprovallevels->client_type=$request->get('client_type');
		$mobilemoneytransferapprovallevels->user_account=$request->get('user_account');
		$mobilemoneytransferapprovallevels->approval_level=$request->get('approval_level');
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','MobileMoneyTransferApprovalLevels']])->get();
		$mobilemoneytransferapprovallevelsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($mobilemoneytransferapprovallevelsdata['usersaccountsroles'][0]) && $mobilemoneytransferapprovallevelsdata['usersaccountsroles'][0]['_show']==1){
			try{
				if($mobilemoneytransferapprovallevels->save()){
					$response['status']='1';
					$response['message']='mobile money transfer approval levels Added successfully';
					return json_encode($response);
			}else{
					$response['status']='0';
					$response['message']='Failed to add mobile money transfer approval levels. Please try again';
					return json_encode($response);
				}
			}
			catch(Exception $e){
					$response['status']='0';
					$response['message']='An Error occured while attempting to add mobile money transfer approval levels. Please try again';
					return json_encode($response);
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$mobilemoneytransferapprovallevelsdata['clienttypes']=ClientTypes::all();
		$mobilemoneytransferapprovallevelsdata['usersaccounts']=UsersAccounts::all();
		$mobilemoneytransferapprovallevelsdata['approvallevels']=ApprovalLevels::all();
		$mobilemoneytransferapprovallevelsdata['data']=MobileMoneyTransferApprovalLevels::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','MobileMoneyTransferApprovalLevels']])->get();
		$mobilemoneytransferapprovallevelsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($mobilemoneytransferapprovallevelsdata['usersaccountsroles'][0]) && $mobilemoneytransferapprovallevelsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('mobilemoneytransferapprovallevelsdata'));
		}else{
		return view('admin.mobile_money_transfer_approval_levels.edit',compact('mobilemoneytransferapprovallevelsdata','id'));
		}
	}

	public function show($id){
		$mobilemoneytransferapprovallevelsdata['clienttypes']=ClientTypes::all();
		$mobilemoneytransferapprovallevelsdata['usersaccounts']=UsersAccounts::all();
		$mobilemoneytransferapprovallevelsdata['approvallevels']=ApprovalLevels::all();
		$mobilemoneytransferapprovallevelsdata['data']=MobileMoneyTransferApprovalLevels::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','MobileMoneyTransferApprovalLevels']])->get();
		$mobilemoneytransferapprovallevelsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($mobilemoneytransferapprovallevelsdata['usersaccountsroles'][0]) && $mobilemoneytransferapprovallevelsdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('mobilemoneytransferapprovallevelsdata'));
		}else{
		return view('admin.mobile_money_transfer_approval_levels.show',compact('mobilemoneytransferapprovallevelsdata','id'));
		}
	}

	public function update(Request $request,$id){
		$mobilemoneytransferapprovallevels=MobileMoneyTransferApprovalLevels::find($id);
		$mobilemoneytransferapprovallevelsdata['clienttypes']=ClientTypes::all();
		$mobilemoneytransferapprovallevelsdata['usersaccounts']=UsersAccounts::all();
		$mobilemoneytransferapprovallevelsdata['approvallevels']=ApprovalLevels::all();
		$mobilemoneytransferapprovallevels->client_type=$request->get('client_type');
		$mobilemoneytransferapprovallevels->user_account=$request->get('user_account');
		$mobilemoneytransferapprovallevels->approval_level=$request->get('approval_level');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','MobileMoneyTransferApprovalLevels']])->get();
		$mobilemoneytransferapprovallevelsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($mobilemoneytransferapprovallevelsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('mobilemoneytransferapprovallevelsdata'));
		}else{
		$mobilemoneytransferapprovallevels->save();
		$mobilemoneytransferapprovallevelsdata['data']=MobileMoneyTransferApprovalLevels::find($id);
		return view('admin.mobile_money_transfer_approval_levels.edit',compact('mobilemoneytransferapprovallevelsdata','id'));
		}
	}

	public function destroy($id){
		$mobilemoneytransferapprovallevels=MobileMoneyTransferApprovalLevels::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','MobileMoneyTransferApprovalLevels']])->get();
		$mobilemoneytransferapprovallevelsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($mobilemoneytransferapprovallevelsdata['usersaccountsroles'][0]) && $mobilemoneytransferapprovallevelsdata['usersaccountsroles'][0]['_delete']==1){
			$mobilemoneytransferapprovallevels->delete();
		}return redirect('admin/mobilemoneytransferapprovallevels')->with('success','mobile money transfer approval levels has been deleted!');
	}
}