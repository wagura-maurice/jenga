<?php
/**
* @author  Wanjala Innocent Khaemba
*Controller - (fine transfer approvals)
*/
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\FineTransferApprovals;
use App\Companies;
use App\Modules;
use App\Users;
use App\LgfToFineTransfers;
use App\ApprovalLevels;
use App\ApprovalStatuses;
use App\UsersAccounts;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;
class FineTransferApprovalsController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$finetransferapprovalsdata['lgftofinetransfers']=LgfToFineTransfers::all();
		$finetransferapprovalsdata['approvallevels']=ApprovalLevels::all();
		$finetransferapprovalsdata['approvalstatuses']=ApprovalStatuses::all();
		$finetransferapprovalsdata['users']=Users::all();
		$finetransferapprovalsdata['usersaccounts']=UsersAccounts::all();
		$finetransferapprovalsdata['list']=FineTransferApprovals::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','FineTransferApprovals']])->get();
		$finetransferapprovalsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($finetransferapprovalsdata['usersaccountsroles'][0]) && $finetransferapprovalsdata['usersaccountsroles'][0]['_add']==0&&$finetransferapprovalsdata['usersaccountsroles'][0]['_list']==0&&$finetransferapprovalsdata['usersaccountsroles'][0]['_edit']==0&&$finetransferapprovalsdata['usersaccountsroles'][0]['_edit']==0&&$finetransferapprovalsdata['usersaccountsroles'][0]['_show']==0&&$finetransferapprovalsdata['usersaccountsroles'][0]['_delete']==0&&$finetransferapprovalsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('finetransferapprovalsdata'));
		}else{
			return view('admin.fine_transfer_approvals.index',compact('finetransferapprovalsdata'));
		}
	}

	public function create(){
		$finetransferapprovalsdata;
		$finetransferapprovalsdata['lgftofinetransfers']=LgfToFineTransfers::all();
		$finetransferapprovalsdata['approvallevels']=ApprovalLevels::all();
		$finetransferapprovalsdata['approvalstatuses']=ApprovalStatuses::all();
		$finetransferapprovalsdata['users']=Users::all();
		$finetransferapprovalsdata['usersaccounts']=UsersAccounts::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','FineTransferApprovals']])->get();
		$finetransferapprovalsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($finetransferapprovalsdata['usersaccountsroles'][0]) && $finetransferapprovalsdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('finetransferapprovalsdata'));
		}else{
			return view('admin.fine_transfer_approvals.create',compact('finetransferapprovalsdata'));
		}
	}

	public function filter(Request $request){
		$finetransferapprovalsdata['lgftofinetransfers']=LgfToFineTransfers::all();
		$finetransferapprovalsdata['approvallevels']=ApprovalLevels::all();
		$finetransferapprovalsdata['approvalstatuses']=ApprovalStatuses::all();
		$finetransferapprovalsdata['users']=Users::all();
		$finetransferapprovalsdata['usersaccounts']=UsersAccounts::all();
		$finetransferapprovalsdata['list']=FineTransferApprovals::where([['fine_transfer','LIKE','%'.$request->get('fine_transfer').'%'],['approval_level','LIKE','%'.$request->get('approval_level').'%'],['approval_status','LIKE','%'.$request->get('approval_status').'%'],['remarks','LIKE','%'.$request->get('remarks').'%'],['approved_by','LIKE','%'.$request->get('approved_by').'%'],['users_accounts','LIKE','%'.$request->get('users_accounts').'%'],])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','FineTransferApprovals']])->get();
		$finetransferapprovalsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($finetransferapprovalsdata['usersaccountsroles'][0]) && $finetransferapprovalsdata['usersaccountsroles'][0]['_add']==0&&$finetransferapprovalsdata['usersaccountsroles'][0]['_list']==0&&$finetransferapprovalsdata['usersaccountsroles'][0]['_edit']==0&&$finetransferapprovalsdata['usersaccountsroles'][0]['_edit']==0&&$finetransferapprovalsdata['usersaccountsroles'][0]['_show']==0&&$finetransferapprovalsdata['usersaccountsroles'][0]['_delete']==0&&$finetransferapprovalsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('finetransferapprovalsdata'));
		}else{
			return view('admin.fine_transfer_approvals.index',compact('finetransferapprovalsdata'));
		}
	}

	public function report(){
		$finetransferapprovalsdata['company']=Companies::all();
		$finetransferapprovalsdata['list']=FineTransferApprovals::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','FineTransferApprovals']])->get();
		$finetransferapprovalsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($finetransferapprovalsdata['usersaccountsroles'][0]) && $finetransferapprovalsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('finetransferapprovalsdata'));
		}else{
			return view('admin.fine_transfer_approvals.report',compact('finetransferapprovalsdata'));
		}
	}

	public function chart(){
		return view('admin.fine_transfer_approvals.chart');
	}

	public function store(Request $request){
		$finetransferapprovals=new FineTransferApprovals();
		$finetransferapprovals->fine_transfer=$request->get('fine_transfer');
		$finetransferapprovals->approval_level=$request->get('approval_level');
		$finetransferapprovals->approval_status=$request->get('approval_status');
		$finetransferapprovals->remarks=$request->get('remarks');
		$finetransferapprovals->approved_by=$request->get('approved_by');
		$finetransferapprovals->users_accounts=$request->get('users_accounts');
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','FineTransferApprovals']])->get();
		$finetransferapprovalsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($finetransferapprovalsdata['usersaccountsroles'][0]) && $finetransferapprovalsdata['usersaccountsroles'][0]['_show']==1){
			try{
				if($finetransferapprovals->save()){
					$response['status']='1';
					$response['message']='fine transfer approvals Added successfully';
					return json_encode($response);
			}else{
					$response['status']='0';
					$response['message']='Failed to add fine transfer approvals. Please try again';
					return json_encode($response);
				}
			}
			catch(Exception $e){
					$response['status']='0';
					$response['message']='An Error occured while attempting to add fine transfer approvals. Please try again';
					return json_encode($response);
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$finetransferapprovalsdata['lgftofinetransfers']=LgfToFineTransfers::all();
		$finetransferapprovalsdata['approvallevels']=ApprovalLevels::all();
		$finetransferapprovalsdata['approvalstatuses']=ApprovalStatuses::all();
		$finetransferapprovalsdata['users']=Users::all();
		$finetransferapprovalsdata['usersaccounts']=UsersAccounts::all();
		$finetransferapprovalsdata['data']=FineTransferApprovals::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','FineTransferApprovals']])->get();
		$finetransferapprovalsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($finetransferapprovalsdata['usersaccountsroles'][0]) && $finetransferapprovalsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('finetransferapprovalsdata'));
		}else{
		return view('admin.fine_transfer_approvals.edit',compact('finetransferapprovalsdata','id'));
		}
	}

	public function show($id){
		$finetransferapprovalsdata['lgftofinetransfers']=LgfToFineTransfers::all();
		$finetransferapprovalsdata['approvallevels']=ApprovalLevels::all();
		$finetransferapprovalsdata['approvalstatuses']=ApprovalStatuses::all();
		$finetransferapprovalsdata['users']=Users::all();
		$finetransferapprovalsdata['usersaccounts']=UsersAccounts::all();
		$finetransferapprovalsdata['data']=FineTransferApprovals::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','FineTransferApprovals']])->get();
		$finetransferapprovalsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($finetransferapprovalsdata['usersaccountsroles'][0]) && $finetransferapprovalsdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('finetransferapprovalsdata'));
		}else{
		return view('admin.fine_transfer_approvals.show',compact('finetransferapprovalsdata','id'));
		}
	}

	public function update(Request $request,$id){
		$finetransferapprovals=FineTransferApprovals::find($id);
		$finetransferapprovalsdata['lgftofinetransfers']=LgfToFineTransfers::all();
		$finetransferapprovalsdata['approvallevels']=ApprovalLevels::all();
		$finetransferapprovalsdata['approvalstatuses']=ApprovalStatuses::all();
		$finetransferapprovalsdata['users']=Users::all();
		$finetransferapprovalsdata['usersaccounts']=UsersAccounts::all();
		$finetransferapprovals->fine_transfer=$request->get('fine_transfer');
		$finetransferapprovals->approval_level=$request->get('approval_level');
		$finetransferapprovals->approval_status=$request->get('approval_status');
		$finetransferapprovals->remarks=$request->get('remarks');
		$finetransferapprovals->approved_by=$request->get('approved_by');
		$finetransferapprovals->users_accounts=$request->get('users_accounts');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','FineTransferApprovals']])->get();
		$finetransferapprovalsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($finetransferapprovalsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('finetransferapprovalsdata'));
		}else{
		$finetransferapprovals->save();
		$finetransferapprovalsdata['data']=FineTransferApprovals::find($id);
		return view('admin.fine_transfer_approvals.edit',compact('finetransferapprovalsdata','id'));
		}
	}

	public function destroy($id){
		$finetransferapprovals=FineTransferApprovals::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','FineTransferApprovals']])->get();
		$finetransferapprovalsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($finetransferapprovalsdata['usersaccountsroles'][0]) && $finetransferapprovalsdata['usersaccountsroles'][0]['_delete']==1){
			$finetransferapprovals->delete();
		}return redirect('admin/finetransferapprovals')->with('success','fine transfer approvals has been deleted!');
	}
}