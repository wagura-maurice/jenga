<?php
/**
* @author  Wanjala Innocent Khaemba
*Controller - (other payment type account mappings)
*/
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\OtherPaymentTypeAccountMappings;
use App\Companies;
use App\Modules;
use App\Users;
use App\OtherPaymentTypes;
use App\PaymentModes;
use App\Accounts;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;
class OtherPaymentTypeAccountMappingsController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$otherpaymenttypeaccountmappingsdata['otherpaymenttypes']=OtherPaymentTypes::all();
		$otherpaymenttypeaccountmappingsdata['paymentmodes']=PaymentModes::all();
		$otherpaymenttypeaccountmappingsdata['accounts']=Accounts::all();
		$otherpaymenttypeaccountmappingsdata['accounts']=Accounts::all();
		$otherpaymenttypeaccountmappingsdata['list']=OtherPaymentTypeAccountMappings::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','OtherPaymentTypeAccountMappings']])->get();
		$otherpaymenttypeaccountmappingsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($otherpaymenttypeaccountmappingsdata['usersaccountsroles'][0]) && $otherpaymenttypeaccountmappingsdata['usersaccountsroles'][0]['_add']==0&&$otherpaymenttypeaccountmappingsdata['usersaccountsroles'][0]['_list']==0&&$otherpaymenttypeaccountmappingsdata['usersaccountsroles'][0]['_edit']==0&&$otherpaymenttypeaccountmappingsdata['usersaccountsroles'][0]['_edit']==0&&$otherpaymenttypeaccountmappingsdata['usersaccountsroles'][0]['_show']==0&&$otherpaymenttypeaccountmappingsdata['usersaccountsroles'][0]['_delete']==0&&$otherpaymenttypeaccountmappingsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('otherpaymenttypeaccountmappingsdata'));
		}else{
			return view('admin.other_payment_type_account_mappings.index',compact('otherpaymenttypeaccountmappingsdata'));
		}
	}

	public function create(){
		$otherpaymenttypeaccountmappingsdata;
		$otherpaymenttypeaccountmappingsdata['otherpaymenttypes']=OtherPaymentTypes::all();
		$otherpaymenttypeaccountmappingsdata['paymentmodes']=PaymentModes::all();
		$otherpaymenttypeaccountmappingsdata['accounts']=Accounts::all();
		$otherpaymenttypeaccountmappingsdata['accounts']=Accounts::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','OtherPaymentTypeAccountMappings']])->get();
		$otherpaymenttypeaccountmappingsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($otherpaymenttypeaccountmappingsdata['usersaccountsroles'][0]) && $otherpaymenttypeaccountmappingsdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('otherpaymenttypeaccountmappingsdata'));
		}else{
			return view('admin.other_payment_type_account_mappings.create',compact('otherpaymenttypeaccountmappingsdata'));
		}
	}

	public function filter(Request $request){
		$otherpaymenttypeaccountmappingsdata['otherpaymenttypes']=OtherPaymentTypes::all();
		$otherpaymenttypeaccountmappingsdata['paymentmodes']=PaymentModes::all();
		$otherpaymenttypeaccountmappingsdata['accounts']=Accounts::all();
		$otherpaymenttypeaccountmappingsdata['accounts']=Accounts::all();
		$otherpaymenttypeaccountmappingsdata['list']=OtherPaymentTypeAccountMappings::where([['other_payment_type','LIKE','%'.$request->get('other_payment_type').'%'],['payment_mode','LIKE','%'.$request->get('payment_mode').'%'],['debit_account','LIKE','%'.$request->get('debit_account').'%'],['credit_account','LIKE','%'.$request->get('credit_account').'%'],])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','OtherPaymentTypeAccountMappings']])->get();
		$otherpaymenttypeaccountmappingsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($otherpaymenttypeaccountmappingsdata['usersaccountsroles'][0]) && $otherpaymenttypeaccountmappingsdata['usersaccountsroles'][0]['_add']==0&&$otherpaymenttypeaccountmappingsdata['usersaccountsroles'][0]['_list']==0&&$otherpaymenttypeaccountmappingsdata['usersaccountsroles'][0]['_edit']==0&&$otherpaymenttypeaccountmappingsdata['usersaccountsroles'][0]['_edit']==0&&$otherpaymenttypeaccountmappingsdata['usersaccountsroles'][0]['_show']==0&&$otherpaymenttypeaccountmappingsdata['usersaccountsroles'][0]['_delete']==0&&$otherpaymenttypeaccountmappingsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('otherpaymenttypeaccountmappingsdata'));
		}else{
			return view('admin.other_payment_type_account_mappings.index',compact('otherpaymenttypeaccountmappingsdata'));
		}
	}

	public function report(){
		$otherpaymenttypeaccountmappingsdata['company']=Companies::all();
		$otherpaymenttypeaccountmappingsdata['list']=OtherPaymentTypeAccountMappings::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','OtherPaymentTypeAccountMappings']])->get();
		$otherpaymenttypeaccountmappingsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($otherpaymenttypeaccountmappingsdata['usersaccountsroles'][0]) && $otherpaymenttypeaccountmappingsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('otherpaymenttypeaccountmappingsdata'));
		}else{
			return view('admin.other_payment_type_account_mappings.report',compact('otherpaymenttypeaccountmappingsdata'));
		}
	}

	public function chart(){
		return view('admin.other_payment_type_account_mappings.chart');
	}

	public function store(Request $request){
		$otherpaymenttypeaccountmappings=new OtherPaymentTypeAccountMappings();
		$otherpaymenttypeaccountmappings->other_payment_type=$request->get('other_payment_type');
		$otherpaymenttypeaccountmappings->payment_mode=$request->get('payment_mode');
		$otherpaymenttypeaccountmappings->debit_account=$request->get('debit_account');
		$otherpaymenttypeaccountmappings->credit_account=$request->get('credit_account');
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','OtherPaymentTypeAccountMappings']])->get();
		$otherpaymenttypeaccountmappingsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($otherpaymenttypeaccountmappingsdata['usersaccountsroles'][0]) && $otherpaymenttypeaccountmappingsdata['usersaccountsroles'][0]['_show']==1){
			try{
				if($otherpaymenttypeaccountmappings->save()){
					$response['status']='1';
					$response['message']='other payment type account mappings Added successfully';
					return json_encode($response);
			}else{
					$response['status']='0';
					$response['message']='Failed to add other payment type account mappings. Please try again';
					return json_encode($response);
				}
			}
			catch(Exception $e){
					$response['status']='0';
					$response['message']='An Error occured while attempting to add other payment type account mappings. Please try again';
					return json_encode($response);
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$otherpaymenttypeaccountmappingsdata['otherpaymenttypes']=OtherPaymentTypes::all();
		$otherpaymenttypeaccountmappingsdata['paymentmodes']=PaymentModes::all();
		$otherpaymenttypeaccountmappingsdata['accounts']=Accounts::all();
		$otherpaymenttypeaccountmappingsdata['accounts']=Accounts::all();
		$otherpaymenttypeaccountmappingsdata['data']=OtherPaymentTypeAccountMappings::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','OtherPaymentTypeAccountMappings']])->get();
		$otherpaymenttypeaccountmappingsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($otherpaymenttypeaccountmappingsdata['usersaccountsroles'][0]) && $otherpaymenttypeaccountmappingsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('otherpaymenttypeaccountmappingsdata'));
		}else{
		return view('admin.other_payment_type_account_mappings.edit',compact('otherpaymenttypeaccountmappingsdata','id'));
		}
	}

	public function show($id){
		$otherpaymenttypeaccountmappingsdata['otherpaymenttypes']=OtherPaymentTypes::all();
		$otherpaymenttypeaccountmappingsdata['paymentmodes']=PaymentModes::all();
		$otherpaymenttypeaccountmappingsdata['accounts']=Accounts::all();
		$otherpaymenttypeaccountmappingsdata['accounts']=Accounts::all();
		$otherpaymenttypeaccountmappingsdata['data']=OtherPaymentTypeAccountMappings::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','OtherPaymentTypeAccountMappings']])->get();
		$otherpaymenttypeaccountmappingsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($otherpaymenttypeaccountmappingsdata['usersaccountsroles'][0]) && $otherpaymenttypeaccountmappingsdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('otherpaymenttypeaccountmappingsdata'));
		}else{
		return view('admin.other_payment_type_account_mappings.show',compact('otherpaymenttypeaccountmappingsdata','id'));
		}
	}

	public function update(Request $request,$id){
		$otherpaymenttypeaccountmappings=OtherPaymentTypeAccountMappings::find($id);
		$otherpaymenttypeaccountmappingsdata['otherpaymenttypes']=OtherPaymentTypes::all();
		$otherpaymenttypeaccountmappingsdata['paymentmodes']=PaymentModes::all();
		$otherpaymenttypeaccountmappingsdata['accounts']=Accounts::all();
		$otherpaymenttypeaccountmappingsdata['accounts']=Accounts::all();
		$otherpaymenttypeaccountmappings->other_payment_type=$request->get('other_payment_type');
		$otherpaymenttypeaccountmappings->payment_mode=$request->get('payment_mode');
		$otherpaymenttypeaccountmappings->debit_account=$request->get('debit_account');
		$otherpaymenttypeaccountmappings->credit_account=$request->get('credit_account');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','OtherPaymentTypeAccountMappings']])->get();
		$otherpaymenttypeaccountmappingsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($otherpaymenttypeaccountmappingsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('otherpaymenttypeaccountmappingsdata'));
		}else{
		$otherpaymenttypeaccountmappings->save();
		$otherpaymenttypeaccountmappingsdata['data']=OtherPaymentTypeAccountMappings::find($id);
		return view('admin.other_payment_type_account_mappings.edit',compact('otherpaymenttypeaccountmappingsdata','id'));
		}
	}

	public function destroy($id){
		$otherpaymenttypeaccountmappings=OtherPaymentTypeAccountMappings::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','OtherPaymentTypeAccountMappings']])->get();
		$otherpaymenttypeaccountmappingsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($otherpaymenttypeaccountmappingsdata['usersaccountsroles'][0]) && $otherpaymenttypeaccountmappingsdata['usersaccountsroles'][0]['_delete']==1){
			$otherpaymenttypeaccountmappings->delete();
		}return redirect('admin/otherpaymenttypeaccountmappings')->with('success','other payment type account mappings has been deleted!');
	}
}