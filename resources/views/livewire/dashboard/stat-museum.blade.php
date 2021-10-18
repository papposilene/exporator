<div class="flex-grow bg-purple-100 p-5 w-full">
    <h3 class="font-bold text-2xl mb-5">@ucfirst(__('app.museums'))</h3>
    <h4 class="font-bold text-1xl mb-2">@ucfirst(__('app.statistics'))</h4>
    <ol class="list-inside list-disc">
        <li class="font-bold">
            <a href="{{ route('front.museum.index') }}" class="text-black hover:text-red-600">
                @ucfirst(__('app.numbers_of_museums', ['count' => $museums]))
            </a>
        </li>
        <li>
            <a href="{{ route('front.museum.index', ['filter' => 'museum']) }}" class="text-black hover:text-red-600">
                @ucfirst(__('app.numbers_of_museum_type', ['count' => $museum_type]))
            </a>
        </li>
        <li>
            <a href="{{ route('front.museum.index', ['filter' => 'gallery']) }}" class="text-black hover:text-red-600">
                @ucfirst(__('app.numbers_of_gallery_type', ['count' => $gallery_type]))
            </a>
        </li>
        <li>
            <a href="{{ route('front.museum.index', ['filter' => 'art-center']) }}" class="text-black hover:text-red-600">
                @ucfirst(__('app.numbers_of_artcenter_type', ['count' => $artcenter_type]))
            </a>
        </li>
        <li>
            <a href="{{ route('front.museum.index', ['filter' => 'art-fair']) }}" class="text-black hover:text-red-600">
                @ucfirst(__('app.numbers_of_artfair_type', ['count' => $artfair_type]))
            </a>
        </li>
        <li>
            <a href="{{ route('front.museum.index', ['filter' => 'library']) }}" class="text-black hover:text-red-600">
                @ucfirst(__('app.numbers_of_library_type', ['count' => $library_type]))
            </a>
        </li>
        <li>
            <a href="{{ route('front.museum.index', ['filter' => 'foundation']) }}" class="text-black hover:text-red-600">
                @ucfirst(__('app.numbers_of_foundation_type', ['count' => $foundation_type]))
            </a>
        </li>
        <li>
            <a href="{{ route('front.museum.index', ['filter' => 'other']) }}" class="text-black hover:text-red-600">
                @ucfirst(__('app.numbers_of_other_type', ['count' => $other_type]))
            </a>
        </li>
    </ol>
    <!-- h4 class="font-bold text-1xl mt-5 mb-2">@ucfirst(__('app.no_exhibition'))</h4>
    <ol class="list-inside list-disc">
        @if(count($open_museums_without_exhibition) > 0)
        @foreach($open_museums_without_exhibition->where('has_exhibitions_count', 0) as $no_exhibition)
        <li>
            <a href="{{ route('admin.museum.show', ['slug' => $no_exhibition->slug]) }}">
                {{ $no_exhibition->name }}
            </a>
        </li>
        @endforeach
        @else
        <li>
            @ucfirst(__('app.nothing')).
        </li>
        @endif
    </ol -->
</div>
