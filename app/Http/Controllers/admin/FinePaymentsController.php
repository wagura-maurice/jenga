<?php
namespace App\Http\Controllers\admin;
use App\Loans;
use App\Users;
use App\Modules;
use App\LoanFine;
use App\Companies;
use Carbon\Carbon;
use App\EntryTypes;
use App\FinePayments;
use App\PaymentModes;
use App\Http\Requests;
use App\GeneralLedgers;
use App\UsersAccountsRoles;
use Illuminate\Http\Request;
use App\FinePaymentConfigurations;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\ProductInterestConfigurations;

class FinePaymentsController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$finepaymentsdata['loans']=Loans::all();
		$finepaymentsdata['paymentmodes']=PaymentModes::all();
		$finepaymentsdata['list']=FinePayments::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','FinePayments']])->get();

		$finepaymentsdata['usersaccountsroles'] = UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();

		// dd($finepaymentsdata['usersaccountsroles']);

		return view('admin.fine_payments.index',compact('finepaymentsdata'));

		/*if($finepaymentsdata['usersaccountsroles'][0]['_add']== 0 && $finepaymentsdata['usersaccountsroles'][0]['_list']== 0 && $finepaymentsdata['usersaccountsroles'][0]['_edit']==0 && $finepaymentsdata['usersaccountsroles'][0]['_edit']== 0 && $finepaymentsdata['usersaccountsroles'][0]['_show']== 0 && $finepaymentsdata['usersaccountsroles'][0]['_delete']== 0 && $finepaymentsdata['usersaccountsroles'][0]['_report']==0) {
			return view('admin.error.denied',compact('finepaymentsdata'));
		}else{
			return view('admin.fine_payments.index',compact('finepaymentsdata'));
		}*/
	}

	public function create(){
		$finepaymentsdata;
		$finepaymentsdata['loans']=Loans::all();
		$finepaymentsdata['paymentmodes']=PaymentModes::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','FinePayments']])->get();
		$finepaymentsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($finepaymentsdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('finepaymentsdata'));
		}else{
			return view('admin.fine_payments.create',compact('finepaymentsdata'));
		}
	}

	public function filter(Request $request){
		$finepaymentsdata['loans']=Loans::all();
		$finepaymentsdata['paymentmodes']=PaymentModes::all();
		$finepaymentsdata['list']=FinePayments::where([['loan','LIKE','%'.$request->get('loan').'%'],['payment_mode','LIKE','%'.$request->get('payment_mode').'%'],['amount','LIKE','%'.$request->get('amount').'%'],])->orWhereBetween('date',[$request->get('datefrom'),$request->get('dateto')])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','FinePayments']])->get();
		$finepaymentsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($finepaymentsdata['usersaccountsroles'][0]['_add']==0&&$finepaymentsdata['usersaccountsroles'][0]['_list']==0&&$finepaymentsdata['usersaccountsroles'][0]['_edit']==0&&$finepaymentsdata['usersaccountsroles'][0]['_edit']==0&&$finepaymentsdata['usersaccountsroles'][0]['_show']==0&&$finepaymentsdata['usersaccountsroles'][0]['_delete']==0&&$finepaymentsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('finepaymentsdata'));
		}else{
			return view('admin.fine_payments.index',compact('finepaymentsdata'));
		}
	}

	public function report(){
		$finepaymentsdata['company']=Companies::all();
		$finepaymentsdata['list']=FinePayments::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','FinePayments']])->get();
		$finepaymentsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($finepaymentsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('finepaymentsdata'));
		}else{
			return view('admin.fine_payments.report',compact('finepaymentsdata'));
		}
	}

	public function chart(){
		return view('admin.fine_payments.chart');
	}

	public function store(Request $request){
		$finepayments=new FinePayments();
		$finepayments->loan=$request->get('loan');
		$finepayments->loanfine=$request->get('loanfine');
		$finepayments->payment_mode=$request->get('payment_mode');
		$finepayments->transaction_code=$request->get('transaction_code');
		$finepayments->amount=$request->get('amount');
		$finepayments->date=Carbon::parse($request->get('date'))->toDateString();
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','FinePayments']])->get();
		$finepaymentsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($finepaymentsdata['usersaccountsroles'][0]['_show']==1){
			try {
				if($finepayments->save()) {
					$loan = Loans::find($finepayments->loan);
					$loanfine = LoanFine::find($finepayments->loanfine);

					if($loan && $request->get('transaction_code') && $request->get('amount')) {
						$configurations = FinePaymentConfigurations::where([
							'loan_product' => $loan->loan_product,
							'payment_mode' => $finepayments->payment_mode
						])->first();
		
						if($configurations) {
							if($loanfine->id) {
								$loanfine->_status = 'settled';
								$loanfine->save();
							}

							$debit = EntryTypes::where([['code', '=', '001']])->first();
							$credit = EntryTypes::where([['code', '=', '002']])->first();
		
							$generalLedger = new GeneralLedgers();
							$generalLedger->account = $configurations->debit_account;
							$generalLedger->entry_type = $debit->id;
							$generalLedger->transaction_number = $request->get('transaction_code');
							$generalLedger->loan = $loan->id;
							$generalLedger->secondary_description = "Debit ledger";
							$generalLedger->amount = $request->get('amount');
							$generalLedger->date = Carbon::parse($request->get('date'))->toDateString();
							$generalLedger->save();
		
							$generalLedger = new GeneralLedgers();
							$generalLedger->account = $configurations->credit_account;
							$generalLedger->entry_type = $credit->id;
							$generalLedger->transaction_number = $request->get('transaction_code');
							$generalLedger->amount = $request->get('amount');
							$generalLedger->loan = $loan->id;
							$generalLedger->secondary_description = "Credit ledger";
							$generalLedger->date = Carbon::parse($request->get('date'))->toDateString();
							$generalLedger->save();

							$response['status']='1';
							$response['message']='fine payments Added successfully';
							
							return json_encode($response);
						} else {
							if($loanfine->id) {
								$loanfine->_status = 'unpaid';
								$loanfine->save();
							}

							$finepayments->delete();

							$response['status']='0';
							$response['message']='Failed to add fine payments due to mismatched fine payment configurations. Please try again';

							return json_encode($response);
						}
					}

					$response['status']='1';
					$response['message']='fine payments Added successfully';
					
					return json_encode($response);

				} else {
					$response['status']='0';
					$response['message']='Failed to add fine payments. Please try again';

					return json_encode($response);
				}
			} catch(\Exception $e){
				$response['status']='0';
				$response['message']='An Error occured while attempting to add fine payments. Please try again';

				return json_encode($response);
			}
		} else {
			$response['status']='0';
			$response['message']='Access Denied!';

			return json_encode($response);
		}
	}

	public function edit($id){
		$finepaymentsdata['loans']=Loans::all();
		$finepaymentsdata['paymentmodes']=PaymentModes::all();
		$finepaymentsdata['data']=FinePayments::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','FinePayments']])->get();
		$finepaymentsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($finepaymentsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('finepaymentsdata'));
		}else{
		return view('admin.fine_payments.edit',compact('finepaymentsdata','id'));
		}
	}

	public function show($id){
		$finepaymentsdata['loans']=Loans::all();
		$finepaymentsdata['paymentmodes']=PaymentModes::all();
		$finepaymentsdata['data']=FinePayments::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','FinePayments']])->get();
		$finepaymentsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($finepaymentsdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('finepaymentsdata'));
		}else{
		return view('admin.fine_payments.show',compact('finepaymentsdata','id'));
		}
	}

	public function update(Request $request,$id){
		$finepayments=FinePayments::find($id);
		$finepaymentsdata['loans']=Loans::all();
		$finepaymentsdata['paymentmodes']=PaymentModes::all();
		$finepayments->loan=$request->get('loan');
		$finepayments->loanfine=$request->get('loanfine');
		$finepayments->payment_mode=$request->get('payment_mode');
		$finepayments->transaction_code=$request->get('transaction_code');
		$finepayments->amount=$request->get('amount');
		$finepayments->date=Carbon::parse($request->get('date'))->toDateString();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','FinePayments']])->get();
		$finepaymentsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($finepaymentsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('finepaymentsdata'));
		}else{
		if($finepayments->save()) {
			$loan = Loans::find($finepayments->loan);
		
			if($loan && $request->get('transaction_code') && $request->get('amount')) {
				$configurations = FinePaymentConfigurations::where([
					'loan_product' => $loan->loan_product,
					'payment_mode' => $finepayments->payment_mode
				])->first();

				if($configurations) {
					if($finepayments->loanfine) {
						$loanfine = LoanFine::find($finepayments->loanfine);
						$loanfine->_status = 'settled';
						$loanfine->save();
					}
					
					$debit = EntryTypes::where([['code', '=', '001']])->first();
					$credit = EntryTypes::where([['code', '=', '002']])->first();

					$generalLedger = new GeneralLedgers();
					$generalLedger->account = $configurations->debit_account;
					$generalLedger->entry_type = $debit->id;
					$generalLedger->transaction_number = $request->get('transaction_code');
					$generalLedger->loan = $loan->id;
					$generalLedger->secondary_description = "Debit ledger";
					$generalLedger->amount = $request->get('amount');
					$generalLedger->date = Carbon::parse($request->get('date'))->toDateString();
					$generalLedger->save();

					$generalLedger = new GeneralLedgers();
					$generalLedger->account = $configurations->credit_account;
					$generalLedger->entry_type = $credit->id;
					$generalLedger->transaction_number = $request->get('transaction_code');
					$generalLedger->amount = $request->get('amount');
					$generalLedger->loan = $loan->id;
					$generalLedger->secondary_description = "Credit ledger";
					$generalLedger->date = Carbon::parse($request->get('date'))->toDateString();
					$generalLedger->save();
				}
			}
		}
		$finepaymentsdata['data']=FinePayments::find($id);
		return view('admin.fine_payments.edit',compact('finepaymentsdata','id'));
		}
	}

	public function destroy($id){
		$finepayments=FinePayments::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','FinePayments']])->get();
		$finepaymentsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($finepaymentsdata['usersaccountsroles'][0]['_delete']==1){
			$finepayments->delete();
		}return redirect('admin/finepayments')->with('success','fine payments has been deleted!');
	}
}