<?php

namespace App\Exports;

use Carbon\Carbon;
use App\LoanDisbursements;
use Rap2hpoutre\FastExcel\Exportable;

class DisbursementPerformanceExport
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
        $loan_disbursements = $this->data();
        $headings = $this->headings();

        // Create a collection with headings
        $loan_disbursementsWithHeadings = collect([$headings])->merge($loan_disbursements);

        return $loan_disbursementsWithHeadings;
    }

    protected function data()
    {
        $query = LoanDisbursements::query();

        // Join the related tables
        $query->join('loans', 'loan_disbursements.loan', '=', 'loans.id');
        $query->join('clients', 'loans.client', '=', 'clients.id');

        if ($this->branch) {
            $query->where('loan_disbursements.branch_id', $this->branch);
        }

        if ($this->officer) {
            $query->where('loan_disbursements.officer_id', $this->officer);
        }

        if ($this->startDate && $this->endDate) {
            $query->whereBetween('loan_disbursements.created_at', [
                Carbon::parse($this->startDate)->hour(0)->minute(0)->second(0)->toDateString(),
                Carbon::parse($this->endDate)->addDay()->hour(23)->minute(59)->second(59)->toDateString()
            ]);
        }

        return $query->get([
            'loans.loan_number',
            'clients.first_name',
            'clients.middle_name',
            'clients.last_name',
            'loans.date',
            'loans.total_loan_amount',
            'loans.amount_to_be_disbursed',
            'loan_disbursements.disbursement_status'
        ])->map(function ($disbarment) {
            return [
                $disbarment->loan_number,
                $disbarment->first_name . ' ' . $disbarment->middle_name . ' '. $disbarment->last_name,
                $disbarment->date,
                $disbarment->total_loan_amount,
                $disbarment->amount_to_be_disbursed,
                $disbarment->disbursement_status == 1 ? 'Pending' : ($disbarment->disbursement_status == 2 ? 'Disbursed' : ($disbarment->disbursement_status == 3 ? 'Rejected' : ''))
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
            'STATUS'
        ];
    }

    public function setOptions(array $options = []): self
    {
        // Here you'd set any options required for the export
        // The specific options you can set will depend on what's provided by the package.

        return $this;  // return the current instance for method chaining
    }
}
