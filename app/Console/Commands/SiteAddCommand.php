<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Site;

class SiteAddCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'observatory:site:add {url} {name?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add site';

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
        Site::create([
            'url' => $this->argument('url'),
            'name' => $this->argument('name'),
       ]);
    }
}
