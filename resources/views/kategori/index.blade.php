<x-app-layout>
    <div class="px-8 pt-8 pb-2 text-3xl font-semibold text-blue-gray-900">
      	<h1>Kategori Management</h1>
    </div>

	@if ($addKategori)
	<div onclick="window.location.href='/kategori-management/add'"
	    data-ripple-dark="true"
	        class="mx-8 my-4 w-1/12 items-center p-3 leading-tight bg-blue-gray-700 text-white transition-all rounded-lg outline-none font-semibold text-center hover:bg-blue-gray-50 hover:bg-opacity-80 hover:text-blue-gray-900 hover:cursor-pointer focus:bg-blue-gray-50 focus:bg-opacity-80 focus:text-blue-gray-900 active:bg-blue-gray-50 active:bg-opacity-80 active:text-blue-gray-900 ">
	    Add Kategori
	</div>
	@endif

	<div
		class="relative mx-8 max-w-[50vw] flex flex-col overflow-scroll text-gray-700 bg-white shadow-md bg-clip-border"
		x-data="{deleteMenu: false, deleteUrl: '', deleteKategoriname: ''}"
		x-cloak
		>
		<table class="text-left table-fixed px-8">
			<thead>
			  <tr>
				<th class="p-4 border-b border-blue-gray-100 bg-blue-gray-50">
				  <p class="block font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
					Nama Kategori
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
					Updated At
				  </p>
				</th>
				<th class="p-4 border-b border-blue-gray-100 bg-blue-gray-50">
				  <p class="block font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
					Editor
				  </p>
				</th>
				<th class="p-4 border-b border-blue-gray-100 bg-blue-gray-50">
				</th>
			  </tr>
			</thead>
			<tbody>
				@foreach ($kategoriRecord as $kategori)
					<tr class="even:bg-blue-gray-50/50">
						<td class="p-4">
					  		<p class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
							{{ $kategori->nama_kategori }}
					  		</p>
						</td>
						<td class="p-4">
					  		<p class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
							{{ $kategori->created_at }}
					  		</p>
						</td>
						<td class="p-4">
					  		<p class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
							@if ($kategori->creator)
							{{ $kategori->creator->user_name }}
							@endif
					  		</p>
						</td>
						<td class="p-4">
					  		<p class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
							{{ $kategori->updated_at }}
					  		</p>
						</td>
						<td class="p-4">
					  		<p class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
							@if ($kategori->editor)
							{{ $kategori->editor->user_name }}
							@endif
					  		</p>
						</td>
						<td class="p-4">
							<div class="flex gap-16 items-center">
								@if ($editKategori)
								<a href="/kategori-management/edit/{{ $kategori->slug }}" class="block font-sans text-sm antialiased font-medium leading-normal text-blue-gray-900 hover:underline">Edit</a>
								@endif
								@if ($deleteKategori)
								<button @click.prevent="deleteMenu = true; deleteUrl = '/kategori-management/delete/{{ $kategori->slug }}'; deleteKategoriname = '{{ $kategori->nama_kategori }}'" class="block font-sans text-sm antialiased font-medium leading-normal text-blue-gray-900 hover:underline">Delete</button>
								@endif
							</div>
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>

		<div x-show="deleteMenu"
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
					<h1>Delete Confirmation</h1>
			  	</div>
				<p class="mb-4 block font-sans antialiased font-normal leading-normal text-blue-gray-900">
					Delete kategori <strong x-text="deleteKategoriname"></strong> ?
				</p>
				<div class="flex gap-4">
					<div class="flex">
						<button @click="deleteMenu = false;"
						class="p-2 bg-blue-gray-100 text-blue-gray-700 transition-all rounded-lg outline-none font-semibold text-center hover:bg-blue-gray-50 hover:bg-opacity-80 hover:text-blue-gray-900 hover:cursor-pointer focus:bg-blue-gray-50 focus:bg-opacity-80 focus:text-blue-gray-900 active:bg-blue-gray-50 active:bg-opacity-80 active:text-blue-gray-900 ">
							Cancel
						</button>
					</div>
					<form :action="deleteUrl" method="POST">
						{{ csrf_field() }}
						@method('DELETE')
						<input type="submit"
						value="Delete"
						class="items-center p-3 leading-tight bg-blue-gray-700 text-white transition-all rounded-lg outline-none font-semibold text-center hover:bg-blue-gray-50 hover:bg-opacity-80 hover:text-blue-gray-900 hover:cursor-pointer focus:bg-blue-gray-50 focus:bg-opacity-80 focus:text-blue-gray-900 active:bg-blue-gray-50 active:bg-opacity-80 active:text-blue-gray-900 "
						>
					</form>
				</div>
			</div>
		</div>
	</div>

	<div class="mx-8 my-4 w-1/3">
		{{ $kategoriRecord->links() }}
	</div>
</x-app-layout>