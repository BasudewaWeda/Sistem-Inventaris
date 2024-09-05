<x-guest-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <div class="relative flex flex-col text-gray-700 bg-transparent shadow-none rounded-xl bg-clip-border">
        <h4 class="block font-sans text-2xl antialiased font-semibold leading-snug tracking-normal text-blue-gray-900">
            Reset Password
        </h4>
        <form method="POST" action="/reset-password" class="max-w-screen-lg mt-4 mb-2 flex flex-col" >
            {{ csrf_field() }}
            <div class="flex-col justify-center items-center gap-2 mb-2">
                <h6
                class="block font-sans text-base antialiased font-semibold leading-relaxed tracking-normal text-blue-gray-900">
                    Email
                </h6>
                <input placeholder="name@mail.com"
                class="peer h-full w-full rounded-md border border-blue-gray-200 border-t-transparent !border-t-blue-gray-200 bg-transparent px-3 py-3 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 focus:border-2 focus:border-gray-900 focus:border-t-transparent focus:!border-t-gray-900 focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50" 
                name="email"
                value="{{ old('email') ?? '' }}"
                required
                />    
            </div>
            <x-input-error :messages="$errors->get('email')" class="mb-2" />
            <div class="flex-col justify-center items-center gap-2 mb-2">
                <h6
                class="block font-sans text-base antialiased font-semibold leading-relaxed tracking-normal text-blue-gray-900">
                    Forget Code
                </h6>
                <input
                class="peer h-full w-full rounded-md border border-blue-gray-200 border-t-transparent !border-t-blue-gray-200 bg-transparent px-3 py-3 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 focus:border-2 focus:border-gray-900 focus:border-t-transparent focus:!border-t-gray-900 focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50" 
                name="forget_code"
                required
                />    
            </div>
            <x-input-error :messages="$errors->get('forget_code')" class="mb-2" />
            <div class="flex-col justify-center items-center gap-2 mb-2">
                <h6
                class="block font-sans text-base antialiased font-semibold leading-relaxed tracking-normal text-blue-gray-900">
                    New Password
                </h6>
                <input
                type="password"
                class="peer h-full w-full rounded-md border border-blue-gray-200 border-t-transparent !border-t-blue-gray-200 bg-transparent px-3 py-3 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 focus:border-2 focus:border-gray-900 focus:border-t-transparent focus:!border-t-gray-900 focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50" 
                name="new_password"
                required
                />    
            </div>
            <div class="flex-col justify-center items-center gap-2 mb-2">
                <h6
                class="block font-sans text-base antialiased font-semibold leading-relaxed tracking-normal text-blue-gray-900">
                    Confirm Password
                </h6>
                <input
                type="password"
                class="peer h-full w-full rounded-md border border-blue-gray-200 border-t-transparent !border-t-blue-gray-200 bg-transparent px-3 py-3 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 focus:border-2 focus:border-gray-900 focus:border-t-transparent focus:!border-t-gray-900 focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50" 
                name="new_password_confirmation"
                required
                />    
            </div>
            <x-input-error :messages="$errors->get('new_password')" class="mb-2" />
            <div data-ripple-dark="true" class="flex">
                <button
                class="flex-1 items-center p-3 leading-tight bg-blue-gray-700 text-white transition-all rounded-lg outline-none font-semibold text-center hover:bg-blue-gray-50 hover:bg-opacity-80 hover:text-blue-gray-900 hover:cursor-pointer focus:bg-blue-gray-50 focus:bg-opacity-80 focus:text-blue-gray-900 active:bg-blue-gray-50 active:bg-opacity-80 active:text-blue-gray-900 "
                type="submit">
                Reset password
                </button>
            </div>
        </form>
        <a href="/login" class="block font-sans text-sm antialiased text-center leading-relaxed tracking-normal text-blue-gray-900 hover:underline hover:pointer">
            Back to login
        </a>
    </div>  
</x-guest-layout>
