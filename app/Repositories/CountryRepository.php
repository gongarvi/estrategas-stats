<?php

namespace App\Repositories;

use App\Interfaces\CountryRepositoryInterface;
use App\Models\Country;

class CountryRepository implements CountryRepositoryInterface{
    public function findAll(){
        return Country::all();
    }

    public function findById($id){
        return Country::find($id);
    }

    public function deleteById($id){
        return $this->findById($id)->delete();
    }
}