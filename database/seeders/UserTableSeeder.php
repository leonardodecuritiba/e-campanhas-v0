<?php

namespace Database\Seeders;

use App\Models\HumanResources\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

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

        $user = new User();
        $user->name = 'Leonardo';
        $user->email = 'silva.zanin@gmail.com';
        $user->password = '123';
        $user->status = true;
        $user->email_verified_at = now();
        $user->remember_token = Str::random(10);
        $user->save();
        $user->assignRole(1);
        $this->command->info($user->name . ' User complete ...');

        $user = User::factory()
            ->create();
        $user->name = 'Fabrício';
        $user->email = 'guiafaxil@gmail.com';
        $user->password = '123';
        $user->status = true;
        $user->email_verified_at = now();
        $user->remember_token = Str::random(10);
        $user->save();
        $user->assignRole(1);
        $this->command->info($user->name . ' User complete ...');

        $this->command->info( 'Seed FINISHED in ' . round((microtime(true) - $start), 3) . "s ***");
    }
}
