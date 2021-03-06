<?php

namespace App\Http\Controllers\Backend;

use Abraham\TwitterOAuth\TwitterOAuth;
use App\Http\Controllers\Controller;
use App\Http\Requests\ImportPlaceRequest;
use App\Http\Requests\StorePlaceRequest;
use App\Http\Requests\UpdatePlaceRequest;
use App\Exports\PlacesExport;
use App\Imports\PlacesImport;
use App\Models\Country;
use App\Models\Place;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class PlaceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StorePlaceRequest $request
     * @return RedirectResponse
     */
    public function store(StorePlaceRequest $request)
    {
        $this->authorize('create', Place::class);

        $validated = $request->validated();

        $country = Country::where('cca3', $request->input('cca3'))->firstOrFail();
        $name = $request->input('name');
        $slug = Str::slug($request->input('city') . ' ' . $name, '-');

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $path = $request->image->storeAs(
                'places', $slug
            );
        }

        $place = new Place();
        $place->slug = $slug;
        $place->name = $name;
        $place->type = $request->input('type');
        $place->status = (bool)$request->input('status');
        $place->address = $request->input('address');
        $place->city = $request->input('city');
        $place->country_cca3 = $country->cca3;
        $place->lat = $request->input('latitude');
        $place->lon = $request->input('longitude');
        $place->link = $request->input('link');
        $place->twitter = $request->input('twitter');
        $place->image = ($request->hasFile('image') ? $path : null);
        $place->save();

        if ($place->twitter) {
            // Twitter API: set up the connection before tweeting about the new place
            try {
                $tweet = ucfirst(__('app.send_place_tweet', [
                    'name' => $name,
                    'twitter' => $request->input('twitter'),
                    'url' => route('front.place.show', ['slug' => $slug]),
                ]));

                $twitter = new TwitterOAuth(
                    env('TWITTER_EXPORATOR_CONSUMERKEY', null),
                    env('TWITTER_EXPORATOR_CONSUMERSECRET', null),
                    env('TWITTER_EXPORATOR_TOKEN', null),
                    env('TWITTER_EXPORATOR_TOKENSECRET', null)
                );
                $twitter->setApiVersion('1.1');

                try {
                    $twitter->post('statuses/update', [
                        'status' => $tweet,
                    ]);
                } catch (\Throwable $e) {
                    report('Twitter: error during tweeting a new place.');
                }
            } catch (\Throwable $e) {
                report('Twitter: error during the connection for a new place.');
            }
        }

        return redirect()->route('front.place.show', ['slug' => $slug])->with('success', 'All good!');
    }

    /**
     * Import a file for creating a new resource.
     *
     * @param ImportPlaceRequest $request
     * @return RedirectResponse
     * @throws AuthorizationException
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

            return redirect()->route('front.place.index', [
                'errors' => $failures,
            ]);
        }

        Storage::delete($request->file('datafile'));

        return redirect()->route('front.place.index')->with('success', 'All good!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdatePlaceRequest $request
     * @param Place $place
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    public function update(UpdatePlaceRequest $request, Place $place)
    {
        $this->authorize('update', $place);

        $validated = $request->validated();

        $country = Country::where('cca3', $request->input('cca3'))->firstOrFail();
        $slug = Str::slug($request->input('city') . ' ' . $request->input('name'), '-');

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $path = $request->image->storeAs(
                'places', $slug
            );
        }

        $place = Place::findOrFail($request->input('uuid'));
        $place->slug = $slug;
        $place->name = $request->input('name');
        $place->type = $request->input('type');
        $place->status = (bool)$request->input('status');
        $place->address = $request->input('address');
        $place->city = $request->input('city');
        $place->country_cca3 = $country->cca3;
        $place->lat = $request->input('latitude');
        $place->lon = $request->input('longitude');
        $place->link = $request->input('link');
        $place->twitter = $request->input('twitter');
        $place->image = ($request->hasFile('image') ? $path : null);
        $place->save();

        return redirect()->route('front.place.show', ['slug' => $request->input('slug')])->with('success', 'All good!');
    }

    /**
     * Export all the resources from storage.
     *
     * @return BinaryFileResponse
     */
    public function export()
    {
        $date = date('Y-m-d');
        return Excel::download(new PlacesExport, $date . '_places.xlsx');
    }
}
