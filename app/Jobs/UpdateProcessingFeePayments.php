<?php

namespace App\Jobs;

use App\Loans;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class UpdateProcessingFeePayments implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $processingFee;

    public function __construct($processingFee)
    {
        $this->processingFee = $processingFee;
    }

    public function handle()
    {
        $loan = Loans::where('id', $this->processingFee->loan_number)->with('clientmodel')->first();
        
        $this->processingFee->branch_id = $loan ? ($loan->clientmodel->branch_id ?? 1) : 1;
        $this->processingFee->officer_id = $loan ? ($loan->clientmodel->officer_id ?? 1) : 1;
        
        $this->processingFee->save();
    }
}
