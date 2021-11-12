<div class="flex-grow bg-indigo-300 p-5 rounded shadow w-full">
    <h3 class="font-bold text-2xl mb-5">
        <a href="{{ route('front.tag.index') }}">
            @ucfirst(__('app.tagcloud'))
        </a>
    </h3>
    @if(count($tags) > 0)
    <div class="grid grid-cols-1 lg:grid-cols-4 sm:gap-2 lg:gap-4">
        @foreach($tags as $tag)
        <div class="bg-indigo-500 text-white m-2 p-2 rounded" title="@ucfirst(__('app.type_is', ['type' => $tag->type]))">
            <a href="{{ route('front.tag.show', ['slug' => $tag->slug]) }}" class="flex flex-grow justify-between">
                <span class="px-3">@ucfirst($tag->name)</span>
                <span class="px-3">{{ $tag->has_exhibitions_count }}</span>
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
