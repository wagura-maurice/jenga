<?php

namespace App\Http\Controllers\admin;

use App\Loans;
use App\Users;
use Exception;
use App\Stores;
use App\Clients;
use App\Genders;
use App\Modules;
use App\Counties;
use App\FeeTypes;
use App\Companies;
use App\Employees;
use App\FineTypes;
use App\Positions;
use Carbon\Carbon;
use App\EntryTypes;
use App\Guarantors;
use App\LoanAssets;
use App\ClientTypes;
use App\SubCounties;
use App\GracePeriods;
use App\LoanPayments;
use App\LoanProducts;
use App\LoanStatuses;
use App\PaymentModes;
use App\Http\Requests;
use App\LoanApprovals;
use App\LoanDocuments;
use App\UsersAccounts;
use App\ApprovalLevels;
use App\GeneralLedgers;
use App\GroupCashBooks;
use App\LoanGuarantors;
use App\PageCollection;
use App\FeePaymentTypes;
use App\LoanCollaterals;
use App\ApprovalStatuses;
use App\ClientCategories;
use App\GracePeriodTypes;
use App\ClientLgfBalances;
use App\DisbursementModes;
use App\FineChargePeriods;
use App\InterestRateTypes;
use App\LoanDisbursements;
use App\LoanProductAssets;
use App\ProductClientTypes;
use App\UsersAccountsRoles;
use App\InterestRatePeriods;
use App\ProductUserAccounts;
use App\TransactionStatuses;
use Illuminate\Http\Request;
use App\CollateralCategories;
use App\DisbursementStatuses;
use App\LoanPaymentDurations;
use App\FineChargeFrequencies;
use App\ProcessingFeePayments;
use App\GuarantorRelationships;
use App\InterestPaymentMethods;
use App\LoanPaymentFrequencies;
use App\MinimumMembershipPeriods;
use App\ProductDisbursementModes;
use App\LoanProductApprovalLevels;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\LoanSchedule;
use Illuminate\Support\Facades\Auth;
use App\ProductInterestConfigurations;
use App\ProductPrincipalConfigurations;
use Symfony\Component\HttpKernel\Client;

class LoansController extends Controller
{

	public function __construct()
	{
		$this->middleware('auth');
	}

