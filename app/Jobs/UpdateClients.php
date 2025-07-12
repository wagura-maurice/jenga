<?php

namespace App\Jobs;

use Faker\Factory;
use App\GroupClients;
use Illuminate\Support\Str;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class UpdateClients implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $client;

    public function __construct($client)
    {
        $this->client = $client;
    }

    public function handle()
    {
        /* $faker = Factory::create();
        $this->client->first_name = $faker->firstName;
        $this->client->middle_name = $faker->name;
        $this->client->last_name = $faker->lastName;
        $this->client->id_number =  Str::random(10);
        $this->client->primary_phone_number = $faker->phoneNumber;
        $this->client->secondary_phone_number = $faker->phoneNumber; */

        $group = GroupClients::where('client', $this->client->id)->with('client_groupmodel')->first();

        $this->client->branch_id = $group ? ($group->client_groupmodel->branchmodel->id ?? 1) : 1;
        $this->client->officer_id = $group ? ($group->client_groupmodel->officermodel->id ?? 1) : 1;
        
        $this->client->save();
    }
}
