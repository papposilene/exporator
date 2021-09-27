<?php

namespace App\Traits;

trait ForExhibition
{
    /**
     * add filtering.
     *
     * @param  $builder: query builder.
     * @param  $filters: array of filters.
     * @return query builder.
     */
    public function scopeFilter($builder, $filters = [])
    {
        if(!$filters || $filters === 'all') {
            return $builder;
        }

        $today = date('Y-m-d');

        $tableName = $this->getTable();

        if($filters === 'past')
        {
            $builder->whereDate($tableName.'.ended_at', 'LIKE', $today);
        }
        elseif($filters === 'current')
        {
            $builder->whereDate($tableName.'.began_at', '=', $today)
                ->whereDate($tableName.'.ended', '=', $today);
        }
        elseif($filters === 'future')
        {
            $builder->whereDate($tableName.'.began_at', '=', $today);
        }
        else
        {
            return $builder;
        }

        return $builder;
    }
}
