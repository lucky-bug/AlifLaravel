<?php

namespace App\Console\Commands;

use App\Http\Services\AlifService;
use Illuminate\Console\Command;

class AlifCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'alif:solve {inputFilePath} {operation}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * @var AlifService
     */
    private $alifService;

    /**
     * Create a new command instance.
     *
     * @param AlifService $alifService
     */
    public function __construct(AlifService $alifService)
    {
        parent::__construct();

        $this->alifService = $alifService;
    }

    /**
     * Execute the console command.
     *
     * @param string $inputFilePath
     * @param string $operation
     * @return mixed
     */
    public function handle()
    {
        $results = $this->alifService->solve($this->argument("inputFilePath"), $this->argument("operation"));
        $negativeResults = $results['negative'];
        $positiveResults = $results['positive'];

        $this->info("Negative Results:");

        foreach ($negativeResults as $result) {
            $this->info($result);
        }

        $this->info("Positive Results:");

        foreach ($positiveResults as $result) {
            $this->info($result);
        }
    }
}
