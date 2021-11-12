<div id="modalCreateReview" class="relative float-right mr-2">
    <div id="modalButtonCreateReview">
        <a href="{{ route('admin.review.create', ['uuid' => $exhibition->uuid]) }}"
            class="focus:outline-none bg-purple-300 text-black bg-opacity-75 px-1 rounded"
            type="button" title="@ucfirst(__('app.write_one_review'))">
            @ucfirst(__('app.write_one_review'))
        </a>
    </div>
</div>
