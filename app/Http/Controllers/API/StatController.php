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
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\ModelNotFoundException;


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
     * Retrieve the statistics for all continents.
     *
     * @param  $year
     * @return \Illuminate\Http\Response
     */
    public function continents($year)
    {
        $types = Tag::where('type', 'gender')->get();

        foreach ($types as $type)
        {
            $tagged[$type->name] = Tagged::where('tag_id', $type->id)
                ->whereRelation(
                    'hasExhibitions',
                    'began_at', 'like', $year . '%'
                )
                ->count();
        }

        arsort($tagged);

        $statistics = collect([
            'chart' => [
                'labels' => array_keys($tagged),
                'datasets' => [
                    [
                        'data' => array_values($tagged),
                        'backgroundColor' => [
                            '#2563EB',
                            '#DC2626',
                            '#D97706',
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
     * Retrieve the statistics for all genders.
     *
     * @param  $year
     * @return \Illuminate\Http\Response
     */
    public function genders($year)
    {
        $types = Tag::where('type', 'gender')->get();

        foreach ($types as $type)
        {
            $tagged[$type->name] = Tagged::where('tag_id', $type->id)
                ->whereRelation(
                    'hasExhibitions',
                    'began_at', 'like', $year . '%'
                )
                ->count();
        }

        arsort($tagged);

        $statistics = collect([
            'chart' => [
                'labels' => array_keys($tagged),
                'datasets' => [
                    [
                        'data' => array_values($tagged),
                        'backgroundColor' => [
                            '#2563EB',
                            '#DC2626',
                            '#D97706',
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
}
