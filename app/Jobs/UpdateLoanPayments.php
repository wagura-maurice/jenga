<?php

namespace App\Jobs;

use App\Loans;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class UpdateLoanPayments implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $loanPayment;

    public function __construct($loanPayment)
    {
        $this->loanPayment = $loanPayment;
    }

    public function handle()
    {
        $loan = Loans::where('id', $this->loanPayment->loan)->with('clientmodel')->first();
        
        $this->loanPayment->branch_id = $loan ? ($loan->clientmodel->branch_id ?? 1) : 1;
        $this->loanPayment->officer_id = $loan ? ($loan->clientmodel->officer_id ?? 1) : 1;
        
        $this->loanPayment->save();
    }
}
