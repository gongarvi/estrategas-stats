<?php

namespace App\Models;

class Country
{

    public string $playerName;
    public string $countryName;
    public float $totalValue;
    public float $incrementedValue;
    public string $incrementedPercentage;
    public int $position;

    function __construct(
        string $playerName,
        string $countryName,
        float $totalValue,
        float $incrementedValue,
        string $incrementedPercentage,
        int $position)
    {
        try{
            $this->playerName = $playerName;
            $this->countryName = $countryName;
            $this->totalValue = $totalValue;
            $this->incrementedValue = $incrementedValue;
            $this->incrementedPercentage = $incrementedPercentage;
            $this->position = $position;
        }
        catch(\Exception $e){
            var_dump($playerName . $countryName);
            die();
        }
    }
}
?>