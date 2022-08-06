<?php

namespace App\Http\Controllers;

use App\Http\Services\DiscordService;

class AuthController extends Controller
{

    private DiscordService $discordService;

    function __construct()
    {
        $this->discordService = new DiscordService();
    }
}