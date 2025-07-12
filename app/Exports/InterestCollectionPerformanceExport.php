<?php

namespace App\Exports;

use Carbon\Carbon;
use App\LoanInterest;
use Rap2hpoutre\FastExcel\Exportable;

class InterestCollectionPerformanceExport
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
        $loan_interests = $this->data();
        $headings = $this->headings();

        $loan_interestsWithHeadings = collect([$headings])->merge($loan_interests);

        return $loan_interestsWithHeadings;
    }

    protected function data()
    {
        $query = LoanInterest::query()->limit(100);

        $query->join('payment_modes', 'loan_interests.mode', '=', 'payment_modes.id');

        if ($this->branch) {
            $query->where('loan_interests.branch_id', $this->branch);
        }

        if ($this->officer) {
            $query->where('loan_interests.officer_id', $this->officer);
        }

        if ($this->startDate && $this->endDate) {
            $query->whereBetween('loan_interests.date', [
                Carbon::parse($this->startDate)->hour(0)->minute(0)->second(0)->toDateString(),
                Carbon::parse($this->endDate)->addDay()->hour(23)->minute(59)->second(59)->toDateString()
            ]);
        }

        return $query->get([
            'loan_interests.id',
            'loan_interests.amount',
            'loan_interests.code',
            'payment_modes.code as payment_mode_code',
            'payment_modes.name as payment_mode_name',
            'loan_interests.date',
            'loan_interests.collecting_officer'
        ])->map(function ($interest) {
            return [
                $interest->id,
                $interest->amount,
                $interest->code,
                $interest->payment_mode_code . ' ' . $interest->payment_mode_name,
                $interest->date,
                $interest->collecting_officer
            ];
        });
    }

    protected function headings(): array
    {
        return [
            '#',
            'AMOUNT',
            'CODE',
            'MODE',
            'DATE',
            'COLLECTING OFFICER'
        ];
    }

    public function setOptions(array $options = []): self
    {
        return $this;
    }
}
