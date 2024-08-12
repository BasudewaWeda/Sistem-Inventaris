<x-app-layout>
    <div class="px-8 pt-8 pb-2 text-3xl font-semibold text-blue-gray-900">
      	<h1>Kantor Management</h1>
    </div>

    <div class="w-10/12 px-8 pt-8 pb-2 relative text-gray-700 bg-transparent shadow-none rounded-xl bg-clip-border">
        <div class="w-4/6 grid grid-cols-10 items-center mb-4 border-b-2">
            <p  
            class="col-span-2 block font-sans text-base antialiased font-semibold leading-relaxed tracking-normal text-blue-gray-900">
                Nama Kantor
            </p>
            <p
            class="col-span-8 bg-transparent font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 focus:border-1 focus:border-gray-900 focus:border-t-transparent focus:!border-t-gray-900 focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"
            >
                {{ $kantorDetails->nama_kantor }}
            </p>
        </div>
        <div class="w-4/6 grid grid-cols-10 items-center mb-4 border-b-2">
            <p  
            class="col-span-2 block font-sans text-base antialiased font-semibold leading-relaxed tracking-normal text-blue-gray-900">
                Alamat
            </p>
            <p
            class="col-span-8 bg-transparent font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 focus:border-1 focus:border-gray-900 focus:border-t-transparent focus:!border-t-gray-900 focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"
            >
                {{ $kantorDetails->alamat_kantor }}
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
                {{ $kantorDetails->nomor_telepon_kantor }}
            </p>
        </div>
        <div class="w-4/6 grid grid-cols-10 items-center mb-4 border-b-2">
            <p  
            class="col-span-2 block font-sans text-base antialiased font-semibold leading-relaxed tracking-normal text-blue-gray-900">
                Provinsi
            </p>
            <p
            class="col-span-8 bg-transparent font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 focus:border-1 focus:border-gray-900 focus:border-t-transparent focus:!border-t-gray-900 focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"
            >
                {{ $kantorDetails->provinsi->nama_provinsi }}
            </p>
        </div>
        <div class="w-4/6 grid grid-cols-10 items-center mb-4 border-b-2">
            <p  
            class="col-span-2 block font-sans text-base antialiased font-semibold leading-relaxed tracking-normal text-blue-gray-900">
                Kabupaten
            </p>
            <p
            class="col-span-8 bg-transparent font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 focus:border-1 focus:border-gray-900 focus:border-t-transparent focus:!border-t-gray-900 focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"
            >
                {{ $kantorDetails->kabupaten->nama_kabupaten }}
            </p>
        </div>
        <div class="w-4/6 grid grid-cols-10 mb-4 items-start h-[45vh]">
            <h6
            class="col-span-2 mt-2 block font-sans text-base antialiased font-semibold leading-relaxed tracking-normal text-blue-gray-900">
                Lantai
            </h6>
            <div class="col-span-8 overflow-y-scroll h-full">
                @foreach ($kantorDetails->lantai as $lantai)
                    <div
                    class="flex mb-2 justify-between items-center rounded-md border border-blue-gray-200 border-t-transparent !border-t-blue-gray-200 p-3 bg-transparent font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 focus:border-1 focus:border-gray-900 focus:border-t-transparent focus:!border-t-gray-900 focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"
                    >
                        <p  
                        class="bg-transparent font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 focus:border-1 focus:border-gray-900 focus:border-t-transparent focus:!border-t-gray-900 focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"
                        >
                            {{ $lantai->nama_lantai }}
                        </p>
                    </div>
                    @if (!$lantai->ruangan->isEmpty())
                    @foreach ($lantai->ruangan as $ruangan)
                        <div
                        class="flex ml-4 mb-2 p-1 justify-between items-center rounded-md border border-blue-gray-200 border-t-transparent !border-t-blue-gray-200 bg-transparent font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 focus:border-1 focus:border-gray-900 focus:border-t-transparent focus:!border-t-gray-900 focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"
                        >
                            <p  
                            class="bg-transparent font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 focus:border-1 focus:border-gray-900 focus:border-t-transparent focus:!border-t-gray-900 focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"
                            >
                                {{ $ruangan->nama_ruangan }}
                            </p>
                            {{-- TODO: Link to inventaris with query --}}
                            <a href="" class="block font-sans text-sm antialiased font-medium leading-normal text-blue-gray-900 hover:underline">View</a>
                        </div>
                    @endforeach
                    @endif
                @endforeach
            </div>
        </div>
        <div class="flex gap-2 justify-end w-4/6">
            <div class="flex">
                <a 
                    href="/kantor-management" 
                    data-ripple-dark="true"
                    class="p-2 bg-blue-gray-100 text-blue-gray-700 transition-all rounded-lg outline-none font-semibold text-center hover:bg-blue-gray-50 hover:bg-opacity-80 hover:text-blue-gray-900 hover:cursor-pointer focus:bg-blue-gray-50 focus:bg-opacity-80 focus:text-blue-gray-900 active:bg-blue-gray-50 active:bg-opacity-80 active:text-blue-gray-900 ">
                    Back
                </a>
            </div>
            <div data-ripple-dark="true" class="flex">
                <a
                    href="/kantor-management/edit/{{ $kantorDetails->slug }}"
                    class="py-2 px-4 bg-blue-gray-700 text-white transition-all rounded-lg outline-none font-semibold text-center hover:bg-blue-gray-50 hover:bg-opacity-80 hover:text-blue-gray-900 hover:cursor-pointer focus:bg-blue-gray-50 focus:bg-opacity-80 focus:text-blue-gray-900 active:bg-blue-gray-50 active:bg-opacity-80 active:text-blue-gray-900 "
                >
                    Edit
                </a>
            </div>
        </div>
    </div>
</x-app-layout>