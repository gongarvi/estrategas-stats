<?php

namespace App\Http\Controllers;

use App\Http\Services\GameService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GameController extends Controller
{

    public function __construct(private GameService $gameService)
    {
    }
    /**
     * Get all games from data base
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json($this->gameService->getAllGames());
    }

    /**
     * Show the details of the game.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        if ($id) {
            return $this->successResponse($this->gameService->getGameStats($id));
        }
        return $this->errorResponse("Game id must be provided", 400);
    }

    /**
     * Create new game
     * @param \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->toArray(), [
            "name" => "required",
            "edition" => "required"
        ]);
        
        if ($validator->failed()) {
            return $this->errorResponse("Game storing failed", 400);
        }

        return $this->successResponse(
            $this->gameService->store($request->input("name"), $request->input("edition")),
            "Game stored",
            200
        );
    }
}