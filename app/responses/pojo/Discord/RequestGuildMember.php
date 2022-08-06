<?php
namespace App\responses\pojo\Discord;

use App\responses\Castable;

class RequestGuildMember extends Castable{

    /**
     * @var array<Role>
     */
    public $roles;

    function __construct($object)
    {
        $this->cast($object);
    }
}

class Role{
    public int $id;
    public string $name;
    public string $color;
}