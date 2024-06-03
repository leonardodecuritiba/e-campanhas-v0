<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Jenssegers\Date\Date;

use Illuminate\Support\Facades\File;
class ExportDB extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:exportdb';

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
        $start = microtime(true);
        $name = strtolower(config('app.name').'-'.Date::now()->format('dmYHis'));
        $filename = storage_path('app' . DIRECTORY_SEPARATOR . $name);

        $cmd =
            "mysqldump -h " . config('database.connections.mysql.host').
            " -u "          . config('database.connections.mysql.username') .
            " -p\""         . config('database.connections.mysql.password')  . "\"" .
            " " . config('database.connections.mysql.database') ."  > ". $filename.".sql";
        $output = [];
        exec($cmd, $output);

        $cmd = "zip -j " . $filename . ".zip ".$filename.".sql";
        exec($cmd, $output);

        File::delete($filename.".sql");

        $file = [
            'filename' => $filename.".zip",
            'name' => $name,
            'mime' => 'text/x-sql',
        ];

        Mail::raw('BACKUP BANCO', function ($message) use ($file){
            $message->to(['silva.zanin@gmail.com'])
                ->subject(env('APP_NAME').' - Backup-' .Date::now()->toDateTimeString())
                ->attach($file['filename'], array(
                        'as' => $file['name'], // If you want you can chnage original name to custom name
                        'mime' => $file['mime'])
                );
        });
        $this->alert( 'Export FINISHED in ' . round((microtime(true) - $start), 3) . "s ***");

//        $tmppath = tempnam(sys_get_temp_dir(), $filename);
//        $handle = fopen($tmppath, "w");
//        fwrite($handle, implode($output, "\n"));
    }
}
