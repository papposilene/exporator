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

        $exhibitions = Exhibition::where('ended_at', '<', $today)->orderBy('began_at', 'asc')->get();

        foreach ($exhibitions as $exhibition)
        {
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
            ];
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
