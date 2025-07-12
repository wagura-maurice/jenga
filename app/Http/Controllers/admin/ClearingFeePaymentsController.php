<?php

/**
 * @author  Wanjala Innocent Khaemba
 *Controller - (manages clearing fee payments data)
 */

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\ClearingFeePayments;
use App\Companies;
use App\Modules;
use App\Users;
use App\Loans;
use App\ClearingFeeConfigurations;
use App\GeneralLedgers;
use App\EntryTypes;
use App\PaymentModes;
use App\TransactionStatuses;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;

class ClearingFeePaymentsController extends Controller
{

	public function __construct()
	{
		$this->middleware('auth');
	}
	public function index()
	{
		$clearingfeepaymentsdata['loans'] = Loans::all();
		$clearingfeepaymentsdata['paymentmodes'] = PaymentModes::all();
		$clearingfeepaymentsdata['transactionstatuses'] = TransactionStatuses::all();
		$clearingfeepaymentsdata['list'] = ClearingFeePayments::all();
		$user = Users::where([['id', '=', Auth::id()]])->get();
		$module = Modules::where([['name', '=', 'ClearingFeePayments']])->get();
		$clearingfeepaymentsdata['usersaccountsroles'] = UsersAccountsRoles::where([['user_account', '=', $user[0]['user_account']], ['module', '=', $module[0]['id']]])->get();
		if ($clearingfeepaymentsdata['usersaccountsroles'][0]['_add'] == 0 && $clearingfeepaymentsdata['usersaccountsroles'][0]['_list'] == 0 && $clearingfeepaymentsdata['usersaccountsroles'][0]['_edit'] == 0 && $clearingfeepaymentsdata['usersaccountsroles'][0]['_edit'] == 0 && $clearingfeepaymentsdata['usersaccountsroles'][0]['_show'] == 0 && $clearingfeepaymentsdata['usersaccountsroles'][0]['_delete'] == 0 && $clearingfeepaymentsdata['usersaccountsroles'][0]['_report'] == 0) {
			return view('admin.error.denied', compact('clearingfeepaymentsdata'));
		} else {
			return view('admin.clearing_fee_payments.index', compact('clearingfeepaymentsdata'));
		}
	}

	public function create()
	{
		$clearingfeepaymentsdata;
		$clearingfeepaymentsdata['loans'] = Loans::all();
		$clearingfeepaymentsdata['paymentmodes'] = PaymentModes::all();
		$clearingfeepaymentsdata['transactionstatuses'] = TransactionStatuses::all();
		$user = Users::where([['id', '=', Auth::id()]])->get();
		$module = Modules::where([['name', '=', 'ClearingFeePayments']])->get();
		$clearingfeepaymentsdata['usersaccountsroles'] = UsersAccountsRoles::where([['user_account', '=', $user[0]['user_account']], ['module', '=', $module[0]['id']]])->get();
		if ($clearingfeepaymentsdata['usersaccountsroles'][0]['_add'] == 0) {
			return view('admin.error.denied', compact('clearingfeepaymentsdata'));
		} else {
			return view('admin.clearing_fee_payments.create', compact('clearingfeepaymentsdata'));
		}
	}

	public function filter(Request $request)
	{
		$clearingfeepaymentsdata['loans'] = Loans::all();
		$clearingfeepaymentsdata['paymentmodes'] = PaymentModes::all();
		$clearingfeepaymentsdata['transactionstatuses'] = TransactionStatuses::all();
		$clearingfeepaymentsdata['list'] = ClearingFeePayments::where([['loan_number', 'LIKE', '%' . $request->get('loan_number') . '%'], ['payment_mode', 'LIKE', '%' . $request->get('payment_mode') . '%'], ['transaction_reference', 'LIKE', '%' . $request->get('transaction_reference') . '%'], ['amount', 'LIKE', '%' . $request->get('amount') . '%'], ['transaction_status', 'LIKE', '%' . $request->get('transaction_status') . '%'],])->orWhereBetween('date', [$request->get('datefrom'), $request->get('dateto')])->get();
		$user = Users::where([['id', '=', Auth::id()]])->get();
		$module = Modules::where([['name', '=', 'ClearingFeePayments']])->get();
		$clearingfeepaymentsdata['usersaccountsroles'] = UsersAccountsRoles::where([['user_account', '=', $user[0]['user_account']], ['module', '=', $module[0]['id']]])->get();
		if ($clearingfeepaymentsdata['usersaccountsroles'][0]['_add'] == 0 && $clearingfeepaymentsdata['usersaccountsroles'][0]['_list'] == 0 && $clearingfeepaymentsdata['usersaccountsroles'][0]['_edit'] == 0 && $clearingfeepaymentsdata['usersaccountsroles'][0]['_edit'] == 0 && $clearingfeepaymentsdata['usersaccountsroles'][0]['_show'] == 0 && $clearingfeepaymentsdata['usersaccountsroles'][0]['_delete'] == 0 && $clearingfeepaymentsdata['usersaccountsroles'][0]['_report'] == 0) {
			return view('admin.error.denied', compact('clearingfeepaymentsdata'));
		} else {
			return view('admin.clearing_fee_payments.index', compact('clearingfeepaymentsdata'));
		}
	}

