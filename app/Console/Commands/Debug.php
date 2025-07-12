<?php

namespace App\Console\Commands;

use App\Loans;
use App\Users;
use App\Groups;
use App\Clients;
use App\Employees;
use App\LoanPayments;
use App\GroupCashBooks;
use App\Jobs\UpdateUsers;
use App\Jobs\UpdateGroups;
use App\LoanDisbursements;
use App\Jobs\UpdateClients;
use App\Jobs\UpdateEmployees;
use App\ProcessingFeePayments;
use App\ClientLgfContributions;
use Illuminate\Console\Command;
use App\Jobs\CreateLoanInterest;
use App\Jobs\UpdateLoanPayments;
use App\Jobs\UpdateGroupCashBooks;
use Illuminate\Support\Facades\DB;
use App\Jobs\UpdateLoanDisbursements;
use Illuminate\Support\Facades\Config;
use App\Jobs\UpdateProcessingFeePayments;
use App\Jobs\UpdateClientLgfContributions;

class Debug extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:debug {--db=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'for the purpose of debugging the application';

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
            // Config::set('database.connections.mysql.host', '185.177.116.84');
            // Config::set('database.connections.mysql.password', '521 Kabbalah');
            DB::reconnect('mysql');

            try {
                Clients::get()->each(function ($client) {
                    UpdateClients::dispatch($client);
                });

                LoanDisbursements::get()->each(function ($disbursment) {
                    UpdateLoanDisbursements::dispatch($disbursment);
                });

                /* Loans::with('clientmodel')->get()->each(function ($loan) {
                    // 
                }); */

                ClientLgfContributions::get()->each(function ($contribution) {
                    UpdateClientLgfContributions::dispatch($contribution);
                });

                LoanPayments::get()->each(function ($disbursment) {
                    UpdateLoanPayments::dispatch($disbursment);
                });

                ProcessingFeePayments::get()->each(function ($disbursment) {
                    UpdateProcessingFeePayments::dispatch($disbursment);
                });

                Groups::get()->map(function ($group)
                {
                    UpdateGroups::dispatch($group);
                });
                
                GroupCashBooks::get()->each(function ($group_cash_book) {
                    UpdateGroupCashBooks::dispatch($group_cash_book);
                    CreateLoanInterest::dispatch($group_cash_book);
                });
                
                Users::get()->map(function ($user)
                {
                    UpdateUsers::dispatch($user);
                });

                Employees::get()->map(function ($employee)
                {
                    UpdateEmployees::dispatch($employee);
                });

                $this->info(__('App\'s debugging, successful!'));
            } catch (\Throwable $th) {
                throw $th;
                $this->info(__('App\'s debugging, unsuccessful! please try again.'));
            }
        } else {
            $this->info(__('App\'s drawing loan fines when due, unsuccessful! please check database connection and try again.'));
        }
    }
}
