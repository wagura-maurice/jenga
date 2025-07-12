<?php
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\GracePeriods;
use App\Companies;
use App\Modules;
use App\Users;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;
class GracePeriodsController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$graceperiodsdata['list']=GracePeriods::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','GracePeriods']])->get();
		$graceperiodsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($graceperiodsdata['usersaccountsroles'][0]['_add']==0&&$graceperiodsdata['usersaccountsroles'][0]['_list']==0&&$graceperiodsdata['usersaccountsroles'][0]['_edit']==0&&$graceperiodsdata['usersaccountsroles'][0]['_edit']==0&&$graceperiodsdata['usersaccountsroles'][0]['_show']==0&&$graceperiodsdata['usersaccountsroles'][0]['_delete']==0&&$graceperiodsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('graceperiodsdata'));
		}else{
			return view('admin.grace_periods.index',compact('graceperiodsdata'));
		}
	}

	public function create(){
		$graceperiodsdata;
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','GracePeriods']])->get();
		$graceperiodsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($graceperiodsdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('graceperiodsdata'));
		}else{
			return view('admin.grace_periods.create',compact('graceperiodsdata'));
		}
	}

	public function filter(Request $request){
		$graceperiodsdata['list']=GracePeriods::where([['name','LIKE','%'.$request->get('name').'%'],['number_of_days','LIKE','%'.$request->get('number_of_days').'%'],])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','GracePeriods']])->get();
		$graceperiodsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($graceperiodsdata['usersaccountsroles'][0]['_add']==0&&$graceperiodsdata['usersaccountsroles'][0]['_list']==0&&$graceperiodsdata['usersaccountsroles'][0]['_edit']==0&&$graceperiodsdata['usersaccountsroles'][0]['_edit']==0&&$graceperiodsdata['usersaccountsroles'][0]['_show']==0&&$graceperiodsdata['usersaccountsroles'][0]['_delete']==0&&$graceperiodsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('graceperiodsdata'));
		}else{
			return view('admin.grace_periods.index',compact('graceperiodsdata'));
		}
	}

	public function report(){
		$graceperiodsdata['company']=Companies::all();
		$graceperiodsdata['list']=GracePeriods::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','GracePeriods']])->get();
		$graceperiodsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($graceperiodsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('graceperiodsdata'));
		}else{
			return view('admin.grace_periods.report',compact('graceperiodsdata'));
		}
	}

	public function chart(){
		return view('admin.grace_periods.chart');
	}

	public function store(Request $request){
		$graceperiods=new GracePeriods();
		$graceperiods->name=$request->get('name');
		$graceperiods->number_of_days=$request->get('number_of_days');
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','GracePeriods']])->get();
		$graceperiodsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($graceperiodsdata['usersaccountsroles'][0]['_show']==1){
			try{
				if($graceperiods->save()){
					$response['status']='1';
					$response['message']='grace periods Added successfully';
					return json_encode($response);
			}else{
					$response['status']='0';
					$response['message']='Failed to add grace periods. Please try again';
					return json_encode($response);
				}
			}
			catch(Exception $e){
					$response['status']='0';
					$response['message']='An Error occured while attempting to add grace periods. Please try again';
					return json_encode($response);
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$graceperiodsdata['data']=GracePeriods::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','GracePeriods']])->get();
		$graceperiodsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($graceperiodsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('graceperiodsdata'));
		}else{
		return view('admin.grace_periods.edit',compact('graceperiodsdata','id'));
		}
	}

	public function show($id){
		$graceperiodsdata['data']=GracePeriods::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','GracePeriods']])->get();
		$graceperiodsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($graceperiodsdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('graceperiodsdata'));
		}else{
		return view('admin.grace_periods.show',compact('graceperiodsdata','id'));
		}
	}

	public function update(Request $request,$id){
		$graceperiods=GracePeriods::find($id);
		$graceperiods->name=$request->get('name');
		$graceperiods->number_of_days=$request->get('number_of_days');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','GracePeriods']])->get();
		$graceperiodsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($graceperiodsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('graceperiodsdata'));
		}else{
		$graceperiods->save();
		$graceperiodsdata['data']=GracePeriods::find($id);
		return view('admin.grace_periods.edit',compact('graceperiodsdata','id'));
		}
	}

	public function destroy($id){
		$graceperiods=GracePeriods::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','GracePeriods']])->get();
		$graceperiodsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($graceperiodsdata['usersaccountsroles'][0]['_delete']==1){
			$graceperiods->delete();
		}return redirect('admin/graceperiods')->with('success','grace periods has been deleted!');
	}
}