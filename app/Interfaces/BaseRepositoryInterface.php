<?php

namespace App\Interfaces;

/**
 * @template T
 */
interface BaseRepositoryInterface
{
    /**
     * Return all the table content as an array of entities
     * @return array<T>
     */
    public function findAll();

    /**
     * find an entity by its id
     * @param V $id primary key of the entity
     * @return T entity
     */
    public function findById($id);

    /**
     * Delete an entity by its id
     * @param V $id primary key of the entity
     * @return bool entity is deleted
     */
    public function deleteById($id);
}