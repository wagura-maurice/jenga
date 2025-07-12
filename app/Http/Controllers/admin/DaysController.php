<?php
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Days;
use App\Companies;
use App\Modules;
use App\Users;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;
class DaysController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$daysdata['list']=Days::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Days']])->get();
		$daysdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($daysdata['usersaccountsroles'][0]['_add']==0&&$daysdata['usersaccountsroles'][0]['_list']==0&&$daysdata['usersaccountsroles'][0]['_edit']==0&&$daysdata['usersaccountsroles'][0]['_edit']==0&&$daysdata['usersaccountsroles'][0]['_show']==0&&$daysdata['usersaccountsroles'][0]['_delete']==0&&$daysdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('daysdata'));
		}else{
			return view('admin.days.index',compact('daysdata'));
		}
	}

	public function create(){
		$daysdata;
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Days']])->get();
		$daysdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($daysdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('daysdata'));
		}else{
			return view('admin.days.create',compact('daysdata'));
		}
	}

	public function filter(Request $request){
		$daysdata['list']=Days::where([['name','LIKE','%'.$request->get('name').'%'],['number','LIKE','%'.$request->get('number').'%'],])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Days']])->get();
		$daysdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($daysdata['usersaccountsroles'][0]['_add']==0&&$daysdata['usersaccountsroles'][0]['_list']==0&&$daysdata['usersaccountsroles'][0]['_edit']==0&&$daysdata['usersaccountsroles'][0]['_edit']==0&&$daysdata['usersaccountsroles'][0]['_show']==0&&$daysdata['usersaccountsroles'][0]['_delete']==0&&$daysdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('daysdata'));
		}else{
			return view('admin.days.index',compact('daysdata'));
		}
	}

	public function report(){
		$daysdata['company']=Companies::all();
		$daysdata['list']=Days::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Days']])->get();
		$daysdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($daysdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('daysdata'));
		}else{
			return view('admin.days.report',compact('daysdata'));
		}
	}

	public function chart(){
		return view('admin.days.chart');
	}

	public function store(Request $request){
		$days=new Days();
		$days->name=$request->get('name');
		$days->number=$request->get('number');
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Days']])->get();
		$daysdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($daysdata['usersaccountsroles'][0]['_show']==1){
			try{
				if($days->save()){
					$response['status']='1';
					$response['message']='days Added successfully';
					return json_encode($response);
			}else{
					$response['status']='0';
					$response['message']='Failed to add days. Please try again';
					return json_encode($response);
				}
			}
			catch(Exception $e){
					$response['status']='0';
					$response['message']='An Error occured while attempting to add days. Please try again';
					return json_encode($response);
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$daysdata['data']=Days::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Days']])->get();
		$daysdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($daysdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('daysdata'));
		}else{
		return view('admin.days.edit',compact('daysdata','id'));
		}
	}

	public function show($id){
		$daysdata['data']=Days::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Days']])->get();
		$daysdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($daysdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('daysdata'));
		}else{
		return view('admin.days.show',compact('daysdata','id'));
		}
	}

	public function update(Request $request,$id){
		$days=Days::find($id);
		$days->name=$request->get('name');
		$days->number=$request->get('number');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Days']])->get();
		$daysdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($daysdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('daysdata'));
		}else{
		$days->save();
		$daysdata['data']=Days::find($id);
		return view('admin.days.edit',compact('daysdata','id'));
		}
	}

	public function destroy($id){
		$days=Days::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Days']])->get();
		$daysdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($daysdata['usersaccountsroles'][0]['_delete']==1){
			$days->delete();
		}return redirect('admin/days')->with('success','days has been deleted!');
	}
}