<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\ImportExhibitionRequest;
use App\Http\Requests\StoreExhibitionRequest;
use App\Imports\ExhibitionsImport;
use App\Models\Exhibition;
use App\Models\Museum;
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

        $museum = Museum::findOrFail($request->input('museum'));

        $exhibition = new Exhibition;
        $exhibition->museum_uuid = $museum->uuid;
        $exhibition->slug = Str::slug($request->input('title'));
        $exhibition->title = $request->input('title');
        $exhibition->began_at = date('Y-m-d', strtotime($request->input('began_at')));
        $exhibition->ended_at = date('Y-m-d', strtotime($request->input('ended_at')));
        $exhibition->description = $request->input('description');
        $exhibition->link = $request->input('link');
        $exhibition->is_published = true;
        $exhibition->save();

        return redirect()->route('admin.museum.show', ['slug' => $museum->slug])->with('success', 'All good!');
    }

    /**
     * Store a resource in storage, proposed by a guest.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function propose(StoreExhibitionRequest $request)
    {
        $validated = $request->validated();

        $museum = Museum::findOrFail($request->input('museum'));

        $exhibition = new Exhibition;
        $exhibition->museum_uuid = $museum->uuid;
        $exhibition->slug = Str::slug($request->input('title'));
        $exhibition->title = $request->input('title');
        $exhibition->began_at = date('Y-m-d', strtotime($request->input('began_at')));
        $exhibition->ended_at = date('Y-m-d', strtotime($request->input('ended_at')));
        $exhibition->description = $request->input('description');
        $exhibition->link = $request->input('link');
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

            return redirect()->route('admin.exhibition.index', compact($failures));
        }
        
        Storage::delete($request->file('datafile'));

        return redirect()->route('admin.exhibition.index')->with('success', 'All good!');
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
