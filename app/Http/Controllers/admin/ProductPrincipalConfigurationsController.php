<?php
/**
* @author  Wanjala Innocent Khaemba
*Controller - (manages product principal configurations)
*/
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\ProductPrincipalConfigurations;
use App\Companies;
use App\Modules;
use App\Users;
use App\LoanProducts;
use App\PaymentModes;
use App\Accounts;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;

class ProductPrincipalConfigurationsController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$productprincipalconfigurationsdata['loanproducts']=LoanProducts::all();
		$productprincipalconfigurationsdata['paymentmodes']=PaymentModes::all();
		$productprincipalconfigurationsdata['accounts']=Accounts::all();
		$productprincipalconfigurationsdata['accounts']=Accounts::all();
		$productprincipalconfigurationsdata['list']=ProductPrincipalConfigurations::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ProductPrincipalConfigurations']])->get();
		$productprincipalconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($productprincipalconfigurationsdata['usersaccountsroles'][0]['_add']==0&&$productprincipalconfigurationsdata['usersaccountsroles'][0]['_list']==0&&$productprincipalconfigurationsdata['usersaccountsroles'][0]['_edit']==0&&$productprincipalconfigurationsdata['usersaccountsroles'][0]['_edit']==0&&$productprincipalconfigurationsdata['usersaccountsroles'][0]['_show']==0&&$productprincipalconfigurationsdata['usersaccountsroles'][0]['_delete']==0&&$productprincipalconfigurationsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('productprincipalconfigurationsdata'));
		}else{
			return view('admin.product_principal_configurations.index',compact('productprincipalconfigurationsdata'));
		}
	}

	public function create(){
		$productprincipalconfigurationsdata;
		$productprincipalconfigurationsdata['loanproducts']=LoanProducts::all();
		$productprincipalconfigurationsdata['paymentmodes']=PaymentModes::all();
		$productprincipalconfigurationsdata['accounts']=Accounts::all();
		$productprincipalconfigurationsdata['accounts']=Accounts::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ProductPrincipalConfigurations']])->get();
		$productprincipalconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($productprincipalconfigurationsdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('productprincipalconfigurationsdata'));
		}else{
			return view('admin.product_principal_configurations.create',compact('productprincipalconfigurationsdata'));
		}
	}

	public function filter(Request $request){
		$productprincipalconfigurationsdata['loanproducts']=LoanProducts::all();
		$productprincipalconfigurationsdata['paymentmodes']=PaymentModes::all();
		$productprincipalconfigurationsdata['accounts']=Accounts::all();
		$productprincipalconfigurationsdata['accounts']=Accounts::all();
		$productprincipalconfigurationsdata['list']=ProductPrincipalConfigurations::where([['loan_product','LIKE','%'.$request->get('loan_product').'%'],['payment_mode','LIKE','%'.$request->get('payment_mode').'%'],['debit_account','LIKE','%'.$request->get('debit_account').'%'],['credit_account','LIKE','%'.$request->get('credit_account').'%'],])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ProductPrincipalConfigurations']])->get();
		$productprincipalconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($productprincipalconfigurationsdata['usersaccountsroles'][0]['_add']==0&&$productprincipalconfigurationsdata['usersaccountsroles'][0]['_list']==0&&$productprincipalconfigurationsdata['usersaccountsroles'][0]['_edit']==0&&$productprincipalconfigurationsdata['usersaccountsroles'][0]['_edit']==0&&$productprincipalconfigurationsdata['usersaccountsroles'][0]['_show']==0&&$productprincipalconfigurationsdata['usersaccountsroles'][0]['_delete']==0&&$productprincipalconfigurationsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('productprincipalconfigurationsdata'));
		}else{
			return view('admin.product_principal_configurations.index',compact('productprincipalconfigurationsdata'));
		}
	}

	public function report(){
		$productprincipalconfigurationsdata['company']=Companies::all();
		$productprincipalconfigurationsdata['list']=ProductPrincipalConfigurations::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ProductPrincipalConfigurations']])->get();
		$productprincipalconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($productprincipalconfigurationsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('productprincipalconfigurationsdata'));
		}else{
			return view('admin.product_principal_configurations.report',compact('productprincipalconfigurationsdata'));
		}
	}

	public function chart(){
		return view('admin.product_principal_configurations.chart');
	}

	public function store(Request $request){
		$productprincipalconfigurations=new ProductPrincipalConfigurations();
		$productprincipalconfigurations->loan_product=$request->get('loan_product');
		$productprincipalconfigurations->payment_mode=$request->get('payment_mode');
		$productprincipalconfigurations->debit_account=$request->get('debit_account');
		$productprincipalconfigurations->credit_account=$request->get('credit_account');
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ProductPrincipalConfigurations']])->get();
		$productprincipalconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($productprincipalconfigurationsdata['usersaccountsroles'][0]['_show']==1){
			try{
				if($productprincipalconfigurations->save()){
					$response['status']='1';
					$response['message']='product principal configurations Added successfully';
					return json_encode($response);
			}else{
					$response['status']='0';
					$response['message']='Failed to add product principal configurations. Please try again';
					return json_encode($response);
				}
			}
			catch(Exception $e){
					$response['status']='0';
					$response['message']='An Error occured while attempting to add product principal configurations. Please try again';
					return json_encode($response);
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$productprincipalconfigurationsdata['loanproducts']=LoanProducts::all();
		$productprincipalconfigurationsdata['paymentmodes']=PaymentModes::all();
		$productprincipalconfigurationsdata['accounts']=Accounts::all();
		$productprincipalconfigurationsdata['accounts']=Accounts::all();
		$productprincipalconfigurationsdata['data']=ProductPrincipalConfigurations::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ProductPrincipalConfigurations']])->get();
		$productprincipalconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($productprincipalconfigurationsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('productprincipalconfigurationsdata'));
		}else{
		return view('admin.product_principal_configurations.edit',compact('productprincipalconfigurationsdata','id'));
		}
	}

	public function show($id){
		$productprincipalconfigurationsdata['loanproducts']=LoanProducts::all();
		$productprincipalconfigurationsdata['paymentmodes']=PaymentModes::all();
		$productprincipalconfigurationsdata['accounts']=Accounts::all();
		$productprincipalconfigurationsdata['accounts']=Accounts::all();
		$productprincipalconfigurationsdata['data']=ProductPrincipalConfigurations::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ProductPrincipalConfigurations']])->get();
		$productprincipalconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($productprincipalconfigurationsdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('productprincipalconfigurationsdata'));
		}else{
		return view('admin.product_principal_configurations.show',compact('productprincipalconfigurationsdata','id'));
		}
	}

	public function update(Request $request,$id){
		$productprincipalconfigurations=ProductPrincipalConfigurations::find($id);
		$productprincipalconfigurationsdata['loanproducts']=LoanProducts::all();
		$productprincipalconfigurationsdata['paymentmodes']=PaymentModes::all();
		$productprincipalconfigurationsdata['accounts']=Accounts::all();
		$productprincipalconfigurationsdata['accounts']=Accounts::all();
		$productprincipalconfigurations->loan_product=$request->get('loan_product');
		$productprincipalconfigurations->payment_mode=$request->get('payment_mode');
		$productprincipalconfigurations->debit_account=$request->get('debit_account');
		$productprincipalconfigurations->credit_account=$request->get('credit_account');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ProductPrincipalConfigurations']])->get();
		$productprincipalconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($productprincipalconfigurationsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('productprincipalconfigurationsdata'));
		}else{
		$productprincipalconfigurations->save();
		$productprincipalconfigurationsdata['data']=ProductPrincipalConfigurations::find($id);
		return view('admin.product_principal_configurations.edit',compact('productprincipalconfigurationsdata','id'));
		}
	}

	public function destroy($id){
		$productprincipalconfigurations=ProductPrincipalConfigurations::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ProductPrincipalConfigurations']])->get();
		$productprincipalconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($productprincipalconfigurationsdata['usersaccountsroles'][0]['_delete']==1){
			$productprincipalconfigurations->delete();
		}return redirect('admin/productprincipalconfigurations')->with('success','product principal configurations has been deleted!');
	}
}