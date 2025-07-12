<?php
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\EmployeeCategories;
use App\Companies;
use App\Modules;
use App\Users;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;
class EmployeeCategoriesController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$employeecategoriesdata['list']=EmployeeCategories::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','EmployeeCategories']])->get();
		$employeecategoriesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($employeecategoriesdata['usersaccountsroles'][0]['_add']==0&&$employeecategoriesdata['usersaccountsroles'][0]['_list']==0&&$employeecategoriesdata['usersaccountsroles'][0]['_edit']==0&&$employeecategoriesdata['usersaccountsroles'][0]['_edit']==0&&$employeecategoriesdata['usersaccountsroles'][0]['_show']==0&&$employeecategoriesdata['usersaccountsroles'][0]['_delete']==0&&$employeecategoriesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('employeecategoriesdata'));
		}else{
			return view('admin.employee_categories.index',compact('employeecategoriesdata'));
		}
	}

	public function create(){
		$employeecategoriesdata;
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','EmployeeCategories']])->get();
		$employeecategoriesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($employeecategoriesdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('employeecategoriesdata'));
		}else{
			return view('admin.employee_categories.create',compact('employeecategoriesdata'));
		}
	}

	public function filter(Request $request){
		$employeecategoriesdata['list']=EmployeeCategories::where([['code','LIKE','%'.$request->get('code').'%'],['name','LIKE','%'.$request->get('name').'%'],['description','LIKE','%'.$request->get('description').'%'],])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','EmployeeCategories']])->get();
		$employeecategoriesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($employeecategoriesdata['usersaccountsroles'][0]['_add']==0&&$employeecategoriesdata['usersaccountsroles'][0]['_list']==0&&$employeecategoriesdata['usersaccountsroles'][0]['_edit']==0&&$employeecategoriesdata['usersaccountsroles'][0]['_edit']==0&&$employeecategoriesdata['usersaccountsroles'][0]['_show']==0&&$employeecategoriesdata['usersaccountsroles'][0]['_delete']==0&&$employeecategoriesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('employeecategoriesdata'));
		}else{
			return view('admin.employee_categories.index',compact('employeecategoriesdata'));
		}
	}

	public function report(){
		$employeecategoriesdata['company']=Companies::all();
		$employeecategoriesdata['list']=EmployeeCategories::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','EmployeeCategories']])->get();
		$employeecategoriesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($employeecategoriesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('employeecategoriesdata'));
		}else{
			return view('admin.employee_categories.report',compact('employeecategoriesdata'));
		}
	}

	public function chart(){
		return view('admin.employee_categories.chart');
	}

	public function store(Request $request){
		$employeecategories=new EmployeeCategories();
		$employeecategories->code=$request->get('code');
		$employeecategories->name=$request->get('name');
		$employeecategories->description=$request->get('description');
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','EmployeeCategories']])->get();
		$employeecategoriesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($employeecategoriesdata['usersaccountsroles'][0]['_show']==1){
			try{
				if($employeecategories->save()){
					$response['status']='1';
					$response['message']='employee categories Added successfully';
					return json_encode($response);
			}else{
					$response['status']='0';
					$response['message']='Failed to add employee categories. Please try again';
					return json_encode($response);
				}
			}
			catch(Exception $e){
					$response['status']='0';
					$response['message']='An Error occured while attempting to add employee categories. Please try again';
					return json_encode($response);
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$employeecategoriesdata['data']=EmployeeCategories::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','EmployeeCategories']])->get();
		$employeecategoriesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($employeecategoriesdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('employeecategoriesdata'));
		}else{
		return view('admin.employee_categories.edit',compact('employeecategoriesdata','id'));
		}
	}

	public function show($id){
		$employeecategoriesdata['data']=EmployeeCategories::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','EmployeeCategories']])->get();
		$employeecategoriesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($employeecategoriesdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('employeecategoriesdata'));
		}else{
		return view('admin.employee_categories.show',compact('employeecategoriesdata','id'));
		}
	}

	public function update(Request $request,$id){
		$employeecategories=EmployeeCategories::find($id);
		$employeecategories->code=$request->get('code');
		$employeecategories->name=$request->get('name');
		$employeecategories->description=$request->get('description');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','EmployeeCategories']])->get();
		$employeecategoriesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($employeecategoriesdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('employeecategoriesdata'));
		}else{
		$employeecategories->save();
		$employeecategoriesdata['data']=EmployeeCategories::find($id);
		return view('admin.employee_categories.edit',compact('employeecategoriesdata','id'));
		}
	}

	public function destroy($id){
		$employeecategories=EmployeeCategories::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','EmployeeCategories']])->get();
		$employeecategoriesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($employeecategoriesdata['usersaccountsroles'][0]['_delete']==1){
			$employeecategories->delete();
		}return redirect('admin/employeecategories')->with('success','employee categories has been deleted!');
	}
}