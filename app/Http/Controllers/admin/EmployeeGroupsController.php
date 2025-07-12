<?php
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\EmployeeGroups;
use App\Companies;
use App\Modules;
use App\Users;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;
class EmployeeGroupsController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$employeegroupsdata['list']=EmployeeGroups::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','EmployeeGroups']])->get();
		$employeegroupsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($employeegroupsdata['usersaccountsroles'][0]['_add']==0&&$employeegroupsdata['usersaccountsroles'][0]['_list']==0&&$employeegroupsdata['usersaccountsroles'][0]['_edit']==0&&$employeegroupsdata['usersaccountsroles'][0]['_edit']==0&&$employeegroupsdata['usersaccountsroles'][0]['_show']==0&&$employeegroupsdata['usersaccountsroles'][0]['_delete']==0&&$employeegroupsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('employeegroupsdata'));
		}else{
			return view('admin.employee_groups.index',compact('employeegroupsdata'));
		}
	}

	public function create(){
		$employeegroupsdata;
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','EmployeeGroups']])->get();
		$employeegroupsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($employeegroupsdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('employeegroupsdata'));
		}else{
			return view('admin.employee_groups.create',compact('employeegroupsdata'));
		}
	}

	public function filter(Request $request){
		$employeegroupsdata['list']=EmployeeGroups::where([['code','LIKE','%'.$request->get('code').'%'],['name','LIKE','%'.$request->get('name').'%'],['description','LIKE','%'.$request->get('description').'%'],])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','EmployeeGroups']])->get();
		$employeegroupsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($employeegroupsdata['usersaccountsroles'][0]['_add']==0&&$employeegroupsdata['usersaccountsroles'][0]['_list']==0&&$employeegroupsdata['usersaccountsroles'][0]['_edit']==0&&$employeegroupsdata['usersaccountsroles'][0]['_edit']==0&&$employeegroupsdata['usersaccountsroles'][0]['_show']==0&&$employeegroupsdata['usersaccountsroles'][0]['_delete']==0&&$employeegroupsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('employeegroupsdata'));
		}else{
			return view('admin.employee_groups.index',compact('employeegroupsdata'));
		}
	}

	public function report(){
		$employeegroupsdata['company']=Companies::all();
		$employeegroupsdata['list']=EmployeeGroups::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','EmployeeGroups']])->get();
		$employeegroupsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($employeegroupsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('employeegroupsdata'));
		}else{
			return view('admin.employee_groups.report',compact('employeegroupsdata'));
		}
	}

	public function chart(){
		return view('admin.employee_groups.chart');
	}

	public function store(Request $request){
		$employeegroups=new EmployeeGroups();
		$employeegroups->code=$request->get('code');
		$employeegroups->name=$request->get('name');
		$employeegroups->description=$request->get('description');
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','EmployeeGroups']])->get();
		$employeegroupsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($employeegroupsdata['usersaccountsroles'][0]['_show']==1){
			try{
				if($employeegroups->save()){
					$response['status']='1';
					$response['message']='employee groups Added successfully';
					return json_encode($response);
			}else{
					$response['status']='0';
					$response['message']='Failed to add employee groups. Please try again';
					return json_encode($response);
				}
			}
			catch(Exception $e){
					$response['status']='0';
					$response['message']='An Error occured while attempting to add employee groups. Please try again';
					return json_encode($response);
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$employeegroupsdata['data']=EmployeeGroups::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','EmployeeGroups']])->get();
		$employeegroupsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($employeegroupsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('employeegroupsdata'));
		}else{
		return view('admin.employee_groups.edit',compact('employeegroupsdata','id'));
		}
	}

	public function show($id){
		$employeegroupsdata['data']=EmployeeGroups::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','EmployeeGroups']])->get();
		$employeegroupsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($employeegroupsdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('employeegroupsdata'));
		}else{
		return view('admin.employee_groups.show',compact('employeegroupsdata','id'));
		}
	}

	public function update(Request $request,$id){
		$employeegroups=EmployeeGroups::find($id);
		$employeegroups->code=$request->get('code');
		$employeegroups->name=$request->get('name');
		$employeegroups->description=$request->get('description');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','EmployeeGroups']])->get();
		$employeegroupsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($employeegroupsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('employeegroupsdata'));
		}else{
		$employeegroups->save();
		$employeegroupsdata['data']=EmployeeGroups::find($id);
		return view('admin.employee_groups.edit',compact('employeegroupsdata','id'));
		}
	}

	public function destroy($id){
		$employeegroups=EmployeeGroups::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','EmployeeGroups']])->get();
		$employeegroupsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($employeegroupsdata['usersaccountsroles'][0]['_delete']==1){
			$employeegroups->delete();
		}return redirect('admin/employeegroups')->with('success','employee groups has been deleted!');
	}
}