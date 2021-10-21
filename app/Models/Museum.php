<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Spatie\Tags\HasTags;

class Museum extends Model
{
    use HasFactory, HasTags, SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'museums';
    protected $primaryKey = 'uuid';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        //'uuid' => 'uuid',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'deleted_at',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
        'laravel_through_key',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uuid',
        'slug',
        'name',
        'type',
        'status',
        'address',
        'city',
        'country_cca3',
        'lat',
        'lon',
        'link',
    ];

    /**
     * Boot the Model.
     */
    public static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $model->uuid = (string) Str::uuid();
        });
    }

    /**
     * Get the country for a specific institution.
     */
    public function inCountry()
    {
        return $this->belongsTo(
            'App\Models\Country',
            'country_cca3',
            'cca3'
        );
    }

    /**
     * Get all the exhibitions for a specific institution.
     */
    public function hasExhibitions()
    {
        return $this->hasMany(
            'App\Models\Exhibition',
            'museum_uuid',
            'uuid'
        );
    }

    /**
     * Get the type for a specific institution.
     */
    public function hasType()
    {
        return $this->hasOne(
            'App\Models\Type',
            'slug',
            'type'
        );
    }
    
    /**
     * Get if the user has followed the museum
     */
    public function isFollowed()
    {
        return $this->hasOneThrough(
            'App\Models\User',
            'App\Models\UserMuseum',
            'museum_uuid', // Foreign key on the cars table...
            'user_uuid', // Foreign key on the owners table...
            'uuid', // Local key on the mechanics table...
            'uuid' // Local key on the cars table...
        );
    }  
}
