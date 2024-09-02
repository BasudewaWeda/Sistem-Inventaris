<x-app-layout>
    <div class="px-8 pt-8 pb-2 text-3xl font-semibold text-blue-gray-900">
      	<h1>Laporan Pemindahan Inventaris</h1>
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

    <div class="w-1/2 px-8 pt-8 pb-2 relative text-gray-700 bg-transparent shadow-none rounded-xl bg-clip-border">
        <form action="/laporan-pemindahan-inventaris/result">
            <div class="grid grid-cols-8 gap-4 items-center mb-4">
                <label 
                for="start_date" 
                class="col-span-2 block font-sans text-base antialiased font-semibold leading-relaxed tracking-normal text-blue-gray-900">
                    Start date dibuat
                </label>
                <input 
                type="date" 
                name="start_date"
                id="start_date"
                value="{{ old('start_date') }}"
                required
                class="col-span-6 rounded-md border border-blue-gray-200 border-t-transparent !border-t-blue-gray-200 bg-transparent p-3 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 focus:border-1 focus:border-gray-900 focus:border-t-transparent focus:!border-t-gray-900 focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"
                >
            </div>
            <div class="grid grid-cols-8 gap-4 items-center mb-4">
                <label 
                for="end_date" 
                class="col-span-2 block font-sans text-base antialiased font-semibold leading-relaxed tracking-normal text-blue-gray-900">
                    End date dibuat
                </label>
                <input 
                type="date" 
                name="end_date"
                id="end_date"
                value="{{ old('end_date') }}"
                required
                class="col-span-6 rounded-md border border-blue-gray-200 border-t-transparent !border-t-blue-gray-200 bg-transparent p-3 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 focus:border-1 focus:border-gray-900 focus:border-t-transparent focus:!border-t-gray-900 focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"
                >
            </div>
            <div class="grid grid-cols-8 gap-4 items-center mb-4">
                <label 
                for="status" 
                class="col-span-2 block font-sans text-base antialiased font-semibold leading-relaxed tracking-normal text-blue-gray-900">
                    Status
                </label>
                <div class="col-span-6">
                    <select
                    class="peer h-full w-full rounded-[7px] border border-blue-gray-200 bg-transparent p-3 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 empty:!bg-gray-900 focus:border-1 focus:border-gray-900 focus:border-t-transparent focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"
                    name="status"
                    id="status"
                    >
                        <option value="">Select Status</option>
                        <option value="Approval 1" {{ old('status') == 'Approval 1' ? 'selected' : '' }}>Approval 1</option>
                        <option value="Approval 2" {{ old('status') == 'Approval 2' ? 'selected' : '' }}>Approval 2</option>
                        <option value="Pending Approval" {{ old('status') == 'Pending Approval' ? 'selected' : '' }}>Pending Approval</option>
                    </select>
                </div>
            </div>
            <div class="grid grid-cols-8 gap-4 items-center mb-4">
                <label 
                for="kantor" 
                class="col-span-2 block font-sans text-base antialiased font-semibold leading-relaxed tracking-normal text-blue-gray-900">
                    Kantor Tujuan
                </label>
                <div class="col-span-6">
                    <select
                    class="peer h-full w-full rounded-[7px] border border-blue-gray-200 bg-transparent p-3 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 empty:!bg-gray-900 focus:border-1 focus:border-gray-900 focus:border-t-transparent focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"
                    name="kantor_id"
                    id="kantor"
                    >
                        <option value="">Select Kantor</option>
                        @foreach ($kantorRecord as $kantor)
                        <option value="{{ $kantor->kantor_id }}" {{ old('kantor_id') == $kantor->kantor_id ? 'selected' : '' }}>{{ $kantor->nama_kantor }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div data-ripple-dark="true" class="w-fit">
                <input
                    class="p-2 bg-blue-gray-700 text-white transition-all rounded-lg outline-none font-semibold text-center hover:bg-blue-gray-50 hover:bg-opacity-80 hover:text-blue-gray-900 hover:cursor-pointer focus:bg-blue-gray-50 focus:bg-opacity-80 focus:text-blue-gray-900 active:bg-blue-gray-50 active:bg-opacity-80 active:text-blue-gray-900 "
                    type="submit"
                    value="Next"
                />
            </div>
        </form>
    </div>  

    <script type="text/javascript">	
        $(document).ready(function() {
            $('#kantor').select2();
            $('#status').select2();
        });
    </script>
</x-app-layout>