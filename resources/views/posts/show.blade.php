<x-layouts.blog>
    <title>{{ env('owner') }} — Blog</title>

    <x-slot:heading>
        {{ $post->title }}
    </x-slot:heading>

    <div class="pb-6 pt-2">
        <div class="flex justify-between">
            <div>
                <h3 class="text-xl font-bold transition-colors duration-300">{{ $post->excerpt }}</h3>
            </div>
            @can('manage', $post)
                <div class="font-bold">
                    <x-posts.post-options :$post />
                </div>
            @endcan
        </div>

        <h3 class="mt-12">{{ $post->body }}</h3>
    </div>
    <div class="flex items-center">
        <img class="h-5 w-5 ml-1" src="/images/heart.svg" />
        <p id="like-count-{{ $post->id }}">
            {{ count($post->likes) }}
        </p>
    </div>
    <div class="flex justify-between">
        <div class="flex space-x-2 mt-4">

            <x-posts.like-button :$post />
        </div>

        <div class="text-sm mt-4 flex items-center">
            by<a class="mx-1 text-gray-400 hover:underline" href="/posts-by-user/{{ $post->user->id }}">{{ $post->user->name }}</a>{{ $post->created_at->diffForHumans() }}
        </div>
    </div>

    <div class="mb-6">
        <form action="{{$post->path()}}/comments" method="POST">
            @csrf

            <x-forms.input class="mt-6 w-full" placeholder="Write a comment" name="body" id="body"></x-forms.input>
        </form>

        @foreach($post->comments as $comment)
        <div class="flex justify-between">
            <div class="flex items-center rounded-full px-3">
                <img src="/images/profile-new.jpg" class="rounded-2xl h-14 w-14">
            </div>

            <div class="w-full hidden" id="edit-comment-{{ $comment->id }}">
                <div class="mt-2 w-full bg-input-bg py-4 px-5 text-white rounded-3xl">
                    <div class="flex flex-col justify-between space-y-1.5">

                        <p class="font-bold mb-1">{{ $comment->user->name }}</p>

                        <form action='{{ $post->path() . "/comments/$comment->id"  }}' method="POST">
                            @csrf
                            @method('PATCH')

                            <textarea
                            rows="3"
                            class="resize-none overflow-auto bg-input-bg py-2 px-5 text-white placeholder:text-base placeholder:text-input-text sm:text-sm sm:leading-6 w-full rounded-3xl"
                            type="text"
                            name="body"
                            required
                            >{{ old('body') ?? $comment->body }}</textarea>

                        </div>
                        <div class="flex justify-end space-x-2 mt-2">
                            <x-forms.button type="button" data-comment-id="{{ $comment->id }}" class="cancel-edit-button bg-gray-600 w-fit">Cancel</x-forms.button>
                            <x-forms.button class="w-fit" type="submit">Save</x-forms.button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="w-full" id="comment-{{ $comment->id }}">
                <div class="mt-2 w-full bg-input-bg py-4 px-5 flex justify-between text-white rounded-3xl">
                    <div class="flex flex-col justify-between space-y-1.5">

                        <p class="font-bold">{{ $comment->user->name }}</p>

                        <p class="text-gray-300">{{ $comment->body }}</p>
                        <div>
                            <p class="text-xs text-gray-400">
                                {{ $comment->updated_at->format('M d \a\t h:i A') }}
                            </p>
                        </div>
                    </div>
                    <div class="flex flex-col items-end">
                        @if($comment->user_id === auth()->id())
                            <div>
                                <x-comment-options :$comment />
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <script>
        //Edit the comment body when clicking on the edit button
        document.addEventListener('DOMContentLoaded', (event) => {
            document.querySelectorAll('.edit-button').forEach(button => {
                button.addEventListener('click', () => {
                    const commentId = button.getAttribute('data-comment-id');
                    const comment = document.getElementById(`comment-${commentId}`);
                    const commentEdit = document.getElementById(`edit-comment-${commentId}`);
                    comment.classList.add('hidden');
                    document.getElementById(`comment-options-${commentId}`).classList.add('hidden');
                    commentEdit.classList.remove('hidden');

                    const textarea = commentEdit.querySelector('textarea');
                    textarea.focus();
                    textarea.setSelectionRange(textarea.value.length, textarea.value.length);
                });
            });
        });

        //Hide edit comment section when clicking on cancel button
        document.addEventListener('DOMContentLoaded', (event) => {
            document.querySelectorAll('.cancel-edit-button').forEach(button => {
                button.addEventListener('click', () => {
                    const commentId = button.getAttribute('data-comment-id');
                    const comment = document.getElementById(`comment-${commentId}`);
                    const commentEdit = document.getElementById(`edit-comment-${commentId}`);
                    comment.classList.remove('hidden');
                    document.getElementById(`comment-options-${commentId}`).classList.remove('hidden');
                    commentEdit.classList.add('hidden');
                });
            });
        });

        //Show post options when clicking on the post-options button
        document.addEventListener('DOMContentLoaded', (event) => {
            const postOptionsButton = document.querySelectorAll('.post-options-button');

            if (postOptionsButton.length > 0) {
                postOptionsButton.forEach(button => {
                    button.addEventListener('click', (event) => {
                        const postId = event.currentTarget.getAttribute('data-post-id');
                        const postOptions = document.getElementById(`post-options-${postId}`);
                        postOptions.classList.toggle('hidden');
                    });
                });
            }
        });

        //Hide post options when clicking outside of it
        document.addEventListener('click', (event) => {
                const postOptionsButton = document.querySelector('.post-options-button');
                const postId = postOptionsButton.getAttribute('data-post-id');
                const postOptions = document.getElementById(`post-options-${postId}`);
                if (!postOptionsButton.contains(event.target) && !postOptions.contains(event.target)) {
                    postOptions.classList.add('hidden');
                }
            });

        //Show comment options and hide it
        document.addEventListener('DOMContentLoaded', () => {
            const buttons = document.querySelectorAll('.comment-options-button');

            //Show comment options dropdown when clicking on the comment-options button
            buttons.forEach(button => {
                button.addEventListener('click', (event) => {
                    event.stopPropagation();
                    const commentId = button.getAttribute('data-comment-id');
                    const commentOptions = document.getElementById(`comment-options-${commentId}`);
                    commentOptions.classList.toggle('hidden');
                    const postOptionsButton = document.querySelector('.post-options-button');
                    if (postOptionsButton) {
                        const postId = postOptionsButton.getAttribute('data-post-id');
                        const postOptions = document.getElementById(`post-options-${postId}`);
                        postOptions.classList.add('hidden');
                    }

                    // Hide other comment options when clicking on a different one
                    buttons.forEach(otherButton => {
                        if (otherButton !== button) {
                            const otherCommentId = otherButton.getAttribute('data-comment-id');
                            const otherCommentOptions = document.getElementById(`comment-options-${otherCommentId}`);
                            otherCommentOptions.classList.add('hidden');
                        }
                    });
                });
            });
            // Hide the comment options when clicking outside of it
            document.addEventListener('click', (event) => {
                buttons.forEach(button => {
                    const commentId = button.getAttribute('data-comment-id');
                    const commentOptions = document.getElementById(`comment-options-${commentId}`);
                    if (!commentOptions.classList.contains('hidden')) {
                        if (!button.contains(event.target) && !commentOptions.contains(event.target)) {
                            commentOptions.classList.add('hidden');
                        }
                    }
                });
            });
        });
    </script>
</x-layouts.blog>
