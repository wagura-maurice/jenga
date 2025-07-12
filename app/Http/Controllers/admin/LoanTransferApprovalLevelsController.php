<?php
/**
* @author  Wanjala Innocent Khaemba
*Controller - (loan transfer approval levels)
*/
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\LoanTransferApprovalLevels;
use App\Companies;
use App\Modules;
use App\Users;
use App\ApprovalLevels;
use App\UsersAccounts;
use App\ClientTypes;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;
class LoanTransferApprovalLevelsController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$loantransferapprovallevelsdata['approvallevels']=ApprovalLevels::all();
		$loantransferapprovallevelsdata['usersaccounts']=UsersAccounts::all();
		$loantransferapprovallevelsdata['clienttypes']=ClientTypes::all();
		$loantransferapprovallevelsdata['list']=LoanTransferApprovalLevels::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LoanTransferApprovalLevels']])->get();
		$loantransferapprovallevelsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($loantransferapprovallevelsdata['usersaccountsroles'][0]) && $loantransferapprovallevelsdata['usersaccountsroles'][0]['_add']==0&&$loantransferapprovallevelsdata['usersaccountsroles'][0]['_list']==0&&$loantransferapprovallevelsdata['usersaccountsroles'][0]['_edit']==0&&$loantransferapprovallevelsdata['usersaccountsroles'][0]['_edit']==0&&$loantransferapprovallevelsdata['usersaccountsroles'][0]['_show']==0&&$loantransferapprovallevelsdata['usersaccountsroles'][0]['_delete']==0&&$loantransferapprovallevelsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('loantransferapprovallevelsdata'));
		}else{
			return view('admin.loan_transfer_approval_levels.index',compact('loantransferapprovallevelsdata'));
		}
	}

	public function create(){
		$loantransferapprovallevelsdata;
		$loantransferapprovallevelsdata['approvallevels']=ApprovalLevels::all();
		$loantransferapprovallevelsdata['usersaccounts']=UsersAccounts::all();
		$loantransferapprovallevelsdata['clienttypes']=ClientTypes::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LoanTransferApprovalLevels']])->get();
		$loantransferapprovallevelsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($loantransferapprovallevelsdata['usersaccountsroles'][0]) && $loantransferapprovallevelsdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('loantransferapprovallevelsdata'));
		}else{
			return view('admin.loan_transfer_approval_levels.create',compact('loantransferapprovallevelsdata'));
		}
	}

	public function filter(Request $request){
		$loantransferapprovallevelsdata['approvallevels']=ApprovalLevels::all();
		$loantransferapprovallevelsdata['usersaccounts']=UsersAccounts::all();
		$loantransferapprovallevelsdata['clienttypes']=ClientTypes::all();
		$loantransferapprovallevelsdata['list']=LoanTransferApprovalLevels::where([['approval_level','LIKE','%'.$request->get('approval_level').'%'],['user_account','LIKE','%'.$request->get('user_account').'%'],['client_type','LIKE','%'.$request->get('client_type').'%'],])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LoanTransferApprovalLevels']])->get();
		$loantransferapprovallevelsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($loantransferapprovallevelsdata['usersaccountsroles'][0]) && $loantransferapprovallevelsdata['usersaccountsroles'][0]['_add']==0&&$loantransferapprovallevelsdata['usersaccountsroles'][0]['_list']==0&&$loantransferapprovallevelsdata['usersaccountsroles'][0]['_edit']==0&&$loantransferapprovallevelsdata['usersaccountsroles'][0]['_edit']==0&&$loantransferapprovallevelsdata['usersaccountsroles'][0]['_show']==0&&$loantransferapprovallevelsdata['usersaccountsroles'][0]['_delete']==0&&$loantransferapprovallevelsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('loantransferapprovallevelsdata'));
		}else{
			return view('admin.loan_transfer_approval_levels.index',compact('loantransferapprovallevelsdata'));
		}
	}

	public function report(){
		$loantransferapprovallevelsdata['company']=Companies::all();
		$loantransferapprovallevelsdata['list']=LoanTransferApprovalLevels::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LoanTransferApprovalLevels']])->get();
		$loantransferapprovallevelsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($loantransferapprovallevelsdata['usersaccountsroles'][0]) && $loantransferapprovallevelsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('loantransferapprovallevelsdata'));
		}else{
			return view('admin.loan_transfer_approval_levels.report',compact('loantransferapprovallevelsdata'));
		}
	}

	public function chart(){
		return view('admin.loan_transfer_approval_levels.chart');
	}

	public function store(Request $request){
		$loantransferapprovallevels=new LoanTransferApprovalLevels();
		$loantransferapprovallevels->approval_level=$request->get('approval_level');
		$loantransferapprovallevels->user_account=$request->get('user_account');
		$loantransferapprovallevels->client_type=$request->get('client_type');
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LoanTransferApprovalLevels']])->get();
		$loantransferapprovallevelsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($loantransferapprovallevelsdata['usersaccountsroles'][0]) && $loantransferapprovallevelsdata['usersaccountsroles'][0]['_show']==1){
			try{
				if($loantransferapprovallevels->save()){
					$response['status']='1';
					$response['message']='loan transfer approval levels Added successfully';
					return json_encode($response);
			}else{
					$response['status']='0';
					$response['message']='Failed to add loan transfer approval levels. Please try again';
					return json_encode($response);
				}
			}
			catch(Exception $e){
					$response['status']='0';
					$response['message']='An Error occured while attempting to add loan transfer approval levels. Please try again';
					return json_encode($response);
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$loantransferapprovallevelsdata['approvallevels']=ApprovalLevels::all();
		$loantransferapprovallevelsdata['usersaccounts']=UsersAccounts::all();
		$loantransferapprovallevelsdata['clienttypes']=ClientTypes::all();
		$loantransferapprovallevelsdata['data']=LoanTransferApprovalLevels::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LoanTransferApprovalLevels']])->get();
		$loantransferapprovallevelsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($loantransferapprovallevelsdata['usersaccountsroles'][0]) && $loantransferapprovallevelsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('loantransferapprovallevelsdata'));
		}else{
		return view('admin.loan_transfer_approval_levels.edit',compact('loantransferapprovallevelsdata','id'));
		}
	}

	public function show($id){
		$loantransferapprovallevelsdata['approvallevels']=ApprovalLevels::all();
		$loantransferapprovallevelsdata['usersaccounts']=UsersAccounts::all();
		$loantransferapprovallevelsdata['clienttypes']=ClientTypes::all();
		$loantransferapprovallevelsdata['data']=LoanTransferApprovalLevels::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LoanTransferApprovalLevels']])->get();
		$loantransferapprovallevelsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($loantransferapprovallevelsdata['usersaccountsroles'][0]) && $loantransferapprovallevelsdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('loantransferapprovallevelsdata'));
		}else{
		return view('admin.loan_transfer_approval_levels.show',compact('loantransferapprovallevelsdata','id'));
		}
	}

	public function update(Request $request,$id){
		$loantransferapprovallevels=LoanTransferApprovalLevels::find($id);
		$loantransferapprovallevelsdata['approvallevels']=ApprovalLevels::all();
		$loantransferapprovallevelsdata['usersaccounts']=UsersAccounts::all();
		$loantransferapprovallevelsdata['clienttypes']=ClientTypes::all();
		$loantransferapprovallevels->approval_level=$request->get('approval_level');
		$loantransferapprovallevels->user_account=$request->get('user_account');
		$loantransferapprovallevels->client_type=$request->get('client_type');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LoanTransferApprovalLevels']])->get();
		$loantransferapprovallevelsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($loantransferapprovallevelsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('loantransferapprovallevelsdata'));
		}else{
		$loantransferapprovallevels->save();
		$loantransferapprovallevelsdata['data']=LoanTransferApprovalLevels::find($id);
		return view('admin.loan_transfer_approval_levels.edit',compact('loantransferapprovallevelsdata','id'));
		}
	}

	public function destroy($id){
		$loantransferapprovallevels=LoanTransferApprovalLevels::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LoanTransferApprovalLevels']])->get();
		$loantransferapprovallevelsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($loantransferapprovallevelsdata['usersaccountsroles'][0]) && $loantransferapprovallevelsdata['usersaccountsroles'][0]['_delete']==1){
			$loantransferapprovallevels->delete();
		}return redirect('admin/loantransferapprovallevels')->with('success','loan transfer approval levels has been deleted!');
	}
}