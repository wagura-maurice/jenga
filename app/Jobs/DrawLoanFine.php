<?php

namespace App\Jobs;

use App\Loans;
use App\LoanFine;
use Carbon\Carbon;
use App\LoanSchedule;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class DrawLoanFine implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $loan;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(string $loan_number)
    {
        $this->loan = Loans::where('loan_number', $loan_number)->first();
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // in the loan schedule table, if a payment date older that today exists. please charge a fine on said loan.
        // first! observe that the loan its self is finable! i.e by the grace period i guess!
        try {
            if(getLoanBalance(['id' => $this->loan->id]) > 0) {
                /* Getting the first schedule that is not yet due. */
                $schedule = LoanSchedule::where('loan_id', $this->loan->id)
                    ->whereDate('payment_date', '>', Carbon::today()->toDateString())
                    ->first();

                if ($schedule) {
                    /* Getting all the fines that have been charged on the loan. */
                    $fines = LoanFine::where([
                        'loan_id' => $this->loan->id,
                        'product_id' => $this->loan->loanproductmodel->id,
                        'schedule_id' => $schedule->id,
                        'client_id' => $this->loan->client
                    ])->get();

                    /* Checking if the fines count is less than 0, if it is, it creates a new fine and
                    saves it. */
                    if ($fines->count() == 0 && ((int) $this->loan->fine_charge > 0)) {
                        $fine = new LoanFine;
                        $fine->loan_id = $this->loan->id;
                        $fine->product_id = $this->loan->loanproductmodel->id;
                        $fine->schedule_id = $schedule->id;
                        $fine->client_id = $this->loan->client;
                        $fine->fine_date = Carbon::parse($schedule->payment_date)->toDateString();
                        $fine->amount = $this->loan->fine_charge;
                        $fine->save();
                    }
                }
        }

        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
