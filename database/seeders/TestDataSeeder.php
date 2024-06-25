<?php

namespace Database\Seeders;

use App\Models\HumanResources\Settings\Address;
use App\Models\HumanResources\Settings\Group;
use App\Models\HumanResources\User;
use App\Models\HumanResources\Voter;
use Illuminate\Database\Seeder;

class TestDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //php artisan db:seed --class=TestDataSeeder

        $start = microtime( true );

        User::factory()
            ->count(10)
            ->create();
        $this->command->info('User complete ...');

        Group::flushEventListeners();
        Group::getEventDispatcher();
        Group::factory()
            ->count(50)
            ->create();
        $this->command->info('Group complete ...');

        Voter::flushEventListeners();
        Voter::getEventDispatcher();
        Voter::factory()
            ->count(200)
            ->create();
        $this->command->info('Voter complete ...');

        $this->command->info( 'TestSeed FINISHED in ' . round((microtime(true) - $start), 3) . "s ***");

    }
}
