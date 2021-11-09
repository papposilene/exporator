<div>
    @if (Auth::check() && $tag->isFollowed)
    <form method="POST" action="{{ route('admin.user.tag_unfollow') }}" class="flex justify-center w-full">
        @csrf

        <input type="hidden" name="follow" value="{{ $tag->hasOne(\App\Models\UserTag::class)->first()->uuid }}" />

        <x-forms.button class="block mt-1 bg-transparent">
            <svg xmlns="http://www.w3.org/2000/svg" class="bg-yellow-500 text-black h-6 w-6" fill="yes" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
            </svg>
        </x-forms.button>
    </form>
    @else
    <form method="POST" action="{{ route('admin.user.tag_follow') }}" class="flex justify-center w-full">
        @csrf

        <input type="hidden" name="tag" value="{{ $tag->id }}" />

        <x-forms.button class="block mt-1 bg-transparent">
            <svg xmlns="http://www.w3.org/2000/svg" class="text-black h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
            </svg>
        </x-forms.button>
    </form>
    @endif
</div>
