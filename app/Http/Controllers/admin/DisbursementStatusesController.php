<?php
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\DisbursementStatuses;
use App\Companies;
use App\Modules;
use App\Users;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;
class DisbursementStatusesController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$disbursementstatusesdata['list']=DisbursementStatuses::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','DisbursementStatuses']])->get();
		$disbursementstatusesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($disbursementstatusesdata['usersaccountsroles'][0]['_add']==0&&$disbursementstatusesdata['usersaccountsroles'][0]['_list']==0&&$disbursementstatusesdata['usersaccountsroles'][0]['_edit']==0&&$disbursementstatusesdata['usersaccountsroles'][0]['_edit']==0&&$disbursementstatusesdata['usersaccountsroles'][0]['_show']==0&&$disbursementstatusesdata['usersaccountsroles'][0]['_delete']==0&&$disbursementstatusesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('disbursementstatusesdata'));
		}else{
			return view('admin.disbursement_statuses.index',compact('disbursementstatusesdata'));
		}
	}

	public function create(){
		$disbursementstatusesdata;
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','DisbursementStatuses']])->get();
		$disbursementstatusesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($disbursementstatusesdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('disbursementstatusesdata'));
		}else{
			return view('admin.disbursement_statuses.create',compact('disbursementstatusesdata'));
		}
	}

	public function filter(Request $request){
		$disbursementstatusesdata['list']=DisbursementStatuses::where([['code','LIKE','%'.$request->get('code').'%'],['name','LIKE','%'.$request->get('name').'%'],['description','LIKE','%'.$request->get('description').'%'],])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','DisbursementStatuses']])->get();
		$disbursementstatusesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($disbursementstatusesdata['usersaccountsroles'][0]['_add']==0&&$disbursementstatusesdata['usersaccountsroles'][0]['_list']==0&&$disbursementstatusesdata['usersaccountsroles'][0]['_edit']==0&&$disbursementstatusesdata['usersaccountsroles'][0]['_edit']==0&&$disbursementstatusesdata['usersaccountsroles'][0]['_show']==0&&$disbursementstatusesdata['usersaccountsroles'][0]['_delete']==0&&$disbursementstatusesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('disbursementstatusesdata'));
		}else{
			return view('admin.disbursement_statuses.index',compact('disbursementstatusesdata'));
		}
	}

	public function report(){
		$disbursementstatusesdata['company']=Companies::all();
		$disbursementstatusesdata['list']=DisbursementStatuses::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','DisbursementStatuses']])->get();
		$disbursementstatusesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($disbursementstatusesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('disbursementstatusesdata'));
		}else{
			return view('admin.disbursement_statuses.report',compact('disbursementstatusesdata'));
		}
	}

	public function chart(){
		return view('admin.disbursement_statuses.chart');
	}

	public function store(Request $request){
		$disbursementstatuses=new DisbursementStatuses();
		$disbursementstatuses->code=$request->get('code');
		$disbursementstatuses->name=$request->get('name');
		$disbursementstatuses->description=$request->get('description');
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','DisbursementStatuses']])->get();
		$disbursementstatusesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($disbursementstatusesdata['usersaccountsroles'][0]['_show']==1){
			try{
				if($disbursementstatuses->save()){
					$response['status']='1';
					$response['message']='disbursement statuses Added successfully';
					return json_encode($response);
			}else{
					$response['status']='0';
					$response['message']='Failed to add disbursement statuses. Please try again';
					return json_encode($response);
				}
			}
			catch(Exception $e){
					$response['status']='0';
					$response['message']='An Error occured while attempting to add disbursement statuses. Please try again';
					return json_encode($response);
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$disbursementstatusesdata['data']=DisbursementStatuses::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','DisbursementStatuses']])->get();
		$disbursementstatusesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($disbursementstatusesdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('disbursementstatusesdata'));
		}else{
		return view('admin.disbursement_statuses.edit',compact('disbursementstatusesdata','id'));
		}
	}

	public function show($id){
		$disbursementstatusesdata['data']=DisbursementStatuses::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','DisbursementStatuses']])->get();
		$disbursementstatusesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($disbursementstatusesdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('disbursementstatusesdata'));
		}else{
		return view('admin.disbursement_statuses.show',compact('disbursementstatusesdata','id'));
		}
	}

	public function update(Request $request,$id){
		$disbursementstatuses=DisbursementStatuses::find($id);
		$disbursementstatuses->code=$request->get('code');
		$disbursementstatuses->name=$request->get('name');
		$disbursementstatuses->description=$request->get('description');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','DisbursementStatuses']])->get();
		$disbursementstatusesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($disbursementstatusesdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('disbursementstatusesdata'));
		}else{
		$disbursementstatuses->save();
		$disbursementstatusesdata['data']=DisbursementStatuses::find($id);
		return view('admin.disbursement_statuses.edit',compact('disbursementstatusesdata','id'));
		}
	}

	public function destroy($id){
		$disbursementstatuses=DisbursementStatuses::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','DisbursementStatuses']])->get();
		$disbursementstatusesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($disbursementstatusesdata['usersaccountsroles'][0]['_delete']==1){
			$disbursementstatuses->delete();
		}return redirect('admin/disbursementstatuses')->with('success','disbursement statuses has been deleted!');
	}
}