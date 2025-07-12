<?php
/**
* @author  Wanjala Innocent Khaemba
*Controller - (mobile money charge configurations)
*/
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\MobileMoneyChargeConfigurations;
use App\Companies;
use App\Modules;
use App\Clients;
use App\Users;
use App\ClientTypes;
use App\MobileMoneyChargeScales;
use App\MobileMoneyModes;
use App\FeeTypes;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;
class MobileMoneyChargeConfigurationsController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$mobilemoneychargeconfigurationsdata['clienttypes']=ClientTypes::all();
		$mobilemoneychargeconfigurationsdata['mobilemoneymodes']=MobileMoneyModes::all();
		$mobilemoneychargeconfigurationsdata['feetypes']=FeeTypes::all();
		$mobilemoneychargeconfigurationsdata['list']=MobileMoneyChargeConfigurations::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','MobileMoneyChargeConfigurations']])->get();
		$mobilemoneychargeconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($mobilemoneychargeconfigurationsdata['usersaccountsroles'][0]) && $mobilemoneychargeconfigurationsdata['usersaccountsroles'][0]['_add']==0&&$mobilemoneychargeconfigurationsdata['usersaccountsroles'][0]['_list']==0&&$mobilemoneychargeconfigurationsdata['usersaccountsroles'][0]['_edit']==0&&$mobilemoneychargeconfigurationsdata['usersaccountsroles'][0]['_edit']==0&&$mobilemoneychargeconfigurationsdata['usersaccountsroles'][0]['_show']==0&&$mobilemoneychargeconfigurationsdata['usersaccountsroles'][0]['_delete']==0&&$mobilemoneychargeconfigurationsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('mobilemoneychargeconfigurationsdata'));
		}else{
			return view('admin.mobile_money_charge_configurations.index',compact('mobilemoneychargeconfigurationsdata'));
		}
	}

	public function create(){
		$mobilemoneychargeconfigurationsdata;
		$mobilemoneychargeconfigurationsdata['clienttypes']=ClientTypes::all();
		$mobilemoneychargeconfigurationsdata['mobilemoneymodes']=MobileMoneyModes::all();
		$mobilemoneychargeconfigurationsdata['feetypes']=FeeTypes::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','MobileMoneyChargeConfigurations']])->get();
		$mobilemoneychargeconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($mobilemoneychargeconfigurationsdata['usersaccountsroles'][0]) && $mobilemoneychargeconfigurationsdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('mobilemoneychargeconfigurationsdata'));
		}else{
			return view('admin.mobile_money_charge_configurations.create',compact('mobilemoneychargeconfigurationsdata'));
		}
	}

	public function filter(Request $request){
		$mobilemoneychargeconfigurationsdata['clienttypes']=ClientTypes::all();
		$mobilemoneychargeconfigurationsdata['mobilemoneymodes']=MobileMoneyModes::all();
		$mobilemoneychargeconfigurationsdata['feetypes']=FeeTypes::all();
		$mobilemoneychargeconfigurationsdata['list']=MobileMoneyChargeConfigurations::where([['client_type','LIKE','%'.$request->get('client_type').'%'],['mobile_money_modes','LIKE','%'.$request->get('mobile_money_modes').'%'],['charge_type','LIKE','%'.$request->get('charge_type').'%'],['value','LIKE','%'.$request->get('value').'%'],])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','MobileMoneyChargeConfigurations']])->get();
		$mobilemoneychargeconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($mobilemoneychargeconfigurationsdata['usersaccountsroles'][0]) && $mobilemoneychargeconfigurationsdata['usersaccountsroles'][0]['_add']==0&&$mobilemoneychargeconfigurationsdata['usersaccountsroles'][0]['_list']==0&&$mobilemoneychargeconfigurationsdata['usersaccountsroles'][0]['_edit']==0&&$mobilemoneychargeconfigurationsdata['usersaccountsroles'][0]['_edit']==0&&$mobilemoneychargeconfigurationsdata['usersaccountsroles'][0]['_show']==0&&$mobilemoneychargeconfigurationsdata['usersaccountsroles'][0]['_delete']==0&&$mobilemoneychargeconfigurationsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('mobilemoneychargeconfigurationsdata'));
		}else{
			return view('admin.mobile_money_charge_configurations.index',compact('mobilemoneychargeconfigurationsdata'));
		}
	}

	public function report(){
		$mobilemoneychargeconfigurationsdata['company']=Companies::all();
		$mobilemoneychargeconfigurationsdata['list']=MobileMoneyChargeConfigurations::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','MobileMoneyChargeConfigurations']])->get();
		$mobilemoneychargeconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($mobilemoneychargeconfigurationsdata['usersaccountsroles'][0]) && $mobilemoneychargeconfigurationsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('mobilemoneychargeconfigurationsdata'));
		}else{
			return view('admin.mobile_money_charge_configurations.report',compact('mobilemoneychargeconfigurationsdata'));
		}
	}

	public function chart(){
		return view('admin.mobile_money_charge_configurations.chart');
	}

	public function store(Request $request){
		$mobilemoneychargeconfigurations=new MobileMoneyChargeConfigurations();
		$mobilemoneychargeconfigurations->client_type=$request->get('client_type');
		$mobilemoneychargeconfigurations->mobile_money_modes=$request->get('mobile_money_modes');
		$mobilemoneychargeconfigurations->charge_type=$request->get('charge_type');
		$mobilemoneychargeconfigurations->name=$request->get('name');
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','MobileMoneyChargeConfigurations']])->get();
		$mobilemoneychargeconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($mobilemoneychargeconfigurationsdata['usersaccountsroles'][0]) && $mobilemoneychargeconfigurationsdata['usersaccountsroles'][0]['_show']==1){
			try{
				if($mobilemoneychargeconfigurations->save()){
					$response['status']='1';
					$response['message']='mobile money charge configurations Added successfully';
					return json_encode($response);
			}else{
					$response['status']='0';
					$response['message']='Failed to add mobile money charge configurations. Please try again';
					return json_encode($response);
				}
			}
			catch(Exception $e){
					$response['status']='0';
					$response['message']='An Error occured while attempting to add mobile money charge configurations. Please try again';
					return json_encode($response);
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$mobilemoneychargeconfigurationsdata['clienttypes']=ClientTypes::all();
		$mobilemoneychargeconfigurationsdata['mobilemoneymodes']=MobileMoneyModes::all();
		$mobilemoneychargeconfigurationsdata['feetypes']=FeeTypes::all();
		$mobilemoneychargeconfigurationsdata['data']=MobileMoneyChargeConfigurations::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','MobileMoneyChargeConfigurations']])->get();
		$mobilemoneychargeconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($mobilemoneychargeconfigurationsdata['usersaccountsroles'][0]) && $mobilemoneychargeconfigurationsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('mobilemoneychargeconfigurationsdata'));
		}else{
		return view('admin.mobile_money_charge_configurations.edit',compact('mobilemoneychargeconfigurationsdata','id'));
		}
	}

	public function show($id){
		$mobilemoneychargeconfigurationsdata['clienttypes']=ClientTypes::all();
		$mobilemoneychargeconfigurationsdata['mobilemoneymodes']=MobileMoneyModes::all();
		$mobilemoneychargeconfigurationsdata['feetypes']=FeeTypes::all();
		$mobilemoneychargeconfigurationsdata['data']=MobileMoneyChargeConfigurations::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','MobileMoneyChargeConfigurations']])->get();
		$mobilemoneychargeconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($mobilemoneychargeconfigurationsdata['usersaccountsroles'][0]) && $mobilemoneychargeconfigurationsdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('mobilemoneychargeconfigurationsdata'));
		}else{
		return view('admin.mobile_money_charge_configurations.show',compact('mobilemoneychargeconfigurationsdata','id'));
		}
	}

	public function update(Request $request,$id){
		$mobilemoneychargeconfigurations=MobileMoneyChargeConfigurations::find($id);
		$mobilemoneychargeconfigurationsdata['clienttypes']=ClientTypes::all();
		$mobilemoneychargeconfigurationsdata['mobilemoneymodes']=MobileMoneyModes::all();
		$mobilemoneychargeconfigurationsdata['feetypes']=FeeTypes::all();
		$mobilemoneychargeconfigurations->client_type=$request->get('client_type');
		$mobilemoneychargeconfigurations->mobile_money_modes=$request->get('mobile_money_modes');
		$mobilemoneychargeconfigurations->charge_type=$request->get('charge_type');
		$mobilemoneychargeconfigurations->name=$request->get('name');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','MobileMoneyChargeConfigurations']])->get();
		$mobilemoneychargeconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($mobilemoneychargeconfigurationsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('mobilemoneychargeconfigurationsdata'));
		}else{
		$mobilemoneychargeconfigurations->save();
		$mobilemoneychargeconfigurationsdata['data']=MobileMoneyChargeConfigurations::find($id);
		return view('admin.mobile_money_charge_configurations.edit',compact('mobilemoneychargeconfigurationsdata','id'));
		}
	}

	public function destroy($id){
		$mobilemoneychargeconfigurations=MobileMoneyChargeConfigurations::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','MobileMoneyChargeConfigurations']])->get();
		$mobilemoneychargeconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($mobilemoneychargeconfigurationsdata['usersaccountsroles'][0]) && $mobilemoneychargeconfigurationsdata['usersaccountsroles'][0]['_delete']==1){
			$mobilemoneychargeconfigurations->delete();
		}return redirect('admin/mobilemoneychargeconfigurations')->with('success','mobile money charge configurations has been deleted!');
	}

	public function gettransactioncharge($clientid,$mobilemoneymodeid,$amount){

		$client=Clients::find($clientid);

		$charge=MobileMoneyChargeConfigurations::where([["client_type","=",$client->client_type],["mobile_money_modes","=",$mobilemoneymodeid]])->get()->first();

		$scale=MobileMoneyChargeScales::where([["mobile_money_charge","=",$charge->id],["minimum_amount","<=",$amount],["maximum_amount",">=",$amount]])->get()->first();

		$chargetype=FeeTypes::where([["code","=","001"]])->get()->first();

		if(isset($scale)){

			if($scale->charge_type==$chargetype->id){

				return ($amount*($scale->charge/100));

			}else{
				return $scale->charge;
			}			

		}

		return 0;

	}
}