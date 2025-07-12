<?php
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\ApprovalStatuses;
use App\Companies;
use App\Modules;
use App\Users;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;
class ApprovalStatusesController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$approvalstatusesdata['list']=ApprovalStatuses::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ApprovalStatuses']])->get();
		$approvalstatusesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($approvalstatusesdata['usersaccountsroles'][0]['_add']==0&&$approvalstatusesdata['usersaccountsroles'][0]['_list']==0&&$approvalstatusesdata['usersaccountsroles'][0]['_edit']==0&&$approvalstatusesdata['usersaccountsroles'][0]['_edit']==0&&$approvalstatusesdata['usersaccountsroles'][0]['_show']==0&&$approvalstatusesdata['usersaccountsroles'][0]['_delete']==0&&$approvalstatusesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('approvalstatusesdata'));
		}else{
			return view('admin.approval_statuses.index',compact('approvalstatusesdata'));
		}
	}

	public function create(){
		$approvalstatusesdata;
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ApprovalStatuses']])->get();
		$approvalstatusesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($approvalstatusesdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('approvalstatusesdata'));
		}else{
			return view('admin.approval_statuses.create',compact('approvalstatusesdata'));
		}
	}

	public function filter(Request $request){
		$approvalstatusesdata['list']=ApprovalStatuses::where([['code','LIKE','%'.$request->get('code').'%'],['name','LIKE','%'.$request->get('name').'%'],])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ApprovalStatuses']])->get();
		$approvalstatusesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($approvalstatusesdata['usersaccountsroles'][0]['_add']==0&&$approvalstatusesdata['usersaccountsroles'][0]['_list']==0&&$approvalstatusesdata['usersaccountsroles'][0]['_edit']==0&&$approvalstatusesdata['usersaccountsroles'][0]['_edit']==0&&$approvalstatusesdata['usersaccountsroles'][0]['_show']==0&&$approvalstatusesdata['usersaccountsroles'][0]['_delete']==0&&$approvalstatusesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('approvalstatusesdata'));
		}else{
			return view('admin.approval_statuses.index',compact('approvalstatusesdata'));
		}
	}

	public function report(){
		$approvalstatusesdata['company']=Companies::all();
		$approvalstatusesdata['list']=ApprovalStatuses::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ApprovalStatuses']])->get();
		$approvalstatusesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($approvalstatusesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('approvalstatusesdata'));
		}else{
			return view('admin.approval_statuses.report',compact('approvalstatusesdata'));
		}
	}

	public function chart(){
		return view('admin.approval_statuses.chart');
	}

	public function store(Request $request){
		$approvalstatuses=new ApprovalStatuses();
		$approvalstatuses->code=$request->get('code');
		$approvalstatuses->name=$request->get('name');
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ApprovalStatuses']])->get();
		$approvalstatusesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($approvalstatusesdata['usersaccountsroles'][0]['_show']==1){
			try{
				if($approvalstatuses->save()){
					$response['status']='1';
					$response['message']='approval statuses Added successfully';
					return json_encode($response);
			}else{
					$response['status']='0';
					$response['message']='Failed to add approval statuses. Please try again';
					return json_encode($response);
				}
			}
			catch(Exception $e){
					$response['status']='0';
					$response['message']='An Error occured while attempting to add approval statuses. Please try again';
					return json_encode($response);
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$approvalstatusesdata['data']=ApprovalStatuses::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ApprovalStatuses']])->get();
		$approvalstatusesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($approvalstatusesdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('approvalstatusesdata'));
		}else{
		return view('admin.approval_statuses.edit',compact('approvalstatusesdata','id'));
		}
	}

	public function show($id){
		$approvalstatusesdata['data']=ApprovalStatuses::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ApprovalStatuses']])->get();
		$approvalstatusesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($approvalstatusesdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('approvalstatusesdata'));
		}else{
		return view('admin.approval_statuses.show',compact('approvalstatusesdata','id'));
		}
	}

	public function update(Request $request,$id){
		$approvalstatuses=ApprovalStatuses::find($id);
		$approvalstatuses->code=$request->get('code');
		$approvalstatuses->name=$request->get('name');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ApprovalStatuses']])->get();
		$approvalstatusesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($approvalstatusesdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('approvalstatusesdata'));
		}else{
		$approvalstatuses->save();
		$approvalstatusesdata['data']=ApprovalStatuses::find($id);
		return view('admin.approval_statuses.edit',compact('approvalstatusesdata','id'));
		}
	}

	public function destroy($id){
		$approvalstatuses=ApprovalStatuses::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ApprovalStatuses']])->get();
		$approvalstatusesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($approvalstatusesdata['usersaccountsroles'][0]['_delete']==1){
			$approvalstatuses->delete();
		}return redirect('admin/approvalstatuses')->with('success','approval statuses has been deleted!');
	}
}