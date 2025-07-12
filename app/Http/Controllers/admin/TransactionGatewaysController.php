<?php
/**
* @author  Wanjala Innocent Khaemba
*Controller - (transaction gateways)
*/
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\TransactionGateways;
use App\Companies;
use App\Modules;
use App\Users;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;
class TransactionGatewaysController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$transactiongatewaysdata['list']=TransactionGateways::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','TransactionGateways']])->get();
		$transactiongatewaysdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($transactiongatewaysdata['usersaccountsroles'][0]) && $transactiongatewaysdata['usersaccountsroles'][0]['_add']==0&&$transactiongatewaysdata['usersaccountsroles'][0]['_list']==0&&$transactiongatewaysdata['usersaccountsroles'][0]['_edit']==0&&$transactiongatewaysdata['usersaccountsroles'][0]['_edit']==0&&$transactiongatewaysdata['usersaccountsroles'][0]['_show']==0&&$transactiongatewaysdata['usersaccountsroles'][0]['_delete']==0&&$transactiongatewaysdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('transactiongatewaysdata'));
		}else{
			return view('admin.transaction_gateways.index',compact('transactiongatewaysdata'));
		}
	}

	public function create(){
		$transactiongatewaysdata;
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','TransactionGateways']])->get();
		$transactiongatewaysdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($transactiongatewaysdata['usersaccountsroles'][0]) && $transactiongatewaysdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('transactiongatewaysdata'));
		}else{
			return view('admin.transaction_gateways.create',compact('transactiongatewaysdata'));
		}
	}

	public function filter(Request $request){
		$transactiongatewaysdata['list']=TransactionGateways::where([['name','LIKE','%'.$request->get('name').'%'],['short_code','LIKE','%'.$request->get('short_code').'%'],['pass_key','LIKE','%'.$request->get('pass_key').'%'],['call_back_url','LIKE','%'.$request->get('call_back_url').'%'],['queue_time_out_url','LIKE','%'.$request->get('queue_time_out_url').'%'],['result_url','LIKE','%'.$request->get('result_url').'%'],])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','TransactionGateways']])->get();
		$transactiongatewaysdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($transactiongatewaysdata['usersaccountsroles'][0]) && $transactiongatewaysdata['usersaccountsroles'][0]['_add']==0&&$transactiongatewaysdata['usersaccountsroles'][0]['_list']==0&&$transactiongatewaysdata['usersaccountsroles'][0]['_edit']==0&&$transactiongatewaysdata['usersaccountsroles'][0]['_edit']==0&&$transactiongatewaysdata['usersaccountsroles'][0]['_show']==0&&$transactiongatewaysdata['usersaccountsroles'][0]['_delete']==0&&$transactiongatewaysdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('transactiongatewaysdata'));
		}else{
			return view('admin.transaction_gateways.index',compact('transactiongatewaysdata'));
		}
	}

	public function report(){
		$transactiongatewaysdata['company']=Companies::all();
		$transactiongatewaysdata['list']=TransactionGateways::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','TransactionGateways']])->get();
		$transactiongatewaysdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($transactiongatewaysdata['usersaccountsroles'][0]) && $transactiongatewaysdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('transactiongatewaysdata'));
		}else{
			return view('admin.transaction_gateways.report',compact('transactiongatewaysdata'));
		}
	}

	public function chart(){
		return view('admin.transaction_gateways.chart');
	}

	public function store(Request $request){
		$transactiongateways=new TransactionGateways();
		$transactiongateways->name=$request->get('name');
		$transactiongateways->short_code=$request->get('short_code');
		$transactiongateways->pass_key=$request->get('pass_key');
		$transactiongateways->call_back_url=$request->get('call_back_url');
		$transactiongateways->queue_time_out_url=$request->get('queue_time_out_url');
		$transactiongateways->result_url=$request->get('result_url');
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','TransactionGateways']])->get();
		$transactiongatewaysdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($transactiongatewaysdata['usersaccountsroles'][0]) && $transactiongatewaysdata['usersaccountsroles'][0]['_show']==1){
			try{
				if($transactiongateways->save()){
					$response['status']='1';
					$response['message']='transaction gateways Added successfully';
					return json_encode($response);
			}else{
					$response['status']='0';
					$response['message']='Failed to add transaction gateways. Please try again';
					return json_encode($response);
				}
			}
			catch(Exception $e){
					$response['status']='0';
					$response['message']='An Error occured while attempting to add transaction gateways. Please try again';
					return json_encode($response);
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$transactiongatewaysdata['data']=TransactionGateways::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','TransactionGateways']])->get();
		$transactiongatewaysdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($transactiongatewaysdata['usersaccountsroles'][0]) && $transactiongatewaysdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('transactiongatewaysdata'));
		}else{
		return view('admin.transaction_gateways.edit',compact('transactiongatewaysdata','id'));
		}
	}

	public function show($id){
		$transactiongatewaysdata['data']=TransactionGateways::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','TransactionGateways']])->get();
		$transactiongatewaysdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($transactiongatewaysdata['usersaccountsroles'][0]) && $transactiongatewaysdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('transactiongatewaysdata'));
		}else{
		return view('admin.transaction_gateways.show',compact('transactiongatewaysdata','id'));
		}
	}

	public function update(Request $request,$id){
		$transactiongateways=TransactionGateways::find($id);
		$transactiongateways->name=$request->get('name');
		$transactiongateways->short_code=$request->get('short_code');
		$transactiongateways->pass_key=$request->get('pass_key');
		$transactiongateways->call_back_url=$request->get('call_back_url');
		$transactiongateways->queue_time_out_url=$request->get('queue_time_out_url');
		$transactiongateways->result_url=$request->get('result_url');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','TransactionGateways']])->get();
		$transactiongatewaysdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($transactiongatewaysdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('transactiongatewaysdata'));
		}else{
		$transactiongateways->save();
		$transactiongatewaysdata['data']=TransactionGateways::find($id);
		return view('admin.transaction_gateways.edit',compact('transactiongatewaysdata','id'));
		}
	}

	public function destroy($id){
		$transactiongateways=TransactionGateways::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','TransactionGateways']])->get();
		$transactiongatewaysdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($transactiongatewaysdata['usersaccountsroles'][0]) && $transactiongatewaysdata['usersaccountsroles'][0]['_delete']==1){
			$transactiongateways->delete();
		}return redirect('admin/transactiongateways')->with('success','transaction gateways has been deleted!');
	}
}