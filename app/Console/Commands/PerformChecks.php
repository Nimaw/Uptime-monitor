<?php

namespace App\Console\Commands;

use App\Jobs\PerformEndpointCheck;
use App\Models\Endpoint;
use Illuminate\Console\Command;
use Illuminate\Log\Logger;

class PerformChecks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'checks:perform';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Perform endpoint checks';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $enpdoints = Endpoint::where('next_check', '<=', now())
            ->each(function ($enpdoint) {
                PerformEndpointCheck::dispatch($enpdoint);
            });

        return Command::SUCCESS;
    }
}
