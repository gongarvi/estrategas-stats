<?php

namespace App\Http\Services;

use App\Exceptions\CustomException;
use App\Interfaces\GameRepositoryInterface;
use App\Models\Game;

class GameService
{

    public function __construct(private GameRepositoryInterface $gameRepository)
    {
    }

    /**
     * Get game stats
     * @return @return array<App\Models\Game>
     */
    public function getAllGames()
    {
        return $this->gameRepository->findAll();
    }

    /**
     * Get game stats
     * @param int game id
     */
    public function getGameStats($gameId)
    {
        $game = $this->gameRepository->findByIdDetailed($gameId);
        if ($game)
        {
            return $game;
        }
        return null;
    }


    public function store(String $name, String $edition): Game
    {
        $game = new Game(["name" => $name, "edition" => $edition]);
        if(!$game->save()){
            throw new CustomException("Error creating game", 500);
        }
        return $game;
    }
}