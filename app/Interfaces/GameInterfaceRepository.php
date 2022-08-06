<?php

namespace App\Interfaces;

use App\Models\Game;

interface GameRepositoryInterface extends BaseRepositoryInterface
{

    /**
     * Return all the table content as an array of entities
     * @return array<Game> returns all games
     */
    public function findAll();

    /**
     * Fnd an entity by its id
     * @param int $id primary key of the entity
     * @return Game|null returns null if game not found or the model
     */
    public function findById($id);

    /**
     * Find an entity by its id egearly
     * @param int $id primary key of the entity
     * @return Game|null returns null if game not found or the model
     */
    public function findByIdDetailed($id);

    /**
     * Delete an entity by its id
     * @param string $id primary key of the entity
     * @return bool entity is deleted
     */
    public function deleteById($id);

    /**
     * Returns a game based on a name
     * @param string $name Name of the game
     * @return array<Game> returns Game entity
     */
    public function findByName($name);

    
}