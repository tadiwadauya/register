<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Backup extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'backups';

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
        'username',
        'department',
        'ip_address',
        'ip_block',
        'date',
        'user_sign',
        'comment',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'           => 'integer',
        'username'     => 'string',
        'department'     => 'string',
        'ip_address'          => 'string',
        'ip_block'          => 'text',
        'date'           => 'date',
        'user_sign'       => 'string',
        'comment'       => 'string',
    ];
}
