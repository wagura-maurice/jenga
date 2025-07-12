<?php
/**
* @author  Wanjala Innocent Khaemba
*Controller - (fine transfer approval levels)
*/
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\FineTransferApprovalLevels;
use App\Companies;
use App\Modules;
use App\Users;
use App\ApprovalLevels;
use App\UsersAccounts;
use App\ClientTypes;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;
class FineTransferApprovalLevelsController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$finetransferapprovallevelsdata['approvallevels']=ApprovalLevels::all();
		$finetransferapprovallevelsdata['usersaccounts']=UsersAccounts::all();
		$finetransferapprovallevelsdata['clienttypes']=ClientTypes::all();
		$finetransferapprovallevelsdata['list']=FineTransferApprovalLevels::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','FineTransferApprovalLevels']])->get();
		$finetransferapprovallevelsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($finetransferapprovallevelsdata['usersaccountsroles'][0]) && $finetransferapprovallevelsdata['usersaccountsroles'][0]['_add']==0&&$finetransferapprovallevelsdata['usersaccountsroles'][0]['_list']==0&&$finetransferapprovallevelsdata['usersaccountsroles'][0]['_edit']==0&&$finetransferapprovallevelsdata['usersaccountsroles'][0]['_edit']==0&&$finetransferapprovallevelsdata['usersaccountsroles'][0]['_show']==0&&$finetransferapprovallevelsdata['usersaccountsroles'][0]['_delete']==0&&$finetransferapprovallevelsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('finetransferapprovallevelsdata'));
		}else{
			return view('admin.fine_transfer_approval_levels.index',compact('finetransferapprovallevelsdata'));
		}
	}

	public function create(){
		$finetransferapprovallevelsdata;
		$finetransferapprovallevelsdata['approvallevels']=ApprovalLevels::all();
		$finetransferapprovallevelsdata['usersaccounts']=UsersAccounts::all();
		$finetransferapprovallevelsdata['clienttypes']=ClientTypes::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','FineTransferApprovalLevels']])->get();
		$finetransferapprovallevelsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($finetransferapprovallevelsdata['usersaccountsroles'][0]) && $finetransferapprovallevelsdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('finetransferapprovallevelsdata'));
		}else{
			return view('admin.fine_transfer_approval_levels.create',compact('finetransferapprovallevelsdata'));
		}
	}

	public function filter(Request $request){
		$finetransferapprovallevelsdata['approvallevels']=ApprovalLevels::all();
		$finetransferapprovallevelsdata['usersaccounts']=UsersAccounts::all();
		$finetransferapprovallevelsdata['clienttypes']=ClientTypes::all();
		$finetransferapprovallevelsdata['list']=FineTransferApprovalLevels::where([['approval_level','LIKE','%'.$request->get('approval_level').'%'],['user_account','LIKE','%'.$request->get('user_account').'%'],['client_type','LIKE','%'.$request->get('client_type').'%'],])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','FineTransferApprovalLevels']])->get();
		$finetransferapprovallevelsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($finetransferapprovallevelsdata['usersaccountsroles'][0]) && $finetransferapprovallevelsdata['usersaccountsroles'][0]['_add']==0&&$finetransferapprovallevelsdata['usersaccountsroles'][0]['_list']==0&&$finetransferapprovallevelsdata['usersaccountsroles'][0]['_edit']==0&&$finetransferapprovallevelsdata['usersaccountsroles'][0]['_edit']==0&&$finetransferapprovallevelsdata['usersaccountsroles'][0]['_show']==0&&$finetransferapprovallevelsdata['usersaccountsroles'][0]['_delete']==0&&$finetransferapprovallevelsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('finetransferapprovallevelsdata'));
		}else{
			return view('admin.fine_transfer_approval_levels.index',compact('finetransferapprovallevelsdata'));
		}
	}

	public function report(){
		$finetransferapprovallevelsdata['company']=Companies::all();
		$finetransferapprovallevelsdata['list']=FineTransferApprovalLevels::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','FineTransferApprovalLevels']])->get();
		$finetransferapprovallevelsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($finetransferapprovallevelsdata['usersaccountsroles'][0]) && $finetransferapprovallevelsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('finetransferapprovallevelsdata'));
		}else{
			return view('admin.fine_transfer_approval_levels.report',compact('finetransferapprovallevelsdata'));
		}
	}

	public function chart(){
		return view('admin.fine_transfer_approval_levels.chart');
	}

	public function store(Request $request){
		$finetransferapprovallevels=new FineTransferApprovalLevels();
		$finetransferapprovallevels->approval_level=$request->get('approval_level');
		$finetransferapprovallevels->user_account=$request->get('user_account');
		$finetransferapprovallevels->client_type=$request->get('client_type');
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','FineTransferApprovalLevels']])->get();
		$finetransferapprovallevelsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($finetransferapprovallevelsdata['usersaccountsroles'][0]) && $finetransferapprovallevelsdata['usersaccountsroles'][0]['_show']==1){
			try{
				if($finetransferapprovallevels->save()){
					$response['status']='1';
					$response['message']='fine transfer approval levels Added successfully';
					return json_encode($response);
			}else{
					$response['status']='0';
					$response['message']='Failed to add fine transfer approval levels. Please try again';
					return json_encode($response);
				}
			}
			catch(Exception $e){
					$response['status']='0';
					$response['message']='An Error occured while attempting to add fine transfer approval levels. Please try again';
					return json_encode($response);
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$finetransferapprovallevelsdata['approvallevels']=ApprovalLevels::all();
		$finetransferapprovallevelsdata['usersaccounts']=UsersAccounts::all();
		$finetransferapprovallevelsdata['clienttypes']=ClientTypes::all();
		$finetransferapprovallevelsdata['data']=FineTransferApprovalLevels::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','FineTransferApprovalLevels']])->get();
		$finetransferapprovallevelsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($finetransferapprovallevelsdata['usersaccountsroles'][0]) && $finetransferapprovallevelsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('finetransferapprovallevelsdata'));
		}else{
		return view('admin.fine_transfer_approval_levels.edit',compact('finetransferapprovallevelsdata','id'));
		}
	}

	public function show($id){
		$finetransferapprovallevelsdata['approvallevels']=ApprovalLevels::all();
		$finetransferapprovallevelsdata['usersaccounts']=UsersAccounts::all();
		$finetransferapprovallevelsdata['clienttypes']=ClientTypes::all();
		$finetransferapprovallevelsdata['data']=FineTransferApprovalLevels::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','FineTransferApprovalLevels']])->get();
		$finetransferapprovallevelsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($finetransferapprovallevelsdata['usersaccountsroles'][0]) && $finetransferapprovallevelsdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('finetransferapprovallevelsdata'));
		}else{
		return view('admin.fine_transfer_approval_levels.show',compact('finetransferapprovallevelsdata','id'));
		}
	}

	public function update(Request $request,$id){
		$finetransferapprovallevels=FineTransferApprovalLevels::find($id);
		$finetransferapprovallevelsdata['approvallevels']=ApprovalLevels::all();
		$finetransferapprovallevelsdata['usersaccounts']=UsersAccounts::all();
		$finetransferapprovallevelsdata['clienttypes']=ClientTypes::all();
		$finetransferapprovallevels->approval_level=$request->get('approval_level');
		$finetransferapprovallevels->user_account=$request->get('user_account');
		$finetransferapprovallevels->client_type=$request->get('client_type');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','FineTransferApprovalLevels']])->get();
		$finetransferapprovallevelsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($finetransferapprovallevelsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('finetransferapprovallevelsdata'));
		}else{
		$finetransferapprovallevels->save();
		$finetransferapprovallevelsdata['data']=FineTransferApprovalLevels::find($id);
		return view('admin.fine_transfer_approval_levels.edit',compact('finetransferapprovallevelsdata','id'));
		}
	}

	public function destroy($id){
		$finetransferapprovallevels=FineTransferApprovalLevels::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','FineTransferApprovalLevels']])->get();
		$finetransferapprovallevelsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($finetransferapprovallevelsdata['usersaccountsroles'][0]) && $finetransferapprovallevelsdata['usersaccountsroles'][0]['_delete']==1){
			$finetransferapprovallevels->delete();
		}return redirect('admin/finetransferapprovallevels')->with('success','fine transfer approval levels has been deleted!');
	}
}