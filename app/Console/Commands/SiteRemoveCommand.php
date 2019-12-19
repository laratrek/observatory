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
        $site = Site::select('id', 'name', 'url')->where('id', $this->argument('site_id'))->firstOrFail();
        $fields = ['id', 'name', 'url'];
        $this->table(collect($site), $fields);
        if ($this->confirm('Are you sure to remove this site and related data?')) {
            $site->destroy();
            $this->line('It has been succesfully removed.');
        } else {
            $this->line('Aborted.');
        }
    }
}
