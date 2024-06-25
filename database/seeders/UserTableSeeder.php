<?php

namespace Database\Seeders;

use App\Models\HumanResources\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //php artisan db:seed --class=UserTableSeeder
        $start = microtime( true );

        User::flushEventListeners();
        User::getEventDispatcher();
        $user = User::factory()
            ->create();
        $user->name = 'Leonardo';
        $user->email = 'silva.zanin@gmail.com';
        $user->save();
        $user->detachRoles();
        $user->assignRole(1);
        $this->command->info('Leonardo User complete ...');

        $user = User::factory()
            ->create();
        $user->name = 'Fabrício';
        $user->email = 'guiafaxil@gmail.com';
        $user->save();
        $user->detachRoles();
        $user->assignRole(1);
        $this->command->info('Leonardo User complete ...');

        $this->command->info( 'Seed FINISHED in ' . round((microtime(true) - $start), 3) . "s ***");
    }
}
