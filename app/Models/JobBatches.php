<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string $id
 * @property string $name
 * @property string $failed_job_ids
 * @property string $options
 * @property int    $total_jobs
 * @property int    $pending_jobs
 * @property int    $failed_jobs
 * @property int    $cancelled_at
 * @property int    $created_at
 * @property int    $finished_at
 */
class JobBatches extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'job_batches';

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
        'name', 'total_jobs', 'pending_jobs', 'failed_jobs', 'failed_job_ids', 'options', 'cancelled_at', 'created_at', 'finished_at'
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
        'id' => 'string', 'name' => 'string', 'total_jobs' => 'int', 'pending_jobs' => 'int', 'failed_jobs' => 'int', 'failed_job_ids' => 'string', 'options' => 'string', 'cancelled_at' => 'int', 'created_at' => 'int', 'finished_at' => 'int'
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
