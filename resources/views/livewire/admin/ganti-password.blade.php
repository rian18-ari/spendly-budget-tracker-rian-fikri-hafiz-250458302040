@section('title', 'Ganti Password')
<div class="border-2 rounded-lg w-auto h-auto p-6 bg-amber-50">
    {{-- <div class="max-w-4xl mx-auto py-10 sm:px-6 lg:px-8"> --}}
        <div class="mt-5 md:mt-0 md:col-span-2">
            {{-- <div class="px-4 py-5 rounded-2xl border-2 shadow-lg border-gray-200 bg-white sm:p-6 "> --}}
                <div class="grid grid-cols-6 gap-6">
                    <!-- Current Password -->
                    <div class="col-span-6 sm:col-span-4">
                        <label for="current_password" class="block font-medium text-sm text-gray-700">Password Saat
                            Ini</label>
                        <input id="current_password" type="password" wire:model="current_password"
                            class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                        @error('current_password')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- New Password -->
                    <div class="col-span-6 sm:col-span-4">
                        <label for="password" class="block font-medium text-sm text-gray-700">Password Baru</label>
                        <input id="password" type="password" wire:model="password"
                            class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                        @error('password')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div class="col-span-6 sm:col-span-4">
                        <label for="password_confirmation" class="block font-medium text-sm text-gray-700">Konfirmasi
                            Password</label>
                        <input id="password_confirmation" type="password" wire:model="password_confirmation"
                            class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                        @error('password_confirmation')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            {{-- </div> --}}

            <div
                class="bg-gray-700/25 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6 mt-4 w-full rounded-lg">
                @if (session()->has('success'))
                    <div class="mr-3 text-sm text-green-600">
                        {{ session('success') }}
                    </div>
                @endif

                <button wire:click="save"
                    class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition">
                    Simpan
                </button>
            </div>
        </div>
    {{-- </div> --}}
</div>
