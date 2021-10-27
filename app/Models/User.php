<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Jetstream\HasTeams;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use HasTeams;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
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
     * Get all the institutions followed by an user.
     */
    public function followedPlaces()
    {
        return $this->hasManyThrough(
            'App\Models\Place',
            'App\Models\UserPlace',
            'user_id',
            'uuid',
            'id',
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
            'user_id',
            'uuid',
            'id',
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
            'user_id',
            'id',
            'id',
            'tag_id'
        );
    }
}
