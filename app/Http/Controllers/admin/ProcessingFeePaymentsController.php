<?php

/**
 * @author  Wanjala Innocent Khaemba
 *Controller - (processing fee payments)
 */

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\ProcessingFeePayments;
use App\Companies;
use App\Modules;
use App\Users;
use App\Loans;
use App\PaymentModes;
use App\TransactionStatuses;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;

class ProcessingFeePaymentsController extends Controller
{

	public function __construct()
	{
		$this->middleware('auth');
	}
	public function index()
	{
		$processingfeepaymentsdata['loans'] = Loans::all();
		$processingfeepaymentsdata['paymentmodes'] = PaymentModes::all();
		$processingfeepaymentsdata['transactionstatuses'] = TransactionStatuses::all();
		$processingfeepaymentsdata['list'] = ProcessingFeePayments::paginate(25);
		$user = Users::where([['id', '=', Auth::id()]])->get();
		$module = Modules::where([['name', '=', 'ProcessingFeePayments']])->get();
		$processingfeepaymentsdata['usersaccountsroles'] = UsersAccountsRoles::where([['user_account', '=', $user[0]['user_account']], ['module', '=', $module[0]['id']]])->get();
		if (isset($processingfeepaymentsdata['usersaccountsroles'][0]) && $processingfeepaymentsdata['usersaccountsroles'][0]['_add'] == 0 && $processingfeepaymentsdata['usersaccountsroles'][0]['_list'] == 0 && $processingfeepaymentsdata['usersaccountsroles'][0]['_edit'] == 0 && $processingfeepaymentsdata['usersaccountsroles'][0]['_edit'] == 0 && $processingfeepaymentsdata['usersaccountsroles'][0]['_show'] == 0 && $processingfeepaymentsdata['usersaccountsroles'][0]['_delete'] == 0 && $processingfeepaymentsdata['usersaccountsroles'][0]['_report'] == 0) {
			return view('admin.error.denied', compact('processingfeepaymentsdata'));
		} else {
			return view('admin.processing_fee_payments.index', compact('processingfeepaymentsdata'));
		}
	}

	public function create()
	{
		$processingfeepaymentsdata;
		$processingfeepaymentsdata['loans'] = Loans::all();
		$processingfeepaymentsdata['paymentmodes'] = PaymentModes::all();
		$processingfeepaymentsdata['transactionstatuses'] = TransactionStatuses::all();
		$user = Users::where([['id', '=', Auth::id()]])->get();
		$module = Modules::where([['name', '=', 'ProcessingFeePayments']])->get();
		$processingfeepaymentsdata['usersaccountsroles'] = UsersAccountsRoles::where([['user_account', '=', $user[0]['user_account']], ['module', '=', $module[0]['id']]])->get();
		if (isset($processingfeepaymentsdata['usersaccountsroles'][0]) && $processingfeepaymentsdata['usersaccountsroles'][0]['_add'] == 0) {
			return view('admin.error.denied', compact('processingfeepaymentsdata'));
		} else {
			return view('admin.processing_fee_payments.create', compact('processingfeepaymentsdata'));
		}
	}

