<?php

namespace Database\Seeders;

use App\Models\HumanResources\Settings\Role;
use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //php artisan db:seed --class=RoleTableSeeder
        $start = microtime( true );

        Role::create(['name' => 'root']);
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'coordinator']);
        Role::create(['name' => 'registrar']);

        $this->command->info( 'Seed FINISHED in ' . round((microtime(true) - $start), 3) . "s ***");
    }
}
