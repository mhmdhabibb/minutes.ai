<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ViewLogs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'logs:view';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Display the contents of the Laravel log file';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $path = storage_path('logs/laravel.log');

        if (!file_exists($path)) {
            $this->error("Log file not found at: $path");
            return;
        }

        $this->info(file_get_contents($path));
    }
}
