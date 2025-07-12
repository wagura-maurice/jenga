<?php
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\EntryTypes;
use App\Companies;
use App\Modules;
use App\Users;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;
class EntryTypesController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$entrytypesdata['list']=EntryTypes::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','EntryTypes']])->get();
		$entrytypesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($entrytypesdata['usersaccountsroles'][0]['_add']==0&&$entrytypesdata['usersaccountsroles'][0]['_list']==0&&$entrytypesdata['usersaccountsroles'][0]['_edit']==0&&$entrytypesdata['usersaccountsroles'][0]['_edit']==0&&$entrytypesdata['usersaccountsroles'][0]['_show']==0&&$entrytypesdata['usersaccountsroles'][0]['_delete']==0&&$entrytypesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('entrytypesdata'));
		}else{
			return view('admin.entry_types.index',compact('entrytypesdata'));
		}
	}

	public function create(){
		$entrytypesdata;
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','EntryTypes']])->get();
		$entrytypesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($entrytypesdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('entrytypesdata'));
		}else{
			return view('admin.entry_types.create',compact('entrytypesdata'));
		}
	}

	public function filter(Request $request){
		$entrytypesdata['list']=EntryTypes::where([['code','LIKE','%'.$request->get('code').'%'],['name','LIKE','%'.$request->get('name').'%'],])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','EntryTypes']])->get();
		$entrytypesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($entrytypesdata['usersaccountsroles'][0]['_add']==0&&$entrytypesdata['usersaccountsroles'][0]['_list']==0&&$entrytypesdata['usersaccountsroles'][0]['_edit']==0&&$entrytypesdata['usersaccountsroles'][0]['_edit']==0&&$entrytypesdata['usersaccountsroles'][0]['_show']==0&&$entrytypesdata['usersaccountsroles'][0]['_delete']==0&&$entrytypesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('entrytypesdata'));
		}else{
			return view('admin.entry_types.index',compact('entrytypesdata'));
		}
	}

	public function report(){
		$entrytypesdata['company']=Companies::all();
		$entrytypesdata['list']=EntryTypes::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','EntryTypes']])->get();
		$entrytypesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($entrytypesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('entrytypesdata'));
		}else{
			return view('admin.entry_types.report',compact('entrytypesdata'));
		}
	}

	public function chart(){
		return view('admin.entry_types.chart');
	}

	public function store(Request $request){
		$entrytypes=new EntryTypes();
		$entrytypes->code=$request->get('code');
		$entrytypes->name=$request->get('name');
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','EntryTypes']])->get();
		$entrytypesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($entrytypesdata['usersaccountsroles'][0]['_show']==1){
			try{
				if($entrytypes->save()){
					$response['status']='1';
					$response['message']='entry types Added successfully';
					return json_encode($response);
			}else{
					$response['status']='0';
					$response['message']='Failed to add entry types. Please try again';
					return json_encode($response);
				}
			}
			catch(Exception $e){
					$response['status']='0';
					$response['message']='An Error occured while attempting to add entry types. Please try again';
					return json_encode($response);
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$entrytypesdata['data']=EntryTypes::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','EntryTypes']])->get();
		$entrytypesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($entrytypesdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('entrytypesdata'));
		}else{
		return view('admin.entry_types.edit',compact('entrytypesdata','id'));
		}
	}

	public function show($id){
		$entrytypesdata['data']=EntryTypes::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','EntryTypes']])->get();
		$entrytypesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($entrytypesdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('entrytypesdata'));
		}else{
		return view('admin.entry_types.show',compact('entrytypesdata','id'));
		}
	}

	public function update(Request $request,$id){
		$entrytypes=EntryTypes::find($id);
		$entrytypes->code=$request->get('code');
		$entrytypes->name=$request->get('name');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','EntryTypes']])->get();
		$entrytypesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($entrytypesdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('entrytypesdata'));
		}else{
		$entrytypes->save();
		$entrytypesdata['data']=EntryTypes::find($id);
		return view('admin.entry_types.edit',compact('entrytypesdata','id'));
		}
	}

	public function destroy($id){
		$entrytypes=EntryTypes::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','EntryTypes']])->get();
		$entrytypesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($entrytypesdata['usersaccountsroles'][0]['_delete']==1){
			$entrytypes->delete();
		}return redirect('admin/entrytypes')->with('success','entry types has been deleted!');
	}
}