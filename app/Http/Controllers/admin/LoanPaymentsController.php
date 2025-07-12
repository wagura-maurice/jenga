<?php
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\LoanPayments;
use App\Companies;
use App\Modules;
use App\Users;
use App\Loans;
use App\PaymentModes;
use App\TransactionStatuses;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;
use Illuminate\Support\Facades\DB;
use App\ProductPrincipalConfigurations;
use App\ProductInterestConfigurations;
use App\EntryTypes;
use App\GeneralLedgers;
use App\LoanProducts;
class LoanPaymentsController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$loanpaymentsdata['loans']=Loans::all();
		$loanpaymentsdata['paymentmodes']=PaymentModes::all();
		$loanpaymentsdata['transactionstatuses']=TransactionStatuses::all();
		$loanpaymentsdata['list']=LoanPayments::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LoanPayments']])->get();
		$loanpaymentsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($loanpaymentsdata['usersaccountsroles'][0]['_add']==0&&$loanpaymentsdata['usersaccountsroles'][0]['_list']==0&&$loanpaymentsdata['usersaccountsroles'][0]['_edit']==0&&$loanpaymentsdata['usersaccountsroles'][0]['_edit']==0&&$loanpaymentsdata['usersaccountsroles'][0]['_show']==0&&$loanpaymentsdata['usersaccountsroles'][0]['_delete']==0&&$loanpaymentsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('loanpaymentsdata'));
		}else{
			return view('admin.loan_payments.index',compact('loanpaymentsdata'));
		}
	}

	public function create(){
		$loanpaymentsdata;
		$loanpaymentsdata['loans']=Loans::all();
		$loanpaymentsdata['paymentmodes']=PaymentModes::all();
		$loanpaymentsdata['transactionstatuses']=TransactionStatuses::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LoanPayments']])->get();
		$loanpaymentsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($loanpaymentsdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('loanpaymentsdata'));
		}else{
			return view('admin.loan_payments.create',compact('loanpaymentsdata'));
		}
	}

	public function filter(Request $request){
		$loanpaymentsdata['loans']=Loans::all();
		$loanpaymentsdata['paymentmodes']=PaymentModes::all();
		$loanpaymentsdata['transactionstatuses']=TransactionStatuses::all();
		$loanpaymentsdata['list']=LoanPayments::where([['loan','LIKE','%'.$request->get('loan').'%'],['mode_of_payment','LIKE','%'.$request->get('mode_of_payment').'%'],['transaction_number','LIKE','%'.$request->get('transaction_number').'%'],['amount','LIKE','%'.$request->get('amount').'%'],['transaction_status','LIKE','%'.$request->get('transaction_status').'%'],])->orWhereBetween('date',[$request->get('datefrom'),$request->get('dateto')])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LoanPayments']])->get();
		$loanpaymentsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($loanpaymentsdata['usersaccountsroles'][0]['_add']==0&&$loanpaymentsdata['usersaccountsroles'][0]['_list']==0&&$loanpaymentsdata['usersaccountsroles'][0]['_edit']==0&&$loanpaymentsdata['usersaccountsroles'][0]['_edit']==0&&$loanpaymentsdata['usersaccountsroles'][0]['_show']==0&&$loanpaymentsdata['usersaccountsroles'][0]['_delete']==0&&$loanpaymentsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('loanpaymentsdata'));
		}else{
			return view('admin.loan_payments.index',compact('loanpaymentsdata'));
		}
	}

	public function report(){
		$loanpaymentsdata['company']=Companies::all();
		$loanpaymentsdata['list']=LoanPayments::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LoanPayments']])->get();
		$loanpaymentsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($loanpaymentsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('loanpaymentsdata'));
		}else{
			return view('admin.loan_payments.report',compact('loanpaymentsdata'));
		}
	}

	public function chart(){
		return view('admin.loan_payments.chart');
	}

	public function store(Request $request){
		$loanpayments=new LoanPayments();
		$loanpayments->loan=$request->get('loan');
		$loanpayments->mode_of_payment=$request->get('mode_of_payment');
		$loanpayments->amount=$request->get('amount');
		$loanpayments->date=$request->get('date');
		$loanpayments->transaction_number=$request->get("transaction_number");
		$transactionstatuses=TransactionStatuses::where([['code','=','002']])->get();
		$loanpayments->transaction_status=$transactionstatuses[0]['id'];
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LoanPayments']])->get();
		$loanpaymentsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		$loan=Loans::find($loanpayments->loan);
		// $product=LoanProducts::find($loan->loan_product);
		
		$productprincipalconfigurations=ProductPrincipalConfigurations::where([['loan_product','=',$loan->loan_product],['payment_mode','=',$loanpayments->mode_of_payment]])->get();
		$productinterestconfigurations=ProductInterestConfigurations::where([['loan_product','=',$loan->loan_product],['payment_mode','=',$loanpayments->mode_of_payment],['interest_payment_method','=',$loan->interest_payment_method]])->get();

		if($loanpaymentsdata['usersaccountsroles'][0]['_show']==1){
			
				return DB::transaction(function() use($loanpayments,$productprincipalconfigurations,$productinterestconfigurations,$loan){
					try{
					$interest=(($loanpayments->amount/(1+$loan->interest_rate/100))*($loan->interest_rate/100));
					$principal=$loanpayments->amount-$interest;
					$debit=EntryTypes::where([['code','=','001']])->get();
					$credit=EntryTypes::where([['code','=','002']])->get();	
					$generalLedger=new GeneralLedgers();
					$generalLedger->account=$productinterestconfigurations[0]['debit_account'];
					$generalLedger->entry_type=$debit[0]['id'];
					$generalLedger->transaction_number=$loanpayments->transaction_number;
					$generalLedger->loan=$loan->id;
					$generalLedger->secondary_description="Interest payments";
					$generalLedger->amount=$interest;
					$generalLedger->date=$loanpayments->date;
					$generalLedger->save();


					$generalLedger=new GeneralLedgers();
					$generalLedger->account=$productinterestconfigurations[0]['credit_account'];
					$generalLedger->entry_type=$credit[0]['id'];
					$generalLedger->transaction_number=$loanpayments->transaction_number;
					$generalLedger->loan=$loan->id;
					$generalLedger->secondary_description="Interest payments";					
					$generalLedger->amount=$interest;
					$generalLedger->date=$loanpayments->date;
					$generalLedger->save();

					$generalLedger=new GeneralLedgers();
					$generalLedger->account=$productprincipalconfigurations[0]['debit_account'];
					$generalLedger->entry_type=$debit[0]['id'];
					$generalLedger->transaction_number=$loanpayments->transaction_number;
					$generalLedger->loan=$loan->id;
					$generalLedger->secondary_description="Principal payments";					
					$generalLedger->amount=$principal;
					$generalLedger->date=$loanpayments->date;
					$generalLedger->save();


					$generalLedger=new GeneralLedgers();
					$generalLedger->account=$productprincipalconfigurations[0]['credit_account'];
					$generalLedger->entry_type=$credit[0]['id'];
					$generalLedger->transaction_number=$loanpayments->transaction_number;
					$generalLedger->loan=$loan->id;
					$generalLedger->secondary_description="principal payments";					
					$generalLedger->amount=$principal;
					$generalLedger->date=$loanpayments->date;
					$generalLedger->save();

					if($loanpayments->save()){
					$response['status']='1';
					$response['message']='loan payments Added successfully';
						return json_encode($response);
					}else{
							$response['status']='0';
							$response['message']='Failed to add loan payments. Please try again';
							return json_encode($response);
						}
					}
					catch(Exception $e){
							$response['status']='0';
							$response['message']='An Error occured while attempting to add loan payments. Please try again';
							return json_encode($response);
					}

				});
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$loanpaymentsdata['loans']=Loans::all();
		$loanpaymentsdata['paymentmodes']=PaymentModes::all();
		$loanpaymentsdata['transactionstatuses']=TransactionStatuses::all();
		$loanpaymentsdata['data']=LoanPayments::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LoanPayments']])->get();
		$loanpaymentsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($loanpaymentsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('loanpaymentsdata'));
		}else{
		return view('admin.loan_payments.edit',compact('loanpaymentsdata','id'));
		}
	}

	public function show($id){
		$loanpaymentsdata['loans']=Loans::all();
		$loanpaymentsdata['paymentmodes']=PaymentModes::all();
		$loanpaymentsdata['transactionstatuses']=TransactionStatuses::all();
		$loanpaymentsdata['data']=LoanPayments::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LoanPayments']])->get();
		$loanpaymentsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($loanpaymentsdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('loanpaymentsdata'));
		}else{
		return view('admin.loan_payments.show',compact('loanpaymentsdata','id'));
		}
	}

	public function update(Request $request,$id){
		$loanpayments=LoanPayments::find($id);
		$loanpaymentsdata['loans']=Loans::all();
		$loanpaymentsdata['paymentmodes']=PaymentModes::all();
		$loanpaymentsdata['transactionstatuses']=TransactionStatuses::all();
		$loanpayments->loan=$request->get('loan');
		$loanpayments->mode_of_payment=$request->get('mode_of_payment');
		$loanpayments->transaction_number=$request->get('transaction_number');
		$loanpayments->amount=$request->get('amount');
		$loanpayments->date=$request->get('date');
		$loanpayments->transaction_status=$request->get('transaction_status');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LoanPayments']])->get();
		$loanpaymentsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($loanpaymentsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('loanpaymentsdata'));
		}else{
		$loanpayments->save();
		$loanpaymentsdata['data']=LoanPayments::find($id);
		return view('admin.loan_payments.edit',compact('loanpaymentsdata','id'));
		}
	}

	public function destroy($id){
		$loanpayments=LoanPayments::find($id);
		DB::transaction(function() use($loanpayments){
			$transactionstatuses=TransactionStatuses::where([['code','=','002']])->get();
			if($transactionstatuses[0]['id']==$loanpayments->transaction_status){
				$transactionstatuses=TransactionStatuses::where([['code','=','003']])->get();

				$loanpayments->transaction_status=$transactionstatuses[0]['id'];
				$loanpayments->save();

				$loan=Loans::find($loanpayments->loan);
				// $product=LoanProducts::find($loan->loan_product);
				$productprincipalconfigurations=ProductPrincipalConfigurations::where([['loan_product','=',$loan->loan_product],['payment_mode','=',$loanpayments->mode_of_payment],['interest_payment_method','=',$loan->interest_payment_method]])->get();
				$productinterestconfigurations=ProductInterestConfigurations::where([['loan_product','=',$loan->loan_product],['payment_mode','=',$loanpayments->mode_of_payment],['interest_payment_method','=',$loan->interest_payment_method]])->get();

				$date=date('m/d/Y');
				$interest=(($loanpayments->amount/(1+$loan->interest_rate/100))*($loan->interest_rate/100));
				$principal=$loanpayments->amount-$interest;
				$debit=EntryTypes::where([['code','=','001']])->get();
				$credit=EntryTypes::where([['code','=','002']])->get();	

				$generalLedger=new GeneralLedgers();
				$generalLedger->account=$productinterestconfigurations[0]['debit_account'];
				$generalLedger->entry_type=$debit[0]['id'];
				$generalLedger->transaction_number="Rejected Interest ".$loan->transaction_number;
				$generalLedger->amount=$interest;
				$generalLedger->date=$date;
				$generalLedger->save();


				$generalLedger=new GeneralLedgers();
				$generalLedger->account=$productinterestconfigurations[0]['credit_account'];
				$generalLedger->entry_type=$credit[0]['id'];
				$generalLedger->transaction_number="Rejected Interest ".$loan->transaction_number;
				$generalLedger->amount=$interest;
				$generalLedger->date=$date;
				$generalLedger->save();

				$generalLedger=new GeneralLedgers();
				$generalLedger->account=$productprincipalconfigurations[0]['debit_account'];
				$generalLedger->entry_type=$debit[0]['id'];
				$generalLedger->transaction_number="Rejected Principal ".$loan->transaction_number;
				$generalLedger->amount=$principal;
				$generalLedger->date=$date;
				$generalLedger->save();


				$generalLedger=new GeneralLedgers();
				$generalLedger->account=$productprincipalconfigurations[0]['credit_account'];
				$generalLedger->entry_type=$credit[0]['id'];
				$generalLedger->transaction_number="Rejected Principal ".$loan->transaction_number;
				$generalLedger->amount=$principal;
				$generalLedger->date=$date;
				$generalLedger->save();			

			}
		});
		return redirect('admin/loanpayments')->with('success','loan payments has been deleted!');
	}
}