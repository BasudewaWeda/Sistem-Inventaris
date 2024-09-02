<x-app-layout>
    <div class="px-8 pt-8 pb-2 text-3xl font-semibold text-blue-gray-900">
      	<h1>Inventaris</h1>
    </div>

    <div class="flex mx-8 my-4 items-center">
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
		<div class="ml-auto flex gap-2">
			@if ($addPemindahanInventaris)
			<form action="/inventaris-management/pemindahan" class="hidden" id="pemindahan-button">
				<input type="hidden" name="selected_items" id="selected_items">
				<div onclick="window.location.href='/inventaris-management/add'"
					data-ripple-dark="true"
					class="items-center p-3 leading-tight bg-blue-gray-700 text-white transition-all rounded-lg outline-none font-semibold text-center hover:bg-blue-gray-50 hover:bg-opacity-80 hover:text-blue-gray-900 hover:cursor-pointer focus:bg-blue-gray-50 focus:bg-opacity-80 focus:text-blue-gray-900 active:bg-blue-gray-50 active:bg-opacity-80 active:text-blue-gray-900 ">
					<input type="submit" value="Pemindahan Inventaris" id="pemindahan-button" class="hover:cursor-pointer">
				</div>
			</form>
			@endif
			@if ($inputInventaris)
			<div onclick="window.location.href='/inventaris-management/add'"
				data-ripple-dark="true"
				class="remove-selection w-1/8 items-center p-3 leading-tight bg-blue-gray-700 text-white transition-all rounded-lg outline-none font-semibold text-center hover:bg-blue-gray-50 hover:bg-opacity-80 hover:text-blue-gray-900 hover:cursor-pointer focus:bg-blue-gray-50 focus:bg-opacity-80 focus:text-blue-gray-900 active:bg-blue-gray-50 active:bg-opacity-80 active:text-blue-gray-900 ">
				Input Inventaris
			</div>
			@endif
		</div>
	</div>

    <div
		class="relative mx-8 text-gray-700 bg-white shadow-md bg-clip-border">
		<table class="w-full text-left table-auto px-8 ">
		<thead class="sticky top-0">
		  <tr>
			<th class="p-4 border-b border-blue-gray-100 bg-blue-gray-50">
			</th>
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
				Tanggal Pembelian
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
			  <p class="block font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70"></p>
			</th>
		  </tr>
		</thead>
		<tbody>
			<form action="">
			@foreach ($inventarisRecord as $inventaris)
				<tr class="even:bg-blue-gray-50/50">
					@if (!(in_array($inventaris->status_inventaris, array('Pending Approval', 'Rejected', 'Approval 1', 'Pending Approval Pemindahan', 'Approval 1 Pemindahan'))))
					<td class="p-4">
						<input type="checkbox"
							class="item-checkbox before:content[''] peer relative h-5 w-5 cursor-pointer appearance-none rounded-md border border-blue-gray-200 transition-all before:absolute before:top-2/4 before:left-2/4 before:block before:h-12 before:w-12 before:-translate-y-2/4 before:-translate-x-2/4 before:rounded-full before:bg-blue-gray-500 before:opacity-0 before:transition-opacity checked:border-gray-900 checked:bg-gray-900 checked:before:bg-gray-900 hover:before:opacity-10"
							id="{{ $inventaris->inventaris_id }}"
							name="inventaris_ids[]"
							value="{{ $inventaris->inventaris_id }}" />
						<span
							class="absolute text-white transition-opacity opacity-0 pointer-events-none top-2/4 left-2/4 -translate-y-2/4 -translate-x-2/4 peer-checked:opacity-100">
							<svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" viewBox="0 0 20 20" fill="currentColor"
							stroke="currentColor" stroke-width="1">
							<path fill-rule="evenodd"
							d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
							clip-rule="evenodd"></path>
							</svg>
						</span>
					</td>
					@else
					<td class="p-4">
					</td>
					@endif
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
						{{ $inventaris->tanggal_pembelian->format('Y-m-d') }}
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
					  	<a class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900 hover:underline" href="/kantor-management/kantor/{{ $inventaris->kantor->slug }}">
						{{ $inventaris->kantor->nama_kantor }}
					  	</a>
					</td>
					<td class="p-4">
					  	<p class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
						{{ $inventaris->status_inventaris }}
					  	</p>
					</td>
					<td class="p-4">
					  	<p class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
						{{ $inventaris->creator->user_name }}
					  	</p>
					</td>
					<td class="p-4">
						<div class="flex gap-16 items-center">
                            <a href="/inventaris-management/inventaris/{{ $inventaris->inventaris_id }}" class="block font-sans text-sm antialiased font-medium leading-normal text-blue-gray-900 hover:underline">View</a>
						</div>
					</td>
				</tr>
			@endforeach
			</form>
		</tbody>
		</table>
	</div>

    <div class="mx-8 my-4">
		{{ $inventarisRecord->links() }}
	</div>

	<script>
		document.addEventListener('DOMContentLoaded', function() {
		    const checkboxes = document.querySelectorAll('.item-checkbox');
		    const localStorageKey = 'selectedItems';
			const pemindahanButton = document.getElementById('pemindahan-button');

		    // Retrieve stored selected items from localStorage
		    const storedIds = JSON.parse(localStorage.getItem(localStorageKey)) || [];
			updateSelectedItemsField();
			updateButtonVisibility();

			function updateSelectedItemsField() {
				document.getElementById('selected_items').value = storedIds;
    		}

		    // Check the stored IDs and mark the checkboxes
		    checkboxes.forEach(checkbox => {
		        if (storedIds.includes(checkbox.value)) {
		            checkbox.checked = true;
		        }
		    });
		
		    // Update localStorage when a checkbox is checked/unchecked
		    checkboxes.forEach(checkbox => {
		        checkbox.addEventListener('change', function() {
		            const id = checkbox.value;
				
		            if (checkbox.checked) {
		                if (!storedIds.includes(id)) {
		                    storedIds.push(id);
		                }
		            } else {
		                const index = storedIds.indexOf(id);
		                if (index !== -1) {
		                    storedIds.splice(index, 1);
		                }
		            }
					
					updateSelectedItemsField();
					updateButtonVisibility();
				
		            // Store the updated array in localStorage
		            localStorage.setItem(localStorageKey, JSON.stringify(storedIds));
		        });
		    });

			function updateButtonVisibility() {
    		    if (storedIds.length > 0) {
    		        pemindahanButton.style.display = 'inline-block'; // Show the button
    		    } else {
    		        pemindahanButton.style.display = 'none'; // Hide the button
    		    }
    		}

			// Function to clear the selected items from localStorage
			function clearSelectedItems() {
				localStorage.removeItem(localStorageKey);
			}
	
			// Attach the function to the navigation menu links
			const menuLinks = document.querySelectorAll('.menu-link');
			menuLinks.forEach(link => {
				link.addEventListener('click', clearSelectedItems);
			});
			document.querySelector('.remove-selection').addEventListener('click', clearSelectedItems);
		});
	</script>
</x-app-layout>