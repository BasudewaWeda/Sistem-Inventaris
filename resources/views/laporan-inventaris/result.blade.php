<x-app-layout>
    <div class="px-1 md:px-2 xl:px-8 pt-1 md:pt-2 xl:pt-8 pb-2 text-3xl font-semibold text-blue-gray-900">
      	<h1>Laporan Inventaris</h1>
    </div>

    <div
		class="relative mx-1 sm:mx-4 lg:mx-8 text-gray-700 bg-white shadow-md bg-clip-border overflow-y-scroll">
		<table class="w-full text-left table-auto px-8 ">
		<thead class="sticky top-0">
		  <tr>
			<th class="p-2 lg:p-4 border-b border-blue-gray-100 bg-blue-gray-50">
			  <p class="block font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
				Nomor Inventaris
			  </p>
			</th>
			<th class="p-2 lg:p-4 border-b border-blue-gray-100 bg-blue-gray-50">
			  <p class="block font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
				Nama Inventaris
			  </p>
			</th>
			<th class="p-2 lg:p-4 border-b border-blue-gray-100 bg-blue-gray-50">
			  <p class="block font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
				Harga
			  </p>
			</th>
			<th class="p-2 lg:p-4 border-b border-blue-gray-100 bg-blue-gray-50">
			  <p class="block font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
				Tanggal Pembelian
			  </p>
			</th>
			<th class="p-2 lg:p-4 border-b border-blue-gray-100 bg-blue-gray-50">
			  <p class="block font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
				Tahun Penyusutan
			  </p>
			</th>
			<th class="p-2 lg:p-4 border-b border-blue-gray-100 bg-blue-gray-50">
			  <p class="block font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
				Kategori
			  </p>
			</th>
			<th class="p-2 lg:p-4 border-b border-blue-gray-100 bg-blue-gray-50">
			  <p class="block font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
				Penempatan
			  </p>
			</th>
			<th class="p-2 lg:p-4 border-b border-blue-gray-100 bg-blue-gray-50">
			  <p class="block font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
				Status
			  </p>
			</th>
			<th class="p-2 lg:p-4 border-b border-blue-gray-100 bg-blue-gray-50">
			  <p class="block font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
				Creator
			  </p>
			</th>
		  </tr>
		</thead>
		<tbody>
			@foreach ($laporanRecord as $inventaris)
				<tr class="even:bg-blue-gray-50/50">
					<td class="p-2 lg:p-4">
				  		<p class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
						{{ $inventaris->nomor_inventaris }}
				  		</p>
					</td>
					<td class="p-2 lg:p-4">
				  		<p class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
						{{ $inventaris->nama_inventaris }}
				  		</p>
					</td>
					<td class="p-2 lg:p-4">
					  	<p class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
						{{ $inventaris->harga_inventaris }}
					  	</p>
					</td>
					<td class="p-2 lg:p-4">
					  	<p class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
						{{ $inventaris->tanggal_pembelian->format('Y-m-d') }}
					  	</p>
					</td>
					<td class="p-2 lg:p-4">
					  	<p class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
						{{ $inventaris->tahun_penyusutan }}
					  	</p>
					</td>
					<td class="p-2 lg:p-4">
					  	<p class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
						{{ $inventaris->kategori->nama_kategori }}
					  	</p>
					</td>
					<td class="p-2 lg:p-4">
					  	<a class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900 hover:underline" href="/kantor-management/kantor/{{ $inventaris->kantor->slug }}">
						{{ $inventaris->kantor->nama_kantor }}
					  	</a>
					</td>
					<td class="p-2 lg:p-4">
					  	<p class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
						{{ $inventaris->status_inventaris }}
					  	</p>
					</td>
					<td class="p-2 lg:p-4">
					  	<p class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
						{{ $inventaris->creator->user_name }}
					  	</p>
					</td>
				</tr>
			@endforeach
		</tbody>
		</table>
	</div>
    
    <div class="mx-8 my-4">
        {{ $laporanRecord->links() }}
	</div>

    <div class="flex mx-1 sm:mx-4 lg:mx-8">
        <a 
            href="/laporan-inventaris" 
            data-ripple-dark="true"
            class="p-2 bg-blue-gray-100 text-blue-gray-700 transition-all rounded-lg outline-none font-semibold text-center hover:bg-blue-gray-50 hover:bg-opacity-80 hover:text-blue-gray-900 hover:cursor-pointer focus:bg-blue-gray-50 focus:bg-opacity-80 focus:text-blue-gray-900 active:bg-blue-gray-50 active:bg-opacity-80 active:text-blue-gray-900 ">
            Back
        </a>
        <form action="/laporan-inventaris/download" class="ml-2 md:ml-auto">
			@if (!empty($request['start_date']))
			<input type="hidden" value="{{ $request['start_date'] }}" name="start_date">
            @endif
            <input type="hidden" value="{{ $request['end_date'] }}" name="end_date">
            @if (!empty($request['kategori_id']))
            <input type="hidden" value="{{ $request['kategori_id'] }}" name="kategori_id">
            @endif
            @if (!empty($request['status']))
            <input type="hidden" value="{{ $request['status'] }}" name="status">
            @endif
            @if (!empty($request['kondisi']))
            <input type="hidden" value="{{ $request['kondisi'] }}" name="kondisi">
            @endif
            <div data-ripple-dark="true" class="w-fit">
                <input 
                type="submit" 
                value="Download Laporan"
                class="p-2 bg-blue-gray-700 text-white transition-all rounded-lg outline-none font-semibold text-center hover:bg-blue-gray-50 hover:bg-opacity-80 hover:text-blue-gray-900 hover:cursor-pointer focus:bg-blue-gray-50 focus:bg-opacity-80 focus:text-blue-gray-900 active:bg-blue-gray-50 active:bg-opacity-80 active:text-blue-gray-900 "
                >
            </div>
        </form>
    </div>
</x-app-layout>