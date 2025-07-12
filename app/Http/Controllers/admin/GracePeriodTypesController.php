<?php
/**
* @author  Wanjala Innocent Khaemba
* Controller for GracePeriodTypes
*/
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\GracePeriodTypes;
use App\Companies;
use App\Modules;
use App\Users;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;
class GracePeriodTypesController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$graceperiodtypesdata['list']=GracePeriodTypes::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','GracePeriodTypes']])->get();
		$graceperiodtypesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($graceperiodtypesdata['usersaccountsroles'][0]['_add']==0&&$graceperiodtypesdata['usersaccountsroles'][0]['_list']==0&&$graceperiodtypesdata['usersaccountsroles'][0]['_edit']==0&&$graceperiodtypesdata['usersaccountsroles'][0]['_edit']==0&&$graceperiodtypesdata['usersaccountsroles'][0]['_show']==0&&$graceperiodtypesdata['usersaccountsroles'][0]['_delete']==0&&$graceperiodtypesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('graceperiodtypesdata'));
		}else{
			return view('admin.grace_period_types.index',compact('graceperiodtypesdata'));
		}
	}

	public function create(){
		$graceperiodtypesdata;
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','GracePeriodTypes']])->get();
		$graceperiodtypesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($graceperiodtypesdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('graceperiodtypesdata'));
		}else{
			return view('admin.grace_period_types.create',compact('graceperiodtypesdata'));
		}
	}

	public function filter(Request $request){
		$graceperiodtypesdata['list']=GracePeriodTypes::where([['code','LIKE','%'.$request->get('code').'%'],['name','LIKE','%'.$request->get('name').'%'],['description','LIKE','%'.$request->get('description').'%'],])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','GracePeriodTypes']])->get();
		$graceperiodtypesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($graceperiodtypesdata['usersaccountsroles'][0]['_add']==0&&$graceperiodtypesdata['usersaccountsroles'][0]['_list']==0&&$graceperiodtypesdata['usersaccountsroles'][0]['_edit']==0&&$graceperiodtypesdata['usersaccountsroles'][0]['_edit']==0&&$graceperiodtypesdata['usersaccountsroles'][0]['_show']==0&&$graceperiodtypesdata['usersaccountsroles'][0]['_delete']==0&&$graceperiodtypesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('graceperiodtypesdata'));
		}else{
			return view('admin.grace_period_types.index',compact('graceperiodtypesdata'));
		}
	}

	public function report(){
		$graceperiodtypesdata['company']=Companies::all();
		$graceperiodtypesdata['list']=GracePeriodTypes::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','GracePeriodTypes']])->get();
		$graceperiodtypesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($graceperiodtypesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('graceperiodtypesdata'));
		}else{
			return view('admin.grace_period_types.report',compact('graceperiodtypesdata'));
		}
	}

	public function chart(){
		return view('admin.grace_period_types.chart');
	}

	public function store(Request $request){
		$graceperiodtypes=new GracePeriodTypes();
		$graceperiodtypes->code=$request->get('code');
		$graceperiodtypes->name=$request->get('name');
		$graceperiodtypes->description=$request->get('description');
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','GracePeriodTypes']])->get();
		$graceperiodtypesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($graceperiodtypesdata['usersaccountsroles'][0]['_show']==1){
			try{
				if($graceperiodtypes->save()){
					$response['status']='1';
					$response['message']='grace period types Added successfully';
					return json_encode($response);
			}else{
					$response['status']='0';
					$response['message']='Failed to add grace period types. Please try again';
					return json_encode($response);
				}
			}
			catch(Exception $e){
					$response['status']='0';
					$response['message']='An Error occured while attempting to add grace period types. Please try again';
					return json_encode($response);
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$graceperiodtypesdata['data']=GracePeriodTypes::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','GracePeriodTypes']])->get();
		$graceperiodtypesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($graceperiodtypesdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('graceperiodtypesdata'));
		}else{
		return view('admin.grace_period_types.edit',compact('graceperiodtypesdata','id'));
		}
	}

	public function show($id){
		$graceperiodtypesdata['data']=GracePeriodTypes::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','GracePeriodTypes']])->get();
		$graceperiodtypesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($graceperiodtypesdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('graceperiodtypesdata'));
		}else{
		return view('admin.grace_period_types.show',compact('graceperiodtypesdata','id'));
		}
	}
	public function get($id){
		$graceperiodtypesdata=GracePeriodTypes::find($id);
		return json_encode($graceperiodtypesdata);
	}	

	public function update(Request $request,$id){
		$graceperiodtypes=GracePeriodTypes::find($id);
		$graceperiodtypes->code=$request->get('code');
		$graceperiodtypes->name=$request->get('name');
		$graceperiodtypes->description=$request->get('description');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','GracePeriodTypes']])->get();
		$graceperiodtypesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($graceperiodtypesdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('graceperiodtypesdata'));
		}else{
		$graceperiodtypes->save();
		$graceperiodtypesdata['data']=GracePeriodTypes::find($id);
		return view('admin.grace_period_types.edit',compact('graceperiodtypesdata','id'));
		}
	}

	public function destroy($id){
		$graceperiodtypes=GracePeriodTypes::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','GracePeriodTypes']])->get();
		$graceperiodtypesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($graceperiodtypesdata['usersaccountsroles'][0]['_delete']==1){
			$graceperiodtypes->delete();
		}return redirect('admin/graceperiodtypes')->with('success','grace period types has been deleted!');
	}
}