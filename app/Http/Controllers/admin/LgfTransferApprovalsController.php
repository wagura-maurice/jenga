<?php
/**
* @author  Wanjala Innocent Khaemba
*Controller - (lgf transfer approvals)
*/
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\LgfTransferApprovals;
use App\Companies;
use App\Modules;
use App\Users;
use App\LgfToLgfTransfers;
use App\ApprovalLevels;
use App\ApprovalStatuses;
use App\UsersAccounts;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;
class LgfTransferApprovalsController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$lgftransferapprovalsdata['lgftolgftransfers']=LgfToLgfTransfers::all();
		$lgftransferapprovalsdata['approvallevels']=ApprovalLevels::all();
		$lgftransferapprovalsdata['approvalstatuses']=ApprovalStatuses::all();
		$lgftransferapprovalsdata['usersaccounts']=UsersAccounts::all();
		$lgftransferapprovalsdata['approvalstatuses']=ApprovalStatuses::all();
		$lgftransferapprovalsdata['list']=LgfTransferApprovals::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LgfTransferApprovals']])->get();
		$lgftransferapprovalsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($lgftransferapprovalsdata['usersaccountsroles'][0]) && $lgftransferapprovalsdata['usersaccountsroles'][0]['_add']==0&&$lgftransferapprovalsdata['usersaccountsroles'][0]['_list']==0&&$lgftransferapprovalsdata['usersaccountsroles'][0]['_edit']==0&&$lgftransferapprovalsdata['usersaccountsroles'][0]['_edit']==0&&$lgftransferapprovalsdata['usersaccountsroles'][0]['_show']==0&&$lgftransferapprovalsdata['usersaccountsroles'][0]['_delete']==0&&$lgftransferapprovalsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('lgftransferapprovalsdata'));
		}else{
			return view('admin.lgf_transfer_approvals.index',compact('lgftransferapprovalsdata'));
		}
	}

	public function create(){
		$lgftransferapprovalsdata;
		$lgftransferapprovalsdata['lgftolgftransfers']=LgfToLgfTransfers::all();
		$lgftransferapprovalsdata['approvallevels']=ApprovalLevels::all();
		$lgftransferapprovalsdata['approvalstatuses']=ApprovalStatuses::all();
		$lgftransferapprovalsdata['usersaccounts']=UsersAccounts::all();
		$lgftransferapprovalsdata['approvalstatuses']=ApprovalStatuses::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LgfTransferApprovals']])->get();
		$lgftransferapprovalsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($lgftransferapprovalsdata['usersaccountsroles'][0]) && $lgftransferapprovalsdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('lgftransferapprovalsdata'));
		}else{
			return view('admin.lgf_transfer_approvals.create',compact('lgftransferapprovalsdata'));
		}
	}

	public function filter(Request $request){
		$lgftransferapprovalsdata['lgftolgftransfers']=LgfToLgfTransfers::all();
		$lgftransferapprovalsdata['approvallevels']=ApprovalLevels::all();
		$lgftransferapprovalsdata['approvalstatuses']=ApprovalStatuses::all();
		$lgftransferapprovalsdata['usersaccounts']=UsersAccounts::all();
		$lgftransferapprovalsdata['approvalstatuses']=ApprovalStatuses::all();
		$lgftransferapprovalsdata['list']=LgfTransferApprovals::where([['lgf_transfer','LIKE','%'.$request->get('lgf_transfer').'%'],['approval_level','LIKE','%'.$request->get('approval_level').'%'],['approval_status','LIKE','%'.$request->get('approval_status').'%'],['user_account','LIKE','%'.$request->get('user_account').'%'],['approved_by','LIKE','%'.$request->get('approved_by').'%'],['remarks','LIKE','%'.$request->get('remarks').'%'],])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LgfTransferApprovals']])->get();
		$lgftransferapprovalsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($lgftransferapprovalsdata['usersaccountsroles'][0]) && $lgftransferapprovalsdata['usersaccountsroles'][0]['_add']==0&&$lgftransferapprovalsdata['usersaccountsroles'][0]['_list']==0&&$lgftransferapprovalsdata['usersaccountsroles'][0]['_edit']==0&&$lgftransferapprovalsdata['usersaccountsroles'][0]['_edit']==0&&$lgftransferapprovalsdata['usersaccountsroles'][0]['_show']==0&&$lgftransferapprovalsdata['usersaccountsroles'][0]['_delete']==0&&$lgftransferapprovalsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('lgftransferapprovalsdata'));
		}else{
			return view('admin.lgf_transfer_approvals.index',compact('lgftransferapprovalsdata'));
		}
	}

	public function report(){
		$lgftransferapprovalsdata['company']=Companies::all();
		$lgftransferapprovalsdata['list']=LgfTransferApprovals::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LgfTransferApprovals']])->get();
		$lgftransferapprovalsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($lgftransferapprovalsdata['usersaccountsroles'][0]) && $lgftransferapprovalsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('lgftransferapprovalsdata'));
		}else{
			return view('admin.lgf_transfer_approvals.report',compact('lgftransferapprovalsdata'));
		}
	}

	public function chart(){
		return view('admin.lgf_transfer_approvals.chart');
	}

	public function store(Request $request){
		$lgftransferapprovals=new LgfTransferApprovals();
		$lgftransferapprovals->lgf_transfer=$request->get('lgf_transfer');
		$lgftransferapprovals->approval_level=$request->get('approval_level');
		$lgftransferapprovals->approval_status=$request->get('approval_status');
		$lgftransferapprovals->user_account=$request->get('user_account');
		$lgftransferapprovals->approved_by=$request->get('approved_by');
		$lgftransferapprovals->remarks=$request->get('remarks');
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LgfTransferApprovals']])->get();
		$lgftransferapprovalsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($lgftransferapprovalsdata['usersaccountsroles'][0]) && $lgftransferapprovalsdata['usersaccountsroles'][0]['_show']==1){
			try{
				if($lgftransferapprovals->save()){
					$response['status']='1';
					$response['message']='lgf transfer approvals Added successfully';
					return json_encode($response);
			}else{
					$response['status']='0';
					$response['message']='Failed to add lgf transfer approvals. Please try again';
					return json_encode($response);
				}
			}
			catch(Exception $e){
					$response['status']='0';
					$response['message']='An Error occured while attempting to add lgf transfer approvals. Please try again';
					return json_encode($response);
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$lgftransferapprovalsdata['lgftolgftransfers']=LgfToLgfTransfers::all();
		$lgftransferapprovalsdata['approvallevels']=ApprovalLevels::all();
		$lgftransferapprovalsdata['approvalstatuses']=ApprovalStatuses::all();
		$lgftransferapprovalsdata['usersaccounts']=UsersAccounts::all();
		$lgftransferapprovalsdata['approvalstatuses']=ApprovalStatuses::all();
		$lgftransferapprovalsdata['data']=LgfTransferApprovals::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LgfTransferApprovals']])->get();
		$lgftransferapprovalsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($lgftransferapprovalsdata['usersaccountsroles'][0]) && $lgftransferapprovalsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('lgftransferapprovalsdata'));
		}else{
		return view('admin.lgf_transfer_approvals.edit',compact('lgftransferapprovalsdata','id'));
		}
	}

	public function show($id){
		$lgftransferapprovalsdata['lgftolgftransfers']=LgfToLgfTransfers::all();
		$lgftransferapprovalsdata['approvallevels']=ApprovalLevels::all();
		$lgftransferapprovalsdata['approvalstatuses']=ApprovalStatuses::all();
		$lgftransferapprovalsdata['usersaccounts']=UsersAccounts::all();
		$lgftransferapprovalsdata['approvalstatuses']=ApprovalStatuses::all();
		$lgftransferapprovalsdata['data']=LgfTransferApprovals::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LgfTransferApprovals']])->get();
		$lgftransferapprovalsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($lgftransferapprovalsdata['usersaccountsroles'][0]) && $lgftransferapprovalsdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('lgftransferapprovalsdata'));
		}else{
		return view('admin.lgf_transfer_approvals.show',compact('lgftransferapprovalsdata','id'));
		}
	}

	public function update(Request $request,$id){
		$lgftransferapprovals=LgfTransferApprovals::find($id);
		$lgftransferapprovalsdata['lgftolgftransfers']=LgfToLgfTransfers::all();
		$lgftransferapprovalsdata['approvallevels']=ApprovalLevels::all();
		$lgftransferapprovalsdata['approvalstatuses']=ApprovalStatuses::all();
		$lgftransferapprovalsdata['usersaccounts']=UsersAccounts::all();
		$lgftransferapprovalsdata['approvalstatuses']=ApprovalStatuses::all();
		$lgftransferapprovals->lgf_transfer=$request->get('lgf_transfer');
		$lgftransferapprovals->approval_level=$request->get('approval_level');
		$lgftransferapprovals->approval_status=$request->get('approval_status');
		$lgftransferapprovals->user_account=$request->get('user_account');
		$lgftransferapprovals->approved_by=$request->get('approved_by');
		$lgftransferapprovals->remarks=$request->get('remarks');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LgfTransferApprovals']])->get();
		$lgftransferapprovalsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($lgftransferapprovalsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('lgftransferapprovalsdata'));
		}else{
		$lgftransferapprovals->save();
		$lgftransferapprovalsdata['data']=LgfTransferApprovals::find($id);
		return view('admin.lgf_transfer_approvals.edit',compact('lgftransferapprovalsdata','id'));
		}
	}

	public function destroy($id){
		$lgftransferapprovals=LgfTransferApprovals::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LgfTransferApprovals']])->get();
		$lgftransferapprovalsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($lgftransferapprovalsdata['usersaccountsroles'][0]) && $lgftransferapprovalsdata['usersaccountsroles'][0]['_delete']==1){
			$lgftransferapprovals->delete();
		}return redirect('admin/lgftransferapprovals')->with('success','lgf transfer approvals has been deleted!');
	}
}