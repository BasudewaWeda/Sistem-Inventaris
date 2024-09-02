<x-app-layout>
    <div class="px-8 pt-8 pb-2 text-3xl font-semibold text-blue-gray-900">
      	<h1>Laporan Pemindahan Inventaris</h1>
    </div>

    <div
		class="relative flex mx-8 flex-col overflow-scroll text-gray-700 bg-white shadow-md bg-clip-border">
		<table class="w-full text-left table-auto px-8">
		<thead>
		  <tr>
			<th class="p-4 border-b border-blue-gray-100 bg-blue-gray-50">
			  <p class="block font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
				Judul Pemindahan
			  </p>
			</th>
			<th class="p-4 border-b border-blue-gray-100 bg-blue-gray-50">
			  <p class="block font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
				Kantor Tujuan
			  </p>
			</th>
			<th class="p-4 border-b border-blue-gray-100 bg-blue-gray-50">
			  <p class="block font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
				Lantai
			  </p>
			</th>
            <th class="p-4 border-b border-blue-gray-100 bg-blue-gray-50">
              <p class="block font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
                Ruangan
              </p>
            </th>
            <th class="p-4 border-b border-blue-gray-100 bg-blue-gray-50">
              <p class="block font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
                Jumlah Inventaris
              </p>
            </th>
			<th class="p-4 border-b border-blue-gray-100 bg-blue-gray-50">
			  <p class="block font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
				Status Pemindahan
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
			@foreach ($laporanRecord as $pemindahanInventaris)
				<tr class="even:bg-blue-gray-50/50">
					<td class="p-4">
				  		<p class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
						{{ $pemindahanInventaris->judul_pemindahan_inventaris }}
				  		</p>
					</td>
					<td class="p-4">
				  		<a class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900 hover:underline" href='/kantor-management/kantor/{{ $pemindahanInventaris->kantorTujuan->slug }}'>
						{{ Str::limit($pemindahanInventaris->kantorTujuan->nama_kantor, 20, '...') }}
				  		</a>
					</td>
					<td class="p-4">
					  	<p class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
						{{ $pemindahanInventaris->lantaiTujuan->nama_lantai }}
					  	</p>
					</td>
					<td class="p-4">
					  	<p class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
						{{ $pemindahanInventaris->ruanganTujuan->nama_ruangan }}
					  	</p>
					</td>
					<td class="p-4">
					  	<p class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
						{{ $pemindahanInventaris->inventaris->count() ?? 0 }}
					  	</p>
					</td>
					<td class="p-4">
					  	<p class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
						{{ $pemindahanInventaris->status_pemindahan_inventaris }}
					  	</p>
					</td>
					<td class="p-4">
					  	<p class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
						@if ($pemindahanInventaris->creator)
						{{ $pemindahanInventaris->creator->user_name }}
					  	</p>
						@endif
					</td>
                    <td class="p-4">
                        <p class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
                        {{ $pemindahanInventaris->created_at }}
                        </p>
                    </td>
					<td class="p-4">
						<div class="flex gap-16 items-center">
                            <a href="/approval-pemindahan-inventaris/{{ $pemindahanInventaris->pemindahan_inventaris_id }}" class="block font-sans text-sm antialiased font-medium leading-normal text-blue-gray-900 hover:underline">View</a>
						</div>
					</td>
				</tr>
			@endforeach
		</tbody>
		</table>
	</div>
    
    <div class="mx-8 my-4">
        {{ $laporanRecord->links() }}
	</div>

    <div class="flex mx-8">
        <a 
            href="/laporan-pemindahan-inventaris" 
            data-ripple-dark="true"
            class="p-2 bg-blue-gray-100 text-blue-gray-700 transition-all rounded-lg outline-none font-semibold text-center hover:bg-blue-gray-50 hover:bg-opacity-80 hover:text-blue-gray-900 hover:cursor-pointer focus:bg-blue-gray-50 focus:bg-opacity-80 focus:text-blue-gray-900 active:bg-blue-gray-50 active:bg-opacity-80 active:text-blue-gray-900 ">
            Back
        </a>
        <form action="/laporan-pemindahan-inventaris/download" class="ml-auto">
            <input type="hidden" value="{{ $request['start_date'] }}" name="start_date">
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