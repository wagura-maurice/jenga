<?php
/**
* @author  Wanjala Innocent Khaemba
*Controller - (manages product client types data)
*/
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\ProductClientTypeConfigurations;
use App\Companies;
use App\Modules;
use App\Users;
use App\LoanProducts;
use App\ClientTypes;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;
class ProductClientTypeConfigurationsController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$productclienttypeconfigurationsdata['loanproducts']=LoanProducts::all();
		$productclienttypeconfigurationsdata['clienttypes']=ClientTypes::all();
		$productclienttypeconfigurationsdata['list']=ProductClientTypeConfigurations::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ProductClientTypeConfigurations']])->get();
		$productclienttypeconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($productclienttypeconfigurationsdata['usersaccountsroles'][0]['_add']==0&&$productclienttypeconfigurationsdata['usersaccountsroles'][0]['_list']==0&&$productclienttypeconfigurationsdata['usersaccountsroles'][0]['_edit']==0&&$productclienttypeconfigurationsdata['usersaccountsroles'][0]['_edit']==0&&$productclienttypeconfigurationsdata['usersaccountsroles'][0]['_show']==0&&$productclienttypeconfigurationsdata['usersaccountsroles'][0]['_delete']==0&&$productclienttypeconfigurationsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('productclienttypeconfigurationsdata'));
		}else{
			return view('admin.product_client_type_configurations.index',compact('productclienttypeconfigurationsdata'));
		}
	}

	public function create(){
		$productclienttypeconfigurationsdata;
		$productclienttypeconfigurationsdata['loanproducts']=LoanProducts::all();
		$productclienttypeconfigurationsdata['clienttypes']=ClientTypes::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ProductClientTypeConfigurations']])->get();
		$productclienttypeconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($productclienttypeconfigurationsdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('productclienttypeconfigurationsdata'));
		}else{
			return view('admin.product_client_type_configurations.create',compact('productclienttypeconfigurationsdata'));
		}
	}

	public function filter(Request $request){
		$productclienttypeconfigurationsdata['loanproducts']=LoanProducts::all();
		$productclienttypeconfigurationsdata['clienttypes']=ClientTypes::all();
		$productclienttypeconfigurationsdata['list']=ProductClientTypeConfigurations::where([['loan_product','LIKE','%'.$request->get('loan_product').'%'],['client_type','LIKE','%'.$request->get('client_type').'%'],])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ProductClientTypeConfigurations']])->get();
		$productclienttypeconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($productclienttypeconfigurationsdata['usersaccountsroles'][0]['_add']==0&&$productclienttypeconfigurationsdata['usersaccountsroles'][0]['_list']==0&&$productclienttypeconfigurationsdata['usersaccountsroles'][0]['_edit']==0&&$productclienttypeconfigurationsdata['usersaccountsroles'][0]['_edit']==0&&$productclienttypeconfigurationsdata['usersaccountsroles'][0]['_show']==0&&$productclienttypeconfigurationsdata['usersaccountsroles'][0]['_delete']==0&&$productclienttypeconfigurationsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('productclienttypeconfigurationsdata'));
		}else{
			return view('admin.product_client_type_configurations.index',compact('productclienttypeconfigurationsdata'));
		}
	}

	public function report(){
		$productclienttypeconfigurationsdata['company']=Companies::all();
		$productclienttypeconfigurationsdata['list']=ProductClientTypeConfigurations::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ProductClientTypeConfigurations']])->get();
		$productclienttypeconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($productclienttypeconfigurationsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('productclienttypeconfigurationsdata'));
		}else{
			return view('admin.product_client_type_configurations.report',compact('productclienttypeconfigurationsdata'));
		}
	}

	public function chart(){
		return view('admin.product_client_type_configurations.chart');
	}

	public function store(Request $request){
		$productclienttypeconfigurations=new ProductClientTypeConfigurations();
		$productclienttypeconfigurations->loan_product=$request->get('loan_product');
		$productclienttypeconfigurations->client_type=$request->get('client_type');
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ProductClientTypeConfigurations']])->get();
		$productclienttypeconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($productclienttypeconfigurationsdata['usersaccountsroles'][0]['_show']==1){
			try{
				if($productclienttypeconfigurations->save()){
					$response['status']='1';
					$response['message']='product client type configurations Added successfully';
					return json_encode($response);
			}else{
					$response['status']='0';
					$response['message']='Failed to add product client type configurations. Please try again';
					return json_encode($response);
				}
			}
			catch(Exception $e){
					$response['status']='0';
					$response['message']='An Error occured while attempting to add product client type configurations. Please try again';
					return json_encode($response);
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$productclienttypeconfigurationsdata['loanproducts']=LoanProducts::all();
		$productclienttypeconfigurationsdata['clienttypes']=ClientTypes::all();
		$productclienttypeconfigurationsdata['data']=ProductClientTypeConfigurations::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ProductClientTypeConfigurations']])->get();
		$productclienttypeconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($productclienttypeconfigurationsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('productclienttypeconfigurationsdata'));
		}else{
		return view('admin.product_client_type_configurations.edit',compact('productclienttypeconfigurationsdata','id'));
		}
	}

	public function show($id){
		$productclienttypeconfigurationsdata['loanproducts']=LoanProducts::all();
		$productclienttypeconfigurationsdata['clienttypes']=ClientTypes::all();
		$productclienttypeconfigurationsdata['data']=ProductClientTypeConfigurations::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ProductClientTypeConfigurations']])->get();
		$productclienttypeconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($productclienttypeconfigurationsdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('productclienttypeconfigurationsdata'));
		}else{
		return view('admin.product_client_type_configurations.show',compact('productclienttypeconfigurationsdata','id'));
		}
	}

	public function update(Request $request,$id){
		$productclienttypeconfigurations=ProductClientTypeConfigurations::find($id);
		$productclienttypeconfigurationsdata['loanproducts']=LoanProducts::all();
		$productclienttypeconfigurationsdata['clienttypes']=ClientTypes::all();
		$productclienttypeconfigurations->loan_product=$request->get('loan_product');
		$productclienttypeconfigurations->client_type=$request->get('client_type');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ProductClientTypeConfigurations']])->get();
		$productclienttypeconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($productclienttypeconfigurationsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('productclienttypeconfigurationsdata'));
		}else{
		$productclienttypeconfigurations->save();
		$productclienttypeconfigurationsdata['data']=ProductClientTypeConfigurations::find($id);
		return view('admin.product_client_type_configurations.edit',compact('productclienttypeconfigurationsdata','id'));
		}
	}

	public function destroy($id){
		$productclienttypeconfigurations=ProductClientTypeConfigurations::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ProductClientTypeConfigurations']])->get();
		$productclienttypeconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($productclienttypeconfigurationsdata['usersaccountsroles'][0]['_delete']==1){
			$productclienttypeconfigurations->delete();
		}return redirect('admin/productclienttypeconfigurations')->with('success','product client type configurations has been deleted!');
	}
}