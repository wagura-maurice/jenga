<?php

namespace App\Jobs;

use App\Users;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class UpdateEmployees implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $employee;

    public function __construct($employee)
    {
        $this->employee = $employee;
    }

    public function handle()
    {
        // Check if the email is not null
        if (isset($this->employee->email_address) && !empty($this->employee->email_address) && !is_null($this->employee->email_address)) {
            $user = Users::where('email', trim($this->employee->email_address))->first();

            if (isset($user) && !empty($user) && !is_null($user)) {
                $user->branch_id = $this->employee->branch;
                $user->save();

                $this->employee->user_id = $user->id;
            } else {
                $this->employee->user_id = NULL;
            }

            $this->employee->email_address = trim($this->employee->email_address);
        } else {
            $this->employee->email_address = NULL;
            $this->employee->user_id = NULL;
        }

        $this->employee->save();
    }
}
