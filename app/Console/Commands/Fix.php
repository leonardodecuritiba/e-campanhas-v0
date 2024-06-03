<?php

namespace App\Console\Commands;

use App\Models\Moviments\Contract;
use Illuminate\Support\Facades\DB;
use Illuminate\Console\Command;

class Fix extends Command
{
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'command:fix';

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
//        $ms = DB::table('moviments')->select('id', 'cte_key')->where('cte_key', "<>", "")->get(['id', 'cte_key']);
//        $progressBar = $this->output->createProgressBar($ms->count());
//        $progressBar->start();
//        foreach ($ms as $c){
//            DB::table('moviments')
//                ->where('id', $c->id)
//                ->update(['cte_key' => trim(preg_replace('/\xc2\xa0/', '', $c->cte_key))]);
//            $progressBar->advance();
//        }
//
//        $progressBar->finish();

        $ids = DB::table('contracts')->select('id')->orderBy('id')->get('id')->pluck('id');
        $progressBar = $this->output->createProgressBar($ids->count());
        $progressBar->start();
        foreach ($ids as $id){
            $c = Contract::with('items','items.moviment','items.moviment.invoices')->find($id);
            $c->updateItemValues();
            $progressBar->advance();
        }

        $progressBar->finish();
		$this->alert( 'Fix FINISHED ');
	}
}
