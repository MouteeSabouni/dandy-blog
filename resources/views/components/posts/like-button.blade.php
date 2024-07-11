<?php

// $class = (auth()->user()->hasLiked($post)) ? "border border-red-600" : "border border-white";
// $route = (auth()->user()->hasLiked($post)) ? "posts.unlike" : "posts.like";

?>

{{-- <form action="{{ route($route, $post->id) }}" method="POST">
    @csrf

    <button type="submit">
        <div class="flex items-center text-sm {{ $class }} px-4 py-1 rounded-full">
            @if(auth()->user()->hasLiked($post))
                <img src="/images/liked.svg" class="img-responsive pr-1 h-6 w-6">
                <span class="text-red-600">Unlike</span>
            @else
                <img src="/images/unliked.svg" class="img-responsive pr-1 h-6 w-6">
                Like
            @endif
        </div>
    </button>
</form> --}}

@php
    $user = auth()->user();
    $hasLiked = $user->hasLiked($post);
    $class = $hasLiked ? 'text-red-600' : 'text-white';
@endphp

<form id="like-form-{{ $post->id }}" action="{{ route($hasLiked ? 'posts.unlike' : 'posts.like', $post->id) }}" method="POST">
    @csrf
    <button type="button" class="like-button" data-post-id="{{ $post->id }}" data-liked="{{ $hasLiked }}">
        <div class="flex items-center text-sm {{ $hasLiked ? 'border border-red-600' : 'border border-white' }} px-4 py-1 rounded-full hover:border-red-600">
            <img src="/images/{{$hasLiked ? 'liked.svg' : 'unliked.svg'}}" class="img-responsive pr-1 h-6 w-6">
            <span class="-mb-0.5 {{ $class }}">{{$hasLiked ? 'Unlike' : 'Like'}}</span>
        </div>
    </button>
</form>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    //Like button functionality
    $(document).ready(function() {
            $('.like-button').on('click', function() {
                var button = $(this);
                var postId = button.data('post-id');
                var liked = button.data('liked');
                var url = liked ? '{{ route('posts.unlike', ':id') }}' : '{{ route('posts.like', ':id') }}';
                url = url.replace(':id', postId);

                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        // Update the button UI
                        if (liked) {
                            button.data('liked', false);
                            button.find('img').attr('src', '/images/unliked.svg');
                            button.find('span').removeClass('text-red-600').addClass('text-white').text('Like');
                            button.find('div').removeClass('border-red-600').addClass('border-white');
                        } else {
                            button.data('liked', true);
                            button.find('img').attr('src', '/images/liked.svg');
                            button.find('span').removeClass('text-white').addClass('text-red-600').text('Unlike');
                            button.find('div').removeClass('border-white').addClass('border-red-600');
                        }
                        // Update the like count
                        $(document).trigger('like-updated', [postId, response.likes_count]);
                    }
                });
            });
        });

        $(document).on('like-updated', function(event, postId, likesCount) {
            $('#like-count-' + postId).text(likesCount);
        });
</script>
