<?php
/**
* @author  Wanjala Innocent Khaemba
*/
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\ChangeGroupRequests;
use App\Companies;
use App\Modules;
use App\Users;
use App\Clients;
use App\Groups;
use App\ChangeGroupRequestStatuses;
use App\Http\Controllers\Controller;
use App\GroupClients;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;
class ChangeGroupRequestsController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$changegrouprequestsdata['clients']=Clients::all();
		$changegrouprequestsdata['groups']=Groups::all();
		$changegrouprequestsdata['groups']=Groups::all();
		$changegrouprequestsdata['changegrouprequeststatuses']=ChangeGroupRequestStatuses::all();
		$changegrouprequestsdata['list']=ChangeGroupRequests::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ChangeGroupRequests']])->get();
		$changegrouprequestsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($changegrouprequestsdata['usersaccountsroles'][0]['_add']==0&&$changegrouprequestsdata['usersaccountsroles'][0]['_list']==0&&$changegrouprequestsdata['usersaccountsroles'][0]['_edit']==0&&$changegrouprequestsdata['usersaccountsroles'][0]['_edit']==0&&$changegrouprequestsdata['usersaccountsroles'][0]['_show']==0&&$changegrouprequestsdata['usersaccountsroles'][0]['_delete']==0&&$changegrouprequestsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('changegrouprequestsdata'));
		}else{
			return view('admin.change_group_requests.index',compact('changegrouprequestsdata'));
		}
	}

	public function create(){
		$changegrouprequestsdata;
		$changegrouprequestsdata['clients']=Clients::all();
		$changegrouprequestsdata['groups']=Groups::all();
		$changegrouprequestsdata['groups']=Groups::all();
		$changegrouprequestsdata['changegrouprequeststatuses']=ChangeGroupRequestStatuses::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ChangeGroupRequests']])->get();
		$changegrouprequestsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($changegrouprequestsdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('changegrouprequestsdata'));
		}else{
			return view('admin.change_group_requests.create',compact('changegrouprequestsdata'));
		}
	}

	public function filter(Request $request){
		$changegrouprequestsdata['clients']=Clients::all();
		$changegrouprequestsdata['groups']=Groups::all();
		$changegrouprequestsdata['groups']=Groups::all();
		$changegrouprequestsdata['changegrouprequeststatuses']=ChangeGroupRequestStatuses::all();
		$changegrouprequestsdata['list']=ChangeGroupRequests::where([['client','LIKE','%'.$request->get('client').'%'],['current_group','LIKE','%'.$request->get('current_group').'%'],['new_group','LIKE','%'.$request->get('new_group').'%'],['status','LIKE','%'.$request->get('status').'%'],['comments','LIKE','%'.$request->get('comments').'%'],])->orWhereBetween('date',[$request->get('datefrom'),$request->get('dateto')])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ChangeGroupRequests']])->get();
		$changegrouprequestsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($changegrouprequestsdata['usersaccountsroles'][0]['_add']==0&&$changegrouprequestsdata['usersaccountsroles'][0]['_list']==0&&$changegrouprequestsdata['usersaccountsroles'][0]['_edit']==0&&$changegrouprequestsdata['usersaccountsroles'][0]['_edit']==0&&$changegrouprequestsdata['usersaccountsroles'][0]['_show']==0&&$changegrouprequestsdata['usersaccountsroles'][0]['_delete']==0&&$changegrouprequestsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('changegrouprequestsdata'));
		}else{
			return view('admin.change_group_requests.index',compact('changegrouprequestsdata'));
		}
	}

	public function report(){
		$changegrouprequestsdata['company']=Companies::all();
		$changegrouprequestsdata['list']=ChangeGroupRequests::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ChangeGroupRequests']])->get();
		$changegrouprequestsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($changegrouprequestsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('changegrouprequestsdata'));
		}else{
			return view('admin.change_group_requests.report',compact('changegrouprequestsdata'));
		}
	}

	public function chart(){
		return view('admin.change_group_requests.chart');
	}

	public function store(Request $request){
		$changegrouprequests=new ChangeGroupRequests();
		$changegrouprequests->client=$request->get('client');
		$changegrouprequests->current_group=$request->get('current_group');
		$changegrouprequests->new_group=$request->get('new_group');
		$changegrouprequests->date=$request->get('date');
		$changegrouprequests->status=$request->get('status');
		$changegrouprequests->comments=$request->get('comments');
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ChangeGroupRequests']])->get();
		$changegrouprequestsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($changegrouprequestsdata['usersaccountsroles'][0]['_show']==1){
			try{
				if($changegrouprequests->save()){

					$groupclient=GroupClients::where([["client","=",$changegrouprequests->client]])->get()->first();

					$groupclient->client_group=$changegrouprequests->new_group;

					$groupclient->save();

					$response['status']='1';
					$response['message']='change group requests Added successfully';
					return json_encode($response);
			}else{
					$response['status']='0';
					$response['message']='Failed to add change group requests. Please try again';
					return json_encode($response);
				}
			}
			catch(Exception $e){
					$response['status']='0';
					$response['message']='An Error occured while attempting to add change group requests. Please try again';
					return json_encode($response);
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$changegrouprequestsdata['clients']=Clients::all();
		$changegrouprequestsdata['groups']=Groups::all();
		$changegrouprequestsdata['groups']=Groups::all();
		$changegrouprequestsdata['changegrouprequeststatuses']=ChangeGroupRequestStatuses::all();
		$changegrouprequestsdata['data']=ChangeGroupRequests::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ChangeGroupRequests']])->get();
		$changegrouprequestsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($changegrouprequestsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('changegrouprequestsdata'));
		}else{
		return view('admin.change_group_requests.edit',compact('changegrouprequestsdata','id'));
		}
	}

	public function show($id){
		$changegrouprequestsdata['clients']=Clients::all();
		$changegrouprequestsdata['groups']=Groups::all();
		$changegrouprequestsdata['groups']=Groups::all();
		$changegrouprequestsdata['changegrouprequeststatuses']=ChangeGroupRequestStatuses::all();
		$changegrouprequestsdata['data']=ChangeGroupRequests::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ChangeGroupRequests']])->get();
		$changegrouprequestsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($changegrouprequestsdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('changegrouprequestsdata'));
		}else{
		return view('admin.change_group_requests.show',compact('changegrouprequestsdata','id'));
		}
	}

	public function update(Request $request,$id){
		$changegrouprequests=ChangeGroupRequests::find($id);
		$changegrouprequestsdata['clients']=Clients::all();
		$changegrouprequestsdata['groups']=Groups::all();
		$changegrouprequestsdata['groups']=Groups::all();
		$changegrouprequestsdata['changegrouprequeststatuses']=ChangeGroupRequestStatuses::all();
		$changegrouprequests->client=$request->get('client');
		$changegrouprequests->current_group=$request->get('current_group');
		$changegrouprequests->new_group=$request->get('new_group');
		$changegrouprequests->date=$request->get('date');
		$changegrouprequests->status=$request->get('status');
		$changegrouprequests->comments=$request->get('comments');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ChangeGroupRequests']])->get();
		$changegrouprequestsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($changegrouprequestsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('changegrouprequestsdata'));
		}else{
		$changegrouprequests->save();
		$changegrouprequestsdata['data']=ChangeGroupRequests::find($id);
		return view('admin.change_group_requests.edit',compact('changegrouprequestsdata','id'));
		}
	}

	public function destroy($id){
		$changegrouprequests=ChangeGroupRequests::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ChangeGroupRequests']])->get();
		$changegrouprequestsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($changegrouprequestsdata['usersaccountsroles'][0]['_delete']==1){
			$changegrouprequests->delete();
		}return redirect('admin/changegrouprequests')->with('success','change group requests has been deleted!');
	}
}