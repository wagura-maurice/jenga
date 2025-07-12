<?php
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\GroupRoles;
use App\Companies;
use App\Modules;
use App\Users;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;
class GroupRolesController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$grouprolesdata['list']=GroupRoles::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','GroupRoles']])->get();
		$grouprolesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($grouprolesdata['usersaccountsroles'][0]['_add']==0&&$grouprolesdata['usersaccountsroles'][0]['_list']==0&&$grouprolesdata['usersaccountsroles'][0]['_edit']==0&&$grouprolesdata['usersaccountsroles'][0]['_edit']==0&&$grouprolesdata['usersaccountsroles'][0]['_show']==0&&$grouprolesdata['usersaccountsroles'][0]['_delete']==0&&$grouprolesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('grouprolesdata'));
		}else{
			return view('admin.group_roles.index',compact('grouprolesdata'));
		}
	}

	public function create(){
		$grouprolesdata;
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','GroupRoles']])->get();
		$grouprolesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($grouprolesdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('grouprolesdata'));
		}else{
			return view('admin.group_roles.create',compact('grouprolesdata'));
		}
	}

	public function filter(Request $request){
		$grouprolesdata['list']=GroupRoles::where([['code','LIKE','%'.$request->get('code').'%'],['name','LIKE','%'.$request->get('name').'%'],['description','LIKE','%'.$request->get('description').'%'],])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','GroupRoles']])->get();
		$grouprolesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($grouprolesdata['usersaccountsroles'][0]['_add']==0&&$grouprolesdata['usersaccountsroles'][0]['_list']==0&&$grouprolesdata['usersaccountsroles'][0]['_edit']==0&&$grouprolesdata['usersaccountsroles'][0]['_edit']==0&&$grouprolesdata['usersaccountsroles'][0]['_show']==0&&$grouprolesdata['usersaccountsroles'][0]['_delete']==0&&$grouprolesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('grouprolesdata'));
		}else{
			return view('admin.group_roles.index',compact('grouprolesdata'));
		}
	}

	public function report(){
		$grouprolesdata['company']=Companies::all();
		$grouprolesdata['list']=GroupRoles::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','GroupRoles']])->get();
		$grouprolesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($grouprolesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('grouprolesdata'));
		}else{
			return view('admin.group_roles.report',compact('grouprolesdata'));
		}
	}

	public function chart(){
		return view('admin.group_roles.chart');
	}

	public function store(Request $request){
		$grouproles=new GroupRoles();
		$grouproles->code=$request->get('code');
		$grouproles->name=$request->get('name');
		$grouproles->description=$request->get('description');
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','GroupRoles']])->get();
		$grouprolesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($grouprolesdata['usersaccountsroles'][0]['_show']==1){
			try{
				if($grouproles->save()){
					$response['status']='1';
					$response['message']='group roles Added successfully';
					return json_encode($response);
			}else{
					$response['status']='0';
					$response['message']='Failed to add group roles. Please try again';
					return json_encode($response);
				}
			}
			catch(Exception $e){
					$response['status']='0';
					$response['message']='An Error occured while attempting to add group roles. Please try again';
					return json_encode($response);
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$grouprolesdata['data']=GroupRoles::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','GroupRoles']])->get();
		$grouprolesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($grouprolesdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('grouprolesdata'));
		}else{
		return view('admin.group_roles.edit',compact('grouprolesdata','id'));
		}
	}

	public function show($id){
		$grouprolesdata['data']=GroupRoles::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','GroupRoles']])->get();
		$grouprolesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($grouprolesdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('grouprolesdata'));
		}else{
		return view('admin.group_roles.show',compact('grouprolesdata','id'));
		}
	}

	public function update(Request $request,$id){
		$grouproles=GroupRoles::find($id);
		$grouproles->code=$request->get('code');
		$grouproles->name=$request->get('name');
		$grouproles->description=$request->get('description');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','GroupRoles']])->get();
		$grouprolesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($grouprolesdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('grouprolesdata'));
		}else{
		$grouproles->save();
		$grouprolesdata['data']=GroupRoles::find($id);
		return view('admin.group_roles.edit',compact('grouprolesdata','id'));
		}
	}

	public function destroy($id){
		$grouproles=GroupRoles::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','GroupRoles']])->get();
		$grouprolesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($grouprolesdata['usersaccountsroles'][0]['_delete']==1){
			$grouproles->delete();
		}return redirect('admin/grouproles')->with('success','group roles has been deleted!');
	}
}