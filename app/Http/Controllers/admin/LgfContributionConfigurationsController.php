<?php
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\LgfContributionConfigurations;
use App\Companies;
use App\Modules;
use App\Users;
use App\ClientTypes;
use App\PaymentModes;
use App\Accounts;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;
class LgfContributionConfigurationsController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$lgfcontributionconfigurationsdata['clienttypes']=ClientTypes::all();
		$lgfcontributionconfigurationsdata['paymentmodes']=PaymentModes::all();
		$lgfcontributionconfigurationsdata['accounts']=Accounts::all();
		$lgfcontributionconfigurationsdata['accounts']=Accounts::all();
		$lgfcontributionconfigurationsdata['list']=LgfContributionConfigurations::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LgfContributionConfigurations']])->get();
		$lgfcontributionconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($lgfcontributionconfigurationsdata['usersaccountsroles'][0]['_add']==0&&$lgfcontributionconfigurationsdata['usersaccountsroles'][0]['_list']==0&&$lgfcontributionconfigurationsdata['usersaccountsroles'][0]['_edit']==0&&$lgfcontributionconfigurationsdata['usersaccountsroles'][0]['_edit']==0&&$lgfcontributionconfigurationsdata['usersaccountsroles'][0]['_show']==0&&$lgfcontributionconfigurationsdata['usersaccountsroles'][0]['_delete']==0&&$lgfcontributionconfigurationsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('lgfcontributionconfigurationsdata'));
		}else{
			return view('admin.lgf_contribution_configurations.index',compact('lgfcontributionconfigurationsdata'));
		}
	}

	public function create(){
		$lgfcontributionconfigurationsdata;
		$lgfcontributionconfigurationsdata['clienttypes']=ClientTypes::all();
		$lgfcontributionconfigurationsdata['paymentmodes']=PaymentModes::all();
		$lgfcontributionconfigurationsdata['accounts']=Accounts::all();
		$lgfcontributionconfigurationsdata['accounts']=Accounts::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LgfContributionConfigurations']])->get();
		$lgfcontributionconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($lgfcontributionconfigurationsdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('lgfcontributionconfigurationsdata'));
		}else{
			return view('admin.lgf_contribution_configurations.create',compact('lgfcontributionconfigurationsdata'));
		}
	}

	public function filter(Request $request){
		$lgfcontributionconfigurationsdata['clienttypes']=ClientTypes::all();
		$lgfcontributionconfigurationsdata['paymentmodes']=PaymentModes::all();
		$lgfcontributionconfigurationsdata['accounts']=Accounts::all();
		$lgfcontributionconfigurationsdata['accounts']=Accounts::all();
		$lgfcontributionconfigurationsdata['list']=LgfContributionConfigurations::where([['client_type','LIKE','%'.$request->get('client_type').'%'],['payment_mode','LIKE','%'.$request->get('payment_mode').'%'],['debit_account','LIKE','%'.$request->get('debit_account').'%'],['credit_account','LIKE','%'.$request->get('credit_account').'%'],])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LgfContributionConfigurations']])->get();
		$lgfcontributionconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($lgfcontributionconfigurationsdata['usersaccountsroles'][0]['_add']==0&&$lgfcontributionconfigurationsdata['usersaccountsroles'][0]['_list']==0&&$lgfcontributionconfigurationsdata['usersaccountsroles'][0]['_edit']==0&&$lgfcontributionconfigurationsdata['usersaccountsroles'][0]['_edit']==0&&$lgfcontributionconfigurationsdata['usersaccountsroles'][0]['_show']==0&&$lgfcontributionconfigurationsdata['usersaccountsroles'][0]['_delete']==0&&$lgfcontributionconfigurationsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('lgfcontributionconfigurationsdata'));
		}else{
			return view('admin.lgf_contribution_configurations.index',compact('lgfcontributionconfigurationsdata'));
		}
	}

	public function report(){
		$lgfcontributionconfigurationsdata['company']=Companies::all();
		$lgfcontributionconfigurationsdata['list']=LgfContributionConfigurations::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LgfContributionConfigurations']])->get();
		$lgfcontributionconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($lgfcontributionconfigurationsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('lgfcontributionconfigurationsdata'));
		}else{
			return view('admin.lgf_contribution_configurations.report',compact('lgfcontributionconfigurationsdata'));
		}
	}

	public function chart(){
		return view('admin.lgf_contribution_configurations.chart');
	}

	public function store(Request $request){
		$lgfcontributionconfigurations=new LgfContributionConfigurations();
		$lgfcontributionconfigurations->client_type=$request->get('client_type');
		$lgfcontributionconfigurations->payment_mode=$request->get('payment_mode');
		$lgfcontributionconfigurations->debit_account=$request->get('debit_account');
		$lgfcontributionconfigurations->credit_account=$request->get('credit_account');
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LgfContributionConfigurations']])->get();
		$lgfcontributionconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($lgfcontributionconfigurationsdata['usersaccountsroles'][0]['_show']==1){
			try{
				if($lgfcontributionconfigurations->save()){
					$response['status']='1';
					$response['message']='lgf contribution configurations Added successfully';
					return json_encode($response);
			}else{
					$response['status']='0';
					$response['message']='Failed to add lgf contribution configurations. Please try again';
					return json_encode($response);
				}
			}
			catch(Exception $e){
					$response['status']='0';
					$response['message']='An Error occured while attempting to add lgf contribution configurations. Please try again';
					return json_encode($response);
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$lgfcontributionconfigurationsdata['clienttypes']=ClientTypes::all();
		$lgfcontributionconfigurationsdata['paymentmodes']=PaymentModes::all();
		$lgfcontributionconfigurationsdata['accounts']=Accounts::all();
		$lgfcontributionconfigurationsdata['accounts']=Accounts::all();
		$lgfcontributionconfigurationsdata['data']=LgfContributionConfigurations::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LgfContributionConfigurations']])->get();
		$lgfcontributionconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($lgfcontributionconfigurationsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('lgfcontributionconfigurationsdata'));
		}else{
		return view('admin.lgf_contribution_configurations.edit',compact('lgfcontributionconfigurationsdata','id'));
		}
	}

	public function show($id){
		$lgfcontributionconfigurationsdata['clienttypes']=ClientTypes::all();
		$lgfcontributionconfigurationsdata['paymentmodes']=PaymentModes::all();
		$lgfcontributionconfigurationsdata['accounts']=Accounts::all();
		$lgfcontributionconfigurationsdata['accounts']=Accounts::all();
		$lgfcontributionconfigurationsdata['data']=LgfContributionConfigurations::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LgfContributionConfigurations']])->get();
		$lgfcontributionconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($lgfcontributionconfigurationsdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('lgfcontributionconfigurationsdata'));
		}else{
		return view('admin.lgf_contribution_configurations.show',compact('lgfcontributionconfigurationsdata','id'));
		}
	}

	public function update(Request $request,$id){
		$lgfcontributionconfigurationsdata['clienttypes']=ClientTypes::all();
		$lgfcontributionconfigurationsdata['paymentmodes']=PaymentModes::all();
		$lgfcontributionconfigurationsdata['accounts']=Accounts::all();
		$lgfcontributionconfigurationsdata['accounts']=Accounts::all();		
		$lgfcontributionconfigurations=LgfContributionConfigurations::find($id);
		$lgfcontributionconfigurations->client_type=$request->get('client_type');
		$lgfcontributionconfigurations->payment_mode=$request->get('payment_mode');
		$lgfcontributionconfigurations->debit_account=$request->get('debit_account');
		$lgfcontributionconfigurations->credit_account=$request->get('credit_account');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LgfContributionConfigurations']])->get();
		$lgfcontributionconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($lgfcontributionconfigurationsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('lgfcontributionconfigurationsdata'));
		}else{
		$lgfcontributionconfigurations->save();
		$lgfcontributionconfigurationsdata['data']=LgfContributionConfigurations::find($id);
		return view('admin.lgf_contribution_configurations.edit',compact('lgfcontributionconfigurationsdata','id'));
		}
	}

	public function destroy($id){
		$lgfcontributionconfigurations=LgfContributionConfigurations::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LgfContributionConfigurations']])->get();
		$lgfcontributionconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($lgfcontributionconfigurationsdata['usersaccountsroles'][0]['_delete']==1){
			$lgfcontributionconfigurations->delete();
		}return redirect('admin/lgfcontributionconfigurations')->with('success','lgf contribution configurations has been deleted!');
	}
}