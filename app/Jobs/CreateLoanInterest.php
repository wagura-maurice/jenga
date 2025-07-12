<?php

namespace App\Jobs;

use Carbon\Carbon;
use App\LoanInterest;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class CreateLoanInterest implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $group_cash_book;

    public function __construct($group_cash_book)
    {
        $this->group_cash_book = $group_cash_book;
    }

    public function handle()
    {
        if (!empty($this->group_cash_book)) {
            $loanInterest = new LoanInterest;

            $loanInterest->amount = $this->group_cash_book->amount ?? 0;
            $loanInterest->code = $this->group_cash_book->transaction_id ? substr(trim($this->group_cash_book->transaction_id), 0, 10) : null;
            $loanInterest->mode = $this->group_cash_book->payment_mode ?? 1;
            $loanInterest->date = $this->parseDate($this->group_cash_book->transaction_date);
            $loanInterest->collecting_officer = $this->group_cash_book->collecting_officer;
            $loanInterest->branch_id = $this->group_cash_book->branch_id ?? 1;
            $loanInterest->officer_id = $this->group_cash_book->officer_id ?? 1;
            
            $loanInterest->save();
        }
    }

    protected function parseDate($date)
    {
        return isset($date) && !empty($date) ? Carbon::parse($date)->toDateString() : Carbon::now()->toDateString();
    }
}
