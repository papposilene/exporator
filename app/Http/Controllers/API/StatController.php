<?php

namespace App\Http\Controllers\API;

use App\Models\Exhibition;
use App\Models\Place;
use App\Models\Review;
use App\Models\Tag;
use App\Models\Tagged;
use App\Models\User;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class StatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Retrieve the statistics by year.
     *
     * @param  $year
     * @return \Illuminate\Http\Response
     */
    public function genders($year)
    {
        $tags = DB::table('taggables')
            ->where('type', 'gender')
            ->selectRaw('id, name, count(tag_id) as total')
            ->join('tags', 'tags.id', '=', 'taggables.tag_id')
            ->groupBy('tag_id')
            ->orderBy('name', 'asc')
            ->get()
            ->map(function($tag){
                return [
                    'id' => $tag->id,
                    'tag' => json_decode($tag->name)->{app()->getLocale()},
                    'count' => $tag->total
                ];
            });

        foreach ($tags as $tag)
        {
            $stat[$tag['tag']] = Tagged::where('tag_id', $tag['id'])
                ->with('isExhibition')
                ->get();

                dd( $stat[$tag['tag']] );

                //->whereYear('began_at', $year)
                //->count();
        }



        //$exhibitions = $tags->hasExhibitions()->whereYear('began_at', $year)->get();


        dd( $stat );



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
                        'backgroundColor' => '',
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
