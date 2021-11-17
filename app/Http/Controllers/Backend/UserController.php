<?php

namespace App\Http\Controllers\Backend;

use App\Models\Exhibition;
use App\Models\Place;
use App\Models\Tag;
use App\Models\User;
use App\Models\UserExhibition;
use App\Models\UserPlace;
use App\Models\UserTag;
use App\Http\Controllers\Controller;
use App\Http\Requests\FollowExhibitionRequest;
use App\Http\Requests\FollowPlaceRequest;
use App\Http\Requests\FollowTagRequest;
use App\Http\Requests\VisitedExhibitionRequest;
use App\Http\Requests\UnfollowExhibitionRequest;
use App\Http\Requests\UnfollowPlaceRequest;
use App\Http\Requests\UnfollowTagRequest;
use App\Http\Requests\UnvisitedExhibitionRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class UserController extends Controller
{
    /**
     * Follow a place.
     *
     * @param  \Illuminate\Http\FollowPlaceRequest  $request
     * @param  \App\Models\UserPlace  $userplace
     * @return \Illuminate\Http\Response
     */
    public function place_follow(FollowPlaceRequest $request, UserPlace $userplace)
    {
        $this->authorize('update', $userplace);

        $validated = $request->validated();

        $user = Auth::id();
        $place = Place::findOrFail($request->input('place'));

        UserPlace::create([
            'user_uuid' => $user,
            'place_uuid' => $place->uuid,
        ]);

        return redirect()->back()->with('success', 'All good!');
    }

    /**
     * Unfollow a place.
     *
     * @param  \Illuminate\Http\UnfollowPlaceRequest  $request
     * @param  \App\Models\UserPlace  $userplace
     * @return \Illuminate\Http\Response
     */
    public function place_unfollow(UnfollowPlaceRequest $request, UserPlace $userplace)
    {
        $this->authorize('update', $userplace);

        $validated = $request->validated();

        $following = UserPlace::findOrFail($request->input('follow'));
        $following->delete();

        return redirect()->back()->with('success', 'All good!');
    }

    /**
     * Follow an exhibition.
     *
     * @param  \Illuminate\Http\FollowExhibitionRequest  $request
     * @param  \App\Models\UserExhibition  $userexhibition
     * @return \Illuminate\Http\Response
     */
    public function exhibition_follow(FollowExhibitionRequest $request, UserExhibition $userexhibition)
    {
        $this->authorize('update', $userexhibition);

        $validated = $request->validated();

        $user = Auth::id();
        $exhibition = Exhibition::findOrFail($request->input('exhibition'));

        UserExhibition::create([
            'user_uuid' => $user,
            'exhibition_uuid' => $exhibition->uuid,
            'visited_at' => null,
        ]);

        return redirect()->back()->with('success', 'All good!');
    }

    /**
     * Unfollow an exhibition.
     *
     * @param  \Illuminate\Http\UnfollowExhibitionRequest  $request
     * @param  \App\Models\UserExhibition  $userexhibition
     * @return \Illuminate\Http\Response
     */
    public function exhibition_unfollow(UnfollowExhibitionRequest $request, UserExhibition $userexhibition)
    {
        $this->authorize('update', $userexhibition);

        $validated = $request->validated();

        $following = UserExhibition::findOrFail($request->input('follow'));
        $following->delete();

        return redirect()->back()->with('success', 'All good!');
    }

    /**
     * Visited exhibition
     *
     * @param  \Illuminate\Http\VisitedExhibitionRequest  $request
     * @param  \App\Models\UserExhibition  $userexhibition
     * @return \Illuminate\Http\Response
     */
    public function exhibition_visited(VisitedExhibitionRequest $request, UserExhibition $userexhibition)
    {
        $this->authorize('update', $userexhibition);

        $validated = $request->validated();

        $user = Auth::id();
        $exhibition = Exhibition::findOrFail($request->input('exhibition'));

        $visited_at = $request->input('date');

        if ($exhibition->began_at < $visited_at || $exhibition->ended_at < $visited_at )
        {
            $visited_at = $exhibition->ended_at->subDays(2);
        }

        UserExhibition::updateOrCreate([
            'user_uuid' => $user,
            'exhibition_uuid' => $exhibition->uuid,
        ],
        [
            'visited_at' => $visited_at,
        ]);

        return redirect()->back()->with('success', 'All good!');
    }

    /**
     * Un-visited exhibition
     *
     * @param  \Illuminate\Http\UnvisitedExhibitionRequest  $request
     * @param  \App\Models\UserExhibition  $userexhibition
     * @return \Illuminate\Http\Response
     */
    public function exhibition_unvisited(UnvisitedExhibitionRequest $request, UserExhibition $userexhibition)
    {
        $this->authorize('update', $userexhibition);

        $validated = $request->validated();

        $user = Auth::id();
        $exhibition = UserExhibition::findOrFail($request->input('visit'));
        $exhibition->visited_at = null;
        $exhibition->save();

        return redirect()->back()->with('success', 'All good!');
    }

    /**
     * Follow a tag.
     *
     * @param  \Illuminate\Http\FollowTagRequest  $request
     * @param  \App\Models\UserTag  $usertag
     * @return \Illuminate\Http\Response
     */
    public function tag_follow(FollowTagRequest $request, UserTag $usertag)
    {
        $this->authorize('update', $usertag);

        $validated = $request->validated();

        $user = Auth::id();
        $tag = Tag::findOrFail($request->input('tag'));

        UserTag::updateOrCreate([
            'user_uuid' => $user,
            'tag_id' => $tag->id,
        ]);

        return redirect()->back()->with('success', 'All good!');
    }

    /**
     * Unfollow a tag.
     *
     * @param  \Illuminate\Http\UnfollowTagRequest  $request
     * @param  \App\Models\UserTag  $usertag
     * @return \Illuminate\Http\Response
     */
    public function tag_unfollow(UnfollowTagRequest $request, UserTag $usertag)
    {
        $this->authorize('update', $usertag);

        $validated = $request->validated();

        $following = UserTag::findOrFail($request->input('follow'));
        $following->delete();

        return redirect()->back()->with('success', 'All good!');
    }


}
