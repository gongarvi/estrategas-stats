<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int    $session
 * @property string $country_tag
 * @property string $overlord
 */
class GameSession extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'game_session';

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
        'session' => 'int', 'country_tag' => 'string', 'overlord' => 'string'
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
    public $timestamps = true;

    // Scopes...

    // Functions ...

    // Relations ...

    public function countryData()
    {
        return $this->belongsTo(CountryHistoricData::class);
    }
}
