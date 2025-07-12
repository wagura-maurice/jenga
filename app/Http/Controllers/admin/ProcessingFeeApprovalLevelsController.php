<?php
/**
* @author  Wanjala Innocent Khaemba
*Controller - (manages processing fee approval levels)
*/
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\ProcessingFeeApprovalLevels;
use App\Companies;
use App\Modules;
use App\Users;
use App\ApprovalLevels;
use App\UsersAccounts;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;
class ProcessingFeeApprovalLevelsController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$processingfeeapprovallevelsdata['approvallevels']=ApprovalLevels::all();
		$processingfeeapprovallevelsdata['usersaccounts']=UsersAccounts::all();
		$processingfeeapprovallevelsdata['list']=ProcessingFeeApprovalLevels::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ProcessingFeeApprovalLevels']])->get();
		$processingfeeapprovallevelsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($processingfeeapprovallevelsdata['usersaccountsroles'][0]['_add']==0&&$processingfeeapprovallevelsdata['usersaccountsroles'][0]['_list']==0&&$processingfeeapprovallevelsdata['usersaccountsroles'][0]['_edit']==0&&$processingfeeapprovallevelsdata['usersaccountsroles'][0]['_edit']==0&&$processingfeeapprovallevelsdata['usersaccountsroles'][0]['_show']==0&&$processingfeeapprovallevelsdata['usersaccountsroles'][0]['_delete']==0&&$processingfeeapprovallevelsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('processingfeeapprovallevelsdata'));
		}else{
			return view('admin.processing_fee_approval_levels.index',compact('processingfeeapprovallevelsdata'));
		}
	}

	public function create(){
		$processingfeeapprovallevelsdata;
		$processingfeeapprovallevelsdata['approvallevels']=ApprovalLevels::all();
		$processingfeeapprovallevelsdata['usersaccounts']=UsersAccounts::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ProcessingFeeApprovalLevels']])->get();
		$processingfeeapprovallevelsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($processingfeeapprovallevelsdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('processingfeeapprovallevelsdata'));
		}else{
			return view('admin.processing_fee_approval_levels.create',compact('processingfeeapprovallevelsdata'));
		}
	}

	public function filter(Request $request){
		$processingfeeapprovallevelsdata['approvallevels']=ApprovalLevels::all();
		$processingfeeapprovallevelsdata['usersaccounts']=UsersAccounts::all();
		$processingfeeapprovallevelsdata['list']=ProcessingFeeApprovalLevels::where([['approval_level','LIKE','%'.$request->get('approval_level').'%'],['user_account','LIKE','%'.$request->get('user_account').'%'],])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ProcessingFeeApprovalLevels']])->get();
		$processingfeeapprovallevelsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($processingfeeapprovallevelsdata['usersaccountsroles'][0]['_add']==0&&$processingfeeapprovallevelsdata['usersaccountsroles'][0]['_list']==0&&$processingfeeapprovallevelsdata['usersaccountsroles'][0]['_edit']==0&&$processingfeeapprovallevelsdata['usersaccountsroles'][0]['_edit']==0&&$processingfeeapprovallevelsdata['usersaccountsroles'][0]['_show']==0&&$processingfeeapprovallevelsdata['usersaccountsroles'][0]['_delete']==0&&$processingfeeapprovallevelsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('processingfeeapprovallevelsdata'));
		}else{
			return view('admin.processing_fee_approval_levels.index',compact('processingfeeapprovallevelsdata'));
		}
	}

	public function report(){
		$processingfeeapprovallevelsdata['company']=Companies::all();
		$processingfeeapprovallevelsdata['list']=ProcessingFeeApprovalLevels::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ProcessingFeeApprovalLevels']])->get();
		$processingfeeapprovallevelsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($processingfeeapprovallevelsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('processingfeeapprovallevelsdata'));
		}else{
			return view('admin.processing_fee_approval_levels.report',compact('processingfeeapprovallevelsdata'));
		}
	}

	public function chart(){
		return view('admin.processing_fee_approval_levels.chart');
	}

	public function store(Request $request){
		$processingfeeapprovallevels=new ProcessingFeeApprovalLevels();
		$processingfeeapprovallevels->approval_level=$request->get('approval_level');
		$processingfeeapprovallevels->user_account=$request->get('user_account');
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ProcessingFeeApprovalLevels']])->get();
		$processingfeeapprovallevelsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($processingfeeapprovallevelsdata['usersaccountsroles'][0]['_show']==1){
			try{
				if($processingfeeapprovallevels->save()){
					$response['status']='1';
					$response['message']='processing fee approval levels Added successfully';
					return json_encode($response);
			}else{
					$response['status']='0';
					$response['message']='Failed to add processing fee approval levels. Please try again';
					return json_encode($response);
				}
			}
			catch(Exception $e){
					$response['status']='0';
					$response['message']='An Error occured while attempting to add processing fee approval levels. Please try again';
					return json_encode($response);
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$processingfeeapprovallevelsdata['approvallevels']=ApprovalLevels::all();
		$processingfeeapprovallevelsdata['usersaccounts']=UsersAccounts::all();
		$processingfeeapprovallevelsdata['data']=ProcessingFeeApprovalLevels::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ProcessingFeeApprovalLevels']])->get();
		$processingfeeapprovallevelsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($processingfeeapprovallevelsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('processingfeeapprovallevelsdata'));
		}else{
		return view('admin.processing_fee_approval_levels.edit',compact('processingfeeapprovallevelsdata','id'));
		}
	}

	public function show($id){
		$processingfeeapprovallevelsdata['approvallevels']=ApprovalLevels::all();
		$processingfeeapprovallevelsdata['usersaccounts']=UsersAccounts::all();
		$processingfeeapprovallevelsdata['data']=ProcessingFeeApprovalLevels::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ProcessingFeeApprovalLevels']])->get();
		$processingfeeapprovallevelsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($processingfeeapprovallevelsdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('processingfeeapprovallevelsdata'));
		}else{
		return view('admin.processing_fee_approval_levels.show',compact('processingfeeapprovallevelsdata','id'));
		}
	}

	public function update(Request $request,$id){
		$processingfeeapprovallevels=ProcessingFeeApprovalLevels::find($id);
		$processingfeeapprovallevelsdata['approvallevels']=ApprovalLevels::all();
		$processingfeeapprovallevelsdata['usersaccounts']=UsersAccounts::all();
		$processingfeeapprovallevels->approval_level=$request->get('approval_level');
		$processingfeeapprovallevels->user_account=$request->get('user_account');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ProcessingFeeApprovalLevels']])->get();
		$processingfeeapprovallevelsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($processingfeeapprovallevelsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('processingfeeapprovallevelsdata'));
		}else{
		$processingfeeapprovallevels->save();
		$processingfeeapprovallevelsdata['data']=ProcessingFeeApprovalLevels::find($id);
		return view('admin.processing_fee_approval_levels.edit',compact('processingfeeapprovallevelsdata','id'));
		}
	}

	public function destroy($id){
		$processingfeeapprovallevels=ProcessingFeeApprovalLevels::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ProcessingFeeApprovalLevels']])->get();
		$processingfeeapprovallevelsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($processingfeeapprovallevelsdata['usersaccountsroles'][0]['_delete']==1){
			$processingfeeapprovallevels->delete();
		}return redirect('admin/processingfeeapprovallevels')->with('success','processing fee approval levels has been deleted!');
	}
}