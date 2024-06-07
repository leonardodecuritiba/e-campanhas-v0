<?php

namespace Database\Seeders\OLD;

use App\Models\HumanResources\Settings\Permission;
use Illuminate\Database\Seeder;

class SetPermissionsTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //php artisan db:seed --class=SetPermissionsTable
        $names = ['users', 'voters', 'groups', 'vehicles', 'conveyors', 'regions', 'moviments', 'contracts'];

        foreach ($names as $name){
            $fields = ['index', 'menu', 'show', 'create', 'edit', 'delete'];
            foreach ($fields as $field){
                $p = $name. "." . $field;
                if(Permission::where('name', $p)->first() == NULL){
                    Permission::create([
                        'name'  =>   $p,
                    ]);
                }
            }
            if($name == 'moviments'){
                $p = $name. ".import";
                if(Permission::where('name', $p)->first() == NULL){
                    Permission::create([
                        'name'  =>   $p,
                    ]);
                }
            } else if($name == 'contracts'){
                $fields = ['import', 'cancel', 'reopen', 'recalc', 'close', 'add_itens', 'edit_itens', 'delete_itens', 'show_values'];
                foreach ($fields as $field){
                    $p = $name. "." . $field;
                    if(Permission::where('name', $p)->first() == NULL){
                        Permission::create([
                            'name'  =>   $p,
                        ]);
                    }
                }
            }
        }

        //service_types  ou unassociateds
        $names = ['service_types', 'unassociateds'];
        foreach ($names as $name){
            $fields = ['index', 'menu'];
            foreach ($fields as $field){
                $p = $name. "." . $field;
                if(Permission::where('name', $p)->first() == NULL){
                    Permission::create([
                        'name'  =>   $p,
                    ]);
                }
            }
        }

        //CTRB Parceiro
        $p = "contracts_partner.menu";
        if(Permission::where('name', $p)->first() == NULL){
            Permission::create([
                'name'  =>   $p,
            ]);
        }

        //invoices-import
        $name = 'invoices-import';
        $fields = ['menu', 'import'];
        foreach ($fields as $field){
            $p = $name. "." . $field;
            if(Permission::where('name', $p)->first() == NULL){
                Permission::create([
                    'name'  =>   $p,
                ]);
            }
        }

        //reports
        $p = "reports.access";
        if(Permission::where('name', $p)->first() == NULL){
            Permission::create([
                'name'  =>   $p,
            ]);
        }

    }
}
