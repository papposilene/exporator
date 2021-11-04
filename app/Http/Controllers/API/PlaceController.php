<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\PlaceResource;
use App\Models\Place;
use App\Models\Type;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class PlaceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return PlaceResource::collection(Place::paginate(25));
    }

    /**
     * Display a listing of the resource in geojson format.
     *
     * @return \Illuminate\Http\Response
     */
    public function geojson()
    {
        $today = date('Y-m-d');
        $data = Place::all();
        $features = [];

        foreach($data as $key => $value)
        {
            $features[] = [
                'type' => 'Feature',
                'geometry' => [
                    'type' => 'Point',
                    'coordinates' => [
                        (float) $value['lon'],
                        (float) $value['lat'],

                    ]
                ],
                'properties' => [
                    'uuid' => $value['uuid'],
                    'slug' => $value['slug'],
                    'name' => $value['name'],
                    'type' => $value['type'],
                    'status' => ($value['status'] === 1 ? 'open' : 'closed'),
                    'address' => $value['address'],
                    'city' => $value['city'],
                    'link' => $value['link'],
                    'url' => route('front.place.show', ['slug' => $value['slug']]),
                    'exhibitions' => [
                        'past' => $value->hasExhibitions()
                            ->where('is_published', true)
                            ->whereDate('ended_at', '>', $today)
                            ->count(),
                        'present' => $value->hasExhibitions()
                            ->where('is_published', true)
                            ->whereDate('began_at', '<', $today)
                            ->whereDate('ended_at', '>', $today)
                            ->count(),
                        'future' => $value->hasExhibitions()
                            ->where('is_published', true)
                            ->whereDate('began_at', '<', $today)
                            ->count(),
                    ],
                ],
            ];
        };

        $allFeatures = [
            'type' => 'FeatureCollection',
            'features' => $features,
        ];

        return json_encode($allFeatures, JSON_PRETTY_PRINT);
    }

    /**
     * Retrieve the statistics for places.
     *
     * @param  \App\Models\Place  $place
     * @return \Illuminate\Http\Response
     */
    public function statistic(Place $place)
    {
        $dataStatistics = Type::withCount('hasPlaces')->orderBy('has_places_count', 'desc')->get();

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
