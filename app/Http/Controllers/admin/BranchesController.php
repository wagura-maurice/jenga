<?php
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Branches;
use App\Companies;
use App\Modules;
use App\Users;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;
class BranchesController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$branchesdata['list']=Branches::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Branches']])->get();
		$branchesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($branchesdata['usersaccountsroles'][0]['_add']==0&&$branchesdata['usersaccountsroles'][0]['_list']==0&&$branchesdata['usersaccountsroles'][0]['_edit']==0&&$branchesdata['usersaccountsroles'][0]['_edit']==0&&$branchesdata['usersaccountsroles'][0]['_show']==0&&$branchesdata['usersaccountsroles'][0]['_delete']==0&&$branchesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('branchesdata'));
		}else{
			return view('admin.branches.index',compact('branchesdata'));
		}
	}

	public function create(){
		$branchesdata;
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Branches']])->get();
		$branchesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($branchesdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('branchesdata'));
		}else{
			return view('admin.branches.create',compact('branchesdata'));
		}
	}

	public function filter(Request $request){
		$branchesdata['list']=Branches::where([['code','LIKE','%'.$request->get('code').'%'],['name','LIKE','%'.$request->get('name').'%'],])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Branches']])->get();
		$branchesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($branchesdata['usersaccountsroles'][0]['_add']==0&&$branchesdata['usersaccountsroles'][0]['_list']==0&&$branchesdata['usersaccountsroles'][0]['_edit']==0&&$branchesdata['usersaccountsroles'][0]['_edit']==0&&$branchesdata['usersaccountsroles'][0]['_show']==0&&$branchesdata['usersaccountsroles'][0]['_delete']==0&&$branchesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('branchesdata'));
		}else{
			return view('admin.branches.index',compact('branchesdata'));
		}
	}

	public function report(){
		$branchesdata['company']=Companies::all();
		$branchesdata['list']=Branches::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Branches']])->get();
		$branchesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($branchesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('branchesdata'));
		}else{
			return view('admin.branches.report',compact('branchesdata'));
		}
	}

	public function chart(){
		return view('admin.branches.chart');
	}

	public function store(Request $request){
		$branches=new Branches();
		$branches->code=$request->get('code');
		$branches->name=$request->get('name');
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Branches']])->get();
		$branchesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($branchesdata['usersaccountsroles'][0]['_show']==1){
			try{
				if($branches->save()){
					$response['status']='1';
					$response['message']='branches Added successfully';
					return json_encode($response);
			}else{
					$response['status']='0';
					$response['message']='Failed to add branches. Please try again';
					return json_encode($response);
				}
			}
			catch(Exception $e){
					$response['status']='0';
					$response['message']='An Error occured while attempting to add branches. Please try again';
					return json_encode($response);
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$branchesdata['data']=Branches::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Branches']])->get();
		$branchesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($branchesdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('branchesdata'));
		}else{
		return view('admin.branches.edit',compact('branchesdata','id'));
		}
	}

	public function show($id){
		$branchesdata['data']=Branches::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Branches']])->get();
		$branchesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($branchesdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('branchesdata'));
		}else{
		return view('admin.branches.show',compact('branchesdata','id'));
		}
	}

	public function update(Request $request,$id){
		$branches=Branches::find($id);
		$branches->code=$request->get('code');
		$branches->name=$request->get('name');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Branches']])->get();
		$branchesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($branchesdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('branchesdata'));
		}else{
		$branches->save();
		$branchesdata['data']=Branches::find($id);
		return view('admin.branches.edit',compact('branchesdata','id'));
		}
	}

	public function destroy($id){
		$branches=Branches::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Branches']])->get();
		$branchesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($branchesdata['usersaccountsroles'][0]['_delete']==1){
			$branches->delete();
		}return redirect('admin/branches')->with('success','branches has been deleted!');
	}
}