<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Tag extends Model
{
    use HasTranslations;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tags';
    protected $primaryKey = 'uuid';

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
     * Get all the exhibitions for a specific tag.
     */
    public function hasExhibitions()
    {
        return $this->hasManyThrough(
            'App\Models\Exhibition',
            'App\Models\Tagged',
            'tag_id',
            'uuid',
            'id',
            'taggable_id'
        );
    }

    /**
     * Get all the museums for a specific tag.
     */
    public function hasMuseums()
    {
        return $this->hasManyThrough(
            'App\Models\Museum',
            'App\Models\Tagged',
            'tag_id',
            'uuid',
            'id',
            'taggable_id'
        );
    }
}
