<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Site;

class SiteListCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'observatory:site:list';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'List all sites';

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
        $fields = ['id', 'name', 'url'];
        $sites = Site::all($fields);
        $this->table($fields, $sites);
    }
}
