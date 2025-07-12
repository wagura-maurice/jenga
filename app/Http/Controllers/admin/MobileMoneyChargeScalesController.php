<?php
/**
* @author  Wanjala Innocent Khaemba
*Controller - (mobile money charge scales)
*/
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\MobileMoneyChargeScales;
use App\Companies;
use App\Modules;
use App\Users;
use App\MobileMoneyChargeConfigurations;
use App\FeeTypes;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;
class MobileMoneyChargeScalesController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$mobilemoneychargescalesdata['mobilemoneychargeconfigurations']=MobileMoneyChargeConfigurations::all();
		$mobilemoneychargescalesdata['feetypes']=FeeTypes::all();
		$mobilemoneychargescalesdata['list']=MobileMoneyChargeScales::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','MobileMoneyChargeScales']])->get();
		$mobilemoneychargescalesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($mobilemoneychargescalesdata['usersaccountsroles'][0]) && $mobilemoneychargescalesdata['usersaccountsroles'][0]['_add']==0&&$mobilemoneychargescalesdata['usersaccountsroles'][0]['_list']==0&&$mobilemoneychargescalesdata['usersaccountsroles'][0]['_edit']==0&&$mobilemoneychargescalesdata['usersaccountsroles'][0]['_edit']==0&&$mobilemoneychargescalesdata['usersaccountsroles'][0]['_show']==0&&$mobilemoneychargescalesdata['usersaccountsroles'][0]['_delete']==0&&$mobilemoneychargescalesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('mobilemoneychargescalesdata'));
		}else{
			return view('admin.mobile_money_charge_scales.index',compact('mobilemoneychargescalesdata'));
		}
	}

	public function create(){
		$mobilemoneychargescalesdata;
		$mobilemoneychargescalesdata['mobilemoneychargeconfigurations']=MobileMoneyChargeConfigurations::all();
		$mobilemoneychargescalesdata['feetypes']=FeeTypes::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','MobileMoneyChargeScales']])->get();
		$mobilemoneychargescalesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($mobilemoneychargescalesdata['usersaccountsroles'][0]) && $mobilemoneychargescalesdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('mobilemoneychargescalesdata'));
		}else{
			return view('admin.mobile_money_charge_scales.create',compact('mobilemoneychargescalesdata'));
		}
	}

	public function filter(Request $request){
		$mobilemoneychargescalesdata['mobilemoneychargeconfigurations']=MobileMoneyChargeConfigurations::all();
		$mobilemoneychargescalesdata['feetypes']=FeeTypes::all();
		$mobilemoneychargescalesdata['list']=MobileMoneyChargeScales::where([['mobile_money_charge','LIKE','%'.$request->get('mobile_money_charge').'%'],['minimum_amount','LIKE','%'.$request->get('minimum_amount').'%'],['maximum_amount','LIKE','%'.$request->get('maximum_amount').'%'],['charge_type','LIKE','%'.$request->get('charge_type').'%'],['charge','LIKE','%'.$request->get('charge').'%'],])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','MobileMoneyChargeScales']])->get();
		$mobilemoneychargescalesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($mobilemoneychargescalesdata['usersaccountsroles'][0]) && $mobilemoneychargescalesdata['usersaccountsroles'][0]['_add']==0&&$mobilemoneychargescalesdata['usersaccountsroles'][0]['_list']==0&&$mobilemoneychargescalesdata['usersaccountsroles'][0]['_edit']==0&&$mobilemoneychargescalesdata['usersaccountsroles'][0]['_edit']==0&&$mobilemoneychargescalesdata['usersaccountsroles'][0]['_show']==0&&$mobilemoneychargescalesdata['usersaccountsroles'][0]['_delete']==0&&$mobilemoneychargescalesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('mobilemoneychargescalesdata'));
		}else{
			return view('admin.mobile_money_charge_scales.index',compact('mobilemoneychargescalesdata'));
		}
	}

	public function report(){
		$mobilemoneychargescalesdata['company']=Companies::all();
		$mobilemoneychargescalesdata['list']=MobileMoneyChargeScales::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','MobileMoneyChargeScales']])->get();
		$mobilemoneychargescalesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($mobilemoneychargescalesdata['usersaccountsroles'][0]) && $mobilemoneychargescalesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('mobilemoneychargescalesdata'));
		}else{
			return view('admin.mobile_money_charge_scales.report',compact('mobilemoneychargescalesdata'));
		}
	}

	public function chart(){
		return view('admin.mobile_money_charge_scales.chart');
	}

	public function store(Request $request){
		$mobilemoneychargescales=new MobileMoneyChargeScales();
		$mobilemoneychargescales->mobile_money_charge=$request->get('mobile_money_charge');
		$mobilemoneychargescales->minimum_amount=$request->get('minimum_amount');
		$mobilemoneychargescales->maximum_amount=$request->get('maximum_amount');
		$mobilemoneychargescales->charge_type=$request->get('charge_type');
		$mobilemoneychargescales->charge=$request->get('charge');
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','MobileMoneyChargeScales']])->get();
		$mobilemoneychargescalesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($mobilemoneychargescalesdata['usersaccountsroles'][0]) && $mobilemoneychargescalesdata['usersaccountsroles'][0]['_show']==1){
			try{
				if($mobilemoneychargescales->save()){
					$response['status']='1';
					$response['message']='mobile money charge scales Added successfully';
					return json_encode($response);
			}else{
					$response['status']='0';
					$response['message']='Failed to add mobile money charge scales. Please try again';
					return json_encode($response);
				}
			}
			catch(Exception $e){
					$response['status']='0';
					$response['message']='An Error occured while attempting to add mobile money charge scales. Please try again';
					return json_encode($response);
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$mobilemoneychargescalesdata['mobilemoneychargeconfigurations']=MobileMoneyChargeConfigurations::all();
		$mobilemoneychargescalesdata['feetypes']=FeeTypes::all();
		$mobilemoneychargescalesdata['data']=MobileMoneyChargeScales::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','MobileMoneyChargeScales']])->get();
		$mobilemoneychargescalesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($mobilemoneychargescalesdata['usersaccountsroles'][0]) && $mobilemoneychargescalesdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('mobilemoneychargescalesdata'));
		}else{
		return view('admin.mobile_money_charge_scales.edit',compact('mobilemoneychargescalesdata','id'));
		}
	}

	public function show($id){
		$mobilemoneychargescalesdata['mobilemoneychargeconfigurations']=MobileMoneyChargeConfigurations::all();
		$mobilemoneychargescalesdata['feetypes']=FeeTypes::all();
		$mobilemoneychargescalesdata['data']=MobileMoneyChargeScales::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','MobileMoneyChargeScales']])->get();
		$mobilemoneychargescalesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($mobilemoneychargescalesdata['usersaccountsroles'][0]) && $mobilemoneychargescalesdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('mobilemoneychargescalesdata'));
		}else{
		return view('admin.mobile_money_charge_scales.show',compact('mobilemoneychargescalesdata','id'));
		}
	}

	public function update(Request $request,$id){
		$mobilemoneychargescales=MobileMoneyChargeScales::find($id);
		$mobilemoneychargescalesdata['mobilemoneychargeconfigurations']=MobileMoneyChargeConfigurations::all();
		$mobilemoneychargescalesdata['feetypes']=FeeTypes::all();
		$mobilemoneychargescales->mobile_money_charge=$request->get('mobile_money_charge');
		$mobilemoneychargescales->minimum_amount=$request->get('minimum_amount');
		$mobilemoneychargescales->maximum_amount=$request->get('maximum_amount');
		$mobilemoneychargescales->charge_type=$request->get('charge_type');
		$mobilemoneychargescales->charge=$request->get('charge');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','MobileMoneyChargeScales']])->get();
		$mobilemoneychargescalesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($mobilemoneychargescalesdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('mobilemoneychargescalesdata'));
		}else{
		$mobilemoneychargescales->save();
		$mobilemoneychargescalesdata['data']=MobileMoneyChargeScales::find($id);
		return view('admin.mobile_money_charge_scales.edit',compact('mobilemoneychargescalesdata','id'));
		}
	}

	public function destroy($id){
		$mobilemoneychargescales=MobileMoneyChargeScales::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','MobileMoneyChargeScales']])->get();
		$mobilemoneychargescalesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($mobilemoneychargescalesdata['usersaccountsroles'][0]) && $mobilemoneychargescalesdata['usersaccountsroles'][0]['_delete']==1){
			$mobilemoneychargescales->delete();
		}return redirect('admin/mobilemoneychargescales')->with('success','mobile money charge scales has been deleted!');
	}
}