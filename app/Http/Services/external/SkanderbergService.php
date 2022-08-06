<?php

namespace App\Http\Services\external;

use App\Interfaces\GameRepositoryInterface;
use App\Interfaces\GameSessionRepositoryInterface;
use App\Models\Session;

class SkanderbergService{

    private \GuzzleHttp\Client $http;

    function __construct()
    {
        $this->http = new \GuzzleHttp\Client(["base_uri"=>"https://skanderbeg.pm/api.php"]);
    }
    /**
     * Get all data from a session
     * @param string $skan_session_id
     * @param string $skan_user_id
     * @return array
     */
    public function getAllData($skan_session_id, $skan_user_id){
        $endpoint = "?key={key}&scope=getSaveDataDump&save={save}&type=countriesData";
        
        $endpoint = str_replace("{save}", $skan_session_id, str_replace("{key}",$skan_user_id, $endpoint));
        $response = $this->http->request("GET", $endpoint); 
        if($response->getStatusCode() === 200){
            return json_decode($response->getBody()->getContents(), true);
        }
        return [];
    }


}