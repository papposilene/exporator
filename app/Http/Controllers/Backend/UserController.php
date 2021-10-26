<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use App\Models\UserExhibition;
use App\Models\UserPlace;
use App\Models\UserTag;
use App\Http\Controllers\Controller;
use App\Http\Requests\AddExhibitionRequest;
use App\Http\Requests\DeleteExhibitionRequest;
use App\Http\Requests\FollowPlaceRequest;
use App\Http\Requests\FollowTagRequest;
use App\Http\Requests\UnfollowPlaceRequest;
use App\Http\Requests\UnfollowTagRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
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
     * @return \Illuminate\Http\Response
     */
    public function place_follow(FollowPlaceRequest $request)
    {
        $this->authorize('create', User::class);

        $validated = $request->validated();
        
        $user = Auth::id();
        $place = Place::findOrFail($request->input('place_uuid'));
        
        UserPlace::create([
            'user_id' => $user,
            'place_uuid' => $place->uuid,
        ]);

        return redirect()->back()->with('success', 'All good!');
    }

    /**
     * Unfollow a place.
     *
     * @param  \Illuminate\Http\UnfollowPlaceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function place_unfollow(UnfollowPlaceRequest $request)
    {
        $this->authorize('delete', User::class);

        $validated = $request->validated();
        
        $following = UserPlace::findOrFail($request->input('follow_uuid'));
        $following->delete();

        return redirect()->back()->with('success', 'All good!');
    }
    
    /**
     * Follow an exhibition.
     *
     * @param  \Illuminate\Http\FollowExhibitionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function exhibition_follow(FollowExhibitionRequest $request)
    {
        $this->authorize('create', User::class);

        $validated = $request->validated();
        
        $user = Auth::id();
        $exhibition = Exhibition::findOrFail($request->input('exhibition_uuid'));
        
        UserExhibition::create([
            'user_id' => $user,
            'exhibition_uuid' => $exhibition->uuid,
            'visited' => false,
        ]);

        return redirect()->back()->with('success', 'All good!');
    }
    
    /**
     * Visited exhibition
     *
     * @param  \Illuminate\Http\FollowExhibitionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function exhibition_visited(FollowExhibitionRequest $request)
    {
        $this->authorize('create', User::class);

        $validated = $request->validated();
        
        $user = Auth::id();
        $exhibition = Exhibition::findOrFail($request->input('exhibition_uuid'));
        
        UserExhibition::updateOrCreate([
            'user_id' => $user,
            'exhibition_uuid' => $exhibition->uuid,
        ], 
        [
            'visited' => true
        ]);

        return redirect()->back()->with('success', 'All good!');
    }

    /**
     * Unfollow an exhibition.
     *
     * @param  \Illuminate\Http\UnfollowExhibitionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function exhibition_unfollow(UnfollowExhibitionRequest $request)
    {
        $this->authorize('delete', User::class);

        $validated = $request->validated();
        
        $following = UserExhibition::findOrFail($request->input('follow_uuid'));
        $following->delete();

        return redirect()->back()->with('success', 'All good!');
    }
    
    /**
     * Un-visited exhibition
     *
     * @param  \Illuminate\Http\FollowExhibitionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function exhibition_unvisited(FollowExhibitionRequest $request)
    {
        $this->authorize('create', User::class);

        $validated = $request->validated();
        
        $user = Auth::id();
        $exhibition = Exhibition::findOrFail($request->input('exhibition_uuid'));
        
        UserExhibition::updateOrCreate([
            'user_id' => $user,
            'exhibition_uuid' => $exhibition->uuid,
        ], 
        [
            'visited' => false
        ]);

        return redirect()->back()->with('success', 'All good!');
    }
    
    /**
     * Follow a tag.
     *
     * @param  \Illuminate\Http\FollowTagRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function tag_follow(FollowTagRequest $request)
    {
        $this->authorize('create', User::class);

        $validated = $request->validated();
        
        $user = Auth::id();
        $tag_id = Tag::findOrFail($request->input('tag_id'));
        
        UserMuseum::create([
            'user_uuid' => $user,
            'tag_id' => $tag->id,
        ]);

        return redirect()->back()->with('success', 'All good!');
    }

    /**
     * Unfollow a tag.
     *
     * @param  \Illuminate\Http\UnfollowTagRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function tag_unfollow(UnfollowTagRequest $request)
    {
        $this->authorize('delete', User::class);

        $validated = $request->validated();
        
        $following = UserTag::findOrFail($request->input('follow_uuid'));
        $following->delete();

        return redirect()->back()->with('success', 'All good!');
    }


}
