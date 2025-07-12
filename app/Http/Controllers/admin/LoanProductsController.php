<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\LoanProducts;
use App\Companies;
use App\Modules;
use App\Users;
use App\GracePeriods;
use App\DisbursementModes;
use App\FineTypes;
use App\FineChargeFrequencies;
use App\FineChargePeriods;
use App\InterestRateTypes;
use App\DisbursementChargeTypes;
use App\DefaulterMeters;
use App\InterestPaymentMethods;
use App\CollateralValueTypes;
use App\LoanPaymentDurations;
use App\LoanPaymentFrequencies;
use App\LoanProductAssets;
use App\Positions;
use App\ClientTypes;
use App\UsersAccounts;
use App\ApprovalLevels;
use App\InterestRatePeriods;
use App\FeeTypes;
use App\InsuranceDeductionConfigurations;
use App\ClearingFeeConfigurations;
use App\ProcessingFeeConfigurations;
use App\ProductClientTypes;
use App\ProductDisbursementModes;
use App\ProductUserAccounts;
use App\FeePaymentTypes;
use App\ProductApprovalConfigurations;
use App\ProductDisbursementConfigurations;
use App\ProductPrincipalConfigurations;
use App\ProductInterestConfigurations;
use App\Accounts;
use App\ClientLgfBalances;
use App\GracePeriodTypes;
use App\PaymentModes;
use App\Products;
use Illuminate\Support\Facades\DB;
use App\MinimumMembershipPeriods;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;

class LoanProductsController extends Controller
{

	public function __construct()
	{
		$this->middleware('auth');
	}
	public function index()
	{
		$loanproductsdata['graceperiods'] = GracePeriods::all();
		$loanproductsdata['disbursementmodes'] = DisbursementModes::all();
		$loanproductsdata['finetypes'] = FineTypes::all();
		$loanproductsdata['finechargefrequencies'] = FineChargeFrequencies::all();
		$loanproductsdata['finechargeperiods'] = FineChargePeriods::all();
		$loanproductsdata['interestratetypes'] = InterestRateTypes::all();
		$loanproductsdata['interestpaymentmethods'] = InterestPaymentMethods::all();
		$loanproductsdata['loanpaymentdurations'] = LoanPaymentDurations::all();
		$loanproductsdata['minimummembershipperiods'] = MinimumMembershipPeriods::all();
		$loanproductsdata['list'] = LoanProducts::all();
		$user = Users::where([['id', '=', Auth::id()]])->get();
		$module = Modules::where([['name', '=', 'LoanProducts']])->get();
		$loanproductsdata['usersaccountsroles'] = UsersAccountsRoles::where([['user_account', '=', $user[0]['user_account']], ['module', '=', $module[0]['id']]])->get();
		if ($loanproductsdata['usersaccountsroles'][0]['_add'] == 0 && $loanproductsdata['usersaccountsroles'][0]['_list'] == 0 && $loanproductsdata['usersaccountsroles'][0]['_edit'] == 0 && $loanproductsdata['usersaccountsroles'][0]['_edit'] == 0 && $loanproductsdata['usersaccountsroles'][0]['_show'] == 0 && $loanproductsdata['usersaccountsroles'][0]['_delete'] == 0 && $loanproductsdata['usersaccountsroles'][0]['_report'] == 0) {
			return view('admin.error.denied', compact('loanproductsdata'));
		} else {
			return view('admin.loan_products.index', compact('loanproductsdata'));
		}
	}
	function getLoanProduct(Request $request)
	{
		$data = LoanProducts::find($request->get('id'));
		return $data;
	}

