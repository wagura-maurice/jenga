<?php

namespace App\Jobs;

use App\Groups;
use Faker\Factory;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class UpdateGroupCashBooks implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $group_cash_book;

    public function __construct($group_cash_book)
    {
        $this->group_cash_book = $group_cash_book;
    }

    public function handle()
    {
        // $faker = Factory::create();

        $group = Groups::find($this->group_cash_book->transacting_group);
        // $group->group_name = $group->group_number . '-' . $faker->unique()->company;

        $this->group_cash_book->officer_id = $group->officermodel->id ?? 1;
        $this->group_cash_book->branch_id = $group->branchmodel->id ?? 1;

        $this->group_cash_book->save();
    }
}
