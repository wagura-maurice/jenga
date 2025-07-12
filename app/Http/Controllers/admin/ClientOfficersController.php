<?php
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\ClientOfficers;
use App\Companies;
use App\Modules;
use App\Users;
use App\Clients;
use App\Employees;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;
use App\ClientTypes;
class ClientOfficersController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$groupclients=ClientTypes::where([['code','=','001']])->get();
		$clientofficersdata['clients']=Clients::where([['client_type','!=',$groupclients[0]['id']]])->get();
		$clientofficersdata['employees']=Employees::all();
		$clientofficersdata['list']=ClientOfficers::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ClientOfficers']])->get();
		$clientofficersdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($clientofficersdata['usersaccountsroles'][0]['_add']==0&&$clientofficersdata['usersaccountsroles'][0]['_list']==0&&$clientofficersdata['usersaccountsroles'][0]['_edit']==0&&$clientofficersdata['usersaccountsroles'][0]['_edit']==0&&$clientofficersdata['usersaccountsroles'][0]['_show']==0&&$clientofficersdata['usersaccountsroles'][0]['_delete']==0&&$clientofficersdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('clientofficersdata'));
		}else{
			return view('admin.client_officers.index',compact('clientofficersdata'));
		}
	}

	public function create(){
		$clientofficersdata;
		$groupclients=ClientTypes::where([['code','=','001']])->get();
		$clientofficersdata['clients']=Clients::where([['client_type','!=',$groupclients[0]['id']]])->get();
		$clientofficersdata['employees']=Employees::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ClientOfficers']])->get();
		$clientofficersdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($clientofficersdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('clientofficersdata'));
		}else{
			return view('admin.client_officers.create',compact('clientofficersdata'));
		}
	}

	public function filter(Request $request){
		$groupclients=ClientTypes::where([['code','=','001']])->get();
		$clientofficersdata['clients']=Clients::where([['client_type','!=',$groupclients[0]['id']]])->get();
		$clientofficersdata['employees']=Employees::all();
		$clientofficersdata['list']=ClientOfficers::where([['client','LIKE','%'.$request->get('client').'%'],['officer','LIKE','%'.$request->get('officer').'%'],])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ClientOfficers']])->get();
		$clientofficersdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($clientofficersdata['usersaccountsroles'][0]['_add']==0&&$clientofficersdata['usersaccountsroles'][0]['_list']==0&&$clientofficersdata['usersaccountsroles'][0]['_edit']==0&&$clientofficersdata['usersaccountsroles'][0]['_edit']==0&&$clientofficersdata['usersaccountsroles'][0]['_show']==0&&$clientofficersdata['usersaccountsroles'][0]['_delete']==0&&$clientofficersdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('clientofficersdata'));
		}else{
			return view('admin.client_officers.index',compact('clientofficersdata'));
		}
	}

	public function report(){
		$clientofficersdata['company']=Companies::all();
		$clientofficersdata['list']=ClientOfficers::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ClientOfficers']])->get();
		$clientofficersdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($clientofficersdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('clientofficersdata'));
		}else{
			return view('admin.client_officers.report',compact('clientofficersdata'));
		}
	}

	public function chart(){
		return view('admin.client_officers.chart');
	}

	public function store(Request $request){
		$clientofficers=new ClientOfficers();
		$clientofficers->client=$request->get('client');
		$clientofficers->officer=$request->get('officer');
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ClientOfficers']])->get();
		$clientofficersdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($clientofficersdata['usersaccountsroles'][0]['_show']==1){
			try{
				if($clientofficers->save()){
					$response['status']='1';
					$response['message']='client officers Added successfully';
					return json_encode($response);
			}else{
					$response['status']='0';
					$response['message']='Failed to add client officers. Please try again';
					return json_encode($response);
				}
			}
			catch(Exception $e){
					$response['status']='0';
					$response['message']='An Error occured while attempting to add client officers. Please try again';
					return json_encode($response);
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$groupclients=ClientTypes::where([['code','=','001']])->get();
		$clientofficersdata['clients']=Clients::where([['client_type','!=',$groupclients[0]['id']]])->get();
		$clientofficersdata['employees']=Employees::all();
		$clientofficersdata['data']=ClientOfficers::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ClientOfficers']])->get();
		$clientofficersdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($clientofficersdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('clientofficersdata'));
		}else{
		return view('admin.client_officers.edit',compact('clientofficersdata','id'));
		}
	}

	public function show($id){
		$groupclients=ClientTypes::where([['code','=','001']])->get();
		$clientofficersdata['clients']=Clients::where([['client_type','!=',$groupclients[0]['id']]])->get();
		$clientofficersdata['employees']=Employees::all();
		$clientofficersdata['data']=ClientOfficers::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ClientOfficers']])->get();
		$clientofficersdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($clientofficersdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('clientofficersdata'));
		}else{
		return view('admin.client_officers.show',compact('clientofficersdata','id'));
		}
	}

	public function update(Request $request,$id){
		$clientofficers=ClientOfficers::find($id);
		$groupclients=ClientTypes::where([['code','=','001']])->get();
		$clientofficersdata['clients']=Clients::where([['client_type','!=',$groupclients[0]['id']]])->get();
		$clientofficersdata['employees']=Employees::all();
		$clientofficers->client=$request->get('client');
		$clientofficers->officer=$request->get('officer');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ClientOfficers']])->get();
		$clientofficersdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($clientofficersdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('clientofficersdata'));
		}else{
		$clientofficers->save();
		$clientofficersdata['data']=ClientOfficers::find($id);
		return view('admin.client_officers.edit',compact('clientofficersdata','id'));
		}
	}

	public function destroy($id){
		$clientofficers=ClientOfficers::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ClientOfficers']])->get();
		$clientofficersdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($clientofficersdata['usersaccountsroles'][0]['_delete']==1){
			$clientofficers->delete();
		}return redirect('admin/clientofficers')->with('success','client officers has been deleted!');
	}
}