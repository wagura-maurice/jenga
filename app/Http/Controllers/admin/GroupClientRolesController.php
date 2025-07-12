<?php
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\GroupClientRoles;
use App\Companies;
use App\Modules;
use App\Users;
use App\Groups;
use App\GroupRoles;
use App\Clients;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;
class GroupClientRolesController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$groupclientrolesdata['groups']=Groups::all();
		$groupclientrolesdata['grouproles']=GroupRoles::all();
		$groupclientrolesdata['clients']=Clients::all();
		$groupclientrolesdata['list']=GroupClientRoles::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','GroupClientRoles']])->get();
		$groupclientrolesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($groupclientrolesdata['usersaccountsroles'][0]['_add']==0&&$groupclientrolesdata['usersaccountsroles'][0]['_list']==0&&$groupclientrolesdata['usersaccountsroles'][0]['_edit']==0&&$groupclientrolesdata['usersaccountsroles'][0]['_edit']==0&&$groupclientrolesdata['usersaccountsroles'][0]['_show']==0&&$groupclientrolesdata['usersaccountsroles'][0]['_delete']==0&&$groupclientrolesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('groupclientrolesdata'));
		}else{
			return view('admin.group_client_roles.index',compact('groupclientrolesdata'));
		}
	}

	public function create(){
		$groupclientrolesdata;
		$groupclientrolesdata['groups']=Groups::all();
		$groupclientrolesdata['grouproles']=GroupRoles::all();
		$groupclientrolesdata['clients']=Clients::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','GroupClientRoles']])->get();
		$groupclientrolesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($groupclientrolesdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('groupclientrolesdata'));
		}else{
			return view('admin.group_client_roles.create',compact('groupclientrolesdata'));
		}
	}

	public function filter(Request $request){
		$groupclientrolesdata['groups']=Groups::all();
		$groupclientrolesdata['grouproles']=GroupRoles::all();
		$groupclientrolesdata['clients']=Clients::all();
		$groupclientrolesdata['list']=GroupClientRoles::where([['client_group','LIKE','%'.$request->get('client_group').'%'],['group_role','LIKE','%'.$request->get('group_role').'%'],['client','LIKE','%'.$request->get('client').'%'],])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','GroupClientRoles']])->get();
		$groupclientrolesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($groupclientrolesdata['usersaccountsroles'][0]['_add']==0&&$groupclientrolesdata['usersaccountsroles'][0]['_list']==0&&$groupclientrolesdata['usersaccountsroles'][0]['_edit']==0&&$groupclientrolesdata['usersaccountsroles'][0]['_edit']==0&&$groupclientrolesdata['usersaccountsroles'][0]['_show']==0&&$groupclientrolesdata['usersaccountsroles'][0]['_delete']==0&&$groupclientrolesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('groupclientrolesdata'));
		}else{
			return view('admin.group_client_roles.index',compact('groupclientrolesdata'));
		}
	}

	public function report(){
		$groupclientrolesdata['company']=Companies::all();
		$groupclientrolesdata['list']=GroupClientRoles::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','GroupClientRoles']])->get();
		$groupclientrolesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($groupclientrolesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('groupclientrolesdata'));
		}else{
			return view('admin.group_client_roles.report',compact('groupclientrolesdata'));
		}
	}

	public function chart(){
		return view('admin.group_client_roles.chart');
	}

	public function store(Request $request){
		$groupclientroles=new GroupClientRoles();
		$groupclientroles->client_group=$request->get('client_group');
		$groupclientroles->group_role=$request->get('group_role');
		$groupclientroles->client=$request->get('client');
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','GroupClientRoles']])->get();
		$groupclientrolesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($groupclientrolesdata['usersaccountsroles'][0]['_show']==1){
			try{
				if($groupclientroles->save()){
					$response['status']='1';
					$response['message']='group client roles Added successfully';
					return json_encode($response);
			}else{
					$response['status']='0';
					$response['message']='Failed to add group client roles. Please try again';
					return json_encode($response);
				}
			}
			catch(Exception $e){
					$response['status']='0';
					$response['message']='An Error occured while attempting to add group client roles. Please try again';
					return json_encode($response);
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$groupclientrolesdata['groups']=Groups::all();
		$groupclientrolesdata['grouproles']=GroupRoles::all();
		$groupclientrolesdata['clients']=Clients::all();
		$groupclientrolesdata['data']=GroupClientRoles::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','GroupClientRoles']])->get();
		$groupclientrolesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($groupclientrolesdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('groupclientrolesdata'));
		}else{
		return view('admin.group_client_roles.edit',compact('groupclientrolesdata','id'));
		}
	}

	public function show($id){
		$groupclientrolesdata['groups']=Groups::all();
		$groupclientrolesdata['grouproles']=GroupRoles::all();
		$groupclientrolesdata['clients']=Clients::all();
		$groupclientrolesdata['data']=GroupClientRoles::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','GroupClientRoles']])->get();
		$groupclientrolesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($groupclientrolesdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('groupclientrolesdata'));
		}else{
		return view('admin.group_client_roles.show',compact('groupclientrolesdata','id'));
		}
	}

	public function update(Request $request,$id){
		$groupclientroles=GroupClientRoles::find($id);
		$groupclientroles->client_group=$request->get('client_group');
		$groupclientroles->group_role=$request->get('group_role');
		$groupclientroles->client=$request->get('client');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','GroupClientRoles']])->get();
		$groupclientrolesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($groupclientrolesdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('groupclientrolesdata'));
		}else{
		$groupclientroles->save();
		$groupclientrolesdata['data']=GroupClientRoles::find($id);
		return view('admin.group_client_roles.edit',compact('groupclientrolesdata','id'));
		}
	}

	public function destroy($id){
		$groupclientroles=GroupClientRoles::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','GroupClientRoles']])->get();
		$groupclientrolesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($groupclientrolesdata['usersaccountsroles'][0]['_delete']==1){
			$groupclientroles->delete();
		}return redirect('admin/groupclientroles')->with('success','group client roles has been deleted!');
	}
}