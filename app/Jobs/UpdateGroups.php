<?php

namespace App\Jobs;

use App\Employees;
use Faker\Factory;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class UpdateGroups implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $group;

    public function __construct($group)
    {
        $this->group = $group;
    }

    public function handle()
    {
        /* $faker = Factory::create();
        $this->group->group_name = $this->group->group_number . '-' . $faker->unique()->company; */

        $employee = Employees::find($this->group->officer);

        $this->group->branch_id = $employee->branch ?? 1;

        $this->group->save();
    }
}
