<?php
/**
* @author  Wanjala Innocent Khaemba
*Controller - (bank transfer approval levels)
*/
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\BankTransferApprovalLevels;
use App\Companies;
use App\Modules;
use App\Users;
use App\ClientTypes;
use App\UsersAccounts;
use App\ApprovalLevels;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;
class BankTransferApprovalLevelsController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$banktransferapprovallevelsdata['clienttypes']=ClientTypes::all();
		$banktransferapprovallevelsdata['usersaccounts']=UsersAccounts::all();
		$banktransferapprovallevelsdata['approvallevels']=ApprovalLevels::all();
		$banktransferapprovallevelsdata['list']=BankTransferApprovalLevels::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','BankTransferApprovalLevels']])->get();
		$banktransferapprovallevelsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($banktransferapprovallevelsdata['usersaccountsroles'][0]) && $banktransferapprovallevelsdata['usersaccountsroles'][0]['_add']==0&&$banktransferapprovallevelsdata['usersaccountsroles'][0]['_list']==0&&$banktransferapprovallevelsdata['usersaccountsroles'][0]['_edit']==0&&$banktransferapprovallevelsdata['usersaccountsroles'][0]['_edit']==0&&$banktransferapprovallevelsdata['usersaccountsroles'][0]['_show']==0&&$banktransferapprovallevelsdata['usersaccountsroles'][0]['_delete']==0&&$banktransferapprovallevelsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('banktransferapprovallevelsdata'));
		}else{
			return view('admin.bank_transfer_approval_levels.index',compact('banktransferapprovallevelsdata'));
		}
	}

	public function create(){
		$banktransferapprovallevelsdata;
		$banktransferapprovallevelsdata['clienttypes']=ClientTypes::all();
		$banktransferapprovallevelsdata['usersaccounts']=UsersAccounts::all();
		$banktransferapprovallevelsdata['approvallevels']=ApprovalLevels::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','BankTransferApprovalLevels']])->get();
		$banktransferapprovallevelsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($banktransferapprovallevelsdata['usersaccountsroles'][0]) && $banktransferapprovallevelsdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('banktransferapprovallevelsdata'));
		}else{
			return view('admin.bank_transfer_approval_levels.create',compact('banktransferapprovallevelsdata'));
		}
	}

	public function filter(Request $request){
		$banktransferapprovallevelsdata['clienttypes']=ClientTypes::all();
		$banktransferapprovallevelsdata['usersaccounts']=UsersAccounts::all();
		$banktransferapprovallevelsdata['approvallevels']=ApprovalLevels::all();
		$banktransferapprovallevelsdata['list']=BankTransferApprovalLevels::where([['client_type','LIKE','%'.$request->get('client_type').'%'],['user_account','LIKE','%'.$request->get('user_account').'%'],['approval_level','LIKE','%'.$request->get('approval_level').'%'],])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','BankTransferApprovalLevels']])->get();
		$banktransferapprovallevelsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($banktransferapprovallevelsdata['usersaccountsroles'][0]) && $banktransferapprovallevelsdata['usersaccountsroles'][0]['_add']==0&&$banktransferapprovallevelsdata['usersaccountsroles'][0]['_list']==0&&$banktransferapprovallevelsdata['usersaccountsroles'][0]['_edit']==0&&$banktransferapprovallevelsdata['usersaccountsroles'][0]['_edit']==0&&$banktransferapprovallevelsdata['usersaccountsroles'][0]['_show']==0&&$banktransferapprovallevelsdata['usersaccountsroles'][0]['_delete']==0&&$banktransferapprovallevelsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('banktransferapprovallevelsdata'));
		}else{
			return view('admin.bank_transfer_approval_levels.index',compact('banktransferapprovallevelsdata'));
		}
	}

	public function report(){
		$banktransferapprovallevelsdata['company']=Companies::all();
		$banktransferapprovallevelsdata['list']=BankTransferApprovalLevels::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','BankTransferApprovalLevels']])->get();
		$banktransferapprovallevelsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($banktransferapprovallevelsdata['usersaccountsroles'][0]) && $banktransferapprovallevelsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('banktransferapprovallevelsdata'));
		}else{
			return view('admin.bank_transfer_approval_levels.report',compact('banktransferapprovallevelsdata'));
		}
	}

	public function chart(){
		return view('admin.bank_transfer_approval_levels.chart');
	}

	public function store(Request $request){
		$banktransferapprovallevels=new BankTransferApprovalLevels();
		$banktransferapprovallevels->client_type=$request->get('client_type');
		$banktransferapprovallevels->user_account=$request->get('user_account');
		$banktransferapprovallevels->approval_level=$request->get('approval_level');
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','BankTransferApprovalLevels']])->get();
		$banktransferapprovallevelsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($banktransferapprovallevelsdata['usersaccountsroles'][0]) && $banktransferapprovallevelsdata['usersaccountsroles'][0]['_show']==1){
			try{
				if($banktransferapprovallevels->save()){
					$response['status']='1';
					$response['message']='bank transfer approval levels Added successfully';
					return json_encode($response);
			}else{
					$response['status']='0';
					$response['message']='Failed to add bank transfer approval levels. Please try again';
					return json_encode($response);
				}
			}
			catch(Exception $e){
					$response['status']='0';
					$response['message']='An Error occured while attempting to add bank transfer approval levels. Please try again';
					return json_encode($response);
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$banktransferapprovallevelsdata['clienttypes']=ClientTypes::all();
		$banktransferapprovallevelsdata['usersaccounts']=UsersAccounts::all();
		$banktransferapprovallevelsdata['approvallevels']=ApprovalLevels::all();
		$banktransferapprovallevelsdata['data']=BankTransferApprovalLevels::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','BankTransferApprovalLevels']])->get();
		$banktransferapprovallevelsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($banktransferapprovallevelsdata['usersaccountsroles'][0]) && $banktransferapprovallevelsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('banktransferapprovallevelsdata'));
		}else{
		return view('admin.bank_transfer_approval_levels.edit',compact('banktransferapprovallevelsdata','id'));
		}
	}

	public function show($id){
		$banktransferapprovallevelsdata['clienttypes']=ClientTypes::all();
		$banktransferapprovallevelsdata['usersaccounts']=UsersAccounts::all();
		$banktransferapprovallevelsdata['approvallevels']=ApprovalLevels::all();
		$banktransferapprovallevelsdata['data']=BankTransferApprovalLevels::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','BankTransferApprovalLevels']])->get();
		$banktransferapprovallevelsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($banktransferapprovallevelsdata['usersaccountsroles'][0]) && $banktransferapprovallevelsdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('banktransferapprovallevelsdata'));
		}else{
		return view('admin.bank_transfer_approval_levels.show',compact('banktransferapprovallevelsdata','id'));
		}
	}

	public function update(Request $request,$id){
		$banktransferapprovallevels=BankTransferApprovalLevels::find($id);
		$banktransferapprovallevelsdata['clienttypes']=ClientTypes::all();
		$banktransferapprovallevelsdata['usersaccounts']=UsersAccounts::all();
		$banktransferapprovallevelsdata['approvallevels']=ApprovalLevels::all();
		$banktransferapprovallevels->client_type=$request->get('client_type');
		$banktransferapprovallevels->user_account=$request->get('user_account');
		$banktransferapprovallevels->approval_level=$request->get('approval_level');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','BankTransferApprovalLevels']])->get();
		$banktransferapprovallevelsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($banktransferapprovallevelsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('banktransferapprovallevelsdata'));
		}else{
		$banktransferapprovallevels->save();
		$banktransferapprovallevelsdata['data']=BankTransferApprovalLevels::find($id);
		return view('admin.bank_transfer_approval_levels.edit',compact('banktransferapprovallevelsdata','id'));
		}
	}

	public function destroy($id){
		$banktransferapprovallevels=BankTransferApprovalLevels::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','BankTransferApprovalLevels']])->get();
		$banktransferapprovallevelsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($banktransferapprovallevelsdata['usersaccountsroles'][0]) && $banktransferapprovallevelsdata['usersaccountsroles'][0]['_delete']==1){
			$banktransferapprovallevels->delete();
		}return redirect('admin/banktransferapprovallevels')->with('success','bank transfer approval levels has been deleted!');
	}
}