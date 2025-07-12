<?php
/**
* @author  Wanjala Innocent Khaemba
*Controller - (manages product fine configurations data)
*/
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\ProductFineConfigurations;
use App\Companies;
use App\Modules;
use App\Users;
use App\LoanProducts;
use App\Accounts;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;
class ProductFineConfigurationsController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$productfineconfigurationsdata['loanproducts']=LoanProducts::all();
		$productfineconfigurationsdata['accounts']=Accounts::all();
		$productfineconfigurationsdata['accounts']=Accounts::all();
		$productfineconfigurationsdata['list']=ProductFineConfigurations::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ProductFineConfigurations']])->get();
		$productfineconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($productfineconfigurationsdata['usersaccountsroles'][0]['_add']==0&&$productfineconfigurationsdata['usersaccountsroles'][0]['_list']==0&&$productfineconfigurationsdata['usersaccountsroles'][0]['_edit']==0&&$productfineconfigurationsdata['usersaccountsroles'][0]['_edit']==0&&$productfineconfigurationsdata['usersaccountsroles'][0]['_show']==0&&$productfineconfigurationsdata['usersaccountsroles'][0]['_delete']==0&&$productfineconfigurationsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('productfineconfigurationsdata'));
		}else{
			return view('admin.product_fine_configurations.index',compact('productfineconfigurationsdata'));
		}
	}

	public function create(){
		$productfineconfigurationsdata;
		$productfineconfigurationsdata['loanproducts']=LoanProducts::all();
		$productfineconfigurationsdata['accounts']=Accounts::all();
		$productfineconfigurationsdata['accounts']=Accounts::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ProductFineConfigurations']])->get();
		$productfineconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($productfineconfigurationsdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('productfineconfigurationsdata'));
		}else{
			return view('admin.product_fine_configurations.create',compact('productfineconfigurationsdata'));
		}
	}

	public function filter(Request $request){
		$productfineconfigurationsdata['loanproducts']=LoanProducts::all();
		$productfineconfigurationsdata['accounts']=Accounts::all();
		$productfineconfigurationsdata['accounts']=Accounts::all();
		$productfineconfigurationsdata['list']=ProductFineConfigurations::where([['loan_product','LIKE','%'.$request->get('loan_product').'%'],['debit_account','LIKE','%'.$request->get('debit_account').'%'],['credit_account','LIKE','%'.$request->get('credit_account').'%'],])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ProductFineConfigurations']])->get();
		$productfineconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($productfineconfigurationsdata['usersaccountsroles'][0]['_add']==0&&$productfineconfigurationsdata['usersaccountsroles'][0]['_list']==0&&$productfineconfigurationsdata['usersaccountsroles'][0]['_edit']==0&&$productfineconfigurationsdata['usersaccountsroles'][0]['_edit']==0&&$productfineconfigurationsdata['usersaccountsroles'][0]['_show']==0&&$productfineconfigurationsdata['usersaccountsroles'][0]['_delete']==0&&$productfineconfigurationsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('productfineconfigurationsdata'));
		}else{
			return view('admin.product_fine_configurations.index',compact('productfineconfigurationsdata'));
		}
	}

	public function report(){
		$productfineconfigurationsdata['company']=Companies::all();
		$productfineconfigurationsdata['list']=ProductFineConfigurations::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ProductFineConfigurations']])->get();
		$productfineconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($productfineconfigurationsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('productfineconfigurationsdata'));
		}else{
			return view('admin.product_fine_configurations.report',compact('productfineconfigurationsdata'));
		}
	}

	public function chart(){
		return view('admin.product_fine_configurations.chart');
	}

	public function store(Request $request){
		$productfineconfigurations=new ProductFineConfigurations();
		$productfineconfigurations->loan_product=$request->get('loan_product');
		$productfineconfigurations->debit_account=$request->get('debit_account');
		$productfineconfigurations->credit_account=$request->get('credit_account');
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ProductFineConfigurations']])->get();
		$productfineconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($productfineconfigurationsdata['usersaccountsroles'][0]['_show']==1){
			try{
				if($productfineconfigurations->save()){
					$response['status']='1';
					$response['message']='product fine configurations Added successfully';
					return json_encode($response);
			}else{
					$response['status']='0';
					$response['message']='Failed to add product fine configurations. Please try again';
					return json_encode($response);
				}
			}
			catch(Exception $e){
					$response['status']='0';
					$response['message']='An Error occured while attempting to add product fine configurations. Please try again';
					return json_encode($response);
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$productfineconfigurationsdata['loanproducts']=LoanProducts::all();
		$productfineconfigurationsdata['accounts']=Accounts::all();
		$productfineconfigurationsdata['accounts']=Accounts::all();
		$productfineconfigurationsdata['data']=ProductFineConfigurations::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ProductFineConfigurations']])->get();
		$productfineconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($productfineconfigurationsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('productfineconfigurationsdata'));
		}else{
		return view('admin.product_fine_configurations.edit',compact('productfineconfigurationsdata','id'));
		}
	}

	public function show($id){
		$productfineconfigurationsdata['loanproducts']=LoanProducts::all();
		$productfineconfigurationsdata['accounts']=Accounts::all();
		$productfineconfigurationsdata['accounts']=Accounts::all();
		$productfineconfigurationsdata['data']=ProductFineConfigurations::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ProductFineConfigurations']])->get();
		$productfineconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($productfineconfigurationsdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('productfineconfigurationsdata'));
		}else{
		return view('admin.product_fine_configurations.show',compact('productfineconfigurationsdata','id'));
		}
	}

	public function update(Request $request,$id){
		$productfineconfigurations=ProductFineConfigurations::find($id);
		$productfineconfigurationsdata['loanproducts']=LoanProducts::all();
		$productfineconfigurationsdata['accounts']=Accounts::all();
		$productfineconfigurationsdata['accounts']=Accounts::all();
		$productfineconfigurations->loan_product=$request->get('loan_product');
		$productfineconfigurations->debit_account=$request->get('debit_account');
		$productfineconfigurations->credit_account=$request->get('credit_account');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ProductFineConfigurations']])->get();
		$productfineconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($productfineconfigurationsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('productfineconfigurationsdata'));
		}else{
		$productfineconfigurations->save();
		$productfineconfigurationsdata['data']=ProductFineConfigurations::find($id);
		return view('admin.product_fine_configurations.edit',compact('productfineconfigurationsdata','id'));
		}
	}

	public function destroy($id){
		$productfineconfigurations=ProductFineConfigurations::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ProductFineConfigurations']])->get();
		$productfineconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($productfineconfigurationsdata['usersaccountsroles'][0]['_delete']==1){
			$productfineconfigurations->delete();
		}return redirect('admin/productfineconfigurations')->with('success','product fine configurations has been deleted!');
	}
}