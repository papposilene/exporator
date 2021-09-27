<?php

namespace App\Traits;

use App\Models\Exhibition;

trait ForExhibition
{
    /**
     * @var string
     */
    public Exhibition $exhibition;

    /**
     * @param Exhibition    $exhibition
     */
    public function __construct(Exhibition $exhibition)
    {
        $this->query = $exhibition;
    }

    /**
     * add filtering.
     *
     * @param  $filters: string of filters (all, past, current, future).
     * @return query builder.
     */
    public function updatingForExhibition($filters = 'all')
    {
        if(!$filters || $filters === 'all') {
            return $this->query;
        }

        $today = date('Y-m-d');

        if($filters === 'past')
        {
            $this->query->whereDate('ended_at', '<', $today);
        }
        elseif($filters === 'current')
        {
            $this->query->whereDate('began_at', '>', $today)
                ->whereDate('ended', '<', $today);
        }
        elseif($filters === 'future')
        {
            $this->query->whereDate('began_at', '>', $today);
        }

        return $this->query;
    }
}
