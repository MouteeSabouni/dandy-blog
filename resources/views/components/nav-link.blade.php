@props(['active' => false])

<a
    class="{{ $active ? 'underline text-dandy-orange': 'text-gray-200 hover:underline hover:text-dandy-orange'}} py-2 text-sm font-medium"
    aria current = "{{ $active ? 'page': 'false'}}"
    {{ $attributes }}
    >{{$slot}}
</a>
