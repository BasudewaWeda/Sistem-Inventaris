<x-app-layout>
    <div class="px-8 pt-8 pb-2 text-3xl font-semibold text-blue-gray-900">
      	<h1>Approval Inventaris</h1>
    </div>

    <div
		class="relative flex mx-8 flex-col overflow-scroll text-gray-700 bg-white shadow-md bg-clip-border">
		<table class="w-full text-left table-auto px-8">
		<thead>
		  <tr>
			<th class="p-4 border-b border-blue-gray-100 bg-blue-gray-50">
			  <p class="block font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
				Judul Inputan
			  </p>
			</th>
			<th class="p-4 border-b border-blue-gray-100 bg-blue-gray-50">
			  <p class="block font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
				Tanggal Pembelian
			  </p>
			</th>
			<th class="p-4 border-b border-blue-gray-100 bg-blue-gray-50">
			  <p class="block font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
				Jumlah
			  </p>
			</th>
            <th class="p-4 border-b border-blue-gray-100 bg-blue-gray-50">
              <p class="block font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
                Kategori
              </p>
            </th>
			<th class="p-4 border-b border-blue-gray-100 bg-blue-gray-50">
			  <p class="block font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
				Total Harga
			  </p>
			</th>
			<th class="p-4 border-b border-blue-gray-100 bg-blue-gray-50">
			  <p class="block font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
				Penempatan
			  </p>
			</th>
			<th class="p-4 border-b border-blue-gray-100 bg-blue-gray-50">
			  <p class="block font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
				Status
			  </p>
			</th>
			<th class="p-4 border-b border-blue-gray-100 bg-blue-gray-50">
			  <p class="block font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
				Creator
			  </p>
			</th>
			<th class="p-4 border-b border-blue-gray-100 bg-blue-gray-50">
			  <p class="block font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
				Created At
			  </p>
			</th>
			<th class="p-4 border-b border-blue-gray-100 bg-blue-gray-50">
			  <p class="block font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
			  </p>
			</th>
		  </tr>
		</thead>
		<tbody>
			@foreach ($inputInventarisRecord as $inputInventaris)
				<tr class="even:bg-blue-gray-50/50">
					<td class="p-4">
				  		<p class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
						{{ $inputInventaris->judul_input_inventaris }}
				  		</p>
					</td>
					<td class="p-4">
				  		<p class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
						{{ $inputInventaris->tanggal_pembelian }}
				  		</p>
					</td>
					<td class="p-4">
					  	<p class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
						{{ $inputInventaris->jumlah_inventaris }}
					  	</p>
					</td>
					<td class="p-4">
					  	<p class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
						{{ $inputInventaris->kategori->nama_kategori }}
					  	</p>
					</td>
					<td class="p-4">
					  	<p class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
						{{ 'Rp.' . number_format($inputInventaris->harga_inventaris * $inputInventaris->jumlah_inventaris, 2, ',', '.') }}
					  	</p>
					</td>
					<td class="p-4">
					  	<p class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
						{{ $inputInventaris->kantor->nama_kantor }}
					  	</p>
					</td>
					<td class="p-4">
					  	<p class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
						{{ $inputInventaris->status_input_inventaris }}
					  	</p>
					</td>
					<td class="p-4">
					  	<p class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
						@if ($inputInventaris->creator)
						{{ $inputInventaris->creator->user_name }}
					  	</p>
						@endif
					</td>
                    <td class="p-4">
                        <p class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
                        {{ $inputInventaris->created_at }}
                        </p>
                    </td>
					<td class="p-4">
						<div class="flex gap-16 items-center">
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