<div>
    @if (Auth::check() && $exhibition->isFollowed)
    <form method="POST" action="{{ route('admin.user.exhibition_unfollow') }}" class="flex justify-center w-full">
        @csrf

        <input type="hidden" name="follow" value="{{ $exhibition->hasOne(\App\Models\UserExhibition::class)->first()->uuid }}" />

        <x-forms.button class="block mt-1 bg-transparent">
            <svg xmlns="http://www.w3.org/2000/svg" class="text-yellow-500 h-6 w-6" fill="yes" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6M3 17V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
            </svg>
            @ucfirst(__('app.unfollow_the', ['what' => $exhibition->title]))
        </x-forms.button>
    </form>
    @else
    <form method="POST" action="{{ route('admin.user.exhibition_follow') }}" class="flex justify-center w-full">
        @csrf

        <input type="hidden" name="uuid" value="{{ $exhibition->uuid }}" />

        <x-forms.button class="block mt-1 bg-transparent">
            <svg xmlns="http://www.w3.org/2000/svg" class="text-black h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
            </svg>
        </x-forms.button>
    </form>
    @endif
</div>
