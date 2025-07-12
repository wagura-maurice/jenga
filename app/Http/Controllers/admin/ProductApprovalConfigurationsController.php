<?php
/**
* @author  Wanjala Innocent Khaemba
*Controller - (manages product approval configurations data)
*/
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\ProductApprovalConfigurations;
use App\Companies;
use App\Modules;
use App\Users;
use App\LoanProducts;
use App\ApprovalLevels;
use App\UsersAccounts;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;
class ProductApprovalConfigurationsController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$productapprovalconfigurationsdata['loanproducts']=LoanProducts::all();
		$productapprovalconfigurationsdata['approvallevels']=ApprovalLevels::all();
		$productapprovalconfigurationsdata['usersaccounts']=UsersAccounts::all();
		$productapprovalconfigurationsdata['list']=ProductApprovalConfigurations::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ProductApprovalConfigurations']])->get();
		$productapprovalconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($productapprovalconfigurationsdata['usersaccountsroles'][0]['_add']==0&&$productapprovalconfigurationsdata['usersaccountsroles'][0]['_list']==0&&$productapprovalconfigurationsdata['usersaccountsroles'][0]['_edit']==0&&$productapprovalconfigurationsdata['usersaccountsroles'][0]['_edit']==0&&$productapprovalconfigurationsdata['usersaccountsroles'][0]['_show']==0&&$productapprovalconfigurationsdata['usersaccountsroles'][0]['_delete']==0&&$productapprovalconfigurationsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('productapprovalconfigurationsdata'));
		}else{
			return view('admin.product_approval_configurations.index',compact('productapprovalconfigurationsdata'));
		}
	}

	public function create(){
		$productapprovalconfigurationsdata;
		$productapprovalconfigurationsdata['loanproducts']=LoanProducts::all();
		$productapprovalconfigurationsdata['approvallevels']=ApprovalLevels::all();
		$productapprovalconfigurationsdata['usersaccounts']=UsersAccounts::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ProductApprovalConfigurations']])->get();
		$productapprovalconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($productapprovalconfigurationsdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('productapprovalconfigurationsdata'));
		}else{
			return view('admin.product_approval_configurations.create',compact('productapprovalconfigurationsdata'));
		}
	}

	public function filter(Request $request){
		$productapprovalconfigurationsdata['loanproducts']=LoanProducts::all();
		$productapprovalconfigurationsdata['approvallevels']=ApprovalLevels::all();
		$productapprovalconfigurationsdata['usersaccounts']=UsersAccounts::all();
		$productapprovalconfigurationsdata['list']=ProductApprovalConfigurations::where([['loan_product','LIKE','%'.$request->get('loan_product').'%'],['approval_level','LIKE','%'.$request->get('approval_level').'%'],['user_account','LIKE','%'.$request->get('user_account').'%'],])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ProductApprovalConfigurations']])->get();
		$productapprovalconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($productapprovalconfigurationsdata['usersaccountsroles'][0]['_add']==0&&$productapprovalconfigurationsdata['usersaccountsroles'][0]['_list']==0&&$productapprovalconfigurationsdata['usersaccountsroles'][0]['_edit']==0&&$productapprovalconfigurationsdata['usersaccountsroles'][0]['_edit']==0&&$productapprovalconfigurationsdata['usersaccountsroles'][0]['_show']==0&&$productapprovalconfigurationsdata['usersaccountsroles'][0]['_delete']==0&&$productapprovalconfigurationsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('productapprovalconfigurationsdata'));
		}else{
			return view('admin.product_approval_configurations.index',compact('productapprovalconfigurationsdata'));
		}
	}

	public function report(){
		$productapprovalconfigurationsdata['company']=Companies::all();
		$productapprovalconfigurationsdata['list']=ProductApprovalConfigurations::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ProductApprovalConfigurations']])->get();
		$productapprovalconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($productapprovalconfigurationsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('productapprovalconfigurationsdata'));
		}else{
			return view('admin.product_approval_configurations.report',compact('productapprovalconfigurationsdata'));
		}
	}

	public function chart(){
		return view('admin.product_approval_configurations.chart');
	}

	public function store(Request $request){
		$productapprovalconfigurations=new ProductApprovalConfigurations();
		$productapprovalconfigurations->loan_product=$request->get('loan_product');
		$productapprovalconfigurations->approval_level=$request->get('approval_level');
		$productapprovalconfigurations->user_account=$request->get('user_account');
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ProductApprovalConfigurations']])->get();
		$productapprovalconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($productapprovalconfigurationsdata['usersaccountsroles'][0]['_show']==1){
			try{
				if($productapprovalconfigurations->save()){
					$response['status']='1';
					$response['message']='product approval configurations Added successfully';
					return json_encode($response);
			}else{
					$response['status']='0';
					$response['message']='Failed to add product approval configurations. Please try again';
					return json_encode($response);
				}
			}
			catch(Exception $e){
					$response['status']='0';
					$response['message']='An Error occured while attempting to add product approval configurations. Please try again';
					return json_encode($response);
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$productapprovalconfigurationsdata['loanproducts']=LoanProducts::all();
		$productapprovalconfigurationsdata['approvallevels']=ApprovalLevels::all();
		$productapprovalconfigurationsdata['usersaccounts']=UsersAccounts::all();
		$productapprovalconfigurationsdata['data']=ProductApprovalConfigurations::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ProductApprovalConfigurations']])->get();
		$productapprovalconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($productapprovalconfigurationsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('productapprovalconfigurationsdata'));
		}else{
		return view('admin.product_approval_configurations.edit',compact('productapprovalconfigurationsdata','id'));
		}
	}

	public function show($id){
		$productapprovalconfigurationsdata['loanproducts']=LoanProducts::all();
		$productapprovalconfigurationsdata['approvallevels']=ApprovalLevels::all();
		$productapprovalconfigurationsdata['usersaccounts']=UsersAccounts::all();
		$productapprovalconfigurationsdata['data']=ProductApprovalConfigurations::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ProductApprovalConfigurations']])->get();
		$productapprovalconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($productapprovalconfigurationsdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('productapprovalconfigurationsdata'));
		}else{
		return view('admin.product_approval_configurations.show',compact('productapprovalconfigurationsdata','id'));
		}
	}

	public function update(Request $request,$id){
		$productapprovalconfigurations=ProductApprovalConfigurations::find($id);
		$productapprovalconfigurationsdata['loanproducts']=LoanProducts::all();
		$productapprovalconfigurationsdata['approvallevels']=ApprovalLevels::all();
		$productapprovalconfigurationsdata['usersaccounts']=UsersAccounts::all();
		$productapprovalconfigurations->loan_product=$request->get('loan_product');
		$productapprovalconfigurations->approval_level=$request->get('approval_level');
		$productapprovalconfigurations->user_account=$request->get('user_account');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ProductApprovalConfigurations']])->get();
		$productapprovalconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($productapprovalconfigurationsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('productapprovalconfigurationsdata'));
		}else{
		$productapprovalconfigurations->save();
		$productapprovalconfigurationsdata['data']=ProductApprovalConfigurations::find($id);
		return view('admin.product_approval_configurations.edit',compact('productapprovalconfigurationsdata','id'));
		}
	}

	public function destroy($id){
		$productapprovalconfigurations=ProductApprovalConfigurations::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ProductApprovalConfigurations']])->get();
		$productapprovalconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($productapprovalconfigurationsdata['usersaccountsroles'][0]['_delete']==1){
			$productapprovalconfigurations->delete();
		}return redirect('admin/productapprovalconfigurations')->with('success','product approval configurations has been deleted!');
	}
}