<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\ImportExhibitionRequest;
use App\Http\Requests\StoreExhibitionRequest;
use App\Imports\ExhibitionsImport;
use App\Models\Exhibition;
use App\Models\Place;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class ExhibitionController extends Controller
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreExhibitionRequest $request)
    {
        $this->authorize('create', Exhibition::class);

        $validated = $request->validated();

        $place = Place::findOrFail($request->input('place'));

        $exhibition = new Exhibition;
        $exhibition->place_uuid = $place->uuid;
        $exhibition->slug = Str::slug($request->input('title'));
        $exhibition->title = $request->input('title');
        $exhibition->began_at = Carbon::createFromFormat('d/m/Y', $request->input('began_at'))->format('Y-m-d');
        $exhibition->ended_at = Carbon::createFromFormat('d/m/Y', $request->input('ended_at'))->format('Y-m-d');
        $exhibition->description = $request->input('description');
        $exhibition->link = $request->input('link');
        $exhibition->price = $request->input('price');
        $exhibition->is_published = true;
        $exhibition->save();

        return redirect()->route('front.place.show', ['slug' => $place->slug])->with('success', 'All good!');
    }

    /**
     * Store a resource in storage, proposed by a guest.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function propose(StoreExhibitionRequest $request)
    {
        $this->authorize('update', \App\Models\User::class, Exhibition::class);

        $validated = $request->validated();

        $place = Place::findOrFail($request->input('place'));

        $exhibition = new Exhibition;
        $exhibition->place_uuid = $place->uuid;
        $exhibition->slug = Str::slug($request->input('title'));
        $exhibition->title = $request->input('title');
        $exhibition->began_at = Carbon::createFromFormat('d/m/Y', $request->input('began_at'))->format('Y-m-d');
        $exhibition->ended_at = Carbon::createFromFormat('d/m/Y', $request->input('ended_at'))->format('Y-m-d');
        $exhibition->description = $request->input('description');
        $exhibition->link = $request->input('link');
        $exhibition->price = $request->input('price');
        $exhibition->is_published = false;
        $exhibition->save();

        return redirect()->route('front.dashboard')->with('success', 'All good!');
    }

    /**
     * Import a file for creating a new resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function import(ImportExhibitionRequest $request)
    {
        $this->authorize('create', Exhibition::class);

        $validated = $request->validated();

        try {
            $import = new ExhibitionsImport();
            $import->import($request->file('datafile'));
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            Storage::delete($request->file('datafile'));
            $failures = $e->failures();

            dd($failures);

            return redirect()->route('front.exhibition.index', compact($failures));
        }

        Storage::delete($request->file('datafile'));

        return redirect()->route('front.exhibition.index')->with('success', 'All good!');
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
