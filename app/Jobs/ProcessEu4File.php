<?php

namespace App\Jobs;

use App\Constants\Constants;
use App\Exceptions\CustomException;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Process\Process;

class ProcessEu4File implements ShouldQueue
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
        private $filePath,
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
    public function handle()
    {
        if ($this->batch()->cancelled()) {
            return;
        }

        //TODO Rellenar con los países
        $eu4StoragePath = storage_path("app\\public\\eu4-files");
        Log::debug("Save parsing start");
        $process = new Process([
            "python",
            "$eu4StoragePath\\index.py",
            "-sfd",
            $this->filePath,
            "-jfd",
            $this->jsonPath
        ],
        env: [
            'SYSTEMROOT' => getenv('SYSTEMROOT'),
            'PATH' => getenv("PATH")
        ]);

        Log::debug($process->getCommandLine());
        $process->setTimeout(Constants::$FIVE_MINUTES_SECONDS);
        $process->run();
        if (!$process->isSuccessful()) {
            Log::error("Save parsing error");
            var_dump($process->getErrorOutput());
            throw new CustomException($process->getErrorOutput(), 500);
        }
        Log::error("Save parsing successfull");
        Log::debug($process->getOutput());
    }
}
