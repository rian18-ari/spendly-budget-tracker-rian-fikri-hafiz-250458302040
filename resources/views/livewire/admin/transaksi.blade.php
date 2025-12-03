@section('title', 'Transaksi')
<div>
    <div class="grid grid-cols-4 gap-4">
        <div class="p-6 rounded-xl shadow-lg border-2 bg-amber-50 w-auto mb-6">
            <h3 class="text-xl font-medium text-gray-500 pb-2">Jumlah Transaksi</h3>
            <h1 class="text-3xl font-medium">{{ $flowtransaksi }}</h1>
        </div>
        <div class="p-6 rounded-xl shadow-lg border-2 bg-green-200 w-auto mb-6">
            <h3 class="text-xl font-medium text-green-500 pb-2">Di setujui</h3>
            <h1 class="text-3xl font-medium">{{ $disetujui }}</h1>
        </div>
        <div class="p-6 rounded-xl shadow-lg border-2 bg-red-200 w-auto mb-6">
            <h3 class="text-xl font-medium text-red-500 pb-2">Di tolak</h3>
            <h1 class="text-3xl font-medium">{{ $ditolak }}</h1>
        </div>
        <div class="p-6 rounded-xl shadow-lg border-2 bg-amber-200 w-auto mb-6">
            <h3 class="text-xl font-medium text-amber-500 pb-2">Menunggu</h3>
            <h1 class="text-3xl font-medium">{{ $menunggu }}</h1>
        </div>
    </div>

    <div class="space-y-5 sm:space-y-6">
        <div class="rounded-2xl border-2 shadow-lg border-gray-200 bg-white dark:border-gray-800">
            <div class="px-6 py-5 flex flex-row">
                <h3 class="font-bold text-2xl text-gray-800">Detail Transaksi</h3>
                <div wire:loading class="text-gray-500 mx-5 mt-2">
                    Mohon Tunggu sebentar....
                </div>
                <div class="justify-end gap-2 flex flex-1">
                    <div class="text-base text-gray-50 flex flex-row items-center justify-between">
                        <button wire:click.prevent="export"
                            class="px-2 py-3 border-2 rounded-lg bg-indigo-500 w-auto h-9 items-center flex align-middle mr-2"><i
                                class="fa-solid fa-file-excel mr-2"></i> EXCEL</button>
                    </div>
                </div>
            </div>
            <div class="p-4 border-t border-gray-100 dark:border-gray-800 sm:p-6 bg-orange-200 rounded-2xl">
                <div class="space-y-5">
                    <div class="overflow-hidden rounded-xl border border-gray-200 bg-gray-50 dark:border-gray-800">
                        <div class="max-w-full overflow-x-auto custom-scrollbar">
                            <table class="min-w-full">
                                <thead>
                                    <tr class="border-b border-gray-200 dark:border-gray-700">
                                        <th class="px-5 py-3 text-left w-1/12 sm:px-6">
                                            <p class="font-medium text-gray-900 text-theme-xs">No.
                                            </p>
                                        </th>
                                        <th class="px-5 py-3 text-left w-3/12 sm:px-6">
                                            <p class="font-medium text-gray-900 text-theme-xs">
                                                Keterangan
                                            </p>
                                        </th>
                                        <th class="px-5 py-3 text-left w-2/12 sm:px-6">
                                            <p class="font-medium text-gray-900 text-theme-xs">
                                                Jenis</p>
                                        </th>
                                        <th class="px-5 py-3 text-left w-2/12 sm:px-6">
                                            <p class="font-medium text-gray-900 text-theme-xs">Nominal
                                            </p>
                                        </th>
                                        <th class="px-5 py-3 text-left w-2/12 sm:px-6">
                                            <p class="font-medium text-gray-900 text-theme-xs">
                                                Status</p>
                                        </th>
                                        <th class="px-5 py-3 text-left w-2/12 sm:px-6">
                                            <p class="font-medium text-gray-900 text-theme-xs">
                                                Tanggal</p>
                                        </th>
                                        <th class="px-5 py-3 text-left w-2/12 sm:px-6">
                                            <p class="font-medium text-gray-900 text-theme-xs">
                                                Aksi</p>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y bg-gray-50">
                                    @forelse ($transaksi as $item)
                                        <tr class="border-t border-gray-100 dark:border-gray-800 hover:bg-gray-200"
                                            wire:key="transaksi-{{ $item->id }}-{{ $statusFilter }}">

                                            <td class="px-5 py-4 sm:px-6">
                                                <p class="text-gray-900 text-theme-sm">
                                                    {{ $loop->iteration }}
                                                </p>
                                            </td>
                                            <td class="px-5 py-4 sm:px-6">
                                                <h1>{{ $item->note }}</h1>
                                            </td>
                                            <td class="px-5 py-4 sm:px-6"><span
                                                    class="rounded-full px-2 py-0.5 text-theme-xs font-medium bg-success-50 text-success-700 dark:bg-success-500/15 dark:text-success-500">{{ $item->type }}</span>
                                            </td>
                                            <td class="px-5 py-4 sm:px-6">
                                                <p class="text-gray-900 text-theme-sm">
                                                    Rp. {{ number_format($item->amount, 0, ',', '.') }}</p>
                                            </td>
                                            <td class="px-5 py-4 sm:px-6">
                                                <p class="text-gray-900 text-theme-sm">
                                                    @if ($item->status == 'menunggu')
                                                        <span
                                                            class="rounded-lg bg-amber-200 w-auto h-auto p-1 border-2 border-amber-300">menunggu</span>
                                                    @elseif ($item->status == 'di setujui')
                                                        <span
                                                            class="rounded-lg bg-green-200 w-auto h-auto p-1 border-2 border-green-300">disetujui</span>
                                                    @elseif ($item->status == 'di tolak')
                                                        <span
                                                            class="rounded-lg bg-red-200 w-auto h-auto p-1 border-2 border-red-300">ditolak</span>
                                                    @endif
                                                </p>
                                            </td>
                                            <td class="px-5 py-4 sm:px-6">
                                                <p class="text-gray-900 text-theme-sm">
                                                    {{ $item->date }}</p>
                                            </td>
                                            <td class="px-5 py-4 sm:px-6">
                                                <a href="{{ route('admin.edittransaksi', ['id' => $item->id]) }}"
                                                    class="rounded-lg bg-yellow-500 w-auto h-auto p-2 text-white border-2 border-yellow-600"><i
                                                        class="fa-solid fa-eye"></i></a>
                                            </td>
                                        @empty
                                        <tr>
                                            <td colspan="6" class="px-5 py-4 text-center">
                                                <p class="text-gray-500">table ini kosong</p>
                                            </td>
                                        </tr>
                                    @endforelse

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
