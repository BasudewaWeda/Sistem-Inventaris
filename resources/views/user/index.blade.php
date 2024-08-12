<x-app-layout>
    <div class="px-8 pt-8 pb-2 text-3xl font-semibold text-blue-gray-900">
      	<h1>User Management</h1>
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
		@if ($addUser)
		<div onclick="window.location.href='/user-management/add'"
			data-ripple-dark="true"
			class="ml-auto w-1/12 items-center p-3 leading-tight bg-blue-gray-700 text-white transition-all rounded-lg outline-none font-semibold text-center hover:bg-blue-gray-50 hover:bg-opacity-80 hover:text-blue-gray-900 hover:cursor-pointer focus:bg-blue-gray-50 focus:bg-opacity-80 focus:text-blue-gray-900 active:bg-blue-gray-50 active:bg-opacity-80 active:text-blue-gray-900 ">
			Add User
		</div>
		@endif
	</div>

	<div
		class="relative flex mx-8 flex-col overflow-scroll text-gray-700 bg-white shadow-md bg-clip-border"
		x-data="{deleteMenu: false, deleteUrl: '', deleteUsername: ''}"
		>
		<table class="w-full text-left table-auto px-8">
		<thead>
		  <tr>
			<th class="p-4 border-b border-blue-gray-100 bg-blue-gray-50">
			  <p class="block font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
				Name
			  </p>
			</th>
			<th class="p-4 border-b border-blue-gray-100 bg-blue-gray-50">
			  <p class="block font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
				Email
			  </p>
			</th>
			<th class="p-4 border-b border-blue-gray-100 bg-blue-gray-50">
			  <p class="block font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
				Phone Number
			  </p>
			</th>
			<th class="p-4 border-b border-blue-gray-100 bg-blue-gray-50">
			  <p class="block font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
				Current Role
			  </p>
			</th>
			<th class="p-4 border-b border-blue-gray-100 bg-blue-gray-50">
			  <p class="block font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
				Created Time
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
			@foreach ($users as $user)
				<tr class="even:bg-blue-gray-50/50">
					<td class="p-4">
				  		<p class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
						{{ $user->user_name }}
				  		</p>
					</td>
					<td class="p-4">
				  		<p class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
						{{ $user->email }}
				  		</p>
					</td>
					<td class="p-4">
					  	<p class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
						{{ $user->user_phone_number }}
					  	</p>
					</td>
					<td class="p-4">
					  	<p class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
						{{ $user->currentRole->role_name }}
					  	</p>
					</td>
					<td class="p-4">
					  	<p class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
						{{ $user->created_at }}
					  	</p>
					</td>
					<td class="p-4">
					  	<p class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
						@if ($user->creator)
						{{ $user->creator->user_name }}
					  	</p>
						@endif
					</td>
					<td class="p-4">
					  	<p class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
						@if ($user->editor)
						{{ $user->editor->user_name }}
					  	</p>
						@endif
					</td>
					<td class="p-4">
						<div class="flex gap-16 items-center">
							@if ($editUser)
							<a href="/user-management/edit/{{ $user->slug }}" class="block font-sans text-sm antialiased font-medium leading-normal text-blue-gray-900 hover:underline">Edit</a>
							@endif
							@if ($deleteUser)
							<button @click.prevent="deleteMenu = true; deleteUrl = '/user-management/delete/{{ $user->slug }}'; deleteUsername = '{{ $user->user_name }}'" class="block font-sans text-sm antialiased font-medium leading-normal text-blue-gray-900 hover:underline">Delete</button>
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
					Delete user <strong x-text="deleteUsername"></strong> ?
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

	<div class="mx-8 my-4">
		{{ $users->links() }}
	</div>

</x-app-layout>