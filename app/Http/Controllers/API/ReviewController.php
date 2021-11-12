<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ReviewResource;
use App\Models\Review;
use App\Models\UserReview;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ReviewResource::collection(Review::paginate(25));
    }

    /**
     * Retrieve the statistics for Reviews.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function statistic(Review $review)
    {
        $dataStatistics = Review::orderBy('has_places_count', 'desc')->get();

        $statistics = collect([
            'data' => [
                'total' => $dataStatistics->count(),
            ],
            'chart' => [
                'labels' => $dataStatistics->pluck('type'),
                'datasets' => [
                    [
                        'label' => ucfirst(__('chart.places_by_types')),
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
                    ],
                ],
            ],
            'options' => [
                'title' => [
                    'display' => true,
                    'fontColor' => '#fff',
                    'position' => 'top',
                    'text' => ucfirst(__('chart.places_by_types')),
                ],
                //'indexAxis' => 'y',
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Place  $place
     * @return \Illuminate\Http\Response
     */
    public function edit(Place $place)
    {
        //
    }
}
