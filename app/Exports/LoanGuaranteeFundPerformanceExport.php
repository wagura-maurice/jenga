<?php

namespace App\Exports;

use Carbon\Carbon;
use App\ClientLgfContributions;
use Rap2hpoutre\FastExcel\Exportable;

class LoanGuaranteeFundPerformanceExport
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
        $client_lgf_contributions = $this->data();
        $headings = $this->headings();

        $client_lgf_contributionsWithHeadings = collect([$headings])->merge($client_lgf_contributions);

        return $client_lgf_contributionsWithHeadings;
    }

    protected function data()
    {
        $query = ClientLgfContributions::query()->limit(100);

        $query->join('clients', 'client_lgf_contributions.client', '=', 'clients.id');
        $query->join('payment_modes', 'client_lgf_contributions.payment_mode', '=', 'payment_modes.id');

        if ($this->branch) {
            $query->where('client_lgf_contributions.branch_id', $this->branch);
        }

        if ($this->officer) {
            $query->where('client_lgf_contributions.officer_id', $this->officer);
        }

        if ($this->startDate && $this->endDate) {
            $query->whereBetween('client_lgf_contributions.date', [
                Carbon::parse($this->startDate)->hour(0)->minute(0)->second(0)->toDateString(),
                Carbon::parse($this->endDate)->addDay()->hour(23)->minute(59)->second(59)->toDateString()
            ]);
        }

        return $query->get([
            'client_lgf_contributions.id',
            'clients.first_name',
            'clients.middle_name',
            'clients.last_name',
            'client_lgf_contributions.amount as contribution_amount',
            'client_lgf_contributions.date as contribution_date',
            'payment_modes.code',
            'payment_modes.name as payment_mode_name',
            'client_lgf_contributions.transaction_number',
            'client_lgf_contributions.transaction_status'
        ])->map(function ($contribution) {
            return [
                $contribution->id,
                $contribution->first_name . ' ' . $contribution->middle_name . ' '. $contribution->last_name,
                $contribution->contribution_amount,
                $contribution->transaction_number,
                $contribution->code . ' ' . $contribution->payment_mode_name,
                $contribution->contribution_date,
                $contribution->transaction_status == 1
                    ? 'Pending'
                    : ($contribution->transaction_status == 2
                        ? 'Approved'
                        : ($contribution->transaction_status == 3
                            ? 'Rejected'
                            : ''))
            ];
        });
    }

    protected function headings(): array
    {
        return [
            '#',
            'CLIENT NAME',
            'AMOUNT',
            'CODE',
            'MODE',
            'DATE',
            'STATUS'
        ];
    }

    public function setOptions(array $options = []): self
    {
        return $this;
    }
}
