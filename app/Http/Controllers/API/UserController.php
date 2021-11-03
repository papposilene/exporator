<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return UserResource::collection(User::paginate(25));
    }

    /**
     * Display the specified resource.
     *
     * @param  UUID $uuid
     * @return \Illuminate\Http\Response
     */
    public function show($uuid = null)
    {
        // Abort unless the given User's UUID is not the same as Auth:id()
        abort_unless(Auth::id() === $uuid, 403);
        
        return new UserResource(User::findOrFail($uuid));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }
}
