<?php

namespace App\Exports;

use Carbon\Carbon;
use App\LoanPayments;
use Rap2hpoutre\FastExcel\Exportable;

class LoanCollectionPerformanceExport
{
    use Exportable;

    protected $branch;
    protected $officer;
    protected $startDate;
    protected $endDate;

    public function __construct($startDate = null, $endDate = null, $branch = null, $officer = null)
    {
        $this->branch = $branch;
        $this->officer = $officer;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function export()
    {
        $loan_payments = $this->data();
        $headings = $this->headings();

        $loan_paymentsWithHeadings = collect([$headings])->merge($loan_payments);

        return $loan_paymentsWithHeadings;
    }

    protected function data()
    {
        $query = LoanPayments::query();

        $query->join('loans', 'loan_payments.loan', '=', 'loans.id');
        $query->join('clients', 'loans.client', '=', 'clients.id');
        $query->join('payment_modes', 'loan_payments.mode_of_payment', '=', 'payment_modes.id');

        if ($this->branch) {
            $query->where('loan_payments.branch_id', $this->branch);
        }

        if ($this->officer) {
            $query->where('loan_payments.officer_id', $this->officer);
        }

        if ($this->startDate && $this->endDate) {
            $query->whereBetween('loan_payments.created_at', [
                Carbon::parse($this->startDate)->hour(0)->minute(0)->second(0)->toDateString(),
                Carbon::parse($this->endDate)->addDay()->hour(23)->minute(59)->second(59)->toDateString()
            ]);
        }

        return $query->get([
            'loans.loan_number',
            'clients.first_name',
            'clients.middle_name',
            'clients.last_name',
            'loans.date as loan_date',
            'loans.total_loan_amount',
            'loans.amount_to_be_disbursed',
            'loan_payments.amount as collected_amount',
            'loan_payments.date as collection_date',
            'payment_modes.code',
            'payment_modes.name as payment_mode_name',
            'loan_payments.transaction_number',
            'loan_payments.transaction_status'
        ])->map(function ($payment) {
            return [
                $payment->loan_number,
                $payment->first_name . ' ' . $payment->middle_name . ' '. $payment->last_name,
                $payment->loan_date,
                $payment->total_loan_amount,
                $payment->amount_to_be_disbursed,
                $payment->collected_amount,
                $payment->collection_date,
                $payment->code . ' - ' .  $payment->payment_mode_name,
                $payment->transaction_number,
                $payment->transaction_status == 1
                    ? 'Pending'
                    : ($payment->transaction_status == 2
                        ? 'Approved'
                        : ($payment->transaction_status == 3
                            ? 'Rejected'
                            : ''))
            ];
        });
    }

    protected function headings(): array
    {
        return [
            '# LOAN NUMBER',
            'CLIENT NAME',
            'LOAN DATE',
            'LOAN AMOUNT',
            'DISBURSEMENT AMOUNT',
            'COLLECTED AMOUNT',
            'COLLECTION DATE',
            'PAYMENT MODE',
            'TRANSACTION CODE',
            'STATUS'
        ];
    }

    public function setOptions(array $options = []): self
    {
        return $this;
    }
}
