<?php

namespace App\Http\Services;

use App\Models\User;
use Illuminate\Support\Facades\Session;

class UserService{

    private DiscordService $discordService;

    function __construct(){
        $this->discordService = new DiscordService();
    }

    public function login(string $code): User | null{
        //Cambiamos el codigo a token
        $response = $this->discordService->changeCodeToToken($code);
        Session::put("token", $response->access_token);
        Session::put("expires_in", (now()->getTimestamp() + $response->expires_in));
        Session::put("refresh_token", $response->refresh_token);
        Session::put("token_type", $response->token_type);
        $authorization = $response->token_type . " " . $response->access_token;
        //Obtenemos los datos del usuario
        $userResponse = $this->discordService->getUserData($authorization);
        Session::put("id", $userResponse->id);
        //comprobamos que el usuario existe
        $user = User::find($userResponse->id);
        if($user == null){
            $user = new User([
                "id" => $userResponse->id,
                "name" => $userResponse->username,
                "user_banner" => $userResponse->avatar,
                "admin" => false
            ]);
            $user->save();
        }

        return $user;
    }
    
    public function getUser(int $userId): User |null{
        $user = User::find($userId);
        if($user == null){
            Session::flush();
        }
        return $user;
    }
}