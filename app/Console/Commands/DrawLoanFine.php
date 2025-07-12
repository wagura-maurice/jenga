<?php

namespace App\Console\Commands;

use App\Loans;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;

class DrawLoanFine extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:draw-loan-fine {--db=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'for the purpose of drawing loan fines when due';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        if ($this->option('db')) {
            Config::set('database.connections.mysql.database', $this->option('db'));
            DB::reconnect('mysql');
                
            try {
                /* Getting all the loans and dispatching the job to draw loan fine for each loan. */
                Loans::get()->map(function($loan) {
                    \App\Jobs\DrawLoanFine::dispatch($loan->loan_number);
                });

                $this->info(__('App\'s drawing loan fines when due, successful!'));

            } catch (\Throwable $th) {
                // throw $th;
                $this->info(__('App\'s drawing loan fines when due, unsuccessful! please try again.'));
            }
        } else {
            $this->info(__('App\'s drawing loan fines when due, unsuccessful! please check database connection and try again.'));
        }
    }
}