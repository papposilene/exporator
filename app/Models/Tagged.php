<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Tagged extends Model
{
    use LogsActivity;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'taggables';

    /**
     * Configure the log options for spatie/activity-log.
     */
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logAll();
    }

    /**
     * Get the exhibition for a specific tag.
     */
    public function isExhibition()
    {
        return $this->hasMany(
            'App\Models\Exhibition',
            'uuid',
            'taggable_id'
        );
    }

    /**
     * Get all the exhibitions for a specific tag.
     */
    public function isTag()
    {
        return $this->hasOne(
            'App\Models\Tag',
            'id',
            'tag_id'
        );
    }
}
