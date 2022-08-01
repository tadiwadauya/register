<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Nicolaslopezj\Searchable\SearchableTrait;

class Asset extends Model
{
    use SoftDeletes;
    use SearchableTrait;

    protected $searchable = [
        'columns' => [
            'users.first_name' => 10,
            'users.last_name' => 10,
            'users.paynumber' => 10,
            'assets.username' => 5,
            'assets.model' => 10,
            'assets.assettag' => 10,
            'assets.serial' => 10,
        ],
        'joins' => [
            'users' => ['users.paynumber','assets.username'],
        ],
    ];
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'assets';

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
        'username',
        'model',
        'type',
        'assettag',
        'serial',
        'age',
        'purchased',
        'notes',
        'warranty',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'                                => 'integer',
        'username'                              => 'string',
        'model'                         => 'string',
        'type'                        => 'string',
        'assettag'                         => 'string',
        'serial'                             => 'string',
        'age'                        => 'string',
        'purchased'                          => 'date',
        'notes'                            => 'text',
        'warranty'                  => 'string',
    ];

    /**
     * Get the socials for the user.
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'paynumber', 'username');
    }

}
