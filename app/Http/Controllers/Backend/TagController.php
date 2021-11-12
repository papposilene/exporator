<?php

namespace App\Http\Controllers\Backend;

use App\Models\Exhibition;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\AttachTagRequest;
use App\Http\Requests\DeleteTagRequest;
use App\Http\Requests\StoreTagRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Spatie\Tags\Tag;

class TagController extends Controller
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
    public function store(StoreTagRequest $request)
    {
        $this->authorize('create', Tag::class);

        $validated = $request->validated();

        $tag = Str::of($request->input('name'))->lower();
        $type = Str::of($request->input('type'))->lower();

        Tag::findOrCreate($tag, $type);

        return redirect()->route('front.tag.index')->with('success', 'All good!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function show(Tag $tag)
    {
        //
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

        $tag = Str::of($request->input('tag'))->lower();
        $type = Str::of($request->input('type'))->lower();
        $existing_tag = Tag::findOrCreate($tag, $type);

        $exhibition = Exhibition::findOrFail($request->input('uuid'));
        $exhibition->attachTag($existing_tag);
        $exhibition->save();

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
        $this->authorize('update', $tag);

        $validated = $request->validated();

        $tag = Str::of($request->input('name'))->lower();
        $type = Str::of($request->input('type'))->lower();

        $tag = Tag::findOrFail($request->input('id'));
        $tag->slug = Str::slug($tag);
        $tag->name = $tag;
        $tag->type = $type;
        $tag->save();

        return redirect()->route('front.tag.index')->with('success', 'All good!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function delete(DeleteTagRequest $request, Tag $tag)
    {
        $this->authorize('delete', $tag);

        $validated = $request->validated();

        $tag = Tag::findOrFail($request->input('id'));
        $tag->delete();

        return redirect()->route('front.tag.index')->with('success', 'All good!');
    }

    /**
     * Delete the specified resource from storage.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag)
    {
        //
    }
}
