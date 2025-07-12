<?php
/**
* @author  Wanjala Innocent Khaemba
*Controller - (mobile money gateways)
*/
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\MobileMoneyGateways;
use App\Companies;
use App\Modules;
use App\Users;
use App\Accounts;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;
class MobileMoneyGatewaysController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$mobilemoneygatewaysdata['accounts']=Accounts::all();
		$mobilemoneygatewaysdata['list']=MobileMoneyGateways::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','MobileMoneyGateways']])->get();
		$mobilemoneygatewaysdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($mobilemoneygatewaysdata['usersaccountsroles'][0]) && $mobilemoneygatewaysdata['usersaccountsroles'][0]['_add']==0&&$mobilemoneygatewaysdata['usersaccountsroles'][0]['_list']==0&&$mobilemoneygatewaysdata['usersaccountsroles'][0]['_edit']==0&&$mobilemoneygatewaysdata['usersaccountsroles'][0]['_edit']==0&&$mobilemoneygatewaysdata['usersaccountsroles'][0]['_show']==0&&$mobilemoneygatewaysdata['usersaccountsroles'][0]['_delete']==0&&$mobilemoneygatewaysdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('mobilemoneygatewaysdata'));
		}else{
			return view('admin.mobile_money_gateways.index',compact('mobilemoneygatewaysdata'));
		}
	}

	public function create(){
		$mobilemoneygatewaysdata;
		$mobilemoneygatewaysdata['accounts']=Accounts::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','MobileMoneyGateways']])->get();
		$mobilemoneygatewaysdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($mobilemoneygatewaysdata['usersaccountsroles'][0]) && $mobilemoneygatewaysdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('mobilemoneygatewaysdata'));
		}else{
			return view('admin.mobile_money_gateways.create',compact('mobilemoneygatewaysdata'));
		}
	}

	public function filter(Request $request){
		$mobilemoneygatewaysdata['accounts']=Accounts::all();
		$mobilemoneygatewaysdata['list']=MobileMoneyGateways::where([['name','LIKE','%'.$request->get('name').'%'],['short_code','LIKE','%'.$request->get('short_code').'%'],['settlement_account','LIKE','%'.$request->get('settlement_account').'%'],['queue_time_out_url','LIKE','%'.$request->get('queue_time_out_url').'%'],['result_url','LIKE','%'.$request->get('result_url').'%'],['call_back_url','LIKE','%'.$request->get('call_back_url').'%'],['pass_key','LIKE','%'.$request->get('pass_key').'%'],])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','MobileMoneyGateways']])->get();
		$mobilemoneygatewaysdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($mobilemoneygatewaysdata['usersaccountsroles'][0]) && $mobilemoneygatewaysdata['usersaccountsroles'][0]['_add']==0&&$mobilemoneygatewaysdata['usersaccountsroles'][0]['_list']==0&&$mobilemoneygatewaysdata['usersaccountsroles'][0]['_edit']==0&&$mobilemoneygatewaysdata['usersaccountsroles'][0]['_edit']==0&&$mobilemoneygatewaysdata['usersaccountsroles'][0]['_show']==0&&$mobilemoneygatewaysdata['usersaccountsroles'][0]['_delete']==0&&$mobilemoneygatewaysdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('mobilemoneygatewaysdata'));
		}else{
			return view('admin.mobile_money_gateways.index',compact('mobilemoneygatewaysdata'));
		}
	}

	public function report(){
		$mobilemoneygatewaysdata['company']=Companies::all();
		$mobilemoneygatewaysdata['list']=MobileMoneyGateways::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','MobileMoneyGateways']])->get();
		$mobilemoneygatewaysdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($mobilemoneygatewaysdata['usersaccountsroles'][0]) && $mobilemoneygatewaysdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('mobilemoneygatewaysdata'));
		}else{
			return view('admin.mobile_money_gateways.report',compact('mobilemoneygatewaysdata'));
		}
	}

	public function chart(){
		return view('admin.mobile_money_gateways.chart');
	}

	public function store(Request $request){
		$mobilemoneygateways=new MobileMoneyGateways();
		$mobilemoneygateways->name=$request->get('name');
		$mobilemoneygateways->short_code=$request->get('short_code');
		$mobilemoneygateways->settlement_account=$request->get('settlement_account');
		$mobilemoneygateways->queue_time_out_url=$request->get('queue_time_out_url');
		$mobilemoneygateways->result_url=$request->get('result_url');
		$mobilemoneygateways->call_back_url=$request->get('call_back_url');
		$mobilemoneygateways->pass_key=$request->get('pass_key');
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','MobileMoneyGateways']])->get();
		$mobilemoneygatewaysdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($mobilemoneygatewaysdata['usersaccountsroles'][0]) && $mobilemoneygatewaysdata['usersaccountsroles'][0]['_show']==1){
			try{
				if($mobilemoneygateways->save()){
					$response['status']='1';
					$response['message']='mobile money gateways Added successfully';
					return json_encode($response);
			}else{
					$response['status']='0';
					$response['message']='Failed to add mobile money gateways. Please try again';
					return json_encode($response);
				}
			}
			catch(Exception $e){
					$response['status']='0';
					$response['message']='An Error occured while attempting to add mobile money gateways. Please try again';
					return json_encode($response);
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$mobilemoneygatewaysdata['accounts']=Accounts::all();
		$mobilemoneygatewaysdata['data']=MobileMoneyGateways::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','MobileMoneyGateways']])->get();
		$mobilemoneygatewaysdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($mobilemoneygatewaysdata['usersaccountsroles'][0]) && $mobilemoneygatewaysdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('mobilemoneygatewaysdata'));
		}else{
		return view('admin.mobile_money_gateways.edit',compact('mobilemoneygatewaysdata','id'));
		}
	}

	public function show($id){
		$mobilemoneygatewaysdata['accounts']=Accounts::all();
		$mobilemoneygatewaysdata['data']=MobileMoneyGateways::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','MobileMoneyGateways']])->get();
		$mobilemoneygatewaysdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($mobilemoneygatewaysdata['usersaccountsroles'][0]) && $mobilemoneygatewaysdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('mobilemoneygatewaysdata'));
		}else{
		return view('admin.mobile_money_gateways.show',compact('mobilemoneygatewaysdata','id'));
		}
	}

	public function update(Request $request,$id){
		$mobilemoneygateways=MobileMoneyGateways::find($id);
		$mobilemoneygatewaysdata['accounts']=Accounts::all();
		$mobilemoneygateways->name=$request->get('name');
		$mobilemoneygateways->short_code=$request->get('short_code');
		$mobilemoneygateways->settlement_account=$request->get('settlement_account');
		$mobilemoneygateways->queue_time_out_url=$request->get('queue_time_out_url');
		$mobilemoneygateways->result_url=$request->get('result_url');
		$mobilemoneygateways->call_back_url=$request->get('call_back_url');
		$mobilemoneygateways->pass_key=$request->get('pass_key');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','MobileMoneyGateways']])->get();
		$mobilemoneygatewaysdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($mobilemoneygatewaysdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('mobilemoneygatewaysdata'));
		}else{
		$mobilemoneygateways->save();
		$mobilemoneygatewaysdata['data']=MobileMoneyGateways::find($id);
		return view('admin.mobile_money_gateways.edit',compact('mobilemoneygatewaysdata','id'));
		}
	}

	public function destroy($id){
		$mobilemoneygateways=MobileMoneyGateways::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','MobileMoneyGateways']])->get();
		$mobilemoneygatewaysdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($mobilemoneygatewaysdata['usersaccountsroles'][0]) && $mobilemoneygatewaysdata['usersaccountsroles'][0]['_delete']==1){
			$mobilemoneygateways->delete();
		}return redirect('admin/mobilemoneygateways')->with('success','mobile money gateways has been deleted!');
	}
}