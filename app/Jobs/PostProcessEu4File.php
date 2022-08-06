<?php

namespace App\Jobs;

use App\Constants\Constants;
use App\Exceptions\CustomException;
use App\Http\Services\SessionService;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Process\Process;

class PostProcessEu4File implements ShouldQueue
{
    use Batchable, Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The number of seconds the job can run before timing out.
     *
     * @var int
     */
    public $timeout = 120;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(
        private $jsonPath,
        private $gameId,
        private $sessionNumber,
        private $countries = null
        )
    {
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(SessionService $sessionService)
    {
        if ($this->batch()->cancelled()) {
            return;
        }
        $countryData = Storage::disk('eu4-files')->get($this->jsonPath);
        if (empty($countryData)) {
            throw new CustomException("No data found on JSON file $this->jsonPath", 500);
        }
        $countryData = json_decode($countryData, true);
        $sessionService->newSession($this->gameId, $this->sessionNumber, $countryData);
    }
}
