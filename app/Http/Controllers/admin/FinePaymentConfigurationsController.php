<?php
/**
* @author  Wanjala Innocent Khaemba
*Controller - (manages fine payment configurations data)
*/
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\FinePaymentConfigurations;
use App\Companies;
use App\Modules;
use App\Users;
use App\LoanProducts;
use App\Accounts;
use App\PaymentModes;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;
class FinePaymentConfigurationsController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$finepaymentconfigurationsdata['loanproducts']=LoanProducts::all();
		$finepaymentconfigurationsdata['accounts']=Accounts::all();
		$finepaymentconfigurationsdata['accounts']=Accounts::all();
		$finepaymentconfigurationsdata['paymentmodes']=PaymentModes::all();
		$finepaymentconfigurationsdata['list']=FinePaymentConfigurations::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','FinePaymentConfigurations']])->get();
		$finepaymentconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($finepaymentconfigurationsdata['usersaccountsroles'][0]['_add']==0&&$finepaymentconfigurationsdata['usersaccountsroles'][0]['_list']==0&&$finepaymentconfigurationsdata['usersaccountsroles'][0]['_edit']==0&&$finepaymentconfigurationsdata['usersaccountsroles'][0]['_edit']==0&&$finepaymentconfigurationsdata['usersaccountsroles'][0]['_show']==0&&$finepaymentconfigurationsdata['usersaccountsroles'][0]['_delete']==0&&$finepaymentconfigurationsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('finepaymentconfigurationsdata'));
		}else{
			return view('admin.fine_payment_configurations.index',compact('finepaymentconfigurationsdata'));
		}
	}

	public function create(){
		$finepaymentconfigurationsdata;
		$finepaymentconfigurationsdata['loanproducts']=LoanProducts::all();
		$finepaymentconfigurationsdata['accounts']=Accounts::all();
		$finepaymentconfigurationsdata['accounts']=Accounts::all();
		$finepaymentconfigurationsdata['paymentmodes']=PaymentModes::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','FinePaymentConfigurations']])->get();
		$finepaymentconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($finepaymentconfigurationsdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('finepaymentconfigurationsdata'));
		}else{
			return view('admin.fine_payment_configurations.create',compact('finepaymentconfigurationsdata'));
		}
	}

	public function filter(Request $request){
		$finepaymentconfigurationsdata['loanproducts']=LoanProducts::all();
		$finepaymentconfigurationsdata['accounts']=Accounts::all();
		$finepaymentconfigurationsdata['accounts']=Accounts::all();
		$finepaymentconfigurationsdata['paymentmodes']=PaymentModes::all();
		$finepaymentconfigurationsdata['list']=FinePaymentConfigurations::where([['loan_product','LIKE','%'.$request->get('loan_product').'%'],['debit_account','LIKE','%'.$request->get('debit_account').'%'],['credit_account','LIKE','%'.$request->get('credit_account').'%'],['payment_mode','LIKE','%'.$request->get('payment_mode').'%'],])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','FinePaymentConfigurations']])->get();
		$finepaymentconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($finepaymentconfigurationsdata['usersaccountsroles'][0]['_add']==0&&$finepaymentconfigurationsdata['usersaccountsroles'][0]['_list']==0&&$finepaymentconfigurationsdata['usersaccountsroles'][0]['_edit']==0&&$finepaymentconfigurationsdata['usersaccountsroles'][0]['_edit']==0&&$finepaymentconfigurationsdata['usersaccountsroles'][0]['_show']==0&&$finepaymentconfigurationsdata['usersaccountsroles'][0]['_delete']==0&&$finepaymentconfigurationsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('finepaymentconfigurationsdata'));
		}else{
			return view('admin.fine_payment_configurations.index',compact('finepaymentconfigurationsdata'));
		}
	}

	public function report(){
		$finepaymentconfigurationsdata['company']=Companies::all();
		$finepaymentconfigurationsdata['list']=FinePaymentConfigurations::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','FinePaymentConfigurations']])->get();
		$finepaymentconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($finepaymentconfigurationsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('finepaymentconfigurationsdata'));
		}else{
			return view('admin.fine_payment_configurations.report',compact('finepaymentconfigurationsdata'));
		}
	}

	public function chart(){
		return view('admin.fine_payment_configurations.chart');
	}

	public function store(Request $request){
		$finepaymentconfigurations=new FinePaymentConfigurations();
		$finepaymentconfigurations->loan_product=$request->get('loan_product');
		$finepaymentconfigurations->debit_account=$request->get('debit_account');
		$finepaymentconfigurations->credit_account=$request->get('credit_account');
		$finepaymentconfigurations->payment_mode=$request->get('payment_mode');
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','FinePaymentConfigurations']])->get();
		$finepaymentconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($finepaymentconfigurationsdata['usersaccountsroles'][0]['_show']==1){
			try{
				if($finepaymentconfigurations->save()){
					$response['status']='1';
					$response['message']='fine payment configurations Added successfully';
					return json_encode($response);
			}else{
					$response['status']='0';
					$response['message']='Failed to add fine payment configurations. Please try again';
					return json_encode($response);
				}
			}
			catch(Exception $e){
					$response['status']='0';
					$response['message']='An Error occured while attempting to add fine payment configurations. Please try again';
					return json_encode($response);
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$finepaymentconfigurationsdata['loanproducts']=LoanProducts::all();
		$finepaymentconfigurationsdata['accounts']=Accounts::all();
		$finepaymentconfigurationsdata['accounts']=Accounts::all();
		$finepaymentconfigurationsdata['paymentmodes']=PaymentModes::all();
		$finepaymentconfigurationsdata['data']=FinePaymentConfigurations::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','FinePaymentConfigurations']])->get();
		$finepaymentconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($finepaymentconfigurationsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('finepaymentconfigurationsdata'));
		}else{
		return view('admin.fine_payment_configurations.edit',compact('finepaymentconfigurationsdata','id'));
		}
	}

	public function show($id){
		$finepaymentconfigurationsdata['loanproducts']=LoanProducts::all();
		$finepaymentconfigurationsdata['accounts']=Accounts::all();
		$finepaymentconfigurationsdata['accounts']=Accounts::all();
		$finepaymentconfigurationsdata['paymentmodes']=PaymentModes::all();
		$finepaymentconfigurationsdata['data']=FinePaymentConfigurations::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','FinePaymentConfigurations']])->get();
		$finepaymentconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($finepaymentconfigurationsdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('finepaymentconfigurationsdata'));
		}else{
		return view('admin.fine_payment_configurations.show',compact('finepaymentconfigurationsdata','id'));
		}
	}

	public function update(Request $request,$id){
		$finepaymentconfigurations=FinePaymentConfigurations::find($id);
		$finepaymentconfigurationsdata['loanproducts']=LoanProducts::all();
		$finepaymentconfigurationsdata['accounts']=Accounts::all();
		$finepaymentconfigurationsdata['accounts']=Accounts::all();
		$finepaymentconfigurationsdata['paymentmodes']=PaymentModes::all();
		$finepaymentconfigurations->loan_product=$request->get('loan_product');
		$finepaymentconfigurations->debit_account=$request->get('debit_account');
		$finepaymentconfigurations->credit_account=$request->get('credit_account');
		$finepaymentconfigurations->payment_mode=$request->get('payment_mode');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','FinePaymentConfigurations']])->get();
		$finepaymentconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($finepaymentconfigurationsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('finepaymentconfigurationsdata'));
		}else{
		$finepaymentconfigurations->save();
		$finepaymentconfigurationsdata['data']=FinePaymentConfigurations::find($id);
		return view('admin.fine_payment_configurations.edit',compact('finepaymentconfigurationsdata','id'));
		}
	}

	public function destroy($id){
		$finepaymentconfigurations=FinePaymentConfigurations::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','FinePaymentConfigurations']])->get();
		$finepaymentconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($finepaymentconfigurationsdata['usersaccountsroles'][0]['_delete']==1){
			$finepaymentconfigurations->delete();
		}return redirect('admin/finepaymentconfigurations')->with('success','fine payment configurations has been deleted!');
	}
}