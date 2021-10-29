<div class="flex-grow bg-blue-100 p-5 w-full">
    <h3 class="font-bold text-2xl mb-5">@ucfirst(__('app.tagcloud'))</h3>
    <ol class="list-inside list-disc">
        <li>@ucfirst(__('app.user_following_places', ['count' => $user->followedPlaces()->count()]))</li>
        <li>@ucfirst(__('app.user_following_exhibitions', ['count' => $user->followedExhibitions()->count()]))</li>
        <li>@ucfirst(__('app.user_following_tags', ['count' => $user->followedTags()->count()]))</li>
    </ol>
</div>