	public function filter(Request $request)
	{
		$processingfeepaymentsdata['loans'] = Loans::all();
		$processingfeepaymentsdata['paymentmodes'] = PaymentModes::all();
		$processingfeepaymentsdata['transactionstatuses'] = TransactionStatuses::all();
		$processingfeepaymentsdata['list'] = ProcessingFeePayments::where([['loan_number', 'LIKE', '%' . $request->get('loan_number') . '%'], ['payment_mode', 'LIKE', '%' . $request->get('payment_mode') . '%'], ['transaction_number', 'LIKE', '%' . $request->get('transaction_number') . '%'], ['amount', 'LIKE', '%' . $request->get('amount') . '%'], ['transaction_status', 'LIKE', '%' . $request->get('transaction_status') . '%'],])->orWhereBetween('date', [$request->get('datefrom'), $request->get('dateto')])->get();
		$user = Users::where([['id', '=', Auth::id()]])->get();
		$module = Modules::where([['name', '=', 'ProcessingFeePayments']])->get();
		$processingfeepaymentsdata['usersaccountsroles'] = UsersAccountsRoles::where([['user_account', '=', $user[0]['user_account']], ['module', '=', $module[0]['id']]])->get();
		if (isset($processingfeepaymentsdata['usersaccountsroles'][0]) && $processingfeepaymentsdata['usersaccountsroles'][0]['_add'] == 0 && $processingfeepaymentsdata['usersaccountsroles'][0]['_list'] == 0 && $processingfeepaymentsdata['usersaccountsroles'][0]['_edit'] == 0 && $processingfeepaymentsdata['usersaccountsroles'][0]['_edit'] == 0 && $processingfeepaymentsdata['usersaccountsroles'][0]['_show'] == 0 && $processingfeepaymentsdata['usersaccountsroles'][0]['_delete'] == 0 && $processingfeepaymentsdata['usersaccountsroles'][0]['_report'] == 0) {
			return view('admin.error.denied', compact('processingfeepaymentsdata'));
		} else {
			return view('admin.processing_fee_payments.index', compact('processingfeepaymentsdata'));
		}
	}

	public function report()
	{
		$processingfeepaymentsdata['company'] = Companies::all();
		$processingfeepaymentsdata['list'] = ProcessingFeePayments::all();
		$user = Users::where([['id', '=', Auth::id()]])->get();
		$module = Modules::where([['name', '=', 'ProcessingFeePayments']])->get();
		$processingfeepaymentsdata['usersaccountsroles'] = UsersAccountsRoles::where([['user_account', '=', $user[0]['user_account']], ['module', '=', $module[0]['id']]])->get();
		if (isset($processingfeepaymentsdata['usersaccountsroles'][0]) && $processingfeepaymentsdata['usersaccountsroles'][0]['_report'] == 0) {
			return view('admin.error.denied', compact('processingfeepaymentsdata'));
		} else {
			return view('admin.processing_fee_payments.report', compact('processingfeepaymentsdata'));
		}
	}

	public function chart()
	{
		return view('admin.processing_fee_payments.chart');
	}

