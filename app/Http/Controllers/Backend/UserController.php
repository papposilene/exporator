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
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class UserController extends Controller
{
    /**
     * Follow a museum.
     *
     * @param  \Illuminate\Http\FollowMuseumRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function museum_follow(FollowMuseumRequest $request)
    {
        $this->authorize('create', User::class);

        $validated = $request->validated();
        
        $user = Auth::id();
        $museum = Museum::findOrFail($request->input('museum_uuid'));
        
        UserMuseum::create([
            'user_uuid' => $user,
            'museum_uuid' => $museum->uuid,
        ]);

        return redirect()->back()->with('success', 'All good!');
    }

    /**
     * Unfollow a museum.
     *
     * @param  \Illuminate\Http\UnfollowMuseumRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function museum_unfollow(UnfollowMuseumRequest $request)
    {
        $this->authorize('delete', User::class);

        $validated = $request->validated();
        
        $following = UserMuseum::findOrFail($request->input('follow_uuid'));
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
            'user_uuid' => $user,
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
            'user_uuid' => $user,
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
            'user_uuid' => $user,
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
    public function museum_tag(FollowTagRequest $request)
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
