<x-app-layout>
    <div class="px-1 sm:px-4 lg:px-8 pt-1 sm:pt-4 lg:pt-8 pb-2 text-3xl font-semibold text-blue-gray-900">
      	<h1>Approval Inventaris</h1>
    </div>

	<div class="flex my-1 mx-1 sm:mx-4 lg:mx-8 sm:my-2 lg:my-4 items-center">
		<form class="flex-col sm:flex-row gap-2 items-center">
			<input 
			type="text" 
			placeholder="Search..."
			name="search"
			autocomplete="off"
			class="rounded-md border border-blue-gray-200 border-t-transparent !border-t-blue-gray-200 bg-transparent p-2 sm:p-3 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 focus:border-1 focus:border-gray-900 focus:border-t-transparent focus:!border-t-gray-900 focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"
			>
			<input
			type="submit"
			value="Search"
			class="items-center p-2 sm:p-2.5 bg-blue-gray-700 text-white transition-all rounded-lg outline-none font-semibold text-center hover:bg-blue-gray-50 hover:bg-opacity-80 hover:text-blue-gray-900 hover:cursor-pointer focus:bg-blue-gray-50 focus:bg-opacity-80 focus:text-blue-gray-900 active:bg-blue-gray-50 active:bg-opacity-80 active:text-blue-gray-900">
		</form>
	</div>

    <div
		class="relative flex mx-1 sm:mx-4 lg:mx-8 overflow-scroll text-gray-700 bg-white shadow-md bg-clip-border">
		<table class="w-full text-left table-auto px-8">
		<thead>
		  <tr>
			<th class="p-2 lg:p-4 border-b border-blue-gray-100 bg-blue-gray-50">
			  <p class="block font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
				Judul Inputan
			  </p>
			</th>
			<th class="p-2 lg:p-4 border-b border-blue-gray-100 bg-blue-gray-50">
			  <p class="block font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
				Tanggal Pembelian
			  </p>
			</th>
			<th class="p-2 lg:p-4 border-b border-blue-gray-100 bg-blue-gray-50">
			  <p class="block font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
				Jumlah
			  </p>
			</th>
            <th class="p-2 lg:p-4 border-b border-blue-gray-100 bg-blue-gray-50">
              <p class="block font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
                Kategori
              </p>
            </th>
			<th class="p-2 lg:p-4 border-b border-blue-gray-100 bg-blue-gray-50">
			  <p class="block font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
				Total Harga
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
			<th class="p-2 lg:p-4 border-b border-blue-gray-100 bg-blue-gray-50">
			  <p class="block font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
				Created At
			  </p>
			</th>
			<th class="p-2 lg:p-4 border-b border-blue-gray-100 bg-blue-gray-50">
			  <p class="block font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
			  </p>
			</th>
		  </tr>
		</thead>
		<tbody>
			@foreach ($inputInventarisRecord as $inputInventaris)
				<tr class="even:bg-blue-gray-50/50">
					<td class="p-2 lg:p-4">
				  		<p class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
						{{ $inputInventaris->judul_input_inventaris }}
				  		</p>
					</td>
					<td class="p-2 lg:p-4">
				  		<p class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
						{{ $inputInventaris->tanggal_pembelian }}
				  		</p>
					</td>
					<td class="p-2 lg:p-4">
					  	<p class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
						{{ $inputInventaris->jumlah_inventaris }}
					  	</p>
					</td>
					<td class="p-2 lg:p-4">
					  	<p class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
						{{ $inputInventaris->kategori->nama_kategori }}
					  	</p>
					</td>
					<td class="p-2 lg:p-4">
					  	<p class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
						{{ 'Rp.' . number_format($inputInventaris->harga_inventaris * $inputInventaris->jumlah_inventaris, 2, ',', '.') }}
					  	</p>
					</td>
					<td class="p-2 lg:p-4">
					  	<a class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900 hover:underline" href="/kantor-management/kantor/{{ $inputInventaris->kantor->slug }}">
						{{ $inputInventaris->kantor->nama_kantor }}
					  	</a>
					</td>
					<td class="p-2 lg:p-4">
					  	<p class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
						{{ $inputInventaris->status_input_inventaris }}
					  	</p>
					</td>
					<td class="p-2 lg:p-4">
					  	<p class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
						@if ($inputInventaris->creator)
						{{ $inputInventaris->creator->user_name }}
					  	</p>
						@endif
					</td>
                    <td class="p-2 lg:p-4">
                        <p class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
                        {{ $inputInventaris->created_at }}
                        </p>
                    </td>
					<td class="p-2 lg:p-4">
						<div class="flex gap-4 lg:gap-16 items-center">
                            <a href="/approval-inventaris/{{ $inputInventaris->input_inventaris_id }}" class="block font-sans text-sm antialiased font-medium leading-normal text-blue-gray-900 hover:underline">View</a>
						</div>
					</td>
				</tr>
			@endforeach
		</tbody>
		</table>
	</div>

    <div class="mx-8 my-4">
		{{ $inputInventarisRecord->links() }}
	</div>
</x-app-layout>