<?php
/**
* @author  Wanjala Innocent Khaemba
*Controller - (loan transfer approvals)
*/
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\LoanTransferApprovals;
use App\Companies;
use App\Modules;
use App\Users;
use App\LgfToLoanTransfers;
use App\ApprovalLevels;
use App\ApprovalStatuses;
use App\UsersAccounts;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;
class LoanTransferApprovalsController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$loantransferapprovalsdata['lgftoloantransfers']=LgfToLoanTransfers::all();
		$loantransferapprovalsdata['approvallevels']=ApprovalLevels::all();
		$loantransferapprovalsdata['approvalstatuses']=ApprovalStatuses::all();
		$loantransferapprovalsdata['users']=Users::all();
		$loantransferapprovalsdata['usersaccounts']=UsersAccounts::all();
		$loantransferapprovalsdata['list']=LoanTransferApprovals::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LoanTransferApprovals']])->get();
		$loantransferapprovalsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($loantransferapprovalsdata['usersaccountsroles'][0]) && $loantransferapprovalsdata['usersaccountsroles'][0]['_add']==0&&$loantransferapprovalsdata['usersaccountsroles'][0]['_list']==0&&$loantransferapprovalsdata['usersaccountsroles'][0]['_edit']==0&&$loantransferapprovalsdata['usersaccountsroles'][0]['_edit']==0&&$loantransferapprovalsdata['usersaccountsroles'][0]['_show']==0&&$loantransferapprovalsdata['usersaccountsroles'][0]['_delete']==0&&$loantransferapprovalsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('loantransferapprovalsdata'));
		}else{
			return view('admin.loan_transfer_approvals.index',compact('loantransferapprovalsdata'));
		}
	}

	public function create(){
		$loantransferapprovalsdata;
		$loantransferapprovalsdata['lgftoloantransfers']=LgfToLoanTransfers::all();
		$loantransferapprovalsdata['approvallevels']=ApprovalLevels::all();
		$loantransferapprovalsdata['approvalstatuses']=ApprovalStatuses::all();
		$loantransferapprovalsdata['users']=Users::all();
		$loantransferapprovalsdata['usersaccounts']=UsersAccounts::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LoanTransferApprovals']])->get();
		$loantransferapprovalsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($loantransferapprovalsdata['usersaccountsroles'][0]) && $loantransferapprovalsdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('loantransferapprovalsdata'));
		}else{
			return view('admin.loan_transfer_approvals.create',compact('loantransferapprovalsdata'));
		}
	}

	public function filter(Request $request){
		$loantransferapprovalsdata['lgftoloantransfers']=LgfToLoanTransfers::all();
		$loantransferapprovalsdata['approvallevels']=ApprovalLevels::all();
		$loantransferapprovalsdata['approvalstatuses']=ApprovalStatuses::all();
		$loantransferapprovalsdata['users']=Users::all();
		$loantransferapprovalsdata['usersaccounts']=UsersAccounts::all();
		$loantransferapprovalsdata['list']=LoanTransferApprovals::where([['loan_transfer','LIKE','%'.$request->get('loan_transfer').'%'],['approval_level','LIKE','%'.$request->get('approval_level').'%'],['approval_status','LIKE','%'.$request->get('approval_status').'%'],['remarks','LIKE','%'.$request->get('remarks').'%'],['approved_by','LIKE','%'.$request->get('approved_by').'%'],['users_accounts','LIKE','%'.$request->get('users_accounts').'%'],])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LoanTransferApprovals']])->get();
		$loantransferapprovalsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($loantransferapprovalsdata['usersaccountsroles'][0]) && $loantransferapprovalsdata['usersaccountsroles'][0]['_add']==0&&$loantransferapprovalsdata['usersaccountsroles'][0]['_list']==0&&$loantransferapprovalsdata['usersaccountsroles'][0]['_edit']==0&&$loantransferapprovalsdata['usersaccountsroles'][0]['_edit']==0&&$loantransferapprovalsdata['usersaccountsroles'][0]['_show']==0&&$loantransferapprovalsdata['usersaccountsroles'][0]['_delete']==0&&$loantransferapprovalsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('loantransferapprovalsdata'));
		}else{
			return view('admin.loan_transfer_approvals.index',compact('loantransferapprovalsdata'));
		}
	}

	public function report(){
		$loantransferapprovalsdata['company']=Companies::all();
		$loantransferapprovalsdata['list']=LoanTransferApprovals::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LoanTransferApprovals']])->get();
		$loantransferapprovalsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($loantransferapprovalsdata['usersaccountsroles'][0]) && $loantransferapprovalsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('loantransferapprovalsdata'));
		}else{
			return view('admin.loan_transfer_approvals.report',compact('loantransferapprovalsdata'));
		}
	}

	public function chart(){
		return view('admin.loan_transfer_approvals.chart');
	}

	public function store(Request $request){
		$loantransferapprovals=new LoanTransferApprovals();
		$loantransferapprovals->loan_transfer=$request->get('loan_transfer');
		$loantransferapprovals->approval_level=$request->get('approval_level');
		$loantransferapprovals->approval_status=$request->get('approval_status');
		$loantransferapprovals->remarks=$request->get('remarks');
		$loantransferapprovals->approved_by=$request->get('approved_by');
		$loantransferapprovals->users_accounts=$request->get('users_accounts');
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LoanTransferApprovals']])->get();
		$loantransferapprovalsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($loantransferapprovalsdata['usersaccountsroles'][0]) && $loantransferapprovalsdata['usersaccountsroles'][0]['_show']==1){
			try{
				if($loantransferapprovals->save()){
					$response['status']='1';
					$response['message']='loan transfer approvals Added successfully';
					return json_encode($response);
			}else{
					$response['status']='0';
					$response['message']='Failed to add loan transfer approvals. Please try again';
					return json_encode($response);
				}
			}
			catch(Exception $e){
					$response['status']='0';
					$response['message']='An Error occured while attempting to add loan transfer approvals. Please try again';
					return json_encode($response);
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$loantransferapprovalsdata['lgftoloantransfers']=LgfToLoanTransfers::all();
		$loantransferapprovalsdata['approvallevels']=ApprovalLevels::all();
		$loantransferapprovalsdata['approvalstatuses']=ApprovalStatuses::all();
		$loantransferapprovalsdata['users']=Users::all();
		$loantransferapprovalsdata['usersaccounts']=UsersAccounts::all();
		$loantransferapprovalsdata['data']=LoanTransferApprovals::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LoanTransferApprovals']])->get();
		$loantransferapprovalsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($loantransferapprovalsdata['usersaccountsroles'][0]) && $loantransferapprovalsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('loantransferapprovalsdata'));
		}else{
		return view('admin.loan_transfer_approvals.edit',compact('loantransferapprovalsdata','id'));
		}
	}

	public function show($id){
		$loantransferapprovalsdata['lgftoloantransfers']=LgfToLoanTransfers::all();
		$loantransferapprovalsdata['approvallevels']=ApprovalLevels::all();
		$loantransferapprovalsdata['approvalstatuses']=ApprovalStatuses::all();
		$loantransferapprovalsdata['users']=Users::all();
		$loantransferapprovalsdata['usersaccounts']=UsersAccounts::all();
		$loantransferapprovalsdata['data']=LoanTransferApprovals::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LoanTransferApprovals']])->get();
		$loantransferapprovalsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($loantransferapprovalsdata['usersaccountsroles'][0]) && $loantransferapprovalsdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('loantransferapprovalsdata'));
		}else{
		return view('admin.loan_transfer_approvals.show',compact('loantransferapprovalsdata','id'));
		}
	}

	public function update(Request $request,$id){
		$loantransferapprovals=LoanTransferApprovals::find($id);
		$loantransferapprovalsdata['lgftoloantransfers']=LgfToLoanTransfers::all();
		$loantransferapprovalsdata['approvallevels']=ApprovalLevels::all();
		$loantransferapprovalsdata['approvalstatuses']=ApprovalStatuses::all();
		$loantransferapprovalsdata['users']=Users::all();
		$loantransferapprovalsdata['usersaccounts']=UsersAccounts::all();
		$loantransferapprovals->loan_transfer=$request->get('loan_transfer');
		$loantransferapprovals->approval_level=$request->get('approval_level');
		$loantransferapprovals->approval_status=$request->get('approval_status');
		$loantransferapprovals->remarks=$request->get('remarks');
		$loantransferapprovals->approved_by=$request->get('approved_by');
		$loantransferapprovals->users_accounts=$request->get('users_accounts');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LoanTransferApprovals']])->get();
		$loantransferapprovalsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($loantransferapprovalsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('loantransferapprovalsdata'));
		}else{
		$loantransferapprovals->save();
		$loantransferapprovalsdata['data']=LoanTransferApprovals::find($id);
		return view('admin.loan_transfer_approvals.edit',compact('loantransferapprovalsdata','id'));
		}
	}

	public function destroy($id){
		$loantransferapprovals=LoanTransferApprovals::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LoanTransferApprovals']])->get();
		$loantransferapprovalsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($loantransferapprovalsdata['usersaccountsroles'][0]) && $loantransferapprovalsdata['usersaccountsroles'][0]['_delete']==1){
			$loantransferapprovals->delete();
		}return redirect('admin/loantransferapprovals')->with('success','loan transfer approvals has been deleted!');
	}
}