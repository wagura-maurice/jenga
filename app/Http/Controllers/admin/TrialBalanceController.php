<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\GeneralLedgers;
use App\Companies;
use App\Modules;
use App\Users;
use App\Accounts;
use App\EntryTypes;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;
use Illuminate\Support\Facades\DB;

class TrialBalanceController extends Controller
{

	public function __construct()
	{
		$this->middleware('auth');
	}
	public function page($pageIndex, $pageSize)
	{



		$trialbalancedata['company'] = Companies::all();
		$trialbalancedata['list'] = GeneralLedgers::skip($pageIndex)->take($pageSize)->get();
		$trialbalancedata['accounts'] = Accounts::all();
		$trialbalancedata["pageIndex"]=$pageIndex;
		$trialbalancedata["pageSize"]=$pageSize;
		$user = Users::where([['id', '=', Auth::id()]])->get();
		$debit = EntryTypes::where([['code', '=', '001']])->get();
		$credit = EntryTypes::where([['code', '=', '002']])->get();
		$ledger = array();
		$totalDebit = 0;
		$totalCredit = 0;



		for ($r = 0; $r < count($trialbalancedata['accounts']); $r++) {

			$debitledger = GeneralLedgers::where([['account', '=', $trialbalancedata['accounts'][$r]->id], ['entry_type', '=', $debit[0]['id']]])->sum('amount');
			$creditledger = GeneralLedgers::where([['account', '=', $trialbalancedata['accounts'][$r]->id], ['entry_type', '=', $credit[0]['id']]])->sum('amount');
			$ledger[$r]['account'] = $trialbalancedata['accounts'][$r]['code'] . ' ' . $trialbalancedata['accounts'][$r]['name'];
			if (isset($debitledger) && isset($creditledger)) {
				$ledger[$r]['debit'] = ($debitledger - $creditledger) > 0 ? ($debitledger - $creditledger) : '';
				$totalDebit += ($debitledger - $creditledger) > 0 ? ($debitledger - $creditledger) : 0;
				$ledger[$r]['credit'] = ($debitledger - $creditledger) > 0 ? '' : ($creditledger - $debitledger);
				$totalCredit += ($debitledger - $creditledger) > 0 ? 0 : ($creditledger - $debitledger);
			}
		}

		$trialbalancedata['ledger'] = $ledger;
		$trialbalancedata['totaldebit'] = $totalDebit;
		$trialbalancedata['totalcredit'] = $totalCredit;
		// die(json_encode($trialbalancedata['ledger']));
		$module = Modules::where([['name', '=', 'GeneralLedgers']])->get();
		$trialbalancedata['usersaccountsroles'] = UsersAccountsRoles::where([['user_account', '=', $user[0]['user_account']], ['module', '=', $module[0]['id']]])->get();
		// if($trialbalancedata['usersaccountsroles'][0]['_report']==0){
		// return view('admin.error.denied',compact('trialbalancedata'));
		// }else{
		return view('admin.reports.trial_balance', compact('trialbalancedata'));
		// }
	}

	public function create()
	{
		$trialbalancedata;
		$trialbalancedata['accounts'] = Accounts::all();
		$trialbalancedata['entrytypes'] = EntryTypes::all();
		$user = Users::where([['id', '=', Auth::id()]])->get();
		$module = Modules::where([['name', '=', 'GeneralLedgers']])->get();
		$trialbalancedata['usersaccountsroles'] = UsersAccountsRoles::where([['user_account', '=', $user[0]['user_account']], ['module', '=', $module[0]['id']]])->get();
		if ($trialbalancedata['usersaccountsroles'][0]['_add'] == 0) {
			return view('admin.error.denied', compact('trialbalancedata'));
		} else {
			return view('admin.general_ledgers.create', compact('trialbalancedata'));
		}
	}

	public function filter(Request $request)
	{
		$trialbalancedata['accounts'] = Accounts::all();
		$trialbalancedata['entrytypes'] = EntryTypes::all();
		$trialbalancedata['list'] = GeneralLedgers::where([['account', 'LIKE', '%' . $request->get('account') . '%'], ['entry_type', 'LIKE', '%' . $request->get('entry_type') . '%'], ['transaction_number', 'LIKE', '%' . $request->get('transaction_number') . '%'], ['amount', 'LIKE', '%' . $request->get('amount') . '%'],])->orWhereBetween('date', [$request->get('datefrom'), $request->get('dateto')])->get();
		$user = Users::where([['id', '=', Auth::id()]])->get();
		$module = Modules::where([['name', '=', 'GeneralLedgers']])->get();
		$trialbalancedata['usersaccountsroles'] = UsersAccountsRoles::where([['user_account', '=', $user[0]['user_account']], ['module', '=', $module[0]['id']]])->get();
		if ($trialbalancedata['usersaccountsroles'][0]['_add'] == 0 && $trialbalancedata['usersaccountsroles'][0]['_list'] == 0 && $trialbalancedata['usersaccountsroles'][0]['_edit'] == 0 && $trialbalancedata['usersaccountsroles'][0]['_edit'] == 0 && $trialbalancedata['usersaccountsroles'][0]['_show'] == 0 && $trialbalancedata['usersaccountsroles'][0]['_delete'] == 0 && $trialbalancedata['usersaccountsroles'][0]['_report'] == 0) {
			return view('admin.error.denied', compact('trialbalancedata'));
		} else {
			return view('admin.general_ledgers.index', compact('trialbalancedata'));
		}
	}

