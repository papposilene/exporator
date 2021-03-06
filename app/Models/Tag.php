<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Translatable\HasTranslations;

class Tag extends Model
{
    use HasTranslations, LogsActivity;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tags';
    protected $primaryKey = 'id';

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [

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
        'id',
        'name',
        'slug',
        'type',
        'order_column',
    ];

    /**
     * The attributes that should be translatable.
     *
     * @var array
     */
    public $translatable = [
        'name',
        'slug',
    ];

    /**
     * Configure the log options for spatie/activity-log.
     */
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logAll();
    }

    /**
     * Get all the exhibitions for a specific tag.
     */
    public function hasExhibitions()
    {
        return $this->hasManyThrough(
            Exhibition::class,
            Tagged::class,
            'tag_id',
            'uuid',
            'id',
            'taggable_id'
        );
    }

    /**
     * Get all the places for a specific tag.
     */
    public function hasPlaces()
    {
        return $this->hasManyThrough(
            Place::class,
            Tagged::class,
            'tag_id',
            'uuid',
            'id',
            'taggable_id'
        );
    }

    /**
     * Get all the exhibitions for a specific tag.
     */
    public function hasTagged()
    {
        return $this->hasMany(
            Tagged::class,
            'tag_id',
            'taggable_id'
        );
    }

    /**
     * Get if the user has followed the place
     */
    public function isFollowed()
    {
        return $this->hasOneThrough(
            User::class,
            UserTag::class,
            'tag_id',
            'uuid',
            'id',
            'user_uuid'
        );
    }
}
