<?php
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\ProductInterestConfigurations;
use App\Companies;
use App\Modules;
use App\Users;
use App\LoanProducts;
use App\InterestPaymentMethods;
use App\PaymentModes;
use App\Accounts;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;
class ProductInterestConfigurationsController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$productinterestconfigurationsdata['loanproducts']=LoanProducts::all();
		$productinterestconfigurationsdata['interestpaymentmethods']=InterestPaymentMethods::all();
		$productinterestconfigurationsdata['paymentmodes']=PaymentModes::all();
		$productinterestconfigurationsdata['accounts']=Accounts::all();
		$productinterestconfigurationsdata['accounts']=Accounts::all();
		$productinterestconfigurationsdata['list']=ProductInterestConfigurations::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ProductInterestConfigurations']])->get();
		$productinterestconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($productinterestconfigurationsdata['usersaccountsroles'][0]['_add']==0&&$productinterestconfigurationsdata['usersaccountsroles'][0]['_list']==0&&$productinterestconfigurationsdata['usersaccountsroles'][0]['_edit']==0&&$productinterestconfigurationsdata['usersaccountsroles'][0]['_edit']==0&&$productinterestconfigurationsdata['usersaccountsroles'][0]['_show']==0&&$productinterestconfigurationsdata['usersaccountsroles'][0]['_delete']==0&&$productinterestconfigurationsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('productinterestconfigurationsdata'));
		}else{
			return view('admin.product_interest_configurations.index',compact('productinterestconfigurationsdata'));
		}
	}

	public function create(){
		$productinterestconfigurationsdata;
		$productinterestconfigurationsdata['loanproducts']=LoanProducts::all();
		$productinterestconfigurationsdata['interestpaymentmethods']=InterestPaymentMethods::all();
		$productinterestconfigurationsdata['paymentmodes']=PaymentModes::all();
		$productinterestconfigurationsdata['accounts']=Accounts::all();
		$productinterestconfigurationsdata['accounts']=Accounts::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ProductInterestConfigurations']])->get();
		$productinterestconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($productinterestconfigurationsdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('productinterestconfigurationsdata'));
		}else{
			return view('admin.product_interest_configurations.create',compact('productinterestconfigurationsdata'));
		}
	}

	public function filter(Request $request){
		$productinterestconfigurationsdata['loanproducts']=LoanProducts::all();
		$productinterestconfigurationsdata['interestpaymentmethods']=InterestPaymentMethods::all();
		$productinterestconfigurationsdata['paymentmodes']=PaymentModes::all();
		$productinterestconfigurationsdata['accounts']=Accounts::all();
		$productinterestconfigurationsdata['accounts']=Accounts::all();
		$productinterestconfigurationsdata['list']=ProductInterestConfigurations::where([['loan_product','LIKE','%'.$request->get('loan_product').'%'],['interest_payment_method','LIKE','%'.$request->get('interest_payment_method').'%'],['payment_mode','LIKE','%'.$request->get('payment_mode').'%'],['debit_account','LIKE','%'.$request->get('debit_account').'%'],['credit_account','LIKE','%'.$request->get('credit_account').'%'],])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ProductInterestConfigurations']])->get();
		$productinterestconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($productinterestconfigurationsdata['usersaccountsroles'][0]['_add']==0&&$productinterestconfigurationsdata['usersaccountsroles'][0]['_list']==0&&$productinterestconfigurationsdata['usersaccountsroles'][0]['_edit']==0&&$productinterestconfigurationsdata['usersaccountsroles'][0]['_edit']==0&&$productinterestconfigurationsdata['usersaccountsroles'][0]['_show']==0&&$productinterestconfigurationsdata['usersaccountsroles'][0]['_delete']==0&&$productinterestconfigurationsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('productinterestconfigurationsdata'));
		}else{
			return view('admin.product_interest_configurations.index',compact('productinterestconfigurationsdata'));
		}
	}

	public function report(){
		$productinterestconfigurationsdata['company']=Companies::all();
		$productinterestconfigurationsdata['list']=ProductInterestConfigurations::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ProductInterestConfigurations']])->get();
		$productinterestconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($productinterestconfigurationsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('productinterestconfigurationsdata'));
		}else{
			return view('admin.product_interest_configurations.report',compact('productinterestconfigurationsdata'));
		}
	}

	public function chart(){
		return view('admin.product_interest_configurations.chart');
	}

	public function store(Request $request){
		$productinterestconfigurations=new ProductInterestConfigurations();
		$productinterestconfigurations->loan_product=$request->get('loan_product');
		$productinterestconfigurations->interest_payment_method=$request->get('interest_payment_method');
		$productinterestconfigurations->payment_mode=$request->get('payment_mode');
		$productinterestconfigurations->debit_account=$request->get('debit_account');
		$productinterestconfigurations->credit_account=$request->get('credit_account');
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ProductInterestConfigurations']])->get();
		$productinterestconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($productinterestconfigurationsdata['usersaccountsroles'][0]['_show']==1){
			try{
				if($productinterestconfigurations->save()){
					$response['status']='1';
					$response['message']='product interest configurations Added successfully';
					return json_encode($response);
			}else{
					$response['status']='0';
					$response['message']='Failed to add product interest configurations. Please try again';
					return json_encode($response);
				}
			}
			catch(Exception $e){
					$response['status']='0';
					$response['message']='An Error occured while attempting to add product interest configurations. Please try again';
					return json_encode($response);
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$productinterestconfigurationsdata['loanproducts']=LoanProducts::all();
		$productinterestconfigurationsdata['interestpaymentmethods']=InterestPaymentMethods::all();
		$productinterestconfigurationsdata['paymentmodes']=PaymentModes::all();
		$productinterestconfigurationsdata['accounts']=Accounts::all();
		$productinterestconfigurationsdata['accounts']=Accounts::all();
		$productinterestconfigurationsdata['data']=ProductInterestConfigurations::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ProductInterestConfigurations']])->get();
		$productinterestconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($productinterestconfigurationsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('productinterestconfigurationsdata'));
		}else{
		return view('admin.product_interest_configurations.edit',compact('productinterestconfigurationsdata','id'));
		}
	}

	public function show($id){
		$productinterestconfigurationsdata['loanproducts']=LoanProducts::all();
		$productinterestconfigurationsdata['interestpaymentmethods']=InterestPaymentMethods::all();
		$productinterestconfigurationsdata['paymentmodes']=PaymentModes::all();
		$productinterestconfigurationsdata['accounts']=Accounts::all();
		$productinterestconfigurationsdata['accounts']=Accounts::all();
		$productinterestconfigurationsdata['data']=ProductInterestConfigurations::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ProductInterestConfigurations']])->get();
		$productinterestconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($productinterestconfigurationsdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('productinterestconfigurationsdata'));
		}else{
		return view('admin.product_interest_configurations.show',compact('productinterestconfigurationsdata','id'));
		}
	}

	public function update(Request $request,$id){
		$productinterestconfigurations=ProductInterestConfigurations::find($id);
		$productinterestconfigurationsdata['loanproducts']=LoanProducts::all();
		$productinterestconfigurationsdata['interestpaymentmethods']=InterestPaymentMethods::all();
		$productinterestconfigurationsdata['paymentmodes']=PaymentModes::all();
		$productinterestconfigurationsdata['accounts']=Accounts::all();
		$productinterestconfigurationsdata['accounts']=Accounts::all();
		$productinterestconfigurations->loan_product=$request->get('loan_product');
		$productinterestconfigurations->interest_payment_method=$request->get('interest_payment_method');
		$productinterestconfigurations->payment_mode=$request->get('payment_mode');
		$productinterestconfigurations->debit_account=$request->get('debit_account');
		$productinterestconfigurations->credit_account=$request->get('credit_account');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ProductInterestConfigurations']])->get();
		$productinterestconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($productinterestconfigurationsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('productinterestconfigurationsdata'));
		}else{
		$productinterestconfigurations->save();
		$productinterestconfigurationsdata['data']=ProductInterestConfigurations::find($id);
		return view('admin.product_interest_configurations.edit',compact('productinterestconfigurationsdata','id'));
		}
	}

	public function destroy($id){
		$productinterestconfigurations=ProductInterestConfigurations::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ProductInterestConfigurations']])->get();
		$productinterestconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($productinterestconfigurationsdata['usersaccountsroles'][0]['_delete']==1){
			$productinterestconfigurations->delete();
		}return redirect('admin/productinterestconfigurations')->with('success','product interest configurations has been deleted!');
	}
}