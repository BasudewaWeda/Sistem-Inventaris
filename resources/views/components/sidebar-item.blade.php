@props(['name', 'icon', 'url', 'active', 'isLogOut'])

<div role="button" 
    onclick="{{ $isLogOut ? 'logout(event)' : "window.location.href='$url'" }}"
    data-ripple-dark="true"
        class="menu-link flex items-center p-1 2xl:p-3 leading-tight transition-all rounded-lg outline-none text-start {{ $active ? 'text-white bg-blue-gray-700' : 'hover:bg-blue-gray-50 hover:bg-opacity-80 hover:text-blue-gray-900 focus:bg-blue-gray-50 focus:bg-opacity-80 focus:text-blue-gray-900 active:bg-blue-gray-50 active:bg-opacity-80 active:text-blue-gray-900'}} ">
          <div class="mr-2 2xl:mr-4 flex justify-center">
            {!! $icon !!}
        </div>
    {{ $name }}
</div>