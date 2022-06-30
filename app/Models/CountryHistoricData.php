<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int   $buildings_value
 * @property int   $development_clicks
 * @property int   $provinces
 * @property float $naval_strength
 * @property float $quality_score
 * @property float $spent_on_advisors
 * @property float $development_average_cost
 * @property float $weighted_avg_monarch
 * @property float $overall_strength
 * @property float $overall_strength_with_subjects
 * @property float $income
 * @property float $max_manpower
 * @property float $innovativeness
 * @property float $professionalism
 * @property float $development
 * @property float $force_limit
 * @property float $development_ratio
 * @property float $total_spent
 * @property float $manpower_recovery
 * @property float $absolutism
 * @property float $army_strength
 */
class CountryHistoricData extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'country_historic_data';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'buildings_value', 'naval_strength', 'quality_score', 'spent_on_advisors', 'development_average_cost', 'development_clicks', 'weighted_avg_monarch', 'overall_strength', 'overall_strength_with_subjects', 'income', 'max_manpower', 'innovativeness', 'professionalism', 'development', 'force_limit', 'development_ratio', 'total_spent', 'manpower_recovery', 'provinces', 'absolutism', 'army_strength'
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
        'buildings_value' => 'int', 'naval_strength' => 'double', 'quality_score' => 'double', 'spent_on_advisors' => 'double', 'development_average_cost' => 'double', 'development_clicks' => 'int', 'weighted_avg_monarch' => 'double', 'overall_strength' => 'double', 'overall_strength_with_subjects' => 'double', 'income' => 'double', 'max_manpower' => 'double', 'innovativeness' => 'double', 'professionalism' => 'double', 'development' => 'double', 'force_limit' => 'double', 'development_ratio' => 'double', 'total_spent' => 'double', 'manpower_recovery' => 'double', 'provinces' => 'int', 'absolutism' => 'double', 'army_strength' => 'double'
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
