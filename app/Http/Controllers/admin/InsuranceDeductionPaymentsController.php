<?php

/**
 * @author  Wanjala Innocent Khaemba
 *Controller - (manages insurance deduction payments data)
 */

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\InsuranceDeductionPayments;
use App\Companies;
use App\Modules;
use App\Users;
use App\GeneralLedgers;
use App\EntryTypes;
use App\InsuranceDeductionConfigurations;
use App\Loans;
use App\PaymentModes;
use App\TransactionStatuses;
use App\Http\Controllers\Controller;
use App\InsuranceDeductionFeePayments;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;

class InsuranceDeductionPaymentsController extends Controller
{

	public function __construct()
	{
		$this->middleware('auth');
	}
	public function index()
	{
		$insurancedeductionpaymentsdata['loans'] = Loans::all();
		$insurancedeductionpaymentsdata['paymentmodes'] = PaymentModes::all();
		$insurancedeductionpaymentsdata['transactionstatuses'] = TransactionStatuses::all();
		$insurancedeductionpaymentsdata['list'] = InsuranceDeductionPayments::all();
		$user = Users::where([['id', '=', Auth::id()]])->get();
		$module = Modules::where([['name', '=', 'InsuranceDeductionPayments']])->get();
		$insurancedeductionpaymentsdata['usersaccountsroles'] = UsersAccountsRoles::where([['user_account', '=', $user[0]['user_account']], ['module', '=', $module[0]['id']]])->get();
		if ($insurancedeductionpaymentsdata['usersaccountsroles'][0]['_add'] == 0 && $insurancedeductionpaymentsdata['usersaccountsroles'][0]['_list'] == 0 && $insurancedeductionpaymentsdata['usersaccountsroles'][0]['_edit'] == 0 && $insurancedeductionpaymentsdata['usersaccountsroles'][0]['_edit'] == 0 && $insurancedeductionpaymentsdata['usersaccountsroles'][0]['_show'] == 0 && $insurancedeductionpaymentsdata['usersaccountsroles'][0]['_delete'] == 0 && $insurancedeductionpaymentsdata['usersaccountsroles'][0]['_report'] == 0) {
			return view('admin.error.denied', compact('insurancedeductionpaymentsdata'));
		} else {
			return view('admin.insurance_deduction_payments.index', compact('insurancedeductionpaymentsdata'));
		}
	}

	public function create()
	{
		$insurancedeductionpaymentsdata;
		$insurancedeductionpaymentsdata['loans'] = Loans::all();
		$insurancedeductionpaymentsdata['paymentmodes'] = PaymentModes::all();
		$insurancedeductionpaymentsdata['transactionstatuses'] = TransactionStatuses::all();
		$user = Users::where([['id', '=', Auth::id()]])->get();
		$module = Modules::where([['name', '=', 'InsuranceDeductionPayments']])->get();
		$insurancedeductionpaymentsdata['usersaccountsroles'] = UsersAccountsRoles::where([['user_account', '=', $user[0]['user_account']], ['module', '=', $module[0]['id']]])->get();
		if ($insurancedeductionpaymentsdata['usersaccountsroles'][0]['_add'] == 0) {
			return view('admin.error.denied', compact('insurancedeductionpaymentsdata'));
		} else {
			return view('admin.insurance_deduction_payments.create', compact('insurancedeductionpaymentsdata'));
		}
	}

	public function filter(Request $request)
	{
		$insurancedeductionpaymentsdata['loans'] = Loans::all();
		$insurancedeductionpaymentsdata['paymentmodes'] = PaymentModes::all();
		$insurancedeductionpaymentsdata['transactionstatuses'] = TransactionStatuses::all();
		$insurancedeductionpaymentsdata['list'] = InsuranceDeductionPayments::where([['loan_number', 'LIKE', '%' . $request->get('loan_number') . '%'], ['payment_mode', 'LIKE', '%' . $request->get('payment_mode') . '%'], ['transaction_reference', 'LIKE', '%' . $request->get('transaction_reference') . '%'], ['amount', 'LIKE', '%' . $request->get('amount') . '%'], ['transaction_status', 'LIKE', '%' . $request->get('transaction_status') . '%'],])->orWhereBetween('date', [$request->get('datefrom'), $request->get('dateto')])->get();
		$user = Users::where([['id', '=', Auth::id()]])->get();
		$module = Modules::where([['name', '=', 'InsuranceDeductionPayments']])->get();
		$insurancedeductionpaymentsdata['usersaccountsroles'] = UsersAccountsRoles::where([['user_account', '=', $user[0]['user_account']], ['module', '=', $module[0]['id']]])->get();
		if ($insurancedeductionpaymentsdata['usersaccountsroles'][0]['_add'] == 0 && $insurancedeductionpaymentsdata['usersaccountsroles'][0]['_list'] == 0 && $insurancedeductionpaymentsdata['usersaccountsroles'][0]['_edit'] == 0 && $insurancedeductionpaymentsdata['usersaccountsroles'][0]['_edit'] == 0 && $insurancedeductionpaymentsdata['usersaccountsroles'][0]['_show'] == 0 && $insurancedeductionpaymentsdata['usersaccountsroles'][0]['_delete'] == 0 && $insurancedeductionpaymentsdata['usersaccountsroles'][0]['_report'] == 0) {
			return view('admin.error.denied', compact('insurancedeductionpaymentsdata'));
		} else {
			return view('admin.insurance_deduction_payments.index', compact('insurancedeductionpaymentsdata'));
		}
	}

