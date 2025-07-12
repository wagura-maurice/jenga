<?php
/**
* @author  Wanjala Innocent Khaemba
*Controller - (manages insurance deduction fee approvals data)
*/
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\InsuranceDeductionApprovalLevels;
use App\Companies;
use App\Modules;
use App\Users;
use App\ApprovalLevels;
use App\UsersAccounts;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;
class InsuranceDeductionApprovalLevelsController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$insurancedeductionapprovallevelsdata['approvallevels']=ApprovalLevels::all();
		$insurancedeductionapprovallevelsdata['usersaccounts']=UsersAccounts::all();
		$insurancedeductionapprovallevelsdata['list']=InsuranceDeductionApprovalLevels::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','InsuranceDeductionApprovalLevels']])->get();
		$insurancedeductionapprovallevelsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($insurancedeductionapprovallevelsdata['usersaccountsroles'][0]['_add']==0&&$insurancedeductionapprovallevelsdata['usersaccountsroles'][0]['_list']==0&&$insurancedeductionapprovallevelsdata['usersaccountsroles'][0]['_edit']==0&&$insurancedeductionapprovallevelsdata['usersaccountsroles'][0]['_edit']==0&&$insurancedeductionapprovallevelsdata['usersaccountsroles'][0]['_show']==0&&$insurancedeductionapprovallevelsdata['usersaccountsroles'][0]['_delete']==0&&$insurancedeductionapprovallevelsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('insurancedeductionapprovallevelsdata'));
		}else{
			return view('admin.insurance_deduction_approval_levels.index',compact('insurancedeductionapprovallevelsdata'));
		}
	}

	public function create(){
		$insurancedeductionapprovallevelsdata;
		$insurancedeductionapprovallevelsdata['approvallevels']=ApprovalLevels::all();
		$insurancedeductionapprovallevelsdata['usersaccounts']=UsersAccounts::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','InsuranceDeductionApprovalLevels']])->get();
		$insurancedeductionapprovallevelsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($insurancedeductionapprovallevelsdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('insurancedeductionapprovallevelsdata'));
		}else{
			return view('admin.insurance_deduction_approval_levels.create',compact('insurancedeductionapprovallevelsdata'));
		}
	}

	public function filter(Request $request){
		$insurancedeductionapprovallevelsdata['approvallevels']=ApprovalLevels::all();
		$insurancedeductionapprovallevelsdata['usersaccounts']=UsersAccounts::all();
		$insurancedeductionapprovallevelsdata['list']=InsuranceDeductionApprovalLevels::where([['approval_level','LIKE','%'.$request->get('approval_level').'%'],['user_account','LIKE','%'.$request->get('user_account').'%'],])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','InsuranceDeductionApprovalLevels']])->get();
		$insurancedeductionapprovallevelsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($insurancedeductionapprovallevelsdata['usersaccountsroles'][0]['_add']==0&&$insurancedeductionapprovallevelsdata['usersaccountsroles'][0]['_list']==0&&$insurancedeductionapprovallevelsdata['usersaccountsroles'][0]['_edit']==0&&$insurancedeductionapprovallevelsdata['usersaccountsroles'][0]['_edit']==0&&$insurancedeductionapprovallevelsdata['usersaccountsroles'][0]['_show']==0&&$insurancedeductionapprovallevelsdata['usersaccountsroles'][0]['_delete']==0&&$insurancedeductionapprovallevelsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('insurancedeductionapprovallevelsdata'));
		}else{
			return view('admin.insurance_deduction_approval_levels.index',compact('insurancedeductionapprovallevelsdata'));
		}
	}

	public function report(){
		$insurancedeductionapprovallevelsdata['company']=Companies::all();
		$insurancedeductionapprovallevelsdata['list']=InsuranceDeductionApprovalLevels::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','InsuranceDeductionApprovalLevels']])->get();
		$insurancedeductionapprovallevelsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($insurancedeductionapprovallevelsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('insurancedeductionapprovallevelsdata'));
		}else{
			return view('admin.insurance_deduction_approval_levels.report',compact('insurancedeductionapprovallevelsdata'));
		}
	}

	public function chart(){
		return view('admin.insurance_deduction_approval_levels.chart');
	}

	public function store(Request $request){
		$insurancedeductionapprovallevels=new InsuranceDeductionApprovalLevels();
		$insurancedeductionapprovallevels->approval_level=$request->get('approval_level');
		$insurancedeductionapprovallevels->user_account=$request->get('user_account');
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','InsuranceDeductionApprovalLevels']])->get();
		$insurancedeductionapprovallevelsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($insurancedeductionapprovallevelsdata['usersaccountsroles'][0]['_show']==1){
			try{
				if($insurancedeductionapprovallevels->save()){
					$response['status']='1';
					$response['message']='insurance deduction approval Levels Added successfully';
					return json_encode($response);
			}else{
					$response['status']='0';
					$response['message']='Failed to add insurance deduction approval Levels. Please try again';
					return json_encode($response);
				}
			}
			catch(Exception $e){
					$response['status']='0';
					$response['message']='An Error occured while attempting to add insurance deduction approval Levels. Please try again';
					return json_encode($response);
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$insurancedeductionapprovallevelsdata['approvallevels']=ApprovalLevels::all();
		$insurancedeductionapprovallevelsdata['usersaccounts']=UsersAccounts::all();
		$insurancedeductionapprovallevelsdata['data']=InsuranceDeductionApprovalLevels::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','InsuranceDeductionApprovalLevels']])->get();
		$insurancedeductionapprovallevelsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($insurancedeductionapprovallevelsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('insurancedeductionapprovallevelsdata'));
		}else{
		return view('admin.insurance_deduction_approval_levels.edit',compact('insurancedeductionapprovallevelsdata','id'));
		}
	}

	public function show($id){
		$insurancedeductionapprovallevelsdata['approvallevels']=ApprovalLevels::all();
		$insurancedeductionapprovallevelsdata['usersaccounts']=UsersAccounts::all();
		$insurancedeductionapprovallevelsdata['data']=InsuranceDeductionApprovalLevels::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','InsuranceDeductionApprovalLevels']])->get();
		$insurancedeductionapprovallevelsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($insurancedeductionapprovallevelsdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('insurancedeductionapprovallevelsdata'));
		}else{
		return view('admin.insurance_deduction_approval_levels.show',compact('insurancedeductionapprovallevelsdata','id'));
		}
	}

	public function update(Request $request,$id){
		$insurancedeductionapprovallevels=InsuranceDeductionApprovalLevels::find($id);
		$insurancedeductionapprovallevelsdata['approvallevels']=ApprovalLevels::all();
		$insurancedeductionapprovallevelsdata['usersaccounts']=UsersAccounts::all();
		$insurancedeductionapprovallevels->approval_level=$request->get('approval_level');
		$insurancedeductionapprovallevels->user_account=$request->get('user_account');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','InsuranceDeductionApprovalLevels']])->get();
		$insurancedeductionapprovallevelsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($insurancedeductionapprovallevelsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('insurancedeductionapprovallevelsdata'));
		}else{
		$insurancedeductionapprovallevels->save();
		$insurancedeductionapprovallevelsdata['data']=InsuranceDeductionApprovalLevels::find($id);
		return view('admin.insurance_deduction_approval_levels.edit',compact('insurancedeductionapprovallevelsdata','id'));
		}
	}

	public function destroy($id){
		$insurancedeductionapprovallevels=InsuranceDeductionApprovalLevels::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','InsuranceDeductionApprovalLevels']])->get();
		$insurancedeductionapprovallevelsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($insurancedeductionapprovallevelsdata['usersaccountsroles'][0]['_delete']==1){
			$insurancedeductionapprovallevels->delete();
		}return redirect('admin/insurancedeductionapprovallevels')->with('success','insurance deduction approval Levels has been deleted!');
	}
}