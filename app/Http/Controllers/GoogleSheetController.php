<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Exception;
use Google\Service\Sheets\Spreadsheet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use StadisticsRanges;

class GoogleSheetController extends Controller
{

    private \Google_Client $client;

    function __construct(){
        $this->client = new \Google\Client();
        putenv('GOOGLE_APPLICATION_CREDENTIALS=' .Storage::path("estrategasapi-f6d9d36edc2b.json"));
        $this->client->setAuthConfig(Storage::path("estrategasapi-f6d9d36edc2b.json"));
        $this->client->setApplicationName("Estrategas Calulator");
        $this->client->setScopes([\Google\Service\Sheets::SPREADSHEETS, \Google\Service\Drive::DRIVE]);
    }

    function getSharedFiles() {
        $service = new \Google\Service\Drive($this->client);
        $optParams = [
            'pageSize'=>10,
            'fields'=>'nextPageToken, files(id, name)',
            'q' => "mimeType='application/vnd.google-apps.spreadsheet'"
        ];
        $files = $service->files->listFiles($optParams)->getFiles();
        
        $fileNames = array();
        foreach($files as $file){
            $fileNames[] = (object) array(
                "name" => $file->name,
                "key" => $file->id
            );
        }
        return (object) $fileNames;
    }

    function getAllDataFromSpreadSheet(string $spreadsheetId){
        $service = new \Google\Service\Sheets($this->client);
        $alivePlayersRange = "Control!D14";
        $alivePlayers = $service->spreadsheets_values->get($spreadsheetId, $alivePlayersRange)->getValues()[0][0];

        $data["year"] = $this->getYearFromSpreadSheet($spreadsheetId);

        $stadistics = array();
        foreach(StadisticsRanges::cases() as $case){
            $stadistics[$case->name()] = $this->getDataFromSpreadSheet($spreadsheetId,str_replace("{RANGE}",(8 + $alivePlayers), $case->range()));
        }
        $data["stadistics"] = (object) $stadistics;
        return (object) $data;
    }

    function getYearFromSpreadSheet(string $spreadsheetId){
        $service = new \Google\Service\Sheets($this->client);
        $alivePlayersRange = "CONFIGURATION!B18";
        $year = $service->spreadsheets_values->get($spreadsheetId, $alivePlayersRange)->getValues()[0][0];
        return $year;
    }

    private function getDataFromSpreadSheet(string $spreadsheetId, string $range){
        try{
            $service = new \Google\Service\Sheets($this->client);
            $values = $service->spreadsheets_values->get($spreadsheetId, $range)->getValues();
            if(empty($values)) return array();
            $parsedValues = array();
            foreach($values as $value){
                $parsedValues[] = new Country($value[4],$value[5],$this->parseNumber($value[6]),$this->parseNumber($value[7]),$value[8],$value[2]);
            }
            return $parsedValues;
        }
        catch(\Exception $exception){
            var_dump($range);
            die();
        }
    }
    
    private function parseNumber(string $number):float{
        return (float) str_replace(",", ".",str_replace(".","",$number));
    }
}
