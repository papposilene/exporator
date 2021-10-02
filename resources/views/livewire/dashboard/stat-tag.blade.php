<div class="flex-grow bg-indigo-100 p-5 w-full">
    <h3 class="font-bold text-2xl mb-5">@ucfirst(__('app.tagcloud'))</h3>
    <div class="grid sm:grid-cols-1 lg:grid-cols-5 gap-4">
        @foreach($tags as $tag)
        <div class="bg-indigo-300 hover:bg-white m-2 p-2 text-center rounded" title="@ucfirst(__('app.type_is', ['type' => $tag->type]))">
            <a href="{{ route('front.tag.show', ['slug' => $tag->slug]) }}">
                {{ $tag->name }}
            </a>
        </div>
        @endforeach
    </div>
</div>
