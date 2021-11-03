<div class="flex-grow bg-sky-100 p-5 w-full">
    <h3 class="font-bold text-2xl mb-5">@ucfirst(__('app.tagcloud'))</h3>
    @if(count($tags) > 0)
    <div class="grid grid-cols-1 lg:grid-cols-4 sm:gap-2 lg:gap-4">
        @foreach($tags as $tag)
        <div class="bg-indigo-300 hover:bg-white m-2 p-2 rounded" title="@ucfirst(__('app.type_is', ['type' => $tag->type]))">
            <a href="{{ route('front.tag.show', ['slug' => $tag->slug]) }}" class="flex flex-grow justify-center text-center">
                @ucfirst($tag->name) ({{ $tag->count() }})
            </a>
        </div>
        @endforeach
    </div>
    @else
    <div class="grid grid-cols-1">
        <p>@ucfirst(__('app.nothing')).</p>
    </div>
    @endif
</div>
