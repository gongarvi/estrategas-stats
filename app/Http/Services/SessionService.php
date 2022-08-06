<?php

namespace App\Http\Services;

use Exception;
use App\Exceptions\CustomException;
use App\Http\Services\external\SkanderbergService;
use App\Interfaces\CountryRepositoryInterface;
use App\Interfaces\GameRepositoryInterface;
use App\Interfaces\SessionRepositoryInterface;
use App\Jobs\PostProcessEu4File;
use App\Jobs\ProcessEu4File;
use App\Models\CountryHistoricData;
use App\Models\GameSession;
use Illuminate\Bus\Batch;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use ZipArchive;

class SessionService{

    public function __construct(
        private GameRepositoryInterface $gameRepository,
        private SessionRepositoryInterface $sessionRepository,
        private CountryRepositoryInterface $countryRepository,
        private SkanderbergService $skanderbergService
    ){
    }

    /**
     * It starts a process to read eu4 file
     * @param int $game_id
     * @param UploadedFile $file
     * @return Batch
     */
    public function processFile($gameId, $file)
    {
        $game = $this->gameRepository->findById($gameId);
        if (empty($game)) {
            throw new CustomException("Game not found", 404);
        }

        $sessionNumber = $game->sessions()->count()+1;
        $fileName = $game->name . '-'. $sessionNumber;
        Storage::disk('eu4-files')->put(($fileName . ".zip"), $file->get());
        Storage::disk('eu4-files')->makeDirectory($fileName);
        $eu4StoragePath = storage_path("app\\public\\eu4-files");

        $zip = new ZipArchive();
        $res = $zip->open("$eu4StoragePath\\$fileName.zip");

        if ($res === TRUE) {
            $zip->extractTo("$eu4StoragePath\\$fileName");
            $zip->close();
        } else {
            throw new CustomException("Error parsing zip", 500);
        }
        

        $files = Storage::disk("eu4-files")->files($fileName);
        if (count($files) != 1)
        {
            throw new CustomException("Too much saves founded", 404);
        }
        Storage::disk("eu4-files")->delete(($fileName . ".zip"));
        Storage::disk("eu4-files")->move(($files[0]), "saves\\$fileName.eu4");
        Storage::disk("eu4-files")->deleteDirectory($fileName);
        Storage::disk('eu4-files')->put("save_result\\$fileName.json", '');

        $batch = Bus::batch([
            new ProcessEu4File(
                "$eu4StoragePath\\saves\\$fileName.eu4",
                "$eu4StoragePath\\save_result\\$fileName.json",
                $gameId,
                $sessionNumber
            ),
            new PostProcessEu4File(
                "save_result\\$fileName.json",
                $gameId,
                $sessionNumber
                )
            ])->dispatch();

        return $batch->id;
    }

    /**
     * Creates new session for the game, and loads countries data
     * @param int $game_id
     * @param int $sessionNumber
     * @param Array $countriesData
     */
    public function newSession($gameId, $sessionNumber, $countriesData)
    {
        $game = $this->gameRepository->findById($gameId);
        if (empty($game)) {
            throw new CustomException("Game not found", 404);
        }

        DB::beginTransaction();
        try {
            foreach ($countriesData as $key => $data) {
                $session = new GameSession([
                    "session" => $sessionNumber,
                    "country_tag" => $key,
                    "game_id" => $game->id
                ]);
                if (array_key_exists("overlord", $data)) {
                    $session->overlord = $data["overlord"];
                }
                if (!$session->save()) {
                    throw new CustomException("Error creating save for: $key in game $game->name", 500);
                }

                $countryData = new CountryHistoricData([
                    "session" => $sessionNumber,
                    "country_tag" => $key,
                    "game_id" => $game->id
                ]);

                if(array_key_exists("monthly_income_var", $data)){
                    $countryData->income = $data["monthly_income_var"];
                }
                $countryData->save();
            }
            DB::commit();
        }catch (Exception $e) {
            DB::rollback();
            throw $e;
        }
    }
}