<?php
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\ManagesDepartmentsData;
use App\Companies;
use App\Modules;
use App\Users;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;
class ManagesDepartmentsDataController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$managesdepartmentsdatadata['list']=ManagesDepartmentsData::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ManagesDepartmentsData']])->get();
		$managesdepartmentsdatadata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($managesdepartmentsdatadata['usersaccountsroles'][0]['_add']==0&&$managesdepartmentsdatadata['usersaccountsroles'][0]['_list']==0&&$managesdepartmentsdatadata['usersaccountsroles'][0]['_edit']==0&&$managesdepartmentsdatadata['usersaccountsroles'][0]['_edit']==0&&$managesdepartmentsdatadata['usersaccountsroles'][0]['_show']==0&&$managesdepartmentsdatadata['usersaccountsroles'][0]['_delete']==0&&$managesdepartmentsdatadata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('managesdepartmentsdatadata'));
		}else{
			return view('admin.manages_departments_data.index',compact('managesdepartmentsdatadata'));
		}
	}

	public function create(){
		$managesdepartmentsdatadata;
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ManagesDepartmentsData']])->get();
		$managesdepartmentsdatadata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($managesdepartmentsdatadata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('managesdepartmentsdatadata'));
		}else{
			return view('admin.manages_departments_data.create',compact('managesdepartmentsdatadata'));
		}
	}

	public function filter(Request $request){
		$managesdepartmentsdatadata['list']=ManagesDepartmentsData::where([['code','LIKE','%'.$request->get('code').'%'],['name','LIKE','%'.$request->get('name').'%'],])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ManagesDepartmentsData']])->get();
		$managesdepartmentsdatadata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($managesdepartmentsdatadata['usersaccountsroles'][0]['_add']==0&&$managesdepartmentsdatadata['usersaccountsroles'][0]['_list']==0&&$managesdepartmentsdatadata['usersaccountsroles'][0]['_edit']==0&&$managesdepartmentsdatadata['usersaccountsroles'][0]['_edit']==0&&$managesdepartmentsdatadata['usersaccountsroles'][0]['_show']==0&&$managesdepartmentsdatadata['usersaccountsroles'][0]['_delete']==0&&$managesdepartmentsdatadata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('managesdepartmentsdatadata'));
		}else{
			return view('admin.manages_departments_data.index',compact('managesdepartmentsdatadata'));
		}
	}

	public function report(){
		$managesdepartmentsdatadata['company']=Companies::all();
		$managesdepartmentsdatadata['list']=ManagesDepartmentsData::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ManagesDepartmentsData']])->get();
		$managesdepartmentsdatadata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($managesdepartmentsdatadata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('managesdepartmentsdatadata'));
		}else{
			return view('admin.manages_departments_data.report',compact('managesdepartmentsdatadata'));
		}
	}

	public function chart(){
		return view('admin.manages_departments_data.chart');
	}

	public function store(Request $request){
		$managesdepartmentsdata=new ManagesDepartmentsData();
		$managesdepartmentsdata->code=$request->get('code');
		$managesdepartmentsdata->name=$request->get('name');
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ManagesDepartmentsData']])->get();
		$managesdepartmentsdatadata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($managesdepartmentsdatadata['usersaccountsroles'][0]['_show']==1){
			try{
				if($managesdepartmentsdata->save()){
					$response['status']='1';
					$response['message']='manages departments data Added successfully';
					return json_encode($response);
			}else{
					$response['status']='0';
					$response['message']='Failed to add manages departments data. Please try again';
					return json_encode($response);
				}
			}
			catch(Exception $e){
					$response['status']='0';
					$response['message']='An Error occured while attempting to add manages departments data. Please try again';
					return json_encode($response);
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$managesdepartmentsdatadata['data']=ManagesDepartmentsData::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ManagesDepartmentsData']])->get();
		$managesdepartmentsdatadata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($managesdepartmentsdatadata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('managesdepartmentsdatadata'));
		}else{
		return view('admin.manages_departments_data.edit',compact('managesdepartmentsdatadata','id'));
		}
	}

	public function show($id){
		$managesdepartmentsdatadata['data']=ManagesDepartmentsData::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ManagesDepartmentsData']])->get();
		$managesdepartmentsdatadata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($managesdepartmentsdatadata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('managesdepartmentsdatadata'));
		}else{
		return view('admin.manages_departments_data.show',compact('managesdepartmentsdatadata','id'));
		}
	}

	public function update(Request $request,$id){
		$managesdepartmentsdata=ManagesDepartmentsData::find($id);
		$managesdepartmentsdata->code=$request->get('code');
		$managesdepartmentsdata->name=$request->get('name');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ManagesDepartmentsData']])->get();
		$managesdepartmentsdatadata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($managesdepartmentsdatadata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('managesdepartmentsdatadata'));
		}else{
		$managesdepartmentsdata->save();
		$managesdepartmentsdatadata['data']=ManagesDepartmentsData::find($id);
		return view('admin.manages_departments_data.edit',compact('managesdepartmentsdatadata','id'));
		}
	}

	public function destroy($id){
		$managesdepartmentsdata=ManagesDepartmentsData::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ManagesDepartmentsData']])->get();
		$managesdepartmentsdatadata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($managesdepartmentsdatadata['usersaccountsroles'][0]['_delete']==1){
			$managesdepartmentsdata->delete();
		}return redirect('admin/managesdepartmentsdata')->with('success','manages departments data has been deleted!');
	}
}