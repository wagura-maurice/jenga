<?php
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\BankBranches;
use App\Companies;
use App\Modules;
use App\Users;
use App\Banks;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;
class BankBranchesController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$bankbranchesdata['banks']=Banks::all();
		$bankbranchesdata['list']=BankBranches::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','BankBranches']])->get();
		$bankbranchesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($bankbranchesdata['usersaccountsroles'][0]['_add']==0&&$bankbranchesdata['usersaccountsroles'][0]['_list']==0&&$bankbranchesdata['usersaccountsroles'][0]['_edit']==0&&$bankbranchesdata['usersaccountsroles'][0]['_edit']==0&&$bankbranchesdata['usersaccountsroles'][0]['_show']==0&&$bankbranchesdata['usersaccountsroles'][0]['_delete']==0&&$bankbranchesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('bankbranchesdata'));
		}else{
			return view('admin.bank_branches.index',compact('bankbranchesdata'));
		}
	}

	public function create(){
		$bankbranchesdata;
		$bankbranchesdata['banks']=Banks::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','BankBranches']])->get();
		$bankbranchesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($bankbranchesdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('bankbranchesdata'));
		}else{
			return view('admin.bank_branches.create',compact('bankbranchesdata'));
		}
	}

	public function filter(Request $request){
		$bankbranchesdata['banks']=Banks::all();
		$bankbranchesdata['list']=BankBranches::where([['bank','LIKE','%'.$request->get('bank').'%'],['code','LIKE','%'.$request->get('code').'%'],['name','LIKE','%'.$request->get('name').'%'],])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','BankBranches']])->get();
		$bankbranchesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($bankbranchesdata['usersaccountsroles'][0]['_add']==0&&$bankbranchesdata['usersaccountsroles'][0]['_list']==0&&$bankbranchesdata['usersaccountsroles'][0]['_edit']==0&&$bankbranchesdata['usersaccountsroles'][0]['_edit']==0&&$bankbranchesdata['usersaccountsroles'][0]['_show']==0&&$bankbranchesdata['usersaccountsroles'][0]['_delete']==0&&$bankbranchesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('bankbranchesdata'));
		}else{
			return view('admin.bank_branches.index',compact('bankbranchesdata'));
		}
	}

	public function report(){
		$bankbranchesdata['company']=Companies::all();
		$bankbranchesdata['list']=BankBranches::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','BankBranches']])->get();
		$bankbranchesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($bankbranchesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('bankbranchesdata'));
		}else{
			return view('admin.bank_branches.report',compact('bankbranchesdata'));
		}
	}

	public function chart(){
		return view('admin.bank_branches.chart');
	}

	public function store(Request $request){
		$bankbranches=new BankBranches();
		$bankbranches->bank=$request->get('bank');
		$bankbranches->code=$request->get('code');
		$bankbranches->name=$request->get('name');
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','BankBranches']])->get();
		$bankbranchesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($bankbranchesdata['usersaccountsroles'][0]['_show']==1){
			try{
				if($bankbranches->save()){
					$response['status']='1';
					$response['message']='bank branches Added successfully';
					return json_encode($response);
			}else{
					$response['status']='0';
					$response['message']='Failed to add bank branches. Please try again';
					return json_encode($response);
				}
			}
			catch(Exception $e){
					$response['status']='0';
					$response['message']='An Error occured while attempting to add bank branches. Please try again';
					return json_encode($response);
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$bankbranchesdata['banks']=Banks::all();
		$bankbranchesdata['data']=BankBranches::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','BankBranches']])->get();
		$bankbranchesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($bankbranchesdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('bankbranchesdata'));
		}else{
		return view('admin.bank_branches.edit',compact('bankbranchesdata','id'));
		}
	}

	public function show($id){
		$bankbranchesdata['banks']=Banks::all();
		$bankbranchesdata['data']=BankBranches::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','BankBranches']])->get();
		$bankbranchesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($bankbranchesdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('bankbranchesdata'));
		}else{
		return view('admin.bank_branches.show',compact('bankbranchesdata','id'));
		}
	}

	public function update(Request $request,$id){
		$bankbranches=BankBranches::find($id);
		$bankbranches->bank=$request->get('bank');
		$bankbranches->code=$request->get('code');
		$bankbranches->name=$request->get('name');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','BankBranches']])->get();
		$bankbranchesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($bankbranchesdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('bankbranchesdata'));
		}else{
		$bankbranches->save();
		$bankbranchesdata['data']=BankBranches::find($id);
		return view('admin.bank_branches.edit',compact('bankbranchesdata','id'));
		}
	}

	public function destroy($id){
		$bankbranches=BankBranches::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','BankBranches']])->get();
		$bankbranchesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($bankbranchesdata['usersaccountsroles'][0]['_delete']==1){
			$bankbranches->delete();
		}return redirect('admin/bankbranches')->with('success','bank branches has been deleted!');
	}
}