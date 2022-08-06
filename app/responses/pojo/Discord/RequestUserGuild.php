<?php
namespace App\responses\pojo\Discord;

use App\responses\Castable;

class RequestUserGuild extends Castable{
    public string $id;
    public string $name;
    public string $icon;
    public bool $owner;
    public string $permissions;
    public array $features;

    function __construct($object)
    {
        $this->cast($object);
    }
}