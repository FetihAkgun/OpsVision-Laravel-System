<?php

namespace App\Console\Commands;

use App\Services\ApiService;
use Illuminate\Console\Command;

class CheckServicesStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'services:check-status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check the status of all active services';

    /**
     * Execute the console command.
     */
    public function handle(ApiService $apiService)
    {
        $this->info('Starting service status check...');
        
        try {
            $apiService->checkAllServices();
            $this->info('All services checked successfully.');
        } catch (\Exception $e) {
            $this->error('Error checking services: ' . $e->getMessage());
        }
        
        return Command::SUCCESS;
    }
}
