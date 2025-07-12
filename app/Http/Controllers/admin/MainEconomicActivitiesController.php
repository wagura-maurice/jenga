<?php
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\MainEconomicActivities;
use App\Companies;
use App\Modules;
use App\Users;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;
class MainEconomicActivitiesController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$maineconomicactivitiesdata['list']=MainEconomicActivities::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','MainEconomicActivities']])->get();
		$maineconomicactivitiesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($maineconomicactivitiesdata['usersaccountsroles'][0]['_add']==0&&$maineconomicactivitiesdata['usersaccountsroles'][0]['_list']==0&&$maineconomicactivitiesdata['usersaccountsroles'][0]['_edit']==0&&$maineconomicactivitiesdata['usersaccountsroles'][0]['_edit']==0&&$maineconomicactivitiesdata['usersaccountsroles'][0]['_show']==0&&$maineconomicactivitiesdata['usersaccountsroles'][0]['_delete']==0&&$maineconomicactivitiesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('maineconomicactivitiesdata'));
		}else{
			return view('admin.main_economic_activities.index',compact('maineconomicactivitiesdata'));
		}
	}

	public function create(){
		$maineconomicactivitiesdata;
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','MainEconomicActivities']])->get();
		$maineconomicactivitiesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($maineconomicactivitiesdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('maineconomicactivitiesdata'));
		}else{
			return view('admin.main_economic_activities.create',compact('maineconomicactivitiesdata'));
		}
	}

	public function filter(Request $request){
		$maineconomicactivitiesdata['list']=MainEconomicActivities::where([['code','LIKE','%'.$request->get('code').'%'],['name','LIKE','%'.$request->get('name').'%'],['description','LIKE','%'.$request->get('description').'%'],])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','MainEconomicActivities']])->get();
		$maineconomicactivitiesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($maineconomicactivitiesdata['usersaccountsroles'][0]['_add']==0&&$maineconomicactivitiesdata['usersaccountsroles'][0]['_list']==0&&$maineconomicactivitiesdata['usersaccountsroles'][0]['_edit']==0&&$maineconomicactivitiesdata['usersaccountsroles'][0]['_edit']==0&&$maineconomicactivitiesdata['usersaccountsroles'][0]['_show']==0&&$maineconomicactivitiesdata['usersaccountsroles'][0]['_delete']==0&&$maineconomicactivitiesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('maineconomicactivitiesdata'));
		}else{
			return view('admin.main_economic_activities.index',compact('maineconomicactivitiesdata'));
		}
	}

	public function report(){
		$maineconomicactivitiesdata['company']=Companies::all();
		$maineconomicactivitiesdata['list']=MainEconomicActivities::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','MainEconomicActivities']])->get();
		$maineconomicactivitiesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($maineconomicactivitiesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('maineconomicactivitiesdata'));
		}else{
			return view('admin.main_economic_activities.report',compact('maineconomicactivitiesdata'));
		}
	}

	public function chart(){
		return view('admin.main_economic_activities.chart');
	}

	public function store(Request $request){
		$maineconomicactivities=new MainEconomicActivities();
		$maineconomicactivities->code=$request->get('code');
		$maineconomicactivities->name=$request->get('name');
		$maineconomicactivities->description=$request->get('description');
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','MainEconomicActivities']])->get();
		$maineconomicactivitiesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($maineconomicactivitiesdata['usersaccountsroles'][0]['_show']==1){
			try{
				if($maineconomicactivities->save()){
					$response['status']='1';
					$response['message']='main economic activities Added successfully';
					return json_encode($response);
			}else{
					$response['status']='0';
					$response['message']='Failed to add main economic activities. Please try again';
					return json_encode($response);
				}
			}
			catch(Exception $e){
					$response['status']='0';
					$response['message']='An Error occured while attempting to add main economic activities. Please try again';
					return json_encode($response);
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$maineconomicactivitiesdata['data']=MainEconomicActivities::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','MainEconomicActivities']])->get();
		$maineconomicactivitiesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($maineconomicactivitiesdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('maineconomicactivitiesdata'));
		}else{
		return view('admin.main_economic_activities.edit',compact('maineconomicactivitiesdata','id'));
		}
	}

	public function show($id){
		$maineconomicactivitiesdata['data']=MainEconomicActivities::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','MainEconomicActivities']])->get();
		$maineconomicactivitiesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($maineconomicactivitiesdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('maineconomicactivitiesdata'));
		}else{
		return view('admin.main_economic_activities.show',compact('maineconomicactivitiesdata','id'));
		}
	}

	public function update(Request $request,$id){
		$maineconomicactivities=MainEconomicActivities::find($id);
		$maineconomicactivities->code=$request->get('code');
		$maineconomicactivities->name=$request->get('name');
		$maineconomicactivities->description=$request->get('description');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','MainEconomicActivities']])->get();
		$maineconomicactivitiesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($maineconomicactivitiesdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('maineconomicactivitiesdata'));
		}else{
		$maineconomicactivities->save();
		$maineconomicactivitiesdata['data']=MainEconomicActivities::find($id);
		return view('admin.main_economic_activities.edit',compact('maineconomicactivitiesdata','id'));
		}
	}

	public function destroy($id){
		$maineconomicactivities=MainEconomicActivities::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','MainEconomicActivities']])->get();
		$maineconomicactivitiesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($maineconomicactivitiesdata['usersaccountsroles'][0]['_delete']==1){
			$maineconomicactivities->delete();
		}return redirect('admin/maineconomicactivities')->with('success','main economic activities has been deleted!');
	}
}