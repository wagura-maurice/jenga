<?php

namespace App\Jobs;

use App\Loans;
use Carbon\Carbon;
use App\LoanSchedule;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class GenerateLoanSchedule implements ShouldQueue
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
        try {
            if(getLoanBalance(['id' => $this->loan->id]) > 0) {
                if(LoanSchedule::where('loan_id', $this->loan->id)->count() == 0) {
                    /* Calling the `getloanschedule` method in the `LoansController` class. */
                    $schedules = app('App\Http\Controllers\admin\LoansController')->getloanschedule(
                        Carbon::parse($this->loan->date),
                        $this->loan->loanproductmodel->graceperiodmodel->number_of_days,
                        $this->loan->loanproductmodel->loanpaymentfrequencymodel->number_of_days,
                        $this->loan->loanproductmodel->loanpaymentdurationmodel->number_of_days,
                        $this->loan->total_loan_amount
                    );

                    /* Looping through the `` array and saving each item in the `loan_schedules`
                    table. */
                    collect($schedules)->map(function($schedule) {
                        $loan_schedule = new LoanSchedule;
                        $loan_schedule->loan_id = $this->loan->id;
                        $loan_schedule->payment_date = Carbon::parse($schedule['date'])->toDateString();
                        $loan_schedule->amount = $schedule['amount'];
                        $loan_schedule->total_expected_payment = $schedule['expectedpayment'];
                        $loan_schedule->payment_expected = $schedule['payment'];
                        $loan_schedule->balance = $schedule['expectedbalance'];
                        $loan_schedule->save();
                    });
                }
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
