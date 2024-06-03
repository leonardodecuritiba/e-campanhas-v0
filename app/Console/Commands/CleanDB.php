<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CleanDB extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:cleandb';

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
	    $this->call('command:exportdb');
	    DB::table('contracts')->delete();
	    DB::statement("ALTER TABLE contracts AUTO_INCREMENT = 1");
	    DB::statement("ALTER TABLE contract_items AUTO_INCREMENT = 1");
	    DB::table('moviments')->delete();
	    DB::statement("ALTER TABLE moviments AUTO_INCREMENT = 1");
	    DB::statement("ALTER TABLE invoices AUTO_INCREMENT = 1");
    }
}
