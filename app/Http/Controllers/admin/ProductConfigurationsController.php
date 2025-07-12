<?php
/**
* @author  Wanjala Innocent Khaemba
*Controller - (manages product configurations data)
*/
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\ProductConfigurations;
use App\Companies;
use App\Modules;
use App\Users;
use App\LoanProducts;
use App\Accounts;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;
class ProductConfigurationsController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$productconfigurationsdata['loanproducts']=LoanProducts::all();
		$productconfigurationsdata['accounts']=Accounts::all();
		$productconfigurationsdata['accounts']=Accounts::all();
		$productconfigurationsdata['list']=ProductConfigurations::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ProductConfigurations']])->get();
		$productconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($productconfigurationsdata['usersaccountsroles'][0]['_add']==0&&$productconfigurationsdata['usersaccountsroles'][0]['_list']==0&&$productconfigurationsdata['usersaccountsroles'][0]['_edit']==0&&$productconfigurationsdata['usersaccountsroles'][0]['_edit']==0&&$productconfigurationsdata['usersaccountsroles'][0]['_show']==0&&$productconfigurationsdata['usersaccountsroles'][0]['_delete']==0&&$productconfigurationsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('productconfigurationsdata'));
		}else{
			return view('admin.product_configurations.index',compact('productconfigurationsdata'));
		}
	}

	public function create(){
		$productconfigurationsdata;
		$productconfigurationsdata['loanproducts']=LoanProducts::all();
		$productconfigurationsdata['accounts']=Accounts::all();
		$productconfigurationsdata['accounts']=Accounts::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ProductConfigurations']])->get();
		$productconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($productconfigurationsdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('productconfigurationsdata'));
		}else{
			return view('admin.product_configurations.create',compact('productconfigurationsdata'));
		}
	}

	public function filter(Request $request){
		$productconfigurationsdata['loanproducts']=LoanProducts::all();
		$productconfigurationsdata['accounts']=Accounts::all();
		$productconfigurationsdata['accounts']=Accounts::all();
		$productconfigurationsdata['list']=ProductConfigurations::where([['loan_product','LIKE','%'.$request->get('loan_product').'%'],['debit_account','LIKE','%'.$request->get('debit_account').'%'],['credit_account','LIKE','%'.$request->get('credit_account').'%'],])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ProductConfigurations']])->get();
		$productconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($productconfigurationsdata['usersaccountsroles'][0]['_add']==0&&$productconfigurationsdata['usersaccountsroles'][0]['_list']==0&&$productconfigurationsdata['usersaccountsroles'][0]['_edit']==0&&$productconfigurationsdata['usersaccountsroles'][0]['_edit']==0&&$productconfigurationsdata['usersaccountsroles'][0]['_show']==0&&$productconfigurationsdata['usersaccountsroles'][0]['_delete']==0&&$productconfigurationsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('productconfigurationsdata'));
		}else{
			return view('admin.product_configurations.index',compact('productconfigurationsdata'));
		}
	}

	public function report(){
		$productconfigurationsdata['company']=Companies::all();
		$productconfigurationsdata['list']=ProductConfigurations::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ProductConfigurations']])->get();
		$productconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($productconfigurationsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('productconfigurationsdata'));
		}else{
			return view('admin.product_configurations.report',compact('productconfigurationsdata'));
		}
	}

	public function chart(){
		return view('admin.product_configurations.chart');
	}

	public function store(Request $request){
		$productconfigurations=new ProductConfigurations();
		$productconfigurations->loan_product=$request->get('loan_product');
		$productconfigurations->debit_account=$request->get('debit_account');
		$productconfigurations->credit_account=$request->get('credit_account');
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ProductConfigurations']])->get();
		$productconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($productconfigurationsdata['usersaccountsroles'][0]['_show']==1){
			try{
				if($productconfigurations->save()){
					$response['status']='1';
					$response['message']='product configurations Added successfully';
					return json_encode($response);
			}else{
					$response['status']='0';
					$response['message']='Failed to add product configurations. Please try again';
					return json_encode($response);
				}
			}
			catch(Exception $e){
					$response['status']='0';
					$response['message']='An Error occured while attempting to add product configurations. Please try again';
					return json_encode($response);
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$productconfigurationsdata['loanproducts']=LoanProducts::all();
		$productconfigurationsdata['accounts']=Accounts::all();
		$productconfigurationsdata['accounts']=Accounts::all();
		$productconfigurationsdata['data']=ProductConfigurations::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ProductConfigurations']])->get();
		$productconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($productconfigurationsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('productconfigurationsdata'));
		}else{
		return view('admin.product_configurations.edit',compact('productconfigurationsdata','id'));
		}
	}

	public function show($id){
		$productconfigurationsdata['loanproducts']=LoanProducts::all();
		$productconfigurationsdata['accounts']=Accounts::all();
		$productconfigurationsdata['accounts']=Accounts::all();
		$productconfigurationsdata['data']=ProductConfigurations::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ProductConfigurations']])->get();
		$productconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($productconfigurationsdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('productconfigurationsdata'));
		}else{
		return view('admin.product_configurations.show',compact('productconfigurationsdata','id'));
		}
	}

	public function update(Request $request,$id){
		$productconfigurations=ProductConfigurations::find($id);
		$productconfigurationsdata['loanproducts']=LoanProducts::all();
		$productconfigurationsdata['accounts']=Accounts::all();
		$productconfigurationsdata['accounts']=Accounts::all();
		$productconfigurations->loan_product=$request->get('loan_product');
		$productconfigurations->debit_account=$request->get('debit_account');
		$productconfigurations->credit_account=$request->get('credit_account');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ProductConfigurations']])->get();
		$productconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($productconfigurationsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('productconfigurationsdata'));
		}else{
		$productconfigurations->save();
		$productconfigurationsdata['data']=ProductConfigurations::find($id);
		return view('admin.product_configurations.edit',compact('productconfigurationsdata','id'));
		}
	}

	public function destroy($id){
		$productconfigurations=ProductConfigurations::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ProductConfigurations']])->get();
		$productconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($productconfigurationsdata['usersaccountsroles'][0]['_delete']==1){
			$productconfigurations->delete();
		}return redirect('admin/productconfigurations')->with('success','product configurations has been deleted!');
	}
}