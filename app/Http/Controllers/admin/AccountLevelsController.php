<?php
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\AccountLevels;
use App\Companies;
use App\Modules;
use App\Users;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;
class AccountLevelsController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$accountlevelsdata['list']=AccountLevels::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','AccountLevels']])->get();
		$accountlevelsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($accountlevelsdata['usersaccountsroles'][0]['_add']==0&&$accountlevelsdata['usersaccountsroles'][0]['_list']==0&&$accountlevelsdata['usersaccountsroles'][0]['_edit']==0&&$accountlevelsdata['usersaccountsroles'][0]['_edit']==0&&$accountlevelsdata['usersaccountsroles'][0]['_show']==0&&$accountlevelsdata['usersaccountsroles'][0]['_delete']==0&&$accountlevelsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('accountlevelsdata'));
		}else{
			return view('admin.account_levels.index',compact('accountlevelsdata'));
		}
	}

	public function create(){
		$accountlevelsdata;
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','AccountLevels']])->get();
		$accountlevelsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($accountlevelsdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('accountlevelsdata'));
		}else{
			return view('admin.account_levels.create',compact('accountlevelsdata'));
		}
	}

	public function filter(Request $request){
		$accountlevelsdata['list']=AccountLevels::where([['code','LIKE','%'.$request->get('code').'%'],['name','LIKE','%'.$request->get('name').'%'],['level','LIKE','%'.$request->get('level').'%'],])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','AccountLevels']])->get();
		$accountlevelsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($accountlevelsdata['usersaccountsroles'][0]['_add']==0&&$accountlevelsdata['usersaccountsroles'][0]['_list']==0&&$accountlevelsdata['usersaccountsroles'][0]['_edit']==0&&$accountlevelsdata['usersaccountsroles'][0]['_edit']==0&&$accountlevelsdata['usersaccountsroles'][0]['_show']==0&&$accountlevelsdata['usersaccountsroles'][0]['_delete']==0&&$accountlevelsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('accountlevelsdata'));
		}else{
			return view('admin.account_levels.index',compact('accountlevelsdata'));
		}
	}

	public function report(){
		$accountlevelsdata['company']=Companies::all();
		$accountlevelsdata['list']=AccountLevels::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','AccountLevels']])->get();
		$accountlevelsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($accountlevelsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('accountlevelsdata'));
		}else{
			return view('admin.account_levels.report',compact('accountlevelsdata'));
		}
	}

	public function chart(){
		return view('admin.account_levels.chart');
	}

	public function store(Request $request){
		$accountlevels=new AccountLevels();
		$accountlevels->code=$request->get('code');
		$accountlevels->name=$request->get('name');
		$accountlevels->level=$request->get('level');
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','AccountLevels']])->get();
		$accountlevelsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($accountlevelsdata['usersaccountsroles'][0]['_show']==1){
			try{
				if($accountlevels->save()){
					$response['status']='1';
					$response['message']='account levels Added successfully';
					return json_encode($response);
			}else{
					$response['status']='0';
					$response['message']='Failed to add account levels. Please try again';
					return json_encode($response);
				}
			}
			catch(Exception $e){
					$response['status']='0';
					$response['message']='An Error occured while attempting to add account levels. Please try again';
					return json_encode($response);
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$accountlevelsdata['data']=AccountLevels::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','AccountLevels']])->get();
		$accountlevelsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($accountlevelsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('accountlevelsdata'));
		}else{
		return view('admin.account_levels.edit',compact('accountlevelsdata','id'));
		}
	}

	public function show($id){
		$accountlevelsdata['data']=AccountLevels::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','AccountLevels']])->get();
		$accountlevelsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($accountlevelsdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('accountlevelsdata'));
		}else{
		return view('admin.account_levels.show',compact('accountlevelsdata','id'));
		}
	}

	public function update(Request $request,$id){
		$accountlevels=AccountLevels::find($id);
		$accountlevels->code=$request->get('code');
		$accountlevels->name=$request->get('name');
		$accountlevels->level=$request->get('level');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','AccountLevels']])->get();
		$accountlevelsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($accountlevelsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('accountlevelsdata'));
		}else{
		$accountlevels->save();
		$accountlevelsdata['data']=AccountLevels::find($id);
		return view('admin.account_levels.edit',compact('accountlevelsdata','id'));
		}
	}

	public function destroy($id){
		$accountlevels=AccountLevels::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','AccountLevels']])->get();
		$accountlevelsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($accountlevelsdata['usersaccountsroles'][0]['_delete']==1){
			$accountlevels->delete();
		}return redirect('admin/accountlevels')->with('success','account levels has been deleted!');
	}
}