<?php
/**
* @author  Wanjala Innocent Khaemba
*Controller - (manages trash details)
*/
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Trash;
use App\Companies;
use App\Modules;
use App\Users;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;
class TrashController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$trashdata['list']=Trash::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Trash']])->get();
		$trashdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($trashdata['usersaccountsroles'][0]['_add']==0&&$trashdata['usersaccountsroles'][0]['_list']==0&&$trashdata['usersaccountsroles'][0]['_edit']==0&&$trashdata['usersaccountsroles'][0]['_edit']==0&&$trashdata['usersaccountsroles'][0]['_show']==0&&$trashdata['usersaccountsroles'][0]['_delete']==0&&$trashdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('trashdata'));
		}else{
			return view('admin.trash.index',compact('trashdata'));
		}
	}

	public function create(){
		$trashdata;
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Trash']])->get();
		$trashdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($trashdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('trashdata'));
		}else{
			return view('admin.trash.create',compact('trashdata'));
		}
	}

	public function filter(Request $request){
		$trashdata['list']=Trash::where([])->orWhereBetween('date',[$request->get('datefrom'),$request->get('dateto')])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Trash']])->get();
		$trashdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($trashdata['usersaccountsroles'][0]['_add']==0&&$trashdata['usersaccountsroles'][0]['_list']==0&&$trashdata['usersaccountsroles'][0]['_edit']==0&&$trashdata['usersaccountsroles'][0]['_edit']==0&&$trashdata['usersaccountsroles'][0]['_show']==0&&$trashdata['usersaccountsroles'][0]['_delete']==0&&$trashdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('trashdata'));
		}else{
			return view('admin.trash.index',compact('trashdata'));
		}
	}

	public function report(){
		$trashdata['company']=Companies::all();
		$trashdata['list']=Trash::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Trash']])->get();
		$trashdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($trashdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('trashdata'));
		}else{
			return view('admin.trash.report',compact('trashdata'));
		}
	}

	public function chart(){
		return view('admin.trash.chart');
	}

	public function store(Request $request){
		$trash=new Trash();
		$trash->date=$request->get('date');
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Trash']])->get();
		$trashdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($trashdata['usersaccountsroles'][0]['_show']==1){
			try{
				if($trash->save()){
					$response['status']='1';
					$response['message']='trash Added successfully';
					return json_encode($response);
			}else{
					$response['status']='0';
					$response['message']='Failed to add trash. Please try again';
					return json_encode($response);
				}
			}
			catch(Exception $e){
					$response['status']='0';
					$response['message']='An Error occured while attempting to add trash. Please try again';
					return json_encode($response);
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$trashdata['data']=Trash::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Trash']])->get();
		$trashdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($trashdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('trashdata'));
		}else{
		return view('admin.trash.edit',compact('trashdata','id'));
		}
	}

	public function show($id){
		$trashdata['data']=Trash::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Trash']])->get();
		$trashdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($trashdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('trashdata'));
		}else{
		return view('admin.trash.show',compact('trashdata','id'));
		}
	}

	public function update(Request $request,$id){
		$trash=Trash::find($id);
		$trash->date=$request->get('date');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Trash']])->get();
		$trashdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($trashdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('trashdata'));
		}else{
		$trash->save();
		$trashdata['data']=Trash::find($id);
		return view('admin.trash.edit',compact('trashdata','id'));
		}
	}

	public function destroy($id){
		$trash=Trash::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Trash']])->get();
		$trashdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($trashdata['usersaccountsroles'][0]['_delete']==1){
			$trash->delete();
		}return redirect('admin/trash')->with('success','trash has been deleted!');
	}
}