<?php
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Groups;
use App\Companies;
use App\Modules;
use App\Users;
use App\Days;
use App\MeetingFrequencies;
use App\BankingModes;
use App\Employees;
use App\Positions;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\UsersAccountsRoles;
class GroupsImportController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$groupsdata['days']=Days::all();
		$groupsdata['meetingfrequencies']=MeetingFrequencies::all();
		$groupsdata['bankingmodes']=BankingModes::all();
		$position=Positions::where([['code','=','BDO']])->get();
		$groupsdata['employees']=Employees::where([['employee_category','=',$position[0]['id']]])->get();
		$groupsdata['list']=Groups::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Groups']])->get();
		$groupsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($groupsdata['usersaccountsroles'][0]['_add']==0&&$groupsdata['usersaccountsroles'][0]['_list']==0&&$groupsdata['usersaccountsroles'][0]['_edit']==0&&$groupsdata['usersaccountsroles'][0]['_edit']==0&&$groupsdata['usersaccountsroles'][0]['_show']==0&&$groupsdata['usersaccountsroles'][0]['_delete']==0&&$groupsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('groupsdata'));
		}else{
			return view('admin.groups_import.index',compact('groupsdata'));
		}
	}

	public function create(){
		$groupsdata;
		$groupsdata['days']=Days::all();
		$groupsdata['meetingfrequencies']=MeetingFrequencies::all();
		$groupsdata['bankingmodes']=BankingModes::all();
		$position=Positions::where([['code','=','BDO']])->get();
		$groupsdata['employees']=Employees::where([['employee_category','=',$position[0]['id']]])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Groups']])->get();
		$groupsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($groupsdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('groupsdata'));
		}else{
			return view('admin.groups.create',compact('groupsdata'));
		}
	}
	function groupsCount(){
		$count=Groups::count();
		return $count;
	}

	public function filter(Request $request){
		$groupsdata['days']=Days::all();
		$groupsdata['meetingfrequencies']=MeetingFrequencies::all();
		$groupsdata['bankingmodes']=BankingModes::all();
		$position=Positions::where([['code','=','BDO']])->get();
		$groupsdata['employees']=Employees::where([['employee_category','=',$position[0]['id']]])->get();

		$groupsdata['list']=Groups::where([['group_number','LIKE','%'.$request->get('group_number').'%'],['group_name','LIKE','%'.$request->get('group_name').'%'],['meeting_day','LIKE','%'.$request->get('meeting_day').'%'],['meeting_time','LIKE','%'.$request->get('meeting_time').'%'],['meeting_frequency','LIKE','%'.$request->get('meeting_frequency').'%'],['preferred_mode_of_banking','LIKE','%'.$request->get('preferred_mode_of_banking').'%'],['officer','LIKE','%'.$request->get('officer').'%'],])->orWhereBetween('registration_date',[$request->get('registration_datefrom'),$request->get('registration_dateto')])->orWhereBetween('group_formation_date',[$request->get('group_formation_datefrom'),$request->get('group_formation_dateto')])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Groups']])->get();
		$groupsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($groupsdata['usersaccountsroles'][0]['_add']==0&&$groupsdata['usersaccountsroles'][0]['_list']==0&&$groupsdata['usersaccountsroles'][0]['_edit']==0&&$groupsdata['usersaccountsroles'][0]['_edit']==0&&$groupsdata['usersaccountsroles'][0]['_show']==0&&$groupsdata['usersaccountsroles'][0]['_delete']==0&&$groupsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('groupsdata'));
		}else{
			return view('admin.groups.index',compact('groupsdata'));
		}
	}

	public function report(){
		$groupsdata['company']=Companies::all();
		$groupsdata['list']=Groups::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Groups']])->get();
		$groupsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($groupsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('groupsdata'));
		}else{
			return view('admin.groups.report',compact('groupsdata'));
		}
	}

	public function chart(){
		return view('admin.groups.chart');
	}

	public function store(Request $request){
		$groups=new Groups();
		$groups->group_number=$request->get('group_number');
		$groups->group_name=$request->get('group_name');
		$groups->meeting_day=$request->get('meeting_day');
		$groups->meeting_time=$request->get('meeting_time');
		$groups->meeting_frequency=$request->get('meeting_frequency');
		$groups->preferred_mode_of_banking=$request->get('preferred_mode_of_banking');
		$groups->registration_date=$request->get('registration_date');
		$groups->group_formation_date=$request->get('group_formation_date');
		$groups->officer=$request->get('officer');
		$response=array();
		ini_set('max_execution_time', 600);
		$query = DB::connection('mysql2')->select("select * from groups");
		DB::transaction(function() use($query){
			foreach ($query as $group) {
				$groups=new Groups();
				$groups->group_number=$group->group_number;
				$groups->group_name=$group->name;
				$day=Days::where([['name','=','Saturday']])->get();
				$groups->meeting_day=$day[0]['id'];
				$groups->meeting_time='3:13 PM';
				$frequency=MeetingFrequencies::wher([['no_of_days','=','7']])->get();

				$groups->meeting_frequency=$frequency[0]['id'];
				$bankingmode=BankingModes::where([['code','=','001']])->get();
				$groups->preferred_mode_of_banking=$bankingmode[0]['id'];
				$groups->registration_date='30/12/2017';
				$groups->group_formation_date='30/12/2017';

				$officer = DB::connection('mysql2')->select("select * from user where user_id='".$group->officer."'");
				$employee=Employees::where([['employee_number','=',$officer[0]->user_number]])->get();
				$groups->officer=$employee[0]['id'];
				$groups->save();
				
			}
	
		});
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Groups']])->get();
		$groupsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($groupsdata['usersaccountsroles'][0]['_show']==1){
			try{
				if($groups->save()){
					$response['status']='1';
					$response['message']='groups Added successfully';
					return json_encode($response);
			}else{
					$response['status']='0';
					$response['message']='Failed to add groups. Please try again';
					return json_encode($response);
				}
			}
			catch(Exception $e){
					$response['status']='0';
					$response['message']='An Error occured while attempting to add groups. Please try again';
					return json_encode($response);
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$groupsdata['days']=Days::all();
		$groupsdata['meetingfrequencies']=MeetingFrequencies::all();
		$groupsdata['bankingmodes']=BankingModes::all();
		$position=Positions::where([['code','=','BDO']])->get();
		$groupsdata['employees']=Employees::where([['employee_category','=',$position[0]['id']]])->get();
		$groupsdata['data']=Groups::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Groups']])->get();
		$groupsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($groupsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('groupsdata'));
		}else{
		return view('admin.groups.edit',compact('groupsdata','id'));
		}
	}

	public function show($id){
		$groupsdata['days']=Days::all();
		$groupsdata['meetingfrequencies']=MeetingFrequencies::all();
		$groupsdata['bankingmodes']=BankingModes::all();
		$position=Positions::where([['code','=','BDO']])->get();
		$groupsdata['employees']=Employees::where([['employee_category','=',$position[0]['id']]])->get();
		$groupsdata['data']=Groups::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Groups']])->get();
		$groupsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($groupsdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('groupsdata'));
		}else{
		return view('admin.groups.show',compact('groupsdata','id'));
		}
	}

	public function update(Request $request,$id){
		$groups=Groups::find($id);
		$groups->group_number=$request->get('group_number');
		$groups->group_name=$request->get('group_name');
		$groups->meeting_day=$request->get('meeting_day');
		$groups->meeting_time=$request->get('meeting_time');
		$groups->meeting_frequency=$request->get('meeting_frequency');
		$groups->preferred_mode_of_banking=$request->get('preferred_mode_of_banking');
		$groups->registration_date=$request->get('registration_date');
		$groups->group_formation_date=$request->get('group_formation_date');
		$groups->officer=$request->get('officer');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Groups']])->get();
		$groupsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($groupsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('groupsdata'));
		}else{
		$groups->save();
		$groupsdata['data']=Groups::find($id);
		return view('admin.groups.edit',compact('groupsdata','id'));
		}
	}

	public function destroy($id){
		$groups=Groups::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Groups']])->get();
		$groupsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($groupsdata['usersaccountsroles'][0]['_delete']==1){
			$groups->delete();
		}return redirect('admin/groups')->with('success','groups has been deleted!');
	}
}