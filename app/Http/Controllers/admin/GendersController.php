<?php
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Genders;
use App\Companies;
use App\Modules;
use App\Users;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;
class GendersController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$gendersdata['list']=Genders::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Genders']])->get();
		$gendersdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($gendersdata['usersaccountsroles'][0]['_add']==0&&$gendersdata['usersaccountsroles'][0]['_list']==0&&$gendersdata['usersaccountsroles'][0]['_edit']==0&&$gendersdata['usersaccountsroles'][0]['_edit']==0&&$gendersdata['usersaccountsroles'][0]['_show']==0&&$gendersdata['usersaccountsroles'][0]['_delete']==0&&$gendersdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('gendersdata'));
		}else{
			return view('admin.genders.index',compact('gendersdata'));
		}
	}

	public function create(){
		$gendersdata;
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Genders']])->get();
		$gendersdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($gendersdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('gendersdata'));
		}else{
			return view('admin.genders.create',compact('gendersdata'));
		}
	}

	public function filter(Request $request){
		$gendersdata['list']=Genders::where([['code','LIKE','%'.$request->get('code').'%'],['name','LIKE','%'.$request->get('name').'%'],['description','LIKE','%'.$request->get('description').'%'],])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Genders']])->get();
		$gendersdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($gendersdata['usersaccountsroles'][0]['_add']==0&&$gendersdata['usersaccountsroles'][0]['_list']==0&&$gendersdata['usersaccountsroles'][0]['_edit']==0&&$gendersdata['usersaccountsroles'][0]['_edit']==0&&$gendersdata['usersaccountsroles'][0]['_show']==0&&$gendersdata['usersaccountsroles'][0]['_delete']==0&&$gendersdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('gendersdata'));
		}else{
			return view('admin.genders.index',compact('gendersdata'));
		}
	}

	public function report(){
		$gendersdata['company']=Companies::all();
		$gendersdata['list']=Genders::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Genders']])->get();
		$gendersdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($gendersdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('gendersdata'));
		}else{
			return view('admin.genders.report',compact('gendersdata'));
		}
	}

	public function chart(){
		return view('admin.genders.chart');
	}

	public function store(Request $request){
		$genders=new Genders();
		$genders->code=$request->get('code');
		$genders->name=$request->get('name');
		$genders->description=$request->get('description');
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Genders']])->get();
		$gendersdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($gendersdata['usersaccountsroles'][0]['_show']==1){
			try{
				if($genders->save()){
					$response['status']='1';
					$response['message']='genders Added successfully';
					return json_encode($response);
			}else{
					$response['status']='0';
					$response['message']='Failed to add genders. Please try again';
					return json_encode($response);
				}
			}
			catch(Exception $e){
					$response['status']='0';
					$response['message']='An Error occured while attempting to add genders. Please try again';
					return json_encode($response);
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$gendersdata['data']=Genders::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Genders']])->get();
		$gendersdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($gendersdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('gendersdata'));
		}else{
		return view('admin.genders.edit',compact('gendersdata','id'));
		}
	}

	public function show($id){
		$gendersdata['data']=Genders::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Genders']])->get();
		$gendersdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($gendersdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('gendersdata'));
		}else{
		return view('admin.genders.show',compact('gendersdata','id'));
		}
	}

	public function update(Request $request,$id){
		$genders=Genders::find($id);
		$genders->code=$request->get('code');
		$genders->name=$request->get('name');
		$genders->description=$request->get('description');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Genders']])->get();
		$gendersdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($gendersdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('gendersdata'));
		}else{
		$genders->save();
		$gendersdata['data']=Genders::find($id);
		return view('admin.genders.edit',compact('gendersdata','id'));
		}
	}

	public function destroy($id){
		$genders=Genders::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Genders']])->get();
		$gendersdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($gendersdata['usersaccountsroles'][0]['_delete']==1){
			$genders->delete();
		}return redirect('admin/genders')->with('success','genders has been deleted!');
	}
}