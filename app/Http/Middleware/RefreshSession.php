<?php

namespace App\Http\Middleware;

use App\Constants\Constants;
use App\Http\Services\DiscordService;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

use Closure;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RefreshSession
{

    private DiscordService $discordService;

    function __construct()
    {
        $this->discordService = new DiscordService();
    }

    public function handle(Request $request, Closure $next)
    {
        if($request->session()->exists("token")){
            $expires_in = intval($request->session()->get("expires_in"));
            $current_timestamp = now()->getTimestamp();
            $difference = $expires_in - $current_timestamp;
            if($difference < 0){
                $request->session()->flush();
                Auth::logout();
                $next($request);
            }
            else if($difference <= Constants::$DISCORD_REFRESH_TOKEN_TIME){
                var_dump($request->session()->all());
                die();
                $response = $this->discordService->refreshToken($request->session()->get("refresh_token"));
                $request->session()->put("token", $response->access_token);
                $request->session()->put("refresh_token", $response->refresh_token);
                $request->session()->put("expires_in", $response->expires_in);
                $request->session()->put("token_type", $response->token_type);
            }
        }
        return $next($request);
    }
}
