@section('title', 'Budget')
<div class="border-2 rounded-lg w-auto h-auto p-6 bg-amber-50">
    <div>
        <h2 class="text-2xl font-semibold text-gray-800 mb-4">Tambah Budget</h2>
    </div>
    {{-- form start --}}
    <form class="space-y-4" wire:submit.prevent="store">
        {{-- name --}}
        <div>
            <label for="name" class="block text-sm font-medium text-gray-900">Nama</label>
            <div class="mt-1">
                <input type="text" wire:model="name" id="name" placeholder="Nama Budget"
                    class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                @error('name')
                    <span class="text-sm text-red-500">
                        {{ $message }}
                    </span>
                @enderror
            </div>
        </div>

        {{-- total budget --}}
        <div>
            <label for="total_amount" class="block text-sm font-medium text-gray-900">Jumlah Budget</label>
            <div class="mt-1">
                <input type="number" wire:model="total_amount" id="total_amount" placeholder="Jumlah Budget"
                    class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                @error('total_amount')
                    <span class="text-sm text-red-500">
                        {{ $message }}
                    </span>
                @enderror
            </div>
            {{-- error message --}}
            @if (session('error'))
                <div class="mt-1">
                    <span class="text-sm text-red-500">
                        {{ session('error') }}
                    </span>
                </div>
            @endif
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            {{-- start date --}}
            <div>
                <label for="start_date" class="block text-sm font-medium text-gray-900">Dimulai</label>
                <div class="mt-1">
                    <input type="date" wire:model="start_date" id="start_date" placeholder="Tanggal Dimulai"
                        class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    @error('start_date')
                        <span class="text-sm text-red-500">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
            </div>

            {{-- end date --}}
            <div>
                <label for="end_date" class="block text-sm font-medium text-gray-900">Selesai</label>
                <div class="mt-1">
                    <input type="date" wire:model="end_date" id="end_date" placeholder="Tanggal Selesai"
                        class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    @error('end_date')
                        <span class="text-sm text-red-500">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
            </div>
        </div>

        {{-- pilih karyawan --}}
        <div>
            <label for="pilihan_users" class="block text-sm font-medium text-gray-900">Pilih Karyawan</label>
            <div class="mt-1">
                <select wire:model="pilihan_users" id="pilihan_users" multiple
                    class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
                @error('pilihan_users')
                    <span class="text-sm text-red-500">
                        {{ $message }}
                    </span>
                @enderror
            </div>
        </div>

        {{-- detail field --}}
        <div>
            <label for="detail" class="block text-sm font-medium text-gray-900">Detail</label>
            <div class="mt-1">
                <textarea wire:model="detail" id="detail" cols="30" rows="10" placeholder="tuliskan detail"
                    class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"></textarea>
                @error('detail')
                    <span class="text-sm text-red-500">
                        {{ $message }}
                    </span>
                @enderror
            </div>
        </div>

        <div>
            <div class="bg-gray-700/25 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6 mt-4 w-full rounded-lg">
                <a wire:navigate href="{{ route('admin.budget') }}" type="button"
                    class="inline-flex w-full justify-center rounded-md bg-red-500 px-3 py-2 text-sm font-semibold text-white hover:bg-red-400 sm:ml-3 sm:w-auto">Batal</a>
                <button type="submit"
                    class="mt-3 inline-flex w-full justify-center rounded-md bg-indigo-500 px-3 py-2 text-sm font-semibold text-white inset-ring inset-ring-white/5 hover:bg-white/20 sm:mt-0 sm:w-auto">Simpan</button>
            </div>
        </div>
    </form>
    {{-- form end --}}
</div>
