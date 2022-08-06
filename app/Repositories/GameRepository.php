<?php

namespace App\Repositories;

use App\Interfaces\GameRepositoryInterface;
use App\Models\Game;
use Illuminate\Support\Facades\DB;

class GameRepository implements GameRepositoryInterface
{
    public function findAll()
    {
        return Game::all();
    }

    public function findById($id)
    {
        return Game::find($id);
    }

    public function findByIdDetailed($id)
    {
        return Game::with("sessions.sessionHistorics.data")->find($id);
    }

    public function deleteById($id)
    {
        return $this->findById($id)->delete();
    }

    public function findByName($name)
    {
        return Game::where("name", $name);
    }
}