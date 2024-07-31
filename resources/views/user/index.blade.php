<x-app-layout>
    <div class="px-8 pt-8 pb-2 text-3xl font-semibold text-blue-gray-900">
      	<h1>User Management</h1>
    </div>

	<div onclick="window.location.href='/user-management/add'"
	    data-ripple-dark="true"
	        class="m-4 ml-auto w-1/12 items-center p-3 leading-tight bg-blue-gray-700 text-white transition-all rounded-lg outline-none font-semibold text-center hover:bg-blue-gray-50 hover:bg-opacity-80 hover:text-blue-gray-900 hover:cursor-pointer focus:bg-blue-gray-50 focus:bg-opacity-80 focus:text-blue-gray-900 active:bg-blue-gray-50 active:bg-opacity-80 active:text-blue-gray-900 ">
	    Add User
	</div>

	<div
		  class="relative flex mx-4 flex-col overflow-scroll text-gray-700 bg-white shadow-md bg-clip-border">
		  <table class="w-full text-left table-fixed px-8">
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
				<th class="py-4 border-b border-blue-gray-100 bg-blue-gray-50">
				  <p class="block font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
					Phone Number
				  </p>
				</th>
				<th class="py-4 border-b border-blue-gray-100 bg-blue-gray-50">
				  <p class="block font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
					Current Role
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
						<td class="p-4 flex gap-16">
						  	<a href="#" class="block font-sans text-sm antialiased font-medium leading-normal text-blue-gray-900 hover:underline">Edit</a>
						  	<a href="#" class="block font-sans text-sm antialiased font-medium leading-normal text-blue-gray-900 hover:underline">Delete</a>
						</td>
					</tr>
				@endforeach
			</tbody>
		  </table>
	</div>
</x-app-layout>