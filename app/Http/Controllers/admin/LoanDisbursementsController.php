<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\LoanDisbursements;
use App\Companies;
use App\Modules;
use App\Users;
use App\Loans;
use App\DisbursementStatuses;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;
use App\LoanDocuments;
use App\LoanCollaterals;
use App\LoanGuarantors;
use Carbon\Carbon;
use App\LoanAssets;
use App\InsuranceDeductionConfigurations;
use App\ProcessingFeeConfigurations;
use App\ClearingFeeConfigurations;
use App\LoanProducts;
use App\LoanProductAssets;
use App\Clients;
use App\GroupCashBooks;
use App\LoanStatuses;
use App\InterestRateTypes;
use App\InterestPaymentMethods;
use App\LoanPaymentDurations;
use App\ProductStocks;
use App\LoanPaymentFrequencies;
use App\GracePeriods;
use App\DisbursementModes;
use App\FineTypes;
use App\FineChargeFrequencies;
use App\PageCollection;
use App\FineChargePeriods;
use App\ProductDisbursementConfigurations;
use Illuminate\Support\Facades\DB;
use App\EntryTypes;
use App\GeneralLedgers;
use App\PaymentModes;
use App\SalesOrderMarginAccountMappings;

class LoanDisbursementsController extends Controller
{

	public function __construct()
	{
		$this->middleware('auth');
	}
	public function index()
	{
		$approvedloans = LoanStatuses::where([['code', '=', '002']])->get();

		$loandisbursementsdata['approvedstatus'] = $approvedloans[0]->id;

		$loandisbursementsdata['loans'] = Loans::where([['status', '=', $approvedloans[0]->id]])->orderBy('loan_number', 'desc')->get();

		$disbursementStatus = DisbursementStatuses::where([['code', '=', '002']])->get();

		$loandisbursementsdata['disbursementstatuses'] = DisbursementStatuses::all();

		$loandisbursementsdata['list'] = LoanDisbursements::all();
		$user = Users::where([['id', '=', Auth::id()]])->get();
		$module = Modules::where([['name', '=', 'LoanDisbursements']])->get();
		$loandisbursementsdata['usersaccountsroles'] = UsersAccountsRoles::where([['user_account', '=', $user[0]['user_account']], ['module', '=', $module[0]['id']]])->get();
		if ($loandisbursementsdata['usersaccountsroles'][0]['_add'] == 0 && $loandisbursementsdata['usersaccountsroles'][0]['_list'] == 0 && $loandisbursementsdata['usersaccountsroles'][0]['_edit'] == 0 && $loandisbursementsdata['usersaccountsroles'][0]['_edit'] == 0 && $loandisbursementsdata['usersaccountsroles'][0]['_show'] == 0 && $loandisbursementsdata['usersaccountsroles'][0]['_delete'] == 0 && $loandisbursementsdata['usersaccountsroles'][0]['_report'] == 0) {
			return view('admin.error.denied', compact('loandisbursementsdata'));
		} else {
			return view('admin.loan_disbursements.index', compact('loandisbursementsdata'));
		}
	}

	function getloandisbursementlist(Request $request)
	{

		$start = $request->get("start");
		$length = $request->get("length");

		$searchvalue = $request->get("search")["value"];

		if (isset($searchvalue) && !empty($searchvalue)) {

			$data = DB::table("loan_disbursements")
				->join("loans", "loans.id", "=", "loan_disbursements.loan")
				->join("clients", "clients.id", "=", "loans.client")
				->join("disbursement_statuses", "disbursement_statuses.id", "=", "loan_disbursements.disbursement_status")
				->join("loan_products", "loan_products.id", "=", "loans.loan_product")
				->select(
					"loan_disbursements.id as loanDisbursementId",
					"loans.loan_number as loanNumber",
					DB::raw("CONCAT(clients.client_number,' ',clients.first_name,' ',clients.middle_name,' ',clients.last_name) as clientName"),
					"loan_disbursements.date as loanDisbursementDate",
					"loans.amount as loanAmount",
					"loans.amount_to_be_disbursed as disbursementAmount",
					"loans.date as loanDate",
					"disbursement_statuses.code as disbursementStatusCode",
					"disbursement_statuses.name as disbursementStatusName",
					DB::raw("CONCAT(loan_products.code,' ',loan_products.name) as loanProductName")
				)
				->where("loans.loan_number", "like", "%" . $searchvalue . "%")
				->orWhere("clients.client_number", "like", "%" . $searchvalue . "%")
				->orderBy("loan_disbursements.created_at", "desc")
				->skip($start)
				->take($length)
				->get();
		} else {
			$data = DB::table("loan_disbursements")
				->join("loans", "loans.id", "=", "loan_disbursements.loan")
				->join("clients", "clients.id", "=", "loans.client")
				->join("disbursement_statuses", "disbursement_statuses.id", "=", "loan_disbursements.disbursement_status")
				->join("loan_products", "loan_products.id", "=", "loans.loan_product")
				->select(
					"loan_disbursements.id as loanDisbursementId",
					"loans.loan_number as loanNumber",
					DB::raw("CONCAT(clients.client_number,' ',clients.first_name,' ',clients.middle_name,' ',clients.last_name) as clientName"),
					"loan_disbursements.date as loanDisbursementDate",
					"loans.amount as loanAmount",
					"loans.amount_to_be_disbursed as disbursementAmount",
					"loans.date as loanDate",
					"disbursement_statuses.code as disbursementStatusCode",
					"disbursement_statuses.name as disbursementStatusName",
					DB::raw("CONCAT(loan_products.code,' ',loan_products.name) as loanProductName")
				)
				->orderBy("loan_disbursements.created_at", "desc")
				->skip($start)
				->take($length)
				->get();
		}

		$totalcount = LoanDisbursements::all()->count();

		$collection = new PageCollection();
		$collection->aaData = $data;
		$collection->iTotalRecords = $totalcount;
		$collection->iTotalDisplayRecords = $totalcount;

		return json_encode($collection);
	}

