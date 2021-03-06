<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\ImportExhibitionRequest;
use App\Http\Requests\PublishExhibitionRequest;
use App\Http\Requests\ProposeExhibitionRequest;
use App\Http\Requests\StoreExhibitionRequest;
use App\Http\Requests\UpdateExhibitionRequest;
use App\Http\Requests\DeleteExhibitionRequest;
use App\Exports\ExhibitionsExport;
use App\Imports\ExhibitionsImport;
use App\Jobs\PostOnSocialNetworks;
use App\Models\Exhibition;
use App\Models\Place;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class ExhibitionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    public function feed()
    {
        $feed = Exhibition::orderBy('created_at', 'desc')
            ->limit(50)
            ->get();
        return response()->view('feed.rss', compact('feed'))->header('Content-Type', 'application/xml');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreExhibitionRequest $request
     * @return RedirectResponse
     * @throws AuthorizationException
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
        $exhibition->is_published = $request->input('is_published');
        $exhibition->save();

        if($place->twitter && Carbon::today()->toDateString() < $exhibition->ended_at)
        {
            PostOnSocialNetworks::dispatch($exhibition)->delay(now()->addMinutes(5));
        }

        return redirect()->route('front.place.show', ['slug' => $place->slug])->with('success', 'All good!');
    }

    /**
     * Store a resource in storage, proposed by a guest.
     *
     * @param ProposeExhibitionRequest $request
     * @return RedirectResponse
     */
    public function propose(ProposeExhibitionRequest $request)
    {
        if( !Auth::user()->can('propose exhibitions') )
        {
            abort(403);
        }

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

        return redirect()->back()->with('success', 'All good!');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PublishExhibitionRequest $request
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    public function publish(PublishExhibitionRequest $request)
    {
        $this->authorize('create', Exhibition::class);

        $validated = $request->validated();

        $exhibition = Exhibition::findOrFail($request->input('exhibition'));
        $exhibition->is_published = true;
        $exhibition->save();

        return redirect()->route('front.exhibition.show', ['place' => $exhibition->inPlace->slug, 'slug' => $exhibition->slug])->with('success', 'All good!');
    }

    /**
     * Import a file for creating a new resource.
     *
     * @param ImportExhibitionRequest $request
     * @return Response
     * @throws AuthorizationException
     */
    public function import(ImportExhibitionRequest $request)
    {
        $this->authorize('create', Exhibition::class);

        $validated = $request->validated();

        try
        {
            $import = new ExhibitionsImport();
            $import->import($request->file('datafile'));
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e)
        {
            Storage::delete($request->file('datafile'));
            $failures = $e->failures();

            return redirect()->route('front.exhibition.index', [
                'errors' => $failures,
            ]);
        }

        Storage::delete($request->file('datafile'));

        return redirect()->route('front.exhibition.index')->with('success', 'All good!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateExhibitionRequest $request
     * @param Exhibition $exhibition
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    public function update(UpdateExhibitionRequest $request, Exhibition $exhibition)
    {
        $this->authorize('update', $exhibition);

        $validated = $request->validated();

        $exhibition = Exhibition::findOrFail($request->input('uuid'));
        $exhibition->place_uuid = $request->input('place');
        $exhibition->slug = Str::slug($request->input('title'));
        $exhibition->title = $request->input('title');
        $exhibition->began_at = Carbon::createFromFormat('d/m/Y', $request->input('began_at'))->format('Y-m-d');
        $exhibition->ended_at = Carbon::createFromFormat('d/m/Y', $request->input('ended_at'))->format('Y-m-d');
        $exhibition->description = $request->input('description');
        $exhibition->link = $request->input('link');
        $exhibition->price = $request->input('price');
        $exhibition->is_published = $request->input('is_published');
        $exhibition->save();

        return redirect()->route('front.exhibition.show', ['place' => $exhibition->inPlace->slug, 'slug' => $exhibition->slug])->with('success', 'All good!');
    }

    /**
     * Export all the resources from storage.
     *
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function export()
    {
        $date = date('Y-m-d');
        return Excel::download(new ExhibitionsExport, $date . '_exhibitions.xlsx');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DeleteExhibitionRequest $request
     * @param Exhibition $exhibition
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    public function delete(DeleteExhibitionRequest $request, Exhibition $exhibition)
    {
        $this->authorize('delete', $exhibition);

        $validated = $request->validated();

        $exhibition = Exhibition::findOrFail($request->input('uuid'));
        $exhibition->delete();

        return redirect()->route('front.exhibition.index')->with('success', 'All good!');
    }
}
