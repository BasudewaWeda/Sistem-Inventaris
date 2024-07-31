<x-app-layout>
    <div class="px-8 pt-8 pb-2 text-3xl font-semibold text-blue-gray-900">
      	<h1>User Management</h1>
    </div>

    <div class="w-1/2 px-8 pt-8 pb-2 relative text-gray-700 bg-transparent shadow-none rounded-xl bg-clip-border">
        <form action="" method="POST">
            {{ csrf_field() }}
            <div class="grid grid-cols-8 gap-4 items-center mb-4">
                <label 
                for="name" 
                class="col-span-2 block font-sans text-base antialiased font-semibold leading-relaxed tracking-normal text-blue-gray-900">
                    Nama
                </label>
                <input 
                type="text" 
                placeholder="John Doe" 
                name="user_name"
                id="name"
                required
                class="col-span-6 rounded-md border border-blue-gray-200 border-t-transparent !border-t-blue-gray-200 bg-transparent p-3 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 focus:border-1 focus:border-gray-900 focus:border-t-transparent focus:!border-t-gray-900 focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"
                >
            </div>
            <div class="grid grid-cols-8 gap-4 items-center mb-4">
                <label 
                for="email" 
                class="col-span-2 block font-sans text-base antialiased font-semibold leading-relaxed tracking-normal text-blue-gray-900">
                    Email
                </label>
                <input 
                type="email" 
                placeholder="johndoe@gmail.com" 
                required
                id="email"
                name="email"
                class="col-span-6 rounded-md border border-blue-gray-200 border-t-transparent !border-t-blue-gray-200 bg-transparent p-3 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 focus:border-1 focus:border-gray-900 focus:border-t-transparent focus:!border-t-gray-900 focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"
                >
            </div>
            <div class="grid grid-cols-8 gap-4 items-center mb-4">
                <label 
                for="user_phone_number" 
                class="col-span-2 block font-sans text-base antialiased font-semibold leading-relaxed tracking-normal text-blue-gray-900">
                    Phone Number
                </label>
                <input 
                type="text" 
                pattern="^08[1-9][0-9]{7,9}$"
                placeholder="08123456789" 
                required
                id="user_phone_number"
                name="user_phone_number"
                class="col-span-6 rounded-md border border-blue-gray-200 border-t-transparent !border-t-blue-gray-200 bg-transparent p-3 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 focus:border-1 focus:border-gray-900 focus:border-t-transparent focus:!border-t-gray-900 focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"
                >
            </div>
            <div class="grid grid-cols-8 gap-4 items-start mb-4">
                <h6  
                class="mt-2 col-span-2 block font-sans text-base antialiased font-semibold leading-relaxed tracking-normal text-blue-gray-900">
                    Roles
                </h6>
                <div class="grid grid-cols-3 col-span-6 rounded-md border border-blue-gray-200">
                    @foreach ($roles as $role)
                    <div class="inline-flex items-center">
                        <label class="relative flex items-center p-3 rounded-full cursor-pointer" htmlFor="check">
                            <input type="checkbox"
                                class="before:content[''] peer relative h-5 w-5 cursor-pointer appearance-none rounded-md border border-blue-gray-200 transition-all before:absolute before:top-2/4 before:left-2/4 before:block before:h-12 before:w-12 before:-translate-y-2/4 before:-translate-x-2/4 before:rounded-full before:bg-blue-gray-500 before:opacity-0 before:transition-opacity checked:border-gray-900 checked:bg-gray-900 checked:before:bg-gray-900 hover:before:opacity-10"
                                id="check"
                                name="role_ids[]"
                                value="{{ $role->role_id }}" />
                            <span
                                class="absolute text-white transition-opacity opacity-0 pointer-events-none top-2/4 left-2/4 -translate-y-2/4 -translate-x-2/4 peer-checked:opacity-100">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" viewBox="0 0 20 20" fill="currentColor"
                                stroke="currentColor" stroke-width="1">
                                <path fill-rule="evenodd"
                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                clip-rule="evenodd"></path>
                                </svg>
                            </span>
                        </label>
                        <label class="mt-px font-light text-gray-700 cursor-pointer select-none" htmlFor="check">
                            {{ $role->role_name }}
                        </label>
                    </div> 
                    @endforeach
                </div>
            </div>
            <div class="flex gap-4 justify-end">
                <div class="flex">
                    <a 
                        href="/user-management" 
                        data-ripple-dark="true"
                        class="p-2 bg-blue-gray-100 text-blue-gray-700 transition-all rounded-lg outline-none font-semibold text-center hover:bg-blue-gray-50 hover:bg-opacity-80 hover:text-blue-gray-900 hover:cursor-pointer focus:bg-blue-gray-50 focus:bg-opacity-80 focus:text-blue-gray-900 active:bg-blue-gray-50 active:bg-opacity-80 active:text-blue-gray-900 ">
                        Cancel
                    </a>
                </div>
                <div data-ripple-dark="true">
                    <input
                        class="p-2 bg-blue-gray-700 text-white transition-all rounded-lg outline-none font-semibold text-center hover:bg-blue-gray-50 hover:bg-opacity-80 hover:text-blue-gray-900 hover:cursor-pointer focus:bg-blue-gray-50 focus:bg-opacity-80 focus:text-blue-gray-900 active:bg-blue-gray-50 active:bg-opacity-80 active:text-blue-gray-900 "
                        type="submit"
                        value="Add User"
                    />
                </div>
            </div>
        </form>

        {{-- <form class="max-w-screen-lg mt-8 mb-2 w-80 sm:w-96">
            <div class=" gap-6 mb-1">
                <h6
                  class="block -mb-3 font-sans text-base antialiased font-semibold leading-relaxed tracking-normal text-blue-gray-900">
                  Your Name
                </h6>
                <div class="relative h-11 w-full min-w-[200px]">
                  <input placeholder="John Doe"
                    type="text"
                    required
                    class="peer h-full w-full rounded-md border border-blue-gray-200 border-t-transparent !border-t-blue-gray-200 bg-transparent px-3 py-3 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 focus:border-2 focus:border-gray-900 focus:border-t-transparent focus:!border-t-gray-900 focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50" />
                  <label
                    class="before:content[' '] after:content[' '] pointer-events-none absolute left-0 -top-1.5 flex h-full w-full select-none !overflow-visible truncate text-[11px] font-normal leading-tight text-gray-500 transition-all before:pointer-events-none before:mt-[6.5px] before:mr-1 before:box-border before:block before:h-1.5 before:w-2.5 before:rounded-tl-md before:border-t before:border-l before:border-blue-gray-200 before:transition-all before:content-none after:pointer-events-none after:mt-[6.5px] after:ml-1 after:box-border after:block after:h-1.5 after:w-2.5 after:flex-grow after:rounded-tr-md after:border-t after:border-r after:border-blue-gray-200 after:transition-all after:content-none peer-placeholder-shown:text-sm peer-placeholder-shown:leading-[4.1] peer-placeholder-shown:text-blue-gray-500 peer-placeholder-shown:before:border-transparent peer-placeholder-shown:after:border-transparent peer-focus:text-[11px] peer-focus:leading-tight peer-focus:text-gray-900 peer-focus:before:border-t-2 peer-focus:before:border-l-2 peer-focus:before:!border-gray-900 peer-focus:after:border-t-2 peer-focus:after:border-r-2 peer-focus:after:!border-gray-900 peer-disabled:text-transparent peer-disabled:before:border-transparent peer-disabled:after:border-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500"></label>
                </div>
                <h6
                  class="block -mb-3 font-sans text-base antialiased font-semibold leading-relaxed tracking-normal text-blue-gray-900">
                  Your Email
                </h6>
                <div class="relative h-11 w-full min-w-[200px]">
                  <input placeholder="name@mail.com"
                    type="email"
                    required
                    class="peer h-full w-full rounded-md border border-blue-gray-200 border-t-transparent !border-t-blue-gray-200 bg-transparent px-3 py-3 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 focus:border-2 focus:border-gray-900 focus:border-t-transparent focus:!border-t-gray-900 focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50" />
                  <label
                    class="before:content[' '] after:content[' '] pointer-events-none absolute left-0 -top-1.5 flex h-full w-full select-none !overflow-visible truncate text-[11px] font-normal leading-tight text-gray-500 transition-all before:pointer-events-none before:mt-[6.5px] before:mr-1 before:box-border before:block before:h-1.5 before:w-2.5 before:rounded-tl-md before:border-t before:border-l before:border-blue-gray-200 before:transition-all before:content-none after:pointer-events-none after:mt-[6.5px] after:ml-1 after:box-border after:block after:h-1.5 after:w-2.5 after:flex-grow after:rounded-tr-md after:border-t after:border-r after:border-blue-gray-200 after:transition-all after:content-none peer-placeholder-shown:text-sm peer-placeholder-shown:leading-[4.1] peer-placeholder-shown:text-blue-gray-500 peer-placeholder-shown:before:border-transparent peer-placeholder-shown:after:border-transparent peer-focus:text-[11px] peer-focus:leading-tight peer-focus:text-gray-900 peer-focus:before:border-t-2 peer-focus:before:border-l-2 peer-focus:before:!border-gray-900 peer-focus:after:border-t-2 peer-focus:after:border-r-2 peer-focus:after:!border-gray-900 peer-disabled:text-transparent peer-disabled:before:border-transparent peer-disabled:after:border-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500"></label>
                </div>

                <input
                    class="p-2 bg-blue-gray-700 text-white transition-all rounded-lg outline-none font-semibold text-center hover:bg-blue-gray-50 hover:bg-opacity-80 hover:text-blue-gray-900 hover:cursor-pointer focus:bg-blue-gray-50 focus:bg-opacity-80 focus:text-blue-gray-900 active:bg-blue-gray-50 active:bg-opacity-80 active:text-blue-gray-900 "
                    type="submit"
                    value="Add User"
                />
            </div>
        </form> --}}
        

      </div>  

</x-app-layout>