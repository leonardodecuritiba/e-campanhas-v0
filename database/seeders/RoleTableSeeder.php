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

//        Role::create(['name' => 'root']);
//        Role::create(['name' => 'admin']);
//        Role::create(['name' => 'coordinator']);
//
//        Artisan::call('make:permission groups');
        $permissions = Permission::all();

//        $role = Role::create(['name' => 'registrar']);
        $role = Role::findByName('registrar');
        $role->syncPermissions($permissions);

        $this->command->info( 'Seed FINISHED in ' . round((microtime(true) - $start), 3) . "s ***");
    }
}