	public function report()
	{
		$clearingfeepaymentsdata['company'] = Companies::all();
		$clearingfeepaymentsdata['list'] = ClearingFeePayments::all();
		$user = Users::where([['id', '=', Auth::id()]])->get();
		$module = Modules::where([['name', '=', 'ClearingFeePayments']])->get();
		$clearingfeepaymentsdata['usersaccountsroles'] = UsersAccountsRoles::where([['user_account', '=', $user[0]['user_account']], ['module', '=', $module[0]['id']]])->get();
		if ($clearingfeepaymentsdata['usersaccountsroles'][0]['_report'] == 0) {
			return view('admin.error.denied', compact('clearingfeepaymentsdata'));
		} else {
			return view('admin.clearing_fee_payments.report', compact('clearingfeepaymentsdata'));
		}
	}

	public function chart()
	{
		return view('admin.clearing_fee_payments.chart');
	}

	public function getbytransactionreference($transactionReference)
	{

		return ClearingFeePayments::where([["transaction_reference", "=", $transactionReference]])->get()->first();
	}

	public function store(Request $request)
	{
		$clearingfeepayments = new ClearingFeePayments();
		$clearingfeepayments->loan_number = $request->get('loan_number');
		$clearingfeepayments->payment_mode = $request->get('payment_mode');
		$clearingfeepayments->transaction_reference = $request->get('transaction_reference');
		$clearingfeepayments->amount = $request->get('amount');
		$clearingfeepayments->date = $request->get('date');
		$clearingfeepayments->transaction_status = $request->get('transaction_status');
		$response = array();
		$user = Users::where([['id', '=', Auth::id()]])->get();
		$module = Modules::where([['name', '=', 'ClearingFeePayments']])->get();
		$clearingfeepaymentsdata['usersaccountsroles'] = UsersAccountsRoles::where([['user_account', '=', $user[0]['user_account']], ['module', '=', $module[0]['id']]])->get();
		if ($clearingfeepaymentsdata['usersaccountsroles'][0]['_show'] == 1) {
			try {
				if (isset($clearingfeepayments->loan_number)) {
					$loan = Loans::find($clearingfeepayments->loan_number);
					if (isset($loan)) {
						$clearingfeeconfiguration = ClearingFeeConfigurations::where([['loan_product', '=', $loan->loan_product], ['payment_mode', '=', $clearingfeepayments->payment_mode]])->get();

						if (!isset($clearingfeeconfiguration[0]))
							return;

						$debitAccount = $clearingfeeconfiguration[0]->debit_account;
						$creditAccount = $clearingfeeconfiguration[0]->credit_account;

						$debit = EntryTypes::where([['code', '=', '001']])->get();
						$credit = EntryTypes::where([['code', '=', '002']])->get();

						$generalLedger = new GeneralLedgers();
						$generalLedger->account = $debitAccount;
						$generalLedger->entry_type = $debit[0]['id'];
						$generalLedger->transaction_number = $clearingfeepayments->transaction_reference;
						$generalLedger->amount = $clearingfeepayments->amount;
						$generalLedger->date = $clearingfeepayments->date;
						$generalLedger->save();



						$generalLedger = new GeneralLedgers();
						$generalLedger->account = $creditAccount;
						$generalLedger->entry_type = $credit[0]['id'];
						$generalLedger->transaction_number = $clearingfeepayments->transaction_reference;
						$generalLedger->amount = $clearingfeepayments->amount;
						$generalLedger->date = $clearingfeepayments->date;
						$generalLedger->save();
					}
				}


				if ($clearingfeepayments->save()) {
					$response['status'] = '1';
					$response['message'] = 'clearing fee payments Added successfully';
					return json_encode($response);
				} else {
					$response['status'] = '0';
					$response['message'] = 'Failed to add clearing fee payments. Please try again';
					return json_encode($response);
				}
			} catch (Exception $e) {
				$response['status'] = '0';
				$response['message'] = 'An Error occured while attempting to add clearing fee payments. Please try again';
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
		$clearingfeepaymentsdata['loans'] = Loans::all();
		$clearingfeepaymentsdata['paymentmodes'] = PaymentModes::all();
		$clearingfeepaymentsdata['transactionstatuses'] = TransactionStatuses::all();
		$clearingfeepaymentsdata['data'] = ClearingFeePayments::find($id);
		$user = Users::where([['id', '=', Auth::id()]])->get();
		$module = Modules::where([['name', '=', 'ClearingFeePayments']])->get();
		$clearingfeepaymentsdata['usersaccountsroles'] = UsersAccountsRoles::where([['user_account', '=', $user[0]['user_account']], ['module', '=', $module[0]['id']]])->get();
		if ($clearingfeepaymentsdata['usersaccountsroles'][0]['_edit'] == 0) {
			return view('admin.error.denied', compact('clearingfeepaymentsdata'));
		} else {
			return view('admin.clearing_fee_payments.edit', compact('clearingfeepaymentsdata', 'id'));
		}
	}

	public function show($id)
	{
		$clearingfeepaymentsdata['loans'] = Loans::all();
		$clearingfeepaymentsdata['paymentmodes'] = PaymentModes::all();
		$clearingfeepaymentsdata['transactionstatuses'] = TransactionStatuses::all();
		$clearingfeepaymentsdata['data'] = ClearingFeePayments::find($id);
		$user = Users::where([['id', '=', Auth::id()]])->get();
		$module = Modules::where([['name', '=', 'ClearingFeePayments']])->get();
		$clearingfeepaymentsdata['usersaccountsroles'] = UsersAccountsRoles::where([['user_account', '=', $user[0]['user_account']], ['module', '=', $module[0]['id']]])->get();
		if ($clearingfeepaymentsdata['usersaccountsroles'][0]['_show'] == 0) {
			return view('admin.error.denied', compact('clearingfeepaymentsdata'));
		} else {
			return view('admin.clearing_fee_payments.show', compact('clearingfeepaymentsdata', 'id'));
		}
	}

	public function update(Request $request, $id)
	{
		$clearingfeepayments = ClearingFeePayments::find($id);
		$clearingfeepaymentsdata['loans'] = Loans::all();
		$clearingfeepaymentsdata['paymentmodes'] = PaymentModes::all();
		$clearingfeepaymentsdata['transactionstatuses'] = TransactionStatuses::all();
		$clearingfeepayments->loan_number = $request->get('loan_number');
		$clearingfeepayments->payment_mode = $request->get('payment_mode');
		$clearingfeepayments->transaction_reference = $request->get('transaction_reference');
		$clearingfeepayments->amount = $request->get('amount');
		$clearingfeepayments->date = $request->get('date');
		$clearingfeepayments->transaction_status = $request->get('transaction_status');
		$user = Users::where([['id', '=', Auth::id()]])->get();
		$module = Modules::where([['name', '=', 'ClearingFeePayments']])->get();
		$clearingfeepaymentsdata['usersaccountsroles'] = UsersAccountsRoles::where([['user_account', '=', $user[0]['user_account']], ['module', '=', $module[0]['id']]])->get();
		if ($clearingfeepaymentsdata['usersaccountsroles'][0]['_edit'] == 0) {
			return view('admin.error.denied', compact('clearingfeepaymentsdata'));
		} else {
			$clearingfeepayments->save();
			$clearingfeepaymentsdata['data'] = ClearingFeePayments::find($id);
			return view('admin.clearing_fee_payments.edit', compact('clearingfeepaymentsdata', 'id'));
		}
	}

	public function destroy($id)
	{
		$clearingfeepayments = ClearingFeePayments::find($id);
		$user = Users::where([['id', '=', Auth::id()]])->get();
		$module = Modules::where([['name', '=', 'ClearingFeePayments']])->get();
		$clearingfeepaymentsdata['usersaccountsroles'] = UsersAccountsRoles::where([['user_account', '=', $user[0]['user_account']], ['module', '=', $module[0]['id']]])->get();
		if ($clearingfeepaymentsdata['usersaccountsroles'][0]['_delete'] == 1) {
			$clearingfeepayments->delete();
		}
		return redirect('admin/clearingfeepayments')->with('success', 'clearing fee payments has been deleted!');
	}
}
