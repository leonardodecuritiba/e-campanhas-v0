<?php

namespace Database\Seeders;

use App\Models\HumanResources\Settings\Permission;
use App\Models\HumanResources\Settings\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

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

        Artisan::call('make:permission groups');
        Artisan::call('make:permission voters');
        Artisan::call('make:permission users');

        $permissions = Permission::all();
        $role_registrar = Role::findByName('registrar');
        $role_coordinator = Role::findByName('coordinator');
        $role_registrar->syncPermissions($permissions);
        $role_coordinator->syncPermissions($permissions);


        $this->command->info( 'Seed FINISHED in ' . round((microtime(true) - $start), 3) . "s ***");
    }
}
