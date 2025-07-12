<?php
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\TransactionStatuses;
use App\Companies;
use App\Modules;
use App\Users;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;
class TransactionStatusesController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$transactionstatusesdata['list']=TransactionStatuses::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','TransactionStatuses']])->get();
		$transactionstatusesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($transactionstatusesdata['usersaccountsroles'][0]['_add']==0&&$transactionstatusesdata['usersaccountsroles'][0]['_list']==0&&$transactionstatusesdata['usersaccountsroles'][0]['_edit']==0&&$transactionstatusesdata['usersaccountsroles'][0]['_edit']==0&&$transactionstatusesdata['usersaccountsroles'][0]['_show']==0&&$transactionstatusesdata['usersaccountsroles'][0]['_delete']==0&&$transactionstatusesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('transactionstatusesdata'));
		}else{
			return view('admin.transaction_statuses.index',compact('transactionstatusesdata'));
		}
	}

	public function create(){
		$transactionstatusesdata;
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','TransactionStatuses']])->get();
		$transactionstatusesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($transactionstatusesdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('transactionstatusesdata'));
		}else{
			return view('admin.transaction_statuses.create',compact('transactionstatusesdata'));
		}
	}

	public function filter(Request $request){
		$transactionstatusesdata['list']=TransactionStatuses::where([['code','LIKE','%'.$request->get('code').'%'],['name','LIKE','%'.$request->get('name').'%'],['description','LIKE','%'.$request->get('description').'%'],])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','TransactionStatuses']])->get();
		$transactionstatusesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($transactionstatusesdata['usersaccountsroles'][0]['_add']==0&&$transactionstatusesdata['usersaccountsroles'][0]['_list']==0&&$transactionstatusesdata['usersaccountsroles'][0]['_edit']==0&&$transactionstatusesdata['usersaccountsroles'][0]['_edit']==0&&$transactionstatusesdata['usersaccountsroles'][0]['_show']==0&&$transactionstatusesdata['usersaccountsroles'][0]['_delete']==0&&$transactionstatusesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('transactionstatusesdata'));
		}else{
			return view('admin.transaction_statuses.index',compact('transactionstatusesdata'));
		}
	}

	public function report(){
		$transactionstatusesdata['company']=Companies::all();
		$transactionstatusesdata['list']=TransactionStatuses::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','TransactionStatuses']])->get();
		$transactionstatusesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($transactionstatusesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('transactionstatusesdata'));
		}else{
			return view('admin.transaction_statuses.report',compact('transactionstatusesdata'));
		}
	}

	public function chart(){
		return view('admin.transaction_statuses.chart');
	}

	public function store(Request $request){
		$transactionstatuses=new TransactionStatuses();
		$transactionstatuses->code=$request->get('code');
		$transactionstatuses->name=$request->get('name');
		$transactionstatuses->description=$request->get('description');
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','TransactionStatuses']])->get();
		$transactionstatusesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($transactionstatusesdata['usersaccountsroles'][0]['_show']==1){
			try{
				if($transactionstatuses->save()){
					$response['status']='1';
					$response['message']='transaction statuses Added successfully';
					return json_encode($response);
			}else{
					$response['status']='0';
					$response['message']='Failed to add transaction statuses. Please try again';
					return json_encode($response);
				}
			}
			catch(Exception $e){
					$response['status']='0';
					$response['message']='An Error occured while attempting to add transaction statuses. Please try again';
					return json_encode($response);
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$transactionstatusesdata['data']=TransactionStatuses::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','TransactionStatuses']])->get();
		$transactionstatusesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($transactionstatusesdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('transactionstatusesdata'));
		}else{
		return view('admin.transaction_statuses.edit',compact('transactionstatusesdata','id'));
		}
	}

	public function show($id){
		$transactionstatusesdata['data']=TransactionStatuses::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','TransactionStatuses']])->get();
		$transactionstatusesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($transactionstatusesdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('transactionstatusesdata'));
		}else{
		return view('admin.transaction_statuses.show',compact('transactionstatusesdata','id'));
		}
	}

	public function update(Request $request,$id){
		$transactionstatuses=TransactionStatuses::find($id);
		$transactionstatuses->code=$request->get('code');
		$transactionstatuses->name=$request->get('name');
		$transactionstatuses->description=$request->get('description');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','TransactionStatuses']])->get();
		$transactionstatusesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($transactionstatusesdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('transactionstatusesdata'));
		}else{
		$transactionstatuses->save();
		$transactionstatusesdata['data']=TransactionStatuses::find($id);
		return view('admin.transaction_statuses.edit',compact('transactionstatusesdata','id'));
		}
	}

	public function destroy($id){
		$transactionstatuses=TransactionStatuses::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','TransactionStatuses']])->get();
		$transactionstatusesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($transactionstatusesdata['usersaccountsroles'][0]['_delete']==1){
			$transactionstatuses->delete();
		}return redirect('admin/transactionstatuses')->with('success','transaction statuses has been deleted!');
	}
}