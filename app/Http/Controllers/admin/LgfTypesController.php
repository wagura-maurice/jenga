<?php
/**
* @author  Wanjala Innocent Khaemba
*Controller - (manages lgf types data)
*/
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\LgfTypes;
use App\Companies;
use App\Modules;
use App\Users;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;
class LgfTypesController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$lgftypesdata['list']=LgfTypes::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LgfTypes']])->get();
		$lgftypesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($lgftypesdata['usersaccountsroles'][0]['_add']==0&&$lgftypesdata['usersaccountsroles'][0]['_list']==0&&$lgftypesdata['usersaccountsroles'][0]['_edit']==0&&$lgftypesdata['usersaccountsroles'][0]['_edit']==0&&$lgftypesdata['usersaccountsroles'][0]['_show']==0&&$lgftypesdata['usersaccountsroles'][0]['_delete']==0&&$lgftypesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('lgftypesdata'));
		}else{
			return view('admin.lgf_types.index',compact('lgftypesdata'));
		}
	}

	public function create(){
		$lgftypesdata;
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LgfTypes']])->get();
		$lgftypesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($lgftypesdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('lgftypesdata'));
		}else{
			return view('admin.lgf_types.create',compact('lgftypesdata'));
		}
	}

	public function filter(Request $request){
		$lgftypesdata['list']=LgfTypes::where([['code','LIKE','%'.$request->get('code').'%'],['name','LIKE','%'.$request->get('name').'%'],['description','LIKE','%'.$request->get('description').'%'],])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LgfTypes']])->get();
		$lgftypesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($lgftypesdata['usersaccountsroles'][0]['_add']==0&&$lgftypesdata['usersaccountsroles'][0]['_list']==0&&$lgftypesdata['usersaccountsroles'][0]['_edit']==0&&$lgftypesdata['usersaccountsroles'][0]['_edit']==0&&$lgftypesdata['usersaccountsroles'][0]['_show']==0&&$lgftypesdata['usersaccountsroles'][0]['_delete']==0&&$lgftypesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('lgftypesdata'));
		}else{
			return view('admin.lgf_types.index',compact('lgftypesdata'));
		}
	}

	public function report(){
		$lgftypesdata['company']=Companies::all();
		$lgftypesdata['list']=LgfTypes::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LgfTypes']])->get();
		$lgftypesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($lgftypesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('lgftypesdata'));
		}else{
			return view('admin.lgf_types.report',compact('lgftypesdata'));
		}
	}

	public function chart(){
		return view('admin.lgf_types.chart');
	}

	public function store(Request $request){
		$lgftypes=new LgfTypes();
		$lgftypes->code=$request->get('code');
		$lgftypes->name=$request->get('name');
		$lgftypes->description=$request->get('description');
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LgfTypes']])->get();
		$lgftypesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($lgftypesdata['usersaccountsroles'][0]['_show']==1){
			try{
				if($lgftypes->save()){
					$response['status']='1';
					$response['message']='lgf types Added successfully';
					return json_encode($response);
			}else{
					$response['status']='0';
					$response['message']='Failed to add lgf types. Please try again';
					return json_encode($response);
				}
			}
			catch(Exception $e){
					$response['status']='0';
					$response['message']='An Error occured while attempting to add lgf types. Please try again';
					return json_encode($response);
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$lgftypesdata['data']=LgfTypes::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LgfTypes']])->get();
		$lgftypesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($lgftypesdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('lgftypesdata'));
		}else{
		return view('admin.lgf_types.edit',compact('lgftypesdata','id'));
		}
	}

	public function show($id){
		$lgftypesdata['data']=LgfTypes::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LgfTypes']])->get();
		$lgftypesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($lgftypesdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('lgftypesdata'));
		}else{
		return view('admin.lgf_types.show',compact('lgftypesdata','id'));
		}
	}

	public function update(Request $request,$id){
		$lgftypes=LgfTypes::find($id);
		$lgftypes->code=$request->get('code');
		$lgftypes->name=$request->get('name');
		$lgftypes->description=$request->get('description');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LgfTypes']])->get();
		$lgftypesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($lgftypesdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('lgftypesdata'));
		}else{
		$lgftypes->save();
		$lgftypesdata['data']=LgfTypes::find($id);
		return view('admin.lgf_types.edit',compact('lgftypesdata','id'));
		}
	}

	public function destroy($id){
		$lgftypes=LgfTypes::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LgfTypes']])->get();
		$lgftypesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($lgftypesdata['usersaccountsroles'][0]['_delete']==1){
			$lgftypes->delete();
		}return redirect('admin/lgftypes')->with('success','lgf types has been deleted!');
	}
}