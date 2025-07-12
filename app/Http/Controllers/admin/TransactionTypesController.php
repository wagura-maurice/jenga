<?php
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\TransactionTypes;
use App\Companies;
use App\Modules;
use App\Users;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;
class TransactionTypesController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$transactiontypesdata['list']=TransactionTypes::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','TransactionTypes']])->get();
		$transactiontypesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($transactiontypesdata['usersaccountsroles'][0]['_add']==0&&$transactiontypesdata['usersaccountsroles'][0]['_list']==0&&$transactiontypesdata['usersaccountsroles'][0]['_edit']==0&&$transactiontypesdata['usersaccountsroles'][0]['_edit']==0&&$transactiontypesdata['usersaccountsroles'][0]['_show']==0&&$transactiontypesdata['usersaccountsroles'][0]['_delete']==0&&$transactiontypesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('transactiontypesdata'));
		}else{
			return view('admin.transaction_types.index',compact('transactiontypesdata'));
		}
	}

	public function create(){
		$transactiontypesdata;
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','TransactionTypes']])->get();
		$transactiontypesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($transactiontypesdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('transactiontypesdata'));
		}else{
			return view('admin.transaction_types.create',compact('transactiontypesdata'));
		}
	}

	public function filter(Request $request){
		$transactiontypesdata['list']=TransactionTypes::where([['code','LIKE','%'.$request->get('code').'%'],['name','LIKE','%'.$request->get('name').'%'],])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','TransactionTypes']])->get();
		$transactiontypesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($transactiontypesdata['usersaccountsroles'][0]['_add']==0&&$transactiontypesdata['usersaccountsroles'][0]['_list']==0&&$transactiontypesdata['usersaccountsroles'][0]['_edit']==0&&$transactiontypesdata['usersaccountsroles'][0]['_edit']==0&&$transactiontypesdata['usersaccountsroles'][0]['_show']==0&&$transactiontypesdata['usersaccountsroles'][0]['_delete']==0&&$transactiontypesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('transactiontypesdata'));
		}else{
			return view('admin.transaction_types.index',compact('transactiontypesdata'));
		}
	}

	public function report(){
		$transactiontypesdata['company']=Companies::all();
		$transactiontypesdata['list']=TransactionTypes::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','TransactionTypes']])->get();
		$transactiontypesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($transactiontypesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('transactiontypesdata'));
		}else{
			return view('admin.transaction_types.report',compact('transactiontypesdata'));
		}
	}

	public function chart(){
		return view('admin.transaction_types.chart');
	}

	public function store(Request $request){
		$transactiontypes=new TransactionTypes();
		$transactiontypes->code=$request->get('code');
		$transactiontypes->name=$request->get('name');
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','TransactionTypes']])->get();
		$transactiontypesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($transactiontypesdata['usersaccountsroles'][0]['_show']==1){
			try{
				if($transactiontypes->save()){
					$response['status']='1';
					$response['message']='transaction types Added successfully';
					return json_encode($response);
			}else{
					$response['status']='0';
					$response['message']='Failed to add transaction types. Please try again';
					return json_encode($response);
				}
			}
			catch(Exception $e){
					$response['status']='0';
					$response['message']='An Error occured while attempting to add transaction types. Please try again';
					return json_encode($response);
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$transactiontypesdata['data']=TransactionTypes::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','TransactionTypes']])->get();
		$transactiontypesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($transactiontypesdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('transactiontypesdata'));
		}else{
		return view('admin.transaction_types.edit',compact('transactiontypesdata','id'));
		}
	}

	public function show($id){
		$transactiontypesdata['data']=TransactionTypes::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','TransactionTypes']])->get();
		$transactiontypesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($transactiontypesdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('transactiontypesdata'));
		}else{
		return view('admin.transaction_types.show',compact('transactiontypesdata','id'));
		}
	}

	public function update(Request $request,$id){
		$transactiontypes=TransactionTypes::find($id);
		$transactiontypes->code=$request->get('code');
		$transactiontypes->name=$request->get('name');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','TransactionTypes']])->get();
		$transactiontypesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($transactiontypesdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('transactiontypesdata'));
		}else{
		$transactiontypes->save();
		$transactiontypesdata['data']=TransactionTypes::find($id);
		return view('admin.transaction_types.edit',compact('transactiontypesdata','id'));
		}
	}

	public function destroy($id){
		$transactiontypes=TransactionTypes::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','TransactionTypes']])->get();
		$transactiontypesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($transactiontypesdata['usersaccountsroles'][0]['_delete']==1){
			$transactiontypes->delete();
		}return redirect('admin/transactiontypes')->with('success','transaction types has been deleted!');
	}
}