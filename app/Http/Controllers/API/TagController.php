<?php

namespace App\Http\Controllers\API;

use App\Models\Tag;
use App\Http\Controllers\Controller;
use App\Http\Resources\TagResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return TagResource::collection(Tag::paginate(25));
    }

    /**
     * Retrieve the statistics for places.
     *
     * @param  $slug
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function stat_tag($slug, Tag $tag)
    {
        $tags = Tag::where('name->' . app()->getLocale(), $tag)->get();
        
        foreach ($tags as $tag)
        {
            $exhibitions = $tag->hasExhibitions()->groupBy(function($date) {
                // Solution found at https://stackoverflow.com/a/25538667/14699817
                return Carbon::parse($date->began_at)->format('Y');
                //return Carbon::parse($date->created_at)->format('m'); // grouping by months
            });
            
            $dataChart[] = [
                'label' => ucfirst(__('chart.tag_by_year')),
                'data' => $dataStatistics->pluck('has_places_count'),
                'backgroundColor' => [
                    '#F87171',
                    '#FBBF24',
                    '#34D399',
                    '#60A5FA',
                    '#818CF8',
                    '#FCA5A5',
                    '#FCD34D',
                    '#6EE7B7',
                    '#93C5FD',
                    '#A5B4FC',
                ],
                'borderColor' => '#000',
            ];
        }
        
        $statistics = collect([
            'data' => [
                'total' => $dataStatistics->count(),
            ],
            'chart' => [
                'labels' => $dataStatistics->pluck('type'),
                'datasets' => [
                    $dataChart
                ],
            ],
            'options' => [
                'title' => [
                    'display' => true,
                    'fontColor' => '#fff',
                    'position' => 'top',
                    'text' => ucfirst(__('chart.tag_by_year')),
                ],
                'responsive' => true,
                'legend' => [
                    'display' => false,
                    'position' => 'bottom',
                    'fontColor' => '#fff',
                ],
            ],
        ])->all();

        return $statistics;
    }
}
