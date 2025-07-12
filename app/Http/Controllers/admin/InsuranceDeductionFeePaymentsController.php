<?php
/**
* @author  Wanjala Innocent Khaemba
*Controller - (manages insurance deduction fee payments)
*/
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\InsuranceDeductionFeePayments;
use App\Companies;
use App\Modules;
use App\Users;
use App\Loans;
use App\PaymentModes;
use App\TransactionStatuses;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;
class InsuranceDeductionFeePaymentsController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$insurancedeductionfeepaymentsdata['loans']=Loans::all();
		$insurancedeductionfeepaymentsdata['paymentmodes']=PaymentModes::all();
		$insurancedeductionfeepaymentsdata['transactionstatuses']=TransactionStatuses::all();
		$insurancedeductionfeepaymentsdata['list']=InsuranceDeductionFeePayments::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','InsuranceDeductionFeePayments']])->get();
		$insurancedeductionfeepaymentsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($insurancedeductionfeepaymentsdata['usersaccountsroles'][0]['_add']==0&&$insurancedeductionfeepaymentsdata['usersaccountsroles'][0]['_list']==0&&$insurancedeductionfeepaymentsdata['usersaccountsroles'][0]['_edit']==0&&$insurancedeductionfeepaymentsdata['usersaccountsroles'][0]['_edit']==0&&$insurancedeductionfeepaymentsdata['usersaccountsroles'][0]['_show']==0&&$insurancedeductionfeepaymentsdata['usersaccountsroles'][0]['_delete']==0&&$insurancedeductionfeepaymentsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('insurancedeductionfeepaymentsdata'));
		}else{
			return view('admin.insurance_deduction_fee_payments.index',compact('insurancedeductionfeepaymentsdata'));
		}
	}

	public function create(){
		$insurancedeductionfeepaymentsdata;
		$insurancedeductionfeepaymentsdata['loans']=Loans::all();
		$insurancedeductionfeepaymentsdata['paymentmodes']=PaymentModes::all();
		$insurancedeductionfeepaymentsdata['transactionstatuses']=TransactionStatuses::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','InsuranceDeductionFeePayments']])->get();
		$insurancedeductionfeepaymentsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($insurancedeductionfeepaymentsdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('insurancedeductionfeepaymentsdata'));
		}else{
			return view('admin.insurance_deduction_fee_payments.create',compact('insurancedeductionfeepaymentsdata'));
		}
	}

	public function filter(Request $request){
		$insurancedeductionfeepaymentsdata['loans']=Loans::all();
		$insurancedeductionfeepaymentsdata['paymentmodes']=PaymentModes::all();
		$insurancedeductionfeepaymentsdata['transactionstatuses']=TransactionStatuses::all();
		$insurancedeductionfeepaymentsdata['list']=InsuranceDeductionFeePayments::where([['loan__number','LIKE','%'.$request->get('loan__number').'%'],['payment_mode','LIKE','%'.$request->get('payment_mode').'%'],['transaction_number','LIKE','%'.$request->get('transaction_number').'%'],['date','LIKE','%'.$request->get('date').'%'],['amount','LIKE','%'.$request->get('amount').'%'],['status','LIKE','%'.$request->get('status').'%'],])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','InsuranceDeductionFeePayments']])->get();
		$insurancedeductionfeepaymentsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($insurancedeductionfeepaymentsdata['usersaccountsroles'][0]['_add']==0&&$insurancedeductionfeepaymentsdata['usersaccountsroles'][0]['_list']==0&&$insurancedeductionfeepaymentsdata['usersaccountsroles'][0]['_edit']==0&&$insurancedeductionfeepaymentsdata['usersaccountsroles'][0]['_edit']==0&&$insurancedeductionfeepaymentsdata['usersaccountsroles'][0]['_show']==0&&$insurancedeductionfeepaymentsdata['usersaccountsroles'][0]['_delete']==0&&$insurancedeductionfeepaymentsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('insurancedeductionfeepaymentsdata'));
		}else{
			return view('admin.insurance_deduction_fee_payments.index',compact('insurancedeductionfeepaymentsdata'));
		}
	}

	public function report(){
		$insurancedeductionfeepaymentsdata['company']=Companies::all();
		$insurancedeductionfeepaymentsdata['list']=InsuranceDeductionFeePayments::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','InsuranceDeductionFeePayments']])->get();
		$insurancedeductionfeepaymentsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($insurancedeductionfeepaymentsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('insurancedeductionfeepaymentsdata'));
		}else{
			return view('admin.insurance_deduction_fee_payments.report',compact('insurancedeductionfeepaymentsdata'));
		}
	}

	public function chart(){
		return view('admin.insurance_deduction_fee_payments.chart');
	}

	public function store(Request $request){
		$insurancedeductionfeepayments=new InsuranceDeductionFeePayments();
		$insurancedeductionfeepayments->loan__number=$request->get('loan__number');
		$insurancedeductionfeepayments->payment_mode=$request->get('payment_mode');
		$insurancedeductionfeepayments->transaction_number=$request->get('transaction_number');
		$insurancedeductionfeepayments->date=$request->get('date');
		$insurancedeductionfeepayments->amount=$request->get('amount');
		$insurancedeductionfeepayments->status=$request->get('status');
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','InsuranceDeductionFeePayments']])->get();
		$insurancedeductionfeepaymentsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($insurancedeductionfeepaymentsdata['usersaccountsroles'][0]['_show']==1){
			try{
			    $loan=Loans::find($insurancedeductionfeepayments->loan_number);
			    $insurancedeductionfeeconfiguration=InsuranceDeductionFeeConfigurations::where([['loan_product','=',$loan->loan_product],['payment_mode','=',$insurancedeductionfeepayments->payment_mode]])->get();
			    die(json_encode($insurancedeductionfeeconfiguration));
			    
			    if(!isset($insurancedeductionfeeconfiguration[0]))
			        return;
			        
			    $debitAccount=$insurancedeductionfeeconfiguration[0]->debit_account;
			    $creditAccount=$insurancedeductionfeeconfiguration[0]->credit_account;
			    
			    $debit=EntryTypes::where([['code','=','001']])->get();
		        $credit=EntryTypes::where([['code','=','002']])->get();

    			$generalLedger=new GeneralLedgers();
    			$generalLedger->account=$debitAccount;
    			$generalLedger->entry_type=$debit[0]['id'];
    			$generalLedger->transaction_number=$insurancedeductionfeepayments->transaction_reference;
    			$generalLedger->amount=$insurancedeductionfeepayments->amount;
    			$generalLedger->date=$insurancedeductionfeepayments->date;
    			$generalLedger->save();
    			
    			
    
    			$generalLedger=new GeneralLedgers();
    			$generalLedger->account=$creditAccount;
    			$generalLedger->entry_type=$credit[0]['id'];
    			$generalLedger->transaction_number=$insurancedeductionfeepayments->transaction_reference;
    			$generalLedger->amount=$insurancedeductionfeepayments->amount;
    			$generalLedger->date=$insurancedeductionfeepayments->date;
    			$generalLedger->save();			    
			if($insurancedeductionfeepayments->save()){
					$response['status']='1';
					$response['message']='insurance deduction fee payments  Added successfully';
					return json_encode($response);
			}else{
					$response['status']='0';
					$response['message']='Failed to add insurance deduction fee payments . Please try again';
					return json_encode($response);
				}
			}
			catch(Exception $e){
					$response['status']='0';
					$response['message']='An Error occured while attempting to add insurance deduction fee payments . Please try again';
					return json_encode($response);
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$insurancedeductionfeepaymentsdata['loans']=Loans::all();
		$insurancedeductionfeepaymentsdata['paymentmodes']=PaymentModes::all();
		$insurancedeductionfeepaymentsdata['transactionstatuses']=TransactionStatuses::all();
		$insurancedeductionfeepaymentsdata['data']=InsuranceDeductionFeePayments::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','InsuranceDeductionFeePayments']])->get();
		$insurancedeductionfeepaymentsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($insurancedeductionfeepaymentsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('insurancedeductionfeepaymentsdata'));
		}else{
		return view('admin.insurance_deduction_fee_payments.edit',compact('insurancedeductionfeepaymentsdata','id'));
		}
	}

	public function show($id){
		$insurancedeductionfeepaymentsdata['loans']=Loans::all();
		$insurancedeductionfeepaymentsdata['paymentmodes']=PaymentModes::all();
		$insurancedeductionfeepaymentsdata['transactionstatuses']=TransactionStatuses::all();
		$insurancedeductionfeepaymentsdata['data']=InsuranceDeductionFeePayments::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','InsuranceDeductionFeePayments']])->get();
		$insurancedeductionfeepaymentsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($insurancedeductionfeepaymentsdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('insurancedeductionfeepaymentsdata'));
		}else{
		return view('admin.insurance_deduction_fee_payments.show',compact('insurancedeductionfeepaymentsdata','id'));
		}
	}

	public function update(Request $request,$id){
		$insurancedeductionfeepayments=InsuranceDeductionFeePayments::find($id);
		$insurancedeductionfeepaymentsdata['loans']=Loans::all();
		$insurancedeductionfeepaymentsdata['paymentmodes']=PaymentModes::all();
		$insurancedeductionfeepaymentsdata['transactionstatuses']=TransactionStatuses::all();
		$insurancedeductionfeepayments->loan__number=$request->get('loan__number');
		$insurancedeductionfeepayments->payment_mode=$request->get('payment_mode');
		$insurancedeductionfeepayments->transaction_number=$request->get('transaction_number');
		$insurancedeductionfeepayments->date=$request->get('date');
		$insurancedeductionfeepayments->amount=$request->get('amount');
		$insurancedeductionfeepayments->status=$request->get('status');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','InsuranceDeductionFeePayments']])->get();
		$insurancedeductionfeepaymentsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($insurancedeductionfeepaymentsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('insurancedeductionfeepaymentsdata'));
		}else{
		$insurancedeductionfeepayments->save();
		$insurancedeductionfeepaymentsdata['data']=InsuranceDeductionFeePayments::find($id);
		return view('admin.insurance_deduction_fee_payments.edit',compact('insurancedeductionfeepaymentsdata','id'));
		}
	}

	public function destroy($id){
		$insurancedeductionfeepayments=InsuranceDeductionFeePayments::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','InsuranceDeductionFeePayments']])->get();
		$insurancedeductionfeepaymentsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($insurancedeductionfeepaymentsdata['usersaccountsroles'][0]['_delete']==1){
			$insurancedeductionfeepayments->delete();
		}return redirect('admin/insurancedeductionfeepayments')->with('success','insurance deduction fee payments  has been deleted!');
	}
}