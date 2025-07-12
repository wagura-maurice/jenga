<?php
/**
* @author  Wanjala Innocent Khaemba
*Controller - (manages insurance deduction approvals data)
*/
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\InsuranceDeductionApprovals;
use App\Companies;
use App\Modules;
use App\InsuranceDeductionPayments;
use App\ApprovalLevels;
use App\Users;
use App\TransactionStatuses;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;
class InsuranceDeductionApprovalsController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$insurancedeductionapprovalsdata['insurancedeductionpayments']=InsuranceDeductionPayments::all();
		$insurancedeductionapprovalsdata['approvallevels']=ApprovalLevels::all();
		$insurancedeductionapprovalsdata['users']=Users::all();
		$insurancedeductionapprovalsdata['transactionstatuses']=TransactionStatuses::all();
		$insurancedeductionapprovalsdata['list']=InsuranceDeductionApprovals::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','InsuranceDeductionApprovals']])->get();
		$insurancedeductionapprovalsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($insurancedeductionapprovalsdata['usersaccountsroles'][0]['_add']==0&&$insurancedeductionapprovalsdata['usersaccountsroles'][0]['_list']==0&&$insurancedeductionapprovalsdata['usersaccountsroles'][0]['_edit']==0&&$insurancedeductionapprovalsdata['usersaccountsroles'][0]['_edit']==0&&$insurancedeductionapprovalsdata['usersaccountsroles'][0]['_show']==0&&$insurancedeductionapprovalsdata['usersaccountsroles'][0]['_delete']==0&&$insurancedeductionapprovalsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('insurancedeductionapprovalsdata'));
		}else{
			return view('admin.insurance_deduction_approvals.index',compact('insurancedeductionapprovalsdata'));
		}
	}

	public function create(){
		$insurancedeductionapprovalsdata;
		$insurancedeductionapprovalsdata['insurancedeductionpayments']=InsuranceDeductionPayments::all();
		$insurancedeductionapprovalsdata['approvallevels']=ApprovalLevels::all();
		$insurancedeductionapprovalsdata['users']=Users::all();
		$insurancedeductionapprovalsdata['transactionstatuses']=TransactionStatuses::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','InsuranceDeductionApprovals']])->get();
		$insurancedeductionapprovalsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($insurancedeductionapprovalsdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('insurancedeductionapprovalsdata'));
		}else{
			return view('admin.insurance_deduction_approvals.create',compact('insurancedeductionapprovalsdata'));
		}
	}

	public function filter(Request $request){
		$insurancedeductionapprovalsdata['insurancedeductionpayments']=InsuranceDeductionPayments::all();
		$insurancedeductionapprovalsdata['approvallevels']=ApprovalLevels::all();
		$insurancedeductionapprovalsdata['users']=Users::all();
		$insurancedeductionapprovalsdata['transactionstatuses']=TransactionStatuses::all();
		$insurancedeductionapprovalsdata['list']=InsuranceDeductionApprovals::where([['transaction_reference','LIKE','%'.$request->get('transaction_reference').'%'],['approval_level','LIKE','%'.$request->get('approval_level').'%'],['approved_by','LIKE','%'.$request->get('approved_by').'%'],['approval_status','LIKE','%'.$request->get('approval_status').'%'],])->orWhereBetween('date',[$request->get('datefrom'),$request->get('dateto')])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','InsuranceDeductionApprovals']])->get();
		$insurancedeductionapprovalsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($insurancedeductionapprovalsdata['usersaccountsroles'][0]['_add']==0&&$insurancedeductionapprovalsdata['usersaccountsroles'][0]['_list']==0&&$insurancedeductionapprovalsdata['usersaccountsroles'][0]['_edit']==0&&$insurancedeductionapprovalsdata['usersaccountsroles'][0]['_edit']==0&&$insurancedeductionapprovalsdata['usersaccountsroles'][0]['_show']==0&&$insurancedeductionapprovalsdata['usersaccountsroles'][0]['_delete']==0&&$insurancedeductionapprovalsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('insurancedeductionapprovalsdata'));
		}else{
			return view('admin.insurance_deduction_approvals.index',compact('insurancedeductionapprovalsdata'));
		}
	}

	public function report(){
		$insurancedeductionapprovalsdata['company']=Companies::all();
		$insurancedeductionapprovalsdata['list']=InsuranceDeductionApprovals::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','InsuranceDeductionApprovals']])->get();
		$insurancedeductionapprovalsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($insurancedeductionapprovalsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('insurancedeductionapprovalsdata'));
		}else{
			return view('admin.insurance_deduction_approvals.report',compact('insurancedeductionapprovalsdata'));
		}
	}

	public function chart(){
		return view('admin.insurance_deduction_approvals.chart');
	}

	public function store(Request $request){
		$insurancedeductionapprovals=new InsuranceDeductionApprovals();
		$insurancedeductionapprovals->transaction_reference=$request->get('transaction_reference');
		$insurancedeductionapprovals->approval_level=$request->get('approval_level');
		$insurancedeductionapprovals->approved_by=$request->get('approved_by');
		$insurancedeductionapprovals->approval_status=$request->get('approval_status');
		$insurancedeductionapprovals->date=$request->get('date');
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','InsuranceDeductionApprovals']])->get();
		$insurancedeductionapprovalsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($insurancedeductionapprovalsdata['usersaccountsroles'][0]['_show']==1){
			try{
				if($insurancedeductionapprovals->save()){
					$response['status']='1';
					$response['message']='insurance deduction approvals Added successfully';
					return json_encode($response);
			}else{
					$response['status']='0';
					$response['message']='Failed to add insurance deduction approvals. Please try again';
					return json_encode($response);
				}
			}
			catch(Exception $e){
					$response['status']='0';
					$response['message']='An Error occured while attempting to add insurance deduction approvals. Please try again';
					return json_encode($response);
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$insurancedeductionapprovalsdata['insurancedeductionpayments']=InsuranceDeductionPayments::all();
		$insurancedeductionapprovalsdata['approvallevels']=ApprovalLevels::all();
		$insurancedeductionapprovalsdata['users']=Users::all();
		$insurancedeductionapprovalsdata['transactionstatuses']=TransactionStatuses::all();
		$insurancedeductionapprovalsdata['data']=InsuranceDeductionApprovals::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','InsuranceDeductionApprovals']])->get();
		$insurancedeductionapprovalsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($insurancedeductionapprovalsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('insurancedeductionapprovalsdata'));
		}else{
		return view('admin.insurance_deduction_approvals.edit',compact('insurancedeductionapprovalsdata','id'));
		}
	}

	public function show($id){
		$insurancedeductionapprovalsdata['insurancedeductionpayments']=InsuranceDeductionPayments::all();
		$insurancedeductionapprovalsdata['approvallevels']=ApprovalLevels::all();
		$insurancedeductionapprovalsdata['users']=Users::all();
		$insurancedeductionapprovalsdata['transactionstatuses']=TransactionStatuses::all();
		$insurancedeductionapprovalsdata['data']=InsuranceDeductionApprovals::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','InsuranceDeductionApprovals']])->get();
		$insurancedeductionapprovalsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($insurancedeductionapprovalsdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('insurancedeductionapprovalsdata'));
		}else{
		return view('admin.insurance_deduction_approvals.show',compact('insurancedeductionapprovalsdata','id'));
		}
	}

	public function update(Request $request,$id){
		$insurancedeductionapprovals=InsuranceDeductionApprovals::find($id);
		$insurancedeductionapprovalsdata['insurancedeductionpayments']=InsuranceDeductionPayments::all();
		$insurancedeductionapprovalsdata['approvallevels']=ApprovalLevels::all();
		$insurancedeductionapprovalsdata['users']=Users::all();
		$insurancedeductionapprovalsdata['transactionstatuses']=TransactionStatuses::all();
		$insurancedeductionapprovals->transaction_reference=$request->get('transaction_reference');
		$insurancedeductionapprovals->approval_level=$request->get('approval_level');
		$insurancedeductionapprovals->approved_by=$request->get('approved_by');
		$insurancedeductionapprovals->approval_status=$request->get('approval_status');
		$insurancedeductionapprovals->date=$request->get('date');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','InsuranceDeductionApprovals']])->get();
		$insurancedeductionapprovalsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($insurancedeductionapprovalsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('insurancedeductionapprovalsdata'));
		}else{
		$insurancedeductionapprovals->save();
		$insurancedeductionapprovalsdata['data']=InsuranceDeductionApprovals::find($id);
		return view('admin.insurance_deduction_approvals.edit',compact('insurancedeductionapprovalsdata','id'));
		}
	}

	public function destroy($id){
		$insurancedeductionapprovals=InsuranceDeductionApprovals::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','InsuranceDeductionApprovals']])->get();
		$insurancedeductionapprovalsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($insurancedeductionapprovalsdata['usersaccountsroles'][0]['_delete']==1){
			$insurancedeductionapprovals->delete();
		}return redirect('admin/insurancedeductionapprovals')->with('success','insurance deduction approvals has been deleted!');
	}
}