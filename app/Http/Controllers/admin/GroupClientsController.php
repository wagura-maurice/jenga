<?php
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\GroupClients;
use App\Companies;
use App\Modules;
use App\Users;
use App\Groups;
use App\Clients;
use App\ClientTypes;
use App\ClientCategories;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\UsersAccountsRoles;
class GroupClientsController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$groupclientsdata['groups']=Groups::all();
		$clientCategory=ClientCategories::where([['code','=','002']])->get();
		$clientType=ClientTypes::where([['code','=','001']])->get();
		$groupclientsdata['clients']=Clients::where([['client_type','=',$clientType[0]['id']],['client_category','=',$clientCategory[0]['id']]])->get();
		$groupclientsdata['list']=GroupClients::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','GroupClients']])->get();
		$groupclientsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($groupclientsdata['usersaccountsroles'][0]['_add']==0&&$groupclientsdata['usersaccountsroles'][0]['_list']==0&&$groupclientsdata['usersaccountsroles'][0]['_edit']==0&&$groupclientsdata['usersaccountsroles'][0]['_edit']==0&&$groupclientsdata['usersaccountsroles'][0]['_show']==0&&$groupclientsdata['usersaccountsroles'][0]['_delete']==0&&$groupclientsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('groupclientsdata'));
		}else{
			return view('admin.group_clients.index',compact('groupclientsdata'));
		}
	}

	public function create(){
		$groupclientsdata;
		$groupclientsdata['groups']=Groups::all();
		$clientCategory=ClientCategories::where([['code','=','002']])->get();
		$clientType=ClientTypes::where([['code','=','001']])->get();
		$groupclientsdata['clients']=Clients::where([['client_type','=',$clientType[0]['id']],['client_category','=',$clientCategory[0]['id']]])->get();

		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','GroupClients']])->get();
		$groupclientsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($groupclientsdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('groupclientsdata'));
		}else{
			return view('admin.group_clients.create',compact('groupclientsdata'));
		}
	}

	public function filter(Request $request){
		$groupclientsdata['groups']=Groups::all();
		$clientCategory=ClientCategories::where([['code','=','002']])->get();
		$clientType=ClientTypes::where([['code','=','001']])->get();
		$groupclientsdata['clients']=Clients::where([['client_type','=',$clientType[0]['id']],['client_category','=',$clientCategory[0]['id']]])->get();

		$groupclientsdata['list']=GroupClients::where([['client_group','LIKE','%'.$request->get('client_group').'%'],['client','LIKE','%'.$request->get('client').'%'],])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','GroupClients']])->get();
		$groupclientsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($groupclientsdata['usersaccountsroles'][0]['_add']==0&&$groupclientsdata['usersaccountsroles'][0]['_list']==0&&$groupclientsdata['usersaccountsroles'][0]['_edit']==0&&$groupclientsdata['usersaccountsroles'][0]['_edit']==0&&$groupclientsdata['usersaccountsroles'][0]['_show']==0&&$groupclientsdata['usersaccountsroles'][0]['_delete']==0&&$groupclientsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('groupclientsdata'));
		}else{
			return view('admin.group_clients.index',compact('groupclientsdata'));
		}
	}
	public function dbimport(){
		ini_set('max_execution_time', 600);
		$query=DB::connection('mysql2')->select("select * from group_clients");
		DB::transaction(function() use($query){
			foreach($query as $groupclient){
				$groupclients=new GroupClients();
				$query2=DB::connection('mysql2')->select("select * from groups where groups_id='".$groupclient->client_group."'");
				$group=Groups::where([['group_number','=',$query2[0]->group_number]])->get();
				$groupclients->client_group=$group[0]['id'];
				$query3=DB::connection('mysql2')->select("select * from client where client_id='".$groupclient->client."'");
				$client=Clients::where([['client_number','=',$query3[0]->client_number]])->get();
				$groupclients->client=$client[0]['id'];
				$groupclients->save();

			}
		});
		$clientCategory=ClientCategories::where([['code','=','002']])->get();
		$clientType=ClientTypes::where([['code','=','001']])->get();
		$groupclientsdata['clients']=Clients::where([['client_type','=',$clientType[0]['id']],['client_category','=',$clientCategory[0]['id']]])->get();
		$groupclientsdata['groups']=Groups::all();
		$clientCategory=ClientCategories::where([['code','=','002']])->get();
		$clientType=ClientTypes::where([['code','=','001']])->get();
		$groupclientsdata['clients']=Clients::where([['client_type','=',$clientType[0]['id']],['client_category','=',$clientCategory[0]['id']]])->get();
		$groupclientsdata['list']=GroupClients::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','GroupClients']])->get();
		$groupclientsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($groupclientsdata['usersaccountsroles'][0]['_add']==0&&$groupclientsdata['usersaccountsroles'][0]['_list']==0&&$groupclientsdata['usersaccountsroles'][0]['_edit']==0&&$groupclientsdata['usersaccountsroles'][0]['_edit']==0&&$groupclientsdata['usersaccountsroles'][0]['_show']==0&&$groupclientsdata['usersaccountsroles'][0]['_delete']==0&&$groupclientsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('groupclientsdata'));
		}else{
			return view('admin.group_clients.index',compact('groupclientsdata'));
		}


	}

	public function report(){
		$groupclientsdata['company']=Companies::all();
		$groupclientsdata['list']=GroupClients::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','GroupClients']])->get();
		$groupclientsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($groupclientsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('groupclientsdata'));
		}else{
			return view('admin.group_clients.report',compact('groupclientsdata'));
		}
	}

	public function chart(){
		return view('admin.group_clients.chart');
	}

	public function store(Request $request){
		$groupclients=new GroupClients();
		$groupclients->client_group=$request->get('client_group');
		$groupclients->client=$request->get('client');
		$clientCategory=ClientCategories::where([['code','=','002']])->get();
		$clientType=ClientTypes::where([['code','=','001']])->get();
		$groupclientsdata['clients']=Clients::where([['client_type','=',$clientType[0]['id']],['client_category','=',$clientCategory[0]['id']]])->get();

		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','GroupClients']])->get();
		$groupclientsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($groupclientsdata['usersaccountsroles'][0]['_show']==1){
			try{
				if($groupclients->save()){
					$response['status']='1';
					$response['message']='group clients Added successfully';
					return json_encode($response);
			}else{
					$response['status']='0';
					$response['message']='Failed to add group clients. Please try again';
					return json_encode($response);
				}
			}
			catch(Exception $e){
					$response['status']='0';
					$response['message']='An Error occured while attempting to add group clients. Please try again';
					return json_encode($response);
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$groupclientsdata['groups']=Groups::all();
		$clientCategory=ClientCategories::where([['code','=','002']])->get();
		$clientType=ClientTypes::where([['code','=','001']])->get();
		$groupclientsdata['clients']=Clients::where([['client_type','=',$clientType[0]['id']],['client_category','=',$clientCategory[0]['id']]])->get();

		$groupclientsdata['data']=GroupClients::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','GroupClients']])->get();
		$groupclientsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($groupclientsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('groupclientsdata'));
		}else{
		return view('admin.group_clients.edit',compact('groupclientsdata','id'));
		}
	}

	public function show($id){
		$groupclientsdata['groups']=Groups::all();
		$clientCategory=ClientCategories::where([['code','=','002']])->get();
		$clientType=ClientTypes::where([['code','=','001']])->get();
		$groupclientsdata['clients']=Clients::where([['client_type','=',$clientType[0]['id']],['client_category','=',$clientCategory[0]['id']]])->get();

		$groupclientsdata['data']=GroupClients::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','GroupClients']])->get();
		$groupclientsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($groupclientsdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('groupclientsdata'));
		}else{
		return view('admin.group_clients.show',compact('groupclientsdata','id'));
		}
	}

	public function update(Request $request,$id){
		$groupclients=GroupClients::find($id);
		$groupclients->client_group=$request->get('client_group');
		$clientCategory=ClientCategories::where([['code','=','002']])->get();
		$clientType=ClientTypes::where([['code','=','001']])->get();
		$groupclientsdata['clients']=Clients::where([['client_type','=',$clientType[0]['id']],['client_category','=',$clientCategory[0]['id']]])->get();

		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','GroupClients']])->get();
		$groupclientsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($groupclientsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('groupclientsdata'));
		}else{
		$groupclients->save();
		$groupclientsdata['data']=GroupClients::find($id);
		return view('admin.group_clients.edit',compact('groupclientsdata','id'));
		}
	}

	public function destroy($id){
		$groupclients=GroupClients::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','GroupClients']])->get();
		$groupclientsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($groupclientsdata['usersaccountsroles'][0]['_delete']==1){
			$groupclients->delete();
		}return redirect('admin/groupclients')->with('success','group clients has been deleted!');
	}
}