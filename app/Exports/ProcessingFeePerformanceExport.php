<?php

namespace App\Exports;

use Carbon\Carbon;
use App\ProcessingFeePayments;
use Rap2hpoutre\FastExcel\Exportable;

class ProcessingFeePerformanceExport
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
        $processing_fee_payments = $this->data();
        $headings = $this->headings();

        $processing_fee_paymentsWithHeadings = collect([$headings])->merge($processing_fee_payments);

        return $processing_fee_paymentsWithHeadings;
    }

    protected function data()
    {
        $query = ProcessingFeePayments::query()->whereNotNull('processing_fee_payments.loan_number');

        $query->join('loans', 'processing_fee_payments.loan_number', '=', 'loans.id');
        $query->join('clients', 'loans.client', '=', 'clients.id');
        $query->join('payment_modes', 'processing_fee_payments.payment_mode', '=', 'payment_modes.id');

        if ($this->branch) {
            $query->where('processing_fee_payments.branch_id', $this->branch);
        }

        if ($this->officer) {
            $query->where('processing_fee_payments.officer_id', $this->officer);
        }

        if ($this->startDate && $this->endDate) {
            $query->whereBetween('processing_fee_payments.created_at', [
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
            'processing_fee_payments.amount as fee_amount',
            'processing_fee_payments.date as fee_date',
            'payment_modes.code',
            'payment_modes.name as payment_mode_name',
            'processing_fee_payments.transaction_number',
            'processing_fee_payments.transaction_status'
        ])->map(function ($payment) {
            return [
                $payment->loan_number,
                $payment->first_name . ' ' . $payment->middle_name . ' '. $payment->last_name,
                $payment->loan_date,
                $payment->total_loan_amount,
                $payment->amount_to_be_disbursed,
                $payment->fee_amount,
                $payment->fee_date,
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
            'FEE AMOUNT',
            'FEE DATE',
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