	public function create()
	{
		$loandisbursementsdata;
		$approvedloans = LoanStatuses::where([['code', '=', '002']])->get();
		$loandisbursementsdata['loans'] = Loans::where([['status', '=', $approvedloans[0]->id]])->orderBy('loan_number', 'desc')->get();
		$loandisbursementsdata['disbursementstatuses'] = DisbursementStatuses::all();
		$user = Users::where([['id', '=', Auth::id()]])->get();
		$module = Modules::where([['name', '=', 'LoanDisbursements']])->get();
		$loandisbursementsdata['usersaccountsroles'] = UsersAccountsRoles::where([['user_account', '=', $user[0]['user_account']], ['module', '=', $module[0]['id']]])->get();
		if ($loandisbursementsdata['usersaccountsroles'][0]['_add'] == 0) {
			return view('admin.error.denied', compact('loandisbursementsdata'));
		} else {
			return view('admin.loan_disbursements.create', compact('loandisbursementsdata'));
		}
	}

	public function filter(Request $request)
	{
		$approvedloans = LoanStatuses::where([['code', '=', '002']])->get();
		$loandisbursementsdata['loans'] = Loans::where([['status', '=', $approvedloans[0]->id]])->orderBy('loan_number', 'desc')->get();
		$loandisbursementsdata['disbursementstatuses'] = DisbursementStatuses::all();
		$loandisbursementsdata['list'] = LoanDisbursements::where([['loan', 'LIKE', '%' . $request->get('loan') . '%'], ['disbursement_status', 'LIKE', '%' . $request->get('disbursement_status') . '%'],])->orWhereBetween('date', [$request->get('datefrom'), $request->get('dateto')])->get();
		$user = Users::where([['id', '=', Auth::id()]])->get();
		$module = Modules::where([['name', '=', 'LoanDisbursements']])->get();
		$loandisbursementsdata['usersaccountsroles'] = UsersAccountsRoles::where([['user_account', '=', $user[0]['user_account']], ['module', '=', $module[0]['id']]])->get();
		if ($loandisbursementsdata['usersaccountsroles'][0]['_add'] == 0 && $loandisbursementsdata['usersaccountsroles'][0]['_list'] == 0 && $loandisbursementsdata['usersaccountsroles'][0]['_edit'] == 0 && $loandisbursementsdata['usersaccountsroles'][0]['_edit'] == 0 && $loandisbursementsdata['usersaccountsroles'][0]['_show'] == 0 && $loandisbursementsdata['usersaccountsroles'][0]['_delete'] == 0 && $loandisbursementsdata['usersaccountsroles'][0]['_report'] == 0) {
			return view('admin.error.denied', compact('loandisbursementsdata'));
		} else {
			return view('admin.loan_disbursements.index', compact('loandisbursementsdata'));
		}
	}

	public function report()
	{
		$loandisbursementsdata['company'] = Companies::all();
		$loandisbursementsdata['list'] = LoanDisbursements::all();
		$user = Users::where([['id', '=', Auth::id()]])->get();
		$module = Modules::where([['name', '=', 'LoanDisbursements']])->get();
		$loandisbursementsdata['usersaccountsroles'] = UsersAccountsRoles::where([['user_account', '=', $user[0]['user_account']], ['module', '=', $module[0]['id']]])->get();
		if ($loandisbursementsdata['usersaccountsroles'][0]['_report'] == 0) {
			return view('admin.error.denied', compact('loandisbursementsdata'));
		} else {
			return view('admin.loan_disbursements.report', compact('loandisbursementsdata'));
		}
	}

	public function chart()
	{
		return view('admin.loan_disbursements.chart');
	}

