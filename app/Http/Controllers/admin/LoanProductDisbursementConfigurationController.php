<?php
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\LoanProductDisbursementConfiguration;
use App\Companies;
use App\Modules;
use App\Users;
use App\LoanProducts;
use App\DisbursementModes;
use App\Accounts;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;
class LoanProductDisbursementConfigurationController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$loanproductdisbursementconfigurationdata['loanproducts']=LoanProducts::all();
		$loanproductdisbursementconfigurationdata['disbursementmodes']=DisbursementModes::all();
		$loanproductdisbursementconfigurationdata['accounts']=Accounts::all();
		$loanproductdisbursementconfigurationdata['accounts']=Accounts::all();
		$loanproductdisbursementconfigurationdata['list']=LoanProductDisbursementConfiguration::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LoanProductDisbursementConfiguration']])->get();
		$loanproductdisbursementconfigurationdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($loanproductdisbursementconfigurationdata['usersaccountsroles'][0]['_add']==0&&$loanproductdisbursementconfigurationdata['usersaccountsroles'][0]['_list']==0&&$loanproductdisbursementconfigurationdata['usersaccountsroles'][0]['_edit']==0&&$loanproductdisbursementconfigurationdata['usersaccountsroles'][0]['_edit']==0&&$loanproductdisbursementconfigurationdata['usersaccountsroles'][0]['_show']==0&&$loanproductdisbursementconfigurationdata['usersaccountsroles'][0]['_delete']==0&&$loanproductdisbursementconfigurationdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('loanproductdisbursementconfigurationdata'));
		}else{
			return view('admin.loan_product_disbursement_configuration.index',compact('loanproductdisbursementconfigurationdata'));
		}
	}

	public function create(){
		$loanproductdisbursementconfigurationdata;
		$loanproductdisbursementconfigurationdata['loanproducts']=LoanProducts::all();
		$loanproductdisbursementconfigurationdata['disbursementmodes']=DisbursementModes::all();
		$loanproductdisbursementconfigurationdata['accounts']=Accounts::all();
		$loanproductdisbursementconfigurationdata['accounts']=Accounts::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LoanProductDisbursementConfiguration']])->get();
		$loanproductdisbursementconfigurationdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($loanproductdisbursementconfigurationdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('loanproductdisbursementconfigurationdata'));
		}else{
			return view('admin.loan_product_disbursement_configuration.create',compact('loanproductdisbursementconfigurationdata'));
		}
	}

	public function filter(Request $request){
		$loanproductdisbursementconfigurationdata['loanproducts']=LoanProducts::all();
		$loanproductdisbursementconfigurationdata['disbursementmodes']=DisbursementModes::all();
		$loanproductdisbursementconfigurationdata['accounts']=Accounts::all();
		$loanproductdisbursementconfigurationdata['accounts']=Accounts::all();
		$loanproductdisbursementconfigurationdata['list']=LoanProductDisbursementConfiguration::where([['loan_product','LIKE','%'.$request->get('loan_product').'%'],['mode_of_disbursement','LIKE','%'.$request->get('mode_of_disbursement').'%'],['debit_account','LIKE','%'.$request->get('debit_account').'%'],['credit_account','LIKE','%'.$request->get('credit_account').'%'],])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LoanProductDisbursementConfiguration']])->get();
		$loanproductdisbursementconfigurationdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($loanproductdisbursementconfigurationdata['usersaccountsroles'][0]['_add']==0&&$loanproductdisbursementconfigurationdata['usersaccountsroles'][0]['_list']==0&&$loanproductdisbursementconfigurationdata['usersaccountsroles'][0]['_edit']==0&&$loanproductdisbursementconfigurationdata['usersaccountsroles'][0]['_edit']==0&&$loanproductdisbursementconfigurationdata['usersaccountsroles'][0]['_show']==0&&$loanproductdisbursementconfigurationdata['usersaccountsroles'][0]['_delete']==0&&$loanproductdisbursementconfigurationdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('loanproductdisbursementconfigurationdata'));
		}else{
			return view('admin.loan_product_disbursement_configuration.index',compact('loanproductdisbursementconfigurationdata'));
		}
	}

	public function report(){
		$loanproductdisbursementconfigurationdata['company']=Companies::all();
		$loanproductdisbursementconfigurationdata['list']=LoanProductDisbursementConfiguration::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LoanProductDisbursementConfiguration']])->get();
		$loanproductdisbursementconfigurationdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($loanproductdisbursementconfigurationdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('loanproductdisbursementconfigurationdata'));
		}else{
			return view('admin.loan_product_disbursement_configuration.report',compact('loanproductdisbursementconfigurationdata'));
		}
	}

	public function chart(){
		return view('admin.loan_product_disbursement_configuration.chart');
	}

	public function store(Request $request){
		$loanproductdisbursementconfiguration=new LoanProductDisbursementConfiguration();
		$loanproductdisbursementconfiguration->loan_product=$request->get('loan_product');
		$loanproductdisbursementconfiguration->mode_of_disbursement=$request->get('mode_of_disbursement');
		$loanproductdisbursementconfiguration->debit_account=$request->get('debit_account');
		$loanproductdisbursementconfiguration->credit_account=$request->get('credit_account');
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LoanProductDisbursementConfiguration']])->get();
		$loanproductdisbursementconfigurationdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($loanproductdisbursementconfigurationdata['usersaccountsroles'][0]['_show']==1){
			try{
				if($loanproductdisbursementconfiguration->save()){
					$response['status']='1';
					$response['message']='loan product disbursement configuration Added successfully';
					return json_encode($response);
			}else{
					$response['status']='0';
					$response['message']='Failed to add loan product disbursement configuration. Please try again';
					return json_encode($response);
				}
			}
			catch(Exception $e){
					$response['status']='0';
					$response['message']='An Error occured while attempting to add loan product disbursement configuration. Please try again';
					return json_encode($response);
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$loanproductdisbursementconfigurationdata['loanproducts']=LoanProducts::all();
		$loanproductdisbursementconfigurationdata['disbursementmodes']=DisbursementModes::all();
		$loanproductdisbursementconfigurationdata['accounts']=Accounts::all();
		$loanproductdisbursementconfigurationdata['accounts']=Accounts::all();
		$loanproductdisbursementconfigurationdata['data']=LoanProductDisbursementConfiguration::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LoanProductDisbursementConfiguration']])->get();
		$loanproductdisbursementconfigurationdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($loanproductdisbursementconfigurationdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('loanproductdisbursementconfigurationdata'));
		}else{
		return view('admin.loan_product_disbursement_configuration.edit',compact('loanproductdisbursementconfigurationdata','id'));
		}
	}

	public function show($id){
		$loanproductdisbursementconfigurationdata['loanproducts']=LoanProducts::all();
		$loanproductdisbursementconfigurationdata['disbursementmodes']=DisbursementModes::all();
		$loanproductdisbursementconfigurationdata['accounts']=Accounts::all();
		$loanproductdisbursementconfigurationdata['accounts']=Accounts::all();
		$loanproductdisbursementconfigurationdata['data']=LoanProductDisbursementConfiguration::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LoanProductDisbursementConfiguration']])->get();
		$loanproductdisbursementconfigurationdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($loanproductdisbursementconfigurationdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('loanproductdisbursementconfigurationdata'));
		}else{
		return view('admin.loan_product_disbursement_configuration.show',compact('loanproductdisbursementconfigurationdata','id'));
		}
	}

	public function update(Request $request,$id){
		$loanproductdisbursementconfiguration=LoanProductDisbursementConfiguration::find($id);
		$loanproductdisbursementconfiguration->loan_product=$request->get('loan_product');
		$loanproductdisbursementconfiguration->mode_of_disbursement=$request->get('mode_of_disbursement');
		$loanproductdisbursementconfiguration->debit_account=$request->get('debit_account');
		$loanproductdisbursementconfiguration->credit_account=$request->get('credit_account');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LoanProductDisbursementConfiguration']])->get();
		$loanproductdisbursementconfigurationdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($loanproductdisbursementconfigurationdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('loanproductdisbursementconfigurationdata'));
		}else{
		$loanproductdisbursementconfiguration->save();
		$loanproductdisbursementconfigurationdata['data']=LoanProductDisbursementConfiguration::find($id);
		return view('admin.loan_product_disbursement_configuration.edit',compact('loanproductdisbursementconfigurationdata','id'));
		}
	}

	public function destroy($id){
		$loanproductdisbursementconfiguration=LoanProductDisbursementConfiguration::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LoanProductDisbursementConfiguration']])->get();
		$loanproductdisbursementconfigurationdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($loanproductdisbursementconfigurationdata['usersaccountsroles'][0]['_delete']==1){
			$loanproductdisbursementconfiguration->delete();
		}return redirect('admin/loanproductdisbursementconfiguration')->with('success','loan product disbursement configuration has been deleted!');
	}
}