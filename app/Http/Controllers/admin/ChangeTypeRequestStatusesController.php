<?php
/**
* @author  Wanjala Innocent Khaemba
*/
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\ChangeTypeRequestStatuses;
use App\Companies;
use App\Modules;
use App\Users;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;
class ChangeTypeRequestStatusesController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$changetyperequeststatusesdata['list']=ChangeTypeRequestStatuses::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ChangeTypeRequestStatuses']])->get();
		$changetyperequeststatusesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($changetyperequeststatusesdata['usersaccountsroles'][0]['_add']==0&&$changetyperequeststatusesdata['usersaccountsroles'][0]['_list']==0&&$changetyperequeststatusesdata['usersaccountsroles'][0]['_edit']==0&&$changetyperequeststatusesdata['usersaccountsroles'][0]['_edit']==0&&$changetyperequeststatusesdata['usersaccountsroles'][0]['_show']==0&&$changetyperequeststatusesdata['usersaccountsroles'][0]['_delete']==0&&$changetyperequeststatusesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('changetyperequeststatusesdata'));
		}else{
			return view('admin.change_type_request_statuses.index',compact('changetyperequeststatusesdata'));
		}
	}

	public function create(){
		$changetyperequeststatusesdata;
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ChangeTypeRequestStatuses']])->get();
		$changetyperequeststatusesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($changetyperequeststatusesdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('changetyperequeststatusesdata'));
		}else{
			return view('admin.change_type_request_statuses.create',compact('changetyperequeststatusesdata'));
		}
	}

	public function filter(Request $request){
		$changetyperequeststatusesdata['list']=ChangeTypeRequestStatuses::where([['code','LIKE','%'.$request->get('code').'%'],['name','LIKE','%'.$request->get('name').'%'],['description','LIKE','%'.$request->get('description').'%'],])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ChangeTypeRequestStatuses']])->get();
		$changetyperequeststatusesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($changetyperequeststatusesdata['usersaccountsroles'][0]['_add']==0&&$changetyperequeststatusesdata['usersaccountsroles'][0]['_list']==0&&$changetyperequeststatusesdata['usersaccountsroles'][0]['_edit']==0&&$changetyperequeststatusesdata['usersaccountsroles'][0]['_edit']==0&&$changetyperequeststatusesdata['usersaccountsroles'][0]['_show']==0&&$changetyperequeststatusesdata['usersaccountsroles'][0]['_delete']==0&&$changetyperequeststatusesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('changetyperequeststatusesdata'));
		}else{
			return view('admin.change_type_request_statuses.index',compact('changetyperequeststatusesdata'));
		}
	}

	public function report(){
		$changetyperequeststatusesdata['company']=Companies::all();
		$changetyperequeststatusesdata['list']=ChangeTypeRequestStatuses::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ChangeTypeRequestStatuses']])->get();
		$changetyperequeststatusesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($changetyperequeststatusesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('changetyperequeststatusesdata'));
		}else{
			return view('admin.change_type_request_statuses.report',compact('changetyperequeststatusesdata'));
		}
	}

	public function chart(){
		return view('admin.change_type_request_statuses.chart');
	}

	public function store(Request $request){
		$changetyperequeststatuses=new ChangeTypeRequestStatuses();
		$changetyperequeststatuses->code=$request->get('code');
		$changetyperequeststatuses->name=$request->get('name');
		$changetyperequeststatuses->description=$request->get('description');
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ChangeTypeRequestStatuses']])->get();
		$changetyperequeststatusesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($changetyperequeststatusesdata['usersaccountsroles'][0]['_show']==1){
			try{
				if($changetyperequeststatuses->save()){
					$response['status']='1';
					$response['message']='change type request statuses Added successfully';
					return json_encode($response);
			}else{
					$response['status']='0';
					$response['message']='Failed to add change type request statuses. Please try again';
					return json_encode($response);
				}
			}
			catch(Exception $e){
					$response['status']='0';
					$response['message']='An Error occured while attempting to add change type request statuses. Please try again';
					return json_encode($response);
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$changetyperequeststatusesdata['data']=ChangeTypeRequestStatuses::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ChangeTypeRequestStatuses']])->get();
		$changetyperequeststatusesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($changetyperequeststatusesdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('changetyperequeststatusesdata'));
		}else{
		return view('admin.change_type_request_statuses.edit',compact('changetyperequeststatusesdata','id'));
		}
	}

	public function show($id){
		$changetyperequeststatusesdata['data']=ChangeTypeRequestStatuses::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ChangeTypeRequestStatuses']])->get();
		$changetyperequeststatusesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($changetyperequeststatusesdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('changetyperequeststatusesdata'));
		}else{
		return view('admin.change_type_request_statuses.show',compact('changetyperequeststatusesdata','id'));
		}
	}

	public function update(Request $request,$id){
		$changetyperequeststatuses=ChangeTypeRequestStatuses::find($id);
		$changetyperequeststatuses->code=$request->get('code');
		$changetyperequeststatuses->name=$request->get('name');
		$changetyperequeststatuses->description=$request->get('description');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ChangeTypeRequestStatuses']])->get();
		$changetyperequeststatusesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($changetyperequeststatusesdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('changetyperequeststatusesdata'));
		}else{
		$changetyperequeststatuses->save();
		$changetyperequeststatusesdata['data']=ChangeTypeRequestStatuses::find($id);
		return view('admin.change_type_request_statuses.edit',compact('changetyperequeststatusesdata','id'));
		}
	}

	public function destroy($id){
		$changetyperequeststatuses=ChangeTypeRequestStatuses::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ChangeTypeRequestStatuses']])->get();
		$changetyperequeststatusesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($changetyperequeststatusesdata['usersaccountsroles'][0]['_delete']==1){
			$changetyperequeststatuses->delete();
		}return redirect('admin/changetyperequeststatuses')->with('success','change type request statuses has been deleted!');
	}
}