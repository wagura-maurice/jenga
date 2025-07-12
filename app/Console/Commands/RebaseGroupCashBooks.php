<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\GroupCashBooks;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;

class RebaseGroupCashBooks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:rebase-group-cash-books {--db=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Rebase group cash books';

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
                GroupCashBooks::get()->map(function($book) {
                    $book->transaction_date2 = $book->transaction_date ? Carbon::parse($book->transaction_date)->toDateString() : NULL;
                    $book->save();
                });

                $this->info(__('App\'s group cash books rebasing, successful!'));

            } catch (\Throwable $th) {
                // throw $th;
                $this->info(__('App\'s group cash books rebasing, unsuccessful! please try again.'));
            }
        } else {
            $this->info(__('App\'s group cash books rebasing, unsuccessful! please check database connection and try again.'));
        }
    }
}
