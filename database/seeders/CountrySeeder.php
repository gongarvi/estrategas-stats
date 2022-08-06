<?php

namespace Database\Seeders;

use App\Http\Services\GoogleSheetService;
use App\Models\Country;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountrySeeder extends Seeder
{
    private GoogleSheetService $google;

    function __construct()
    {
        $this->google = new GoogleSheetService();    
    }
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('country')->delete();

        //Custom Nations
        for($i = 0; $i < 75; $i++){
            Country::create(
                [
                    "tag"=> sprintf("D%02d",$i),
                    "name" => sprintf("Custom nation %02d",($i+1))
                ]
            );
        }
        
        //Colonies
        for($i = 0; $i < 75; $i++){
            Country::create(
                [
                    "tag"=> sprintf("C%02d",$i),
                    "name" => sprintf("Colonie %02d",($i+1)),
                    "created_at" => Carbon::now()->getTimestamp(),
                    "updated_at" => Carbon::now()->getTimestamp()
                ]
            );
        }

        //Client States
        for($i = 0; $i < 100; $i++){
            Country::create(
                [
                    "tag"=> sprintf("K%02d",$i),
                    "name" => sprintf("Client State %02d",($i+1)),
                ]
            );
        }

        //Estate disaster
        for($i = 0; $i < 50; $i++){
            Country::create(
                [
                    "tag"=> sprintf("E%02d",$i),
                    "name" => sprintf("Estate Disaster %02d",($i+1))
                ]
            );
        }

        //Federation countries
        for($i = 0; $i < 20; $i++){
            Country::create(
                [
                    "tag"=> sprintf("F%02d",$i),
                    "name" => sprintf("Federation Country %02d",($i+1)),
                ]
            );
        }

        //TradingCities
        for($i = 0; $i < 75; $i++){
            Country::create(
                [
                    "tag"=> sprintf("T%02d",$i),
                    "name" => sprintf("Trading City %02d",($i+1))
                ]
            );
        }

        //Original countries
        $countries = $this->google->getCountries("1m2Hkn08YLat0QpDpP8XseIC3r1fJb4VNd7Lk8IvB0dc", "Control!O3:Q858");
        foreach($countries as $country){
            Country::create($country);
        }
    }
}
