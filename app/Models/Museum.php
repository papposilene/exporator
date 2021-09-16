<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Museum extends Model
{
    use HasFactory, SoftDeletes;

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
        'uuid' => 'uuid',
        'country_uuid' => 'uuid',
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
        'slug',
        'name',
        'address',
        'lat',
        'lon',
        'link',
        'country_uuid',
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
     * Get all the exhibitions for a specific museum.
     */
    public function hasExhibitions()
    {
        return $this->hasMany(
            'App\Models\Exhibition',
            'museum_uuid',
            'uuid'
        );
    }
}
