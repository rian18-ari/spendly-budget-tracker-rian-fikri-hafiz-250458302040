@section('title', 'Karyawan')
<div>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
        <div class="p-6 rounded-xl shadow-lg border-2 bg-amber-50 w-auto mb-6">
            <h3 class="text-xl font-medium text-gray-500 pb-2">Jumlah Pegawai


            </h3>
            <h1 class="text-3xl font-medium">{{ $totalkaryawan }}</h1>
        </div>
        <div class="p-6 rounded-xl shadow-lg border-2 bg-amber-50 w-auto mb-6">
            <h3 class="text-xl font-medium text-gray-500 pb-2">Karyawan Aktif</h3>
            <h1 class="text-3xl font-medium">{{ $jeniskaryawan }}</h1>
        </div>
        <div class="p-6 rounded-xl shadow-lg border-2 bg-amber-50 w-auto mb-6">
            <h3 class="text-xl font-medium text-gray-500 pb-2">Admin Aktif</h3>
            <h1 class="text-3xl font-medium">{{ $totaladmin }}</h1>
        </div>
    </div>

    <div class="space-y-5 sm:space-y-6">
        <div class="rounded-2xl border-2 shadow-lg border-gray-200 bg-white dark:border-gray-800">
            <div class="px-6 py-5 flex flex-row">
                <h3 class="font-bold text-2xl text-gray-800">Data Karyawan</h3>
                <div wire:loading class="text-gray-500 text-xs mx-5 mt-2">
                            Mohon Tunggu sebentar....
                        </div>
                <div class="justify-end flex flex-1">
                    <input type="text" wire:model.live.debounce.500ms="search" placeholder="Cari Karyawan..." class="px-2 py-3 border-2 rounded-lg w-auto h-9 items-center flex align-middle mr-2">
                    <div class="text-base text-gray-50 flex flex-row items-center justify-between">
                        <button wire:click.prevent="export" type="button"
                            class="px-2 py-3 border-2 rounded-lg bg-indigo-500 w-auto h-9 items-center flex align-middle mr-2"><i
                                class="fa-solid fa-file-excel mr-2"></i> EXCEL</button>
                        
                        <a wire:navigate href="{{ route('admin.tambahkaryawan') }}"
                            class="px-2 py-3 border-2 rounded-lg bg-indigo-500 w-auto h-9 items-center flex align-middle mr-2">
                            <i class="fa-solid fa-plus"></i>Tambah</a>
                    </div>
                </div>
            </div>
            <div class="p-4 border-t border-gray-100 dark:border-gray-800 sm:p-6 bg-orange-200 rounded-2xl">
                <div class="space-y-5">
                    <div x-data="{ showModal: false }">
                        <div class="overflow-hidden rounded-xl border border-gray-200 bg-gray-50 dark:border-gray-800">
                            <div class="max-w-full overflow-x-auto custom-scrollbar">
                                <table class="min-w-full">
                                    <thead>
                                        <tr class="border-b border-gray-200 dark:border-gray-700">
                                            <th class="px-5 py-3 text-left w-2/12 sm:px-6">
                                                <p class="font-medium text-gray-900 text-theme-xs">No.
                                                </p>
                                            </th>
                                            <th class="px-5 py-3 text-left w-3/12 sm:px-6">
                                                <p class="font-medium text-gray-900 text-theme-xs">
                                                    Nama Karyawan
                                                </p>
                                            </th>
                                            <th class="px-5 py-3 text-left w-2/12 sm:px-6">
                                                <p class="font-medium text-gray-900 text-theme-xs">
                                                    Jabatan</p>
                                            </th>
                                            <th class="px-5 py-3 text-left w-3/12 sm:px-6">
                                                <p class="font-medium text-gray-900 text-theme-xs">
                                                    Email
                                                </p>
                                            </th>
                                            <th class="px-5 py-3 text-left w-2/12 sm:px-6">
                                                <p class="font-medium text-gray-900 text-theme-xs">
                                                    Aksi
                                                    </p>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y bg-gray-50">
                                        @forelse ($karyawans as $item)
                                            <tr class="border-t border-gray-100 dark:border-gray-800 hover:bg-gray-200">

                                                <td class="px-5 py-4 sm:px-6">
                                                    <p class="text-gray-900 text-theme-sm">
                                                        {{ $loop->iteration }}
                                                    </p>
                                                </td>
                                                <td class="px-5 py-4 sm:px-6">
                                                    <h1>{{ $item->name }}</h1>
                                                </td>
                                                <td class="px-5 py-4 sm:px-6"><span
                                                        class="rounded-full px-2 py-0.5 text-theme-xs font-medium bg-success-50 text-success-700 dark:bg-success-500/15 dark:text-success-500">{{ $item->role }}</span>
                                                </td>
                                                <td class="px-5 py-4 sm:px-6">
                                                    <p class="text-gray-900 text-theme-sm">
                                                        {{ $item->email }}</p>
                                                </td>
                                                <td class="px-5 py-4 sm:px-6 flex gap-2">
                                                    <button @click="showModal = true; $wire.confirmDelete({{ $item->id }})"
                                                        class="rounded-lg bg-red-500 w-auto h-auto p-2 text-white border-2 border-red-600">
                                                        <i class="fa-solid fa-trash"></i>
                                                    </button>
                                                    <button wire:navigate
                                                        href="{{ route('admin.editkaryawan', ['id' => $item->id]) }}"
                                                        class="rounded-lg bg-yellow-500 w-auto h-auto p-2 text-white border-2 border-yellow-600">
                                                        <i class="fa-solid fa-eye"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="px-5 py-4 text-center">
                                                    <p class="text-gray-500">table ini kosong</p>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            {{-- modal dialog --}}
                            <div x-show="showModal" style="display: none;" class="relative z-10" aria-labelledby="modal-title" role="dialog" aria-modal="true">
                                <div x-show="showModal" 
                                     x-transition:enter="ease-out duration-300" 
                                     x-transition:enter-start="opacity-25" 
                                     x-transition:enter-end="opacity-25" 
                                     x-transition:leave="ease-in duration-200" 
                                     x-transition:leave-start="opacity-25" 
                                     x-transition:leave-end="opacity-25" 
                                     class="fixed inset-0 opacity-25 bg-gray-500 bg-opacity-25 transition-opacity"></div>

                                <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
                                    <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                                        <div x-show="showModal" 
                                             x-transition:enter="ease-out duration-300" 
                                             x-transition:enter-start="opacity-25 translate-y-4 sm:translate-y-0 sm:scale-95" 
                                             x-transition:enter-end="opacity-25 translate-y-0 sm:scale-100" 
                                             x-transition:leave="ease-in duration-200" 
                                             x-transition:leave-start="opacity-25 translate-y-0 sm:scale-100" 
                                             x-transition:leave-end="opacity-25 translate-y-4 sm:translate-y-0 sm:scale-95" 
                                             class="relative transform overflow-hidden rounded-lg border-2 bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                                            <div class="bg-orange-200 px-4 pb-4 pt-5 sm:p-6 sm:pb-4 border-b">
                                                <div class="sm:flex sm:items-start">
                                                    <div class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                                                        <svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                                            <path stroke-linecap="round" 
                                                                  stroke-linejoin="round" 
                                                                  d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                                                        </svg>
                                                    </div>
                                                    <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
                                                        <h3 class="text-base font-semibold leading-6 text-gray-900" id="modal-title">Hapus Data Karyawan</h3>
                                                        <div class="mt-2">
                                                            <p class="text-sm text-gray-500">Yakin mau hapus data karyawan ini?</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="bg-amber-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                                                <button @click="showModal = false; $wire.deleteKaryawan()" 
                                                        type="button" 
                                                        class="inline-flex w-full justify-center rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500 sm:ml-3 sm:w-auto">
                                                        Ya
                                                </button>
                                                <button @click="showModal = false" 
                                                        type="button" 
                                                        class="mt-3 inline-flex w-full justify-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-indigo-500 sm:mt-0 sm:w-auto">
                                                        Batal
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- modal dialog end --}}

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



