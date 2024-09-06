@props(['icon', 'active'])

<div class="p-2 2xl:py-3 px-1 rounded-lg flex justify-center {{ $active ? 'text-white bg-blue-gray-700' : ''}} ">
    {!! $icon !!}
</div>
