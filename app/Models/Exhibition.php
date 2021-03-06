<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Tags\HasTags;

class Exhibition extends Model
{
    use HasFactory, HasTags, LogsActivity, SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'exhibitions';
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
        'began_at' => 'date:Y-m-d',
        'ended_at' => 'date:Y-m-d',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'began_at',
        'ended_at',
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
        'place_uuid',
        'slug',
        'title',
        'began_at',
        'ended_at',
        'description',
        'link',
        'price',
        'is_published',
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
     * Configure the log options for spatie/activity-log.
     */
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logAll();
    }

    /**
     * Get all the reviews written by an user.
     */
    public function hasReviews()
    {
        return $this->hasManyThrough(
            'App\Models\Review',
            'App\Models\UserReview',
            'exhibition_uuid',
            'uuid',
            'uuid',
            'review_uuid'
        );
    }

    /**
     * Get all the exhibitions for a specific place.
     */
    public function inPlace()
    {
        return $this->belongsTo(
            Place::class,
            'place_uuid',
            'uuid'
        );
    }

    /**
     * Get if the user has followed the exhibition
     */
    public function isFollowed()
    {
        return $this->hasOneThrough(
            User::class,
            UserExhibition::class,
            'exhibition_uuid',
            'uuid',
            'uuid',
            'user_uuid'
        );
    }

    /**
     * Get all the tags for a specific exhibition.
     */
    public function isTagged()
    {
        return $this->hasManyThrough(
            Tag::class,
            Tagged::class,
            'taggable_id',
            'id',
            'uuid',
            'tag_id'
        );
    }
}
