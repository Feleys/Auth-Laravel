<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Library\CollectHelper;

class CollectData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'collect:data';

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
     */
    public function handle()
    {
        $CollectHelper = new CollectHelper();
        $CollectHelper->init();
        $this->info('Collect successfully!');
    }
}
