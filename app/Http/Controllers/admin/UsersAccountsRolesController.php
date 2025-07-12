<?php
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\UsersAccountsRoles;
use App\Companies;
use App\UsersAccounts;
use App\Modules;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
class UsersAccountsRolesController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$usersaccountsrolesdata['usersaccounts']=UsersAccounts::all();
		$usersaccountsrolesdata['modules']=Modules::all();
		$usersaccountsrolesdata['list']=UsersAccountsRoles::all();
		return view('admin.users_accounts_roles.index',compact('usersaccountsrolesdata'));
	}
	public function useraccountrolesmanagement($id){
		$usersaccountsrolesdata['usersaccounts']=UsersAccounts::all();
		$usersaccountsrolesdata['modules']=Modules::all();
		$usersaccountsrolesdata['list']=UsersAccountsRoles::where([['user_account','=',$id]])->orderBy('id','desc')->get();
		return view('admin.users_accounts_roles.index',compact('usersaccountsrolesdata'));
	}
	public function create(){
		$usersaccountsrolesdata;
		$usersaccountsrolesdata['usersaccounts']=UsersAccounts::all();
		$usersaccountsrolesdata['modules']=Modules::all();
		return view('admin.users_accounts_roles.create',compact('usersaccountsrolesdata'));
	}

	public function filter(Request $request){
		$usersaccountsrolesdata['usersaccounts']=UsersAccounts::all();
		$usersaccountsrolesdata['modules']=Modules::all();
		$usersaccountsrolesdata['list']=UsersAccountsRoles::where([['user_account','LIKE','%'.$request->get('user_account').'%'],['module','LIKE','%'.$request->get('module').'%'],['_add','LIKE','%'.$request->get('_add').'%'],['_list','LIKE','%'.$request->get('_list').'%'],['_edit','LIKE','%'.$request->get('_edit').'%'],['_delete','LIKE','%'.$request->get('_delete').'%'],['_show','LIKE','%'.$request->get('_show').'%'],['_report','LIKE','%'.$request->get('_report').'%'],])->get();
		return view('admin.users_accounts_roles.index',compact('usersaccountsrolesdata'));
	}

	public function report(){
		$usersaccountsrolesdata['company']=Companies::all();
		$usersaccountsrolesdata['list']=UsersAccountsRoles::all();
		return view('admin.users_accounts_roles.report',compact('usersaccountsrolesdata'));
	}

	public function chart(){
		return view('admin.users_accounts_roles.chart');
	}

	public function store(Request $request){
		$usersaccountsroles=new UsersAccountsRoles();
		$usersaccountsroles->user_account=$request->get('user_account');
		$usersaccountsroles->module=$request->get('module');
		$usersaccountsroles->_add=$request->get('_add');
		$usersaccountsroles->_list=$request->get('_list');
		$usersaccountsroles->_edit=$request->get('_edit');
		$usersaccountsroles->_delete=$request->get('_delete');
		$usersaccountsroles->_show=$request->get('_show');
		$usersaccountsroles->_report=$request->get('_report');
		$response=array();
		try{
			if($usersaccountsroles->save()){
				$response['status']='1';
				$response['message']='users accounts roles Added successfully';
				return json_encode($response);
		}else{
				$response['status']='0';
				$response['message']='Failed to add users accounts roles. Please try again';
				return json_encode($response);
		}
		}
		catch(Exception $e){
				$response['status']='0';
				$response['message']='An Error occured while attempting to add users accounts roles. Please try again';
				return json_encode($response);
		}
		return json_encode($response);
	}

	public function edit($id){
		$usersaccountsrolesdata['usersaccounts']=UsersAccounts::all();
		$usersaccountsrolesdata['modules']=Modules::all();
		$usersaccountsrolesdata['data']=UsersAccountsRoles::find($id);
		return view('admin.users_accounts_roles.edit',compact('usersaccountsrolesdata','id'));
	}

	public function show($id){
		$usersaccountsrolesdata['usersaccounts']=UsersAccounts::all();
		$usersaccountsrolesdata['modules']=Modules::all();
		$usersaccountsrolesdata['data']=UsersAccountsRoles::find($id);
		return view('admin.users_accounts_roles.show',compact('usersaccountsrolesdata','id'));
	}

	public function update(Request $request,$id){
		$usersaccountsroles=UsersAccountsRoles::find($id);
		$usersaccountsroles->user_account=$request->get('user_account');
		$usersaccountsroles->module=$request->get('module');
		$usersaccountsroles->_add=empty($request->get('_add'))?0:1;
		$usersaccountsroles->_list=empty($request->get('_list'))?0:1;
		$usersaccountsroles->_edit=empty($request->get('_edit'))?0:1;
		$usersaccountsroles->_delete=empty($request->get('_delete'))?0:1;
		$usersaccountsroles->_show=empty($request->get('_show'))?0:1;
		$usersaccountsroles->_report=empty($request->get('_report'))?0:1;

		
		
		$usersaccountsroles->save();
		$usersaccountsrolesdata['data']=UsersAccountsRoles::find($id);
		$usersaccountsrolesdata['usersaccounts']=UsersAccounts::all();
		$usersaccountsrolesdata['modules']=Modules::all();

		$usersaccountsrolesdata['usersaccounts']=UsersAccounts::all();
		$usersaccountsrolesdata['modules']=Modules::all();
		$usersaccountsrolesdata['list']=UsersAccountsRoles::where([['user_account','=',$request->user_account]])->orderBy('id','desc')->get();
		return view('admin.users_accounts_roles.index',compact('usersaccountsrolesdata'));	}

	public function destroy($id){
		$usersaccountsroles=UsersAccountsRoles::find($id);
		$usersaccountsroles->delete();return redirect('admin/usersaccountsroles')->with('success','users accounts roles has been deleted!');
	}
}