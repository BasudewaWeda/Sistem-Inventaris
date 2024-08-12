<x-app-layout>
    @php
        $temp = $inputInventarisDetails;
    @endphp

    <div class="px-8 pt-8 pb-2 text-3xl font-semibold text-blue-gray-900">
      	<h1>Input Inventaris</h1>
    </div>
    
    <div class="flex h-1/2">
        <div class="w-6/12 px-8 pt-8 pb-2 relative text-gray-700 bg-transparent shadow-none rounded-xl bg-clip-border"
        x-data="{rejectMenu: false, rejectUrl: '', inputInventarisTitle: '{{ $inputInventarisDetails->judul_input_inventaris }}'}"
        >
            <div class="w-full grid grid-cols-10 items-center mb-4 border-b-2">
                <p  
                class="col-span-2 block font-sans text-base antialiased font-semibold leading-relaxed tracking-normal text-blue-gray-900">
                    Judul Inputan
                </p>
                <p
                class="col-span-8 bg-transparent font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 focus:border-1 focus:border-gray-900 focus:border-t-transparent focus:!border-t-gray-900 focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"
                >
                    {{ $inputInventarisDetails->judul_input_inventaris }}
                </p>
            </div>
            <div class="w-full grid grid-cols-10 items-center mb-4 border-b-2">
                <p  
                class="col-span-2 block font-sans text-base antialiased font-semibold leading-relaxed tracking-normal text-blue-gray-900">
                    Jumlah
                </p>
                <p
                class="col-span-8 bg-transparent font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 focus:border-1 focus:border-gray-900 focus:border-t-transparent focus:!border-t-gray-900 focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"
                >
                    {{ $inputInventarisDetails->jumlah_inventaris }}
                </p>
            </div>
            <div class="w-full grid grid-cols-10 items-center mb-4 border-b-2">
                <p  
                class="col-span-2 block font-sans text-base antialiased font-semibold leading-relaxed tracking-normal text-blue-gray-900">
                    Harga Total
                </p>
                <p
                class="col-span-8 bg-transparent font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 focus:border-1 focus:border-gray-900 focus:border-t-transparent focus:!border-t-gray-900 focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"
                >
                    {{ 'Rp.' . number_format($inputInventarisDetails->harga_inventaris * $inputInventarisDetails->jumlah_inventaris, 2, ',', '.') }}
                </p>
            </div>
            <div class="w-full grid grid-cols-10 items-center mb-4 border-b-2">
                <p  
                class="col-span-2 block font-sans text-base antialiased font-semibold leading-relaxed tracking-normal text-blue-gray-900">
                    Kategori
                </p>
                <p
                class="col-span-8 bg-transparent font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 focus:border-1 focus:border-gray-900 focus:border-t-transparent focus:!border-t-gray-900 focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"
                >
                    {{ $inputInventarisDetails->kategori->nama_kategori }}
                </p>
            </div>
            <div class="w-full grid grid-cols-10 items-center mb-4 border-b-2">
                <p  
                class="col-span-2 block font-sans text-base antialiased font-semibold leading-relaxed tracking-normal text-blue-gray-900">
                    Penempatan
                </p>
                <p
                class="col-span-8 bg-transparent font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 focus:border-1 focus:border-gray-900 focus:border-t-transparent focus:!border-t-gray-900 focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"
                >
                    {{ $inputInventarisDetails->kantor->nama_kantor . ' | ' . $inputInventarisDetails->lantai->nama_lantai . ' | ' . $inputInventarisDetails->ruangan->nama_ruangan}}
                </p>
            </div>
            <div class="w-full grid grid-cols-10 items-center mb-4 border-b-2">
                <p  
                class="col-span-2 block font-sans text-base antialiased font-semibold leading-relaxed tracking-normal text-blue-gray-900">
                    Status
                </p>
                <p
                class="col-span-8 bg-transparent font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 focus:border-1 focus:border-gray-900 focus:border-t-transparent focus:!border-t-gray-900 focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"
                >
                    {{ $inputInventarisDetails->status_input_inventaris }}
                </p>
            </div>
            @if (!empty($inputInventarisDetails->alasan_rejection))
            <div class="w-full grid grid-cols-10 items-center mb-4 border-b-2">
                <p  
                class="col-span-2 block font-sans text-base antialiased font-semibold leading-relaxed tracking-normal text-blue-gray-900">
                    Alasan Rejection
                </p>
                <p
                class="col-span-8 bg-transparent font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 focus:border-1 focus:border-gray-900 focus:border-t-transparent focus:!border-t-gray-900 focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"
                >
                    {{ $inputInventarisDetails->alasan_rejection }}
                </p>
            </div>
            @endif
            <div class="w-full grid grid-cols-10 items-center mb-4 border-b-2">
                <p  
                class="col-span-2 block font-sans text-base antialiased font-semibold leading-relaxed tracking-normal text-blue-gray-900">
                    Approver 1
                </p>
                <p
                class="col-span-8 bg-transparent font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 focus:border-1 focus:border-gray-900 focus:border-t-transparent focus:!border-t-gray-900 focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"
                >
                    {{ $inputInventarisDetails->firstApprover->user_name }}
                </p>
            </div>
            <div class="w-full grid grid-cols-10 items-center mb-4 border-b-2">
                <p  
                class="col-span-2 block font-sans text-base antialiased font-semibold leading-relaxed tracking-normal text-blue-gray-900">
                    Approver 2
                </p>
                <p
                class="col-span-8 bg-transparent font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 focus:border-1 focus:border-gray-900 focus:border-t-transparent focus:!border-t-gray-900 focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"
                >
                    {{ $inputInventarisDetails->secondApprover->user_name }}
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
                    {{ $inputInventarisDetails->created_at }}
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
                    {{ $inputInventarisDetails->creator->user_name }}
                </p>
            </div>
            <div class="flex gap-2 justify-between w-full">
                <div class="flex">
                    <a 
                        href="/approval-inventaris" 
                        data-ripple-dark="true"
                        class="p-2 bg-blue-gray-100 text-blue-gray-700 transition-all rounded-lg outline-none font-semibold text-center hover:bg-blue-gray-50 hover:bg-opacity-80 hover:text-blue-gray-900 hover:cursor-pointer focus:bg-blue-gray-50 focus:bg-opacity-80 focus:text-blue-gray-900 active:bg-blue-gray-50 active:bg-opacity-80 active:text-blue-gray-900 ">
                        Back
                    </a>
                </div>
                <div class="flex gap-2">
                    @if (($currentUser->user_id == $inputInventarisDetails->approver_1 && $inputInventarisDetails->status_input_inventaris == 'Pending Approval') || ($currentUser->user_id == $inputInventarisDetails->approver_2 && $inputInventarisDetails->status_input_inventaris == 'Approval 1'))
                    <div data-ripple-dark="true" class="flex">
                        <button @click.prevent="rejectMenu = true;" class="py-2 px-4 bg-blue-gray-700 text-white transition-all rounded-lg outline-none font-semibold text-center hover:bg-blue-gray-50 hover:bg-opacity-80 hover:text-blue-gray-900 hover:cursor-pointer focus:bg-blue-gray-50 focus:bg-opacity-80 focus:text-blue-gray-900 active:bg-blue-gray-50 active:bg-opacity-80 active:text-blue-gray-900 ">Reject</button>
                    </div>
                    @endif
                    @if (($currentUser->user_id == $inputInventarisDetails->approver_1 && $inputInventarisDetails->status_input_inventaris == 'Pending Approval') || ($currentUser->user_id == $inputInventarisDetails->approver_2 && $inputInventarisDetails->status_input_inventaris == 'Approval 1'))
                    <div data-ripple-dark="true" class="flex">
                        <form action="/approval-inventaris/{{ $inputInventarisDetails->input_inventaris_id }}/approve" method="POST">
                            {{ csrf_field() }}
                            <input type="submit"
                            value="Approve"
                            class="py-2 px-4 bg-blue-gray-700 text-white transition-all rounded-lg outline-none font-semibold text-center hover:bg-blue-gray-50 hover:bg-opacity-80 hover:text-blue-gray-900 hover:cursor-pointer focus:bg-blue-gray-50 focus:bg-opacity-80 focus:text-blue-gray-900 active:bg-blue-gray-50 active:bg-opacity-80 active:text-blue-gray-900 "
                            >
                        </form>
                    </div>
                    @endif
                </div>
            </div>
            <div x-show="rejectMenu"
		    x-cloak
		    x-transition:enter="transition ease-out duration-100 transform"
		    x-transition:enter-start="opacity-0 scale-95"
		    x-transition:enter-end="opacity-100 scale-100"
		    x-transition:leave="transition ease-in duration-75 transform"
		    x-transition:leave-start="opacity-100 scale-100"
		    x-transition:leave-end="opacity-0 scale-95"
		    class="fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center z-50">
		    	<div class="bg-white rounded-lg shadow-lg max-w-sm mx-auto p-6">
		    		<div class="py-2 text-3xl font-semibold text-blue-gray-900">
		    			<h1>Rejection Form</h1>
		    	  	</div>
                    <form action="/approval-inventaris/{{ $inputInventarisDetails->input_inventaris_id }}/reject" method="POST">
                        {{ csrf_field() }}
                        <label 
                        for="reason" 
                        class="col-span-2 block font-sans text-base antialiased leading-relaxed tracking-normal text-blue-gray-900">
                            Alasan Rejection <strong>{{ $inputInventarisDetails->judul_input_inventaris }}</strong>
                        </label>
                        <textarea 
                        name="alasan_rejection"
                        id="reason"
                        required
                        class="col-span-6 rounded-md border border-blue-gray-200 border-t-transparent !border-t-blue-gray-200 bg-transparent p-3 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 focus:border-1 focus:border-gray-900 focus:border-t-transparent focus:!border-t-gray-900 focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"
                        cols="30" 
                        rows="10"
                        maxlength="255"></textarea>

                        <div class="flex gap-4">
                            <div class="flex">
                                <button @click="rejectMenu = false;"
                                type="button"
                                class="p-2 bg-blue-gray-100 text-blue-gray-700 transition-all rounded-lg outline-none font-semibold text-center hover:bg-blue-gray-50 hover:bg-opacity-80 hover:text-blue-gray-900 hover:cursor-pointer focus:bg-blue-gray-50 focus:bg-opacity-80 focus:text-blue-gray-900 active:bg-blue-gray-50 active:bg-opacity-80 active:text-blue-gray-900 ">
                                    Cancel
                                </button>
                            </div>
                            <input type="submit"
                            value="Reject"
                            class="items-center p-3 leading-tight bg-blue-gray-700 text-white transition-all rounded-lg outline-none font-semibold text-center hover:bg-blue-gray-50 hover:bg-opacity-80 hover:text-blue-gray-900 hover:cursor-pointer focus:bg-blue-gray-50 focus:bg-opacity-80 focus:text-blue-gray-900 active:bg-blue-gray-50 active:bg-opacity-80 active:text-blue-gray-900 "
                            >
                        </div>
                    </form>
		    	</div>
		    </div>
        </div>
        <div
		class="relative w-6/12 mx-8 mt-8 mb-2 flex flex-col overflow-scroll text-gray-700 bg-white shadow-md bg-clip-border">
		    <table class="text-left table-fixed px-8">
		    <thead class="sticky top-0">
		      <tr>
                @if (!(in_array($inputInventarisDetails->status_input_inventaris, array('Pending Approval', 'Rejected', 'Approval 1'))))
		    	<th class="p-4 border-b border-blue-gray-100 bg-blue-gray-50">
		    	  <p class="block font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
		    		Nomor Inventaris
		    	  </p>
		    	</th>
                @endif
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
                @if (!(in_array($inputInventarisDetails->status_input_inventaris, array('Pending Approval', 'Rejected', 'Approval 1'))))
		    	@foreach ($inputInventarisDetails->inventaris as $inventaris)
		    		<tr class="even:bg-blue-gray-50/50">
		    			<td class="p-4">
		    		  		<p class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
		    				{{ $inventaris->nomor_inventaris }}
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
                @else
		    	@foreach ($inputInventarisDetails->inventaris as $inventaris)
		    		<tr class="even:bg-blue-gray-50/50">
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
                @endif
		    </tbody>
		    </table>
	    </div>
    </div>
</x-app-layout>
