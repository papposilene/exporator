<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\ImportMuseumRequest;
use App\Http\Requests\UpdateMuseumRequest;
use App\Imports\MuseumsImport;
use App\Models\Country;
use App\Models\Museum;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class MuseumController extends Controller
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Import a file for creating a new resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function import(ImportMuseumRequest $request)
    {
        $this->authorize('create', Museum::class);

        $validated = $request->validated();

        try {
            $import = new MuseumsImport();
            $import->import($request->file('datafile'));
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = $e->failures();

            return redirect()->route('admin.museum.index', compact($failures));
        }

        return redirect()->route('admin.museum.index')->with('success', 'All good!');
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Museum  $museum
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMuseumRequest $request, Museum $museum)
    {
        $this->authorize('update', Museum::class);

        $validated = $request->validated();

        $country = Country::where('cca3', $request->input('cca3'))->firstOrFail();

        dd($validated);

        $museum = Museum::findOrFail($request->input('uuid'));
        $museum->slug = $request->input('slug');
        $museum->name = $request->input('name');
        $museum->type = $request->input('type');
        $museum->status = (bool) $request->input('status');
        $museum->address = $request->input('address');
        $museum->city = $request->input('city');
        $museum->country_cca = $country->cca3;
        $museum->lat = $request->input('latitude');
        $museum->lon = $request->input('longitude');
        $museum->link = $request->input('link');
        $museum->save();

        return redirect()->route('admin.museum.show', ['slug' => $request->input('slug')])->with('success', 'All good!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Museum  $museum
     * @return \Illuminate\Http\Response
     */
    public function destroy(Museum $museum)
    {
        //
    }
}
