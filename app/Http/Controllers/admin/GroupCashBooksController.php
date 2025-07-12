<?php

/**
 * @author  Wanjala Innocent Khaemba
 *Controller - ()
 */

namespace App\Http\Controllers\admin;

use App\Users;
use App\Groups;
use App\Modules;
use App\Accounts;
use App\Companies;
use Carbon\Carbon;
use App\PaymentModes;
use App\GroupCashBooks;
use App\UsersAccountsRoles;
use App\FinancialCategories;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Rap2hpoutre\FastExcel\FastExcel;
use Rap2hpoutre\FastExcel\SheetCollection;
use OpenSpout\Writer\Common\Creator\Style\StyleBuilder;

class GroupCashBooksController extends Controller
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


		// $groupcashbooksdata['groups'] = Groups::all();
		// $groupcashbooksdata['paymentmodes'] = PaymentModes::all();
		// $groupcashbooksdata['list'] = GroupCashBooks::all();
		$user = Users::where([['id', '=', Auth::id()]])->get();
		$module = Modules::where([['name', '=', 'GroupCashBooks']])->get();
		$groupcashbooksdata['usersaccountsroles'] = UsersAccountsRoles::where([['user_account', '=', $user[0]['user_account']], ['module', '=', $module[0]['id']]])->get();
		if (isset($groupcashbooksdata['usersaccountsroles'][0]) && $groupcashbooksdata['usersaccountsroles'][0]['_add'] == 0 && $groupcashbooksdata['usersaccountsroles'][0]['_list'] == 0 && $groupcashbooksdata['usersaccountsroles'][0]['_edit'] == 0 && $groupcashbooksdata['usersaccountsroles'][0]['_edit'] == 0 && $groupcashbooksdata['usersaccountsroles'][0]['_show'] == 0 && $groupcashbooksdata['usersaccountsroles'][0]['_delete'] == 0 && $groupcashbooksdata['usersaccountsroles'][0]['_report'] == 0) {
			return view('admin.error.denied', compact('accountsdata '));
		} else {
			return view('admin.group_cash_books.index', compact('accountsdata'));
		}
	}

	public function create()
	{
		$groupcashbooksdata;
		$groupcashbooksdata['groups'] = Groups::all();
		$groupcashbooksdata['paymentmodes'] = PaymentModes::all();
		$user = Users::where([['id', '=', Auth::id()]])->get();
		$module = Modules::where([['name', '=', 'GroupCashBooks']])->get();
		$groupcashbooksdata['usersaccountsroles'] = UsersAccountsRoles::where([['user_account', '=', $user[0]['user_account']], ['module', '=', $module[0]['id']]])->get();
		if (isset($groupcashbooksdata['usersaccountsroles'][0]) && $groupcashbooksdata['usersaccountsroles'][0]['_add'] == 0) {
			return view('admin.error.denied', compact('groupcashbooksdata'));
		} else {
			return view('admin.group_cash_books.create', compact('groupcashbooksdata'));
		}
	}

	public function filter(Request $request)
	{
		$groupcashbooksdata['groups'] = Groups::all();
		$groupcashbooksdata['paymentmodes'] = PaymentModes::all();
		$groupcashbooksdata['list'] = GroupCashBooks::where([['transaction_id', 'LIKE', '%' . $request->get('transaction_id') . '%'], ['group', 'LIKE', '%' . $request->get('group') . '%'], ['transaction_reference', 'LIKE', '%' . $request->get('transaction_reference') . '%'], ['transaction_type', 'LIKE', '%' . $request->get('transaction_type') . '%'], ['amount', 'LIKE', '%' . $request->get('amount') . '%'], ['payment_mode', 'LIKE', '%' . $request->get('payment_mode') . '%'],])->orWhereBetween('transaction_date', [$request->get('transaction_datefrom'), $request->get('transaction_dateto')])->get();
		$user = Users::where([['id', '=', Auth::id()]])->get();
		$module = Modules::where([['name', '=', 'GroupCashBooks']])->get();
		$groupcashbooksdata['usersaccountsroles'] = UsersAccountsRoles::where([['user_account', '=', $user[0]['user_account']], ['module', '=', $module[0]['id']]])->get();
		if (isset($groupcashbooksdata['usersaccountsroles'][0]) && $groupcashbooksdata['usersaccountsroles'][0]['_add'] == 0 && $groupcashbooksdata['usersaccountsroles'][0]['_list'] == 0 && $groupcashbooksdata['usersaccountsroles'][0]['_edit'] == 0 && $groupcashbooksdata['usersaccountsroles'][0]['_edit'] == 0 && $groupcashbooksdata['usersaccountsroles'][0]['_show'] == 0 && $groupcashbooksdata['usersaccountsroles'][0]['_delete'] == 0 && $groupcashbooksdata['usersaccountsroles'][0]['_report'] == 0) {
			return view('admin.error.denied', compact('groupcashbooksdata'));
		} else {
			return view('admin.group_cash_books.index', compact('groupcashbooksdata'));
		}
	}

	/* public function report($id)
	{
		$groupcashbooksdata['id'] = $id;
		$groupcashbooksdata['startDate'] = Carbon::now()->subDays(5)->toDateString();
		$groupcashbooksdata['endDate'] = Carbon::now()->toDateString();
		$groupcashbooksdata['company'] = Companies::all();
		$groupcashbooksdata['list-a'] = GroupCashBooks::where(["account" => $id, "transaction_type" => 2])
			->whereBetween('transaction_date', [$groupcashbooksdata['startDate'], $groupcashbooksdata['endDate']])
			->orderBy('transaction_date', 'DESC')
			->get(); // debit

		$debit_items = array_unique($groupcashbooksdata['list-a']->pluck('transaction_id')->toArray());
		$debit = [];
		foreach ($debit_items as $key => $item) {
			$debit[] = (object) [
				'transaction_id'        => $item,
				'transaction_date'      => $groupcashbooksdata['list-a']->where('transaction_id', $item)->first()->transaction_date,
				'transacting_group'     => isset($groupcashbooksdata['list-a']->where('transaction_id', $item)->first()->transacting_group) ? Groups::find($groupcashbooksdata['list-a']->where('transaction_id', $item)->first()->transacting_group) : null,
				'transaction_reference' => $groupcashbooksdata['list-a']->where('transaction_id', $item)->first()->transaction_reference,
				'amount'                => $groupcashbooksdata['list-a']->where('transaction_id', $item)->sum('amount')
			];
		}

		$groupcashbooksdata['list-a-view'] = collect($debit)->paginate(25); // $debit;

		$groupcashbooksdata['list-b'] = GroupCashBooks::where(["account" => $id, "transaction_type" => 1])
			->whereBetween('transaction_date', [$groupcashbooksdata['startDate'], $groupcashbooksdata['endDate']])
			->orderBy('transaction_date', 'DESC')
			->get(); // credit

		$credit_items = array_unique($groupcashbooksdata['list-b']->pluck('transaction_id')->toArray());
		$credit = [];
		foreach ($credit_items as $key => $item) {
			$credit[] = (object) [
				'transaction_id'        => $item,
				'transaction_date'      => $groupcashbooksdata['list-b']->where('transaction_id', $item)->first()->transaction_date,
				'particulars'           => $groupcashbooksdata['list-b']->where('transaction_id', $item)->first()->particulars,
				'transaction_reference' => $groupcashbooksdata['list-b']->where('transaction_id', $item)->first()->transaction_reference,
				'amount'                => $groupcashbooksdata['list-b']->where('transaction_id', $item)->sum('amount')
			];
		}

		$groupcashbooksdata['list-b-view'] = collect($credit)->paginate(25); // $credit;

		$groupcashbooksdata['working-debit'] = array_sum($groupcashbooksdata['list-a']->pluck('amount')->toArray());
		$groupcashbooksdata['working-credit'] = array_sum($groupcashbooksdata['list-b']->pluck('amount')->toArray());
		
		$groupcashbooksdata['opening-balance'] = 0; // $debit - $credit;
		$groupcashbooksdata['closing-balance'] = ($groupcashbooksdata['opening-balance'] + $groupcashbooksdata['working-debit']) - $groupcashbooksdata['working-credit'];

		$groupcashbooksdata["account"] = Accounts::find($id);
		$user = Users::where([['id', '=', Auth::id()]])->get();
		$module = Modules::where([['name', '=', 'GroupCashBooks']])->get();
		$groupcashbooksdata['usersaccountsroles'] = UsersAccountsRoles::where([['user_account', '=', $user[0]['user_account']], ['module', '=', $module[0]['id']]])->get();
		if (isset($groupcashbooksdata['usersaccountsroles'][0]) && $groupcashbooksdata['usersaccountsroles'][0]['_report'] == 0) {
			return view('admin.error.denied', compact('groupcashbooksdata'));
		} else {
			return view('admin.group_cash_books.report', compact('groupcashbooksdata'));
		}
	} */

	public function report($id)
	{
		$groupcashbooksdata['id'] = $id;
		$groupcashbooksdata['startDate'] = Carbon::now()->subDays(5)->toDateString();
		$groupcashbooksdata['endDate'] = Carbon::now()->toDateString();
		$groupcashbooksdata['company'] = Companies::all();
		
		// Renamed occurrences of list-b to list-a
		$groupcashbooksdata['list-b'] = GroupCashBooks::where(["account" => $id, "transaction_type" => 2])
			->whereBetween('transaction_date', [$groupcashbooksdata['startDate'], $groupcashbooksdata['endDate']])
			->orderBy('transaction_date', 'DESC')
			->get(); // debit

		$debit_items = array_unique($groupcashbooksdata['list-b']->pluck('transaction_id')->toArray());
		$debit = [];
		foreach ($debit_items as $key => $item) {
			$debit[] = (object) [
				'transaction_id'        => $item,
				'transaction_date'      => $groupcashbooksdata['list-b']->where('transaction_id', $item)->first()->transaction_date,
				'transaction_reference' => $groupcashbooksdata['list-b']->where('transaction_id', $item)->first()->transaction_reference,
				'amount'                => $groupcashbooksdata['list-b']->where('transaction_id', $item)->sum('amount')
			];
		}

		$groupcashbooksdata['list-b-view'] = collect($debit)->paginate(25); // $debit;

		// Renamed occurrences of list-a to list-b
		$groupcashbooksdata['list-a'] = GroupCashBooks::where(["account" => $id, "transaction_type" => 1])
			->whereBetween('transaction_date', [$groupcashbooksdata['startDate'], $groupcashbooksdata['endDate']])
			->orderBy('transaction_date', 'DESC')
			->get(); // credit

		$credit_items = array_unique($groupcashbooksdata['list-a']->pluck('transaction_id')->toArray());
		$credit = [];
		foreach ($credit_items as $key => $item) {
			$credit[] = (object) [
				'transaction_id'        => $item,
				'transaction_date'      => $groupcashbooksdata['list-a']->where('transaction_id', $item)->first()->transaction_date,
				'transacting_group'     => isset($groupcashbooksdata['list-a']->where('transaction_id', $item)->first()->transacting_group) ? Groups::find($groupcashbooksdata['list-a']->where('transaction_id', $item)->first()->transacting_group) : null,
				'particulars'           => $groupcashbooksdata['list-a']->where('transaction_id', $item)->first()->particulars,
				'transaction_reference' => $groupcashbooksdata['list-a']->where('transaction_id', $item)->first()->transaction_reference,
				'amount'                => $groupcashbooksdata['list-a']->where('transaction_id', $item)->sum('amount')
			];
		}

		$groupcashbooksdata['list-a-view'] = collect($credit)->paginate(25); // $credit;

		$groupcashbooksdata['working-debit'] = array_sum($groupcashbooksdata['list-b']->pluck('amount')->toArray());
		$groupcashbooksdata['working-credit'] = array_sum($groupcashbooksdata['list-a']->pluck('amount')->toArray());
		
		$groupcashbooksdata['opening-balance'] = 0; // $debit - $credit;
		$groupcashbooksdata['closing-balance'] = ($groupcashbooksdata['opening-balance'] + $groupcashbooksdata['working-debit']) - $groupcashbooksdata['working-credit'];

		$groupcashbooksdata["account"] = Accounts::find($id);
		$user = Users::where([['id', '=', Auth::id()]])->get();
		$module = Modules::where([['name', '=', 'GroupCashBooks']])->get();
		$groupcashbooksdata['usersaccountsroles'] = UsersAccountsRoles::where([['user_account', '=', $user[0]['user_account']], ['module', '=', $module[0]['id']]])->get();

		// dd($groupcashbooksdata);


		if (isset($groupcashbooksdata['usersaccountsroles'][0]) && $groupcashbooksdata['usersaccountsroles'][0]['_report'] == 0) {
			return view('admin.error.denied', compact('groupcashbooksdata'));
		} else {
			return view('admin.group_cash_books.report', compact('groupcashbooksdata'));
		}
	}

	public function dateconverter(){

		$groupcashbooks=GroupCashBooks::all();

		foreach($groupcashbooks as $groupcashbook){
			
			$dates=explode("/", $groupcashbook->transaction_date);

			if(!$dates)
				$dates=explode("-", $groupcashbook->transaction_date);

			if(count($dates)==3 && $dates[1]>12){
				$groupcashbook->transaction_date=$dates[1]+"/"+$dates[0]+"/"+$dates[2];
			}

			if(str_contains($groupcashbook->transaction_date,'-')){
				$groupcashbook->transaction_date=str_replace("-",'/',$groupcashbook->transaction_date);
			}

			$groupcashbook->save();
		}
	}

	public function reportbydate($id, $startDate, $endDate)
	{
		$groupcashbooksdata['id'] = $id;
		$groupcashbooksdata['startDate'] = Carbon::parse($startDate)->toDateString();
		$groupcashbooksdata['endDate'] = Carbon::parse($endDate)->toDateString();

		$groupcashbooksdata['company'] = Companies::all();

		// Opening Transactions
		$groupcashbooksdata['OT'] = GroupCashBooks::where([
			"account" => $id
		])
		->whereDate('transaction_date', '<=' , $groupcashbooksdata['startDate'])
		->orderBy('transaction_date', 'DESC')
		->get();
		// opening-balance = opening-debit - opening-credit
		$groupcashbooksdata['opening-balance'] = array_sum($groupcashbooksdata['OT']->where('transaction_type', 2)->pluck('amount')->toArray()) - array_sum($groupcashbooksdata['OT']->where('transaction_type', 1)->pluck('amount')->toArray());

		// Working Transactions
		$groupcashbooksdata['WT'] = GroupCashBooks::where([
			"account" => $id
		])
		->whereBetween('transaction_date', [$groupcashbooksdata['startDate'], $groupcashbooksdata['endDate']])
		->orderBy('transaction_date', 'DESC')
		->get();

		$groupcashbooksdata['list-b'] = $groupcashbooksdata['WT']->where('transaction_type', 2);
		$debit_items = array_unique($groupcashbooksdata['list-b']->pluck('transaction_id')->toArray());
		$debit = [];
		foreach ($debit_items as $key => $item) {
			$debit[] = (object) [
				'transaction_id'        => $item,
				'transaction_date'      => $groupcashbooksdata['list-b']->where('transaction_id', $item)->first()->transaction_date,
				'transacting_group'     => isset($groupcashbooksdata['list-b']->where('transaction_id', $item)->first()->transacting_group) ? Groups::find($groupcashbooksdata['list-b']->where('transaction_id', $item)->first()->transacting_group) : null,
				'transaction_reference' => $groupcashbooksdata['list-b']->where('transaction_id', $item)->first()->transaction_reference,
				'amount'                => $groupcashbooksdata['list-b']->where('transaction_id', $item)->sum('amount')
			];
		}
		$groupcashbooksdata['list-b-view'] = collect($debit)->paginate(25);
	
		$groupcashbooksdata['list-a'] = $groupcashbooksdata['WT']->where('transaction_type', 1);
		$credit_items = array_unique($groupcashbooksdata['list-a']->pluck('transaction_id')->toArray());
		$credit = [];
		foreach ($credit_items as $key => $item) {
			$credit[] = (object) [
				'transaction_id'        => $item,
				'transaction_date'      => $groupcashbooksdata['list-a']->where('transaction_id', $item)->first()->transaction_date,
				'particulars'           => $groupcashbooksdata['list-a']->where('transaction_id', $item)->first()->particulars,
				'transaction_reference' => $groupcashbooksdata['list-a']->where('transaction_id', $item)->first()->transaction_reference,
				'amount'                => $groupcashbooksdata['list-a']->where('transaction_id', $item)->sum('amount')
			];
		}
		$groupcashbooksdata['list-a-view'] = collect($credit)->paginate(25);	

		$groupcashbooksdata['working-debit'] = array_sum($groupcashbooksdata['list-a']->pluck('amount')->toArray());
		$groupcashbooksdata['working-credit'] = array_sum($groupcashbooksdata['list-b']->pluck('amount')->toArray());
		
		// closing-balance = (opening-balance + working-debit) - working-credit
		$groupcashbooksdata['closing-balance'] = ($groupcashbooksdata['opening-balance'] +  $groupcashbooksdata['working-debit']) - $groupcashbooksdata['working-credit'];

		$groupcashbooksdata["account"] = Accounts::find($id);

		$user = Users::where([['id', '=', Auth::id()]])->get();

		$module = Modules::where([['name', '=', 'GroupCashBooks']])->get();

		$groupcashbooksdata['usersaccountsroles'] = UsersAccountsRoles::where([['user_account', '=', $user[0]['user_account']], ['module', '=', $module[0]['id']]])->get();

		if (isset($groupcashbooksdata['usersaccountsroles'][0]) && $groupcashbooksdata['usersaccountsroles'][0]['_report'] == 0) {
			return view('admin.error.denied', compact('groupcashbooksdata'));
		} else {
			return view('admin.group_cash_books.report', compact('groupcashbooksdata'));
		}
	}

	public function chart()
	{
		return view('admin.group_cash_books.chart');
	}

	public function store(Request $request)
	{
		$groupcashbooks = new GroupCashBooks();
		$groupcashbooks->transaction_id = $request->get('transaction_id');
		$groupcashbooks->transacting_group = $request->get('transacting_group');
		$groupcashbooks->transaction_date = \Carbon\Carbon::parse($request->transaction_date)->toDateString();
		$groupcashbooks->transaction_reference = $request->get('transaction_reference');
		$groupcashbooks->transaction_type = $request->get('transaction_type');
		$groupcashbooks->amount = $request->get('amount');
		$groupcashbooks->payment_mode = $request->get('payment_mode');
		$response = array();
		$user = Users::where([['id', '=', Auth::id()]])->get();
		$module = Modules::where([['name', '=', 'GroupCashBooks']])->get();
		$groupcashbooksdata['usersaccountsroles'] = UsersAccountsRoles::where([['user_account', '=', $user[0]['user_account']], ['module', '=', $module[0]['id']]])->get();
		if (isset($groupcashbooksdata['usersaccountsroles'][0]) && $groupcashbooksdata['usersaccountsroles'][0]['_show'] == 1) {
			try {
				if ($groupcashbooks->save()) {
					$response['status'] = '1';
					$response['message'] = 'group cash books Added successfully';
					return json_encode($response);
				} else {
					$response['status'] = '0';
					$response['message'] = 'Failed to add group cash books. Please try again';
					return json_encode($response);
				}
			} catch (Exception $e) {
				$response['status'] = '0';
				$response['message'] = 'An Error occured while attempting to add group cash books. Please try again';
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
		$groupcashbooksdata['groups'] = Groups::all();
		$groupcashbooksdata['paymentmodes'] = PaymentModes::all();
		$groupcashbooksdata['data'] = GroupCashBooks::find($id);
		$user = Users::where([['id', '=', Auth::id()]])->get();
		$module = Modules::where([['name', '=', 'GroupCashBooks']])->get();
		$groupcashbooksdata['usersaccountsroles'] = UsersAccountsRoles::where([['user_account', '=', $user[0]['user_account']], ['module', '=', $module[0]['id']]])->get();
		if (isset($groupcashbooksdata['usersaccountsroles'][0]) && $groupcashbooksdata['usersaccountsroles'][0]['_edit'] == 0) {
			return view('admin.error.denied', compact('groupcashbooksdata'));
		} else {
			return view('admin.group_cash_books.edit', compact('groupcashbooksdata', 'id'));
		}
	}

	public function show($id)
	{
		$groupcashbooksdata['groups'] = Groups::all();
		$groupcashbooksdata['paymentmodes'] = PaymentModes::all();
		$groupcashbooksdata['data'] = GroupCashBooks::find($id);
		$user = Users::where([['id', '=', Auth::id()]])->get();
		$module = Modules::where([['name', '=', 'GroupCashBooks']])->get();
		$groupcashbooksdata['usersaccountsroles'] = UsersAccountsRoles::where([['user_account', '=', $user[0]['user_account']], ['module', '=', $module[0]['id']]])->get();
		if (isset($groupcashbooksdata['usersaccountsroles'][0]) && $groupcashbooksdata['usersaccountsroles'][0]['_show'] == 0) {
			return view('admin.error.denied', compact('groupcashbooksdata'));
		} else {
			return view('admin.group_cash_books.show', compact('groupcashbooksdata', 'id'));
		}
	}

	public function update(Request $request, $id)
	{
		$groupcashbooks = GroupCashBooks::find($id);
		$groupcashbooksdata['groups'] = Groups::all();
		$groupcashbooksdata['paymentmodes'] = PaymentModes::all();
		$groupcashbooks->transaction_id = $request->get('transaction_id');
		$groupcashbooks->transacting_group = $request->get('transacting_group');
		$groupcashbooks->transaction_date = \Carbon\Carbon::parse($request->transaction_date)->toDateString();
		$groupcashbooks->transaction_reference = $request->get('transaction_reference');
		$groupcashbooks->transaction_type = $request->get('transaction_type');
		$groupcashbooks->amount = $request->get('amount');
		$groupcashbooks->payment_mode = $request->get('payment_mode');
		$user = Users::where([['id', '=', Auth::id()]])->get();
		$module = Modules::where([['name', '=', 'GroupCashBooks']])->get();
		$groupcashbooksdata['usersaccountsroles'] = UsersAccountsRoles::where([['user_account', '=', $user[0]['user_account']], ['module', '=', $module[0]['id']]])->get();
		if ($groupcashbooksdata['usersaccountsroles'][0]['_edit'] == 0) {
			return view('admin.error.denied', compact('groupcashbooksdata'));
		} else {
			$groupcashbooks->save();
			$groupcashbooksdata['data'] = GroupCashBooks::find($id);
			return view('admin.group_cash_books.edit', compact('groupcashbooksdata', 'id'));
		}
	}

	public function destroy($id)
	{
		$groupcashbooks = GroupCashBooks::find($id);
		$user = Users::where([['id', '=', Auth::id()]])->get();
		$module = Modules::where([['name', '=', 'GroupCashBooks']])->get();
		$groupcashbooksdata['usersaccountsroles'] = UsersAccountsRoles::where([['user_account', '=', $user[0]['user_account']], ['module', '=', $module[0]['id']]])->get();
		if (isset($groupcashbooksdata['usersaccountsroles'][0]) && $groupcashbooksdata['usersaccountsroles'][0]['_delete'] == 1) {
			$groupcashbooks->delete();
		}
		return redirect('admin/groupcashbooks')->with('success', 'group cash books has been deleted!');
	}

	public function export($id, $startDate = NULL, $endDate = NULL)
	{
		$groupcashbooksdata['id'] = $id;
		$groupcashbooksdata['startDate'] = Carbon::parse($startDate)->toDateString();
		$groupcashbooksdata['endDate'] = Carbon::parse($endDate)->toDateString();


		// Opening Transactions
		$groupcashbooksdata['OT'] = GroupCashBooks::where([
			"account" => $id
		])
		->whereDate('transaction_date', '<=' , $groupcashbooksdata['startDate'])
		->orderBy('transaction_date', 'DESC')
		->get();
		// opening-balance = opening-debit - opening-credit
		$groupcashbooksdata['opening-balance'] = array_sum($groupcashbooksdata['OT']->where('transaction_type', 2)->pluck('amount')->toArray()) - array_sum($groupcashbooksdata['OT']->where('transaction_type', 1)->pluck('amount')->toArray());

		// Working Transactions
		$groupcashbooks = GroupCashBooks::where([
			"account" => $id
		]);

		if(isset($startDate) && isset($groupcashbooksdata['endDate'])) {
			$groupcashbooks->whereBetween('transaction_date', [$groupcashbooksdata['startDate'], $groupcashbooksdata['endDate']]);
		}

		$groupcashbooksdata['WT'] = $groupcashbooks->orderBy('transaction_date', 'DESC')->get();

		$groupcashbooksdata['working-debit'] = array_sum($groupcashbooksdata['WT']->where('transaction_type', 2)->pluck('amount')->toArray());
		$groupcashbooksdata['working-credit'] = array_sum($groupcashbooksdata['WT']->where('transaction_type', 1)->pluck('amount')->toArray());
		
		// closing-balance = (opening-balance + working-debit) - working-credit
		$groupcashbooksdata['closing-balance'] = ($groupcashbooksdata['opening-balance'] +  $groupcashbooksdata['working-debit']) - $groupcashbooksdata['working-credit'];

		$debit = [];
		$credit = [];

		foreach($groupcashbooksdata['WT'] as $groupcash) {

			if ($groupcash->transaction_type == 2) {
				$debit[] = [
					'Transaction Date' => Carbon::parse($groupcash->transaction_date)->format('d-m-Y'),
					'Group ID' => isset($groupcash->transacting_group) ? $groupcash->groupmodel->group_number : '',
					'Transaction ID' => $groupcash->transaction_reference,
					'Group Name' => isset($groupcash->transacting_group) ? $groupcash->groupmodel->group_name : '',
					'Total Receipts' => number_format($groupcash->amount, 2)
				];

			} elseif ($groupcash->transaction_type == 1) {
				$credit[] = [
					'Transaction Date' => Carbon::parse($groupcash->transaction_date)->format('d-m-Y'),
					'Group ID' => isset($groupcash->transacting_group) ? $groupcash->groupmodel->group_number : '',
					'Transaction ID' => $groupcash->transaction_reference,
					'Group Name' => isset($groupcash->transacting_group) ? $groupcash->groupmodel->group_name : '',
					'Total Receipts' => number_format($groupcash->amount, 2)
				];
			}
		}

		$sheets['header'] = (new StyleBuilder())
			->setFontBold()
			->build();

		$sheets['rows']   = (new StyleBuilder())
			->setFontSize(11)
			// ->setShouldWrapText()
			->setBackgroundColor("EDEDED")
			->build();

		$sheets['data'] = new SheetCollection([
			'SUMMARY' => collect([
				[
					'Opening Balance' => number_format($groupcashbooksdata['opening-balance'], 2),
					'Closing Balance' => number_format($groupcashbooksdata['closing-balance'], 2),
					'Debit' => number_format($groupcashbooksdata['working-debit'], 2),
					'Credit' => number_format($groupcashbooksdata['working-credit'], 2)
				]
			]),
			'DEBIT' => collect($debit),
			'CREDIT' => collect($credit)
		]);

		return (new FastExcel($sheets['data']))
			->headerStyle($sheets['header'])
			->rowsStyle($sheets['rows'])
			->download('GROUP_CASH_BOOKS_' . $groupcashbooksdata['id'] . '.xlsx');
	}
}

