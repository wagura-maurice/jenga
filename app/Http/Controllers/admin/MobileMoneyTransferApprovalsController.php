<?php
/**
* @author  Wanjala Innocent Khaemba
*Controller - (mobile money transfer approvals)
*/
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\MobileMoneyTransferApprovals;
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
class MobileMoneyTransferApprovalsController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$mobilemoneytransferapprovalsdata['lgftomobilemoneytransfers']=LgfToMobileMoneyTransfers::all();
		$mobilemoneytransferapprovalsdata['approvallevels']=ApprovalLevels::all();
		$mobilemoneytransferapprovalsdata['approvalstatuses']=ApprovalStatuses::all();
		$mobilemoneytransferapprovalsdata['users']=Users::all();
		$mobilemoneytransferapprovalsdata['usersaccounts']=UsersAccounts::all();
		$mobilemoneytransferapprovalsdata['list']=MobileMoneyTransferApprovals::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','MobileMoneyTransferApprovals']])->get();
		$mobilemoneytransferapprovalsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($mobilemoneytransferapprovalsdata['usersaccountsroles'][0]) && $mobilemoneytransferapprovalsdata['usersaccountsroles'][0]['_add']==0&&$mobilemoneytransferapprovalsdata['usersaccountsroles'][0]['_list']==0&&$mobilemoneytransferapprovalsdata['usersaccountsroles'][0]['_edit']==0&&$mobilemoneytransferapprovalsdata['usersaccountsroles'][0]['_edit']==0&&$mobilemoneytransferapprovalsdata['usersaccountsroles'][0]['_show']==0&&$mobilemoneytransferapprovalsdata['usersaccountsroles'][0]['_delete']==0&&$mobilemoneytransferapprovalsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('mobilemoneytransferapprovalsdata'));
		}else{
			return view('admin.mobile_money_transfer_approvals.index',compact('mobilemoneytransferapprovalsdata'));
		}
	}

	public function create(){
		$mobilemoneytransferapprovalsdata;
		$mobilemoneytransferapprovalsdata['lgftomobilemoneytransfers']=LgfToMobileMoneyTransfers::all();
		$mobilemoneytransferapprovalsdata['approvallevels']=ApprovalLevels::all();
		$mobilemoneytransferapprovalsdata['approvalstatuses']=ApprovalStatuses::all();
		$mobilemoneytransferapprovalsdata['users']=Users::all();
		$mobilemoneytransferapprovalsdata['usersaccounts']=UsersAccounts::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','MobileMoneyTransferApprovals']])->get();
		$mobilemoneytransferapprovalsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($mobilemoneytransferapprovalsdata['usersaccountsroles'][0]) && $mobilemoneytransferapprovalsdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('mobilemoneytransferapprovalsdata'));
		}else{
			return view('admin.mobile_money_transfer_approvals.create',compact('mobilemoneytransferapprovalsdata'));
		}
	}

	public function filter(Request $request){
		$mobilemoneytransferapprovalsdata['lgftomobilemoneytransfers']=LgfToMobileMoneyTransfers::all();
		$mobilemoneytransferapprovalsdata['approvallevels']=ApprovalLevels::all();
		$mobilemoneytransferapprovalsdata['approvalstatuses']=ApprovalStatuses::all();
		$mobilemoneytransferapprovalsdata['users']=Users::all();
		$mobilemoneytransferapprovalsdata['usersaccounts']=UsersAccounts::all();
		$mobilemoneytransferapprovalsdata['list']=MobileMoneyTransferApprovals::where([['mobile_money_transfer','LIKE','%'.$request->get('mobile_money_transfer').'%'],['approval_level','LIKE','%'.$request->get('approval_level').'%'],['approval_status','LIKE','%'.$request->get('approval_status').'%'],['approved_by','LIKE','%'.$request->get('approved_by').'%'],['user_account','LIKE','%'.$request->get('user_account').'%'],['remarks','LIKE','%'.$request->get('remarks').'%'],])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','MobileMoneyTransferApprovals']])->get();
		$mobilemoneytransferapprovalsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($mobilemoneytransferapprovalsdata['usersaccountsroles'][0]) && $mobilemoneytransferapprovalsdata['usersaccountsroles'][0]['_add']==0&&$mobilemoneytransferapprovalsdata['usersaccountsroles'][0]['_list']==0&&$mobilemoneytransferapprovalsdata['usersaccountsroles'][0]['_edit']==0&&$mobilemoneytransferapprovalsdata['usersaccountsroles'][0]['_edit']==0&&$mobilemoneytransferapprovalsdata['usersaccountsroles'][0]['_show']==0&&$mobilemoneytransferapprovalsdata['usersaccountsroles'][0]['_delete']==0&&$mobilemoneytransferapprovalsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('mobilemoneytransferapprovalsdata'));
		}else{
			return view('admin.mobile_money_transfer_approvals.index',compact('mobilemoneytransferapprovalsdata'));
		}
	}

	public function report(){
		$mobilemoneytransferapprovalsdata['company']=Companies::all();
		$mobilemoneytransferapprovalsdata['list']=MobileMoneyTransferApprovals::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','MobileMoneyTransferApprovals']])->get();
		$mobilemoneytransferapprovalsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($mobilemoneytransferapprovalsdata['usersaccountsroles'][0]) && $mobilemoneytransferapprovalsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('mobilemoneytransferapprovalsdata'));
		}else{
			return view('admin.mobile_money_transfer_approvals.report',compact('mobilemoneytransferapprovalsdata'));
		}
	}

	public function chart(){
		return view('admin.mobile_money_transfer_approvals.chart');
	}

	public function store(Request $request){
		$mobilemoneytransferapprovals=new MobileMoneyTransferApprovals();
		$mobilemoneytransferapprovals->mobile_money_transfer=$request->get('mobile_money_transfer');
		$mobilemoneytransferapprovals->approval_level=$request->get('approval_level');
		$mobilemoneytransferapprovals->approval_status=$request->get('approval_status');
		$mobilemoneytransferapprovals->approved_by=$request->get('approved_by');
		$mobilemoneytransferapprovals->user_account=$request->get('user_account');
		$mobilemoneytransferapprovals->remarks=$request->get('remarks');
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','MobileMoneyTransferApprovals']])->get();
		$mobilemoneytransferapprovalsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($mobilemoneytransferapprovalsdata['usersaccountsroles'][0]) && $mobilemoneytransferapprovalsdata['usersaccountsroles'][0]['_show']==1){
			try{
				if($mobilemoneytransferapprovals->save()){
					$response['status']='1';
					$response['message']='mobile money transfer approvals Added successfully';
					return json_encode($response);
			}else{
					$response['status']='0';
					$response['message']='Failed to add mobile money transfer approvals. Please try again';
					return json_encode($response);
				}
			}
			catch(Exception $e){
					$response['status']='0';
					$response['message']='An Error occured while attempting to add mobile money transfer approvals. Please try again';
					return json_encode($response);
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$mobilemoneytransferapprovalsdata['lgftomobilemoneytransfers']=LgfToMobileMoneyTransfers::all();
		$mobilemoneytransferapprovalsdata['approvallevels']=ApprovalLevels::all();
		$mobilemoneytransferapprovalsdata['approvalstatuses']=ApprovalStatuses::all();
		$mobilemoneytransferapprovalsdata['users']=Users::all();
		$mobilemoneytransferapprovalsdata['usersaccounts']=UsersAccounts::all();
		$mobilemoneytransferapprovalsdata['data']=MobileMoneyTransferApprovals::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','MobileMoneyTransferApprovals']])->get();
		$mobilemoneytransferapprovalsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($mobilemoneytransferapprovalsdata['usersaccountsroles'][0]) && $mobilemoneytransferapprovalsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('mobilemoneytransferapprovalsdata'));
		}else{
		return view('admin.mobile_money_transfer_approvals.edit',compact('mobilemoneytransferapprovalsdata','id'));
		}
	}

	public function show($id){
		$mobilemoneytransferapprovalsdata['lgftomobilemoneytransfers']=LgfToMobileMoneyTransfers::all();
		$mobilemoneytransferapprovalsdata['approvallevels']=ApprovalLevels::all();
		$mobilemoneytransferapprovalsdata['approvalstatuses']=ApprovalStatuses::all();
		$mobilemoneytransferapprovalsdata['users']=Users::all();
		$mobilemoneytransferapprovalsdata['usersaccounts']=UsersAccounts::all();
		$mobilemoneytransferapprovalsdata['data']=MobileMoneyTransferApprovals::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','MobileMoneyTransferApprovals']])->get();
		$mobilemoneytransferapprovalsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($mobilemoneytransferapprovalsdata['usersaccountsroles'][0]) && $mobilemoneytransferapprovalsdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('mobilemoneytransferapprovalsdata'));
		}else{
		return view('admin.mobile_money_transfer_approvals.show',compact('mobilemoneytransferapprovalsdata','id'));
		}
	}

	public function update(Request $request,$id){
		$mobilemoneytransferapprovals=MobileMoneyTransferApprovals::find($id);
		$mobilemoneytransferapprovalsdata['lgftomobilemoneytransfers']=LgfToMobileMoneyTransfers::all();
		$mobilemoneytransferapprovalsdata['approvallevels']=ApprovalLevels::all();
		$mobilemoneytransferapprovalsdata['approvalstatuses']=ApprovalStatuses::all();
		$mobilemoneytransferapprovalsdata['users']=Users::all();
		$mobilemoneytransferapprovalsdata['usersaccounts']=UsersAccounts::all();
		$mobilemoneytransferapprovals->mobile_money_transfer=$request->get('mobile_money_transfer');
		$mobilemoneytransferapprovals->approval_level=$request->get('approval_level');
		$mobilemoneytransferapprovals->approval_status=$request->get('approval_status');
		$mobilemoneytransferapprovals->approved_by=$request->get('approved_by');
		$mobilemoneytransferapprovals->user_account=$request->get('user_account');
		$mobilemoneytransferapprovals->remarks=$request->get('remarks');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','MobileMoneyTransferApprovals']])->get();
		$mobilemoneytransferapprovalsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($mobilemoneytransferapprovalsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('mobilemoneytransferapprovalsdata'));
		}else{
		$mobilemoneytransferapprovals->save();
		$mobilemoneytransferapprovalsdata['data']=MobileMoneyTransferApprovals::find($id);
		return view('admin.mobile_money_transfer_approvals.edit',compact('mobilemoneytransferapprovalsdata','id'));
		}
	}

	public function destroy($id){
		$mobilemoneytransferapprovals=MobileMoneyTransferApprovals::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','MobileMoneyTransferApprovals']])->get();
		$mobilemoneytransferapprovalsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($mobilemoneytransferapprovalsdata['usersaccountsroles'][0]) && $mobilemoneytransferapprovalsdata['usersaccountsroles'][0]['_delete']==1){
			$mobilemoneytransferapprovals->delete();
		}return redirect('admin/mobilemoneytransferapprovals')->with('success','mobile money transfer approvals has been deleted!');
	}
}