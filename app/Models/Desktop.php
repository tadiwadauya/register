<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Desktop extends Model
{
    use SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'desktops';

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
        'deleted_at',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'assettag',
        'ram',
        'hdd',
        'antivirus',
        'os',
        'office',
        'has_monitor',
        'monitor_name',
        'monitor_serial',
        'has_keyboard',
        'keyboard_name',
        'keyboard_serial',
        'has_mouse',
        'mouse_name',
        'mouse_serial',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'                                => 'integer',
        'assettag'                              => 'string',
        'ram'                         => 'string',
        'hdd'                        => 'string',
        'antivirus'                         => 'string',
        'os'                             => 'string',
        'office'                        => 'string',
        'has_monitor'                        => 'boolean',
        'monitor_name'                        => 'string',
        'monitor_serial'                        => 'string',
        'has_keyboard'                        => 'boolean',
        'keyboard_name'                        => 'string',
        'keyboard_serial'                        => 'string',
        'has_mouse'                        => 'boolean',
        'mouse_name'                        => 'string',
        'mouse_serial'                        => 'string',
    ];

}
