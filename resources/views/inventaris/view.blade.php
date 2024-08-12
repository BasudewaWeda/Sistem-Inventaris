<x-app-layout>
    <div class="px-8 pt-8 pb-2 text-3xl font-semibold text-blue-gray-900">
      	<h1>Inventaris</h1>
    </div>

    <div class="w-10/12 px-8 pt-8 pb-2 relative text-gray-700 bg-transparent shadow-none rounded-xl bg-clip-border">
        <div class="w-4/6 grid grid-cols-10 items-center mb-4 border-b-2">
            <p  
            class="col-span-2 block font-sans text-base antialiased font-semibold leading-relaxed tracking-normal text-blue-gray-900">
                Nomor Inventaris
            </p>
            <p
            class="col-span-8 bg-transparent font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 focus:border-1 focus:border-gray-900 focus:border-t-transparent focus:!border-t-gray-900 focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"
            >
                {{ $inventarisDetails->nomor_inventaris }}
            </p>
        </div>
        <div class="w-4/6 grid grid-cols-10 items-center mb-4 border-b-2">
            <p  
            class="col-span-2 block font-sans text-base antialiased font-semibold leading-relaxed tracking-normal text-blue-gray-900">
                Harga
            </p>
            <p
            class="col-span-8 bg-transparent font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 focus:border-1 focus:border-gray-900 focus:border-t-transparent focus:!border-t-gray-900 focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"
            >
                {{ $inventarisDetails->harga_inventaris }}
            </p>
        </div>
        <div class="w-4/6 grid grid-cols-10 items-center mb-4 border-b-2">
            <p  
            class="col-span-2 block font-sans text-base antialiased font-semibold leading-relaxed tracking-normal text-blue-gray-900">
                Tanggal Pembelian
            </p>
            <p
            class="col-span-8 bg-transparent font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 focus:border-1 focus:border-gray-900 focus:border-t-transparent focus:!border-t-gray-900 focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"
            >
                {{ $inventarisDetails->tanggal_pembelian }}
            </p>
        </div>
        <div class="w-4/6 grid grid-cols-10 items-center mb-4 border-b-2">
            <p  
            class="col-span-2 block font-sans text-base antialiased font-semibold leading-relaxed tracking-normal text-blue-gray-900">
                Tahun Penyusutan
            </p>
            <p
            class="col-span-8 bg-transparent font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 focus:border-1 focus:border-gray-900 focus:border-t-transparent focus:!border-t-gray-900 focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"
            >
                {{ $inventarisDetails->tahun_penyusutan }}
            </p>
        </div>
        <div class="w-4/6 grid grid-cols-10 items-center mb-4 border-b-2">
            <p  
            class="col-span-2 block font-sans text-base antialiased font-semibold leading-relaxed tracking-normal text-blue-gray-900">
                Kategori
            </p>
            <p
            class="col-span-8 bg-transparent font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 focus:border-1 focus:border-gray-900 focus:border-t-transparent focus:!border-t-gray-900 focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"
            >
                {{ $inventarisDetails->kategori->nama_kategori }}
            </p>
        </div>
        <div class="w-4/6 grid grid-cols-10 items-center mb-4 border-b-2">
            <p  
            class="col-span-2 block font-sans text-base antialiased font-semibold leading-relaxed tracking-normal text-blue-gray-900">
                Status
            </p>
            <p
            class="col-span-8 bg-transparent font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 focus:border-1 focus:border-gray-900 focus:border-t-transparent focus:!border-t-gray-900 focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"
            >
                {{ $inventarisDetails->status_inventaris }}
            </p>
        </div>
        <div class="w-4/6 grid grid-cols-10 items-center mb-4 border-b-2">
            <p  
            class="col-span-2 block font-sans text-base antialiased font-semibold leading-relaxed tracking-normal text-blue-gray-900">
                Penempatan
            </p>
            <p
            class="col-span-8 bg-transparent font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 focus:border-1 focus:border-gray-900 focus:border-t-transparent focus:!border-t-gray-900 focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"
            >
                {{ $inventarisDetails->kantor->nama_kantor . ' | ' . $inventarisDetails->lantai->nama_lantai . ' | ' . $inventarisDetails->ruangan->nama_ruangan}}
            </p>
        </div>
        <div class="w-4/6 grid grid-cols-10 items-center mb-4 border-b-2">
            <p  
            class="col-span-2 block font-sans text-base antialiased font-semibold leading-relaxed tracking-normal text-blue-gray-900">
                Approver 1
            </p>
            <p
            class="col-span-8 bg-transparent font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 focus:border-1 focus:border-gray-900 focus:border-t-transparent focus:!border-t-gray-900 focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"
            >
                {{ $inventarisDetails->firstApprover->user_name }}
            </p>
        </div>
        <div class="w-4/6 grid grid-cols-10 items-center mb-4 border-b-2">
            <p  
            class="col-span-2 block font-sans text-base antialiased font-semibold leading-relaxed tracking-normal text-blue-gray-900">
                Approver 2
            </p>
            <p
            class="col-span-8 bg-transparent font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 focus:border-1 focus:border-gray-900 focus:border-t-transparent focus:!border-t-gray-900 focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"
            >
                {{ $inventarisDetails->secondApprover->user_name }}
            </p>
        </div>
        <div class="w-4/6 grid grid-cols-10 items-center mb-4 border-b-2">
            <p  
            class="col-span-2 block font-sans text-base antialiased font-semibold leading-relaxed tracking-normal text-blue-gray-900">
                Created At
            </p>
            <p
            class="col-span-8 bg-transparent font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 focus:border-1 focus:border-gray-900 focus:border-t-transparent focus:!border-t-gray-900 focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"
            >
                {{ $inventarisDetails->created_at }}
            </p>
        </div>
        <div class="w-4/6 grid grid-cols-10 items-center mb-4 border-b-2">
            <p  
            class="col-span-2 block font-sans text-base antialiased font-semibold leading-relaxed tracking-normal text-blue-gray-900">
                Creator
            </p>
            <p
            class="col-span-8 bg-transparent font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 focus:border-1 focus:border-gray-900 focus:border-t-transparent focus:!border-t-gray-900 focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"
            >
                {{ $inventarisDetails->creator->user_name }}
            </p>
        </div>
        <div class="flex gap-2 justify-end w-4/6">
            <div class="flex">
                <a 
                    href="/inventaris-management" 
                    data-ripple-dark="true"
                    class="p-2 bg-blue-gray-100 text-blue-gray-700 transition-all rounded-lg outline-none font-semibold text-center hover:bg-blue-gray-50 hover:bg-opacity-80 hover:text-blue-gray-900 hover:cursor-pointer focus:bg-blue-gray-50 focus:bg-opacity-80 focus:text-blue-gray-900 active:bg-blue-gray-50 active:bg-opacity-80 active:text-blue-gray-900 ">
                    Back
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