	public function create()
	{
		$loanproductsdata;
		$loanproductsdata["paymentmodes"] = PaymentModes::all();
		$loanproductsdata["defaultermeters"] = DefaulterMeters::all();
		$loanproductsdata["collateralvaluetypes"] = CollateralValueTypes::all();
		$loanproductsdata["interestrateperiods"] = InterestRatePeriods::all();
		$loanproductsdata["assets"] = Products::all();
		$loanproductsdata['clienttypes'] = ClientTypes::all();
		$loanproductsdata['disbursementchargetypes'] = DisbursementChargeTypes::all();
		$loanproductsdata['loanpaymentfrequencies'] = LoanPaymentFrequencies::all();
		$loanproductsdata["positions"] = Positions::all();
		$loanproductsdata["feetypes"] = FeeTypes::all();
		$loanproductsdata["feepaymenttypes"] = FeePaymentTypes::all();
		$loanproductsdata["graceperiodtypes"] = GracePeriodTypes::all();
		$loanproductsdata['accounts'] = Accounts::all();
		$loanproductsdata['useraccounts'] = UsersAccounts::all();
		$loanproductsdata['graceperiods'] = GracePeriods::all();
		$loanproductsdata['approvallevels'] = ApprovalLevels::all();
		$loanproductsdata['usersaccounts'] = UsersAccounts::all();
		$loanproductsdata['disbursementmodes'] = DisbursementModes::all();
		$loanproductsdata['finetypes'] = FineTypes::all();
		$loanproductsdata['finechargefrequencies'] = FineChargeFrequencies::all();
		$loanproductsdata['finechargeperiods'] = FineChargePeriods::all();
		$loanproductsdata['interestratetypes'] = InterestRateTypes::all();
		$loanproductsdata['interestpaymentmethods'] = InterestPaymentMethods::all();
		$loanproductsdata['loanpaymentdurations'] = LoanPaymentDurations::all();
		$loanproductsdata['minimummembershipperiods'] = MinimumMembershipPeriods::all();
		$user = Users::where([['id', '=', Auth::id()]])->get();
		$module = Modules::where([['name', '=', 'LoanProducts']])->get();
		$loanproductsdata['usersaccountsroles'] = UsersAccountsRoles::where([['user_account', '=', $user[0]['user_account']], ['module', '=', $module[0]['id']]])->get();
		if ($loanproductsdata['usersaccountsroles'][0]['_add'] == 0) {
			return view('admin.error.denied', compact('loanproductsdata'));
		} else {
			return view('admin.loan_products.create', compact('loanproductsdata'));
		}
	}

	public function filter(Request $request)
	{
		$loanproductsdata['graceperiods'] = GracePeriods::all();
		$loanproductsdata['disbursementmodes'] = DisbursementModes::all();
		$loanproductsdata['finetypes'] = FineTypes::all();
		$loanproductsdata['finechargefrequencies'] = FineChargeFrequencies::all();
		$loanproductsdata['finechargeperiods'] = FineChargePeriods::all();
		$loanproductsdata['interestratetypes'] = InterestRateTypes::all();
		$loanproductsdata['interestpaymentmethods'] = InterestPaymentMethods::all();
		$loanproductsdata['loanpaymentdurations'] = LoanPaymentDurations::all();
		$loanproductsdata['minimummembershipperiods'] = MinimumMembershipPeriods::all();
		$loanproductsdata['list'] = LoanProducts::where([['code', 'LIKE', '%' . $request->get('code') . '%'], ['name', 'LIKE', '%' . $request->get('name') . '%'], ['description', 'LIKE', '%' . $request->get('description') . '%'], ['grace_period', 'LIKE', '%' . $request->get('grace_period') . '%'], ['mode_of_disbursement', 'LIKE', '%' . $request->get('mode_of_disbursement') . '%'], ['fine_type', 'LIKE', '%' . $request->get('fine_type') . '%'], ['fine_charge', 'LIKE', '%' . $request->get('fine_charge') . '%'], ['fine_charge_frequency', 'LIKE', '%' . $request->get('fine_charge_frequency') . '%'], ['fine_charge_period', 'LIKE', '%' . $request->get('fine_charge_period') . '%'], ['interest_rate_type', 'LIKE', '%' . $request->get('interest_rate_type') . '%'], ['compounds_per_year', 'LIKE', '%' . $request->get('compounds_per_year') . '%'], ['interest_rate', 'LIKE', '%' . $request->get('interest_rate') . '%'], ['interest_payment_method', 'LIKE', '%' . $request->get('interest_payment_method') . '%'], ['initial_deposit', 'LIKE', '%' . $request->get('initial_deposit') . '%'], ['loan_payment_duration', 'LIKE', '%' . $request->get('loan_payment_duration') . '%'], ['minimum_loan_amount', 'LIKE', '%' . $request->get('minimum_loan_amount') . '%'], ['maximum_loan_amount', 'LIKE', '%' . $request->get('maximum_loan_amount') . '%'], ['can_change_disbursement_mode', 'LIKE', '%' . $request->get('can_change_disbursement_mode') . '%'], ['can_access_another_loan', 'LIKE', '%' . $request->get('can_access_another_loan') . '%'], ['clearing_fee', 'LIKE', '%' . $request->get('clearing_fee') . '%'], ['number_of_guarantors', 'LIKE', '%' . $request->get('number_of_guarantors') . '%'], ['minimum_membership_period', 'LIKE', '%' . $request->get('minimum_membership_period') . '%'], ['insurance_deduction_fee', 'LIKE', '%' . $request->get('insurance_deduction_fee') . '%'],])->get();
		$user = Users::where([['id', '=', Auth::id()]])->get();
		$module = Modules::where([['name', '=', 'LoanProducts']])->get();
		$loanproductsdata['usersaccountsroles'] = UsersAccountsRoles::where([['user_account', '=', $user[0]['user_account']], ['module', '=', $module[0]['id']]])->get();
		if ($loanproductsdata['usersaccountsroles'][0]['_add'] == 0 && $loanproductsdata['usersaccountsroles'][0]['_list'] == 0 && $loanproductsdata['usersaccountsroles'][0]['_edit'] == 0 && $loanproductsdata['usersaccountsroles'][0]['_edit'] == 0 && $loanproductsdata['usersaccountsroles'][0]['_show'] == 0 && $loanproductsdata['usersaccountsroles'][0]['_delete'] == 0 && $loanproductsdata['usersaccountsroles'][0]['_report'] == 0) {
			return view('admin.error.denied', compact('loanproductsdata'));
		} else {
			return view('admin.loan_products.index', compact('loanproductsdata'));
		}
	}

