<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Jobs\SendNewsletter;
use App\Models\Clinet;

class MailCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send';

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
     * @return int
     */
    public function handle()
    {
        $clinet = Clinet::all();
        for($i=0;$i<count($clinet);$i++)
        {
            $details['name'] = $clinet[$i]['name'];
            $details['email'] = $clinet[$i]['email'];
        
            dispatch(new SendNewsletter($details));
        }
        return 'all sent';
    }
}
