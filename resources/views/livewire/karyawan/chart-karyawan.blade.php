@section('title', 'Statistik')
<div class="bg-white p-6 rounded-xl shadow-lg border-2">
    
    <div class="flex justify-between items-center mb-4">
        {{-- JUDUL, Updated by Livewire directly --}}
        <h3 class="text-xl font-extrabold text-gray-800 border-b pb-2">
            {{ $chartTitle }}
        </h3>

        {{-- >>> Filter Dropdown Livewire <<< --}}
        
    </div>

    {{-- Chart Container with wire:ignore to prevent Livewire from re-rendering the canvas --}}
    <div 
        class="relative h-64 sm:h-80"
        wire:ignore
        x-data="transactionChartData(@js($labels), @js($data))"
        x-init="initChart()"
        @chart-data-updated.window="updateChart($event.detail.labels, $event.detail.data)"
    >
        <canvas x-ref="myChart"></canvas>
    </div>

    <script>
        // Fungsi Alpine.js untuk Chart.js
        function transactionChartData(initialLabels, initialData) {
            return {
                labels: initialLabels,
                data: initialData,
                chart: null,

                initChart() {
                    if (typeof Chart === 'undefined') {
                        console.error('Chart.js belum dimuat. Pastikan script Chart.js diimpor di layout.');
                        return;
                    }
                    
                    const ctx = this.$refs.myChart.getContext('2d');
                    
                    this.chart = new Chart(ctx, {
                        type: 'line', // Line Chart untuk melihat tren harian
                        data: {
                            labels: this.labels,
                            datasets: [{
                                label: 'Total Pengeluaran (Rp)',
                                data: this.data,
                                backgroundColor: 'rgba(59, 130, 246, 0.4)', // Warna Biru Tailwind
                                borderColor: 'rgb(59, 130, 246)',
                                borderWidth: 2,
                                tension: 0.3, // Membuat garis melengkung
                                fill: true,
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    title: { display: true, text: 'Jumlah Pengeluaran (Rp)' },
                                    ticks: {
                                        // Format Rupiah di sumbu Y
                                        callback: function(value) {
                                            return new Intl.NumberFormat('id-ID', {
                                                style: 'currency',
                                                currency: 'IDR',
                                                minimumFractionDigits: 0
                                            }).format(value);
                                        }
                                    },
                                },
                                x: { 
                                    grid: { display: false } 
                                }
                            },
                            plugins: {
                                legend: { display: false },
                                tooltip: {
                                    // Format Rupiah di Tooltip
                                    callbacks: {
                                        label: (context) => 
                                            context.dataset.label + ': ' + new Intl.NumberFormat('id-ID', { 
                                                style: 'currency', 
                                                currency: 'IDR',
                                                minimumFractionDigits: 0
                                            }).format(context.parsed.y)
                                    }
                                }
                            }
                        }
                    });
                },
                
                // Fungsi untuk MENGUPDATE CHART secara dinamis
                updateChart(newLabels, newData) {
                    // Update data Alpine state
                    this.labels = newLabels;
                    this.data = newData;
                    
                    // Update data Chart.js
                    if (this.chart) {
                        this.chart.data.labels = newLabels;
                        this.chart.data.datasets[0].data = newData;
                        this.chart.update(); // Panggil update untuk menggambar ulang grafik
                    }
                }
            }
        }
    </script>
</div>