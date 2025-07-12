<?php

namespace App\Jobs;

use App\Clients;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class UpdateClientLgfContributions implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $contribution;

    public function __construct($contribution)
    {
        $this->contribution = $contribution;
    }

    public function handle()
    {
        $client = Clients::find($this->contribution->client);

        $this->contribution->branch_id = $client->branch_id;
        $this->contribution->officer_id = $client->officer_id;
        
        $this->contribution->save();
    }
}
