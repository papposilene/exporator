<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\ImportPlaceRequest;
use App\Http\Requests\StorePlaceRequest;
use App\Http\Requests\UpdatePlaceRequest;
use App\Imports\PlacesImport;
use App\Models\Country;
use App\Models\Place;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class PlaceController extends Controller
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\StorePlaceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePlaceRequest $request)
    {
        $this->authorize('create', Place::class);

        $validated = $request->validated();

        $country = Country::where('cca3', $request->input('cca3'))->firstOrFail();
        $slug = Str::slug($request->input('city') . ' ' . $request->input('name'), '-');
        
        if ($request->hasFile('image') && $request->file('image')->isValid())
        {
            $path = $request->image->storeAs(
                'places', $slug
            );
        }

        $place = new Place();
        $place->slug = $slug;
        $place->name = $request->input('name');
        $place->type = $request->input('type');
        $place->status = (bool) $request->input('status');
        $place->address = $request->input('address');
        $place->city = $request->input('city');
        $place->country_cca3 = $country->cca3;
        $place->lat = $request->input('latitude');
        $place->lon = $request->input('longitude');
        $place->link = $request->input('link');
        $place->image = ($path ? $path : null);
        $place->save();
        


        return redirect()->route('front.place.show', ['slug' => $slug])->with('success', 'All good!');
    }

    /**
     * Import a file for creating a new resource.
     *
     * @param  \Illuminate\Http\ImportPlaceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function import(ImportPlaceRequest $request)
    {
        $this->authorize('create', Place::class);

        $validated = $request->validated();

        try {
            $import = new PlacesImport();
            $import->import($request->file('datafile'));
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            Storage::delete($request->file('datafile'));
            $failures = $e->failures();

            return redirect()->route('front.place.index', compact($failures));
        }
        
        Storage::delete($request->file('datafile'));

        return redirect()->route('front.place.index')->with('success', 'All good!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Place  $place
     * @return \Illuminate\Http\Response
     */
    public function show(Place $place)
    {
        //
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\UpdatePlaceRequest  $request
     * @param  \App\Models\Place  $place
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePlaceRequest $request, Place $place)
    {
        $this->authorize('update', Place::class);

        $validated = $request->validated();

        $country = Country::where('cca3', $request->input('cca3'))->firstOrFail();
        $slug = Str::slug($request->input('city') . ' ' . $request->input('name'), '-');
        
        if ($request->hasFile('image') && $request->file('image')->isValid())
        {
            $request->image->storeAs(
                'places', $slug
            );
        }

        $place = Place::findOrFail($request->input('uuid'));
        $place->slug = $slug;
        $place->name = $request->input('name');
        $place->type = $request->input('type');
        $place->status = (bool) $request->input('status');
        $place->address = $request->input('address');
        $place->city = $request->input('city');
        $place->country_cca = $country->cca3;
        $place->lat = $request->input('latitude');
        $place->lon = $request->input('longitude');
        $place->link = $request->input('link');
        $place->image = ($path ? $path : null);
        $place->save();
        
        return redirect()->route('front.place.show', ['slug' => $request->input('slug')])->with('success', 'All good!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Place  $place
     * @return \Illuminate\Http\Response
     */
    public function destroy(Place $place)
    {
        //
    }
}
