<div class="p-4 rounded-xl">
    <div class="space-y-3">
        <h3 class="text-2xl font-extrabold transition-colors duration-300">
            {{ str($post->title)->words(10) }}
        </h3>
        @if(count($post->tags) !== 0)
            <div class="flex-1">
                @foreach($post->tags as $tag)
                <a href="/posts-by-tag/{{ strtolower($tag->name) }}" class = "bg-dandy-orange opacity-80 hover:py-2 hover:animate-pulse rounded-xl font-bold transition-colors duration-300 mr-1.5 px-3 py-1 text-xs">
                    {{ ucwords($tag->name) }}
                </a>
                @endforeach
            </div>
        @endif
        <h3 class="text-base transition-colors duration-300">
            {{ str($post->body)->words(20) }}
        </h3>
        <div class="flex justify-between mt-2">
            <div class="text-sm flex items-center">
                <img class="h-5 w-5" src="/images/heart.svg" />
                <p id="like-count-{{ $post->id }}">
                    {{ count($post->likes) }}
                </p>
            </div>
            <div class="text-sm">
                by<a class="mx-1 text-orange-600 hover:underline" href="/posts-by-user/{{ $post->user->id }}">{{ $post->user->name }}</a>{{ $post->created_at->diffForHumans() }}
            </div>
        </div>
    </div>

    <div id="comment-section-{{ $post->id }}" class="comment-section hidden mt-3">
        <form action="{{$post->path()}}/comments" method="POST">
            @csrf

            <input class="rounded-full w-full bg-zinc-700 py-2 px-5 text-white placeholder:text-base placeholder:text-input-text sm:text-sm sm:leading-6 input-field" placeholder="Write your comment...">
        </form>
    </div>
</div>

