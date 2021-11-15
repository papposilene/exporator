<?php

namespace App\Http\Controllers\API;

use App\Models\Tag;
use App\Http\Controllers\Controller;
use App\Http\Resources\TagResource;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

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
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function stat_tags(Tag $tag)
    {
        $tags = DB::table('taggables')
            ->selectRaw('name, count(tag_id) as total')
            ->join('tags', 'tags.id', '=', 'taggables.tag_id')
            ->groupBy('tag_id')
            ->orderBy('name', 'asc')
            ->get()
            ->map(function($tag){
                return [
                    'name' => json_decode($tag->name)->{app()->getLocale()},
                    'count' => $tag->total
                ];
            });

        $dataStatistics = $tags->toArray();

        //dd( array_values(data_get($dataStatistics, '*.name')) );

        $statistics = collect([
            'data' => [
                'total' => $tags->count(),
            ],
            'chart' => [
                'labels' => array_values(data_get($dataStatistics, '*.name')),
                'datasets' => [
                    [
                        //'label' => array_values(data_get($dataStatistics, '*.name')),
                        'data' => array_values(data_get($dataStatistics, '*.count')),
                        'backgroundColor' => [
                            '#0284C7',
                        ],
                        'borderColor' => '#000',
                        'tension' => '0.3',
                        'fill' => false,
                    ],
                ],
            ],
            'options' => [
                'indexAxis' => 'y',
                'title' => [
                    'display' => true,
                    'fontColor' => '#FFFFFF',
                    'position' => 'top',
                    'text' => ucfirst(__('chart.tags_by_years')),
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
            })->toArray();

            krsort($dataYears);
            foreach ($dataYears as $year => $value)
            {
                $years[$year] = count($value);
            }

            $dataChart[] = [
                'axis' => 'y',
                'label' => ucfirst(__('chart.tags_by_years')),
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
                    'text' => ucfirst(__('chart.tags_by_years')),
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

    /**
     * Retrieve the statistics for places.
     *
     * @param  $slug
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function stat_type($slug, Tag $tag)
    {
        if ($slug === 'continent')
        {
            $colors = ['#06B6D4', '#EF4444', '#8B5CF6', '#84CC16','#0EA5E9'];
        }
        elseif ($slug === 'gender')
        {
            $colors = ['#2563EB', '#DC2626', '#D97706'];
        }
        else
        {
            $colors = [
                '#06B6D4',
                '#EF4444',
                '#8B5CF6',
                '#84CC16',
                '#0EA5E9',
                '#F97316',
                '#A855F7',
                '#22C55E',
                '#3B82F6',
                '#F59E0B',
                '#D946EF',
                '#10B981',
                '#6366F1',
                '#EAB308',
                '#EC4899',
                '#14B8A6',
                '#F43F5E',
            ];
        }


        $tags = DB::table('taggables')
            ->where('type', $slug)
            ->selectRaw('name, count(tag_id) as total')
            ->join('tags', 'tags.id', '=', 'taggables.tag_id')
            ->groupBy('tag_id')
            ->orderBy('name', 'asc')
            ->get()
            ->map(function($tag){
                return [
                    'name' => json_decode($tag->name)->{app()->getLocale()},
                    'count' => $tag->total
                ];
            });

        $dataStatistics = $tags->toArray();
        rsort($dataStatistics);

        $statistics = collect([
            'data' => [
                'total' => $tags->count(),
            ],
            'chart' => [
                'labels' => array_values(data_get($dataStatistics, '*.name')),
                'datasets' => [
                    [
                        'data' => array_values(data_get($dataStatistics, '*.count')),
                        'backgroundColor' => $colors,
                        'borderColor' => '#000',
                        'tension' => '0.3',
                        'fill' => false,
                    ],
                ],
            ],
            'options' => [
                'indexAxis' => 'y',
                'title' => [
                    'display' => true,
                    'fontColor' => '#FFFFFF',
                    'position' => 'top',
                    'text' => ucfirst(__('chart.tags_by_years')),
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
