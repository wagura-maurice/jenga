<?php
/**
* @author  Wanjala Innocent Khaemba
*/
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Salutations;
use App\Companies;
use App\Modules;
use App\Users;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;
class SalutationsController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$salutationsdata['list']=Salutations::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Salutations']])->get();
		$salutationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($salutationsdata['usersaccountsroles'][0]['_add']==0&&$salutationsdata['usersaccountsroles'][0]['_list']==0&&$salutationsdata['usersaccountsroles'][0]['_edit']==0&&$salutationsdata['usersaccountsroles'][0]['_edit']==0&&$salutationsdata['usersaccountsroles'][0]['_show']==0&&$salutationsdata['usersaccountsroles'][0]['_delete']==0&&$salutationsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('salutationsdata'));
		}else{
			return view('admin.salutations.index',compact('salutationsdata'));
		}
	}

	public function create(){
		$salutationsdata;
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Salutations']])->get();
		$salutationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($salutationsdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('salutationsdata'));
		}else{
			return view('admin.salutations.create',compact('salutationsdata'));
		}
	}

	public function filter(Request $request){
		$salutationsdata['list']=Salutations::where([['code','LIKE','%'.$request->get('code').'%'],['name','LIKE','%'.$request->get('name').'%'],['abbreviation','LIKE','%'.$request->get('abbreviation').'%'],['description','LIKE','%'.$request->get('description').'%'],])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Salutations']])->get();
		$salutationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($salutationsdata['usersaccountsroles'][0]['_add']==0&&$salutationsdata['usersaccountsroles'][0]['_list']==0&&$salutationsdata['usersaccountsroles'][0]['_edit']==0&&$salutationsdata['usersaccountsroles'][0]['_edit']==0&&$salutationsdata['usersaccountsroles'][0]['_show']==0&&$salutationsdata['usersaccountsroles'][0]['_delete']==0&&$salutationsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('salutationsdata'));
		}else{
			return view('admin.salutations.index',compact('salutationsdata'));
		}
	}

	public function report(){
		$salutationsdata['company']=Companies::all();
		$salutationsdata['list']=Salutations::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Salutations']])->get();
		$salutationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($salutationsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('salutationsdata'));
		}else{
			return view('admin.salutations.report',compact('salutationsdata'));
		}
	}

	public function chart(){
		return view('admin.salutations.chart');
	}

	public function store(Request $request){
		$salutations=new Salutations();
		$salutations->code=$request->get('code');
		$salutations->name=$request->get('name');
		$salutations->abbreviation=$request->get('abbreviation');
		$salutations->description=$request->get('description');
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Salutations']])->get();
		$salutationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($salutationsdata['usersaccountsroles'][0]['_show']==1){
			try{
				if($salutations->save()){
					$response['status']='1';
					$response['message']='salutations Added successfully';
					return json_encode($response);
			}else{
					$response['status']='0';
					$response['message']='Failed to add salutations. Please try again';
					return json_encode($response);
				}
			}
			catch(Exception $e){
					$response['status']='0';
					$response['message']='An Error occured while attempting to add salutations. Please try again';
					return json_encode($response);
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$salutationsdata['data']=Salutations::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Salutations']])->get();
		$salutationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($salutationsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('salutationsdata'));
		}else{
		return view('admin.salutations.edit',compact('salutationsdata','id'));
		}
	}

	public function show($id){
		$salutationsdata['data']=Salutations::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Salutations']])->get();
		$salutationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($salutationsdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('salutationsdata'));
		}else{
		return view('admin.salutations.show',compact('salutationsdata','id'));
		}
	}

	public function update(Request $request,$id){
		$salutations=Salutations::find($id);
		$salutations->code=$request->get('code');
		$salutations->name=$request->get('name');
		$salutations->abbreviation=$request->get('abbreviation');
		$salutations->description=$request->get('description');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Salutations']])->get();
		$salutationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($salutationsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('salutationsdata'));
		}else{
		$salutations->save();
		$salutationsdata['data']=Salutations::find($id);
		return view('admin.salutations.edit',compact('salutationsdata','id'));
		}
	}

	public function destroy($id){
		$salutations=Salutations::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Salutations']])->get();
		$salutationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($salutationsdata['usersaccountsroles'][0]['_delete']==1){
			$salutations->delete();
		}return redirect('admin/salutations')->with('success','salutations has been deleted!');
	}
}