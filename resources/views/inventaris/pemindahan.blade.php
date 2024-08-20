<x-app-layout>
    <div class="px-8 pt-8 pb-2 text-3xl font-semibold text-blue-gray-900">
      	<h1>Pemindahan Inventaris</h1>
    </div>

    @if ($errors->any())
    <div role="alert"
      class="w-1/2 relative flex p-4 mx-8 text-base text-gray-900 border border-gray-900 rounded-lg font-regular"
      style="opacity: 1;">
      <div class="shrink-0"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
          class="w-6 h-6">
          <path fill-rule="evenodd"
            d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm8.706-1.442c1.146-.573 2.437.463 2.126 1.706l-.709 2.836.042-.02a.75.75 0 01.67 1.34l-.04.022c-1.147.573-2.438-.463-2.127-1.706l.71-2.836-.042.02a.75.75 0 11-.671-1.34l.041-.022zM12 9a.75.75 0 100-1.5.75.75 0 000 1.5z"
            clip-rule="evenodd"></path>
        </svg></div>
      <div class="ml-3 mr-12">
        <p class="block font-sans text-base antialiased font-medium leading-relaxed text-inherit">Errors occured:</p>
        <ul class="mt-2 ml-2 list-disc list-inside">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div>
    </div>
    @endif


    <div class="flex h-3/4">
        <div class="w-1/2 px-8 pt-8 pb-2 relative text-gray-700 bg-transparent shadow-none rounded-xl bg-clip-border">
            <form action="" method="POST">
                {{ csrf_field() }}
                <div class="grid grid-cols-8 gap-4 items-center mb-4">
                    <label 
                    for="judul" 
                    class="col-span-2 block font-sans text-base antialiased font-semibold leading-relaxed tracking-normal text-blue-gray-900">
                        Judul Pemindahan
                    </label>
                    <input 
                    type="text" 
                    placeholder="Pemindahan Inventaris Meja" 
                    name="judul_pemindahan_inventaris"
                    id="judul"
                    required
                    class="col-span-6 rounded-md border border-blue-gray-200 border-t-transparent !border-t-blue-gray-200 bg-transparent p-3 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 focus:border-1 focus:border-gray-900 focus:border-t-transparent focus:!border-t-gray-900 focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"
                    value="{{ old('judul_pemindahan_inventaris') ?? "" }}"
                    >
                </div>
                <div class="grid grid-cols-8 gap-4 items-center mb-4">
                    <label 
                    for="kantor" 
                    class="col-span-2 block font-sans text-base antialiased font-semibold leading-relaxed tracking-normal text-blue-gray-900">
                        Kantor Tujuan
                    </label>
                    <div class="col-span-6">
                        <select
                        class="peer h-full w-full rounded-[7px] border border-blue-gray-200 bg-transparent p-3 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 empty:!bg-gray-900 focus:border-1 focus:border-gray-900 focus:border-t-transparent focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"
                        name="kantor_id_tujuan"
                        id="kantor"
                        >
                            <option value="">Select Kantor</option>
                            @foreach ($kantorRecord as $kantor)
                            <option value="{{ $kantor->kantor_id }}" @if ($kantor->kantor_id == old('kantor_id_tujuan')) selected @endif>{{ $kantor->nama_kantor }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="grid grid-cols-8 gap-4 items-center mb-4">
                    <label 
                    for="lantai" 
                    class="col-span-2 block font-sans text-base antialiased font-semibold leading-relaxed tracking-normal text-blue-gray-900">
                        Lantai
                    </label>
                    <div class="col-span-6">
                        <select
                        class="peer h-full w-full rounded-[7px] border border-blue-gray-200 bg-transparent p-3 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 empty:!bg-gray-900 focus:border-1 focus:border-gray-900 focus:border-t-transparent focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"
                        name="lantai_id_tujuan"
                        id="lantai"
                        >
                            <option value="">Select Lantai</option>
                        </select>
                    </div>
                </div>
                <div class="grid grid-cols-8 gap-4 items-center mb-4">
                    <label 
                    for="ruangan" 
                    class="col-span-2 block font-sans text-base antialiased font-semibold leading-relaxed tracking-normal text-blue-gray-900">
                        Ruangan
                    </label>
                    <div class="col-span-6">
                        <select
                        class="peer h-full w-full rounded-[7px] border border-blue-gray-200 bg-transparent p-3 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 empty:!bg-gray-900 focus:border-1 focus:border-gray-900 focus:border-t-transparent focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"
                        name="ruangan_id_tujuan"
                        id="ruangan"
                        >
                            <option value="">Select Ruangan</option>
                        </select>
                    </div>
                </div>
                <div class="grid grid-cols-8 gap-4 items-center mb-4">
                    <label 
                    for="approver1" 
                    class="col-span-2 block font-sans text-base antialiased font-semibold leading-relaxed tracking-normal text-blue-gray-900">
                        Approver 1 (Kadiv)
                    </label>
                    <div class="col-span-6">
                        <select
                        class="peer h-full w-full rounded-[7px] border border-blue-gray-200 bg-transparent p-3 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 empty:!bg-gray-900 focus:border-1 focus:border-gray-900 focus:border-t-transparent focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"
                        name="approver_1"
                        id="approver1"
                        >
                            <option value="">Select Approver</option>
                            @foreach ($firstApprovers as $approver)
                            <option value="{{ $approver->user_id }}" @if ($approver->user_id == old('approver_1')) selected @endif>{{ $approver->user_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <input type="hidden" name="inventaris_ids" value={{ $inventarisRecords->implode('inventaris_id', ',') }}>
                <div class="grid grid-cols-8 gap-4 items-center mb-4">
                    <label 
                    for="approver1" 
                    class="col-span-2 block font-sans text-base antialiased font-semibold leading-relaxed tracking-normal text-blue-gray-900">
                        Approver 2 (Kabag)
                    </label>
                    <div class="col-span-6">
                        <select
                        class="peer h-full w-full rounded-[7px] border border-blue-gray-200 bg-transparent p-3 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 empty:!bg-gray-900 focus:border-1 focus:border-gray-900 focus:border-t-transparent focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"
                        name="approver_2"
                        id="approver2"
                        >
                            <option value="">Select Approver</option>
                            @foreach ($secondApprovers as $approver)
                            <option value="{{ $approver->user_id }}" @if ($approver->user_id == old('approver_2')) selected @endif>{{ $approver->user_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="flex gap-4 justify-end">
                    <div class="flex">
                        <a 
                            href="/inventaris-management" 
                            data-ripple-dark="true"
                            class="p-2 bg-blue-gray-100 text-blue-gray-700 transition-all rounded-lg outline-none font-semibold text-center hover:bg-blue-gray-50 hover:bg-opacity-80 hover:text-blue-gray-900 hover:cursor-pointer focus:bg-blue-gray-50 focus:bg-opacity-80 focus:text-blue-gray-900 active:bg-blue-gray-50 active:bg-opacity-80 active:text-blue-gray-900 ">
                            Cancel
                        </a>
                    </div>
                    <div data-ripple-dark="true">
                        <input
                            class="p-2 bg-blue-gray-700 text-white transition-all rounded-lg outline-none font-semibold text-center hover:bg-blue-gray-50 hover:bg-opacity-80 hover:text-blue-gray-900 hover:cursor-pointer focus:bg-blue-gray-50 focus:bg-opacity-80 focus:text-blue-gray-900 active:bg-blue-gray-50 active:bg-opacity-80 active:text-blue-gray-900 "
                            type="submit"
                            value="Pindahkan Inventaris"
                        />
                    </div>
                </div>
            </form>
        </div> 
        <div
		class="relative w-6/12 h-fit max-h-3/4 mx-8 mt-8 mb-2 flex flex-col overflow-scroll text-gray-700 bg-white shadow-md bg-clip-border">
		    <table class="text-left table-auto px-8">
		    <thead class="sticky top-0">
		      <tr>
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
		    		Kategori
		    	  </p>
		    	</th>
		    	<th class="p-4 border-b border-blue-gray-100 bg-blue-gray-50">
		    	  <p class="block font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
		    		Kantor
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
		    	  <p class="block font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70"></p>
		    	</th>
		      </tr>
		    </thead>
		    <tbody>
                @foreach ($inventarisRecords as $inventaris)
		    	<tr class="even:bg-blue-gray-50/50">
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
		    			{{ $inventaris->kategori->nama_kategori }}
		    		  	</p>
		    		</td>
		    		<td class="p-4">
		    		  	<p class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
		    			{{ Str::limit($inventaris->kantor->nama_kantor, 20, '...') }}
		    		  	</p>
		    		</td>
		    		<td class="p-4">
		    		  	<p class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
		    			{{ $inventaris->lantai->nama_lantai }}
		    		  	</p>
		    		</td>
		    		<td class="p-4">
		    		  	<p class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
		    			{{ $inventaris->ruangan->nama_ruangan }}
		    		  	</p>
		    		</td>
		    		<td class="p-4">
		    			<div class="flex gap-16 items-center">
                            <a href="/inventaris-management/inventaris/{{ $inventaris->inventaris_id }}" class="block font-sans text-sm antialiased font-medium leading-normal text-blue-gray-900 hover:underline">View</a>
		    			</div>
		    		</td>
		    	</tr>                    
                @endforeach
		    </tbody>
		    </table>
	    </div> 
    </div>
    <script type="text/javascript">	
        $(document).ready(function() {
            $('#kantor').select2();
            $('#lantai').select2();
            $('#ruangan').select2();
            $('#approver1').select2();
            $('#approver2').select2();
    
            var selectedLantaiId = "{{ old('lantai_id') }}"; // Retain the previously selected lantai
            var selectedRuanganId = "{{ old('ruangan_id') }}"; // Retain the previously selected ruangan
    
            $('#kantor').change(function() {
                var kantorId = $(this).val();
                $('#lantai').empty().append('<option value="">Select Lantai</option>');
                $('#ruangan').empty().append('<option value="">Select Ruangan</option>');
    
                if (kantorId) {
                    $.ajax({
                        url: '/kantor-management/api/lantai/kantor/' + kantorId,
                        type: 'GET',
                        success: function(data) {
                            data.forEach(function(lantai) {
                                var isSelected = lantai.lantai_id == selectedLantaiId ? 'selected' : '';
                                $('#lantai').append('<option value="' + lantai.lantai_id + '" ' + isSelected + '>' + lantai.nama_lantai + '</option>');
                            });
                        }
                    });
                }
            });
    
            $('#lantai').change(function() {
                var lantaiId = $(this).val();
                $('#ruangan').empty().append('<option value="">Select Ruangan</option>');
    
                if (lantaiId) {
                    $.ajax({
                        url: '/kantor-management/api/ruangan/lantai/' + lantaiId,
                        type: 'GET',
                        success: function(data) {
                            data.forEach(function(ruangan) {
                                var isSelected = ruangan.ruangan_id == selectedRuanganId ? 'selected' : '';
                                $('#ruangan').append('<option value="' + ruangan.ruangan_id + '" ' + isSelected + '>' + ruangan.nama_ruangan + '</option>');
                            });
                        }
                    });
                }
            });
    
            // Trigger the change event to load the options on page load if values were previously selected
            if ($('#kantor').val()) {
                $('#kantor').trigger('change');
            }
    
            if (selectedLantaiId) {
                $('#lantai').trigger('change');
            }
        });
    </script>    
</x-app-layout>
