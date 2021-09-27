<?php

namespace App\Traits;

trait ForExhibition
{
    /**
     * add filtering.
     *
     * @param  $filters: string of filters (all, past, current, future).
     * @return query builder.
     */
    public function updatingForExhibition($filters = 'all')
    {
        if(!$filters || $filters === 'all') {
            return $this;
        }

        $today = date('Y-m-d');

        if($filters === 'past')
        {
            $this->whereDate('ended_at', '<', $today);
        }
        elseif($filters === 'current')
        {
            $this->whereDate('began_at', '>', $today)
                ->whereDate('ended', '<', $today);
        }
        elseif($filters === 'future')
        {
            $this->whereDate('began_at', '>', $today);
        }
        else
        {
            return $this;
        }

        return $this;
    }
}
