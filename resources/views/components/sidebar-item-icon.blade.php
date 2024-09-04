@props(['icon', 'active'])

<div class="py-3 px-1 rounded-lg {{ $active ? 'text-white bg-blue-gray-700' : ''}} ">
    {!! $icon !!}
</div>
