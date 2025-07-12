<?php
/**
* @author  Wanjala Innocent Khaemba
*Controller - (manages processing fee approvals data)
*/
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\ProcessingFeeApprovals;
use App\Companies;
use App\Modules;
use App\Users;
use App\ProcessingFeePayments;
use App\ApprovalLevels;
use App\TransactionStatuses;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;
class ProcessingFeeApprovalsController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$processingfeeapprovalsdata['processingfeepayments']=ProcessingFeePayments::all();
		$processingfeeapprovalsdata['approvallevels']=ApprovalLevels::all();
		$processingfeeapprovalsdata['users']=Users::all();
		$processingfeeapprovalsdata['transactionstatuses']=TransactionStatuses::all();
		$processingfeeapprovalsdata['list']=ProcessingFeeApprovals::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ProcessingFeeApprovals']])->get();
		$processingfeeapprovalsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($processingfeeapprovalsdata['usersaccountsroles'][0]['_add']==0&&$processingfeeapprovalsdata['usersaccountsroles'][0]['_list']==0&&$processingfeeapprovalsdata['usersaccountsroles'][0]['_edit']==0&&$processingfeeapprovalsdata['usersaccountsroles'][0]['_edit']==0&&$processingfeeapprovalsdata['usersaccountsroles'][0]['_show']==0&&$processingfeeapprovalsdata['usersaccountsroles'][0]['_delete']==0&&$processingfeeapprovalsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('processingfeeapprovalsdata'));
		}else{
			return view('admin.processing_fee_approvals.index',compact('processingfeeapprovalsdata'));
		}
	}

	public function create(){
		$processingfeeapprovalsdata;
		$processingfeeapprovalsdata['processingfeepayments']=ProcessingFeePayments::all();
		$processingfeeapprovalsdata['approvallevels']=ApprovalLevels::all();
		$processingfeeapprovalsdata['users']=Users::all();
		$processingfeeapprovalsdata['transactionstatuses']=TransactionStatuses::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ProcessingFeeApprovals']])->get();
		$processingfeeapprovalsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($processingfeeapprovalsdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('processingfeeapprovalsdata'));
		}else{
			return view('admin.processing_fee_approvals.create',compact('processingfeeapprovalsdata'));
		}
	}

	public function filter(Request $request){
		$processingfeeapprovalsdata['processingfeepayments']=ProcessingFeePayments::all();
		$processingfeeapprovalsdata['approvallevels']=ApprovalLevels::all();
		$processingfeeapprovalsdata['users']=Users::all();
		$processingfeeapprovalsdata['transactionstatuses']=TransactionStatuses::all();
		$processingfeeapprovalsdata['list']=ProcessingFeeApprovals::where([['transaction_reference','LIKE','%'.$request->get('transaction_reference').'%'],['approval_level','LIKE','%'.$request->get('approval_level').'%'],['approved_by','LIKE','%'.$request->get('approved_by').'%'],['approval_status','LIKE','%'.$request->get('approval_status').'%'],])->orWhereBetween('date',[$request->get('datefrom'),$request->get('dateto')])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ProcessingFeeApprovals']])->get();
		$processingfeeapprovalsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($processingfeeapprovalsdata['usersaccountsroles'][0]['_add']==0&&$processingfeeapprovalsdata['usersaccountsroles'][0]['_list']==0&&$processingfeeapprovalsdata['usersaccountsroles'][0]['_edit']==0&&$processingfeeapprovalsdata['usersaccountsroles'][0]['_edit']==0&&$processingfeeapprovalsdata['usersaccountsroles'][0]['_show']==0&&$processingfeeapprovalsdata['usersaccountsroles'][0]['_delete']==0&&$processingfeeapprovalsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('processingfeeapprovalsdata'));
		}else{
			return view('admin.processing_fee_approvals.index',compact('processingfeeapprovalsdata'));
		}
	}

	public function report(){
		$processingfeeapprovalsdata['company']=Companies::all();
		$processingfeeapprovalsdata['list']=ProcessingFeeApprovals::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ProcessingFeeApprovals']])->get();
		$processingfeeapprovalsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($processingfeeapprovalsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('processingfeeapprovalsdata'));
		}else{
			return view('admin.processing_fee_approvals.report',compact('processingfeeapprovalsdata'));
		}
	}

	public function chart(){
		return view('admin.processing_fee_approvals.chart');
	}

	public function store(Request $request){
		$processingfeeapprovals=new ProcessingFeeApprovals();
		$processingfeeapprovals->transaction_reference=$request->get('transaction_reference');
		$processingfeeapprovals->approval_level=$request->get('approval_level');
		$processingfeeapprovals->approved_by=$request->get('approved_by');
		$processingfeeapprovals->approval_status=$request->get('approval_status');
		$processingfeeapprovals->date=$request->get('date');
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ProcessingFeeApprovals']])->get();
		$processingfeeapprovalsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($processingfeeapprovalsdata['usersaccountsroles'][0]['_show']==1){
			try{
				if($processingfeeapprovals->save()){
					$response['status']='1';
					$response['message']='processing fee approvals Added successfully';
					return json_encode($response);
			}else{
					$response['status']='0';
					$response['message']='Failed to add processing fee approvals. Please try again';
					return json_encode($response);
				}
			}
			catch(Exception $e){
					$response['status']='0';
					$response['message']='An Error occured while attempting to add processing fee approvals. Please try again';
					return json_encode($response);
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$processingfeeapprovalsdata['processingfeepayments']=ProcessingFeePayments::all();
		$processingfeeapprovalsdata['approvallevels']=ApprovalLevels::all();
		$processingfeeapprovalsdata['users']=Users::all();
		$processingfeeapprovalsdata['transactionstatuses']=TransactionStatuses::all();
		$processingfeeapprovalsdata['data']=ProcessingFeeApprovals::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ProcessingFeeApprovals']])->get();
		$processingfeeapprovalsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($processingfeeapprovalsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('processingfeeapprovalsdata'));
		}else{
		return view('admin.processing_fee_approvals.edit',compact('processingfeeapprovalsdata','id'));
		}
	}

	public function show($id){
		$processingfeeapprovalsdata['processingfeepayments']=ProcessingFeePayments::all();
		$processingfeeapprovalsdata['approvallevels']=ApprovalLevels::all();
		$processingfeeapprovalsdata['users']=Users::all();
		$processingfeeapprovalsdata['transactionstatuses']=TransactionStatuses::all();
		$processingfeeapprovalsdata['data']=ProcessingFeeApprovals::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ProcessingFeeApprovals']])->get();
		$processingfeeapprovalsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($processingfeeapprovalsdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('processingfeeapprovalsdata'));
		}else{
		return view('admin.processing_fee_approvals.show',compact('processingfeeapprovalsdata','id'));
		}
	}

	public function update(Request $request,$id){
		$processingfeeapprovals=ProcessingFeeApprovals::find($id);
		$processingfeeapprovalsdata['processingfeepayments']=ProcessingFeePayments::all();
		$processingfeeapprovalsdata['approvallevels']=ApprovalLevels::all();
		$processingfeeapprovalsdata['users']=Users::all();
		$processingfeeapprovalsdata['transactionstatuses']=TransactionStatuses::all();
		$processingfeeapprovals->transaction_reference=$request->get('transaction_reference');
		$processingfeeapprovals->approval_level=$request->get('approval_level');
		$processingfeeapprovals->approved_by=$request->get('approved_by');
		$processingfeeapprovals->approval_status=$request->get('approval_status');
		$processingfeeapprovals->date=$request->get('date');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ProcessingFeeApprovals']])->get();
		$processingfeeapprovalsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($processingfeeapprovalsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('processingfeeapprovalsdata'));
		}else{
		$processingfeeapprovals->save();
		$processingfeeapprovalsdata['data']=ProcessingFeeApprovals::find($id);
		return view('admin.processing_fee_approvals.edit',compact('processingfeeapprovalsdata','id'));
		}
	}

	public function destroy($id){
		$processingfeeapprovals=ProcessingFeeApprovals::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ProcessingFeeApprovals']])->get();
		$processingfeeapprovalsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($processingfeeapprovalsdata['usersaccountsroles'][0]['_delete']==1){
			$processingfeeapprovals->delete();
		}return redirect('admin/processingfeeapprovals')->with('success','processing fee approvals has been deleted!');
	}
}