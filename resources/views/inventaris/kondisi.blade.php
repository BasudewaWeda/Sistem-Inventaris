<x-app-layout>
    <div class="px-1 md:px-2 xl:px-8 pt-1 md:pt-2 xl:pt-8 pb-2 text-3xl font-semibold text-blue-gray-900">
        <h1>Inventaris</h1>
    </div>
    
    <div class="flex flex-col md:flex-row h-3/4">
        <div class="md:w-10/12 px-1 md:px-2 xl:px-8 pt-1 md:pt-2 xl:pt-8 pb-2 relative text-gray-700 bg-transparent shadow-none rounded-xl bg-clip-border">
            <div class="grid grid-cols-10 items-center mb-2 xl:mb-4 border-b-2">
                <p  
                class="col-span-5 md:col-span-2 block font-sans text-base antialiased font-semibold leading-relaxed tracking-normal text-blue-gray-900">
                    Nomor Inventaris
                </p>
                <p
                class="col-span-8 bg-transparent font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 focus:border-1 focus:border-gray-900 focus:border-t-transparent focus:!border-t-gray-900 focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"
                >
                    {{ $inventaris->nomor_inventaris }}
                </p>
            </div>
            <div class="grid grid-cols-10 items-center mb-2 xl:mb-4 border-b-2">
                <p  
                class="col-span-5 md:col-span-2 block font-sans text-base antialiased font-semibold leading-relaxed tracking-normal text-blue-gray-900">
                    Harga
                </p>
                <p
                class="col-span-8 bg-transparent font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 focus:border-1 focus:border-gray-900 focus:border-t-transparent focus:!border-t-gray-900 focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"
                >
                    {{ $inventaris->harga_inventaris }}
                </p>
            </div>
            <div class="grid grid-cols-10 items-center mb-2 xl:mb-4 border-b-2">
                <p  
                class="col-span-5 md:col-span-2 block font-sans text-base antialiased font-semibold leading-relaxed tracking-normal text-blue-gray-900">
                    Tanggal Pembelian
                </p>
                <p
                class="col-span-8 bg-transparent font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 focus:border-1 focus:border-gray-900 focus:border-t-transparent focus:!border-t-gray-900 focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"
                >
                    {{ $inventaris->tanggal_pembelian }}
                </p>
            </div>
            <div class="grid grid-cols-10 items-center mb-2 xl:mb-4 border-b-2">
                <p  
                class="col-span-5 md:col-span-2 block font-sans text-base antialiased font-semibold leading-relaxed tracking-normal text-blue-gray-900">
                    Tahun Penyusutan
                </p>
                <p
                class="col-span-8 bg-transparent font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 focus:border-1 focus:border-gray-900 focus:border-t-transparent focus:!border-t-gray-900 focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"
                >
                    {{ $inventaris->tahun_penyusutan }}
                </p>
            </div>
            <div class="grid grid-cols-10 items-center mb-2 xl:mb-4 border-b-2">
                <p  
                class="col-span-5 md:col-span-2 block font-sans text-base antialiased font-semibold leading-relaxed tracking-normal text-blue-gray-900">
                    Kategori
                </p>
                <p
                class="col-span-8 bg-transparent font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 focus:border-1 focus:border-gray-900 focus:border-t-transparent focus:!border-t-gray-900 focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"
                >
                    {{ $inventaris->kategori->nama_kategori }}
                </p>
            </div>
            <div class="grid grid-cols-10 items-center mb-2 xl:mb-4 border-b-2">
                <p  
                class="col-span-5 md:col-span-2 block font-sans text-base antialiased font-semibold leading-relaxed tracking-normal text-blue-gray-900">
                    Status
                </p>
                <p
                class="col-span-8 bg-transparent font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 focus:border-1 focus:border-gray-900 focus:border-t-transparent focus:!border-t-gray-900 focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"
                >
                    {{ $inventaris->status_inventaris }}
                </p>
            </div>
            <div class="grid grid-cols-10 items-center mb-2 xl:mb-4 border-b-2">
                <p  
                class="col-span-5 md:col-span-2 block font-sans text-base antialiased font-semibold leading-relaxed tracking-normal text-blue-gray-900">
                    Kondisi
                </p>
                <p
                class="col-span-8 bg-transparent font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 focus:border-1 focus:border-gray-900 focus:border-t-transparent focus:!border-t-gray-900 focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"
                >
                    {{ $inventaris->kondisi_inventaris }}
                </p>
            </div>
            <div class="grid grid-cols-10 items-center mb-2 xl:mb-4 border-b-2">
                <p  
                class="col-span-5 md:col-span-2 block font-sans text-base antialiased font-semibold leading-relaxed tracking-normal text-blue-gray-900">
                    Penempatan
                </p>
                <p
                class="col-span-8 bg-transparent font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 focus:border-1 focus:border-gray-900 focus:border-t-transparent focus:!border-t-gray-900 focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"
                >
                <a href="/kantor-management/kantor/{{ $inventaris->kantor->slug }}" class="hover:underline">{{ $inventaris->kantor->nama_kantor }}</a>
                    {{' | ' . $inventaris->lantai->nama_lantai . ' | ' . $inventaris->ruangan->nama_ruangan}}
                </p>
            </div>
            <div class="grid grid-cols-10 items-center mb-2 xl:mb-4 border-b-2">
                <p  
                class="col-span-5 md:col-span-2 block font-sans text-base antialiased font-semibold leading-relaxed tracking-normal text-blue-gray-900">
                    Approver 1
                </p>
                <p
                class="col-span-8 bg-transparent font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 focus:border-1 focus:border-gray-900 focus:border-t-transparent focus:!border-t-gray-900 focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"
                >
                    {{ $inventaris->firstApprover->user_name }}
                </p>
            </div>
            <div class="grid grid-cols-10 items-center mb-2 xl:mb-4 border-b-2">
                <p  
                class="col-span-5 md:col-span-2 block font-sans text-base antialiased font-semibold leading-relaxed tracking-normal text-blue-gray-900">
                    Approver 2
                </p>
                <p
                class="col-span-8 bg-transparent font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 focus:border-1 focus:border-gray-900 focus:border-t-transparent focus:!border-t-gray-900 focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"
                >
                    {{ $inventaris->secondApprover->user_name }}
                </p>
            </div>
            <div class="grid grid-cols-10 items-center mb-2 xl:mb-4 border-b-2">
                <p  
                class="col-span-5 md:col-span-2 block font-sans text-base antialiased font-semibold leading-relaxed tracking-normal text-blue-gray-900">
                    Created At
                </p>
                <p
                class="col-span-8 bg-transparent font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 focus:border-1 focus:border-gray-900 focus:border-t-transparent focus:!border-t-gray-900 focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"
                >
                    {{ $inventaris->created_at }}
                </p>
            </div>
            <div class="grid grid-cols-10 items-center mb-2 xl:mb-4 border-b-2">
                <p  
                class="col-span-5 md:col-span-2 block font-sans text-base antialiased font-semibold leading-relaxed tracking-normal text-blue-gray-900">
                    Creator
                </p>
                <p
                class="col-span-8 bg-transparent font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 focus:border-1 focus:border-gray-900 focus:border-t-transparent focus:!border-t-gray-900 focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"
                >
                    {{ $inventaris->creator->user_name }}
                </p>
            </div>
            <div class="flex gap-2 justify-between w-4/6">
                <div class="flex">
                    <a 
                        href="{{ url()->previous() ?? '/inventaris-management' }}" 
                        data-ripple-dark="true"
                        class="p-2 bg-blue-gray-100 text-blue-gray-700 transition-all rounded-lg outline-none font-semibold text-center hover:bg-blue-gray-50 hover:bg-opacity-80 hover:text-blue-gray-900 hover:cursor-pointer focus:bg-blue-gray-50 focus:bg-opacity-80 focus:text-blue-gray-900 active:bg-blue-gray-50 active:bg-opacity-80 active:text-blue-gray-900 ">
                        Back
                    </a>
                </div>
            </div>
        </div>
        <div class="relative md:w-1/2 max-h-[70vh] md:px-2 xl:px-8 pt-1 md:pt-2 xl:pt-8 mb-2 flex flex-col text-gray-700 bg-white">
            <form action="" method="POST">
                {{ csrf_field() }}
                <label 
                for="kondisi" 
                class="col-span-5 md:col-span-2 block font-sans text-base antialiased font-semibold leading-relaxed tracking-normal text-blue-gray-900">
                    Kondisi Inventaris
                </label>
                <select
                    class="peer h-full w-full rounded-[7px] border border-blue-gray-200 bg-transparent p-3 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 empty:!bg-gray-900 focus:border-1 focus:border-gray-900 focus:border-t-transparent focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"
                    name="kondisi"
                    id="kondisi"
                    >
                        <option value="">Select Kondisi</option>
                        <option value="Normal" @if ($inventaris->kondisi_inventaris == 'Normal') selected @endif>Normal</option>
                        <option value="Rusak" @if ($inventaris->kondisi_inventaris == 'Rusak') selected @endif>Rusak</option>
                </select>
                <div data-ripple-dark="true" class="mt-2">
                    <input
                        class="p-2 bg-blue-gray-700 text-white transition-all rounded-lg outline-none font-semibold text-center hover:bg-blue-gray-50 hover:bg-opacity-80 hover:text-blue-gray-900 hover:cursor-pointer focus:bg-blue-gray-50 focus:bg-opacity-80 focus:text-blue-gray-900 active:bg-blue-gray-50 active:bg-opacity-80 active:text-blue-gray-900 "
                        type="submit"
                        value="Ubah Kondisi"
                    />
                </div>
            </form>
        </div>
    </div>

    <script type="text/javascript">	
        $(document).ready(function() {
            $('#kondisi').select2();
        });
    </script>
</x-app-layout>