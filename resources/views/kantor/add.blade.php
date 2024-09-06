<x-app-layout>
    <div class="px-1 md:px-2 xl:px-8 pt-1 md:pt-2 xl:pt-8 pb-2 text-3xl font-semibold text-blue-gray-900">
      	<h1>Kantor Management</h1>
    </div>

    @if ($errors->any())
    <div role="alert"
      class="xl:w-1/2 relative flex p-1 md:p-2 xl:p-4 mx-1 md:mx-2 xl:mx-8 text-sm sm:text-base text-gray-900 border border-gray-900 rounded-lg font-regular"
      style="opacity: 1;">
      <div class="shrink-0"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
          class="w-6 h-6">
          <path fill-rule="evenodd"
            d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm8.706-1.442c1.146-.573 2.437.463 2.126 1.706l-.709 2.836.042-.02a.75.75 0 01.67 1.34l-.04.022c-1.147.573-2.438-.463-2.127-1.706l.71-2.836-.042.02a.75.75 0 11-.671-1.34l.041-.022zM12 9a.75.75 0 100-1.5.75.75 0 000 1.5z"
            clip-rule="evenodd"></path>
        </svg></div>
      <div class="m-1 xl:ml-3 mr-1 md:mr-4 xl:mr-12">
        <p class="block font-sans text-base antialiased font-medium leading-relaxed text-inherit">Errors occured:</p>
        <ul class="mt-2 ml-2 list-disc list-inside">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div>
    </div>
    @endif

    <div class="2xl:w-1/2 px-1 md:px-2 xl:px-8 pt-1 md:pt-2 xl:pt-8 pb-2 relative text-gray-700 bg-transparent shadow-none rounded-xl bg-clip-border">
        <form action="" method="POST">
            {{ csrf_field() }}
            <div class="grid grid-cols-8 gap-1 sm:gap-4 items-center mb-2 xl:mb-4">
                <label 
                for="nama_kantor" 
                class="col-span-2 block font-sans text-sm sm:text-base antialiased font-semibold leading-relaxed tracking-normal text-blue-gray-900">
                    Nama Kantor
                </label>
                <input 
                type="text" 
                placeholder="BPR Lestari Sanur" 
                name="nama_kantor"
                id="nama_kantor"
                required
                class="col-span-6 rounded-md border border-blue-gray-200 border-t-transparent !border-t-blue-gray-200 bg-transparent p-2 sm:p-3 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 focus:border-1 focus:border-gray-900 focus:border-t-transparent focus:!border-t-gray-900 focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"
                value="{{ old('nama_kantor') ?? "" }}"
                >
            </div>
            <div class="grid grid-cols-8 gap-1 sm:gap-4 items-center mb-2 xl:mb-4">
                <label 
                for="kode_kantor" 
                class="col-span-2 block font-sans text-sm sm:text-base antialiased font-semibold leading-relaxed tracking-normal text-blue-gray-900">
                    Kode Kantor
                </label>
                <input 
                type="text" 
                placeholder="001"
                pattern="\d{3}"
                title="Kode kantor merupakan angka 3 digit"
                maxlength="3" 
                required
                id="kode_kantor"
                name="kode_kantor"
                class="col-span-6 rounded-md border border-blue-gray-200 border-t-transparent !border-t-blue-gray-200 bg-transparent p-2 sm:p-3 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 focus:border-1 focus:border-gray-900 focus:border-t-transparent focus:!border-t-gray-900 focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"
                value="{{ old('kode_kantor') ?? "" }}"
                >
            </div>
            <div class="grid grid-cols-8 gap-1 sm:gap-4 items-center mb-2 xl:mb-4">
                <label 
                for="nomor_telepon" 
                class="col-span-2 block font-sans text-sm sm:text-base antialiased font-semibold leading-relaxed tracking-normal text-blue-gray-900">
                    Nomor Telepon
                </label>
                <input 
                type="text" 
                pattern="0\d{9,12}"
                title="Nomor telepon harus dimulai dengan '0', diikuti oleh 9 hingga 12 digit angka."
                maxlength="13"
                placeholder="036123456789"
                required
                id="nomor_telepon"
                name="nomor_telepon_kantor"
                class="col-span-6 rounded-md border border-blue-gray-200 border-t-transparent !border-t-blue-gray-200 bg-transparent p-2 sm:p-3 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 focus:border-1 focus:border-gray-900 focus:border-t-transparent focus:!border-t-gray-900 focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"
                value="{{ old('nomor_telepon_kantor') ?? "" }}"
                >
            </div>
            <div class="grid grid-cols-8 gap-1 sm:gap-4 items-center mb-2 xl:mb-4">
                <label 
                for="alamat_kantor" 
                class="col-span-2 block font-sans text-sm sm:text-base antialiased font-semibold leading-relaxed tracking-normal text-blue-gray-900">
                    Alamat
                </label>
                <input 
                type="text" 
                placeholder="Jln By Pass Ngurah Rai" 
                required
                id="alamat_kantor"
                name="alamat_kantor"
                class="col-span-6 rounded-md border border-blue-gray-200 border-t-transparent !border-t-blue-gray-200 bg-transparent p-2 sm:p-3 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 focus:border-1 focus:border-gray-900 focus:border-t-transparent focus:!border-t-gray-900 focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"
                value="{{ old('alamat_kantor') ?? "" }}"
                >
            </div>
            <div class="grid grid-cols-8 gap-1 sm:gap-4 items-center mb-2 xl:mb-4">
                <label 
                for="provinsi" 
                class="col-span-2 block font-sans text-sm sm:text-base antialiased font-semibold leading-relaxed tracking-normal text-blue-gray-900">
                    Provinsi
                </label>
                <div class="col-span-6">
                    <select
                    class="peer h-full w-full rounded-[7px] border border-blue-gray-200 bg-transparent p-2 sm:p-3 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 empty:!bg-gray-900 focus:border-1 focus:border-gray-900 focus:border-t-transparent focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"
                    name="provinsi_id"
                    id="provinsi"
                    >
                        <option value="">Select Provinsi</option>
                        @foreach ($provinsiRecord as $provinsi)
                        <option value="{{ $provinsi->provinsi_id }}" @if($provinsi->provinsi_id == old('provinsi_id')) selected @endif>{{ $provinsi->nama_provinsi }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="grid grid-cols-8 gap-1 sm:gap-4 items-center mb-2 xl:mb-4">
                <label 
                for="kabupaten" 
                class="col-span-2 block font-sans text-sm sm:text-base antialiased font-semibold leading-relaxed tracking-normal text-blue-gray-900">
                    Kabupaten
                </label>
                <div class="col-span-6">
                    <select
                    class="peer h-full w-full rounded-[7px] border border-blue-gray-200 bg-transparent p-2 sm:p-3 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 empty:!bg-gray-900 focus:border-1 focus:border-gray-900 focus:border-t-transparent focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"
                    name="kabupaten_id"
                    id="kabupaten"
                    >
                        <option value="">Select Kabupaten</option>
                        @if (old('provinsi_id'))
                        @foreach ($kabupatenRecord as $kabupaten)
                        @if ($kabupaten->provinsi->provinsi_id == old('provinsi_id'))
                        <option value="{{ $kabupaten->kabupaten_id }}" @if($kabupaten->kabupaten_id == old('kabupaten_id')) selected @endif>{{ $kabupaten->nama_kabupaten }}</option>
                        @endif
                        @endforeach
                        @endif
                    </select>
                </div>
            </div>
            <div class="grid grid-cols-8 gap-4 items-top mb-2 xl:mb-4">
                <label 
                class="col-span-2 py-3 block font-sans text-sm sm:text-base antialiased font-semibold leading-relaxed tracking-normal text-blue-gray-900">
                    Lantai & Ruangan
                </label>
                <div class="col-span-6">
                    <div class="lantai-group">

                    </div>
                    <button type="button" onclick="addLantai()" class="p-1 sm:p-2 bg-blue-gray-700 text-white transition-all rounded-lg outline-none font-semibold text-center hover:bg-blue-gray-50 hover:bg-opacity-80 hover:text-blue-gray-900 hover:cursor-pointer focus:bg-blue-gray-50 focus:bg-opacity-80 focus:text-blue-gray-900 active:bg-blue-gray-50 active:bg-opacity-80 active:text-blue-gray-900 ">Add Lantai</button>
                </div>
            </div>
            <div class="flex gap-2 md:gap-4 justify-end">
                <div class="flex">
                    <a 
                        href="/kantor-management" 
                        data-ripple-dark="true"
                        class="text-sm sm:text-base p-2 bg-blue-gray-100 text-blue-gray-700 transition-all rounded-lg outline-none font-semibold text-center hover:bg-blue-gray-50 hover:bg-opacity-80 hover:text-blue-gray-900 hover:cursor-pointer focus:bg-blue-gray-50 focus:bg-opacity-80 focus:text-blue-gray-900 active:bg-blue-gray-50 active:bg-opacity-80 active:text-blue-gray-900 ">
                        Cancel
                    </a>
                </div>
                <div data-ripple-dark="true">
                    <input
                        class="text-sm sm:text-base p-2 bg-blue-gray-700 text-white transition-all rounded-lg outline-none font-semibold text-center hover:bg-blue-gray-50 hover:bg-opacity-80 hover:text-blue-gray-900 hover:cursor-pointer focus:bg-blue-gray-50 focus:bg-opacity-80 focus:text-blue-gray-900 active:bg-blue-gray-50 active:bg-opacity-80 active:text-blue-gray-900 "
                        type="submit"
                        value="Add Kantor"
                    />
                </div>
            </div>
        </form>
    </div>  
    <script type="text/javascript">	
        $(document).ready(function() {
            $('#kabupaten').select2();
            $('#provinsi').select2();
            $('#provinsi').change(function() {
                var provinsiId = $(this).val();
                $('#kabupaten').empty().append('<option value="">Select Kabupaten</option>');

                if (provinsiId) {
                    $.ajax({
                        url: '/kantor-management/api/kabupaten/provinsi/' + provinsiId,
                        type: 'GET',
                        success: function(data) {
                            var selectedKabupatenId = "{{ old('kabupaten_id') }}";
                            data.forEach(function(kabupaten) {
                                var isSelected = kabupaten.kabupaten_id == selectedKabupatenId ? 'selected' : '';
                                $('#kabupaten').append('<option value="' + kabupaten.kabupaten_id + '" ' + isSelected + '>' + kabupaten.nama_kabupaten + '</option>');
                            });
                        }
                    });
                }
            });

        });

        let lantaiIndex = 0;
        let ruanganIndexes = {};
        
        function addLantai() {
            const lantaiGroup = document.createElement('div');
            lantaiGroup.classList.add('lantai');
            lantaiGroup.setAttribute('data-lantai-index', lantaiIndex);
        
            ruanganIndexes[lantaiIndex] = 0;
        
            lantaiGroup.innerHTML = `
                <div class="flex gap-2">
                    <input placeholder="Nama Lantai" required type="text" name="lantai[${lantaiIndex}][nama_lantai]" class="flex-1 mb-2 rounded-md border border-blue-gray-200 border-t-transparent !border-t-blue-gray-200 bg-transparent p-2 sm:p-3 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 focus:border-1 focus:border-gray-900 focus:border-t-transparent focus:!border-t-gray-900 focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"/>
                    <button type="button" onclick="removeLantai(${lantaiIndex})" class="text-sm sm:text-base p-1 sm:p-2 mb-1 sm:mb-2 bg-blue-gray-700 text-white transition-all rounded-lg outline-none font-semibold text-center hover:bg-blue-gray-50 hover:bg-opacity-80 hover:text-blue-gray-900 hover:cursor-pointer focus:bg-blue-gray-50 focus:bg-opacity-80 focus:text-blue-gray-900 active:bg-blue-gray-50 active:bg-opacity-80 active:text-blue-gray-900 ">Remove Lantai</button>
                    </div>
                <div class="ruangan-group" id="ruangan-group-${lantaiIndex}">
                </div>
                <button type="button" onclick="addRuangan(${lantaiIndex})" class="text-sm sm:text-base p-1 sm:p-2 mb-1 bg-blue-gray-700 text-white transition-all rounded-lg outline-none font-semibold text-center hover:bg-blue-gray-50 hover:bg-opacity-80 hover:text-blue-gray-900 hover:cursor-pointer focus:bg-blue-gray-50 focus:bg-opacity-80 focus:text-blue-gray-900 active:bg-blue-gray-50 active:bg-opacity-80 active:text-blue-gray-900 ">Add Ruangan</button>
            `;
            
            document.querySelector('.lantai-group').appendChild(lantaiGroup);
            lantaiIndex++;
        }
    
        function addRuangan(lantaiIndex) {
            const ruanganGroup = document.querySelector(`#ruangan-group-${lantaiIndex}`);
            const ruanganIndex = ruanganIndexes[lantaiIndex];
        
            const ruanganDiv = document.createElement('div');
            ruanganDiv.setAttribute('data-ruangan-index', ruanganIndex);
            ruanganDiv.className = 'ruangan flex md:flex-row flex-col gap-1 md:gap-2 ml-2';
        
            ruanganDiv.innerHTML = `
                <input type="text" required placeholder="Nama Ruangan" name="lantai[${lantaiIndex}][ruangan][${ruanganIndex}][nama_ruangan]" class="flex-1 mb-1 md:mb-2 rounded-md border border-blue-gray-200 border-t-transparent !border-t-blue-gray-200 bg-transparent p-2 sm:p-3 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 focus:border-1 focus:border-gray-900 focus:border-t-transparent focus:!border-t-gray-900 focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"/>
                <input type="text" required placeholder="Detail Ruangan" name="lantai[${lantaiIndex}][ruangan][${ruanganIndex}][detail_ruangan]" class="flex-1 mb-1 md:mb-2 rounded-md border border-blue-gray-200 border-t-transparent !border-t-blue-gray-200 bg-transparent p-2 sm:p-3 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 focus:border-1 focus:border-gray-900 focus:border-t-transparent focus:!border-t-gray-900 focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"/>
                <button type="button" onclick="removeRuangan(${lantaiIndex}, ${ruanganIndex})" class="p-2 mb-2 bg-blue-gray-700 text-white transition-all rounded-lg outline-none font-semibold text-center hover:bg-blue-gray-50 hover:bg-opacity-80 hover:text-blue-gray-900 hover:cursor-pointer focus:bg-blue-gray-50 focus:bg-opacity-80 focus:text-blue-gray-900 active:bg-blue-gray-50 active:bg-opacity-80 active:text-blue-gray-900 ">Remove Ruangan</button>
            `;
        
            ruanganGroup.appendChild(ruanganDiv);
            ruanganIndexes[lantaiIndex]++;
        }
    
        function removeLantai(lantaiIndex) {
            const lantaiDiv = document.querySelector(`.lantai[data-lantai-index="${lantaiIndex}"]`);
            lantaiDiv.remove();
        }
    
        function removeRuangan(lantaiIndex, ruanganIndex) {
            const ruanganDiv = document.querySelector(`.lantai[data-lantai-index="${lantaiIndex}"] .ruangan[data-ruangan-index="${ruanganIndex}"]`);
            ruanganDiv.remove();
        }
    </script>
</x-app-layout>
