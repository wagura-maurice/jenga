<?php
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\SubAccounts;
use App\Companies;
use App\Modules;
use App\Users;
use App\Accounts;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;
class SubAccountsController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$subaccountsdata['accounts']=Accounts::all();
		$subaccountsdata['accounts']=Accounts::all();
		$subaccountsdata['list']=SubAccounts::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','SubAccounts']])->get();
		$subaccountsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($subaccountsdata['usersaccountsroles'][0]['_add']==0&&$subaccountsdata['usersaccountsroles'][0]['_list']==0&&$subaccountsdata['usersaccountsroles'][0]['_edit']==0&&$subaccountsdata['usersaccountsroles'][0]['_edit']==0&&$subaccountsdata['usersaccountsroles'][0]['_show']==0&&$subaccountsdata['usersaccountsroles'][0]['_delete']==0&&$subaccountsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('subaccountsdata'));
		}else{
			return view('admin.sub_accounts.index',compact('subaccountsdata'));
		}
	}

	public function create(){
		$subaccountsdata;
		$subaccountsdata['accounts']=Accounts::all();
		$subaccountsdata['accounts']=Accounts::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','SubAccounts']])->get();
		$subaccountsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($subaccountsdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('subaccountsdata'));
		}else{
			return view('admin.sub_accounts.create',compact('subaccountsdata'));
		}
	}

	public function filter(Request $request){
		$subaccountsdata['accounts']=Accounts::all();
		$subaccountsdata['accounts']=Accounts::all();
		$subaccountsdata['list']=SubAccounts::where([['account','LIKE','%'.$request->get('account').'%'],['sub_account','LIKE','%'.$request->get('sub_account').'%'],])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','SubAccounts']])->get();
		$subaccountsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($subaccountsdata['usersaccountsroles'][0]['_add']==0&&$subaccountsdata['usersaccountsroles'][0]['_list']==0&&$subaccountsdata['usersaccountsroles'][0]['_edit']==0&&$subaccountsdata['usersaccountsroles'][0]['_edit']==0&&$subaccountsdata['usersaccountsroles'][0]['_show']==0&&$subaccountsdata['usersaccountsroles'][0]['_delete']==0&&$subaccountsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('subaccountsdata'));
		}else{
			return view('admin.sub_accounts.index',compact('subaccountsdata'));
		}
	}

	public function report(){
		$subaccountsdata['company']=Companies::all();
		$subaccountsdata['list']=SubAccounts::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','SubAccounts']])->get();
		$subaccountsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($subaccountsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('subaccountsdata'));
		}else{
			return view('admin.sub_accounts.report',compact('subaccountsdata'));
		}
	}

	public function chart(){
		return view('admin.sub_accounts.chart');
	}

	public function store(Request $request){
		$subaccounts=new SubAccounts();
		$subaccounts->account=$request->get('account');
		$subaccounts->sub_account=$request->get('sub_account');
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','SubAccounts']])->get();
		$subaccountsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($subaccountsdata['usersaccountsroles'][0]['_show']==1){
			try{
				if($subaccounts->save()){
					$response['status']='1';
					$response['message']='sub accounts Added successfully';
					return json_encode($response);
			}else{
					$response['status']='0';
					$response['message']='Failed to add sub accounts. Please try again';
					return json_encode($response);
				}
			}
			catch(Exception $e){
					$response['status']='0';
					$response['message']='An Error occured while attempting to add sub accounts. Please try again';
					return json_encode($response);
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$subaccountsdata['accounts']=Accounts::all();
		$subaccountsdata['accounts']=Accounts::all();
		$subaccountsdata['data']=SubAccounts::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','SubAccounts']])->get();
		$subaccountsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($subaccountsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('subaccountsdata'));
		}else{
		return view('admin.sub_accounts.edit',compact('subaccountsdata','id'));
		}
	}

	public function show($id){
		$subaccountsdata['accounts']=Accounts::all();
		$subaccountsdata['accounts']=Accounts::all();
		$subaccountsdata['data']=SubAccounts::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','SubAccounts']])->get();
		$subaccountsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($subaccountsdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('subaccountsdata'));
		}else{
		return view('admin.sub_accounts.show',compact('subaccountsdata','id'));
		}
	}

	public function update(Request $request,$id){
		$subaccounts=SubAccounts::find($id);
		$subaccounts->account=$request->get('account');
		$subaccounts->sub_account=$request->get('sub_account');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','SubAccounts']])->get();
		$subaccountsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($subaccountsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('subaccountsdata'));
		}else{
		$subaccounts->save();
		$subaccountsdata['data']=SubAccounts::find($id);
		return view('admin.sub_accounts.edit',compact('subaccountsdata','id'));
		}
	}

	public function destroy($id){
		$subaccounts=SubAccounts::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','SubAccounts']])->get();
		$subaccountsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($subaccountsdata['usersaccountsroles'][0]['_delete']==1){
			$subaccounts->delete();
		}return redirect('admin/subaccounts')->with('success','sub accounts has been deleted!');
	}
}