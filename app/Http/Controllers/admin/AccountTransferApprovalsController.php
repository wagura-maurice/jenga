<?php
/**
* @author  Wanjala Innocent Khaemba
*Controller - (account transfer approvals)
*/
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\AccountTransferApprovals;
use App\Companies;
use App\Modules;
use App\Users;
use App\AccountToAccountTransfers;
use App\ApprovalLevels;
use App\ApprovalStatuses;
use App\UsersAccounts;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;
class AccountTransferApprovalsController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$accounttransferapprovalsdata['accounttoaccounttransfers']=AccountToAccountTransfers::all();
		$accounttransferapprovalsdata['approvallevels']=ApprovalLevels::all();
		$accounttransferapprovalsdata['approvalstatuses']=ApprovalStatuses::all();
		$accounttransferapprovalsdata['usersaccounts']=UsersAccounts::all();
		$accounttransferapprovalsdata['users']=Users::all();
		$accounttransferapprovalsdata['list']=AccountTransferApprovals::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','AccountTransferApprovals']])->get();
		$accounttransferapprovalsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($accounttransferapprovalsdata['usersaccountsroles'][0]) && $accounttransferapprovalsdata['usersaccountsroles'][0]['_add']==0&&$accounttransferapprovalsdata['usersaccountsroles'][0]['_list']==0&&$accounttransferapprovalsdata['usersaccountsroles'][0]['_edit']==0&&$accounttransferapprovalsdata['usersaccountsroles'][0]['_edit']==0&&$accounttransferapprovalsdata['usersaccountsroles'][0]['_show']==0&&$accounttransferapprovalsdata['usersaccountsroles'][0]['_delete']==0&&$accounttransferapprovalsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('accounttransferapprovalsdata'));
		}else{
			return view('admin.account_transfer_approvals.index',compact('accounttransferapprovalsdata'));
		}
	}

	public function create(){
		$accounttransferapprovalsdata;
		$accounttransferapprovalsdata['accounttoaccounttransfers']=AccountToAccountTransfers::all();
		$accounttransferapprovalsdata['approvallevels']=ApprovalLevels::all();
		$accounttransferapprovalsdata['approvalstatuses']=ApprovalStatuses::all();
		$accounttransferapprovalsdata['usersaccounts']=UsersAccounts::all();
		$accounttransferapprovalsdata['users']=Users::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','AccountTransferApprovals']])->get();
		$accounttransferapprovalsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($accounttransferapprovalsdata['usersaccountsroles'][0]) && $accounttransferapprovalsdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('accounttransferapprovalsdata'));
		}else{
			return view('admin.account_transfer_approvals.create',compact('accounttransferapprovalsdata'));
		}
	}

	public function filter(Request $request){
		$accounttransferapprovalsdata['accounttoaccounttransfers']=AccountToAccountTransfers::all();
		$accounttransferapprovalsdata['approvallevels']=ApprovalLevels::all();
		$accounttransferapprovalsdata['approvalstatuses']=ApprovalStatuses::all();
		$accounttransferapprovalsdata['usersaccounts']=UsersAccounts::all();
		$accounttransferapprovalsdata['users']=Users::all();
		$accounttransferapprovalsdata['list']=AccountTransferApprovals::where([['account_transfer','LIKE','%'.$request->get('account_transfer').'%'],['approval_level','LIKE','%'.$request->get('approval_level').'%'],['approval_status','LIKE','%'.$request->get('approval_status').'%'],['user_account','LIKE','%'.$request->get('user_account').'%'],['approved_by','LIKE','%'.$request->get('approved_by').'%'],['remarks','LIKE','%'.$request->get('remarks').'%'],])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','AccountTransferApprovals']])->get();
		$accounttransferapprovalsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($accounttransferapprovalsdata['usersaccountsroles'][0]) && $accounttransferapprovalsdata['usersaccountsroles'][0]['_add']==0&&$accounttransferapprovalsdata['usersaccountsroles'][0]['_list']==0&&$accounttransferapprovalsdata['usersaccountsroles'][0]['_edit']==0&&$accounttransferapprovalsdata['usersaccountsroles'][0]['_edit']==0&&$accounttransferapprovalsdata['usersaccountsroles'][0]['_show']==0&&$accounttransferapprovalsdata['usersaccountsroles'][0]['_delete']==0&&$accounttransferapprovalsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('accounttransferapprovalsdata'));
		}else{
			return view('admin.account_transfer_approvals.index',compact('accounttransferapprovalsdata'));
		}
	}

	public function report(){
		$accounttransferapprovalsdata['company']=Companies::all();
		$accounttransferapprovalsdata['list']=AccountTransferApprovals::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','AccountTransferApprovals']])->get();
		$accounttransferapprovalsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($accounttransferapprovalsdata['usersaccountsroles'][0]) && $accounttransferapprovalsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('accounttransferapprovalsdata'));
		}else{
			return view('admin.account_transfer_approvals.report',compact('accounttransferapprovalsdata'));
		}
	}

	public function chart(){
		return view('admin.account_transfer_approvals.chart');
	}

	public function store(Request $request){
		$accounttransferapprovals=new AccountTransferApprovals();
		$accounttransferapprovals->account_transfer=$request->get('account_transfer');
		$accounttransferapprovals->approval_level=$request->get('approval_level');
		$accounttransferapprovals->approval_status=$request->get('approval_status');
		$accounttransferapprovals->user_account=$request->get('user_account');
		$accounttransferapprovals->approved_by=$request->get('approved_by');
		$accounttransferapprovals->remarks=$request->get('remarks');
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','AccountTransferApprovals']])->get();
		$accounttransferapprovalsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($accounttransferapprovalsdata['usersaccountsroles'][0]) && $accounttransferapprovalsdata['usersaccountsroles'][0]['_show']==1){
			try{
				if($accounttransferapprovals->save()){
					$response['status']='1';
					$response['message']='account transfer approvals Added successfully';
					return json_encode($response);
			}else{
					$response['status']='0';
					$response['message']='Failed to add account transfer approvals. Please try again';
					return json_encode($response);
				}
			}
			catch(Exception $e){
					$response['status']='0';
					$response['message']='An Error occured while attempting to add account transfer approvals. Please try again';
					return json_encode($response);
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$accounttransferapprovalsdata['accounttoaccounttransfers']=AccountToAccountTransfers::all();
		$accounttransferapprovalsdata['approvallevels']=ApprovalLevels::all();
		$accounttransferapprovalsdata['approvalstatuses']=ApprovalStatuses::all();
		$accounttransferapprovalsdata['usersaccounts']=UsersAccounts::all();
		$accounttransferapprovalsdata['users']=Users::all();
		$accounttransferapprovalsdata['data']=AccountTransferApprovals::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','AccountTransferApprovals']])->get();
		$accounttransferapprovalsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($accounttransferapprovalsdata['usersaccountsroles'][0]) && $accounttransferapprovalsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('accounttransferapprovalsdata'));
		}else{
		return view('admin.account_transfer_approvals.edit',compact('accounttransferapprovalsdata','id'));
		}
	}

	public function show($id){
		$accounttransferapprovalsdata['accounttoaccounttransfers']=AccountToAccountTransfers::all();
		$accounttransferapprovalsdata['approvallevels']=ApprovalLevels::all();
		$accounttransferapprovalsdata['approvalstatuses']=ApprovalStatuses::all();
		$accounttransferapprovalsdata['usersaccounts']=UsersAccounts::all();
		$accounttransferapprovalsdata['users']=Users::all();
		$accounttransferapprovalsdata['data']=AccountTransferApprovals::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','AccountTransferApprovals']])->get();
		$accounttransferapprovalsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($accounttransferapprovalsdata['usersaccountsroles'][0]) && $accounttransferapprovalsdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('accounttransferapprovalsdata'));
		}else{
		return view('admin.account_transfer_approvals.show',compact('accounttransferapprovalsdata','id'));
		}
	}

	public function update(Request $request,$id){
		$accounttransferapprovals=AccountTransferApprovals::find($id);
		$accounttransferapprovalsdata['accounttoaccounttransfers']=AccountToAccountTransfers::all();
		$accounttransferapprovalsdata['approvallevels']=ApprovalLevels::all();
		$accounttransferapprovalsdata['approvalstatuses']=ApprovalStatuses::all();
		$accounttransferapprovalsdata['usersaccounts']=UsersAccounts::all();
		$accounttransferapprovalsdata['users']=Users::all();
		$accounttransferapprovals->account_transfer=$request->get('account_transfer');
		$accounttransferapprovals->approval_level=$request->get('approval_level');
		$accounttransferapprovals->approval_status=$request->get('approval_status');
		$accounttransferapprovals->user_account=$request->get('user_account');
		$accounttransferapprovals->approved_by=$request->get('approved_by');
		$accounttransferapprovals->remarks=$request->get('remarks');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','AccountTransferApprovals']])->get();
		$accounttransferapprovalsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($accounttransferapprovalsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('accounttransferapprovalsdata'));
		}else{
		$accounttransferapprovals->save();
		$accounttransferapprovalsdata['data']=AccountTransferApprovals::find($id);
		return view('admin.account_transfer_approvals.edit',compact('accounttransferapprovalsdata','id'));
		}
	}

	public function destroy($id){
		$accounttransferapprovals=AccountTransferApprovals::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','AccountTransferApprovals']])->get();
		$accounttransferapprovalsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($accounttransferapprovalsdata['usersaccountsroles'][0]) && $accounttransferapprovalsdata['usersaccountsroles'][0]['_delete']==1){
			$accounttransferapprovals->delete();
		}return redirect('admin/accounttransferapprovals')->with('success','account transfer approvals has been deleted!');
	}
}