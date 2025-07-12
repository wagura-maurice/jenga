<?php
namespace App\Http\Controllers\admin;

use App\Branches;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Users;
use App\Companies;
use App\UsersAccounts;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;
use App\Modules;
class UsersController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$usersdata['usersaccounts']=UsersAccounts::all();
		$usersdata['list']=Users::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Users']])->get();
		$usersdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($usersdata['usersaccountsroles'][0]['_add']==0&&$usersdata['usersaccountsroles'][0]['_list']==0&&$usersdata['usersaccountsroles'][0]['_edit']==0&&$usersdata['usersaccountsroles'][0]['_edit']==0&&$usersdata['usersaccountsroles'][0]['_show']==0&&$usersdata['usersaccountsroles'][0]['_delete']==0&&$usersdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('usersdata'));
		}else{
			return view('admin.users.index',compact('usersdata'));
		}
	}

	public function create(){
		$usersdata['branches'] = Branches::all();
		$usersdata['usersaccounts']=UsersAccounts::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Users']])->get();
		$usersdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($usersdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('usersdata'));
		}else{
			return view('admin.users.create',compact('usersdata'));
		}

	}

	public function filter(Request $request){
		$usersdata['usersaccounts']=UsersAccounts::all();
		$usersdata['list']=Users::where([['name','LIKE','%'.$request->get('name').'%'],['email','LIKE','%'.$request->get('email').'%'],['user_account','LIKE','%'.$request->get('user_account').'%'],['password','LIKE','%'.$request->get('password').'%'],['remember_token','LIKE','%'.$request->get('remember_token').'%'],['created_at','LIKE','%'.$request->get('created_at').'%'],['updated_at','LIKE','%'.$request->get('updated_at').'%'],])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Users']])->get();
		$usersdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($usersdata['usersaccountsroles'][0]['_add']==0&&$usersdata['usersaccountsroles'][0]['_list']==0&&$usersdata['usersaccountsroles'][0]['_edit']==0&&$usersdata['usersaccountsroles'][0]['_edit']==0&&$usersdata['usersaccountsroles'][0]['_show']==0&&$usersdata['usersaccountsroles'][0]['_delete']==0&&$usersdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('usersdata'));
		}else{
			return view('admin.users.index',compact('usersdata'));
		}

	}

	public function report(){
		$usersdata['company']=Companies::all();
		$usersdata['list']=Users::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Users']])->get();
		$usersdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();if($usersdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('usersdata'));
		}else{
			return view('admin.users.report',compact('usersdata'));
		}

	}

	public function chart(){
		return view('admin.users.chart');
	}

	public function store(Request $request){
		$users=new Users();
		$users->name=$request->get('name');
		$users->email=$request->get('email');
		$users->user_account=$request->get('user_account');
		$users->password=bcrypt($request->get('password'));
		// $users->remember_token=$request->get('remember_token');
		// $users->created_at=$request->get('created_at');
		// $users->updated_at=$request->get('updated_at');
		$users->branch_id=$request->get('branch');
		$response=array();
		try{
			if($users->save()){
				$response['status']='1';
				$response['message']='users Added successfully';
				return json_encode($response);
		}else{
				$response['status']='0';
				$response['message']='Failed to add users. Please try again';
				return json_encode($response);
		}
		}
		catch(Exception $e){
				$response['status']='0';
				$response['message']='An Error occured while attempting to add users. Please try again';
				return json_encode($response);
		}
		return json_encode($response);
	}

	public function edit($id){
		$usersdata['branches'] = Branches::all();
		$usersdata['usersaccounts']=UsersAccounts::all();
		$usersdata['data']=Users::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Users']])->get();
		$usersdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($usersdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('usersdata'));
		}else{
			return view('admin.users.edit',compact('usersdata','id'));
		}

		
	}

	public function show($id){
		$usersdata['usersaccounts']=UsersAccounts::all();
		$usersdata['data']=Users::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Users']])->get();
		$usersdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($usersdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('usersdata'));
		}else{
			return view('admin.users.show',compact('usersdata','id'));
			
		}

		
	}

	public function update(Request $request,$id){
		$usersdata['usersaccounts']=UsersAccounts::all();
		$users=Users::find($id);
		$users->name=$request->get('name');
		$users->email=$request->get('email');
		$users->user_account=$request->get('user_account');
		$users->password=bcrypt($request->get('password'));
		// $users->remember_token=$request->get('remember_token');
		// $users->created_at=$request->get('created_at');
		// $users->updated_at=$request->get('updated_at');
		$users->branch_id=$request->get('branch');
		$users->save();
		$usersdata['data']=Users::find($id);

		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Users']])->get();
		$usersdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($usersdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('usersdata'));
		}else{
			return view('admin.users.edit',compact('usersdata','id'));
		}

	}

	public function destroy($id){
		$users=Users::find($id);
		$users->delete();
		return redirect('admin/users')->with('success','users has been deleted!');
	}
}