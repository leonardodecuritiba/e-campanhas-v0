<?php

namespace Database\Seeders;

use App\Models\HumanResources\User;
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
            ->count(50)
            ->create();

        $this->command->info('User complete ...');

        $this->command->info( 'TestSeed FINISHED in ' . round((microtime(true) - $start), 3) . "s ***");

    }
}
