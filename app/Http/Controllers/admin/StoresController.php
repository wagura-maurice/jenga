<?php
/**
* @author  Wanjala Innocent Khaemba
*Controller - (stores)
*/
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Stores;
use App\Companies;
use App\Modules;
use App\Users;
use App\Branches;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;
class StoresController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$storesdata['users']=Users::all();
		$storesdata['branches']=Branches::all();
		$storesdata['list']=Stores::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Stores']])->get();
		$storesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($storesdata['usersaccountsroles'][0]['_add']==0&&$storesdata['usersaccountsroles'][0]['_list']==0&&$storesdata['usersaccountsroles'][0]['_edit']==0&&$storesdata['usersaccountsroles'][0]['_edit']==0&&$storesdata['usersaccountsroles'][0]['_show']==0&&$storesdata['usersaccountsroles'][0]['_delete']==0&&$storesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('storesdata'));
		}else{
			return view('admin.stores.index',compact('storesdata'));
		}
	}

	public function create(){
		$storesdata;
		$storesdata['users']=Users::all();
		$storesdata['branches']=Branches::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Stores']])->get();
		$storesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($storesdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('storesdata'));
		}else{
			return view('admin.stores.create',compact('storesdata'));
		}
	}

	public function filter(Request $request){
		$storesdata['users']=Users::all();
		$storesdata['branches']=Branches::all();
		$storesdata['list']=Stores::where([['number','LIKE','%'.$request->get('number').'%'],['name','LIKE','%'.$request->get('name').'%'],['staff','LIKE','%'.$request->get('staff').'%'],['branch','LIKE','%'.$request->get('branch').'%'],])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Stores']])->get();
		$storesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($storesdata['usersaccountsroles'][0]['_add']==0&&$storesdata['usersaccountsroles'][0]['_list']==0&&$storesdata['usersaccountsroles'][0]['_edit']==0&&$storesdata['usersaccountsroles'][0]['_edit']==0&&$storesdata['usersaccountsroles'][0]['_show']==0&&$storesdata['usersaccountsroles'][0]['_delete']==0&&$storesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('storesdata'));
		}else{
			return view('admin.stores.index',compact('storesdata'));
		}
	}

	public function report(){
		$storesdata['company']=Companies::all();
		$storesdata['list']=Stores::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Stores']])->get();
		$storesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($storesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('storesdata'));
		}else{
			return view('admin.stores.report',compact('storesdata'));
		}
	}

	public function chart(){
		return view('admin.stores.chart');
	}

	public function getstorenumber(){
		return Stores::all()->count()+1;
	}	

	public function store(Request $request){
		$stores=new Stores();
		$stores->number=$request->get('number');
		$stores->name=$request->get('name');
		$stores->staff=$request->get('staff');
		$stores->branch=$request->get('branch');
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Stores']])->get();
		$storesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($storesdata['usersaccountsroles'][0]['_show']==1){
			try{
				if($stores->save()){
					$response['status']='1';
					$response['message']='stores Added successfully';
					return json_encode($response);
			}else{
					$response['status']='0';
					$response['message']='Failed to add stores. Please try again';
					return json_encode($response);
				}
			}
			catch(Exception $e){
					$response['status']='0';
					$response['message']='An Error occured while attempting to add stores. Please try again';
					return json_encode($response);
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$storesdata['users']=Users::all();
		$storesdata['branches']=Branches::all();
		$storesdata['data']=Stores::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Stores']])->get();
		$storesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($storesdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('storesdata'));
		}else{
		return view('admin.stores.edit',compact('storesdata','id'));
		}
	}

	public function show($id){
		$storesdata['users']=Users::all();
		$storesdata['branches']=Branches::all();
		$storesdata['data']=Stores::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Stores']])->get();
		$storesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($storesdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('storesdata'));
		}else{
		return view('admin.stores.show',compact('storesdata','id'));
		}
	}

	public function update(Request $request,$id){
		$stores=Stores::find($id);
		$storesdata['users']=Users::all();
		$storesdata['branches']=Branches::all();
		$stores->number=$request->get('number');
		$stores->name=$request->get('name');
		$stores->staff=$request->get('staff');
		$stores->branch=$request->get('branch');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Stores']])->get();
		$storesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($storesdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('storesdata'));
		}else{
		$stores->save();
		$storesdata['data']=Stores::find($id);
		return view('admin.stores.edit',compact('storesdata','id'));
		}
	}

	public function destroy($id){
		$stores=Stores::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Stores']])->get();
		$storesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($storesdata['usersaccountsroles'][0]['_delete']==1){
			$stores->delete();
		}return redirect('admin/stores')->with('success','stores has been deleted!');
	}
}