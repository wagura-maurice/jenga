<?php
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\OtherPayments;
use App\Companies;
use App\Modules;
use App\Users;
use App\OtherPaymentTypes;
use App\PaymentModes;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;
class OtherPaymentsController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$otherpaymentsdata['otherpaymenttypes']=OtherPaymentTypes::all();
		$otherpaymentsdata['paymentmodes']=PaymentModes::all();
		$otherpaymentsdata['list']=OtherPayments::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','OtherPayments']])->get();
		$otherpaymentsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($otherpaymentsdata['usersaccountsroles'][0]['_add']==0&&$otherpaymentsdata['usersaccountsroles'][0]['_list']==0&&$otherpaymentsdata['usersaccountsroles'][0]['_edit']==0&&$otherpaymentsdata['usersaccountsroles'][0]['_edit']==0&&$otherpaymentsdata['usersaccountsroles'][0]['_show']==0&&$otherpaymentsdata['usersaccountsroles'][0]['_delete']==0&&$otherpaymentsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('otherpaymentsdata'));
		}else{
			return view('admin.other_payments.index',compact('otherpaymentsdata'));
		}
	}

	public function create(){
		$otherpaymentsdata;
		$otherpaymentsdata['otherpaymenttypes']=OtherPaymentTypes::all();
		$otherpaymentsdata['paymentmodes']=PaymentModes::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','OtherPayments']])->get();
		$otherpaymentsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($otherpaymentsdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('otherpaymentsdata'));
		}else{
			return view('admin.other_payments.create',compact('otherpaymentsdata'));
		}
	}

	public function filter(Request $request){
		$otherpaymentsdata['otherpaymenttypes']=OtherPaymentTypes::all();
		$otherpaymentsdata['paymentmodes']=PaymentModes::all();
		$otherpaymentsdata['list']=OtherPayments::where([['other_payment_type','LIKE','%'.$request->get('other_payment_type').'%'],['transaction_number','LIKE','%'.$request->get('transaction_number').'%'],['payment_mode','LIKE','%'.$request->get('payment_mode').'%'],['amount','LIKE','%'.$request->get('amount').'%'],])->orWhereBetween('date',[$request->get('datefrom'),$request->get('dateto')])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','OtherPayments']])->get();
		$otherpaymentsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($otherpaymentsdata['usersaccountsroles'][0]['_add']==0&&$otherpaymentsdata['usersaccountsroles'][0]['_list']==0&&$otherpaymentsdata['usersaccountsroles'][0]['_edit']==0&&$otherpaymentsdata['usersaccountsroles'][0]['_edit']==0&&$otherpaymentsdata['usersaccountsroles'][0]['_show']==0&&$otherpaymentsdata['usersaccountsroles'][0]['_delete']==0&&$otherpaymentsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('otherpaymentsdata'));
		}else{
			return view('admin.other_payments.index',compact('otherpaymentsdata'));
		}
	}

	public function report(){
		$otherpaymentsdata['company']=Companies::all();
		$otherpaymentsdata['list']=OtherPayments::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','OtherPayments']])->get();
		$otherpaymentsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($otherpaymentsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('otherpaymentsdata'));
		}else{
			return view('admin.other_payments.report',compact('otherpaymentsdata'));
		}
	}

	public function chart(){
		return view('admin.other_payments.chart');
	}

	public function store(Request $request){
		$otherpayments=new OtherPayments();
		$otherpayments->other_payment_type=$request->get('other_payment_type');
		$otherpayments->transaction_number=$request->get('transaction_number');
		$otherpayments->payment_mode=$request->get('payment_mode');
		$otherpayments->date=$request->get('date');
		$otherpayments->amount=$request->get('amount');
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','OtherPayments']])->get();
		$otherpaymentsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($otherpaymentsdata['usersaccountsroles'][0]['_show']==1){
			try{
				if($otherpayments->save()){
					$response['status']='1';
					$response['message']='other payments Added successfully';
					return json_encode($response);
			}else{
					$response['status']='0';
					$response['message']='Failed to add other payments. Please try again';
					return json_encode($response);
				}
			}
			catch(Exception $e){
					$response['status']='0';
					$response['message']='An Error occured while attempting to add other payments. Please try again';
					return json_encode($response);
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$otherpaymentsdata['otherpaymenttypes']=OtherPaymentTypes::all();
		$otherpaymentsdata['paymentmodes']=PaymentModes::all();
		$otherpaymentsdata['data']=OtherPayments::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','OtherPayments']])->get();
		$otherpaymentsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($otherpaymentsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('otherpaymentsdata'));
		}else{
		return view('admin.other_payments.edit',compact('otherpaymentsdata','id'));
		}
	}

	public function show($id){
		$otherpaymentsdata['otherpaymenttypes']=OtherPaymentTypes::all();
		$otherpaymentsdata['paymentmodes']=PaymentModes::all();
		$otherpaymentsdata['data']=OtherPayments::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','OtherPayments']])->get();
		$otherpaymentsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($otherpaymentsdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('otherpaymentsdata'));
		}else{
		return view('admin.other_payments.show',compact('otherpaymentsdata','id'));
		}
	}

	public function update(Request $request,$id){
		$otherpayments=OtherPayments::find($id);
		$otherpaymentsdata['otherpaymenttypes']=OtherPaymentTypes::all();
		$otherpaymentsdata['paymentmodes']=PaymentModes::all();
		$otherpayments->other_payment_type=$request->get('other_payment_type');
		$otherpayments->transaction_number=$request->get('transaction_number');
		$otherpayments->payment_mode=$request->get('payment_mode');
		$otherpayments->date=$request->get('date');
		$otherpayments->amount=$request->get('amount');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','OtherPayments']])->get();
		$otherpaymentsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($otherpaymentsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('otherpaymentsdata'));
		}else{
		$otherpayments->save();
		$otherpaymentsdata['data']=OtherPayments::find($id);
		return view('admin.other_payments.edit',compact('otherpaymentsdata','id'));
		}
	}

	public function destroy($id){
		$otherpayments=OtherPayments::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','OtherPayments']])->get();
		$otherpaymentsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($otherpaymentsdata['usersaccountsroles'][0]['_delete']==1){
			$otherpayments->delete();
		}return redirect('admin/otherpayments')->with('success','other payments has been deleted!');
	}
}