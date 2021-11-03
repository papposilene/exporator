<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tagged extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'taggables';

    /**
     * Get all the exhibitions for a specific tag.
     */
    public function isExhibition()
    {
        return $this->hasOne(
            'App\Models\Exhibition',
            'uuid',
            'taggable_id'
        );
    }
}
