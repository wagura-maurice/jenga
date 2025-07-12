<?php

namespace App\Exports;

use App\Clients;
use Carbon\Carbon;
use Rap2hpoutre\FastExcel\Exportable;

class ClientPerformanceExport
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
        $clients = $this->data();
        $headings = $this->headings();

        // Create a collection with headings
        $clientsWithHeadings = collect([$headings])->merge($clients);

        return $clientsWithHeadings;
    }

    protected function data()
    {
        $query = Clients::query();

        // Join the related tables
        $query->join('client_types', 'clients.client_type', '=', 'client_types.id');

        if ($this->branch) {
            $query->where('clients.branch_id', $this->branch);
        }

        if ($this->officer) {
            $query->where('clients.officer_id', $this->officer);
        }

        if ($this->startDate && $this->endDate) {
            $query->whereBetween('clients.created_at', [
                Carbon::parse($this->startDate)->hour(0)->minute(0)->second(0)->toDateString(),
                Carbon::parse($this->endDate)->addDay()->hour(23)->minute(59)->second(59)->toDateString()
            ]);
        }

        return $query->get([
            'client_number',
            'first_name',
            'middle_name',
            'last_name',
            'primary_phone_number',
            'id_number',
            'gender',
            'date_of_birth',
            'clients.created_at as created',
            'client_types.name as client_type'
        ])->map(function ($client) {
            return [
                $client->client_number,
                $client->first_name,
                $client->middle_name,
                $client->last_name,
                $client->primary_phone_number,
                $client->id_number,
                $client->gender,
                $client->date_of_birth,
                $client->created,
                $client->client_type
            ];
        });
    }

    protected function headings(): array
    {
        return [
            '# NUMBER',
            'FIRST NAME',
            'MIDDLE NAME',
            'LAST NAME',
            'PHONE NUMBER',
            'NATIONAL ID',
            'GENDER',
            'AGE',
            'REGISTERED',
            'TYPE'
        ];
    }

    public function setOptions(array $options = []): self
    {
        // Here you'd set any options required for the export
        // The specific options you can set will depend on what's provided by the package.

        return $this;  // return the current instance for method chaining
    }
}
