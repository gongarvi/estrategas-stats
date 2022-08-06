<?php

namespace App\Exceptions;

use Exception;

class CustomException extends Exception
{


    public function __construct(private $data, private $errorCode)
    {
        
    }

    public function getData()
    {
        return $this->data;
    }

    public function getErrorCode()
    {
        return $this->errorCode;
    }
}
