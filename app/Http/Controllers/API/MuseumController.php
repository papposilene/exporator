<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\MuseumResource;
use App\Models\Museum;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class MuseumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return MuseumResource::collection(Museum::paginate(25));
    }

    /**
     * Display a listing of the resource in geojson format.
     *
     * @return \Illuminate\Http\Response
     */
    public function geojson()
    {
        $today = date('Y-m-d');
        $data = Museum::where('is_published', true)->get();
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
                    'exhibitions' => [
                        'past' => $value->hasExhibitions()->whereDate('ended_at', '>', $today)->count(),
                        'present' => $value->hasExhibitions()->whereDate('began_at', '<', $today)->whereDate('ended_at', '>', $today)->count(),
                        'future' => $value->hasExhibitions()->whereDate('began_at', '<', $today)->count(),
                    ],
                ],
            ];
        };

        $allfeatures = [
            'type' => 'FeatureCollection',
            'features' => $features,
        ];

        return json_encode($allfeatures, JSON_PRETTY_PRINT);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Museum  $museum
     * @return \Illuminate\Http\Response
     */
    public function show(Museum $museum)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Museum  $museum
     * @return \Illuminate\Http\Response
     */
    public function edit(Museum $museum)
    {
        //
    }
}
