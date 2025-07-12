<?php
/**
* @author  Wanjala Innocent Khaemba
*Controller - (client exit approvals)
*/
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\ClientExitApprovals;
use App\Companies;
use App\Modules;
use App\Users;
use App\ClientExits;
use App\UsersAccounts;
use App\ApprovalStatuses;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;
class ClientExitApprovalsController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$clientexitapprovalsdata['clientexits']=ClientExits::all();
		$clientexitapprovalsdata['users']=Users::all();
		$clientexitapprovalsdata['usersaccounts']=UsersAccounts::all();
		$clientexitapprovalsdata['approvalstatuses']=ApprovalStatuses::all();
		$clientexitapprovalsdata['list']=ClientExitApprovals::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ClientExitApprovals']])->get();
		$clientexitapprovalsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($clientexitapprovalsdata['usersaccountsroles'][0]) && $clientexitapprovalsdata['usersaccountsroles'][0]['_add']==0&&$clientexitapprovalsdata['usersaccountsroles'][0]['_list']==0&&$clientexitapprovalsdata['usersaccountsroles'][0]['_edit']==0&&$clientexitapprovalsdata['usersaccountsroles'][0]['_edit']==0&&$clientexitapprovalsdata['usersaccountsroles'][0]['_show']==0&&$clientexitapprovalsdata['usersaccountsroles'][0]['_delete']==0&&$clientexitapprovalsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('clientexitapprovalsdata'));
		}else{
			return view('admin.client_exit_approvals.index',compact('clientexitapprovalsdata'));
		}
	}

	public function create(){
		$clientexitapprovalsdata;
		$clientexitapprovalsdata['clientexits']=ClientExits::all();
		$clientexitapprovalsdata['users']=Users::all();
		$clientexitapprovalsdata['usersaccounts']=UsersAccounts::all();
		$clientexitapprovalsdata['approvalstatuses']=ApprovalStatuses::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ClientExitApprovals']])->get();
		$clientexitapprovalsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($clientexitapprovalsdata['usersaccountsroles'][0]) && $clientexitapprovalsdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('clientexitapprovalsdata'));
		}else{
			return view('admin.client_exit_approvals.create',compact('clientexitapprovalsdata'));
		}
	}

	public function filter(Request $request){
		$clientexitapprovalsdata['clientexits']=ClientExits::all();
		$clientexitapprovalsdata['users']=Users::all();
		$clientexitapprovalsdata['usersaccounts']=UsersAccounts::all();
		$clientexitapprovalsdata['approvalstatuses']=ApprovalStatuses::all();
		$clientexitapprovalsdata['list']=ClientExitApprovals::where([['client_exit','LIKE','%'.$request->get('client_exit').'%'],['approved_by','LIKE','%'.$request->get('approved_by').'%'],['user_account','LIKE','%'.$request->get('user_account').'%'],['approval_status','LIKE','%'.$request->get('approval_status').'%'],['remarks','LIKE','%'.$request->get('remarks').'%'],])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ClientExitApprovals']])->get();
		$clientexitapprovalsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($clientexitapprovalsdata['usersaccountsroles'][0]) && $clientexitapprovalsdata['usersaccountsroles'][0]['_add']==0&&$clientexitapprovalsdata['usersaccountsroles'][0]['_list']==0&&$clientexitapprovalsdata['usersaccountsroles'][0]['_edit']==0&&$clientexitapprovalsdata['usersaccountsroles'][0]['_edit']==0&&$clientexitapprovalsdata['usersaccountsroles'][0]['_show']==0&&$clientexitapprovalsdata['usersaccountsroles'][0]['_delete']==0&&$clientexitapprovalsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('clientexitapprovalsdata'));
		}else{
			return view('admin.client_exit_approvals.index',compact('clientexitapprovalsdata'));
		}
	}

	public function report(){
		$clientexitapprovalsdata['company']=Companies::all();
		$clientexitapprovalsdata['list']=ClientExitApprovals::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ClientExitApprovals']])->get();
		$clientexitapprovalsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($clientexitapprovalsdata['usersaccountsroles'][0]) && $clientexitapprovalsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('clientexitapprovalsdata'));
		}else{
			return view('admin.client_exit_approvals.report',compact('clientexitapprovalsdata'));
		}
	}

	public function chart(){
		return view('admin.client_exit_approvals.chart');
	}

	public function store(Request $request){
		$clientexitapprovals=new ClientExitApprovals();
		$clientexitapprovals->client_exit=$request->get('client_exit');
		$clientexitapprovals->approved_by=$request->get('approved_by');
		$clientexitapprovals->user_account=$request->get('user_account');
		$clientexitapprovals->approval_status=$request->get('approval_status');
		$clientexitapprovals->remarks=$request->get('remarks');
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ClientExitApprovals']])->get();
		$clientexitapprovalsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($clientexitapprovalsdata['usersaccountsroles'][0]) && $clientexitapprovalsdata['usersaccountsroles'][0]['_show']==1){
			try{
				if($clientexitapprovals->save()){
					$response['status']='1';
					$response['message']='client exit approvals Added successfully';
					return json_encode($response);
			}else{
					$response['status']='0';
					$response['message']='Failed to add client exit approvals. Please try again';
					return json_encode($response);
				}
			}
			catch(Exception $e){
					$response['status']='0';
					$response['message']='An Error occured while attempting to add client exit approvals. Please try again';
					return json_encode($response);
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$clientexitapprovalsdata['clientexits']=ClientExits::all();
		$clientexitapprovalsdata['users']=Users::all();
		$clientexitapprovalsdata['usersaccounts']=UsersAccounts::all();
		$clientexitapprovalsdata['approvalstatuses']=ApprovalStatuses::all();
		$clientexitapprovalsdata['data']=ClientExitApprovals::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ClientExitApprovals']])->get();
		$clientexitapprovalsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($clientexitapprovalsdata['usersaccountsroles'][0]) && $clientexitapprovalsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('clientexitapprovalsdata'));
		}else{
		return view('admin.client_exit_approvals.edit',compact('clientexitapprovalsdata','id'));
		}
	}

	public function show($id){
		$clientexitapprovalsdata['clientexits']=ClientExits::all();
		$clientexitapprovalsdata['users']=Users::all();
		$clientexitapprovalsdata['usersaccounts']=UsersAccounts::all();
		$clientexitapprovalsdata['approvalstatuses']=ApprovalStatuses::all();
		$clientexitapprovalsdata['data']=ClientExitApprovals::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ClientExitApprovals']])->get();
		$clientexitapprovalsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($clientexitapprovalsdata['usersaccountsroles'][0]) && $clientexitapprovalsdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('clientexitapprovalsdata'));
		}else{
		return view('admin.client_exit_approvals.show',compact('clientexitapprovalsdata','id'));
		}
	}

	public function update(Request $request,$id){
		$clientexitapprovals=ClientExitApprovals::find($id);
		$clientexitapprovalsdata['clientexits']=ClientExits::all();
		$clientexitapprovalsdata['users']=Users::all();
		$clientexitapprovalsdata['usersaccounts']=UsersAccounts::all();
		$clientexitapprovalsdata['approvalstatuses']=ApprovalStatuses::all();
		$clientexitapprovals->client_exit=$request->get('client_exit');
		$clientexitapprovals->approved_by=$request->get('approved_by');
		$clientexitapprovals->user_account=$request->get('user_account');
		$clientexitapprovals->approval_status=$request->get('approval_status');
		$clientexitapprovals->remarks=$request->get('remarks');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ClientExitApprovals']])->get();
		$clientexitapprovalsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($clientexitapprovalsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('clientexitapprovalsdata'));
		}else{
		$clientexitapprovals->save();
		$clientexitapprovalsdata['data']=ClientExitApprovals::find($id);
		return view('admin.client_exit_approvals.edit',compact('clientexitapprovalsdata','id'));
		}
	}

	public function destroy($id){
		$clientexitapprovals=ClientExitApprovals::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ClientExitApprovals']])->get();
		$clientexitapprovalsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($clientexitapprovalsdata['usersaccountsroles'][0]) && $clientexitapprovalsdata['usersaccountsroles'][0]['_delete']==1){
			$clientexitapprovals->delete();
		}return redirect('admin/clientexitapprovals')->with('success','client exit approvals has been deleted!');
	}
}