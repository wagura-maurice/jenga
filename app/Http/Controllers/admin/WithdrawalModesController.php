<?php
/**
* @author  Wanjala Innocent Khaemba
*Controller - (withdrawal modes)
*/
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\WithdrawalModes;
use App\Companies;
use App\Modules;
use App\Users;
use App\TransactionGateways;
use App\Accounts;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;
class WithdrawalModesController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$withdrawalmodesdata['transactiongateways']=TransactionGateways::all();
		$withdrawalmodesdata['accounts']=Accounts::all();
		$withdrawalmodesdata['list']=WithdrawalModes::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','WithdrawalModes']])->get();
		$withdrawalmodesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($withdrawalmodesdata['usersaccountsroles'][0]) && $withdrawalmodesdata['usersaccountsroles'][0]['_add']==0&&$withdrawalmodesdata['usersaccountsroles'][0]['_list']==0&&$withdrawalmodesdata['usersaccountsroles'][0]['_edit']==0&&$withdrawalmodesdata['usersaccountsroles'][0]['_edit']==0&&$withdrawalmodesdata['usersaccountsroles'][0]['_show']==0&&$withdrawalmodesdata['usersaccountsroles'][0]['_delete']==0&&$withdrawalmodesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('withdrawalmodesdata'));
		}else{
			return view('admin.withdrawal_modes.index',compact('withdrawalmodesdata'));
		}
	}

	public function create(){
		$withdrawalmodesdata;
		$withdrawalmodesdata['transactiongateways']=TransactionGateways::all();
		$withdrawalmodesdata['accounts']=Accounts::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','WithdrawalModes']])->get();
		$withdrawalmodesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($withdrawalmodesdata['usersaccountsroles'][0]) && $withdrawalmodesdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('withdrawalmodesdata'));
		}else{
			return view('admin.withdrawal_modes.create',compact('withdrawalmodesdata'));
		}
	}

	public function filter(Request $request){
		$withdrawalmodesdata['transactiongateways']=TransactionGateways::all();
		$withdrawalmodesdata['accounts']=Accounts::all();
		$withdrawalmodesdata['list']=WithdrawalModes::where([['code','LIKE','%'.$request->get('code').'%'],['name','LIKE','%'.$request->get('name').'%'],['transaction_gateway','LIKE','%'.$request->get('transaction_gateway').'%'],['settlement_account','LIKE','%'.$request->get('settlement_account').'%'],])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','WithdrawalModes']])->get();
		$withdrawalmodesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($withdrawalmodesdata['usersaccountsroles'][0]) && $withdrawalmodesdata['usersaccountsroles'][0]['_add']==0&&$withdrawalmodesdata['usersaccountsroles'][0]['_list']==0&&$withdrawalmodesdata['usersaccountsroles'][0]['_edit']==0&&$withdrawalmodesdata['usersaccountsroles'][0]['_edit']==0&&$withdrawalmodesdata['usersaccountsroles'][0]['_show']==0&&$withdrawalmodesdata['usersaccountsroles'][0]['_delete']==0&&$withdrawalmodesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('withdrawalmodesdata'));
		}else{
			return view('admin.withdrawal_modes.index',compact('withdrawalmodesdata'));
		}
	}

	public function report(){
		$withdrawalmodesdata['company']=Companies::all();
		$withdrawalmodesdata['list']=WithdrawalModes::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','WithdrawalModes']])->get();
		$withdrawalmodesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($withdrawalmodesdata['usersaccountsroles'][0]) && $withdrawalmodesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('withdrawalmodesdata'));
		}else{
			return view('admin.withdrawal_modes.report',compact('withdrawalmodesdata'));
		}
	}

	public function chart(){
		return view('admin.withdrawal_modes.chart');
	}

	public function store(Request $request){
		$withdrawalmodes=new WithdrawalModes();
		$withdrawalmodes->code=$request->get('code');
		$withdrawalmodes->name=$request->get('name');
		$withdrawalmodes->transaction_gateway=$request->get('transaction_gateway');
		$withdrawalmodes->settlement_account=$request->get('settlement_account');
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','WithdrawalModes']])->get();
		$withdrawalmodesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($withdrawalmodesdata['usersaccountsroles'][0]) && $withdrawalmodesdata['usersaccountsroles'][0]['_show']==1){
			try{
				if($withdrawalmodes->save()){
					$response['status']='1';
					$response['message']='withdrawal modes Added successfully';
					return json_encode($response);
			}else{
					$response['status']='0';
					$response['message']='Failed to add withdrawal modes. Please try again';
					return json_encode($response);
				}
			}
			catch(Exception $e){
					$response['status']='0';
					$response['message']='An Error occured while attempting to add withdrawal modes. Please try again';
					return json_encode($response);
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$withdrawalmodesdata['transactiongateways']=TransactionGateways::all();
		$withdrawalmodesdata['accounts']=Accounts::all();
		$withdrawalmodesdata['data']=WithdrawalModes::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','WithdrawalModes']])->get();
		$withdrawalmodesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($withdrawalmodesdata['usersaccountsroles'][0]) && $withdrawalmodesdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('withdrawalmodesdata'));
		}else{
		return view('admin.withdrawal_modes.edit',compact('withdrawalmodesdata','id'));
		}
	}

	public function show($id){
		$withdrawalmodesdata['transactiongateways']=TransactionGateways::all();
		$withdrawalmodesdata['accounts']=Accounts::all();
		$withdrawalmodesdata['data']=WithdrawalModes::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','WithdrawalModes']])->get();
		$withdrawalmodesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($withdrawalmodesdata['usersaccountsroles'][0]) && $withdrawalmodesdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('withdrawalmodesdata'));
		}else{
		return view('admin.withdrawal_modes.show',compact('withdrawalmodesdata','id'));
		}
	}

	public function update(Request $request,$id){
		$withdrawalmodes=WithdrawalModes::find($id);
		$withdrawalmodesdata['transactiongateways']=TransactionGateways::all();
		$withdrawalmodesdata['accounts']=Accounts::all();
		$withdrawalmodes->code=$request->get('code');
		$withdrawalmodes->name=$request->get('name');
		$withdrawalmodes->transaction_gateway=$request->get('transaction_gateway');
		$withdrawalmodes->settlement_account=$request->get('settlement_account');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','WithdrawalModes']])->get();
		$withdrawalmodesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($withdrawalmodesdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('withdrawalmodesdata'));
		}else{
		$withdrawalmodes->save();
		$withdrawalmodesdata['data']=WithdrawalModes::find($id);
		return view('admin.withdrawal_modes.edit',compact('withdrawalmodesdata','id'));
		}
	}

	public function destroy($id){
		$withdrawalmodes=WithdrawalModes::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','WithdrawalModes']])->get();
		$withdrawalmodesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($withdrawalmodesdata['usersaccountsroles'][0]) && $withdrawalmodesdata['usersaccountsroles'][0]['_delete']==1){
			$withdrawalmodes->delete();
		}return redirect('admin/withdrawalmodes')->with('success','withdrawal modes has been deleted!');
	}
}