	function getloanlist(Request $request)
	{

		$start = $request->get("start");
		$length = $request->get("length");

		$searchvalue = $request->get("search")["value"];

		if (isset($searchvalue) && !empty($searchvalue)) {

			$data = DB::table("loans")
				->join("clients", "clients.id", "=", "loans.client")
				->join("loan_products", "loan_products.id", "=", "loans.loan_product")
				->join("interest_rate_types", "interest_rate_types.id", "=", "loans.interest_rate_type")
				->join("loan_statuses", "loan_statuses.id", "=", "loans.status")
				->select(
					"loans.id as loanId",
					"loans.loan_number as loanNumber",
					DB::raw("CONCAT_WS(' ',clients.client_number,clients.first_name,clients.middle_name,clients.last_name) as clientName"),
					"loan_products.name as loanProductName",
					"loans.Date as loanDate",
					"loans.amount as loanAmount",
					"interest_rate_types.name as interestRateTypeName",
					"loans.interest_rate as interestRate",
					"loans.amount_to_be_disbursed as disbursementAmount",
					"loan_statuses.code as loanStatusCode",
					"loan_statuses.name as loanStatusName"
				)
				->where("loans.loan_number", "like", "%" . $searchvalue . "%")
				->orWhere("clients.client_number", "like", "%" . $searchvalue . "%")
				->orWhere("clients.first_name", "like", "%" . $searchvalue . "%")
				->orWhere("clients.middle_name", "like", "%" . $searchvalue . "%")
				->orWhere("clients.last_name", "like", "%" . $searchvalue . "%")
				->orderBy("loans.created_at", "desc")
				->skip($start)
				->take($length)
				->get();

		} else {

			$data = DB::table("loans")
				->join("clients", "clients.id", "=", "loans.client")
				->join("loan_products", "loan_products.id", "=", "loans.loan_product")
				->join("interest_rate_types", "interest_rate_types.id", "=", "loans.interest_rate_type")
				->join("loan_statuses", "loan_statuses.id", "=", "loans.status")
				->select(
					"loans.id as loanId",
					"loans.loan_number as loanNumber",
					DB::raw("CONCAT_WS(' ',clients.client_number,clients.first_name,clients.middle_name,clients.last_name) as clientName"),
					"loan_products.name as loanProductName",
					"loans.Date as loanDate",
					"loans.amount as loanAmount",
					"interest_rate_types.name as interestRateTypeName",
					"loans.interest_rate as interestRate",
					"loans.amount_to_be_disbursed as disbursementAmount",
					"loan_statuses.code as loanStatusCode",
					"loan_statuses.name as loanStatusName"
				)
				->orderBy("loans.created_at", "desc")
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

	public function index(Request $request)
	{
		$loansdata['loanproducts'] = LoanProducts::all();
		$loansdata['clients'] = Clients::all();
		$loansdata['interestratetypes'] = InterestRateTypes::all();
		$loansdata['interestpaymentmethods'] = InterestPaymentMethods::all();
		$loansdata['loanpaymentdurations'] = LoanPaymentDurations::all();
		$loansdata['loanpaymentfrequencies'] = LoanPaymentFrequencies::all();
		$loansdata['graceperiods'] = GracePeriods::all();
		$loansdata['disbursementmodes'] = DisbursementModes::all();
		$loansdata['finetypes'] = FineTypes::all();
		$loansdata['approvalstatuses'] = ApprovalStatuses::all();
		$loansdata['finechargefrequencies'] = FineChargeFrequencies::all();
		$loansdata['finechargeperiods'] = FineChargePeriods::all();
		$loansdata['loanproducts'] = LoanProducts::all();
		$loansdata['loanstatuses'] = LoanStatuses::all();
		
		$loans = Loans::withTrashed()
			->with('loanproductmodel','clientmodel','modeofdisbursementmodel','loanstatusmodel')
			->orderBy('requested_at', 'ASC');

		if($request->client_number) {
			$client = Clients::where('client_number', $request->client_number)->first();
			
			if (isset($client->id)) {
				$loans->where('client', $client->id);
			}
		}

		if($request->loan_number) {
			$loans->where('loan_number', $request->loan_number);
		}

		if($request->start_date && $request->end_date) {
			$loans->whereBetween('requested_at', [Carbon::parse($request->start_date)->toDateTimeString(), Carbon::parse($request->end_date)->toDateTimeString()]);
		}

		if($request->status) {
			$loans->where('status', $request->status);
		}

		if($request->product) {
			$loans->where('loan_product', $request->product);
		}

		if (auth()->user()->user_account != '8' && auth()->user()->user_account != '1') {
			$clientIds = Clients::where('officer_id', auth()->user()->employeemodel->id)->pluck('id');
			$loansdata['list'] = $loans->whereIn('client', $clientIds)->paginate(25);
		} else {
			$loansdata['list'] = $loans->paginate(25);
		}

		$loansdata['product'] = $request->product ?? NULL;
		$loansdata['status'] = $request->status ?? NULL;

		$user = Users::where([['id', '=', Auth::id()]])->get();
		$module = Modules::where([['name', '=', 'Loans']])->get();
		$loansdata['usersaccountsroles'] = UsersAccountsRoles::where([['user_account', '=', $user[0]['user_account']], ['module', '=', $module[0]['id']]])->get();

		if ($loansdata['usersaccountsroles'][0]['_add'] == 0 && $loansdata['usersaccountsroles'][0]['_list'] == 0 && $loansdata['usersaccountsroles'][0]['_edit'] == 0 && $loansdata['usersaccountsroles'][0]['_edit'] == 0 && $loansdata['usersaccountsroles'][0]['_show'] == 0 && $loansdata['usersaccountsroles'][0]['_delete'] == 0 && $loansdata['usersaccountsroles'][0]['_report'] == 0) {
			return View('admin.error.denied', compact('loansdata'));
		} else {
			return View('admin.loans.index', compact('loansdata'));
		}
	}

	public function getloans(Request $request)
	{
		$start = $request->get("start");
		$length = $request->get("length");

		$searchvalue = $request->get("search")["value"];

		if (isset($searchvalue) && !empty($searchvalue)) {

			$data = Loans::where([['loan_number', 'LIKE', '%' . $searchvalue . '%']])->orderBy('created_at', 'desc')->take($length)->skip($start)->get();
		} else {

			$data = Loans::orderBy('created_at', 'desc')->take($length)->skip($start)->get();
		}

		$totalcount = Loans::all()->count();

		$collection = new PageCollection();
		$collection->aaData = $data;
		$collection->iTotalRecords = $totalcount;
		$collection->iTotalDisplayRecords = $totalcount;

		return json_encode($collection);
	}

	public function loanapplicationclienttypes($id)
	{
		$loansdata['loanproducts'] = LoanProducts::all();
		$loansdata['clienttypes'] = ClientTypes::all();

		$myCollection = ProductClientTypes::where([['loan_product', '=', $id]])->orderBy('id', 'desc')->get();
		$uniqueCollection = $myCollection->unique(function ($item) {
			return $item['client_type'];
		});

		$loansdata['list'] = $uniqueCollection->all();

		$user = Users::where([['id', '=', Auth::id()]])->get();
		$module = Modules::where([['name', '=', 'ProductClientTypes']])->get();
		$loansdata['usersaccountsroles'] = UsersAccountsRoles::where([['user_account', '=', $user[0]['user_account']], ['module', '=', $module[0]['id']]])->get();
		if ($loansdata['usersaccountsroles'][0]['_add'] == 0 && $loansdata['usersaccountsroles'][0]['_list'] == 0 && $loansdata['usersaccountsroles'][0]['_edit'] == 0 && $loansdata['usersaccountsroles'][0]['_edit'] == 0 && $loansdata['usersaccountsroles'][0]['_show'] == 0 && $loansdata['usersaccountsroles'][0]['_delete'] == 0 && $loansdata['usersaccountsroles'][0]['_report'] == 0) {
			return view('admin.error.denied', compact('loansdata'));
		} else {
			return view('admin.loans.client_types', compact('loansdata'));
		}
	}

	public function loanapplicationclients(Request $request, $productId, $clientTypeId)
	{
		$loansdata['productId'] = $productId;
		$loansdata['clientTypeId'] = $clientTypeId;

		$loansdata['genders'] = Genders::all();
		$loansdata['loanproduct'] = LoanProducts::find($productId);
		$loansdata['active'] = ClientCategories::where([['code', '=', '002']])->get();
		$position = Positions::where([['code', '=', 'BDO']])->get();
		$loansdata['employees'] = Employees::where([['position', '=', $position[0]['id']]])->get();

		// $loansdata['list'] = Clients::where([['client_category', '=', $loansdata['active'][0]->id], ['client_type', '=', $clientTypeId]])->orderBy('id', 'desc')->take(100)->skip(0)->get();

		$clients = Clients::where(array_filter([
			'client_category' => $loansdata['active'][0]->id,
			'client_type' => $clientTypeId,
			'officer_id' => auth()->user()->user_account != '8' ? auth()->user()->employeemodel->id : NULL
		]));

		if (isset($request->client_number)) {
			$loansdata['client_number'] = trim($request->client_number);
			$clients->where('client_number', trim($request->client_number));
		}
		
		if (isset($request->primary_phone_number)) {
			$loansdata['primary_phone_number'] = trim($request->primary_phone_number);
			$clients->where('primary_phone_number', trim($request->primary_phone_number));
		}

		$loansdata['list'] = $clients->orderBy('id', 'desc')->paginate(100);

		$user = Users::where([['id', '=', Auth::id()]])->get();

		$module = Modules::where([['name', '=', 'Clients']])->get();

		$loansdata['usersaccountsroles'] = UsersAccountsRoles::where([['user_account', '=', $user[0]['user_account']], ['module', '=', $module[0]['id']]])->get();

		if ($loansdata['usersaccountsroles'][0]['_add'] == 0 && $loansdata['usersaccountsroles'][0]['_list'] == 0 && $loansdata['usersaccountsroles'][0]['_edit'] == 0 && $loansdata['usersaccountsroles'][0]['_edit'] == 0 && $loansdata['usersaccountsroles'][0]['_show'] == 0 && $loansdata['usersaccountsroles'][0]['_delete'] == 0 && $loansdata['usersaccountsroles'][0]['_report'] == 0) {
			return view('admin.error.denied', compact('loansdata'));
		} else {
			return view('admin.loans.clients', compact('loansdata'));
		}
	}

	public function getloanschedule($applicationdate, $graceperiod, $paymentfrequency, $paymentduration, $totalloanamount)
	{
		$noofinstallments = round(($paymentduration - $graceperiod) / $paymentfrequency);
		if ($noofinstallments == 0) {
			$installment = round(($totalloanamount / 1));
		} else {
			$installment = round(($totalloanamount / $noofinstallments));
		}

		// die("no of installment : ".$noofinstallments." installment : ".$installment);
		$startdate = $applicationdate->addDays($graceperiod);
		$loanschedule = array();



		$nextdate = $startdate;
		$noofdays = $paymentfrequency;
		$expectedpayment = round($installment);;
		$expectedbalance = $totalloanamount - $expectedpayment;
		$loanschedule[0]['amount'] = $totalloanamount;
		$loanschedule[0]['date'] = "" . $startdate;
		$loanschedule[0]['expectedpayment'] = "" . $expectedpayment;
		$loanschedule[0]['expectedbalance'] = "" . $expectedbalance;
		$loanschedule[0]['payment'] = "" . $installment;



		for ($r = 1; $r <= round($noofinstallments - 1); $r++) {
			// die("r : ".(round($noofinstallments)-1));
			if ($r == round($noofinstallments) - 1) {

				$loanschedule[$r]['payment'] = "" . $expectedbalance;
				$expectedpayment += $expectedbalance;

				$loanschedule[$r]['amount'] = $expectedbalance;
				$expectedbalance -= $expectedbalance;
			} else {
				if ($expectedbalance < $installment) {
					$loanschedule[$r]['payment'] = "" . $expectedbalance;
					$expectedpayment += $expectedbalance;
					$loanschedule[$r]['amount'] = "" . $expectedbalance;
					$expectedbalance -= $expectedbalance;
				} else {
					$loanschedule[$r]['payment'] = "" . $installment;

					$expectedpayment += round($installment);
					$loanschedule[$r]['amount'] = $expectedbalance;
					$expectedbalance -= round($installment);
				}
			}
			$loanschedule[$r]['date'] = "" . $startdate->addDays($noofdays);
			$loanschedule[$r]['expectedpayment'] = "" . $expectedpayment;
			$loanschedule[$r]['expectedbalance'] = "" . $expectedbalance;
			// echo ", amount : ".round($installment,2)." no of days : ".$noofdays." date : ".$startdate->addDays($noofdays);


		}
		// die(json_encode($loanschedule));

		return $loanschedule;
	}
	public function getloanschedulebyrequest(Request $request)
	{
		$applicationdate = Carbon::parse($request->get("applicationDate"));
		$graceperiod = GracePeriods::find($request->get("gracePeriod"))->number_of_days;
		$paymentfrequency = LoanPaymentFrequencies::find($request->get("paymentFrequency"))->number_of_days;
		$paymentduration = LoanPaymentDurations::find($request->get("paymentDuration"))->number_of_days;
		$totalloanamount = $request->get("totalLoanAmount");


		$noofinstallments = round(($paymentduration - $graceperiod) / $paymentfrequency);
		$installment = round(($totalloanamount / $noofinstallments));
		$startdate = $applicationdate->addDays($graceperiod);
		$loanschedule = array();


		$nextdate = $startdate;
		$noofdays = $paymentfrequency;
		$expectedpayment = round($installment);;
		$expectedbalance = $totalloanamount - $expectedpayment;
		$loanschedule[0]['amount'] = $totalloanamount;
		$loanschedule[0]['date'] = "" . $startdate;
		$loanschedule[0]['expectedpayment'] = "" . $expectedpayment;
		$loanschedule[0]['expectedbalance'] = "" . $expectedbalance;
		$loanschedule[0]['payment'] = "" . $installment;


		for ($r = 1; $r <= round($noofinstallments - 1); $r++) {
			// die("r : ".(round($noofinstallments)-1));
			if ($r == round($noofinstallments) - 1) {

				$loanschedule[$r]['payment'] = "" . $expectedbalance;
				$expectedpayment += $expectedbalance;

				$loanschedule[$r]['amount'] = $expectedbalance;
				$expectedbalance -= $expectedbalance;
			} else {
				if ($expectedbalance < $installment) {
					$loanschedule[$r]['payment'] = "" . $expectedbalance;
					$expectedpayment += $expectedbalance;
					$loanschedule[$r]['amount'] = "" . $expectedbalance;
					$expectedbalance -= $expectedbalance;
				} else {
					$loanschedule[$r]['payment'] = "" . $installment;
					$expectedbalance -= round($installment);
					$expectedpayment += round($installment);
					$loanschedule[$r]['amount'] = $expectedbalance;
				}
			}
			$loanschedule[$r]['date'] = "" . $startdate->addDays($noofdays);
			$loanschedule[$r]['expectedpayment'] = "" . $expectedpayment;
			$loanschedule[$r]['expectedbalance'] = "" . $expectedbalance;
			// echo ", amount : ".round($installment,2)." no of days : ".$noofdays." date : ".$startdate->addDays($noofdays);


		}
		// die(json_encode($loanschedule));

		return $loanschedule;
	}

	public function loanapplicationproducts(Request $request)
	{
		$loansdata['graceperiods'] = GracePeriods::all();
		$loansdata['disbursementmodes'] = DisbursementModes::all();
		$loansdata['finetypes'] = FineTypes::all();
		$loansdata['finechargefrequencies'] = FineChargeFrequencies::all();
		$loansdata['finechargeperiods'] = FineChargePeriods::all();
		$loansdata['interestratetypes'] = InterestRateTypes::all();
		$loansdata['interestpaymentmethods'] = InterestPaymentMethods::all();
		$loansdata['loanpaymentdurations'] = LoanPaymentDurations::all();
		$loansdata['minimummembershipperiods'] = MinimumMembershipPeriods::all();
		$user = Users::where([['id', '=', Auth::id()]])->get();
		$productuseraccounts = ProductUserAccounts::where('user_account', '=', $user[0]->user_account)->distinct("loan_product")->get();
		$loansdata['list'] = [];

		if($request->loanNumber) {
			$loansdata['rescheduled_loan_number'] = trim($request->loanNumber);
			$loansdata['rescheduled_loan_balance'] = getLoanBalance(['loan_number' => trim($request->loanNumber)]);
			$loansdata['list'] = LoanProducts::where('minimum_loan_amount','<', $loansdata['rescheduled_loan_balance'])
				->where('maximum_loan_amount','>', $loansdata['rescheduled_loan_balance'])
				->get();
		} else {
			$r = 0;
			foreach ($productuseraccounts as $productuseraccount) {
				$loanproduct = LoanProducts::find($productuseraccount->loan_product);

				if (isset($loanproduct)) {
					$loansdata['list'][$r] = $loanproduct;
					$r++;
				}
			}
		}

		$module = Modules::where([['name', '=', 'LoanProducts']])->get();
		$loansdata['usersaccountsroles'] = UsersAccountsRoles::where([['user_account', '=', $user[0]['user_account']], ['module', '=', $module[0]['id']]])->get();
		if ($loansdata['usersaccountsroles'][0]['_add'] == 0 && $loansdata['usersaccountsroles'][0]['_list'] == 0 && $loansdata['usersaccountsroles'][0]['_edit'] == 0 && $loansdata['usersaccountsroles'][0]['_edit'] == 0 && $loansdata['usersaccountsroles'][0]['_show'] == 0 && $loansdata['usersaccountsroles'][0]['_delete'] == 0 && $loansdata['usersaccountsroles'][0]['_report'] == 0) {
			return view('admin.error.denied', compact('loansdata'));
		} else {
			return view('admin.loans.products', compact('loansdata'));
		}
	}

	function getLoansCount()
	{
		return Loans::count();
	}


	function getInterestChargedByRequest(Request $request)
	{
		$loans = new Loans();
		$interestRateType = InterestRateTypes::find($request->get("interest_rate_type"));
		$interestRateTypeCode = $interestRateType->code;
		$interestRatePeriod = InterestRatePeriods::find($request->get("interest_rate_period"));
		$interestRatePeriodDays = $interestRatePeriod->number_of_days;

		$loanPaymentDuration = LoanPaymentDurations::find($request->get("loan_payment_duration"));
		$loanPaymentDurationDays = $loanPaymentDuration->number_of_days;

		return $loans->getInterestCharged($request->get('loan_amount'), $request->get("interest_rate"), $interestRateTypeCode, $interestRatePeriodDays, $loanPaymentDurationDays);
	}
	function getInterestCharged($loanAmount, $interestRate, $interestRateTypeId, $interestRatePeriodId, $loanPaymentDurationId)
	{
		$loans = new Loans();
		$interestRateType = InterestRateTypes::find($interestRateTypeId);
		$interestRateTypeCode = $interestRateType->code;
		$interestRatePeriod = InterestRatePeriods::find($interestRatePeriodId);
		$interestRatePeriodDays = $interestRatePeriod->number_of_days;
		$loanPaymentDuration = LoanPaymentDurations::find($loanPaymentDurationId);
		$loanPaymentDurationDays = $loanPaymentDuration->number_of_days;

		return $loans->getInterestCharged($loanAmount, $interestRate, $interestRateTypeCode, $interestRatePeriodDays, $loanPaymentDurationDays);
	}
	function getTotalLoanAmountByRequest(Request $request)
	{
		$loans = new Loans();
		$loanAmount = $request->get('loan_amount');
		$interestCharged = $request->get('interest_charged');
		$interestPaymentMethodId = $request->get('interest_payment_method');
		$interestPaymentMethod = InterestPaymentMethods::find($interestPaymentMethodId);
		$interestPaymentMethodCode = $interestPaymentMethod->code;
		return $loans->getTotalLoanAmount($loanAmount, $interestCharged, $interestPaymentMethodCode);
	}

	function getTotalLoanAmount($loanAmount, $interestCharged, $interestPaymentMethodId)
	{
		$loans = new Loans();



		$interestPaymentMethod = InterestPaymentMethods::find($interestPaymentMethodId);

		$interestPaymentMethodCode = $interestPaymentMethod->code;
		return $loans->getTotalLoanAmount($loanAmount, $interestCharged, $interestPaymentMethodCode);
	}
	function getAmountToBeDisbursed($loanAmount, $interestCharged, $loanProduct)
	{
		$loans = new Loans();
		if ($loanProduct->clearingfeepaymenttypemodel->code == "002") {
			if ($loanProduct->clearingfeetypemodel->code == "001") {
				$clearingFee = $loanProduct->maximum_loan_amount * $loanProduct->clearing_fee / 100;
			} else {
				$clearingFee = $loanProduct->clearing_fee;
			}
		} else {
			$clearingFee = 0;
		}

		if ($loanProduct->processingfeepaymenttypemodel->code == "002") {
			if ($loanProduct->processingfeetypemodel->code == "001") {
				$processingFee = $loanProduct->maximum_loan_amount * $loanProduct->processing_fee / 100;
			} else {
				$processingFee = $loanProduct->processing_fee;
			}
		} else {
			$processingFee = 0;
		}

		if ($loanProduct->insurancedeductionfeepaymenttypemodel->code == "002") {
			if ($loanProduct->insurancedeductionfeetypemodel->code == "001") {
				$insuranceDeductionFee = ($loanProduct->maximum_loan_amount * $loanProduct->insurance_deduction_fee / 100);
			} else {
				$insuranceDeductionFee = $loanProduct->insurance_deduction_fee;
			}
		} else {
			$insuranceDeductionFee = 0;
		}
		$interestPaymentMethod = InterestPaymentMethods::find($loanProduct->interest_payment_method);

		$interestPaymentMethodCode = $interestPaymentMethod->code;
		return $loans->getAmountToBeDisbursed($loanAmount, $interestCharged, $interestPaymentMethodCode, $clearingFee, $insuranceDeductionFee, $processingFee);
	}
	function getAmountToBeDisbursedByRequest(Request $request)
	{
		$loans = new Loans();
		$loanAmount = $request->get('loan_amount');
		$interestCharged = $request->get('interest_charged');
		$interestPaymentMethodId = $request->get('interest_payment_method');
		$loanProduct = LoanProducts::find($request->get("loanProductId"));
		if ($request->get("clearing_fee_payment_type_code") == "002") {

			if ($loanProduct->clearingfeetypemodel->code == "001") {
				$clearingFee = $loanAmount * $loanProduct->clearing_fee / 100;
			} else {
				$clearingFee = $clearingFee = $loanProduct->clearing_fee;
			}
		} else {
			$clearingFee = 0;
		}
		if ($loanProduct->processingfeepaymenttypemodel->code == "002") {
			if ($loanProduct->processingfeetypemodel->code == "001") {
				$processingFee = $loanAmount * $loanProduct->processing_fee / 100;
			} else {
				$processingFee = $loanProduct->processing_fee;
			}
		} else {
			$processingFee = 0;
		}

		if ($request->get("insurance_deduction_fee_payment_type_code") == "002") {
			if ($loanProduct->insurancedeductionfeetypemodel->code == "001") {
				$insuranceDeductionFee = $loanAmount * $loanProduct->insurance_deduction_fee / 100;
			} else {
				$insuranceDeductionFee = $loanProduct->insurance_deduction_fee;
			}
		} else {
			$insuranceDeductionFee = 0;
		}

		$interestPaymentMethod = InterestPaymentMethods::find($interestPaymentMethodId);
		$interestPaymentMethodCode = $interestPaymentMethod->code;
		return $loans->getAmountToBeDisbursed($loanAmount, $interestCharged, $interestPaymentMethodCode, $clearingFee, $insuranceDeductionFee, $processingFee);
	}
	public function loanapplication(Request $request, $productId, $clientId)
	{
		if($request->loanNumber) {
			$loansdata['rescheduled_loan_number'] = trim($request->loanNumber);
			$loansdata['rescheduled_loan_balance'] = getLoanBalance(['loan_number' => trim($request->loanNumber)]);
		}

		$loansdata['counties'] = Counties::all();
		$loansdata['subcounties'] = SubCounties::all();
		$loansdata['loanproducts'] = LoanProducts::find($productId);
		$loansdata['paymentmodes'] = PaymentModes::all();
		$loansdata['guarantorrelationships'] = GuarantorRelationships::all();
		$loansdata['loanproduct'] = LoanProducts::find($productId);
		$loansdata['client'] = Clients::find($clientId);
		$loansdata['clienttypes'] = ClientTypes::all();
		$loansdata["positions"] = Positions::all();
		$loansdata["productassets"] = LoanProductAssets::where([["loan_product", "=", $productId]])->get();
		$user = Users::where([['id', '=', Auth::id()]])->get();
		$loansdata["stores"] = Stores::all(); // where([["staff", "=", $user[0]->id]])->get();
		$loansdata['feetypes'] = FeeTypes::all();
		if ($loansdata['loanproduct']->depends_on_lgf == 1) {
			if (isset($loansdata['loanproduct']->lgftypemodel->code)) {
				if ($loansdata['loanproduct']->lgftypemodel->code == "001") {
					$loansdata['minimumlgf'] = ($loansdata['loanproduct']->maximum_loan_amount) * $loansdata['loanproduct']->lgf / 100;
				} else if ($loansdata['loanproduct']->lgftypemodel->code == "001") {
					$loansdata['minimumlgf'] = $loansdata['loanproduct']->lgf;
				}
			}
			$loansdata['clientlgfbalance'] = ClientLgfBalances::where([["client", "=", $clientId]])->orderBy("id", "desc")->get();
			if (isset($loansdata['clientlgfbalance']->balance)) {
				$loansdata['minimumlgfrequirement'] = $loansdata['clientlgfbalance']->balance - $loansdata['minimumlgf'];
			}
		}


		$dependsonlgf = $loansdata['loanproducts']->depends_on_lgf;

		$loansdata['feepaymenttypes'] = FeePaymentTypes::all();
		$loansdata['interestcharged'] = $this->getInterestCharged(($loansdata['rescheduled_loan_balance'] ?? $loansdata['loanproduct']->maximum_loan_amount), $loansdata['loanproduct']->interest_rate, $loansdata['loanproduct']->interest_rate_type, $loansdata['loanproduct']->interest_rate_period, $loansdata['loanproduct']->loan_payment_duration);

		$loansdata['totalloanamount'] = $this->getTotalLoanAmount(($loansdata['rescheduled_loan_balance'] ?? $loansdata['loanproduct']->maximum_loan_amount), $loansdata['interestcharged'], $loansdata['loanproduct']->interest_payment_method);

		// $loansdata['amounttobedisbursed'] = $this->getAmountToBeDisbursed(($loansdata['rescheduled_loan_balance'] ?? $loansdata['loanproduct']->maximum_loan_amount), $loansdata['interestcharged'], $loansdata['loanproduct']);

		$loansdata['clearingfee'] = $this->getClearingFee($loansdata['loanproduct'], $loansdata['rescheduled_loan_balance'] ?? NULL);

		$loansdata['insurancedeductionfee'] = $this->getInsuranceDeductionFee($loansdata['loanproduct'], $loansdata['rescheduled_loan_balance']  ?? NULL);
		$loansdata["processingfee"] = $this->getProcessingFee($loansdata['loanproduct'], $loansdata['rescheduled_loan_balance']  ?? NULL);

		$loanproduct = $loansdata['loanproduct'];
		$loansdata['loanschedule'] = $this->getloanschedule(Carbon::now(), $loanproduct->graceperiodmodel->number_of_days, $loanproduct->loanpaymentfrequencymodel->number_of_days, $loanproduct->loanpaymentdurationmodel->number_of_days, $loansdata['totalloanamount']);
		$clientCategory = ClientCategories::where([['code', '=', '002']])->get();
		$loansdata['clients'] = Clients::where([['id', '=', $clientId]])->orderBy('id', 'desc')->get();

		$loansdata['interestratetypes'] = InterestRateTypes::all();
		$loansdata['interestpaymentmethods'] = InterestPaymentMethods::all();
		$loansdata['loanpaymentdurations'] = LoanPaymentDurations::all();
		$loansdata['loanpaymentfrequencies'] = LoanPaymentFrequencies::all();
		$loansdata['graceperiods'] = GracePeriods::all();
		$loansdata['graceperiodtypes'] = GracePeriodTypes::all();

		$myCollection = ProductDisbursementModes::where([['loan_product', '=', $productId]])
			->with('disbursementmodemodel')
			->orderBy('id', 'desc')
			->get();
		$uniqueCollection = $myCollection->unique(function ($item) {
			return $item['disbursement_mode'];
		});

		$loansdata['disbursementmodes'] = $uniqueCollection->all();

		$loansdata['finetypes'] = FineTypes::all();
		$loansdata['finechargefrequencies'] = FineChargeFrequencies::all();
		$loansdata['finechargeperiods'] = FineChargePeriods::all();
		$loansdata['loanstatuses'] = LoanStatuses::all();
		$loansdata['collateralcategories'] = CollateralCategories::all();

		$objetoRequest = new \Illuminate\Http\Request();
		$objetoRequest->setMethod('GET');
		$objetoRequest->request->add([
			'loanProductId' => $productId,
			'loan_amount' => $loansdata['rescheduled_loan_balance'] ?? $loansdata['loanproduct']->maximum_loan_amount,
			'interest_charged' => $loansdata['interestcharged'],
			'interest_payment_method' => $loansdata['loanproduct']->interest_payment_method,
			'clearing_fee' => $loansdata['clearingfee'],
			'insurance_deduction_fee' => $loansdata['insurancedeductionfee'],
			'clearing_fee_payment_type_code' => "002",
			'insurance_deduction_fee_payment_type_code' => "002"
		]);

		$loansdata['amounttobedisbursed'] = app('App\Http\Controllers\admin\LoansController')->getAmountToBeDisbursedbyrequest($objetoRequest);

		$module = Modules::where([['name', '=', 'Loans']])->get();
		$loansdata['usersaccountsroles'] = UsersAccountsRoles::where([['user_account', '=', $user[0]['user_account']], ['module', '=', $module[0]['id']]])->get();
		if ($loansdata['usersaccountsroles'][0]['_add'] == 0) {
			return view('admin.error.denied', compact('loansdata'));
		} else {
			return view('admin.loans.create', compact('loansdata'));
		}
	}
	public function getClearingFee($loanProduct, $loanAmount = NULL)
	{
		$loan = new Loans();
		$clearingFeeCode = $loanProduct->clearingfeetypemodel->code;
		$clearingFee = $loanProduct->clearing_fee;
		$loanAmount = $loanAmount ?? $loanProduct->maximum_loan_amount;
		return $loan->getClearingFee($clearingFeeCode, $clearingFee, $loanAmount);
	}
	public function getInsuranceDeductionFee($loanProduct, $loanAmount = NULL)
	{
		$loan = new Loans();
		$insuranceDeductionFeeTypeCode = $loanProduct->insurancedeductionfeetypemodel->code;
		$insuranceDeductionFeeValue = $loanProduct->insurance_deduction_fee;
		$loanAmount = $loanAmount ?? $loanProduct->maximum_loan_amount;
		return $loan->getInsuranceDeductionFee($insuranceDeductionFeeTypeCode, $insuranceDeductionFeeValue, $loanAmount);
	}
	public function getInsuranceDeductionFeeByRequest(Request $request)
	{
		$loan = new Loans();
		$insuranceDeductionFeeTypeCode = $request->get("insurance_deduction_fee_type_code");
		$insuranceDeductionFeeValue = $request->get("insurance_deduction_fee_value");
		$loanAmount = $request->get("loan_amount");
		return $loan->getInsuranceDeductionFee($insuranceDeductionFeeTypeCode, $insuranceDeductionFeeValue, $loanAmount);
	}
	public function getProcessingFee($loanProduct, $loanAmount = NULL)
	{
		$loan = new Loans();
		$processingFeeTypeCode = $loanProduct->processingfeetypemodel->code;
		$processingFeeValue = $loanProduct->processing_fee;
		$loanAmount = $loanAmount ?? $loanProduct->maximum_loan_amount;
		return $loan->getProcessingFee($processingFeeTypeCode, $processingFeeValue, $loanAmount);
	}
	public function getProcessingFeeByRequest(Request $request)
	{
		$loan = new Loans();
		$processingFeeTypeCode = $request->get("processing_fee_type_code");
		$processingFeeValue = $request->get("processing_fee_value");
		$loanAmount = $request->get("loan_amount");
		return $loan->getProcessingFee($processingFeeTypeCode, $processingFeeValue, $loanAmount);
	}

	public function getClearingFeeByRequest(Request $request)
	{
		$loan = new Loans();
		$clearingFeeCode = $request->get("clearing_fee_code");
		$clearingFeeValue = $request->get("clearing_fee_value");
		$loanAmount = $request->get("loan_amount");
		return $loan->getClearingFee($clearingFeeCode, $clearingFeeValue, $loanAmount);
	}

	public function create()
	{
		$clientCategory = ClientCategories::where([['code', '=', '002']])->get();

		$loansdata['counties'] = Counties::all();
		$loansdata['subcounties'] = SubCounties::all();
		$loansdata['loanproducts'] = LoanProducts::all();
		$loansdata['clienttypes'] = ClientTypes::all();
		$loansdata["positions"] = Positions::all();
		$loansdata['feetypes'] = FeeTypes::all();
		$loansdata['feepaymenttypes'] = FeePaymentTypes::all();		
		$loansdata['clients'] = Clients::where([['client_category', '=', $clientCategory[0]['id']]])->orderBy("client_number", "desc")->get();
		$loansdata['interestratetypes'] = InterestRateTypes::all();
		$loansdata['interestpaymentmethods'] = InterestPaymentMethods::all();
		$loansdata['loanpaymentdurations'] = LoanPaymentDurations::all();
		$loansdata['loanpaymentfrequencies'] = LoanPaymentFrequencies::all();
		$loansdata['graceperiods'] = GracePeriods::all();
		$loansdata['graceperiodtypes'] = GracePeriodTypes::all();
		$loansdata['disbursementmodes'] = DisbursementModes::all();
		$loansdata['finetypes'] = FineTypes::all();
		$loansdata['finechargefrequencies'] = FineChargeFrequencies::all();
		$loansdata['finechargeperiods'] = FineChargePeriods::all();
		$loansdata['loanstatuses'] = LoanStatuses::all();
		$loansdata['collateralcategories'] = CollateralCategories::all();

		$user = Users::where([['id', '=', Auth::id()]])->get();
		$module = Modules::where([['name', '=', 'Loans']])->get();
		$loansdata['usersaccountsroles'] = UsersAccountsRoles::where([['user_account', '=', $user[0]['user_account']], ['module', '=', $module[0]['id']]])->get();
		if ($loansdata['usersaccountsroles'][0]['_add'] == 0) {
			return view('admin.error.denied', compact('loansdata'));
		} else {
			return view('admin.loans.create', compact('loansdata'));
		}
	}

	public function filter(Request $request)
	{
		$loansdata['loanproducts'] = LoanProducts::all();
		$loansdata['clients'] = Clients::all();
		$loansdata['interestratetypes'] = InterestRateTypes::all();
		$loansdata['interestpaymentmethods'] = InterestPaymentMethods::all();
		$loansdata['loanpaymentdurations'] = LoanPaymentDurations::all();
		$loansdata['loanpaymentfrequencies'] = LoanPaymentFrequencies::all();
		$loansdata['graceperiods'] = GracePeriods::all();
		$loansdata['disbursementmodes'] = DisbursementModes::all();
		$loansdata['finetypes'] = FineTypes::all();
		$loansdata['finechargefrequencies'] = FineChargeFrequencies::all();
		$loansdata['finechargeperiods'] = FineChargePeriods::all();
		$loansdata['loanstatuses'] = LoanStatuses::all();
		$loansdata['list'] = Loans::where([['loan_number', 'LIKE', '%' . $request->get('loan_number') . '%'], ['loan_product', 'LIKE', '%' . $request->get('loan_product') . '%'], ['client', 'LIKE', '%' . $request->get('client') . '%'], ['amount', 'LIKE', '%' . $request->get('amount') . '%'], ['interest_rate_type', 'LIKE', '%' . $request->get('interest_rate_type') . '%'], ['interest_rate', 'LIKE', '%' . $request->get('interest_rate') . '%'], ['interest_payment_method', 'LIKE', '%' . $request->get('interest_payment_method') . '%'], ['loan_payment_duration', 'LIKE', '%' . $request->get('loan_payment_duration') . '%'], ['loan_payment_frequency', 'LIKE', '%' . $request->get('loan_payment_frequency') . '%'], ['grace_period', 'LIKE', '%' . $request->get('grace_period') . '%'], ['interest_charged', 'LIKE', '%' . $request->get('interest_charged') . '%'], ['total_loan_amount', 'LIKE', '%' . $request->get('total_loan_amount') . '%'], ['amount_to_be_disbursed', 'LIKE', '%' . $request->get('amount_to_be_disbursed') . '%'], ['disbursement_mode', 'LIKE', '%' . $request->get('disbursement_mode') . '%'], ['clearing_fee', 'LIKE', '%' . $request->get('clearing_fee') . '%'], ['insurance_deduction_fee', 'LIKE', '%' . $request->get('insurance_deduction_fee') . '%'], ['fine_type', 'LIKE', '%' . $request->get('fine_type') . '%'], ['fine_charge', 'LIKE', '%' . $request->get('fine_charge') . '%'], ['fine_charge_frequency', 'LIKE', '%' . $request->get('fine_charge_frequency') . '%'], ['fine_charge_period', 'LIKE', '%' . $request->get('fine_charge_period') . '%'], ['initial_deposit', 'LIKE', '%' . $request->get('initial_deposit') . '%'], ['status', 'LIKE', '%' . $request->get('status') . '%'],])->orWhereBetween('date', [$request->get('datefrom'), $request->get('dateto')])->get();
		$user = Users::where([['id', '=', Auth::id()]])->get();
		$module = Modules::where([['name', '=', 'Loans']])->get();
		$loansdata['usersaccountsroles'] = UsersAccountsRoles::where([['user_account', '=', $user[0]['user_account']], ['module', '=', $module[0]['id']]])->get();
		if ($loansdata['usersaccountsroles'][0]['_add'] == 0 && $loansdata['usersaccountsroles'][0]['_list'] == 0 && $loansdata['usersaccountsroles'][0]['_edit'] == 0 && $loansdata['usersaccountsroles'][0]['_edit'] == 0 && $loansdata['usersaccountsroles'][0]['_show'] == 0 && $loansdata['usersaccountsroles'][0]['_delete'] == 0 && $loansdata['usersaccountsroles'][0]['_report'] == 0) {
			return view('admin.error.denied', compact('loansdata'));
		} else {
			return view('admin.loans.index', compact('loansdata'));
		}
	}

	public function report()
	{
		$loansdata['company'] = Companies::all();
		$loansdata['list'] = Loans::all();
		$user = Users::where([['id', '=', Auth::id()]])->get();
		$module = Modules::where([['name', '=', 'Loans']])->get();
		$loansdata['usersaccountsroles'] = UsersAccountsRoles::where([['user_account', '=', $user[0]['user_account']], ['module', '=', $module[0]['id']]])->get();
		if ($loansdata['usersaccountsroles'][0]['_report'] == 0) {
			return view('admin.error.denied', compact('loansdata'));
		} else {
			return view('admin.loans.report', compact('loansdata'));
		}
	}

	public function chart()
	{
		return view('admin.loans.chart');
	}

	public function store(Request $request)
	{
		/* $loans = Loans::where([['client', '=', $request->get('client')], ['loan_product', '=', $request->get('loan_product')]])->get();
		if (isset($loans[0])) {
			$response['status'] = '0';
			$response['message'] = 'Client has an existing loan!';
			return json_encode($response);
		} else {
			$response = array();
		} */

		if($request->rescheduled_loan_number) {
			$loansdata['rescheduled_loan_number'] = trim($request->rescheduled_loan_number);
			$loansdata['rescheduled_loan_balance'] = getLoanBalance(['loan_number' => trim($request->rescheduled_loan_number)]);

			$this->rescheduleLoan($request->all(), trim($request->rescheduled_loan_number));
		}

		return DB::transaction(function () use ($request) {
			$response = array();
			try {
		
				$loans = new Loans();
		
				$max=Loans::whereRaw('id = (select max(`id`) from loans)')->get()->first();
		
				$count = $max ? $max->id+1 : NULL;
		
				if ($count < 10) {
					$loans->loan_number = "JKL0000" . ($count + 1);
				} else if ($count < 100) {
					$loans->loan_number = "JKL000" . ($count + 1);
				} else if ($count < 1000) {
					$loans->loan_number = "JKL00" . ($count + 1);
				} else if ($count < 10000) {
					$loans->loan_number = "JKL0" . ($count + 1);
				} else {
					$loans->loan_number = "JKL" . ($count + 1);
				}
		
				$exist=Loans::where([["loan_number","=",$loans->loan_number]])->get()->first();
		
				while(isset($exist)){
		
					$count = $count+10;
		
					if ($count < 10) {
						$loans->loan_number = "JKL0000" . ($count + 1);
					} else if ($count < 100) {
						$loans->loan_number = "JKL000" . ($count + 1);
					} else if ($count < 1000) {
						$loans->loan_number = "JKL00" . ($count + 1);
					} else if ($count < 10000) {
						$loans->loan_number = "JKL0" . ($count + 1);
					} else {
						$loans->loan_number = "JKL" . ($count + 1);
					}	
		
					$exist=Loans::where([["loan_number","=",$loans->loan_number]])->get()->first();
		
				}
				
				// $loans->loan_number=trim($loans->loan_number);// trim($request->get('loan_number'));
				$loans->loan_product = trim($request->get('loan_product'));
				$loans->client = trim($request->get('client'));
				$loans->date = trim($request->get('date'));
				$loans->amount = trim($request->get('amount'));
				$loans->interest_rate_type = trim($request->get('interest_rate_type'));
				$loans->interest_rate = trim($request->get('interest_rate'));
				$loans->interest_payment_method = trim($request->get('interest_payment_method'));
				$loans->loan_payment_duration = trim($request->get('loan_payment_duration'));
				$loans->loan_payment_frequency = trim($request->get('loan_payment_frequency'));
				$loans->disbursement_mode = trim($request->get("disbursement_mode"));
				$loans->grace_period = trim($request->get('grace_period'));
				$loans->interest_charged = trim($request->get('interest_charged'));
				$loans->total_loan_amount = trim($request->get('total_loan_amount'));
				$loans->amount_to_be_disbursed = $request->get('amount_to_be_disbursed') ? trim($request->get('amount_to_be_disbursed')) : NULL;
				$loans->clearing_fee = trim($request->get('clearing_fee'));
				$loans->clearing_fee_payment_type = trim($request->get('clearing_fee_payment_type'));
				$loans->processing_fee = trim($request->get('processing_fee'));
				$loans->processing_fee_payment_type = trim($request->get('processing_fee_payment_type'));
				$loans->insurance_deduction_fee = trim($request->get('insurance_deduction_fee'));
				$loans->insurance_deduction_fee_payment_type = trim($request->get('insurance_deduction_fee_payment_type'));
				$loans->fine_type = trim($request->get('fine_type'));
				$loans->fine_charge = trim($request->get('fine_charge'));
				$loans->fine_charge_frequency = trim($request->get('fine_charge_frequency'));
				$loans->fine_charge_period = trim($request->get('fine_charge_period'));
				$loans->initial_deposit = trim($request->get('initial_deposit')) ? trim($request->get('initial_deposit')) : NULL;
				$loans->status = trim($request->get('status'));
				$loans->store = trim($request->get('store')) ? trim($request->get('store')) : NULL;
				$loans->requested_at = Carbon::parse($request->get('date') ? trim($request->get('date')) : Carbon::now())->toDateTimeString();
		
				$lproduct = LoanProducts::find($request->get('loan_product'));
		
				if($lproduct->is_asset=="1") {
					$assetmode=DisbursementModes::where([["code","=","004"]])->get()->first();
					$loans->disbursement_mode=$assetmode->id;					
		
					if(!isset($loans->store)) {
						$response['status'] = '0';
						$response['message'] = 'For asset loans you must select a store';
						return json_encode($response);
		
					}
		
				}else{
					
					if(!isset($loans->disbursement_mode) || empty($loans->disbursement_mode)) {
						$response['status'] = '0';
						$response['message'] = 'Loan disbursement mode not selected.';
						return json_encode($response);
		
					}
				}
		
				$loans->save();
				
				\App\Jobs\GenerateLoanSchedule::dispatch($loans->loan_number);
		
				$loanassets = $request->get("loan_asset");
				$loanassetquantities = $request->get("loan_asset_quantity");
		
				if (isset($loanassets) && isset($loanassetquantities)) {
		
					for ($r = 0; $r < Count($loanassets); $r++) {
		
						$loanasset = new LoanAssets();
		
						$loanasset->loan = $loans->id;
		
						$loanasset->asset = $loanassets[$r];
		
						$loanasset->quantity = $loanassetquantities[$r];
		
						$loanasset->save();
					}
				}
		
				if ($request->get("processing_fee_transaction_reference")!=null && !empty($request->get("processing_fee_transaction_reference")) && $lproduct->processingfeepaymenttypemodel->code == "001" && $this->getProcessingFee($lproduct) > 0) {
		
					$processingfee = app('App\Http\Controllers\admin\ProcessingFeePaymentsController')->getbytransactionreference($request->get("processing_fee_transaction_reference"));
		
					if (isset($processingfee->loan_number)) {
						throw new Exception("Transaction Reference Already used!");
					}
		
					if(isset($processingfee)) {
						$processingfee->loan_number = $loans->id;
						$processingfee->save();
					}
				}
		
				if ($request->get("clearing_fee_transaction_reference")!=null && !empty($request->get("clearing_fee_transaction_reference")) && $lproduct->clearingfeepaymenttypemodel->code == "001" && $this->getClearingFee($lproduct) > 0) {
		
					$clearingfee = app('App\Http\Controllers\admin\ClearingFeePaymentsController')->getbytransactionreference($request->get("clearing_fee_transaction_reference"));
		
					if (isset($clearingfee->loan_number)) {
						throw new Exception("Transaction Reference Already used!");
					}
		
					if(isset($clearingfee)) {
						$clearingfee->loan_number = $loans->id;
						$clearingfee->save();
					}
				}
		
				if ($request->get("insurance_deduction_transaction_reference")!=null && !empty($request->get("insurance_deduction_transaction_reference")) && $lproduct->insurancedeductionfeepaymenttypemodel->code == "001" && $this->getInsuranceDeductionFee($lproduct) > 0) {
		
					$insurancedeductionfee = app('App\Http\Controllers\admin\InsuranceDeductionPaymentsController')->getbytransactionreference($request->get("insurance_deduction_transaction_reference"));
		
					if (isset($insurancedeductionfee->loan_number)) {
						throw new Exception("Transaction Reference Already used!");
					}
		
					if(isset($insurancedeductionfee)) {
						$insurancedeductionfee->loan_number = $loans->id;
						$insurancedeductionfee->save();
					}
				}
		
		
				$user = Users::where([['id', '=', Auth::id()]])->get();
				$module = Modules::where([['name', '=', 'Loans']])->get();
				$loansdata['usersaccountsroles'] = UsersAccountsRoles::where([['user_account', '=', $user[0]['user_account']], ['module', '=', $module[0]['id']]])->get();
				$guarantorIdNumberArr = $request->get("guarantor_id_number_arr");
				$guarantorFirstNameArr = $request->get("guarantor_first_name_arr");
				$guarantorMiddleNameArr = $request->get("guarantor_middle_name_arr");
				$guarantorLastNameArr = $request->get("guarantor_last_name_arr");
				$guarantorCountArr = $request->get("guarantor_county_arr");
				$guarantorSubCountyArr = $request->get("guarantor_sub_county_arr");
				$guarantorPrimaryPhoneNumberArr = $request->get("guarantor_primary_phone_number_arr");
				$guarantorSecondaryPhoneNumberArr = $request->get("guarantor_secondary_phone_number_arr");
				$guarantorRelationshipArr = $request->get("guarantor_relationship_arr");
				
				if(isset($guarantorIdNumberArr)){
					for ($r = 0; $r < count($guarantorIdNumberArr); $r++) {
						$guarantorexists = Guarantors::where([['id_number', '=', $guarantorIdNumberArr[$r]]])->get();
		
						if (!isset($guarantorexists[0])) {
							$guarantor = new Guarantors();
							$guarantor->id_number = $guarantorIdNumberArr[$r];
							$guarantor->first_name = $guarantorFirstNameArr[$r];
							$guarantor->middle_name = $guarantorMiddleNameArr[$r];
							$guarantor->last_name = $guarantorLastNameArr[$r];
							$guarantor->county = $guarantorCountArr[$r];
							$guarantor->client = $request->get('client');
							$guarantor->sub_county = $guarantorSubCountyArr[$r];
							$guarantor->primary_phone_number = $guarantorPrimaryPhoneNumberArr[$r];
							$guarantor->secondary_phone_number = $guarantorSecondaryPhoneNumberArr[$r];
							$guarantor->save();
							$loanguarantor = new LoanGuarantors();
							$loanguarantor->loan = $loans->id;
							$loanguarantor->guarantor = $guarantor->id;
							$loanguarantor->relationship_with_guarantor = $guarantorRelationshipArr[$r];
							$loanguarantor->save();
						} else {
							$loanguarantor = new LoanGuarantors();
							$loanguarantor->loan = $loans->id;
							$loanguarantor->guarantor = $guarantorexists[0]->id;
							$loanguarantor->relationship_with_guarantor = $guarantorRelationshipArr[$r];
							$loanguarantor->save();
						}
					}
				}
		
				$collateralcategoriesarr = $request->get("collateral_category");
				$modelarr = $request->get("model");
				$colorarr = $request->get("color");
				$sizearr = $request->get("size");
				$yearboughtarr = $request->get("year_bought");
				$buyingpricearr = $request->get("buying_price");
				$currentsellingpricearr = $request->get("current_selling_price");
				$serialnumberarr = $request->get("serial_number");
				$mincollateralvalue = $request->get("collateral_value");
				$picturearr = $request->get("picture");
				if (isset($collateralcategoriesarr)) {
					for ($r = 0; $r < count($collateralcategoriesarr); $r++) {
						$collateral = new LoanCollaterals();
						$collateral->loan = $loans->id;
						$collateral->collateral_category = $collateralcategoriesarr[$r];
						$collateral->model = $colorarr[$r];
						$collateral->size = $sizearr[$r];
						$collateral->year_bought = $yearboughtarr[$r];
						$collateral->buying_price = $buyingpricearr[$r];
						$collateral->serial_number = $serialnumberarr[$r];
						$collateral->collateral_value = $mincollateralvalue[$r];
						$collateral->picture = 'loancoll_' . time() . '_' . rand(1000, 9999) . '.jpg';
		
						$collateral->save();
						// $picture=isset($picturearr[$r])?;
						// $picture->move('uploads/images/',$collateral->picture);
		
					}
				}
		
				/* $loandocumentarr = $request->file("loan_document");
		
				if (isset($LoanDocuments)) {
					for ($r = 1; $r < count($loandocumentarr) + 1; $r++) {
						$loandocument = new LoanDocuments();
						$loandocument->loan = $loans->id;
						$loandocument->document = 'loandoc_' . time() . '_' . rand(1000, 9999) . '.jpg';
						$loandocument->save();
						$document = $loandocumentarr[$r];
						$document->move('uploads/images', $loandocument->document);
					}
				} */
		
				$response['status'] = '1';
				$response['message'] = 'Loan Application Was Succeffull. ';
				// return json_encode($response);
			} catch (Exception $e) {
				die($e);
				$response['status'] = '0';
				$response['message'] = 'An Error occured while attempting to add loans. Please try again';
				// return json_encode($response);
			}
		});
	}

	public function edit($id)
	{
		$loansdata['loanproducts'] = LoanProducts::all();
		$loansdata['clients'] = Clients::all();
		$loansdata['interestratetypes'] = InterestRateTypes::all();
		$loansdata['interestpaymentmethods'] = InterestPaymentMethods::all();
		$loansdata['loanpaymentdurations'] = LoanPaymentDurations::all();
		$loansdata['loanpaymentfrequencies'] = LoanPaymentFrequencies::all();
		$loansdata['graceperiods'] = GracePeriods::all();
		$loansdata['disbursementmodes'] = DisbursementModes::all();
		$loansdata['finetypes'] = FineTypes::all();
		$loansdata['finechargefrequencies'] = FineChargeFrequencies::all();
		$loansdata['finechargeperiods'] = FineChargePeriods::all();
		$loansdata['loanstatuses'] = LoanStatuses::all();
		$loansdata['data'] = Loans::find($id);
		$user = Users::where([['id', '=', Auth::id()]])->get();
		$module = Modules::where([['name', '=', 'Loans']])->get();
		$loansdata['usersaccountsroles'] = UsersAccountsRoles::where([['user_account', '=', $user[0]['user_account']], ['module', '=', $module[0]['id']]])->get();
		if ($loansdata['usersaccountsroles'][0]['_edit'] == 0) {
			return view('admin.error.denied', compact('loansdata'));
		} else {
			return view('admin.loans.edit', compact('loansdata', 'id'));
		}
	}

	public function show($id)
	{
		$loansdata['data'] = Loans::find($id);

		$loansdata['clients'] = Clients::all();
		$loansdata['interestratetypes'] = InterestRateTypes::all();
		$loansdata['interestpaymentmethods'] = InterestPaymentMethods::all();
		$loansdata['loanpaymentdurations'] = LoanPaymentDurations::all();
		$loansdata['loanpaymentfrequencies'] = LoanPaymentFrequencies::all();
		$loansdata['graceperiods'] = GracePeriods::all();
		$loansdata['disbursementmodes'] = DisbursementModes::all();
		$loansdata['finetypes'] = FineTypes::all();
		$loansdata['finechargefrequencies'] = FineChargeFrequencies::all();
		$loansdata['finechargeperiods'] = FineChargePeriods::all();
		$loansdata['loanstatuses'] = LoanStatuses::all();

		$loansdata['myturn'] = false;
		$loan = $loansdata['data']::find($id);
		$loansdata['documents'] = LoanDocuments::where([['loan', '=', $id]])->orderBy('id', 'desc')->get();
		$loansdata['guarantors'] = LoanGuarantors::where([['loan', '=', $id]])->orderBy('id', 'desc')->get();
		$loansdata['collaterals'] = LoanCollaterals::where([['loan', '=', $id]])->orderBy('id', 'desc')->get();
		$loansdata['loanproduct'] = LoanProducts::find($loansdata['data']->loan_product);;
		$loanproduct = $loansdata['loanproduct'];
		// print_r($loansdata['data']);
		// die();
		$loansdata['loanschedule'] = app('App\Http\Controllers\admin\LoansController')->getloanschedule(Carbon::parse($loansdata['data']->date), $loanproduct->graceperiodmodel->number_of_days, $loanproduct->loanpaymentfrequencymodel->number_of_days, $loanproduct->loanpaymentdurationmodel->number_of_days, $loansdata['data']->total_loan_amount);
		$user = Users::where([['id', '=', Auth::id()]])->get();
		$module = Modules::where([['name', '=', 'Loans']])->get();
		$loansdata['usersaccountsroles'] = UsersAccountsRoles::where([['user_account', '=', $user[0]['user_account']], ['module', '=', $module[0]['id']]])->get();


		$loansdata['today'] = date('m/d/Y');
		$loansdata['usersaccounts'] = UsersAccounts::all();
		$loansdata['users'] = Users::all();
		$loansdata['user'] = $user;
		$loansdata['approvalstatuses'] = ApprovalStatuses::all();
		if ($loansdata['usersaccountsroles'][0]['_show'] == 0) {
			return view('admin.error.denied', compact('loansdata'));
		} else {
			return view('admin.loans.show', compact('loansdata', 'id'));
		}
	}

	public function loanApproval($id)
	{
		$loansdata['loanproducts'] = LoanProducts::all();
		$loansdata['clients'] = Clients::all();
		$loansdata['interestratetypes'] = InterestRateTypes::all();
		$loansdata['interestpaymentmethods'] = InterestPaymentMethods::all();
		$loansdata['loanpaymentdurations'] = LoanPaymentDurations::all();
		$loansdata['loanpaymentfrequencies'] = LoanPaymentFrequencies::all();
		$loansdata['graceperiods'] = GracePeriods::all();
		$loansdata['disbursementmodes'] = DisbursementModes::all();
		$loansdata['finetypes'] = FineTypes::all();
		$loansdata['finechargefrequencies'] = FineChargeFrequencies::all();
		$loansdata['finechargeperiods'] = FineChargePeriods::all();
		$loansdata['loanstatuses'] = LoanStatuses::all();
		$loansdata['data'] = Loans::find($id);

		$user = Users::where([['id', '=', Auth::id()]])->get();
		$module = Modules::where([['name', '=', 'Loans']])->get();
		$loansdata['usersaccountsroles'] = UsersAccountsRoles::where([['user_account', '=', $user[0]['user_account']], ['module', '=', $module[0]['id']]])->get();
		$myApprovalLevel = LoanProductApprovalLevels::where([['loan_product', '=', $loansdata['data']->loan_product], ['user_account', '=', $user[0]->user_account]])->get();
		$myLevel = ApprovalLevels::find($myApprovalLevel[0]->level);
		$loansdata['approvallevels'] = ApprovalLevels::all();
		$loansdata['myapproval'] = array();
		$loansdata['approvalstatuses'] = ApprovalStatuses::all();
		$r = 0;
		$k = 0;
		foreach ($loansdata['approvallevels'] as $level) {

			if ($level->level < $myLevel->level) {
				$loansdata['approval'][$r] = LoanProductApprovalLevels::where([['loan_product', '=', $loansdata['data']->loan_product], ['level', '=', $level->id]])->get();
				$r++;
			} else if ($level->level == $myLevel->level) {
				$loansdata['myapproval'][$k] = LoanProductApprovalLevels::where([['loan_product', '=', $loansdata['data']->loan_product], ['level', '=', $level->id]])->get();
				$k++;
			}
		}
		// echo json_encode($loansdata['myapproval'][0][0]);
		$loansdata['loanapprovals'] = LoanApprovals::where([['loan', '=', $loansdata['data']->id]]);

		$loansdata['usersaccounts'] = UsersAccounts::all();
		$loansdata['users'] = Users::all();
		$loansdata['user'] = $user;
		// echo json_encode($loansdata['user']);


		if ($loansdata['usersaccountsroles'][0]['_show'] == 0) {
			return view('admin.error.denied', compact('loansdata'));
		} else {
			return view('admin.loans.approval', compact('loansdata'));
		}
	}
	public function approveLoan(Request $request)
	{
		$currentApprovalLevel = ApprovalLevels::find($request->get('level'));
		$loanproductapprovallevels = LoanProductApprovalLevels::all();
		$maxLevel = 0;
		foreach ($loanproductapprovallevels as $productapprovallevel) {
			$approvallevel = ApprovalLevels::find($productapprovallevel->level);
			if ($approvallevel->level > $maxLevel) {
				$maxLevel = $approvallevel->level;
			}
		}
		die("max level - " + $maxLevel);
		if ($maxLevel == $currentApprovalLevel->level) {
			DB::transaction(function () use ($request, $maxLevel) {
				$loanapprovals = new LoanApprovals();
				$loanapprovals->loan = $request->get('loan');
				$loanapprovals->level = $request->get('level');
				$loanapprovals->user_account = $request->get('user_account');
				$loanapprovals->user = $request->get('user');
				$loanapprovals->date = $request->get('date');
				$loanapprovals->status = $request->get('status');
				$loanapprovals->comment = $request->get('comment');
				$loanapprovals->save();
				$loan = Loans::find($request->get('loan'));
			});
		} else {
			$loanapprovals = new LoanApprovals();
			$loanapprovals->loan = $request->get('loan');
			$loanapprovals->level = $request->get('level');
			$loanapprovals->user_account = $request->get('user_account');
			$loanapprovals->user = $request->get('user');
			$loanapprovals->date = $request->get('date');
			$loanapprovals->status = $request->get('status');
			$loanapprovals->comment = $request->get('comment');
			$loanapprovals->save();
		}


		$id = $request->get('loan');
		$loansdata['loanproducts'] = LoanProducts::all();
		$loansdata['clients'] = Clients::all();
		$loansdata['interestratetypes'] = InterestRateTypes::all();
		$loansdata['interestpaymentmethods'] = InterestPaymentMethods::all();
		$loansdata['loanpaymentdurations'] = LoanPaymentDurations::all();
		$loansdata['loanpaymentfrequencies'] = LoanPaymentFrequencies::all();
		$loansdata['graceperiods'] = GracePeriods::all();
		$loansdata['disbursementmodes'] = DisbursementModes::all();
		$loansdata['finetypes'] = FineTypes::all();
		$loansdata['finechargefrequencies'] = FineChargeFrequencies::all();
		$loansdata['finechargeperiods'] = FineChargePeriods::all();
		$loansdata['loanstatuses'] = LoanStatuses::all();
		$loansdata['data'] = Loans::find($id);
		$user = Users::where([['id', '=', Auth::id()]])->get();
		$module = Modules::where([['name', '=', 'Loans']])->get();
		$loansdata['usersaccountsroles'] = UsersAccountsRoles::where([['user_account', '=', $user[0]['user_account']], ['module', '=', $module[0]['id']]])->get();
		$myApprovalLevel = LoanProductApprovalLevels::where([['loan_product', '=', $loansdata['data']->loan_product], ['user_account', '=', $user[0]->user_account]])->get();
		$myLevel = ApprovalLevels::find($myApprovalLevel[0]->level);
		$loansdata['approvallevels'] = ApprovalLevels::all();
		$loansdata['myapproval'] = array();
		$loansdata['approvalstatuses'] = ApprovalStatuses::all();
		$r = 0;
		$k = 0;
		foreach ($loansdata['approvallevels'] as $level) {

			if ($level->level < $myLevel->level) {
				$loansdata['approval'][$r] = LoanProductApprovalLevels::where([['loan_product', '=', $loansdata['data']->loan_product], ['level', '=', $level->id]])->get();
				$r++;
			} else if ($level->level == $myLevel->level) {
				$loansdata['myapproval'][$k] = LoanProductApprovalLevels::where([['loan_product', '=', $loansdata['data']->loan_product], ['level', '=', $level->id]])->get();
				$k++;
			}
		}
		// echo json_encode($loansdata['myapproval'][0][0]);
		$loansdata['loanapprovals'] = LoanApprovals::where([['loan', '=', $loansdata['data']->id]]);

		$loansdata['usersaccounts'] = UsersAccounts::all();
		$loansdata['users'] = Users::all();
		$loansdata['user'] = $user;

		return view('admin.loans.approval', compact('loansdata'));
	}
	public function update(Request $request, $id)
	{
		$loans = Loans::find($id);
		$loansdata['loanproducts'] = LoanProducts::all();
		$loansdata['clients'] = Clients::all();
		$loansdata['interestratetypes'] = InterestRateTypes::all();
		$loansdata['interestpaymentmethods'] = InterestPaymentMethods::all();
		$loansdata['loanpaymentdurations'] = LoanPaymentDurations::all();
		$loansdata['loanpaymentfrequencies'] = LoanPaymentFrequencies::all();
		$loansdata['graceperiods'] = GracePeriods::all();
		$loansdata['disbursementmodes'] = DisbursementModes::all();
		$loansdata['finetypes'] = FineTypes::all();
		$loansdata['finechargefrequencies'] = FineChargeFrequencies::all();
		$loansdata['finechargeperiods'] = FineChargePeriods::all();
		$loansdata['loanstatuses'] = LoanStatuses::all();
		$loans->loan_number = $request->get('loan_number');
		$loans->loan_product = $request->get('loan_product');
		$loans->client = $request->get('client');
		$loans->date = $request->get('date');
		$loans->amount = $request->get('amount');
		$loans->interest_rate_type = $request->get('interest_rate_type');
		$loans->interest_rate = $request->get('interest_rate');
		$loans->interest_payment_method = $request->get('interest_payment_method');
		$loans->loan_payment_duration = $request->get('loan_payment_duration');
		$loans->loan_payment_frequency = $request->get('loan_payment_frequency');
		$loans->grace_period = $request->get('grace_period');
		$loans->interest_charged = $request->get('interest_charged');
		$loans->total_loan_amount = $request->get('total_loan_amount');
		$loans->amount_to_be_disbursed = $request->get('amount_to_be_disbursed');
		$loans->disbursement_mode = $request->get('disbursement_mode');
		$loans->clearing_fee = $request->get('clearing_fee');
		$loans->insurance_deduction_fee = $request->get('insurance_deduction_fee');
		$loans->fine_type = $request->get('fine_type');
		$loans->fine_charge = $request->get('fine_charge');
		$loans->fine_charge_frequency = $request->get('fine_charge_frequency');
		$loans->fine_charge_period = $request->get('fine_charge_period');
		$loans->initial_deposit = $request->get('initial_deposit');
		$loans->status = $request->get('status');
		$user = Users::where([['id', '=', Auth::id()]])->get();
		$module = Modules::where([['name', '=', 'Loans']])->get();
		$loansdata['usersaccountsroles'] = UsersAccountsRoles::where([['user_account', '=', $user[0]['user_account']], ['module', '=', $module[0]['id']]])->get();
		if ($loansdata['usersaccountsroles'][0]['_edit'] == 0) {
			return view('admin.error.denied', compact('loansdata'));
		} else {
			$loans->save();
			$loansdata['data'] = Loans::find($id);
			return view('admin.loans.edit', compact('loansdata', 'id'));
		}
	}

	public function destroy(Request $request, $id)
	{
		$loans = Loans::where('id', $id)->withTrashed()->first();
		
		$user = Users::where([['id', '=', Auth::id()]])->get();
		$module = Modules::where([['name', '=', 'Loans']])->get();
		$loansdata['usersaccountsroles'] = UsersAccountsRoles::where([['user_account', '=', $user[0]['user_account']], ['module', '=', $module[0]['id']]])->get();
		if ($loansdata['usersaccountsroles'][0]['_delete'] == 1) {
			$loans->_narrative = isset($request->_narrative) ? trim($request->_narrative) : NULL;
			$loans->save();

			if ($request->action == 'deactivate') {
				$loans->delete();

				return response()->json([
					'icon' => 'success',
					'message' => 'Loan successfully deactivated!'
				]);
			} elseif ($request->action == 'activate') {
				$loans->deleted_at = NULL;
				$loans->save();

				return response()->json([
					'icon' => 'success',
					'message' => 'Loan successfully activated!'
				]);
			} else {
				return response()->json([
					'icon' => 'warning',
					'message' => 'Ops! Loan update unsuccessful, please try again!'
				]);
			}
		}
		// return redirect('admin/loans')->with('success', 'loans has been deleted!');
	}

	public function loanreschedule($loan, $product)
	{
		$loan = Loans::where('loan_number', $loan)->first();

		return redirect()->route('loanapplication', [
			'loanNumber' => $loan->loan_number,
			'productId' => $product ?? $loan->loanproductmodel->id,
			'clientId' => $loan->clientmodel->id
		]);
	}

	private function rescheduleLoan(array $request, string $id)
	{
		$request['date'] = \Carbon\Carbon::parse($request['date'])->toDateString();

		return DB::transaction(function () use ($request, $id) {

			$loan = Loans::where('loan_number', $id)->first();
			$client = Clients::where('id', $request['client'])->with('group')->first();

			if(isset($client->group)) {
				$clientrequests = [$request['client']];
				$loanpaymentrequests = [$request['total_loan_amount']];
				$loanrequests = [$loan->id];
				$paymentmode = $request['disbursement_mode'];
				$transactionnumber = 'LR-' . strtoupper(substr(generateUUID(), -7));
				$date = $request['date'];
				$debit = EntryTypes::where([['code', '=', '001']])->get();
				$credit = EntryTypes::where([['code', '=', '002']])->get();
				$transactionstatuses = TransactionStatuses::where([['code', '=', '002']])->get();
				$user = Users::where([['id', '=', Auth::id()]])->get()->first();

				//principal debit
				$groupcashbook=new GroupCashBooks();

				$groupcashbook->transaction_id= $transactionnumber;
				$groupcashbook->transacting_group=$client->group->client_group;
				$groupcashbook->transaction_reference= $transactionnumber;
				$groupcashbook->transaction_date=$request['date'];
				$groupcashbook->transaction_type=2;
				$groupcashbook->amount=0;
				$groupcashbook->payment_mode=$paymentmode;
				$groupcashbook->lgf=0;
				$groupcashbook->loan_principal=0;
				$groupcashbook->loan_interest=0;
				$groupcashbook->mpesa_charges=0;
				$groupcashbook->fine=0;
				$groupcashbook->processing_fees=0;
				$groupcashbook->insurance_deduction_fees=0;
				$groupcashbook->collecting_officer=$user->name;
				$groupcashbook->clearing_fees=0;

				//principal credit
				$groupcashbook1=new GroupCashBooks();

				$groupcashbook1->transaction_id= $transactionnumber;
				$groupcashbook1->transacting_group=$client->group->client_group;
				$groupcashbook1->transaction_reference= $transactionnumber;
				$groupcashbook1->transaction_date=$request['date'];
				$groupcashbook1->transaction_type=1;
				$groupcashbook1->amount=0;
				$groupcashbook1->payment_mode=$paymentmode;
				$groupcashbook1->lgf=0;
				$groupcashbook1->loan_principal=0;
				$groupcashbook1->loan_interest=0;
				$groupcashbook1->mpesa_charges=0;
				$groupcashbook1->fine=0;
				$groupcashbook1->processing_fees=0;
				$groupcashbook1->insurance_deduction_fees=0;
				$groupcashbook1->collecting_officer=$user->name;
				$groupcashbook1->clearing_fees=0;			

				//interest debit
				$groupcashbook2=new GroupCashBooks();

				$groupcashbook2->transaction_id= $transactionnumber;
				$groupcashbook2->transacting_group=$client->group->client_group;
				$groupcashbook2->transaction_reference= $transactionnumber;
				$groupcashbook2->transaction_date=$request['date'];
				$groupcashbook2->transaction_type=2;
				$groupcashbook2->amount=0;
				$groupcashbook2->payment_mode=$paymentmode;
				$groupcashbook2->lgf=0;
				$groupcashbook2->loan_principal=0;
				$groupcashbook2->loan_interest=0;
				$groupcashbook2->mpesa_charges=0;
				$groupcashbook2->fine=0;
				$groupcashbook2->processing_fees=0;
				$groupcashbook2->insurance_deduction_fees=0;
				$groupcashbook2->collecting_officer=$user->name;
				$groupcashbook2->clearing_fees=0;

				//interest credti
				$groupcashbook21=new GroupCashBooks();

				$groupcashbook21->transaction_id= $transactionnumber;
				$groupcashbook21->transacting_group=$client->group->client_group;
				$groupcashbook21->transaction_reference= $transactionnumber;
				$groupcashbook21->transaction_date=$request['date'];
				$groupcashbook21->transaction_type=1;
				$groupcashbook21->amount=0;
				$groupcashbook21->payment_mode=$paymentmode;
				$groupcashbook21->lgf=0;
				$groupcashbook21->loan_principal=0;
				$groupcashbook21->loan_interest=0;
				$groupcashbook21->mpesa_charges=0;
				$groupcashbook21->fine=0;
				$groupcashbook21->processing_fees=0;
				$groupcashbook21->insurance_deduction_fees=0;
				$groupcashbook21->collecting_officer=$user->name;
				$groupcashbook21->clearing_fees=0;

				if (!empty($date) && !empty($transactionnumber) && !empty($paymentmode)) {

					for ($c = 0; $c < count($clientrequests); $c++) {
						if (isset($loanrequests[$c]) && isset($loanpaymentrequests[$c]) && $loanpaymentrequests[$c] > 0) {

							$ExistingLoanPayments=LoanPayments::where([["transaction_number","=",$transactionnumber],["loan","=",$loanrequests[$c]]])->get();

							if(isset($ExistingLoanPayments) && count($ExistingLoanPayments)>0)
								throw new Exception("Transaction already exists");

							$loanpayments = new LoanPayments();
							$loanpayments->loan = $loanrequests[$c];
							$loanpayments->mode_of_payment = $paymentmode;
							$loanpayments->amount = $loanpaymentrequests[$c];
							$loanpayments->date = $date;
							$loanpayments->transaction_number = $transactionnumber;
							$transactionstatuses = TransactionStatuses::where([['code', '=', '002']])->get();
							$loanpayments->transaction_status = $transactionstatuses[0]['id'];

							// $product=LoanProducts::find($loan->loan_product);
							$productprincipalconfigurations = ProductPrincipalConfigurations::where([
								'loan_product' => $loan->loan_product,
								'payment_mode' => $loanpayments->mode_of_payment
							])->get();

							$productinterestconfigurations = ProductInterestConfigurations::where([
								'loan_product' => $loan->loan_product,
								'payment_mode' => $loanpayments->mode_of_payment
							])->get();
							
							$interest = (($loanpayments->amount / (1 + $loan->interest_rate / 100)) * ($loan->interest_rate / 100));

							$principal = $loanpayments->amount - $interest;

							$groupcashbook->amount=$groupcashbook->amount+$principal;
							// $groupcashbook->loan_interest=$groupcashbook->loan_interest+$interest;
							$groupcashbook->account=$productprincipalconfigurations[0]['debit_account'];

							$groupcashbook1->amount=$groupcashbook1->amount+$principal;
							$groupcashbook1->loan_interest=$groupcashbook1->loan_interest+$interest;
							$groupcashbook1->account=$productprincipalconfigurations[0]['credit_account'];


							$groupcashbook2->amount=$groupcashbook2->amount+$interest;
							$groupcashbook2->account=$productinterestconfigurations[0]['debit_account'];

							$groupcashbook21->amount=$groupcashbook21->amount+$interest;
							$groupcashbook21->account=$productinterestconfigurations[0]['credit_account'];


							if (isset($productinterestconfigurations[0]) && isset($productprincipalconfigurations[0])) {

								$generalLedger = new GeneralLedgers();
								$generalLedger->account = $productinterestconfigurations[0]['debit_account'];
								$generalLedger->entry_type = $debit[0]['id'];
								$generalLedger->transaction_number = $transactionnumber;
								$generalLedger->loan = $loan->id;
								$generalLedger->secondary_description = "Interest payments";
								$generalLedger->amount = $interest;
								$generalLedger->date = $loanpayments->date;
								$generalLedger->save();

								$generalLedger = new GeneralLedgers();
								$generalLedger->account = $productinterestconfigurations[0]['credit_account'];
								$generalLedger->entry_type = $credit[0]['id'];
								$generalLedger->transaction_number = $transactionnumber;
								$generalLedger->amount = $interest;
								$generalLedger->loan = $loan->id;
								$generalLedger->secondary_description = "Interest payments";
								$generalLedger->date = $loanpayments->date;
								$generalLedger->save();

								$generalLedger = new GeneralLedgers();
								$generalLedger->account = $productprincipalconfigurations[0]['debit_account'];
								$generalLedger->entry_type = $debit[0]['id'];
								$generalLedger->transaction_number = $transactionnumber;
								$generalLedger->loan = $loan->id;
								$generalLedger->secondary_description = "Principal payments";
								$generalLedger->amount = $principal;
								$generalLedger->date = $loanpayments->date;
								$generalLedger->save();

								$generalLedger = new GeneralLedgers();
								$generalLedger->account = $productprincipalconfigurations[0]['credit_account'];
								$generalLedger->entry_type = $credit[0]['id'];
								$generalLedger->transaction_number = $transactionnumber;
								$generalLedger->loan = $loan->id;
								$generalLedger->secondary_description = "Principal payments";
								$generalLedger->amount = $principal;
								$generalLedger->date = $loanpayments->date;
								$generalLedger->save();

								$loanpayments->save();

							} else {

								return redirect()->back()->with("failed", "Loan configurations missing for !" . $loan->loan_number);
							}
						}
					}
				}

				$groupcashbook->save();
				$groupcashbook1->save();
				$groupcashbook2->save();
				$groupcashbook21->save();

				$loan->status = 4;
				$loan->save();

				return true;
			}

			return false;
		});

	}

	public function getoverralloanbalance($clientid)
	{

		$approved = LoanStatuses::where([["code", "=", "002"]])->get()->first();

		$loans = Loans::where([["client", "=", $clientid], ["status", "=", $approved->id]])->get();

		$overralloanamount = 0;

		for ($r = 0; $r < count($loans); $r++) {

			$disbursed = DisbursementStatuses::where([["code", "=", "002"]])->get()->first();

			$disbursement = LoanDisbursements::where([["loan", "=", $loans[$r]->id], ["disbursement_status", "=", $disbursed->id]])->get()->first();

			if (isset($disbursement)) {

				$overralloanamount = $overralloanamount + $loans[$r]->total_loan_amount;

				$payments = LoanPayments::where([["loan", "=", $loans[$r]->id]])->sum("amount");

				$overralloanamount = $overralloanamount - $payments;
			}
		}

		return $overralloanamount;
	}


	public function getloanbalancebyid($id)
	{

		$approved = LoanStatuses::where([["code", "=", "002"]])->get()->first();

		$loans = Loans::where([["id","=",$id], ["status", "=", $approved->id]])->get();

		$overralloanamount = 0;

		for ($r = 0; $r < count($loans); $r++) {

			$disbursed = DisbursementStatuses::where([["code", "=", "002"]])->get()->first();

			$disbursement = LoanDisbursements::where([["loan", "=", $loans[$r]->id], ["disbursement_status", "=", $disbursed->id]])->get()->first();

			if (isset($disbursement)) {

				$overralloanamount = $overralloanamount + $loans[$r]->total_loan_amount;

				$payments = LoanPayments::where([["loan", "=", $loans[$r]->id]])->sum("amount");

				$overralloanamount = $overralloanamount - $payments;
			}
		}

		return $overralloanamount;
	}

	public function getprocessingfeebalance($loanid)
	{

		$loan = Loans::find($loanid);

		$balance = 0;

		$processingfee = $loan->processing_fee;

		$processingfeepayment = ProcessingFeePayments::where([["loan_number", "=", $loan->id]])->get()->first();

		if (isset($processingfeepayment)) {

			$balance = (($processingfee / 100) * $loan->amount) - $processingfeepayment->amount;

			return $balance;
		}

		$balance = (($processingfee / 100) * $loan->amount);

		return $balance;
	}
}
