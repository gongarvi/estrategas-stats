<?php

namespace App\Repositories;

use App\Interfaces\SessionRepositoryInterface;
use App\Models\Session;

class SessionRepository implements SessionRepositoryInterface{

    public function findAll(){
        return Session::all();
    }

    public function findById($id){
        return Session::find($id);
    }

    public function deleteById($id){
        return $this->findById($id)->delete();
    }
}