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
    public function stat_total(Place $place)
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
                            '#2563EB',
                            '#059669',
                            '#D97706',
                            '#DC2626',
                            '#60A5FA',
                            '#34D399',
                            '#FBBF24',
                            '#F87171',
                        ],
                        'borderColor' => '#000',
                    ],
                ],
            ],
            'options' => [
                'title' => [
                    'display' => true,
                    'fontColor' => '#fff',
                    'position' => 'bottom',
                    'text' => ucfirst(__('chart.places_by_types')),
                ],
                //'indexAxis' => 'x',
                'responsive' => true,
                'legend' => [
                    'display' => true,
                    'position' => 'bottom',
                    'fontColor' => '#fff',
                ],
            ],
        ])->all();

        return $statistics;
    }

    /**
     * Retrieve the statistics for places.
     *
     * @param  \App\Models\Place  $place
     * @return \Illuminate\Http\Response
     */
    public function stat_status(Place $place)
    {
        $dataStatistics = Place::all();

        $statistics = collect([
            'data' => [
                'total' => $dataStatistics->count(),
            ],
            'chart' => [
                'labels' => [
                    @ucfirst(__('app.places_open')),
                    @ucfirst(__('app.places_closed')),
                ],
                'datasets' => [
                    [
                        'label' => ucfirst(__('chart.places_by_status')),
                        'data' => [
                            $dataStatistics->where('status', 1)->count(),
                            $dataStatistics->where('status', 0)->count(),
                        ],
                        'backgroundColor' => [
                            '#059669',
                            '#DC2626',
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
                    'text' => ucfirst(__('chart.places_by_status')),
                ],
                //'indexAxis' => 'y',
                'responsive' => true,
                'legend' => [
                    'display' => true,
                    'position' => 'bottom',
                    'fontColor' => '#fff',
                ],
            ],
        ])->all();

        return $statistics;
    }
}
