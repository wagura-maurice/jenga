<?php
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\MeetingFrequencies;
use App\Companies;
use App\Modules;
use App\Users;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;
class MeetingFrequenciesController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$meetingfrequenciesdata['list']=MeetingFrequencies::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','MeetingFrequencies']])->get();
		$meetingfrequenciesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($meetingfrequenciesdata['usersaccountsroles'][0]['_add']==0&&$meetingfrequenciesdata['usersaccountsroles'][0]['_list']==0&&$meetingfrequenciesdata['usersaccountsroles'][0]['_edit']==0&&$meetingfrequenciesdata['usersaccountsroles'][0]['_edit']==0&&$meetingfrequenciesdata['usersaccountsroles'][0]['_show']==0&&$meetingfrequenciesdata['usersaccountsroles'][0]['_delete']==0&&$meetingfrequenciesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('meetingfrequenciesdata'));
		}else{
			return view('admin.meeting_frequencies.index',compact('meetingfrequenciesdata'));
		}
	}

	public function create(){
		$meetingfrequenciesdata;
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','MeetingFrequencies']])->get();
		$meetingfrequenciesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($meetingfrequenciesdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('meetingfrequenciesdata'));
		}else{
			return view('admin.meeting_frequencies.create',compact('meetingfrequenciesdata'));
		}
	}

	public function filter(Request $request){
		$meetingfrequenciesdata['list']=MeetingFrequencies::where([['name','LIKE','%'.$request->get('name').'%'],['no_of_days','LIKE','%'.$request->get('no_of_days').'%'],])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','MeetingFrequencies']])->get();
		$meetingfrequenciesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($meetingfrequenciesdata['usersaccountsroles'][0]['_add']==0&&$meetingfrequenciesdata['usersaccountsroles'][0]['_list']==0&&$meetingfrequenciesdata['usersaccountsroles'][0]['_edit']==0&&$meetingfrequenciesdata['usersaccountsroles'][0]['_edit']==0&&$meetingfrequenciesdata['usersaccountsroles'][0]['_show']==0&&$meetingfrequenciesdata['usersaccountsroles'][0]['_delete']==0&&$meetingfrequenciesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('meetingfrequenciesdata'));
		}else{
			return view('admin.meeting_frequencies.index',compact('meetingfrequenciesdata'));
		}
	}

	public function report(){
		$meetingfrequenciesdata['company']=Companies::all();
		$meetingfrequenciesdata['list']=MeetingFrequencies::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','MeetingFrequencies']])->get();
		$meetingfrequenciesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($meetingfrequenciesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('meetingfrequenciesdata'));
		}else{
			return view('admin.meeting_frequencies.report',compact('meetingfrequenciesdata'));
		}
	}

	public function chart(){
		return view('admin.meeting_frequencies.chart');
	}

	public function store(Request $request){
		$meetingfrequencies=new MeetingFrequencies();
		$meetingfrequencies->name=$request->get('name');
		$meetingfrequencies->no_of_days=$request->get('no_of_days');
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','MeetingFrequencies']])->get();
		$meetingfrequenciesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($meetingfrequenciesdata['usersaccountsroles'][0]['_show']==1){
			try{
				if($meetingfrequencies->save()){
					$response['status']='1';
					$response['message']='meeting frequencies Added successfully';
					return json_encode($response);
			}else{
					$response['status']='0';
					$response['message']='Failed to add meeting frequencies. Please try again';
					return json_encode($response);
				}
			}
			catch(Exception $e){
					$response['status']='0';
					$response['message']='An Error occured while attempting to add meeting frequencies. Please try again';
					return json_encode($response);
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$meetingfrequenciesdata['data']=MeetingFrequencies::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','MeetingFrequencies']])->get();
		$meetingfrequenciesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($meetingfrequenciesdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('meetingfrequenciesdata'));
		}else{
		return view('admin.meeting_frequencies.edit',compact('meetingfrequenciesdata','id'));
		}
	}

	public function show($id){
		$meetingfrequenciesdata['data']=MeetingFrequencies::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','MeetingFrequencies']])->get();
		$meetingfrequenciesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($meetingfrequenciesdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('meetingfrequenciesdata'));
		}else{
		return view('admin.meeting_frequencies.show',compact('meetingfrequenciesdata','id'));
		}
	}

	public function update(Request $request,$id){
		$meetingfrequencies=MeetingFrequencies::find($id);
		$meetingfrequencies->name=$request->get('name');
		$meetingfrequencies->no_of_days=$request->get('no_of_days');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','MeetingFrequencies']])->get();
		$meetingfrequenciesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($meetingfrequenciesdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('meetingfrequenciesdata'));
		}else{
		$meetingfrequencies->save();
		$meetingfrequenciesdata['data']=MeetingFrequencies::find($id);
		return view('admin.meeting_frequencies.edit',compact('meetingfrequenciesdata','id'));
		}
	}

	public function destroy($id){
		$meetingfrequencies=MeetingFrequencies::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','MeetingFrequencies']])->get();
		$meetingfrequenciesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($meetingfrequenciesdata['usersaccountsroles'][0]['_delete']==1){
			$meetingfrequencies->delete();
		}return redirect('admin/meetingfrequencies')->with('success','meeting frequencies has been deleted!');
	}
}