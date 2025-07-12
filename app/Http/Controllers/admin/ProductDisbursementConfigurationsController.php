<?php
/**
* @author  Wanjala Innocent Khaemba
*Controller - ()
*/
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\ProductDisbursementConfigurations;
use App\Companies;
use App\Modules;
use App\Users;
use App\LoanProducts;
use App\DisbursementModes;
use App\Accounts;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;
class ProductDisbursementConfigurationsController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$productdisbursementconfigurationsdata['loanproducts']=LoanProducts::all();
		$productdisbursementconfigurationsdata['disbursementmodes']=DisbursementModes::all();
		$productdisbursementconfigurationsdata['accounts']=Accounts::all();
		$productdisbursementconfigurationsdata['accounts']=Accounts::all();
		$productdisbursementconfigurationsdata['list']=ProductDisbursementConfigurations::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ProductDisbursementConfigurations']])->get();
		$productdisbursementconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($productdisbursementconfigurationsdata['usersaccountsroles'][0]['_add']==0&&$productdisbursementconfigurationsdata['usersaccountsroles'][0]['_list']==0&&$productdisbursementconfigurationsdata['usersaccountsroles'][0]['_edit']==0&&$productdisbursementconfigurationsdata['usersaccountsroles'][0]['_edit']==0&&$productdisbursementconfigurationsdata['usersaccountsroles'][0]['_show']==0&&$productdisbursementconfigurationsdata['usersaccountsroles'][0]['_delete']==0&&$productdisbursementconfigurationsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('productdisbursementconfigurationsdata'));
		}else{
			return view('admin.product_disbursement_configurations.index',compact('productdisbursementconfigurationsdata'));
		}
	}

	public function create(){
		$productdisbursementconfigurationsdata;
		$productdisbursementconfigurationsdata['loanproducts']=LoanProducts::all();
		$productdisbursementconfigurationsdata['disbursementmodes']=DisbursementModes::all();
		$productdisbursementconfigurationsdata['accounts']=Accounts::all();
		$productdisbursementconfigurationsdata['accounts']=Accounts::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ProductDisbursementConfigurations']])->get();
		$productdisbursementconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($productdisbursementconfigurationsdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('productdisbursementconfigurationsdata'));
		}else{
			return view('admin.product_disbursement_configurations.create',compact('productdisbursementconfigurationsdata'));
		}
	}

	public function filter(Request $request){
		$productdisbursementconfigurationsdata['loanproducts']=LoanProducts::all();
		$productdisbursementconfigurationsdata['disbursementmodes']=DisbursementModes::all();
		$productdisbursementconfigurationsdata['accounts']=Accounts::all();
		$productdisbursementconfigurationsdata['accounts']=Accounts::all();
		$productdisbursementconfigurationsdata['list']=ProductDisbursementConfigurations::where([['loan_product','LIKE','%'.$request->get('loan_product').'%'],['disbursement_mode','LIKE','%'.$request->get('disbursement_mode').'%'],['debit_account','LIKE','%'.$request->get('debit_account').'%'],['credit_account','LIKE','%'.$request->get('credit_account').'%'],])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ProductDisbursementConfigurations']])->get();
		$productdisbursementconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($productdisbursementconfigurationsdata['usersaccountsroles'][0]['_add']==0&&$productdisbursementconfigurationsdata['usersaccountsroles'][0]['_list']==0&&$productdisbursementconfigurationsdata['usersaccountsroles'][0]['_edit']==0&&$productdisbursementconfigurationsdata['usersaccountsroles'][0]['_edit']==0&&$productdisbursementconfigurationsdata['usersaccountsroles'][0]['_show']==0&&$productdisbursementconfigurationsdata['usersaccountsroles'][0]['_delete']==0&&$productdisbursementconfigurationsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('productdisbursementconfigurationsdata'));
		}else{
			return view('admin.product_disbursement_configurations.index',compact('productdisbursementconfigurationsdata'));
		}
	}

	public function report(){
		$productdisbursementconfigurationsdata['company']=Companies::all();
		$productdisbursementconfigurationsdata['list']=ProductDisbursementConfigurations::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ProductDisbursementConfigurations']])->get();
		$productdisbursementconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($productdisbursementconfigurationsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('productdisbursementconfigurationsdata'));
		}else{
			return view('admin.product_disbursement_configurations.report',compact('productdisbursementconfigurationsdata'));
		}
	}

	public function chart(){
		return view('admin.product_disbursement_configurations.chart');
	}

	public function store(Request $request){
		$productdisbursementconfigurations=new ProductDisbursementConfigurations();
		$productdisbursementconfigurations->loan_product=$request->get('loan_product');
		$productdisbursementconfigurations->disbursement_mode=$request->get('disbursement_mode');
		$productdisbursementconfigurations->debit_account=$request->get('debit_account');
		$productdisbursementconfigurations->credit_account=$request->get('credit_account');
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ProductDisbursementConfigurations']])->get();
		$productdisbursementconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($productdisbursementconfigurationsdata['usersaccountsroles'][0]['_show']==1){
			try{
				if($productdisbursementconfigurations->save()){
					$response['status']='1';
					$response['message']='product disbursement configurations Added successfully';
					return json_encode($response);
			}else{
					$response['status']='0';
					$response['message']='Failed to add product disbursement configurations. Please try again';
					return json_encode($response);
				}
			}
			catch(Exception $e){
					$response['status']='0';
					$response['message']='An Error occured while attempting to add product disbursement configurations. Please try again';
					return json_encode($response);
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$productdisbursementconfigurationsdata['loanproducts']=LoanProducts::all();
		$productdisbursementconfigurationsdata['disbursementmodes']=DisbursementModes::all();
		$productdisbursementconfigurationsdata['accounts']=Accounts::all();
		$productdisbursementconfigurationsdata['accounts']=Accounts::all();
		$productdisbursementconfigurationsdata['data']=ProductDisbursementConfigurations::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ProductDisbursementConfigurations']])->get();
		$productdisbursementconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($productdisbursementconfigurationsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('productdisbursementconfigurationsdata'));
		}else{
		return view('admin.product_disbursement_configurations.edit',compact('productdisbursementconfigurationsdata','id'));
		}
	}

	public function show($id){
		$productdisbursementconfigurationsdata['loanproducts']=LoanProducts::all();
		$productdisbursementconfigurationsdata['disbursementmodes']=DisbursementModes::all();
		$productdisbursementconfigurationsdata['accounts']=Accounts::all();
		$productdisbursementconfigurationsdata['accounts']=Accounts::all();
		$productdisbursementconfigurationsdata['data']=ProductDisbursementConfigurations::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ProductDisbursementConfigurations']])->get();
		$productdisbursementconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($productdisbursementconfigurationsdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('productdisbursementconfigurationsdata'));
		}else{
		return view('admin.product_disbursement_configurations.show',compact('productdisbursementconfigurationsdata','id'));
		}
	}

	public function update(Request $request,$id){
		$productdisbursementconfigurations=ProductDisbursementConfigurations::find($id);
		$productdisbursementconfigurationsdata['loanproducts']=LoanProducts::all();
		$productdisbursementconfigurationsdata['disbursementmodes']=DisbursementModes::all();
		$productdisbursementconfigurationsdata['accounts']=Accounts::all();
		$productdisbursementconfigurationsdata['accounts']=Accounts::all();
		$productdisbursementconfigurations->loan_product=$request->get('loan_product');
		$productdisbursementconfigurations->disbursement_mode=$request->get('disbursement_mode');
		$productdisbursementconfigurations->debit_account=$request->get('debit_account');
		$productdisbursementconfigurations->credit_account=$request->get('credit_account');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ProductDisbursementConfigurations']])->get();
		$productdisbursementconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($productdisbursementconfigurationsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('productdisbursementconfigurationsdata'));
		}else{
		$productdisbursementconfigurations->save();
		$productdisbursementconfigurationsdata['data']=ProductDisbursementConfigurations::find($id);
		return view('admin.product_disbursement_configurations.edit',compact('productdisbursementconfigurationsdata','id'));
		}
	}

	public function destroy($id){
		$productdisbursementconfigurations=ProductDisbursementConfigurations::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ProductDisbursementConfigurations']])->get();
		$productdisbursementconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($productdisbursementconfigurationsdata['usersaccountsroles'][0]['_delete']==1){
			$productdisbursementconfigurations->delete();
		}return redirect('admin/productdisbursementconfigurations')->with('success','product disbursement configurations has been deleted!');
	}
}