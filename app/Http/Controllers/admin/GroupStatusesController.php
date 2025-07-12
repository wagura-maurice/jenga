<?php
/**
* @author  Wanjala Innocent Khaemba
*/
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\GroupStatuses;
use App\Companies;
use App\Modules;
use App\Users;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;
class GroupStatusesController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$groupstatusesdata['list']=GroupStatuses::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','GroupStatuses']])->get();
		$groupstatusesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($groupstatusesdata['usersaccountsroles'][0]['_add']==0&&$groupstatusesdata['usersaccountsroles'][0]['_list']==0&&$groupstatusesdata['usersaccountsroles'][0]['_edit']==0&&$groupstatusesdata['usersaccountsroles'][0]['_edit']==0&&$groupstatusesdata['usersaccountsroles'][0]['_show']==0&&$groupstatusesdata['usersaccountsroles'][0]['_delete']==0&&$groupstatusesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('groupstatusesdata'));
		}else{
			return view('admin.group_statuses.index',compact('groupstatusesdata'));
		}
	}

	public function create(){
		$groupstatusesdata;
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','GroupStatuses']])->get();
		$groupstatusesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($groupstatusesdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('groupstatusesdata'));
		}else{
			return view('admin.group_statuses.create',compact('groupstatusesdata'));
		}
	}

	public function filter(Request $request){
		$groupstatusesdata['list']=GroupStatuses::where([['code','LIKE','%'.$request->get('code').'%'],['name','LIKE','%'.$request->get('name').'%'],['description','LIKE','%'.$request->get('description').'%'],])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','GroupStatuses']])->get();
		$groupstatusesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($groupstatusesdata['usersaccountsroles'][0]['_add']==0&&$groupstatusesdata['usersaccountsroles'][0]['_list']==0&&$groupstatusesdata['usersaccountsroles'][0]['_edit']==0&&$groupstatusesdata['usersaccountsroles'][0]['_edit']==0&&$groupstatusesdata['usersaccountsroles'][0]['_show']==0&&$groupstatusesdata['usersaccountsroles'][0]['_delete']==0&&$groupstatusesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('groupstatusesdata'));
		}else{
			return view('admin.group_statuses.index',compact('groupstatusesdata'));
		}
	}

	public function report(){
		$groupstatusesdata['company']=Companies::all();
		$groupstatusesdata['list']=GroupStatuses::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','GroupStatuses']])->get();
		$groupstatusesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($groupstatusesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('groupstatusesdata'));
		}else{
			return view('admin.group_statuses.report',compact('groupstatusesdata'));
		}
	}

	public function chart(){
		return view('admin.group_statuses.chart');
	}

	public function store(Request $request){
		$groupstatuses=new GroupStatuses();
		$groupstatuses->code=$request->get('code');
		$groupstatuses->name=$request->get('name');
		$groupstatuses->description=$request->get('description');
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','GroupStatuses']])->get();
		$groupstatusesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($groupstatusesdata['usersaccountsroles'][0]['_show']==1){
			try{
				if($groupstatuses->save()){
					$response['status']='1';
					$response['message']='group statuses Added successfully';
					return json_encode($response);
			}else{
					$response['status']='0';
					$response['message']='Failed to add group statuses. Please try again';
					return json_encode($response);
				}
			}
			catch(Exception $e){
					$response['status']='0';
					$response['message']='An Error occured while attempting to add group statuses. Please try again';
					return json_encode($response);
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$groupstatusesdata['data']=GroupStatuses::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','GroupStatuses']])->get();
		$groupstatusesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($groupstatusesdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('groupstatusesdata'));
		}else{
		return view('admin.group_statuses.edit',compact('groupstatusesdata','id'));
		}
	}

	public function show($id){
		$groupstatusesdata['data']=GroupStatuses::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','GroupStatuses']])->get();
		$groupstatusesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($groupstatusesdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('groupstatusesdata'));
		}else{
		return view('admin.group_statuses.show',compact('groupstatusesdata','id'));
		}
	}

	public function update(Request $request,$id){
		$groupstatuses=GroupStatuses::find($id);
		$groupstatuses->code=$request->get('code');
		$groupstatuses->name=$request->get('name');
		$groupstatuses->description=$request->get('description');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','GroupStatuses']])->get();
		$groupstatusesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($groupstatusesdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('groupstatusesdata'));
		}else{
		$groupstatuses->save();
		$groupstatusesdata['data']=GroupStatuses::find($id);
		return view('admin.group_statuses.edit',compact('groupstatusesdata','id'));
		}
	}

	public function destroy($id){
		$groupstatuses=GroupStatuses::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','GroupStatuses']])->get();
		$groupstatusesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($groupstatusesdata['usersaccountsroles'][0]['_delete']==1){
			$groupstatuses->delete();
		}return redirect('admin/groupstatuses')->with('success','group statuses has been deleted!');
	}
}