<?php

namespace App\Console\Commands;

use App\Loans;
use Carbon\Carbon;
use App\StandingOrder;
use App\ApprovalStatuses;
use App\LgfToLoanTransfers;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;
use App\Http\Controllers\admin\LoansController;

class TransferStandingOrder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:transfer-standing-order-via-lgf {--db=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'transfer funds from lgf for loan payment purposes';

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
                /* Transferring funds from lgf to loan account. */
                StandingOrder::where('_status', 'approved')
                    // ->where('start_date', '>=', Carbon::today())
                    // ->where('end_date', '>=', Carbon::today())
                    ->where('next_transfer', '<=', Carbon::now()->toDateTimeString())
                    ->get()
                    ->map(function($order) {
                        $loan = Loans::where('id', $order->destination_account)->first();
                        $loan->balance = app(LoansController::class)->getloanbalancebyid($order->destination_account);

                        if(isset($loan->balance) && $loan->balance > $order->amount) {
                            $c = $loan->balance; // loan balance
                            $s = $order->amount; // order amount

                            $mod = $c % $s;
                            $times = ($c-$mod)/$s;

                            if ($times >= 1) {
                                $lgftoloantransfers=new LgfToLoanTransfers();
                                $lgftoloantransfers->client=$order->client_id;
                                $lgftoloantransfers->transaction_number='SO - ' . strtoupper(substr(generateUUID(), -7));
                                $lgftoloantransfers->loan=$order->destination_account;
                                $lgftoloantransfers->amount=$order->amount;
                                $lgftoloantransfers->initiated_by=$order->escalated_by;
                                $lgftoloantransfers->transaction_date=Carbon::now()->toDateString();
                                $approvalstatuses=ApprovalStatuses::where([["code","=","003"]])->get()->first();
                                $lgftoloantransfers->approval_status=$approvalstatuses->id;
                                $lgftoloantransfers->save();
                            } else {
                                $order->_status = 'processed';
                            }

                            if ($order->frequency == 'daily') {
                                $order->next_transfer = Carbon::parse($order->next_transfer)->addDay()->toDateTimeString();
                            } elseif($order->frequency == 'weekly') {
                                $order->next_transfer = Carbon::parse($order->next_transfer)->addWeek()->toDateTimeString();
                            } elseif($order->frequency == 'monthly') {
                                $order->next_transfer = Carbon::parse($order->next_transfer)->addMonth()->toDateTimeString();
                            } elseif($order->frequency == 'quarterly') {
                                $order->next_transfer = Carbon::parse($order->next_transfer)->addMonths(3)->toDateTimeString();
                            }

                            $order->next_transfer = Carbon::now()->toDateTimeString();
                            $order->save();
                        }
                    });

                $this->info(__('App\'s transferring standing orders via lgf, successful!'));

            } catch (\Throwable $th) {
                // throw $th;
                $this->info(__('App\'s transferring standing orders via lgf, unsuccessful! please try again.'));
            }
        } else {
            $this->info(__('App\'s transferring standing orders via lgf, unsuccessful! please check database connection and try again.'));
        }
    }
}
