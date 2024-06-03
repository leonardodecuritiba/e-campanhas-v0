<?php

namespace App\Console\Commands;

use App\Models\HumanResources\Settings\Permission;
use Illuminate\Console\Command;

class MakePermission extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:permission {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $name = $this->argument('name');
        $fields = ['index', 'show', 'create', 'edit', 'delete', 'menu'];

        foreach ($fields as $field){
            Permission::create([
                'name'  =>   $name. "." . $field,
            ]);
        }

    }
}
