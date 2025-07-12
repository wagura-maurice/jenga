<?php
/**
* @author  Wanjala Innocent Khaemba
*Controller - (manages clearing fee approvals data)
*/
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\ClearingFeeApprovals;
use App\Companies;
use App\Modules;
use App\Users;
use App\ClearingFeePayments;
use App\ApprovalLevels;
use App\TransactionStatuses;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;
class ClearingFeeApprovalsController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$clearingfeeapprovalsdata['clearingfeepayments']=ClearingFeePayments::all();
		$clearingfeeapprovalsdata['approvallevels']=ApprovalLevels::all();
		$clearingfeeapprovalsdata['users']=Users::all();
		$clearingfeeapprovalsdata['transactionstatuses']=TransactionStatuses::all();
		$clearingfeeapprovalsdata['list']=ClearingFeeApprovals::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ClearingFeeApprovals']])->get();
		$clearingfeeapprovalsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($clearingfeeapprovalsdata['usersaccountsroles'][0]['_add']==0&&$clearingfeeapprovalsdata['usersaccountsroles'][0]['_list']==0&&$clearingfeeapprovalsdata['usersaccountsroles'][0]['_edit']==0&&$clearingfeeapprovalsdata['usersaccountsroles'][0]['_edit']==0&&$clearingfeeapprovalsdata['usersaccountsroles'][0]['_show']==0&&$clearingfeeapprovalsdata['usersaccountsroles'][0]['_delete']==0&&$clearingfeeapprovalsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('clearingfeeapprovalsdata'));
		}else{
			return view('admin.clearing_fee_approvals.index',compact('clearingfeeapprovalsdata'));
		}
	}

	public function create(){
		$clearingfeeapprovalsdata;
		$clearingfeeapprovalsdata['clearingfeepayments']=ClearingFeePayments::all();
		$clearingfeeapprovalsdata['approvallevels']=ApprovalLevels::all();
		$clearingfeeapprovalsdata['users']=Users::all();
		$clearingfeeapprovalsdata['transactionstatuses']=TransactionStatuses::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ClearingFeeApprovals']])->get();
		$clearingfeeapprovalsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($clearingfeeapprovalsdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('clearingfeeapprovalsdata'));
		}else{
			return view('admin.clearing_fee_approvals.create',compact('clearingfeeapprovalsdata'));
		}
	}

	public function filter(Request $request){
		$clearingfeeapprovalsdata['clearingfeepayments']=ClearingFeePayments::all();
		$clearingfeeapprovalsdata['approvallevels']=ApprovalLevels::all();
		$clearingfeeapprovalsdata['users']=Users::all();
		$clearingfeeapprovalsdata['transactionstatuses']=TransactionStatuses::all();
		$clearingfeeapprovalsdata['list']=ClearingFeeApprovals::where([['transaction_reference','LIKE','%'.$request->get('transaction_reference').'%'],['approval_level','LIKE','%'.$request->get('approval_level').'%'],['approved_by','LIKE','%'.$request->get('approved_by').'%'],['approval_status','LIKE','%'.$request->get('approval_status').'%'],])->orWhereBetween('date',[$request->get('datefrom'),$request->get('dateto')])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ClearingFeeApprovals']])->get();
		$clearingfeeapprovalsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($clearingfeeapprovalsdata['usersaccountsroles'][0]['_add']==0&&$clearingfeeapprovalsdata['usersaccountsroles'][0]['_list']==0&&$clearingfeeapprovalsdata['usersaccountsroles'][0]['_edit']==0&&$clearingfeeapprovalsdata['usersaccountsroles'][0]['_edit']==0&&$clearingfeeapprovalsdata['usersaccountsroles'][0]['_show']==0&&$clearingfeeapprovalsdata['usersaccountsroles'][0]['_delete']==0&&$clearingfeeapprovalsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('clearingfeeapprovalsdata'));
		}else{
			return view('admin.clearing_fee_approvals.index',compact('clearingfeeapprovalsdata'));
		}
	}

	public function report(){
		$clearingfeeapprovalsdata['company']=Companies::all();
		$clearingfeeapprovalsdata['list']=ClearingFeeApprovals::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ClearingFeeApprovals']])->get();
		$clearingfeeapprovalsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($clearingfeeapprovalsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('clearingfeeapprovalsdata'));
		}else{
			return view('admin.clearing_fee_approvals.report',compact('clearingfeeapprovalsdata'));
		}
	}

	public function chart(){
		return view('admin.clearing_fee_approvals.chart');
	}

	public function store(Request $request){
		$clearingfeeapprovals=new ClearingFeeApprovals();
		$clearingfeeapprovals->transaction_reference=$request->get('transaction_reference');
		$clearingfeeapprovals->approval_level=$request->get('approval_level');
		$clearingfeeapprovals->approved_by=$request->get('approved_by');
		$clearingfeeapprovals->approval_status=$request->get('approval_status');
		$clearingfeeapprovals->date=$request->get('date');
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ClearingFeeApprovals']])->get();
		$clearingfeeapprovalsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($clearingfeeapprovalsdata['usersaccountsroles'][0]['_show']==1){
			try{
				if($clearingfeeapprovals->save()){
					$response['status']='1';
					$response['message']='clearing fee approvals Added successfully';
					return json_encode($response);
			}else{
					$response['status']='0';
					$response['message']='Failed to add clearing fee approvals. Please try again';
					return json_encode($response);
				}
			}
			catch(Exception $e){
					$response['status']='0';
					$response['message']='An Error occured while attempting to add clearing fee approvals. Please try again';
					return json_encode($response);
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$clearingfeeapprovalsdata['clearingfeepayments']=ClearingFeePayments::all();
		$clearingfeeapprovalsdata['approvallevels']=ApprovalLevels::all();
		$clearingfeeapprovalsdata['users']=Users::all();
		$clearingfeeapprovalsdata['transactionstatuses']=TransactionStatuses::all();
		$clearingfeeapprovalsdata['data']=ClearingFeeApprovals::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ClearingFeeApprovals']])->get();
		$clearingfeeapprovalsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($clearingfeeapprovalsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('clearingfeeapprovalsdata'));
		}else{
		return view('admin.clearing_fee_approvals.edit',compact('clearingfeeapprovalsdata','id'));
		}
	}

	public function show($id){
		$clearingfeeapprovalsdata['clearingfeepayments']=ClearingFeePayments::all();
		$clearingfeeapprovalsdata['approvallevels']=ApprovalLevels::all();
		$clearingfeeapprovalsdata['users']=Users::all();
		$clearingfeeapprovalsdata['transactionstatuses']=TransactionStatuses::all();
		$clearingfeeapprovalsdata['data']=ClearingFeeApprovals::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ClearingFeeApprovals']])->get();
		$clearingfeeapprovalsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($clearingfeeapprovalsdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('clearingfeeapprovalsdata'));
		}else{
		return view('admin.clearing_fee_approvals.show',compact('clearingfeeapprovalsdata','id'));
		}
	}

	public function update(Request $request,$id){
		$clearingfeeapprovals=ClearingFeeApprovals::find($id);
		$clearingfeeapprovalsdata['clearingfeepayments']=ClearingFeePayments::all();
		$clearingfeeapprovalsdata['approvallevels']=ApprovalLevels::all();
		$clearingfeeapprovalsdata['users']=Users::all();
		$clearingfeeapprovalsdata['transactionstatuses']=TransactionStatuses::all();
		$clearingfeeapprovals->transaction_reference=$request->get('transaction_reference');
		$clearingfeeapprovals->approval_level=$request->get('approval_level');
		$clearingfeeapprovals->approved_by=$request->get('approved_by');
		$clearingfeeapprovals->approval_status=$request->get('approval_status');
		$clearingfeeapprovals->date=$request->get('date');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ClearingFeeApprovals']])->get();
		$clearingfeeapprovalsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($clearingfeeapprovalsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('clearingfeeapprovalsdata'));
		}else{
		$clearingfeeapprovals->save();
		$clearingfeeapprovalsdata['data']=ClearingFeeApprovals::find($id);
		return view('admin.clearing_fee_approvals.edit',compact('clearingfeeapprovalsdata','id'));
		}
	}

	public function destroy($id){
		$clearingfeeapprovals=ClearingFeeApprovals::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ClearingFeeApprovals']])->get();
		$clearingfeeapprovalsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($clearingfeeapprovalsdata['usersaccountsroles'][0]['_delete']==1){
			$clearingfeeapprovals->delete();
		}return redirect('admin/clearingfeeapprovals')->with('success','clearing fee approvals has been deleted!');
	}
}