<x-layouts.blog>
    <title>{{ env('owner') }} — Blog</title>

    <x-slot:heading>
        @if(request()->is('posts'))
            Our newest posts
        @elseif(request()->is('oldest-posts'))
            Our oldest posts
        @elseif(request()->is('featured-posts'))
            Our Featured Posts
        @elseif(request()->is('posts-by-user/*'))
            {{ auth()->user()->name }}'s posts
        @endif
    </x-slot:heading>

    @foreach ($posts as $post)
        <div class="py-2">
            <x-posts.panel class="flex flex-col">

                @if(count($post->tags) !== 0)
                    <div class="mb-4">
                        @foreach($post->tags as $tag)
                            <x-posts.tag :$tag size="small" />
                        @endforeach
                    </div>
                @endif

                <div class="self-start text-2xl font-extrabold">{{ $post->title }}</div>

                <div class="space-y-3 pt-2">
                    <h3 class="text-xl font-bold transition-colors duration-300">
                            {{ $post->excerpt }}
                    </h3>

                    <h3 class="text-base transition-colors duration-300">
                        {{ $post->body }}
                    </h3>
                </div>
                <div class="text-sm mt-4 flex items-center">
                    <div class="flex items-center">
                        <img class="h-5 w-5 ml-1 mr-0.5" src="/images/heart.svg" />
                        <p id="like-count-{{ $post->id }}">
                            {{ count($post->likes) }}
                        </p>
                        <img class="h-5 w-5 ml-2 mr-0.5" src="/images/chat.svg" />
                        <p>
                            {{ count($post->comments) }}
                        </p>
                    </div>
                </div>
                <div class="flex justify-between">
                    <div class="flex space-x-2 mt-4">
                        <x-posts.like-button :$post />

                        <button class="comment-button" data-post-id="{{ $post->id }}">
                            <div class="flex items-center text-sm border border-white px-4 py-1 rounded-full hover:border-blue-600">
                                <img src="/images/comment.svg" class="img-responsive pr-1 h-6 w-6">
                                Comment
                            </div>
                        </button>
                        <button>
                            <a href="posts/{{$post->id}}">
                                <div class="flex items-center text-sm hover:underline">
                                    <img src="/images/view.svg" class="img-responsive pr-1 h-6 w-6">
                                    View post
                                </div>
                            </a>
                        </button>
                    </div>

                    <div class="text-sm  flex items-end mb-1">
                        by<a class="mx-1 text-gray-400 hover:underline" href="posts-by-user/{{ $post->user->id }}">{{ $post->user->name }}</a>{{ $post->created_at->diffForHumans() }}
                    </div>
                </div>

                <div id="comment-section-{{ $post->id }}" class="comment-section hidden mt-3">
                    <form action="{{$post->path()}}/comments" method="POST">
                        @csrf

                        <input name="body" class="rounded-full w-full bg-zinc-700 py-2 px-5 text-white placeholder:text-base placeholder:text-input-text sm:text-sm sm:leading-6 input-field" placeholder="Write your comment...">
                    </form>
                </div>
            </x-posts.panel>
        </div>
    @endforeach
    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            document.querySelectorAll('.comment-button').forEach(button => {
                button.addEventListener('click', () => {
                    const postId = button.getAttribute('data-post-id');
                    const commentSection = document.getElementById(`comment-section-${postId}`);
                    commentSection.classList.toggle('hidden');
                });
            });
        });
    </script>
</x-layouts.blog>
