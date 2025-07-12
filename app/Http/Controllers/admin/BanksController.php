<?php
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Banks;
use App\Companies;
use App\Modules;
use App\Users;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;
class BanksController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$banksdata['list']=Banks::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Banks']])->get();
		$banksdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($banksdata['usersaccountsroles'][0]['_add']==0&&$banksdata['usersaccountsroles'][0]['_list']==0&&$banksdata['usersaccountsroles'][0]['_edit']==0&&$banksdata['usersaccountsroles'][0]['_edit']==0&&$banksdata['usersaccountsroles'][0]['_show']==0&&$banksdata['usersaccountsroles'][0]['_delete']==0&&$banksdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('banksdata'));
		}else{
			return view('admin.banks.index',compact('banksdata'));
		}
	}

	public function create(){
		$banksdata;
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Banks']])->get();
		$banksdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($banksdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('banksdata'));
		}else{
			return view('admin.banks.create',compact('banksdata'));
		}
	}

	public function filter(Request $request){
		$banksdata['list']=Banks::where([['code','LIKE','%'.$request->get('code').'%'],['name','LIKE','%'.$request->get('name').'%'],['swift_code','LIKE','%'.$request->get('swift_code').'%'],])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Banks']])->get();
		$banksdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($banksdata['usersaccountsroles'][0]['_add']==0&&$banksdata['usersaccountsroles'][0]['_list']==0&&$banksdata['usersaccountsroles'][0]['_edit']==0&&$banksdata['usersaccountsroles'][0]['_edit']==0&&$banksdata['usersaccountsroles'][0]['_show']==0&&$banksdata['usersaccountsroles'][0]['_delete']==0&&$banksdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('banksdata'));
		}else{
			return view('admin.banks.index',compact('banksdata'));
		}
	}

	public function report(){
		$banksdata['company']=Companies::all();
		$banksdata['list']=Banks::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Banks']])->get();
		$banksdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($banksdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('banksdata'));
		}else{
			return view('admin.banks.report',compact('banksdata'));
		}
	}

	public function chart(){
		return view('admin.banks.chart');
	}

	public function store(Request $request){
		$banks=new Banks();
		$banks->code=$request->get('code');
		$banks->name=$request->get('name');
		$banks->swift_code=$request->get('swift_code');
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Banks']])->get();
		$banksdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($banksdata['usersaccountsroles'][0]['_show']==1){
			try{
				if($banks->save()){
					$response['status']='1';
					$response['message']='banks Added successfully';
					return json_encode($response);
			}else{
					$response['status']='0';
					$response['message']='Failed to add banks. Please try again';
					return json_encode($response);
				}
			}
			catch(Exception $e){
					$response['status']='0';
					$response['message']='An Error occured while attempting to add banks. Please try again';
					return json_encode($response);
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$banksdata['data']=Banks::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Banks']])->get();
		$banksdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($banksdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('banksdata'));
		}else{
		return view('admin.banks.edit',compact('banksdata','id'));
		}
	}

	public function show($id){
		$banksdata['data']=Banks::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Banks']])->get();
		$banksdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($banksdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('banksdata'));
		}else{
		return view('admin.banks.show',compact('banksdata','id'));
		}
	}

	public function update(Request $request,$id){
		$banks=Banks::find($id);
		$banks->code=$request->get('code');
		$banks->name=$request->get('name');
		$banks->swift_code=$request->get('swift_code');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Banks']])->get();
		$banksdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($banksdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('banksdata'));
		}else{
		$banks->save();
		$banksdata['data']=Banks::find($id);
		return view('admin.banks.edit',compact('banksdata','id'));
		}
	}

	public function destroy($id){
		$banks=Banks::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Banks']])->get();
		$banksdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($banksdata['usersaccountsroles'][0]['_delete']==1){
			$banks->delete();
		}return redirect('admin/banks')->with('success','banks has been deleted!');
	}
}