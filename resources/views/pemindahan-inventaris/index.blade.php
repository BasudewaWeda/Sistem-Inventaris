<x-app-layout>
    <div class="px-1 sm:px-4 lg:px-8 pt-1 sm:pt-4 lg:pt-8 pb-2 text-3xl font-semibold text-blue-gray-900">
      	<h1>Approval Pemindahan Inventaris</h1>
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
		class="relative flex mx-1 sm:mx-4 lg:mx-8 flex-col overflow-scroll text-gray-700 bg-white shadow-md bg-clip-border">
		<table class="w-full text-left table-auto px-8">
		<thead>
		  <tr>
			<th class="p-2 xl:p-4 border-b border-blue-gray-100 bg-blue-gray-50">
			  <p class="block font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
				Judul Pemindahan
			  </p>
			</th>
			<th class="p-2 xl:p-4 border-b border-blue-gray-100 bg-blue-gray-50">
			  <p class="block font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
				Kantor Tujuan
			  </p>
			</th>
			<th class="p-2 xl:p-4 border-b border-blue-gray-100 bg-blue-gray-50">
			  <p class="block font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
				Lantai
			  </p>
			</th>
            <th class="p-2 xl:p-4 border-b border-blue-gray-100 bg-blue-gray-50">
              <p class="block font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
                Ruangan
              </p>
            </th>
			<th class="p-2 xl:p-4 border-b border-blue-gray-100 bg-blue-gray-50">
			  <p class="block font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
				Status Pemindahan
			  </p>
			</th>
			<th class="p-2 xl:p-4 border-b border-blue-gray-100 bg-blue-gray-50">
			  <p class="block font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
				Creator
			  </p>
			</th>
			<th class="p-2 xl:p-4 border-b border-blue-gray-100 bg-blue-gray-50">
			  <p class="block font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
				Created At
			  </p>
			</th>
			<th class="p-2 xl:p-4 border-b border-blue-gray-100 bg-blue-gray-50">
			  <p class="block font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
			  </p>
			</th>
		  </tr>
		</thead>
		<tbody>
			@foreach ($pemindahanInventarisRecord as $pemindahanInventaris)
				<tr class="even:bg-blue-gray-50/50">
					<td class="p-2 xl:p-4">
				  		<p class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
						{{ $pemindahanInventaris->judul_pemindahan_inventaris }}
				  		</p>
					</td>
					<td class="p-2 xl:p-4">
				  		<a class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900 hover:underline" href='/kantor-management/kantor/{{ $pemindahanInventaris->kantorTujuan->slug }}'>
						{{ Str::limit($pemindahanInventaris->kantorTujuan->nama_kantor, 20, '...') }}
				  		</a>
					</td>
					<td class="p-2 xl:p-4">
					  	<p class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
						{{ $pemindahanInventaris->lantaiTujuan->nama_lantai }}
					  	</p>
					</td>
					<td class="p-2 xl:p-4">
					  	<p class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
						{{ $pemindahanInventaris->ruanganTujuan->nama_ruangan }}
					  	</p>
					</td>
					<td class="p-2 xl:p-4">
					  	<p class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
						{{ $pemindahanInventaris->status_pemindahan_inventaris }}
					  	</p>
					</td>
					<td class="p-2 xl:p-4">
					  	<p class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
						@if ($pemindahanInventaris->creator)
						{{ $pemindahanInventaris->creator->user_name }}
					  	</p>
						@endif
					</td>
                    <td class="p-2 xl:p-4">
                        <p class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
                        {{ $pemindahanInventaris->created_at }}
                        </p>
                    </td>
					<td class="p-2 xl:p-4">
						<div class="flex gap-4 xl:gap-16 items-center">
                            <a href="/approval-pemindahan-inventaris/{{ $pemindahanInventaris->pemindahan_inventaris_id }}" class="block font-sans text-sm antialiased font-medium leading-normal text-blue-gray-900 hover:underline">View</a>
						</div>
					</td>
				</tr>
			@endforeach
		</tbody>
		</table>
	</div>

    <div class="mx-8 my-4">
		{{ $pemindahanInventarisRecord->links() }}
	</div>
</x-app-layout>