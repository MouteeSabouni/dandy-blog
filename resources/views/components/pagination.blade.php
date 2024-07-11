
<div class="flex items-center w-fit mt-2 mb-6">
    @foreach ($elements as $element)
    @if (is_array($element))
        @foreach ($element as $page => $url)
            @if ($page == $paginator->currentPage())
                @if($paginator->hasPages())
                    <p class="px-2 font-extrabold text-xl"><span>{{ $page }}</span></p>
                @endif
            @else
                <a class="px-2.5 py-2 rounded-lg bg-zinc-700 mx-1 hover:scale-110" href="{{ $url }}">{{ $page }}</a>
            @endif
        @endforeach
    @endif
@endforeach
</div>
