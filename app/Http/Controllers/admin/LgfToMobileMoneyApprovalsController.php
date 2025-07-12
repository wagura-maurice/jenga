<?php
/**
* @author  Wanjala Innocent Khaemba
*Controller - (lgf to mobile money approvals)
*/
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\LgfToMobileMoneyApprovals;
use App\Companies;
use App\Modules;
use App\Users;
use App\LgfToMobileMoneyTransfers;
use App\ApprovalLevels;
use App\ApprovalStatuses;
use App\UsersAccounts;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;
class LgfToMobileMoneyApprovalsController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$lgftomobilemoneyapprovalsdata['lgftomobilemoneytransfers']=LgfToMobileMoneyTransfers::all();
		$lgftomobilemoneyapprovalsdata['approvallevels']=ApprovalLevels::all();
		$lgftomobilemoneyapprovalsdata['approvalstatuses']=ApprovalStatuses::all();
		$lgftomobilemoneyapprovalsdata['users']=Users::all();
		$lgftomobilemoneyapprovalsdata['usersaccounts']=UsersAccounts::all();
		$lgftomobilemoneyapprovalsdata['list']=LgfToMobileMoneyApprovals::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LgfToMobileMoneyApprovals']])->get();
		$lgftomobilemoneyapprovalsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($lgftomobilemoneyapprovalsdata['usersaccountsroles'][0]) && $lgftomobilemoneyapprovalsdata['usersaccountsroles'][0]['_add']==0&&$lgftomobilemoneyapprovalsdata['usersaccountsroles'][0]['_list']==0&&$lgftomobilemoneyapprovalsdata['usersaccountsroles'][0]['_edit']==0&&$lgftomobilemoneyapprovalsdata['usersaccountsroles'][0]['_edit']==0&&$lgftomobilemoneyapprovalsdata['usersaccountsroles'][0]['_show']==0&&$lgftomobilemoneyapprovalsdata['usersaccountsroles'][0]['_delete']==0&&$lgftomobilemoneyapprovalsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('lgftomobilemoneyapprovalsdata'));
		}else{
			return view('admin.lgf_to_mobile_money_approvals.index',compact('lgftomobilemoneyapprovalsdata'));
		}
	}

	public function create(){
		$lgftomobilemoneyapprovalsdata;
		$lgftomobilemoneyapprovalsdata['lgftomobilemoneytransfers']=LgfToMobileMoneyTransfers::all();
		$lgftomobilemoneyapprovalsdata['approvallevels']=ApprovalLevels::all();
		$lgftomobilemoneyapprovalsdata['approvalstatuses']=ApprovalStatuses::all();
		$lgftomobilemoneyapprovalsdata['users']=Users::all();
		$lgftomobilemoneyapprovalsdata['usersaccounts']=UsersAccounts::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LgfToMobileMoneyApprovals']])->get();
		$lgftomobilemoneyapprovalsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($lgftomobilemoneyapprovalsdata['usersaccountsroles'][0]) && $lgftomobilemoneyapprovalsdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('lgftomobilemoneyapprovalsdata'));
		}else{
			return view('admin.lgf_to_mobile_money_approvals.create',compact('lgftomobilemoneyapprovalsdata'));
		}
	}

	public function filter(Request $request){
		$lgftomobilemoneyapprovalsdata['lgftomobilemoneytransfers']=LgfToMobileMoneyTransfers::all();
		$lgftomobilemoneyapprovalsdata['approvallevels']=ApprovalLevels::all();
		$lgftomobilemoneyapprovalsdata['approvalstatuses']=ApprovalStatuses::all();
		$lgftomobilemoneyapprovalsdata['users']=Users::all();
		$lgftomobilemoneyapprovalsdata['usersaccounts']=UsersAccounts::all();
		$lgftomobilemoneyapprovalsdata['list']=LgfToMobileMoneyApprovals::where([['mobile_money_transfer','LIKE','%'.$request->get('mobile_money_transfer').'%'],['approval_level','LIKE','%'.$request->get('approval_level').'%'],['approval_status','LIKE','%'.$request->get('approval_status').'%'],['approved_by','LIKE','%'.$request->get('approved_by').'%'],['user_account','LIKE','%'.$request->get('user_account').'%'],['remarks','LIKE','%'.$request->get('remarks').'%'],])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LgfToMobileMoneyApprovals']])->get();
		$lgftomobilemoneyapprovalsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($lgftomobilemoneyapprovalsdata['usersaccountsroles'][0]) && $lgftomobilemoneyapprovalsdata['usersaccountsroles'][0]['_add']==0&&$lgftomobilemoneyapprovalsdata['usersaccountsroles'][0]['_list']==0&&$lgftomobilemoneyapprovalsdata['usersaccountsroles'][0]['_edit']==0&&$lgftomobilemoneyapprovalsdata['usersaccountsroles'][0]['_edit']==0&&$lgftomobilemoneyapprovalsdata['usersaccountsroles'][0]['_show']==0&&$lgftomobilemoneyapprovalsdata['usersaccountsroles'][0]['_delete']==0&&$lgftomobilemoneyapprovalsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('lgftomobilemoneyapprovalsdata'));
		}else{
			return view('admin.lgf_to_mobile_money_approvals.index',compact('lgftomobilemoneyapprovalsdata'));
		}
	}

	public function report(){
		$lgftomobilemoneyapprovalsdata['company']=Companies::all();
		$lgftomobilemoneyapprovalsdata['list']=LgfToMobileMoneyApprovals::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LgfToMobileMoneyApprovals']])->get();
		$lgftomobilemoneyapprovalsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($lgftomobilemoneyapprovalsdata['usersaccountsroles'][0]) && $lgftomobilemoneyapprovalsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('lgftomobilemoneyapprovalsdata'));
		}else{
			return view('admin.lgf_to_mobile_money_approvals.report',compact('lgftomobilemoneyapprovalsdata'));
		}
	}

	public function chart(){
		return view('admin.lgf_to_mobile_money_approvals.chart');
	}

	public function store(Request $request){
		$lgftomobilemoneyapprovals=new LgfToMobileMoneyApprovals();
		$lgftomobilemoneyapprovals->mobile_money_transfer=$request->get('mobile_money_transfer');
		$lgftomobilemoneyapprovals->approval_level=$request->get('approval_level');
		$lgftomobilemoneyapprovals->approval_status=$request->get('approval_status');
		$lgftomobilemoneyapprovals->approved_by=$request->get('approved_by');
		$lgftomobilemoneyapprovals->user_account=$request->get('user_account');
		$lgftomobilemoneyapprovals->remarks=$request->get('remarks');
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LgfToMobileMoneyApprovals']])->get();
		$lgftomobilemoneyapprovalsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($lgftomobilemoneyapprovalsdata['usersaccountsroles'][0]) && $lgftomobilemoneyapprovalsdata['usersaccountsroles'][0]['_show']==1){
			try{
				if($lgftomobilemoneyapprovals->save()){
					$response['status']='1';
					$response['message']='lgf to mobile money approvals Added successfully';
					return json_encode($response);
			}else{
					$response['status']='0';
					$response['message']='Failed to add lgf to mobile money approvals. Please try again';
					return json_encode($response);
				}
			}
			catch(Exception $e){
					$response['status']='0';
					$response['message']='An Error occured while attempting to add lgf to mobile money approvals. Please try again';
					return json_encode($response);
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$lgftomobilemoneyapprovalsdata['lgftomobilemoneytransfers']=LgfToMobileMoneyTransfers::all();
		$lgftomobilemoneyapprovalsdata['approvallevels']=ApprovalLevels::all();
		$lgftomobilemoneyapprovalsdata['approvalstatuses']=ApprovalStatuses::all();
		$lgftomobilemoneyapprovalsdata['users']=Users::all();
		$lgftomobilemoneyapprovalsdata['usersaccounts']=UsersAccounts::all();
		$lgftomobilemoneyapprovalsdata['data']=LgfToMobileMoneyApprovals::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LgfToMobileMoneyApprovals']])->get();
		$lgftomobilemoneyapprovalsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($lgftomobilemoneyapprovalsdata['usersaccountsroles'][0]) && $lgftomobilemoneyapprovalsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('lgftomobilemoneyapprovalsdata'));
		}else{
		return view('admin.lgf_to_mobile_money_approvals.edit',compact('lgftomobilemoneyapprovalsdata','id'));
		}
	}

	public function show($id){
		$lgftomobilemoneyapprovalsdata['lgftomobilemoneytransfers']=LgfToMobileMoneyTransfers::all();
		$lgftomobilemoneyapprovalsdata['approvallevels']=ApprovalLevels::all();
		$lgftomobilemoneyapprovalsdata['approvalstatuses']=ApprovalStatuses::all();
		$lgftomobilemoneyapprovalsdata['users']=Users::all();
		$lgftomobilemoneyapprovalsdata['usersaccounts']=UsersAccounts::all();
		$lgftomobilemoneyapprovalsdata['data']=LgfToMobileMoneyApprovals::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LgfToMobileMoneyApprovals']])->get();
		$lgftomobilemoneyapprovalsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($lgftomobilemoneyapprovalsdata['usersaccountsroles'][0]) && $lgftomobilemoneyapprovalsdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('lgftomobilemoneyapprovalsdata'));
		}else{
		return view('admin.lgf_to_mobile_money_approvals.show',compact('lgftomobilemoneyapprovalsdata','id'));
		}
	}

	public function update(Request $request,$id){
		$lgftomobilemoneyapprovals=LgfToMobileMoneyApprovals::find($id);
		$lgftomobilemoneyapprovalsdata['lgftomobilemoneytransfers']=LgfToMobileMoneyTransfers::all();
		$lgftomobilemoneyapprovalsdata['approvallevels']=ApprovalLevels::all();
		$lgftomobilemoneyapprovalsdata['approvalstatuses']=ApprovalStatuses::all();
		$lgftomobilemoneyapprovalsdata['users']=Users::all();
		$lgftomobilemoneyapprovalsdata['usersaccounts']=UsersAccounts::all();
		$lgftomobilemoneyapprovals->mobile_money_transfer=$request->get('mobile_money_transfer');
		$lgftomobilemoneyapprovals->approval_level=$request->get('approval_level');
		$lgftomobilemoneyapprovals->approval_status=$request->get('approval_status');
		$lgftomobilemoneyapprovals->approved_by=$request->get('approved_by');
		$lgftomobilemoneyapprovals->user_account=$request->get('user_account');
		$lgftomobilemoneyapprovals->remarks=$request->get('remarks');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LgfToMobileMoneyApprovals']])->get();
		$lgftomobilemoneyapprovalsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($lgftomobilemoneyapprovalsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('lgftomobilemoneyapprovalsdata'));
		}else{
		$lgftomobilemoneyapprovals->save();
		$lgftomobilemoneyapprovalsdata['data']=LgfToMobileMoneyApprovals::find($id);
		return view('admin.lgf_to_mobile_money_approvals.edit',compact('lgftomobilemoneyapprovalsdata','id'));
		}
	}

	public function destroy($id){
		$lgftomobilemoneyapprovals=LgfToMobileMoneyApprovals::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LgfToMobileMoneyApprovals']])->get();
		$lgftomobilemoneyapprovalsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($lgftomobilemoneyapprovalsdata['usersaccountsroles'][0]) && $lgftomobilemoneyapprovalsdata['usersaccountsroles'][0]['_delete']==1){
			$lgftomobilemoneyapprovals->delete();
		}return redirect('admin/lgftomobilemoneyapprovals')->with('success','lgf to mobile money approvals has been deleted!');
	}
}