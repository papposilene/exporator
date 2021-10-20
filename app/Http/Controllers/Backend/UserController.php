<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use App\Models\UserExhibition;
use App\Models\UserMuseum;
use App\Models\UserTag;
use App\Http\Controllers\Controller;
use App\Http\Requests\AddExhibitionRequest;
use App\Http\Requests\DeleteExhibitionRequest;
use App\Http\Requests\FollowMuseumRequest;
use App\Http\Requests\FollowTagRequest;
use App\Http\Requests\UnfollowMuseumRequest;
use App\Http\Requests\UnfollowTagRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class UserController extends Controller
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
     * Follow a museum.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function museum_follow(FollowMuseumRequest $request)
    {
        $this->authorize('create', User::class);

        $validated = $request->validated();

        return redirect()->back()->with('success', 'All good!');
    }

    /**
     * Unfollow a museum.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function museum_unfollow(UnfollowMuseumRequest $request)
    {
        $this->authorize('delete', User::class);

        $validated = $request->validated();

        return redirect()->back()->with('success', 'All good!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function edit(Tag $tag)
    {
        //
    }

    /**
     * Attach the specified tag to an exhibition.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Exhibition  $exhibition
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function attach(AttachTagRequest $request, Exhibition $exhibition, Tag $tag)
    {
        $this->authorize('create', Exhibition::class);

        $validated = $request->validated();

        return redirect()->back()->with('success', 'All good!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function update(StoreTagRequest $request, Tag $tag)
    {
        $this->authorize('update', Tag::class);

        $validated = $request->validated();

        return redirect()->route('front.tag.index')->with('success', 'All good!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag)
    {
        //
    }
}
