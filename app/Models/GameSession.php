<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string $skan_game_id
 * @property string $skan_user_token
 */
class GameSession extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'game_session';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'skan_game_id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'game_uuid', 'session', 'skan_user_token'
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
        'skan_game_id' => 'string', 'skan_user_token' => 'string'
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
}
