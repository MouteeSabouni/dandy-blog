@props(['active' => false])

<a
    class="{{ $active ? 'underline text-white': 'text-gray-200 hover:underline'}} py-2 text-sm font-medium"
    aria current = "{{ $active ? 'page': 'false'}}"
    {{ $attributes }}
    >{{$slot}}
</a>
