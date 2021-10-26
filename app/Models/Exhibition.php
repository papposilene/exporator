<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Spatie\Tags\HasTags;

class Exhibition extends Model
{
    use HasFactory, HasTags, SoftDeletes;

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
     * Get all the exhibitions for a specific place.
     */
    public function inPlace()
    {
        return $this->belongsTo(
            'App\Models\Place',
            'place_uuid',
            'uuid'
        );
    }
}
