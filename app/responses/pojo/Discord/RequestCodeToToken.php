<?php
namespace App\responses\pojo\Discord;

use App\responses\Castable;

class RequestCodeToToken extends Castable{
    public string $access_token;
    public int $expires_in;
    public string $refresh_token;
    public string $scope;
    public string $token_type;

    function __construct($object)
    {
        $this->cast($object);
    }
}