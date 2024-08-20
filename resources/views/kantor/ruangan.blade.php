<x-app-layout>
    <div class="px-8 pt-8 pb-2 text-3xl font-semibold text-blue-gray-900">
      	<h1>Ruangan</h1>
    </div>
    
    <div class="flex h-3/4">
        <div class="w-6/12 px-8 pt-8 pb-2 relative text-gray-700 bg-transparent shadow-none rounded-xl bg-clip-border"
        >
            <div class="w-full grid grid-cols-10 items-center mb-4 border-b-2">
                <p  
                class="col-span-2 block font-sans text-base antialiased font-semibold leading-relaxed tracking-normal text-blue-gray-900">
                    Nama Ruangan
                </p>
                <p
                class="col-span-8 bg-transparent font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 focus:border-1 focus:border-gray-900 focus:border-t-transparent focus:!border-t-gray-900 focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"
                >
                    {{ $ruanganDetails->nama_ruangan }}
                </p>
            </div>
            <div class="w-full grid grid-cols-10 items-center mb-4 border-b-2">
                <p  
                class="col-span-2 block font-sans text-base antialiased font-semibold leading-relaxed tracking-normal text-blue-gray-900">
                    Detail Ruangan
                </p>
                <p
                class="col-span-8 bg-transparent font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 focus:border-1 focus:border-gray-900 focus:border-t-transparent focus:!border-t-gray-900 focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"
                >
                    {{ $ruanganDetails->detail_ruangan }}
                </p>
            </div>
            <div class="w-full grid grid-cols-10 items-center mb-4 border-b-2">
                <p  
                class="col-span-2 block font-sans text-base antialiased font-semibold leading-relaxed tracking-normal text-blue-gray-900">
                    Jumlah Inventaris
                </p>
                <p
                class="col-span-8 bg-transparent font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 focus:border-1 focus:border-gray-900 focus:border-t-transparent focus:!border-t-gray-900 focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"
                >
                    {{ $ruanganDetails->inventaris()->count() }}
                </p>
            </div>
            <div class="w-full grid grid-cols-10 items-center mb-4 border-b-2">
                <p  
                class="col-span-2 block font-sans text-base antialiased font-semibold leading-relaxed tracking-normal text-blue-gray-900">
                    Jumlah Inventaris Approved
                </p>
                <p
                class="col-span-8 bg-transparent font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 focus:border-1 focus:border-gray-900 focus:border-t-transparent focus:!border-t-gray-900 focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"
                >
                    {{ $ruanganDetails->inventaris()->where('status_inventaris', 'Approval 2')->count() }}
                </p>
            </div>
            <div class="w-full grid grid-cols-10 items-center mb-4 border-b-2">
                <p  
                class="col-span-2 block font-sans text-base antialiased font-semibold leading-relaxed tracking-normal text-blue-gray-900">
                    Created At
                </p>
                <p
                class="col-span-8 bg-transparent font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 focus:border-1 focus:border-gray-900 focus:border-t-transparent focus:!border-t-gray-900 focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"
                >
                    {{ $ruanganDetails->created_at }}
                </p>
            </div>
            <div class="w-full grid grid-cols-10 items-center mb-4 border-b-2">
                <p  
                class="col-span-2 block font-sans text-base antialiased font-semibold leading-relaxed tracking-normal text-blue-gray-900">
                    Creator
                </p>
                <p
                class="col-span-8 bg-transparent font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 focus:border-1 focus:border-gray-900 focus:border-t-transparent focus:!border-t-gray-900 focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"
                >
                    {{ $ruanganDetails->creator->user_name }}
                </p>
            </div>
            <div class="flex gap-2 justify-between w-full">
                <div class="flex">
                    <a 
                        href="{{ url()->previous() ?? '/kantor-management' }}" 
                        data-ripple-dark="true"
                        class="p-2 bg-blue-gray-100 text-blue-gray-700 transition-all rounded-lg outline-none font-semibold text-center hover:bg-blue-gray-50 hover:bg-opacity-80 hover:text-blue-gray-900 hover:cursor-pointer focus:bg-blue-gray-50 focus:bg-opacity-80 focus:text-blue-gray-900 active:bg-blue-gray-50 active:bg-opacity-80 active:text-blue-gray-900 ">
                        Back
                    </a>
                </div>
            </div>
        </div>
        <div
		class="relative w-6/12 max-h-[70vh] mx-8 mt-8 mb-2 flex flex-col overflow-y-scroll text-gray-700 bg-white shadow-md bg-clip-border">
		    <table class="text-left table-auto px-8">
		    <thead class="sticky top-0">
		      <tr>
		    	<th class="p-4 border-b border-blue-gray-100 bg-blue-gray-50">
		    	  <p class="block font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
		    		Nomor Inventaris
		    	  </p>
		    	</th>
		    	<th class="p-4 border-b border-blue-gray-100 bg-blue-gray-50">
		    	  <p class="block font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
		    		Nama Inventaris
		    	  </p>
		    	</th>
		    	<th class="p-4 border-b border-blue-gray-100 bg-blue-gray-50">
		    	  <p class="block font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
		    		Harga
		    	  </p>
		    	</th>
		    	<th class="p-4 border-b border-blue-gray-100 bg-blue-gray-50">
		    	  <p class="block font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
		    		Tahun Penyusutan
		    	  </p>
		    	</th>
		    	<th class="p-4 border-b border-blue-gray-100 bg-blue-gray-50">
		    	  <p class="block font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
		    		Kategori
		    	  </p>
		    	</th>
		    	<th class="p-4 border-b border-blue-gray-100 bg-blue-gray-50">
		    	  <p class="block font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70"></p>
		    	</th>
		      </tr>
		    </thead>
		    <tbody>
		    	@foreach ($ruanganDetails->inventaris as $inventaris)
		    		<tr class="even:bg-blue-gray-50/50">
		    			<td class="p-4">
		    		  		<p class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
		    				@if (isset($inventaris->nomor_inventaris))
                                {{ $inventaris->nomor_inventaris }}
                            @endif
		    		  		</p>
		    			</td>
		    			<td class="p-4">
		    		  		<p class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
		    				{{ $inventaris->nama_inventaris }}
		    		  		</p>
		    			</td>
		    			<td class="p-4">
		    			  	<p class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
		    				{{ $inventaris->harga_inventaris }}
		    			  	</p>
		    			</td>
		    			<td class="p-4">
		    			  	<p class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
		    				{{ $inventaris->tahun_penyusutan }}
		    			  	</p>
		    			</td>
		    			<td class="p-4">
		    			  	<p class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
		    				{{ $inventaris->kategori->nama_kategori }}
		    			  	</p>
		    			</td>
		    			<td class="p-4">
		    				<div class="flex gap-16 items-center">
                                <a href="/inventaris-management/inventaris/{{ $inventaris->inventaris_id }}" class="block font-sans text-sm antialiased font-medium leading-normal text-blue-gray-900 hover:underline">View</a>
		    				</div>
		    			</td>
		    		</tr>
		    	@endforeach
		    </tbody>
		    </table>
	    </div>
    </div>
</x-app-layout>
