<?php
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\MinimumMembershipPeriods;
use App\Companies;
use App\Modules;
use App\Users;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;
class MinimumMembershipPeriodsController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$minimummembershipperiodsdata['list']=MinimumMembershipPeriods::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','MinimumMembershipPeriods']])->get();
		$minimummembershipperiodsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($minimummembershipperiodsdata['usersaccountsroles'][0]['_add']==0&&$minimummembershipperiodsdata['usersaccountsroles'][0]['_list']==0&&$minimummembershipperiodsdata['usersaccountsroles'][0]['_edit']==0&&$minimummembershipperiodsdata['usersaccountsroles'][0]['_edit']==0&&$minimummembershipperiodsdata['usersaccountsroles'][0]['_show']==0&&$minimummembershipperiodsdata['usersaccountsroles'][0]['_delete']==0&&$minimummembershipperiodsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('minimummembershipperiodsdata'));
		}else{
			return view('admin.minimum_membership_periods.index',compact('minimummembershipperiodsdata'));
		}
	}

	public function create(){
		$minimummembershipperiodsdata;
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','MinimumMembershipPeriods']])->get();
		$minimummembershipperiodsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($minimummembershipperiodsdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('minimummembershipperiodsdata'));
		}else{
			return view('admin.minimum_membership_periods.create',compact('minimummembershipperiodsdata'));
		}
	}

	public function filter(Request $request){
		$minimummembershipperiodsdata['list']=MinimumMembershipPeriods::where([['name','LIKE','%'.$request->get('name').'%'],['number_of_days','LIKE','%'.$request->get('number_of_days').'%'],])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','MinimumMembershipPeriods']])->get();
		$minimummembershipperiodsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($minimummembershipperiodsdata['usersaccountsroles'][0]['_add']==0&&$minimummembershipperiodsdata['usersaccountsroles'][0]['_list']==0&&$minimummembershipperiodsdata['usersaccountsroles'][0]['_edit']==0&&$minimummembershipperiodsdata['usersaccountsroles'][0]['_edit']==0&&$minimummembershipperiodsdata['usersaccountsroles'][0]['_show']==0&&$minimummembershipperiodsdata['usersaccountsroles'][0]['_delete']==0&&$minimummembershipperiodsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('minimummembershipperiodsdata'));
		}else{
			return view('admin.minimum_membership_periods.index',compact('minimummembershipperiodsdata'));
		}
	}

	public function report(){
		$minimummembershipperiodsdata['company']=Companies::all();
		$minimummembershipperiodsdata['list']=MinimumMembershipPeriods::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','MinimumMembershipPeriods']])->get();
		$minimummembershipperiodsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($minimummembershipperiodsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('minimummembershipperiodsdata'));
		}else{
			return view('admin.minimum_membership_periods.report',compact('minimummembershipperiodsdata'));
		}
	}

	public function chart(){
		return view('admin.minimum_membership_periods.chart');
	}

	public function store(Request $request){
		$minimummembershipperiods=new MinimumMembershipPeriods();
		$minimummembershipperiods->name=$request->get('name');
		$minimummembershipperiods->number_of_days=$request->get('number_of_days');
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','MinimumMembershipPeriods']])->get();
		$minimummembershipperiodsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($minimummembershipperiodsdata['usersaccountsroles'][0]['_show']==1){
			try{
				if($minimummembershipperiods->save()){
					$response['status']='1';
					$response['message']='minimum membership periods Added successfully';
					return json_encode($response);
			}else{
					$response['status']='0';
					$response['message']='Failed to add minimum membership periods. Please try again';
					return json_encode($response);
				}
			}
			catch(Exception $e){
					$response['status']='0';
					$response['message']='An Error occured while attempting to add minimum membership periods. Please try again';
					return json_encode($response);
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$minimummembershipperiodsdata['data']=MinimumMembershipPeriods::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','MinimumMembershipPeriods']])->get();
		$minimummembershipperiodsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($minimummembershipperiodsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('minimummembershipperiodsdata'));
		}else{
		return view('admin.minimum_membership_periods.edit',compact('minimummembershipperiodsdata','id'));
		}
	}

	public function show($id){
		$minimummembershipperiodsdata['data']=MinimumMembershipPeriods::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','MinimumMembershipPeriods']])->get();
		$minimummembershipperiodsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($minimummembershipperiodsdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('minimummembershipperiodsdata'));
		}else{
		return view('admin.minimum_membership_periods.show',compact('minimummembershipperiodsdata','id'));
		}
	}

	public function update(Request $request,$id){
		$minimummembershipperiods=MinimumMembershipPeriods::find($id);
		$minimummembershipperiods->name=$request->get('name');
		$minimummembershipperiods->number_of_days=$request->get('number_of_days');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','MinimumMembershipPeriods']])->get();
		$minimummembershipperiodsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($minimummembershipperiodsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('minimummembershipperiodsdata'));
		}else{
		$minimummembershipperiods->save();
		$minimummembershipperiodsdata['data']=MinimumMembershipPeriods::find($id);
		return view('admin.minimum_membership_periods.edit',compact('minimummembershipperiodsdata','id'));
		}
	}

	public function destroy($id){
		$minimummembershipperiods=MinimumMembershipPeriods::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','MinimumMembershipPeriods']])->get();
		$minimummembershipperiodsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($minimummembershipperiodsdata['usersaccountsroles'][0]['_delete']==1){
			$minimummembershipperiods->delete();
		}return redirect('admin/minimummembershipperiods')->with('success','minimum membership periods has been deleted!');
	}
}