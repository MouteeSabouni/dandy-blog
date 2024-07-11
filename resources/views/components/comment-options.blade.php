<div class="relative text-left">
    <div>
        <button type="button"
                class="comment-options-button inline-flex w-full justify-end gap-x-1.5 text-white px-3 py-2 text-sm font-semibold"
                data-comment-id="{{ $comment->id }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z"></path>
            </svg>
        </button>
    </div>

    <div id="comment-options-{{ $comment->id }}" class="hidden absolute bg-zinc-700 text-white mr-4 w-28 right-0 z-10 origin-top-right rounded-md shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none">
        <button data-comment-id="{{ $comment->id }}"
            class="edit-button hover:bg-zinc-500 hover:rounded w-full text-left px-4 py-2 text-xs"
            >Edit
        </button>

        <form method="POST" action="/comments/{{ $comment->id }}">
            @csrf
            @method('DELETE')

            <button class="w-full text-left px-4 py-2 text-xs hover:bg-zinc-500 hover:rounded" type='submit'>Delete</button>
        </form>
    </div>
</div>
