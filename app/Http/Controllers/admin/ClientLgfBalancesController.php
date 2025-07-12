<?php
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\ClientLgfBalances;
use App\Companies;
use App\Modules;
use App\Users;
use App\Clients;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;
class ClientLgfBalancesController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){

		$clientlgfbalancesdata['clients']=Clients::all();
		$clientlgfbalancesdata['list']=ClientLgfBalances::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ClientLgfBalances']])->get();
		$clientlgfbalancesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($clientlgfbalancesdata['usersaccountsroles'][0]['_add']==0&&$clientlgfbalancesdata['usersaccountsroles'][0]['_list']==0&&$clientlgfbalancesdata['usersaccountsroles'][0]['_edit']==0&&$clientlgfbalancesdata['usersaccountsroles'][0]['_edit']==0&&$clientlgfbalancesdata['usersaccountsroles'][0]['_show']==0&&$clientlgfbalancesdata['usersaccountsroles'][0]['_delete']==0&&$clientlgfbalancesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('clientlgfbalancesdata'));
		}else{
			return view('admin.client_lgf_balances.index',compact('clientlgfbalancesdata'));
		}
	}

	public function create(){
		$clientlgfbalancesdata;
		
		$clientlgfbalancesdata['clients']=Clients::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ClientLgfBalances']])->get();
		$clientlgfbalancesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($clientlgfbalancesdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('clientlgfbalancesdata'));
		}else{
			return view('admin.client_lgf_balances.create',compact('clientlgfbalancesdata'));
		}
	}

	public function filter(Request $request){
		$clientlgfbalancesdata['clients']=Clients::all();
		$clientlgfbalancesdata['list']=ClientLgfBalances::where([['client','LIKE','%'.$request->get('client').'%'],['balance','LIKE','%'.$request->get('balance').'%'],])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ClientLgfBalances']])->get();
		$clientlgfbalancesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($clientlgfbalancesdata['usersaccountsroles'][0]['_add']==0&&$clientlgfbalancesdata['usersaccountsroles'][0]['_list']==0&&$clientlgfbalancesdata['usersaccountsroles'][0]['_edit']==0&&$clientlgfbalancesdata['usersaccountsroles'][0]['_edit']==0&&$clientlgfbalancesdata['usersaccountsroles'][0]['_show']==0&&$clientlgfbalancesdata['usersaccountsroles'][0]['_delete']==0&&$clientlgfbalancesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('clientlgfbalancesdata'));
		}else{
			return view('admin.client_lgf_balances.index',compact('clientlgfbalancesdata'));
		}
	}

	public function report(){
		$clientlgfbalancesdata['company']=Companies::all();
		$clientlgfbalancesdata['list']=ClientLgfBalances::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ClientLgfBalances']])->get();
		$clientlgfbalancesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($clientlgfbalancesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('clientlgfbalancesdata'));
		}else{
			return view('admin.client_lgf_balances.report',compact('clientlgfbalancesdata'));
		}
	}

	public function chart(){
		return view('admin.client_lgf_balances.chart');
	}

	public function getclientlgfbalance($id){
		return ClientLgfBalances::where([["client","=",$id]])->get()->first();
	}

	public function store(Request $request){
		$clientlgfbalances=new ClientLgfBalances();
		$clientlgfbalances->client=$request->get('client');
		$clientlgfbalances->balance=$request->get('balance');
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ClientLgfBalances']])->get();
		$clientlgfbalancesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($clientlgfbalancesdata['usersaccountsroles'][0]['_show']==1){
			try{
				if($clientlgfbalances->save()){
					$response['status']='1';
					$response['message']='client lgf balances Added successfully';
					return json_encode($response);
			}else{
					$response['status']='0';
					$response['message']='Failed to add client lgf balances. Please try again';
					return json_encode($response);
				}
			}
			catch(Exception $e){
					$response['status']='0';
					$response['message']='An Error occured while attempting to add client lgf balances. Please try again';
					return json_encode($response);
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$clientlgfbalancesdata['clients']=Clients::all();
		$clientlgfbalancesdata['data']=ClientLgfBalances::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ClientLgfBalances']])->get();
		$clientlgfbalancesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($clientlgfbalancesdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('clientlgfbalancesdata'));
		}else{
		return view('admin.client_lgf_balances.edit',compact('clientlgfbalancesdata','id'));
		}
	}

	public function show($id){
		$clientlgfbalancesdata['clients']=Clients::all();
		$clientlgfbalancesdata['data']=ClientLgfBalances::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ClientLgfBalances']])->get();
		$clientlgfbalancesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($clientlgfbalancesdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('clientlgfbalancesdata'));
		}else{
		return view('admin.client_lgf_balances.show',compact('clientlgfbalancesdata','id'));
		}
	}

	public function update(Request $request,$id){
		$clientlgfbalances=ClientLgfBalances::find($id);
		$clientlgfbalancesdata['clients']=Clients::all();
		$clientlgfbalances->client=$request->get('client');
		$clientlgfbalances->balance=$request->get('balance');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ClientLgfBalances']])->get();
		$clientlgfbalancesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($clientlgfbalancesdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('clientlgfbalancesdata'));
		}else{
		$clientlgfbalances->save();
		$clientlgfbalancesdata['data']=ClientLgfBalances::find($id);
		return view('admin.client_lgf_balances.edit',compact('clientlgfbalancesdata','id'));
		}
	}

	public function destroy($id){
		$clientlgfbalances=ClientLgfBalances::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ClientLgfBalances']])->get();
		$clientlgfbalancesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($clientlgfbalancesdata['usersaccountsroles'][0]['_delete']==1){
			$clientlgfbalances->delete();
		}return redirect('admin/clientlgfbalances')->with('success','client lgf balances has been deleted!');
	}
}