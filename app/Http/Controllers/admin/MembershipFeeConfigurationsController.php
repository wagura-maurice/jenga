<?php
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\MembershipFeeConfigurations;
use App\Companies;
use App\Modules;
use App\Users;
use App\ClientTypes;
use App\PaymentModes;
use App\Accounts;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;
class MembershipFeeConfigurationsController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$membershipfeeconfigurationsdata['clienttypes']=ClientTypes::all();
		$membershipfeeconfigurationsdata['paymentmodes']=PaymentModes::all();
		$membershipfeeconfigurationsdata['accounts']=Accounts::all();
		$membershipfeeconfigurationsdata['accounts']=Accounts::all();
		$membershipfeeconfigurationsdata['list']=MembershipFeeConfigurations::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','MembershipFeeConfigurations']])->get();
		$membershipfeeconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($membershipfeeconfigurationsdata['usersaccountsroles'][0]['_add']==0&&$membershipfeeconfigurationsdata['usersaccountsroles'][0]['_list']==0&&$membershipfeeconfigurationsdata['usersaccountsroles'][0]['_edit']==0&&$membershipfeeconfigurationsdata['usersaccountsroles'][0]['_edit']==0&&$membershipfeeconfigurationsdata['usersaccountsroles'][0]['_show']==0&&$membershipfeeconfigurationsdata['usersaccountsroles'][0]['_delete']==0&&$membershipfeeconfigurationsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('membershipfeeconfigurationsdata'));
		}else{
			return view('admin.membership_fee_configurations.index',compact('membershipfeeconfigurationsdata'));
		}
	}

	public function create(){
		$membershipfeeconfigurationsdata;
		$membershipfeeconfigurationsdata['clienttypes']=ClientTypes::all();
		$membershipfeeconfigurationsdata['paymentmodes']=PaymentModes::all();
		$membershipfeeconfigurationsdata['accounts']=Accounts::all();
		$membershipfeeconfigurationsdata['accounts']=Accounts::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','MembershipFeeConfigurations']])->get();
		$membershipfeeconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($membershipfeeconfigurationsdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('membershipfeeconfigurationsdata'));
		}else{
			return view('admin.membership_fee_configurations.create',compact('membershipfeeconfigurationsdata'));
		}
	}

	public function filter(Request $request){
		$membershipfeeconfigurationsdata['clienttypes']=ClientTypes::all();
		$membershipfeeconfigurationsdata['paymentmodes']=PaymentModes::all();
		$membershipfeeconfigurationsdata['accounts']=Accounts::all();
		$membershipfeeconfigurationsdata['accounts']=Accounts::all();
		$membershipfeeconfigurationsdata['list']=MembershipFeeConfigurations::where([['client_type','LIKE','%'.$request->get('client_type').'%'],['payment_mode','LIKE','%'.$request->get('payment_mode').'%'],['debit_account','LIKE','%'.$request->get('debit_account').'%'],['credit_account','LIKE','%'.$request->get('credit_account').'%'],])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','MembershipFeeConfigurations']])->get();
		$membershipfeeconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($membershipfeeconfigurationsdata['usersaccountsroles'][0]['_add']==0&&$membershipfeeconfigurationsdata['usersaccountsroles'][0]['_list']==0&&$membershipfeeconfigurationsdata['usersaccountsroles'][0]['_edit']==0&&$membershipfeeconfigurationsdata['usersaccountsroles'][0]['_edit']==0&&$membershipfeeconfigurationsdata['usersaccountsroles'][0]['_show']==0&&$membershipfeeconfigurationsdata['usersaccountsroles'][0]['_delete']==0&&$membershipfeeconfigurationsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('membershipfeeconfigurationsdata'));
		}else{
			return view('admin.membership_fee_configurations.index',compact('membershipfeeconfigurationsdata'));
		}
	}

	public function report(){
		$membershipfeeconfigurationsdata['company']=Companies::all();
		$membershipfeeconfigurationsdata['list']=MembershipFeeConfigurations::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','MembershipFeeConfigurations']])->get();
		$membershipfeeconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($membershipfeeconfigurationsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('membershipfeeconfigurationsdata'));
		}else{
			return view('admin.membership_fee_configurations.report',compact('membershipfeeconfigurationsdata'));
		}
	}

	public function chart(){
		return view('admin.membership_fee_configurations.chart');
	}

	public function store(Request $request){
		$membershipfeeconfigurations=new MembershipFeeConfigurations();
		$membershipfeeconfigurations->client_type=$request->get('client_type');
		$membershipfeeconfigurations->payment_mode=$request->get('payment_mode');
		$membershipfeeconfigurations->debit_account=$request->get('debit_account');
		$membershipfeeconfigurations->credit_account=$request->get('credit_account');
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','MembershipFeeConfigurations']])->get();
		$membershipfeeconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($membershipfeeconfigurationsdata['usersaccountsroles'][0]['_show']==1){
			try{
				if($membershipfeeconfigurations->save()){
					$response['status']='1';
					$response['message']='membership fee configurations Added successfully';
					return json_encode($response);
			}else{
					$response['status']='0';
					$response['message']='Failed to add membership fee configurations. Please try again';
					return json_encode($response);
				}
			}
			catch(Exception $e){
					$response['status']='0';
					$response['message']='An Error occured while attempting to add membership fee configurations. Please try again';
					return json_encode($response);
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$membershipfeeconfigurationsdata['clienttypes']=ClientTypes::all();
		$membershipfeeconfigurationsdata['paymentmodes']=PaymentModes::all();
		$membershipfeeconfigurationsdata['accounts']=Accounts::all();
		$membershipfeeconfigurationsdata['accounts']=Accounts::all();
		$membershipfeeconfigurationsdata['data']=MembershipFeeConfigurations::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','MembershipFeeConfigurations']])->get();
		$membershipfeeconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($membershipfeeconfigurationsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('membershipfeeconfigurationsdata'));
		}else{
		return view('admin.membership_fee_configurations.edit',compact('membershipfeeconfigurationsdata','id'));
		}
	}

	public function show($id){
		$membershipfeeconfigurationsdata['clienttypes']=ClientTypes::all();
		$membershipfeeconfigurationsdata['paymentmodes']=PaymentModes::all();
		$membershipfeeconfigurationsdata['accounts']=Accounts::all();
		$membershipfeeconfigurationsdata['accounts']=Accounts::all();
		$membershipfeeconfigurationsdata['data']=MembershipFeeConfigurations::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','MembershipFeeConfigurations']])->get();
		$membershipfeeconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($membershipfeeconfigurationsdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('membershipfeeconfigurationsdata'));
		}else{
		return view('admin.membership_fee_configurations.show',compact('membershipfeeconfigurationsdata','id'));
		}
	}

	public function update(Request $request,$id){
		$membershipfeeconfigurations=MembershipFeeConfigurations::find($id);
		$membershipfeeconfigurations->client_type=$request->get('client_type');
		$membershipfeeconfigurations->payment_mode=$request->get('payment_mode');
		$membershipfeeconfigurations->debit_account=$request->get('debit_account');
		$membershipfeeconfigurations->credit_account=$request->get('credit_account');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','MembershipFeeConfigurations']])->get();
		$membershipfeeconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($membershipfeeconfigurationsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('membershipfeeconfigurationsdata'));
		}else{
		$membershipfeeconfigurations->save();
		$membershipfeeconfigurationsdata['data']=MembershipFeeConfigurations::find($id);
		return view('admin.membership_fee_configurations.edit',compact('membershipfeeconfigurationsdata','id'));
		}
	}

	public function destroy($id){
		$membershipfeeconfigurations=MembershipFeeConfigurations::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','MembershipFeeConfigurations']])->get();
		$membershipfeeconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($membershipfeeconfigurationsdata['usersaccountsroles'][0]['_delete']==1){
			$membershipfeeconfigurations->delete();
		}return redirect('admin/membershipfeeconfigurations')->with('success','membership fee configurations has been deleted!');
	}
}