<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int    $session
 * @property int    $development_clicks
 * @property string $country_tag
 * @property float  $discipline
 * @property float  $discipline_constant
 * @property float  $effective_discipline
 * @property float  $morale
 * @property float  $morale_constant
 * @property float  $effective_morale
 * @property float  $infantry_power
 * @property float  $cavalry_power
 * @property float  $artillery_power
 * @property float  $force_limit
 * @property float  $max_manpower
 * @property float  $manpower_recovery
 * @property float  $income
 */
class CountryHistoricData extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'country_historic_data';


    protected $primaryKey = ['game_id', 'session', 'country_tag'];
    public $incrementing = false;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'game_id', 'session', 'country_tag'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'session' => 'int', 'country_tag' => 'string', 'discipline' => 'double', 'discipline_constant' => 'double', 'effective_discipline' => 'double', 'morale' => 'double', 'morale_constant' => 'double', 'effective_morale' => 'double', 'infantry_power' => 'double', 'cavalry_power' => 'double', 'artillery_power' => 'double', 'force_limit' => 'double', 'max_manpower' => 'double', 'manpower_recovery' => 'double', 'development_clicks' => 'int', 'income' => 'double'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var boolean
     */
    public $timestamps = false;

    // Scopes...

    // Functions ...

    // Relations ...
}
