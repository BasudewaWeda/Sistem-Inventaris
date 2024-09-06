<x-app-layout>
    <div class="p-8 text-3xl font-semibold text-blue-gray-900">
        <h1>Dashboard</h1>
    </div>

	<div class="flex flex-shrink grow m-2 p-4 items-center rounded-md border justify-evenly border-blue-gray-200 border-t-transparent !border-t-blue-gray-200 bg-transparent font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 focus:border-1 focus:border-gray-900 focus:border-t-transparent focus:!border-t-gray-900 focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50">
        <div class="w-1/3 flex justify-center">
            <canvas id="inventoryByKategoriChart"></canvas>
        </div>
        <div class="w-1/3 flex justify-center">
            <canvas id="inventoryByKondisiChart"></canvas>
        </div>
        <div class="w-1/3 flex justify-center">
            <canvas id="inventoryByStatusChart"></canvas>
        </div>
    </div>

    <script>
        const chartDataKategori = @json($kategoriCount);
        const chartDataKondisi = @json($kondisiCount);
        const chartDataStatus = @json($statusCount);

        const kategoriLabels = Object.keys(chartDataKategori);
        const kategoriDataValues = Object.values(chartDataKategori);
        const kondisiLabels = Object.keys(chartDataKondisi);
        const kondisiDataValues = Object.values(chartDataKondisi);
        const statusLabels = Object.keys(chartDataStatus);
        const statusDataValues = Object.values(chartDataStatus);

        const ctxKategori = document.getElementById('inventoryByKategoriChart').getContext('2d');
        const inventoryByKategoriChart = new Chart(ctxKategori, {
            type: 'pie',
            data: {
                labels: kategoriLabels,
                datasets: [{
                    label: 'Inventory Count',
                    data: kategoriDataValues,
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Inventory Count by Category'
                    }
                }
            }
        });

        const ctxKondisi = document.getElementById('inventoryByKondisiChart').getContext('2d');
        const inventoryByKondisiChart = new Chart(ctxKondisi, {
            type: 'pie',
            data: {
                labels: kondisiLabels,
                datasets: [{
                    label: 'Inventory Count',
                    data: kondisiDataValues,
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Inventory Count by Kondisi'
                    }
                }
            }
        });

        const ctxStatus = document.getElementById('inventoryByStatusChart').getContext('2d');
        const inventoryByStatusChart = new Chart(ctxStatus, {
            type: 'pie',
            data: {
                labels: statusLabels,
                datasets: [{
                    label: 'Inventory Count',
                    data: statusDataValues,
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Inventory Count by Status'
                    }
                }
            }
        });
    </script>
</x-app-layout>
