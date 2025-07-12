<?php
/**
* @author  Wanjala Innocent Khaemba
*Controller - (bank transfer charge scales)
*/
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\BankTransferChargeScales;
use App\Companies;
use App\Modules;
use App\Users;
use App\BankTransferCharges;
use App\FeeTypes;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;
class BankTransferChargeScalesController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$banktransferchargescalesdata['banktransfercharges']=BankTransferCharges::all();
		$banktransferchargescalesdata['feetypes']=FeeTypes::all();
		$banktransferchargescalesdata['list']=BankTransferChargeScales::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','BankTransferChargeScales']])->get();
		$banktransferchargescalesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($banktransferchargescalesdata['usersaccountsroles'][0]) && $banktransferchargescalesdata['usersaccountsroles'][0]['_add']==0&&$banktransferchargescalesdata['usersaccountsroles'][0]['_list']==0&&$banktransferchargescalesdata['usersaccountsroles'][0]['_edit']==0&&$banktransferchargescalesdata['usersaccountsroles'][0]['_edit']==0&&$banktransferchargescalesdata['usersaccountsroles'][0]['_show']==0&&$banktransferchargescalesdata['usersaccountsroles'][0]['_delete']==0&&$banktransferchargescalesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('banktransferchargescalesdata'));
		}else{
			return view('admin.bank_transfer_charge_scales.index',compact('banktransferchargescalesdata'));
		}
	}

	public function create(){
		$banktransferchargescalesdata;
		$banktransferchargescalesdata['banktransfercharges']=BankTransferCharges::all();
		$banktransferchargescalesdata['feetypes']=FeeTypes::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','BankTransferChargeScales']])->get();
		$banktransferchargescalesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($banktransferchargescalesdata['usersaccountsroles'][0]) && $banktransferchargescalesdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('banktransferchargescalesdata'));
		}else{
			return view('admin.bank_transfer_charge_scales.create',compact('banktransferchargescalesdata'));
		}
	}

	public function filter(Request $request){
		$banktransferchargescalesdata['banktransfercharges']=BankTransferCharges::all();
		$banktransferchargescalesdata['feetypes']=FeeTypes::all();
		$banktransferchargescalesdata['list']=BankTransferChargeScales::where([['bank_transfer_charge','LIKE','%'.$request->get('bank_transfer_charge').'%'],['minimum_amount','LIKE','%'.$request->get('minimum_amount').'%'],['maximum_amount','LIKE','%'.$request->get('maximum_amount').'%'],['charge_type','LIKE','%'.$request->get('charge_type').'%'],['charge','LIKE','%'.$request->get('charge').'%'],])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','BankTransferChargeScales']])->get();
		$banktransferchargescalesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($banktransferchargescalesdata['usersaccountsroles'][0]) && $banktransferchargescalesdata['usersaccountsroles'][0]['_add']==0&&$banktransferchargescalesdata['usersaccountsroles'][0]['_list']==0&&$banktransferchargescalesdata['usersaccountsroles'][0]['_edit']==0&&$banktransferchargescalesdata['usersaccountsroles'][0]['_edit']==0&&$banktransferchargescalesdata['usersaccountsroles'][0]['_show']==0&&$banktransferchargescalesdata['usersaccountsroles'][0]['_delete']==0&&$banktransferchargescalesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('banktransferchargescalesdata'));
		}else{
			return view('admin.bank_transfer_charge_scales.index',compact('banktransferchargescalesdata'));
		}
	}

	public function report(){
		$banktransferchargescalesdata['company']=Companies::all();
		$banktransferchargescalesdata['list']=BankTransferChargeScales::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','BankTransferChargeScales']])->get();
		$banktransferchargescalesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($banktransferchargescalesdata['usersaccountsroles'][0]) && $banktransferchargescalesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('banktransferchargescalesdata'));
		}else{
			return view('admin.bank_transfer_charge_scales.report',compact('banktransferchargescalesdata'));
		}
	}

	public function chart(){
		return view('admin.bank_transfer_charge_scales.chart');
	}

	public function store(Request $request){
		$banktransferchargescales=new BankTransferChargeScales();
		$banktransferchargescales->bank_transfer_charge=$request->get('bank_transfer_charge');
		$banktransferchargescales->minimum_amount=$request->get('minimum_amount');
		$banktransferchargescales->maximum_amount=$request->get('maximum_amount');
		$banktransferchargescales->charge_type=$request->get('charge_type');
		$banktransferchargescales->charge=$request->get('charge');
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','BankTransferChargeScales']])->get();
		$banktransferchargescalesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($banktransferchargescalesdata['usersaccountsroles'][0]) && $banktransferchargescalesdata['usersaccountsroles'][0]['_show']==1){
			try{
				if($banktransferchargescales->save()){
					$response['status']='1';
					$response['message']='bank transfer charge scales Added successfully';
					return json_encode($response);
			}else{
					$response['status']='0';
					$response['message']='Failed to add bank transfer charge scales. Please try again';
					return json_encode($response);
				}
			}
			catch(Exception $e){
					$response['status']='0';
					$response['message']='An Error occured while attempting to add bank transfer charge scales. Please try again';
					return json_encode($response);
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$banktransferchargescalesdata['banktransfercharges']=BankTransferCharges::all();
		$banktransferchargescalesdata['feetypes']=FeeTypes::all();
		$banktransferchargescalesdata['data']=BankTransferChargeScales::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','BankTransferChargeScales']])->get();
		$banktransferchargescalesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($banktransferchargescalesdata['usersaccountsroles'][0]) && $banktransferchargescalesdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('banktransferchargescalesdata'));
		}else{
		return view('admin.bank_transfer_charge_scales.edit',compact('banktransferchargescalesdata','id'));
		}
	}

	public function show($id){
		$banktransferchargescalesdata['banktransfercharges']=BankTransferCharges::all();
		$banktransferchargescalesdata['feetypes']=FeeTypes::all();
		$banktransferchargescalesdata['data']=BankTransferChargeScales::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','BankTransferChargeScales']])->get();
		$banktransferchargescalesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($banktransferchargescalesdata['usersaccountsroles'][0]) && $banktransferchargescalesdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('banktransferchargescalesdata'));
		}else{
		return view('admin.bank_transfer_charge_scales.show',compact('banktransferchargescalesdata','id'));
		}
	}

	public function update(Request $request,$id){
		$banktransferchargescales=BankTransferChargeScales::find($id);
		$banktransferchargescalesdata['banktransfercharges']=BankTransferCharges::all();
		$banktransferchargescalesdata['feetypes']=FeeTypes::all();
		$banktransferchargescales->bank_transfer_charge=$request->get('bank_transfer_charge');
		$banktransferchargescales->minimum_amount=$request->get('minimum_amount');
		$banktransferchargescales->maximum_amount=$request->get('maximum_amount');
		$banktransferchargescales->charge_type=$request->get('charge_type');
		$banktransferchargescales->charge=$request->get('charge');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','BankTransferChargeScales']])->get();
		$banktransferchargescalesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($banktransferchargescalesdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('banktransferchargescalesdata'));
		}else{
		$banktransferchargescales->save();
		$banktransferchargescalesdata['data']=BankTransferChargeScales::find($id);
		return view('admin.bank_transfer_charge_scales.edit',compact('banktransferchargescalesdata','id'));
		}
	}

	public function destroy($id){
		$banktransferchargescales=BankTransferChargeScales::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','BankTransferChargeScales']])->get();
		$banktransferchargescalesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($banktransferchargescalesdata['usersaccountsroles'][0]) && $banktransferchargescalesdata['usersaccountsroles'][0]['_delete']==1){
			$banktransferchargescales->delete();
		}return redirect('admin/banktransferchargescales')->with('success','bank transfer charge scales has been deleted!');
	}
}