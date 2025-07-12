<?php
/**
* @author  Wanjala Innocent Khaemba
*Controller - (Purchase Order Approvals)
*/
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\PurchaseOrderApprovals;
use App\Companies;
use App\Modules;
use App\Users;
use App\PurchaseOrders;
use App\ApprovalStatuses;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;
class PurchaseOrderApprovalsController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$purchaseorderapprovalsdata['purchaseorders']=PurchaseOrders::all();
		$purchaseorderapprovalsdata['approvalstatuses']=ApprovalStatuses::all();
		$purchaseorderapprovalsdata['list']=PurchaseOrderApprovals::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','PurchaseOrderApprovals']])->get();
		$purchaseorderapprovalsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($purchaseorderapprovalsdata['usersaccountsroles'][0]['_add']==0&&$purchaseorderapprovalsdata['usersaccountsroles'][0]['_list']==0&&$purchaseorderapprovalsdata['usersaccountsroles'][0]['_edit']==0&&$purchaseorderapprovalsdata['usersaccountsroles'][0]['_edit']==0&&$purchaseorderapprovalsdata['usersaccountsroles'][0]['_show']==0&&$purchaseorderapprovalsdata['usersaccountsroles'][0]['_delete']==0&&$purchaseorderapprovalsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('purchaseorderapprovalsdata'));
		}else{
			return view('admin.purchase_order_approvals.index',compact('purchaseorderapprovalsdata'));
		}
	}

	public function create(){
		$purchaseorderapprovalsdata;
		$purchaseorderapprovalsdata['purchaseorders']=PurchaseOrders::all();
		$purchaseorderapprovalsdata['approvalstatuses']=ApprovalStatuses::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','PurchaseOrderApprovals']])->get();
		$purchaseorderapprovalsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($purchaseorderapprovalsdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('purchaseorderapprovalsdata'));
		}else{
			return view('admin.purchase_order_approvals.create',compact('purchaseorderapprovalsdata'));
		}
	}

	public function filter(Request $request){
		$purchaseorderapprovalsdata['purchaseorders']=PurchaseOrders::all();
		$purchaseorderapprovalsdata['approvalstatuses']=ApprovalStatuses::all();
		$purchaseorderapprovalsdata['list']=PurchaseOrderApprovals::where([['purchase_order','LIKE','%'.$request->get('purchase_order').'%'],['approval_level','LIKE','%'.$request->get('approval_level').'%'],['user','LIKE','%'.$request->get('user').'%'],['approval_status','LIKE','%'.$request->get('approval_status').'%'],])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','PurchaseOrderApprovals']])->get();
		$purchaseorderapprovalsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($purchaseorderapprovalsdata['usersaccountsroles'][0]['_add']==0&&$purchaseorderapprovalsdata['usersaccountsroles'][0]['_list']==0&&$purchaseorderapprovalsdata['usersaccountsroles'][0]['_edit']==0&&$purchaseorderapprovalsdata['usersaccountsroles'][0]['_edit']==0&&$purchaseorderapprovalsdata['usersaccountsroles'][0]['_show']==0&&$purchaseorderapprovalsdata['usersaccountsroles'][0]['_delete']==0&&$purchaseorderapprovalsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('purchaseorderapprovalsdata'));
		}else{
			return view('admin.purchase_order_approvals.index',compact('purchaseorderapprovalsdata'));
		}
	}

	public function report(){
		$purchaseorderapprovalsdata['company']=Companies::all();
		$purchaseorderapprovalsdata['list']=PurchaseOrderApprovals::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','PurchaseOrderApprovals']])->get();
		$purchaseorderapprovalsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($purchaseorderapprovalsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('purchaseorderapprovalsdata'));
		}else{
			return view('admin.purchase_order_approvals.report',compact('purchaseorderapprovalsdata'));
		}
	}

	public function chart(){
		return view('admin.purchase_order_approvals.chart');
	}

	public function store(Request $request){
		$purchaseorderapprovals=new PurchaseOrderApprovals();
		$purchaseorderapprovals->purchase_order=$request->get('purchase_order');
		$purchaseorderapprovals->approval_level=$request->get('approval_level');
		$purchaseorderapprovals->user=$request->get('user');
		$purchaseorderapprovals->approval_status=$request->get('approval_status');
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','PurchaseOrderApprovals']])->get();
		$purchaseorderapprovalsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($purchaseorderapprovalsdata['usersaccountsroles'][0]['_show']==1){
			try{
				if($purchaseorderapprovals->save()){
					$response['status']='1';
					$response['message']='Purchase Order Approvals Added successfully';
					return json_encode($response);
			}else{
					$response['status']='0';
					$response['message']='Failed to add Purchase Order Approvals. Please try again';
					return json_encode($response);
				}
			}
			catch(Exception $e){
					$response['status']='0';
					$response['message']='An Error occured while attempting to add Purchase Order Approvals. Please try again';
					return json_encode($response);
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$purchaseorderapprovalsdata['purchaseorders']=PurchaseOrders::all();
		$purchaseorderapprovalsdata['approvalstatuses']=ApprovalStatuses::all();
		$purchaseorderapprovalsdata['data']=PurchaseOrderApprovals::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','PurchaseOrderApprovals']])->get();
		$purchaseorderapprovalsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($purchaseorderapprovalsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('purchaseorderapprovalsdata'));
		}else{
		return view('admin.purchase_order_approvals.edit',compact('purchaseorderapprovalsdata','id'));
		}
	}

	public function show($id){
		$purchaseorderapprovalsdata['purchaseorders']=PurchaseOrders::all();
		$purchaseorderapprovalsdata['approvalstatuses']=ApprovalStatuses::all();
		$purchaseorderapprovalsdata['data']=PurchaseOrderApprovals::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','PurchaseOrderApprovals']])->get();
		$purchaseorderapprovalsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($purchaseorderapprovalsdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('purchaseorderapprovalsdata'));
		}else{
		return view('admin.purchase_order_approvals.show',compact('purchaseorderapprovalsdata','id'));
		}
	}

	public function update(Request $request,$id){
		$purchaseorderapprovals=PurchaseOrderApprovals::find($id);
		$purchaseorderapprovalsdata['purchaseorders']=PurchaseOrders::all();
		$purchaseorderapprovalsdata['approvalstatuses']=ApprovalStatuses::all();
		$purchaseorderapprovals->purchase_order=$request->get('purchase_order');
		$purchaseorderapprovals->approval_level=$request->get('approval_level');
		$purchaseorderapprovals->user=$request->get('user');
		$purchaseorderapprovals->approval_status=$request->get('approval_status');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','PurchaseOrderApprovals']])->get();
		$purchaseorderapprovalsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($purchaseorderapprovalsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('purchaseorderapprovalsdata'));
		}else{
		$purchaseorderapprovals->save();
		$purchaseorderapprovalsdata['data']=PurchaseOrderApprovals::find($id);
		return view('admin.purchase_order_approvals.edit',compact('purchaseorderapprovalsdata','id'));
		}
	}

	public function destroy($id){
		$purchaseorderapprovals=PurchaseOrderApprovals::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','PurchaseOrderApprovals']])->get();
		$purchaseorderapprovalsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($purchaseorderapprovalsdata['usersaccountsroles'][0]['_delete']==1){
			$purchaseorderapprovals->delete();
		}return redirect('admin/purchaseorderapprovals')->with('success','Purchase Order Approvals has been deleted!');
	}
}