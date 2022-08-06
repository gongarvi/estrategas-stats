<?php

namespace App\Interfaces;

use App\Models\Session;

interface SessionRepositoryInterface extends BaseRepositoryInterface
{

    /**
     * Return all the table content as an array of entities
     * @return array<Session> returns all games
     */
    public function findAll();

    /**
     * Fnd an entity by its id
     * @param int $id primary key of the entity
     * @return Session|null returns null if game not found or the model
     */
    public function findById($id);

    /**
     * Delete an entity by its id
     * @param string $id primary key of the entity
     * @return bool entity is deleted
     */
    public function deleteById($id);
}