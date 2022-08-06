<?php

namespace Database\Seeders;

use App\Http\Services\DiscordService;
use App\Http\Services\GoogleSheetService;
use App\Models\Country;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountrySeeder extends Seeder
{
    private DiscordService $google;

    function __construct()
    {
        $this->google = new DiscordService();
    }
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        
    }
}
