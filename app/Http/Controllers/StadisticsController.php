<?php

namespace App\Http\Controllers;

use App\Constants\Constants;
use App\Http\Services\GoogleSheetService;
use App\Http\Services\StadisticsService;
use App\Http\Services\UserService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class StadisticsController extends Controller
{

    function __construct(
        private UserService $userService,
        private GoogleSheetService $google){
    }

    function reIndex(Request $request){
        //Si nos viene code logeamos
        $query = $request->query();
        $user = null;
        if(array_key_exists("code", $query)){
            $user = $this->userService->login($request->input("code"));
            Auth::login($user);
        }
        //Si encontramos el token en la session obtenemos el usuario
        else if($request->session()->has("token")){
            $user = $this->userService->getUser($request->session()->get("id"));
        }

        $view = view('pages.index')->with("discordLogin", Constants::$DISCORD_OAUTH);

        if($user != null){
            $data = $this->google->getSharedFiles();
            $view->with('data', $data);
        }
        return $view;
    }

    function save(string $id){
        $data = $this->google->getAllDataFromSpreadSheet($id);
        $title = $this->google->getGameTitle($id);
        $year = $this->google->getYearFromSpreadSheet($id);
        return view('pages.save')->with('data', $data)->with('title', $title)->with('year', $year);
    }

}