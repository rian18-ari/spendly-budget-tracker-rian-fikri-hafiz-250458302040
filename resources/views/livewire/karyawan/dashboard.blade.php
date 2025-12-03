@section('title', 'Dashboard')
<div>

            <!-- Contoh Kartu Dashboard -->
            <div class="grid grid-cols-3 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div class="p-6 rounded-xl shadow-lg border-2 bg-amber-50 col-span-2">
                    <p class="text-sm font-medium text-gray-500">Saldo saat ini</p>
                    <p class="text-3xl font-bold text-cyan-900 mt-1">Rp. {{ number_format($balance, 0, ',', '.') }}</p>
                </div>
                <div class="p-6 rounded-xl shadow-lg border-2 bg-amber-50 col-span-2">
                    <p class="text-sm font-medium text-gray-500">Pengeluaran (Bulan Ini)</p>
                    <p class="text-3xl font-bold text-cyan-900 mt-1">Rp. {{ number_format($total_pengeluaran, 0, ',', '.') }}</p>
                </div>
                <div class="p-6 rounded-xl shadow-lg border-2 bg-amber-50 col-span-2">
                    <p class="text-sm font-medium text-gray-500">Pengeluaran Terbesar</p>
                    <p class="text-3xl font-bold text-cyan-900 mt-1">{{ $nominalTerbesar->note?? "Belum ada transaksi" }}</p>
                    <p class="text-sm font-bold text-cyan-900 mt-1">Rp. {{ number_format($nominalTerbesar->amount?? 0, 0, ',', '.') }}</p>
                </div>
                <div class="p-6 rounded-xl shadow-lg border-2 bg-amber-50 col-span-2">
                    <p class="text-sm font-medium text-gray-500">Tugas Tertunda</p>
                    <p class="text-3xl font-bold text-cyan-900 mt-1">14</p>
                </div>
            </div>

            <!-- Konten Panjang untuk memastikan scroll berfungsi -->
            <div class="bg-amber-50 p-6 rounded-xl shadow-lg mb-6 border-2">
                <h3 class="text-xl font-semibold text-gray-800 mb-4">Laporan Aktivitas</h3>
                <p class="text-gray-600 mb-6">
                    @livewire('karyawan.chart-karyawan')
                </p>

                <p class="text-gray-600 mt-4 text-center text-sm">
                    Scroll ke bawah untuk melihat akhir konten.
                </p>
            </div>
            <!-- Akhir Konten Panjang -->

</div>