<?php
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Departments;
use App\Companies;
use App\Modules;
use App\Users;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;
class DepartmentsController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$departmentsdata['list']=Departments::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Departments']])->get();
		$departmentsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($departmentsdata['usersaccountsroles'][0]['_add']==0&&$departmentsdata['usersaccountsroles'][0]['_list']==0&&$departmentsdata['usersaccountsroles'][0]['_edit']==0&&$departmentsdata['usersaccountsroles'][0]['_edit']==0&&$departmentsdata['usersaccountsroles'][0]['_show']==0&&$departmentsdata['usersaccountsroles'][0]['_delete']==0&&$departmentsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('departmentsdata'));
		}else{
			return view('admin.departments.index',compact('departmentsdata'));
		}
	}

	public function create(){
		$departmentsdata;
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Departments']])->get();
		$departmentsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($departmentsdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('departmentsdata'));
		}else{
			return view('admin.departments.create',compact('departmentsdata'));
		}
	}

	public function filter(Request $request){
		$departmentsdata['list']=Departments::where([['code','LIKE','%'.$request->get('code').'%'],['name','LIKE','%'.$request->get('name').'%'],])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Departments']])->get();
		$departmentsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($departmentsdata['usersaccountsroles'][0]['_add']==0&&$departmentsdata['usersaccountsroles'][0]['_list']==0&&$departmentsdata['usersaccountsroles'][0]['_edit']==0&&$departmentsdata['usersaccountsroles'][0]['_edit']==0&&$departmentsdata['usersaccountsroles'][0]['_show']==0&&$departmentsdata['usersaccountsroles'][0]['_delete']==0&&$departmentsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('departmentsdata'));
		}else{
			return view('admin.departments.index',compact('departmentsdata'));
		}
	}

	public function report(){
		$departmentsdata['company']=Companies::all();
		$departmentsdata['list']=Departments::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Departments']])->get();
		$departmentsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($departmentsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('departmentsdata'));
		}else{
			return view('admin.departments.report',compact('departmentsdata'));
		}
	}

	public function chart(){
		return view('admin.departments.chart');
	}

	public function store(Request $request){
		$departments=new Departments();
		$departments->code=$request->get('code');
		$departments->name=$request->get('name');
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Departments']])->get();
		$departmentsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($departmentsdata['usersaccountsroles'][0]['_show']==1){
			try{
				if($departments->save()){
					$response['status']='1';
					$response['message']='departments Added successfully';
					return json_encode($response);
			}else{
					$response['status']='0';
					$response['message']='Failed to add departments. Please try again';
					return json_encode($response);
				}
			}
			catch(Exception $e){
					$response['status']='0';
					$response['message']='An Error occured while attempting to add departments. Please try again';
					return json_encode($response);
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$departmentsdata['data']=Departments::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Departments']])->get();
		$departmentsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($departmentsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('departmentsdata'));
		}else{
		return view('admin.departments.edit',compact('departmentsdata','id'));
		}
	}

	public function show($id){
		$departmentsdata['data']=Departments::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Departments']])->get();
		$departmentsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($departmentsdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('departmentsdata'));
		}else{
		return view('admin.departments.show',compact('departmentsdata','id'));
		}
	}

	public function update(Request $request,$id){
		$departments=Departments::find($id);
		$departments->code=$request->get('code');
		$departments->name=$request->get('name');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Departments']])->get();
		$departmentsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($departmentsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('departmentsdata'));
		}else{
		$departments->save();
		$departmentsdata['data']=Departments::find($id);
		return view('admin.departments.edit',compact('departmentsdata','id'));
		}
	}

	public function destroy($id){
		$departments=Departments::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Departments']])->get();
		$departmentsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($departmentsdata['usersaccountsroles'][0]['_delete']==1){
			$departments->delete();
		}return redirect('admin/departments')->with('success','departments has been deleted!');
	}
}