	public function report()
	{
		$insurancedeductionpaymentsdata['company'] = Companies::all();
		$insurancedeductionpaymentsdata['list'] = InsuranceDeductionPayments::all();
		$user = Users::where([['id', '=', Auth::id()]])->get();
		$module = Modules::where([['name', '=', 'InsuranceDeductionPayments']])->get();
		$insurancedeductionpaymentsdata['usersaccountsroles'] = UsersAccountsRoles::where([['user_account', '=', $user[0]['user_account']], ['module', '=', $module[0]['id']]])->get();
		if ($insurancedeductionpaymentsdata['usersaccountsroles'][0]['_report'] == 0) {
			return view('admin.error.denied', compact('insurancedeductionpaymentsdata'));
		} else {
			return view('admin.insurance_deduction_payments.report', compact('insurancedeductionpaymentsdata'));
		}
	}

	public function chart()
	{
		return view('admin.insurance_deduction_payments.chart');
	}

	public function getbytransactionreference($transactionReference)
	{
		return InsuranceDeductionPayments::where([["transaction_reference", "=", $transactionReference]])->get()->first();
	}

	public function store(Request $request)
	{
		// dd($request->all());

		$insurancedeductionpayments = new InsuranceDeductionPayments();
		$insurancedeductionpayments->loan_number = $request->get('loan_number');
		$insurancedeductionpayments->payment_mode = $request->get('payment_mode');
		$insurancedeductionpayments->transaction_reference = $request->get('transaction_reference');
		$insurancedeductionpayments->amount = $request->get('amount');
		$insurancedeductionpayments->date = $request->get('date');
		$insurancedeductionpayments->transaction_status = $request->get('transaction_status');
		$response = array();
		$user = Users::where([['id', '=', Auth::id()]])->get();
		$module = Modules::where([['name', '=', 'InsuranceDeductionPayments']])->get();
		$insurancedeductionpaymentsdata['usersaccountsroles'] = UsersAccountsRoles::where([['user_account', '=', $user[0]['user_account']], ['module', '=', $module[0]['id']]])->get();
		if ($insurancedeductionpaymentsdata['usersaccountsroles'][0]['_show'] == 1) {
			try {

				if (isset($insurancedeductionpayments->loan_number)) {

					$loan = Loans::find($insurancedeductionpayments->loan_number);

					if (isset($loan)) {

						$insurancedeductionconfiguration = InsuranceDeductionConfigurations::where([['loan_product', '=', $loan->loan_product], ['payment_mode', '=', $insurancedeductionpayments->payment_mode]])->get();

						if (!isset($insurancedeductionconfiguration[0])) {
							return;
						}

						$debitAccount = $insurancedeductionconfiguration[0]->debit_account;
						$creditAccount = $insurancedeductionconfiguration[0]->credit_account;

						$debit = EntryTypes::where([['code', '=', '001']])->get();
						$credit = EntryTypes::where([['code', '=', '002']])->get();

						$generalLedger = new GeneralLedgers();
						$generalLedger->account = $debitAccount;
						$generalLedger->entry_type = $debit[0]['id'];
						$generalLedger->transaction_number = $insurancedeductionpayments->transaction_reference;
						$generalLedger->amount = $insurancedeductionpayments->amount;
						$generalLedger->date = $insurancedeductionpayments->date;
						$generalLedger->save();

						$generalLedger = new GeneralLedgers();
						$generalLedger->account = $creditAccount;
						$generalLedger->entry_type = $credit[0]['id'];
						$generalLedger->transaction_number = $insurancedeductionpayments->transaction_reference;
						$generalLedger->amount = $insurancedeductionpayments->amount;
						$generalLedger->date = $insurancedeductionpayments->date;
						$generalLedger->save();
					}
				}


				if ($insurancedeductionpayments->save()) {
					$response['status'] = '1';
					$response['message'] = 'insurance deduction payments Added successfully';
					return json_encode($response);
				} else {
					$response['status'] = '0';
					$response['message'] = 'Failed to add insurance deduction payments. Please try again';
					return json_encode($response);
				}
			} catch (Exception $e) {
				$response['status'] = '0';
				$response['message'] = 'An Error occured while attempting to add insurance deduction payments. Please try again';
				return json_encode($response);
			}
		} else {
			$response['status'] = '0';
			$response['message'] = 'Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id)
	{
		$insurancedeductionpaymentsdata['loans'] = Loans::all();
		$insurancedeductionpaymentsdata['paymentmodes'] = PaymentModes::all();
		$insurancedeductionpaymentsdata['transactionstatuses'] = TransactionStatuses::all();
		$insurancedeductionpaymentsdata['data'] = InsuranceDeductionPayments::find($id);
		$user = Users::where([['id', '=', Auth::id()]])->get();
		$module = Modules::where([['name', '=', 'InsuranceDeductionPayments']])->get();
		$insurancedeductionpaymentsdata['usersaccountsroles'] = UsersAccountsRoles::where([['user_account', '=', $user[0]['user_account']], ['module', '=', $module[0]['id']]])->get();
		if ($insurancedeductionpaymentsdata['usersaccountsroles'][0]['_edit'] == 0) {
			return view('admin.error.denied', compact('insurancedeductionpaymentsdata'));
		} else {
			return view('admin.insurance_deduction_payments.edit', compact('insurancedeductionpaymentsdata', 'id'));
		}
	}

	public function show($id)
	{
		$insurancedeductionpaymentsdata['loans'] = Loans::all();
		$insurancedeductionpaymentsdata['paymentmodes'] = PaymentModes::all();
		$insurancedeductionpaymentsdata['transactionstatuses'] = TransactionStatuses::all();
		$insurancedeductionpaymentsdata['data'] = InsuranceDeductionPayments::find($id);
		$user = Users::where([['id', '=', Auth::id()]])->get();
		$module = Modules::where([['name', '=', 'InsuranceDeductionPayments']])->get();
		$insurancedeductionpaymentsdata['usersaccountsroles'] = UsersAccountsRoles::where([['user_account', '=', $user[0]['user_account']], ['module', '=', $module[0]['id']]])->get();
		if ($insurancedeductionpaymentsdata['usersaccountsroles'][0]['_show'] == 0) {
			return view('admin.error.denied', compact('insurancedeductionpaymentsdata'));
		} else {
			return view('admin.insurance_deduction_payments.show', compact('insurancedeductionpaymentsdata', 'id'));
		}
	}

	public function update(Request $request, $id)
	{
		$insurancedeductionpayments = InsuranceDeductionPayments::find($id);
		$insurancedeductionpaymentsdata['loans'] = Loans::all();
		$insurancedeductionpaymentsdata['paymentmodes'] = PaymentModes::all();
		$insurancedeductionpaymentsdata['transactionstatuses'] = TransactionStatuses::all();
		$insurancedeductionpayments->loan_number = $request->get('loan_number');
		$insurancedeductionpayments->payment_mode = $request->get('payment_mode');
		$insurancedeductionpayments->transaction_reference = $request->get('transaction_reference');
		$insurancedeductionpayments->amount = $request->get('amount');
		$insurancedeductionpayments->date = $request->get('date');
		$insurancedeductionpayments->transaction_status = $request->get('transaction_status');
		$user = Users::where([['id', '=', Auth::id()]])->get();
		$module = Modules::where([['name', '=', 'InsuranceDeductionPayments']])->get();
		$insurancedeductionpaymentsdata['usersaccountsroles'] = UsersAccountsRoles::where([['user_account', '=', $user[0]['user_account']], ['module', '=', $module[0]['id']]])->get();
		if ($insurancedeductionpaymentsdata['usersaccountsroles'][0]['_edit'] == 0) {
			return view('admin.error.denied', compact('insurancedeductionpaymentsdata'));
		} else {
			$insurancedeductionpayments->save();
			$insurancedeductionpaymentsdata['data'] = InsuranceDeductionPayments::find($id);
			return view('admin.insurance_deduction_payments.edit', compact('insurancedeductionpaymentsdata', 'id'));
		}
	}

	public function destroy($id)
	{
		$insurancedeductionpayments = InsuranceDeductionPayments::find($id);
		$user = Users::where([['id', '=', Auth::id()]])->get();
		$module = Modules::where([['name', '=', 'InsuranceDeductionPayments']])->get();
		$insurancedeductionpaymentsdata['usersaccountsroles'] = UsersAccountsRoles::where([['user_account', '=', $user[0]['user_account']], ['module', '=', $module[0]['id']]])->get();
		if ($insurancedeductionpaymentsdata['usersaccountsroles'][0]['_delete'] == 1) {
			$insurancedeductionpayments->delete();
		}
		return redirect('admin/insurancedeductionpayments')->with('success', 'insurance deduction payments has been deleted!');
	}
}
