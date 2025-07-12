<?php

namespace App\Http\Controllers;

use App\Groups;
use App\Clients;
use App\Loans;
use App\LoanStatuses;
use App\LoanPayments;
use App\LoanDisbursements;
use App\LoanPaymentDurations;
use App\LoanPaymentFrequencies;
use App\ClientLgfContributions;
use App\PaymentModes;
use App\ClientLgfBalances;
use Illuminate\Http\Request;

class GeneralReportsController extends Controller
{
    public function ptr($id)
	{
		$approvedloans = LoanStatuses::where([['code','=','002']])->get();
		$ptr = Groups::where(['id' => $id])->with(['clients'])->first();
		foreach ($ptr->clients as $client) {

			$client->bio = Clients::find($client->client);

			$client->loans = Loans::where([
				'client' => $client->client,
				'status' => $approvedloans[0]->id
			])->with(['loan_payments'])->get();

			$client->last_lgf = ClientLgfContributions::where([
				'client' => $client->client
			])->orderBy('id', 'desc')->first();

			$client->lgf_balance = ClientLgfBalances::where([
				'client' => $client->client
			])->first();

			foreach ($client->loans as $key => $loan) {

				$loan->duration     = LoanPaymentDurations::find($loan->loan_payment_duration);
				$loan->frequency    = LoanPaymentFrequencies::find($loan->loan_payment_frequency);

				for ($i=0; $i < count($loan['loan_payments']); $i++) { 
					$loan['loan_payments_total'] += $loan['loan_payments'][$i]['amount'];
				}
				$loan->view = (object) [];
                $loan->view->Expected_Pay   = [round(($loan->total_loan_amount * $loan->frequency->number_of_days) / $loan->duration->number_of_days), $loan->frequency->name];
                $loan->view->Last_Paid      = [$loan['loan_payments']['0']['amount'], $loan['loan_payments']['0']['date']];
                $loan->view->Arrears_Period = NULL;
                $loan->view->Next_Pay_Date  = NULL;
                $loan->view->OLB            = $loan['total_loan_amount'] - $loan['loan_payments_total'];
                $loan->view->Last_LGF       = $client->last_lgf ? [$client->last_lgf->amount, $client->last_lgf->date] : NULL;
                $loan->view->Total_LGF      = $client->lgf_balance ? $client->lgf_balance->balance : NULL;
			}
		}

		// dd($ptr->clients[0]['loans']);
		
		return view('admin.general_reports.ptr',compact('ptr'));
	}

	public function loan_statement(Loans $loan)
	{
		// $loans = Loans::where([
		// 	'status' => LoanStatuses::where([['code','=','002']])->first()->id
		// ])->with(['loan_payments'])->paginate(100);

		$loan->client       = Clients::find($loan->client);
		$loan->balance      = $loan->total_loan_amount;
		$loan->disbursement = LoanDisbursements::where(['loan' => $loan->id])->first();
		$loan->duration     = LoanPaymentDurations::find($loan->loan_payment_duration);
		$loan->frequency    = LoanPaymentFrequencies::find($loan->loan_payment_frequency);
		$loan->installment  = round(($loan->total_loan_amount * $loan->frequency->number_of_days) / $loan->duration->number_of_days);
		$loan->payments     = LoanPayments::where(['loan' => $loan->id])->get();

		foreach ($loan->payments as $payments) {
			$loan->balance    -= $payments->amount;
			$payments->mode    = PaymentModes::find($payments->mode_of_payment)->name;
			$payments->balance = $loan->balance;
		}


		// dd($loan);

		return view('admin.general_reports.loan_statement',compact('loan'));
	}

	public function group_payment()
	{
		return view('admin.general_reports.group_payment',compact('group_payment'));
	}

	public function cashbook()
	{
		return view('admin.general_reports.cashbook',compact('cashbook'));
	}

	public function lgf_statement()
	{
		return view('admin.general_reports.lgf_statement',compact('lgf_statement'));
	}
}
