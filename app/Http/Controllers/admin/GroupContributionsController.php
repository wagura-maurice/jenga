<?php

namespace App\Http\Controllers\admin;

use App\Days;
use App\Loans;
use App\Users;
use Exception;
use App\Groups;
use App\Clients;
use App\Modules;
use App\Companies;
use App\Employees;
use App\Positions;
use App\EntryTypes;
use App\GroupRoles;
use App\BankingModes;
use App\GroupClients;
use App\LoanPayments;
use App\LoanProducts;
use App\LoanStatuses;
use App\PaymentModes;
use App\Http\Requests;
use App\OtherPayments;
use App\GeneralLedgers;
use App\GroupCashBooks;
use App\ClientCategories;
use App\GroupClientRoles;
use App\ClientLgfBalances;
use App\LoanDisbursements;
use App\OtherPaymentTypes;
use App\MeetingFrequencies;
use App\UsersAccountsRoles;
use App\ClearingFeePayments;
use App\TransactionStatuses;
use Illuminate\Http\Request;
use App\DisbursementStatuses;
use App\ProcessingFeePayments;
use App\ClientLgfContributions;
use Illuminate\Support\Facades\DB;
use App\InsuranceDeductionPayments;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\LgfContributionConfigurations;
use App\ProductInterestConfigurations;
use App\ProductPrincipalConfigurations;
use App\OtherPaymentTypeAccountMappings;

