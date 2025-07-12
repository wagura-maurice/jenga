<?php
/**
* @author  Wanjala Innocent Khaemba
*/
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\ChangeGroupRequestStatuses;
use App\Companies;
use App\Modules;
use App\Users;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;
class ChangeGroupRequestStatusesController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$changegrouprequeststatusesdata['list']=ChangeGroupRequestStatuses::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ChangeGroupRequestStatuses']])->get();
		$changegrouprequeststatusesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($changegrouprequeststatusesdata['usersaccountsroles'][0]['_add']==0&&$changegrouprequeststatusesdata['usersaccountsroles'][0]['_list']==0&&$changegrouprequeststatusesdata['usersaccountsroles'][0]['_edit']==0&&$changegrouprequeststatusesdata['usersaccountsroles'][0]['_edit']==0&&$changegrouprequeststatusesdata['usersaccountsroles'][0]['_show']==0&&$changegrouprequeststatusesdata['usersaccountsroles'][0]['_delete']==0&&$changegrouprequeststatusesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('changegrouprequeststatusesdata'));
		}else{
			return view('admin.change_group_request_statuses.index',compact('changegrouprequeststatusesdata'));
		}
	}

	public function create(){
		$changegrouprequeststatusesdata;
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ChangeGroupRequestStatuses']])->get();
		$changegrouprequeststatusesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($changegrouprequeststatusesdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('changegrouprequeststatusesdata'));
		}else{
			return view('admin.change_group_request_statuses.create',compact('changegrouprequeststatusesdata'));
		}
	}

	public function filter(Request $request){
		$changegrouprequeststatusesdata['list']=ChangeGroupRequestStatuses::where([['code','LIKE','%'.$request->get('code').'%'],['name','LIKE','%'.$request->get('name').'%'],['description','LIKE','%'.$request->get('description').'%'],])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ChangeGroupRequestStatuses']])->get();
		$changegrouprequeststatusesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($changegrouprequeststatusesdata['usersaccountsroles'][0]['_add']==0&&$changegrouprequeststatusesdata['usersaccountsroles'][0]['_list']==0&&$changegrouprequeststatusesdata['usersaccountsroles'][0]['_edit']==0&&$changegrouprequeststatusesdata['usersaccountsroles'][0]['_edit']==0&&$changegrouprequeststatusesdata['usersaccountsroles'][0]['_show']==0&&$changegrouprequeststatusesdata['usersaccountsroles'][0]['_delete']==0&&$changegrouprequeststatusesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('changegrouprequeststatusesdata'));
		}else{
			return view('admin.change_group_request_statuses.index',compact('changegrouprequeststatusesdata'));
		}
	}

	public function report(){
		$changegrouprequeststatusesdata['company']=Companies::all();
		$changegrouprequeststatusesdata['list']=ChangeGroupRequestStatuses::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ChangeGroupRequestStatuses']])->get();
		$changegrouprequeststatusesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($changegrouprequeststatusesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('changegrouprequeststatusesdata'));
		}else{
			return view('admin.change_group_request_statuses.report',compact('changegrouprequeststatusesdata'));
		}
	}

	public function chart(){
		return view('admin.change_group_request_statuses.chart');
	}

	public function store(Request $request){
		$changegrouprequeststatuses=new ChangeGroupRequestStatuses();
		$changegrouprequeststatuses->code=$request->get('code');
		$changegrouprequeststatuses->name=$request->get('name');
		$changegrouprequeststatuses->description=$request->get('description');
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ChangeGroupRequestStatuses']])->get();
		$changegrouprequeststatusesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($changegrouprequeststatusesdata['usersaccountsroles'][0]['_show']==1){
			try{
				if($changegrouprequeststatuses->save()){
					$response['status']='1';
					$response['message']='change group request statuses Added successfully';
					return json_encode($response);
			}else{
					$response['status']='0';
					$response['message']='Failed to add change group request statuses. Please try again';
					return json_encode($response);
				}
			}
			catch(Exception $e){
					$response['status']='0';
					$response['message']='An Error occured while attempting to add change group request statuses. Please try again';
					return json_encode($response);
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$changegrouprequeststatusesdata['data']=ChangeGroupRequestStatuses::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ChangeGroupRequestStatuses']])->get();
		$changegrouprequeststatusesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($changegrouprequeststatusesdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('changegrouprequeststatusesdata'));
		}else{
		return view('admin.change_group_request_statuses.edit',compact('changegrouprequeststatusesdata','id'));
		}
	}

	public function show($id){
		$changegrouprequeststatusesdata['data']=ChangeGroupRequestStatuses::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ChangeGroupRequestStatuses']])->get();
		$changegrouprequeststatusesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($changegrouprequeststatusesdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('changegrouprequeststatusesdata'));
		}else{
		return view('admin.change_group_request_statuses.show',compact('changegrouprequeststatusesdata','id'));
		}
	}

	public function update(Request $request,$id){
		$changegrouprequeststatuses=ChangeGroupRequestStatuses::find($id);
		$changegrouprequeststatuses->code=$request->get('code');
		$changegrouprequeststatuses->name=$request->get('name');
		$changegrouprequeststatuses->description=$request->get('description');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ChangeGroupRequestStatuses']])->get();
		$changegrouprequeststatusesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($changegrouprequeststatusesdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('changegrouprequeststatusesdata'));
		}else{
		$changegrouprequeststatuses->save();
		$changegrouprequeststatusesdata['data']=ChangeGroupRequestStatuses::find($id);
		return view('admin.change_group_request_statuses.edit',compact('changegrouprequeststatusesdata','id'));
		}
	}

	public function destroy($id){
		$changegrouprequeststatuses=ChangeGroupRequestStatuses::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ChangeGroupRequestStatuses']])->get();
		$changegrouprequeststatusesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($changegrouprequeststatusesdata['usersaccountsroles'][0]['_delete']==1){
			$changegrouprequeststatuses->delete();
		}return redirect('admin/changegrouprequeststatuses')->with('success','change group request statuses has been deleted!');
	}
}