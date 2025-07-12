<?php
/**
* @author  Wanjala Innocent Khaemba
*Controller - (bank transfer charges)
*/
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\BankTransferCharges;
use App\Companies;
use App\Modules;
use App\Users;
use App\Clients;
use App\FeeTypes;
use App\BankTransferChargeScales;
use App\ClientTypes;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;
class BankTransferChargesController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$banktransferchargesdata['clienttypes']=ClientTypes::all();
		$banktransferchargesdata['list']=BankTransferCharges::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','BankTransferCharges']])->get();
		$banktransferchargesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($banktransferchargesdata['usersaccountsroles'][0]) && $banktransferchargesdata['usersaccountsroles'][0]['_add']==0&&$banktransferchargesdata['usersaccountsroles'][0]['_list']==0&&$banktransferchargesdata['usersaccountsroles'][0]['_edit']==0&&$banktransferchargesdata['usersaccountsroles'][0]['_edit']==0&&$banktransferchargesdata['usersaccountsroles'][0]['_show']==0&&$banktransferchargesdata['usersaccountsroles'][0]['_delete']==0&&$banktransferchargesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('banktransferchargesdata'));
		}else{
			return view('admin.bank_transfer_charges.index',compact('banktransferchargesdata'));
		}
	}

	public function create(){
		$banktransferchargesdata;
		$banktransferchargesdata['clienttypes']=ClientTypes::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','BankTransferCharges']])->get();
		$banktransferchargesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($banktransferchargesdata['usersaccountsroles'][0]) && $banktransferchargesdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('banktransferchargesdata'));
		}else{
			return view('admin.bank_transfer_charges.create',compact('banktransferchargesdata'));
		}
	}

	public function filter(Request $request){
		$banktransferchargesdata['clienttypes']=ClientTypes::all();
		$banktransferchargesdata['list']=BankTransferCharges::where([['client_type','LIKE','%'.$request->get('client_type').'%'],['name','LIKE','%'.$request->get('name').'%'],])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','BankTransferCharges']])->get();
		$banktransferchargesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($banktransferchargesdata['usersaccountsroles'][0]) && $banktransferchargesdata['usersaccountsroles'][0]['_add']==0&&$banktransferchargesdata['usersaccountsroles'][0]['_list']==0&&$banktransferchargesdata['usersaccountsroles'][0]['_edit']==0&&$banktransferchargesdata['usersaccountsroles'][0]['_edit']==0&&$banktransferchargesdata['usersaccountsroles'][0]['_show']==0&&$banktransferchargesdata['usersaccountsroles'][0]['_delete']==0&&$banktransferchargesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('banktransferchargesdata'));
		}else{
			return view('admin.bank_transfer_charges.index',compact('banktransferchargesdata'));
		}
	}

	public function report(){
		$banktransferchargesdata['company']=Companies::all();
		$banktransferchargesdata['list']=BankTransferCharges::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','BankTransferCharges']])->get();
		$banktransferchargesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($banktransferchargesdata['usersaccountsroles'][0]) && $banktransferchargesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('banktransferchargesdata'));
		}else{
			return view('admin.bank_transfer_charges.report',compact('banktransferchargesdata'));
		}
	}

	public function chart(){
		return view('admin.bank_transfer_charges.chart');
	}

	public function store(Request $request){
		$banktransfercharges=new BankTransferCharges();
		$banktransfercharges->client_type=$request->get('client_type');
		$banktransfercharges->name=$request->get('name');
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','BankTransferCharges']])->get();
		$banktransferchargesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($banktransferchargesdata['usersaccountsroles'][0]) && $banktransferchargesdata['usersaccountsroles'][0]['_show']==1){
			try{
				if($banktransfercharges->save()){
					$response['status']='1';
					$response['message']='bank transfer charges Added successfully';
					return json_encode($response);
			}else{
					$response['status']='0';
					$response['message']='Failed to add bank transfer charges. Please try again';
					return json_encode($response);
				}
			}
			catch(Exception $e){
					$response['status']='0';
					$response['message']='An Error occured while attempting to add bank transfer charges. Please try again';
					return json_encode($response);
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$banktransferchargesdata['clienttypes']=ClientTypes::all();
		$banktransferchargesdata['data']=BankTransferCharges::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','BankTransferCharges']])->get();
		$banktransferchargesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($banktransferchargesdata['usersaccountsroles'][0]) && $banktransferchargesdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('banktransferchargesdata'));
		}else{
		return view('admin.bank_transfer_charges.edit',compact('banktransferchargesdata','id'));
		}
	}

	public function show($id){
		$banktransferchargesdata['clienttypes']=ClientTypes::all();
		$banktransferchargesdata['data']=BankTransferCharges::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','BankTransferCharges']])->get();
		$banktransferchargesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($banktransferchargesdata['usersaccountsroles'][0]) && $banktransferchargesdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('banktransferchargesdata'));
		}else{
		return view('admin.bank_transfer_charges.show',compact('banktransferchargesdata','id'));
		}
	}

	public function update(Request $request,$id){
		$banktransfercharges=BankTransferCharges::find($id);
		$banktransferchargesdata['clienttypes']=ClientTypes::all();
		$banktransfercharges->client_type=$request->get('client_type');
		$banktransfercharges->name=$request->get('name');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','BankTransferCharges']])->get();
		$banktransferchargesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($banktransferchargesdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('banktransferchargesdata'));
		}else{
		$banktransfercharges->save();
		$banktransferchargesdata['data']=BankTransferCharges::find($id);
		return view('admin.bank_transfer_charges.edit',compact('banktransferchargesdata','id'));
		}
	}

	public function destroy($id){
		$banktransfercharges=BankTransferCharges::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','BankTransferCharges']])->get();
		$banktransferchargesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($banktransferchargesdata['usersaccountsroles'][0]) && $banktransferchargesdata['usersaccountsroles'][0]['_delete']==1){
			$banktransfercharges->delete();
		}return redirect('admin/banktransfercharges')->with('success','bank transfer charges has been deleted!');
	}

	function getbanktransactioncharges($clientid,$amount){

		$client=Clients::find($clientid);

		$charge=BankTransferCharges::where([["client_type","=",$client->client_type]])->get()->first();

		if(isset($charge)){

			$scale=BankTransferChargeScales::where([["bank_transfer_charge","=",$charge->id],["minimum_amount","<=",$amount],["maximum_amount",">=",$amount]])->get()->first();

			$percentage=FeeTypes::where([["code","=","001"]])->get()->first();

			if($percentage->id==$scale->charge_type){

				return (($scale->charge/100)*$amount);

			}else{

				return $scale->charge;

			}
		}

		return 0;

	}
}