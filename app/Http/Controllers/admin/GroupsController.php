<?php
namespace App\Http\Controllers\admin;
use App\Days;
use App\Users;
use App\Groups;
use App\Clients;
use App\Modules;
use App\Companies;
use App\Employees;
use App\Positions;
use App\GroupRoles;
use App\ClientTypes;
use App\BankingModes;
use App\Branches;
use App\GroupClients;
use App\GroupLeadership;
use App\GroupLeadershipCategory;
use App\GroupStatuses;
use App\Http\Requests;
use App\MeetingFrequencies;
use App\UsersAccountsRoles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Client;
use App\Http\Controllers\Controller;

class GroupsController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$groupsdata['days']=Days::all();
		$groupsdata['groupstatuses']=GroupStatuses::all();
		$groupsdata['meetingfrequencies']=MeetingFrequencies::all();
		$groupsdata['bankingmodes']=BankingModes::all();
		$position=Positions::where([['code','=','BDO']])->get();
		$groupsdata['employees']=Employees::where([['position','=',$position[0]['id']]])->get();
		$groupsdata['list']=Groups::withTrashed()->orderBy('created_at','asc')->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Groups']])->get();
		$groupsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($groupsdata['usersaccountsroles'][0]['_add']==0&&$groupsdata['usersaccountsroles'][0]['_list']==0&&$groupsdata['usersaccountsroles'][0]['_edit']==0&&$groupsdata['usersaccountsroles'][0]['_edit']==0&&$groupsdata['usersaccountsroles'][0]['_show']==0&&$groupsdata['usersaccountsroles'][0]['_delete']==0&&$groupsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('groupsdata'));
		}else{
			return view('admin.groups.index',compact('groupsdata'));
		}
	}

	public function create(){
		$groupsdata;
		$groupsdata['days']=Days::all();
		$groupsdata['groupstatuses']=GroupStatuses::all();
		$groupsdata["grouproles"]=GroupRoles::all();
		$clienttypes=ClientTypes::where([['code','=','001']])->get();
		$groupsdata['branches']=Branches::with('employees')->get();
		$groupsdata['clients']=Clients::where([['client_type','=',$clienttypes[0]->id],['assigned_group','=','0']])->get();
		$groupsdata['meetingfrequencies']=MeetingFrequencies::all();
		$groupsdata['bankingmodes']=BankingModes::all();
		$position=Positions::where([['code','=','BDO']])->get();
		$groupsdata['employees']=Employees::where([['position','=',$position[0]['id']]])->get();
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
		$groupsdata['groupstatuses']=GroupStatuses::all();
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
		$groupsdata['groupstatuses']=GroupStatuses::all();
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

	public function store(Request $request) {
		$groups=new Groups();
		$groupsdata['groupstatuses']=GroupStatuses::all();

		$count=Groups::all()->count();

        if($count<10){
            $groups->group_number="G0000".($count+1);
        }else if($count<100){
            $groups->group_number="G000".($count+1);
        }else if($count<1000){
            $groups->group_number="G00".($count+1);
        }else if($count<10000){
            $groups->group_number="G0".($count+1);
        }else{
            $groups->group_number="G".($count+1);
        }

		
		$groups->group_name=$request->get('group_name');
		$groups->meeting_day=$request->get('meeting_day');
		$groups->meeting_time=$request->get('meeting_time');
		$groups->meeting_frequency=$request->get('meeting_frequency');
		$groups->preferred_mode_of_banking=$request->get('preferred_mode_of_banking');
		$groups->registration_date=$request->get('registration_date');
		$groups->group_formation_date=$request->get('group_formation_date');
		$groups->officer=$request->get('officer');
		$groups->branch_id=$request->get('branch');
		$response=array();
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

	public function dbimport(){
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
				$frequency=MeetingFrequencies::where([['no_of_days','=','7']])->get();

				$groups->meeting_frequency=$frequency[0]['id'];
				$bankingmode=BankingModes::where([['code','=','001']])->get();
				$groups->preferred_mode_of_banking=$bankingmode[0]['id'];
				$groups->registration_date='30/12/2017';
				$groups->group_formation_date='30/12/2017';

				$officer = DB::connection('mysql2')->select("select * from user where user_id='".$group->officer."'");

				if(isset($officer[0])){
					$employee=Employees::where([['employee_number','=',$officer[0]->user_number]])->get();

					$groups->officer=$employee[0]['id'];
				}else{
					$groups->officer=29;
				}


				
				
				$groups->save();
				
			}
	
		});
		$groupsdata['days']=Days::all();
		$groupsdata['meetingfrequencies']=MeetingFrequencies::all();
		$groupsdata['bankingmodes']=BankingModes::all();
		$position=Positions::where([['code','=','BDO']])->get();
		$groupsdata['employees']=Employees::where([['position','=',$position[0]['id']]])->get();
		$groupsdata['list']=Groups::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Groups']])->get();
		$groupsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($groupsdata['usersaccountsroles'][0]['_add']==0&&$groupsdata['usersaccountsroles'][0]['_list']==0&&$groupsdata['usersaccountsroles'][0]['_edit']==0&&$groupsdata['usersaccountsroles'][0]['_edit']==0&&$groupsdata['usersaccountsroles'][0]['_show']==0&&$groupsdata['usersaccountsroles'][0]['_delete']==0&&$groupsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('groupsdata'));
		}else{
			return view('admin.groups.index',compact('groupsdata'));
		}
	}


	public function edit($id){
		$groupsdata['days']=Days::all();
		$groupsdata['groupstatuses']=GroupStatuses::all();
		$groupsdata['meetingfrequencies']=MeetingFrequencies::all();
		$groupsdata['bankingmodes']=BankingModes::all();
		$position=Positions::where([['code','=','BDO']])->get();
		$groupsdata['branches']=Branches::with('employees')->get();
		$groupsdata['employees']=Employees::where([['position','=',$position[0]['id']]])->get();
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
		$groupsdata['groupstatuses']=GroupStatuses::all();
		$groupsdata['meetingfrequencies']=MeetingFrequencies::all();
		$groupsdata['bankingmodes']=BankingModes::all();
		$position=Positions::where([['code','=','BDO']])->get();
		$groupsdata['employees']=Employees::where([['position','=',$position[0]['id']]])->get();
		$groupsdata['clients'] = GroupClients::where('group_clients.client_group', $id)
			->leftJoin('clients', 'group_clients.client', '=', 'clients.id')
			->with('leadership.category')
			->get();
		$groupsdata['leadership'] = GroupLeadership::where('group_id', $id)
			->with('category', 'client')
			->orderBy('occupied_at', 'DESC')
			->get();
		$operations = [];
		foreach(GroupLeadershipCategory::all() as $category) {
			$operations[] = [
				'category' => $category,
				'leadership' => collect($groupsdata['leadership'])->where('category_id', $category->id)->where('vacated_at', '=', NULL)->first()
			];
		};
		$groupsdata['operations'] = $operations;
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

	public function update(Request $request, $id){
		// dd($request->all());
		$groups=Groups::find($id);
		$groupsdata['groupstatuses']=GroupStatuses::all();
		$groups->group_number=$request->get('group_number');
		$groups->group_name=$request->get('group_name');
		$groups->meeting_day=$request->get('meeting_day');
		$groups->meeting_time=$request->get('meeting_time');
		$groups->meeting_frequency=$request->get('meeting_frequency');
		$groups->preferred_mode_of_banking=$request->get('preferred_mode_of_banking');
		$groups->registration_date=$request->get('registration_date');
		$groups->group_formation_date=$request->get('group_formation_date');
		$groups->officer=$request->get('officer');
		$groups->branch_id=$request->get('branch');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Groups']])->get();
		$groupsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($groupsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('groupsdata'));
		}else{
			$groups->save();

			$groupClients = GroupClients::where('client_group', $id)->get();

			foreach ($groupClients as $_client) {
				$client = Clients::find($_client->client);
				$client->assigned_officer = $groups->officer;
				$client->save();
			}

			$groupsdata['data']=Groups::find($id);
		}

		return redirect()->route('groups.edit', $id);
	}

	public function customize(Groups $groups, Request $request) {
		$groups->group_name=$request->get('group_name');
		$groups->meeting_day=$request->get('meeting_day');
		$groups->meeting_time=$request->get('meeting_time');
		$groups->meeting_frequency=$request->get('meeting_frequency');
		$groups->preferred_mode_of_banking=$request->get('preferred_mode_of_banking');
		$groups->registration_date=$request->get('registration_date');
		$groups->group_formation_date=$request->get('group_formation_date');
		$groups->officer=$request->get('officer');
		$groups->status=$request->get('status');
		$groups->_gps_latitude=$request->get('_gps_latitude');
		$groups->_gps_longitude=$request->get('_gps_longitude');
		$groups->save();

		return redirect()->back();
	}

	public function destroy(Request $request, $id) {
		$groups=Groups::where('id', $id)->withTrashed()->first();
		$groupsdata['groupstatuses']=GroupStatuses::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Groups']])->get();
		$groupsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if ($groupsdata['usersaccountsroles'][0]['_delete']==1) {
			$groups->_narrative = isset($request->_narrative) ? trim($request->_narrative) : NULL;
			$groups->save();

			if ($request->action == 'deactivate') {
				$groups->delete();

				return response()->json([
					'icon' => 'success',
					'message' => 'Group successfully deactivated!'
				]);
			} elseif ($request->action == 'activate') {
				$groups->deleted_at = NULL;
				$groups->save();

				return response()->json([
					'icon' => 'success',
					'message' => 'Group successfully activated!'
				]);
			} else {
				return response()->json([
					'icon' => 'warning',
					'message' => 'Ops! Group deletion unsuccessful, please try again!'
				]);
			}
		}
	}
}