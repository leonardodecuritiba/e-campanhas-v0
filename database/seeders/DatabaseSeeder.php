<?php

namespace Database\Seeders;
use App\Models\HumanResources\Settings\Role;
use Illuminate\Database\Seeder;
use App\Companies\Company;
use Illuminate\Support\Facades\Artisan;
use App\Models\HumanResources\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	    $this->call(ImportCepTable::class);
        Role::create(['name' => 'root']);
        Role::create(['name' => 'admin']);

	    User::flushEventListeners();
	    User::getEventDispatcher();

	    $user = new User([
            'name'          => 'Leonardo ROOT',
            'email'         => 'silva.zanin@gmail.com',
        ]);
        $user->password = bcrypt('123');
        $user->save();
        $user->assignRole(1);

        $user = new User([
            'name'          => 'Fabrício ROOT',
            'email'         => 'guiafaxil@gmail.com',
        ]);
	    $user->password = bcrypt('123');
        $user->save();
        $user->assignRole(1);

    }
}
