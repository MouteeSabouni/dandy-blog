<x-layouts.blog>
    <title>{{ env('owner') }} — Blog</title>

    <x-slot:heading>
        @if(request()->is('posts'))
            Our newest posts
        @elseif(request()->is('oldest-posts'))
            Our oldest posts
        @elseif(request()->is('featured-posts'))
            Our featured posts
        @elseif(request()->is('posts-by-user/*'))
            {{ $user->name }}'s posts
        @endif
    </x-slot:heading>

    @foreach ($posts as $post)
        <div class="py-2">
            <x-posts.card :$post />
        </div>
    @endforeach

</x-layouts.blog>
<div class="flex justify-center">
    {{ $posts->links() }}
</div>

<script>
    //Show comment section when clicking on the comment button
    document.querySelectorAll('.comment-button').forEach(button => {
        button.addEventListener('click', () => {
            const postId = button.getAttribute('data-post-id');
            const commentSection = document.getElementById(`comment-section-${postId}`);
            const commentDiv = document.getElementById(`comment-div-${postId}`);
            commentSection.classList.toggle('hidden');
            commentDiv.classList.toggle('border-white');
            commentDiv.classList.toggle('border-blue-600');
        });
    });

    document.addEventListener('DOMContentLoaded', () => {
        const buttons = document.querySelectorAll('.post-options-button');

        //Show post options dropdown when clicking on the post-options button
        buttons.forEach(button => {
            button.addEventListener('click', (event) => {
                const postId = button.getAttribute('data-post-id');
                const postOptions = document.getElementById(`post-options-${postId}`);
                postOptions.classList.toggle('hidden');

                // Hide all other dropdowns
                buttons.forEach(otherButton => {
                    if (otherButton !== button) {
                        const otherPostId = otherButton.getAttribute('data-post-id');
                        const otherPostOptions = document.getElementById(`post-options-${otherPostId}`);
                        otherPostOptions.classList.add('hidden');
                    }
                });
            });
        });

        // Hide all the shown dropdown when clicking outside of it
        document.addEventListener('click', (event) => {
            buttons.forEach(button => {
                const postId = button.getAttribute('data-post-id');
                const postOptions = document.getElementById(`post-options-${postId}`);
                if (!postOptions.classList.contains('hidden')) {
                    // Check if the click is outside the button and the dropdown menu
                    if (!button.contains(event.target) && !postOptions.contains(event.target)) {
                        postOptions.classList.add('hidden');
                    }
                }
            });
        });
    });
</script>