	public function report()
	{
		$loanproductsdata['company'] = Companies::all();
		$loanproductsdata['list'] = LoanProducts::all();
		$user = Users::where([['id', '=', Auth::id()]])->get();
		$module = Modules::where([['name', '=', 'LoanProducts']])->get();
		$loanproductsdata['usersaccountsroles'] = UsersAccountsRoles::where([['user_account', '=', $user[0]['user_account']], ['module', '=', $module[0]['id']]])->get();
		if ($loanproductsdata['usersaccountsroles'][0]['_report'] == 0) {
			return view('admin.error.denied', compact('loanproductsdata'));
		} else {
			return view('admin.loan_products.report', compact('loanproductsdata'));
		}
	}

	public function chart()
	{
		return view('admin.loan_products.chart');
	}

	public function store(Request $request)
	{
		$loanproducts = new LoanProducts();

		$count = LoanProducts::count() + 1;

		$code = "";
		if ($count < 10) {
			$code = "JKLP000" . $count;
		} else if ($count >= 10 && $count < 100) {
			$code = "JKLP00" . $count;
		} else if ($count >= 100 && $count < 1000) {
			$code = "JKLP0" . $count;
		} else if ($count > 1000) {
			$code = "JKLP" . $count;
		}

		$loanproducts->code = $code;

		$loanproducts->name = $request->get('name');

		$loanproducts->description = $request->get('description');
		$loanproducts->defaulter_meter = $request->get("defaulter_meter");
		$loanproducts->min_collateral_value = $request->get("min_collateral_value");
		$loanproducts->min_collateral_value_type = $request->get("min_collateral_value_type");
		$loanproducts->grace_period_type = $request->get('grace_period_type');
		$loanproducts->grace_period = $request->get('grace_period');
		$loanproducts->min_grace_period = $request->get('min_grace_period');
		$loanproducts->max_grace_period = $request->get('max_grace_period');
		$loanproducts->fine_type = $request->get('fine_type');
		$loanproducts->fine_charge = $request->get('fine_charge');
		$loanproducts->fine_charge_frequency = $request->get('fine_charge_frequency');
		$loanproducts->loan_payment_frequency = $request->get('loan_payment_frequency');
		$loanproducts->fine_charge_period = $request->get('fine_charge_period');
		$loanproducts->interest_rate_type = $request->get('interest_rate_type');
		$loanproducts->interest_rate_period = $request->get('interest_rate_period');
		$loanproducts->compounds_per_year = $request->get('compounds_per_year');
		$loanproducts->interest_rate = $request->get('interest_rate');
		$loanproducts->interest_payment_method = $request->get('interest_payment_method');
		$loanproducts->initial_deposit = $request->get('initial_deposit');
		$loanproducts->loan_payment_duration = $request->get('loan_payment_duration');
		$loanproducts->minimum_loan_amount = $request->get('minimum_loan_amount');
		$loanproducts->maximum_loan_amount = $request->get('maximum_loan_amount');

		$loanproducts->can_access_another_loan = $request->get('can_access_another_loan');
		$loanproducts->clearing_fee = $request->get('clearing_fee');
		$loanproducts->clearing_fee_type = $request->get('clearing_fee_type');
		$loanproducts->clearing_fee_payment_type = $request->get('clearing_fee_payment_type');

		$loanproducts->processing_fee = $request->get('processing_fee');
		$loanproducts->processing_fee_type = $request->get('processing_fee_type');
		$loanproducts->processing_fee_payment_type = $request->get('processing_fee_payment_type');
		$loanproducts->depends_on_lgf = $request->get("depends_on_lgf");
		$loanproducts->lgf_type = $request->get("lgf_type");
		$loanproducts->lgf = $request->get("lgf");
		$loanproducts->number_of_guarantors = $request->get('number_of_guarantors');
		$loanproducts->minimum_membership_period = $request->get('minimum_membership_period');
		$loanproducts->insurance_deduction_fee_type = $request->get('insurance_deduction_fee_type');
		$loanproducts->insurance_deduction_fee_payment_type = $request->get('insurance_deduction_fee_payment_type');
		$loanproducts->insurance_deduction_fee = $request->get('insurance_deduction_fee');
		$loanproducts->is_asset = $request->get('is_asset');

		$response = array();

		$user = Users::where([['id', '=', Auth::id()]])->get();
		$module = Modules::where([['name', '=', 'LoanProducts']])->get();
		$loanproductsdata['usersaccountsroles'] = UsersAccountsRoles::where([['user_account', '=', $user[0]['user_account']], ['module', '=', $module[0]['id']]])->get();
		if ($loanproductsdata['usersaccountsroles'][0]['_show'] == 1) {
			try {

				return DB::transaction(function () use ($request, $loanproducts) {
					$loanproducts->save();
					$feetypeinsurancedeductionconfig = $request->get("fee_type_insurance_deduction_config");
					$feepaymenttypeinsurancedeductionconfig = $request->get("fee_payment_type_insurance_deduction_config");
					$paymentmodeinsurancedeductionconfig = $request->get("payment_mode_insurance_deduction_config");
					$disbursementmodeinsurancedeductionconfig = $request->get("disbursement_mode_insurance_deduction_config");
					$debitaccountinsurancedeductionconfig = $request->get("debit_account_insurance_deduction_config");
					$creditaccountinsurancedeductionconfig = $request->get("credit_account_insurance_deduction_config");



					for ($r = 0; $r < count($feetypeinsurancedeductionconfig); $r++) {

						$insurancedeductionconfiguration = new InsuranceDeductionConfigurations();
						$insurancedeductionconfiguration->loan_product = $loanproducts->id;
						$insurancedeductionconfiguration->fee_type = $feetypeinsurancedeductionconfig[$r];
						$insurancedeductionconfiguration->fee_payment_type = $feepaymenttypeinsurancedeductionconfig[$r];
						$insurancedeductionconfiguration->payment_mode = $paymentmodeinsurancedeductionconfig[$r];
						$insurancedeductionconfiguration->disbursement_mode = $disbursementmodeinsurancedeductionconfig[$r];
						$insurancedeductionconfiguration->debit_account = $debitaccountinsurancedeductionconfig[$r];
						$insurancedeductionconfiguration->credit_account = $creditaccountinsurancedeductionconfig[$r];
						$insurancedeductionconfiguration->save();
					}

					$feetypeclearingfeeconfig = $request->get("fee_type_clearing_fee_config");
					$feepaymenttypeclearingfeeconfig = $request->get("fee_payment_type_clearing_fee_config");
					$debitaccountclearingfeeconfig = $request->get("debit_account_clearing_fee_config");
					$creditaccuntclearingfeeconfig = $request->get("credit_account_clearing_fee_config");
					$paymentmodeclearingfeeconfig = $request->get("payment_mode_clearing_fee_config");
					$disbursementmodeclearingfeeconfig = $request->get("disbursement_mode_clearing_fee_config");
					for ($r = 0; $r < count($feetypeclearingfeeconfig); $r++) {
						$clearingfeeconfiguration = new ClearingFeeConfigurations();
						$clearingfeeconfiguration->loan_product = $loanproducts->id;
						$clearingfeeconfiguration->fee_type = $feetypeclearingfeeconfig[$r];
						$clearingfeeconfiguration->fee_payment_type = $feepaymenttypeclearingfeeconfig[$r];
						$clearingfeeconfiguration->payment_mode = $paymentmodeclearingfeeconfig[$r];
						$clearingfeeconfiguration->disbursement_mode = $disbursementmodeclearingfeeconfig[$r];
						$clearingfeeconfiguration->debit_account = $debitaccountclearingfeeconfig[$r];
						$clearingfeeconfiguration->credit_account = $creditaccuntclearingfeeconfig[$r];
						$clearingfeeconfiguration->save();
					}

					$feetypeprocessingfeeconfig = $request->get("fee_type_processing_fee_config");
					$feepaymenttypeprocessingfeeconfig = $request->get("fee_payment_type_processing_fee_config");
					$debitaccountprocessingfeeconfig = $request->get("debit_account_processing_fee_config");
					$creditaccuntprocessingfeeconfig = $request->get("credit_account_processing_fee_config");
					$paymentmodeprocessingfeeconfig = $request->get("payment_mode_processing_fee_config");
					$disbursementmodeprocessingfeeconfig = $request->get("disbursement_mode_processing_fee_config");

					for ($r = 0; $r < count($feetypeprocessingfeeconfig); $r++) {
						$processingfeeconfiguration = new ProcessingFeeConfigurations();
						$processingfeeconfiguration->loan_product = $loanproducts->id;
						$processingfeeconfiguration->fee_type = $feetypeprocessingfeeconfig[$r];
						$processingfeeconfiguration->fee_payment_type = $feepaymenttypeprocessingfeeconfig[$r];
						$processingfeeconfiguration->payment_mode = $paymentmodeprocessingfeeconfig[$r];
						$processingfeeconfiguration->disbursement_mode = $disbursementmodeprocessingfeeconfig[$r];
						$processingfeeconfiguration->debit_account = $debitaccountprocessingfeeconfig[$r];
						$processingfeeconfiguration->credit_account = $creditaccuntprocessingfeeconfig[$r];
						$processingfeeconfiguration->save();
					}

					$productclienttypeconfig = $request->get("client_type_config");
					for ($r = 0; $r < count($productclienttypeconfig); $r++) {
						$productclienttype = new ProductClientTypes();
						$productclienttype->loan_product = $loanproducts->id;
						$productclienttype->client_type = $productclienttypeconfig[$r];
						$productclienttype->save();
					}

					$loanproductassets = $request->get("loan_product_assets");
					$loanproductassetquantities = $request->get("loan_product_asset_quantities");

					if (isset($loanproductassets)) {
						for ($r = 0; $r < count($loanproductassets); $r++) {
							$loanproductasset = new LoanProductAssets();
							$loanproductasset->loan_product = $loanproducts->id;
							$loanproductasset->asset = $loanproductassets[$r];
							$loanproductasset->quantity = $loanproductassetquantities[$r];
							$loanproductasset->save();
						}
					}



					$productdisbursementmodeconfigs = $request->get("disbursement_mode_config");

					if (isset($productdisbursementmodeconfigs)) {
						for ($r = 0; $r < count($productdisbursementmodeconfigs); $r++) {
							$productdisbursementmode = new ProductDisbursementModes();
							$productdisbursementmode->loan_product = $loanproducts->id;
							$productdisbursementmode->disbursement_mode = $productdisbursementmodeconfigs[$r];
							$productdisbursementmode->save();
						}
					}

					$productuseraccountconfigs = $request->get("user_account_config");

					for ($r = 0; $r < count($productuseraccountconfigs); $r++) {
						$productuseraccount = new ProductUserAccounts();
						$productuseraccount->loan_product = $loanproducts->id;
						$productuseraccount->user_account = $productuseraccountconfigs[$r];
						$productuseraccount->save();
					}

					$disbursementmodeconfiguration = $request->get("disbursement_mode_configuration");


					$debitaccountdisbursementconfiguration = $request->get("debit_account_disbursement_configuration");

					$creditaccountdisbursementconfiguration = $request->get("credit_account_disbursement_configuration");

					if (isset($disbursementmodeconfiguration)) {
						for ($r = 0; $r < count($disbursementmodeconfiguration); $r++) {
							$productdisbursementconfigurations = new ProductDisbursementConfigurations();
							$productdisbursementconfigurations->loan_product = $loanproducts->id;
							$productdisbursementconfigurations->disbursement_mode = $disbursementmodeconfiguration[$r];
							$productdisbursementconfigurations->debit_account = $debitaccountdisbursementconfiguration[$r];
							$productdisbursementconfigurations->credit_account = $creditaccountdisbursementconfiguration[$r];
							$productdisbursementconfigurations->save();
						}
					}

					$principalpaymentmodeconfig = $request->get("principal_payment_mode_config");
					$debitaccountprincipalconfig = $request->get("debit_account_principal_config");
					$creditaccountprincipalconfig = $request->get("credit_account_principal_config");
					for ($r = 0; $r < count($principalpaymentmodeconfig); $r++) {
						$productprincipalconfigurations = new ProductPrincipalConfigurations();
						$productprincipalconfigurations->loan_product = $loanproducts->id;
						$productprincipalconfigurations->payment_mode = $principalpaymentmodeconfig[$r];
						$productprincipalconfigurations->debit_account = $debitaccountprincipalconfig[$r];
						$productprincipalconfigurations->credit_account = $creditaccountprincipalconfig[$r];
						$productprincipalconfigurations->save();
					}

					$interestpaymentmethodconfig = $request->get("interest_payment_method_config");
					$paymentmodeinterestconfig = $request->get("payment_mode_interest_config");
					$debitaccountinterestconfig = $request->get("debit_account_interest_config");
					$creditaccountinterestconfig = $request->get("credit_account_interest_config");
					for ($r = 0; $r < count($interestpaymentmethodconfig); $r++) {
						$productinterestconfigurations = new ProductInterestConfigurations();
						$productinterestconfigurations->loan_product = $loanproducts->id;
						$productinterestconfigurations->interest_payment_method = $interestpaymentmethodconfig[$r];
						$productinterestconfigurations->payment_mode = $paymentmodeinterestconfig[$r];
						$productinterestconfigurations->debit_account = $debitaccountinterestconfig[$r];
						$productinterestconfigurations->credit_account = $creditaccountinterestconfig[$r];
						$productinterestconfigurations->save();
					}

					$approvallevelconfig = $request->get("approval_level_config");
					$useraccountapprovalconfig = $request->get("user_account_approval_config");
					for ($r = 0; $r < count($approvallevelconfig); $r++) {
						$productapprovalconfigurations = new ProductApprovalConfigurations();
						$productapprovalconfigurations->loan_product = $loanproducts->id;
						$productapprovalconfigurations->approval_level = $approvallevelconfig[$r];
						$productapprovalconfigurations->user_account = $useraccountapprovalconfig[$r];
						$productapprovalconfigurations->save();
					}


					$response['status'] = '1';
					$response['message'] = 'loan products Added successfully';
					return json_encode($response);
				});
			} catch (Exception $e) {
				$response['status'] = '0';
				$response['message'] = 'An Error occured while attempting to add loan products. Please try again';
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
		$loanproductsdata["interestrateperiods"] = InterestRatePeriods::all();
		$loanproductsdata['graceperiods'] = GracePeriods::all();
		$loanproductsdata['disbursementmodes'] = DisbursementModes::all();
		$loanproductsdata['finetypes'] = FineTypes::all();
		$loanproductsdata['loanpaymentfrequencies'] = LoanPaymentFrequencies::all();
		$loanproductsdata['finechargefrequencies'] = FineChargeFrequencies::all();
		$loanproductsdata['finechargeperiods'] = FineChargePeriods::all();
		$loanproductsdata['interestratetypes'] = InterestRateTypes::all();
		$loanproductsdata['interestpaymentmethods'] = InterestPaymentMethods::all();
		$loanproductsdata['loanpaymentdurations'] = LoanPaymentDurations::all();
		$loanproductsdata["assets"] = Products::all();
		$loanproductsdata['minimummembershipperiods'] = MinimumMembershipPeriods::all();
		$loanproductsdata["graceperiodtypes"] = GracePeriodTypes::all();
		$loanproductsdata['usersaccounts'] = UsersAccounts::all();
		$loanproductsdata['productuseraccounts'] = ProductUserAccounts::where([['loan_product', '=', $id]])->orderBy('id', 'desc')->get();
		$loanproductsdata['clienttypes'] = ClientTypes::all();
		$loanproductsdata['productclienttypes'] = ProductClientTypes::where([['loan_product', '=', $id]])->orderBy('id', 'desc')->get();
		$loanproductsdata["productdisbursementmodes"] = ProductDisbursementModes::where([['loan_product', '=', $id]])->orderBy('id', 'desc')->get();
		$loanproductsdata['productdisbursementconfigurations'] = ProductDisbursementConfigurations::where([['loan_product', '=', $id]])->orderBy('id', 'desc')->get();
		$loanproductsdata['insurancedeductionconfigurations'] = InsuranceDeductionConfigurations::where([['loan_product', '=', $id]])->orderBy('id', 'desc')->get();
		$loanproductsdata['clearingfeeconfigurations'] = ClearingFeeConfigurations::where([['loan_product', '=', $id]])->orderBy('id', 'desc')->get();
		$loanproductsdata['productinterestconfigurations'] = ProductInterestConfigurations::where([['loan_product', '=', $id]])->orderBy('id', 'desc')->get();
		$loanproductsdata['productprincipalconfigurations'] = ProductPrincipalConfigurations::where([['loan_product', '=', $id]])->orderBy('id', 'desc')->get();
		$loanproductsdata['productapprovalconfigurations'] = ProductApprovalConfigurations::where([['loan_product', '=', $id]])->orderBy('id', 'desc')->get();
		$loanproductsdata['accounts'] = Accounts::all();
		$loanproductsdata['paymentmodes'] = PaymentModes::all();
		$loanproductsdata['graceperiods'] = GracePeriods::all();
		$loanproductsdata['approvallevels'] = ApprovalLevels::all();
		$loanproductsdata['disbursementmodes'] = DisbursementModes::all();
		$loanproductsdata['finetypes'] = FineTypes::all();
		$loanproductsdata['finechargefrequencies'] = FineChargeFrequencies::all();
		$loanproductsdata['finechargeperiods'] = FineChargePeriods::all();
		$loanproductsdata['interestratetypes'] = InterestRateTypes::all();
		$loanproductsdata['interestpaymentmethods'] = InterestPaymentMethods::all();
		$loanproductsdata['loanpaymentdurations'] = LoanPaymentDurations::all();
		$loanproductsdata['minimummembershipperiods'] = MinimumMembershipPeriods::all();
		$loanproductsdata['data'] = LoanProducts::find($id);
		$user = Users::where([['id', '=', Auth::id()]])->get();
		$module = Modules::where([['name', '=', 'LoanProducts']])->get();
		$loanproductsdata['usersaccountsroles'] = UsersAccountsRoles::where([['user_account', '=', $user[0]['user_account']], ['module', '=', $module[0]['id']]])->get();
		if ($loanproductsdata['usersaccountsroles'][0]['_edit'] == 0) {
			return view('admin.error.denied', compact('loanproductsdata'));
		} else {
			return view('admin.loan_products.edit', compact('loanproductsdata', 'id'));
		}
	}
	public function loanproductcode()
	{
		$count = LoanProducts::count() + 1;
		$code = "";
		if ($count < 10) {
			$code = "JKLP000" . $count;
		} else if ($count >= 10 && $count < 100) {
			$code = "JKLP00" . $count;
		} else if ($count >= 100 && $count < 1000) {
			$code = "JKLP0" . $count;
		} else if ($count > 1000) {
			$code = "JKLP" . $count;
		}
		return $code;
	}

	public function show($id)
	{
		$loanproductsdata['graceperiods'] = GracePeriods::all();
		$loanproductsdata['disbursementmodes'] = DisbursementModes::all();
		$loanproductsdata['finetypes'] = FineTypes::all();
		$loanproductsdata['finechargefrequencies'] = FineChargeFrequencies::all();
		$loanproductsdata['finechargeperiods'] = FineChargePeriods::all();
		$loanproductsdata['interestratetypes'] = InterestRateTypes::all();
		$loanproductsdata['interestpaymentmethods'] = InterestPaymentMethods::all();
		$loanproductsdata['loanpaymentdurations'] = LoanPaymentDurations::all();
		$loanproductsdata['minimummembershipperiods'] = MinimumMembershipPeriods::all();
		$loanproductsdata['data'] = LoanProducts::find($id);
		$user = Users::where([['id', '=', Auth::id()]])->get();
		$module = Modules::where([['name', '=', 'LoanProducts']])->get();
		$loanproductsdata['usersaccountsroles'] = UsersAccountsRoles::where([['user_account', '=', $user[0]['user_account']], ['module', '=', $module[0]['id']]])->get();
		if ($loanproductsdata['usersaccountsroles'][0]['_show'] == 0) {
			return view('admin.error.denied', compact('loanproductsdata'));
		} else {
			return view('admin.loan_products.show', compact('loanproductsdata', 'id'));
		}
	}

	public function update(Request $request, $id)
	{
		$loanproducts = LoanProducts::find($id);
		$loanproducts->code = $request->get('code');
		$loanproducts->name = $request->get('name');
		$loanproducts->description = $request->get('description');
		$loanproducts->grace_period = $request->get('grace_period');
		$loanproducts->mode_of_disbursement = $request->get('mode_of_disbursement');
		$loanproducts->fine_type = $request->get('fine_type');
		$loanproducts->fine_charge = $request->get('fine_charge');
		$loanproducts->fine_charge_frequency = $request->get('fine_charge_frequency');
		$loanproducts->fine_charge_period = $request->get('fine_charge_period');
		$loanproducts->interest_rate_type = $request->get('interest_rate_type');
		$loanproducts->compounds_per_year = $request->get('compounds_per_year');
		$loanproducts->interest_rate = $request->get('interest_rate');
		$loanproducts->interest_payment_method = $request->get('interest_payment_method');
		$loanproducts->initial_deposit = $request->get('initial_deposit');
		$loanproducts->loan_payment_duration = $request->get('loan_payment_duration');
		$loanproducts->minimum_loan_amount = $request->get('minimum_loan_amount');
		$loanproducts->maximum_loan_amount = $request->get('maximum_loan_amount');

		$loanproducts->can_access_another_loan = $request->get('can_access_another_loan');
		$loanproducts->clearing_fee = $request->get('clearing_fee');
		$loanproducts->number_of_guarantors = $request->get('number_of_guarantors');
		$loanproducts->minimum_membership_period = $request->get('minimum_membership_period');
		$loanproducts->insurance_deduction_fee = $request->get('insurance_deduction_fee');
		$loanproducts->is_asset = $request->get('is_asset');
		$loanproducts->asset = $request->get('asset');

		$user = Users::where([['id', '=', Auth::id()]])->get();
		$module = Modules::where([['name', '=', 'LoanProducts']])->get();
		$loanproductsdata['usersaccountsroles'] = UsersAccountsRoles::where([['user_account', '=', $user[0]['user_account']], ['module', '=', $module[0]['id']]])->get();
		if ($loanproductsdata['usersaccountsroles'][0]['_edit'] == 0) {
			return view('admin.error.denied', compact('loanproductsdata'));
		} else {
			$loanproducts->save();
			$loanproductsdata['data'] = LoanProducts::find($id);
			return view('admin.loan_products.edit', compact('loanproductsdata', 'id'));
		}
	}

	public function destroy($id)
	{
		$loanproducts = LoanProducts::find($id);
		$user = Users::where([['id', '=', Auth::id()]])->get();
		$module = Modules::where([['name', '=', 'LoanProducts']])->get();
		$loanproductsdata['usersaccountsroles'] = UsersAccountsRoles::where([['user_account', '=', $user[0]['user_account']], ['module', '=', $module[0]['id']]])->get();
		if ($loanproductsdata['usersaccountsroles'][0]['_delete'] == 1) {
			$loanproducts->delete();
		}
		return redirect('admin/loanproducts')->with('success', 'loan products has been deleted!');
	}

	public function checkifloanproductdependsonlgf($id, $clientid, $loanamount)
	{

		$loanproduct = LoanProducts::find($id);

		if ($loanproduct->depends_on_lgf == 0)
			return 0;

		$lgfbalance = ClientLgfBalances::where([["client", "=", $clientid]])->get()->first();

		if (isset($lgfbalance)) {

			if ($loanproduct->lgftypemodel->code == "001") {

				if (($lgfbalance->balance) >= (($loanamount * $loanproduct->lgf) / 100)) {
					return 1;
				} else {
					return 2;
				}
			} else if ($loanproduct->lgftypemodel->code == "002") {

				if ($lgfbalance->balance >= $loanproduct->lgf) {
					return 1;
				} else {
					return 2;
				}
			}
		}

		return 3;
	}
}
