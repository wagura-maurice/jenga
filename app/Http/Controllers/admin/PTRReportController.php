<?php

namespace App\Http\Controllers\admin;

use App\Days;
use App\Loans;
use App\Users;
use App\Groups;
use App\Clients;
use App\Modules;
use App\Companies;
use App\Employees;
use App\Positions;
use Carbon\Carbon;
use App\EntryTypes;
use App\GroupRoles;
use App\BankingModes;
use App\GracePeriods;
use App\GroupClients;
use App\LoanPayments;
use App\LoanStatuses;
use App\PaymentModes;
use App\GeneralLedgers;
use App\ClientCategories;
use App\GroupClientRoles;
use App\ClientLgfBalances;
use App\LoanDisbursements;
use App\OtherPaymentTypes;
use App\MeetingFrequencies;
use App\UsersAccountsRoles;
use App\TransactionStatuses;
use Illuminate\Http\Request;
use App\DisbursementStatuses;
use App\LoanPaymentDurations;
use App\ClientLgfContributions;
use App\LoanPaymentFrequencies;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\LgfContributionConfigurations;
use App\ProductInterestConfigurations;
use App\ProductPrincipalConfigurations;

class PTRReportController extends Controller
{

	public function __construct()
	{
		$this->middleware('auth');
	}
	public function index()
	{
		$groupsdata['days'] = Days::all();
		$groupsdata['meetingfrequencies'] = MeetingFrequencies::all();
		$groupsdata['bankingmodes'] = BankingModes::all();
		$position = Positions::where([['code', '=', 'BDO']])->get();
		$groupsdata['employees'] = Employees::where([['position', '=', $position[0]['id']]])->get();
		$groupsdata['list'] = Groups::all();
		$user = Users::where([['id', '=', Auth::id()]])->get();
		$module = Modules::where([['name', '=', 'Groups']])->get();
		$groupsdata['usersaccountsroles'] = UsersAccountsRoles::where([['user_account', '=', $user[0]['user_account']], ['module', '=', $module[0]['id']]])->get();
		if ($groupsdata['usersaccountsroles'][0]['_add'] == 0 && $groupsdata['usersaccountsroles'][0]['_list'] == 0 && $groupsdata['usersaccountsroles'][0]['_edit'] == 0 && $groupsdata['usersaccountsroles'][0]['_edit'] == 0 && $groupsdata['usersaccountsroles'][0]['_show'] == 0 && $groupsdata['usersaccountsroles'][0]['_delete'] == 0 && $groupsdata['usersaccountsroles'][0]['_report'] == 0) {
			return view('admin.error.denied', compact('groupsdata'));
		} else {
			return view('admin.ptr_report.index', compact('groupsdata'));
		}
	}

	public function create()
	{
		$groupsdata;
		$groupsdata['days'] = Days::all();
		$groupsdata['meetingfrequencies'] = MeetingFrequencies::all();
		$groupsdata['bankingmodes'] = BankingModes::all();
		$position = Positions::where([['code', '=', 'BDO']])->get();
		$groupsdata['employees'] = Employees::where([['position', '=', $position[0]['id']]])->get();
		$user = Users::where([['id', '=', Auth::id()]])->get();
		$module = Modules::where([['name', '=', 'Groups']])->get();
		$groupsdata['usersaccountsroles'] = UsersAccountsRoles::where([['user_account', '=', $user[0]['user_account']], ['module', '=', $module[0]['id']]])->get();
		if ($groupsdata['usersaccountsroles'][0]['_add'] == 0) {
			return view('admin.error.denied', compact('groupsdata'));
		} else {
			return view('admin.groups.create', compact('groupsdata'));
		}
	}
	function groupsCount()
	{
		$count = Groups::count();
		return $count;
	}

	public function filter(Request $request)
	{
		$groupsdata['days'] = Days::all();
		$groupsdata['meetingfrequencies'] = MeetingFrequencies::all();
		$groupsdata['bankingmodes'] = BankingModes::all();
		$position = Positions::where([['code', '=', 'BDO']])->get();
		$groupsdata['employees'] = Employees::where([['position', '=', $position[0]['id']]])->get();

		$groupsdata['list'] = Groups::where([['group_number', 'LIKE', '%' . $request->get('group_number') . '%'], ['group_name', 'LIKE', '%' . $request->get('group_name') . '%'], ['meeting_day', 'LIKE', '%' . $request->get('meeting_day') . '%'], ['meeting_time', 'LIKE', '%' . $request->get('meeting_time') . '%'], ['meeting_frequency', 'LIKE', '%' . $request->get('meeting_frequency') . '%'], ['preferred_mode_of_banking', 'LIKE', '%' . $request->get('preferred_mode_of_banking') . '%'], ['officer', 'LIKE', '%' . $request->get('officer') . '%'],])->orWhereBetween('registration_date', [$request->get('registration_datefrom'), $request->get('registration_dateto')])->orWhereBetween('group_formation_date', [$request->get('group_formation_datefrom'), $request->get('group_formation_dateto')])->get();
		$user = Users::where([['id', '=', Auth::id()]])->get();
		$module = Modules::where([['name', '=', 'Groups']])->get();
		$groupsdata['usersaccountsroles'] = UsersAccountsRoles::where([['user_account', '=', $user[0]['user_account']], ['module', '=', $module[0]['id']]])->get();
		if ($groupsdata['usersaccountsroles'][0]['_add'] == 0 && $groupsdata['usersaccountsroles'][0]['_list'] == 0 && $groupsdata['usersaccountsroles'][0]['_edit'] == 0 && $groupsdata['usersaccountsroles'][0]['_edit'] == 0 && $groupsdata['usersaccountsroles'][0]['_show'] == 0 && $groupsdata['usersaccountsroles'][0]['_delete'] == 0 && $groupsdata['usersaccountsroles'][0]['_report'] == 0) {
			return view('admin.error.denied', compact('groupsdata'));
		} else {
			return view('admin.groups.index', compact('groupsdata'));
		}
	}

