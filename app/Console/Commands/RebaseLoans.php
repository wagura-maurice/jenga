<?php

namespace App\Console\Commands;

use App\Loans;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;

class RebaseLoans extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:rebase-loans {--db=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Rebase loans';

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
                Loans::get()->map(function($loan) {
                    $loan->date = isset($loan->date) && !empty($loan->date) ? Carbon::parse(date('y-m-d', strtotime($loan->date)))->format('m/d/Y') : Carbon::now()->format('m/d/Y');
                    $loan->requested_at = isset($loan->date) && !empty($loan->date) ? Carbon::parse($loan->date)->toDateTimeString() : Carbon::now()->toDateTimeString();
                    $loan->save();
                });

                $this->info(__('App\'s loans rebasing, successful!'));

            } catch (\Throwable $th) {
                // throw $th;
                $this->info(__('App\'s loans rebasing, unsuccessful! please try again.'));
            }
        } else {
            $this->info(__('App\'s loans rebasing, unsuccessful! please check database connection and try again.'));
        }
    }
}
