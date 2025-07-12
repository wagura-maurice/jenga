<?php
/**
* @author  Wanjala Innocent Khaemba
*Controller - (purchase order approval mappings)
*/
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\PurchaseOrderApprovalMappings;
use App\Companies;
use App\Modules;
use App\Users;
use App\Stores;
use App\ApprovalLevels;
use App\UsersAccounts;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;
class PurchaseOrderApprovalMappingsController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$purchaseorderapprovalmappingsdata['stores']=Stores::all();
		$purchaseorderapprovalmappingsdata['approvallevels']=ApprovalLevels::all();
		$purchaseorderapprovalmappingsdata['usersaccounts']=UsersAccounts::all();
		$purchaseorderapprovalmappingsdata['list']=PurchaseOrderApprovalMappings::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','PurchaseOrderApprovalMappings']])->get();
		$purchaseorderapprovalmappingsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($purchaseorderapprovalmappingsdata['usersaccountsroles'][0]['_add']==0&&$purchaseorderapprovalmappingsdata['usersaccountsroles'][0]['_list']==0&&$purchaseorderapprovalmappingsdata['usersaccountsroles'][0]['_edit']==0&&$purchaseorderapprovalmappingsdata['usersaccountsroles'][0]['_edit']==0&&$purchaseorderapprovalmappingsdata['usersaccountsroles'][0]['_show']==0&&$purchaseorderapprovalmappingsdata['usersaccountsroles'][0]['_delete']==0&&$purchaseorderapprovalmappingsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('purchaseorderapprovalmappingsdata'));
		}else{
			return view('admin.purchase_order_approval_mappings.index',compact('purchaseorderapprovalmappingsdata'));
		}
	}

	public function create(){
		$purchaseorderapprovalmappingsdata;
		$purchaseorderapprovalmappingsdata['stores']=Stores::all();
		$purchaseorderapprovalmappingsdata['approvallevels']=ApprovalLevels::all();
		$purchaseorderapprovalmappingsdata['usersaccounts']=UsersAccounts::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','PurchaseOrderApprovalMappings']])->get();
		$purchaseorderapprovalmappingsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($purchaseorderapprovalmappingsdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('purchaseorderapprovalmappingsdata'));
		}else{
			return view('admin.purchase_order_approval_mappings.create',compact('purchaseorderapprovalmappingsdata'));
		}
	}

	public function filter(Request $request){
		$purchaseorderapprovalmappingsdata['stores']=Stores::all();
		$purchaseorderapprovalmappingsdata['approvallevels']=ApprovalLevels::all();
		$purchaseorderapprovalmappingsdata['usersaccounts']=UsersAccounts::all();
		$purchaseorderapprovalmappingsdata['list']=PurchaseOrderApprovalMappings::where([['store','LIKE','%'.$request->get('store').'%'],['approval_level','LIKE','%'.$request->get('approval_level').'%'],['user_account','LIKE','%'.$request->get('user_account').'%'],])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','PurchaseOrderApprovalMappings']])->get();
		$purchaseorderapprovalmappingsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($purchaseorderapprovalmappingsdata['usersaccountsroles'][0]['_add']==0&&$purchaseorderapprovalmappingsdata['usersaccountsroles'][0]['_list']==0&&$purchaseorderapprovalmappingsdata['usersaccountsroles'][0]['_edit']==0&&$purchaseorderapprovalmappingsdata['usersaccountsroles'][0]['_edit']==0&&$purchaseorderapprovalmappingsdata['usersaccountsroles'][0]['_show']==0&&$purchaseorderapprovalmappingsdata['usersaccountsroles'][0]['_delete']==0&&$purchaseorderapprovalmappingsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('purchaseorderapprovalmappingsdata'));
		}else{
			return view('admin.purchase_order_approval_mappings.index',compact('purchaseorderapprovalmappingsdata'));
		}
	}

	public function report(){
		$purchaseorderapprovalmappingsdata['company']=Companies::all();
		$purchaseorderapprovalmappingsdata['list']=PurchaseOrderApprovalMappings::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','PurchaseOrderApprovalMappings']])->get();
		$purchaseorderapprovalmappingsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($purchaseorderapprovalmappingsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('purchaseorderapprovalmappingsdata'));
		}else{
			return view('admin.purchase_order_approval_mappings.report',compact('purchaseorderapprovalmappingsdata'));
		}
	}

	public function chart(){
		return view('admin.purchase_order_approval_mappings.chart');
	}

	public function store(Request $request){
		$purchaseorderapprovalmappings=new PurchaseOrderApprovalMappings();
		$purchaseorderapprovalmappings->store=$request->get('store');
		$purchaseorderapprovalmappings->approval_level=$request->get('approval_level');
		$purchaseorderapprovalmappings->user_account=$request->get('user_account');
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','PurchaseOrderApprovalMappings']])->get();
		$purchaseorderapprovalmappingsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($purchaseorderapprovalmappingsdata['usersaccountsroles'][0]['_show']==1){
			try{
				if($purchaseorderapprovalmappings->save()){
					$response['status']='1';
					$response['message']='purchase order approval mappings Added successfully';
					return json_encode($response);
			}else{
					$response['status']='0';
					$response['message']='Failed to add purchase order approval mappings. Please try again';
					return json_encode($response);
				}
			}
			catch(Exception $e){
					$response['status']='0';
					$response['message']='An Error occured while attempting to add purchase order approval mappings. Please try again';
					return json_encode($response);
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$purchaseorderapprovalmappingsdata['stores']=Stores::all();
		$purchaseorderapprovalmappingsdata['approvallevels']=ApprovalLevels::all();
		$purchaseorderapprovalmappingsdata['usersaccounts']=UsersAccounts::all();
		$purchaseorderapprovalmappingsdata['data']=PurchaseOrderApprovalMappings::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','PurchaseOrderApprovalMappings']])->get();
		$purchaseorderapprovalmappingsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($purchaseorderapprovalmappingsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('purchaseorderapprovalmappingsdata'));
		}else{
		return view('admin.purchase_order_approval_mappings.edit',compact('purchaseorderapprovalmappingsdata','id'));
		}
	}

	public function show($id){
		$purchaseorderapprovalmappingsdata['stores']=Stores::all();
		$purchaseorderapprovalmappingsdata['approvallevels']=ApprovalLevels::all();
		$purchaseorderapprovalmappingsdata['usersaccounts']=UsersAccounts::all();
		$purchaseorderapprovalmappingsdata['data']=PurchaseOrderApprovalMappings::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','PurchaseOrderApprovalMappings']])->get();
		$purchaseorderapprovalmappingsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($purchaseorderapprovalmappingsdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('purchaseorderapprovalmappingsdata'));
		}else{
		return view('admin.purchase_order_approval_mappings.show',compact('purchaseorderapprovalmappingsdata','id'));
		}
	}

	public function update(Request $request,$id){
		$purchaseorderapprovalmappings=PurchaseOrderApprovalMappings::find($id);
		$purchaseorderapprovalmappingsdata['stores']=Stores::all();
		$purchaseorderapprovalmappingsdata['approvallevels']=ApprovalLevels::all();
		$purchaseorderapprovalmappingsdata['usersaccounts']=UsersAccounts::all();
		$purchaseorderapprovalmappings->store=$request->get('store');
		$purchaseorderapprovalmappings->approval_level=$request->get('approval_level');
		$purchaseorderapprovalmappings->user_account=$request->get('user_account');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','PurchaseOrderApprovalMappings']])->get();
		$purchaseorderapprovalmappingsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($purchaseorderapprovalmappingsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('purchaseorderapprovalmappingsdata'));
		}else{
		$purchaseorderapprovalmappings->save();
		$purchaseorderapprovalmappingsdata['data']=PurchaseOrderApprovalMappings::find($id);
		return view('admin.purchase_order_approval_mappings.edit',compact('purchaseorderapprovalmappingsdata','id'));
		}
	}

	public function destroy($id){
		$purchaseorderapprovalmappings=PurchaseOrderApprovalMappings::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','PurchaseOrderApprovalMappings']])->get();
		$purchaseorderapprovalmappingsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($purchaseorderapprovalmappingsdata['usersaccountsroles'][0]['_delete']==1){
			$purchaseorderapprovalmappings->delete();
		}return redirect('admin/purchaseorderapprovalmappings')->with('success','purchase order approval mappings has been deleted!');
	}
}