<?php
/**
* @author  Wanjala Innocent Khaemba
*Controller - (inventory transfer approval levels)
*/
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\InventoryTransferApprovalLevels;
use App\Companies;
use App\Modules;
use App\Users;
use App\ClientTypes;
use App\UsersAccounts;
use App\ApprovalLevels;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;
class InventoryTransferApprovalLevelsController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$inventorytransferapprovallevelsdata['clienttypes']=ClientTypes::all();
		$inventorytransferapprovallevelsdata['usersaccounts']=UsersAccounts::all();
		$inventorytransferapprovallevelsdata['approvallevels']=ApprovalLevels::all();
		$inventorytransferapprovallevelsdata['list']=InventoryTransferApprovalLevels::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','InventoryTransferApprovalLevels']])->get();
		$inventorytransferapprovallevelsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($inventorytransferapprovallevelsdata['usersaccountsroles'][0]) && $inventorytransferapprovallevelsdata['usersaccountsroles'][0]['_add']==0&&$inventorytransferapprovallevelsdata['usersaccountsroles'][0]['_list']==0&&$inventorytransferapprovallevelsdata['usersaccountsroles'][0]['_edit']==0&&$inventorytransferapprovallevelsdata['usersaccountsroles'][0]['_edit']==0&&$inventorytransferapprovallevelsdata['usersaccountsroles'][0]['_show']==0&&$inventorytransferapprovallevelsdata['usersaccountsroles'][0]['_delete']==0&&$inventorytransferapprovallevelsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('inventorytransferapprovallevelsdata'));
		}else{
			return view('admin.inventory_transfer_approval_levels.index',compact('inventorytransferapprovallevelsdata'));
		}
	}

	public function create(){
		$inventorytransferapprovallevelsdata;
		$inventorytransferapprovallevelsdata['clienttypes']=ClientTypes::all();
		$inventorytransferapprovallevelsdata['usersaccounts']=UsersAccounts::all();
		$inventorytransferapprovallevelsdata['approvallevels']=ApprovalLevels::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','InventoryTransferApprovalLevels']])->get();
		$inventorytransferapprovallevelsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($inventorytransferapprovallevelsdata['usersaccountsroles'][0]) && $inventorytransferapprovallevelsdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('inventorytransferapprovallevelsdata'));
		}else{
			return view('admin.inventory_transfer_approval_levels.create',compact('inventorytransferapprovallevelsdata'));
		}
	}

	public function filter(Request $request){
		$inventorytransferapprovallevelsdata['clienttypes']=ClientTypes::all();
		$inventorytransferapprovallevelsdata['usersaccounts']=UsersAccounts::all();
		$inventorytransferapprovallevelsdata['approvallevels']=ApprovalLevels::all();
		$inventorytransferapprovallevelsdata['list']=InventoryTransferApprovalLevels::where([['client_type','LIKE','%'.$request->get('client_type').'%'],['user_account','LIKE','%'.$request->get('user_account').'%'],['approval_level','LIKE','%'.$request->get('approval_level').'%'],])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','InventoryTransferApprovalLevels']])->get();
		$inventorytransferapprovallevelsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($inventorytransferapprovallevelsdata['usersaccountsroles'][0]) && $inventorytransferapprovallevelsdata['usersaccountsroles'][0]['_add']==0&&$inventorytransferapprovallevelsdata['usersaccountsroles'][0]['_list']==0&&$inventorytransferapprovallevelsdata['usersaccountsroles'][0]['_edit']==0&&$inventorytransferapprovallevelsdata['usersaccountsroles'][0]['_edit']==0&&$inventorytransferapprovallevelsdata['usersaccountsroles'][0]['_show']==0&&$inventorytransferapprovallevelsdata['usersaccountsroles'][0]['_delete']==0&&$inventorytransferapprovallevelsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('inventorytransferapprovallevelsdata'));
		}else{
			return view('admin.inventory_transfer_approval_levels.index',compact('inventorytransferapprovallevelsdata'));
		}
	}

	public function report(){
		$inventorytransferapprovallevelsdata['company']=Companies::all();
		$inventorytransferapprovallevelsdata['list']=InventoryTransferApprovalLevels::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','InventoryTransferApprovalLevels']])->get();
		$inventorytransferapprovallevelsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($inventorytransferapprovallevelsdata['usersaccountsroles'][0]) && $inventorytransferapprovallevelsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('inventorytransferapprovallevelsdata'));
		}else{
			return view('admin.inventory_transfer_approval_levels.report',compact('inventorytransferapprovallevelsdata'));
		}
	}

	public function chart(){
		return view('admin.inventory_transfer_approval_levels.chart');
	}

	public function store(Request $request){
		$inventorytransferapprovallevels=new InventoryTransferApprovalLevels();
		$inventorytransferapprovallevels->client_type=$request->get('client_type');
		$inventorytransferapprovallevels->user_account=$request->get('user_account');
		$inventorytransferapprovallevels->approval_level=$request->get('approval_level');
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','InventoryTransferApprovalLevels']])->get();
		$inventorytransferapprovallevelsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($inventorytransferapprovallevelsdata['usersaccountsroles'][0]) && $inventorytransferapprovallevelsdata['usersaccountsroles'][0]['_show']==1){
			try{
				if($inventorytransferapprovallevels->save()){
					$response['status']='1';
					$response['message']='inventory transfer approval levels Added successfully';
					return json_encode($response);
			}else{
					$response['status']='0';
					$response['message']='Failed to add inventory transfer approval levels. Please try again';
					return json_encode($response);
				}
			}
			catch(Exception $e){
					$response['status']='0';
					$response['message']='An Error occured while attempting to add inventory transfer approval levels. Please try again';
					return json_encode($response);
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$inventorytransferapprovallevelsdata['clienttypes']=ClientTypes::all();
		$inventorytransferapprovallevelsdata['usersaccounts']=UsersAccounts::all();
		$inventorytransferapprovallevelsdata['approvallevels']=ApprovalLevels::all();
		$inventorytransferapprovallevelsdata['data']=InventoryTransferApprovalLevels::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','InventoryTransferApprovalLevels']])->get();
		$inventorytransferapprovallevelsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($inventorytransferapprovallevelsdata['usersaccountsroles'][0]) && $inventorytransferapprovallevelsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('inventorytransferapprovallevelsdata'));
		}else{
		return view('admin.inventory_transfer_approval_levels.edit',compact('inventorytransferapprovallevelsdata','id'));
		}
	}

	public function show($id){
		$inventorytransferapprovallevelsdata['clienttypes']=ClientTypes::all();
		$inventorytransferapprovallevelsdata['usersaccounts']=UsersAccounts::all();
		$inventorytransferapprovallevelsdata['approvallevels']=ApprovalLevels::all();
		$inventorytransferapprovallevelsdata['data']=InventoryTransferApprovalLevels::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','InventoryTransferApprovalLevels']])->get();
		$inventorytransferapprovallevelsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($inventorytransferapprovallevelsdata['usersaccountsroles'][0]) && $inventorytransferapprovallevelsdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('inventorytransferapprovallevelsdata'));
		}else{
		return view('admin.inventory_transfer_approval_levels.show',compact('inventorytransferapprovallevelsdata','id'));
		}
	}

	public function update(Request $request,$id){
		$inventorytransferapprovallevels=InventoryTransferApprovalLevels::find($id);
		$inventorytransferapprovallevelsdata['clienttypes']=ClientTypes::all();
		$inventorytransferapprovallevelsdata['usersaccounts']=UsersAccounts::all();
		$inventorytransferapprovallevelsdata['approvallevels']=ApprovalLevels::all();
		$inventorytransferapprovallevels->client_type=$request->get('client_type');
		$inventorytransferapprovallevels->user_account=$request->get('user_account');
		$inventorytransferapprovallevels->approval_level=$request->get('approval_level');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','InventoryTransferApprovalLevels']])->get();
		$inventorytransferapprovallevelsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($inventorytransferapprovallevelsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('inventorytransferapprovallevelsdata'));
		}else{
		$inventorytransferapprovallevels->save();
		$inventorytransferapprovallevelsdata['data']=InventoryTransferApprovalLevels::find($id);
		return view('admin.inventory_transfer_approval_levels.edit',compact('inventorytransferapprovallevelsdata','id'));
		}
	}

	public function destroy($id){
		$inventorytransferapprovallevels=InventoryTransferApprovalLevels::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','InventoryTransferApprovalLevels']])->get();
		$inventorytransferapprovallevelsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($inventorytransferapprovallevelsdata['usersaccountsroles'][0]) && $inventorytransferapprovallevelsdata['usersaccountsroles'][0]['_delete']==1){
			$inventorytransferapprovallevels->delete();
		}return redirect('admin/inventorytransferapprovallevels')->with('success','inventory transfer approval levels has been deleted!');
	}
}