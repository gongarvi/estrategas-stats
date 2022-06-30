<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string $tag
 * @property string $name
 * @property string $color
 * @property int    $created_at
 * @property int    $updated_at
 */
class Country extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'country';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'tag';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'color', 'created_at', 'updated_at'
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
        'tag' => 'string', 'name' => 'string', 'color' => 'string', 'created_at' => 'timestamp', 'updated_at' => 'timestamp'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at', 'updated_at'
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