	public function report()
	{
		$trialbalancedata['company'] = Companies::all();
		$trialbalancedata['list'] = GeneralLedgers::all();
		$user = Users::where([['id', '=', Auth::id()]])->get();
		$module = Modules::where([['name', '=', 'GeneralLedgers']])->get();
		$trialbalancedata['usersaccountsroles'] = UsersAccountsRoles::where([['user_account', '=', $user[0]['user_account']], ['module', '=', $module[0]['id']]])->get();
		if ($trialbalancedata['usersaccountsroles'][0]['_report'] == 0) {
			return view('admin.error.denied', compact('trialbalancedata'));
		} else {
			return view('admin.general_ledgers.report', compact('trialbalancedata'));
		}
	}

	public function chart()
	{
		return view('admin.general_ledgers.chart');
	}

	public function store(Request $request)
	{
		$generalledgers = new GeneralLedgers();
		$generalledgers->account = $request->get('account');
		$generalledgers->entry_type = $request->get('entry_type');
		$generalledgers->transaction_number = $request->get('transaction_number');
		$generalledgers->amount = $request->get('amount');
		$generalledgers->date = $request->get('date');
		$response = array();
		$user = Users::where([['id', '=', Auth::id()]])->get();
		$module = Modules::where([['name', '=', 'GeneralLedgers']])->get();
		$trialbalancedata['usersaccountsroles'] = UsersAccountsRoles::where([['user_account', '=', $user[0]['user_account']], ['module', '=', $module[0]['id']]])->get();
		if ($trialbalancedata['usersaccountsroles'][0]['_show'] == 1) {
			try {
				if ($generalledgers->save()) {
					$response['status'] = '1';
					$response['message'] = 'general ledgers Added successfully';
					return json_encode($response);
				} else {
					$response['status'] = '0';
					$response['message'] = 'Failed to add general ledgers. Please try again';
					return json_encode($response);
				}
			} catch (Exception $e) {
				$response['status'] = '0';
				$response['message'] = 'An Error occured while attempting to add general ledgers. Please try again';
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
		$trialbalancedata['accounts'] = Accounts::all();
		$trialbalancedata['entrytypes'] = EntryTypes::all();
		$trialbalancedata['data'] = GeneralLedgers::find($id);
		$user = Users::where([['id', '=', Auth::id()]])->get();
		$module = Modules::where([['name', '=', 'GeneralLedgers']])->get();
		$trialbalancedata['usersaccountsroles'] = UsersAccountsRoles::where([['user_account', '=', $user[0]['user_account']], ['module', '=', $module[0]['id']]])->get();
		if ($trialbalancedata['usersaccountsroles'][0]['_edit'] == 0) {
			return view('admin.error.denied', compact('trialbalancedata'));
		} else {
			return view('admin.general_ledgers.edit', compact('trialbalancedata', 'id'));
		}
	}

	public function show($id)
	{
		$trialbalancedata['accounts'] = Accounts::all();
		$trialbalancedata['entrytypes'] = EntryTypes::all();
		$trialbalancedata['data'] = GeneralLedgers::find($id);
		$user = Users::where([['id', '=', Auth::id()]])->get();
		$module = Modules::where([['name', '=', 'GeneralLedgers']])->get();
		$trialbalancedata['usersaccountsroles'] = UsersAccountsRoles::where([['user_account', '=', $user[0]['user_account']], ['module', '=', $module[0]['id']]])->get();
		if ($trialbalancedata['usersaccountsroles'][0]['_show'] == 0) {
			return view('admin.error.denied', compact('trialbalancedata'));
		} else {
			return view('admin.general_ledgers.show', compact('trialbalancedata', 'id'));
		}
	}

	public function update(Request $request, $id)
	{
		$generalledgers = GeneralLedgers::find($id);
		$generalledgers->account = $request->get('account');
		$generalledgers->entry_type = $request->get('entry_type');
		$generalledgers->transaction_number = $request->get('transaction_number');
		$generalledgers->amount = $request->get('amount');
		$generalledgers->date = $request->get('date');
		$user = Users::where([['id', '=', Auth::id()]])->get();
		$module = Modules::where([['name', '=', 'GeneralLedgers']])->get();
		$trialbalancedata['usersaccountsroles'] = UsersAccountsRoles::where([['user_account', '=', $user[0]['user_account']], ['module', '=', $module[0]['id']]])->get();
		if ($trialbalancedata['usersaccountsroles'][0]['_edit'] == 0) {
			return view('admin.error.denied', compact('trialbalancedata'));
		} else {
			$generalledgers->save();
			$trialbalancedata['data'] = GeneralLedgers::find($id);
			return view('admin.general_ledgers.edit', compact('trialbalancedata', 'id'));
		}
	}

	public function destroy($id)
	{
		$generalledgers = GeneralLedgers::find($id);
		$user = Users::where([['id', '=', Auth::id()]])->get();
		$module = Modules::where([['name', '=', 'GeneralLedgers']])->get();
		$trialbalancedata['usersaccountsroles'] = UsersAccountsRoles::where([['user_account', '=', $user[0]['user_account']], ['module', '=', $module[0]['id']]])->get();
		if ($trialbalancedata['usersaccountsroles'][0]['_delete'] == 1) {
			$generalledgers->delete();
		}
		return redirect('admin/generalledgers')->with('success', 'general ledgers has been deleted!');
	}
}
