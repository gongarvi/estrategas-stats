<?php

namespace App\responses;

use stdClass;

interface ICastable{
    public function cast($object);    
}
class Castable implements ICastable{
    public function cast($object){
        if (is_array($object) || is_object($object)) {
            foreach ($object as $key => $value) {
                if($value instanceof stdClass){
                    $this->key = $this->cast($value);
                }else{
                    $this->$key = $value;
                }
            }
        }
    }
}