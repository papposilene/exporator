<?php

namespace App\Http\Controllers\API;

use App\Models\Tag;
use App\Http\Controllers\Controller;
use App\Http\Resources\TagResource;
use Carbon\Carbon;
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
        $tags = Tag::where('slug->' . app()->getLocale(), $slug)->get();

        foreach ($tags as $tag)
        {
            $exhibitions = $tag->hasExhibitions()->get();
            $dataYears = $exhibitions->groupBy(function($date) {
                // Solution found at https://stackoverflow.com/a/25538667
                return Carbon::parse($date->began_at)->format('Y'); // grouping by years
                //return Carbon::parse($date->created_at)->format('m'); // grouping by months
            });

            $dataYears = $dataYears->toArray();
            krsort($dataYears);
            foreach ($dataYears as $year => $value)
            {
                $years[$year] = count($value);
            }

            $dataChart[] = [
                'axis' => 'y',
                'label' => ucfirst(__('chart.tag_by_year')),
                'data' => array_values($years),
                'backgroundColor' => [
                    '#1E293B',
                ],
                'borderColor' => '#FFFFFF',
            ];
        }

        $statistics = collect([
            'data' => [
                'total' => $tags->count(),
            ],
            'chart' => [
                'labels' => array_keys($years),
                'datasets' => $dataChart,
            ],
            'options' => [
                'indexAxis' => 'y',
                'title' => [
                    'display' => true,
                    'fontColor' => '#FFFFFF',
                    'position' => 'top',
                    'text' => ucfirst(__('chart.tag_by_year')),
                ],
                'responsive' => true,
                'legend' => [
                    'display' => false,
                    'position' => 'bottom',
                    'fontColor' => '#FFFFFF',
                ],
            ],
        ])->all();

        return $statistics;
    }
}
