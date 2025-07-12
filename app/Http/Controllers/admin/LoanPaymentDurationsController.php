<?php
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\LoanPaymentDurations;
use App\Companies;
use App\Modules;
use App\Users;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;
class LoanPaymentDurationsController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$loanpaymentdurationsdata['list']=LoanPaymentDurations::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LoanPaymentDurations']])->get();
		$loanpaymentdurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($loanpaymentdurationsdata['usersaccountsroles'][0]['_add']==0&&$loanpaymentdurationsdata['usersaccountsroles'][0]['_list']==0&&$loanpaymentdurationsdata['usersaccountsroles'][0]['_edit']==0&&$loanpaymentdurationsdata['usersaccountsroles'][0]['_edit']==0&&$loanpaymentdurationsdata['usersaccountsroles'][0]['_show']==0&&$loanpaymentdurationsdata['usersaccountsroles'][0]['_delete']==0&&$loanpaymentdurationsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('loanpaymentdurationsdata'));
		}else{
			return view('admin.loan_payment_durations.index',compact('loanpaymentdurationsdata'));
		}
	}

	public function create(){
		$loanpaymentdurationsdata;
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LoanPaymentDurations']])->get();
		$loanpaymentdurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($loanpaymentdurationsdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('loanpaymentdurationsdata'));
		}else{
			return view('admin.loan_payment_durations.create',compact('loanpaymentdurationsdata'));
		}
	}

	public function filter(Request $request){
		$loanpaymentdurationsdata['list']=LoanPaymentDurations::where([['name','LIKE','%'.$request->get('name').'%'],['number_of_days','LIKE','%'.$request->get('number_of_days').'%'],])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LoanPaymentDurations']])->get();
		$loanpaymentdurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($loanpaymentdurationsdata['usersaccountsroles'][0]['_add']==0&&$loanpaymentdurationsdata['usersaccountsroles'][0]['_list']==0&&$loanpaymentdurationsdata['usersaccountsroles'][0]['_edit']==0&&$loanpaymentdurationsdata['usersaccountsroles'][0]['_edit']==0&&$loanpaymentdurationsdata['usersaccountsroles'][0]['_show']==0&&$loanpaymentdurationsdata['usersaccountsroles'][0]['_delete']==0&&$loanpaymentdurationsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('loanpaymentdurationsdata'));
		}else{
			return view('admin.loan_payment_durations.index',compact('loanpaymentdurationsdata'));
		}
	}

	public function report(){
		$loanpaymentdurationsdata['company']=Companies::all();
		$loanpaymentdurationsdata['list']=LoanPaymentDurations::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LoanPaymentDurations']])->get();
		$loanpaymentdurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($loanpaymentdurationsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('loanpaymentdurationsdata'));
		}else{
			return view('admin.loan_payment_durations.report',compact('loanpaymentdurationsdata'));
		}
	}

	public function chart(){
		return view('admin.loan_payment_durations.chart');
	}

	public function store(Request $request){
		$loanpaymentdurations=new LoanPaymentDurations();
		$loanpaymentdurations->name=$request->get('name');
		$loanpaymentdurations->number_of_days=$request->get('number_of_days');
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LoanPaymentDurations']])->get();
		$loanpaymentdurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($loanpaymentdurationsdata['usersaccountsroles'][0]['_show']==1){
			try{
				if($loanpaymentdurations->save()){
					$response['status']='1';
					$response['message']='loan payment durations Added successfully';
					return json_encode($response);
			}else{
					$response['status']='0';
					$response['message']='Failed to add loan payment durations. Please try again';
					return json_encode($response);
				}
			}
			catch(Exception $e){
					$response['status']='0';
					$response['message']='An Error occured while attempting to add loan payment durations. Please try again';
					return json_encode($response);
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$loanpaymentdurationsdata['data']=LoanPaymentDurations::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LoanPaymentDurations']])->get();
		$loanpaymentdurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($loanpaymentdurationsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('loanpaymentdurationsdata'));
		}else{
		return view('admin.loan_payment_durations.edit',compact('loanpaymentdurationsdata','id'));
		}
	}

	public function show($id){
		$loanpaymentdurationsdata['data']=LoanPaymentDurations::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LoanPaymentDurations']])->get();
		$loanpaymentdurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($loanpaymentdurationsdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('loanpaymentdurationsdata'));
		}else{
		return view('admin.loan_payment_durations.show',compact('loanpaymentdurationsdata','id'));
		}
	}

	public function update(Request $request,$id){
		$loanpaymentdurations=LoanPaymentDurations::find($id);
		$loanpaymentdurations->name=$request->get('name');
		$loanpaymentdurations->number_of_days=$request->get('number_of_days');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LoanPaymentDurations']])->get();
		$loanpaymentdurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($loanpaymentdurationsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('loanpaymentdurationsdata'));
		}else{
		$loanpaymentdurations->save();
		$loanpaymentdurationsdata['data']=LoanPaymentDurations::find($id);
		return view('admin.loan_payment_durations.edit',compact('loanpaymentdurationsdata','id'));
		}
	}

	public function destroy($id){
		$loanpaymentdurations=LoanPaymentDurations::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LoanPaymentDurations']])->get();
		$loanpaymentdurationsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($loanpaymentdurationsdata['usersaccountsroles'][0]['_delete']==1){
			$loanpaymentdurations->delete();
		}return redirect('admin/loanpaymentdurations')->with('success','loan payment durations has been deleted!');
	}
}