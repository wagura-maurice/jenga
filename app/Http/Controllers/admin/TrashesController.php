<?php
/**
* @author  Wanjala Innocent Khaemba
*Controller - (manages trash details)
*/
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Trashes;
use App\Companies;
use App\Modules;
use App\Users;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;
class TrashesController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$trashesdata['list']=Trashes::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Trashes']])->get();
		$trashesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($trashesdata['usersaccountsroles'][0]['_add']==0&&$trashesdata['usersaccountsroles'][0]['_list']==0&&$trashesdata['usersaccountsroles'][0]['_edit']==0&&$trashesdata['usersaccountsroles'][0]['_edit']==0&&$trashesdata['usersaccountsroles'][0]['_show']==0&&$trashesdata['usersaccountsroles'][0]['_delete']==0&&$trashesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('trashesdata'));
		}else{
			return view('admin.trashes.index',compact('trashesdata'));
		}
	}

	public function create(){
		$trashesdata;
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Trashes']])->get();
		$trashesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($trashesdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('trashesdata'));
		}else{
			return view('admin.trashes.create',compact('trashesdata'));
		}
	}

	public function filter(Request $request){
		$trashesdata['list']=Trashes::where([])->orWhereBetween('date',[$request->get('datefrom'),$request->get('dateto')])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Trashes']])->get();
		$trashesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($trashesdata['usersaccountsroles'][0]['_add']==0&&$trashesdata['usersaccountsroles'][0]['_list']==0&&$trashesdata['usersaccountsroles'][0]['_edit']==0&&$trashesdata['usersaccountsroles'][0]['_edit']==0&&$trashesdata['usersaccountsroles'][0]['_show']==0&&$trashesdata['usersaccountsroles'][0]['_delete']==0&&$trashesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('trashesdata'));
		}else{
			return view('admin.trashes.index',compact('trashesdata'));
		}
	}

	public function report(){
		$trashesdata['company']=Companies::all();
		$trashesdata['list']=Trashes::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Trashes']])->get();
		$trashesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($trashesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('trashesdata'));
		}else{
			return view('admin.trashes.report',compact('trashesdata'));
		}
	}

	public function chart(){
		return view('admin.trashes.chart');
	}

	public function store(Request $request){
		$trashes=new Trashes();
		$trashes->date=$request->get('date');
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Trashes']])->get();
		$trashesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($trashesdata['usersaccountsroles'][0]['_show']==1){
			try{
				if($trashes->save()){
					$response['status']='1';
					$response['message']='trashes Added successfully';
					return json_encode($response);
			}else{
					$response['status']='0';
					$response['message']='Failed to add trashes. Please try again';
					return json_encode($response);
				}
			}
			catch(Exception $e){
					$response['status']='0';
					$response['message']='An Error occured while attempting to add trashes. Please try again';
					return json_encode($response);
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$trashesdata['data']=Trashes::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Trashes']])->get();
		$trashesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($trashesdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('trashesdata'));
		}else{
		return view('admin.trashes.edit',compact('trashesdata','id'));
		}
	}

	public function show($id){
		$trashesdata['data']=Trashes::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Trashes']])->get();
		$trashesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($trashesdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('trashesdata'));
		}else{
		return view('admin.trashes.show',compact('trashesdata','id'));
		}
	}

	public function update(Request $request,$id){
		$trashes=Trashes::find($id);
		$trashes->date=$request->get('date');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Trashes']])->get();
		$trashesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($trashesdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('trashesdata'));
		}else{
		$trashes->save();
		$trashesdata['data']=Trashes::find($id);
		return view('admin.trashes.edit',compact('trashesdata','id'));
		}
	}

	public function destroy($id){
		$trashes=Trashes::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Trashes']])->get();
		$trashesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($trashesdata['usersaccountsroles'][0]['_delete']==1){
			$trashes->delete();
		}return redirect('admin/trashes')->with('success','trashes has been deleted!');
	}
}