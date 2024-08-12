<x-app-layout>
    <div class="px-8 pt-8 pb-2 text-3xl font-semibold text-blue-gray-900">
      	<h1>Profile</h1>
    </div>

    @if ($errors->any())
    <div role="alert"
      class="w-1/2 relative flex p-4 mx-8 text-base text-gray-900 border border-gray-900 rounded-lg font-regular"
      style="opacity: 1;">
      <div class="shrink-0"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
          class="w-6 h-6">
          <path fill-rule="evenodd"
            d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm8.706-1.442c1.146-.573 2.437.463 2.126 1.706l-.709 2.836.042-.02a.75.75 0 01.67 1.34l-.04.022c-1.147.573-2.438-.463-2.127-1.706l.71-2.836-.042.02a.75.75 0 11-.671-1.34l.041-.022zM12 9a.75.75 0 100-1.5.75.75 0 000 1.5z"
            clip-rule="evenodd"></path>
        </svg></div>
      <div class="ml-3 mr-12">
        <p class="block font-sans text-base antialiased font-medium leading-relaxed text-inherit">Errors occured:</p>
        <ul class="mt-2 ml-2 list-disc list-inside">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div>
    </div>
    @endif

    <div class="w-10/12 px-8 pt-8 pb-2 relative text-gray-700 bg-transparent shadow-none rounded-xl bg-clip-border">
        <div class="w-4/6 grid grid-cols-10 items-center mb-4 border-b-2">
            <p  
            class="col-span-2 block font-sans text-base antialiased font-semibold leading-relaxed tracking-normal text-blue-gray-900">
                Nama
            </p>
            <p
            class="col-span-8 bg-transparent font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 focus:border-1 focus:border-gray-900 focus:border-t-transparent focus:!border-t-gray-900 focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"
            >
                {{ $currentUser->user_name }}
            </p>
        </div>
        <div class="w-4/6 grid grid-cols-10 items-center mb-4 border-b-2">
            <p  
            class="col-span-2 block font-sans text-base antialiased font-semibold leading-relaxed tracking-normal text-blue-gray-900">
                Email
            </p>
            <p
            class="col-span-8 bg-transparent font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 focus:border-1 focus:border-gray-900 focus:border-t-transparent focus:!border-t-gray-900 focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"
            >
                {{ $currentUser->email }}
            </p>
        </div>
        <div class="w-4/6 grid grid-cols-10 items-center mb-4 border-b-2">
            <p  
            class="col-span-2 block font-sans text-base antialiased font-semibold leading-relaxed tracking-normal text-blue-gray-900">
                Nomor Telepon
            </p>
            <p
            class="col-span-8 bg-transparent font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 focus:border-1 focus:border-gray-900 focus:border-t-transparent focus:!border-t-gray-900 focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"
            >
                {{ $currentUser->user_phone_number }}
            </p>
        </div>
    </div>

    <div class="px-8 pt-8 pb-2 text-3xl font-semibold text-blue-gray-900">
        <h1>Change Role</h1>
    </div>

    <div class="w-10/12 px-8 pt-8 pb-2 relative text-gray-700 bg-transparent shadow-none rounded-xl bg-clip-border">
        <form action="{{ route('profile.change-role') }}" method="POST"
        class="w-4/6 grid grid-cols-10 items-center mb-4 gap-4"
        >
            {{ csrf_field() }}
            <label  
            class="col-span-2 block font-sans text-base antialiased font-semibold leading-relaxed tracking-normal text-blue-gray-900"
            for="role"
            >
                Roles
            </label>
            <div 
            class="col-span-8 bg-transparent font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all focus:border-1 focus:border-gray-900 focus:!border-t-gray-900 focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"
            >
                <select
                class="peer h-full w-full rounded-[7px] border border-blue-gray-200 bg-transparent p-3 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 empty:!bg-gray-900 focus:border-1 focus:border-gray-900 focus:border-t-transparent focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"
                name="role"
                id="role"
                >
                    <option value="{{ $currentUser->currentRole->role_id }}">{{ $currentUser->currentRole->role_name }}</option>
                    @foreach ($currentUser->roles as $role)
                    @if ($role->role_id != $currentUser->currentRole->role_id)
                    <option value="{{ $role->role_id }}">{{ $role->role_name }}</option>
                    @endif
                    @endforeach
                </select>
            </div>
            <script type="text/javascript">	
                $(document).ready(function() {
                    $('#role').select2();
                });
            </script>
            <div class="col-span-10 flex justify-end">
                <div data-ripple-dark="true">
                    <input
                        class="p-2 bg-blue-gray-700 text-white transition-all rounded-lg outline-none font-semibold text-center hover:bg-blue-gray-50 hover:bg-opacity-80 hover:text-blue-gray-900 hover:cursor-pointer focus:bg-blue-gray-50 focus:bg-opacity-80 focus:text-blue-gray-900 active:bg-blue-gray-50 active:bg-opacity-80 active:text-blue-gray-900 "
                        type="submit"
                        value="Change Role"
                    />
                </div>
            </div>
        </form>
    </div>

    <div class="px-8 pt-8 pb-2 text-3xl font-semibold text-blue-gray-900">
        <h1>Change Password</h1>
    </div>

    <div class="w-10/12 px-8 pt-8 pb-2 relative text-gray-700 bg-transparent shadow-none rounded-xl bg-clip-border">
        <form action="{{ route('profile.change-password') }}" method="POST"
        class="w-4/6 grid grid-cols-10 items-center mb-4 gap-4"
        >
            {{ csrf_field() }}
            <label  
            class="col-span-2 block font-sans text-base antialiased font-semibold leading-relaxed tracking-normal text-blue-gray-900"
            for="current_password"
            >
                Current Password
            </label>
            <input 
                type="password"  
                name="current_password"
                id="current_password"
                required
                class="col-span-8 rounded-md border border-blue-gray-200 border-t-transparent !border-t-blue-gray-200 bg-transparent p-3 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 focus:border-1 focus:border-gray-900 focus:border-t-transparent focus:!border-t-gray-900 focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"
            >
            <label  
            class="col-span-2 block font-sans text-base antialiased font-semibold leading-relaxed tracking-normal text-blue-gray-900"
            for="new_password"
            >
                New Password
            </label>
            <input 
                type="password"  
                name="new_password"
                id="new_password"
                required
                class="col-span-8 rounded-md border border-blue-gray-200 border-t-transparent !border-t-blue-gray-200 bg-transparent p-3 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 focus:border-1 focus:border-gray-900 focus:border-t-transparent focus:!border-t-gray-900 focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"
            >
            <label  
            class="col-span-2 block font-sans text-base antialiased font-semibold leading-relaxed tracking-normal text-blue-gray-900"
            for="confirm_password"
            >
                Confirm New Password
            </label>
            <input 
                type="password"  
                name="confirm_password"
                id="confirm_password"
                required
                class="col-span-8 rounded-md border border-blue-gray-200 border-t-transparent !border-t-blue-gray-200 bg-transparent p-3 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 focus:border-1 focus:border-gray-900 focus:border-t-transparent focus:!border-t-gray-900 focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"
            >
            <div class="col-span-10 flex justify-end">
                <div data-ripple-dark="true">
                    <input
                        class="p-2 bg-blue-gray-700 text-white transition-all rounded-lg outline-none font-semibold text-center hover:bg-blue-gray-50 hover:bg-opacity-80 hover:text-blue-gray-900 hover:cursor-pointer focus:bg-blue-gray-50 focus:bg-opacity-80 focus:text-blue-gray-900 active:bg-blue-gray-50 active:bg-opacity-80 active:text-blue-gray-900 "
                        type="submit"
                        value="Change Password"
                    />
                </div>
            </div>
        </form>
    </div>
</x-app-layout>