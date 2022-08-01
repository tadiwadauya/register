<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Zamaccount extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'zamaccounts';

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
        'user',
        'email',
        'password',
        'prev_password',
        'last_agent',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'                                => 'integer',
        'user'                         => 'string',
        'email'                         => 'string',
        'password'                         => 'string',
        'prev_password'                         => 'string',
        'last_agent'                         => 'string',
    ];
}
