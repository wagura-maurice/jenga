<?php
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\SecondaryEconomicActivities;
use App\Companies;
use App\Modules;
use App\Users;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;
class SecondaryEconomicActivitiesController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$secondaryeconomicactivitiesdata['list']=SecondaryEconomicActivities::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','SecondaryEconomicActivities']])->get();
		$secondaryeconomicactivitiesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($secondaryeconomicactivitiesdata['usersaccountsroles'][0]['_add']==0&&$secondaryeconomicactivitiesdata['usersaccountsroles'][0]['_list']==0&&$secondaryeconomicactivitiesdata['usersaccountsroles'][0]['_edit']==0&&$secondaryeconomicactivitiesdata['usersaccountsroles'][0]['_edit']==0&&$secondaryeconomicactivitiesdata['usersaccountsroles'][0]['_show']==0&&$secondaryeconomicactivitiesdata['usersaccountsroles'][0]['_delete']==0&&$secondaryeconomicactivitiesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('secondaryeconomicactivitiesdata'));
		}else{
			return view('admin.secondary_economic_activities.index',compact('secondaryeconomicactivitiesdata'));
		}
	}

	public function create(){
		$secondaryeconomicactivitiesdata;
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','SecondaryEconomicActivities']])->get();
		$secondaryeconomicactivitiesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($secondaryeconomicactivitiesdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('secondaryeconomicactivitiesdata'));
		}else{
			return view('admin.secondary_economic_activities.create',compact('secondaryeconomicactivitiesdata'));
		}
	}

	public function filter(Request $request){
		$secondaryeconomicactivitiesdata['list']=SecondaryEconomicActivities::where([['code','LIKE','%'.$request->get('code').'%'],['name','LIKE','%'.$request->get('name').'%'],['description','LIKE','%'.$request->get('description').'%'],])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','SecondaryEconomicActivities']])->get();
		$secondaryeconomicactivitiesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($secondaryeconomicactivitiesdata['usersaccountsroles'][0]['_add']==0&&$secondaryeconomicactivitiesdata['usersaccountsroles'][0]['_list']==0&&$secondaryeconomicactivitiesdata['usersaccountsroles'][0]['_edit']==0&&$secondaryeconomicactivitiesdata['usersaccountsroles'][0]['_edit']==0&&$secondaryeconomicactivitiesdata['usersaccountsroles'][0]['_show']==0&&$secondaryeconomicactivitiesdata['usersaccountsroles'][0]['_delete']==0&&$secondaryeconomicactivitiesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('secondaryeconomicactivitiesdata'));
		}else{
			return view('admin.secondary_economic_activities.index',compact('secondaryeconomicactivitiesdata'));
		}
	}

	public function report(){
		$secondaryeconomicactivitiesdata['company']=Companies::all();
		$secondaryeconomicactivitiesdata['list']=SecondaryEconomicActivities::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','SecondaryEconomicActivities']])->get();
		$secondaryeconomicactivitiesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($secondaryeconomicactivitiesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('secondaryeconomicactivitiesdata'));
		}else{
			return view('admin.secondary_economic_activities.report',compact('secondaryeconomicactivitiesdata'));
		}
	}

	public function chart(){
		return view('admin.secondary_economic_activities.chart');
	}

	public function store(Request $request){
		$secondaryeconomicactivities=new SecondaryEconomicActivities();
		$secondaryeconomicactivities->code=$request->get('code');
		$secondaryeconomicactivities->name=$request->get('name');
		$secondaryeconomicactivities->description=$request->get('description');
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','SecondaryEconomicActivities']])->get();
		$secondaryeconomicactivitiesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($secondaryeconomicactivitiesdata['usersaccountsroles'][0]['_show']==1){
			try{
				if($secondaryeconomicactivities->save()){
					$response['status']='1';
					$response['message']='secondary economic activities Added successfully';
					return json_encode($response);
			}else{
					$response['status']='0';
					$response['message']='Failed to add secondary economic activities. Please try again';
					return json_encode($response);
				}
			}
			catch(Exception $e){
					$response['status']='0';
					$response['message']='An Error occured while attempting to add secondary economic activities. Please try again';
					return json_encode($response);
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$secondaryeconomicactivitiesdata['data']=SecondaryEconomicActivities::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','SecondaryEconomicActivities']])->get();
		$secondaryeconomicactivitiesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($secondaryeconomicactivitiesdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('secondaryeconomicactivitiesdata'));
		}else{
		return view('admin.secondary_economic_activities.edit',compact('secondaryeconomicactivitiesdata','id'));
		}
	}

	public function show($id){
		$secondaryeconomicactivitiesdata['data']=SecondaryEconomicActivities::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','SecondaryEconomicActivities']])->get();
		$secondaryeconomicactivitiesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($secondaryeconomicactivitiesdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('secondaryeconomicactivitiesdata'));
		}else{
		return view('admin.secondary_economic_activities.show',compact('secondaryeconomicactivitiesdata','id'));
		}
	}

	public function update(Request $request,$id){
		$secondaryeconomicactivities=SecondaryEconomicActivities::find($id);
		$secondaryeconomicactivities->code=$request->get('code');
		$secondaryeconomicactivities->name=$request->get('name');
		$secondaryeconomicactivities->description=$request->get('description');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','SecondaryEconomicActivities']])->get();
		$secondaryeconomicactivitiesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($secondaryeconomicactivitiesdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('secondaryeconomicactivitiesdata'));
		}else{
		$secondaryeconomicactivities->save();
		$secondaryeconomicactivitiesdata['data']=SecondaryEconomicActivities::find($id);
		return view('admin.secondary_economic_activities.edit',compact('secondaryeconomicactivitiesdata','id'));
		}
	}

	public function destroy($id){
		$secondaryeconomicactivities=SecondaryEconomicActivities::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','SecondaryEconomicActivities']])->get();
		$secondaryeconomicactivitiesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($secondaryeconomicactivitiesdata['usersaccountsroles'][0]['_delete']==1){
			$secondaryeconomicactivities->delete();
		}return redirect('admin/secondaryeconomicactivities')->with('success','secondary economic activities has been deleted!');
	}
}