	public function store(Request $request)
	{
		$processingfeepayments = new ProcessingFeePayments();
		$processingfeepayments->loan_number = $request->get('loan_number');
		$processingfeepayments->payment_mode = $request->get('payment_mode');
		$processingfeepayments->transaction_number = $request->get('transaction_number');
		$processingfeepayments->amount = $request->get('amount');
		$processingfeepayments->date = $request->get('date');
		$approved = TransactionStatuses::where([["code", "=", "002"]])->get()->first();
		$processingfeepayments->transaction_status = $approved->id;
		
		$response = array();
		$user = Users::where([['id', '=', Auth::id()]])->get();
		$module = Modules::where([['name', '=', 'ProcessingFeePayments']])->get();
		$processingfeepaymentsdata['usersaccountsroles'] = UsersAccountsRoles::where([['user_account', '=', $user[0]['user_account']], ['module', '=', $module[0]['id']]])->get();
		if (isset($processingfeepaymentsdata['usersaccountsroles'][0]) && $processingfeepaymentsdata['usersaccountsroles'][0]['_show'] == 1) {
			try {
				if ($processingfeepayments->save()) {
					$response['status'] = '1';
					$response['message'] = 'processing fee payments Added successfully';
					return json_encode($response);
				} else {
					$response['status'] = '0';
					$response['message'] = 'Failed to add processing fee payments. Please try again';
					return json_encode($response);
				}
			} catch (Exception $e) {
				$response['status'] = '0';
				$response['message'] = 'An Error occured while attempting to add processing fee payments. Please try again';
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
		$processingfeepaymentsdata['loans'] = Loans::all();
		$processingfeepaymentsdata['paymentmodes'] = PaymentModes::all();
		$processingfeepaymentsdata['transactionstatuses'] = TransactionStatuses::all();
		$processingfeepaymentsdata['data'] = ProcessingFeePayments::find($id);
		$user = Users::where([['id', '=', Auth::id()]])->get();
		$module = Modules::where([['name', '=', 'ProcessingFeePayments']])->get();
		$processingfeepaymentsdata['usersaccountsroles'] = UsersAccountsRoles::where([['user_account', '=', $user[0]['user_account']], ['module', '=', $module[0]['id']]])->get();
		if (isset($processingfeepaymentsdata['usersaccountsroles'][0]) && $processingfeepaymentsdata['usersaccountsroles'][0]['_edit'] == 0) {
			return view('admin.error.denied', compact('processingfeepaymentsdata'));
		} else {
			return view('admin.processing_fee_payments.edit', compact('processingfeepaymentsdata', 'id'));
		}
	}

	public function show($id)
	{
		$processingfeepaymentsdata['loans'] = Loans::all();
		$processingfeepaymentsdata['paymentmodes'] = PaymentModes::all();
		$processingfeepaymentsdata['transactionstatuses'] = TransactionStatuses::all();
		$processingfeepaymentsdata['data'] = ProcessingFeePayments::find($id);
		$user = Users::where([['id', '=', Auth::id()]])->get();
		$module = Modules::where([['name', '=', 'ProcessingFeePayments']])->get();
		$processingfeepaymentsdata['usersaccountsroles'] = UsersAccountsRoles::where([['user_account', '=', $user[0]['user_account']], ['module', '=', $module[0]['id']]])->get();
		if (isset($processingfeepaymentsdata['usersaccountsroles'][0]) && $processingfeepaymentsdata['usersaccountsroles'][0]['_show'] == 0) {
			return view('admin.error.denied', compact('processingfeepaymentsdata'));
		} else {
			return view('admin.processing_fee_payments.show', compact('processingfeepaymentsdata', 'id'));
		}
	}


	public function getbytransactionreference($transactionNumber)
	{
		return ProcessingFeePayments::where([["transaction_number", "=", $transactionNumber]])->get()->first();
	}

	public function update(Request $request, $id)
	{
		$processingfeepayments = ProcessingFeePayments::find($id);
		$processingfeepaymentsdata['loans'] = Loans::all();
		$processingfeepaymentsdata['paymentmodes'] = PaymentModes::all();
		$processingfeepaymentsdata['transactionstatuses'] = TransactionStatuses::all();
		$processingfeepayments->loan_number = $request->get('loan_number');
		$processingfeepayments->payment_mode = $request->get('payment_mode');
		$processingfeepayments->transaction_number = $request->get('transaction_number');
		$processingfeepayments->amount = $request->get('amount');
		$processingfeepayments->date = $request->get('date');
		$processingfeepayments->transaction_status = $request->get('transaction_status');
		$user = Users::where([['id', '=', Auth::id()]])->get();
		$module = Modules::where([['name', '=', 'ProcessingFeePayments']])->get();
		$processingfeepaymentsdata['usersaccountsroles'] = UsersAccountsRoles::where([['user_account', '=', $user[0]['user_account']], ['module', '=', $module[0]['id']]])->get();
		if ($processingfeepaymentsdata['usersaccountsroles'][0]['_edit'] == 0) {
			return view('admin.error.denied', compact('processingfeepaymentsdata'));
		} else {
			$processingfeepayments->save();
			$processingfeepaymentsdata['data'] = ProcessingFeePayments::find($id);
			return view('admin.processing_fee_payments.edit', compact('processingfeepaymentsdata', 'id'));
		}
	}

	public function destroy($id)
	{
		$processingfeepayments = ProcessingFeePayments::find($id);
		$user = Users::where([['id', '=', Auth::id()]])->get();
		$module = Modules::where([['name', '=', 'ProcessingFeePayments']])->get();
		$processingfeepaymentsdata['usersaccountsroles'] = UsersAccountsRoles::where([['user_account', '=', $user[0]['user_account']], ['module', '=', $module[0]['id']]])->get();
		if (isset($processingfeepaymentsdata['usersaccountsroles'][0]) && $processingfeepaymentsdata['usersaccountsroles'][0]['_delete'] == 1) {
			$processingfeepayments->delete();
		}
		return redirect('admin/processingfeepayments')->with('success', 'processing fee payments has been deleted!');
	}
}
