<?php

/**
 * @author  Wanjala Innocent Khaemba
 *Controller - ()
 */

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\ClearingFeeConfigurations;
use App\Companies;
use App\Modules;
use App\Users;
use App\Accounts;
use Carbon\Carbon;
use App\GeneralLedgers;
use App\Groups;
use App\EntryTypes;
use App\PaymentModes;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\FinancialCategories;
use App\AccountLevels;
use App\ClearingFeePayments;
use App\ClientLgfContributions;
use App\GroupClients;
use App\InsuranceDeductionPayments;
use App\LoanPayments;
use App\MembershipFees;
use Illuminate\Support\Facades\DB;
use App\ProcessingFeePayments;
use App\UsersAccountsRoles;

class PaymentModesReportController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

	public function index()
	{
		$accountsdata['financialcategories'] = FinancialCategories::all();
		$accountsdata['list'] = Accounts::all();
		$user = Users::where([['id', '=', Auth::id()]])->get();
		$module = Modules::where([['name', '=', 'Accounts']])->get();
		$accountsdata['usersaccountsroles'] = UsersAccountsRoles::where([['user_account', '=', $user[0]['user_account']], ['module', '=', $module[0]['id']]])->get();
		if ($accountsdata['usersaccountsroles'][0]['_add'] == 0 && $accountsdata['usersaccountsroles'][0]['_list'] == 0 && $accountsdata['usersaccountsroles'][0]['_edit'] == 0 && $accountsdata['usersaccountsroles'][0]['_edit'] == 0 && $accountsdata['usersaccountsroles'][0]['_show'] == 0 && $accountsdata['usersaccountsroles'][0]['_delete'] == 0 && $accountsdata['usersaccountsroles'][0]['_report'] == 0) {
			return view('admin.error.denied', compact('accountsdata'));
		} else {
			return view('admin.payment_mode_report.index', compact('accountsdata'));
		}

		// $paymentmodesdata['list'] = PaymentModes::all();
		// $user = Users::where([['id', '=', Auth::id()]])->get();
		// $module = Modules::where([['name', '=', 'Accounts']])->get();
		// $paymentmodesdata['usersaccountsroles'] = UsersAccountsRoles::where([['user_account', '=', $user[0]['user_account']], ['module', '=', $module[0]['id']]])->get();
		// if ($paymentmodesdata['usersaccountsroles'][0]['_add'] == 0 && $paymentmodesdata['usersaccountsroles'][0]['_list'] == 0 && $paymentmodesdata['usersaccountsroles'][0]['_edit'] == 0 && $paymentmodesdata['usersaccountsroles'][0]['_edit'] == 0 && $paymentmodesdata['usersaccountsroles'][0]['_show'] == 0 && $paymentmodesdata['usersaccountsroles'][0]['_delete'] == 0 && $paymentmodesdata['usersaccountsroles'][0]['_report'] == 0) {
		// 	return view('admin.error.denied', compact('paymentmodesdata'));
		// } else {
		// 	return view('admin.payment_mode_report.index', compact('paymentmodesdata'));
		// }
	}

	public function show($id)
	{
		ini_set('max_execution_time', 300000);

		$paymentmodesdata['company'] = Companies::all();
		$paymentmodesdata["date"] = Carbon::now()->toDateTimeString();

		$debit = EntryTypes::where([['code', '=', '001']])->get()->first();
		$credit = EntryTypes::where([['code', '=', '002']])->get()->first();

		$paymentmodesdata["credits"] = DB::table("general_ledgers")->select("date", "transaction_number", DB::raw("sum(amount) as amount"))->where("account", $id)->where("entry_type", $credit->id)->whereBetween(DB::raw("STR_TO_DATE(date, '%d-%m-%Y')"), ["2020-01-01", "2020-03-30"])->orderBy("date", "asc")->groupBy("transaction_number")->groupBy("date")->get();
		$paymentmodesdata["debits"] = DB::table("general_ledgers")->select("date", "transaction_number", DB::raw("sum(amount) as amount"))->where("account", $id)->where("entry_type", $debit->id)->whereBetween(DB::raw("STR_TO_DATE(date, '%d-%m-%Y')"), ["2020-01-01", "2020-03-30"])->orderBy("date", "asc")->groupBy("transaction_number")->groupBy("date")->get();

		$paymentmodesdata["list"] = array();

		$r = 0;
		$total = 0;

		for ($c = 0; $c < count($paymentmodesdata["debits"]); $c++) {

			$amount = 0;

			$l = $paymentmodesdata["debits"][$c];

			$paymentmodesdata["list"][$r]["date"] = $l->date;
			$paymentmodesdata["list"][$r]["groupid"] = "";
			$paymentmodesdata["list"][$r]["details"] = "";
			$paymentmodesdata["list"][$r]["transactionid"] = $l->transaction_number;
			$paymentmodesdata["list"][$r]["groupname"] = "";
			$paymentmodesdata["list"][$r]["clientname"] = "";
			$paymentmodesdata["list"][$r]["amount"] = $l->amount;

			$total = $total + $l->amount;

			$r++;
		}

		$paymentmodesdata["listc"] = array();

		$rc = 0;
		$totalc = 0;

		for ($c = 0; $c < count($paymentmodesdata["credits"]); $c++) {

			$amount = 0;

			$l = $paymentmodesdata["credits"][$c];

			$paymentmodesdata["listc"][$rc]["date"] = $l->date;
			$paymentmodesdata["listc"][$rc]["groupid"] = "";
			$paymentmodesdata["listc"][$rc]["details"] = "";
			$paymentmodesdata["listc"][$rc]["transactionid"] = $l->transaction_number;
			$paymentmodesdata["listc"][$rc]["groupname"] = "";
			$paymentmodesdata["listc"][$rc]["clientname"] = "";
			$paymentmodesdata["listc"][$rc]["amount"] = $l->amount;

			$totalc = $totalc + $l->amount;

			$rc++;
		}

		$paymentmodesdata["total"] = $total;
		$paymentmodesdata["totalc"] = $totalc;

		return view('admin.payment_mode_report.show', compact('paymentmodesdata'));
	}
}