	public function report()
	{
		$groupsdata['company'] = Companies::all();
		$groupsdata['list'] = Groups::all();
		$user = Users::where([['id', '=', Auth::id()]])->get();
		$module = Modules::where([['name', '=', 'Groups']])->get();
		$groupsdata['usersaccountsroles'] = UsersAccountsRoles::where([['user_account', '=', $user[0]['user_account']], ['module', '=', $module[0]['id']]])->get();
		if ($groupsdata['usersaccountsroles'][0]['_report'] == 0) {
			return view('admin.error.denied', compact('groupsdata'));
		} else {
			return view('admin.groups.report', compact('groupsdata'));
		}
	}

	public function chart()
	{
		return view('admin.groups.chart');
	}

	public function store(Request $request)
	{
		$groups = new Groups();
		$groups->group_number = $request->get('group_number');
		$groups->group_name = $request->get('group_name');
		$groups->meeting_day = $request->get('meeting_day');
		$groups->meeting_time = $request->get('meeting_time');
		$groups->meeting_frequency = $request->get('meeting_frequency');
		$groups->preferred_mode_of_banking = $request->get('preferred_mode_of_banking');
		$groups->registration_date = $request->get('registration_date');
		$groups->group_formation_date = $request->get('group_formation_date');
		$groups->officer = $request->get('officer');
		$response = array();
		$user = Users::where([['id', '=', Auth::id()]])->get();
		$module = Modules::where([['name', '=', 'Groups']])->get();
		$groupsdata['usersaccountsroles'] = UsersAccountsRoles::where([['user_account', '=', $user[0]['user_account']], ['module', '=', $module[0]['id']]])->get();
		if ($groupsdata['usersaccountsroles'][0]['_show'] == 1) {
			try {
				if ($groups->save()) {
					$response['status'] = '1';
					$response['message'] = 'groups Added successfully';
					return json_encode($response);
				} else {
					$response['status'] = '0';
					$response['message'] = 'Failed to add groups. Please try again';
					return json_encode($response);
				}
			} catch (Exception $e) {
				$response['status'] = '0';
				$response['message'] = 'An Error occured while attempting to add groups. Please try again';
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
		$groupsdata['company'] = Companies::all();
		$groupsdata["date"] = Carbon::now()->toDateTimeString();
		$groupsdata['days'] = Days::all();
		$groupsdata['meetingfrequencies'] = MeetingFrequencies::all();
		$groupsdata['bankingmodes'] = BankingModes::all();
		$position = Positions::where([['code', '=', 'BDO']])->get();
		$groupsdata['employees'] = Employees::where([['position', '=', $position[0]['id']]])->get();
		$groupsdata['data'] = Groups::find($id);
		$user = Users::where([['id', '=', Auth::id()]])->get();
		$module = Modules::where([['name', '=', 'Groups']])->get();
		$groupsdata['usersaccountsroles'] = UsersAccountsRoles::where([['user_account', '=', $user[0]['user_account']], ['module', '=', $module[0]['id']]])->get();
		$groupclients = GroupClients::where([['client_group', '=', $id]])->get();
		$groupsdata['clients'] = array();
		$groupsdata['clientcontributions'] = array();
		$groupsdata['paymentmodes'] = PaymentModes::all();
		$groupsdata['otherpaymenttypes'] = OtherPaymentTypes::all();
		$r = 0;
		$totalLgfBalance = 0;
		$totalLoanBalance = 0;
		$grandtotal = 0;
		$clientCategory = ClientCategories::where([['code', '=', '002']])->get();
		$approvedloans = LoanStatuses::where([['code', '=', '002']])->get();
		foreach ($groupclients as $groupclient) {
			$client = Clients::find($groupclient->client);
			if ($client->client_category == $clientCategory[0]['id']) {
				$groupsdata['clients'][] = $client;
				$groupsdata['clientcontributions'][$r]['client'] = $client;
				$groupsdata['clientcontributions'][$r]['lgf'] = array();
				$lastcontribution = ClientLgfContributions::where([['client', '=', $groupclient->client]])->get()->last();

				$tlc = ClientLgfBalances::where([['client', '=', $groupclient->client]])->get()->first();

				$groupsdata['clientcontributions'][$r]['lgf']['totallgfcontribution'] = isset($tlc) ? $tlc->balance : 0;

				if (isset($lastcontribution)) {
					$grandtotal += $lastcontribution->amount;
					$groupsdata['clientcontributions'][$r]['lgf']['lastcontribution'] = $lastcontribution->amount;
					$groupsdata['clientcontributions'][$r]['lgf']['lastcontributiondate'] = $lastcontribution->created_at;
				}

				$clientLoans = Loans::where([['client', '=', $groupclient->client], ['status', '=', $approvedloans[0]->id]])->get();

				$l = 0;

				$groupsdata['clientcontributions'][$r]['loans'] = array();

				for ($cl = 0; $cl < count($clientLoans); $cl++) {

					$disbursementStatus = DisbursementStatuses::where([['code', '=', '002']])->get();

					$loanDisbursed = LoanDisbursements::where([['disbursement_status', '=', $disbursementStatus[0]->id], ['loan', '=', $clientLoans[$cl]->id]])->get();

					if (count($loanDisbursed) > 0) {

						$loanPaid = DB::table('loan_payments')->where('loan', $clientLoans[$cl]->id)->sum('amount');

						$totalloanamount = ($clientLoans[$cl]->total_loan_amount);

						$bal = ($clientLoans[$cl]->total_loan_amount) - $loanPaid;

						if ($bal <= 0)
							continue;

						$date=str_replace('-','/',substr($clientLoans[$cl]->date, 0,10));

						$date=explode("/", $date);

						$date1=$date[0];
						$date2=$date[1];
						$date3=$date[2];


						if(strlen($date1)>2){
						$clientLoans[$cl]->date=$date3.'/'.$date2.'/'.$date1;
						}else{
							$clientLoans[$cl]->date=$date1.'/'.$date2.'/'.$date3;
						}


						$clientLoans[$cl]->parsed_date = Carbon::createFromFormat('d/m/Y', $clientLoans[$cl]->date);

						$groupsdata['clientcontributions'][$r]['loans'][$l] = $clientLoans[$cl];

						$graceperiod = GracePeriods::where([['id', '=', $clientLoans[$cl]->grace_period]])->get();

						$paymentfrequency = LoanPaymentFrequencies::where([['id', '=', $clientLoans[$cl]->loan_payment_frequency]])->get();

						$paymentduration = LoanPaymentDurations::where([['id', '=', $clientLoans[$cl]->loan_payment_duration]])->get();

						$installments = ($paymentduration[0]->number_of_days - $graceperiod[0]->number_of_days) / $paymentfrequency[0]->number_of_days;

						$installmentAmount = $totalloanamount / $installments;

						$loanDate =Carbon::createFromFormat('d/m/Y', $clientLoans[$cl]->date);

						$gp = $loanDate->addDays($graceperiod[0]->number_of_days);

						$cd = $gp->gt(Carbon::now()) ? 0 : ($gp->diffInDays(Carbon::now()));

						$wd = $gp->diffInWeeks(Carbon::now());

						$currentinstallments = $cd > 0 ? round($cd / $paymentfrequency[0]->number_of_days) : 0;

						$currentexpectedamount = $currentinstallments * $installmentAmount;

						if ($cd >= $paymentduration[0]->number_of_days) {

							$noofinstallmentsmissed = $installmentAmount > 0 ? round(($currentexpectedamount - $loanPaid) / $installmentAmount) : 0;

							$groupsdata['clientcontributions'][$r]['loans'][$l]['arrears_period'] = (0 - $noofinstallmentsmissed) . "-" . substr($paymentfrequency[0]->name, 0, 1);

							$groupsdata['clientcontributions'][$r]['loans'][$l]['arrears'] = round(0 - $bal);

							$groupsdata['clientcontributions'][$r]['loans'][$l]['exppay'] = round($installmentAmount) . "-" . substr($paymentfrequency[0]->name, 0, 1);

							$groupsdata['clientcontributions'][$r]['loans'][$l]['nextpay'] = Carbon::now()->toDateString();
						} else {

							$cinstallments = $cd < $paymentfrequency[0]->number_of_days ? 0 : ($paymentfrequency[0]->number_of_days * round(($cd) / $paymentfrequency[0]->number_of_days));

							$nextpay = $gp->addDays(round($currentinstallments*$paymentfrequency[0]->number_of_days));

							$exppay = $installmentAmount;

							$prepayment = 0;
							$prepaymentperiod = 0;
							$prepaymentdays = 0;

							if ($loanPaid > $currentexpectedamount) {
								$prepayment = $loanPaid - $currentexpectedamount;
								$prepaymentinstallments = $installmentAmount > 0 ? round($prepayment / $installmentAmount) : 0;

								$prepaymentdays = $prepaymentinstallments * $paymentfrequency[0]->number_of_days;
								$nextpay = $gp->addDays($prepaymentdays);
							}

							$noofinstallmentsmissed = $installmentAmount > 0 ? round(($currentexpectedamount - $loanPaid) / $installmentAmount) : 0;

							$groupsdata['clientcontributions'][$r]['loans'][$l]['arrears_period'] = "";

							$groupsdata['clientcontributions'][$r]['loans'][$l]['arrears'] = "";

							$groupsdata['clientcontributions'][$r]['loans'][$l]['exppay'] = round($exppay) . "-" . substr($paymentfrequency[0]->name, 0, 1);

							$groupsdata['clientcontributions'][$r]['loans'][$l]['nextpay'] = Carbon::parse($nextpay)->toDateString();
						}

						$lastpayment = LoanPayments::where([['loan', "=", $clientLoans[$cl]->id]])->get()->last();

						$groupsdata['clientcontributions'][$r]['loans'][$l]['rembalance'] = round($clientLoans[$cl]->total_loan_amount - $loanPaid);

						if (isset($lastpayment)) {

							$grandtotal += $lastpayment->amount;

							$groupsdata['clientcontributions'][$r]['loans'][$l]['lastpaydate'] = $lastpayment->date;

							$groupsdata['clientcontributions'][$r]['loans'][$l]['lastpayamount'] = $lastpayment->amount;
						}


						$l++;
					}
				}

				for ($k = 0; $k < count($groupsdata['clientcontributions'][$r]['loans']); $k++) {

					if (count($groupsdata['clientcontributions'][$r]['loans']) > 0) {

						$loanPaid = DB::table('loan_payments')->where('loan', $groupsdata['clientcontributions'][$r]['loans'][$k]->id)->sum('amount');

						$groupsdata['clientcontributions'][$r]['loans'][$k]['balance'] = $groupsdata['clientcontributions'][$r]['loans'][$k]['total_loan_amount'] - $loanPaid;

						$totalLoanBalance += $groupsdata['clientcontributions'][$r]['loans'][$k]['balance'];
					} else {
					}
				}
				$r++;
			}
		}
		$groupsdata["grandtotal"] = $grandtotal;
		$groupsdata['totallgfbalance'] = $totalLgfBalance;
		$groupsdata['totalloanbalance'] = $totalLoanBalance;

		// echo json_encode($groupsdata['clientcontributions'][0]['client']['client_number']);
		$groupsdata['clientroles'] = GroupClientRoles::where([['client_group', '=', $id]])->get();
		$groupsdata['grouproles'] = GroupRoles::all();

		if ($groupsdata['usersaccountsroles'][0]['_edit'] == 0) {
			return view('admin.error.denied', compact('groupsdata'));
		} else {
			return view('admin.ptr_report.ptr', compact('groupsdata', 'id'));
		}
	}

	public function export($id)
	{
		$groupsdata['company'] = Companies::all();
		$groupsdata["date"] = Carbon::now()->toDateTimeString();
		$groupsdata['days'] = Days::all();
		$groupsdata['meetingfrequencies'] = MeetingFrequencies::all();
		$groupsdata['bankingmodes'] = BankingModes::all();
		$position = Positions::where([['code', '=', 'BDO']])->get();
		$groupsdata['employees'] = Employees::where([['position', '=', $position[0]['id']]])->get();
		$groupsdata['data'] = Groups::find($id);
		$user = Users::where([['id', '=', Auth::id()]])->get();
		$module = Modules::where([['name', '=', 'Groups']])->get();
		$groupsdata['usersaccountsroles'] = UsersAccountsRoles::where([['user_account', '=', $user[0]['user_account']], ['module', '=', $module[0]['id']]])->get();
		$groupclients = GroupClients::where([['client_group', '=', $id]])->get();
		$groupsdata['clients'] = array();
		$groupsdata['clientcontributions'] = array();
		$groupsdata['paymentmodes'] = PaymentModes::all();
		$groupsdata['otherpaymenttypes'] = OtherPaymentTypes::all();
		$r = 0;
		$totalLgfBalance = 0;
		$totalLoanBalance = 0;
		$grandtotal = 0;
		$clientCategory = ClientCategories::where([['code', '=', '002']])->get();
		$approvedloans = LoanStatuses::where([['code', '=', '002']])->get();
		foreach ($groupclients as $groupclient) {
			$client = Clients::find($groupclient->client);
			if ($client->client_category == $clientCategory[0]['id']) {
				$groupsdata['clients'][] = $client;
				$groupsdata['clientcontributions'][$r]['client'] = $client;
				$groupsdata['clientcontributions'][$r]['lgf'] = array();
				$lastcontribution = ClientLgfContributions::where([['client', '=', $groupclient->client]])->get()->last();

				$tlc = ClientLgfBalances::where([['client', '=', $groupclient->client]])->get()->first();

				$groupsdata['clientcontributions'][$r]['lgf']['totallgfcontribution'] = isset($tlc) ? $tlc->balance : 0;

				if (isset($lastcontribution)) {
					$grandtotal += $lastcontribution->amount;
					$groupsdata['clientcontributions'][$r]['lgf']['lastcontribution'] = $lastcontribution->amount;
					$groupsdata['clientcontributions'][$r]['lgf']['lastcontributiondate'] = $lastcontribution->created_at;
				}

				$clientLoans = Loans::where([['client', '=', $groupclient->client], ['status', '=', $approvedloans[0]->id]])->get();

				$l = 0;

				$groupsdata['clientcontributions'][$r]['loans'] = array();

				for ($cl = 0; $cl < count($clientLoans); $cl++) {

					$disbursementStatus = DisbursementStatuses::where([['code', '=', '002']])->get();

					$loanDisbursed = LoanDisbursements::where([['disbursement_status', '=', $disbursementStatus[0]->id], ['loan', '=', $clientLoans[$cl]->id]])->get();

					if (count($loanDisbursed) > 0) {

						$loanPaid = DB::table('loan_payments')->where('loan', $clientLoans[$cl]->id)->sum('amount');

						$totalloanamount = ($clientLoans[$cl]->total_loan_amount);

						$bal = ($clientLoans[$cl]->total_loan_amount) - $loanPaid;

						if ($bal <= 0)
							continue;

						$date=str_replace('-','/',substr($clientLoans[$cl]->date, 0,10));

						$date=explode("/", $date);

						$date1=$date[0];
						$date2=$date[1];
						$date3=$date[2];


						if(strlen($date1)>2){
						$clientLoans[$cl]->date=$date3.'/'.$date2.'/'.$date1;
						}else{
							$clientLoans[$cl]->date=$date1.'/'.$date2.'/'.$date3;
						}


						$clientLoans[$cl]->parsed_date = Carbon::createFromFormat('d/m/Y', $clientLoans[$cl]->date);

						$groupsdata['clientcontributions'][$r]['loans'][$l] = $clientLoans[$cl];

						$graceperiod = GracePeriods::where([['id', '=', $clientLoans[$cl]->grace_period]])->get();

						$paymentfrequency = LoanPaymentFrequencies::where([['id', '=', $clientLoans[$cl]->loan_payment_frequency]])->get();

						$paymentduration = LoanPaymentDurations::where([['id', '=', $clientLoans[$cl]->loan_payment_duration]])->get();

						$installments = ($paymentduration[0]->number_of_days - $graceperiod[0]->number_of_days) / $paymentfrequency[0]->number_of_days;

						$installmentAmount = $totalloanamount / $installments;

						$loanDate =Carbon::createFromFormat('d/m/Y', $clientLoans[$cl]->date);

						$gp = $loanDate->addDays($graceperiod[0]->number_of_days);

						$cd = $gp->gt(Carbon::now()) ? 0 : ($gp->diffInDays(Carbon::now()));

						$wd = $gp->diffInWeeks(Carbon::now());

						$currentinstallments = $cd > 0 ? round($cd / $paymentfrequency[0]->number_of_days) : 0;

						$currentexpectedamount = $currentinstallments * $installmentAmount;

						if ($cd >= $paymentduration[0]->number_of_days) {

							$noofinstallmentsmissed = $installmentAmount > 0 ? round(($currentexpectedamount - $loanPaid) / $installmentAmount) : 0;

							$groupsdata['clientcontributions'][$r]['loans'][$l]['arrears_period'] = (0 - $noofinstallmentsmissed) . "-" . substr($paymentfrequency[0]->name, 0, 1);

							$groupsdata['clientcontributions'][$r]['loans'][$l]['arrears'] = round(0 - $bal);

							$groupsdata['clientcontributions'][$r]['loans'][$l]['exppay'] = round($installmentAmount) . "-" . substr($paymentfrequency[0]->name, 0, 1);

							$groupsdata['clientcontributions'][$r]['loans'][$l]['nextpay'] = Carbon::now()->toDateString();
						} else {

							$cinstallments = $cd < $paymentfrequency[0]->number_of_days ? 0 : ($paymentfrequency[0]->number_of_days * round(($cd) / $paymentfrequency[0]->number_of_days));

							$nextpay = $gp->addDays(round($currentinstallments*$paymentfrequency[0]->number_of_days));

							$exppay = $installmentAmount;

							$prepayment = 0;
							$prepaymentperiod = 0;
							$prepaymentdays = 0;

							if ($loanPaid > $currentexpectedamount) {
								$prepayment = $loanPaid - $currentexpectedamount;
								$prepaymentinstallments = $installmentAmount > 0 ? round($prepayment / $installmentAmount) : 0;

								$prepaymentdays = $prepaymentinstallments * $paymentfrequency[0]->number_of_days;
								$nextpay = $gp->addDays($prepaymentdays);
							}

							$noofinstallmentsmissed = $installmentAmount > 0 ? round(($currentexpectedamount - $loanPaid) / $installmentAmount) : 0;

							$groupsdata['clientcontributions'][$r]['loans'][$l]['arrears_period'] = "";

							$groupsdata['clientcontributions'][$r]['loans'][$l]['arrears'] = "";

							$groupsdata['clientcontributions'][$r]['loans'][$l]['exppay'] = round($exppay) . "-" . substr($paymentfrequency[0]->name, 0, 1);

							$groupsdata['clientcontributions'][$r]['loans'][$l]['nextpay'] = Carbon::parse($nextpay)->toDateString();
						}

						$lastpayment = LoanPayments::where([['loan', "=", $clientLoans[$cl]->id]])->get()->last();

						$groupsdata['clientcontributions'][$r]['loans'][$l]['rembalance'] = round($clientLoans[$cl]->total_loan_amount - $loanPaid);

						if (isset($lastpayment)) {

							$grandtotal += $lastpayment->amount;

							$groupsdata['clientcontributions'][$r]['loans'][$l]['lastpaydate'] = $lastpayment->date;

							$groupsdata['clientcontributions'][$r]['loans'][$l]['lastpayamount'] = $lastpayment->amount;
						}


						$l++;
					}
				}

				for ($k = 0; $k < count($groupsdata['clientcontributions'][$r]['loans']); $k++) {

					if (count($groupsdata['clientcontributions'][$r]['loans']) > 0) {

						$loanPaid = DB::table('loan_payments')->where('loan', $groupsdata['clientcontributions'][$r]['loans'][$k]->id)->sum('amount');

						$groupsdata['clientcontributions'][$r]['loans'][$k]['balance'] = $groupsdata['clientcontributions'][$r]['loans'][$k]['total_loan_amount'] - $loanPaid;

						$totalLoanBalance += $groupsdata['clientcontributions'][$r]['loans'][$k]['balance'];
					} else {
					}
				}
				$r++;
			}
		}
		$groupsdata["grandtotal"] = $grandtotal;
		$groupsdata['totallgfbalance'] = $totalLgfBalance;
		$groupsdata['totalloanbalance'] = $totalLoanBalance;

		// echo json_encode($groupsdata['clientcontributions'][0]['client']['client_number']);
		$groupsdata['clientroles'] = GroupClientRoles::where([['client_group', '=', $id]])->get();
		$groupsdata['grouproles'] = GroupRoles::all();
		
		$excle_data = [];
		foreach($groupsdata['clientcontributions'] as $clientcontribution) {
			$loans = [];
			foreach($clientcontribution['loans'] as $loan) {
                $loans[] = [
					'loan_number' => $loan->loan_number,
					'loan_amount' => $loan->amount,
					'expected_payment_period' => $loan->exppay,
					'last_payment_date' => Carbon::parse($loan->lastpaydate)->toDateString(),
					'arrears_period' => $loan->arrears_period,
					'next_payment_date' => $loan->nextpay,
					'rembalance' => $loan->rembalance,
					'loan_date' => Carbon::parse($loan->date)->toDateString(),
					'last_payment_amount' => $loan->lastpayamount
				];
			}

			$excle_data[] = [
				'client_id' => $clientcontribution['client']['id'],
				'client_number' => $clientcontribution['client']['client_number'],
				'name' => $clientcontribution['client']['first_name'].' '.$clientcontribution['client']['middle_name'].' '.$clientcontribution['client']['last_name'],
				'loans' => isset($loans) && !empty($loans) ? $loans : [
					'loan_number' => NULL,
					'loan_amount' => NULL,
					'expected_payment_period' => NULL,
					'last_payment_date' => NULL,
					'arrears_period' => NULL,
					'next_payment_date' => NULL,
					'rembalance' => NULL,
					'loan_date' => NULL,
					'last_payment_amount' => NULL
				],
				'last_contribution_date' => isset($clientcontribution['lgf']['lastcontributiondate']) ? Carbon::parse($clientcontribution['lgf']['lastcontributiondate'])->toDateString() : null,
				'total_lgf_contribution' => isset($clientcontribution['lgf']['lastcontributiondate']) ? $clientcontribution['lgf']['totallgfcontribution'] : null
			];
		}

		return \Excel::create($groupsdata['data']->group_number . '-PTR-' . Carbon::now()->format('YmdHis'), function($excel) use ($groupsdata) {
			return $excel->sheet('PTR', function($sheet) use ($groupsdata) {
				return $sheet->loadView('admin.ptr_report.ptr_print', [
					'groupsdata' => $groupsdata
				]);
			});
		})->download('xls');
	}

	public function show($id)
	{
		$groupsdata['days'] = Days::all();
		$groupsdata['meetingfrequencies'] = MeetingFrequencies::all();
		$groupsdata['bankingmodes'] = BankingModes::all();
		$position = Positions::where([['code', '=', 'BDO']])->get();
		$groupsdata['employees'] = Employees::where([['position', '=', $position[0]['id']]])->get();
		$groupsdata['data'] = Groups::find($id);
		$user = Users::where([['id', '=', Auth::id()]])->get();
		$module = Modules::where([['name', '=', 'Groups']])->get();
		$groupsdata['usersaccountsroles'] = UsersAccountsRoles::where([['user_account', '=', $user[0]['user_account']], ['module', '=', $module[0]['id']]])->get();
		if ($groupsdata['usersaccountsroles'][0]['_show'] == 0) {
			return view('admin.error.denied', compact('groupsdata'));
		} else {
			return view('admin.groups.show', compact('groupsdata', 'id'));
		}
	}

	public function update(Request $request, $id)
	{

		DB::transaction(function () use ($request, $id) {
			$clientrequests = $request->get('client');
			$clientlgfcontributionrequests = $request->get('client_lgf_contribution');

			$loanpaymentrequests = $request->get('loan_payment');
			$otherpaymenttyperequests = $request->get('other_payment');
			$otherpaymentrequests = $request->get('other_payment');
			$loanrequests = $request->get('loan');
			$paymentmode = $request->get('payment_mode');
			$transactionnumber = $request->get('transaction_number');
			$date = \Carbon\Carbon::parse($request->transaction_date)->toDateString();


			$debit = EntryTypes::where([['code', '=', '001']])->get();
			$credit = EntryTypes::where([['code', '=', '002']])->get();
			$transactionstatuses = TransactionStatuses::where([['code', '=', '002']])->get();
			$approvedloans = LoanStatuses::where([['code', '=', '002']])->get();
			if (!empty($date) && !empty($transactionnumber) && !empty($paymentmode)) {

				for ($c = 0; $c < count($clientrequests); $c++) {
					//contribution
					$client = Clients::find($clientrequests[$c]);
					if (isset($clientlgfcontributionrequests[$c]) && $clientlgfcontributionrequests[$c] > 0) {
						$clientlgfcontributions = new ClientLgfContributions();
						$clientlgfcontributions->client = $clientrequests[$c];
						$clientlgfcontributions->payment_mode = $paymentmode;
						$clientlgfcontributions->transaction_number = $transactionnumber;
						$clientlgfcontributions->date = $date;
						$clientlgfcontributions->amount = $clientlgfcontributionrequests[$c];
						$clientlgfcontributions->transaction_status = $transactionstatuses[0]['id'];


						$clientlgfbalance = ClientLgfBalances::where([['client', '=', $clientlgfcontributions->client]])->get();


						$lgfContributionConfiguration = LgfContributionConfigurations::where([['client_type', '=', $client->client_type], ['payment_mode', '=', $clientlgfcontributions->payment_mode]])->get();

						if (isset($lgfContributionConfiguration[0])) {
							$clientlgfcontributions->save();
							if ($clientlgfbalance != null && $clientlgfbalance->count() > 0) {

								$clientlgfbalance = ClientLgfBalances::find($clientlgfbalance[0]['id']);
								$clientlgfbalance->balance = $clientlgfbalance->balance + $clientlgfcontributions->amount;
								$clientlgfbalance->save();
							} else {
								$clientlgfbalance = new ClientLgfBalances();
								$clientlgfbalance->client = $clientlgfcontributions->client;
								$clientlgfbalance->balance = $clientlgfcontributions->amount;
								$clientlgfbalance->save();
							}
							$generalLedger = new GeneralLedgers();
							$generalLedger->account = $lgfContributionConfiguration[0]['debit_account'];
							$generalLedger->entry_type = $debit[0]['id'];
							$generalLedger->transaction_number = $clientlgfcontributions->transaction_number;
							$generalLedger->amount = $clientlgfcontributions->amount;
							$generalLedger->date = $clientlgfcontributions->date;
							$generalLedger->save();


							$generalLedger = new GeneralLedgers();
							$generalLedger->account = $lgfContributionConfiguration[0]['credit_account'];
							$generalLedger->entry_type = $credit[0]['id'];
							$generalLedger->transaction_number = $clientlgfcontributions->transaction_number;
							$generalLedger->amount = $clientlgfcontributions->amount;
							$generalLedger->date = $clientlgfcontributions->date;
							$generalLedger->save();
						}
					}

					//loan payment
					// die(json_encode($loanrequests));

					if (isset($loanrequests[$c]) && isset($loanpaymentrequests[$c]) && $loanpaymentrequests[$c] > 0) {

						$loanpayments = new LoanPayments();
						$loanpayments->loan = $loanrequests[$c];
						$loanpayments->mode_of_payment = $paymentmode;
						$loanpayments->amount = $loanpaymentrequests[$c];
						$loanpayments->date = $date;
						$loanpayments->transaction_number = $transactionnumber;
						$transactionstatuses = TransactionStatuses::where([['code', '=', '002']])->get();
						$loanpayments->transaction_status = $transactionstatuses[0]['id'];
						$loanpayments->save();

						$loan = Loans::find($loanpayments->loan);
						// $product=LoanProducts::find($loan->loan_product);
						$productprincipalconfigurations = ProductPrincipalConfigurations::where([['loan_product', '=', $loan->loan_product], ['payment_mode', '=', $loanpayments->mode_of_payment], ['interest_payment_method', '=', $loan->interest_payment_method]])->get();
						$productinterestconfigurations = ProductInterestConfigurations::where([['loan_product', '=', $loan->loan_product], ['payment_mode', '=', $loanpayments->mode_of_payment], ['interest_payment_method', '=', $loan->interest_payment_method]])->get();

						$interest = (($loanpayments->amount / (1 + $loan->interest_rate / 100)) * ($loan->interest_rate / 100));
						$principal = $loanpayments->amount - $interest;
						$generalLedger = new GeneralLedgers();
						$generalLedger->account = $productinterestconfigurations[0]['debit_account'];
						$generalLedger->entry_type = $debit[0]['id'];
						$generalLedger->transaction_number = $loan->loan_number;
						$generalLedger->amount = $interest;
						$generalLedger->date = $loanpayments->date;
						$generalLedger->save();


						$generalLedger = new GeneralLedgers();
						$generalLedger->account = $productinterestconfigurations[0]['credit_account'];
						$generalLedger->entry_type = $credit[0]['id'];
						$generalLedger->transaction_number = $loan->loan_number;
						$generalLedger->amount = $interest;
						$generalLedger->date = $loanpayments->date;
						$generalLedger->save();

						$generalLedger = new GeneralLedgers();
						$generalLedger->account = $productprincipalconfigurations[0]['debit_account'];
						$generalLedger->entry_type = $debit[0]['id'];
						$generalLedger->transaction_number = $loan->loan_number;
						$generalLedger->amount = $principal;
						$generalLedger->date = $loanpayments->date;
						$generalLedger->save();


						$generalLedger = new GeneralLedgers();
						$generalLedger->account = $productprincipalconfigurations[0]['credit_account'];
						$generalLedger->entry_type = $credit[0]['id'];
						$generalLedger->transaction_number = $loan->loan_number;
						$generalLedger->amount = $principal;
						$generalLedger->date = $loanpayments->date;
						$generalLedger->save();
					}
				}
			}
		});

		$groupsdata['days'] = Days::all();
		$groupsdata['meetingfrequencies'] = MeetingFrequencies::all();
		$groupsdata['bankingmodes'] = BankingModes::all();
		$position = Positions::where([['code', '=', 'BDO']])->get();
		$groupsdata['employees'] = Employees::where([['position', '=', $position[0]['id']]])->get();
		$groupsdata['data'] = Groups::find($id);
		$user = Users::where([['id', '=', Auth::id()]])->get();
		$module = Modules::where([['name', '=', 'Groups']])->get();
		$groupsdata['usersaccountsroles'] = UsersAccountsRoles::where([['user_account', '=', $user[0]['user_account']], ['module', '=', $module[0]['id']]])->get();
		$groupclients = GroupClients::where([['client_group', '=', $id]])->get();
		$groupsdata['clients'] = array();
		$groupsdata['clientcontributions'] = array();
		$groupsdata['paymentmodes'] = PaymentModes::all();
		$groupsdata['otherpaymenttypes'] = OtherPaymentTypes::all();
		$r = 0;
		$totalLgfBalance = 0;
		$totalLoanBalance = 0;
		foreach ($groupclients as $groupclient) {
			$groupsdata['clients'][] = Clients::find($groupclient->client);
			$groupsdata['clientcontributions'][$r]['client'] = Clients::find($groupclient->client);
			$groupsdata['clientcontributions'][$r]['lgf'] = ClientLgfBalances::where([['client', '=', $groupclient->client]])->get();
			if (count($groupsdata['clientcontributions'][$r]['lgf']) > 0) {
				$totalLgfBalance += $groupsdata['clientcontributions'][$r]['lgf'][0]->balance;
			}

			$clientLoans = Loans::where([['client', '=', $groupclient->client], ['status', '=', $approvedloans[0]->id]])->get();

			$l = 0;

			$groupsdata['clientcontributions'][$r]['loans'] = array();

			for ($cl = 0; $cl < count($clientLoans); $cl++) {

				$disbursementStatus = DisbursementStatuses::where([['code', '=', '002']])->get();

				$loanDisbursed = LoanDisbursements::where([['disbursement_status', '=', $disbursementStatus[0]->id], ['loan', '=', $clientLoans[$cl]->id]])->get();

				if (count($loanDisbursed) > 0) {

					$groupsdata['clientcontributions'][$r]['loans'][$l] = $clientLoans[$cl];

					$l++;
				}
			}


			for ($k = 0; $k < count($groupsdata['clientcontributions'][$r]['loans']); $k++) {

				if (count($groupsdata['clientcontributions'][$r]['loans']) > 0) {

					$loanPaid = DB::table('loan_payments')->where('loan', $groupsdata['clientcontributions'][$r]['loans'][$k]->id)->sum('amount');
					$groupsdata['clientcontributions'][$r]['loans'][$k]['balance'] = $groupsdata['clientcontributions'][$r]['loans'][$k]['total_loan_amount'] - $loanPaid;
					$totalLoanBalance += $groupsdata['clientcontributions'][$r]['loans'][$k]['balance'];
				}
			}
			$r++;
		}
		$groupsdata['totallgfbalance'] = $totalLgfBalance;
		$groupsdata['totalloanbalance'] = $totalLoanBalance;
		// echo json_encode($groupsdata['clientcontributions'][0]['client']['client_number']);
		$groupsdata['clientroles'] = GroupClientRoles::where([['client_group', '=', $id]])->get();
		$groupsdata['grouproles'] = GroupRoles::all();

		return view('admin.ptr_report.ptr', compact('groupsdata', 'id'));
	}

	public function destroy($id)
	{
		$groups = Groups::find($id);
		$user = Users::where([['id', '=', Auth::id()]])->get();
		$module = Modules::where([['name', '=', 'Groups']])->get();
		$groupsdata['usersaccountsroles'] = UsersAccountsRoles::where([['user_account', '=', $user[0]['user_account']], ['module', '=', $module[0]['id']]])->get();
		if ($groupsdata['usersaccountsroles'][0]['_delete'] == 1) {
			$groups->delete();
		}
		return redirect('admin/groups')->with('success', 'groups has been deleted!');
	}
}
