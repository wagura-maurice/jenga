<?php
/**
* @author  Wanjala Innocent Khaemba
*Controller - (manages fine configurations data)
*/
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\FineConfigurations;
use App\Companies;
use App\Modules;
use App\Users;
use App\LoanProducts;
use App\Accounts;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;
class FineConfigurationsController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$fineconfigurationsdata['loanproducts']=LoanProducts::all();
		$fineconfigurationsdata['accounts']=Accounts::all();
		$fineconfigurationsdata['accounts']=Accounts::all();
		$fineconfigurationsdata['list']=FineConfigurations::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','FineConfigurations']])->get();
		$fineconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($fineconfigurationsdata['usersaccountsroles'][0]['_add']==0&&$fineconfigurationsdata['usersaccountsroles'][0]['_list']==0&&$fineconfigurationsdata['usersaccountsroles'][0]['_edit']==0&&$fineconfigurationsdata['usersaccountsroles'][0]['_edit']==0&&$fineconfigurationsdata['usersaccountsroles'][0]['_show']==0&&$fineconfigurationsdata['usersaccountsroles'][0]['_delete']==0&&$fineconfigurationsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('fineconfigurationsdata'));
		}else{
			return view('admin.fine_configurations.index',compact('fineconfigurationsdata'));
		}
	}

	public function create(){
		$fineconfigurationsdata;
		$fineconfigurationsdata['loanproducts']=LoanProducts::all();
		$fineconfigurationsdata['accounts']=Accounts::all();
		$fineconfigurationsdata['accounts']=Accounts::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','FineConfigurations']])->get();
		$fineconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($fineconfigurationsdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('fineconfigurationsdata'));
		}else{
			return view('admin.fine_configurations.create',compact('fineconfigurationsdata'));
		}
	}

	public function filter(Request $request){
		$fineconfigurationsdata['loanproducts']=LoanProducts::all();
		$fineconfigurationsdata['accounts']=Accounts::all();
		$fineconfigurationsdata['accounts']=Accounts::all();
		$fineconfigurationsdata['list']=FineConfigurations::where([['loan_product','LIKE','%'.$request->get('loan_product').'%'],['debit_account','LIKE','%'.$request->get('debit_account').'%'],['credit_account','LIKE','%'.$request->get('credit_account').'%'],])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','FineConfigurations']])->get();
		$fineconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($fineconfigurationsdata['usersaccountsroles'][0]['_add']==0&&$fineconfigurationsdata['usersaccountsroles'][0]['_list']==0&&$fineconfigurationsdata['usersaccountsroles'][0]['_edit']==0&&$fineconfigurationsdata['usersaccountsroles'][0]['_edit']==0&&$fineconfigurationsdata['usersaccountsroles'][0]['_show']==0&&$fineconfigurationsdata['usersaccountsroles'][0]['_delete']==0&&$fineconfigurationsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('fineconfigurationsdata'));
		}else{
			return view('admin.fine_configurations.index',compact('fineconfigurationsdata'));
		}
	}

	public function report(){
		$fineconfigurationsdata['company']=Companies::all();
		$fineconfigurationsdata['list']=FineConfigurations::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','FineConfigurations']])->get();
		$fineconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($fineconfigurationsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('fineconfigurationsdata'));
		}else{
			return view('admin.fine_configurations.report',compact('fineconfigurationsdata'));
		}
	}

	public function chart(){
		return view('admin.fine_configurations.chart');
	}

	public function store(Request $request){
		$fineconfigurations=new FineConfigurations();
		$fineconfigurations->loan_product=$request->get('loan_product');
		$fineconfigurations->debit_account=$request->get('debit_account');
		$fineconfigurations->credit_account=$request->get('credit_account');
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','FineConfigurations']])->get();
		$fineconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($fineconfigurationsdata['usersaccountsroles'][0]['_show']==1){
			try{
				if($fineconfigurations->save()){
					$response['status']='1';
					$response['message']='fine configurations Added successfully';
					return json_encode($response);
			}else{
					$response['status']='0';
					$response['message']='Failed to add fine configurations. Please try again';
					return json_encode($response);
				}
			}
			catch(Exception $e){
					$response['status']='0';
					$response['message']='An Error occured while attempting to add fine configurations. Please try again';
					return json_encode($response);
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$fineconfigurationsdata['loanproducts']=LoanProducts::all();
		$fineconfigurationsdata['accounts']=Accounts::all();
		$fineconfigurationsdata['accounts']=Accounts::all();
		$fineconfigurationsdata['data']=FineConfigurations::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','FineConfigurations']])->get();
		$fineconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($fineconfigurationsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('fineconfigurationsdata'));
		}else{
		return view('admin.fine_configurations.edit',compact('fineconfigurationsdata','id'));
		}
	}

	public function show($id){
		$fineconfigurationsdata['loanproducts']=LoanProducts::all();
		$fineconfigurationsdata['accounts']=Accounts::all();
		$fineconfigurationsdata['accounts']=Accounts::all();
		$fineconfigurationsdata['data']=FineConfigurations::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','FineConfigurations']])->get();
		$fineconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($fineconfigurationsdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('fineconfigurationsdata'));
		}else{
		return view('admin.fine_configurations.show',compact('fineconfigurationsdata','id'));
		}
	}

	public function update(Request $request,$id){
		$fineconfigurations=FineConfigurations::find($id);
		$fineconfigurationsdata['loanproducts']=LoanProducts::all();
		$fineconfigurationsdata['accounts']=Accounts::all();
		$fineconfigurationsdata['accounts']=Accounts::all();
		$fineconfigurations->loan_product=$request->get('loan_product');
		$fineconfigurations->debit_account=$request->get('debit_account');
		$fineconfigurations->credit_account=$request->get('credit_account');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','FineConfigurations']])->get();
		$fineconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($fineconfigurationsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('fineconfigurationsdata'));
		}else{
		$fineconfigurations->save();
		$fineconfigurationsdata['data']=FineConfigurations::find($id);
		return view('admin.fine_configurations.edit',compact('fineconfigurationsdata','id'));
		}
	}

	public function destroy($id){
		$fineconfigurations=FineConfigurations::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','FineConfigurations']])->get();
		$fineconfigurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($fineconfigurationsdata['usersaccountsroles'][0]['_delete']==1){
			$fineconfigurations->delete();
		}return redirect('admin/fineconfigurations')->with('success','fine configurations has been deleted!');
	}
}