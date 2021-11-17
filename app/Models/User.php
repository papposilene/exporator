<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
//use Laravel\Jetstream\HasTeams;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use HasRoles;
    //use HasTeams;
    use LogsActivity;
    use Notifiable;
    use TwoFactorAuthenticatable;

    protected $primaryKey = 'uuid';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'uuid',
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
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
     * Get all the institutions followed by an user.
     */
    public function followedPlaces()
    {
        return $this->hasManyThrough(
            'App\Models\Place',
            'App\Models\UserPlace',
            'user_uuid',
            'uuid',
            'uuid',
            'place_uuid'
        );
    }

    /**
     * Get all the exhibitions followed by an user.
     */
    public function followedExhibitions()
    {
        return $this->hasManyThrough(
            'App\Models\Exhibition',
            'App\Models\UserExhibition',
            'user_uuid',
            'uuid',
            'uuid',
            'exhibition_uuid'
        );
    }

    /**
     * Get all the tags followed by an user.
     */
    public function followedTags()
    {
        return $this->hasManyThrough(
            'App\Models\Tag',
            'App\Models\UserTag',
            'user_uuid',
            'id',
            'uuid',
            'tag_id'
        );
    }

    /**
     * Get all the activities done by an user.
     */
    public function hasActivities()
    {
        return $this->hasMany(
            'Spatie\Activitylog\Models\Activity',
            'causer_id',
            'uuid'
        );
    }

    /**
     * Get all the reviews written by an user.
     */
    public function hasReviews()
    {
        return $this->hasManyThrough(
            'App\Models\Review',
            'App\Models\UserReview',
            'user_uuid',
            'uuid',
            'uuid',
            'review_uuid'
        );
    }

    /**
     * Get all the visited exhibitions by an user.
     */
    public function hasVisitedExhibitions()
    {
        return $this->hasMany(
            'App\Models\UserPlace',
            'user_uuid',
            'uuid'
        );
    }

    /**
     * Get if an exhibition is followed by an user.
     */
    public function isFollowingExhibition()
    {
        return $this->hasOne(
            'App\Models\UserExhibition',
            'user_uuid',
            'uuid'
        );
    }

    /**
     * Get if a place is followed by an user.
     */
    public function isFollowingPlace()
    {
        return $this->hasOne(
            'App\Models\UserPlace',
            'user_uuid',
            'uuid'
        );
    }

    /**
     * Get if a tag is followed by an user.
     */
    public function isFollowingTag()
    {
        return $this->hasOne(
            'App\Models\UserTag',
            'user_uuid',
            'uuid'
        );
    }
}
