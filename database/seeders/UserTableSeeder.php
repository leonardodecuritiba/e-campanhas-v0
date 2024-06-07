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
//
//        User::flushEventListeners();
//        User::getEventDispatcher();

        $user = new User([
            'name'          => 'Leonardo',
            'email'         => 'silva.zanin@gmail.com',
        ]);
        $user->password = '123';
        $user->save();
        $user->assignRole(1);

        $user = new User([
            'name'          => 'Fabrício',
            'email'         => 'guiafaxil@gmail.com',
        ]);
        $user->password = '123';
        $user->save();
        $user->assignRole(1);

        $this->command->info( 'Seed FINISHED in ' . round((microtime(true) - $start), 3) . "s ***");
    }
}
