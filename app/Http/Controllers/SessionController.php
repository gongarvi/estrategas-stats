<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewSessionRequest;
use App\Http\Services\SessionService;
use Illuminate\Support\Facades\Bus;

class SessionController extends Controller
{

    public function __construct(
        private SessionService $sessionService)
        {
    }
    
    /**
     * Create new game
     * @param integer $game
     * @param NewSessionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(int $game, NewSessionRequest $newSessionRequest)
    {
        $file = $newSessionRequest->safe()->only("file");

        return $this->successResponse($this->sessionService->processFile($game, $file["file"]));
    }

    public function batch()
    {
        return $this->successResponse(Bus::findBatch(request("id")));
    }
}