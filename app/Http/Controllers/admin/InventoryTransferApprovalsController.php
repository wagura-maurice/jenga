<?php
/**
* @author  Wanjala Innocent Khaemba
*Controller - (inventory transfer approvals)
*/
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\InventoryTransferApprovals;
use App\Companies;
use App\Modules;
use App\Users;
use App\LgfToInventoryTransfers;
use App\ApprovalLevels;
use App\ApprovalStatuses;
use App\UsersAccounts;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;
class InventoryTransferApprovalsController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$inventorytransferapprovalsdata['lgftoinventorytransfers']=LgfToInventoryTransfers::all();
		$inventorytransferapprovalsdata['approvallevels']=ApprovalLevels::all();
		$inventorytransferapprovalsdata['approvalstatuses']=ApprovalStatuses::all();
		$inventorytransferapprovalsdata['users']=Users::all();
		$inventorytransferapprovalsdata['usersaccounts']=UsersAccounts::all();
		$inventorytransferapprovalsdata['list']=InventoryTransferApprovals::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','InventoryTransferApprovals']])->get();
		$inventorytransferapprovalsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($inventorytransferapprovalsdata['usersaccountsroles'][0]) && $inventorytransferapprovalsdata['usersaccountsroles'][0]['_add']==0&&$inventorytransferapprovalsdata['usersaccountsroles'][0]['_list']==0&&$inventorytransferapprovalsdata['usersaccountsroles'][0]['_edit']==0&&$inventorytransferapprovalsdata['usersaccountsroles'][0]['_edit']==0&&$inventorytransferapprovalsdata['usersaccountsroles'][0]['_show']==0&&$inventorytransferapprovalsdata['usersaccountsroles'][0]['_delete']==0&&$inventorytransferapprovalsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('inventorytransferapprovalsdata'));
		}else{
			return view('admin.inventory_transfer_approvals.index',compact('inventorytransferapprovalsdata'));
		}
	}

	public function create(){
		$inventorytransferapprovalsdata;
		$inventorytransferapprovalsdata['lgftoinventorytransfers']=LgfToInventoryTransfers::all();
		$inventorytransferapprovalsdata['approvallevels']=ApprovalLevels::all();
		$inventorytransferapprovalsdata['approvalstatuses']=ApprovalStatuses::all();
		$inventorytransferapprovalsdata['users']=Users::all();
		$inventorytransferapprovalsdata['usersaccounts']=UsersAccounts::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','InventoryTransferApprovals']])->get();
		$inventorytransferapprovalsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($inventorytransferapprovalsdata['usersaccountsroles'][0]) && $inventorytransferapprovalsdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('inventorytransferapprovalsdata'));
		}else{
			return view('admin.inventory_transfer_approvals.create',compact('inventorytransferapprovalsdata'));
		}
	}

	public function filter(Request $request){
		$inventorytransferapprovalsdata['lgftoinventorytransfers']=LgfToInventoryTransfers::all();
		$inventorytransferapprovalsdata['approvallevels']=ApprovalLevels::all();
		$inventorytransferapprovalsdata['approvalstatuses']=ApprovalStatuses::all();
		$inventorytransferapprovalsdata['users']=Users::all();
		$inventorytransferapprovalsdata['usersaccounts']=UsersAccounts::all();
		$inventorytransferapprovalsdata['list']=InventoryTransferApprovals::where([['inventory_transfer','LIKE','%'.$request->get('inventory_transfer').'%'],['approval_level','LIKE','%'.$request->get('approval_level').'%'],['approval_status','LIKE','%'.$request->get('approval_status').'%'],['approved_by','LIKE','%'.$request->get('approved_by').'%'],['user_account','LIKE','%'.$request->get('user_account').'%'],['remarks','LIKE','%'.$request->get('remarks').'%'],])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','InventoryTransferApprovals']])->get();
		$inventorytransferapprovalsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($inventorytransferapprovalsdata['usersaccountsroles'][0]) && $inventorytransferapprovalsdata['usersaccountsroles'][0]['_add']==0&&$inventorytransferapprovalsdata['usersaccountsroles'][0]['_list']==0&&$inventorytransferapprovalsdata['usersaccountsroles'][0]['_edit']==0&&$inventorytransferapprovalsdata['usersaccountsroles'][0]['_edit']==0&&$inventorytransferapprovalsdata['usersaccountsroles'][0]['_show']==0&&$inventorytransferapprovalsdata['usersaccountsroles'][0]['_delete']==0&&$inventorytransferapprovalsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('inventorytransferapprovalsdata'));
		}else{
			return view('admin.inventory_transfer_approvals.index',compact('inventorytransferapprovalsdata'));
		}
	}

	public function report(){
		$inventorytransferapprovalsdata['company']=Companies::all();
		$inventorytransferapprovalsdata['list']=InventoryTransferApprovals::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','InventoryTransferApprovals']])->get();
		$inventorytransferapprovalsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($inventorytransferapprovalsdata['usersaccountsroles'][0]) && $inventorytransferapprovalsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('inventorytransferapprovalsdata'));
		}else{
			return view('admin.inventory_transfer_approvals.report',compact('inventorytransferapprovalsdata'));
		}
	}

	public function chart(){
		return view('admin.inventory_transfer_approvals.chart');
	}

	public function store(Request $request){
		$inventorytransferapprovals=new InventoryTransferApprovals();
		$inventorytransferapprovals->inventory_transfer=$request->get('inventory_transfer');
		$inventorytransferapprovals->approval_level=$request->get('approval_level');
		$inventorytransferapprovals->approval_status=$request->get('approval_status');
		$inventorytransferapprovals->approved_by=$request->get('approved_by');
		$inventorytransferapprovals->user_account=$request->get('user_account');
		$inventorytransferapprovals->remarks=$request->get('remarks');
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','InventoryTransferApprovals']])->get();
		$inventorytransferapprovalsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($inventorytransferapprovalsdata['usersaccountsroles'][0]) && $inventorytransferapprovalsdata['usersaccountsroles'][0]['_show']==1){
			try{
				if($inventorytransferapprovals->save()){
					$response['status']='1';
					$response['message']='inventory transfer approvals Added successfully';
					return json_encode($response);
			}else{
					$response['status']='0';
					$response['message']='Failed to add inventory transfer approvals. Please try again';
					return json_encode($response);
				}
			}
			catch(Exception $e){
					$response['status']='0';
					$response['message']='An Error occured while attempting to add inventory transfer approvals. Please try again';
					return json_encode($response);
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$inventorytransferapprovalsdata['lgftoinventorytransfers']=LgfToInventoryTransfers::all();
		$inventorytransferapprovalsdata['approvallevels']=ApprovalLevels::all();
		$inventorytransferapprovalsdata['approvalstatuses']=ApprovalStatuses::all();
		$inventorytransferapprovalsdata['users']=Users::all();
		$inventorytransferapprovalsdata['usersaccounts']=UsersAccounts::all();
		$inventorytransferapprovalsdata['data']=InventoryTransferApprovals::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','InventoryTransferApprovals']])->get();
		$inventorytransferapprovalsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($inventorytransferapprovalsdata['usersaccountsroles'][0]) && $inventorytransferapprovalsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('inventorytransferapprovalsdata'));
		}else{
		return view('admin.inventory_transfer_approvals.edit',compact('inventorytransferapprovalsdata','id'));
		}
	}

	public function show($id){
		$inventorytransferapprovalsdata['lgftoinventorytransfers']=LgfToInventoryTransfers::all();
		$inventorytransferapprovalsdata['approvallevels']=ApprovalLevels::all();
		$inventorytransferapprovalsdata['approvalstatuses']=ApprovalStatuses::all();
		$inventorytransferapprovalsdata['users']=Users::all();
		$inventorytransferapprovalsdata['usersaccounts']=UsersAccounts::all();
		$inventorytransferapprovalsdata['data']=InventoryTransferApprovals::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','InventoryTransferApprovals']])->get();
		$inventorytransferapprovalsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($inventorytransferapprovalsdata['usersaccountsroles'][0]) && $inventorytransferapprovalsdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('inventorytransferapprovalsdata'));
		}else{
		return view('admin.inventory_transfer_approvals.show',compact('inventorytransferapprovalsdata','id'));
		}
	}

	public function update(Request $request,$id){
		$inventorytransferapprovals=InventoryTransferApprovals::find($id);
		$inventorytransferapprovalsdata['lgftoinventorytransfers']=LgfToInventoryTransfers::all();
		$inventorytransferapprovalsdata['approvallevels']=ApprovalLevels::all();
		$inventorytransferapprovalsdata['approvalstatuses']=ApprovalStatuses::all();
		$inventorytransferapprovalsdata['users']=Users::all();
		$inventorytransferapprovalsdata['usersaccounts']=UsersAccounts::all();
		$inventorytransferapprovals->inventory_transfer=$request->get('inventory_transfer');
		$inventorytransferapprovals->approval_level=$request->get('approval_level');
		$inventorytransferapprovals->approval_status=$request->get('approval_status');
		$inventorytransferapprovals->approved_by=$request->get('approved_by');
		$inventorytransferapprovals->user_account=$request->get('user_account');
		$inventorytransferapprovals->remarks=$request->get('remarks');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','InventoryTransferApprovals']])->get();
		$inventorytransferapprovalsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($inventorytransferapprovalsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('inventorytransferapprovalsdata'));
		}else{
		$inventorytransferapprovals->save();
		$inventorytransferapprovalsdata['data']=InventoryTransferApprovals::find($id);
		return view('admin.inventory_transfer_approvals.edit',compact('inventorytransferapprovalsdata','id'));
		}
	}

	public function destroy($id){
		$inventorytransferapprovals=InventoryTransferApprovals::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','InventoryTransferApprovals']])->get();
		$inventorytransferapprovalsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($inventorytransferapprovalsdata['usersaccountsroles'][0]) && $inventorytransferapprovalsdata['usersaccountsroles'][0]['_delete']==1){
			$inventorytransferapprovals->delete();
		}return redirect('admin/inventorytransferapprovals')->with('success','inventory transfer approvals has been deleted!');
	}
}