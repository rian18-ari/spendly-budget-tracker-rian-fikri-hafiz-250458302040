@section('title', 'Dashboard')
<div>
    <!-- Cards Dashboard -->
    <div class="grid grid-cols-3 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="p-6 rounded-xl shadow-lg border-2 bg-amber-50 col-span-4">
            <p class="text-sm font-medium text-gray-500">Saldo saat ini,....</p>
            <p class="text-3xl font-bold text-cyan-900 mt-1">Rp.
                {{ number_format($budget_master->first()?->budget ?? 0, 0, ',', '.') }}</p>
        </div>
        <div class="p-6 rounded-xl shadow-lg border-2 bg-amber-50 col-span-2">
            <p class="text-sm font-medium text-gray-500">Pengeluaran</p>
            <p class="text-3xl font-bold text-cyan-900 mt-1">Rp. {{ number_format($total_pengeluaran, 0, ',', '.') }}
            </p>
        </div>
        <div class="p-6 rounded-xl shadow-lg border-2 bg-amber-50">
            <p class="text-sm font-medium text-gray-500">Pegawai Aktif</p>
            <p class="text-3xl font-bold text-cyan-900 mt-1">{{ $pengguna }}</p>
        </div>
        <div class="p-6 rounded-xl shadow-lg border-2 bg-amber-50 ">
            <p class="text-sm font-medium text-gray-500">Budget Aktif</p>
            <p class="text-3xl font-bold text-cyan-900 mt-1">{{ $budgetAktif }}</p>
        </div>
    </div>

    <!-- Chart Section -->
    <div class="bg-white p-6 rounded-xl shadow-lg mb-6 border-2">
        <h3 class="text-xl font-semibold text-gray-800 mb-4">Laporan Aktivitas Bulanan</h3>
        <div class="bg-gray-50 rounded-lg flex justify-between">
            <div class="w-100">
                <canvas id="budgetChart" class="w-auto h-96"></canvas>
            </div>
            <table class="w-auto divide-y divide-gray-200 border border-gray-300 rounded-lg">
                <thead class="bg-gray-100">
                    <tr>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Nama Kegiatan</th>
                        <th scope="col"
                            class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Total Jumlah</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($dataChart as $item)
                        <tr class="hover:bg-indigo-50/50">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                {{ $item->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-right text-gray-700">
                                Rp{{ number_format($item->total_amount, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- Script Chart - Gunakan @script untuk Livewire --}}
@script
<script>
    let budgetChart = null;
    let initAttempts = 0;
    const maxAttempts = 10;

    function initBudgetChart() {
        console.log('sedang mengambil data...', initAttempts + 1);

        const ctx = document.getElementById('budgetChart');
        
        if (!ctx) {
            console.warn('data tidak bisa di muat! mencoba muat ulang...');
            initAttempts++;
            
            if (initAttempts < maxAttempts) {
                setTimeout(() => {
                    initBudgetChart();
                }, 200);
            } else {
                console.error('data tidak ditemukan setelah', maxAttempts, 'percobaan');
                initAttempts = 0;
            }
            return;
        }

        initAttempts = 0;

        try {
            // PENTING: Destroy semua chart yang mungkin masih nempel di canvas ini
            const existingChart = Chart.getChart(ctx);
            if (existingChart) {
                console.log('menghapus data terakhir..');
                existingChart.destroy();
            }
            
            // Destroy chart yang di variabel global juga
            if (budgetChart) {
                console.log('Destroying budgetChart variable...');
                budgetChart.destroy();
                budgetChart = null;
            }

            const labels = @json($chartLabels ?? []);
            const data = @json($chartData ?? []);

            console.log('Labels:', labels);
            console.log('Data:', data);

            if (!labels || !data || labels.length === 0 || data.length === 0) {
                console.warn('No data available for chart');
                ctx.parentElement.innerHTML = '<p class="text-center text-lg text-gray-500 py-12">Tidak ada data untuk ditampilkan.</p>';
                return;
            }

            function generateRandomColor() {
                const r = Math.floor(Math.random() * 200) + 50;
                const g = Math.floor(Math.random() * 200) + 50;
                const b = Math.floor(Math.random() * 200) + 50;
                return `rgb(${r}, ${g}, ${b})`;
            }

            const backgroundColors = data.map(() => generateRandomColor());

            // Buat chart baru
            budgetChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Total Anggaran',
                        data: data,
                        backgroundColor: backgroundColors,
                        hoverOffset: 4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { position: 'top' },
                        title: {
                            display: true,
                            text: 'Distribusi Anggaran Berdasarkan Nama Kegiatan'
                        }
                    }
                }
            });

            console.log('Chart created successfully! ID:', budgetChart.id);

        } catch (e) {
            console.error("Error creating chart:", e);
            
            // Kalau error, coba destroy semua chart dan reset canvas
            Chart.helpers.each(Chart.instances, (instance) => {
                instance.destroy();
            });
            
            ctx.parentElement.innerHTML = '<p class="text-center text-lg text-red-500 py-12">Error memuat data chart: ' + e.message + '</p>';
        }
    }

    // Initialize pertama kali
    document.addEventListener('DOMContentLoaded', () => {
        console.log('DOM loaded');
        initBudgetChart();
    });

    // Re-initialize setelah navigasi
    document.addEventListener('livewire:navigated', () => {
        console.log('Page navigated, re-initializing chart...');
        
        // Destroy dulu sebelum delay
        const ctx = document.getElementById('budgetChart');
        if (ctx) {
            const existingChart = Chart.getChart(ctx);
            if (existingChart) {
                existingChart.destroy();
            }
        }
        
        if (budgetChart) {
            budgetChart.destroy();
            budgetChart = null;
        }
        
        initAttempts = 0;
        
        setTimeout(() => {
            initBudgetChart();
        }, 300);
    });

    // Cleanup sebelum navigasi
    document.addEventListener('livewire:navigating', () => {
        console.log('Navigating away, destroying chart...');
        
        const ctx = document.getElementById('budgetChart');
        if (ctx) {
            const existingChart = Chart.getChart(ctx);
            if (existingChart) {
                existingChart.destroy();
            }
        }
        
        if (budgetChart) {
            budgetChart.destroy();
            budgetChart = null;
        }
    });
</script>
@endscript

