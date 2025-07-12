<?php
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\LoanStatuses;
use App\Companies;
use App\Modules;
use App\Users;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;
class LoanStatusesController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$loanstatusesdata['list']=LoanStatuses::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LoanStatuses']])->get();
		$loanstatusesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($loanstatusesdata['usersaccountsroles'][0]['_add']==0&&$loanstatusesdata['usersaccountsroles'][0]['_list']==0&&$loanstatusesdata['usersaccountsroles'][0]['_edit']==0&&$loanstatusesdata['usersaccountsroles'][0]['_edit']==0&&$loanstatusesdata['usersaccountsroles'][0]['_show']==0&&$loanstatusesdata['usersaccountsroles'][0]['_delete']==0&&$loanstatusesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('loanstatusesdata'));
		}else{
			return view('admin.loan_statuses.index',compact('loanstatusesdata'));
		}
	}

	public function create(){
		$loanstatusesdata;
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LoanStatuses']])->get();
		$loanstatusesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($loanstatusesdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('loanstatusesdata'));
		}else{
			return view('admin.loan_statuses.create',compact('loanstatusesdata'));
		}
	}

	public function filter(Request $request){
		$loanstatusesdata['list']=LoanStatuses::where([['code','LIKE','%'.$request->get('code').'%'],['name','LIKE','%'.$request->get('name').'%'],['description','LIKE','%'.$request->get('description').'%'],])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LoanStatuses']])->get();
		$loanstatusesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($loanstatusesdata['usersaccountsroles'][0]['_add']==0&&$loanstatusesdata['usersaccountsroles'][0]['_list']==0&&$loanstatusesdata['usersaccountsroles'][0]['_edit']==0&&$loanstatusesdata['usersaccountsroles'][0]['_edit']==0&&$loanstatusesdata['usersaccountsroles'][0]['_show']==0&&$loanstatusesdata['usersaccountsroles'][0]['_delete']==0&&$loanstatusesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('loanstatusesdata'));
		}else{
			return view('admin.loan_statuses.index',compact('loanstatusesdata'));
		}
	}

	public function report(){
		$loanstatusesdata['company']=Companies::all();
		$loanstatusesdata['list']=LoanStatuses::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LoanStatuses']])->get();
		$loanstatusesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($loanstatusesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('loanstatusesdata'));
		}else{
			return view('admin.loan_statuses.report',compact('loanstatusesdata'));
		}
	}

	public function chart(){
		return view('admin.loan_statuses.chart');
	}

	public function store(Request $request){
		$loanstatuses=new LoanStatuses();
		$loanstatuses->code=$request->get('code');
		$loanstatuses->name=$request->get('name');
		$loanstatuses->description=$request->get('description');
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LoanStatuses']])->get();
		$loanstatusesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($loanstatusesdata['usersaccountsroles'][0]['_show']==1){
			try{
				if($loanstatuses->save()){
					$response['status']='1';
					$response['message']='loan statuses Added successfully';
					return json_encode($response);
			}else{
					$response['status']='0';
					$response['message']='Failed to add loan statuses. Please try again';
					return json_encode($response);
				}
			}
			catch(Exception $e){
					$response['status']='0';
					$response['message']='An Error occured while attempting to add loan statuses. Please try again';
					return json_encode($response);
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$loanstatusesdata['data']=LoanStatuses::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LoanStatuses']])->get();
		$loanstatusesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($loanstatusesdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('loanstatusesdata'));
		}else{
		return view('admin.loan_statuses.edit',compact('loanstatusesdata','id'));
		}
	}

	public function show($id){
		$loanstatusesdata['data']=LoanStatuses::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LoanStatuses']])->get();
		$loanstatusesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($loanstatusesdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('loanstatusesdata'));
		}else{
		return view('admin.loan_statuses.show',compact('loanstatusesdata','id'));
		}
	}

	public function update(Request $request,$id){
		$loanstatuses=LoanStatuses::find($id);
		$loanstatuses->code=$request->get('code');
		$loanstatuses->name=$request->get('name');
		$loanstatuses->description=$request->get('description');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LoanStatuses']])->get();
		$loanstatusesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($loanstatusesdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('loanstatusesdata'));
		}else{
		$loanstatuses->save();
		$loanstatusesdata['data']=LoanStatuses::find($id);
		return view('admin.loan_statuses.edit',compact('loanstatusesdata','id'));
		}
	}

	public function destroy($id){
		$loanstatuses=LoanStatuses::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LoanStatuses']])->get();
		$loanstatusesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($loanstatusesdata['usersaccountsroles'][0]['_delete']==1){
			$loanstatuses->delete();
		}return redirect('admin/loanstatuses')->with('success','loan statuses has been deleted!');
	}
}