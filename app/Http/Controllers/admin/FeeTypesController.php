<?php
/**
* @author  Wanjala Innocent Khaemba
*Controller - (manages fee types data)
*/
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\FeeTypes;
use App\Companies;
use App\Modules;
use App\Users;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;
class FeeTypesController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$feetypesdata['list']=FeeTypes::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','FeeTypes']])->get();
		$feetypesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($feetypesdata['usersaccountsroles'][0]['_add']==0&&$feetypesdata['usersaccountsroles'][0]['_list']==0&&$feetypesdata['usersaccountsroles'][0]['_edit']==0&&$feetypesdata['usersaccountsroles'][0]['_edit']==0&&$feetypesdata['usersaccountsroles'][0]['_show']==0&&$feetypesdata['usersaccountsroles'][0]['_delete']==0&&$feetypesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('feetypesdata'));
		}else{
			return view('admin.fee_types.index',compact('feetypesdata'));
		}
	}

	public function create(){
		$feetypesdata;
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','FeeTypes']])->get();
		$feetypesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($feetypesdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('feetypesdata'));
		}else{
			return view('admin.fee_types.create',compact('feetypesdata'));
		}
	}

	public function filter(Request $request){
		$feetypesdata['list']=FeeTypes::where([['code','LIKE','%'.$request->get('code').'%'],['name','LIKE','%'.$request->get('name').'%'],['description','LIKE','%'.$request->get('description').'%'],])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','FeeTypes']])->get();
		$feetypesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($feetypesdata['usersaccountsroles'][0]['_add']==0&&$feetypesdata['usersaccountsroles'][0]['_list']==0&&$feetypesdata['usersaccountsroles'][0]['_edit']==0&&$feetypesdata['usersaccountsroles'][0]['_edit']==0&&$feetypesdata['usersaccountsroles'][0]['_show']==0&&$feetypesdata['usersaccountsroles'][0]['_delete']==0&&$feetypesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('feetypesdata'));
		}else{
			return view('admin.fee_types.index',compact('feetypesdata'));
		}
	}

	public function report(){
		$feetypesdata['company']=Companies::all();
		$feetypesdata['list']=FeeTypes::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','FeeTypes']])->get();
		$feetypesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($feetypesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('feetypesdata'));
		}else{
			return view('admin.fee_types.report',compact('feetypesdata'));
		}
	}

	public function chart(){
		return view('admin.fee_types.chart');
	}

	public function store(Request $request){
		$feetypes=new FeeTypes();
		$feetypes->code=$request->get('code');
		$feetypes->name=$request->get('name');
		$feetypes->description=$request->get('description');
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','FeeTypes']])->get();
		$feetypesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($feetypesdata['usersaccountsroles'][0]['_show']==1){
			try{
				if($feetypes->save()){
					$response['status']='1';
					$response['message']='fee types Added successfully';
					return json_encode($response);
			}else{
					$response['status']='0';
					$response['message']='Failed to add fee types. Please try again';
					return json_encode($response);
				}
			}
			catch(Exception $e){
					$response['status']='0';
					$response['message']='An Error occured while attempting to add fee types. Please try again';
					return json_encode($response);
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$feetypesdata['data']=FeeTypes::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','FeeTypes']])->get();
		$feetypesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($feetypesdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('feetypesdata'));
		}else{
		return view('admin.fee_types.edit',compact('feetypesdata','id'));
		}
	}

	public function show($id){
		$feetypesdata['data']=FeeTypes::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','FeeTypes']])->get();
		$feetypesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($feetypesdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('feetypesdata'));
		}else{
		return view('admin.fee_types.show',compact('feetypesdata','id'));
		}
	}

	public function update(Request $request,$id){
		$feetypes=FeeTypes::find($id);
		$feetypes->code=$request->get('code');
		$feetypes->name=$request->get('name');
		$feetypes->description=$request->get('description');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','FeeTypes']])->get();
		$feetypesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($feetypesdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('feetypesdata'));
		}else{
		$feetypes->save();
		$feetypesdata['data']=FeeTypes::find($id);
		return view('admin.fee_types.edit',compact('feetypesdata','id'));
		}
	}

	public function destroy($id){
		$feetypes=FeeTypes::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','FeeTypes']])->get();
		$feetypesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($feetypesdata['usersaccountsroles'][0]['_delete']==1){
			$feetypes->delete();
		}return redirect('admin/feetypes')->with('success','fee types has been deleted!');
	}
}