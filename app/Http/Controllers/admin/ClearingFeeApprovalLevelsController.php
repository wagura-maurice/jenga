<?php
/**
* @author  Wanjala Innocent Khaemba
*Controller - (manages clearing fee approval levels)
*/
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\ClearingFeeApprovalLevels;
use App\Companies;
use App\Modules;
use App\Users;
use App\ApprovalLevels;
use App\UsersAccounts;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;
class ClearingFeeApprovalLevelsController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$clearingfeeapprovallevelsdata['approvallevels']=ApprovalLevels::all();
		$clearingfeeapprovallevelsdata['usersaccounts']=UsersAccounts::all();
		$clearingfeeapprovallevelsdata['list']=ClearingFeeApprovalLevels::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ClearingFeeApprovalLevels']])->get();
		$clearingfeeapprovallevelsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($clearingfeeapprovallevelsdata['usersaccountsroles'][0]['_add']==0&&$clearingfeeapprovallevelsdata['usersaccountsroles'][0]['_list']==0&&$clearingfeeapprovallevelsdata['usersaccountsroles'][0]['_edit']==0&&$clearingfeeapprovallevelsdata['usersaccountsroles'][0]['_edit']==0&&$clearingfeeapprovallevelsdata['usersaccountsroles'][0]['_show']==0&&$clearingfeeapprovallevelsdata['usersaccountsroles'][0]['_delete']==0&&$clearingfeeapprovallevelsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('clearingfeeapprovallevelsdata'));
		}else{
			return view('admin.clearing_fee_approval_levels.index',compact('clearingfeeapprovallevelsdata'));
		}
	}

	public function create(){
		$clearingfeeapprovallevelsdata;
		$clearingfeeapprovallevelsdata['approvallevels']=ApprovalLevels::all();
		$clearingfeeapprovallevelsdata['usersaccounts']=UsersAccounts::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ClearingFeeApprovalLevels']])->get();
		$clearingfeeapprovallevelsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($clearingfeeapprovallevelsdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('clearingfeeapprovallevelsdata'));
		}else{
			return view('admin.clearing_fee_approval_levels.create',compact('clearingfeeapprovallevelsdata'));
		}
	}

	public function filter(Request $request){
		$clearingfeeapprovallevelsdata['approvallevels']=ApprovalLevels::all();
		$clearingfeeapprovallevelsdata['usersaccounts']=UsersAccounts::all();
		$clearingfeeapprovallevelsdata['list']=ClearingFeeApprovalLevels::where([['approval_level','LIKE','%'.$request->get('approval_level').'%'],['user_account','LIKE','%'.$request->get('user_account').'%'],])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ClearingFeeApprovalLevels']])->get();
		$clearingfeeapprovallevelsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($clearingfeeapprovallevelsdata['usersaccountsroles'][0]['_add']==0&&$clearingfeeapprovallevelsdata['usersaccountsroles'][0]['_list']==0&&$clearingfeeapprovallevelsdata['usersaccountsroles'][0]['_edit']==0&&$clearingfeeapprovallevelsdata['usersaccountsroles'][0]['_edit']==0&&$clearingfeeapprovallevelsdata['usersaccountsroles'][0]['_show']==0&&$clearingfeeapprovallevelsdata['usersaccountsroles'][0]['_delete']==0&&$clearingfeeapprovallevelsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('clearingfeeapprovallevelsdata'));
		}else{
			return view('admin.clearing_fee_approval_levels.index',compact('clearingfeeapprovallevelsdata'));
		}
	}

	public function report(){
		$clearingfeeapprovallevelsdata['company']=Companies::all();
		$clearingfeeapprovallevelsdata['list']=ClearingFeeApprovalLevels::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ClearingFeeApprovalLevels']])->get();
		$clearingfeeapprovallevelsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($clearingfeeapprovallevelsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('clearingfeeapprovallevelsdata'));
		}else{
			return view('admin.clearing_fee_approval_levels.report',compact('clearingfeeapprovallevelsdata'));
		}
	}

	public function chart(){
		return view('admin.clearing_fee_approval_levels.chart');
	}

	public function store(Request $request){
		$clearingfeeapprovallevels=new ClearingFeeApprovalLevels();
		$clearingfeeapprovallevels->approval_level=$request->get('approval_level');
		$clearingfeeapprovallevels->user_account=$request->get('user_account');
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ClearingFeeApprovalLevels']])->get();
		$clearingfeeapprovallevelsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($clearingfeeapprovallevelsdata['usersaccountsroles'][0]['_show']==1){
			try{
				if($clearingfeeapprovallevels->save()){
					$response['status']='1';
					$response['message']='clearing fee approval levels Added successfully';
					return json_encode($response);
			}else{
					$response['status']='0';
					$response['message']='Failed to add clearing fee approval levels. Please try again';
					return json_encode($response);
				}
			}
			catch(Exception $e){
					$response['status']='0';
					$response['message']='An Error occured while attempting to add clearing fee approval levels. Please try again';
					return json_encode($response);
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$clearingfeeapprovallevelsdata['approvallevels']=ApprovalLevels::all();
		$clearingfeeapprovallevelsdata['usersaccounts']=UsersAccounts::all();
		$clearingfeeapprovallevelsdata['data']=ClearingFeeApprovalLevels::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ClearingFeeApprovalLevels']])->get();
		$clearingfeeapprovallevelsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($clearingfeeapprovallevelsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('clearingfeeapprovallevelsdata'));
		}else{
		return view('admin.clearing_fee_approval_levels.edit',compact('clearingfeeapprovallevelsdata','id'));
		}
	}

	public function show($id){
		$clearingfeeapprovallevelsdata['approvallevels']=ApprovalLevels::all();
		$clearingfeeapprovallevelsdata['usersaccounts']=UsersAccounts::all();
		$clearingfeeapprovallevelsdata['data']=ClearingFeeApprovalLevels::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ClearingFeeApprovalLevels']])->get();
		$clearingfeeapprovallevelsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($clearingfeeapprovallevelsdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('clearingfeeapprovallevelsdata'));
		}else{
		return view('admin.clearing_fee_approval_levels.show',compact('clearingfeeapprovallevelsdata','id'));
		}
	}

	public function update(Request $request,$id){
		$clearingfeeapprovallevels=ClearingFeeApprovalLevels::find($id);
		$clearingfeeapprovallevelsdata['approvallevels']=ApprovalLevels::all();
		$clearingfeeapprovallevelsdata['usersaccounts']=UsersAccounts::all();
		$clearingfeeapprovallevels->approval_level=$request->get('approval_level');
		$clearingfeeapprovallevels->user_account=$request->get('user_account');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ClearingFeeApprovalLevels']])->get();
		$clearingfeeapprovallevelsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($clearingfeeapprovallevelsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('clearingfeeapprovallevelsdata'));
		}else{
		$clearingfeeapprovallevels->save();
		$clearingfeeapprovallevelsdata['data']=ClearingFeeApprovalLevels::find($id);
		return view('admin.clearing_fee_approval_levels.edit',compact('clearingfeeapprovallevelsdata','id'));
		}
	}

	public function destroy($id){
		$clearingfeeapprovallevels=ClearingFeeApprovalLevels::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ClearingFeeApprovalLevels']])->get();
		$clearingfeeapprovallevelsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($clearingfeeapprovallevelsdata['usersaccountsroles'][0]['_delete']==1){
			$clearingfeeapprovallevels->delete();
		}return redirect('admin/clearingfeeapprovallevels')->with('success','clearing fee approval levels has been deleted!');
	}
}