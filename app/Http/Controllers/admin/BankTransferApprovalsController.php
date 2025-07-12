<?php
/**
* @author  Wanjala Innocent Khaemba
*Controller - (bank transfer approvals)
*/
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\BankTransferApprovals;
use App\Companies;
use App\Modules;
use App\LgfToBankTransfers;
use App\ApprovalLevels;
use App\ApprovalStatuses;
use App\Users;
use App\UsersAccounts;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;
class BankTransferApprovalsController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$banktransferapprovalsdata['lgftobanktransfers']=LgfToBankTransfers::all();
		$banktransferapprovalsdata['approvallevels']=ApprovalLevels::all();
		$banktransferapprovalsdata['approvalstatuses']=ApprovalStatuses::all();
		$banktransferapprovalsdata['users']=Users::all();
		$banktransferapprovalsdata['usersaccounts']=UsersAccounts::all();
		$banktransferapprovalsdata['list']=BankTransferApprovals::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','BankTransferApprovals']])->get();
		$banktransferapprovalsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($banktransferapprovalsdata['usersaccountsroles'][0]) && $banktransferapprovalsdata['usersaccountsroles'][0]['_add']==0&&$banktransferapprovalsdata['usersaccountsroles'][0]['_list']==0&&$banktransferapprovalsdata['usersaccountsroles'][0]['_edit']==0&&$banktransferapprovalsdata['usersaccountsroles'][0]['_edit']==0&&$banktransferapprovalsdata['usersaccountsroles'][0]['_show']==0&&$banktransferapprovalsdata['usersaccountsroles'][0]['_delete']==0&&$banktransferapprovalsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('banktransferapprovalsdata'));
		}else{
			return view('admin.bank_transfer_approvals.index',compact('banktransferapprovalsdata'));
		}
	}

	public function create(){
		$banktransferapprovalsdata;
		$banktransferapprovalsdata['lgftobanktransfers']=LgfToBankTransfers::all();
		$banktransferapprovalsdata['approvallevels']=ApprovalLevels::all();
		$banktransferapprovalsdata['approvalstatuses']=ApprovalStatuses::all();
		$banktransferapprovalsdata['users']=Users::all();
		$banktransferapprovalsdata['usersaccounts']=UsersAccounts::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','BankTransferApprovals']])->get();
		$banktransferapprovalsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($banktransferapprovalsdata['usersaccountsroles'][0]) && $banktransferapprovalsdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('banktransferapprovalsdata'));
		}else{
			return view('admin.bank_transfer_approvals.create',compact('banktransferapprovalsdata'));
		}
	}

	public function filter(Request $request){
		$banktransferapprovalsdata['lgftobanktransfers']=LgfToBankTransfers::all();
		$banktransferapprovalsdata['approvallevels']=ApprovalLevels::all();
		$banktransferapprovalsdata['approvalstatuses']=ApprovalStatuses::all();
		$banktransferapprovalsdata['users']=Users::all();
		$banktransferapprovalsdata['usersaccounts']=UsersAccounts::all();
		$banktransferapprovalsdata['list']=BankTransferApprovals::where([['bank_transfer','LIKE','%'.$request->get('bank_transfer').'%'],['approval_level','LIKE','%'.$request->get('approval_level').'%'],['approval_status','LIKE','%'.$request->get('approval_status').'%'],['approved_by','LIKE','%'.$request->get('approved_by').'%'],['user_account','LIKE','%'.$request->get('user_account').'%'],['remarks','LIKE','%'.$request->get('remarks').'%'],])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','BankTransferApprovals']])->get();
		$banktransferapprovalsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($banktransferapprovalsdata['usersaccountsroles'][0]) && $banktransferapprovalsdata['usersaccountsroles'][0]['_add']==0&&$banktransferapprovalsdata['usersaccountsroles'][0]['_list']==0&&$banktransferapprovalsdata['usersaccountsroles'][0]['_edit']==0&&$banktransferapprovalsdata['usersaccountsroles'][0]['_edit']==0&&$banktransferapprovalsdata['usersaccountsroles'][0]['_show']==0&&$banktransferapprovalsdata['usersaccountsroles'][0]['_delete']==0&&$banktransferapprovalsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('banktransferapprovalsdata'));
		}else{
			return view('admin.bank_transfer_approvals.index',compact('banktransferapprovalsdata'));
		}
	}

	public function report(){
		$banktransferapprovalsdata['company']=Companies::all();
		$banktransferapprovalsdata['list']=BankTransferApprovals::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','BankTransferApprovals']])->get();
		$banktransferapprovalsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($banktransferapprovalsdata['usersaccountsroles'][0]) && $banktransferapprovalsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('banktransferapprovalsdata'));
		}else{
			return view('admin.bank_transfer_approvals.report',compact('banktransferapprovalsdata'));
		}
	}

	public function chart(){
		return view('admin.bank_transfer_approvals.chart');
	}

	public function store(Request $request){
		$banktransferapprovals=new BankTransferApprovals();
		$banktransferapprovals->bank_transfer=$request->get('bank_transfer');
		$banktransferapprovals->approval_level=$request->get('approval_level');
		$banktransferapprovals->approval_status=$request->get('approval_status');
		$banktransferapprovals->approved_by=$request->get('approved_by');
		$banktransferapprovals->user_account=$request->get('user_account');
		$banktransferapprovals->remarks=$request->get('remarks');
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','BankTransferApprovals']])->get();
		$banktransferapprovalsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($banktransferapprovalsdata['usersaccountsroles'][0]) && $banktransferapprovalsdata['usersaccountsroles'][0]['_show']==1){
			try{
				if($banktransferapprovals->save()){
					$response['status']='1';
					$response['message']='bank transfer approvals Added successfully';
					return json_encode($response);
			}else{
					$response['status']='0';
					$response['message']='Failed to add bank transfer approvals. Please try again';
					return json_encode($response);
				}
			}
			catch(Exception $e){
					$response['status']='0';
					$response['message']='An Error occured while attempting to add bank transfer approvals. Please try again';
					return json_encode($response);
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$banktransferapprovalsdata['lgftobanktransfers']=LgfToBankTransfers::all();
		$banktransferapprovalsdata['approvallevels']=ApprovalLevels::all();
		$banktransferapprovalsdata['approvalstatuses']=ApprovalStatuses::all();
		$banktransferapprovalsdata['users']=Users::all();
		$banktransferapprovalsdata['usersaccounts']=UsersAccounts::all();
		$banktransferapprovalsdata['data']=BankTransferApprovals::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','BankTransferApprovals']])->get();
		$banktransferapprovalsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($banktransferapprovalsdata['usersaccountsroles'][0]) && $banktransferapprovalsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('banktransferapprovalsdata'));
		}else{
		return view('admin.bank_transfer_approvals.edit',compact('banktransferapprovalsdata','id'));
		}
	}

	public function show($id){
		$banktransferapprovalsdata['lgftobanktransfers']=LgfToBankTransfers::all();
		$banktransferapprovalsdata['approvallevels']=ApprovalLevels::all();
		$banktransferapprovalsdata['approvalstatuses']=ApprovalStatuses::all();
		$banktransferapprovalsdata['users']=Users::all();
		$banktransferapprovalsdata['usersaccounts']=UsersAccounts::all();
		$banktransferapprovalsdata['data']=BankTransferApprovals::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','BankTransferApprovals']])->get();
		$banktransferapprovalsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($banktransferapprovalsdata['usersaccountsroles'][0]) && $banktransferapprovalsdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('banktransferapprovalsdata'));
		}else{
		return view('admin.bank_transfer_approvals.show',compact('banktransferapprovalsdata','id'));
		}
	}

	public function update(Request $request,$id){
		$banktransferapprovals=BankTransferApprovals::find($id);
		$banktransferapprovalsdata['lgftobanktransfers']=LgfToBankTransfers::all();
		$banktransferapprovalsdata['approvallevels']=ApprovalLevels::all();
		$banktransferapprovalsdata['approvalstatuses']=ApprovalStatuses::all();
		$banktransferapprovalsdata['users']=Users::all();
		$banktransferapprovalsdata['usersaccounts']=UsersAccounts::all();
		$banktransferapprovals->bank_transfer=$request->get('bank_transfer');
		$banktransferapprovals->approval_level=$request->get('approval_level');
		$banktransferapprovals->approval_status=$request->get('approval_status');
		$banktransferapprovals->approved_by=$request->get('approved_by');
		$banktransferapprovals->user_account=$request->get('user_account');
		$banktransferapprovals->remarks=$request->get('remarks');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','BankTransferApprovals']])->get();
		$banktransferapprovalsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($banktransferapprovalsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('banktransferapprovalsdata'));
		}else{
		$banktransferapprovals->save();
		$banktransferapprovalsdata['data']=BankTransferApprovals::find($id);
		return view('admin.bank_transfer_approvals.edit',compact('banktransferapprovalsdata','id'));
		}
	}

	public function destroy($id){
		$banktransferapprovals=BankTransferApprovals::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','BankTransferApprovals']])->get();
		$banktransferapprovalsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($banktransferapprovalsdata['usersaccountsroles'][0]) && $banktransferapprovalsdata['usersaccountsroles'][0]['_delete']==1){
			$banktransferapprovals->delete();
		}return redirect('admin/banktransferapprovals')->with('success','bank transfer approvals has been deleted!');
	}
}