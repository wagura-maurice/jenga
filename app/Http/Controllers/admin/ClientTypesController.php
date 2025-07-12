<?php
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\ClientTypes;
use App\Companies;
use App\Modules;
use App\Users;
use App\Accounts;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;
class ClientTypesController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$clienttypesdata['list']=ClientTypes::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ClientTypes']])->get();
		$clienttypesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($clienttypesdata['usersaccountsroles'][0]['_add']==0&&$clienttypesdata['usersaccountsroles'][0]['_list']==0&&$clienttypesdata['usersaccountsroles'][0]['_edit']==0&&$clienttypesdata['usersaccountsroles'][0]['_edit']==0&&$clienttypesdata['usersaccountsroles'][0]['_show']==0&&$clienttypesdata['usersaccountsroles'][0]['_delete']==0&&$clienttypesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('clienttypesdata'));
		}else{
			return view('admin.client_types.index',compact('clienttypesdata'));
		}
	}

	public function create(){
		$clienttypesdata;
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ClientTypes']])->get();
		$clienttypesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($clienttypesdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('clienttypesdata'));
		}else{
			return view('admin.client_types.create',compact('clienttypesdata'));
		}
	}

	public function filter(Request $request){
		$clienttypesdata['list']=ClientTypes::where([['code','LIKE','%'.$request->get('code').'%'],['name','LIKE','%'.$request->get('name').'%'],['description','LIKE','%'.$request->get('description').'%'],])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ClientTypes']])->get();
		$clienttypesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($clienttypesdata['usersaccountsroles'][0]['_add']==0&&$clienttypesdata['usersaccountsroles'][0]['_list']==0&&$clienttypesdata['usersaccountsroles'][0]['_edit']==0&&$clienttypesdata['usersaccountsroles'][0]['_edit']==0&&$clienttypesdata['usersaccountsroles'][0]['_show']==0&&$clienttypesdata['usersaccountsroles'][0]['_delete']==0&&$clienttypesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('clienttypesdata'));
		}else{
			return view('admin.client_types.index',compact('clienttypesdata'));
		}
	}
	public function getclienttype(Request $request){
		$clientType=ClientTypes::find($request->get('id'));
		return json_encode($clientType);
	}
	public function report(){
		$clienttypesdata['company']=Companies::all();
		$clienttypesdata['list']=ClientTypes::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ClientTypes']])->get();
		$clienttypesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($clienttypesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('clienttypesdata'));
		}else{
			return view('admin.client_types.report',compact('clienttypesdata'));
		}
	}

	public function chart(){
		return view('admin.client_types.chart');
	}

	public function store(Request $request){
		$clienttypes=new ClientTypes();
		$clienttypes->code=$request->get('code');
		$clienttypes->name=$request->get('name');
		$clienttypes->description=$request->get('description');
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ClientTypes']])->get();
		$clienttypesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($clienttypesdata['usersaccountsroles'][0]['_show']==1){
			try{
				if($clienttypes->save()){
					$response['status']='1';
					$response['message']='client types Added successfully';
					return json_encode($response);
			}else{
					$response['status']='0';
					$response['message']='Failed to add client types. Please try again';
					return json_encode($response);
				}
			}
			catch(Exception $e){
					$response['status']='0';
					$response['message']='An Error occured while attempting to add client types. Please try again';
					return json_encode($response);
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$clienttypesdata['data']=ClientTypes::find($id);
		$clienttypesdata['accounts']=Accounts::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ClientTypes']])->get();
		$clienttypesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($clienttypesdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('clienttypesdata'));
		}else{
		return view('admin.client_types.edit',compact('clienttypesdata','id'));
		}
	}

	public function show($id){
		$clienttypesdata['data']=ClientTypes::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ClientTypes']])->get();
		$clienttypesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($clienttypesdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('clienttypesdata'));
		}else{
		return view('admin.client_types.show',compact('clienttypesdata','id'));
		}
	}

	public function update(Request $request,$id){
		$clienttypes=ClientTypes::find($id);
		$clienttypesdata['accounts']=Accounts::all();
		$clienttypes->description=$request->get('description');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ClientTypes']])->get();
		$clienttypesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($clienttypesdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('clienttypesdata'));
		}else{
		$clienttypes->save();
		$clienttypesdata['data']=ClientTypes::find($id);
		return view('admin.client_types.edit',compact('clienttypesdata','id'));
		}
	}

	public function destroy($id){
		$clienttypes=ClientTypes::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ClientTypes']])->get();
		$clienttypesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($clienttypesdata['usersaccountsroles'][0]['_delete']==1){
			$clienttypes->delete();
		}return redirect('admin/clienttypes')->with('success','client types has been deleted!');
	}
}