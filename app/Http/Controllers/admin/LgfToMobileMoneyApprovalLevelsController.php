<?php
/**
* @author  Wanjala Innocent Khaemba
*Controller - (lgf to mobile money approval levels)
*/
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\LgfToMobileMoneyApprovalLevels;
use App\Companies;
use App\Modules;
use App\Users;
use App\ClientTypes;
use App\ApprovalLevels;
use App\UsersAccounts;
use App\ApprovalStatuses;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;
class LgfToMobileMoneyApprovalLevelsController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$lgftomobilemoneyapprovallevelsdata['clienttypes']=ClientTypes::all();
		$lgftomobilemoneyapprovallevelsdata['approvallevels']=ApprovalLevels::all();
		$lgftomobilemoneyapprovallevelsdata['usersaccounts']=UsersAccounts::all();
		$lgftomobilemoneyapprovallevelsdata['users']=Users::all();
		$lgftomobilemoneyapprovallevelsdata['approvalstatuses']=ApprovalStatuses::all();
		$lgftomobilemoneyapprovallevelsdata['list']=LgfToMobileMoneyApprovalLevels::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LgfToMobileMoneyApprovalLevels']])->get();
		$lgftomobilemoneyapprovallevelsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($lgftomobilemoneyapprovallevelsdata['usersaccountsroles'][0]) && $lgftomobilemoneyapprovallevelsdata['usersaccountsroles'][0]['_add']==0&&$lgftomobilemoneyapprovallevelsdata['usersaccountsroles'][0]['_list']==0&&$lgftomobilemoneyapprovallevelsdata['usersaccountsroles'][0]['_edit']==0&&$lgftomobilemoneyapprovallevelsdata['usersaccountsroles'][0]['_edit']==0&&$lgftomobilemoneyapprovallevelsdata['usersaccountsroles'][0]['_show']==0&&$lgftomobilemoneyapprovallevelsdata['usersaccountsroles'][0]['_delete']==0&&$lgftomobilemoneyapprovallevelsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('lgftomobilemoneyapprovallevelsdata'));
		}else{
			return view('admin.lgf_to_mobile_money_approval_levels.index',compact('lgftomobilemoneyapprovallevelsdata'));
		}
	}

	public function create(){
		$lgftomobilemoneyapprovallevelsdata;
		$lgftomobilemoneyapprovallevelsdata['clienttypes']=ClientTypes::all();
		$lgftomobilemoneyapprovallevelsdata['approvallevels']=ApprovalLevels::all();
		$lgftomobilemoneyapprovallevelsdata['usersaccounts']=UsersAccounts::all();
		$lgftomobilemoneyapprovallevelsdata['users']=Users::all();
		$lgftomobilemoneyapprovallevelsdata['approvalstatuses']=ApprovalStatuses::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LgfToMobileMoneyApprovalLevels']])->get();
		$lgftomobilemoneyapprovallevelsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($lgftomobilemoneyapprovallevelsdata['usersaccountsroles'][0]) && $lgftomobilemoneyapprovallevelsdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('lgftomobilemoneyapprovallevelsdata'));
		}else{
			return view('admin.lgf_to_mobile_money_approval_levels.create',compact('lgftomobilemoneyapprovallevelsdata'));
		}
	}

	public function filter(Request $request){
		$lgftomobilemoneyapprovallevelsdata['clienttypes']=ClientTypes::all();
		$lgftomobilemoneyapprovallevelsdata['approvallevels']=ApprovalLevels::all();
		$lgftomobilemoneyapprovallevelsdata['usersaccounts']=UsersAccounts::all();
		$lgftomobilemoneyapprovallevelsdata['users']=Users::all();
		$lgftomobilemoneyapprovallevelsdata['approvalstatuses']=ApprovalStatuses::all();
		$lgftomobilemoneyapprovallevelsdata['list']=LgfToMobileMoneyApprovalLevels::where([['client_type','LIKE','%'.$request->get('client_type').'%'],['approval_level','LIKE','%'.$request->get('approval_level').'%'],['user_account','LIKE','%'.$request->get('user_account').'%'],['approved_by','LIKE','%'.$request->get('approved_by').'%'],['approval_status','LIKE','%'.$request->get('approval_status').'%'],['remarks','LIKE','%'.$request->get('remarks').'%'],])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LgfToMobileMoneyApprovalLevels']])->get();
		$lgftomobilemoneyapprovallevelsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($lgftomobilemoneyapprovallevelsdata['usersaccountsroles'][0]) && $lgftomobilemoneyapprovallevelsdata['usersaccountsroles'][0]['_add']==0&&$lgftomobilemoneyapprovallevelsdata['usersaccountsroles'][0]['_list']==0&&$lgftomobilemoneyapprovallevelsdata['usersaccountsroles'][0]['_edit']==0&&$lgftomobilemoneyapprovallevelsdata['usersaccountsroles'][0]['_edit']==0&&$lgftomobilemoneyapprovallevelsdata['usersaccountsroles'][0]['_show']==0&&$lgftomobilemoneyapprovallevelsdata['usersaccountsroles'][0]['_delete']==0&&$lgftomobilemoneyapprovallevelsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('lgftomobilemoneyapprovallevelsdata'));
		}else{
			return view('admin.lgf_to_mobile_money_approval_levels.index',compact('lgftomobilemoneyapprovallevelsdata'));
		}
	}

	public function report(){
		$lgftomobilemoneyapprovallevelsdata['company']=Companies::all();
		$lgftomobilemoneyapprovallevelsdata['list']=LgfToMobileMoneyApprovalLevels::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LgfToMobileMoneyApprovalLevels']])->get();
		$lgftomobilemoneyapprovallevelsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($lgftomobilemoneyapprovallevelsdata['usersaccountsroles'][0]) && $lgftomobilemoneyapprovallevelsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('lgftomobilemoneyapprovallevelsdata'));
		}else{
			return view('admin.lgf_to_mobile_money_approval_levels.report',compact('lgftomobilemoneyapprovallevelsdata'));
		}
	}

	public function chart(){
		return view('admin.lgf_to_mobile_money_approval_levels.chart');
	}

	public function store(Request $request){
		$lgftomobilemoneyapprovallevels=new LgfToMobileMoneyApprovalLevels();
		$lgftomobilemoneyapprovallevels->client_type=$request->get('client_type');
		$lgftomobilemoneyapprovallevels->approval_level=$request->get('approval_level');
		$lgftomobilemoneyapprovallevels->user_account=$request->get('user_account');
		$lgftomobilemoneyapprovallevels->approved_by=$request->get('approved_by');
		$lgftomobilemoneyapprovallevels->approval_status=$request->get('approval_status');
		$lgftomobilemoneyapprovallevels->remarks=$request->get('remarks');
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LgfToMobileMoneyApprovalLevels']])->get();
		$lgftomobilemoneyapprovallevelsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($lgftomobilemoneyapprovallevelsdata['usersaccountsroles'][0]) && $lgftomobilemoneyapprovallevelsdata['usersaccountsroles'][0]['_show']==1){
			try{
				if($lgftomobilemoneyapprovallevels->save()){
					$response['status']='1';
					$response['message']='lgf to mobile money approval levels Added successfully';
					return json_encode($response);
			}else{
					$response['status']='0';
					$response['message']='Failed to add lgf to mobile money approval levels. Please try again';
					return json_encode($response);
				}
			}
			catch(Exception $e){
					$response['status']='0';
					$response['message']='An Error occured while attempting to add lgf to mobile money approval levels. Please try again';
					return json_encode($response);
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$lgftomobilemoneyapprovallevelsdata['clienttypes']=ClientTypes::all();
		$lgftomobilemoneyapprovallevelsdata['approvallevels']=ApprovalLevels::all();
		$lgftomobilemoneyapprovallevelsdata['usersaccounts']=UsersAccounts::all();
		$lgftomobilemoneyapprovallevelsdata['users']=Users::all();
		$lgftomobilemoneyapprovallevelsdata['approvalstatuses']=ApprovalStatuses::all();
		$lgftomobilemoneyapprovallevelsdata['data']=LgfToMobileMoneyApprovalLevels::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LgfToMobileMoneyApprovalLevels']])->get();
		$lgftomobilemoneyapprovallevelsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($lgftomobilemoneyapprovallevelsdata['usersaccountsroles'][0]) && $lgftomobilemoneyapprovallevelsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('lgftomobilemoneyapprovallevelsdata'));
		}else{
		return view('admin.lgf_to_mobile_money_approval_levels.edit',compact('lgftomobilemoneyapprovallevelsdata','id'));
		}
	}

	public function show($id){
		$lgftomobilemoneyapprovallevelsdata['clienttypes']=ClientTypes::all();
		$lgftomobilemoneyapprovallevelsdata['approvallevels']=ApprovalLevels::all();
		$lgftomobilemoneyapprovallevelsdata['usersaccounts']=UsersAccounts::all();
		$lgftomobilemoneyapprovallevelsdata['users']=Users::all();
		$lgftomobilemoneyapprovallevelsdata['approvalstatuses']=ApprovalStatuses::all();
		$lgftomobilemoneyapprovallevelsdata['data']=LgfToMobileMoneyApprovalLevels::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LgfToMobileMoneyApprovalLevels']])->get();
		$lgftomobilemoneyapprovallevelsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($lgftomobilemoneyapprovallevelsdata['usersaccountsroles'][0]) && $lgftomobilemoneyapprovallevelsdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('lgftomobilemoneyapprovallevelsdata'));
		}else{
		return view('admin.lgf_to_mobile_money_approval_levels.show',compact('lgftomobilemoneyapprovallevelsdata','id'));
		}
	}

	public function update(Request $request,$id){
		$lgftomobilemoneyapprovallevels=LgfToMobileMoneyApprovalLevels::find($id);
		$lgftomobilemoneyapprovallevelsdata['clienttypes']=ClientTypes::all();
		$lgftomobilemoneyapprovallevelsdata['approvallevels']=ApprovalLevels::all();
		$lgftomobilemoneyapprovallevelsdata['usersaccounts']=UsersAccounts::all();
		$lgftomobilemoneyapprovallevelsdata['users']=Users::all();
		$lgftomobilemoneyapprovallevelsdata['approvalstatuses']=ApprovalStatuses::all();
		$lgftomobilemoneyapprovallevels->client_type=$request->get('client_type');
		$lgftomobilemoneyapprovallevels->approval_level=$request->get('approval_level');
		$lgftomobilemoneyapprovallevels->user_account=$request->get('user_account');
		$lgftomobilemoneyapprovallevels->approved_by=$request->get('approved_by');
		$lgftomobilemoneyapprovallevels->approval_status=$request->get('approval_status');
		$lgftomobilemoneyapprovallevels->remarks=$request->get('remarks');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LgfToMobileMoneyApprovalLevels']])->get();
		$lgftomobilemoneyapprovallevelsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($lgftomobilemoneyapprovallevelsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('lgftomobilemoneyapprovallevelsdata'));
		}else{
		$lgftomobilemoneyapprovallevels->save();
		$lgftomobilemoneyapprovallevelsdata['data']=LgfToMobileMoneyApprovalLevels::find($id);
		return view('admin.lgf_to_mobile_money_approval_levels.edit',compact('lgftomobilemoneyapprovallevelsdata','id'));
		}
	}

	public function destroy($id){
		$lgftomobilemoneyapprovallevels=LgfToMobileMoneyApprovalLevels::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LgfToMobileMoneyApprovalLevels']])->get();
		$lgftomobilemoneyapprovallevelsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($lgftomobilemoneyapprovallevelsdata['usersaccountsroles'][0]) && $lgftomobilemoneyapprovallevelsdata['usersaccountsroles'][0]['_delete']==1){
			$lgftomobilemoneyapprovallevels->delete();
		}return redirect('admin/lgftomobilemoneyapprovallevels')->with('success','lgf to mobile money approval levels has been deleted!');
	}
}