@section('title', 'Budget')
<div class="border-2 rounded-lg w-auto h-auto p-6 bg-amber-50">
    <div>
        <h2 class="text-2xl font-semibold text-gray-800 mb-4">Form Tambah Karyawan</h2>
    </div>
    {{-- form start --}}
    <form class="gap-x-4 gap-y-4" wire:submit.prevent="update">
        <div>
            {{-- name  --}}
            <div>
                <label for="name" class="block text-sm font-medium text-gray-900">Name</label>
                <div class="mt-1">
                    <input type="text" wire:model="name" id="name"
                        class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    @error('name')
                        <span class="text-sm text-red-500">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
            </div>
            {{-- total_amount --}}
            <div>
                <label for="total_amount" class="block text-sm font-medium text-gray-900">Saldo Total</label>
                <div class="mt-1">
                    <input type="number" wire:model="total_amount" id="total_amount"
                        class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    @error('name')
                        <span class="text-sm text-red-500">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
            </div>
            {{-- detail --}}
            <div>
                <label for="detail" class="block text-sm font-medium text-gray-900">Detail</label>
                <div class="mt-1">
                    <input type="text" wire:model="detail" id="detail"
                        class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    @error('name')
                        <span class="text-sm text-red-500">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
            </div>
            {{-- start_date & end_date --}}
            <div class="flex gap-x-4 grid-cols-2">
                {{-- start_date --}}
                <div class="col-span-1">
                    <div>
                        <label for="start_date" class="block text-sm font-medium text-gray-900">Tanggal Mulai</label>
                        <div class="mt-1">
                            <input type="date" wire:model="start_date" id="start_date"
                                class="block w-full col-span-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        </div>
                    </div>
                    {{-- end_date --}}
                    <div>
                        <label for="end_date" class="block text-sm font-medium text-gray-900">Tanggal Selesai</label>
                        <div class="mt-1">
                            <input type="date" wire:model="end_date" id="end_date"
                                class="block w-full col-span-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        </div>
                    </div>
                </div>
                {{-- habis di sini --}}
                {{-- data karyawan --}}
                <div class="col-span-1">
                    <label for="user_ids" class="block text-sm font-medium text-gray-900">Karyawan yang bersangkutan</label>
                    <select name="user_ids" id="user_ids" multiple wire:model="user_ids" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm overflow-y-auto h-24">
                        @foreach ($dataKaryawan as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                        @error('user_ids')
                            <span class="text-sm text-red-500">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                </div>
            </div>
            <div>
                <div class="bg-gray-700/25 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6 mt-4 w-full">
                    <a wire:navigate href="{{ route('admin.budget') }}" command="close" commandfor="dialog"
                        class="inline-flex w-full justify-center rounded-md bg-red-500 px-3 py-2 text-sm font-semibold text-white hover:bg-red-400 sm:ml-3 sm:w-auto">Batal</a>
                    <button type="submit"
                        class="mt-3 inline-flex w-full justify-center rounded-md bg-indigo-500 px-3 py-2 text-sm font-semibold text-white inset-ring inset-ring-white/5 hover:bg-white/20 sm:mt-0 sm:w-auto">Simpan</button>
                </div>
            </div>
    </form>
    {{-- form end --}}
</div>
