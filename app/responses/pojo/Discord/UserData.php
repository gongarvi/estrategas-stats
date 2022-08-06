<?php
namespace App\responses\pojo\Discord;

use App\responses\Castable;

class UserData extends Castable{
    public string $id;
    public string $username;
    public string $avatar;
    public string $locale;

    function __construct($object)
    {
        $this->cast($object);
    }
}