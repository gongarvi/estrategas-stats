<?php

namespace App\Interfaces;

use App\Models\Country;

interface CountryRepositoryInterface extends BaseRepositoryInterface
{

    /**
     * Return all the table content as an array of entities
     * @return array<Country> returns all games
     */
    public function findAll();

    /**
     * Fnd an entity by its id
     * @param string $id primary key of the entity
     * @return Country|null returns null if game not found or the model
     */
    public function findById($id);

    /**
     * Delete an entity by its id
     * @param string $id primary key of the entity
     * @return bool entity is deleted
     */
    public function deleteById($id);
}