	public function store(Request $request)
	{
		$loandisbursements = new LoanDisbursements();
		$loandisbursements->loan = $request->get('loan');
		$loandisbursements->disbursement_status = $request->get('disbursement_status');
		$loandisbursements->date = \Carbon\Carbon::parse($request->get('date'))->toDateTimeString();
		$response = array();
		$user = Users::where([['id', '=', Auth::id()]])->get();
		$module = Modules::where([['name', '=', 'LoanDisbursements']])->get();
		$loandisbursementsdata['usersaccountsroles'] = UsersAccountsRoles::where([['user_account', '=', $user[0]['user_account']], ['module', '=', $module[0]['id']]])->get();
		if ($loandisbursementsdata['usersaccountsroles'][0]['_show'] == 1) {
			try {
				if ($loandisbursements->save()) {
					$response['status'] = '1';
					$response['message'] = 'loan disbursements Added successfully';
					return json_encode($response);
				} else {
					$response['status'] = '0';
					$response['message'] = 'Failed to add loan disbursements. Please try again';
					return json_encode($response);
				}
			} catch (Exception $e) {
				$response['status'] = '0';
				$response['message'] = 'An Error occured while attempting to add loan disbursements. Please try again';
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
		$loandisbursementsdata['data'] = LoanDisbursements::find($id);
		$loan = $loandisbursementsdata['data']->loan;
		$loandisbursementsdata['disbursementloan'] = Loans::find($loan);
		$loandisbursementsdata['documents'] = LoanDocuments::where([['loan', '=', $id]])->orderBy('id', 'desc')->get();
		$loandisbursementsdata['guarantors'] = LoanGuarantors::where([['loan', '=', $id]])->orderBy('id', 'desc')->get();
		$loandisbursementsdata['collaterals'] = LoanCollaterals::where([['loan', '=', $id]])->orderBy('id', 'desc')->get();
		$loandisbursementsdata['loanproduct'] = LoanProducts::find($loandisbursementsdata['disbursementloan']->loan_product);;
		$loandisbursementsdata['assets'] = LoanAssets::where([["loan", "=", $loan]])->get();
		$loanproduct = $loandisbursementsdata['loanproduct'];
		// print_r($loandisbursementsdata['data']);
		// die();

		$loandisbursementsdata['loanschedule'] = app('App\Http\Controllers\admin\LoansController')->getloanschedule(Carbon::now(), $loanproduct->graceperiodmodel->number_of_days, $loanproduct->loanpaymentfrequencymodel->number_of_days, $loanproduct->loanpaymentdurationmodel->number_of_days, $loandisbursementsdata['disbursementloan']->total_loan_amount);
		$approvedloans = LoanStatuses::where([['code', '=', '002']])->get();
		$loandisbursementsdata['loans'] = Loans::where([['status', '=', $approvedloans[0]->id]])->orderBy('loan_number', 'desc')->get();

		$loandisbursementsdata['loanproducts'] = LoanProducts::all();
		$loandisbursementsdata['clients'] = Clients::all();
		$loandisbursementsdata['interestratetypes'] = InterestRateTypes::all();
		$loandisbursementsdata['disbursementstatuses'] = DisbursementStatuses::all();
		$loandisbursementsdata['interestpaymentmethods'] = InterestPaymentMethods::all();
		$loandisbursementsdata['loanpaymentdurations'] = LoanPaymentDurations::all();
		$loandisbursementsdata['loanpaymentfrequencies'] = LoanPaymentFrequencies::all();
		$loandisbursementsdata['graceperiods'] = GracePeriods::all();
		$loandisbursementsdata['disbursementmodes'] = DisbursementModes::all();
		$loandisbursementsdata['finetypes'] = FineTypes::all();
		$loandisbursementsdata['finechargefrequencies'] = FineChargeFrequencies::all();
		$loandisbursementsdata['finechargeperiods'] = FineChargePeriods::all();
		$loandisbursementsdata['loanstatuses'] = LoanStatuses::all();

		$user = Users::where([['id', '=', Auth::id()]])->get();
		$module = Modules::where([['name', '=', 'LoanDisbursements']])->get();
		$loandisbursementsdata['usersaccountsroles'] = UsersAccountsRoles::where([['user_account', '=', $user[0]['user_account']], ['module', '=', $module[0]['id']]])->get();
		if ($loandisbursementsdata['usersaccountsroles'][0]['_edit'] == 0) {
			return view('admin.error.denied', compact('loandisbursementsdata'));
		} else {
			return view('admin.loan_disbursements.edit', compact('loandisbursementsdata', 'id'));
		}
	}

	public function show($id)
	{
		$approvedloans = LoanStatuses::where([['code', '=', '002']])->get();
		$loandisbursementsdata['loans'] = Loans::where([['status', '=', $approvedloans[0]->id]])->orderBy('loan_number', 'desc')->get();
		$loandisbursementsdata['disbursementstatuses'] = DisbursementStatuses::all();
		$loandisbursementsdata['data'] = LoanDisbursements::find($id);
		$user = Users::where([['id', '=', Auth::id()]])->get();
		$module = Modules::where([['name', '=', 'LoanDisbursements']])->get();
		$loandisbursementsdata['usersaccountsroles'] = UsersAccountsRoles::where([['user_account', '=', $user[0]['user_account']], ['module', '=', $module[0]['id']]])->get();
		if ($loandisbursementsdata['usersaccountsroles'][0]['_show'] == 0) {
			return view('admin.error.denied', compact('loandisbursementsdata'));
		} else {
			return view('admin.loan_disbursements.show', compact('loandisbursementsdata', 'id'));
		}
	}

	public function update(Request $request, $id)
	{
		$loandisbursements = LoanDisbursements::find($id);
		$loandisbursementsdata['data'] = LoanDisbursements::find($id);
		$loan = $loandisbursementsdata['data']->loan;
		$loandisbursementsdata['disbursementloan'] = Loans::find($loan);
		$approvedloans = LoanStatuses::where([['code', '=', '002']])->get();
		$loandisbursementsdata['assets'] = LoanAssets::where([["loan", "=", $loan]])->get();
		$loandisbursementsdata['loans'] = Loans::where([['status', '=', $approvedloans[0]->id]])->orderBy('loan_number', 'desc')->get();

		$loandisbursementsdata['loanproducts'] = LoanProducts::all();
		$loandisbursementsdata['clients'] = Clients::all();
		$loandisbursementsdata['interestratetypes'] = InterestRateTypes::all();
		$loandisbursementsdata['disbursementstatuses'] = DisbursementStatuses::all();
		$loandisbursementsdata['interestpaymentmethods'] = InterestPaymentMethods::all();
		$loandisbursementsdata['loanpaymentdurations'] = LoanPaymentDurations::all();
		$loandisbursementsdata['loanpaymentfrequencies'] = LoanPaymentFrequencies::all();
		$loandisbursementsdata['graceperiods'] = GracePeriods::all();
		$loandisbursementsdata['disbursementmodes'] = DisbursementModes::all();
		$loandisbursementsdata['finetypes'] = FineTypes::all();
		$loandisbursementsdata['finechargefrequencies'] = FineChargeFrequencies::all();
		$loandisbursementsdata['finechargeperiods'] = FineChargePeriods::all();
		$loandisbursementsdata['loanstatuses'] = LoanStatuses::all();
		$loandisbursements->loan = $request->get('loan');
		$loandisbursements->disbursement_status = $request->get('disbursement_status');
		$loandisbursements->date = \Carbon\Carbon::parse($request->get('date'))->toDateTimeString();
		$loandisbursements->date = \Carbon\Carbon::parse($request->get('date'))->toDateTimeString();
		$user = Users::where([['id', '=', Auth::id()]])->get();
		$module = Modules::where([['name', '=', 'LoanDisbursements']])->get();

		$loan = $loandisbursementsdata['disbursementloan'];

		$productdisbursementconfigurations = ProductDisbursementConfigurations::where([['loan_product', '=', $loan->loan_product], ['disbursement_mode', '=', $loan->disbursement_mode]])->get();

		$loandisbursementsdata['usersaccountsroles'] = UsersAccountsRoles::where([['user_account', '=', $user[0]['user_account']], ['module', '=', $module[0]['id']]])->get();

		if ($loandisbursementsdata['usersaccountsroles'][0]['_edit'] == 0) {
			return view('admin.error.denied', compact('loandisbursementsdata'));
		} else {
			return DB::transaction(function () use ($loandisbursements, $productdisbursementconfigurations, $loan, $id, $loandisbursementsdata, $user) {

				try {

					$disbursestatus = DisbursementStatuses::where([['code', '=', '002']])->get();
					$pendingstatus = DisbursementStatuses::where([['code', '=', '001']])->get();
					$disbursed = LoanDisbursements::find($id);

					if ($disbursed->disbursement_status == $pendingstatus[0]['id']) {

						if ($disbursestatus[0]['id'] == $loandisbursements->disbursement_status) {

							if ($loan->loanproductmodel->is_asset == "1") {

								$loanassets = LoanAssets::where([["loan", "=", $loan->id]])->get();

								for ($r = 0; $r < Count($loanassets); $r++) {

									$productstock = ProductStocks::where([["product", "=", $loanassets[$r]->asset], ["store", "=", $loan->store]])->get()->first();

									if ($loanassets[$r]->quantity > 0) {
										if (!isset($productstock) || $productstock->size < $loanassets[$r]->quantity) {


											$loandisbursementsdata['response'] = "0";
											$loandisbursementsdata['result'] = "No Stock";
											$loandisbursementsdata['data'] = LoanDisbursements::find($id);
											return view('admin.loan_disbursements.edit', compact('loandisbursementsdata', 'id'));
										}
									} else {
										continue;
									}

									$productstock->size = $productstock->size - $loanassets[$r]->quantity;

									$productstock->save();
								}
							}

							$debit = EntryTypes::where([['code', '=', '001']])->get();
							$credit = EntryTypes::where([['code', '=', '002']])->get();

							$generalLedger = new GeneralLedgers();

							$insurancedeductionconfiguration = InsuranceDeductionConfigurations::where([['loan_product', '=', $loan->loan_product], ['disbursement_mode', '=', $loan->disbursement_mode]])->get();

							if (isset($insurancedeductionconfiguration[0])) {

								$debitAccount = $insurancedeductionconfiguration[0]->debit_account;
								$creditAccount = $insurancedeductionconfiguration[0]->credit_account;

								$debit = EntryTypes::where([['code', '=', '001']])->get();
								$credit = EntryTypes::where([['code', '=', '002']])->get();

								$generalLedger = new GeneralLedgers();
								$generalLedger->account = $debitAccount;
								$generalLedger->entry_type = $debit[0]['id'];
								$generalLedger->transaction_number = $loandisbursements->transaction_reference;
								$generalLedger->amount = $loan->insurance_deduction_fee;
								$generalLedger->date = $loandisbursements->date;
								$generalLedger->save();

								$generalLedger = new GeneralLedgers();
								$generalLedger->account = $creditAccount;
								$generalLedger->entry_type = $credit[0]['id'];
								$generalLedger->transaction_number = $loandisbursements->transaction_reference;
								$generalLedger->amount = $loan->insurance_deduction_fee;
								$generalLedger->date = $loandisbursements->date;
								$generalLedger->save();

								$groupcashbook7 = new GroupCashBooks();

								$groupcashbook7->transaction_id = $loan->loan_number;
								$groupcashbook7->transaction_reference = $loandisbursements->transaction_reference;
								$groupcashbook7->transaction_date = $loandisbursements->date;
								$groupcashbook7->transaction_type = 2;
								$groupcashbook7->transacting_group = null;
								$groupcashbook7->amount = $loan->insurance_deduction_fee;
								$groupcashbook7->disbursement_mode = $loan->disbursement_mode;
								$groupcashbook7->lgf = 0;
								$groupcashbook7->account = $debitAccount;
								$groupcashbook7->loan_principal = 0;
								$groupcashbook7->loan_interest = 0;
								$groupcashbook7->mpesa_charges = 0;
								$groupcashbook7->fine = 0;
								$groupcashbook7->processing_fees = 0;
								$groupcashbook7->insurance_deduction_fees = 0;
								$groupcashbook7->collecting_officer = $user[0]->name;
								$groupcashbook7->clearing_fees = 0;
								$groupcashbook7->particulars = $loan->clientmodel->first_name . " " . $loan->clientmodel->middle_name . " " . $loan->clientmodel->last_name . " loan disbursement insurance fee";

								$groupcashbook7->save();

								$groupcashbook8 = new GroupCashBooks();

								$groupcashbook8->transaction_id = $loan->loan_number;
								$groupcashbook8->transaction_reference = $loandisbursements->transaction_reference;
								$groupcashbook8->transaction_date = $loandisbursements->date;
								$groupcashbook8->transaction_type = 1;
								$groupcashbook8->disbursement_mode = $loan->disbursement_mode;
								$groupcashbook8->transacting_group = null;
								$groupcashbook8->amount = $loan->insurance_deduction_fee;
								$groupcashbook8->lgf = 0;
								$groupcashbook8->account = $creditAccount;
								$groupcashbook8->loan_principal = 0;
								$groupcashbook8->loan_interest = 0;
								$groupcashbook8->mpesa_charges = 0;
								$groupcashbook8->fine = 0;
								$groupcashbook8->processing_fees = 0;
								$groupcashbook8->insurance_deduction_fees = 0;
								$groupcashbook8->collecting_officer = $user[0]->name;
								$groupcashbook8->clearing_fees = 0;
								$groupcashbook8->particulars = $loan->clientmodel->first_name . " " . $loan->clientmodel->middle_name . " " . $loan->clientmodel->last_name . " loan disbursement insurance fee";

								$groupcashbook8->save();
							}

							$clearingfeeconfiguration = ClearingFeeConfigurations::where([['loan_product', '=', $loan->loan_product], ['disbursement_mode', '=', $loan->disbursement_mode]])->get();

							if (isset($clearingfeeconfiguration[0])) {

								$debitAccount = $clearingfeeconfiguration[0]->debit_account;
								$creditAccount = $clearingfeeconfiguration[0]->credit_account;

								$debit = EntryTypes::where([['code', '=', '001']])->get();
								$credit = EntryTypes::where([['code', '=', '002']])->get();

								$generalLedger = new GeneralLedgers();
								$generalLedger->account = $debitAccount;
								$generalLedger->entry_type = $debit[0]['id'];
								$generalLedger->transaction_number = $loandisbursements->transaction_reference;
								$generalLedger->amount = $loan->clearing_fee;
								$generalLedger->date = $loandisbursements->date;
								$generalLedger->save();

								$generalLedger = new GeneralLedgers();
								$generalLedger->account = $creditAccount;
								$generalLedger->entry_type = $credit[0]['id'];
								$generalLedger->transaction_number = $loandisbursements->transaction_reference;
								$generalLedger->amount = $loan->clearing_fee;
								$generalLedger->date = $loandisbursements->date;
								$generalLedger->save();

								$groupcashbook5 = new GroupCashBooks();

								$groupcashbook5->transaction_id = $loan->loan_number;
								$groupcashbook5->transaction_reference = $loandisbursements->transaction_reference;
								$groupcashbook5->transaction_date = $loandisbursements->date;
								$groupcashbook5->transaction_type = 2;
								$groupcashbook5->transacting_group = null;
								$groupcashbook5->amount =  $loan->clearing_fee;
								$groupcashbook5->disbursement_mode = $loan->disbursement_mode;
								$groupcashbook5->lgf = 0;
								$groupcashbook5->account = $debitAccount;
								$groupcashbook5->loan_principal = 0;
								$groupcashbook5->loan_interest = 0;
								$groupcashbook5->mpesa_charges = 0;
								$groupcashbook5->fine = 0;
								$groupcashbook5->processing_fees = 0;
								$groupcashbook5->insurance_deduction_fees = 0;
								$groupcashbook5->collecting_officer = $user[0]->name;
								$groupcashbook5->clearing_fees = 0;
								$groupcashbook5->particulars = $loan->clientmodel->first_name . " " . $loan->clientmodel->middle_name . " " . $loan->clientmodel->last_name . " loan disbursement clearing fee";

								$groupcashbook5->save();

								$groupcashbook6 = new GroupCashBooks();

								$groupcashbook6->transaction_id = $loan->loan_number;
								$groupcashbook6->transaction_reference = $loandisbursements->transaction_reference;
								$groupcashbook6->transaction_date = $loandisbursements->date;
								$groupcashbook6->transaction_type = 1;
								$groupcashbook6->disbursement_mode = $loan->disbursement_mode;
								$groupcashbook6->transacting_group = null;
								$groupcashbook6->amount = $loan->clearing_fee;
								$groupcashbook6->lgf = 0;
								$groupcashbook6->account = $creditAccount;
								$groupcashbook6->loan_principal = 0;
								$groupcashbook6->loan_interest = 0;
								$groupcashbook6->mpesa_charges = 0;
								$groupcashbook6->fine = 0;
								$groupcashbook6->processing_fees = 0;
								$groupcashbook6->insurance_deduction_fees = 0;
								$groupcashbook6->collecting_officer = $user[0]->name;
								$groupcashbook6->clearing_fees = 0;
								$groupcashbook6->particulars = $loan->clientmodel->first_name . " " . $loan->clientmodel->middle_name . " " . $loan->clientmodel->last_name . " loan disbursement clearing fee";

								$groupcashbook6->save();
							}

							$processingfeeconfiguration = ProcessingFeeConfigurations::where([['loan_product', '=', $loan->loan_product], ['disbursement_mode', '=', $loan->disbursement_mode]])->get();

							$debit = EntryTypes::where([['code', '=', '001']])->get();
							$credit = EntryTypes::where([['code', '=', '002']])->get();

							if (isset($processingfeeconfiguration[0])) {

								$debitAccount = $processingfeeconfiguration[0]->debit_account;
								$creditAccount = $processingfeeconfiguration[0]->credit_account;


								$generalLedger = new GeneralLedgers();
								$generalLedger->account = $debitAccount;
								$generalLedger->entry_type = $debit[0]['id'];
								$generalLedger->transaction_number = $loandisbursements->transaction_reference;
								$generalLedger->amount = $loan->processing_fee;
								$generalLedger->date = $loandisbursements->date;
								$generalLedger->save();

								$generalLedger = new GeneralLedgers();
								$generalLedger->account = $creditAccount;
								$generalLedger->entry_type = $credit[0]['id'];
								$generalLedger->transaction_number = $loandisbursements->transaction_reference;
								$generalLedger->amount = $loan->processing_fee;
								$generalLedger->date = $loandisbursements->date;
								$generalLedger->save();

								$groupcashbook3 = new GroupCashBooks();

								$groupcashbook3->transaction_id = $loan->loan_number;
								$groupcashbook3->transaction_reference = $loandisbursements->transaction_reference;
								$groupcashbook3->transaction_date = $loandisbursements->date;
								$groupcashbook3->transaction_type = 2;
								$groupcashbook3->transacting_group = null;
								$groupcashbook3->amount =  $loan->processing_fee;
								$groupcashbook3->disbursement_mode = $loan->disbursement_mode;
								$groupcashbook3->lgf = 0;
								$groupcashbook3->account = $debitAccount;
								$groupcashbook3->loan_principal = 0;
								$groupcashbook3->loan_interest = 0;
								$groupcashbook3->mpesa_charges = 0;
								$groupcashbook3->fine = 0;
								$groupcashbook3->processing_fees = 0;
								$groupcashbook3->insurance_deduction_fees = 0;
								$groupcashbook3->collecting_officer = $user[0]->name;
								$groupcashbook3->clearing_fees = 0;
								$groupcashbook3->particulars = $loan->clientmodel->first_name . " " . $loan->clientmodel->middle_name . " " . $loan->clientmodel->last_name . " loan disbursement processing fee";

								$groupcashbook3->save();

								$groupcashbook4 = new GroupCashBooks();

								$groupcashbook4->transaction_id = $loan->loan_number;
								$groupcashbook4->transaction_reference = $loandisbursements->transaction_reference;
								$groupcashbook4->transaction_date = $loandisbursements->date;
								$groupcashbook4->transaction_type = 1;
								$groupcashbook4->disbursement_mode = $loan->disbursement_mode;
								$groupcashbook4->transacting_group = null;
								$groupcashbook4->amount = $loan->processing_fee;
								$groupcashbook4->lgf = 0;
								$groupcashbook4->account = $creditAccount;
								$groupcashbook4->loan_principal = 0;
								$groupcashbook4->loan_interest = 0;
								$groupcashbook4->mpesa_charges = 0;
								$groupcashbook4->fine = 0;
								$groupcashbook4->processing_fees = 0;
								$groupcashbook4->insurance_deduction_fees = 0;
								$groupcashbook4->collecting_officer = $user[0]->name;
								$groupcashbook4->clearing_fees = 0;
								$groupcashbook4->particulars = $loan->clientmodel->first_name . " " . $loan->clientmodel->middle_name . " " . $loan->clientmodel->last_name . " loan disbursement processing fee";

								$groupcashbook4->save();
							}

							if ($loan->loanproductmodel->is_asset == "0") {

								if (isset($productdisbursementconfigurations[0]['debit_account'])) {

									$generalLedger->account = $productdisbursementconfigurations[0]['debit_account'];
									$generalLedger->entry_type = $debit[0]['id'];
									$generalLedger->transaction_number = $loan->loan_number;
									$generalLedger->amount = $loan->amount_to_be_disbursed;
									$generalLedger->date = $loandisbursements->date;
									$generalLedger->save();


									$generalLedger = new GeneralLedgers();
									$generalLedger->account = $productdisbursementconfigurations[0]['credit_account'];
									$generalLedger->entry_type = $credit[0]['id'];
									$generalLedger->transaction_number = $loan->loan_number;
									$generalLedger->amount = $loan->amount_to_be_disbursed;
									$generalLedger->date = $loandisbursements->date;
									$generalLedger->save();

									$groupcashbook = new GroupCashBooks();

									$groupcashbook->transaction_id = $loan->loan_number;
									$groupcashbook->transaction_reference = $loandisbursements->transaction_reference;
									$groupcashbook->transaction_date = $loandisbursements->date;
									$groupcashbook->transaction_type = 2;
									$groupcashbook->transacting_group = null;
									$groupcashbook->amount = $loan->amount_to_be_disbursed;
									$groupcashbook->disbursement_mode = $loan->disbursement_mode;
									$groupcashbook->lgf = 0;
									$groupcashbook->account = $productdisbursementconfigurations[0]['debit_account'];
									$groupcashbook->loan_principal = 0;
									$groupcashbook->loan_interest = 0;
									$groupcashbook->mpesa_charges = 0;
									$groupcashbook->fine = 0;
									$groupcashbook->processing_fees = 0;
									$groupcashbook->insurance_deduction_fees = 0;
									$groupcashbook->collecting_officer = $user[0]->name;
									$groupcashbook->clearing_fees = 0;
									$groupcashbook->particulars = $loan->clientmodel->first_name . " " . $loan->clientmodel->middle_name . " " . $loan->clientmodel->last_name . " loan disbursement";

									$groupcashbook->save();


									$groupcashbook2 = new GroupCashBooks();

									$groupcashbook2->transaction_id = $loan->loan_number;
									$groupcashbook2->transaction_reference = $loandisbursements->transaction_reference;
									$groupcashbook2->transaction_date = $loandisbursements->date;
									$groupcashbook2->transaction_type = 1;
									$groupcashbook2->disbursement_mode = $loan->disbursement_mode;
									$groupcashbook2->transacting_group = null;
									$groupcashbook2->amount = $loan->amount_to_be_disbursed;
									$groupcashbook2->lgf = 0;
									$groupcashbook2->account = $productdisbursementconfigurations[0]['credit_account'];
									$groupcashbook2->loan_principal = 0;
									$groupcashbook2->loan_interest = 0;
									$groupcashbook2->mpesa_charges = 0;
									$groupcashbook2->fine = 0;
									$groupcashbook2->processing_fees = 0;
									$groupcashbook2->insurance_deduction_fees = 0;
									$groupcashbook2->collecting_officer = $user[0]->name;
									$groupcashbook2->clearing_fees = 0;
									$groupcashbook2->particulars = $loan->clientmodel->first_name . " " . $loan->clientmodel->middle_name . " " . $loan->clientmodel->last_name . " loan disbursement";

									$groupcashbook2->save();
								} else {
									$loandisbursementsdata['result'] = "productdisbursementconfigurations not found";
									$loandisbursementsdata['response'] = "0";
									$loandisbursementsdata['data'] = LoanDisbursements::find($id);
									return view('admin.loan_disbursements.edit', compact('loandisbursementsdata', 'id'));
								}
							} else {


								if (isset($productdisbursementconfigurations[0]['debit_account'])) {

									$loanassets = LoanAssets::where([["loan", "=", $loan->id]])->get();

									$purchaseAmount = 0;

									for ($r = 0; $r < Count($loanassets); $r++) {
										$purchaseAmount = $purchaseAmount + ($loanassets[$r]->quantity * $loanassets[$r]->assetmodel->buying_price);
									}

									$generalLedger->account = $productdisbursementconfigurations[0]['debit_account'];
									$generalLedger->entry_type = $debit[0]['id'];
									$generalLedger->transaction_number = $loan->loan_number;
									$generalLedger->amount = $purchaseAmount;
									$generalLedger->date = $loandisbursements->date;
									$generalLedger->save();


									$generalLedger = new GeneralLedgers();
									$generalLedger->account = $productdisbursementconfigurations[0]['credit_account'];
									$generalLedger->entry_type = $credit[0]['id'];
									$generalLedger->transaction_number = $loan->loan_number;
									$generalLedger->amount = $purchaseAmount;
									$generalLedger->date = $loandisbursements->date;
									$generalLedger->save();

									$groupcashbook = new GroupCashBooks();

									$groupcashbook->transaction_id = $loan->loan_number;
									$groupcashbook->transaction_reference = $loandisbursements->transaction_reference;
									$groupcashbook->transaction_date = $loandisbursements->date;
									$groupcashbook->transaction_type = 2;
									$groupcashbook->transacting_group = null;
									$groupcashbook->amount = $purchaseAmount;
									$groupcashbook->disbursement_mode = $loan->disbursement_mode;
									$groupcashbook->lgf = 0;
									$groupcashbook->account = $productdisbursementconfigurations[0]['debit_account'];
									$groupcashbook->loan_principal = 0;
									$groupcashbook->loan_interest = 0;
									$groupcashbook->mpesa_charges = 0;
									$groupcashbook->fine = 0;
									$groupcashbook->processing_fees = 0;
									$groupcashbook->insurance_deduction_fees = 0;
									$groupcashbook->collecting_officer = $user[0]->name;
									$groupcashbook->clearing_fees = 0;
									$groupcashbook->particulars = $loan->clientmodel->first_name . " " . $loan->clientmodel->middle_name . " " . $loan->clientmodel->last_name . " loan disbursement";

									$groupcashbook->save();

									$groupcashbook2 = new GroupCashBooks();

									$groupcashbook2->transaction_id = $loan->loan_number;
									$groupcashbook2->transaction_reference = $loandisbursements->transaction_reference;
									$groupcashbook2->transaction_date = $loandisbursements->date;
									$groupcashbook2->transaction_type = 1;
									$groupcashbook2->disbursement_mode = $loan->disbursement_mode;
									$groupcashbook2->transacting_group = null;
									$groupcashbook2->amount = $purchaseAmount;
									$groupcashbook2->lgf = 0;
									$groupcashbook2->account = $productdisbursementconfigurations[0]['credit_account'];
									$groupcashbook2->loan_principal = 0;
									$groupcashbook2->loan_interest = 0;
									$groupcashbook2->mpesa_charges = 0;
									$groupcashbook2->fine = 0;
									$groupcashbook2->processing_fees = 0;
									$groupcashbook2->insurance_deduction_fees = 0;
									$groupcashbook2->collecting_officer = $user[0]->name;
									$groupcashbook2->clearing_fees = 0;
									$groupcashbook2->particulars = $loan->clientmodel->first_name . " " . $loan->clientmodel->middle_name . " " . $loan->clientmodel->last_name . " loan disbursement";

									$groupcashbook2->save();

									$paymentmode = PaymentModes::where([["code", "=", "006"]])->get()->first();

									for ($r = 0; $r < Count($loanassets); $r++) {

										$margin = $loanassets[$r]->assetmodel->margin;

										$salesordermarginaccountmapping = SalesOrderMarginAccountMappings::where([["product", "=", $loanassets[$r]->asset], ["payment_mode", "=", $paymentmode->id]])->get()->first();

										if (!isset($salesordermarginaccountmapping)) {
											die("salesordermarginaccountmapping not found for " . $loanassets[$r]->assetmodel->name . " mode " . $paymentmode->name);
										}

										if ($loanassets[$r]->quantity > 0) {
											
											$generalLedger->account = $salesordermarginaccountmapping->debit_account;
											$generalLedger->entry_type = $debit[0]['id'];
											$generalLedger->transaction_number = $loan->loan_number;
											$generalLedger->amount = $margin;
											$generalLedger->date = $loandisbursements->date;
											$generalLedger->save();


											$generalLedger = new GeneralLedgers();
											$generalLedger->account = $salesordermarginaccountmapping->credit_account;
											$generalLedger->entry_type = $credit[0]['id'];
											$generalLedger->transaction_number = $loan->loan_number;
											$generalLedger->amount = $margin;
											$generalLedger->date = $loandisbursements->date;
											$generalLedger->save();

											$groupcashbook = new GroupCashBooks();

											$groupcashbook->transaction_id = $loan->loan_number;
											$groupcashbook->transaction_reference = $loandisbursements->transaction_reference;
											$groupcashbook->transaction_date = $loandisbursements->date;
											$groupcashbook->transaction_type = 2;
											$groupcashbook->transacting_group = null;
											$groupcashbook->amount = $margin;
											$groupcashbook->disbursement_mode = $loan->disbursement_mode;
											$groupcashbook->lgf = 0;
											$groupcashbook->account = $salesordermarginaccountmapping->debit_account;
											$groupcashbook->loan_principal = 0;
											$groupcashbook->loan_interest = 0;
											$groupcashbook->mpesa_charges = 0;
											$groupcashbook->fine = 0;
											$groupcashbook->processing_fees = 0;
											$groupcashbook->insurance_deduction_fees = 0;
											$groupcashbook->collecting_officer = $user[0]->name;
											$groupcashbook->clearing_fees = 0;
											$groupcashbook->particulars = $loan->clientmodel->first_name . " " . $loan->clientmodel->middle_name . " " . $loan->clientmodel->last_name . " loan disbursement";

											$groupcashbook->save();

											$groupcashbook2 = new GroupCashBooks();

											$groupcashbook2->transaction_id = $loan->loan_number;
											$groupcashbook2->transaction_reference = $loandisbursements->transaction_reference;
											$groupcashbook2->transaction_date = $loandisbursements->date;
											$groupcashbook2->transaction_type = 1;
											$groupcashbook2->disbursement_mode = $loan->disbursement_mode;
											$groupcashbook2->transacting_group = null;
											$groupcashbook2->amount = $margin;
											$groupcashbook2->lgf = 0;
											$groupcashbook2->account = $salesordermarginaccountmapping->credit_account;
											$groupcashbook2->loan_principal = 0;
											$groupcashbook2->loan_interest = 0;
											$groupcashbook2->mpesa_charges = 0;
											$groupcashbook2->fine = 0;
											$groupcashbook2->processing_fees = 0;
											$groupcashbook2->insurance_deduction_fees = 0;
											$groupcashbook2->collecting_officer = $user[0]->name;
											$groupcashbook2->clearing_fees = 0;
											$groupcashbook2->particulars = $loan->clientmodel->first_name . " " . $loan->clientmodel->middle_name . " " . $loan->clientmodel->last_name . " loan disbursement";

											$groupcashbook2->save();
										}
									}
								} else {
									$loandisbursementsdata['result'] = "productdisbursementconfigurations not found";
									$loandisbursementsdata['response'] = "0";
									$loandisbursementsdata['data'] = LoanDisbursements::find($id);
									return view('admin.loan_disbursements.edit', compact('loandisbursementsdata', 'id'));
								}
							}
						}

						$loandisbursements->save();
					}

					$loandisbursementsdata['response'] = "1";

					$loandisbursementsdata['data'] = LoanDisbursements::find($id);

					return view('admin.loan_disbursements.edit', compact('loandisbursementsdata', 'id'));
				} catch (Exception $e) {

					echo $e;

					$loandisbursementsdata['response'] = "0";
					$loandisbursementsdata['result'] = $e;
					$loandisbursementsdata['data'] = LoanDisbursements::find($id);

					return view('admin.loan_disbursements.edit', compact('loandisbursementsdata', 'id'));
				}
			});

			$loandisbursementsdata['data'] = LoanDisbursements::find($id);

			return view('admin.loan_disbursements.edit', compact('loandisbursementsdata', 'id'));
		}
	}

	public function destroy($id)
	{
		$loandisbursements = LoanDisbursements::find($id);
		$user = Users::where([['id', '=', Auth::id()]])->get();
		$module = Modules::where([['name', '=', 'LoanDisbursements']])->get();
		$loandisbursementsdata['usersaccountsroles'] = UsersAccountsRoles::where([['user_account', '=', $user[0]['user_account']], ['module', '=', $module[0]['id']]])->get();
		if ($loandisbursementsdata['usersaccountsroles'][0]['_delete'] == 1) {
			$loandisbursements->delete();
		}
		return redirect('admin/loandisbursements')->with('success', 'loan disbursements has been deleted!');
	}
}
