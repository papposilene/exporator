<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ExhibitionResource;
use App\Models\Exhibition;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ExhibitionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ExhibitionResource::collection(Exhibition::paginate(25));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function json()
    {
        $today = date('Y-m-d');
        $ended_2months = date('Y-m-d', strtotime('-2 months'));
        $begin_in_2months = date('Y-m-d', strtotime('+2 months'));

        $exhibitions = Exhibition::where('began_at', '>', $today)
            ->where('ended_at', '>', $ended_2months)
            ->where('began_at', '<', $begin_in_2months)
            ->orderBy('began_at', 'asc')
            ->get();

        $ii = 0;
        $colors = [
            // Colors from TailwindCSS 2.0
            '#E5E7EB',
            '#FECACA',
            '#FDE68A',
            '#A7F3D0',
            '#BFDBFE',
            '#C7D2FE',
            '#DDD6FE',
            '#FBCFE8',

            '#D1D5DB',
            '#FCA5A5',
            '#FCD34D',
            '#6EE7B7',
            '#93C5FD',
            '#A5B4FC',
            '#C4B5FD',
            '#F9A8D4',

            '#F87171',
            '#FBBF24',
            '#34D399',
            '#60A5FA',
            '#818CF8',
            '#312E81',
            '#A78BFA',
            '#F472B6',

            '#6B7280',
            '#EF4444',
            '#F59E0B',
            '#10B981',
            '#3B82F6',
            '#6366F1',
            '#8B5CF6',
            '#EC4899',
        ];

        foreach ($exhibitions as $exhibition)
        {
            if ($ii > count($colors)-1) $ii = 0;

            $json[] = [
                'uuid' => $exhibition->uuid,
                'slug' => $exhibition->slug,
                'title' => $exhibition->title,
                'began_at' => $exhibition->began_at->format('Y-m-d'),
                'ended_at' => $exhibition->ended_at->format('Y-m-d'),
                'description' => $exhibition->description,
                'museum_name' => $exhibition->inMuseum->name,
                'museum_slug' => $exhibition->inMuseum->slug,
                'museum_address' => $exhibition->inMuseum->address,
                'museum_city' => $exhibition->inMuseum->city,
                'museum_country' => $exhibition->inMuseum->cca3,
                'color' => $colors[$ii++],
            ];

            $ii++;
        }

        return json_encode($json, JSON_PRETTY_PRINT);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Exhibition  $exhibition
     * @return \Illuminate\Http\Response
     */
    public function show(Exhibition $exhibition)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Exhibition  $exhibition
     * @return \Illuminate\Http\Response
     */
    public function edit(Exhibition $exhibition)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Exhibition  $exhibition
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Exhibition $exhibition)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Exhibition  $exhibition
     * @return \Illuminate\Http\Response
     */
    public function destroy(Exhibition $exhibition)
    {
        //
    }
}
