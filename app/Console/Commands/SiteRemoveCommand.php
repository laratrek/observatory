<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Site;

class SiteRemoveCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'observatory:site:remove {site_id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remove specified site by id';

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
        $site = Site::select($fields)->where('id', $this->argument('site_id'))->firstOrFail();
        $this->table($fields, [$site->toArray()]);
        if ($this->confirm('Are you sure to remove this site and related data?')) {
            $site->delete();
            $this->line('It has been succesfully removed.');
        } else {
            $this->line('Aborted.');
        }
    }
}
