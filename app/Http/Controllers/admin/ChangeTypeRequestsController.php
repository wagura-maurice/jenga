<?php
/**
* @author  Wanjala Innocent Khaemba
*/
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\ChangeTypeRequests;
use App\Companies;
use App\Modules;
use App\Users;
use App\Clients;
use App\ClientTypes;
use App\ChangeTypeRequestStatuses;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;
class ChangeTypeRequestsController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$changetyperequestsdata['clients']=Clients::all();
		$changetyperequestsdata['clienttypes']=ClientTypes::all();
		$changetyperequestsdata['clienttypes']=ClientTypes::all();
		$changetyperequestsdata['changetyperequeststatuses']=ChangeTypeRequestStatuses::all();
		$changetyperequestsdata['list']=ChangeTypeRequests::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ChangeTypeRequests']])->get();
		$changetyperequestsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($changetyperequestsdata['usersaccountsroles'][0]['_add']==0&&$changetyperequestsdata['usersaccountsroles'][0]['_list']==0&&$changetyperequestsdata['usersaccountsroles'][0]['_edit']==0&&$changetyperequestsdata['usersaccountsroles'][0]['_edit']==0&&$changetyperequestsdata['usersaccountsroles'][0]['_show']==0&&$changetyperequestsdata['usersaccountsroles'][0]['_delete']==0&&$changetyperequestsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('changetyperequestsdata'));
		}else{
			return view('admin.change_type_requests.index',compact('changetyperequestsdata'));
		}
	}

	public function create(){
		$changetyperequestsdata;
		$changetyperequestsdata['clients']=Clients::all();
		$changetyperequestsdata['clienttypes']=ClientTypes::all();
		$changetyperequestsdata['clienttypes']=ClientTypes::all();
		$changetyperequestsdata['changetyperequeststatuses']=ChangeTypeRequestStatuses::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ChangeTypeRequests']])->get();
		$changetyperequestsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($changetyperequestsdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('changetyperequestsdata'));
		}else{
			return view('admin.change_type_requests.create',compact('changetyperequestsdata'));
		}
	}

	public function filter(Request $request){
		$changetyperequestsdata['clients']=Clients::all();
		$changetyperequestsdata['clienttypes']=ClientTypes::all();
		$changetyperequestsdata['clienttypes']=ClientTypes::all();
		$changetyperequestsdata['changetyperequeststatuses']=ChangeTypeRequestStatuses::all();
		$changetyperequestsdata['list']=ChangeTypeRequests::where([['client','LIKE','%'.$request->get('client').'%'],['current_type','LIKE','%'.$request->get('current_type').'%'],['new_type','LIKE','%'.$request->get('new_type').'%'],['comments','LIKE','%'.$request->get('comments').'%'],['status','LIKE','%'.$request->get('status').'%'],])->orWhereBetween('date',[$request->get('datefrom'),$request->get('dateto')])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ChangeTypeRequests']])->get();
		$changetyperequestsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($changetyperequestsdata['usersaccountsroles'][0]['_add']==0&&$changetyperequestsdata['usersaccountsroles'][0]['_list']==0&&$changetyperequestsdata['usersaccountsroles'][0]['_edit']==0&&$changetyperequestsdata['usersaccountsroles'][0]['_edit']==0&&$changetyperequestsdata['usersaccountsroles'][0]['_show']==0&&$changetyperequestsdata['usersaccountsroles'][0]['_delete']==0&&$changetyperequestsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('changetyperequestsdata'));
		}else{
			return view('admin.change_type_requests.index',compact('changetyperequestsdata'));
		}
	}

	public function report(){
		$changetyperequestsdata['company']=Companies::all();
		$changetyperequestsdata['list']=ChangeTypeRequests::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ChangeTypeRequests']])->get();
		$changetyperequestsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($changetyperequestsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('changetyperequestsdata'));
		}else{
			return view('admin.change_type_requests.report',compact('changetyperequestsdata'));
		}
	}

	public function chart(){
		return view('admin.change_type_requests.chart');
	}

	public function store(Request $request){
		$changetyperequests=new ChangeTypeRequests();
		$changetyperequests->client=$request->get('client');
		$changetyperequests->current_type=$request->get('current_type');
		$changetyperequests->new_type=$request->get('new_type');
		$changetyperequests->date=$request->get('date');
		$changetyperequests->comments=$request->get('comments');
		$changetyperequests->status=$request->get('status');
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ChangeTypeRequests']])->get();
		$changetyperequestsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($changetyperequestsdata['usersaccountsroles'][0]['_show']==1){
			try{
				if($changetyperequests->save()){
					$response['status']='1';
					$response['message']='change type requests Added successfully';
					return json_encode($response);
			}else{
					$response['status']='0';
					$response['message']='Failed to add change type requests. Please try again';
					return json_encode($response);
				}
			}
			catch(Exception $e){
					$response['status']='0';
					$response['message']='An Error occured while attempting to add change type requests. Please try again';
					return json_encode($response);
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$changetyperequestsdata['clients']=Clients::all();
		$changetyperequestsdata['clienttypes']=ClientTypes::all();
		$changetyperequestsdata['clienttypes']=ClientTypes::all();
		$changetyperequestsdata['changetyperequeststatuses']=ChangeTypeRequestStatuses::all();
		$changetyperequestsdata['data']=ChangeTypeRequests::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ChangeTypeRequests']])->get();
		$changetyperequestsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($changetyperequestsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('changetyperequestsdata'));
		}else{
		return view('admin.change_type_requests.edit',compact('changetyperequestsdata','id'));
		}
	}

	public function show($id){
		$changetyperequestsdata['clients']=Clients::all();
		$changetyperequestsdata['clienttypes']=ClientTypes::all();
		$changetyperequestsdata['clienttypes']=ClientTypes::all();
		$changetyperequestsdata['changetyperequeststatuses']=ChangeTypeRequestStatuses::all();
		$changetyperequestsdata['data']=ChangeTypeRequests::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ChangeTypeRequests']])->get();
		$changetyperequestsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($changetyperequestsdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('changetyperequestsdata'));
		}else{
		return view('admin.change_type_requests.show',compact('changetyperequestsdata','id'));
		}
	}

	public function update(Request $request,$id){
		$changetyperequests=ChangeTypeRequests::find($id);
		$changetyperequestsdata['clients']=Clients::all();
		$changetyperequestsdata['clienttypes']=ClientTypes::all();
		$changetyperequestsdata['clienttypes']=ClientTypes::all();
		$changetyperequestsdata['changetyperequeststatuses']=ChangeTypeRequestStatuses::all();
		$changetyperequests->client=$request->get('client');
		$changetyperequests->current_type=$request->get('current_type');
		$changetyperequests->new_type=$request->get('new_type');
		$changetyperequests->date=$request->get('date');
		$changetyperequests->comments=$request->get('comments');
		$changetyperequests->status=$request->get('status');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ChangeTypeRequests']])->get();
		$changetyperequestsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($changetyperequestsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('changetyperequestsdata'));
		}else{
		$changetyperequests->save();
		$changetyperequestsdata['data']=ChangeTypeRequests::find($id);
		return view('admin.change_type_requests.edit',compact('changetyperequestsdata','id'));
		}
	}

	public function destroy($id){
		$changetyperequests=ChangeTypeRequests::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ChangeTypeRequests']])->get();
		$changetyperequestsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($changetyperequestsdata['usersaccountsroles'][0]['_delete']==1){
			$changetyperequests->delete();
		}return redirect('admin/changetyperequests')->with('success','change type requests has been deleted!');
	}
}