<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Maintenance extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'maintenances';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'id',
    ];

    /**
     * The attributes that are hidden.
     *
     * @var array
     */
    protected $hidden = [
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'agent',
        'ip_address',
        'username',
        'department',
        'all_five',
        'monitor',
        'cpu',
        'keyboard',
        'mouse',
        'desk',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'           => 'integer',
        'agent'     => 'string',
        'ip_address'     => 'string',
        'username'          => 'string',
        'department'          => 'string',
        'all_five'           => 'boolean',
        'monitor'       => 'boolean',
        'cpu'       => 'boolean',
        'keyboard'       => 'boolean',
        'mouse'       => 'boolean',
        'desk'       => 'boolean',
    ];
}
