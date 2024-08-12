<x-app-layout>
    <div class="px-8 pt-8 pb-2 text-3xl font-semibold text-blue-gray-900">
      	<h1>Kantor Management</h1>
    </div>

	<div class="flex my-4 mx-8 items-center">
		<form class="flex gap-2 items-center">
			<input 
			type="text" 
			placeholder="Search..."
			name="search"
			autocomplete="off"
			class="rounded-md border border-blue-gray-200 border-t-transparent !border-t-blue-gray-200 bg-transparent p-3 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 focus:border-1 focus:border-gray-900 focus:border-t-transparent focus:!border-t-gray-900 focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"
			>
			<input
			type="submit"
			value="Search"
			class="items-center p-3 bg-blue-gray-700 text-white transition-all rounded-lg outline-none font-semibold text-center hover:bg-blue-gray-50 hover:bg-opacity-80 hover:text-blue-gray-900 hover:cursor-pointer focus:bg-blue-gray-50 focus:bg-opacity-80 focus:text-blue-gray-900 active:bg-blue-gray-50 active:bg-opacity-80 active:text-blue-gray-900">
		</form>
		@if ($addKantor)
		<div onclick="window.location.href='/kantor-management/add'"
			data-ripple-dark="true"
				class="ml-auto w-1/12 items-center p-3 leading-tight bg-blue-gray-700 text-white transition-all rounded-lg outline-none font-semibold text-center hover:bg-blue-gray-50 hover:bg-opacity-80 hover:text-blue-gray-900 hover:cursor-pointer focus:bg-blue-gray-50 focus:bg-opacity-80 focus:text-blue-gray-900 active:bg-blue-gray-50 active:bg-opacity-80 active:text-blue-gray-900 ">
			Add Kantor
		</div>
		@endif
	</div>

	<div
		class="relative flex mx-8 flex-col overflow-scroll text-gray-700 bg-white shadow-md bg-clip-border">
		<table class="w-full text-left table-auto px-8">
		<thead>
		  <tr>
			<th class="p-4 border-b border-blue-gray-100 bg-blue-gray-50">
			  <p class="block font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
				Kode
			  </p>
			</th>
			<th class="p-4 border-b border-blue-gray-100 bg-blue-gray-50">
			  <p class="block font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
				Nama
			  </p>
			</th>
			<th class="p-4 border-b border-blue-gray-100 bg-blue-gray-50">
			  <p class="block font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
				Nomor Telepon
			  </p>
			</th>
			<th class="p-4 border-b border-blue-gray-100 bg-blue-gray-50">
			  <p class="block font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
				Alamat
			  </p>
			</th>
			<th class="p-4 border-b border-blue-gray-100 bg-blue-gray-50">
			  <p class="block font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
				Kabupaten
			  </p>
			</th>
			<th class="p-4 border-b border-blue-gray-100 bg-blue-gray-50">
			  <p class="block font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
				Provinsi
			  </p>
			</th>
			<th class="p-4 border-b border-blue-gray-100 bg-blue-gray-50">
			  <p class="block font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
				Created At
			  </p>
			</th>
			<th class="p-4 border-b border-blue-gray-100 bg-blue-gray-50">
			  <p class="block font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
				Creator
			  </p>
			</th>
			<th class="p-4 border-b border-blue-gray-100 bg-blue-gray-50">
			  <p class="block font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
				Editor
			  </p>
			</th>
			<th class="p-4 border-b border-blue-gray-100 bg-blue-gray-50">
			  <p class="block font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70"></p>
			</th>
		  </tr>
		</thead>
		<tbody>
			@foreach ($kantorRecords as $kantor)
				<tr class="even:bg-blue-gray-50/50 items-center">
					<td class="p-4">
				  		<p class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
						{{ $kantor->kode_kantor }}
				  		</p>
					</td>
					<td class="p-4">
				  		<p class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
						{{ Str::of($kantor->nama_kantor)->limit(40,	'...') }}
				  		</p>
					</td>
					<td class="p-4">
					  	<p class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
						{{ $kantor->nomor_telepon_kantor }}
					  	</p>
					</td>
					<td class="p-4">
					  	<p class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
						{{ Str::of($kantor->alamat_kantor)->limit(40, '...') }}
					  	</p>
					</td>
					<td class="p-4">
					  	<p class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
						{{ $kantor->kabupaten->nama_kabupaten }}
					  	</p>
					</td>
					<td class="p-4">
					  	<p class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
						{{ $kantor->provinsi->nama_provinsi }}
					  	</p>
					</td>
					<td class="p-4">
					  	<p class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
						{{ $kantor->created_at }}
					  	</p>
					</td>
					<td class="p-4">
						@if ($kantor->creator)
					  	<p class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
						{{ $kantor->creator->user_name }}
					  	</p>
						@endif
					</td>
					<td class="p-4">
						@if ($kantor->editor)
					  	<p class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
						{{ $kantor->editor->user_name }}
						@endif
					  	</p>
					</td>
					<td class="py-4">
                        <div class="flex gap-4 items-center">
                            <a href="/kantor-management/kantor/{{ $kantor->slug }}" class="block font-sans text-sm antialiased font-medium leading-normal text-blue-gray-900 hover:underline">View</a>
                            @if ($editKantor)
                            <a href="/kantor-management/edit/{{ $kantor->slug }}" class="block font-sans text-sm antialiased font-medium leading-normal text-blue-gray-900 hover:underline">Edit</a>
                            @endif
                            @if ($deleteKantor)
                            <a href="/kantor-management/delete/{{ $kantor->slug }}" data-confirm-delete="true" class="block font-sans text-sm antialiased font-medium leading-normal text-blue-gray-900 hover:underline">Delete</a>
                            @endif
                        </div>
					</td>
				</tr>
			@endforeach
		</tbody>
		</table>
	</div>

	<div class="mx-8 my-4">
		{{ $kantorRecords->links() }}
	</div>
</x-app-layout>