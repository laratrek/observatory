<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Site;
use App\SitePing;

class PingCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'observatory:ping';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Ping all sites';

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
        Site::orderBy('id')->chunk(100, function ($sites) {
            foreach ($sites as $site) {
                $context = [
                    'http' => [
                        'method'  => 'HEAD',
                        'timeout' => 10.0,
                        'ignore_errors' => true,
                    ]
                ];
                $timeBegin = microtime(true);
                $result = @file_get_contents($site->url, false, stream_context_create($context));
                $timeEnd = microtime(true);
                if ($result === false) {
                    $statusCode = 0;
                } elseif (!empty($http_response_header)) {
                    foreach ($http_response_header as $line) {
                        if (preg_match('/^HTTP\/[^\s]+\s([0-9]+)/', $line, $match)) {
                            $statusCode = $match[1];
                        }
                    }
                }

                SitePing::create([
                    'site_id' => $site->id,
                    'took' => ceil(($timeEnd - $timeBegin) * 1000),
                    'status_code' => $statusCode,
                ]);
            }
        });
    }
}
