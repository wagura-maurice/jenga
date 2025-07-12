<?php
/**
* @author  Wanjala Innocent Khaemba
*Controller - (Product Payment Configurations)
*/
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\ProductPaymentConfigurations;
use App\Companies;
use App\Modules;
use App\Users;
use App\Products;
use App\PaymentModes;
use App\Accounts;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;
class ProductPaymentConfigurationsController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$productpaymentconfigurationsdata['products']=Products::all();
		$productpaymentconfigurationsdata['paymentmodes']=PaymentModes::all();
		$productpaymentconfigurationsdata['accounts']=Accounts::all();
		$productpaymentconfigurationsdata['accounts']=Accounts::all();
		$productpaymentconfigurationsdata['list']=ProductPaymentConfigurations::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ProductPaymentConfigurations']])->get();
		$productpaymentconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($productpaymentconfigurationsdata['usersaccountsroles'][0]['_add']==0&&$productpaymentconfigurationsdata['usersaccountsroles'][0]['_list']==0&&$productpaymentconfigurationsdata['usersaccountsroles'][0]['_edit']==0&&$productpaymentconfigurationsdata['usersaccountsroles'][0]['_edit']==0&&$productpaymentconfigurationsdata['usersaccountsroles'][0]['_show']==0&&$productpaymentconfigurationsdata['usersaccountsroles'][0]['_delete']==0&&$productpaymentconfigurationsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('productpaymentconfigurationsdata'));
		}else{
			return view('admin.product_payment_configurations.index',compact('productpaymentconfigurationsdata'));
		}
	}

	public function create(){
		$productpaymentconfigurationsdata;
		$productpaymentconfigurationsdata['products']=Products::all();
		$productpaymentconfigurationsdata['paymentmodes']=PaymentModes::all();
		$productpaymentconfigurationsdata['accounts']=Accounts::all();
		$productpaymentconfigurationsdata['accounts']=Accounts::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ProductPaymentConfigurations']])->get();
		$productpaymentconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($productpaymentconfigurationsdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('productpaymentconfigurationsdata'));
		}else{
			return view('admin.product_payment_configurations.create',compact('productpaymentconfigurationsdata'));
		}
	}

	public function filter(Request $request){
		$productpaymentconfigurationsdata['products']=Products::all();
		$productpaymentconfigurationsdata['paymentmodes']=PaymentModes::all();
		$productpaymentconfigurationsdata['accounts']=Accounts::all();
		$productpaymentconfigurationsdata['accounts']=Accounts::all();
		$productpaymentconfigurationsdata['list']=ProductPaymentConfigurations::where([['prodcuct','LIKE','%'.$request->get('prodcuct').'%'],['payment_mode','LIKE','%'.$request->get('payment_mode').'%'],['debit_account','LIKE','%'.$request->get('debit_account').'%'],['credit_account','LIKE','%'.$request->get('credit_account').'%'],])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ProductPaymentConfigurations']])->get();
		$productpaymentconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($productpaymentconfigurationsdata['usersaccountsroles'][0]['_add']==0&&$productpaymentconfigurationsdata['usersaccountsroles'][0]['_list']==0&&$productpaymentconfigurationsdata['usersaccountsroles'][0]['_edit']==0&&$productpaymentconfigurationsdata['usersaccountsroles'][0]['_edit']==0&&$productpaymentconfigurationsdata['usersaccountsroles'][0]['_show']==0&&$productpaymentconfigurationsdata['usersaccountsroles'][0]['_delete']==0&&$productpaymentconfigurationsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('productpaymentconfigurationsdata'));
		}else{
			return view('admin.product_payment_configurations.index',compact('productpaymentconfigurationsdata'));
		}
	}

	public function report(){
		$productpaymentconfigurationsdata['company']=Companies::all();
		$productpaymentconfigurationsdata['list']=ProductPaymentConfigurations::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ProductPaymentConfigurations']])->get();
		$productpaymentconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($productpaymentconfigurationsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('productpaymentconfigurationsdata'));
		}else{
			return view('admin.product_payment_configurations.report',compact('productpaymentconfigurationsdata'));
		}
	}

	public function chart(){
		return view('admin.product_payment_configurations.chart');
	}

	public function store(Request $request){
		$productpaymentconfigurations=new ProductPaymentConfigurations();
		$productpaymentconfigurations->prodcuct=$request->get('prodcuct');
		$productpaymentconfigurations->payment_mode=$request->get('payment_mode');
		$productpaymentconfigurations->debit_account=$request->get('debit_account');
		$productpaymentconfigurations->credit_account=$request->get('credit_account');
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ProductPaymentConfigurations']])->get();
		$productpaymentconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($productpaymentconfigurationsdata['usersaccountsroles'][0]['_show']==1){
			try{
				if($productpaymentconfigurations->save()){
					$response['status']='1';
					$response['message']='Product Payment Configurations Added successfully';
					return json_encode($response);
			}else{
					$response['status']='0';
					$response['message']='Failed to add Product Payment Configurations. Please try again';
					return json_encode($response);
				}
			}
			catch(Exception $e){
					$response['status']='0';
					$response['message']='An Error occured while attempting to add Product Payment Configurations. Please try again';
					return json_encode($response);
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$productpaymentconfigurationsdata['products']=Products::all();
		$productpaymentconfigurationsdata['paymentmodes']=PaymentModes::all();
		$productpaymentconfigurationsdata['accounts']=Accounts::all();
		$productpaymentconfigurationsdata['accounts']=Accounts::all();
		$productpaymentconfigurationsdata['data']=ProductPaymentConfigurations::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ProductPaymentConfigurations']])->get();
		$productpaymentconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($productpaymentconfigurationsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('productpaymentconfigurationsdata'));
		}else{
		return view('admin.product_payment_configurations.edit',compact('productpaymentconfigurationsdata','id'));
		}
	}

	public function show($id){
		$productpaymentconfigurationsdata['products']=Products::all();
		$productpaymentconfigurationsdata['paymentmodes']=PaymentModes::all();
		$productpaymentconfigurationsdata['accounts']=Accounts::all();
		$productpaymentconfigurationsdata['accounts']=Accounts::all();
		$productpaymentconfigurationsdata['data']=ProductPaymentConfigurations::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ProductPaymentConfigurations']])->get();
		$productpaymentconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($productpaymentconfigurationsdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('productpaymentconfigurationsdata'));
		}else{
		return view('admin.product_payment_configurations.show',compact('productpaymentconfigurationsdata','id'));
		}
	}

	public function update(Request $request,$id){
		$productpaymentconfigurations=ProductPaymentConfigurations::find($id);
		$productpaymentconfigurationsdata['products']=Products::all();
		$productpaymentconfigurationsdata['paymentmodes']=PaymentModes::all();
		$productpaymentconfigurationsdata['accounts']=Accounts::all();
		$productpaymentconfigurationsdata['accounts']=Accounts::all();
		$productpaymentconfigurations->prodcuct=$request->get('prodcuct');
		$productpaymentconfigurations->payment_mode=$request->get('payment_mode');
		$productpaymentconfigurations->debit_account=$request->get('debit_account');
		$productpaymentconfigurations->credit_account=$request->get('credit_account');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ProductPaymentConfigurations']])->get();
		$productpaymentconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($productpaymentconfigurationsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('productpaymentconfigurationsdata'));
		}else{
		$productpaymentconfigurations->save();
		$productpaymentconfigurationsdata['data']=ProductPaymentConfigurations::find($id);
		return view('admin.product_payment_configurations.edit',compact('productpaymentconfigurationsdata','id'));
		}
	}

	public function destroy($id){
		$productpaymentconfigurations=ProductPaymentConfigurations::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ProductPaymentConfigurations']])->get();
		$productpaymentconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($productpaymentconfigurationsdata['usersaccountsroles'][0]['_delete']==1){
			$productpaymentconfigurations->delete();
		}return redirect('admin/productpaymentconfigurations')->with('success','Product Payment Configurations has been deleted!');
	}
}