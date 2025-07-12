<?php
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\ApprovalLevels;
use App\Companies;
use App\Modules;
use App\Users;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;
class ApprovalLevelsController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$approvallevelsdata['list']=ApprovalLevels::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ApprovalLevels']])->get();
		$approvallevelsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($approvallevelsdata['usersaccountsroles'][0]['_add']==0&&$approvallevelsdata['usersaccountsroles'][0]['_list']==0&&$approvallevelsdata['usersaccountsroles'][0]['_edit']==0&&$approvallevelsdata['usersaccountsroles'][0]['_edit']==0&&$approvallevelsdata['usersaccountsroles'][0]['_show']==0&&$approvallevelsdata['usersaccountsroles'][0]['_delete']==0&&$approvallevelsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('approvallevelsdata'));
		}else{
			return view('admin.approval_levels.index',compact('approvallevelsdata'));
		}
	}

	public function create(){
		$approvallevelsdata;
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ApprovalLevels']])->get();
		$approvallevelsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($approvallevelsdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('approvallevelsdata'));
		}else{
			return view('admin.approval_levels.create',compact('approvallevelsdata'));
		}
	}

	public function filter(Request $request){
		$approvallevelsdata['list']=ApprovalLevels::where([['name','LIKE','%'.$request->get('name').'%'],['level','LIKE','%'.$request->get('level').'%'],])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ApprovalLevels']])->get();
		$approvallevelsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($approvallevelsdata['usersaccountsroles'][0]['_add']==0&&$approvallevelsdata['usersaccountsroles'][0]['_list']==0&&$approvallevelsdata['usersaccountsroles'][0]['_edit']==0&&$approvallevelsdata['usersaccountsroles'][0]['_edit']==0&&$approvallevelsdata['usersaccountsroles'][0]['_show']==0&&$approvallevelsdata['usersaccountsroles'][0]['_delete']==0&&$approvallevelsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('approvallevelsdata'));
		}else{
			return view('admin.approval_levels.index',compact('approvallevelsdata'));
		}
	}

	public function report(){
		$approvallevelsdata['company']=Companies::all();
		$approvallevelsdata['list']=ApprovalLevels::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ApprovalLevels']])->get();
		$approvallevelsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($approvallevelsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('approvallevelsdata'));
		}else{
			return view('admin.approval_levels.report',compact('approvallevelsdata'));
		}
	}

	public function chart(){
		return view('admin.approval_levels.chart');
	}

	public function store(Request $request){
		$approvallevels=new ApprovalLevels();
		$approvallevels->name=$request->get('name');
		$approvallevels->level=$request->get('level');
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ApprovalLevels']])->get();
		$approvallevelsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($approvallevelsdata['usersaccountsroles'][0]['_show']==1){
			try{
				if($approvallevels->save()){
					$response['status']='1';
					$response['message']='approval levels Added successfully';
					return json_encode($response);
			}else{
					$response['status']='0';
					$response['message']='Failed to add approval levels. Please try again';
					return json_encode($response);
				}
			}
			catch(Exception $e){
					$response['status']='0';
					$response['message']='An Error occured while attempting to add approval levels. Please try again';
					return json_encode($response);
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$approvallevelsdata['data']=ApprovalLevels::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ApprovalLevels']])->get();
		$approvallevelsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($approvallevelsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('approvallevelsdata'));
		}else{
		return view('admin.approval_levels.edit',compact('approvallevelsdata','id'));
		}
	}

	public function show($id){
		$approvallevelsdata['data']=ApprovalLevels::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ApprovalLevels']])->get();
		$approvallevelsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($approvallevelsdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('approvallevelsdata'));
		}else{
		return view('admin.approval_levels.show',compact('approvallevelsdata','id'));
		}
	}

	public function update(Request $request,$id){
		$approvallevels=ApprovalLevels::find($id);
		$approvallevels->name=$request->get('name');
		$approvallevels->level=$request->get('level');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ApprovalLevels']])->get();
		$approvallevelsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($approvallevelsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('approvallevelsdata'));
		}else{
		$approvallevels->save();
		$approvallevelsdata['data']=ApprovalLevels::find($id);
		return view('admin.approval_levels.edit',compact('approvallevelsdata','id'));
		}
	}

	public function destroy($id){
		$approvallevels=ApprovalLevels::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ApprovalLevels']])->get();
		$approvallevelsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($approvallevelsdata['usersaccountsroles'][0]['_delete']==1){
			$approvallevels->delete();
		}return redirect('admin/approvallevels')->with('success','approval levels has been deleted!');
	}
}