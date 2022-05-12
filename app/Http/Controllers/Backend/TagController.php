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
     * Store a newly created resource in storage.
     *
     * @param StoreTagRequest $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(StoreTagRequest $request)
    {
        $this->authorize('create tags', Tag::class);

        $validated = $request->validated();

        $tag = Str::of($request->input('name'))->lower();
        $type = Str::of($request->input('type'))->lower();

        Tag::findOrCreate($tag, $type);

        return redirect()->route('front.tag.index')->with('success', 'All good!');
    }

    /**
     * Attach the specified tag to an exhibition.
     *
     * @param AttachTagRequest $request
     * @param Exhibition $exhibition
     * @param Tag $tag
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function attach(AttachTagRequest $request, Exhibition $exhibition, Tag $tag)
    {
        $this->authorize('create tags', Exhibition::class);

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
     * @param StoreTagRequest $request
     * @param Tag $tag
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(StoreTagRequest $request, Tag $tag)
    {
        $this->authorize('update tags', $tag);

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
     * @param DeleteTagRequest $request
     * @param Tag $tag
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function delete(DeleteTagRequest $request, Tag $tag)
    {
        $this->authorize('delete tags', $tag);

        $validated = $request->validated();

        $tag = Tag::findOrFail($request->input('id'));
        $tag->delete();

        return redirect()->route('front.tag.index')->with('success', 'All good!');
    }
}
