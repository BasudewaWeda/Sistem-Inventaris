<x-app-layout>
    <div class="px-1 md:px-2 xl:px-8 pt-1 md:pt-2 xl:pt-8 pb-2 text-3xl font-semibold text-blue-gray-900">
      	<h1>User Management</h1>
    </div>

    @if ($errors->any())
    <div role="alert"
      class="xl:w-1/2 relative flex p-1 md:p-2 xl:p-4 mx-1 md:mx-2 xl:mx-8 text-sm sm:text-base text-gray-900 border border-gray-900 rounded-lg font-regular"
      style="opacity: 1;">
      <div class="shrink-0"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
          class="w-6 h-6">
          <path fill-rule="evenodd"
            d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm8.706-1.442c1.146-.573 2.437.463 2.126 1.706l-.709 2.836.042-.02a.75.75 0 01.67 1.34l-.04.022c-1.147.573-2.438-.463-2.127-1.706l.71-2.836-.042.02a.75.75 0 11-.671-1.34l.041-.022zM12 9a.75.75 0 100-1.5.75.75 0 000 1.5z"
            clip-rule="evenodd"></path>
        </svg></div>
      <div class="m-1 xl:ml-3 mr-1 md:mr-4 xl:mr-12">
        <p class="block font-sans text-sm sm:text-base antialiased font-medium leading-relaxed text-inherit">Errors occured:</p>
        <ul class="mt-2 ml-2 list-disc list-inside">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div>
    </div>
    @endif

    <div class="lg:w-1/2 px-1 md:px-2 xl:px-8 pt-1 md:pt-2 xl:pt-8 pb-2 relative text-gray-700 bg-transparent shadow-none rounded-xl bg-clip-border">
        <form action="" method="POST">
            {{ csrf_field() }}
            <div class="grid grid-cols-8 gap-1 sm:gap-4 items-center mb-2 xl:mb-4">
                <label 
                for="name" 
                class="col-span-2 block font-sans text-sm sm:text-base antialiased font-semibold leading-relaxed tracking-normal text-blue-gray-900">
                    Nama
                </label>
                <input 
                type="text" 
                placeholder="John Doe" 
                name="user_name"
                id="name"
                required
                value="{{ old('user_name') ?? $user->user_name }}"
                class="col-span-6 rounded-md border border-blue-gray-200 border-t-transparent !border-t-blue-gray-200 bg-transparent p-2 sm:p-3 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 focus:border-1 focus:border-gray-900 focus:border-t-transparent focus:!border-t-gray-900 focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"
                >
            </div>
            <div class="grid grid-cols-8 gap-1 sm:gap-4 items-center mb-2 xl:mb-4">
                <label 
                for="email" 
                class="col-span-2 block font-sans text-sm sm:text-base antialiased font-semibold leading-relaxed tracking-normal text-blue-gray-900">
                    Email
                </label>
                <input 
                type="email" 
                placeholder="johndoe@gmail.com" 
                required
                id="email"
                name="email"
                value="{{ old('email') ?? $user->email }}"
                class="col-span-6 rounded-md border border-blue-gray-200 border-t-transparent !border-t-blue-gray-200 bg-transparent p-2 sm:p-3 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 focus:border-1 focus:border-gray-900 focus:border-t-transparent focus:!border-t-gray-900 focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"
                >
            </div>
            <div class="grid grid-cols-8 gap-1 sm:gap-4 items-center mb-2 xl:mb-4">
                <label 
                for="user_phone_number" 
                class="col-span-2 block font-sans text-sm sm:text-base antialiased font-semibold leading-relaxed tracking-normal text-blue-gray-900">
                    Phone Number
                </label>
                <input 
                type="text" 
                pattern="^08[1-9][0-9]{7,10}$"
                title="Nomor telepon harus dimulai dengan '08', diikuti oleh 8 hingga 11 digit angka."
                placeholder="08123456789" 
                required
                id="user_phone_number"
                name="user_phone_number"
                value="{{ old('user_phone_number') ?? $user->user_phone_number }}"
                class="col-span-6 rounded-md border border-blue-gray-200 border-t-transparent !border-t-blue-gray-200 bg-transparent p-2 sm:p-3 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 focus:border-1 focus:border-gray-900 focus:border-t-transparent focus:!border-t-gray-900 focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"
                >
            </div>
            <div class="grid grid-cols-8 gap-4 items-start mb-4">
                <h6  
                class="mt-2 col-span-2 block font-sans text-sm sm:text-base antialiased font-semibold leading-relaxed tracking-normal text-blue-gray-900">
                    Roles
                </h6>
                <div class="grid grid-cols-3 col-span-6 rounded-md border border-blue-gray-200">
                    @foreach ($roles as $role)
                    <div class="inline-flex items-center">
                        <label class="relative flex items-center p-2 sm:p-3 rounded-full cursor-pointer" htmlFor="check">
                            <input type="checkbox"
                                class="before:content[''] peer relative h-5 w-5 cursor-pointer appearance-none rounded-md border border-blue-gray-200 transition-all before:absolute before:top-2/4 before:left-2/4 before:block before:h-12 before:w-12 before:-translate-y-2/4 before:-translate-x-2/4 before:rounded-full before:bg-blue-gray-500 before:opacity-0 before:transition-opacity checked:border-gray-900 checked:bg-gray-900 checked:before:bg-gray-900 hover:before:opacity-10"
                                id="check"
                                name="role_ids[]"
                                value="{{ $role->role_id }}"
                                @if (!empty(old('role_ids')))
                                    {{ in_array($role->role_id, old('role_ids', [])) ? 'checked' : '' }}
                                @else
                                    {{ $user_roles->contains('role_id', $role->role_id) ? 'checked' : '' }}
                                @endif
                                />
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
                        <label class="mt-px font-light text-gray-700 cursor-pointer text-sm sm:text-base select-none" htmlFor="check">
                            {{ $role->role_name }}
                        </label>
                    </div> 
                    @endforeach
                </div>
            </div>
            <div class="grid grid-cols-8 gap-1 sm:gap-4 items-center mb-2 xl:mb-4">
                <label 
                for="status" 
                class="col-span-2 block font-sans text-sm sm:text-base antialiased font-semibold leading-relaxed tracking-normal text-blue-gray-900">
                    Status
                </label>
                <div class="col-span-6">
                    <select
                    class="peer h-full w-full rounded-[7px] border border-blue-gray-200 bg-transparent p-2 sm:p-3 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 empty:!bg-gray-900 focus:border-1 focus:border-gray-900 focus:border-t-transparent focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"
                    name="status"
                    id="status"
                    >
                        <option value="active" @if ($user->status == 'active') selected @endif>Active</option>
                        <option value="inactive" @if ($user->status == 'inactive') selected @endif>Inactive</option>
                    </select>
                </div>
            </div>
            <div class="flex justify-between">
                <div class="flex">
                    <a 
                        href="/user-management/reset-password/{{ $user->slug }}" 
                        data-ripple-dark="true"
                        class="p-2 bg-blue-gray-700 text-white transition-all rounded-lg outline-none font-semibold text-center hover:bg-blue-gray-50 hover:bg-opacity-80 hover:text-blue-gray-900 hover:cursor-pointer focus:bg-blue-gray-50 focus:bg-opacity-80 focus:text-blue-gray-900 active:bg-blue-gray-50 active:bg-opacity-80 active:text-blue-gray-900 ">
                        Reset Password
                    </a>
                </div>
                <div class="flex gap-1 sm:gap-4 justify-end">
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
                            value="Save User"
                        />
                    </div>
                </div>
            </div>
        </form>
    </div>
    <script type="text/javascript">	
        $(document).ready(function() {
            $('#status').select2();
        });
    </script>
</x-app-layout>