<?php
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\LoanPaymentFrequencies;
use App\Companies;
use App\Modules;
use App\Users;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;
class LoanPaymentFrequenciesController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$loanpaymentfrequenciesdata['list']=LoanPaymentFrequencies::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LoanPaymentFrequencies']])->get();
		$loanpaymentfrequenciesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($loanpaymentfrequenciesdata['usersaccountsroles'][0]['_add']==0&&$loanpaymentfrequenciesdata['usersaccountsroles'][0]['_list']==0&&$loanpaymentfrequenciesdata['usersaccountsroles'][0]['_edit']==0&&$loanpaymentfrequenciesdata['usersaccountsroles'][0]['_edit']==0&&$loanpaymentfrequenciesdata['usersaccountsroles'][0]['_show']==0&&$loanpaymentfrequenciesdata['usersaccountsroles'][0]['_delete']==0&&$loanpaymentfrequenciesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('loanpaymentfrequenciesdata'));
		}else{
			return view('admin.loan_payment_frequencies.index',compact('loanpaymentfrequenciesdata'));
		}
	}

	public function create(){
		$loanpaymentfrequenciesdata;
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LoanPaymentFrequencies']])->get();
		$loanpaymentfrequenciesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($loanpaymentfrequenciesdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('loanpaymentfrequenciesdata'));
		}else{
			return view('admin.loan_payment_frequencies.create',compact('loanpaymentfrequenciesdata'));
		}
	}

	public function filter(Request $request){
		$loanpaymentfrequenciesdata['list']=LoanPaymentFrequencies::where([['name','LIKE','%'.$request->get('name').'%'],['number_of_days','LIKE','%'.$request->get('number_of_days').'%'],])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LoanPaymentFrequencies']])->get();
		$loanpaymentfrequenciesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($loanpaymentfrequenciesdata['usersaccountsroles'][0]['_add']==0&&$loanpaymentfrequenciesdata['usersaccountsroles'][0]['_list']==0&&$loanpaymentfrequenciesdata['usersaccountsroles'][0]['_edit']==0&&$loanpaymentfrequenciesdata['usersaccountsroles'][0]['_edit']==0&&$loanpaymentfrequenciesdata['usersaccountsroles'][0]['_show']==0&&$loanpaymentfrequenciesdata['usersaccountsroles'][0]['_delete']==0&&$loanpaymentfrequenciesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('loanpaymentfrequenciesdata'));
		}else{
			return view('admin.loan_payment_frequencies.index',compact('loanpaymentfrequenciesdata'));
		}
	}

	public function report(){
		$loanpaymentfrequenciesdata['company']=Companies::all();
		$loanpaymentfrequenciesdata['list']=LoanPaymentFrequencies::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LoanPaymentFrequencies']])->get();
		$loanpaymentfrequenciesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($loanpaymentfrequenciesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('loanpaymentfrequenciesdata'));
		}else{
			return view('admin.loan_payment_frequencies.report',compact('loanpaymentfrequenciesdata'));
		}
	}

	public function chart(){
		return view('admin.loan_payment_frequencies.chart');
	}

	public function store(Request $request){
		$loanpaymentfrequencies=new LoanPaymentFrequencies();
		$loanpaymentfrequencies->name=$request->get('name');
		$loanpaymentfrequencies->number_of_days=$request->get('number_of_days');
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LoanPaymentFrequencies']])->get();
		$loanpaymentfrequenciesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($loanpaymentfrequenciesdata['usersaccountsroles'][0]['_show']==1){
			try{
				if($loanpaymentfrequencies->save()){
					$response['status']='1';
					$response['message']='loan payment frequencies Added successfully';
					return json_encode($response);
			}else{
					$response['status']='0';
					$response['message']='Failed to add loan payment frequencies. Please try again';
					return json_encode($response);
				}
			}
			catch(Exception $e){
					$response['status']='0';
					$response['message']='An Error occured while attempting to add loan payment frequencies. Please try again';
					return json_encode($response);
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$loanpaymentfrequenciesdata['data']=LoanPaymentFrequencies::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LoanPaymentFrequencies']])->get();
		$loanpaymentfrequenciesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($loanpaymentfrequenciesdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('loanpaymentfrequenciesdata'));
		}else{
		return view('admin.loan_payment_frequencies.edit',compact('loanpaymentfrequenciesdata','id'));
		}
	}

	public function show($id){
		$loanpaymentfrequenciesdata['data']=LoanPaymentFrequencies::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LoanPaymentFrequencies']])->get();
		$loanpaymentfrequenciesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($loanpaymentfrequenciesdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('loanpaymentfrequenciesdata'));
		}else{
		return view('admin.loan_payment_frequencies.show',compact('loanpaymentfrequenciesdata','id'));
		}
	}

	public function update(Request $request,$id){
		$loanpaymentfrequencies=LoanPaymentFrequencies::find($id);
		$loanpaymentfrequencies->name=$request->get('name');
		$loanpaymentfrequencies->number_of_days=$request->get('number_of_days');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LoanPaymentFrequencies']])->get();
		$loanpaymentfrequenciesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($loanpaymentfrequenciesdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('loanpaymentfrequenciesdata'));
		}else{
		$loanpaymentfrequencies->save();
		$loanpaymentfrequenciesdata['data']=LoanPaymentFrequencies::find($id);
		return view('admin.loan_payment_frequencies.edit',compact('loanpaymentfrequenciesdata','id'));
		}
	}

	public function destroy($id){
		$loanpaymentfrequencies=LoanPaymentFrequencies::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LoanPaymentFrequencies']])->get();
		$loanpaymentfrequenciesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($loanpaymentfrequenciesdata['usersaccountsroles'][0]['_delete']==1){
			$loanpaymentfrequencies->delete();
		}return redirect('admin/loanpaymentfrequencies')->with('success','loan payment frequencies has been deleted!');
	}
}