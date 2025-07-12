<?php
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\LoanProductDisbursementConfigurations;
use App\Companies;
use App\Modules;
use App\Users;
use App\LoanProducts;
use App\DisbursementModes;
use App\Accounts;
use App\Accounts;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;
class LoanProductDisbursementConfigurationsController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$loanproductdisbursementconfigurationsdata['loanproducts']=LoanProducts::all();
		$loanproductdisbursementconfigurationsdata['disbursementmodes']=DisbursementModes::all();
		$loanproductdisbursementconfigurationsdata['accounts']=Accounts::all();
		$loanproductdisbursementconfigurationsdata['accounts']=Accounts::all();
		$loanproductdisbursementconfigurationsdata['list']=LoanProductDisbursementConfigurations::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LoanProductDisbursementConfigurations']])->get();
		$loanproductdisbursementconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($loanproductdisbursementconfigurationsdata['usersaccountsroles'][0]['_add']==0&&$loanproductdisbursementconfigurationsdata['usersaccountsroles'][0]['_list']==0&&$loanproductdisbursementconfigurationsdata['usersaccountsroles'][0]['_edit']==0&&$loanproductdisbursementconfigurationsdata['usersaccountsroles'][0]['_edit']==0&&$loanproductdisbursementconfigurationsdata['usersaccountsroles'][0]['_show']==0&&$loanproductdisbursementconfigurationsdata['usersaccountsroles'][0]['_delete']==0&&$loanproductdisbursementconfigurationsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('loanproductdisbursementconfigurationsdata'));
		}else{
			return view('admin.loan_product_disbursement_configurations.index',compact('loanproductdisbursementconfigurationsdata'));
		}
	}

	public function create(){
		$loanproductdisbursementconfigurationsdata;
		$loanproductdisbursementconfigurationsdata['loanproducts']=LoanProducts::all();
		$loanproductdisbursementconfigurationsdata['disbursementmodes']=DisbursementModes::all();
		$loanproductdisbursementconfigurationsdata['accounts']=Accounts::all();
		$loanproductdisbursementconfigurationsdata['accounts']=Accounts::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LoanProductDisbursementConfigurations']])->get();
		$loanproductdisbursementconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($loanproductdisbursementconfigurationsdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('loanproductdisbursementconfigurationsdata'));
		}else{
			return view('admin.loan_product_disbursement_configurations.create',compact('loanproductdisbursementconfigurationsdata'));
		}
	}

	public function filter(Request $request){
		$loanproductdisbursementconfigurationsdata['loanproducts']=LoanProducts::all();
		$loanproductdisbursementconfigurationsdata['disbursementmodes']=DisbursementModes::all();
		$loanproductdisbursementconfigurationsdata['accounts']=Accounts::all();
		$loanproductdisbursementconfigurationsdata['accounts']=Accounts::all();
		$loanproductdisbursementconfigurationsdata['list']=LoanProductDisbursementConfigurations::where([['loan_product','LIKE','%'.$request->get('loan_product').'%'],['mode_of_disbursement','LIKE','%'.$request->get('mode_of_disbursement').'%'],['debit_account','LIKE','%'.$request->get('debit_account').'%'],['credit_account','LIKE','%'.$request->get('credit_account').'%'],])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LoanProductDisbursementConfigurations']])->get();
		$loanproductdisbursementconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($loanproductdisbursementconfigurationsdata['usersaccountsroles'][0]['_add']==0&&$loanproductdisbursementconfigurationsdata['usersaccountsroles'][0]['_list']==0&&$loanproductdisbursementconfigurationsdata['usersaccountsroles'][0]['_edit']==0&&$loanproductdisbursementconfigurationsdata['usersaccountsroles'][0]['_edit']==0&&$loanproductdisbursementconfigurationsdata['usersaccountsroles'][0]['_show']==0&&$loanproductdisbursementconfigurationsdata['usersaccountsroles'][0]['_delete']==0&&$loanproductdisbursementconfigurationsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('loanproductdisbursementconfigurationsdata'));
		}else{
			return view('admin.loan_product_disbursement_configurations.index',compact('loanproductdisbursementconfigurationsdata'));
		}
	}

	public function report(){
		$loanproductdisbursementconfigurationsdata['company']=Companies::all();
		$loanproductdisbursementconfigurationsdata['list']=LoanProductDisbursementConfigurations::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LoanProductDisbursementConfigurations']])->get();
		$loanproductdisbursementconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($loanproductdisbursementconfigurationsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('loanproductdisbursementconfigurationsdata'));
		}else{
			return view('admin.loan_product_disbursement_configurations.report',compact('loanproductdisbursementconfigurationsdata'));
		}
	}

	public function chart(){
		return view('admin.loan_product_disbursement_configurations.chart');
	}

	public function store(Request $request){
		$loanproductdisbursementconfigurations=new LoanProductDisbursementConfigurations();
		$loanproductdisbursementconfigurations->loan_product=$request->get('loan_product');
		$loanproductdisbursementconfigurations->mode_of_disbursement=$request->get('mode_of_disbursement');
		$loanproductdisbursementconfigurations->debit_account=$request->get('debit_account');
		$loanproductdisbursementconfigurations->credit_account=$request->get('credit_account');
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LoanProductDisbursementConfigurations']])->get();
		$loanproductdisbursementconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($loanproductdisbursementconfigurationsdata['usersaccountsroles'][0]['_show']==1){
			try{
				if($loanproductdisbursementconfigurations->save()){
					$response['status']='1';
					$response['message']='loan product disbursement configurations Added successfully';
					return json_encode($response);
			}else{
					$response['status']='0';
					$response['message']='Failed to add loan product disbursement configurations. Please try again';
					return json_encode($response);
				}
			}
			catch(Exception $e){
					$response['status']='0';
					$response['message']='An Error occured while attempting to add loan product disbursement configurations. Please try again';
					return json_encode($response);
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$loanproductdisbursementconfigurationsdata['loanproducts']=LoanProducts::all();
		$loanproductdisbursementconfigurationsdata['disbursementmodes']=DisbursementModes::all();
		$loanproductdisbursementconfigurationsdata['accounts']=Accounts::all();
		$loanproductdisbursementconfigurationsdata['accounts']=Accounts::all();
		$loanproductdisbursementconfigurationsdata['data']=LoanProductDisbursementConfigurations::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LoanProductDisbursementConfigurations']])->get();
		$loanproductdisbursementconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($loanproductdisbursementconfigurationsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('loanproductdisbursementconfigurationsdata'));
		}else{
		return view('admin.loan_product_disbursement_configurations.edit',compact('loanproductdisbursementconfigurationsdata','id'));
		}
	}

	public function show($id){
		$loanproductdisbursementconfigurationsdata['loanproducts']=LoanProducts::all();
		$loanproductdisbursementconfigurationsdata['disbursementmodes']=DisbursementModes::all();
		$loanproductdisbursementconfigurationsdata['accounts']=Accounts::all();
		$loanproductdisbursementconfigurationsdata['accounts']=Accounts::all();
		$loanproductdisbursementconfigurationsdata['data']=LoanProductDisbursementConfigurations::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LoanProductDisbursementConfigurations']])->get();
		$loanproductdisbursementconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($loanproductdisbursementconfigurationsdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('loanproductdisbursementconfigurationsdata'));
		}else{
		return view('admin.loan_product_disbursement_configurations.show',compact('loanproductdisbursementconfigurationsdata','id'));
		}
	}

	public function update(Request $request,$id){
		$loanproductdisbursementconfigurations=LoanProductDisbursementConfigurations::find($id);
		$loanproductdisbursementconfigurations->loan_product=$request->get('loan_product');
		$loanproductdisbursementconfigurations->mode_of_disbursement=$request->get('mode_of_disbursement');
		$loanproductdisbursementconfigurations->debit_account=$request->get('debit_account');
		$loanproductdisbursementconfigurations->credit_account=$request->get('credit_account');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LoanProductDisbursementConfigurations']])->get();
		$loanproductdisbursementconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($loanproductdisbursementconfigurationsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('loanproductdisbursementconfigurationsdata'));
		}else{
		$loanproductdisbursementconfigurations->save();
		$loanproductdisbursementconfigurationsdata['data']=LoanProductDisbursementConfigurations::find($id);
		return view('admin.loan_product_disbursement_configurations.edit',compact('loanproductdisbursementconfigurationsdata','id'));
		}
	}

	public function destroy($id){
		$loanproductdisbursementconfigurations=LoanProductDisbursementConfigurations::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LoanProductDisbursementConfigurations']])->get();
		$loanproductdisbursementconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($loanproductdisbursementconfigurationsdata['usersaccountsroles'][0]['_delete']==1){
			$loanproductdisbursementconfigurations->delete();
		}return redirect('admin/loanproductdisbursementconfigurations')->with('success','loan product disbursement configurations has been deleted!');
	}
}