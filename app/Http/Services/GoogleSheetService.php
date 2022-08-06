<?php

namespace App\Http\Services;

use App\Constants\StadisticsRanges;
use App\Models\Country;
use Exception;
use Illuminate\Support\Facades\Storage;

class GoogleSheetService
{

    private \Google_Client $client;

    function __construct(){
        $this->client = new \Google\Client();
        putenv('GOOGLE_APPLICATION_CREDENTIALS=' . Storage::path("estrategasapi-f6d9d36edc2b.json"));
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
            if($file && $file->name !== "Master")
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

        $stadistics = array();
        foreach(StadisticsRanges::cases() as $case){
            $stadistics[$case->name()] = $this->getDataFromSpreadSheet($spreadsheetId,str_replace("{RANGE}",(8 + $alivePlayers), $case->range()));
        }
        $data["stadistics"] = (object) $stadistics;
        $data["tops"] = (object) $this->getTopsDataFromSpreadSheet($spreadsheetId);
        return (object) $data;
    }

    public function getCountries(string $spreadsheetId, string $range) : array {
        $service = new \Google\Service\Sheets($this->client);
        $response = $service->spreadsheets_values->get($spreadsheetId, $range)->getValues();
        if($response === null) return [];
        return array_map(function($item){
            try{
                return [
                    "tag"=>$item[0],
                    "name"=>$item[1],
                    "color"=>$item[2]
                ];
            }
            catch(Exception $e){
                return[
                    "tag"=>$item[0],
                    "name"=>$item[1],
                    "color"=>"#000"
                ];
            }
            
        }, $response);
    }

    public function getGameTitle(string $spreadsheetId) : string{
        $service = new \Google\Service\Sheets($this->client);
        $range = "Control!B3:D3";
        $response = $service->spreadsheets_values->get($spreadsheetId, $range)->getValues();
        if($response == null || count($response)>1 || count($response[0]) !== 3) return "";
        return $response[0][1] . " " . $response[0][2] . " - " . $response[0][0];
    }

    public function getYearFromSpreadSheet(string $spreadsheetId){
        $service = new \Google\Service\Sheets($this->client);
        $alivePlayersRange = "CONFIGURATION!B18";
        return $service->spreadsheets_values->get($spreadsheetId, $alivePlayersRange)->getValues()[0][0];;
    }

    private function getTopsDataFromSpreadSheet(string $spreadsheetId){
        $service = new \Google\Service\Sheets($this->client);
        $range = "Regla de TOPs!H2:H3";
        $response = $service->spreadsheets_values->get($spreadsheetId, $range)->getValues();
        return array("top"=>$response[0][0], "superTop"=>$response[1][0]);
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
            print("Ha fallado la obteción de datos");
            die();
        }
    }
    
    private function parseNumber(string $number):float{
        return (float) str_replace(",", ".",str_replace(".","",$number));
    }
}