class GroupContributionsController extends Controller
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

		$groupsdata['list']= auth()->user()->user_account != '8' ? Groups::where('officer', auth()->user()->employeemodel->id)->get() : Groups::all();

		$user = Users::where([['id', '=', Auth::id()]])->get();
		$module = Modules::where([['name', '=', 'Groups']])->get();
		$groupsdata['usersaccountsroles'] = UsersAccountsRoles::where([['user_account', '=', $user[0]['user_account']], ['module', '=', $module[0]['id']]])->get();
		if ($groupsdata['usersaccountsroles'][0]['_add'] == 0 && $groupsdata['usersaccountsroles'][0]['_list'] == 0 && $groupsdata['usersaccountsroles'][0]['_edit'] == 0 && $groupsdata['usersaccountsroles'][0]['_edit'] == 0 && $groupsdata['usersaccountsroles'][0]['_show'] == 0 && $groupsdata['usersaccountsroles'][0]['_delete'] == 0 && $groupsdata['usersaccountsroles'][0]['_report'] == 0) {
			return view('admin.error.denied', compact('groupsdata'));
		} else {
			return view('admin.group_contributions.index', compact('groupsdata'));
		}
	}

	public function create()
	{
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

	function receipt($id){

		$groupcashbooksdata['company'] = Companies::all();
		$receipt=GroupCashBooks::find($id);
		$groupclients=GroupClients::where([["client_group","=","".$receipt->transacting_group]])->get();
		$groupcashbooksdata["date"]=$receipt->transaction_date;
		$groupcashbooksdata["group"]=$receipt->groupmodel->group_number." ".$receipt->groupmodel->group_name;
		$groupcashbooksdata["bdo"]=$receipt->collecting_officer;
		$groupcashbooksdata["transactionid"]=$receipt->transaction_id;
		$groupcashbooksdata["modeofpayment"]=$receipt->paymentmodemodel->name;

		$totalloan=0;
		$totallgf=0;
		$totalothers=0;

		$totalamount=0;

		$clients=array();

		$loanpayments=LoanPayments::where([["transaction_number","like","%".$receipt->transaction_reference."%"]])->get();

		foreach ($groupclients as $groupclient) {

			$client=Clients::find($groupclient->client);

			$lgf=ClientLgfContributions::where([["client","=",$client->id],["transaction_number","like","%".$receipt->transaction_reference."%"]])->get()->first();

			$client->lgf=isset($lgf)?$lgf->amount:0;

			$totalamount=$totalamount+$client->lgf;

			$totallgf=$totallgf+$client->lgf;

			$clientloans=Loans::where([["client","=",$client->id]])->get();

			$otherpayments=OtherPayments::where([["client","=",$client->id]])->get();

			$otherpaymentamount=0;

			foreach ($otherpayments as $otherpayment) {
				$otherpaymentamount=$otherpaymentamount+$otherpayment->amount;
				$totalamount=$totalamount+$otherpaymentamount;
				$totalothers=$totalothers+$otherpaymentamount;
			}

			$client->others=$otherpaymentamount;

			$loanamount=0;

			foreach ($loanpayments as $loanpayment) {
				foreach($clientloans as $clientloan){
					if($loanpayment->loan==$clientloan->id){
						$loanamount=$loanamount+$loanpayment->amount;
					}
				}				
			}

			$client->loan=$loanamount;

			$totalamount=$totalamount+$loanamount;

			$totalloan=$totalloan+$loanamount;

			if(($client->loan+$client->lgf+$client->others)>0){
				array_push($clients, $client);
			}

		}

		$groupcashbooksdata['clients']=$clients;

		$groupcashbooksdata["amount"]=$totalamount;

		$groupcashbooksdata["totallgf"]=$totallgf;
		$groupcashbooksdata["totalothers"]=$totalothers;
		$groupcashbooksdata["totalloan"]=$totalloan;

		return View("admin.group_contributions.receipt",compact('groupcashbooksdata'));
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
		$clientCategory = ClientCategories::where([['code', '=', '002']])->get();
		$approvedloans = LoanStatuses::where([['code', '=', '002']])->get();
		$disbursementstatuses = DisbursementStatuses::where([['code', '=', '002']])->get();
		foreach ($groupclients as $groupclient) {

			$client = Clients::find($groupclient->client);

			if ($client->client_category == $clientCategory[0]['id']) {

				$groupsdata['clients'][] = $client;

				$groupsdata['clientcontributions'][$r]['client'] = Clients::find($groupclient->client);
				$groupsdata['clientcontributions'][$r]['lgf'] = ClientLgfBalances::where([['client', '=', $groupclient->client]])->get();
				if (count($groupsdata['clientcontributions'][$r]['lgf']) > 0) {
					$totalLgfBalance += $groupsdata['clientcontributions'][$r]['lgf'][0]->balance;
				}

				$myloans = Loans::where([
					'client'              => $groupclient->client,
					'status'            => $approvedloans[0]->id,
				])->get();

				$groupsdata['clientcontributions'][$r]['loans'] = array();

				$l = 0;

				for ($k = 0; $k < count($myloans); $k++) {

					$disbursementStatus = DisbursementStatuses::where([['code', '=', '002']])->get();

					$loanDisbursed = LoanDisbursements::where([['disbursement_status', '=', $disbursementStatus[0]->id], ['loan', '=', $myloans[$k]->id]])->get();

					if (!isset($loanDisbursed[0]) > 0) {
						continue;
					}


					$loanPaid = DB::table('loan_payments')->where('loan', $myloans[$k]->id)->sum('amount');

					$balance = $myloans[$k]['total_loan_amount'] - $loanPaid;

					if ($balance > 0) {

						$groupsdata['clientcontributions'][$r]['loans'][$l] = $myloans[$k];

						$groupsdata['clientcontributions'][$r]['loans'][$l]['balance'] = $balance;

						$totalLoanBalance += $balance;

						$l++;
					}
				}

				$r++;
			}
		}

		$groupsdata['totallgfbalance'] = $totalLgfBalance;
		$groupsdata['totalloanbalance'] = $totalLoanBalance;
		// echo json_encode($groupsdata['clientcontributions'][0]['client']['client_number']);
		$groupsdata['clientroles'] = GroupClientRoles::where([['client_group', '=', $id]])->get();
		$groupsdata['grouproles'] = GroupRoles::all();

		if ($groupsdata['usersaccountsroles'][0]['_edit'] == 0) {
			return view('admin.error.denied', compact('groupsdata'));
		} else {
			return view('admin.group_contributions.contribution', compact('groupsdata', 'id'));
		}
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
		$request['date'] = \Carbon\Carbon::parse($request->transaction_date)->toDateString();

		return DB::transaction(function () use ($request, $id) {

			$clientrequests = $request->get('client');
			$clientlgfcontributionrequests = $request->get('client_lgf_contribution');

			$loanpaymentrequests = $request->get('loan_payment');
			$otherpaymenttyperequests = $request->get('other_payment_type');
			$otherpaymentrequests = $request->get('other_payment');
			$loanrequests = $request->get('loan');
			$paymentmode = $request->get('payment_mode');
			$transactionnumber = $request->get('transaction_number');
			$date = $request['date'];


			$debit = EntryTypes::where([['code', '=', '001']])->get();
			$credit = EntryTypes::where([['code', '=', '002']])->get();
			$transactionstatuses = TransactionStatuses::where([['code', '=', '002']])->get();

			$user = Users::where([['id', '=', Auth::id()]])->get()->first();
			$group = Groups::find($id);

			//principal debit
			$groupcashbook=new GroupCashBooks();

			$groupcashbook->transaction_id= $request->get('transaction_number');
			$groupcashbook->transacting_group=$id;
			$groupcashbook->transaction_reference= $request->get('transaction_number');
			$groupcashbook->transaction_date=$request['date'];
			$groupcashbook->transaction_type=2;
			$groupcashbook->amount=0;
			$groupcashbook->payment_mode=$request->get('payment_mode');
			$groupcashbook->lgf=0;
			$groupcashbook->loan_principal=0;
			$groupcashbook->loan_interest=0;
			$groupcashbook->mpesa_charges=0;
			$groupcashbook->fine=0;
			$groupcashbook->processing_fees=0;
			$groupcashbook->insurance_deduction_fees=0;
			$groupcashbook->collecting_officer=$user->name;
			$groupcashbook->clearing_fees=0;
			$groupcashbook->officer_id = $group->officermodel->id;
			$groupcashbook->branch_id = $group->branchmodel->id;

			//principal credit
			$groupcashbook1=new GroupCashBooks();

			$groupcashbook1->transaction_id= $request->get('transaction_number');
			$groupcashbook1->transacting_group=$id;
			$groupcashbook1->transaction_reference= $request->get('transaction_number');
			$groupcashbook1->transaction_date=$request['date'];
			$groupcashbook1->transaction_type=1;
			$groupcashbook1->amount=0;
			$groupcashbook1->payment_mode=$request->get('payment_mode');
			$groupcashbook1->lgf=0;
			$groupcashbook1->loan_principal=0;
			$groupcashbook1->loan_interest=0;
			$groupcashbook1->mpesa_charges=0;
			$groupcashbook1->fine=0;
			$groupcashbook1->processing_fees=0;
			$groupcashbook1->insurance_deduction_fees=0;
			$groupcashbook1->collecting_officer=$user->name;
			$groupcashbook1->clearing_fees=0;
			$groupcashbook1->officer_id = $group->officermodel->id;
			$groupcashbook1->branch_id = $group->branchmodel->id;		

			//interest debit
			$groupcashbook2=new GroupCashBooks();

			$groupcashbook2->transaction_id= $request->get('transaction_number');
			$groupcashbook2->transacting_group=$id;
			$groupcashbook2->transaction_reference= $request->get('transaction_number');
			$groupcashbook2->transaction_date=$request['date'];
			$groupcashbook2->transaction_type=2;
			$groupcashbook2->amount=0;
			$groupcashbook2->payment_mode=$request->get('payment_mode');
			$groupcashbook2->lgf=0;
			$groupcashbook2->loan_principal=0;
			$groupcashbook2->loan_interest=0;
			$groupcashbook2->mpesa_charges=0;
			$groupcashbook2->fine=0;
			$groupcashbook2->processing_fees=0;
			$groupcashbook2->insurance_deduction_fees=0;
			$groupcashbook2->collecting_officer=$user->name;
			$groupcashbook2->clearing_fees=0;
			$groupcashbook2->officer_id = $group->officermodel->id;
			$groupcashbook2->branch_id = $group->branchmodel->id;

			//interest credti
			$groupcashbook21=new GroupCashBooks();

			$groupcashbook21->transaction_id= $request->get('transaction_number');
			$groupcashbook21->transacting_group=$id;
			$groupcashbook21->transaction_reference= $request->get('transaction_number');
			$groupcashbook21->transaction_date=$request['date'];
			$groupcashbook21->transaction_type=1;
			$groupcashbook21->amount=0;
			$groupcashbook21->payment_mode=$request->get('payment_mode');
			$groupcashbook21->lgf=0;
			$groupcashbook21->loan_principal=0;
			$groupcashbook21->loan_interest=0;
			$groupcashbook21->mpesa_charges=0;
			$groupcashbook21->fine=0;
			$groupcashbook21->processing_fees=0;
			$groupcashbook21->insurance_deduction_fees=0;
			$groupcashbook21->collecting_officer=$user->name;
			$groupcashbook21->clearing_fees=0;
			$groupcashbook21->officer_id = $group->officermodel->id;
			$groupcashbook21->branch_id = $group->branchmodel->id;

			//other payment debit
			$groupcashbook3=new GroupCashBooks();

			$groupcashbook3->transaction_id= $request->get('transaction_number');
			$groupcashbook3->transacting_group=$id;
			$groupcashbook3->transaction_reference= $request->get('transaction_number');
			$groupcashbook3->transaction_date=$request['date'];
			$groupcashbook3->transaction_type=2;
			$groupcashbook3->amount=0;
			$groupcashbook3->payment_mode=$request->get('payment_mode');
			$groupcashbook3->lgf=0;
			$groupcashbook3->loan_principal=0;
			$groupcashbook3->loan_interest=0;
			$groupcashbook3->mpesa_charges=0;
			$groupcashbook3->fine=0;
			$groupcashbook3->processing_fees=0;
			$groupcashbook3->insurance_deduction_fees=0;
			$groupcashbook3->collecting_officer=$user->name;
			$groupcashbook3->clearing_fees=0;
			$groupcashbook3->officer_id = $group->officermodel->id;
			$groupcashbook3->branch_id = $group->branchmodel->id;

			//other payment credit
			$groupcashbook31=new GroupCashBooks();
			$groupcashbook31->transaction_id= $request->get('transaction_number');
			$groupcashbook31->transacting_group=$id;
			$groupcashbook31->transaction_reference= $request->get('transaction_number');
			$groupcashbook31->transaction_date=$request['date'];
			$groupcashbook31->transaction_type=1;
			$groupcashbook31->amount=0;
			$groupcashbook31->payment_mode=$request->get('payment_mode');
			$groupcashbook31->lgf=0;
			$groupcashbook31->loan_principal=0;
			$groupcashbook31->loan_interest=0;
			$groupcashbook31->mpesa_charges=0;
			$groupcashbook31->fine=0;
			$groupcashbook31->processing_fees=0;
			$groupcashbook31->insurance_deduction_fees=0;
			$groupcashbook31->collecting_officer=$user->name;
			$groupcashbook31->clearing_fees=0;
			$groupcashbook31->officer_id = $group->officermodel->id;
			$groupcashbook31->branch_id = $group->branchmodel->id;

			//lgf debit
			$groupcashbook4=new GroupCashBooks();

			$groupcashbook4->transaction_id= $request->get('transaction_number');
			$groupcashbook4->transacting_group=$id;
			$groupcashbook4->transaction_reference= $request->get('transaction_number');
			$groupcashbook4->transaction_date=$request['date'];
			$groupcashbook4->transaction_type=2;
			$groupcashbook4->amount=0;
			$groupcashbook4->payment_mode=$request->get('payment_mode');
			$groupcashbook4->lgf=0;
			$groupcashbook4->loan_principal=0;
			$groupcashbook4->loan_interest=0;
			$groupcashbook4->mpesa_charges=0;
			$groupcashbook4->fine=0;
			$groupcashbook4->processing_fees=0;
			$groupcashbook4->insurance_deduction_fees=0;
			$groupcashbook4->collecting_officer=$user->name;
			$groupcashbook4->clearing_fees=0;
			$groupcashbook4->officer_id = $group->officermodel->id;
			$groupcashbook4->branch_id = $group->branchmodel->id;

			//lgf credit
			$groupcashbook5=new GroupCashBooks();

			$groupcashbook5->transaction_id= $request->get('transaction_number');
			$groupcashbook5->transacting_group=$id;
			$groupcashbook5->transaction_reference= $request->get('transaction_number');
			$groupcashbook5->transaction_date=$request['date'];
			$groupcashbook5->transaction_type=1;
			$groupcashbook5->amount=0;
			$groupcashbook5->payment_mode=$request->get('payment_mode');
			$groupcashbook5->lgf=0;
			$groupcashbook5->loan_principal=0;
			$groupcashbook5->loan_interest=0;
			$groupcashbook5->mpesa_charges=0;
			$groupcashbook5->fine=0;
			$groupcashbook5->processing_fees=0;
			$groupcashbook5->insurance_deduction_fees=0;
			$groupcashbook5->collecting_officer=$user->name;
			$groupcashbook5->clearing_fees=0;
			$groupcashbook5->officer_id = $group->officermodel->id;
			$groupcashbook5->branch_id = $group->branchmodel->id;

			$transactionDate=$request['date'];

			if (!empty($date) && !empty($transactionnumber) && !empty($paymentmode)) {

				for ($c = 0; $c < count($clientrequests); $c++) {

					// $groupcashbook->amount=isset($loanpaymentrequests[$c])?$groupcashbook->amount+$loanpaymentrequests[$c]:$groupcashbook->amount+0;
					// $groupcashbook->amount=isset($otherpaymentrequests[$c])?$groupcashbook->amount+$otherpaymentrequests[$c]:$groupcashbook->amount+0;
					// $groupcashbook->amount=isset($clientlgfcontributionrequests[$c])?$groupcashbook->amount+$clientlgfcontributionrequests[$c]:$groupcashbook->amount+0;
					// $groupcashbook->lgf=isset($clientlgfcontributionrequests[$c])?$groupcashbook->lgf+$clientlgfcontributionrequests[$c]:$groupcashbook->lgf+0;

					$groupcashbook4->amount=isset($clientlgfcontributionrequests[$c])?$groupcashbook4->amount+$clientlgfcontributionrequests[$c]:$groupcashbook4->amount+0;
					$groupcashbook5->amount=isset($clientlgfcontributionrequests[$c])?$groupcashbook5->amount+$clientlgfcontributionrequests[$c]:$groupcashbook5->amount+0;

					// $groupcashbook2->amount=isset($otherpaymentrequests[$c])?$groupcashbook2->amount+$otherpaymentrequests[$c]:$groupcashbook2->amount+0;
					// $groupcashbook2->amount=isset($clientlgfcontributionrequests[$c])?$groupcashbook2->amount+$clientlgfcontributionrequests[$c]:$groupcashbook2->amount+0;
					// $groupcashbook2->lgf=isset($clientlgfcontributionrequests[$c])?$groupcashbook2->lgf+$clientlgfcontributionrequests[$c]:$groupcashbook2->lgf+0;


					//contribution
					$client = Clients::find($clientrequests[$c]);

					if (isset($clientlgfcontributionrequests[$c]) && $clientlgfcontributionrequests[$c] > 0) {

						$ExistingClientLgfContributions=ClientLgfContributions::where([["transaction_number","=",$transactionnumber],["client","=",$clientrequests[$c]]])->get();

						if(isset($ExistingClientLgfContributions) && count($ExistingClientLgfContributions)>0)
							throw new Exception("Transaction already exists");

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
							$generalLedger->client = $clientrequests[$c];
							$generalLedger->secondary_description = "Lgf contribution";
							$generalLedger->transaction_number = $clientlgfcontributions->transaction_number;
							$generalLedger->amount = $clientlgfcontributions->amount;
							$generalLedger->date = $clientlgfcontributions->date;
							$generalLedger->save();


							$generalLedger = new GeneralLedgers();
							$generalLedger->account = $lgfContributionConfiguration[0]['credit_account'];
							$generalLedger->entry_type = $credit[0]['id'];
							$generalLedger->client = $clientrequests[$c];
							$generalLedger->secondary_description = "Lgf contribution";
							$generalLedger->transaction_number = $clientlgfcontributions->transaction_number;
							$generalLedger->amount = $clientlgfcontributions->amount;
							$generalLedger->date = $clientlgfcontributions->date;
							$generalLedger->save();

							$groupcashbook4->account=$lgfContributionConfiguration[0]['debit_account'];
							$groupcashbook5->account=$lgfContributionConfiguration[0]['credit_account'];
						}
					}

					//loan payment
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
						$loanpayments->officer_id = $group->officermodel->id;
						$loanpayments->branch_id = $group->branchmodel->id;

						$loan = Loans::find($loanpayments->loan);
						// $product=LoanProducts::find($loan->loan_product);
						$productprincipalconfigurations = ProductPrincipalConfigurations::where([['loan_product', '=', $loan->loan_product], ['payment_mode', '=', $loanpayments->mode_of_payment]])->get();

						$productinterestconfigurations = ProductInterestConfigurations::where([['loan_product', '=', $loan->loan_product], ['payment_mode', '=', $loanpayments->mode_of_payment], ['interest_payment_method', '=', $loan->interest_payment_method]])->get();


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

							return redirect('admin/groupcontributions/' . $id . '/edit')->with("failed", "Loan configurations missing for !" . $loan->loan_number);
						}
					}

					if (isset($otherpaymenttyperequests[$c]) && $otherpaymentrequests[$c] > 0) {

						$otherpaymenttype = OtherPaymentTypes::find($otherpaymenttyperequests[$c]);

						$otherpaymenttypeaccountmappings = OtherPaymentTypeAccountMappings::where([["other_payment_type", "=", $otherpaymenttyperequests[$c]], ["payment_mode", "=", $request->get('payment_mode')]])->first();

						if (isset($otherpaymenttypeaccountmappings)) {

							$otherpayments = new OtherPayments();
							$otherpayments->other_payment_type = $otherpaymenttyperequests[$c];
							$otherpayments->transaction_number=$transactionnumber . rand(1000, 10000);
							$otherpayments->payment_mode = $request->get('payment_mode');
							$otherpayments->date = $request['date'];
							$otherpayments->amount = $otherpaymentrequests[$c];
							$otherpayments->client=$clientrequests[$c];
							$otherpayments->save();

							$generalLedger = new GeneralLedgers();
							$generalLedger->account = $otherpaymenttypeaccountmappings->debit_account;
							$generalLedger->entry_type = $debit[0]['id'];
							$generalLedger->transaction_number = $transactionnumber;
							$generalLedger->client = $clientrequests[$c];
							$generalLedger->secondary_description = $otherpaymenttype->name . " payments";
							$generalLedger->amount = $otherpaymentrequests[$c];
							$generalLedger->date = $request['date'];
							$generalLedger->save();


							$generalLedger = new GeneralLedgers();
							$generalLedger->account = $otherpaymenttypeaccountmappings->credit_account;
							$generalLedger->entry_type = $credit[0]['id'];
							$generalLedger->transaction_number = $transactionnumber;
							$generalLedger->client = $clientrequests[$c];
							$generalLedger->secondary_description = $otherpaymenttype->name . " payments";
							$generalLedger->amount = $otherpaymentrequests[$c];
							$generalLedger->date = $request['date'];
							$generalLedger->save();

							$groupcashbook3->amount= $groupcashbook3->amount+$otherpaymentrequests[$c];
							$groupcashbook3->account = $otherpaymenttypeaccountmappings->debit_account;

							$groupcashbook31->amount= $groupcashbook31->amount+$otherpaymentrequests[$c];
							$groupcashbook31->account = $otherpaymenttypeaccountmappings->credit_account;


							if (isset($request->get('other_payment')[$c])) {

								$loannumber = isset($request->get('other_payment_loan')[$c]) ? $request->get('other_payment_loan')[$c] : '';

								$approved = TransactionStatuses::where([["code", "=", "002"]])->get()->first();

								if ($otherpaymenttype->code == "003") { //processing fee

									$processingfeepayments = new ProcessingFeePayments();

									$processingfeepayments->payment_mode = $request->get('payment_mode');
									$processingfeepayments->transaction_number = $transactionnumber . rand(1000, 10000);
									$processingfeepayments->amount = $otherpaymentrequests[$c];
									$processingfeepayments->date = $request['date'];
									$processingfeepayments->transaction_status = $approved->id;
									$processingfeepayments->save();

									$groupcashbook->processing_fees=$groupcashbook->processing_fees+ $otherpaymentrequests[$c];
									
								} else if ($otherpaymenttype->code == "004") { //clearing fee

									$clearingfeepayments = new ClearingFeePayments();
									
									$clearingfeepayments->payment_mode = $request->get('payment_mode');
									$clearingfeepayments->transaction_reference = $transactionnumber . rand(1000, 10000);;
									$clearingfeepayments->amount = $otherpaymentrequests[$c];
									$clearingfeepayments->date = $request['date'];
									$clearingfeepayments->transaction_status = $approved->id;
									$clearingfeepayments->save();

									$groupcashbook->clearing_fees=$groupcashbook->clearing_fees+ $otherpaymentrequests[$c];

									// $groupcashbook2->clearing_fees=$groupcashbook2->clearing_fees+ $otherpaymentrequests[$c];

								} else if ($otherpaymenttype->code == "005") { //insurance deduction fee

									$insurancedeductionpayments = new InsuranceDeductionPayments();
									$insurancedeductionpayments->payment_mode = $request->get('payment_mode');
									$insurancedeductionpayments->transaction_reference = $transactionnumber . rand(1000, 10000);;
									$insurancedeductionpayments->amount = $otherpaymentrequests[$c];
									$insurancedeductionpayments->date = $request['date'];
									$insurancedeductionpayments->transaction_status = $approved->id;
									$insurancedeductionpayments->save();

									$groupcashbook->insurance_deduction_fees=$groupcashbook->insurance_deduction_fees+ $otherpaymentrequests[$c];

									// $groupcashbook2->insurance_deduction_fees=$groupcashbook2->insurance_deduction_fees+ $otherpaymentrequests[$c];

								}else if($otherpaymenttype->code=="002"){
									$groupcashbook->fine=$groupcashbook->fine+$otherpaymentrequests[$c];
									// $groupcashbook2->fine=$groupcashbook2->fine+$otherpaymentrequests[$c];

								}else if($otherpaymenttype->code=="001"){
									// $groupcashbook2->mpesa_charges=$groupcashbook2->mpesa_charges+$otherpaymentrequests[$c];
								}
							}

						} else {
							return redirect('admin/groupcontributions/' . $id . '/edit')->with("failed", "No mappings for other payments");
						}
					}
				}
			}

			$groupcashbook->save();
			$groupcashbook1->save();
			$groupcashbook2->save();
			$groupcashbook21->save();
			$groupcashbook3->save();
			$groupcashbook31->save();
			$groupcashbook4->save();
			$groupcashbook5->save();

			return redirect('admin/groupcontributions/receipt/' . $groupcashbook->id . '');
		});

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
