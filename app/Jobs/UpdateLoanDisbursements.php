<?php

namespace App\Jobs;

use App\Loans;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class UpdateLoanDisbursements implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $disbursment;

    public function __construct($disbursment)
    {
        $this->disbursment = $disbursment;
    }

    public function handle()
    {
        $loan = Loans::where('id', $this->disbursment->loan)->with('clientmodel')->first();

        $this->disbursment->branch_id = $loan ? ($loan->clientmodel->branch_id ?? 1) : 1;
        $this->disbursment->officer_id = $loan ? ($loan->clientmodel->officer_id ?? 1) : 1;
        
        $this->disbursment->save();
    }
}
