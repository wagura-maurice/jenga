<?php
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\LoanApprovals;
use App\Companies;
use App\Modules;
use App\Users;
use App\Loans;
use App\ApprovalLevels;
use App\UsersAccounts;
use App\ApprovalStatuses;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;
class LoanApprovalsController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$loanapprovalsdata['loans']=Loans::all();
		$loanapprovalsdata['approvallevels']=ApprovalLevels::all();
		$loanapprovalsdata['usersaccounts']=UsersAccounts::all();
		$loanapprovalsdata['users']=Users::all();
		$loanapprovalsdata['approvalstatuses']=ApprovalStatuses::all();
		$loanapprovalsdata['list']=LoanApprovals::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LoanApprovals']])->get();
		$loanapprovalsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($loanapprovalsdata['usersaccountsroles'][0]['_add']==0&&$loanapprovalsdata['usersaccountsroles'][0]['_list']==0&&$loanapprovalsdata['usersaccountsroles'][0]['_edit']==0&&$loanapprovalsdata['usersaccountsroles'][0]['_edit']==0&&$loanapprovalsdata['usersaccountsroles'][0]['_show']==0&&$loanapprovalsdata['usersaccountsroles'][0]['_delete']==0&&$loanapprovalsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('loanapprovalsdata'));
		}else{
			return view('admin.loan_approvals.index',compact('loanapprovalsdata'));
		}
	}

	public function create(){
		$loanapprovalsdata;
		$loanapprovalsdata['loans']=Loans::all();
		$loanapprovalsdata['approvallevels']=ApprovalLevels::all();
		$loanapprovalsdata['usersaccounts']=UsersAccounts::all();
		$loanapprovalsdata['users']=Users::all();
		$loanapprovalsdata['approvalstatuses']=ApprovalStatuses::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LoanApprovals']])->get();
		$loanapprovalsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($loanapprovalsdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('loanapprovalsdata'));
		}else{
			return view('admin.loan_approvals.create',compact('loanapprovalsdata'));
		}
	}

	public function filter(Request $request){
		$loanapprovalsdata['loans']=Loans::all();
		$loanapprovalsdata['approvallevels']=ApprovalLevels::all();
		$loanapprovalsdata['usersaccounts']=UsersAccounts::all();
		$loanapprovalsdata['users']=Users::all();
		$loanapprovalsdata['approvalstatuses']=ApprovalStatuses::all();
		$loanapprovalsdata['list']=LoanApprovals::where([['loan','LIKE','%'.$request->get('loan').'%'],['level','LIKE','%'.$request->get('level').'%'],['user_account','LIKE','%'.$request->get('user_account').'%'],['user','LIKE','%'.$request->get('user').'%'],['status','LIKE','%'.$request->get('status').'%'],['comment','LIKE','%'.$request->get('comment').'%'],])->orWhereBetween('date',[$request->get('datefrom'),$request->get('dateto')])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LoanApprovals']])->get();
		$loanapprovalsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($loanapprovalsdata['usersaccountsroles'][0]['_add']==0&&$loanapprovalsdata['usersaccountsroles'][0]['_list']==0&&$loanapprovalsdata['usersaccountsroles'][0]['_edit']==0&&$loanapprovalsdata['usersaccountsroles'][0]['_edit']==0&&$loanapprovalsdata['usersaccountsroles'][0]['_show']==0&&$loanapprovalsdata['usersaccountsroles'][0]['_delete']==0&&$loanapprovalsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('loanapprovalsdata'));
		}else{
			return view('admin.loan_approvals.index',compact('loanapprovalsdata'));
		}
	}

	public function report(){
		$loanapprovalsdata['company']=Companies::all();
		$loanapprovalsdata['list']=LoanApprovals::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LoanApprovals']])->get();
		$loanapprovalsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($loanapprovalsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('loanapprovalsdata'));
		}else{
			return view('admin.loan_approvals.report',compact('loanapprovalsdata'));
		}
	}

	public function chart(){
		return view('admin.loan_approvals.chart');
	}

	public function store(Request $request){
		$loanapprovals=new LoanApprovals();
		$loanapprovals->loan=$request->get('loan');
		$loanapprovals->level=$request->get('level');
		$loanapprovals->user_account=$request->get('user_account');
		$loanapprovals->user=$request->get('user');
		$loanapprovals->date=$request->get('date');
		$loanapprovals->status=$request->get('status');
		$loanapprovals->comment=$request->get('comment');
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LoanApprovals']])->get();
		$loanapprovalsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		
		if($loanapprovalsdata['usersaccountsroles'][0]['_show']==1){
			try{
				if($loanapprovals->save()){
					$response['status']='1';
					$response['message']='loan approvals Added successfully';
					return json_encode($response);
			}else{
					$response['status']='0';
					$response['message']='Failed to add loan approvals. Please try again';
					return json_encode($response);
				}
			}
			catch(Exception $e){
					$response['status']='0';
					$response['message']='An Error occured while attempting to add loan approvals. Please try again';
					return json_encode($response);
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$loanapprovalsdata['loans']=Loans::all();
		$loanapprovalsdata['approvallevels']=ApprovalLevels::all();
		$loanapprovalsdata['usersaccounts']=UsersAccounts::all();
		$loanapprovalsdata['users']=Users::all();
		$loanapprovalsdata['approvalstatuses']=ApprovalStatuses::all();
		$loanapprovalsdata['data']=LoanApprovals::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LoanApprovals']])->get();
		$loanapprovalsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($loanapprovalsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('loanapprovalsdata'));
		}else{
		return view('admin.loan_approvals.edit',compact('loanapprovalsdata','id'));
		}
	}

	public function show($id){
		$loanapprovalsdata['loans']=Loans::all();
		$loanapprovalsdata['approvallevels']=ApprovalLevels::all();
		$loanapprovalsdata['usersaccounts']=UsersAccounts::all();
		$loanapprovalsdata['users']=Users::all();
		$loanapprovalsdata['approvalstatuses']=ApprovalStatuses::all();
		$loanapprovalsdata['data']=LoanApprovals::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LoanApprovals']])->get();
		$loanapprovalsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($loanapprovalsdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('loanapprovalsdata'));
		}else{
		return view('admin.loan_approvals.show',compact('loanapprovalsdata','id'));
		}
	}

	public function update(Request $request,$id){
		$loanapprovals=LoanApprovals::find($id);
		$loanapprovalsdata['loans']=Loans::all();
		$loanapprovalsdata['approvallevels']=ApprovalLevels::all();
		$loanapprovalsdata['usersaccounts']=UsersAccounts::all();
		$loanapprovalsdata['users']=Users::all();
		$loanapprovalsdata['approvalstatuses']=ApprovalStatuses::all();
		$loanapprovals->loan=$request->get('loan');
		$loanapprovals->level=$request->get('level');
		$loanapprovals->user_account=$request->get('user_account');
		$loanapprovals->user=$request->get('user');
		$loanapprovals->date=$request->get('date');
		$loanapprovals->status=$request->get('status');
		$loanapprovals->comment=$request->get('comment');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LoanApprovals']])->get();
		$loanapprovalsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($loanapprovalsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('loanapprovalsdata'));
		}else{
		$loanapprovals->save();
		$loanapprovalsdata['data']=LoanApprovals::find($id);
		return view('admin.loan_approvals.edit',compact('loanapprovalsdata','id'));
		}
	}

	public function destroy($id){
		$loanapprovals=LoanApprovals::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LoanApprovals']])->get();
		$loanapprovalsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($loanapprovalsdata['usersaccountsroles'][0]['_delete']==1){
			$loanapprovals->delete();
		}return redirect('admin/loanapprovals')->with('success','loan approvals has been deleted!');
	}
}